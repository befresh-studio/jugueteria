<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugueteRequest;
use App\Http\Requests\UpdateJugueteRequest;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Categoria;
use App\Models\Configuracion;
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
        $umbral_stock = Configuracion::where('key', 'UMBRAL_STOCK')->first();

        return view('juguetes.index', [
            'juguetes' => Juguete::latest()->paginate(25),
            'umbral_stock' => ($umbral_stock ? $umbral_stock->value : 0)
        ]);
    }

    /**
     * Display a listing of the resource filtering.
     */
    public function filtrar(FormRequest $request): View
    {
        $umbral_stock = Configuracion::where('key', 'UMBRAL_STOCK')->first();

        return view('juguetes.index', [
            'juguetes' => Juguete::where('nombre', 'like', '%' . $request->filtro. '%')->paginate(25),
            'umbral_stock' => ($umbral_stock ? $umbral_stock->value : 0),
            'filtro' => $request->filtro
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categorias = Categoria::all();

        return view('juguetes.create', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugueteRequest $request): RedirectResponse
    {
        // $nombre_imagen = time().'.'.$request->fichero->extension();
        // $request->file('fichero')->storeAs('juguetes', $nombre_imagen);
        $path = $request->file('fichero')->store('juguetes', ['disk' => 'public']);

        //$request['imagen'] = $nombre_imagen;
        $request['imagen'] = $path;

        $juguete = Juguete::create($request->all());
        
        $juguete->categorias()->sync($request->categorias);

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
        $categorias = Categoria::all();

        return view('juguetes.edit', [
            'juguete' => $juguete,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJugueteRequest $request, Juguete $juguete): RedirectResponse
    {
        if($request->file('fichero')) {
            $path = $request->file('fichero')->store('juguetes');
            $request['imagen'] = $path;
        }

        $juguete->update($request->all());

        $juguete->categorias()->sync($request->categorias);

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
