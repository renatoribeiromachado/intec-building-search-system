<style>
    .social-icons {
        font-size: 24px;
        margin: 0 10px;
        color: #000;
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
            color: #fff;
        }

    }
</style>
<a href="https://api.whatsapp.com/send?phone=5511988327074&text=&text=Ol%C3%A1%20tenho%20d%C3%BAvida%20sobre%20a%20plataforma%2C%20pode%20me%20ajudar%3F"
    class="whatsapp-button" target="_blank">
    <i class="fa fa-whatsapp whatsapp-icon"></i>
    Fale Conosco no WhatsApp
</a>