@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Company Profile</h1>
@stop

@section('plugins.BsCustomFileInput', true)

@section('content')
    <form action="/company/coyProfile" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">

        <x-adminlte-input name="name" label="Company Name" placeholder="company name"
                          value="{{ old('name')??$company->name??''}}"
                          fgroup-class="col-md-6" />
    </div>

    <div class="row">
        {{-- Placeholder, sm size and prepend icon --}}
        <x-adminlte-input-file name="logo" label="Company's Logo" igroup-size="sm"  fgroup-class="col-md-6">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
    </div>

<div class="row">

    <x-adminlte-input name="address" label="Company's Address" fgroup-class="col-md-6"
                      value="{{ old('address')??$company->address??''}}">
        <x-slot name="prependSlot">
            <div class="input-group-text text-purple">
                <i class="fas fa-address-card text-lightblue"></i>
            </div>
        </x-slot>
        <x-slot name="bottomSlot">
        <span class="text-sm text-gray">
            [Add address information you may consider important]
        </span>
        </x-slot>
    </x-adminlte-input>
</div>
    {{-- Email type --}}
    <div class="row">
    <x-adminlte-input name="email" label="Company's Email" type="email" placeholder="mail@example.com"
                      fgroup-class="col-md-6" value="{{ old('email')??$company->email??''}}">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-at text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    </div>

    <div class="row">
        <x-adminlte-input label="Company's Phone" name="phone"
                          fgroup-class="col-md-6" value="{{ old('phone')??$company->phone??''}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-mobile text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>

    <div class="row">
        <x-adminlte-textarea name="description" label="Company's Description" rows=5
                             igroup-size="sm" placeholder="Insert description..."
                             fgroup-class="col-md-6">
            {{old('description')??$company->description??''}}
            <x-slot name="prependSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-textarea>
    </div>
    <x-adminlte-button class="btn-flat mb-5" type="submit" label="Save" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop

@section('css')
{{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
{{--    <script> console.log('Hi!'); </script>--}}
@stop
