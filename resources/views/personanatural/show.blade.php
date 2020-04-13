@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th style="width: 10px" class="table-secondary">{{'#'}}</th>
                            <th class="table-secondary">{{'Campo'}}</th>
                            <th>{{'Valor'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-secondary">{{'1.'}}</td>
                            <td class="table-secondary">{{'id'}}</td>
                            <td>{{$personanatural->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Código'}}</td>
                            <td>{{$personanatural->codigo}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Nombre completo'}}</td>
                            <td>{{$personanatural->nombrecompleto}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Tipo de documento de identificación'}}</td>
                            <td>{{$personanatural->tipodocumentoidentificacion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Número de documento'}}</td>
                            <td>{{$personanatural->numerodocumento}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Lugar de expedición'}}</td>
                            <td>{{$personanatural->expedicion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Fecha de expedición'}}</td>
                            <td>{{$personanatural->fechaexpedicion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'8.'}}</td>
                            <td class="table-secondary">{{'Fecha de nacimiento'}}</td>
                            <td>{{$personanatural->fechanacimiento}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'9.'}}</td>
                            <td class="table-secondary">{{'Dirección'}}</td>
                            <td>{{$personanatural->direccion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'10.'}}</td>
                            <td class="table-secondary">{{'Eps'}}</td>
                            <td>{{$personanatural->eps}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'11.'}}</td>
                            <td class="table-secondary">{{'Fondo de pensión'}}</td>
                            <td>{{$personanatural->fondodepension}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'12.'}}</td>
                            <td class="table-secondary">{{'Fuerza - Grado'}}</td>
                            <td>
                                @if ($personanatural->grado == 'NA')
                                    {{$personanatural->grado}}
                                @else
                                    {{$personanatural->fuerza}} - {{$personanatural->grado}} 
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'13.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$personanatural->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'14.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$personanatural->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'15.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$personanatural->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('personanatural.index')}}" class="btn btn-secondary" role="button" aria-label="Regresar">
                    {{'Regresar'}}
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection