@extends('admin.index')

@section('content')
<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
        <div class="card-tools">
            <form action="{{route('personanatural.index')}}" method="get">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="buscar" class="form-control float-right" placeholder="Buscar">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="card-body">

        <div class="row  mb-4">
            <div class="col-12">
                <a href="{{route('personanatural.create')}}" class="btn btn-primary" role="button" aria-label="Buscar">
                    <i class="fas fa-plus-square"></i>
                    {{'Crear nuevo proceso'}}
                </a>
                <div class="float-right">
                    <a href="{{route('personanatural.csv')}}" class="btn btn-success" role="button" aria-label="Csv">
                        <i class="fas fa-download"></i>
                        {{'Descargar CSV'}}
                    </a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5><i class="icon fa fa-check"></i> {{'Alerta!'}}</h5>
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @include('admin.errors')

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th style="width: 10px">{{'#'}}</th>
                            <th>{{'Código'}}</th>
                            <th>{{'Nombre completo'}}</th>
                            <th>{{'Documento de identificación'}}</th>
                            <th>{{'Número de documento'}}</th>
                            <th>{{'Lugar de expedición'}}</th>
                            <th>{{'Fecha de expedición'}}</th>
                            <th>{{'Fecha de nacimiento'}}</th>
                            <th>{{'Dirección'}}</th>
                            <th>{{'Eps'}}</th>
                            <th>{{'Fondo de pensión'}}</th>
                            <th>{{'Fuerza -Grado'}}</th>
                            <th style="width: 80px" class="text-center">{{'Telefono'}}</th>
                            <th style="width: 80px" class="text-center">{{'Correo'}}</th>
                            <th style="width: 160px" class="text-center">{{'Acciones'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Personasnaturales as $personanatural)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$personanatural->codigo}}</td>
                            <td>{{$personanatural->nombrecompleto}}</td>
                            <td>{{$personanatural->tipodocumentoidentificacion}}</td>
                            <td>{{$personanatural->numerodocumento}}</td>
                            <td>{{$personanatural->expedicion}}</td>
                            <td>{{$personanatural->fechaexpedicion}}</td>
                            <td>{{$personanatural->fechanacimiento}}</td>
                            <td>{{$personanatural->direccion}}</td>
                            <td>{{$personanatural->eps}}</td>
                            <td>{{$personanatural->fondodepension}}</td>
                            <td>
                                @if ($personanatural->grado == 'NA')
                                    {{$personanatural->grado}}
                                @else
                                    {{$personanatural->fuerza}} - {{$personanatural->grado}} 
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{route('personanatural.telefono.index', $personanatural->id)}}"
                                    class="btn btn-outline-success" role="button" aria-label="Pagos">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{route('personanatural.correo.index', $personanatural->id)}}"
                                    class="btn btn-outline-success" role="button" aria-label="Pagos">
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{route('personanatural.destroy', $personanatural->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{route('personanatural.show', $personanatural->id)}}" class="btn btn-info"
                                            role="button" aria-label="Mostrar">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('personanatural.edit', $personanatural->id)}}"
                                            class="btn btn-warning" aria-label="Editar">
                                            <i class="fas fa-pen" aria-hidden="true"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger" aria-label="Borrar"
                                            onclick="return confirm('¿Realmente desea eliminar?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-right">{{$Personasnaturales->links()}}</div>
    </div>
</div>
@endsection