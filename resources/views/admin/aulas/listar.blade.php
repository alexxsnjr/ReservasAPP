@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Listado de aulas
                        <a class="btn btn-success btn-sm pull-right" href="{{ route('aulas.crear') }}"><span class="oi oi-plus"></span> Crear nueva aula</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Edificio</th>
                                <th>Planta</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Aforo</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach($aulas as $aula)
                                <tr>
                                    <th scope="row">{{ $aula->id }}</th>
                                    <td>{{ $aula->edificio->nombre }}</td>
                                    <td>{{ $aula->planta->piso }}</td>
                                    <td>{{ $aula->nombre }}</td>
                                    <td>{{ $aula->tipo }}</td>
                                    <td>{{ $aula->aforo }}</td>
                                    <td>

                                        <a href="{{ route('aulas.editar',$aula->id) }}" class="btn btn-sm btn-primary"><span class="fa fa-pencil"></span></a>

                                        {!! Form::open(['action' => ['AulasController@borrar', $aula->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Seguro que quiere eliminar esta aula?')">
                                            <span class="fa fa-trash"></span>
                                        </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>
@endsection
