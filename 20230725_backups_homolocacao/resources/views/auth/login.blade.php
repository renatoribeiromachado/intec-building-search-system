@extends('layouts.app')
@section('content')

<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black shadow">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src='{{ url('images/logomarca.png') }}' style="width: 285px;"/>
                                    <h4 class="mt-1 mb-5 pb-1">Pesquisa de Obras</h4>
                                </div>
                                <!--Mensagem que vem da classe app/Http/Middleware/SingleDeviceSessionMiddleware, qdo o mesmo usuario com o mesmo se login se loga em outro dispositivo-->
                                <div class="text-center">
                                    @if(session('message'))
                                        <div class="alert alert-danger">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="{{ route('login') }}" id="myForm">
                                    @csrf  

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

                                    <div class="form-outline mb-4">
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   name="password" required autocomplete="current-password"
                                                   placeholder="Informe a senha">
                                            <button id="togglePassword" class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility()">
                                                <i id="toggleIcon" class="bi bi-eye"></i>
                                            </button>
                                        </div>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button id="submitButton" type="submit" class="btn btn-primary btnSubmit">
                                            {{ __('Avançar') }}
                                        </button>
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            <strong>{{ __('Esqueceu sua senha?') }}</strong>
                                        </a>
                                        @endif
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <p class="small"><a href="https://www.intecbrasil.com.br/site/politicadeprivacidade.html" target="_blank">Política de privacidade</a></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style="background-color: #ff3b00;">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Intec Brasil</h4>
                                <p class="small mb-0">O sistema INTEC de pesquisa de obras é o sistema totalmente online, para pesquisa de oportunidadesde negócios na construção civil de grande porte. A INTEC cataloga diariamente obras em projeto e construção, alimentando nossa base de dados com um verdadeiro Raio-X de cada uma, informando a construtora com os seus dados completos, estágio, prazos e previsões, empresas já contratadas, e contatos de responsáveis pela contratação da mão de obra ou compra de material.
Nosso sistema de pesquisa de obras não limita informações por clicks, dando assim ao nosso assinante, total acesso aos leads que estejam dentro de seu plano.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection