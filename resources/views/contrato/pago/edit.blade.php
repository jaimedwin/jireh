@extends('admin.index')

@section('content')
<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title"><a href="{{route('contrato.pago.index', $contrato_id)}}">{{'Pago'}}</a></h3>
    </div>


    <div class="card-body">
        @include('admin.errors')

        <form action="{{route('contrato.pago.update', ['contrato' => $contrato_id, 'pago' => $pago->id])}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="contrato.pago.abono">{{'Abono *'}}</label>
                        <input type="text" class="form-control" id="contrato.pago.abono" name="abono"
                        value="{{$pago->abono}}">
                    </div>
                    <div class="form-group">
                        <label for="contrato.pago.nrecibo">{{'Número de recibo'}}</label>
                        <input type="text" class="form-control" id="contrato.pago.nrecibo" name="nrecibo"
                        value="{{$pago->nrecibo}}">
                    </div>
                    <div class="form-group">
                        <label for="contrato.pago.fecha">{{'Fecha de recibo *'}}</label>
                        <input class="form-control" type="date" id="contrato.pago.fecha" name="fecha"
                        value="{{$pago->fecha}}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="users_id">users_id</label>
                        <input id="users_id" class="form-control" type="hidden" name="users_id" value="{{ Auth::id()}}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="contrato_id">contrato_id</label>
                        <input id="contrato_id" class="form-control" type="hidden" name="contrato_id"
                            value="{{$contrato_id}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{route('contrato.pago.index', $contrato_id)}}" class="btn btn-secondary" role="button" aria-label="Cancelar">
                        {{'Cancelar'}}
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        {{'Actualizar'}}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection