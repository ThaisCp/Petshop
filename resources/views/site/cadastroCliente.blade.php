@extends('site.Master.layout')

@section('content')

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="text-center"></div>
        <h1 class="h2">Cadastro de Cliente</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <div class="container  py-5">
        <form class="needs-validation" novalidate>

            {{--            //Nomes--}}
            <div class="form-row">
                <div class="   col-md-5 offset-md-1">
                    <label for="validationCustom01">Nome</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="nome" placeholder="Digite o nome" required v-model="cliente.nome">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="validationCustom02">E-mail</label> <span id="obrigatorio">*</span>
                    <input type="email" class="form-control" id="email" placeholder="Email" required  v-model="cliente.email">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>

            {{--            //Contato--}}
            <div class="form-row">
                <div class="   col-md-5 offset-md-1">
                    <label for="telefoneFixo">Telefone Fixo</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Contato Fixo" required>
                </div>

                <div class="col-md-5 mb-3">
                    <label for="telefoneCelular">Celular</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Contato" required v-model="cliente.telefoneCelular">
                </div>
            </div>


{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-4">--}}
{{--                    <label for="telefoneFixo">Telefone </label>--}}
{{--                    <telefoneMask placeholder="Digite o telefone fixo" v-model="cliente.telefoneFixo"></telefoneMask>--}}
{{--                </div>--}}
{{--                <div class="form-group col-md-4">--}}
{{--                    <label for="telefoneCelular">Celular <span id="obrigatorio">*</span></label>--}}
{{--                    <telefoneMask placeholder="Digite o celular" v-model="cliente.telefoneCelular"></telefoneMask>--}}
{{--                </div>--}}


            {{--            //Endereço--}}
            <div class="form-row">
                <div class="   col-md-2 offset-md-1">
                    <label for="inputAddress">Cep</label> <span id="obrigatorio">*</span>
                    <input type="number" class="form-control" id="inputAddress" placeholder="Cep" required v-model="cliente.cep">
                </div>

                <div class="col-md-5 mb-3">
                    <label for="inputAddress">Endereço</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Endereço" required v-model="cliente.endereco">
                </div>

                <div class="col-md-1 mb-3">
                    <label for="inputAddress">Número</label> <span id="obrigatorio">*</span>
                    <input type="number" class="form-control" id="inputAddress" placeholder="Número" required  v-model="cliente.numero">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="inputAddress">Complemento</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Complemento" required  v-model="cliente.complemento">
                </div>
            </div>

            {{--            //Estado--}}
            <div class="form-row">
                <div class="   col-md-3 offset-md-1">
                    <label for="validationCustom03">Cidade</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="validationCustom03" required placeholder="Cidade" v-model="cliente.cidade">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom03">UF</label> <span id="obrigatorio">*</span>
                    <input type="text" class="form-control" id="validationCustom03" placeholder="Estado" required v-model="cliente.estado">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
            </div>
            <div class="form-group">
            </div>

            <hr class="my-4">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="text-center"></div>
                <h1 class="h2">Dados do Pet</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                </div>
            </div>
            <div class="container  py-3">
                <form class="needs-validation" novalidate>

                    {{--//Dados do Pet--}}

                    <div class="form-row">
                        <div class="   col-md-6 offset-md-1">
                            <label for="validationCustom01">Nome Pet</label> <span id="obrigatorio">*</span>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="Nome do Pet" required v-model="cliente.nomepet">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Raça do Pet</label> <span id="obrigatorio">*</span>
                            <input type="text" class="form-control" id="validationCustom02" placeholder="Raça" required v-model="cliente.racapet">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    {{--            //Peso e doenças--}}
                    <div class="form-row">
                        <div class="   col-md-2 offset-md-1">
                            <label for="inputAddress">Peso do Pet</label> <span id="obrigatorio">*</span>
                            <input type="number" class="form-control" id="inputAddress" placeholder="Peso do Pet" required v-model="cliente.pesopet">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="inputAddress">Idade do Pet</label> <span id="obrigatorio">*</span>
                            <input type="number" class="form-control" id="inputAddress"
                                   placeholder="Idade do Pet" required v-model="cliente.idadepet">
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="inputAddress">Alguma Deficiencia/Doença</label> <span id="obrigatorio">*</span>
                            <input type="text" class="form-control" id="inputAddress"
                                   placeholder="Deficiencia ou Doença" required v-model="cliente.outros">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                        </div>

                        {{--            //Botão--}}
                        <div class="   col-md-5 offset-md-4">
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
