@extends('layouts.admin')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    {{-- title --}}
    <h1 class="mt-5 mb-4 text-center">Ordini</h1>
    {{-- /title --}}

    {{-- order details  --}}
    <div class="form-container border rounded-5 p-3">

        {{-- btn-back-order --}}
        <form action="{{ route('admin.orders.index') }}" method="GET">
            @csrf
            <input type="text" class="hide" name="restaurant_id" value="{{ $orders['restaurant_id'] }}">
            <button type="submit" class="btn-action-form btn-left">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
        </form>
        {{-- btn-back-order --}}

        <h5 class="text-center border-bottom pb-2">Riepilogo ordine:</h5>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
                <div>
                    <span>
                        <strong>Ordine n. :</strong>
                    </span>
                    <span>
                        {{ $orderDetails->id }}
                    </span>
                </div>
                <div>
                    <span>
                        <strong>Nome:</strong>
                    </span>
                    <span>
                        {{ $orderDetails->name }} {{ $orderDetails->lastname }}
                    </span>
                </div>
                <div>
                    <span>
                        <strong>Indirizzo: </strong>
                    </span>
                    <span>
                        {{ $orderDetails->address }}
                    </span>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-6">
                <div>
                    <span>
                        <strong>E-mail: </strong>
                    </span>
                    <span>
                        {{ $orderDetails->email }}
                    </span>
                </div>
                <div>
                    <span>
                        <strong>Telefono:</strong>
                    </span>
                    <span>
                        {{ $orderDetails->phone_number }}
                    </span>
                </div>
                <div>
                    <span>
                        <strong>Data: </strong>
                    </span>
                    <span>
                        {{ Carbon::parse($orderDetails->date)->format('d/m/Y') }} ,
                    </span>
                    <span>
                        <strong>Ore: </strong>
                    </span>
                    <span>
                        {{ Carbon::parse($orderDetails->date)->format('H:i') }}
                    </span>
                </div>

            </div>

        </div>
    </div>
    {{-- /order details  --}}

    {{-- container --}}
    <div class="form-container form-padding">

        {{-- dishes order --}}
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
        {{-- /dishes order --}}

        <div class="text-end">
            <span class="fs-5 text-danger">
                <strong>Totale:</strong>
            </span>
            <span class="fs-5">
                {{ $orderDetails->total_price }}€
            </span>
        </div>

    </div>
    {{-- /container --}}
@endsection
