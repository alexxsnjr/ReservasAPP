@extends('admin.asistente.layouts.layout')

@section('content')

    <h1>Bienvenido al asistente de configuración de la aplicación:</h1>
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
                <h3>Te guiaremos en la configuración basica de la aplicación, para que puedas empezar a utilizarla cuanto antes.</h3>
                <br>
                <h4>¿Estas listo?</h4>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('datosCentro') }}" class="btn btn-info pull-right animsition-link">Continuar</a>
            </div>
        </div>

    </div>
    </div>


    <div id="barra" class="progress active">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="10"
             aria-valuemin="0" aria-valuemax="100" style="width: 10%">
            <span class="sr-only">10% Completado</span>
        </div>
    </div>
@endsection