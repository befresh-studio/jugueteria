@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de proveedores') }}</div>
    <div class="card-body">
        @can('create-proveedor')
            <a href="{{ route('proveedores.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo proveedor') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Nombre') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('CIF') }}</th>
                    <th scope="col">{{ __('Teléfono') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proveedores as $proveedor)
                <tr>
                    <th scope="row">{{ $proveedor->id }}</th>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>{{ $proveedor->cif }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>
                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-proveedor')
                                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-proveedor')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este proveedor?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay proveedores') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $proveedores->links() }}

    </div>
</div>
@endsection