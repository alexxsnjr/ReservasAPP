@extends('admin.layouts.app')

@section('header')

    <h1>
        Añadir
        <small>Nuevo horario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Profesores</a></li>
        <li><a href="{{ route('profesores.listar') }}">Listado</a></li>
        <li><a href="{{ route('profesores.horario',$profesor_id) }}">Ver horario</a></li>
        <li><a href="#">Añadir horario</a></li>
    </ol>

@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Añadir horario</h3>
            </div>

            <form class="form-horizontal" action="{{ route('horario.store',$profesor_id) }}" method="POST">
                {{ csrf_field() }}

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Aula</label>

                        <div class="col-sm-10">
                            <select name="aula"
                                    class="form-control"
                                    data-placeholder="Selecciona un aula"
                                    style="width: 100%;">
                                <option value="">Selecciona un aula</option>
                                @foreach($aulas as $aula)
                                    <option {{ old('aula')==$aula->id ? 'selected' : '' }}
                                            value="{{ $aula->id }}"
                                    >{{ $aula->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dia</label>

                        <div class="col-sm-10">
                            <select name="dia"
                                    class="form-control"
                                    id="dia"
                                    style="width: 100%;">
                                <option value="">Selecciona un dia</option>
                                <option value="1" {{ old('dia') == '1' ? 'selected' : '' }}>Lunes</option>
                                <option value="2" {{ old('dia') == '2' ? 'selected' : '' }}>Martes</option>
                                <option value="3" {{ old('dia') == '3' ? 'selected' : '' }}>Miercoles</option>
                                <option value="4" {{ old('dia') == '4' ? 'selected' : '' }}>Jueves</option>
                                <option value="5" {{ old('dia') == '5' ? 'selected' : '' }}>Viernes</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hora</label>

                        <div class="col-sm-10">
                            <select name="hora"
                                    class="form-control"
                                    id="hora"
                                    style="width: 100%;">
                                <option value="">Selecciona una hora</option>
                                <option value="1" {{ old('hora') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('hora') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('hora') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('hora') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('hora') == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ old('hora') == '6' ? 'selected' : '' }}>6</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Turno</label>

                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="turno" id="optionsRadios1" value="manana" {{ old('turno') == 'manana' ? 'checked' : '' }}>
                                    Mañana
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="turno" id="optionsRadios2" value="tarde" {{ old('turno') == 'tarde' ? 'checked' : '' }}>
                                    Tarde
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">

                    <a href="{{ route('profesores.horario',$profesor_id) }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar horario</button>

                </div>

            </form>
        </div>
    </div>

@endsection