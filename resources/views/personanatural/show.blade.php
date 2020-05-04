@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('personanatural.index')}}">{{'Persona natural'}}</a></h3>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="table-secondary">{{'#'}}</th>
                            <th class="table-secondary">{{'Campo'}}</th>
                            <th class="table-secondary">{{'Valor'}}</th>
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
                            <td>{{$personanatural->expedicion_municipio}}, {{$personanatural->expedicion_departamento}}</td>
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
                            <td class="table-secondary">{{'Fondo de pensión'}}</td>
                            <td>{{$personanatural->fondodepension}}</td>
                        </tr>
                        <tr>
                            
                            <td class="table-secondary">{{'11.'}}</td>
                            <td class="table-secondary">{{'Eps'}}</td>
                            <td>{{$personanatural->eps}}</td>
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
                                    {{$documento->tipodocumento_id}} - {{$documento->tipodocumento}} 
                                    @if ($documento->nombrearchivo)
                                        <a href="{{route('descargas_otrosdocumentos', 
                                        [
                                            'personanatural' => $personanatural->id, 
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
                            <td class="table-secondary">{{'Proceso(s) y tipo(s) de demanda(s)'}}</td>
                            <td>
                                @foreach ($Clientesproceso as $clienteproceso)
                                {{$clienteproceso->tipodemanda}} | {{$clienteproceso->proceso}} ({{$clienteproceso->estado}}) <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'17.'}}</td>
                            <td class="table-secondary">{{'Términos y condiciones'}}</td>
                            <td>
                                @if ($personanatural->contrato == 0)
                                    <i class="fas fa-times-circle text-danger"></i>
                                @elseif($personanatural->contrato == 1)
                                    <i class="fas fa-check-circle text-success"></i>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="table-secondary">{{'18.'}}</td>
                            <td class="table-secondary">{{'Usuario'}}</td>
                            <td>{{$personanatural->users_id}} - {{$auditoria->email}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'19.'}}</td>
                            <td class="table-secondary">{{'Fecha de creación'}}</td>
                            <td>{{$personanatural->created_at}}</td>
                        </tr>
                        <tr>
                            <td class="table-secondary">{{'20.'}}</td>
                            <td class="table-secondary">{{'Fecha de actualización'}}</td>
                            <td>{{$personanatural->updated_at}}</td>
                        </tr>
                    </tfoot>
                </table>

                <h5>Contrato(s)</h5>   

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="table-secondary">{{'#'}}</th>
                            <th class="table-secondary">{{'Número del contrato'}}</th>
                            <th class="table-secondary">{{'Número del proceso'}}</th>
                            <th class="table-secondary">{{'Tipo del contrato'}}</th>
                            <th class="table-secondary">{{'Valor del contrato'}}</th>
                            <th class="table-secondary">{{'Abono total'}}</th>
                            <th class="table-secondary">{{'Saldo'}}</th>
                            <th style="width: 80px" class="table-secondary text-center">{{'Documento'}}</th>
                        </tr>
                    </thead>
                    <tbody>   
                        @foreach ($Contratos as $contrato)
                        <tr>
                            <td class="table-secondary">{{$loop->iteration}}</td>
                            <td>{{$contrato->numero}}</td>
                            <td>{{$contrato->proceso}}</td>
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