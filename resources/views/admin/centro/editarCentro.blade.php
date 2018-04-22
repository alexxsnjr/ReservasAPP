@extends('admin.layouts.app')

@push('token')
    <meta id="token" name="token" content="{{ csrf_token() }}">
@endpush
@section('header')
    <h1>
        Centro
        <small>Editar datos y preferencias</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    </ol>
@endsection
@section('content')

    <div class="row">
        <div id="contenedor" class="col-md-6 col-md-offset-3">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div id="fondo" class="widget-user-header bg-{{centro()->color ? centro()->color : 'blue'}}-active">
                    <h3 id="nombreCentro" class="widget-user-username">{{ centro()->nombre }}</h3>
                    <h5 class="widget-user-desc">{{ centro()->email }}</h5>
                    <h3 class="pull-right widget-user-username" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-color"><i class="fa fa-edit"></i></h3>
                </div>
                <div class="widget-user-image">
                    <img id="imagen" data-toggle="modal" data-target="#modal-imagen" data-backdrop="static" data-keyboard="false" class="img-circle" src="{{centro()->imagen ? centro()->imagen : '/img/centroPredefinido.jpg' }}" alt="Logo centro">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-12 border-right">
                            <div class="description-block">
                                <form class="form-horizontal" action="{{ route('centro.update' , centro()->id)}}" method="POST">
                                {{ csrf_field() }}{{ method_field('PUT') }}

                                    <br>
                                    <label class="pull-left">Nombre del centro:</label>

                                    <input type="text" name="nombre" class="form-control"
                                               value="{{ old('nombre',centro()->nombre) }}">
                                    <br>
                                    <label class="pull-left">Email del centro:</label>

                                    <input type="text" name="email" class="form-control"
                                           value="{{ old('email',centro()->email) }}">
                                    <br>
                                    <label class="pull-left">Descripción del centro:</label>
                                    <br>
                                    <textarea type="text" name="descripcion" class="form-control">{{ old('descripcion',centro()->descripcion) }}</textarea>

                                    <input id="colorEnvio" type="hidden" name="color" value="{{centro()->color ? centro()->color : 'blue'}}">
                                    <br>
                                    <button type="submit" class="btn btn-info pull-right">Guardar</button>

                                </form>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>


            <div class="modal fade" id="modal-imagen">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar imagen</h4>
                        </div>
                        <div class="modal-body">
                            <div class="dropzone"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="recargarImagen" type="button" data-dismiss="modal" class="btn btn-info" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-color">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Escoge color</h4>
                        </div>
                        <div class="modal-body">
                            <div class="caja">
                                <div id="blue" class="color bg-blue-active">
                                    {!! centro()->color==('blue') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <div class="caja">
                                <div id="white" class="color bg-white-active">
                                    {!! centro()->color==('white') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <div class="caja">
                                <div id="purple" class="color bg-purple-active">
                                    {!! centro()->color==('purple') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <div class="caja">
                                <div id="green" class="color bg-green-active">
                                    {!! centro()->color==('green') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <div class="caja">
                                <div id="red" class="color bg-red-active">
                                    {!! centro()->color==('red') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <div class="caja">
                                <div id="yellow" class="color bg-yellow-active">
                                    {!! centro()->color==('yellow') ? '<i class="icono fa fa-check-circle"></i>' : '' !!}
                                </div>
                            </div>
                            <br><br><br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <script>
        var myDropzone = new Dropzone('.dropzone', {
            url: '/subir-imagen',
            paramName: 'img',
            acceptedFiles: 'image/*',
            maxFilesize: 15,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra o pincha para subir tu imagen'
        });
        Dropzone.autoDiscover = false;

        $('#recargarImagen').click(function(){

            $.ajax({
                //URL para la petición
                url : '/recargarimagen',

                type : 'GET',

                // el tipo de información que se espera de respuesta
                dataType : 'json',

                success : function(json) {

                    if(json.imagen!=null) {
                        $('#imagen').attr('src', json.imagen);
                    }

                }

            });

        });

        $('#colorEnvio').val();

        $('.color').click(function(){

            $('.color').html('');
            $(this).html('<i class="icono fa fa-check-circle"></i>');

            var colorAntiguo = $('#colorEnvio').val();
            var colorNuevo = $(this).attr('id');

            $('#fondo').removeClass('bg-'+colorAntiguo+'-active').addClass('bg-'+colorNuevo+'-active');

            $('#colorEnvio').val(colorNuevo);

        });

    </script>
@endpush