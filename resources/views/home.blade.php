@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        @can('create-cliente')
            <div class="col-md-3">
                <a href="{{ route('clientes.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo cliente') }}</a>
            </div>
        @endcan
        @can('create-proveedor')
            <div class="col-md-3">
                <a href="{{ route('proveedores.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo proveedor') }}</a>
            </div>
        @endcan
        @can('create-venta')
            <div class="col-md-3">
                <a href="{{ route('ventas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva venta') }}</a>
            </div>
        @endcan
        @can('create-compra')
            <div class="col-md-3">
                <a href="{{ route('compras.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva compra') }}</a>
            </div>
        @endcan
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">{{ __('Últimos clientes') }}</div>

                <div class="card-body">
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
            
                                        @can('create-venta')
                                            <a href="{{ route('ventas.tpvCliente', $cliente->id) }}" class="btn btn-secondary btn-sm"><i class="bi bi-cart-plus"></i> {{ __('TPV') }}</a>
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
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">{{ __('Últimas ventas') }}</div>

                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
