@extends('template.main')


@section('content')

    <div class="div-form">

        <div class="container w-70">
            @if (session('message'))
                <div class="alert alert-success" style="display: block">
                    {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="">Cadastro de embarque</h2>
            @if (isset($board))
                @php
                    $fat_route = str_replace('-', '*', $board->fat);
                    $fat_route = str_replace('/', '-', $fat_route);
                @endphp
                <form action="{{ route('boarding.update', $fat_route) }}" method="POST">
                    @method('PUT')
                @else
                    <form action="{{ route('boarding.store') }}" method="POST">
            @endif
            @csrf
            @php
                
                $data = date('Y-m-d H:i');
                $data = str_replace(' ', 'T', $data);
                
            @endphp
            <div class="row mt-3">
                <div class="col-md">
                    <div class="form-group">
                        <label for="client">Cliente</label>
                        <input type="text" class="form-control" id="client" name="client"
                            value="{{ $board->client ?? '' }}" />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="fat">Fatura</label>
                        <input type="text" class="form-control" id="fat" name="fat" value="{{ $board->fat ?? '' }}" />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="agent">Agente</label>
                        <input type="text" class="form-control" id="agent" name="agent"
                            value="{{ $board->agent ?? '' }}" />
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-group">
                        <label for="date_delivery">Entrega da Mercadoria</label>
                        <input type="datetime-local" class="form-control" id="date_delivery" name="date_delivery"
                            @if (isset($board))
                    value="{{ str_replace(' ', 'T', $board->date_delivery) }}" @else
                        @endif />
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md">
                    <div class="form-group">
                        <label for="date_loading">Data do Carregamento</label>
                        <input type="datetime-local" class="form-control" id="date_loading" name="date_loading"
                            @if (isset($board))
                    value="{{ str_replace(' ', 'T', $board->date_loading) }}" @else
                        @endif />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="date_boarding">Saída do (Avião/Navio)</label>
                        <input type="datetime-local" class="form-control" id="date_boarding" name="date_boarding"
                            @if (isset($board))
                    value="{{ str_replace(' ', 'T', $board->date_boarding) }}" @else
                        @endif />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="date_doc">Entrega do Documento</label>
                        <input type="datetime-local" class="form-control" id="date_doc" name="date_doc" @if (isset($board)) value="{{ str_replace(' ', 'T', $board->date_doc) }}"
                    @else
                        @endif />
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-group">
                        <label for="date_prod">Entrega Produção/Faturamento</label>
                        <input type="datetime-local" class="form-control" id="date_prod" name="date_prod" @if (isset($board)) value="{{ str_replace(' ', 'T', $board->date_prod) }}"
                    @else
                        @endif />
                    </div>
                </div>
            </div>

            <div class="form-group mt-2">
                <label for="obs">Observação</label>
                <textarea class="form-control" id="obs" name="obs" rows="3">{{ $board->obs ?? '' }}</textarea>
            </div>

            <div class="row mt-2">
                <div class="col-md">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> @if (isset($board)) Atualizar @else Cadastrar @endif
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
