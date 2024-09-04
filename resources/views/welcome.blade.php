@extends('layouts.app')
@section('content')

{{-- home page back --}}
<div class="bg-light vh-100 flex-center flex-column text-center">
        {{-- logo --}}
        <div class="logoext mb-5">
            <img src="{{ asset('storage/img/logo_esteso.png') }}" alt="logo">
        </div>
        {{-- /logo --}}

        {{-- title --}}
        <h1 class="fs-1 fw-bold">
           Benvenuto nel Back-Office di DeliveBoo
        </h1>
        {{-- /title --}}

        {{-- subtitle --}}
        <p class="col-md-10 fs-4">Qui potrai visualizzare il tuo ristorante, gestire il tuo menu e visualizzare i tuoi ordini</p>
        {{-- /subtitle --}}
</div>
{{-- /home page back --}}

@endsection
