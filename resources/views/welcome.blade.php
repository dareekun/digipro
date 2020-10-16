<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Produksi</title>
        <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>   
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/js/app.js') }}">
        <script type="text/javascript" src="{{ asset('/js/chart.js') }}"></script> 
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url("{{ asset('/img/bg.png') }}");
                background-size: cover;
            }
            .clock {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        color: #636b6f;
        font-size: 200%;
        font-family: sans-serif;
        letter-spacing: 7px;
    }
    .dropdown-menu{
   max-height:300px;
   overflow-y: scroll;
}
            .full-height {
                height: 150px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .center {
                margin-left :auto;
                margin-right : auto;
                width : 85%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" >Login</a>
                    @endauth
                </div>
            @endif
            </div>
            <div class="center">
               <table style="width:100%" id="data">
               <tr>
               <td colspan="4" style="width:65%"><canvas id="chart2"></canvas></td>
               <td colspan="2" ><canvas id="chart1"></canvas> <br></td>
               </tr>
               <tr>
               <td></td>
               <td>Assy WD</td>
               <td>Compression</td>
               <td>Injection</td>
               <td>Metal Part</td>
               <td>Export</td>
               <td>Total</td>
               </tr>
               <tr>
               <td>Plan</td>
               <td class="dataplan">{{$AssyP}}</td>
               <td class="dataplan">{{$CompressionP}}</td>
               <td class="dataplan">{{$InjectionP}}</td>
               <td class="dataplan">{{$MetalP}}</td>
               <td class="dataplan">{{$ExportP}}</td>
               <td class="total">{{$TotalP}}</td>
               </tr>
               <tr>
               <td>Actual</td>
               <td class="dataactual">{{$AssyA}}</td>
               <td class="dataactual">{{$CompressionA}}</td>
               <td class="dataactual">{{$InjectionA}}</td>
               <td class="dataactual">{{$MetalA}}</td>
               <td class="dataactual">{{$ExportA}}</td>
               <td class="total">{{$TotalA}}</td>
               </tr>
               </tr>
               </table>
        </div>
        <script type="text/javascript" src="/js/chart1.js"></script>
    </body>
</html>
