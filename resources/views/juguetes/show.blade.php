@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información del juguete') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('juguetes.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="categoria" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Categorías') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @foreach ($juguete->categorias as $categoria)
                            {{ $categoria->nombre }}@if(!$loop->last),@endif
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <label for="imagen" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Imagen') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        <img src="{{ url('storage/'.$juguete->imagen) }}" alt="{{ $juguete->nombre }}" class="img-fluid img-juguete" />
                    </div>
                </div>
                
                <div class="row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Nombre') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $juguete->nombre }}
                    </div>
                </div>

                <div class="row">
                    <label for="referencia" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Referencia') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $juguete->referencia }}
                    </div>
                </div>

                <div class="row">
                    <label for="ean13" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('EAN13') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $juguete->ean13 }}
                    </div>
                </div>

                <div class="row">
                    <label for="precio" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Precio') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $juguete->precio }}
                    </div>
                </div>

                <div class="row">
                    <label for="stock" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Stock') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $juguete->stock }}
                    </div>
                </div>
        
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Proveedores del juguete') }}
                </div>
            </div>
            <div class="card-body">
                    
                @foreach($juguete->proveedores as $proveedor)
                    <div class="row">
                        <label for="proveedor_{{ $loop->index }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Proveedor') }} {{ $loop->index + 1 }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $proveedor->nombre }} ({{ __('último precio de compra:') }} {{ $proveedor->ultimoPrecioCompra($juguete->id) }}€)
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
    </div>    
</div>
    
@endsection