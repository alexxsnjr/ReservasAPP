@extends('admin.layouts.app')

@section('content')

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crea aula</h3>
                    </div>

                    <form class="form-horizontal" action="{{ route('aulas.store') }}" method="POST">
                            {{ csrf_field() }}

                        <div class="box-body">

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Edificio</label>

                            <div class="col-sm-10">
                                <select name="edificio[]"
                                        class="form-control"
                                        id="edificio"
                                        style="width: 100%;">
                                    <option value="">Selecciona un edificio</option>
                                    @foreach($edificios as $edificio)
                                        <option {{ collect(old('edificio'))->contains($edificio->id) ? 'selected' : '' }}
                                                value="{{ $edificio->id }}"
                                                {{ old('edificio') == $edificio->id ? 'selected' : '' }}
                                        >{{ $edificio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Planta</label>

                            <div class="col-sm-10">
                                <select name="planta[]"
                                        class="form-control"
                                        style="width: 100%;">
                                    <option value="">Selecciona una planta</option>
                                    @foreach($edificios as $edificio)
                                        <option {{ collect(old('edificio'))->contains($edificio->id) ? 'selected' : '' }}
                                                value="{{ $edificio->id }}"
                                                {{ old('edificio') == $edificio->id ? 'selected' : '' }}
                                        >{{ $edificio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre del aula</label>

                            <div class="col-sm-10">
                                <input type="text" name="nombre" class="form-control"
                                       value="{{ old('nombre') }}"
                                       placeholder="Escribe el nombre del aula">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aforo del aula</label>

                            <div class="col-sm-10">
                                <input type="number" name="aforo" class="form-control"
                                       value="{{ old('aforo') }}">
                            </div>
                        </div>

                        </div>
                        <div class="box-footer">

                            <button type="submit" class="btn btn-danger">Volver</button>
                            <button type="submit" class="btn btn-info pull-right">Guardar aula</button>

                        </div>

                    </form>
                </div>
            </div>

@endsection
@push('scripts')
    <script>

        $('#edificio').change(function() {

            var edificio_seleccionado = $('#edificio').val();
            console.log(edificio_seleccionado);

            $.ajax({
            //URL para la petición
            url : '/aulas/sacarPisos',

            data : { edificio_id : edificio_seleccionado },
                
            type : 'POST',

            // el tipo de información que se espera de respuesta
            dataType : 'json',
            });

        });

    </script>
@endpush
