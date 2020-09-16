@extends('site.Master.layout')

@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="text-center"></div>
        <h1 class="h2">Cadastro de Produtos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <div class="container  py-5">
        <form class="needs-validation" novalidate>

            {{--            //Nomes--}}
            <div class="form-row">
                <div class="   col-md-5 offset-md-1">
                    <label for="validationCustom01">Nome Produto</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="Nome Produto" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Código EAN</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="validationCustom02" placeholder="EAN" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

                <div class="   col-md-5 offset-md-1">
                    <label for="validationCustom01">Quantidade</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="validationCustom01" placeholder="Quantidade" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom02">Preço</label> <span id="obrigatorio">*</span>
                    <input type="number" class="form-control" id="validationCustom02" placeholder="Preço" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

            </div>


    </div>
    <div class="form-group">
    </div>

    <hr class="my-4">


    {{--            //Botão--}}
    <div class="   col-md-7 offset-md-5">
        <button class="btn btn-primary" type="submit">Cadastrar</button>
        <router-link :to="'/home/'" class="btn btn-secondary">Voltar</router-link>

    </div>
    </form>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    </div>
@endsection
