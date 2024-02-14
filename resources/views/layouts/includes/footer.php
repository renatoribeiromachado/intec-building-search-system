<style>
    .social-icons {
        font-size: 24px;
        margin: 0 10px;
        color: #ff6b1a;
        transition: color 0.3s;
        /* Adiciona uma transição suave para a mudança de cor */
    }

    .social-icons:hover {
        color: #ff6b1a;
        /* Altera a cor para vermelho ao passar o mouse */
    }

    .icon {
        font-size: 1.6rem;
        /* Ajuste o tamanho do ícone conforme necessário */
    }

    .whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: green;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .whatsapp-icon {
        font-size: 24px;
        margin-right: 10px;
    }

    .label-font-bold {
        font-weight: bold;
    }

    footer {
        color: #ff6b1a;
        text-align: center;
        padding: 20px;
    }

    footer p {
        margin: 10px 0;
    }

    /*Celular*/
    @media (max-width: 767px) {

        /* Estilos específicos para dispositivos móveis */
        .user-icon {
            font-size: 2rem;
            /* Tamanho menor para telas menores */
            top: 40%;
            /* Ajuste a posição vertical conforme necessário para dispositivos móveis */
            left: 18%;
            /* Ajuste a posição horizontal conforme necessário para dispositivos móveis */
        }

        .social-icons {
            font-size: 24px;
            margin: 0 10px;
            color: #ff6b1a;
        }

        footer {
            color: #ff6b1a;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 10px 0;
        }

        .p-mobile-footer {
            font-size: 12px !important;
        }

    }
</style>

<footer class="footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>Redes sociais:<br>
                    <a href="https://www.facebook.com/" target="_blank" class="social-icons">
                        <i class="fa fa-facebook orange-icon"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="social-icons">
                        <i class="fa fa-instagram orange-icon"></i>
                    </a>
                </p>
            </div>

            <div class="col-md-6">
                <p>Entre em contato:<br>
                    contato@intecbrasil.com.br<br>
                    (11) 4659-0013<br>
                    Rua Alencar Araripe, 985 - Sacomã - São Paulo - SP</p>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <p>Intec Brasil - Informações Técnicas da Construção - Todos os direitos reservados</p>
            </div>
        </div>
    </div>

</footer>