@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('corporacion.index')}}">{{'Corporación'}}</a></h3>
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
                            <td>{{$corporacion->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Nombre'}}</td>
                            <td>{{$corporacion->nombre}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Correo de notificación'}}</td>
                            <td>{{$corporacion->correonotificacion}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$corporacion->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$corporacion->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$corporacion->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('corporacion.index')}}" class="btn btn-secondary" role="button" aria-label="Regresar">
                    {{'Regresar'}}
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection