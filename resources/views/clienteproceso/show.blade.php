@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('clienteproceso.index')}}">{{'Cliente y proceso'}}</a></h3>
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
                            <td>{{$Clienteproceso->id}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Persona natural'}}</td>
                            <td>{{$Clienteproceso->personanatural_id}} - {{$Clienteproceso->nombrecompleto}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Proceso'}}</td>
                            <td>{{$Clienteproceso->proceso_id}} - {{$Clienteproceso->proceso}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Tipo de demanda'}}</td>
                            <td>{{$Clienteproceso->tipodemanda_id}} - {{$Clienteproceso->tipodemanda}}</td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$Clienteproceso->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$Clienteproceso->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$Clienteproceso->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>

                
                <h5>Cliente</h5>    

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
                            <td class="table-secondary">{{'Código'}}</td>
                            <td>{{$Personanatural->codigo}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Nombre'}}</td>
                            <td>{{$Personanatural->nombres}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Apellido paterno'}}</td>
                            <td>{{$Personanatural->apellidopaterno}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Apellido materno'}}</td>
                            <td>{{$Personanatural->apellidomaterno}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Identificacióm'}}</td>
                            <td>{{$Personanatural->tipodocumentoidentificacion}}. {{$Personanatural->numerodocumento}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Lugar de expedición'}}</td>
                            <td>{{$Personanatural->municipio_id}} - {{$Personanatural->municipio}}, {{$Personanatural->departamento}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Fecha de expedición'}}</td>
                            <td>{{$Personanatural->fechaexpedicion}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'8.'}}</td>
                            <td class="table-secondary">{{'Fecha de nacimiento'}}</td>
                            <td>{{$Personanatural->fechanacimiento}} </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'9.'}}</td>
                            <td class="table-secondary">{{'Dirección'}}</td>
                            <td>{{$Personanatural->direccion}} </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'10.'}}</td>
                            <td class="table-secondary">{{'Eps'}}</td>
                            <td>{{$Personanatural->eps_id}} - {{$Personanatural->eps}}, {{$Personanatural->eps_descripcion}} </td>
                        </tr> 
                        <tr>
                            <td class="table-secondary">{{'11.'}}</td>
                            <td class="table-secondary">{{'Fondo de pensión'}}</td>
                            <td>{{$Personanatural->fondodepension_id}} - {{$Personanatural->fondodepension}} </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'12.'}}</td>
                            <td class="table-secondary">{{'Grado'}}</td>
                            <td>
                                {{$Personanatural->grado_id}} - 
                                @if ($Personanatural->grado == 'NA')
                                    {{$Personanatural->grado}}, {{$Personanatural->carrera}}
                                @else
                                    {{$Personanatural->fuerza}}, {{$Personanatural->carrera}}, {{$Personanatural->grado}} 
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="table-secondary">{{'13.'}}</td>
                            <td class="table-secondary">{{'Correo(s)'}}</td>
                            <td>
                                @foreach ($Correos as $correo)
                                    {{$correo->electronico}} 
                                    @if ($correo->principal == 1)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                        </tr> 
                        <tr>
                            <td class="table-secondary">{{'14.'}}</td>
                            <td class="table-secondary">{{'Telefono(s)'}}</td>
                            <td>
                                @foreach ($Telefonos as $telefono)
                                    ({{$telefono->prefijo}}) {{$telefono->numero}} 
                                    @if ($telefono->principal == 1)
                                        <i class="fas fa-check-circle text-success"></i>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                        </tr> 
                        <tr>
                            <td class="table-secondary">{{'15.'}}</td>
                            <td class="table-secondary">{{'Documento(s)'}}</td>
                            <td>
                                @foreach ($Documentos as $documento)
                                {{$documento->tipodocumento_id}} - ({{$documento->tipodocumento}}) {{$documento->tipodocumento_descripcion}}
                                    @if ($documento->nombrearchivo)
                                        <a href="{{route('descargas_otrosdocumentos', 
                                        [
                                            'personanatural' => $Clienteproceso->personanatural_id, 
                                            'name' => $documento->nombrearchivo
                                        ])}}" class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'16.'}}</td>
                            <td class="table-secondary">{{'Términos y condiciones'}}</td>
                            <td>
                                @if ($Personanatural->contrato == 0)
                                    <i class="fas fa-times-circle text-danger"></i>
                                @elseif($Personanatural->contrato == 1)
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                            </td>
                        </tr>  
                    </tbody>
                </table>

                <h5>Contrato(s)</h5>   

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="table-secondary">{{'#'}}</th>
                            <th class="table-secondary">{{'Número del contrato'}}</th>
                            <th class="table-secondary">{{'Tipo del contrato'}}</th>
                            <th class="table-secondary">{{'Valor del contrato'}}</th>
                            <th class="table-secondary">{{'Abono'}}</th>
                            <th class="table-secondary">{{'Saldo'}}</th>
                            <th style="width: 80px" class="table-secondary text-center">{{'Documento'}}</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach ($Contratos as $contrato)
                        <tr>
                            <td class="table-secondary">{{$loop->iteration}}</td>
                            <td>{{$contrato->numero}}</td>
                            <td>{{$contrato->tipocontrato_id}}, {{$contrato->tipocontrato}}</td>
                            <td class="row_data">{{$contrato->valor}}</td>
                            <td class="row_data">{{$contrato->abono}}</td>
                            <td class="row_data">{{$contrato->valor - $contrato->abono}} </td>
                            <td>
                                @if ($contrato->nombrearchivo)
								<a href="{{route('descargas_otrosdocumentos_contrato', 
                                    [
                                        'personanatural' => $contrato->personanatural_id, 
                                        'name' => $contrato->nombrearchivo
                                    ])}}" class="btn btn-outline-success">
                                                        <i class="fa fa-download"></i>
								</a>
								@endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5>Pago(s)</h5>   

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="table-secondary">{{'#'}}</th>
                            <th class="table-secondary">{{'Número del contrato'}}</th>
                            
                            <th class="table-secondary">{{'Pago'}}<br>{{'Número de recibo'}}</th>
                            <th class="table-secondary">{{'Pago'}}<br>{{'Fecha de recibo'}}</th>
                            <th class="table-secondary">{{'Pago'}}<br>{{'Abono'}}</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach ($Pagos as $pago)
                        <tr>
                            <td class="table-secondary">{{$loop->iteration}}</td>
                            <td>{{$pago->numero}}</td>
                            
                            <td>{{$pago->nrecibo}}</td>
                            <td>{{$pago->fecha}}</td>
                            <td class="row_data">{{$pago->abono}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5>Proceso</h5>   

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
                            <td class="table-secondary">{{'Código'}}</td>
                            <td>{{$Proceso->codigo}}</td>
                        </tr> 
                        <tr>
                            <td class="table-secondary">{{'2.'}}</td>
                            <td class="table-secondary">{{'Número'}}</td>
                            <td>{{$Proceso->numero}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'3.'}}</td>
                            <td class="table-secondary">{{'Ciudad del proceso'}}</td>
                            <td>{{$Proceso->ciudadproceso_id}} - {{$Proceso->ciudadproceso}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'4.'}}</td>
                            <td class="table-secondary">{{'Corporación'}}</td>
                            <td>{{$Proceso->corporacion_id}} - {{$Proceso->corporacion}}</td>
                        </tr>  
                        <tr>
                            <td class="table-secondary">{{'5.'}}</td>
                            <td class="table-secondary">{{'Ponente'}}</td>
                            <td>{{$Proceso->ponente_id}} - {{$Proceso->ponente}}</td>
                        </tr>   
                        <tr>
                            <td class="table-secondary">{{'6.'}}</td>
                            <td class="table-secondary">{{'Estado'}}</td>
                            <td>{{$Proceso->estado_id}} - {{$Proceso->estado}}</td>
                        </tr> 
                        <tr>
                            <td class="table-secondary">{{'7.'}}</td>
                            <td class="table-secondary">{{'Documento(s)'}}</td>
                            <td>
                                @foreach ($Documentosproceso as $documentoproceso)
                                {{$documentoproceso->tipodocumento_id}} - ({{$documentoproceso->tipodocumento}}) {{$documentoproceso->tipodocumento_descripcion}}
                                    @if ($documentoproceso->nombrearchivo)
                                        <a href="{{route('descargas_proceso_documentos', 
                                        [
                                            'proceso' => $Clienteproceso->proceso_id, 
                                            'name' => $documentoproceso->nombrearchivo
                                        ])}}" class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-download"></i>
                                        </a>
                                    @endif<br>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
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
										'proceso' => $Clienteproceso->proceso_id, 
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
                <a href="{{route('clienteproceso.index')}}" class="btn btn-secondary" role="button" aria-label="Regresar">
                    {{'Regresar'}}
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection