@extends('layouts.app_order_report')

@section('content')

    <style>
        /* Estilo para remover a margem inferior das tabelas */
        .remove-margin-bottom {
            margin-bottom: 0;
        }
        .table-bordered {
            border-color: #ff3b00 !important;
        }
        .small-font {
            font-size: 14px; /* Ajuste o tamanho da fonte conforme necessário */
        }

        body {
            font-size: 14px; /* Defina o tamanho de fonte desejado, por exemplo, 12px */
        }

        .h1 {
            font-size: 18px !important; /* Por exemplo, aumente o tamanho do título em 150% */
        }
        /*print*/
        @@media print {
            body {
                font-size: 60% !important; /* Reduza o tamanho da fonte para 75% do tamanho original */
            }

            /* Defina as margens da página para ajustar o conteúdo na impressão */
            @page {
                size: A4; /* Escolha o tamanho de página desejado, como A4 */
                margin: 1cm; /* Defina as margens da página conforme necessário */
            }
            .image-for-print {
                max-width: 10% !important; /* Reduzirá a largura da imagem para ajustar à largura da página impressa */
                height: auto; /* Mantém a proporção de aspecto da imagem */
            }
            .minuta{
                 margin-top:400px;
            }
            .h1 {
                font-size: 70% !important; /* Por exemplo, aumente o tamanho do título em 150% */
            }
            p{
                line-height: 1.2 !important; 
                margin-bottom: 1px;
            }
        }
    </style>
    
    <div class="container">
        <div class="row mt-4">
            <table class="table table-bordered remove-margin-bottom small-font">
                <tr>
                    <th class="text-center h1">
                        INSTRUMENTO DE CONTRATO DE SERVIÇOS AO BANCO DE DADOS INTEC
                    </th>
                </tr>
                <tr>
                    <th class="text-center">
                        <img
                            src="{{ asset('images/intec_default_mini.png') }}"
                            alt="Imagem da Obra"
                            width="280"
                            class="img-fluid image-for-print"
                        >
                    </th>
                </tr>
                <tr>
                    <td class="text-center h1">
                         @if($order->company->associate->linked_company == "36.622.261/0001-90")
                             <strong>CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO LTDA - CNPJ:</strong>
                         @else
                             <strong>INTEC INFORMAÇÕES DA CONSTRUÇÃO LTDA - CNPJ:</strong>
                         @endif
                         {{ $order->company->associate->linked_company }}
                     </td>
                </tr>
                <tr>
                    <th class="text-center h1">
                        PEDIDO DE FORNECIMENTO DE INFORMAÇÕES / DADOS CADASTRAIS
                    </th>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Razão Social:</strong>
                        {{ $order->company->company_name }}
                    </td>
                    <td>
                        <strong>Fantasia:</strong>
                        {{ $order->company->trading_name }}
                    </td>
                    <td>
                        <strong>Código:</strong>
                        {{ $order->company->associate->old_code }}
                        /
                        <strong>Pedido:</strong>
                        {{ $order->old_code }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>CNPJ/CPF:</strong>
                        {{ $order->company->cnpj }}
                    </td>
                    <td>
                        <strong>IE:</strong>
                        {{ $order->company->state_registration }}
                    </td>
                    <td>
                        <strong>Ramo:</strong>
                        {{ $order->company->associate->business_branch }}
                    </td>
                    <td>
                        <strong>Atividade:</strong>
                        {{ $order->company->activityField->description }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Aniversário da empresa:</strong>
                        {{ $order->company->associate->company_date_birth }}
                    </td>
                    <td>
                        <strong>Site:</strong>
                        {{ $order->company->home_page }}
                    </td>
                    <td>
                        <strong>Emissão:</strong>
                        {{ $order->company->associate->contract_due_date_start->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Vendedor(a):</strong>
                        {{ $order->company->associate->salesperson->name }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Endereço:</strong>
                        {{ $order->company->address }}, {{ $order->company->number }}
                    </td>
                    <td>
                        <strong>Bairro:</strong>
                        {{ $order->company->district }}
                    </td>
                    <td>
                        <strong>Cidade:</strong>
                        {{ $order->company->city }}
                    </td>
                    <td>
                        <strong>UF:</strong>
                        {{ $order->company->state }}
                    </td>
                    <td>
                        <strong>CEP:</strong>
                        {{ $order->company->zip_code }}
                    </td>
                </tr>

                {{-- @foreach($contacts as $contact)
                    <tr>
                        <td>
                            <strong>Contato:</strong>
                            {{ $contact->name }}
                        </td>
                        <td>
                            <strong>Telefone:</strong>
                            {{ $contact->ddd }} - {{ $contact->main_phone }}
                        </td>
                        <td colspan="2">
                            <strong>Celular:</strong>
                            {{ $contact->ddd_two }} - {{ $contact->phone_two }}
                        </td>
                        <td colspan="2">
                            <strong>E-mail principal:</strong>
                            {{ $contact->email }}
                        </td>
                    </tr>
                @endforeach --}}
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">
                        Informações de Obras:
                        {{ $order->work_notes }}
                    </th>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <td>
                        <strong>Posição:</strong>
                        {{ $order->situation }}<br>
                        <strong>Plano:</strong>
                        {{ $order->plan->description }}<br>
                        <strong>Início:</strong>
                        {{ $order->start_at->format('d/m/Y') }}<br>
                        <strong>Término:</strong>
                        {{ $order->ends_at->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Valor Original:</strong><br>
                        R$ {{ convertDecimalToBRL($order->original_price) }}<br>
                        <strong>Total de Desconto Aplicado:</strong><br>
                        @if($order->discount_in_percentage)
                            {{ $order->discount }}%
                        @endif
                        
                        @if(! $order->discount_in_percentage)
                            R$ {{ convertDecimalToBRL($order->discount) }}
                        @endif
                    </td>
                    <td>
                        <strong>Valor Concedido:</strong><br>
                        R$ {{ convertDecimalToBRL($order->final_price) }}<br>
                        <strong>1º Vencto:</strong><br>
                        {{ $order->first_due_date->format('d/m/Y') }}
                    </td>
                    <td>
                        <strong>Condição Facilitada De Pagamento:</strong><br>
                        {{ $order->easy_payment_condition }}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">RESUMO DO PEDIDO / OBSERVAÇÕES</th>
                </tr>
                <tr>
                    <td>
                        {!! nl2br($order->notes) !!}
                    </td>
                </tr>
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Telefone/Celular</th>
                    <th>E-Mail</th>
                </tr>

                {{-- @foreach($associateUsers as $associateUser)
                    <tr>
                        <td>
                            {{ $associateUser->name }}
                        </td>
                        <td>
                            {{ optional($associateUser->position)->description }}
                        </td>
                        <td>
                            @if ($associateUser->ddd && $associateUser->main_phone)
                            ({{ $associateUser->ddd }}) {{ $associateUser->main_phone }} /
                            @endif
                            @if ($associateUser->ddd_two && $associateUser->phone_two)
                            ({{ $associateUser->ddd_two }}) {{ $associateUser->phone_two }}
                            @endif
                        </td>
                        <td>
                            {{ $associateUser->user->email }}
                        </td>
                    </tr>
                @endforeach --}}

                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            {{ $contact->name }}
                        </td>
                        <td>
                            {{ optional($contact->position)->description }}
                        </td>
                        <td>
                            {{ isset($contact->ddd) && isset($contact->main_phone) ? ' (' . $contact->ddd . ') ' . $contact->main_phone : ''  }}
                            {{ isset($contact->ddd_two) && isset($contact->phone_two) ? ' / (' . $contact->ddd_two . ') ' . $contact->phone_two : '' }}
                            {{ isset($contact->ddd_three) && isset($contact->phone_three) ? ' / (' . $contact->ddd_three . ') ' . $contact->phone_three : '' }}
                            {{ isset($contact->ddd_four) && isset($contact->phone_four) ? ' / (' . $contact->ddd_four . ') ' . $contact->phone_four : '' }}

                        </td>
                        <td>
                            {{ isset($contact->email) ? $contact->email : '' }}
                            {{ isset($contact->secondary_email) ? '; ' . $contact->secondary_email : '' }}
                            {{ isset($contact->tertiary_email) ? '; ' . $contact->tertiary_email : '' }}

                        </td>
                    </tr>
                @endforeach
            </table>

            <table class="table table-bordered remove-margin-bottom">
                <tr>
                    <th class="text-center">PRODUTOS E SERVIÇOS</th>
                </tr>
                <tr>
                    <td class="text-center">
                        {{ $order->company->associate->products_and_services }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    @if($order->company->associate->linked_company == "30.252.400/0001-55")
        <div class="container minuta">
            <div class="row">  
                <p class="c57">
                    <span class="c0">INSTRUMENTO DE CONTRATO DE SERVI&Ccedil;OS AO BANCO DE DADOS INTEC </span></p>
                <p class="c58"><span class="c0 c12">CONTRATO DE PRESTA&Ccedil;&Atilde;O DE SERVI&Ccedil;OS</span><span class="c0">&nbsp;</span></p>
                <p class="c14"><span class="c0">Por este instrumento, de um lado, a CONTRATANTE, devidamente qualificada no ato de ades&atilde;o ao Contrato de Presta&ccedil;&atilde;o de Servi&ccedil;os, e, de outro, a INTEC - Informa&ccedil;&otilde;es da Constru&ccedil;&atilde;o &ndash; EIRELI, com sede na Rua Alencar Araripe, 985 - Sacom&atilde; - 04253000 - Sao Paulo, SP, inscrita no CNPJ/MF sob o n&ordm; 30.252.400/0001-55, doravante designada INTEC, resolvem firmar este Contrato de Presta&ccedil;&atilde;o de Servi&ccedil;os, que se reger&aacute; mediante as seguintes cl&aacute;usulas e condi&ccedil;&otilde;es: </span></p>
                <p class="c4"><span class="c0 c12">I) DO ACESSO &Agrave;S BASES DE DADOS COMERCIAIS DA INTEC</span><span class="c0">&nbsp;</span></p>
                <p class="c56"><span class="c0">1.1 Este contrato n&atilde;o se destina ao consumidor final e tem por finalidade disponibilizar e servir de insumo a atividade profissional da CONTRATANTE para que possa ter acesso &agrave;s bases de dados comerciais de produtos ou servi&ccedil;os na &aacute;rea da constru&ccedil;&atilde;o civil mantidos em plataforma virtual pela INTEC. </span></p>
                <p class="c9"><span class="c0 c12">Par&aacute;grafo Primeiro:</span><span class="c0">&nbsp;A CONTRATANTE realizar&aacute; a op&ccedil;&atilde;o de acesso as informa&ccedil;&otilde;es de obras por seguimento e, por consequ&ecirc;ncia, ao pre&ccedil;o a que este se refere no momento do aceite eletr&ocirc;nico desta contrata&ccedil;&atilde;o. </span></p>
                <p class="c24 c61"><span class="c0 c12">Par&aacute;grafo Segundo:</span><span class="c0">&nbsp;O pre&ccedil;o ajustado e as condi&ccedil;&otilde;es de pagamento ficar&aacute; registrada no Pedido de Fornecimento de Informa&ccedil;&otilde;es. </span><span class="c0 c12">Par&aacute;grafo</span><span class="c0">&nbsp;Terceiro: A CONTRATANTE ter&aacute; acesso &agrave; 100% das informa&ccedil;&otilde;es contratadas dentro do plano descrito j&aacute; em seu primeiro acesso, sem qualquer limita&ccedil;&atilde;o de quantidade de consultas, buscas ou lote de obras que estejam dentro do plano. </span></p>
                <p class="c5"><span class="c0 c12">Par&aacute;grafo Quarto:</span><span class="c0">&nbsp;Novos blocos de informa&ccedil;&otilde;es ou funcionalidades disponibilizados nos bancos de dados e nos servi&ccedil;os objeto desta contrata&ccedil;&atilde;o poder&atilde;o ser utilizados pela CONTRATANTE sem implicar em qualquer custo adicional. </span></p>
                <p class="c37"><span class="c0 c12">Par&aacute;grafo Quinto:</span><span class="c0">&nbsp;A partir do momento em que a CONTRATADA e CONTRATANTE realizarem a assinatura deste documento, ficar&aacute; formalizada, para todo e qualquer efeito de direito, a sua ades&atilde;o as condi&ccedil;&otilde;es contratuais. </span></p>
                <p class="c6"><span class="c0 c12">Par&aacute;grafo Sexto:</span><span class="c0">&nbsp;No t&eacute;rmino do prazo previsto de contrata&ccedil;&atilde;o, a INTEC entrar&aacute; em contato com a CONTRATANTE para verificar a hip&oacute;tese de renova&ccedil;&atilde;o, ajustando novo valor, pacote e condi&ccedil;&otilde;es de pagamento. </span></p>
                <p class="c52"><span class="c0 c12">Par&aacute;grafo S&eacute;timo:</span><span class="c0">&nbsp;A INTEC n&atilde;o realiza a exporta&ccedil;&atilde;o manual e ou envio de planilhas com as informa&ccedil;&otilde;es do banco de dados contratado, o pr&oacute;prio sistema possui a funcionalidade onde o CONTRATANTE pode realizar a exporta&ccedil;&atilde;o em excel de at&eacute; 500 obras ou empresas por lote exportado. </span></p>
                <p class="c27"><span class="c0 c12">Par&aacute;grafo Oitavo:</span><span class="c0">&nbsp;O CONTRATANTE dos servi&ccedil;os INTEC ter&aacute; um limite pr&eacute;-estabelecido de 01 (uma) licen&ccedil;a de acesso e senha por contrata&ccedil;&atilde;o e para cada login excedente ser&aacute; acrescido o valor &uacute;nico de R$ 500,00 (Quinhentos reais). </span></p>
                <p class="c4"><span class="c0">II) DO PRE&Ccedil;O </span></p>
                <p class="c38"><span class="c0">2.1 A CONTRATANTE pagar&aacute;, anualmente, &agrave; INTEC, o valor ao plano escolhido, para ter acesso por (12) doze meses ao sistema e banco de dados contratado, descrito no Pedido de Fornecimento de Informa&ccedil;&otilde;es. </span></p>
                <p class="c39"><span class="c0 c12">Par&aacute;grafo Primeiro:</span><span class="c0">&nbsp;O pagamento da anuidade poder&aacute; ser parcelado em at&eacute; (12) doze vezes, todavia, o acesso poder&aacute; ser interrompido, sem pr&eacute;vio aviso, caso ocorra a inadimpl&ecirc;ncia de qualquer das parcelas descritas e ajustadas na condi&ccedil;&atilde;o de pagamento. Par&aacute;grafo Segundo: Quando da aquisi&ccedil;&atilde;o do pacote anual a INTEC encaminhar&aacute; por e-mail a nota fiscal &agrave; CONTRATANTE, no valor correspondente a aquisi&ccedil;&atilde;o, conforme informado no Pedido de Fornecimento de Informa&ccedil;&otilde;es. </span></p>
                <p class="c44"><span class="c0 c12">Par&aacute;grafo Terceiro:</span><span class="c0">&nbsp;As partes convencionam que, no caso de n&atilde;o pagamento at&eacute; a data do vencimento, o valor da fatura sofrer&aacute; acr&eacute;scimo de 2% (dois por cento), a t&iacute;tulo de multa por atraso, e juros de mora de (1%) um por cento ao m&ecirc;s, calculados pro rata temporis, desde a data do inadimplemento at&eacute; a do efetivo pagamento. </span></p><p class="c17"><span class="c0 c12">Par&aacute;grafo Quarto:</span><span class="c0">&nbsp;Ocorrendo acumulo de (2) duas parcelas n&atilde;o pagas em seus respectivos vencimentos, as parcelas vincendas, tornam-se vencidas, podendo a CONTRATADA efetuar a sua cobran&ccedil;a administrativa ou judicial, arcando a CONTRATANTE com as custas e despesas, al&eacute;m de honor&aacute;rios advocat&iacute;cios na propor&ccedil;&atilde;o de (20%) vinte por cento sobre o saldo devido, sem preju&iacute;zo da multa, juros de mora de (1%) um por cento ao m&ecirc;s e corre&ccedil;&atilde;o monet&aacute;ria at&eacute; efetiva liquida&ccedil;&atilde;o. </span></p>
                <p class="c54"><span class="c0 c12">Par&aacute;grafo Quinto:</span><span class="c0">&nbsp;A n&atilde;o utiliza&ccedil;&atilde;o dos servi&ccedil;os contratados N&Atilde;O isenta a CONTRATANTE do pagamento da ANUIDADE, sendo livre o acesso pelo per&iacute;odo de (12) doze meses da contrata&ccedil;&atilde;o, exceto em caso de inadimpl&ecirc;ncia. </span></p>
                <p class="c4"><span class="c0">III) DO DISTRATO </span></p>
                <p class="c42"><span class="c0">3.1 Nos casos em que a CONTRATADA cedeu &agrave; CONTRATANTE a condi&ccedil;&atilde;o facilitada de pagamento em at&eacute; 12 parcelas e a CONTRATANTE venha a solicitar o DISTRATO dentro do per&iacute;odo minimo determinado na pagina 1 (um), a CONTRATADA em nome da boa pr&aacute;tica e parceria comercial dar&aacute; como quitado (50%) do saldo residual, e ser&aacute; realizado apenas a cobran&ccedil;a dos outros (50%) restante do saldo residual, cujo pagamento dever&aacute; ser realizado pelo CONTRATANTE em uma &uacute;nica parcela no prazo de (10) dez dias da solicita&ccedil;&atilde;o do DISTRATO, sob pena de incorrer multa de (20%) vinte por cento sobre o saldo devido, acrescido de juros e corre&ccedil;&atilde;o monet&aacute;ria e honor&aacute;rios advocat&iacute;cios. Visto que, conforme cl&aacute;usula 1.1 Paragr&aacute;fo terceiro, a CONTRATADA entregou e disponibilizou desde o in&iacute;cio deste contrato 100% das informa&ccedil;&otilde;es do seu banco de dados dentro do plano contratado sem qualquer limita&ccedil;&atilde;o ou restri&ccedil;&atilde;o de uso. </span></p>
                <p class="c29"><span class="c0">3.2 O DISTRATO poder&aacute; ser realizado a qualquer tempo, com pr&eacute;vio aviso de (30) trinta dias, devendo ser encaminhado um e-mail para posvendas@intecbrasil.com.br, com o assunto DISTRATO. </span></p><p class="c10"><span class="c0">IV) DAS RESPONSABILIDADES E DOS DIREITOS DA INTEC </span></p>
                <p class="c48"><span class="c0">4.1 A INTEC responsabiliza-se por perdas e danos que se originem das informa&ccedil;&otilde;es prestadas, desde que tenha culpa exclusiva.</span></p>
                <p class="c48"><span class="c0">4.2 A realiza&ccedil;&atilde;o ou n&atilde;o realiza&ccedil;&atilde;o de quaisquer neg&oacute;cios jur&iacute;dicos entre a CONTRATANTE e os seus clientes ou eventual insucesso de campanhas levadas a termo com o uso das informa&ccedil;&otilde;es disponibilizadas na plataforma da INTEC, e eventuais perdas e danos que qualquer deles e/ou terceiros possam vir a pleitear, judicial e/ou extrajudicialmente, n&atilde;o s&atilde;o responsabilidade da INTEC.</span></p>
                <p class="c48"><span class="c0">4.3 A INTEC responsabiliza-se pela integridade das informa&ccedil;&otilde;es existentes nas bases de dados e nos servi&ccedil;os contratados, tais como recebidas de suas fontes, bem como n&atilde;o se responsabiliza pelo desempenho do servi&ccedil;o, eventualmente pretendido pela CONTRATANTE.</span></p>  
                <p class="c48"><span class="c0">4.4 A INTEC declara que &eacute; legitima propriet&aacute;ria dos direitos de propriedade intelectual relativos ao sistema de pesquisa, bem como sobre os demais materiais e as informa&ccedil;&otilde;es eventualmente disponibilizados &agrave; CONTRATANTE em raz&atilde;o deste contrato, sendo vedada a sua c&oacute;pia, reprodu&ccedil;&atilde;o ou utiliza&ccedil;&atilde;o, sen&atilde;o nos termos ora contratados. </span></p>
                <p class="c62"><span class="c0 c12">Par&aacute;grafo &Uacute;nico:</span><span class="c0">&nbsp;Todos os direitos de propriedade intelectual sobre a plataforma e a documenta&ccedil;&atilde;o a ele relacionada, bem como sobre os demais materiais e informa&ccedil;&otilde;es eventualmente disponibilizados &agrave; CONTRATANTE em raz&atilde;o deste contrato, permanecer&atilde;o sob a titularidade da INTEC. </span></p>
                <p class="c18"><span class="c0">V) DAS RESPONSABILIDADES E DOS DIREITOS DA CONTRATANTE </span></p>
                <p class="c7"><span class="c0">5.1 A CONTRATANTE responsabiliza-se, integralmente e com exclusividade, perante os seus clientes e/ou terceiros, quanto &agrave; utiliza&ccedil;&atilde;o das informa&ccedil;&otilde;es, dos servi&ccedil;os e da pol&iacute;tica de compra e venda disponibilizados neste contrato, respondendo por perdas e danos que possam, eventualmente, originar-se dessa utiliza&ccedil;&atilde;o. </span></p>
                <p class="c35"><span class="c0">5.2 A CONTRATANTE se obriga a dar ci&ecirc;ncia das obriga&ccedil;&otilde;es ora contratada aos seus empregados e/ou quaisquer terceiros que venham a ter acesso aos servi&ccedil;os objeto deste contrato, em especial no que se refere ao uso das informa&ccedil;&otilde;es e &agrave;s responsabilidades da CONTRATANTE e da INTEC, bem como a fiscalizar a sua observ&acirc;ncia. </span></p>
                <p class="c3"><span class="c0">5.3 A CONTRATANTE reconhece que lhe &eacute; vedado: </span></p>
                <p class="c21"><span class="c0">a) armazenar, divulgar e/ou fornecer a terceiros, em hip&oacute;tese alguma e sob qualquer forma, as informa&ccedil;&otilde;es obtidas por meio deste contrato, inclusive ap&oacute;s o t&eacute;rmino da rela&ccedil;&atilde;o contratual, exceto mediante pr&eacute;via e expressa autoriza&ccedil;&atilde;o da INTEC, a qual jamais ser&aacute; presumida; b) reproduzir qualquer p&aacute;gina ou tela com dados de propriedade da INTEC, inclusive as constantes em seu site, nos manuais ou em qualquer outro regulamento; </span></p>
                <p class="c1"><span class="c0">c) utilizar as informa&ccedil;&otilde;es obtidas para constranger ou coagir, de qualquer maneira que seja, o titular do documento consultado ou, ainda, como justificativa para atos que violem ou ameacem interesses de terceiros; </span></p><p class="c20"><span class="c0">d) vender, repassar ou estabelecer conv&ecirc;nio de repasse de informa&ccedil;&otilde;es com outras empresas, especialmente aquelas que prestam servi&ccedil;os de informa&ccedil;&otilde;es ou assemelhados, salvo mediante pr&eacute;via e expressa autoriza&ccedil;&atilde;o da INTEC, a qual jamais ser&aacute; presumida. </span></p>
                <p class="c18"><span class="c0">VI) DO ACESSO AO BANCO DE DADOS DA INTEC </span></p>
                <p class="c35"><span class="c0">6.1 A INTEC se reserva no direito de monitorar e controlar os acessos realizados pelo CONTRATANTE dos servi&ccedil;os INTEC e identificada qualquer irregularidade no uso das informa&ccedil;&otilde;es, os servi&ccedil;os ser&atilde;o automaticamente suspensos at&eacute; que o processo interno de fiscaliza&ccedil;&atilde;o seja concluido, sendo a CONTRATANTE notificada a esclarecer as irregularidades. </span></p>
                <p class="c10"><span class="c0 c12">Par&aacute;grafo Primeiro:</span><span class="c0">&nbsp;Ocorrendo irregularidades, tais como: </span></p>
                <p class="c8"><span class="c0">a) Ceder Logins e senha &agrave; terceiros para que tenham acesso a plataforma; </span></p>
                <p class="c41"><span class="c0">b) Comercializar dados obtidos na plataforma da INTEC, a CONTRATANTE sofrer&aacute; uma pena pecuni&aacute;ria equivalente a (1) uma anuidade contratada, al&eacute;m de interrup&ccedil;&atilde;o definitiva no acesso &agrave; plataforma. </span></p>
                <p class="c59"><span class="c0">6.2 A CONTRATANTE responsabiliza-se, por si, seus empregados e/ou prepostos, pelo resguardo de sua(s) senha(s), n&atilde;o as repassando a terceiros, inclusive &agrave; INTEC, sob qualquer hip&oacute;tese. </span></p>
                <p class="c53"><span class="c0">6.3 Caso n&atilde;o sejam observadas as condi&ccedil;&otilde;es previstas nas al&iacute;neas desta cl&aacute;usula, a CONTRATANTE assumir&aacute; exclusivamente todo e qualquer dano decorrente dessa inobserv&acirc;ncia. </span></p>
                <p class="c18"><span class="c0 c12">VII) DAS PR&Aacute;TICAS DE COMPLIANCE ANTICORRUP&Ccedil;&Atilde;O E CONCORR&Ecirc;NCIA DESLEAL</span><span class="c0">&nbsp;</span></p>
                <p class="c15"><span class="c0">7.1 As partes declaram, para todos os efeitos, que exercer&atilde;o as suas atividades observando os preceitos &eacute;tico-profissionais, em conformidade com a legisla&ccedil;&atilde;o vigente e que det&ecirc;m as aprova&ccedil;&otilde;es necess&aacute;rias &agrave; celebra&ccedil;&atilde;o deste contrato e ao cumprimento das</span></p>
                <p class="c23"><span class="c0">obriga&ccedil;&otilde;es nele previstas. </span></p>
                <p class="c55"><span class="c0">7.2 As partes declaram, garantem e aceitam que, com rela&ccedil;&atilde;o a este contrato, n&atilde;o houve e n&atilde;o haver&aacute; nenhuma solicita&ccedil;&atilde;o, exig&ecirc;ncia, cobran&ccedil;a ou obten&ccedil;&atilde;o para si e para outrem de vantagem indevida ou promessa de vantagem indevida, a pretexto de influir em ato praticado por agente p&uacute;blico e/ou privado, restando expresso, ainda, que nenhum favorecimento, taxa, dinheiro ou qualquer outro objeto de valor foi ou ser&aacute; pago, oferecido, doado ou prometido pelas partes ou por qualquer de seus agentes ou empregados, direta ou indiretamente, especialmente, mas n&atilde;o se limitando, a qualquer: </span></p>
                <p class="c63"><span class="c0">a) pessoa (natural ou jur&iacute;dica) que exer&ccedil;a cargo, emprego ou fun&ccedil;&atilde;o p&uacute;blica ou trabalhe em entidade paraestatal, funda&ccedil;&otilde;es, empresas p&uacute;blicas, sociedades de economia mista ou autarquia, ainda que transitoriamente ou sem remunera&ccedil;&atilde;o; que trabalhe para empresa prestadora de servi&ccedil;o INTEC ou conveniada para a execu&ccedil;&atilde;o de atividade t&iacute;pica da administra&ccedil;&atilde;o p&uacute;blica; </span></p>
                <p class="c47"><span class="c0">b) partido pol&iacute;tico ou autoridade partid&aacute;ria ou qualquer candidato a cargo pol&iacute;tico; </span></p>
                <p class="c43"><span class="c0">c) representante que esteja atuando por ou em nome de qualquer entidade estatal ou paraestatal, funda&ccedil;&otilde;es, empresas p&uacute;blicas, sociedades de economia mista ou autarquia, ainda que transitoriamente ou sem remunera&ccedil;&atilde;o; que trabalhe para empresa prestadora de servi&ccedil;o INTEC ou conveniada para a execu&ccedil;&atilde;o de atividade t&iacute;pica da administra&ccedil;&atilde;o p&uacute;blica; </span></p>
                <p class="c64"><span class="c0">d) pessoa (natural ou jur&iacute;dica) que exer&ccedil;a cargo, emprego ou fun&ccedil;&atilde;o em qualquer organiza&ccedil;&atilde;o p&uacute;blica internacional (considerando-se cada um desses indiv&iacute;duos descritos nos itens a, b, c, d como &ldquo;Autoridade P&uacute;blica&rdquo;), com o intuito de: </span></p>
                <p class="c2"><span class="c0">a) exercer influ&ecirc;ncia indevida sobre qualquer Autoridade P&uacute;blica, em sua capacidade oficial, societ&aacute;ria ou comercial; b) induzir qualquer Autoridade P&uacute;blica a realizar ou deixar de realizar qualquer ato, infringindo ou n&atilde;o as suas atribui&ccedil;&otilde;es legais; c) induzir indevidamente qualquer Autoridade P&uacute;blica a usar de sua influ&ecirc;ncia perante a Administra&ccedil;&atilde;o direta ou indireta para afetar ou influenciar qualquer ato ou decis&atilde;o de sua responsabilidade; </span></p>
                <p class="c23"><span class="c0">d) obter qualquer vantagem indevida ou que seja contr&aacute;ria ao interesse p&uacute;blico. </span></p>
                <p class="c40"><span class="c0">7.3 As partes, seus agentes ou empregados devem combater toda e qualquer iniciativa que seja contra a livre concorr&ecirc;ncia, especialmente, mas n&atilde;o se limitando, a iniciativas indutoras &agrave; forma&ccedil;&atilde;o de cartel. </span></p>
                <p class="c16"><span class="c0">7.4 As partes se comprometem a estabelecer de forma clara e precisa os deveres e as obriga&ccedil;&otilde;es de seus agentes e/ou empregados em quest&otilde;es comerciais, para que estejam sempre em conformidade com as leis, as normas vigentes e as determina&ccedil;&otilde;es deste contrato.</span></p>  
                <p class="c16"><span class="c0">7.5 As partes ficar&atilde;o sujeitas a auditorias e visitas, realizadas a crit&eacute;rio da outra parte, para a verifica&ccedil;&atilde;o do cumprimento das pr&aacute;ticas estabelecidas neste t&iacute;tulo. </span></p>
                <p class="c19"><span class="c0">7.6 A CONTRATANTE est&aacute; impedida de realizar qualquer tipo de proposta de trabalho ou, ainda, de realizar a contrata&ccedil;&atilde;o, de forma direta ou indireta de qualquer dos colaboradores da INTEC, isso na const&acirc;ncia do contrato de trabalho, estendendo-se pelo prazo de (90) noventa dias ap&oacute;s o t&eacute;rmino da rela&ccedil;&atilde;o de emprego com o colaborador, sob pena de incorrer em concorr&ecirc;ncia desleal, com a punibilidade de (100) cem vezes o valor do sal&aacute;rio do obreiro assediado. </span></p>
                <p class="c8"><span class="c0">7.7 A viola&ccedil;&atilde;o de qualquer das pr&aacute;ticas estabelecidas neste t&iacute;tulo poder&aacute; ensejar a imediata rescis&atilde;o deste contrato pela parte inocente. </span></p>
                <p class="c60"><span class="c0 c12">VIII) SUPORTE T&Eacute;CNICO E ATENDIMENTO AO CLIENTE</span><span class="c0">&nbsp;</span></p>
                <p class="c24 c51"><span class="c0">8.1 O Suporte T&eacute;cnico e o Atendimento ao Cliente s&atilde;o permanentes via e-mail, telefone, WhatsApp ou presencial na sede da INTEC. Hor&aacute;rio de atendimento das: 09:00hs &agrave;s 17:00hs de segunda &aacute; sexta-feira, exceto feriado &ndash; R: Alencar Araripe n&ordm; 985 2&ordm; andar Sacom&atilde; SP S&atilde;oPaulo. Telefone: (11)4659-0013 WhatsApp (11)98832-7074 E-mails: posvendas@intecbrasil.com.br; beatriz@intecbrasil.com.br </span></p>
                <p class="c4"><span class="c0">IX) TREINAMENTOS </span></p>
                <p class="c32"><span class="c0">9.1 Os Treinamentos para usu&aacute;rios do sistema s&atilde;o realizados via Google meet, telefone ou presencial na sede da INTEC e devem ser agendados pelo CONTRATANTE dos servi&ccedil;os INTEC com o uso dos canais de comunica&ccedil;&atilde;o acima descritos. </span></p>
                <p class="c18"><span class="c0 c12">X) DO T&Iacute;TULO EXECUTIVO</span><span class="c0">&nbsp;</span></p>
                <p class="c34"><span class="c0">10.1 Este instrumento de contrato possui for&ccedil;a de t&iacute;tulo executivo extrajudicial nos termos do art. 784, III do C&oacute;digo de Processo Civil, sem preju&iacute;zo do envio dos t&iacute;tulos vencidos ao Cart&oacute;rio de Protesto da Capital do Estado de S&atilde;o Paulo ora considerada pra&ccedil;a de pagamento. </span></p>
                <p class="c18"><span class="c0 c12">XI) DAS DISPOSI&Ccedil;&Otilde;ES GERAIS</span><span class="c0">&nbsp;</span></p>
                <p class="c36"><span class="c0">11.1 A INTEC assegura que os servi&ccedil;os online estar&atilde;o dispon&iacute;veis para atendimento &agrave;s necessidades da CONTRATANTE, conforme ajustado neste contrato, (24) vinte e quatro horas por dia, (7) sete dias por semana, em at&eacute; (97%) noventa e sete por cento do per&iacute;odo considerado para faturamento, exclu&iacute;das as paradas programadas, os casos fortuitos e de for&ccedil;a maior, sem preju&iacute;zo do quanto disposto no pre&ccedil;o ajustado. </span></p>
                <p class="c50"><span class="c0">11.2 A CONTRATANTE tem ci&ecirc;ncia de que &eacute; poss&iacute;vel que alguns produtos n&atilde;o estejam dispon&iacute;veis para consulta em determinada regi&atilde;o.</span></p> 
                <p class="c50"><span class="c0">11.3 Qualquer toler&acirc;ncia de uma das partes em rela&ccedil;&atilde;o &agrave; outra s&oacute; importar&aacute; modifica&ccedil;&atilde;o do presente instrumento se expressamente formalizada. </span></p>
                <p class="c28"><span class="c0">11.4 Os servi&ccedil;os contratados devem ser utilizados pela CONTRATANTE como insumo para a atividade profissional exercida, n&atilde;o podendo servir ao consumidor como destinat&aacute;rio final. </span></p>
                <p class="c30"><span class="c0">11.5 O presente instrumento ser&aacute; assinado eletronicamente, conforme determina a MP 2.200-2/01,em seu art. 10&ordm;, &sect;2, instrumento digital que ser&aacute; Sincronizado com o NTP.br e Observat&oacute;rio Nacional (ON). </span></p>
                <p class="c4"><span class="c0">FORO </span></p>
                <p class="c1 c13"><span class="c0">As partes elegem o Foro da Comarca de S&atilde;o Paulo como o &uacute;nico competente para dirimir quaisquer d&uacute;vidas decorrentes deste Contrato, com ren&uacute;ncia expressa a qualquer outro, por mais privilegiado que seja. </span></p>
                <p class="c18 c24"><span class="c0">TERMO DE MONITORAMENTO DE DADOS PESSOAIS </span></p>
                <p class="c22"><span class="c0">1. A CONTRATANTE dever&aacute; informar seu e-mail, para que seja poss&iacute;vel gerar um relat&oacute;rio dentro da &aacute;rea logada, contendo todas as informa&ccedil;&otilde;es a respeito dos dados que, eventualmente, forem identificados na plataforma da INTEC, atreladas ao e-mail informado.</span></p> 
                <p class="c22"><span class="c0">2. As informa&ccedil;&otilde;es identificadas permanecer&atilde;o dispon&iacute;veis para que a CONTRATANTE possa visualiz&aacute;-las na &aacute;rea logada a qualquer tempo.</span></p> 
                <p class="c22"><span class="c0">3. A CONTRATANTE autoriza a INTEC a utilizar os dados pessoais mencionados neste instrumento de contrato de presta&ccedil;&atilde;o de servi&ccedil;os, exclusivamente para a finalidade de manuten&ccedil;&atilde;o do contrato, nos termos deste instrumento, os quais n&atilde;o ser&atilde;o compartilhados com nenhum terceiro. </span></p>
                <p class="c49"><span class="c0">4. A CONTRATANTE tem ci&ecirc;ncia de que a INTEC poder&aacute; processar os seus dados no Brasil e obriga-se a adotar todas as provid&ecirc;ncias eventualmente exigidas pela legisla&ccedil;&atilde;o vigente para o referido processamento. </span></p>
                <p class="c3"><span class="c0">5. &Eacute; a partir do seu consentimento que tratamos os seus dados pessoais. </span></p>
                <p class="c11"><span class="c0">6. O consentimento &eacute; a manifesta&ccedil;&atilde;o livre, informada e inequ&iacute;voca pela qual voc&ecirc; autoriza a INTEC INFORMA&Ccedil;OES DA CONSTRU&Ccedil;&Atilde;O EIRELI a tratar seus dados. Assim, em conson&acirc;ncia com a Lei Geral de Prote&ccedil;&atilde;o de Dados, seus dados s&oacute; ser&atilde;o coletados, tratados e armazenados mediante pr&eacute;vio e expresso consentimento, com a finalidade espec&iacute;fica para nossa rela&ccedil;&atilde;o comercial. </span></p>
                <p class="c46"><span class="c0">7. O seu consentimento ser&aacute; obtido de forma espec&iacute;fica para esta contrata&ccedil;&atilde;o de servi&ccedil;os, evidenciando o compromisso de transpar&ecirc;ncia e boa-f&eacute; da </span><span class="c0 c12">INTEC INFORMA&Ccedil;OES DA CONSTRU&Ccedil;&Atilde;O EIRELI</span><span class="c0">&nbsp;para com seus usu&aacute;rios/clientes, seguindo as regula&ccedil;&otilde;es legislativas pertinentes.</span></p> 
                <p class="c46"><span class="c0">8. Ao utilizar os servi&ccedil;os da INTEC INFORMA&Ccedil;OES DA CONSTRU&Ccedil;&Atilde;O EIRELI e fornecer seus dados pessoais, voc&ecirc; est&aacute; ciente e consentindo com as disposi&ccedil;&otilde;es desta Pol&iacute;tica de Privacidade, al&eacute;m de conhecer seus direitos e como exerc&ecirc;-los. </span></p>
                <p class="c45"><span class="c0">9. A qualquer tempo e sem nenhum custo, voc&ecirc; poder&aacute; revogar seu consentimento e para isso basta comunicar o nosso Encarregado de Dados, Marcelo Passiani, pelo endere&ccedil;o </span><span class="c31">passiani@dpogestaocadastral.com.br</span><span class="c0">&nbsp;</span></p>
                <p class="c26"><span class="c0">10. A </span><span class="c0 c12">INTEC INFORMA&Ccedil;OES DA CONSTRU&Ccedil;&Atilde;O EIRELI</span><span class="c0">&nbsp;disponibiliza os seguintes meios para que voc&ecirc; possa entrar em contato conosco para exercer seus direitos de titular nosso Encarregado de Dados, Marcelo Passiani, pelo endere&ccedil;o </span><span class="c31">passiani@dpogestaocadastral.com.br</span></p>
                <p class="c26"><span class="c0">11. Caso tenha d&uacute;vidas sobre esta Pol&iacute;tica de Privacidade ou sobre os dados pessoais que tratamos, voc&ecirc; pode entrar em contato com o nosso Encarregado de Prote&ccedil;&atilde;o de Dados Pessoais, sendo o advogado Marcelo Passiani, pelo endere&ccedil;o </span><span class="c31">passiani@dpogestaocadastral.com.br</span><span class="c0">&nbsp;</span></p>
                <p class="c30"><span class="c0">12. O presente instrumento ser&aacute; assinado eletronicamente, conforme determina a MP 2.200-2/01,em seu art. 10&ordm;, &sect;2, instrumento digital que ser&aacute; Sincronizado com o NTP.br e Observat&oacute;rio Nacional (ON).&nbsp;</span>
                </p>
            </div>
        </div>
    @else
        <div class="container minuta">
            <div class="row">
                <p>INSTRUMENTO DE CONTRATO DE SERVIÇOS AO BANCO DE DADOS INTEC</p> 
                <p>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</p>
                <p>Por este instrumento, de um lado, a CONTRATANTE, devidamente qualificada no ato de adesão ao Contrato de Prestação de Serviços, e, de outro, a
                CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO LTDA, com sede na Rua Alencar Araripe, 985 - Sacomã - 04253000 - Sao Paulo, SP, inscrita
                no CNPJ/MF sob o nº 36.622.261/0001-90, doravante designada INTEC, resolvem firmar este Contrato de Prestação de Serviços, que se regerá mediante
                as seguintes cláusulas e condições:</p>
                <p>I) DO ACESSO ÀS BASES DE DADOS COMERCIAIS DA INTEC</p>
                <p>1.1 Este contrato não se destina ao consumidor final e tem por finalidade disponibilizar e servir de insumo a atividade profissional da CONTRATANTE
                para que possa ter acesso às bases de dados comerciais de produtos ou serviços na área da construção civil mantidos em plataforma virtual pela INTEC.
                Parágrafo Primeiro: A CONTRATANTE realizará a opção de acesso as informações de obras por seguimento e, por consequência, ao preço a que este
                se refere no momento do aceite eletrônico desta contratação.</p>
                <p>Parágrafo Segundo: O preço ajustado e as condições de pagamento ficará registrada no Pedido de Fornecimento de Informações. Parágrafo Terceiro: A
                CONTRATANTE terá acesso à 100% das informações contratadas dentro do plano descrito já em seu primeiro acesso, sem qualquer limitação de
                quantidade de consultas, buscas ou lote de obras que estejam dentro do plano.</p>
                <p>Parágrafo Quarto: Novos blocos de informações ou funcionalidades disponibilizados nos bancos de dados e nos serviços objeto desta contratação
                    poderão ser utilizados pela CONTRATANTE sem implicar em qualquer custo adicional.</p>
                <p>Parágrafo Quinto: A partir do momento em que a CONTRATADA e CONTRATANTE realizarem a assinatura deste documento, ficará formalizada, para
                    todo e qualquer efeito de direito, a sua adesão as condições contratuais.</p>
                <p>Parágrafo Sexto: No término do prazo previsto de contratação, a INTEC entrará em contato com a CONTRATANTE para verificar a hipótese de renovação,
                    ajustando novo valor, pacote e condições de pagamento.</p>
                <p>Parágrafo Sétimo: A INTEC não realiza a exportação manual e ou envio de planilhas com as informações do banco de dados contratado, o próprio sistema
                possui a funcionalidade onde o CONTRATANTE pode realizar a exportação em excel de até 500 obras ou empresas por lote exportado.
                Parágrafo Oitavo: O CONTRATANTE dos serviços INTEC terá um limite pré-estabelecido de 01 (uma) licença de acesso e senha por contratação e para
                cada login excedente será acrescido o valor único de R$ 500,00 (Quinhentos reais).</p>
                <p>II) DO PREÇO</p>
                <p>2.1 A CONTRATANTE pagará, anualmente, à INTEC, o valor ao plano escolhido, para ter acesso por (12) doze meses ao sistema e banco de dados
                    contratado, descrito no Pedido de Fornecimento de Informações.</p>
                <p>Parágrafo Primeiro: O pagamento da anuidade poderá ser parcelado em até (12) doze vezes, todavia, o acesso poderá ser interrompido, sem prévio
                    aviso, caso ocorra a inadimplência de qualquer das parcelas descritas e ajustadas na condição de pagamento.</p>
                <p>Parágrafo Segundo: Quando da aquisição do pacote anual a INTEC encaminhará por e-mail a nota fiscal à CONTRATANTE, no valor correspondente a
                    aquisição, conforme informado no Pedido de Fornecimento de Informações.</p>
                <p>Parágrafo Terceiro: As partes convencionam que, no caso de não pagamento até a data do vencimento, o valor da fatura sofrerá acréscimo de 2% (dois
                por cento), a título de multa por atraso, e juros de mora de (1%) um por cento ao mês, calculados pro rata temporis, desde a data do inadimplemento até
                a do efetivo pagamento.</p>
                <p>Parágrafo Quarto: Ocorrendo acumulo de (2) duas parcelas não pagas em seus respectivos vencimentos, as parcelas vincendas, tornam-se vencidas,
                podendo a CONTRATADA efetuar a sua cobrança administrativa ou judicial, arcando a CONTRATANTE com as custas e despesas, além de honorários
                advocatícios na proporção de (20%) vinte por cento sobre o saldo devido, sem prejuízo da multa, juros de mora de (1%) um por cento ao mês e correção
                monetária até efetiva liquidação.</p>
                <p>Parágrafo Quinto: A não utilização dos serviços contratados NÃO isenta a CONTRATANTE do pagamento da ANUIDADE, sendo livre o acesso pelo
                    período de (12) doze meses da contratação, exceto em caso de inadimplência.</p>
                <p>III) DO DISTRATO</p>
                <p>3.1 Nos casos em que a CONTRATADA cedeu à CONTRATANTE a condição facilitada de pagamento em até 12 parcelas e a CONTRATANTE venha a
                solicitar o DISTRATO dentro do período minimo determinado na pagina 1 (um), a CONTRATADA em nome da boa prática e parceria comercial dará
                como quitado (50%) do saldo residual, e será realizado apenas a cobrança dos outros (50%) restante do saldo residual, cujo pagamento deverá ser
                realizado pelo CONTRATANTE em uma única parcela no prazo de (10) dez dias da solicitação do DISTRATO, sob pena de incorrer multa de (20%) vinte
                por cento sobre o saldo devido, acrescido de juros e correção monetária e honorários advocatícios. Visto que, conforme cláusula 1.1 Paragráfo terceiro,
                a CONTRATADA entregou e disponibilizou desde o início deste contrato 100% das informações do seu banco de dados dentro do plano contratado sem
                qualquer limitação ou restrição de uso.</p>
                <p>3.2 O DISTRATO poderá ser realizado a qualquer tempo, com prévio aviso de (30) trinta dias, devendo ser encaminhado um e-mail para
                    posvendas@intecbrasil.com.br, com o assunto DISTRATO.</p>
                <p>IV) DAS RESPONSABILIDADES E DOS DIREITOS DA INTEC</p>
                <p>4.1 A INTEC responsabiliza-se por perdas e danos que se originem das informações prestadas, desde que tenha culpa exclusiva.</p>
                <p>4.2 A realização ou não realização de quaisquer negócios jurídicos entre a CONTRATANTE e os seus clientes ou eventual insucesso de campanhas
                levadas a termo com o uso das informações disponibilizadas na plataforma da INTEC, e eventuais perdas e danos que qualquer deles e/ou terceiros
                possam vir a pleitear, judicial e/ou extrajudicialmente, não são responsabilidade da INTEC.</p>
                <p>4.3 A INTEC responsabiliza-se pela integridade das informações existentes nas bases de dados e nos serviços contratados, tais como recebidas de suas
                    fontes, bem como não se responsabiliza pelo desempenho do serviço, eventualmente pretendido pela CONTRATANTE.</p>
                <p>4.4 A INTEC declara que é legitima proprietária dos direitos de propriedade intelectual relativos ao sistema de pesquisa, bem como sobre os demais
                materiais e as informações eventualmente disponibilizados à CONTRATANTE em razão deste contrato, sendo vedada a sua cópia, reprodução ou
                utilização, senão nos termos ora contratados.</p>
                <p>Parágrafo Único: Todos os direitos de propriedade intelectual sobre a plataforma e a documentação a ele relacionada, bem como sobre os demais
                    materiais e informações eventualmente disponibilizados à CONTRATANTE em razão deste contrato, permanecerão sob a titularidade da INTEC.</p>
                <p>V) DAS RESPONSABILIDADES E DOS DIREITOS DA CONTRATANTE</p>
                <p>5.1 A CONTRATANTE responsabiliza-se, integralmente e com exclusividade, perante os seus clientes e/ou terceiros, quanto à utilização das informações,
                dos serviços e da política de compra e venda disponibilizados neste contrato, respondendo por perdas e danos que possam, eventualmente, originar-se
                dessa utilização.</p>
                <p>5.2 A CONTRATANTE se obriga a dar ciência das obrigações ora contratada aos seus empregados e/ou quaisquer terceiros que venham a ter acesso
                aos serviços objeto deste contrato, em especial no que se refere ao uso das informações e às responsabilidades da CONTRATANTE e da INTEC, bem
                como a fiscalizar a sua observância.</p>
                <p>5.3 A CONTRATANTE reconhece que lhe é vedado:</p>
                <p>a) armazenar, divulgar e/ou fornecer a terceiros, em hipótese alguma e sob qualquer forma, as informações obtidas por meio deste contrato, inclusive
                    após o término da relação contratual, exceto mediante prévia e expressa autorização da INTEC, a qual jamais será presumida;</p>
                <p>b) reproduzir qualquer página ou tela com dados de propriedade da INTEC, inclusive as constantes em seu site, nos manuais ou em qualquer outro
                    regulamento;</p>
                <p>c) utilizar as informações obtidas para constranger ou coagir, de qualquer maneira que seja, o titular do documento consultado ou, ainda, como justificativa
                para atos que violem ou ameacem interesses de terceiros;</p>
                <p>d) vender, repassar ou estabelecer convênio de repasse de informações com outras empresas, especialmente aquelas que prestam serviços de
                    informações ou assemelhados, salvo mediante prévia e expressa autorização da INTEC, a qual jamais será presumida.</p>
                <p>VI) DO ACESSO AO BANCO DE DADOS DA INTEC</p>
                <p>6.1 A INTEC se reserva no direito de monitorar e controlar os acessos realizados pelo CONTRATANTE dos serviços INTEC e identificada qualquer
                irregularidade no uso das informações, os serviços serão automaticamente suspensos até que o processo interno de fiscalização seja concluido, sendo
                a CONTRATANTE notificada a esclarecer as irregularidades.</p>
                <p>Parágrafo Primeiro: Ocorrendo irregularidades, tais como:</p>
                <p>a) Ceder Logins e senha à terceiros para que tenham acesso a plataforma;</p>
                <p>b) Comercializar dados obtidos na plataforma da INTEC, a CONTRATANTE sofrerá uma pena pecuniária equivalente a (1) uma anuidade contratada,
                    além de interrupção definitiva no acesso à plataforma.</p>
                <p>6.2 A CONTRATANTE responsabiliza-se, por si, seus empregados e/ou prepostos, pelo resguardo de sua(s) senha(s), não as repassando a terceiros,
                    inclusive à INTEC, sob qualquer hipótese.</p>
                <p>6.3 Caso não sejam observadas as condições previstas nas alíneas desta cláusula, a CONTRATANTE assumirá exclusivamente todo e qualquer dano
                    decorrente dessa inobservância.</p>
                <p>VII) DAS PRÁTICAS DE COMPLIANCE ANTICORRUPÇÃO E CONCORRÊNCIA DESLEAL</p>
                <p>7.1 As partes declaram, para todos os efeitos, que exercerão as suas atividades observando os preceitos ético-profissionais, em conformidade com a
                    legislação vigente e que detêm as aprovações necessárias à celebração deste contrato e ao cumprimento das obrigações nele previstas.</p>
                <p>7.2 As partes declaram, garantem e aceitam que, com relação a este contrato, não houve e não haverá nenhuma solicitação, exigência, cobrança ou
                obtenção para si e para outrem de vantagem indevida ou promessa de vantagem indevida, a pretexto de influir em ato praticado por agente público e/ou
                privado, restando expresso, ainda, que nenhum favorecimento, taxa, dinheiro ou qualquer outro objeto de valor foi ou será pago, oferecido, doado ou
                prometido pelas partes ou por qualquer de seus agentes ou empregados, direta ou indiretamente, especialmente, mas não se limitando, a qualquer:</p>
                <p>a) pessoa (natural ou jurídica) que exerça cargo, emprego ou função pública ou trabalhe em entidade paraestatal, fundações, empresas públicas,
                sociedades de economia mista ou autarquia, ainda que transitoriamente ou sem remuneração; que trabalhe para empresa prestadora de serviço INTEC
                ou conveniada para a execução de atividade típica da administração pública;</p>
                <p>b) partido político ou autoridade partidária ou qualquer candidato a cargo político;</p>
                <p>c) representante que esteja atuando por ou em nome de qualquer entidade estatal ou paraestatal, fundações, empresas públicas, sociedades de economia
                mista ou autarquia, ainda que transitoriamente ou sem remuneração; que trabalhe para empresa prestadora de serviço INTEC ou conveniada para a
                execução de atividade típica da administração pública;</p>
                <p>d) pessoa (natural ou jurídica) que exerça cargo, emprego ou função em qualquer organização pública internacional (considerando-se cada um desses
                    indivíduos descritos nos itens a, b, c, d como “Autoridade Pública”), com o intuito de:</p>
                <p>a) exercer influência indevida sobre qualquer Autoridade Pública, em sua capacidade oficial, societária ou comercial;</p>
                <p>b) induzir qualquer Autoridade Pública a realizar ou deixar de realizar qualquer ato, infringindo ou não as suas atribuições legais;</p>
                <p>c) induzir indevidamente qualquer Autoridade Pública a usar de sua influência perante a Administração direta ou indireta para afetar ou influenciar
                qualquer ato ou decisão de sua responsabilidade;</p>
                <p>d) obter qualquer vantagem indevida ou que seja contrária ao interesse público.</p>
                <p>7.3 As partes, seus agentes ou empregados devem combater toda e qualquer iniciativa que seja contra a livre concorrência, especialmente, mas não se
                    limitando, a iniciativas indutoras à formação de cartel.</p>
                <p>7.4 As partes se comprometem a estabelecer de forma clara e precisa os deveres e as obrigações de seus agentes e/ou empregados em questões
                comerciais, para que estejam sempre em conformidade com as leis, as normas vigentes e as determinações deste contrato. 7.5 As partes ficarão sujeitas
                a auditorias e visitas, realizadas a critério da outra parte, para a verificação do cumprimento das práticas estabelecidas neste título.</p>
                <p>7.6 A CONTRATANTE está impedida de realizar qualquer tipo de proposta de trabalho ou, ainda, de realizar a contratação, de forma direta ou indireta
                de qualquer dos colaboradores da INTEC, isso na constância do contrato de trabalho, estendendo-se pelo prazo de (90) noventa dias após o término da
                relação de emprego com o colaborador, sob pena de incorrer em concorrência desleal, com a punibilidade de (100) cem vezes o valor do salário do
                obreiro assediado.</p>
                <p>7.7 A violação de qualquer das práticas estabelecidas neste título poderá ensejar a imediata rescisão deste contrato pela parte inocente.</p>
                <p>VIII) SUPORTE TÉCNICO E ATENDIMENTO AO CLIENTE</p>
                <p>8.1 O Suporte Técnico e o Atendimento ao Cliente são permanentes via e-mail, telefone, WhatsApp ou presencial na sede da INTEC. Horário de
                    atendimento das: 09:00hs às 17:00hs de segunda á sexta-feira, exceto feriado – R: Alencar Araripe nº 985 2º andar Sacomã SP SãoPaulo. Telefone:
                (11)4659-0013 WhatsApp (11)98832-7074 E-mails: posvendas@intecbrasil.com.br; beatriz@intecbrasil.com.br</p>
                <p>IX) TREINAMENTOS</p>
                <p>9.1 Os Treinamentos para usuários do sistema são realizados via Google meet, telefone ou presencial na sede da INTEC e devem ser agendados pelo
                    CONTRATANTE dos serviços INTEC com o uso dos canais de comunicação acima descritos.</p>
                <p>X) DO TÍTULO EXECUTIVO</p>
                <p>10.1 Este instrumento de contrato possui força de título executivo extrajudicial nos termos do art. 784, III do Código de Processo Civil, sem prejuízo do
                    envio dos títulos vencidos ao Cartório de Protesto da Capital do Estado de São Paulo ora considerada praça de pagamento.</p>
                <p>XI) DAS DISPOSIÇÕES GERAIS</p>
                <p>11.1 A INTEC assegura que os serviços online estarão disponíveis para atendimento às necessidades da CONTRATANTE, conforme ajustado neste
                contrato, (24) vinte e quatro horas por dia, (7) sete dias por semana, em até (97%) noventa e sete por cento do período considerado para faturamento,
                excluídas as paradas programadas, os casos fortuitos e de força maior, sem prejuízo do quanto disposto no preço ajustado.</p>
                <p>11.2 A CONTRATANTE tem ciência de que é possível que alguns produtos não estejam disponíveis para consulta em determinada região. 11.3 Qualquer
                    tolerância de uma das partes em relação à outra só importará modificação do presente instrumento se expressamente formalizada.</p>
                <p>11.4 Os serviços contratados devem ser utilizados pela CONTRATANTE como insumo para a atividade profissional exercida, não podendo servir ao
                    consumidor como destinatário final.</p>
                <p>11.5 O presente instrumento será assinado eletronicamente, conforme determina a MP 2.200-2/01,em seu art. 10º, §2, instrumento digital que será
                    Sincronizado com o NTP.br e Observatório Nacional (ON).</p>
                <p>FORO</p>
                <p>As partes elegem o Foro da Comarca de São Paulo como o único competente para dirimir quaisquer dúvidas decorrentes deste Contrato, com renúncia
                    expressa a qualquer outro, por mais privilegiado que seja.</p>
                <p>TERMO DE MONITORAMENTO DE DADOS PESSOAIS</p>
                <p>1. A CONTRATANTE deverá informar seu e-mail, para que seja possível gerar um relatório dentro da área logada, contendo todas as informações a
                    respeito dos dados que, eventualmente, forem identificados na plataforma da INTEC, atreladas ao e-mail informado.</p>
                <p>2. As informações identificadas permanecerão disponíveis para que a CONTRATANTE possa visualizá-las na área logada a qualquer tempo.</p>
                <p>3. A CONTRATANTE autoriza a INTEC a utilizar os dados pessoais mencionados neste instrumento de contrato de prestação de serviços, exclusivamente
                para a finalidade de manutenção do contrato, nos termos deste instrumento, os quais não serão compartilhados com nenhum terceiro.</p>
                <p>4. A CONTRATANTE tem ciência de que a INTEC poderá processar os seus dados no Brasil e obriga-se a adotar todas as providências eventualmente
                    exigidas pela legislação vigente para o referido processamento.</p>
                <p>5. É a partir do seu consentimento que tratamos os seus dados pessoais.</p>
                <p>6. O consentimento é a manifestação livre, informada e inequívoca pela qual você autoriza a CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO
                LTDA a tratar seus dados. Assim, em consonância com a Lei Geral de Proteção de Dados, seus dados só serão coletados, tratados e armazenados
                mediante prévio e expresso consentimento, com a finalidade específica para nossa relação comercial.</p>
                <p>7. O seu consentimento será obtido de forma específica para esta contratação de serviços, evidenciando o compromisso de transparência e boa-fé da
                CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO LTDA para com seus usuários/clientes, seguindo as regulações legislativas pertinentes.</p>
                <p>8. Ao utilizar os serviços da CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO LTDA e fornecer seus dados pessoais, você está ciente e
                consentindo com as disposições desta Política de Privacidade, além de conhecer seus direitos e como exercê-los.</p>
                <p>9. A qualquer tempo e sem nenhum custo, você poderá revogar seu consentimento e para isso basta comunicar o nosso Encarregado de Dados, Marcelo
                Passiani, pelo endereço passiani@dpogestaocadastral.com.br.</p>
                <p>10. A CONSTRUINFORMA INFORMAÇÕES DA CONSTRUÇÃO LTDA disponibiliza os seguintes meios para que você possa entrar em contato conosco
                    para exercer seus direitos de titular nosso Encarregado de Dados, Marcelo Passiani, pelo endereço passiani@dpogestaocadastral.com.br .</p>
                <p>11. Caso tenha dúvidas sobre esta Política de Privacidade ou sobre os dados pessoais que tratamos, você pode entrar em contato com o nosso Encarregado de Proteção
                de Dados Pessoais, sendo o advogado Marcelo Passiani, pelo endereço passiani@dpogestaocadastral.com.br.</p>
                <p>12. O presente instrumento será assinado eletronicamente, conforme determina a MP 2.200-2/01,em seu art. 10º, §2, instrumento digital que será
                Sincronizado com o NTP.br e Observatório Nacional (ON).</p>
            </div>
        </div>
    @endif
@endsection
