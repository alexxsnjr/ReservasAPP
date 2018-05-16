@extends('admin.layouts.app')

@section('header')

    <h1>
        Importar XML
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-folder"></i> Importar</a></li>
    </ol>

@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Importar ficheros</h3>
            </div>

            <form action="{{ route('importar') }}" method="POST">
                {{ csrf_field() }}

            <div class="box-body">

                <div class="form-goup">
                    <div class="dropzone"></div>
                </div>
                <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo de fichero</label>

                        <div class="col-sm-10">
                            <select name="tipoFichero"
                                    class="form-control"
                                    style="width: 100%;">
                                <option disabled selected>-- Selecciona el tipo de fichero --</option>
                                <option value="aulas">Aulas</option>
                                <option value="usuarios">Usuarios</option>
                                <option value="reservas">Reservas</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="checkbox">
                        <label>
                            <input id='delete' name="confirmar" type="checkbox"> Borrar datos actuales
                        </label>
                    </div>

            </div>
                <div class="box-footer">

                    <button type="submit"
                            class="pull-right btn btn-info">Importar</button>

                </div>

            </form>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <script>
        var myDropzone = new Dropzone('.dropzone', {
            url: '/subir-xml',
            paramName: 'xml',
            acceptedFiles: '.xml',
            maxFilesize: 5,
            maxFiles: '1',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra aquí tu documento XML'
        });
        Dropzone.autoDiscover = false;

    </script>
@endpush