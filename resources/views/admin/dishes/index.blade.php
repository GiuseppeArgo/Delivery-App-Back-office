@extends('layouts.admin')

@section('content')
    {{-- btn --}}
    {{-- <div class="flex-center mt-5 gap-2"> --}}
        {{-- btn home --}}
        {{-- <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Indietro
        </a> --}}
        {{-- btn home --}}

        {{-- </div> --}}
        {{-- /btn --}}

        <div class="container">
            <div class="row justify-content-center">
                {{-- header --}}

                    <div class="mt-5 mb-2  text-center ">
                        <h1 class="p-0 d-block">
                            Menu del ristorante
                        </h1>
                        <span class="">
                            ( Totale piatti: {{ count($dishesList) }}  )
                        </span>

                        {{-- add dish--}}
                        <form action="{{ route('admin.dishes.create') }}" method="GET" class="d-inline-block">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant_id }}">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </form>
                        {{-- add dish--}}



            </div>
            {{-- /header --}}


            @if (count($dishesList) > 0)
                {{-- table --}}
                <div class="table-responsive text-center">
                    <table class="table table-bordered m-auto">

                        {{-- thead --}}
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col">Disponibile</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        {{-- /thead --}}


                        {{-- tbody --}}
                        <tbody>
                            @foreach ($dishesList as $dish)
                                <tr>
                                    {{-- name --}}
                                    <td class="align-middle">{{ ucfirst(strtolower($dish->name)) }}</td>

                                    {{-- price --}}
                                    <td class="align-middle">{{ $dish->price }} €</td>


                                    {{-- statuts --}}
                                    <td class="align-middle d-cell gap-2">

                                        {{-- change status --}}

                                            <form class="form-visibility" action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant_id }}">
                                                <input type="text" class="hide" name="visibility" value="{{ $dish->visibility }}">
                                                <button type="submit" class="btn @if($dish->visibility == 1) btn btn-outline-success @else btn btn-outline-danger @endif">
                                                    <span>
                                                        {{ $dish->visibility == 1 ? 'SI' : 'NO' }}
                                                    </span>
                                                </button>
                                            </form>

                                            {{-- change status --}}

                                    </td>
                                    {{-- /status --}}

                                    <td class="p-0 m-0 align-middle">
                                        <a class="btn btn-outline-primary p-1 btn-table"
                                            href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                            <i class="fa solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-outline-primary p-1 btn-table d-none d-sm-inline-block"
                                            href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        {{-- /tbody --}}

                    </table>
                </div>
                {{-- /table --}}
            @else
                <div class="form-container p-5 text-center">
                    <p class="fs-3"> Non ci sono ancora piatti nel tuo menu</p>
                </div>
            @endif
        </div>
    </div>
@endsection
