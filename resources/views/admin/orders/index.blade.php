@extends('layouts.admin')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @if (isset($error))
        <div class="mt-5">
            <div class="w-50 text-center m-auto">
                <div class="alert alert-danger">
                    <span class="text-danger">
                        <strong>{{ $error }}</strong>
                    </span>
                </div>
            </div>
        </div>
    @endif

    <div class="flex-center gap-2 mt-4">
        {{-- btn-home --}}
        <a href="{{ route('admin.restaurants.index') }}"
            class="btn btn-primary btn-action-form flex-center rounded-5">
            <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
        </a>
        {{-- /btn-home --}}
        {{-- title  --}}
        <h1 class="text-center p-0 m-0">Lista ordini</h1>
        {{-- /title  --}}
    </div>

    {{-- container  --}}
    <div class="form-container w-100 pt-5 pb-5">
        @if (count($orders) > 0)

            {{-- btn-home --}}
            <div class="btn-action-form btn-left">
                <a href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
                </a>
            </div>
            {{-- /btn-home --}}

            {{-- btn-stats --}}
            <a class="btn-action-form btn-right" href="{{ route('admin.stats.index') }}">
                <i class="fa-solid fa-chart-line" style="color: #ffffff;"></i>
            </a>
            {{-- /btn-stats --}}

            {{-- table --}}
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover text-center ">

                    {{-- thead --}}
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-lg-table-cell">Num.</th>{{-- --}}
                            <th scope="col">Nome</th>
                            <th scope="col">Telefono</th>
                            <th scope="col" class="d-none d-md-table-cell">Mail</th> {{-- --}}
                            <th scope="col" class="d-none d-md-table-cell">Indirizzo</th>{{-- --}}
                            <th scope="col">Data</th>{{-- --}}
                            <th scope="col">Totale</th>
                            <th scope="col" class="text-center">Dettagli</th>
                        </tr>
                    </thead>
                    {{-- /thead --}}


                    {{-- tbody --}}
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-truncate">
                                <td class="align-middle d-none d-lg-table-cell">{{ $order->id }}</td>
                                {{-- --}}
                                <td class="align-middle">{{ ucwords(strtolower($order->name)) }} {{ $order->lastname }}</td>
                                <td class="align-middle">{{ $order->phone_number }}</td>
                                <td class="align-middle d-none d-md-table-cell">{{ $order->email }}</td>
                                {{-- --}}
                                <td class="align-middle">{{ Carbon::parse($order->date)->format('d/m/Y') }}</td>
                                <td class="align-middle d-none d-md-table-cell">{{ ucwords(strtolower($order->address)) }}
                                </td>{{-- --}}
                                <td class="align-middle">{{ $order->total_price }}€</td> {{-- --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                        class="btn btn-outline-primary rounded-5 px-2 py-1 m-0">
                                        <i class="fa-solid fa-arrow-right"></i>
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
                                    <a class="page-link" href="{{ $orders->url(1) }}" aria-label="First"><i
                                            class="fa-solid fa-angles-left"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-solid fa-angles-left"></i></span>
                                </li>
                            @endif

                            {{-- Link alla pagina precedente --}}
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-solid fa-arrow-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev"><i
                                            class="fa-solid fa-arrow-left"></i></a>
                                </li>
                            @endif

                            {{-- Pagine vicine alla corrente --}}
                            @foreach (range(1, $orders->lastPage()) as $page)
                                @if ($page >= $orders->currentPage() - 1 && $page <= $orders->currentPage() + 1)
                                    @if ($page == $orders->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $orders->url($page) }}">{{ $page }}</a></li>
                                    @endif
                                @endif
                            @endforeach

                            {{-- Link alla pagina successiva --}}
                            @if ($orders->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next"><i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-solid fa-arrow-right"></i></span>
                                </li>
                            @endif

                            {{-- Link all'ultima pagina --}}
                            @if ($orders->currentPage() < $orders->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->url($orders->lastPage()) }}"
                                        aria-label="Last"><i class="fa-solid fa-angles-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-solid fa-angles-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
            {{-- /table --}}
        @else
            <div class="flex-center gap-2">
                <p class="flex-center nothing text-center"><strong>Non ci sono ordini</strong></p>
            </div>
        @endif
    </div>
    {{-- /container  --}}

@endsection
