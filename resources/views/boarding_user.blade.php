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
            <h6>Fatura: {{$board->fat}}</h6>

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
