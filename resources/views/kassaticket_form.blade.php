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
            <form method="POST" enctype="multipart/form-data" action="{{route('kassatickets.store')}}">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="voornaam" class="form-label">Voornaam</label>
                        <input type="text" class="form-control @error('voornaam') is-invalid @enderror" name="voornaam" id="voornaam" value="{{ old('voornaam', $klant->voornaam ?? '') }}" required>
                        @error('voornaam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col">
                        <label for="achternaam" class="form-label">Achternaam</label>
                        <input type="text" class="form-control @error('achternaam') is-invalid @enderror" name="achternaam" id="achternaam" value="{{ old('achternaam', $klant->achternaam ?? '') }}" required>
                        @error('achternaam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $klant->email ?? '') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="kassaticket" class="form-label">Kassaticket invoegen</label>
                    <input type="file" class="form-control @error('kassaticket') is-invalid @enderror" name="kassaticket" id="kassaticket" accept=".pdf, .jpg, .jpeg, .png" required/>
                    @error('kassaticket') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary d-block mx-auto px-5">Indienen</button>
            </form>
            @if (session('success'))
                <div class="alert alert-success my-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </body>
</html>
