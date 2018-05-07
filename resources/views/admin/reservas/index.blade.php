@extends('admin.layouts.app')

@section('header')

    <h1>
        Aulas
        <small>Todas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Aulas</a></li>
        <li><a href="{{ route('aulas.listar') }}">Listado</a></li>
    </ol>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Añadir reserva</h3>
                </div>

                <form class="form-horizontal" action="{{ route('reservas.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Profesor</label>

                            <div class="col-sm-10">
                                <select name="profesor_id"
                                        class="form-control"
                                        id="profesor"
                                        style="width: 100%;">
                                    <option value="">Selecciona un profesor</option>
                                    @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->id }}"
                                                {{ old('profesor_id') == $profesor->id ? 'selected' : '' }}
                                        >{{ $profesor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Aula</label>

                            <div class="col-sm-10">
                                <select name="aula_id"
                                        class="form-control"
                                        id="profesor"
                                        style="width: 100%;">
                                    <option value="">Selecciona un aula</option>
                                    @foreach($aulas as $aula)
                                        <option value="{{ $aula->id }}"
                                                {{ old('aula_id') == $aula->id ? 'selected' : '' }}
                                        >{{ $aula->tipo.' - '.$aula->nombre.' - '.$aula->aforo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="fecha" type="text" class="form-control pull-right" id="datepicker" value="{{ old('fecha') }}">
                                </div>
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

                    </div>
                    <div class="box-footer">

                        <a href="{{ route('aulas.listar') }}" class="btn btn-danger">Volver</a>
                        <button type="submit" class="btn btn-info pull-right">Guardar aula</button>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar" class="fc fc-unthemed fc-ltr"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
    </div>
@endsection
@push('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
@endpush

@push('scripts')

    <!-- bootstrap datepicker -->
    <script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/adminlte/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
    <!-- fullCalendar -->
    <script src="/adminlte/bower_components/moment/moment.js"></script>
    <script src="/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src='/adminlte/bower_components/fullcalendar/dist/locale-all.js'></script>
    <!-- Page specific script -->
    <script>
        $(function () {

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language: 'es',
            })

            //Calendario
            $('#calendar').fullCalendar({
                locale: 'es',
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                },
                //Random default events
                events    : [
                    @foreach($reservas as $reserva)
                    {
                        title          : '{{ $reserva->hora.' - '.$reserva->aula->nombre.' - '.$reserva->profesor->name }}',
                        start          : '{{ $reserva->fecha }}',
                        backgroundColor: '{{ $centro->color }}',
                        borderColor    : '{{ $centro->color }}',
                    },
                    @endforeach
                ],
            })
        })
    </script>
@endpush