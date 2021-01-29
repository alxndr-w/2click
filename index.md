# 2Click-Privacy

Eine einfache Möglichkeit, externe Inhalte durch eine 2-Klick-Lösung nachzuladen, z.B. iframes (Youtube, Google Maps, ...) oder andere Elemente (Tweets, Instagram Posts, ...)

Mit Dank an [2Click-Iframe-Privacy](https://01-scripts.github.io/2Click-Iframe-Privacy/)

## Standalone-Fassung

**Skript einfügen**

```html
<script src="2ClickPrivacy.min.js"></script>
```

**CSS-Code für das Overlay festlegen**

```html
    <style type="text/css">
        div.privacy-msg {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            margin: 0;
        }

        div.privacy-msg p {
            position: absolute;
            background-image: none; /* optional: eigenes Vorschaubild verwenden */
            background-color: rgba(0, 0, 0, 0.8);
            padding: 12px;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            margin: 0;
            z-index: 1;
        }

        div.privacy-msg p,
        div.privacy-msg label {
            color: white;
        }
    </style>
```

**Konfiguration und Instanziieren**

```html
    <script type="text/javascript">
        function init_google_maps() {
            alert("Callback google maps ausgeführt");
        }

        function init_twitter() {
            var d = document, t = 'script',
            o = d.createElement(t),
            s = d.getElementsByTagName(t)[0];
            o.src = "https://platform.twitter.com/widgets.js";
            s.parentNode.insertBefore(o, s);
        }

        var _2ClickConfig = {
            enableCookies: true,
            useSessionCookie: true,
            cookieNamespace: 'dsgvo_',
            privacyPolicyUrl: '<?= rex_getUrl(rex_config::get('across/dsgvo', 'consent_url')); ?>',
            CustomTypes: Array({
                type: 'google_maps',
                class: 'google_maps',
                callback: 'init_google_maps',
                description: 'Please enter a text to show before loading the content<br />'
            }, {
                type: 'twitter',
                class: 'twitter',
                callback: 'init_twitter',
                description: 'Please enter a text to show before loading the content<br />'
            })

        };
        document.addEventListener('DOMContentLoaded', _2ClickPrivacy.init(_2ClickConfig));
    </script>
```

# Anwendung

## iframe

Verschiebe den Inhalt von `src=` nach `data-src=` und füge ein leeres Attribut `src=""` hinzu.


```html
<iframe data-2click-type="google_maps" style="width: 100%; height: 600px;"
    data-src="https://www.youtube-nocookie.com/embed/oHg5SJYRHA0"
    frameborder="0" scrolling="no" allow="autoplay; encrypted-media" allowfullscreen>
</iframe>
```

## beliebiges Element

Zum Beispiel Twitter: 

```html
<div data-2click-type="twitter" style="width: 100%; height: 600px;">
    <blockquote class="twitter-tweet">
        <p lang="en" dir="ltr">Sorry losers and haters, but my I.Q. is one of the highest -and you all know it! Please don&#39;t feel so stupid or insecure,it&#39;s not your fault</p>&mdash; Donald J. Trump (@realDonaldTrump) 
        <a href="https://twitter.com/realDonaldTrump/status/332308211321425920?ref_src=twsrc%5Etfw">May 9, 2013</a></blockquote>
    <!-- Script-Bereich entfernen und stattdessen in den Callback legen -->
</div>
```
