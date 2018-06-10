@extends('admin.layouts.app')

@push('token')
    <meta id="token" name="token" content="{{ csrf_token() }}">
@endpush

@section('header')

    <h1>
        Editar
        <small>Aula</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Aulas</a></li>
        <li><a href="{{ route('aulas.listar') }}">Listado</a></li>
        <li><a href="#">Editar</a></li>
    </ol>

@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar aula</h3>
            </div>

            <form class="form-horizontal" action="{{ route('aulas.update' , $aula->id)}}" method="POST">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Edificio</label>

                        <div class="col-sm-10">
                            <select name="edificio"
                                    class="form-control"
                                    id="edificio"
                                    style="width: 100%;">
                                <option value="">Selecciona un edificio</option>
                                @foreach($edificios as $edificio)
                                    <option value="{{ $edificio->id }}"
                                            {{ old('edificio',$aula->edificio_id) == $edificio->id ? 'selected' : '' }}
                                    >{{ $edificio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Planta</label>

                        <div class="col-sm-10">
                            <select name="planta"
                                    id="planta"
                                    class="form-control"
                                    style="width: 100%;">
                                <option value="">Selecciona un edificio</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre del aula</label>

                        <div class="col-sm-10">
                            <input type="text" name="nombre" class="form-control"
                                   value="{{ old('nombre',$aula->nombre) }}"
                                   placeholder="Escribe el nombre del aula">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo de aula</label>

                        <div class="col-sm-10">
                            <select name="tipo"
                                    class="form-control"
                                    id="tipo"
                                    style="width: 100%;">
                                <option value="">Selecciona un tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->tipo }}"
                                            {{ old('tipo',$aula->tipo) == $tipo->tipo ? 'selected' : '' }}
                                    >{{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Aforo del aula</label>

                        <div class="col-sm-10">
                            <input type="number" name="aforo" class="form-control"
                                   value="{{ old('aforo',$aula->aforo) }}">
                        </div>
                    </div>

                </div>
                <div class="box-footer">

                    <a href="{{ route('aulas.listar') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar aula</button>

                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>

        $('#edificio').ready(sacarPisos).change(sacarPisos);


        function sacarPisos() {

            var edificio_seleccionado = $('#edificio').val();
            //console.log(edificio_seleccionado);

            $.ajax({
                //URL para la petición
                url : '/sacarPisos',

                data : { edificio_id : edificio_seleccionado },

                type : 'POST',

                // el tipo de información que se espera de respuesta
                dataType : 'json',

                beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},

                success : function(json) {

                    $('#planta').html('');
                    $('#planta').append('<option value="">Selecciona una planta</option>');

                    for (var i = 0; i < json.length; i++) {

                        $('#planta').append('<option value="'+json[i].id+'">'+json[i].piso+'</option>');

                    }
                },

            });

        };

    </script>
@endpush
