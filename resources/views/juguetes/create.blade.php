@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Insertar nuevo juguete') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('juguetes.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('juguetes.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="imagen" class="col-md-4 col-form-label text-md-end text-start">{{ __('Imagen') }}</label>
                        <div class="col-md-6">
                          <input type="imagen" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" value="{{ old('imagen') }}">
                            @if ($errors->has('imagen'))
                                <span class="text-danger">{{ $errors->first('imagen') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
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
                        <label for="ean13" class="col-md-4 col-form-label text-md-end text-start">{{ __('EAN13') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('ean13') is-invalid @enderror" id="ean13" name="ean13" value="{{ old('ean13') }}">
                            @if ($errors->has('ean13'))
                                <span class="text-danger">{{ $errors->first('ean13') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Insertar juguete') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection