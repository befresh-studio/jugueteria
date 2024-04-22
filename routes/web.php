<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JugueteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EstadoCompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EstadoVentaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ConfiguracionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'juguetes' => JugueteController::class,
    'compras' => CompraController::class,
    'estado-compras' => EstadoCompraController::class,
    'categorias' => CategoriaController::class,
    'clientes' => ClienteController::class,
    'ventas' => VentaController::class,
    'estado-ventas' => EstadoVentaController::class,
    'reservas' => ReservaController::class,
]);

Route::resource('proveedores', ProveedorController::class)->parameter('proveedores','proveedor');
Route::resource('configuraciones', ConfiguracionController::class)->parameter('configuraciones','configuracion');

Route::get('ventas/add_juguete/{num_juguete}', [VentaController::class, 'addJuguete'])->name('add_juguete');
Route::post('ventas/add_juguete/{num_juguete}', [VentaController::class, 'addJugueteRef'])->name('add_jugueteRef');
Route::get('compras/add_juguete/{num_juguete}/{proveedor}', [CompraController::class, 'addJuguete'])->name('add_juguete_compra');

Route::get('ventas/create/{cliente}', [VentaController::class, 'create'])->name('ventas.createCliente');
Route::get('ventas/tpv/{cliente}', [VentaController::class, 'tpv'])->name('ventas.tpvCliente');
Route::get('reservas/create/{cliente}', [ReservaController::class, 'create'])->name('reservas.createCliente');

Route::post('juguetes/filtrar', [JugueteController::class, 'filtrar'])->name('juguetes.filtrar');
Route::post('clientes/filtrar', [ClienteController::class, 'filtrar'])->name('clientes.filtrar');
Route::post('proveedores/filtrar', [ProveedorController::class, 'filtrar'])->name('proveedores.filtrar');