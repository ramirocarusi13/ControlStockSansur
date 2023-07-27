<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\materialsController;
use App\Models\materials;
use App\Http\Controllers\productsController;

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

/**
 * View login page.
 */
Route::get('/', [LoginController::class, 'view'])->name('login.view');

/**
 * Send login data.
 */
Route::post('/login', [LoginController::class, 'login'])->name('logins.login');

Route::get('/register', [LoginController::class, 'register'])->name('register.view');

Route::post('/register-user', [LoginController::class, 'register_user'])->name('register.register');

Route::get('/home', [HomeController::class, 'view'])->middleware('auth')->name('home.home');

Route::get('/formKitchen', [HomeController::class, 'view_kitchen'])->name('home.discountKitchen.form_kitchen');

Route::get('/seleccionar-producto', [ProductoController::class, 'seleccionarTipo'])->name('home.discountKitchen.seleccionar_tipo_producto');
Route::post('/seleccionar-subtipo', [ProductoController::class, 'seleccionarSubtipo'])->name('producto.subtipo');
Route::post('/seleccionar-opciones', [ProductoController::class, 'seleccionarOpciones'])->name('producto.opciones');






Route::get('/materiales', [materialsController::class, 'list'])->middleware('auth')->name('materials');







Route::get('/material', [materialsController::class, 'index'])->name('material.index');
Route::post('/material/buscar', [materialsController::class, 'buscarMateriales'])->name('material.buscar');

Route::post('/material/create', [materialsController::class, 'create'])->name('material.create');

Route::post('/material/deactivate/{id}', [materialsController::class, 'deactivateMaterial'])->name('material.deactivate');
Route::post('/material/add-stock/{id}', [materialsController::class, 'addStock'])->name('material.add-stock');


Route::get('/products', [productsController::class, 'view'])->middleware('auth')->name('products');
