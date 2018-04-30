@extends('admin.layouts.app')

@section('header')

    <h1>
        Crear
        <small>Nuevo profesor</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Profesores</a></li>
        <li><a href="{{ route('profesores.listar') }}">Listado</a></li>
        <li><a href="#">Crear</a></li>
    </ol>

@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Crea profesor</h3>
            </div>

            <form class="form-horizontal" action="{{ route('profesores.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" name="nombre" class="form-control"
                                   value="{{ old('nombre') }}"
                                   placeholder="Escribe el nombre del profesor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="Escribe el email del profesor">
                        </div>
                    </div>

                    <div class="form-group">
                        <p class="col-sm-12 control-label" style="color: #8d8d8d;">*La contraseña por defecto será: '123456'</p>
                    </div>

                </div>
                <div class="box-footer">

                    <a href="{{ route('profesores.listar') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar profesor</button>

                </div>

            </form>
        </div>
    </div>

@endsection
