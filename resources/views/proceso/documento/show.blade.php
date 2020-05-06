@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.documento.index', $proceso_id)}}">{{'Documento'}}</a></h3>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-bordered table-sm">
                    <thead>
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
                            <td>{{$documentoproceso->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Tipo de documento'}}</td>
                            <td>{{$documentoproceso->tipodocumento_id}} - {{$tipodocumento->abreviatura}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Descripción del documento'}}</td>
                            <td>{{$tipodocumento->descripcion}}</td>
                        </tr>c
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Documento'}}</td>
                            <td>{{$documentoproceso->nombrearchivo}}</td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$documentoproceso->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$documentoproceso->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$documentoproceso->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('proceso.documento.index', $proceso_id)}}" class="btn btn-secondary" role="button" aria-label="Regresar">
                    {{'Regresar'}}
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection