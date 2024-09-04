@extends('layouts.admin')

@section('content')
<div class="container mt-5">
        <div>
            {{-- success message --}}
            @if (session('message'))
                <div class="alert alert-success text-center border-0">
                    {{ session('message') }}
                </div>
            @endif
            {{-- /success message --}}

            <h1 class="mb-3 text-center">
                Dati anagrafici
            </h1>

                {{-- user details --}}
                <div class="form-container p-2 m-auto">
                    @if (session('status'))
                        <div class="" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="p-3">
                        <dt>
                            Nome utente:
                        </dt>
                        <dd>
                            {{ ucfirst(strtolower($user->name)) }} {{ ucfirst(strtolower($user->lastname)) }}
                        </dd>
                        <dt>
                            Email:
                        </dt>
                        <dd>
                            {{ $user->email }}
                        </dd>
                        <dt>
                            Data creazione account:
                        </dt>
                        <dd>
                            {{ 'In data: ' .
                                \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') .
                                ', alle ore: ' .
                                \Carbon\Carbon::parse($user->created_at)->format('H:i') }}
                        </dd>

                    </div>
                </div>
                {{-- user details --}}


    </div>
</div>
@endsection
