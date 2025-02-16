<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KiemKracht opdracht</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-vh-100 d-flex flex-column">
        <header class="d-flex flex-column flex-md-row justify-content-between">
                <a class="text-decoration-none" href="/">
                    <h1 class="title fs-3 ms-3 mt-2">KIEM<br>KRACHT<br>OPDRACHT</h1>
                </a>
                <form class="form-horizontal d-flex justify-content-center align-items-center me-3" method="get">
                    @csrf
                    <div class="input-group">
                        <button class="btn btn-huis" type="submit">Zoeken</button>
                        <input type="text" class="form-control-lg" name="query" placeholder="Zoek op klant naam of email address" aria-label="Search">
                    </div>
                </form>
        </header>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success my-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if($kassatickets->count())
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Voornaam</th>
                        <th scope="col">Achternaam</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kassaticket</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($kassatickets as $kassaticket)
                            @php
                                $klant = $kassaticket->klant;
                                $i++;
                            @endphp
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$klant->voornaam}}</td>
                                <td>{{$klant->achternaam}}</td>
                                <td>{{$klant->email}}</td>
                                <td><a class="btn btn-primary" href="/uploads/{{$kassaticket->bestaand}}" target="_blank" rel="noopener">Toon kassaticket</a></td>
                                <td>
                                    <form action="{{ route('kassatickets.destroy', $kassaticket->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center mt-3">Er zijn geen kassatickets gevonden</p>
            @endif
        </div>
    </body>
</html>
