@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de reservas') }}</div>
    <div class="card-body">
        @can('create-reserva')
            <a href="{{ route('reservas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva reserva') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Cliente') }}</th>
                    <th scope="col">{{ __('Importe pagado') }}</th>
                    <th scope="col">{{ __('Importe total') }}</th>
                    <th scope="col">{{ __('Importe pendiente') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservas as $reserva)
                <tr>
                    <th scope="row">{{ $reserva->id }}</th>
                    <td>{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellidos }}</td>
                    <td>{{ number_format($reserva->importe_pagado, 2, ',') }}€</td>
                    <td>{{ number_format($reserva->importe_total, 2, ',') }}€</td>
                    <td>{{ number_format($reserva->importe_total - $reserva->importe_pagado, 2, ',') }}€</td>
                    <td>
                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('reservas.show', $reserva->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-reserva')
                                <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-reserva')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta reserva?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="5">
                        <span class="text-danger">
                            <strong>{{ __('No hay reservas') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $reservas->links() }}

    </div>
</div>
@endsection