@extends('site.Master.layout')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-0">

                        <div class="card-block">
                            <form  role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="text-center">
                                    <h1>Login</h1>
                                </div>
                                <br/>

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
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif

                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-layers"></i>
                                    </span>
                                    <input type="text"  class="form-control" name="codigoCliente" value="{{ old('codigoCliente') }}" placeholder="Código cliente" required/>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text"  class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required/>
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="Senha" required>
                                </div>

                            <!-- <div class="col-6 text-right">
                                         <a class="btn btn-link" href="{{ route('password.request') }}">
                                             Esqueci minha senha?
                                         </a>
                                     <a class="btn btn-link" href="{{ route('register') }}">

                                        Novo usuario
                                      </a>
                                   </div> -->
                                <div class="row">
                                    <div  class="col-lg-12 text-center" >
                                        <button type="submit" class="btn btn-primary px-4">Entrar</button>
                                    </div>
                                <!-- <div class="col-6 text-right">
                                        <a class="btn btn-light" href="{{ route('password.request') }}">
                                            Esqueci minha senha
                                        </a>
                                      </div> -->
                                    <br/>

                                </div>

                            </form>

                        </div>

                    </div>
                    <!-- <div class="card card-inverse card-primary py-5 d-md-down-none" style="width:44%">

                    </div> -->


                </div>
            </div>
        </div>
    </div>

@endsection
