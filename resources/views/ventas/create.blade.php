@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Insertar nueva venta') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ventas.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="cliente" class="col-md-4 col-form-label text-md-end text-start">{{ __('Cliente') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('proveedores_id') is-invalid @enderror" id="cliente" name="clientes_id">
                                <option value="">{{ __('Seleccione un cliente') }}</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"{{ ($cliente->id == old('clientes_id') ? ' selected' : '') }}>{{ $cliente->nombre }} {{ $cliente->apellidos }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('clientes_id'))
                                <span class="text-danger">{{ $errors->first('clientes_id') }}</span>
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
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Insertar venta') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection