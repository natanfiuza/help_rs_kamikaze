@extends('adminlte::page')

@section('title', __('Cadastro de Usuários'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Consulta') }}</h1>
@stop

@section('content')

    @php
        $heads = [
            'ID',
            __('Name'),
            ['label' => __('E-mail'), 'width' => 40],
            ['label' => __('Actions'), 'no-export' => true, 'width' => 5],
        ];

        $btnDelete =
            '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="' .
            __('Delete') .
            '">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        // $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="'.__('Details').'">
//            <i class="fa fa-lg fa-fw fa-eye"></i>
//        </button>';
        $btnDetails = '';
        $btnNew =
            '<button id="btn_new_user" onclick="window.open(\'' .
            route('consulta.create') .
            '\',\'_self\')" class="btn btn-xs btn-default text-teal mx-1 ml-5 shadow justify-content-end" title="' .
            __('New') .
            '">
                   <i class="fa fa-lg fa-fw fa-plus-square mt-1"></i>
               </button>';
        $data = [];
        foreach ($consulta as $key => $value) {
            $btnEdit =
                '<button onclick="window.open(\'' .
                route('consulta.edit', $value->id) .
                '\',\'_self\')" class="btn btn-xs btn-default text-primary mx-1 shadow" title="' .
                __('Edit') .
                '">
                <i class="fa fa-lg fa-fw fa-pen"></i></button>';
            $data[] = [
                $value->major_id,
                $value->cpf,
                $value->valor,
                '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
            ];
        }
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
            'searching' => false,
            'layout' => [
                'topStart' => [
                    'buttons' => ['pdf'],
                ],
            ],
            'language' => [
                'info' => __('Showing _START_ to _END_ of _TOTAL_ records'),
                'lengthMenu' => __('Display _MENU_ results per page') . $btnNew,
                'paginate' => [
                    'next' => __('Next'),
                    'previous' => __('Previous'),
                    'first' => __('First'),
                    'last' => __('Last'),
                ],
                'emptyTable' => __('No data available in table'),
                'sInfoEmpty' => __('Showing 0 to 0 of 0 _ENTRIES-TOTAL_'),
            ],
        ];
    @endphp
    <x-adminlte-button id="btn_nova_transacao" class="mr-auto" theme="success" label="Nova transação" />
    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" striped hoverable :heads="$heads" :config="$config">
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!} </td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {{-- Compressed with style options / fill data using the plugin config --}}


@stop
<x-adminlte-modal id="cadastro_transacao" title="Nova Transação" class="mb-2" style="" size="lg" theme="danger" icon="fas fa-currency"
    v-centered static-backdrop scrollable>
    <div style="height:200px;">
        <div class="row">
            <div class="col-sm-6">
                <x-adminlte-input name="cpf" label="CPF" placeholder="Informe o CPF"
                    value="{{ Auth::user()->cpf }}" label-class="">
                    <x-slot name="prependSlot">

                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <x-adminlte-input name="valor" label="Valor" placeholder="Informe o Valor" value=""
                    label-class="">
                    <x-slot name="prependSlot">

                    </x-slot>
                </x-adminlte-input>
            </div>
        </div>
    </div>
    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" id="btn_salvar" theme="success" label="Savar" />
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" />
    </x-slot>
</x-adminlte-modal>

@section('js')
    <script>
        $("#btn_nova_transacao").on("click", function() {
            $("#cadastro_transacao").modal('show');
        });
        $("#btn_salvar").on("click", function() {
            salva();
        });

        function salva() {

              $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                    "api-key": "HACKATON_UNIESP_MARJO_2024"
                },
                data: {
                    cpf: $('#cpf').val(),
                    valor: $('#valor').val(),
                },
                url: "/api/save-transacao",
                success: function(res) {
                    console.log('res', res);
                },
                error: function (e) {}, 
            });



        }
    </script>

@stop
