<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('alunos', App\Http\Controllers\AlunoController::class);
Route::get('/alunos', [App\Http\Controllers\AlunoController::class, 'index'])->name('alunos');
Route::resource('curso', App\Http\Controllers\CursoController::class);
Route::get('/curso', [App\Http\Controllers\CursoController::class, 'index'])->name('curso');
Route::resource('eixos', App\Http\Controllers\EixosController::class);
Route::get('/eixos', [App\Http\Controllers\EixosController::class, 'index'])->name('eixos');
Route::resource('materias', App\Http\Controllers\MateriaController::class);
Route::get('/materias', [App\Http\Controllers\MateriaController::class, 'index'])->name('materias');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'index'])->name('login-admin');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('login-admin-submit');
Route::post('/admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('logout-admin');
Route::get('/home-admin', [App\Http\Controllers\AdminController::class, 'index'])->name('home-admin');

Route::get('perfiladm/{id}', [App\Http\Controllers\PerfilAdmController::class, 'perfil'])->name('perfiladm/{id}');
Route::get('perfiladm/show/{id}', [App\Http\Controllers\PerfilAdmController::class, 'show'])->name('perfiladm/show');
Route::get('perfiladm/apagar/{id}', [App\Http\Controllers\PerfilAdmController::class, 'destroy'])->name('perfiladm/apagar');
Route::post('perfiladm/updateft', [App\Http\Controllers\PerfilAdmController::class, 'updatefoto'])->name('perfiladm/updateft');
Route::post('perfiladm/update/{id}', [App\Http\Controllers\PerfilAdmController::class, 'update'])->name('perfiladm/update');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/perfil/apagar', [App\Http\Controllers\HomeController::class, 'deletar'])->name('perfil/apagar');
Route::get('/materias_a/{id}', [App\Http\Controllers\Materias::class, 'index'])->name('materias_a');
Route::post('/materias_a/salvar', [App\Http\Controllers\Materias::class, 'salvar'])->name('materias_a/salvar');
Route::get('/materias_a/editar/{id}', [App\Http\Controllers\Materias::class, 'editar'])->name('materias_a/editar');
Route::post('/materias_a/editi', [App\Http\Controllers\Materias::class, 'editi'])->name('materias_a/editi');
Route::get('/periodos/{id}', [App\Http\Controllers\Materias::class, 'index'])->name('periodos');
Route::get('/periodos/pdf/{id}', [App\Http\Controllers\Periodos::class, 'pdf'])->name('periodos/pdf');
Route::post('/concluido', [App\Http\Controllers\Materias::class, 'concluido'])->name('concluido');
Route::get('/simulador/{id}', [App\Http\Controllers\Simulador::class, 'index'])->name('simulador');
Route::get('/perfil/{id}', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');
Route::get('/perfil/editar/{id}', [App\Http\Controllers\HomeController::class, 'editar'])->name('perfil/editar');
Route::post('/perfil/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('perfil/edit');
Route::post('/perfil/update', [App\Http\Controllers\HomeController::class, 'update'])->name('perfil/update');
