@extends('layouts.app')
@section('content')
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-12">
                <div class="card rounded-3 text-black shadow">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src='{{ url('images/logomarca.png') }}' style="width: 285px;"/>
                                    <h4 class="mt-1 mb-5 pb-1">Pesquisa de Obras</h4>
                                    <p>Esqueceu sua senha? <br>Sem problemas. Basta nos informar seu endereço de e-mail<br> e enviaremos por e-mail um link de redefinição de senha que permitirá que você escolha uma nova.</p>
                                </div>

                                <!--Mensagem que vem da classe app/Http/Middleware/SingleDeviceSessionMiddleware, qdo o mesmo usuario com o mesmo se login se loga em outro dispositivo-->
                                <div class="text-center">
                                    @if(session('message'))
                                        <div class="alert alert-danger">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>

                                 <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    @include('layouts.alerts.all-errors')

                                    <div class="form-outline mb-4">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                               placeholder="Digite seu e-mail">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                    
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button id="submitButton" type="submit" class="btn btn-primary btnSubmit">
                                            {{ __('Enviar Link para resetar senha') }}
                                        </button> 
                
                                        <a href="./" class="btn btn-primary text-white">Voltar</a>
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <p class="small"><a href="https://www.intecbrasil.com.br/site/politicadeprivacidade.html" target="_blank">Política de privacidade</a></p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
