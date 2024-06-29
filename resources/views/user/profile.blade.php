@extends('adminlte::page')

@section('title', '')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Profile') }}</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="{{ __('Collapse') }}">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <x-adminlte-input name="username" label="{{ __('User') }}" placeholder="username"
                        value="{{ $user->name }}" disabled label-class="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user e"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-input name="email" label="{{ __('E-mail') }}" placeholder="username"
                        value="{{ $user->email }}" disabled label-class="">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-envelope e"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>



                </div>
            </div>
        </div>
    </div>

@stop
