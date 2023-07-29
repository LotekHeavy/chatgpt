<?php
$type = "Persönlicher API-Key";
//  if (substr($_SERVER["REMOTE_ADDR"],0,9)!="127.0.0.1"){
//    if (strpos($_SERVER["HTTP_USER_AGENT"],"MicroMessenger")){
//      echo "<div style='height:100%;width:100%;text-align:center;margin-top:30%;'><h1>Bitte klicken Sie auf die obere rechte Ecke und wählen Sie Im Browser öffnen.</h1></div>";
//      exit;
//    }
//    if (!isset($_SERVER['PHP_AUTH_USER'])) {
//      header('WWW-Authenticate: Basic realm="Please input username and password."');
//      header('HTTP/1.0 401 Unauthorized');
//      echo 'Bye, honey.';
//      exit;
//    } else {
//      if (($_SERVER['PHP_AUTH_USER']=="xxxx")&&($_SERVER['PHP_AUTH_PW']=="xxxx")){
//        $type = "Authentifiziert";
//      } else {
//        echo 'Wrong password, bye...';
//        exit;
//      }
//    }
//  } else {
//    $type = "Intranet";
 // }
?>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ChatGPT [<?= $type ?>] chat.heavy.ch</title>
    <link rel="stylesheet" href="css/common.css?v1.1">
    <link rel="stylesheet" href="css/wenda.css?v1.1">
    <link rel="stylesheet" href="css/hightlight.css">
</head>

<body>
    <div class="layout-wrap">
        <header class="layout-header">
            <div class="container" data-flex="main:justify cross:start">
                <div class="header-logo">
                    <h2 class="logo"><a class="links" id="clean" title="chat.HEAVY.ch"><span class="logo-title">chat.HEAVY.ch</span></a></h2>
                </div>
                <div class="header-logo">
                    <h2 class="logo"><a class="links" href="https://platform.openai.com/account/usage"><span class="logo-title">Statistik</span></a></h2>
                </div>
            </div>
        </header>
        <div class="layout-content">
            <div class="container">
                <article class="article" id="article">
                    <div class="article-box">
                        <div class="precast-block" data-flex="main:left">
                            <!--
                            <div class="input-group">
                                <span style="text-align: center;color:#9ca2a8">&nbsp;&nbsp;API-KEY&nbsp;&nbsp;</span>
                                <input type="password" id="key" style="border:1px solid grey;display:block;max-width:270px;width:calc(100% - 70px);" onload="this.focus();">
                            </div>
-->
                            <div class="input-group">
                                <span style="text-align: center;color:#9ca2a8">&nbsp;&nbsp;Fortlaufender Dialog：</span>
                                <input type="checkbox" id="keep" checked="" style="min-width:220px;">
                                <label for="keep"></label>
                            </div>
                            <div class="input-group">
                                <span style="text-align: center;color:#9ca2a8">&nbsp;&nbsp;Vorlage：</span>
<select id="preset-text" onchange="insertPresetText()" style="width:calc(100% - 90px);max-width:280px;">

<option value="">bitte auswählen</option>

<option value="Ich möchte, dass Sie die Rolle des Englisch-Übersetzers, des Rechtschreibkorrekturlesers und des rhetorischen Verbesserers übernehmen. Ich werde mit Ihnen in einer beliebigen Sprache kommunizieren, und Sie werden die Sprache erkennen, sie übersetzen und mir in eleganterem und raffinierterem Englisch antworten. Bitte ersetzen Sie meine einfachen Wörter und Sätze durch schönere und elegantere Ausdrücke, wobei Sie sicherstellen, dass der Sinn erhalten bleibt, aber die Formulierung literarischer wird. Bitte antworten Sie nur auf die Korrekturen und Verbesserungen und schreiben Sie keine Erklärungen. Antworten Sie nur mit OK und warten Sie auf die erste Eingabe.">Englisch-Übersetzer</option>

<option value="Ich möchte, dass Sie die Rolle des Deutsch-Übersetzers, des Rechtschreibkorrekturlesers und des rhetorischen Verbesserers übernehmen. Ich werde mit Ihnen in einer beliebigen Sprache kommunizieren, und Sie werden die Sprache erkennen, sie übersetzen und mir in eleganterem und raffinierterem Deutsch antworten. Bitte ersetzen Sie meine einfachen Wörter und Sätze durch schönere und elegantere Ausdrücke, wobei Sie sicherstellen, dass der Sinn erhalten bleibt, aber die Formulierung literarischer wird. Bitte antworten Sie nur auf die Korrekturen und Verbesserungen und schreiben Sie keine Erklärungen. Antworten Sie nur mit OK und warten Sie auf die erste Eingabe.">Deutsch-Übersetzer</option>

<option value="Ich möchte, dass Sie als Experte für Front-End-Entwicklung agieren. Ich werde einige spezifische Informationen über Front-End-Code-Probleme in Js, Node, etc. zur Verfügung stellen, und es wird Ihre Aufgabe sein, Strategien zu finden, um das Problem für mich zu lösen. Dies kann auch Vorschläge für Code, Code-Logik Ideen Strategien. Meine erste Anforderung lautet: 'Ich muss in der Lage sein, dynamisch auf die X- und Y-Achse des Abstands eines Elementknotens von der oberen linken Ecke des Bildschirms des aktuellen Computergeräts durch Ziehen und Ablegen zu hören, um die Position des Browserfensters zu verschieben und die Größe des Browserfensters zu ändern.'">Front-End-Entwickler</option>

