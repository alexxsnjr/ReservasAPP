@extends('admin.layouts.app')


@section('header')
        <h1>
            Inicio
            <small>Panel de control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $reservas }}</h3>

                    <p>Reservas totales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
                <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $reservasHoy }}<sup style="font-size: 20px">%</sup></h3>

                    <p>Porcentaje de reservas para hoy</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $profesores }}</h3>

                    <p>Profesores registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="{{ route('profesores.listar') }}" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $aulas }}</h3>

                    <p>Aulas totales</p>
                </div>
                <div class="icon">
                    <i class="fa fa-university"></i>
                </div>
                <a href="{{ route('aulas.listar') }}" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-md-8">
            <h1>Bienvenido a la aplicación para la gestión de aulas</h1>
        </div>
    </div>
@endsection
