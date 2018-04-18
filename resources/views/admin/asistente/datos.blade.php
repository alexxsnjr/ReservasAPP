@extends('admin.asistente.layouts.layout')

@section('content')

    <h1>El primer paso es introducir los datos del centro:</h1>
    <br><br>
    <div class="row">
        <div id="contenedor" class="col-md-6 col-md-offset-3">

            @include('admin.partials.mensajes')

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del centro</h3><p>Estos datos seran visibles en la parte publica</p>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('datosCentro.store') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>

                            <div class="col-sm-10">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Descripción</label>

                            <div class="col-sm-10">
                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Continuar</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    <div id="barra" class="progress active">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="30"
             aria-valuemin="0" aria-valuemax="100" style="width: 30%">
            <span class="sr-only">30% Completado</span>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $('#nombre').keyup(function(){

            if(this.value.length>3 && this.value.length<50){

                $('.form-group').eq(0).removeClass('has-error');
                $('.form-group').eq(0).addClass('has-success');

            }else{

                $('.form-group').eq(0).removeClass('has-success')[0];
                $('.form-group').eq(0).addClass('has-error')[0];

            }

        });

        $('#email').keyup(function(){

            if(this.value.length>3 && this.value.length<50){

                $('.form-group').eq(1).removeClass('has-error')[1];
                $('.form-group').eq(1).addClass('has-success')[1];

            }else{

                $('.form-group').eq(1).removeClass('has-success')[1];
                $('.form-group').eq(1).addClass('has-error')[1];

            }

        });

        $('#descripcion').keyup(function(){

            if(this.value.length>10 && this.value.length<200){

                $('.form-group').eq(2).removeClass('has-error')[1];
                $('.form-group').eq(2).addClass('has-success')[1];

            }else{

                $('.form-group').eq(2).removeClass('has-success')[1];
                $('.form-group').eq(2).addClass('has-error')[1];

            }

        });

    </script>
@endpush