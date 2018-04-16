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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listado de aulas</h3>
                        <a class="btn btn-success btn-sm pull-right" href="{{ route('aulas.crear') }}"><span class="fa fa-plus"></span>  Crear nueva aula</a>
                    </div>
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="posts-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">ID</th>
                                            <th>Edificio</th>
                                            <th>Planta</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Aforo</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($aulas as $aula)
                                            <tr>
                                                <th scope="row">{{ $aula->id }}</th>
                                                <td>{{ $aula->edificio->nombre }}</td>
                                                <td>{{ $aula->planta->piso }}</td>
                                                <td>{{ $aula->nombre }}</td>
                                                <td>{{ $aula->tipo }}</td>
                                                <td>{{ $aula->aforo }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('aulas.ver',$aula->id) }}" class="btn btn-sm btn-info"><span class="fa fa-eye"></span> Ver más</a>
                                                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="fa fa-angle-down"></span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('aulas.editar',$aula->id) }}" class="btn btn-primary"><span class="fa fa-pencil"></span> Editar</a>
                                                            <br><br>
                                                            {!! Form::open(['action' => ['AulasController@borrar', $aula->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                                                            <button class="btn btn-danger"
                                                                    onclick="return confirm('¿Seguro que quiere eliminar esta aula? Se eliminaran tanto sus equipaciones como sus reservas.')">
                                                                <span class="fa fa-trash"></span> Eliminar
                                                            </button>

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
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