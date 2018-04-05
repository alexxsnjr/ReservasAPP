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
                <h3 class="box-title">Aula: <b>{{ $aula->nombre }}</b></h3>
            </div>

            <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">ID</label>

                            {{ $aula->id }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Edificio</label>

                            {{ $aula->edificio->nombre }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Planta</label>

                            {{ $aula->planta_id }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nombre del aula</label>

                            {{ $aula->nombre }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tipo de aula</label>

                            {{ $aula->tipo }}
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Aforo del aula</label>

                            {{ $aula->aforo }}

                    </div>

            </div>
            <div class="box-footer">

                <a href="{{ route('aulas.editar',$aula->id) }}" class="btn btn-primary"><span class="fa fa-pencil"></span> Editar aula</a>

                {!! Form::open(['action' => ['AulasController@borrar', $aula->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                <button class="btn btn-danger pull-right"
                        onclick="return confirm('¿Seguro que quiere eliminar esta aula? Se eliminaran tanto sus equipaciones como sus reservas.')">
                    <span class="fa fa-trash"></span> Eliminar aula
                </button>

                {!! Form::close() !!}

            </div>

        </div>
    </div>
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Equipamientos del aula</h3>
                <a class="btn btn-success btn-sm pull-right" href="#"><span class="fa fa-plus"></span>  Añadir nuevo equipamiento</a>
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
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aula->equipamiento as $equipamiento)
                                    <tr>
                                        <th scope="row">{{ $equipamiento->id }}</th>
                                        <td>{{ $equipamiento->nombre }}</td>
                                        <td>{{ $equipamiento->cantidad }}</td>
                                        <td>

                                            <a href="{{ route('aulas.editar',$equipamiento->id) }}" class="btn btn-sm btn-primary"><span class="fa fa-pencil"></span></a>

                                            {!! Form::open(['action' => ['AulasController@borrar', $equipamiento->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Seguro que quiere eliminar esta aula? Se eliminaran tanto sus equipaciones como sus reservas.')">
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

