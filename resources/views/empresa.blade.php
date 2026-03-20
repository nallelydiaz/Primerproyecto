@extends('layouts.app')
@section('titulopagina','Empresa E-commerce')
@push('css')
    <style>
        .fondo {
            background: #302886;
        }

        .img-responsive{
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@section('titulo')
    Bienvenido al la página de EC
@endsection

@section('subtitulo')
    Explorando las oportunidades con Laravel 12
@endsection

@section('link1','Active')
@section('titulo1')
    <h1>About Me</h1>
@endsection
@section("descripcion_about")
    {{$descripcion_about}}
@endsection
@section("Autor")
    {{$nombre}}
@endsection
@section("actividad",$actividad)
@section("texto_ejemplo")
    {{$texto_ejemplo}}
@endsection
@section("contenido_listado")
    <h2>Listado de Usuarios Registrados</h2>
    <ul>
        @if(isset($listadousuarios))
            <table id='tablausuarios' class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Calle</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listadousuarios as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->telefono}}</td>
                        <td>{{$usuario->calle}}</td>
                        <td>
                        <button class='btn btn-primary' onclick="carga_modal({{$usuario->id}},'{{$usuario->name}}', '{{$usuario->calle}}')" data-id="{{$usuario->id}}"
                        data-nombre="{{$usuario->name}}" data-calle="{{$usuario->calle}}"
                        data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil"></span>
                        </button>
                        {{-- Botón Eliminación Lógica (cambia is_active a 0) --}}
                        <button class='btn btn-warning' 
                        onclick="eliminacion_logica({{$usuario->id}})">
                        <span class="fa fa-eye-slash"></span>
                        </button>

                        {{-- Botón Eliminación Física (borra el registro de la BD) --}}
                        <button class='btn btn-danger' 
                        onclick="eliminacion_fisica({{$usuario->id}})">
                        <span class="fa fa-trash"></span>
                        </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>La variable de listado de usuarios no está definida</p>
        @endif
    </ul>
@endsection
            

