@extends('layouts.app2')

@section('content')
<div class="container mb-10">
    <div class="row justify-content-center table-responsive-sm">
        <div class="col-md-12 mb-4">
            <a href="{{route('consultacliente.deleteCookies')}}" class="btn btn-secondary float-right">
                <i class="nav-icon fas fa-sign-out-alt mr-2"></i> Cerrar consulta
            </a>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">{{ __('Proceso') }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th colspan="2" class="table-secondary">{{'Número del proceso'}}</th>
                                <th class="table-secondary">{{'Ciudad del proceso'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">{{$Proceso->numero}}</td>
                                <td>{{$Proceso->ciudadproceso}}</td>
                            </tr>   
                        </tbody>
                        <thead>
                            <tr>
                                <th class="table-secondary">{{'Corporación'}}</th>
                                <th class="table-secondary">{{'Ponente'}}</th>
                                <th class="table-secondary">{{'Estado'}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$Proceso->corporacion}}</td>
                                <td>{{$Proceso->ponente}}</td>
                                <td>{{$Proceso->estado}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Actuacion(es)') }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="table-secondary">{{'Fecha de actuacion'}}</th>
                                <th class="table-secondary">{{'Actuacion'}}</th>
                                <th class="table-secondary">{{'Anotacion'}}</th>
                                <th class="table-secondary">{{'Fecha inicia termino'}}</th>
                                <th class="table-secondary">{{'Fecha finaliza termino'}}</th>
                                <th class="table-secondary">{{'Fecha registro'}}</th>
                                <th class="table-secondary">{{'Documento'}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($Actuacionesproceso as $actuacionproceso)
                            <tr>
                                <td>{{$actuacionproceso->fechaactuacion}}</td>
                                <td>{{$actuacionproceso->actuacion}}</td>
                                <td>{{$actuacionproceso->anotacion}}</td>
                                <td>{{$actuacionproceso->fechainiciatermino}}</td>
                                <td>{{$actuacionproceso->fechafinalizatermino}}</td>
                                <td>{{$actuacionproceso->fecharegistro}}</td>
                                <td class="text-center">
                                    @if ($actuacionproceso->nombrearchivo)
                                    <a href="{{route('consultacliente.descargas', 
                                        [
                                            'proceso' => $Proceso->id, 
                                            'name' => $actuacionproceso->nombrearchivo
                                        ])}}" class="btn btn-outline-success">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
