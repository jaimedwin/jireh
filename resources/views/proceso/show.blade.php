@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.index')}}">{{'Proceso'}}</a></h3>
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
                            <td>{{$proceso->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Código'}}</td>
                            <td>{{$proceso->codigo}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Abreviatura'}}</td>
                            <td>{{$proceso->numero}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Descripción'}}</td>
                            <td>{{$proceso->ciudadproceso_id}} - {{$proceso->ciudadproceso}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Comentario'}}</td>
                            <td>{{$proceso->corporacion_id}} - {{$proceso->corporacion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Comentario'}}</td>
                            <td>{{$proceso->ponente_id}} - {{$proceso->ponente}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Comentario'}}</td>
                            <td>{{$proceso->estado_id}} - {{$proceso->estado}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'8.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$proceso->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'9.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$proceso->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'10.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$proceso->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{route('proceso.index')}}" class="btn btn-secondary" role="button" aria-label="Regresar">
                    {{'Regresar'}}
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection