<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        {{-- <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title> --}}

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>SINTEC</title>
    </head>
    <body>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">
            <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Registre-se na SINTEC</h1>
                {{-- <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> --}}
                <p class="col-lg-10 fs-4">Aqui você encontra todo tipo de obra que queira trabalhar.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form method="POST" action="{{ route('register') }}" class="p-4 p-md-5 border rounded-3 bg-light">
                    @csrf
                        
                    <div class="form-floating mb-3">
                        <input type="name" name="name" class="form-control" id="floatingInput" value="{{ old('name') }}" placeholder="José">
                        <label for="floatingInput">Nome</label>
                        @error('name') <span class="text-danger">{{ $errors->first('name') }}</span> @enderror
                    </div>
                        
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" value="{{ old('email') }}" placeholder="jose.alves@gmail.com">
                        <label for="floatingInput">Email</label>
                        @error('email') <span class="text-danger">{{ $errors->first('email') }}</span> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" value="" class="form-control" id="floatingPassword" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                        <label for="floatingPassword">Senha</label>
                        @error('password') <span class="text-danger">{{ $errors->first('password') }}</span> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" value="" class="form-control" id="floatingPassword" required autocomplete="current-password" placeholder="{{ __('Confirm Password') }}" for="password_confirmation">
                        <label for="password_confirmation">Confirme sua Senha</label>
                        @error('password_confirmation') <span class="text-danger">{{ $errors->first('password_confirmation') }}</span> @enderror
                    </div>
                    {{-- <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me">{{ __('Remember me') }}
                        </label>
                    </div> --}}
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>
                    <hr class="my-4">
                    {{-- <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small> --}}
                </form>
            </div>
            </div>
        </div>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>