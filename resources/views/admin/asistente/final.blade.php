@extends('admin.asistente.layouts.layout')

@section('content')

    <h1>!!Enhorabuena, la aplicación ya esta lista para funcionar¡¡</h1>
    <br><br>
    <div class="row">
        <div id="contenedor" class="col-md-6 col-md-offset-3">

            <div class="box box-warning box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Guia de configuración</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h3>Has completado la configuración basica, ahora accederas al panel de administración.</h3>
                    <br>
                    <h4></h4>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin') }}" class="btn btn-info pull-right animsition-link">Terminar</a>
                </div>
            </div>

        </div>
    </div>


    <div id="barra" class="progress active">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100"
             aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only">100% Completado</span>
        </div>
    </div>
@endsection