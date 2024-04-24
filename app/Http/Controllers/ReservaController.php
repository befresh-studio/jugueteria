<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Cliente;
use App\Models\Juguete;
use App\Models\Reserva;
use App\Models\Configuracion;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReservaController extends Controller
{
    /**
     * Instantiate a new ReservaController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-reserva|edit-reserva|delete-reserva', ['only' => ['index','show']]);
       $this->middleware('permission:create-reserva', ['only' => ['create','store']]);
       $this->middleware('permission:edit-reserva', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-reserva', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('reservas.index', [
            'reservas' => Reserva::with('cliente')->latest()->paginate(10)
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

        return view('reservas.create', [
            'clientes' => $clientes,
            'juguetes' => $juguetes,
            'cliente' => $cliente,
            'ivas' => $ivas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaRequest $request): RedirectResponse
    {
        $reserva = Reserva::create($request->all());

        foreach($request->juguetes as $index => $id_juguete) {
            $juguete = Juguete::find($id_juguete);

            $cantidad = $request->cantidad[$index];
            $precio_unitario = $juguete->precio;
            $iva_total = ($juguete->precio * ($request->iva_aplicado / 100)) * $request->cantidad[$index];
            $importe_total = ($juguete->precio * ($request->iva_aplicado / 100 + 1)) * $request->cantidad[$index];

            $reserva->juguetes()->attach($id_juguete, ['cantidad' => $cantidad, 'precio_unitario' => $precio_unitario, 'iva_total' => $iva_total, 'importe_total' => $importe_total]);

            $juguete->stock -= $cantidad;

            $juguete->save();
        }

        return redirect()->route('reservas.index')->withSuccess('Nueva reserva creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva): View
    {
        return view('reservas.show', [
            'reserva' => $reserva
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva): View
    {
        $clientes = Cliente::all();
        $juguetes = Juguete::all();
        $ivas = Configuracion::where('key', 'IVA')->get();

        return view('reservas.edit', [
            'reserva' => $reserva,
            'clientes' => $clientes,
            'juguetes' => $juguetes,
            'ivas' => $ivas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservaRequest $request, Reserva $reserva): RedirectResponse
    {
        $reserva->update($request->all());
        return redirect()->back()->withSuccess('Reserva actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva): RedirectResponse
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->withSuccess('Reserva borrada correctamente.');
    }
}
