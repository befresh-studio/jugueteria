<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfiguracionRequest;
use App\Http\Requests\UpdateConfiguracionRequest;
use App\Models\Configuracion;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ConfiguracionController extends Controller
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
    public function index(): View {
        return view('configuraciones.index', [
            'configuraciones' => Configuracion::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        return view('configuraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfiguracionRequest $request): RedirectResponse
    {
        Configuracion::create($request->all());

        return redirect()->route('configuraciones.index')->withSuccess('Nuevo valor de configuración creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuracion $configuracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuracion $configuracion): View
    {
        return view('configuraciones.edit', [
            'configuracion' => $configuracion
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfiguracionRequest $request, Configuracion $configuracion): RedirectResponse
    {
        $configuracion->update($request->all());
        return redirect()->back()->withSuccess('Valor de configuración actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuracion $configuracion): RedirectResponse
    {
        $configuracion->delete();
        return redirect()->route('configuraciones.index')->withSuccess('Valor de configuración borrado correctamente.');
    }
}
