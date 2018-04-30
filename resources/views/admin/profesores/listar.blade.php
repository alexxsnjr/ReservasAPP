@extends('admin.layouts.app')

@section('header')

    <h1>
        Profesores
        <small>Todos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Profesores</a></li>
        <li><a href="{{ route('profesores.listar') }}">Listado</a></li>
    </ol>

@endsection

@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listado de profesores</h3>
                <a class="btn btn-success btn-sm pull-right" href="{{ route('profesores.crear') }}"><span class="fa fa-plus"></span>  Crear nuevo profesor</a>
            </div>
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="posts-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th rowspan="1" colspan="1">ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Clave</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($profesores as $profesor)
                                    <tr>
                                        <th scope="row">{{ $profesor->id }}</th>
                                        <td>{{ $profesor->name }}</td>
                                        <td>{{ $profesor->email }}</td>
                                        <td style="text-align: center; font-size: 25px;">
                                            @if(\Hash::check('123456', $profesor->password))

                                                <a class="btn btn-danger btn-sm"><span class="fa fa-unlock"></span> </a>

                                            @else

                                                <a href="{{ route('profesores.restaurarClave',$profesor->id) }}" class="btn btn-success btn-sm"><span class="fa fa-lock"></span> </a>

                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('profesores.editar',$profesor->id) }}" class="btn btn-primary"><span class="fa fa-pencil"></span> Editar</a>

                                            {!! Form::open(['action' => ['ProfesorController@borrar', $profesor->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                                            <button class="btn btn-danger"
                                                    onclick="return confirm('¿Seguro que quiere eliminar este profesor? Se eliminaran tambien sus reservas asociadas.')">
                                                <span class="fa fa-trash"></span> Eliminar
                                            </button>
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