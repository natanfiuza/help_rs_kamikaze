@extends('adminlte::page')

@section('title', __('Cadastro de Usuários'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Usuários') }}</h1>
@stop

@section('content')

    @php
        $heads = [
            'ID',
            __('Name'),
            ['label' => __('E-mail'), 'width' => 40],
            ['label' => __('Actions'), 'no-export' => true, 'width' => 5],
        ];


        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="'.__('Delete').'">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        // $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="'.__('Details').'">
        //            <i class="fa fa-lg fa-fw fa-eye"></i>
        //        </button>';
        $btnDetails = '';
        $btnNew = '<button id="btn_new_user" onclick="window.open(\''.route('user.create').'\',\'_self\')" class="btn btn-xs btn-default text-teal mx-1 ml-5 shadow justify-content-end" title="'.__('New').'">
                   <i class="fa fa-lg fa-fw fa-plus-square mt-1"></i>
               </button>';
        $data = [];
        foreach ($users as $key => $value) {
            $btnEdit = '<button onclick="window.open(\''.route('user.edit',$value->id).'\',\'_self\')" class="btn btn-xs btn-default text-primary mx-1 shadow" title="'.__('Edit').'">
                <i class="fa fa-lg fa-fw fa-pen"></i></button>';
            $data[] = [
                $value->id,
                $value->name,
                $value->email,
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
                'lengthMenu' => __('Display _MENU_ results per page').$btnNew,
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
