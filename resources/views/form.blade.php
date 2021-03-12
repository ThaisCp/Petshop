<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulário :: Rotas</title>

    <link rel="stylesheet" href="{{asset('css/app.css') }}">
</head>
<body>

<div class="container m-5">
    <form action="{{ url('/users/1') }}" method="POST" autocomplete="off">

        @method('DELETE')
        <input type="hidden" name="_token" value="{{csrf_token() }}">


        <div class="form-group">
            <label form="first_name"> Primeiro Nome</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="Thais">
        </div>

        <div class="form-group">
            <label form="last_name"> Segundo Nome</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="Cordeiro">
        </div>

        <div class="form-group">
            <label form="email"> E-mail </label>
            <input type="email" name="email" id="first_name" class="form-control" value="thais@jarvisdd.com">
        </div>

        <button class="btn-primary">Enviar</button>
    </form>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
