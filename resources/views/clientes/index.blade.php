@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de clientes') }}</div>
    <div class="card-body">
        @can('create-cliente')
            <a href="{{ route('clientes.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo cliente') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Nombre') }}</th>
                    <th scope="col">{{ __('Apellidos') }}</th>
                    <th scope="col">{{ __('Teléfono') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-cliente')
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-cliente')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este cliente?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan

                            @can('create-venta')
                                <a href="{{ route('ventas.createCliente', $cliente->id) }}" class="btn btn-secondary btn-sm"><i class="bi bi-cart-plus"></i> {{ __('Venta') }}</a>
                            @endcan

                            @can('create-reserva')
                                <a href="{{ route('reservas.createCliente', $cliente->id) }}" class="btn btn-secondary btn-sm"><i class="bi bi-basket2"></i> {{ __('Reserva') }}</a>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay clientes') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $clientes->links() }}

    </div>
</div>
@endsection