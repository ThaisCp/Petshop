@extends('site.Master.layout')
@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="text-center"></div>
        <h1 class="h2">Clientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <hr "my-5">


    <div class="componente">
        <form class="navbar-form navbar-left">
            <div class="   col-md-8 offset-md-2">
                <input type="text" class="form-control" placeholder="Pesquisar">
            </div>

            <br>
            <div class="   col-md-3 offset-md-5">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>

        <div class="componente py-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Pet</th>
                <th scope="col">Ultima Visita</th>
            </tr>
            </thead>


            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>-</td>
            </tr>
            </tbody>
        </table>

    </div>

@endsection
