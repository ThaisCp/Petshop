@extends('site.Master.layout')

@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="text-center"></div>
        <h1 class="h2">Produtos em Estoque</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <hr "my-5">

{{--    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}


    <div class="componente">
        <form class="navbar-form navbar-left">
            <div class="   col-md-8 offset-md-2">
                <input type="text" class="form-control" placeholder="Pesquisar">
            </div>

            <br>
            <div class="   col-md-3 offset-md-5">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
                <router-link :to="'/home/'" class="btn btn-secondary">Voltar</router-link>

            </div>


        </form>
    </div>

@endsection
