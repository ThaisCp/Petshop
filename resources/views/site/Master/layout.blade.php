<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seu Pet Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/petshop/public/style.css">
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('site.home') }}">Seu Pet Shop</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{--    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('site.cliente') }}"> <span
                                data-feather="cliente"></span>
                            Cliente <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.cadastroCliente') }}"> <span
                                data-feather="cadastroCliente"></span>
                            Cadastrar Cliente <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.agenda') }}"> <span data-feather="agenda"></span>
                            Agenda <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.estoque') }}"> <span
                                data-feather="estoque"></span>
                            Estoque <span class="sr-only">(current)</span> </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-muted">
                    <span>Administração</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <ul class="nav flex-column mb-1">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('site.home') }}"> <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.financeiro') }}"> <span
                                data-feather="financeiro"></span> Financeiro <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.relatorio') }}"> <span
                                data-feather="relatorio"></span> Relatório <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.fornecedor') }}"> <span
                                data-feather="fornecedor"></span> Fornecedor <span class="sr-only">(current)</span> </a>

                        <a class="nav-link active" href="{{route('site.cadastroEstoque') }}"> <span
                                data-feather="cadastroEstoque"></span> Cadastro de Produtos <span class="sr-only">(current)</span>
                        </a>

                        <a class="nav-link active" href="{{route('site.configuracao') }}"> <span
                                data-feather="configuracao"></span> Configuração <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

        @yield('content')
        <!-- FOOTER -->
            <hr class="my-4">
            <footer class="container text-center ">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; <?= date('Y') ?> Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
                </p>
            </footer>
        </main>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>
