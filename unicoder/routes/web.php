<?php

use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', LoginController::class . '@index')->name('login');
Route::post('/login', LoginController::class . '@login')->name('autenticar');
Route::get('/logout', LoginController::class . '@logout')->name('logout');

Route::get('/cadastro', [UsuarioController::class, 'create'])->name('users.create');
Route::post('/cadastro', [UsuarioController::class, 'store'])->name('users.store');

//Grupo de rotas internas
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/pesquisar', [UsuarioController::class, 'index'])->name('index');
        Route::get('/{id}', [UsuarioController::class, 'show'])->name('show');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy');
    });

    /** Cria as rotas:
     * GET /livros - LivroController@index - livros.index - Lista os livros
     * GET /livros/create - LivroController@create - livros.create - Formulário de criação
     * POST /livros - LivroController@store - livros.store - Salva o novo livro
     * GET /livros/{id} - LivroController@show - livros.show - Exibe um livro
     * GET /livros/{id}/edit - LivroController@edit - livros.edit - Formulário de edição
     * PUT /livros/{id} - LivroController@update - livros.update - Salva a edição de um livro
     * DELETE /livros/{id} - LivroController@destroy - livros.destroy - Remove um livro
     */
    Route::resource('livros', LivroController::class)->except(['create']);

    Route::resource('emprestimos', EmprestimoController::class);
    Route::get('/emprestimos/{id}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
    Route::get('/emprestimos/{id}/renovar', [EmprestimoController::class, 'renovar'])->name('emprestimos.renovar');
    
});
