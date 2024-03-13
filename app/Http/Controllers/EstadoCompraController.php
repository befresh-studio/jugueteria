<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadoCompraRequest;
use App\Http\Requests\UpdateEstadoCompraRequest;
use App\Models\EstadoCompra;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EstadoCompraController extends Controller
{
    /**
     * Instantiate a new EstadoCompraController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-estado_compra|edit-estado_compra|delete-estado_compra', ['only' => ['index','show']]);
       $this->middleware('permission:create-estado_compra', ['only' => ['create','store']]);
       $this->middleware('permission:edit-estado_compra', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-estado_compra', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('estado_compras.index', [
            'estado_compras' => EstadoCompra::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('estado_compras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoCompraRequest $request): RedirectResponse
    {
        EstadoCompra::create($request->all());

        return redirect()->route('estado_compras.index')->withSuccess('Nuevo estado de compra creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoCompra $estadoCompra): View
    {
        return view('estado_compras.show', [
            'estado_compra' => $estadoCompra
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstadoCompra $estadoCompra): View
    {
        return view('estado_compras.edit', [
            'estado_compra' => $estadoCompra
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadoCompraRequest $request, EstadoCompra $estadoCompra): RedirectResponse
    {
        $estadoCompra->update($request->all());
        return redirect()->back()->withSuccess('Estado de compra actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoCompra $estadoCompra): RedirectResponse
    {
        $estadoCompra->delete();
        return redirect()->route('estado_compras.index')->withSuccess('Estado de compra borrado correctamente.');
    }
}
