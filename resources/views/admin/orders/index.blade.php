@extends('layouts.admin')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="mt-5">
        <div class="w-50 text-center m-auto">
            @if (isset($error))
                <div class="alert alert-danger">
                    <span class="text-danger">
                        <strong>{{ $error }}</strong>
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- title  --}}
    <h1 class="text-center mb-4 mt-5">Lista ordini</h1>
    {{-- /title  --}}

    {{-- container  --}}
    <div class="form-container w-100 pt-5 mt-3">
        @if (count($orders) > 0)

            {{-- btn-home --}}
            <div class="btn-back">
                <a href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </div>
            {{-- /btn-home --}}

            {{-- btn-stats --}}
            <a class="btn-edit-restaurant btn-stats" href="{{ route('admin.stats.index') }}">
                <i class="fa-solid fa-chart-line"></i>
            </a>
            {{-- /btn-stats --}}

            {{-- table --}}
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover text-center ">

                    {{-- thead --}}
                    <thead>
                        <tr>
                            {{-- <th scope="col ">Num.</th> --}}
                            <th scope="col">Nome</th>
                            <th scope="col">Telefono</th>
                            {{-- <th scope="col">Mail</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Data</th> --}}
                            <th scope="col">Totale</th>
                            <th scope="col" class="text-center">Dettagli</th>
                        </tr>
                    </thead>
                    {{-- /thead --}}


                    {{-- tbody --}}
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-truncate">
                                {{-- <td class="align-middle">{{ $order->id }}</td> --}}
                                <td class="align-middle">{{ ucwords(strtolower($order->name)) }} {{ $order->lastname }}</td>
                                <td class="align-middle">{{ $order->phone_number }}</td>
                                {{-- <td class="align-middle">{{ $order->email }}</td>
                                <td class="align-middle">{{ ucwords(strtolower($order->address)) }}</td> --}}
                                <td class="align-middle">{{ Carbon::parse($order->date)->format('d/m/Y') }}</td>
                                {{-- <td class="align-middle">{{ $order->total_price }}€</td> --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                        class="btn btn-outline-primary">
                                        >
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    {{-- /tbody --}}

                </table>

                <!-- Collegamenti di paginazione -->
                @if ($orders->hasPages())
                <div class="d-flex justify-content-center">
                    <ul class="pagination">

                        {{-- Link alla prima pagina --}}
                        @if ($orders->currentPage() > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->url(1) }}" aria-label="First">&#5176;&#5176;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&#5176;</span>
                            </li>
                        @endif

                        {{-- Link alla pagina precedente --}}
                        @if ($orders->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&#5176;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">&#5176;</a>
                            </li>
                        @endif

                        {{-- Pagine vicine alla corrente --}}
                        @foreach(range(1, $orders->lastPage()) as $page)
                            @if ($page >= $orders->currentPage() - 1 && $page <= $orders->currentPage() + 1)
                                @if ($page == $orders->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Link alla pagina successiva --}}
                        @if ($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">&#5171;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&#5171;</span>
                            </li>
                        @endif

                        {{-- Link all'ultima pagina --}}
                        @if ($orders->currentPage() < $orders->lastPage())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}" aria-label="Last">&#5171;&#5171;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&#5171;&#5171;</span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
            </div>
            {{-- /table --}}
        @else
            <div class="flex-center flex-column gap-2">
                <p class="fs-3 p-0 m-0 text-center"><strong>Non ci sono ordini</strong></p>
                <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Home
                </a>
            </div>
        @endif
    </div>
    {{-- /container  --}}

@endsection
