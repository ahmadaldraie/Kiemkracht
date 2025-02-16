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
        <header class="">
                <a class="text-decoration-none" href="/">
                    <h1 class="title fs-3 ms-3 mt-2">KIEM<br>KRACHT<br>OPDRACHT</h1>
                </a>
        </header>
        <div class="container d-flex flex-grow-1 flex-column justify-content-center align-items-center ">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control @error('email') is-invalid @enderror" id="username" value="{{ old('username', $user->username ?? '') }}" required>
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Wachtwoord</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password', $user->password ?? '') }}" required>
                    @error('achternaam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-huis d-block mx-auto px-5">inloggen</button>
            </form>
            @error('login') <div class="alert alert-danger mt-3" role="alert">{{ $message }}</div> @enderror
            <div class="alert alert-info mt-3 text-center" role="alert">
                Er is geen registratiefunctie beschikbaar. <br>Hier vindt u daarom enkele demo-accounts om te testen. <br>
                Account met admin role: <br>
                <strong title="username">admin</strong> <br>
                <strong title="wachtwoord">password123</strong> <br>
                Gewoone account: <br>
                <strong title="username">user</strong> <br>
                <strong title="wachtwoord">userpassword</strong> <br>
            </div>
        </div>
    </body>
</html>
