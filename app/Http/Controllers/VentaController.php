<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Models\Cliente;
use App\Models\Juguete;
use App\Models\Venta;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VentaController extends Controller
{
    /**
     * Instantiate a new VentaController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-venta|edit-venta|delete-venta', ['only' => ['index','show']]);
       $this->middleware('permission:create-venta', ['only' => ['create','store']]);
       $this->middleware('permission:edit-venta', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-venta', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('ventas.index', [
            'ventas' => Venta::with('cliente')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $clientes = Cliente::all();
        $juguetes = Juguete::all();

        return view('ventas.create', [
            'clientes' => $clientes,
            'juguetes' => $juguetes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request): RedirectResponse
    {
        $venta = Venta::create($request->all());

        foreach($request->juguetes as $index => $id_juguete) {
            $juguete = Juguete::find($id_juguete);

            $cantidad = $request->cantidad[$index];
            $precio_unitario = $juguete->precio;
            $iva_total = ($juguete->precio * ($request->iva_aplicado / 100)) * $request->cantidad[$index];
            $importe_total = ($juguete->precio * ($request->iva_aplicado / 100 + 1)) * $request->cantidad[$index];

            $venta->juguetes()->attach($id_juguete, ['cantidad' => $cantidad, 'precio_unitario' => $precio_unitario, 'iva_total' => $iva_total, 'importe_total' => $importe_total]);

            $juguete->stock -= $cantidad;

            $juguete->save();
        }

        return redirect()->route('ventas.index')->withSuccess('Nueva venta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta): View
    {
        return view('ventas.show', [
            'venta' => $venta
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta): View
    {
        $clientes = Cliente::all();

        return view('ventas.edit', [
            'venta' => $venta,
            'clientes' => $clientes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentaRequest $request, Venta $venta): RedirectResponse
    {
        $venta->update($request->all());
        return redirect()->back()->withSuccess('Venta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta): RedirectResponse
    {
        $venta->delete();
        return redirect()->route('ventas.index')->withSuccess('Venta borrada correctamente.');
    }

    public function addJuguete(int $num_juguete): View {
        $juguetes = Juguete::all();

        return view('ventas.add_juguete', [
            'num_juguete' => $num_juguete,
            'juguetes' => $juguetes
        ]);
    }
}
