@extends('admin.layouts.app')

@section('header')

    <h1>
        Importar XML
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-university"></i> Aulas</a></li>
        <li><a href="#">Importar</a></li>
    </ol>

@endsection

@section('content')
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ route('aulas.importar') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-goup">
                                <div class="dropzone"></div>
                            </div><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Importar a base de datos</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <script>
        var myDropzone = new Dropzone('.dropzone', {
            url: '/aulas/subir-xml',
            paramName: 'xml',
            acceptedFiles: '.xml',
            maxFilesize: 0.05,
            maxFiles: '1',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra aquí tu documento XML para importar las aulas'
        });
        Dropzone.autoDiscover = false;
    </script>
@endpush