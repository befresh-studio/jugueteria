<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cliente;
use App\Models\Juguete;
use App\Models\Configuracion;
use App\Models\EstadoCompra;
use App\Models\EstadoVenta;
use App\Models\Venta;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
        $estados = EstadoVenta::all();

        return view('ventas.index', [
            'ventas' => Venta::with('cliente')->latest()->paginate(25),
            'estados' => $estados
        ]);
    }

    /**
     * Display a listing of the resource filtering.
     */
    public function filtrar(FormRequest $request): View
    {
        $estados = EstadoVenta::all();

        return view('ventas.index', [
            'ventas' => Venta::where('referencia', 'like', '%' . $request->filtro. '%')->paginate(25),
            'filtro' => $request->filtro,
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Cliente $cliente = NULL): View
    {
        $clientes = Cliente::all();
        $juguetes = Juguete::all();
        $ivas = Configuracion::where('key', 'IVA')->get();

        return view('ventas.create', [
            'clientes' => $clientes,
            'cliente' => $cliente,
            'juguetes' => $juguetes,
            'ivas' => $ivas
        ]);
    }

    /**
     * Show the TPV form for creating a new resource.
     */
    public function tpv(Cliente $cliente = NULL): View
    {
        $ivas = Configuracion::where('key', 'IVA')->get();

        return view('ventas.tpv', [
            'cliente' => $cliente,
            'ivas' => $ivas
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

        $estado_inicial = Configuracion::where('key', 'ESTADO_INICIO_VENTAS')->first();

        if($estado_inicial) {
            $venta->estados()->attach($estado_inicial->value);
        }

        return redirect()->route('ventas.index')->withSuccess('Nueva venta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta): View
    {
        $estados = EstadoVenta::all();

        return view('ventas.show', [
            'venta' => $venta,
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta): View
    {
        $clientes = Cliente::all();
        $juguetes = Juguete::all();
        $ivas = Configuracion::where('key', 'IVA')->get();

        return view('ventas.edit', [
            'venta' => $venta,
            'clientes' => $clientes,
            'juguetes' => $juguetes,
            'ivas' => $ivas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentaRequest $request, Venta $venta): RedirectResponse
    {
        $venta->update($request->all());

        $venta->juguetes()->detach();

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

    public function addJugueteRef(int $num_juguete, Request $request): JsonResponse {
        $juguete = Juguete::where('referencia', 'like', $request->ref_juguete)->first();

        return response()->json([
            'success' => (isset($juguete) && $juguete->stock > 0 ? true : false),
            'message' => (!isset($juguete) ? 'La referencia introducida no existe' : ($juguete->stock <= 0 ? 'No hay stock suficiente' : 'ERROR')),
            'html' => (isset($juguete) && $juguete->stock > 0 ? view('ventas.add_jugueteTPV', ['num_juguete' => $num_juguete, 'juguete' => $juguete])->render() : '')
        ]);
    }

    public function cambiarEstado(Venta $venta, int $id_estado): RedirectResponse {
        $venta->estados()->attach($id_estado);

        $estados = EstadoVenta::all();

        return redirect()->route('ventas.index', [
            'ventas' => Venta::with('cliente')->latest()->paginate(25),
            'estados' => $estados
        ])->withSuccess('Estado actualizado correctamente.');
    }

    public function cambiarEstadoPost(Request $request): RedirectResponse {
        $venta = Venta::find($request->id_venta);
        
        $venta->estados()->attach($request->estado);

        $estados = EstadoVenta::all();

        return redirect()->route('ventas.show', [
            'venta' => $venta,
            'estados' => $estados
        ])->withSuccess('Estado actualizado correctamente.');
    }
}
