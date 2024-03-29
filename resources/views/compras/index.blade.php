@extends('layouts.app')

@section('content')
<a href="{{ route('estado-compras.index') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-flag-fill"></i> {{ __('Ver estados de compras') }}</a>

<div class="card">
    <div class="card-header">{{ __('Listado de compras') }}</div>
    <div class="card-body">
        @can('create-compra')
            <a href="{{ route('compras.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva compra') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Referencia') }}</th>
                    <th scope="col">{{ __('Proveedor') }}</th>
                    <th scope="col">{{ __('Fecha entrega') }}</th>
                    <th scope="col">{{ __('IVA') }}</th>
                    <th scope="col">{{ __('Importe total') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $compra)
                <tr>
                    <th scope="row">{{ $compra->id }}</th>
                    <td>{{ $compra->referencia }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->fecha_entrega }}</td>
                    <td>{{ $compra->iva }}</td>
                    <td>{{ $compra->importe_total }}</td>
                    <td>
                        <form action="{{ route('compras.destroy', $compra->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-compra')
                                <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-compra')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta compra?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="7">
                        <span class="text-danger">
                            <strong>{{ __('No hay compras') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $compras->links() }}

    </div>
</div>
@endsection