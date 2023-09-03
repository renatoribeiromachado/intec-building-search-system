<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Intec Obras</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
            >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Adicione o link do ícone do Bootstrap 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="icon" type="image/png" href="{{ url('favicon/favicon.png') }}">
        <link rel="icon" type="image/png" href="{{ url('imgs/favicon.png') }}">
    </head>
    <style>
        /**teste */
        .btn-primary{
            background: #001043 !important; 
        }
        a{
            color: #001043 !important;
            text-decoration: none !important;
        }
    </style>
    <body>

        <main>
            @yield('content')
        </main>

        <footer>
        </footer>

        <!-- include any additional scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
       
        <script>
            /*Alterar valor do botão ao cadastrar*/
            let submitButton = document.getElementById('submitButton');
            let myForm = document.getElementById('myForm');

            myForm.addEventListener('submit', function (event) {
                let emailField = document.getElementById('email');
                let passwordField = document.getElementById('password');

                if (!emailField.checkValidity() || !passwordField.checkValidity()) {
                    event.preventDefault();
                    return;
                }

                submitButton.innerText = 'Aguarde...';
            });
            
            /*Ver password*/
            let passwordField = document.getElementById('password');
            let toggleIcon = document.getElementById('toggleIcon');
            
            function togglePasswordVisibility() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-fill');
                } else {
                    passwordField.type = 'password';
                    toggleIcon.classList.remove('bi-eye-fill');
                    toggleIcon.classList.add('bi-eye');
                }
            }
            
        </script>
    </body>
</html>
