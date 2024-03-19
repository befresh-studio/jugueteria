<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Proveedor;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProveedorController extends Controller
{
    /**
     * Instantiate a new ProveedorController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-proveedor|edit-proveedor|delete-proveedor', ['only' => ['index','show']]);
       $this->middleware('permission:create-proveedor', ['only' => ['create','store']]);
       $this->middleware('permission:edit-proveedor', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-proveedor', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('proveedores.index', [
            'proveedores' => Proveedor::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request): RedirectResponse
    {
        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->withSuccess('Nuevo proveedor creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor): View
    {
        return view('proveedores.show', [
            'proveedor' => $proveedor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor): View
    {
        return view('proveedores.edit', [
            'proveedor' => $proveedor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor): RedirectResponse
    {
        $proveedor->update($request->all());
        return redirect()->back()->withSuccess('Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->withSuccess('Proveedor borrado correctamente.');
    }
}
