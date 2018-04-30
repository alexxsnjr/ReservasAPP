@extends('admin.layouts.app')

@section('header')

    <h1>
        Editar
        <small>Profesor</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Profesores</a></li>
        <li><a href="{{ route('profesores.listar') }}">Listado</a></li>
        <li><a href="#">Editar</a></li>
    </ol>

@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar profesor</h3>
            </div>

            <form class="form-horizontal" action="{{ route('profesores.update' , $profesor->id)}}" method="POST">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" name="nombre" class="form-control"
                                   value="{{ old('nombre',$profesor->name) }}"
                                   placeholder="Escribe el nombre del profesor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email',$profesor->email) }}"
                                   placeholder="Escribe el email del profesor">
                        </div>
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