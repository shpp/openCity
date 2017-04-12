@if (env('GOOGLE_ANALYTICS'))
    <script>
        !function(a,b,c,d,e,f,g){a.GoogleAnalyticsObject=e,a[e]=a[e]||function(){(a[e].q=a[e].q||[]).push(arguments)},a[e].l=1*new Date,f=b.createElement(c),g=b.getElementsByTagName(c)[0],f.async=1,f.src=d,g.parentNode.insertBefore(f,g)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","{{ env('GOOGLE_ANALYTICS') }}","auto"),ga("send","pageview");
    </script>
@endif
@if (env('YANDEX_METRIKA'))
    <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter{{ env('YANDEX_METRIKA') }} = new Ya.Metrika({ id:{{ env('YANDEX_METRIKA') }}, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/{{ env('YANDEX_METRIKA') }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
@endif
