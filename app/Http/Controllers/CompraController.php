<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Juguete;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompraController extends Controller
{
    /**
     * Instantiate a new CompraController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-compra|edit-compra|delete-compra', ['only' => ['index','show']]);
       $this->middleware('permission:create-compra', ['only' => ['create','store']]);
       $this->middleware('permission:edit-compra', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-compra', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('compras.index', [
            'compras' => Compra::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $proveedores = Proveedor::all();

        return view('compras.create', [
            'proveedores' => $proveedores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request): RedirectResponse
    {
        $compra = Compra::create($request->all());

        foreach($request->juguetes as $index => $id_juguete) {
            $juguete = Juguete::find($id_juguete);

            $cantidad = $request->cantidad[$index];
            $precio_unitario = $request->precio_unitario[$index];
            $iva_total = ($precio_unitario * ($request->iva_aplicado / 100)) * $cantidad;
            $importe_total = ($precio_unitario * ($request->iva_aplicado / 100 + 1)) * $cantidad;

            $compra->juguetes()->attach($id_juguete, ['cantidad' => $cantidad, 'precio_unitario' => $precio_unitario, 'iva_total' => $iva_total, 'importe_total' => $importe_total]);

            $juguete->stock += $cantidad;

            $juguete->save();
        }

        return redirect()->route('compras.index')->withSuccess('Nueva compra creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra): View
    {
        return view('compras.show', [
            'compra' => $compra
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra): View
    {
        $proveedores = Proveedor::all();

        return view('compras.edit', [
            'compra' => $compra,
            'proveedores' => $proveedores
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra): RedirectResponse
    {
        $compra->update($request->all());
        return redirect()->back()->withSuccess('Compra actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra): RedirectResponse
    {
        $compra->delete();
        return redirect()->route('compras.index')->withSuccess('Compra borrada correctamente.');
    }

    public function addJuguete(int $num_juguete, Proveedor $proveedor): View {
        $juguetes = $proveedor->juguetes;

        return view('compras.add_juguete', [
            'num_juguete' => $num_juguete,
            'juguetes' => $juguetes
        ]);
    }
}
