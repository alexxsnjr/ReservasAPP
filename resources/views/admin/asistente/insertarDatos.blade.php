@extends('admin.asistente.layouts.layout')

@section('content')

    <h1>Por ultimo puedes importar tus ficheros para generar la base de datos</h1>
    <h2>Recuerda que puedes hacerlo en cualquier momento desde la administración</h2>
    <br><br>
    <div class="row">
        <div id="contenedor" class="col-md-6 col-md-offset-3">

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-{{ $centro[0]->color ? $centro[0]->color : 'blue' }}">
                    <div class="widget-user-image">
                        <img id="imagen" class="img-circle" style="margin-right: 10px;" src="{{ $centro[0]->imagen ? $centro[0]->imagen : '/img/subirFoto.jpg' }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $centro[0]->nombre }}</h3>
                    <h5 class="widget-user-desc">{{ $centro[0]->email }}</h5>
                    <br><br>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a id="aulas" data-toggle="modal" data-target="#modal-ficheros">Aulas <span class="pull-right badge bg-red"><i class="fa fa-times"></i></span></a></li>
                        <li><a id="usuarios"data-toggle="modal" data-target="#modal-ficheros">Usuarios <span class="pull-right badge bg-red"><i class="fa fa-times"></i></span></a></li>
                    </ul>
                </div>
                <div class="box-footer no-padding">

                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <div class="description-block">
                                <a href="{{ route('asistenteTerminar') }}" class="btn btn-info animsition-link">Continuar</a>

                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
            </div>

            <div class="modal fade" id="modal-ficheros">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="dropzone"></div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('importar') }}" method="POST">
                                {{ csrf_field() }}
                            <input id="tipoXML" type="hidden" name="tipoFichero">

                            <button type="submit" class="btn btn-info">Importar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="barra" class="progress active">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="80"
             aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            <span class="sr-only">80% Completado</span>
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
            url: '/subir-xml',
            paramName: 'xml',
            acceptedFiles: '.xml',
            maxFilesize: 0.05,
            maxFiles: '1',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra aquí tu documento XML'
        });
        Dropzone.autoDiscover = false;

        $('#aulas').click(function(){

            $('h4').text('Sube el fichero XML para aulas');

            $('#tipoXML').val('aulas');

        });

        $('#usuarios').click(function(){

            $('h4').text('Sube el fichero XML para usuarios');

            $('#tipoXML').val('usuarios');

        });


        $.ajax({
                //URL para la petición
                url : '/consultardatos',

                type : 'GET',

                // el tipo de información que se espera de respuesta
                dataType : 'json',

                success : function(json) {

                    console.log(json);

                    if(json.aulas=='1'){

                        $('#aulas').children().removeClass('badge bg-red').addClass('badge bg-green');
                        $('#aulas').children().children().removeClass('fa-times').addClass('fa-check');

                    }

                    if(json.usuarios=='1'){

                        $('#usuarios').children().removeClass('badge bg-red').addClass('badge bg-green');
                        $('#usuarios').children().children().removeClass('fa-times').addClass('fa-check');

                    }

                }

        });

    </script>
@endpush