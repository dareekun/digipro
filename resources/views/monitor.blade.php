<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Monitor Produksi</title>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Silde Show -->
    <style>
    body {
        margin: 0;
        /* Reset default margin */
    }

    iframe {
        display: block;
        /* iframes are inline by default */
        background: #000;
        border: none;
        /* Reset default border */
        height: 100vh;
        /* Viewport-relative units */
        width: 100vw;
    }
    </style>
</head>

<body>
    <div class="col-md-12">
        <table class="table" hidden id="url" style="width:100%" bordered>
            <tr>
                @foreach ($bagian as $bg)
                <td>
                    <div class="namabagian">{{$bg->bagian}}</div>
                </td>
                @endforeach
            </tr>
        </table>
        <iframe id="rotator" frameBorder="0" style="width:100%;height:100vh" src="/grafik/Assy WD"></iframe>
        <script>
        // start when the page is loaded
        window.onload = function() {
            var y = document.getElementById('url').rows[0].cells.length;
            var urls = Array();
            console.log(y);

            for (x = 0; x < y; x++) {
                urls[x] = "/grafik/" + document.getElementsByClassName("namabagian")[x].innerHTML;
            }
            console.log(urls);
            var index = 1;
            var el = document.getElementById("rotator");

            setTimeout(function rotate() {

                if (index == urls.length) {
                    index = 0;
                }

                el.src = urls[index];
                index = index + 1;

                // continue rotating iframes
                setTimeout(rotate, 60000);

            }, 60000); 
        };
        </script>
</body>

</html>