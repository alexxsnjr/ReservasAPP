@extends('admin.layouts.app')


@section('header')
        <h1>
            Inicio
            <small>Gestión de aulas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Bienvenido a la aplicación para la gestión de aulas</h1>
        </div>
    </div>
@endsection
