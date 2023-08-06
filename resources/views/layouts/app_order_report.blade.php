<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        {{-- <link rel="profile" href="https://gmpg.org/xfn/11" /> --}}
        <link
            rel="shortcut icon"
            href="https://www.intecbrasil.com.br/favicon/favicon.png"
            />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
            rel="stylesheet"
            type="text/css"
            />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
            crossorigin="anonymous"
            />
    
        <title>INTECBRASIL - Informações Técnicas da Construção</title>

        <style>
            .remove-margin-bottom {
                margin-bottom: 0;
            }
            .table-bordered {
                border-color: #ff3b00 !important;
            }
            body {
                margin-bottom: 60px;
            }
        </style>

        @stack('report_styles')
    </head>
    <body>

        @yield('content')

        @stack('report_scripts')

    </body>
</html>
