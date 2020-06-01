@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('proceso.index')}}">{{'Proceso'}}</a></h3>
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
                            <td>{{$proceso->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Código'}}</td>
                            <td>{{$proceso->codigo}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Número del proceso'}}</td>
                            <td>{{$proceso->numero}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Ciudad del proceso'}}</td>
                            <td>{{$proceso->ciudadproceso_id}} - {{$proceso->ciudadproceso}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Corporación'}}</td>
                            <td>{{$proceso->corporacion_id}} - {{$proceso->corporacion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Ponente'}}</td>
                            <td>{{$proceso->ponente_id}} - {{$proceso->ponente}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Estado'}}</td>
                            <td>{{$proceso->estado_id}} - {{$proceso->estado}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'8.'}}</td>
                            <td class="table-secondary">{{'Documento(s)'}}</td>
                            <td>
                                @foreach ($Documentosproceso as $documentoproceso)
                                    {{$documentoproceso->tipodocumento_id}} - ({{$documentoproceso->tipodocumento}}) {{$documentoproceso->tipodocumento_descripcion}} 
                                    @if ($documentoproceso->nombrearchivo)
                                        <a href="{{route('descargas_proceso_documentos', 
                                        [
                                            'proceso' => $proceso->id, 
                                            'name' => $documentoproceso->nombrearchivo
                                        ])}}" class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'9.'}}</td>
                            <td class="table-secondary">{{'Recordatorio(s)'}}</td>
                            <td>
                                @foreach ($Recordatoriosproceso as $recordatorioproceso)
                                    {{$recordatorioproceso->fecha}} - {{$recordatorioproceso->observacion}} <br>
                                @endforeach
                            </td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'10.'}}</td>
                            <td class="table-secondary">{{'Persona(s) natural(es) '}} <br> {{'y tipo(s) de demanda(s)'}}</td>
                            <td>
                                @foreach ($Clientesproceso as $clienteproceso)
                                    {{$clienteproceso->nombrecompleto}} ({{$clienteproceso->tipodemanda}})<br>
                                @endforeach
                            </td>
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
                
                <h5>Atuacion(es) del proceso</h5>

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="table-secondary">{{'Fecha de actuación'}}</th>
                            <th class="table-secondary">{{'Actuación'}}</th>
                            <th class="table-secondary">{{'Anotación'}}</th>
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
								<a href="{{route('descargas_actuaciones', 
									[
										'proceso' => $proceso->id, 
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