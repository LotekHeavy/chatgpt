<?php
error_reporting(E_ALL ^ E_WARNING);
header("Access-Control-Allow-Origin: *");
set_time_limit(0);
session_start();
$postData = $_SESSION['data'];

$responsedata = "";
$ch = curl_init();
$OPENAI_API_KEY = "";

//Der folgende Code holt sich den apikey aus der Datei und wird per Polling aufgerufen. Um apikey zu konfigurieren, gehen Sie zu key.php
$content = "<?php header('HTTP/1.1 404 Not Found');exit; ?>\n";
$line = 0;
$handle = fopen(__DIR__ . "/apikey.php", "r") or die("Writing file failed.");
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        $line++;
        if ($line == 2) {
            $OPENAI_API_KEY = str_replace("\n", "", $buffer);
        }
        if ($line > 2) {
            $content .= $buffer;
        }
    }
    fclose($handle);
}
$content .= $OPENAI_API_KEY . "\n";
$handle = fopen(__DIR__ . "/apikey.php", "w") or die("Writing file failed.");
if ($handle) {
    fwrite($handle, $content);
    fclose($handle);
}

//Wenn die Homepage die Eingabe eines benutzerdefinierten apikeys erlaubt, wird der vom Benutzer eingegebene apikey verwendet
if (isset($_SESSION['key'])) {
    $OPENAI_API_KEY = $_SESSION['key'];
}
session_write_close();
$headers  = [
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer ' . $OPENAI_API_KEY
];

setcookie("errcode", ""); //EventSource kann keine Fehlermeldungen erhalten, die über ein Cookie geliefert werden
setcookie("errmsg", "");

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/images/generations');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // Setzen Sie den Timeout für die Verbindung auf 30 Sekunden
curl_setopt($ch, CURLOPT_MAXREDIRS, 3); // Setzen Sie die maximale Anzahl von Weiterleitungen auf 3
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Automatische Umleitung zulassen
curl_setopt($ch, CURLOPT_AUTOREFERER, true); // Automatisches Setzen des Referers
//curl_setopt($ch, CURLOPT_PROXY, "http://127.0.0.1:1081");
$responsedata = curl_exec($ch);
echo $responsedata;
curl_close($ch);


session_start();
$questionarr = json_decode($postData, true);
$answer = json_decode($responsedata, true);
$goodanswer = '![IMG](' . $answer['data'][0]['url'] . ')';
$filecontent = $_SERVER["REMOTE_ADDR"] . " | " . date("Y-m-d H:i:s") . "\n";
$filecontent .= "Q:" . $questionarr['prompt'] .  "\nA:" . trim($goodanswer) . "\n----------------\n";
$myfile = fopen(__DIR__ . "/chat.txt", "a") or die("Writing file failed.");
fwrite($myfile, $filecontent);
fclose($myfile);
