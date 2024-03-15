@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Editar juguete') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('juguetes.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('juguetes.update', $juguete->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="fichero" class="col-md-4 col-form-label text-md-end text-start">{{ __('Imagen') }}</label>
                        <div class="col-md-6">
                            <img src="{{ url('storage/'.$juguete->imagen) }}" alt="{{ $juguete->nombre }}" class="img-fluid" />
                            <input type="file" class="form-control @error('fichero') is-invalid @enderror" id="fichero" name="fichero" value="{{ $juguete->imagen }}">
                            @if ($errors->has('fichero'))
                                <span class="text-danger">{{ $errors->first('fichero') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $juguete->nombre }}">
                            @if ($errors->has('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start">{{ __('Referencia') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('referencia') is-invalid @enderror" id="referencia" name="referencia" value="{{ $juguete->referencia }}">
                            @if ($errors->has('referencia'))
                                <span class="text-danger">{{ $errors->first('referencia') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ean13" class="col-md-4 col-form-label text-md-end text-start">{{ __('EAN13') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('ean13') is-invalid @enderror" id="ean13" name="ean13" value="{{ $juguete->ean13 }}">
                            @if ($errors->has('ean13'))
                                <span class="text-danger">{{ $errors->first('ean13') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="precio" class="col-md-4 col-form-label text-md-end text-start">{{ __('Precio') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ $juguete->precio }}">
                            @if ($errors->has('precio'))
                                <span class="text-danger">{{ $errors->first('precio') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="stock" class="col-md-4 col-form-label text-md-end text-start">{{ __('Stock') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $juguete->stock }}">
                            @if ($errors->has('stock'))
                                <span class="text-danger">{{ $errors->first('stock') }}</span>
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