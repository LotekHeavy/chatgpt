var contextarray = [];

var defaults = {
    html: false,        // Enable HTML tags in source
    xhtmlOut: false,        // Use '/' to close single tags (<br />)
    breaks: false,        // Convert '\n' in paragraphs into <br>
    langPrefix: 'language-',  // CSS language prefix for fenced blocks
    linkify: true,         // autoconvert URL-like texts to links
    linkTarget: '',           // set target to open link in
    typographer: true,         // Enable smartypants and other sweet transforms
    _highlight: true,
    _strict: false,
    _view: 'html'
};
defaults.highlight = function (str, lang) {
    if (!defaults._highlight || !window.hljs) { return ''; }

    var hljs = window.hljs;
    if (lang && hljs.getLanguage(lang)) {
        try {
            return hljs.highlight(lang, str).value;
        } catch (__) { }
    }

    try {
        return hljs.highlightAuto(str).value;
    } catch (__) { }

    return '';
};
mdHtml = new window.Remarkable('full', defaults);

mdHtml.renderer.rules.table_open = function () {
    return '<table class="table table-striped">\n';
};

mdHtml.renderer.rules.paragraph_open = function (tokens, idx) {
    var line;
    if (tokens[idx].lines && tokens[idx].level === 0) {
        line = tokens[idx].lines[0];
        return '<p class="line" data-line="' + line + '">';
    }
    return '<p>';
};

mdHtml.renderer.rules.heading_open = function (tokens, idx) {
    var line;
    if (tokens[idx].lines && tokens[idx].level === 0) {
        line = tokens[idx].lines[0];
        return '<h' + tokens[idx].hLevel + ' class="line" data-line="' + line + '">';
    }
    return '<h' + tokens[idx].hLevel + '>';
};
function getCookie(name) {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(name + '=') === 0) {
            return cookie.substring(name.length + 1, cookie.length);
        }
    }
    return null;
}

function isMobile() {
    const userAgent = navigator.userAgent.toLowerCase();
    const mobileKeywords = ['iphone', 'ipod', 'ipad', 'android', 'windows phone', 'blackberry', 'nokia', 'opera mini', 'mobile'];
    for (let i = 0; i < mobileKeywords.length; i++) {
        if (userAgent.indexOf(mobileKeywords[i]) !== -1) {
            return true;
        }
    }
    return false;
}

function insertPresetText() {
    $("#kw-target").val($('#preset-text').val());
    autoresize();
}

function initcode() {
    console['\x6c\x6f\x67']("\u672c\u7ad9\u4ee3\u7801\u4fee\u6539\u81ea\x68\x74\x74\x70\x3a\x2f\x2f\x67\x69\x74\x68\x75\x62\x2e\x63\x6f\x6d\x2f\x64\x69\x72\x6b\x31\x39\x38\x33\x2f\x63\x68\x61\x74\x67\x70\x74");
}

function copyToClipboard(text) {
    var input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);
    return result;
}

function copycode(obj) {
    copyToClipboard($(obj).closest('code').clone().children('button').remove().end().text());
    layer.msg("Kopie erfolgt");
}

function autoresize() {
    var textarea = $('#kw-target');
    var width = textarea.width();
    var content = (textarea.val() + "a").replace(/\\n/g, '<br>');
    var div = $('<div>').css({
        'position': 'absolute',
        'top': '-99999px',
        'border': '1px solid red',
        'width': width,
        'font-size': '15px',
        'line-height': '20px',
        'white-space': 'pre-wrap'
    }).html(content).appendTo('body');
    var height = div.height();
    var rows = Math.ceil(height / 20);
    div.remove();
    textarea.attr('rows', rows);
    $("#article-wrapper").height(parseInt($(window).height()) - parseInt($("#fixed-block").height()) - parseInt($(".layout-header").height()) - 80);
}

