<div id="juguete{{ $num_juguete }}">
    <input type="hidden" class="juguete" id="juguete_{{ $num_juguete }}" data-precio="{{ $juguete->precio }}" data-numJuguete="{{ $num_juguete }}" name="juguetes[]" value="{{ $juguete->id }}">
    <h5>{{ __('Juguete ' . $num_juguete) }}:</h5>
    <div class="row mb-3">
        <div class="col-md-6">
            <h6>{{ $juguete->nombre }} (REF: <span class="referencia_juguete" data-numJuguete="{{ $num_juguete }}">{{ $juguete->referencia }}</span>)</h6>
        </div>
        <div class="col-md-2">
            <label for="cantidad_{{ $num_juguete }}" class="col-form-label text-md-end text-start">{{ __('Cantidad') }}</label>
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control cantidad @error('cantidad') is-invalid @enderror" id="cantidad_{{ $num_juguete }}" name="cantidad[]" value="1">
        </div>
        <div class="col-md-2">
            <button data-num-juguete="{{ $num_juguete }}" class="btn btn-danger btn-sm quitar" onclick="return confirm('{{ __('¿Quieres quitar este juguete?') }}');"><i class="bi bi-trash"></i> {{ __('Quitar') }}</button>
        </div>
    </div>
</div>