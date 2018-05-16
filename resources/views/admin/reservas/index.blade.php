@extends('admin.layouts.app')

@push('token')
    <meta id="token" name="token" content="{{ csrf_token() }}">
@endpush

@section('header')

    <h1>
        Reservas
        <small>Gestión</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-calendar"></i> Reservas</a></li>
        <li><a href="{{ route('reservas.listar') }}">Listado</a></li>
    </ol>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning" id="cajaInfo" style="display: none;">
                <div class="box-header with-border">
                    <h3 class="box-title">Información de la reserva</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Profesor:</label>

                        <div class="col-sm-4">
                            <label id="profesor"></label>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-success btn-xs" href=""><span class="fa fa-eye"></span></a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Aula:</label>

                        <div class="col-sm-4">
                            <label id="aula"></label>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-success btn-xs" href=""><span class="fa fa-eye"></span></a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Fecha:</label>

                        <div class="col-sm-10">
                            <label id="fecha"></label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Turno:</label>

                        <div class="col-sm-10">
                            <label id="turno"></label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Hora:</label>

                        <div class="col-sm-10">
                            <label id="hora"></label>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="box-footer">

                    <a id="ocultarCajaInfo" class="btn btn-warning pull-left">Cancelar</a>

                    {!! Form::open(['action' => ['ReservasController@borrar', ':ID'], 'method' => 'DELETE', 'style' => 'display:inline;', 'id' => 'formDelete']) !!}

                    <button type="submit" class="btn btn-danger pull-right" onclick="return confirm('¿Seguro que quiere anular esta reserva?')">
                        <span class="fa fa-trash"></span> Anular
                    </button>

                    {!! Form::close() !!}

                </div>
            </div>

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Añadir reserva</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
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

                        <button type="submit" class="btn btn-info pull-right">Guardar aula</button>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR CONFIGURADO EN SCRIPT-->
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

            $('#ocultarCajaInfo').click(function () {

                $('#cajaInfo').fadeOut();

            })

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
                    right : 'month,daily'
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
                        backgroundColor: '{{ $centro->color == 'white' ? 'blue' : $centro->color }}',
                        borderColor    : '{{ $centro->color == 'white' ? 'blue' : $centro->color }}',
                        url:'#{{ $reserva->id }}'
                    },
                    @endforeach
                ],
            })

            $('.fc-day-grid-event').click(function () {

                var enlace = $(this).attr('href');
                var id = enlace.substr(1);

                $.ajax({
                    //URL para la petición
                    url : '/reservas/info',

                    data : { reserva_id : id },

                    type : 'POST',

                    // el tipo de información que se espera de respuesta
                    dataType : 'json',

                    beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},

                    success : function(json) {

                        $('#cajaInfo').fadeIn();

                        $('#profesor').text(json.profesor.name);
                        $('#aula').text(json.aula.nombre);
                        $('#fecha').text(json.fecha);
                        $('#turno').text(json.turno);
                        $('#hora').text(json.hora);

                        var url = $('#formDelete').attr('action').replace(':ID', json.id);

                        $('#formDelete').attr('action',url);

                    },

                });

            });
        })
    </script>
@endpush