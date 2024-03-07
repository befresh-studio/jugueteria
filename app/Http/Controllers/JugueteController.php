<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugueteRequest;
use App\Http\Requests\UpdateJugueteRequest;
use App\Models\Juguete;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JugueteController extends Controller
{
    /**
     * Instantiate a new JugueteController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-juguete|edit-juguete|delete-juguete', ['only' => ['index','show']]);
       $this->middleware('permission:create-juguete', ['only' => ['create','store']]);
       $this->middleware('permission:edit-juguete', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-juguete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('juguetes.index', [
            'juguetes' => Juguete::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('juguetes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugueteRequest $request): RedirectResponse
    {
        Juguete::create($request->all());

        return redirect()->route('juguetes.index')->withSuccess('Nuevo juguete creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Juguete $juguete): View
    {
        return view('juguetes.show', [
            'juguete' => $juguete
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juguete $juguete): View
    {
        return view('juguetes.edit', [
            'juguete' => $juguete
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJugueteRequest $request, Juguete $juguete): RedirectResponse
    {
        $juguete->update($request->all());
        return redirect()->back()->withSuccess('Juguete actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juguete $juguete): RedirectResponse
    {
        $juguete->delete();
        return redirect()->route('juguetes.index')->withSuccess('Juguete borrado correctamente.');
    }
}
