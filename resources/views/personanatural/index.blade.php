@extends('admin.index')

@section('content')
<div class="card card-secondary">

    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
        <div class="card-tools">
            <form action="{{route('personanatural.index')}}" method="get" autocomplete="off">
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
                @include('admin.descarga_csv',
                [
                'route_name' => 'personanatural.csv',
                'parameter' => [''],
                'title_btn' => 'Descargar CSV'
                ])
            </div>
        </div>

        @include('admin.success')
		@include('admin.errors')

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">{{'#'}}</th>
                            <th>{{'Código'}}</th>
                            <th>{{'Nombre completo'}}</th>
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
                            <td>
                                <p>{{$personanatural->tipodocumentoidentificacion}} {{$personanatural->numerodocumento}}
                                </p>
                            </td>
                            <td>{{$personanatural->expedicion_municipio}}, {{$personanatural->expedicion_departamento}}
                            </td>
                            <td>{{$personanatural->fechaexpedicion}}</td>
                            <td>{{$personanatural->fechanacimiento}}</td>
                            <td>{{$personanatural->direccion}}</td>
                            <td>{{$personanatural->fondodepension}}</td>
                            <td>{{$personanatural->eps}}</td>
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
                                        <a href="{{route('personanatural.show', $personanatural->id)}}"
                                            class="btn btn-info" role="button" aria-label="Mostrar">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('personanatural.edit', $personanatural->id)}}"
                                            class="btn btn-warning" aria-label="Editar">
                                            <i class="fas fa-pen" aria-hidden="true"></i>
                                        </a>
                                        @include('admin.btn_delete')
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

    <div class="card-footer clearfix">
        <div class="float-right">{{$Personasnaturales->links()}}</div>
    </div>
</div>
@endsection