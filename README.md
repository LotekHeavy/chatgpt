# chatgpt

**Ganz oben geschrieben:**

ChatGPT kam aus dem Nichts und hat die Welt wirklich verändert. Diejenigen, die es benutzt haben, wissen, dass ChatGPT als Produktivitätswerkzeug in vielen Bereichen eingesetzt werden kann. Man kann sagen, dass ChatGPT in den letzten Jahren ein weiterer großer Glücksfall ist, und eine große Anzahl von Investitionsinstitutionen und Regierungsabteilungen ermutigen und unterstützen jetzt die Entwicklung von verwandten Industrien. Wenn Sie auch die Idee haben, ChatGPT zu nutzen, um Geld zu verdienen oder ein Unternehmen zu gründen, sind Sie herzlich eingeladen, der Gruppe kostenlos beizutreten, um zu diskutieren, QR-Code am Ende dieses Artikels. Es gibt viele gleichgesinnte Freunde in der Gruppe, um Informationen, Wissen und Ressourcen gemeinsam zu teilen. Darüber hinaus zeigen Sie bitte auf den kleinen Stern in der oberen rechten Ecke, damit Sie dieses Projekt jederzeit finden können.

**Erstmalige Benutzerkonfiguration:**

Bitte besuchen Sie http://你的域名/key.php, um Ihre API_KEY-Liste zu konfigurieren, das Programm wird in einer automatischen Schleife global aufgerufen. Standard-Benutzername: admin, Standard-Passwort: admin@2023. Der Standard-Benutzername und das Passwort können in der Datei key.php geändert werden.

** Dieses Projekt ist vollständig Open Source, ist die PHP-Version des Aufrufs OpenAI API-Schnittstelle für Q&A Demo, hat die folgenden Eigenschaften und Funktionen:**

1. keine Anforderungen an die PHP-Version, keine Datenbank. Der Kern-Code ist nur ein paar Dateien, kein Rahmen, ist es sehr einfach zu ändern und zu debuggen.
2. mit Stream-Flow-Modus der Kommunikation, während der Erzeugung einer Seite der Ausgabe, die schnellste Reaktionszeit im Netzwerk. 3.
3. unterstützt GPT-3.5-Turbo und GPT-4 und andere Modelle (letztere müssen den Standard-Modellnamen zu ändern). 4.
4. unterstützt die Textanzeige im Markdown-Format, wie z.B. Tabellen, Code-Blöcke. Einfärbung des Codes, eine Schaltfläche zum Kopieren des Codes, Unterstützung für die Anzeige von Formeln.
5. Unterstützung für mehrzeilige Eingabe, Textfeld Höhe automatisch angepasst, Handys und PC-Display wurden angepasst.
6. Unterstützung einiger voreingestellter Wörter, Unterstützung kontextbezogener kontinuierlicher Dialoge, KI kann jederzeit auf dem Weg zur Antwort unterbrechen. 7. Unterstützung der Fehlerbehandlung, OpenOffice ist keine gute Wahl.
7. unterstützt Fehlerbehandlung, OpenAI-Schnittstelle kann den spezifischen Grund sehen, wenn es einen Fehler zurückgibt.
8. sie kann zwischen interner und externer IP unterscheiden, und auf das interne Netzwerk kann direkt zugegriffen werden, und auf das externe Netzwerk kann durch BASIC-Authentifizierung zugegriffen werden. 9.
(9) Sie können einen benutzerdefinierten API_KEY auf der Seite eingeben, um die Weitergabe an Ihre Freunde zu erleichtern.
10. der Server zeichnet automatisch die Dialogprotokolle und IP-Adressen aller Besucher auf, was für Administratoren bequem abzufragen ist.
11. Unterstützung von API_KEY Auto-Polling, um das Problem der Begrenzung der Abfragen auf 3 Mal pro Minute für $5-Konten zu lösen.
12. Unterstützung für den Aufruf von OpenAI offiziellen Schnittstelle, um Bilder zu zeichnen, ist das erste Wort der Frage "zeichnen", um Bilder zu erzeugen.

**Dieses Projekt ist für persönliche oder Freunde positioniert, um die Verwendung von leichten Design zu teilen, nicht planen, komplexe Funktionen wie Datenbank einzuführen. Benutzer, die es brauchen, können es nehmen und ändern Sie es selbst, kein Copyright, keine Untersuchung von Änderungen. Für das Projekt UI oder andere Funktionen haben, um die Idee von Freunden zu verbessern sind willkommen, PR einreichen, oder in Fragen oder Diskussionen für die Diskussion. **

