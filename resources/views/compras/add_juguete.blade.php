<div id="juguete{{ $num_juguete }}">
    <h5>{{ __('Juguete ' . $num_juguete) }}</h5>
    <div class="mb-3 row">
        <label for="juguete_{{ $num_juguete }}" class="col-md-4 col-form-label text-md-end text-start">{{ __('Juguete') }}</label>
        <div class="col-md-6">
            <select class="form-control juguetes @error('juguetes') is-invalid @enderror" id="juguete_{{ $num_juguete }}" name="juguetes[]">
                <option value="">{{ __('Seleccione un juguete') }}</option>
                @foreach($juguetes as $juguete)
                    @if($juguete->stock > 0)
                        <option data-precio="{{ $juguete->precio }}" value="{{ $juguete->id }}"{{ ($juguete->id == old('juguetes') ? ' selected' : '') }}>{{ $juguete->nombre }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="cantidad_{{ $num_juguete }}" class="col-md-4 col-form-label text-md-end text-start">{{ __('Cantidad') }}</label>
        <div class="col-md-2">
            <input type="number" class="form-control cantidad @error('cantidad') is-invalid @enderror" id="cantidad_{{ $num_juguete }}" name="cantidad[]" value="1">
        </div>
        <div class="col-md-2">
            <button data-num-juguete="{{ $num_juguete }}" class="btn btn-danger btn-sm quitar" onclick="return confirm('{{ __('¿Quieres quitar este juguete?') }}');"><i class="bi bi-trash"></i> {{ __('Quitar') }}</button>
        </div>
    </div>
</div>