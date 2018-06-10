@extends('admin.layouts.app')

@section('header')

    <h1>
        Ver
        <small>Aula</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Aulas</a></li>
        <li><a href="{{ route('aulas.listar') }}">Listado</a></li>
        <li><a href="#">Ver</a></li>
    </ol>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nombre: <b>{{ $profesor->name }}</b></h3>
                </div>

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">ID</label>

                        {{ $profesor->id }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nombre</label>

                        {{ $profesor->name }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label>

                        {{ $profesor->email }}
                    </div>

                </div>
                <div class="box-footer">

                    <a href="{{ route('profesores.editar',$profesor->id) }}" class="btn btn-primary"><span class="fa fa-pencil"></span> Editar profesor</a>

                    {!! Form::open(['action' => ['ProfesorController@borrar', $profesor->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                    <button class="btn btn-danger pull-right"
                            onclick="return confirm('¿Seguro que quiere eliminar este profesor? Se eliminaran todas sus reservas')">
                        <span class="fa fa-trash"></span> Eliminar profesor
                    </button>

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Horario del profesor</h3>
                    <a class="btn btn-success btn-sm pull-right" href="{{ route('horario.crear',$profesor->id) }}"><span class="fa fa-plus"></span>  Añadir nuevo horario</a>
                </div>
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="posts-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1">ID</th>
                                        <th>Nombre aula</th>
                                        <th>Dia de la semana</th>
                                        <th>Turno</th>
                                        <th>Hora</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($profesor->horario as $horario)
                                        <tr>
                                            <th scope="row">{{ $horario->id }}</th>
                                            <td>{{ $horario->aula->nombre }}</td>
                                            <td>{{ $horario->dia_semana }}</td>
                                            <td>{{ $horario->turno }}</td>
                                            <td>{{ $horario->hora }}</td>
                                            <td>
                                                <a href="{{ route('horario.editar',$horario->id) }}" class="btn btn-sm btn-primary"><span class="fa fa-pencil"></span></a>

                                                {!! Form::open(['action' => ['HorariosController@borrar', $horario->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Seguro que quiere eliminar este horario?')">
                                                    <span class="fa fa-trash"></span>
                                                </button>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#posts-table').DataTable({
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endpush

