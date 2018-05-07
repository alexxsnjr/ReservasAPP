@extends('admin.asistente.layouts.layout')

@section('content')

    <h1>¡Muy bien, ya has registrado tu centro en la aplicación!</h1>
    <h2>El siguiente paso es personalizar el sistema un poco:</h2>
    <br><br>
    <div class="row">
        <div id="contenedor" class="col-md-6 col-md-offset-3">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div id="fondo" class="widget-user-header bg-blue-active">
                    <h3 class="widget-user-username">{{ $centro->nombre }}</h3>
                    <h5 class="widget-user-desc">{{ $centro->email }}</h5>
                    <h3 class="pull-right widget-user-username" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-color"><i class="fa fa-edit"></i></h3>
                </div>
                <div class="widget-user-image">
                    <img id="imagen" data-toggle="modal" data-target="#modal-imagen" data-backdrop="static" data-keyboard="false" class="img-circle" src="/img/subirFoto.jpg" alt="Logo centro">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <a href="{{ route('asistente.importarDatos') }}" class="btn btn-default animsition-link">Omitir</a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">



                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <form class="form-horizontal" action="{{ route('datosCentro.color' , $centro->id)}}" method="POST">
                                {{ csrf_field() }}{{ method_field('PUT') }}

                                    <input id="colorEnvio" type="hidden" name="color">

                                    <button type="submit" class="btn btn-info">Continuar</button>

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
                                    <i class="icono fa fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="caja">
                                <div id="white" class="color bg-white-active">
                                </div>
                            </div>
                            <div class="caja">
                                <div id="purple" class="color bg-purple-active">
                                </div>
                            </div>
                            <div class="caja">
                                <div id="green" class="color bg-green-active">
                                </div>
                            </div>
                            <div class="caja">
                                <div id="red" class="color bg-red-active">
                                </div>
                            </div>
                            <div class="caja">
                                <div id="yellow" class="color bg-yellow-active">
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
    <div id="barra" class="progress active">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="60"
             aria-valuemin="0" aria-valuemax="100" style="width: 60%">
            <span class="sr-only">60% Completado</span>
        </div>
    </div>
@endsection
@push('styles')
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

        $('#colorEnvio').val('blue');

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