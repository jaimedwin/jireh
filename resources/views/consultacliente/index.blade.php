@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Consultar información del proceso') }}</div>

                <div class="card-body">
                    <form id="consultacliente" method="POST" action="{{ route('consultacliente.validarPost') }}">
                        @csrf
                        @include('admin.errors')
                        @include('admin.success')
                        <div class="form-group row">
                            <label for="cliente.codigo"
                                class="col-md-4 col-form-label text-md-right">{{ __('Código de cliente:') }}</label>

                            <div class="col-md-6">
                                <input id="cliente.codigo" type="text" class="form-control" name="cliente_codigo"
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proceso.codigo"
                                class="col-md-4 col-form-label text-md-right">{{ __('Código de proceso:') }}</label>

                            <div class="col-md-6">
                                <input id="proceso.codigo" type="text" class="form-control" name="proceso_codigo"
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="personanatural.fechaexpedicion"
                                class="col-md-4 col-form-label text-md-right">{{'Contraseña:'}}</label>
                            <div class="col-md-6">
                                <input id="personanatural.fechaexpedicion" type="text" class="form-control"
                                    name="cliente_contraseña" autofocus>
                            </div>
                        </div>
                
                        <div class="form-group row mb-2">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Consultar') }}
                                </button>
                            </div>
                        </div>

                    </form>

                    <script src="https://www.google.com/recaptcha/api.js?render={{config('app.site_key')}}"></script>

                    <script>
                        $('#consultacliente').submit(function(event) {
                            event.preventDefault();
                            var proceso_codigo = $('#proceso.codigo').val();
                            var cliente_codigo = $('#cliente.codigo').val();
                            var cliente_contraseña = $('#personanatural.fechaexpedicion').val();
                            grecaptcha.ready(function() {
                                grecaptcha.execute('{{config('app.site_key')}}', {action: 'consulta_cliente'}).then(function(token) {
                                    $('#consultacliente').prepend('<input type="hidden" name="token" value="' + token + '">');
                                    $('#consultacliente').prepend('<input type="hidden" name="action" value="consulta_cliente">');
                                    $('#consultacliente').unbind('submit').submit();
                                });;
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection