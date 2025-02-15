<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KiemKracht opdracht</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-vh-100 d-flex align-items-center">
        <div class="container d-flex flex-column flex-md-row justify-content-around align-items-center ">
            <div>
                <h1 class="title fs-1 fw-bold">KIEM<br>KRACHT<br>OPDRACHT</h1>
            </div>
            <div>
                <a class="btn btn-c-index d-block mx-auto mb-3" href="{{route('kassatickets.create')}}">Een kassaticket indienen</a>
                <a class="btn btn-c-index d-block mx-auto" href="{{route('kassatickets.index')}}">Kassatickets tonen</a>
                @auth <a class="d-block text-center mt-2 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{route('logout')}}">logout</a> @endauth
            </div>
        </div>
    </body>
</html>
