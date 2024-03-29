@extends('layouts.app')

@section('content')
<a href="{{ route('estado-ventas.index') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-flag-fill"></i> {{ __('Ver estados de ventas') }}</a>

<div class="card">
    <div class="card-header">{{ __('Listado de ventas') }}</div>
    <div class="card-body">
        @can('create-venta')
            <a href="{{ route('ventas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva venta') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Referencia') }}</th>
                    <th scope="col">{{ __('Cliente') }}</th>
                    <th scope="col">{{ __('IVA') }}</th>
                    <th scope="col">{{ __('Importe total') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas as $venta)
                    <tr>
                        <th scope="row">{{ $venta->id }}</th>
                        <td>{{ $venta->referencia }}</td>
                        <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</td>
                        <td>{{ $venta->iva }}</td>
                        <td>{{ $venta->importe_total }}</td>
                        <td>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                                @can('edit-venta')
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                                @endcan

                                @can('delete-venta')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta venta?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay ventas') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $ventas->links() }}

    </div>
</div>
@endsection