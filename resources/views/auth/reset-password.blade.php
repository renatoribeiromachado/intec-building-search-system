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
                                    <h4 class="mt-1 mb-5 pb-1">Intec Brasil</h4>
                                    <p>Redefina sua senha</p>
                                </div>
                                
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="col-md-12 mb-4">
                                        <label for="email" value="__('Email')" />
                                        <input id="email" class="form-control" type="email" name="email" value="{{ $request->email }}" required autofocus readonly/>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-12 mt-4">
                                        <label for="password" value="__('Password')" />
                                        <input id="password" class="form-control" type="password" name="password" required />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-12 mt-4">
                                        <label for="password_confirmation" value="__('Confirm Password')" />
                                        <input id="password_confirmation" class="form-control"
                                               type="password"
                                               name="password_confirmation" required />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <button class="btn btn-primary">
                                            {{ __('Resetar senha') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection