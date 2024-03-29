@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Editar proveedor') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('proveedores.update', $proveedor->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="juguetes" class="col-md-4 col-form-label text-md-end text-start">{{ __('Juguetes') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('juguetes') is-invalid @enderror" id="juguetes" name="juguetes[]" multiple>
                                <option value="">{{ __('Seleccione juguetes') }}</option>
                                @foreach($juguetes as $juguete)
                                    <option value="{{ $juguete->id }}"{{ (in_array($juguete->id, $proveedor->juguetes->pluck('id')->toArray()) ? ' selected' : '') }}>{{ $juguete->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('juguetes'))
                                <span class="text-danger">{{ $errors->first('juguetes') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $proveedor->nombre }}">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">{{ __('Email') }}</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $proveedor->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="cif" class="col-md-4 col-form-label text-md-end text-start">{{ __('CIF') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('cif') is-invalid @enderror" id="cif" name="cif" value="{{ $proveedor->cif }}">
                            @if ($errors->has('cif'))
                                <span class="text-danger">{{ $errors->first('cif') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-end text-start">{{ __('Teléfono') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ $proveedor->telefono }}">
                            @if ($errors->has('telefono'))
                                <span class="text-danger">{{ $errors->first('telefono') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="observaciones" class="col-md-4 col-form-label text-md-end text-start">{{ __('Observaciones') }}</label>
                        <div class="col-md-6">
                          <textarea class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones">{{ $proveedor->observaciones }}</textarea>
                            @if ($errors->has('observaciones'))
                                <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Actualizar') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection