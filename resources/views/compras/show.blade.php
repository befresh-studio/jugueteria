@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información de la compra') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="proveedor" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Proveedor') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $compra->proveedor->nombre }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Referencia') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $compra->referencia }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="fecha_entrega" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Fecha de entrega') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $compra->fecha_entrega }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="iva" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('IVA') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $compra->iva }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $compra->importe_total }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection