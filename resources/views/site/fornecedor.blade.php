@extends('site.Master.layout')

@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="text-center"></div>
        <h1 class="h2">Cadastro de Fornecedor</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <div class="container  py-5">
        <form class="needs-validation" novalidate>


    {{--            //FORNECEDOR Contato--}}
<div class="form-row">
    <div class="   col-md-6 offset-md-1">
        <label for="validationCustom01">Fornecedor</label> <span id="obrigatorio">*</span>
        <input type="text" class="form-control" id="validationCustom01" placeholder="Fornecedor" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="validationCustom02">E-mail</label> <span id="obrigatorio">*</span>
        <input type="email" class="form-control" id="validationCustom02" placeholder="Email" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="   col-md-5 offset-md-1">
        <label for="inputAddress">Telefone Fixo</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Contato" required>
    </div>

    <div class="col-md-5 mb-3">
        <label for="inputAddress">Celular</label> <span id="obrigatorio">*</span>
        <input type="text" class="form-control" id="inputAddress" placeholder="Contato" required>
    </div>
</div>


{{--            //Endereço--}}
<div class="form-row">
    <div class="   col-md-2 offset-md-1">
        <label for="inputAddress">Cep</label> <span id="obrigatorio">*</span>
        <input type="number" class="form-control" id="inputAddress" placeholder="Cep" required>
    </div>

    <div class="col-md-7 mb-3">
        <label for="inputAddress">Endereço</label> <span id="obrigatorio">*</span>
        <input type="text" class="form-control" id="inputAddress" placeholder="Endereço" required>
    </div>

    <div class="col-md-1 mb-3">
        <label for="inputAddress">Número</label> <span id="obrigatorio">*</span>
        <input type="number" class="form-control" id="inputAddress" placeholder="Número" required>
    </div>
</div>

{{--            //Estado--}}
<div class="form-row">
    <div class="   col-md-3 offset-md-1">
        <label for="validationCustom03">Cidade</label> <span id="obrigatorio">*</span>
        <input type="text" class="form-control" id="validationCustom03" required placeholder="Cidade">
        <div class="invalid-feedback">
            Please provide a valid city.
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <label for="validationCustom03">UF</label> <span id="obrigatorio">*</span>
        <input type="text" class="form-control" id="validationCustom03" placeholder="Estado" required>
        <div class="invalid-feedback">
            Please provide a valid city.
        </div>
    </div>
@endsection
