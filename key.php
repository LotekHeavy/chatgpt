<?php
$content = "";
session_start();
if ((isset($_SESSION['admin'])) && ($_SESSION['admin'] == true)) {
    if (isset($_POST["message"])) {
        if ($_POST["action"] == "save") {
            $handle = fopen(__DIR__ . "/apikey.php", "w") or die("Writing file failed.");
            if ($handle) {
                fwrite($handle, "<?php header('HTTP/1.1 404 Not Found');exit; ?>\n" . $_POST["message"]);
                fclose($handle);
                exit;
            }
        } elseif ($_POST["action"] == "check") {
            $lines = explode("\n", $_POST["message"]);
            $i = 0;
            $validkey = "";
            $invalidkey = "";
            while ($i < count($lines)) {
                $line = $lines[$i];
                $headers  = [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $line
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/models/gpt-4');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec($ch);
                curl_close($ch);
                $complete = json_decode($response);
                if (isset($complete->error)) {
                    $invalidkey .= $line . "\n";
                } else {
                    $validkey .= $line . "\n";
                }
                $i++;
            }
            echo $validkey;
            exit;
        }
    }
    $line = 0;
    $handle = @fopen(__DIR__ . "/apikey.php", "r");
    if ($handle) {
        while (($buffer = fgets($handle)) !== false) {
            $line++;
            if ($line > 1) {
                $content .= $buffer;
            }
        }
        fclose($handle);
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>API_KEY-Konfigurationsdaten</title>
        <script src="js/jquery-3.6.4.min.js"></script>
        <script src="js/layer.min.js" type="application/javascript"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            .container {
                margin: 50px auto;
                width: 80%;
                max-width: 800px;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }

            textarea {
                width: calc(100% - 20px);
                height: 200px;
                padding: 10px;
                border: none;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                resize: none;
                font-size: 16px;
                line-height: 1.5;
                margin-bottom: 20px;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                margin-right: 10px;
                transition: background-color 0.3s ease;
            }

            .btn:hover {
                background-color: #3e8e41;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>API_KEY-Konfigurationsdaten</h1>
            <textarea placeholder="Bitte geben Sie eine Zeile und einen Zeilenumbruch ein." id="tt"><?php echo $content; ?></textarea>
            <button class="btn" onclick="checkit();">Verifizierung der Gültigkeit</button> <button class="btn" onclick="saveit();">Aktuelle Einstellungen speichern</button>
        </div>
    </body>
    <script>
        function saveit() {
            $.ajax({
                type: "POST",
                url: "key.php",
                data: {
                    message: $("#tt").val(),
                    action: "save",
                },
                success: function(results) {
                    layer.msg('Erfolgreich gespeichert, können Sie diese Seite zur Bestätigung aktualisieren');
                }
            });
        }

        function checkit() {
            var loading = layer.msg('Überprüfung läuft, dies wird einige Zeit dauern, bitte warten...', {
                icon: 16,
                shade: 0.4,
                time: false //Automatische Abschaltung abbrechen
            });
            $.ajax({
                type: "POST",
                url: "key.php",
                data: {
                    message: $("#tt").val(),
                    action: "check",
                },
                success: function(results) {
                    $("#tt").val(results);
                    layer.close(loading);
                    layer.msg('Die Validierung ist abgeschlossen und der ungültige API_KEY wurde entfernt. Bitte denken Sie daran, auf Einstellungen speichern zu tippen.');
                }
            });
        }
    </script>

    </html>

<?php
    exit;
}
// Definieren Sie Konstanten für Benutzernamen und Passwort 
define('USERNAME', 'xxxx');
define('PASSWORD', 'xxxx');
// Feststellen, ob das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Abrufen des vom Formular übermittelten Benutzernamens und Passworts.
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Feststellen, ob der Benutzername und das Passwort korrekt sind
    if ($username == USERNAME && $password == PASSWORD) {
        // Erfolgreiche Anmeldung, weiter zur Homepage
        $_SESSION['admin'] = true;
        header("Location: key.php");
        exit;
    } else {
        // Anmeldung fehlgeschlagen, Fehlermeldung angezeigt
        $error = 'Falscher Benutzername oder Passwort';
        $_SESSION['admin'] = false;
    }
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldeseite</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        p.error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php if (isset($error)) : ?>
        <script>
            alert('<?php echo $error; ?>');
        </script>
    <?php endif; ?>
    <form method="post">
        <h1>API_KEY Management Hintergrund</h1>
        <p> <label>Benutzer：</label> <input type="text" name="username"> </p>
        <p> <label>Password：</label> <input type="password" name="password"> </p>
        <p style="text-align:center"> <button type="submit">Anmelden</button> </p>
    </form>
</body>

</html>
