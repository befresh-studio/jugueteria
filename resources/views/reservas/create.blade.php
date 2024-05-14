@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Insertar nueva reserva') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('reservas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('reservas.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="cliente" class="col-md-4 col-form-label text-md-end text-start">{{ __('Cliente') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('clientes_id') is-invalid @enderror" id="cliente" name="{{ ($cliente ? 'clientes' : 'clientes_id') }}"{{ ($cliente ? ' disabled' : '') }}>
                                <option value="">{{ __('Seleccione un cliente') }}</option>
                                @foreach($clientes as $cada_cliente)
                                    <option value="{{ $cada_cliente->id }}"{{ ($cliente != NULL ? ($cliente->id == $cada_cliente->id ? ' selected' : ($cada_cliente->id == old('clientes_id') ? ' selected' : '')) : '') }}>{{ $cada_cliente->nombre }} {{ $cada_cliente->apellidos }}</option>
                                @endforeach
                            </select>
                            @if($cliente)
                                <input type="hidden" name="clientes_id" value="{{ $cliente->id }}" />
                            @endif
                            @if ($errors->has('clientes_id'))
                                <span class="text-danger">{{ $errors->first('clientes_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="iva_aplicado" class="col-md-4 col-form-label text-md-end text-start">{{ __('% IVA') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('iva_aplicado') is-invalid @enderror" id="iva_aplicado" name="iva_aplicado">
                                @foreach($ivas as $iva)
                                    <option value="{{ $iva->value }}"{{ ($iva->value == old('iva_aplicado') ? ' selected' : '') }}>{{ $iva->value }}%</option>
                                @endforeach
                            </select>
                            @if ($errors->has('iva_aplicado'))
                                <span class="text-danger">{{ $errors->first('iva_aplicado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="iva" class="col-md-4 col-form-label text-md-end text-start">{{ __('IVA') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('iva') is-invalid @enderror" id="iva" name="iva_total" value="{{ (old('iva') ?? 0) }}">
                            @if ($errors->has('iva'))
                                <span class="text-danger">{{ $errors->first('iva') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start">{{ __('Importe total') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('importe_total') is-invalid @enderror" id="importe_total" name="importe_total" value="{{ old('importe_total') }}">
                            @if ($errors->has('importe_total'))
                                <span class="text-danger">{{ $errors->first('importe_total') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="importe_pagado" class="col-md-4 col-form-label text-md-end text-start">{{ __('Importe pagado') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('importe_pagado') is-invalid @enderror" id="importe_pagado" name="importe_pagado" value="{{ old('importe_pagado') }}">
                            @if ($errors->has('importe_pagado'))
                                <span class="text-danger">{{ $errors->first('importe_pagado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="importe_pendiente" class="col-md-4 col-form-label text-md-end text-start">{{ __('Importe pendiente') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('importe_pendiente') is-invalid @enderror" id="importe_pendiente" name="importe_pendiente" value="{{ old('importe_pendiente') }}">
                            @if ($errors->has('importe_pendiente'))
                                <span class="text-danger">{{ $errors->first('importe_pendiente') }}</span>
                            @endif
                        </div>
                    </div>

                    <div id="juguetes">
                        <h3>{{ __('Juguetes') }}</h3>
                        <hr />
                        <div id="juguete1">
                            <h5>{{ __('Juguete 1') }}</h5>
                            <div class="mb-3 row">
                                <label for="juguete_1" class="col-md-4 col-form-label text-md-end text-start">{{ __('Juguete') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control juguetes @error('juguetes') is-invalid @enderror" id="juguete_1" name="juguetes[]">
                                        <option value="">{{ __('Seleccione un juguete') }}</option>
                                        @foreach($juguetes as $juguete)
                                            @if($juguete->stock > 0)
                                                <option data-precio="{{ $juguete->precio }}" value="{{ $juguete->id }}"{{ ($juguete->id == old('juguetes[0]') ? ' selected' : '') }}>{{ $juguete->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cantidad_1" class="col-md-4 col-form-label text-md-end text-start">{{ __('Cantidad') }}</label>
                                <div class="col-md-2">
                                    <input type="number" class="form-control cantidad @error('cantidad') is-invalid @enderror" id="cantidad_1" name="cantidad[]" value="{{ (old('cantidad[0]') ?? 1) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" id="add_juguete" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Añadir juguete') }}</a>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Insertar reserva') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection

@section('javascript')
    <script>
        var juguetes = 1;

        function actualizarImportes() {
            var iva_aplicado = $("#iva_aplicado").val();
            var iva = 0;
            var importe_total = 0;

            $("select.juguetes").each(function() {
                if($(this).find(":selected").data('precio')) {
                    var num_juguete = $(this).prop('id');
                    var cantidad = $("#cantidad" + num_juguete.substring(num_juguete.indexOf('_'))).val();
                    var precio = $(this).find(":selected").data('precio');

                    iva += (precio * (iva_aplicado / 100) * cantidad);
                    importe_total += (precio * (iva_aplicado / 100 + 1) * cantidad);
                }
            });

            $("#iva").val(iva.toFixed(2));
            $("#importe_total").val(importe_total.toFixed(2));

            var importe_pagado = $("#importe_pagado").val();

            $("#importe_pendiente").val((importe_total - importe_pagado).toFixed(2));
        }

        window.onload = function(){
            $("#importe_pagado").on('change', function(e) {
                var importe_total = $("#importe_total").val();
                var importe_pagado = $("#importe_pagado").val();

                $("#importe_pendiente").val((importe_total - importe_pagado).toFixed(2));
            });

            $("#add_juguete").on('click', function(e) {
                e.preventDefault();

                juguetes++;
                $.get("/ventas/add_juguete/" + juguetes , function( data ) {
                    $("#juguetes").append(data);
                    
                    $(".quitar").on('click', function() {
                        $("#juguete" + $(this).data('num-juguete')).remove();
                    });

                    $("select.juguetes, input.cantidad").on('change', function() {
                        actualizarImportes();
                    });
                });
            });

            $("select.juguetes, #iva_aplicado, input.cantidad").on('change', function() {
                actualizarImportes();
            });

            $(".quitar").on('click', function() {
                $("#juguete" + $(this).data('num-juguete')).remove();
            });
        };
    </script>
@endsection