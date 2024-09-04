@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light pt-4">
        <div class="row justify-content-center">

            {{-- logo --}}
            <div class="pt-2 pb-4 w-100 d-inline-block d-md-none text-center">
                <img class="logoext text-center" src="{{ asset('storage/img/logo_esteso.png') }}" alt="logo">
            </div>
            {{-- /logo --}}

            <div class="col-md-8">
                <h1 class="text-center mt-1 mb-4">
                    Pagina registrazione
                </h1>
                <div class="card container bg-trasp">

                    {{-- form --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="container">
                                <div class="row mb-4">
                                    {{-- name --}}
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <label for="name" class="text-md-right">
                                            {{ __('Nome ') }} <span class="asterisco">*</span>
                                        </label>

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            minlength="3" maxlength="20" value="{{ old('name') }}" required
                                            autocomplete="name" placeholder="Es. Mario" autofocus>

                                        {{-- error --}}
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- /error --}}
                                    </div>
                                    {{-- /name --}}

                                    {{-- lastname --}}
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <label for="lastname" class="text-md-right">
                                            {{ __('Cognome ') }} <span class="asterisco">*</span>
                                        </label>


                                        <input id="lastname" type="text" minlength="3" maxlength="20"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" required autocomplete="lastname"
                                            placeholder="Es. Rossi" autofocus required>

                                        {{-- error --}}
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- /error --}}
                                    </div>
                                    {{-- /lastname --}}

                                </div>
                            </div>

                            <div class="container">
                                <div class="row mb-4">
                                    {{-- password --}}
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <label for="password" class="text-md-right">
                                            {{ __('Password ') }} <span class="asterisco">*</span>
                                        </label>
                                        <input id="password" type="password" minlength="8"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="********" required>

                                        {{-- error --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- /error --}}
                                    </div>
                                    {{-- /password --}}

                                    {{-- password-confirm --}}
                                    <div class="col-12 col-sm-12 col-md-6">
                                        <label for="password_confirmation" class="text-md-right">
                                            {{ __('Conferma Password ') }} <span class="asterisco">*</span>
                                        </label>
                                        <input id="password_confirmation" minlength="8" type="password"
                                            class="form-control" name="password_confirmation" placeholder="********"
                                            required autocomplete="new-password">
                                    </div>
                                    {{-- /password-confirm --}}
                                </div>
                            </div>

                            <div class="mb-4 container">
                                <div class="row">
                                    {{-- email --}}
                                    <label for="email" class="col-12 text-md-right">
                                        {{ __('E-mail ') }}<span class="asterisco">*</span>
                                    </label>

                                    <div class="col-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="mariorossi@example.com" required>

                                        {{-- error --}}
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- /error --}}

                                    </div>
                                </div>
                                {{-- /email --}}

                            </div>

                            {{-- btn submit --}}
                            <div class="mb-3">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn.register">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                            <div class="">
                                <span class="asterisco">*</span>
                                <span class="field-required">
                                    questi campi sono obbligatori
                                </span>
                            </div>
                            {{-- btn submit --}}

                    </div>
                </div>





                </form>
            </div>
            {{-- /form --}}

        </div>
    </div>
    </div>
    </div>

    {{-- control password.length --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            function checkPasswordLength() {
                if (passwordInput.value.length !== confirmPasswordInput.value.length) {
                    confirmPasswordInput.setCustomValidity("Le password devono avere la stessa lunghezza.");
                } else {
                    confirmPasswordInput.setCustomValidity("");
                }
            }

            passwordInput.addEventListener('input', checkPasswordLength);
            confirmPasswordInput.addEventListener('input', checkPasswordLength);

            // Verifica iniziale quando la pagina viene caricata
            checkPasswordLength();
        });
    </script>
    {{-- control password.length --}}
@endsection
