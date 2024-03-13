<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Reserva;
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
            'reservas' => Reserva::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('reservas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaRequest $request): RedirectResponse
    {
        Reserva::create($request->all());

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
        return view('reservas.edit', [
            'reserva' => $reserva
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
