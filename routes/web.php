<?php

///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/

Route::get('/', function () {
    return view('site.home');
})->name('site.home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/site', 'AuthController@home')->name('site');
Route::get('/site/login', 'AuthController@home')->name('site.login');
Route::get('/site/logout', 'AuthController@home')->name('site.logout');
Route::post('/site/login/do', 'AuthController@home')->name('site.login.do');

//Route::get('/site/cadastroCleite', 'ClienteController@cadastroCleite')->name('site.cadastroCleite');

//Cliente
Route::get('/cliente', function () {
    return view('site.cliente');
})->name('site.cliente');

Route::get('/cadastroCliente', function () {
    return view('site.cadastroCliente');
})->name('site.cadastroCliente');

//Agenda
Route::get('/agenda', function () {
    return view('site.agenda');
})->name('site.agenda');

//Estoque de Produtos
Route::get('/estoque', function () {
    return view('site.estoque');
})->name('site.estoque');

Route::get('/cadastroEstoque', function () {
    return view('site.cadastroEstoque');
})->name('site.cadastroEstoque');

Route::get('/fornecedor', function () {
    return view('site.fornecedor');
})->name('site.fornecedor');


//Contatos
Route::get('/contato', function () {
    return view('site.contato');
})->name('site.contato');

//Relatorios
Route::get('/relatorio', function () {
    return view('site.relatorio');
})->name('site.relatorio');


//Financeiro
Route::get('/financeiro', function () {
    return view('site.financeiro');
})->name('site.financeiro');


//Configuração
Route::get('/configuracao', function () {
    return view('site.configuracao');
})->name('site.configuracao');
