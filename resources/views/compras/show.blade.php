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

<div class="row justify-content-center mt-4">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Juguetes en la compra') }}
                </div>
            </div>
            <div class="card-body">
                    
                @foreach($compra->juguetes as $juguete)
                    @if($loop->index > 0)
                        <hr />
                    @endif
                    
                    <div class="row">
                        <label for="juguete_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Juguete') }} {{ ($loop->index + 1) }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->nombre }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="cantidad_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Cantidad') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->pivot->cantidad }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="precio_unitario_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Precio unitario') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->pivot->precio_unitario }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="iva_total_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('IVA total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->pivot->iva_total }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="importe_total_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->pivot->importe_total }}
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
    </div>    
</div>
    
@endsection