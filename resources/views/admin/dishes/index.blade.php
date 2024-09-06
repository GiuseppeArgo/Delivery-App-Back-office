@extends('layouts.admin')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            {{-- header --}}

            <div class="mt-5 mb-2 text-center ">
                <h1 class="p-0 d-block">
                    Menù
                </h1>

                <div class="flex-center gap-2">
                    {{-- btn-home --}}
                    <div>
                        <a href="{{ route('admin.restaurants.index') }}" class="btn-action-form flex-center">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                    {{-- /btn-home --}}
                    <div>
                        <span class="">
                            ( Totale piatti: {{ count($dishesList) }} )
                        </span>
                    </div>

                    {{-- add dish --}}
                    <div>
                        <form action="{{ route('admin.dishes.create') }}" method="GET">
                            <input type="text" class="hide" name="restaurant_id" value="{{ $restaurant_id }}">
                            <button type="submit" class="btn-action-form border-0 flex-center">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </form>
                    </div>
                    {{-- add dish --}}
                </div>



            </div>
            {{-- /header --}}


            @if (count($dishesList) > 0)
                {{-- table --}}
                <div class="table-responsive text-center w-75">
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

                                        <form class="flex-center"
                                            action="{{ route('admin.dishes.toggle', ['id' => $dish->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" class="hide" name="restaurant_id"
                                                value="{{ $restaurant_id }}">
                                            <input type="text" class="hide" name="visibility"
                                                value="{{ $dish->visibility }}">
                                            <button type="submit"
                                                class="size-btn-table flex-center @if ($dish->visibility == 1) btn btn-outline-success @else btn btn-outline-danger @endif">
                                                <span>
                                                    {{ $dish->visibility == 1 ? 'SI' : 'NO' }}
                                                </span>
                                            </button>
                                        </form>

                                        {{-- change status --}}

                                    </td>
                                    {{-- /status --}}

                                    <td class="p-0 m-0 align-middle">
                                        <a class="btn btn-outline-primary p-1 size-btn-table"
                                            href="{{ route('admin.dishes.show', ['dish' => $dish->slug]) }}">
                                            <i class="fa solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-outline-primary p-1 size-btn-table d-none d-sm-inline-block"
                                            href="{{ route('admin.dishes.edit', ['dish' => $dish->slug]) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
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
                    <p class="nothing"> Non ci sono ancora piatti nel tuo menù</p>
                </div>
            @endif
        </div>
    </div>
@endsection