<option value="Ich möchte, dass Sie als Interviewer und Personalmitarbeiter für eine offene Job-Stelle fungieren. Ich werde der Bewerber sein und Sie werden mir Fragen zum Vorstellungsgespräch für die Stelle stellen. Ich möchte, dass Sie nur als Interviewer antworten. Schreiben Sie nicht alle Fragen auf einmal. Ich möchte, dass Sie nur mich interviewen. Stellen Sie mir schwierige Fragen und warten Sie auf meine Antworten. Schreiben Sie keine Erklärungen. Stellen Sie mir eine Frage nach der anderen wie ein Interviewer und warten Sie auf meine Antwort. Meine ersten Worte sind 'Hallo Interviewer'">Job-Interview</option>

<option value="Ich möchte, dass Sie als Javascript-Konsole fungieren. Ich gebe den Befehl ein und Sie antworten mit dem, was die Javascript-Konsole anzeigen soll. Ich möchte, dass Sie auf die Terminalausgabe in einem einzigen Codeblock antworten und sonst nichts. Schreiben Sie keine Erklärungen. Es sei denn, ich weise Sie an, dies zu tun.">JavaScript-Konsole</option>

<option value="Ich möchte, dass Sie als textbasiertes Excel arbeiten. Sie werden mir nur mit einem 10-zeiligen textbasierten Excel-Arbeitsblatt antworten, in dem die Zeilennummern und Zellbuchstaben als Spalten (A bis L) angegeben sind. Die erste Spaltenüberschrift sollte leer sein, um auf die Zeilennummer zu verweisen. Ich sage Ihnen, was Sie in die Zellen schreiben sollen, und Sie antworten nur mit den Ergebnissen der Excel-Tabelle als Text und sonst nichts. Schreiben Sie keine Erklärungen. Ich schreibe Ihre Formeln, Sie führen die Formeln aus, und Sie antworten nur mit dem Ergebnis der Exceltabelle als Text. Antworten Sie zunächst auf meine leere Tabelle." >Excel-Arbeitsblatt</option>

<option value="Ich möchte, dass Sie einen Reiseführer erstellen. Ich schreibe Ihnen meinen Standort und Sie empfehlen mir einen Ort in der Nähe meines Standorts. In manchen Fällen werde ich Ihnen auch die Art des Ortes nennen, den ich besuchen werde. Sie werden auch ähnliche Orte in der Nähe meines ersten Ortes vorschlagen.">Reiseführer</option>

<option value="Ich möchte, dass Sie als Plagiatsprüfer fungieren. Ich schreibe Ihnen Sätze, und Sie antworten nur in der Sprache des vorgegebenen Satzes, wenn dieser bei der Plagiatsprüfung unentdeckt bleibt, sonst nichts. Schreiben Sie keine Erklärungen zu Ihren Antworten." >Plagiatsprüfung</option>

<option value="Ich möchte, dass Sie sich wie {Charakter} aus einem {Film/Serie} verhalten. Ich möchte, dass Sie wie {Charakter} reagieren und antworten. Schreiben Sie keine Erklärungen. Antworte nur wie {Charakter}. Du musst alles über {Charakter} wissen.">Figur in einem Film/Serie</option>.

<option value="| Ich möchte, dass Sie als Berater für Künstler fungieren, indem Sie Ratschläge zu verschiedenen künstlerischen Stilen erteilen, wie z.B. Techniken für den effektiven Einsatz von Licht- und Schatteneffekten in der Malerei, Schattierungstechniken in der Bildhauerei usw., sowie musikalische Kompositionen vorschlagen, die das Kunstwerk je nach Genre/Stil gut begleiten würden, zusammen mit geeigneten Referenzbildern, um Ihre Vorschläge dafür zu zeigen; all dies in dem Bemühen, aufstrebenden Künstlern zu helfen, neue kreative Möglichkeiten und praktische Ideen zu erforschen, die ihnen helfen werden, ihre Fähigkeiten entsprechend zu verbessern!">Künstlerratgeber</option>



                                </select>
                            </div>
                        </div>
                        <ul id="article-wrapper">
                        </ul>
                        <div class="creating-loading" data-flex="main:center dir:top cross:center">
                            <div class="semi-circle-spin"></div>
                        </div>
                        <div id="fixed-block">
                            <div class="precast-block" id="kw-target-box" data-flex="main:left cross:center">
                                <div id="target-box" class="box">
                                    <textarea name="kw-target" placeholder="Um hier eine Frage zu stellen, drücken Sie CTRL+ENTER, um sie zu senden an" id="kw-target" autofocus rows=1></textarea>
                                </div>
                                <div class="right-btn layout-bar">
                                    <p class="btn ai-btn bright-btn" id="ai-btn" data-flex="main:center cross:center"><i class="iconfont icon-wuguan"></i>Senden</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <script src="js/remarkable.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/jquery.cookie.min.js"></script>
    <script src="js/layer.min.js"></script>
    <script src="js/chat.js?v2.8"></script>
    <script src="js/highlight.min.js"></script>
    <script src="//cdn.bootcss.com/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        showProcessingMessages: false,
        messageStyle: "none",
        extensions: ["tex2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        tex2jax: {
            inlineMath:  [ ["$", "$"] ],
        displayMath: [ ["$$","$$"] ],
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre','code','a'],
        ignoreClass:"comment-content"
            },
        "HTML-CSS": {
            availableFonts: ["STIX","TeX"],
        showMathMenu: false
            }
        });
    </script>
    <script>
        if ($('#key').length) {
            $(document).ready(function() {
                var key = $.cookie('key');
                if (key) {
                    $('#key').val(key);
                }
                $('#key').on('input', function() {
                    var inputVal = $(this).val();
                    $.cookie('key', inputVal, {
                        expires: 365
                    });
                });
            });
        }
    </script>
</body>

</html>
