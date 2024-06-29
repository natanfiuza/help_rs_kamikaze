@extends('adminlte::page')

@section('title', 'Cadastro Usuários')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('User') }}</h1>
@stop

@section('content')
    <form action="{{ route('user.update' , $usuario->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Alterar: {{$usuario->name}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                title="{{ __('Collapse') }}">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>{{__('Attention!!')}}</strong> {{__('We have some problems with your form.')}}<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <x-adminlte-input name="name" label="{{ __('Name') }}" placeholder="{{ __('Name') }}"
                            value="{{$usuario->name}}" label-class="">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user e"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="email" label="{{ __('E-mail') }}" placeholder="{{ __('E-mail') }}"
                            value="{{$usuario->email}}" label-class="">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope e"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="password" type="password" label="{{ __('Password') }}" placeholder="{{ __('Password') }}"
                            value="" label-class="">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock e"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-input name="password_confirmation"  type="password" label="{{ __('Password confirm') }}" placeholder="{{ __('Password confirm') }}"
                            value="" label-class="">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock e"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>



                    </div>
                    <div class="card-footer">
                        <x-adminlte-button label="{{ __('Save') }}" id="btn_save_user" type="submit" theme="success"
                            icon="fas fa-check" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
