@extends('admin.layouts.app')

@section('header')

    <h1>
        Editar
        <small>Equipamiento</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Aulas</a></li>
        <li><a href="{{ route('aulas.listar') }}">Listado</a></li>
        <li><a href="{{ route('aulas.ver',$equipamiento->aula_id) }}">Ver aula</a></li>
        <li><a href="#">Editar equipamiento</a></li>
    </ol>

@endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Editar equipamiento</h3>
            </div>

            <form class="form-horizontal" action="{{ route('equipamiento.update',$equipamiento->id) }}" method="POST">
                {{ csrf_field() }}{{ method_field('PUT') }}

                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <select name="nombres[]"
                                    class="form-control select2"
                                    data-placeholder="Selecciona una o más etiquetas"
                                    style="width: 100%;">
                                @foreach($tipos as $tipo)
                                    <option {{ collect(old('nombres',$equipamiento->nombre))->contains($tipo->nombre) ? 'selected' : '' }}
                                            value="{{ $tipo->nombre }}"
                                            {{ old('nombres',$equipamiento->nombre) == $tipo->nombre ? 'selected' : '' }}
                                    >{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cantidad</label>

                        <div class="col-sm-10">
                            <input type="number" name="cantidad" class="form-control"
                                   value="{{ old('cantidad',$equipamiento->cantidad) }}">
                        </div>
                    </div>
                </div>
                <div class="box-footer">

                    <a href="{{ route('aulas.ver',$equipamiento->aula_id) }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar equipamiento</button>

                </div>

            </form>
        </div>
    </div>

@endsection
@push('styles')
    <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endpush
@push('scripts')
    <script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2({
            tags: true
        })
    </script>
@endpush