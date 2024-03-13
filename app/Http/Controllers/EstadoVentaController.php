<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadoVentaRequest;
use App\Http\Requests\UpdateEstadoVentaRequest;
use App\Models\EstadoVenta;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EstadoVentaController extends Controller
{
    /**
     * Instantiate a new EstadoVentaController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-estado_venta|edit-estado_venta|delete-estado_venta', ['only' => ['index','show']]);
       $this->middleware('permission:create-estado_venta', ['only' => ['create','store']]);
       $this->middleware('permission:edit-estado_venta', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-estado_venta', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('estado_ventas.index', [
            'estado_ventas' => EstadoVenta::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('estado_ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoVentaRequest $request): RedirectResponse
    {
        EstadoVenta::create($request->all());

        return redirect()->route('estado_ventas.index')->withSuccess('Nuevo estado de venta creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoVenta $estadoVenta): View
    {
        return view('estado_ventas.show', [
            'estado_venta' => $estadoVenta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoVenta $estadoVenta): View
    {
        return view('estado_ventas.show', [
            'estado_venta' => $estadoVenta
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadoVentaRequest $request, EstadoVenta $estadoVenta): RedirectResponse
    {
        $estadoVenta->update($request->all());
        return redirect()->back()->withSuccess('Estado de venta actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoVenta $estadoVenta): RedirectResponse
    {
        $estadoVenta->delete();
        return redirect()->route('estado_ventas.index')->withSuccess('Estado de venta borrado correctamente.');
    }
}