------
# Test-URL: http://mm1.ltd
! [t1](https://user-images.githubusercontent.com/5563148/232330560-1b6a45f3-fcc1-4d3e-a2f7-b1c9878fe9cd.jpg)
! [t2](https://user-images.githubusercontent.com/5563148/232330566-c6ea7fb3-474f-45e4-adda-37f3db27b92a.jpg)
! [t3](https://github.com/dirk1983/chatgpt/assets/5563148/732b5bed-7e9c-4c07-9865-9b97957781a7)


------
**Häufig gestellte Fragen zu diesem Projekt:**

1. die Verwendung in der heimischen Umgebung führt zu einem Timeout der OpenAI-Verbindung

Ja, OpenAI unterstützt offiziell keine IP-Zugangsschnittstelle für China (einschließlich Hongkong, Macao und Taiwan). Es gibt mehrere Lösungen:

a. Verwenden Sie einen Offshore-Server, um dieses Projekt bereitzustellen, wie die Vereinigten Staaten, Südkorea, Japan, usw., zum Beispiel Tencent Cloud Japan kann.

b. Wenn das Projekt auf dem Computer bereitgestellt wird, können Sie den HTTP-PROXY-Proxy auf dem Computer verwenden, um stream.php innerhalb der auskommentierten "curl_setopt($ch, CURLOPT_PROXY, " http://127.0.0.1:1081 "); " geändert werden.

c. Verwenden Sie einen Reverse-Proxy-Dienst, um die Adresse der OpenAI-Schnittstelle in eine URL umzuwandeln, ändern Sie die URL in der Zeile "curl_setopt($ch, CURLOPT_URL, ' https://api.openai.com/v1/chat/completions ');" in "curl_setopt($ch, CURLOPT_URL, ' https://api.openai.com/v1/chat/completions ');". Die Angabe "$ch, CURLOPT_URL, '  ');" in dieser Zeile kann nach der Substitution in die URL geändert werden.

Bei Verwendung der beiden letztgenannten Lösungen kann die Echtzeitleistung des Stream-Modus aufgrund des Caching-Mechanismus des Proxys beeinträchtigt werden und die Zugriffslatenz kann sich ebenfalls erhöhen.

2. über die Konfiguration des Reverse-Proxys

Wenn Sie einen ausländischen Server haben, ist die Verwendung von nginx Reverse-Proxy die einfachste, ändern Sie die Konfigurationsdatei, fügen Sie eine Zeile oder zwei von Code erreicht werden kann, die spezifische Art und Weise für sich selbst zu suchen. Wenn Sie nicht über einen Server in Übersee, können Sie cf worker verwenden, um eine kostenlos zu bauen, vorausgesetzt, dass Sie einen Domain-Namen haben, ein paar Dollar, um eine zu registrieren. Eine Anleitung zum Erstellen eines eigenen cf worker finden Sie hier: https://github.com/noobnooc/noobnooc/discussions/9. Wenn Sie nicht einmal einen Domainnamen registrieren wollen, können Sie auch die fertige Reverse-Proxy-Adresse eines anderen Anbieters verwenden, z. B. die folgende: https://openai.1rmb.tk/v1/chat/completions . Die Adresse wird von einer Gruppe von Freunden zur Verfügung gestellt, nicht sicher, wann es abläuft, kann die Verwendung von mehr Menschen ein wenig stecken, können Sie auch in der Gruppe zu fragen, für eine. 3.

3. auf dem Prinzip der Stream-Flow-Modus, warum Sie nicht so schnell wie meine eingesetzt

Das Front-End dieses Projekts verwendet den EventSource-Modus von Javascript, um mit dem Back-End zu kommunizieren, wodurch eine sofortige Übertragung von Daten im Stream-Modus erreicht werden kann, und die OpenAI-Schnittstelle unterstützt auch die Erzeugung von Daten in Echtzeit und die Übertragung in Echtzeit, um die Q&A in Sekunden zu erreichen. Der Nachteil des EventSource-Modus ist, dass er die POST-Methode der Datenübertragung nicht unterstützt, die GET-Methode hat eine Beschränkung der Länge der Daten, und das Cookie hat auch eine Beschränkung. Als für, warum Sie meinen Code verwenden, um die Website langsamer, der Hauptgrund zusätzlich zu Server-Probleme, kann es Probleme mit der PHP-Umgebung sein. PHP, wenn Sie Streaming-Ausgabe erreichen wollen, müssen Sie die Ausgabe-Cache zu schließen, müssen Sie möglicherweise die Apache oder Nginx und php.ini-Konfiguration zu ändern, können die spezifischen Modifikationen gesucht werden, oder fragen Sie die Gruppe Gruppe von Freunden.

4. wenn Sie die Funktion der Eingabe von API_KEY wie Demo Station erreichen wollen, wie der Code zu ändern?

In der index.php-Datei, um die entsprechenden Kommentare auf der Linie zu kündigen, aus Gründen der Ästhetik, ist es empfehlenswert, dass die oben genannten "kontinuierlichen Dialog" Teil der Kommentare, oder mobilen Zugang ist nicht sehr freundlich. Kommentar "kontinuierlichen Dialog" hat keinen Einfluss auf den Betrieb der Website, ist der Standard, um den Kontext der kontinuierlichen Dialog enthalten.

5) Unterstützt es Docker?

Einige Benutzer wollen Docker verwenden, um dieses Projekt auszuführen, in der Tat, finden Sie einfach eine nginx+php Umgebung Docker, zeigen Sie den Pfad zu dem Verzeichnis, in dem das Projekt befindet. Hier ist ein Docker-Image, das von einem Benutzer zur Verfügung gestellt wurde: gindex/nginx-php. Der Weg, es zu benutzen, ist wie folgt:

``
docker pull gindex/nginx-php
docker run -itd -v /root/chatgpt(lokales Verzeichnis):/usr/share/nginx/html --name nginx-php -p 8080(Host-Port):80 --restart=always gindex/nginx-php
```

Es gibt auch eine auf diesem Projekt basierende Docker-Version von chatgpt eines anderen begeisterten Benutzers auf github unter https://github.com/hsmbs/chatgpt-php , die ebenfalls verwendet werden kann.

6. unterstützt es den Windows-Client?

Wenn Sie eine eigenständige Windows-Desktop-Anwendung verwenden möchten, können Sie die Exe-Datei in der Veröffentlichung herunterladen und ausführen, die eigentlich eine Browser-Shell ist, die auf meine Demo-Website zeigt.

7. gibt es eine kommerzielle Version, bei der ich Mitglieder registrieren kann?

Da viele meiner Freunde ähnliche Bedürfnisse haben, habe ich eine kommerzielle Version der Software entwickelt, die auf einer PHP+Mysql-Umgebung basiert und offiziell veröffentlicht wurde. Wenn Sie daran interessiert sind, können Sie hier weitere Informationen finden: https://github.com/dirk1983/chatgpt_commercial

------

Anbei die Modell- und Schnittstelleneinführung von der offiziellen OpenAI-Website:

https://platform.openai.com/docs/models/moderation

https://platform.openai.com/docs/api-reference/chat/create

https://platform.openai.com/docs/guides/chat/introduction

https://platform.openai.com/docs/api-reference/models/list

------
**Studenten, die sich für Chatgpt interessieren, sind herzlich eingeladen, der Gruppe beizutreten und zu diskutieren. In der Gruppe gibt es viele Götter, so dass man sich gegenseitig bei Fragen helfen kann. **

Da die Zahl der Menschen in der Gruppe hat mehr als 200, kann nicht direkt scannen Sie den Code in die Gruppe, wollen die Gruppe von Freunden können Wärme Herz Netizen Trompete, durch seine Hilfe zu ziehen in die Gruppe.

! [WeChat screenshot_20230306154434](https://user-images.githubusercontent.com/5563148/223048985-4cac05cb-acf0-4f04-aad5-1c3dcec609d0.png)




Einige warmherzige Netizens vorgeschlagen, dass ich eine Belohnung Code, Sie alle, wenn Sie wirklich wollen, um Dankbarkeit auszudrücken, kann ein kleiner Betrag sein.

! [Reward Code](https://user-images.githubusercontent.com/5563148/222968018-9def451a-bbce-4a7e-bde6-edecc7ced40f.jpg)

Schließlich habe ich auch eine Funktion entwickelt, um den Chatbot ChatGPT in die persönliche WeChat-Abonnementnummer zu implementieren, indem ich die neueste Schnittstelle von OpenAI und das gpt-3.5-Turbomodell aufrufe, das als Open Source zur Verfügung gestellt wurde.
https://github.com/dirk1983/chatgpt-wechat-personal

[! [Star History Chart](https://api.star-history.com/svg?repos=dirk1983/chatgpt&type=Date)](https://star-history.com/#dirk1983/chatgpt& Datum)
