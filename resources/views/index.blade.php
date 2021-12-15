@extends('template.main')
@section('content')
    <div class="div-talbe">
        <table class="table table-striped lf-table">
            <thead style="">
                <th>Fatura</th>
                <th>Cliente</th>
                <th>Agente</th>
                <th>Entrega Produção/Faturamento</th>
                <th>Prazo da Entrega do Documento</th>
                <th>Data do Carregamento <br> (P. Prudente)</th>
                <th>Entrega da Mercadoria (Terminal)</th>
                <th>Data da Saída (Avião/Navio)</th>
                <th>Observação</th>
                <th>Ações</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($boarding as $item)
                    <tr>
                        <td>
                            {{ $item->fat }}
                        </td>
                        <td>
                            {{ $item->client }}
                        </td>
                        <td>
                            {{ $item->agent }}
                        </td>
                        <td>
                            @if (isset($item->date_prod))
                                {{ date('d/m/Y', strtotime($item->date_prod)) }}<br>
                                {{ date('H:i', strtotime($item->date_prod)) }}
                            @else
                                {{ '-' }}
                            @endif

                        </td>
                        <td>

                            @if (isset($item->date_doc))
                                {{ date('d/m/Y', strtotime($item->date_doc)) }}<br>
                                {{ date('H:i', strtotime($item->date_doc)) }}
                            @else
                                {{ '-' }}
                            @endif
                        </td>
                        <td>
                            @if (isset($item->date_loading))
                                {{ date('d/m/Y', strtotime($item->date_loading)) }} <br>
                                {{ date('H:i', strtotime($item->date_loading)) }}
                            @else
                                {{ '-' }}
                            @endif


                        </td>
                        <td>
                            @if (isset($item->date_delivery))
                                {{ date('d/m/Y', strtotime($item->date_delivery)) }} <br>
                                {{ date('H:i', strtotime($item->date_delivery)) }}
                            @else
                                {{ '-' }}
                            @endif

                        </td>

                        <td>
                            @if (isset($item->date_boarding))
                                {{ date('d/m/Y', strtotime($item->date_boarding)) }} <br>
                                {{ date('H:i', strtotime($item->date_boarding)) }}
                            @else
                                {{ '-' }}
                            @endif

                        </td>


                        <td>
                            {{ $item->obs }}
                        </td>
                        @php
                            $fat_route = str_replace('-', '*', $item->fat);
                            $fat_route = str_replace('/', '-', $fat_route);
                            
                        @endphp
                        <td>
                            <a href="{{ route('boarding.edit', $fat_route) }}"> <img
                                    src="{{ asset('images/edit.png') }}" alt="" width="14px"></a>
                            <form action="{{ route('boarding.destroy', $item->fat) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button style="border: none; background-color: transparent"> <img
                                        src="{{ asset('images/delete.png') }}" alt="" width="14px"></button>
                            </form>
                        </td>
                        <td>
                            @if($item->status == 0)
                                {{ '---'}}
                            @else
                           <img src="{{asset('images/check.png')}}" alt="" width="17px">
                            @endif
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
