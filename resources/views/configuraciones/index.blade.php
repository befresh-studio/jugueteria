@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de valores de configuración') }}</div>
    <div class="card-body">
        @can('create-configuraciones')
            <a href="{{ route('configuraciones.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo valor de configuración') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Clave') }}</th>
                    <th scope="col">{{ __('Valor') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($configuraciones as $configuracion)
                <tr>
                    <th scope="row">{{ $configuracion->id }}</th>
                    <td>{{ $configuracion->key }}</td>
                    <td>{{ $configuracion->value }}</td>
                    <td>
                        @if(!in_array($configuracion->key, ['IVA', 'ESTADO_INICIO_VENTAS', 'ESTADO_INICIO_COMPRAS', 'ESTADO_FINAL_COMPRAS', 'ESTADO_FINAL_VENTAS', 'UMBRAL_STOCK']))
                            <form action="{{ route('configuraciones.destroy', $configuracion->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                        @endif

                            @can('edit-configuraciones')
                                <a href="{{ route('configuraciones.edit', $configuracion->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                        @if(!in_array($configuracion->key, ['IVA', 'ESTADO_INICIO_VENTAS', 'ESTADO_INICIO_COMPRAS', 'ESTADO_FINAL_COMPRAS', 'ESTADO_FINAL_VENTAS', 'UMBRAL_STOCK']))
                                @can('delete-configuraciones')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este valor de configuración?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                                @endcan
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>{{ __('No hay valores de configuración') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $configuraciones->links() }}

    </div>
</div>
@endsection