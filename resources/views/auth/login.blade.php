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

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @php
        $popupData = App\Models\Popup::where('status', '1')->first();
    @endphp

    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="formCreate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title" id="formCreate">{{ optional($popupData)->title }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {!! nl2br(e(optional($popupData)->description)) !!}
                </div>
            </div>
        </div>
    </div>
    
    <!--Pop-up-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            let statusPopup = {{ $popupData->status ?? 0 }};
            if (statusPopup === 1) {
                $('#popup').modal('show'); // Substitua 'popup' pelo ID real do seu modal
            }
        });
     </script>

</section>
@endsection