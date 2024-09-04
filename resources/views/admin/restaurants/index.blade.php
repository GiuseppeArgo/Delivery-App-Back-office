@extends('layouts.admin')

@section('content')

    @include('partials.session_message')

    {{-- control list restaurant  --}}
    @if ($restaurant->isNotEmpty())
        {{-- error message --}}
        <div class="mt-5">
            @if (session('error'))
                <div class="alert alert-danger form-container border-0 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        {{-- /error message --}}

        @foreach ($restaurant as $curRestaurant)

        {{-- header --}}
            <h1 class="text-center">Dettagli ristorante</h1>
        {{-- /header --}}

        {{-- container --}}
        <div class="form-container container form-padding">

                {{-- btn edit --}}
                    <a class="btn-action-form btn-right" href="{{ route('admin.restaurants.edit', ['restaurant' => $curRestaurant->slug]) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                {{-- /btn edit --}}


                    {{-- container main --}}
                    <div class="row flex-center">

                        {{-- restaurant-img --}}
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 p-0 text-center ">
                            <img class="square-image w-75" src="{{ asset('storage/' . $curRestaurant->image) }}"
                                alt="img-restaurant">
                        </div>
                        {{-- /restaurant-img --}}


                        {{-- restaurant text --}}
                        <div
                            class="col-12 col-sm-6 col-md-6 col-lg-6 text-lg-start pt-3 d-flex flex-column gap-2 align-items-center align-items-md-start font-restaurants-details">

                            {{-- name --}}
                            <div>
                                <p class="p-0 m-0">
                                    <strong>Nome ristorante: </strong>
                                </p>
                                <span class="">{{ ucwords(strtolower($curRestaurant->name)) }}</span>
                                {{-- /name --}}

                                {{-- city --}}
                                <p class="p-0 m-0">
                                    <strong>Città: </strong>
                                </p>
                                <span class="">{{ $curRestaurant->city }}</span>
                                {{-- /city --}}

                                {{-- address --}}
                                <p class="p-0 m-0">
                                    <strong>Indirizzo: </strong>
                                </p>
                                <span class="">{{ ucwords(strtolower($curRestaurant->address)) }}</span>
                                {{-- /address --}}

                                {{-- types --}}
                                <p class="p-0 m-0">
                                    @if (count($curRestaurant->types) === 1)
                                        <strong>Tipologia: </strong>
                                    @else
                                        <strong>Tipologie: </strong>
                                    @endif
                                </p>
                                <ul>
                                    @foreach ($curRestaurant->types as $type)
                                        <li>
                                            <span class="">{{ $type->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- /types --}}

                        </div>
                        {{-- /restaurant text --}}

                        {{-- /container main --}}
                    </div>
                    {{-- container main --}}





            </div>
            {{-- /container --}}
        @endforeach
        </div>
    @else
        <div class="form-container flex-center flex-column p-5">
            <p class="nothing text-center">Nessun ristorante registrato. Aggiungine uno.</p>
            <a class="btn btn-primary" href="{{ route('admin.restaurants.create') }}">
                <i class="fa-solid fa-plus"></i> Nuovo ristorante
            </a>
        </div>
    @endif

@endsection