$(document).ready(function () {
    initcode();
    autoresize();
    $("#kw-target").on('keydown', function (event) {
        if (event.keyCode == 13 && event.ctrlKey) {
            send_post();
            return false;
        }
    });

    $(window).resize(function () {
        autoresize();
    });

    $('#kw-target').on('input', function () {
        autoresize();
    });

    $("#ai-btn").click(function () {
        if ($("#kw-target").is(':disabled')) {
            clearInterval(timer);
            $("#kw-target").val("");
            $("#kw-target").attr("disabled", false);
            autoresize();
            $("#ai-btn").html('<i class="iconfont icon-wuguan"></i>Senden');
            if (!isMobile()) $("#kw-target").focus();
        } else {
            send_post();
        }
        return false;
    });

    $("#clean").click(function () {
        $("#article-wrapper").html("");
        contextarray = [];
        layer.msg("Zwischenspeicher wird gelöscht");
        return false;
    });

    $("#showlog").click(function () {
        let btnArry = ['lesen'];
        layer.open({ type: 1, title: 'Vollständiges Dialogprotokoll', area: ['80%', '80%'], shade: 0.5, scrollbar: true, offset: [($(window).height() * 0.1), ($(window).width() * 0.1)], content: '<iframe src="chat.txt?' + new Date().getTime() + '" style="width: 100%; height: 100%;"></iframe>', btn: btnArry });
        return false;
    });

    function send_post() {
        if (($('#key').length) && ($('#key').val().length != 51)) {
            layer.msg("Bitte geben Sie den richtigen API-KEY ein", { icon: 5 });
            return;
        }

        var prompt = $("#kw-target").val();

        if (prompt == "") {
            layer.msg("Bitte geben Sie Ihre Frage ein", { icon: 5 });
            return;
        }

        var loading = layer.msg('Bitte warten Sie einen Moment...', {
            icon: 16,
            shade: 0.4,
            time: false //Automatische Abschaltung aufheben
        });

        function draw() {
            $.get("getpicture.php", function (data) {
                layer.close(loading);
                layer.msg("Erfolgreiche Bearbeitung");
                answer = randomString(16);
                $("#article-wrapper").append('<li class="article-title" id="q' + answer + '"><pre></pre></li>');
                for (var j = 0; j < prompt.length; j++) {
                    $("#q" + answer).children('pre').text($("#q" + answer).children('pre').text() + prompt[j]);
                }
                $("#article-wrapper").append('<li class="article-content" id="' + answer + '"><img onload="document.getElementById(\'article-wrapper\').scrollTop=100000;" src="pictureproxy.php?url=' + encodeURIComponent(data.data[0].url) + '"></li>');
                $("#kw-target").val("");
                $("#kw-target").attr("disabled", false);
                autoresize();
                $("#ai-btn").html('<i class="iconfont icon-wuguan"></i>Senden');
                if (!isMobile()) $("#kw-target").focus();
            }, "json");
        }
        function streaming() {
            var es = new EventSource("stream.php");
            var isstarted = true;
            var alltext = "";
            var isalltext = false;
            es.onerror = function (event) {
                layer.close(loading);
                var errcode = getCookie("errcode");
                switch (errcode) {
                    case "invalid_api_key":
                        layer.msg("API-KEY ist nicht zulässig");
                        break;
                    case "context_length_exceeded":
                        layer.msg("Frage und Kontextlänge überschritten, bitte eine neue Frage stellen");
                        break;
                    case "rate_limit_reached":
                        layer.msg("Zu viele Anfragen zur gleichen Zeit, bitte versuchen Sie es später noch einmal");
                        break;
                    case "access_terminated":
                        layer.msg("API-KEY wegen nicht konformer Verwendung gesperrt");
                        break;
                    case "no_api_key":
                        layer.msg("API-KEY nicht angegeben");
                        break;
                    case "insufficient_quota":
                        layer.msg("Unzureichendes API-KEY-Guthaben");
                        break;
                    case "account_deactivated":
                        layer.msg("Konto gesperrt");
                        break;
                    case "model_overloaded":
                        layer.msg("OpenAI-Modell ist überlastet, bitte starten Sie die Anfrage erneut");
                        break;
                    case null:
                        layer.msg("OpenAI-Server-Zugriffszeitüberschreitung oder unbekannter Typ-Fehler");
                        break;
                    default:
                        layer.msg("OpenAI-Serverfehler, Fehlertyp：" + errcode);
                }
                es.close();
                if (!isMobile()) $("#kw-target").focus();
                return;
            }
            es.onmessage = function (event) {
                if (isstarted) {
                    layer.close(loading);
                    $("#kw-target").val("Bitte warten Sie, bis ChatGPT ihren Satz beendet hat...");
                    $("#kw-target").attr("disabled", true);
                    autoresize();
                    $("#ai-btn").html('<i class="iconfont icon-wuguan"></i>Abbrechen');
                    layer.msg("Erfolgreiche Bearbeitung");
                    isstarted = false;
                    answer = randomString(16);
                    $("#article-wrapper").append('<li class="article-title" id="q' + answer + '"><pre></pre></li>');
                    for (var j = 0; j < prompt.length; j++) {
                        $("#q" + answer).children('pre').text($("#q" + answer).children('pre').text() + prompt[j]);
                    }
                    $("#article-wrapper").append('<li class="article-content" id="' + answer + '"></li>');
                    let str_ = '';
                    let i = 0;
                    let strforcode = '';
                    timer = setInterval(() => {
                        let newalltext = alltext;
                        let islastletter = false;
                        //Gelegentlich gibt der Server fälschlicherweise \\n als Zeilenumbruch zurück, insbesondere wenn die Frage eine kontextbezogene Frage enthält, und diese Codezeile kann damit umgehen.
                        if (newalltext.split("\n").length == 1) {
                            newalltext = newalltext.replace(/\\n/g, '\n');
                        }
                        if (str_.length < (newalltext.length - 3)) {
                            str_ += newalltext[i++];
                            strforcode = str_;
                            if ((str_.split("```").length % 2) == 0) {
                                strforcode += "\n```\n";
                            } else {
                                strforcode += "_";
                            }
                        } else {
                            if (isalltext) {
                                clearInterval(timer);
                                strforcode = newalltext;
                                islastletter = true;
                                $("#kw-target").val("");
                                $("#kw-target").attr("disabled", false);
                                autoresize();
                                $("#ai-btn").html('<i class="iconfont icon-wuguan"></i>Senden');
                                if (!isMobile()) $("#kw-target").focus();
                            }
                        }
                        //let arr = strforcode.split("```");
                        //for (var j = 0; j <= arr.length; j++) {
                        //    if (j % 2 == 0) {
                        //        arr[j] = arr[j].replace(/\n\n/g, '\n');
                        //        arr[j] = arr[j].replace(/\n/g, '\n\n');
                        //        arr[j] = arr[j].replace(/\t/g, '\\t');
                        //        arr[j] = arr[j].replace(/\n {4}/g, '\n\\t');
                        //        arr[j] = $("<div>").text(arr[j]).html();
                        //    }
                        //}

                        //var converter = new showdown.Converter();
                        //newalltext = converter.makeHtml(arr.join("```"));
                        newalltext = mdHtml.render(strforcode);
                        //newalltext = newalltext.replace(/\\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
                        $("#" + answer).html(newalltext);
                        if (islastletter) MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        //if (document.querySelector("[id='" + answer + "']" + " pre code")) document.querySelectorAll("[id='" + answer + "']" + " pre code").forEach(el => { hljs.highlightElement(el); });
                        $("#" + answer + " pre code").each(function () {
                            $(this).html("<button onclick='copycode(this);' class='codebutton'>eine Kopie machen von</button>" + $(this).html());
                        });
                        document.getElementById("article-wrapper").scrollTop = 100000;
                    }, 30);
                }
                if (event.data == "[DONE]") {
                    isalltext = true;
                    contextarray.push([prompt, alltext]);
                    contextarray = contextarray.slice(-5); // Behalten Sie nur die letzten 5 Gespräche als Kontext, um die maximale Tokengrenze nicht zu überschreiten
                    es.close();
                    return;
                }
                var json = eval("(" + event.data + ")");
                if (json.choices[0].delta.hasOwnProperty("content")) {
                    if (alltext == "") {
                        alltext = json.choices[0].delta.content.replace(/^\n+/, ''); // Entfernen Sie den gelegentlich auftretenden Zeilenumbruch am Anfang einer Antwortnachricht
                    } else {
                        alltext += json.choices[0].delta.content;
                    }
                }
            }
        }


        if (prompt.charAt(0) === '|') { // UNBEKANNT: Sichter für Gemälde usw.
            $.ajax({
                cache: true,
                type: "POST",
                url: "setsession.php",
                data: {
                    message: prompt,
                    context: '[]',
                    key: ($("#key").length) ? ($("#key").val()) : '',
                },
                dataType: "json",
                success: function (results) {
                    draw();
                }
            });
        } else {
            $.ajax({
                cache: true,
                type: "POST",
                url: "setsession.php",
                data: {
                    message: prompt,
                    context: (!($("#keep").length) || ($("#keep").prop("checked"))) ? JSON.stringify(contextarray) : '[]',
                    key: ($("#key").length) ? ($("#key").val()) : '',
                },
                dataType: "json",
                success: function (results) {
                    streaming();
                }
            });
        }


    }

    function randomString(len) {
        len = len || 32;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';    /**** entfernt standardmäßig verwirrende Zeichen oOLl,9gq,Vv,Uu,I1****/
        var maxPos = $chars.length;
        var pwd = '';
        for (i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }

});
