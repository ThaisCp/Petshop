@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-0">

                        <div class="card-block">
                            <form  role="form" method="POST" action="{{ route('password.email') }}">
                                <h4>Resetar senha</h4>
                                <p class="text-muted">Informe seu codigo de cliente e email abaixo</p>

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{ csrf_field() }}

                                @if ($errors->has('codigoCliente'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('codigoCliente') }}</strong>
                                    </div>
                                @endif

                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif

                                <div class="input-group mb-3">
                                        <span class="input-group-addon"><i class="icon-layers"></i>
                                        </span>
                                    <input type="text"  class="form-control" name="codigoCliente" value="{{ old('codigoCliente') }}" placeholder="Cliente" required/>
                                </div>


                                <div class="input-group mb-3">
                                        <span class="input-group-addon"><i class="icon-user"></i>
                                        </span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                </div>






                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-success">
                                            Me envie um link para resetar minha senha
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="btn btn-secondary" href="{{ route('login') }}">
                                            Voltar
                                        </a>
                                    </div>
                                    <br/>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
