@extends('layouts.admin')

@section('content')

{{-- title --}}
    <h1 class="mb-4 mt.5 text-center">Ordini</h1>
{{-- /title --}}

{{-- container --}}
<div class="form-container p-5">
        {{-- btn-back-menu --}}
        <form action="{{ route('admin.orders.index') }}" method="GET">
            @csrf
            <input type="text" class="hide" name="restaurant_id" value="{{ $orders['restaurant_id'] }}">
            <button type="submit" class="btn btn-primary btn-table flex-center rounded-5 btn-menu">
                <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
            </button>
        </form>
        {{-- btn-back-menu --}}

        {{-- table --}}
        <table class="table table-responsive striped text-center mt-5 ">

            {{-- thead --}}
            <thead>
                <tr>
                    <th>Piatto</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
            {{-- /thead --}}


            {{-- tbody --}}
            @foreach ($orders['dishes'] as $order)
                <tbody>
                    <tr>
                        <td>
                            {{ ucfirst(strtolower($order->name)) }}
                        </td>
                        <td>
                            {{ $order->pivot->quantity }}
                        </td>
                        <td>
                            {{ $order->price * $order->pivot->quantity }}€
                        </td>
                    </tr>
                </tbody>
            @endforeach
            {{-- /tbody --}}

        </table>
        {{-- /table --}}

    </div>
    {{-- /container --}}
@endsection
