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
    return view('welcome');
});

//Rota do cadastro de imoveis
Route::get('/imoveis', 'PropertyController@index');
Route::get('/imoveis/novo', 'PropertyController@create');

Route::post('/imoveis/store', 'PropertyController@store');
Route::get('/imoveis/{name}', 'PropertyController@show');

Route::post('/imoveis/editar/{name}', 'PropertyController@edit');
Route::put('/imoveis/update/{name}', 'PropertyController@update');




//cadastro de Cliente
Route::get('/cliente', 'ClienteController@index');
Route::get('/cleinte/novo', 'ClienteController@create');
Route::post('/cliente/store', 'ClienteController@store');


//cadastro de Fornecedor
Route::get('/fornecedor', 'FornecedorController@index');
Route::get('/fornecedor/novo', 'FornecedorController@create');
Route::post('/fornecedor/store', 'FornecedorController@store');

//cadastro de Produto
Route::get('/produto', 'ProdutoController@index');
Route::get('/produto/novo', 'ProdutoController@create');
Route::post('/produto/store', 'ProdutoController@store');


//cadastro Contas a Pagar
Route::get('/contasPagar', 'ContasPagarController@index');
Route::get('/contasPagar/novo', 'ContasPagarController@create');
Route::post('/contasPagar/store', 'ContasPagarController@store');

//cadastro Contas a Receber
Route::get('/contasReceber', 'ContasReceberController@index');
Route::get('/contasReceber/novo', 'ContasReceberController@create');
Route::post('/contasReceber/store', 'ContasReceberController@store');

//Relatorios
Route::get('/produto', 'ProdutoController@index');
Route::get('/produto/novo', 'ProdutoController@create');
Route::post('/produto/store', 'ProdutoController@store');