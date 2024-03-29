@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Insertar nueva compra') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('compras.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="proveedor" class="col-md-4 col-form-label text-md-end text-start">{{ __('Proveedor') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('proveedores_id') is-invalid @enderror" id="proveedor" name="proveedores_id">
                                <option value="">{{ __('Seleccione un proveedor') }}</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}"{{ ($proveedor->id == old('proveedores_id') ? ' selected' : '') }}>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('proveedores_id'))
                                <span class="text-danger">{{ $errors->first('proveedores_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start">{{ __('Referencia') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('referencia') is-invalid @enderror" id="referencia" name="referencia" value="{{ old('referencia') }}">
                            @if ($errors->has('referencia'))
                                <span class="text-danger">{{ $errors->first('referencia') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="fecha_entrega" class="col-md-4 col-form-label text-md-end text-start">{{ __('Fecha de entrega') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('fecha_entrega') is-invalid @enderror" id="fecha_entrega" name="fecha_entrega" value="{{ old('fecha_entrega') }}">
                            @if ($errors->has('fecha_entrega'))
                                <span class="text-danger">{{ $errors->first('fecha_entrega') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="iva" class="col-md-4 col-form-label text-md-end text-start">{{ __('IVA') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('iva') is-invalid @enderror" id="iva" name="iva" value="{{ old('iva') }}">
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

                    <div id="juguetes">
                        <h3>{{ __('Juguetes') }}</h3>
                        <hr />
                    </div>

                    <a href="#" id="add_juguete" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Añadir juguete') }}</a>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Insertar compra') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection

@section('javascript')
    <script>
        var juguetes = 0;

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
        }

        window.onload = function(){
            $("#add_juguete").on('click', function(e) {
                e.preventDefault();

                juguetes++;
                $.get("/compras/add_juguete/" + juguetes , function( data ) {
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