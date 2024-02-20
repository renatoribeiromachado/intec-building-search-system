@extends('layouts.app')

@section('content')

<style>
    hr{border: 2px solid red !important;}
        
    table{
        border: none !important;
    }
    p{
        /* font-size: 10px; */
    }
    tr{
        background: white !important;
        border: none !important;
    }
    th{
        /* font-size: 10px; */
        border: none !important;
    }
    td{
        /* font-size: 10px; */
        border: none !important;
        padding: 0 !important;
    }
    .alinhadoDireita {
        text-align:right;
    }

    .margin{
        margin-top:-20px;
    }

    .pg{
        page-break-after: always;
    }

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
        line-height: 1.4em;
        padding-bottom: 70px;
    }

    .h1 {
        font-size: 18px !important; /* Por exemplo, aumente o tamanho do título em 150% */
    }
    .emp{
         font-size:14px !important; 
    }
        
    /* Defina a tabela para exibição padrão */
    .contact-table {
        display: none;
    }

    /* Oculte os elementos de contato individuais em modo de impressão */
    .contact-card {
        display: block;
    }

   /* Estilos de impressão */
@media print {
    .contact-table {
        display: block;
    }
    .contact-card {
        display: none;
    }
    body {
        margin: 0px; /* Remova todas as margens da página */
    }
    .hidden {
        display: none;
    }
    .emp {
        font-size: 8px !important; /* Reduza o tamanho da fonte para 8px */
    }
    @page {
        size: A4; /* Escolha o tamanho de página desejado, como A4 */
        margin: 0; /* Defina as margens da página como zero */
    }
    .image-for-print {
        display: none;
        max-width: 100% !important; /* Mantenha a largura da imagem ajustada automaticamente */
        height: auto; /* Mantenha a proporção de aspecto da imagem */
    }
    .h1 {
        font-size: 50% !important; /* Mantenha o tamanho do título igual ao original */
        margin-top: 5px;
    }
    p {
        font-size: 12px !important;
        line-height: 0.5; /* Reduza o espaçamento entre linhas para 1 (padrão) */
        margin-bottom: 10px; /* Remova a margem inferior dos parágrafos */
    }
    .obra {
        page-break-before: always;
    }
     hr {
        margin: 1px !important; /* Reduza o espaço entre os elementos <hr> */
    }
    td {
        font-size: 12px !important;
        max-height: 5px !important; /* Ajuste a altura máxima conforme necessário */
        overflow: hidden;
    }
    br {
        line-height: 0 !important; /* Define o espaçamento vertical entre as quebras de linha como 0 */
        margin: 0 !important; /* Remove qualquer margem vertical entre as quebras de linha */
    }
}


</style>

<div class="container pt-2">
    
    @include('layouts.alerts.success')
    <div id="flash-message" class="alert alert-success" style="display:none;">
        {{ session('success') }}
    </div>
    
    <div class="row hidden">
        <div class="col-md-2">
            <a href="" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#sendEmail"><i class="fa fa-check"></i> Enviar link por e-mail</a>
        </div>
    </div>
    
    <!--ENVIAR LINK DE OBRAS POR EMAIL-->
    <div class="modal fade" id="sendEmail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h4 class="modal-title">Enviar link de obra(s) por e-mail</h4>
                </div>
                <div class="modal-body">
   
                    <form id="emailForm" action="{{ route('send.email-obra') }}" method="post">
                        @csrf
                        <!-- Link de obras selecionadas-->
                        <input type="hidden" name="link" class="form-control" value="" id="link" readonly="">
                        
                        <div class="row mt-2">
                            <div class="col-md-10">
                                <label class="control-label"><i class="glyphicon glyphicon-user"></i> Usuário</label>
                                <input type="text" name="senderName" class="form-control" id="senderName" value="{{ auth()->user()->name }}" readonly="" required=""/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> E-mail</label>
                                <input type="email" name="senderEmail" class="form-control" id="senderEmail" value="{{ auth()->user()->email }}" readonly="" required=""/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> Lista de E-Mail's (separar cada-mail por vírgula) <code>* Obrigatório</code></label>
                                <input type="text" name="emailDestination" id="emailDestination" class="form-control" value="" required=""/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="control-label"> Observação</label>
                                <textarea name="notes" class="form-control" rows="5" ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary btnSendEmail" id="btnSendEmail" value="Enviar" />
                           </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtém a URL da página atual
            var currentUrl = window.location.href;

            // Preenche o campo com a URL da página atual
            var link = document.getElementById("link");
            if (link) {
                link.value = currentUrl;
            }
        });
        
        /*Desativa obra*/
        function fncXMHide(className) {
            const elements = document.querySelectorAll('.' + className);
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
            fncLoadPageBreak();
        }
    </script>

    @forelse ($works as $work)
        <div class="obra-info info-{{ $work->id }} obra">
            <div class="row mt-2">
                <div class="col-md-12">
                    <img src="https://homolocacao.intecbrasil.com.br/images/relatorio-obras.png" class="img-fluid" alt="Pesquisa de obras Inteec">
                    <p class="pt-2">
                        <strong>Código</strong>: {{ $work->old_code }} -
                        Última Atualização:
                            @if (isset($work->last_review))
                            <strong>{{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}</strong> -
                            @endif
                        Revisão: <strong>{{ $work->revision }}</strong> -
                        Emitido em: <strong>{{ date('d/m/Y') }}</strong>
                    </p>
                </div>
            </div>

            <!--BOTÕES-->
            @can('ver-sig')
                <div class="row hidden">
                    <div class="col-md-4">
                        <button class="btn btn-primary text-white" type='button' onclick='fncXMHide("info-{{ $work->id }}")' title="DESATIVAR OBRA"> <i class="fa fa-eye"></i> Desativar</button>

                        <a class="btn btn-primary text-white" title="Cadastrar SIG"
                            href="javascript:void(0)"
                            data-bs-toggle="modal"
                            data-bs-target="#sig"
                            data-work-id="{{ $work->id }}"
                            data-code="{{ $work->old_code }}"
                            >
                            <i class="fa fa-check"></i> NOVO SIG
                        </a>
                    </div>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <p class="text-success"><strong>DADOS DA OBRA {{ $loop->iteration }}:</strong></p>
                    <hr>
                    <table class="table table-condensed mt-2">
                        <tr>
                            <td style="width:85% !important;">
                                <strong>Nome da Obra</strong>:  {{ $work->name }}<br>
                                <strong>Endereço</strong>: {{ $work->address }}, {{ $work->number }}<br>
                                <strong>Bairro</strong>: {{ $work->district }}<br>
                                <strong>Cidade</strong>: {{ $work->city }} <strong>Estado:</strong> {{ $work->state }}-
                                <strong>CEP:</strong> {{ $work->zip_code }}<br>
                                <strong>Segmento</strong>: <span class="text-uppercase">{{ $work->segment_description }}</span> -
                                <b>Subtipo</b>: {{ $work->segment_sub_type_description }}<br>

                                <strong>Início da obra</strong>
                                @if(isset($work->started_at))
                                {{ \Carbon\Carbon::parse($work->started_at)->format('d/m/Y') }}
                                @endif

                                <strong>Término da obra</strong>
                                @if(isset($work->ends_at))
                                {{ \Carbon\Carbon::parse($work->ends_at)->format('d/m/Y') }}
                                @endif -

                                <strong>Início / Término</strong>: {{ $work->start_and_end }}<br>
                                <strong>Fase</strong>: {{ $work->phase_description }}
                                <strong>Estágio</strong>: {{ $work->stage_description }}<br>
                                <strong>Área total construída (m<sup>2</sup>)</strong>: {{ $work->total_project_area }}<br>
                                <strong>Padrão</strong>: {{ $work->investment_standard }}<br>
                                <strong>Valor do investimento</strong>: R$ {{ convertDecimalToBRL($work->price) }}<br>
                            </td>

                            <!-- Foto da obra -->
                            <td style="width:150% !important;">
                                <picture>
                                    @if (!empty($work->storage_image_link))
                                    <img src="{{ asset($work->public_image_link) }}" class="" width="310"  alt="Imagem da Obra" />
                                    @else
                                        <img src="{{ asset('images/intec_default_mini.png') }}" class="img-fluid" width="310" alt="Imagem da Obra" />
                                    @endif
                                </picture>
                            </td>
                        </tr>
                    </table>

                    <hr>
                    <table class="table table-condensed">
                        <tr>
                            <td>
                               <strong>Detalhes:</strong> {{ $work->notes }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

             <!--INFORMAÇÕES ADICIONAIS-->
            @if ($work->segment_description == \App\Models\Work::RESIDENTIAL_SEGMENT)
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-success"><strong>DESCRIÇÃO:</strong></p>
                        <hr>
                        <table class="table table-condensed">
                            <tr>
                                <td><strong>Edifício(s) Residenciais</strong>: <span class="text">{{ $work->tower }}</span>
                                    <br>
                                    <strong>Nº de pavimentos</strong>: <span class="text">{{ $work->floor }}</span>
                                    <br>
                                    <strong>Apart. Por andar</strong>: {{ $work->apartment_per_floor }}
                                    <br>
                                    <strong>Dormitório(s)</strong>: {{ $work->bedroom }}
                                    <br>
                                    <strong>Condominio</strong>: {{ $work->condominium }}
                                </td>
                                <td>
                                    <strong>Suíte(s)</strong>: {{ $work->suite }}
                                    <br>
                                    <strong>Banheiro(s)</strong>: {{ $work->bathroom }}
                                    <br>
                                    <strong>Lavabo(s)</strong>: {{ $work->washbasin }}
                                    <br>
                                    <strong>Sala(s) de jantar / estar</strong>: {{ $work->living_room }}
                                </td>
                                <td>
                                    <strong>Área(s) de Serv. / Terraço(s) / Varanda(s)</strong>: {{ $work->service_area_terrace_balcony }}
                                    <br>
                                    <strong>Copa / Cozinha</strong>: {{ $work->cup_and_kitchen }}
                                    <br>
                                    <strong>Dependência(s) de empregada(s)</strong>: {{ $work->maid_dependency }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif

            <hr>
            
            <!--Informações adicionais -->
            <div class="row">
                <div class="col-md-12">
                    <p class="text-success"><b>INFORMAÇÕES ADICIONAIS:</b></p>
                    <table class="table table-condensed">
                        <tr>
                            <td>
                                <strong>Total de unidades</strong>: {{  $work->total_unities }}
                                <br>
                                <strong>Área Útil(m²)</strong>: {{ $work->useful_area }}
                                <br>
                                <strong>Vaga(s)</strong>: {{ $work->garage }}
                            </td>
                            <td>
                                <strong>A. Terreno(m²)</strong>: {{ $work->total_area }}
                                <br>
                                <strong>Elevadore(s)</strong>: {{ $work->elevator }}
                                <br>
                                <strong>Cobertura(s)(m²)</strong>: {{ $work->coverage }}
                            </td>
                            <td>
                                <strong>Ar Condicionado</strong>: {{ $work->air_conditioner }}
                                <br>
                                <strong>Aquecimento</strong>: {{ $work->heating }}
                                <br>
                                <strong>Fundações</strong>: {{ $work->foundry }}
                            </td>
                            <td>
                                <strong>Estrutura</strong>: {{ $work->frame }}
                                <br>
                                <strong>Fachada</strong>: {{ $work->facade }}
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <strong>Acabamento</strong>: {{ $work->completion }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!--AREA DE LAZER-->
            <div class="row">
                <div class="col-md-12">
                    <p class="boxtitle text-success">
                        <strong>ÁREA DE LAZER</strong>
                        <code>*Itens marcados estão disponiveis na Obra</code>
                    </p>

                    <table class="table table-condensed">
                        <tr>
                            @foreach($workFeatures as $workFeature)
                                <td>
                                    <input
                                        type="checkbox"
                                        name="work_features[]"
                                        value="{{ $workFeature->id }}"
                                        class="form-check-input me-1"
                                        id="check-feature-{{ $loop->index }}"
                                        onclick="return false;"

                                        @if (empty(old('work_features')) &&
                                            \App\Models\Work::find($work->id)->features->contains($workFeature->id))
                                        checked
                                        @endif
                                        />
                                    <label class="form-check-label" for="check-feature-{{ $loop->index }}">
                                        {{ $workFeature->description }}
                                    </label>
                                </td>

                                @if ($loop->iteration % 4 == 0)
                                    </tr>
                                    <tr>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <td colspan="6" class="">
                                <strong>Outros</strong>: {{ $work->other_leisure }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!-- CONTATOS -->
            <div class="row">

                <div class="col-md-12">
                    <p class="text-success"><strong>CONTATO(s) DA OBRA</strong></p>
                </div>
                
                <div class="row">
                    @foreach ((new \App\Models\Work)->find($work->id)->contacts->sortBy('name') as $contact)
                        @php
                            $workCompanies = (new \App\Models\Work)->find($work->id)->companies;
                            $contactBelongsToWork = false;
                        @endphp

                        @foreach ($workCompanies as $company)
                            @if ($contact->company_id === $company->id)
                                @php
                                    $contactBelongsToWork = true;
                                    // Defina $company dentro do loop
                                    $contactCompany = $company;
                                @endphp
                            @endif
                        @endforeach

                        @if ($contactBelongsToWork)
                            <div class="col-4 col-md-4">
                                <!-- Adicione a classe contact-card aos elementos de contato individuais -->
                                <div class="card p-2 contact-card">
                                    <div class="card-header bg-secondary text-white emp">
                                        <strong>EMPRESA: {{ $contactCompany->trading_name }}</strong>
                                    </div>
                                    <strong>Nome:</strong> {{ $contact->name }}<br>
                                    <strong>Cargo:</strong> {{ optional($contact->position)->description }}<br>
                                    <strong>Telefone(s): </strong>
                                    @if ($contact->ddd && $contact->main_phone)
                                        ({{ $contact->ddd }}) {{ $contact->main_phone }}
                                    @endif

                                    @if ($contact->ddd_two && $contact->phone_two)
                                        <br>
                                        ({{ $contact->ddd_two }}) {{ $contact->phone_two }}
                                    @endif

                                    @if ($contact->ddd_three && $contact->phone_three)
                                        <br>
                                        ({{ $contact->ddd_three }}) {{ $contact->phone_three }}
                                    @endif

                                    @if ($contact->ddd_four && $contact->phone_four)
                                        <br>
                                        ({{ $contact->ddd_four }}) {{ $contact->phone_four }}
                                    @endif
                                    <br>

                                    <strong>E-mail(s):</strong>
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                    @endif

                                    @if ($contact->secondary_email)
                                        <a href="mailto:{{ $contact->secondary_email }}">{{ $contact->secondary_email }}</a>
                                    @endif

                                    @if ($contact->tertiary_email)
                                        <a href="mailto:{{ $contact->tertiary_email }}">{{ $contact->tertiary_email }}</a>
                                    @endif<br>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Adicione a classe contact-table à tabela de contato para impressão -->
                <table class="table contact-table">
                    <!-- Coloque o cabeçalho da tabela aqui -->
                    <tr>
                        <th>Empresa</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Telefone(s)</th>
                        <th>E-mail(s)</th>
                    </tr>

                    <!-- Adicione as linhas da tabela com os detalhes do contato aqui -->
                    @foreach ((new \App\Models\Work)->find($work->id)->contacts->sortBy('name') as $contact)
                        @php
                            $workCompanies = (new \App\Models\Work)->find($work->id)->companies;
                            $contactBelongsToWork = false;
                        @endphp

                        @foreach ($workCompanies as $company)
                            @if ($contact->company_id === $company->id)
                                @php
                                    $contactBelongsToWork = true;
                                    // Defina $company dentro do loop
                                    $contactCompany = $company;
                                @endphp
                            @endif
                        @endforeach

                        @if ($contactBelongsToWork)
                            <tr>
                                <td>{{ $contactCompany->trading_name }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ optional($contact->position)->description }}</td>
                                <td>
                                    @if ($contact->ddd && $contact->main_phone)
                                        ({{ $contact->ddd }}) {{ $contact->main_phone }}<br>
                                    @endif
                                    @if ($contact->ddd_two && $contact->phone_two)
                                        ({{ $contact->ddd_two }}) {{ $contact->phone_two }}<br>
                                    @endif
                                    @if ($contact->ddd_three && $contact->phone_three)
                                        ({{ $contact->ddd_three }}) {{ $contact->phone_three }}<br>
                                    @endif
                                    @if ($contact->ddd_four && $contact->phone_four)
                                        ({{ $contact->ddd_four }}) {{ $contact->phone_four }}
                                    @endif
                                </td>
                                <td>
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
                                    @endif
                                    @if ($contact->secondary_email)
                                        <a href="mailto:{{ $contact->secondary_email }}">{{ $contact->secondary_email }}</a><br>
                                    @endif
                                    @if ($contact->tertiary_email)
                                        <a href="mailto:{{ $contact->tertiary_email }}">{{ $contact->tertiary_email }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>

            <hr>

            <!--EMPRESAS PARTICIPANTES-->
            <div class="row">
                <div class="col-md-12">
                    <p class="boxtitle text-success"><strong>EMPRESA(s) PARTICIPANTE(s)</strong></p>
                    @foreach (
                            (new \App\Models\Work)->find($work->id)->companies->sortBy(function ($company) {
                                return $company->activity_field_id != 2;
                            }) as $company
                        )
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="4">
                                        <strong>Modalidade(s):</strong>
                                        @foreach (
                                            (new \App\Models\Work)->find($work->id)
                                                ->companyActivityFields()
                                                ->where('activity_field_work.company_id', $company->id)
                                                ->get() as $workCompanyActivity
                                            )
                                            {{ $workCompanyActivity->description }} <br>
                                        @endforeach

                                        <strong>Razão social:</strong> {{ $company->company_name }} -
                                        <strong>CNPJ:</strong> {{ $company->cnpj }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <strong>Nome Fantasia:</strong> {{ $company->trading_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if($company->address || $company->number || $company->district)
                                            <strong>Endereço:</strong> {{ $company->address }}, {{ $company->number }} - {{ $company->district }}
                                        @else
                                            <strong>Endereço</strong>:
                                        @endif
                                    </td>
                                    <td colspan="3">
                                        <strong>Site:</strong> {{ $company->home_page }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Cidade:</strong> {{ $company->city }} - {{ $company->state }} - <strong>CEP:</strong> {{ $company->zip_code }}
                                    </td>
                                    <td>
                                        <strong>Email(s):</strong>
                                        @if ($company->primary_email)
                                            <a href="mailto:{{ $company->primary_email }}">{{ $company->primary_email }}</a>
                                        @endif

                                        @if ($company->secondary_email)
                                            /
                                            <a href="mailto:{{ $company->secondary_email }}">{{ $company->secondary_email }}</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    <!-- Contatos no formato de cartão (padrão) -->
                    <div class="row">
                        <div class='col-md-12'>
                            <p><strong>Contato(s)</strong></p>
                        </div>
                        @foreach ($company->contacts()->where('contacts.archived', false)->orderBy('name','asc')->get() as $workCompanyContact)
                            @if($workCompanyContact)
                                <div class="col-4 col-md-3">
                                    <div class="card p-2 contact-card">
                                        <strong>Nome:</strong> {{ $workCompanyContact->name }} <br>
                                        <strong>Cargo:</strong> {{ optional($workCompanyContact->position)->description }} <br>
                                        <strong>Telefone(s):</strong>
                                        @if ($workCompanyContact->main_phone)
                                            ({{ $workCompanyContact->ddd }})
                                            {{ $workCompanyContact->main_phone }}
                                        @endif

                                        @if ($workCompanyContact->phone_two)
                                            <br>
                                            ({{ $workCompanyContact->ddd_two }})
                                            {{ $workCompanyContact->phone_two }}
                                        @endif

                                        @if ($workCompanyContact->phone_three)
                                            <br>
                                            ({{ $workCompanyContact->ddd_three }})
                                            {{ $workCompanyContact->phone_three }}
                                        @endif

                                        @if ($workCompanyContact->phone_four)
                                            <br>
                                            ({{ $workCompanyContact->ddd_four }})
                                            {{ $workCompanyContact->phone_four }}
                                        @endif
                                        <br>

                                        <strong>E-mail(s):</strong>
                                        @if ($workCompanyContact->email)
                                            <a href="mailto:{{ $workCompanyContact->email }}">{{ $workCompanyContact->email }}</a>
                                        @endif

                                        @if ($workCompanyContact->secondary_email)
                                            <a href="mailto:{{ $workCompanyContact->secondary_email }}">{{ $workCompanyContact->secondary_email }}</a>
                                        @endif

                                        @if ($workCompanyContact->tertiary_email)
                                            <a href="mailto:{{ $workCompanyContact->tertiary_email }}">{{ $workCompanyContact->tertiary_email }}</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Contatos no formato de tabela para impressão -->
                    <table class="table contact-table">
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Telefone(s)</th>
                            <th>E-mail(s)</th>
                        </tr>
                        @foreach ($company->contacts()->where('contacts.archived', false)->orderBy('name','asc')->get() as $workCompanyContact)
                            @if($workCompanyContact)
                                <tr>
                                    <td>{{ $workCompanyContact->name }}</td>
                                    <td>{{ optional($workCompanyContact->position)->description }}</td>
                                    <td>
                                        @if ($workCompanyContact->main_phone)
                                            ({{ $workCompanyContact->ddd }})
                                            {{ $workCompanyContact->main_phone }}
                                        @endif

                                        @if ($workCompanyContact->phone_two)
                                            <br>
                                            ({{ $workCompanyContact->ddd_two }})
                                            {{ $workCompanyContact->phone_two }}
                                        @endif

                                        @if ($workCompanyContact->phone_three)
                                            <br>
                                            ({{ $workCompanyContact->ddd_three }})
                                            {{ $workCompanyContact->phone_three }}
                                        @endif

                                        @if ($workCompanyContact->phone_four)
                                            <br>
                                            ({{ $workCompanyContact->ddd_four }})
                                            {{ $workCompanyContact->phone_four }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($workCompanyContact->email)
                                            <a href="mailto:{{ $workCompanyContact->email }}">{{ $workCompanyContact->email }}</a>
                                        @endif

                                        @if ($workCompanyContact->secondary_email)
                                            <a href="mailto:{{ $workCompanyContact->secondary_email }}">{{ $workCompanyContact->secondary_email }}</a>
                                        @endif

                                        @if ($workCompanyContact->tertiary_email)
                                            <a href="mailto:{{ $workCompanyContact->tertiary_email }}">{{ $workCompanyContact->tertiary_email }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    @endforeach
                </div>
            </div>
        </div><!--Fim obra-info, para desativar obras e empresas participantes-->
    
        @empty
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="text-center">
                    Nenhuma obra encontrada com base nos critérios selecionados.
                </p>
            </div>
        </div>
    @endforelse
   
    @can('ver-sig')
    <!-- The Modal -->
    <div class="modal" id="sig">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-secondary text-white">
                    <h4 class="modal-title">Cadastro de SIG-Obra</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('sig.store') }}" method="post" id="sig-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <p>Código: <span id="modal-code"></span></p>
                            </div>
                        </div>

                        <!--Inputs hidden -->
                        <input type="hidden" name="work_id" value="" id="modal-work-id-input">

                        <div class="row">
                            <div class="col-md-4">
                                <label>Agendar para</label>
                                <input type="text" name="appointment_date" class="form-control datepicker" value="" required=''>
                            </div>

                            <div class="col-md-4">
                                <label for="priority">Prioridade</label>
                                <select id="priority" name="priority" class="form-select">
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority }}">{{ $priority }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-select">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="notes">Descriçao</label>
                                <textarea id="notes" name="notes" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary" id="submit-button">Cadastrar</button>
                        </div>
                    </form>
                </div> <!-- /.modal-body -->
            </div> <!-- /.modal-content -->
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
            const modalCode = document.getElementById('modal-code');
            const modalWorkIdInput = document.getElementById('modal-work-id-input');
            const submitButton = document.getElementById('submit-button'); // Adicione um ID ao botão

            sigLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const workId = this.getAttribute('data-work-id');
                    const workOldCode = this.getAttribute('data-code');
                    modalCode.textContent = workOldCode;
                    modalWorkIdInput.value = workId;
                });
            });

            // Intercepta o envio do formulário
            $('#sig-form').submit(function (e) {
                e.preventDefault(); // Evita o envio padrão do formulário

                // Obtém os dados do formulário
                const formData = $(this).serialize();

                // Desativa o botão de envio e define o texto "Cadastrando, Aguarde..."
                submitButton.disabled = true;
                submitButton.textContent = 'Cadastrando, aguarde...';

                // Envia os dados por AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function (response) {
                        // Fecha o modal
                        $('#sig').modal('hide');

                        // Limpa o formulário
                        $('#sig-form')[0].reset();

                        // Reativa o botão de envio e redefine o texto "Cadastrar"
                        submitButton.disabled = false;
                        submitButton.textContent = 'Cadastrar';

                        // Verifica se a operação foi bem-sucedida
                        if (response.success) {
                            const flashMessage = document.getElementById('flash-message');
                            flashMessage.textContent = response.message;
                            flashMessage.style.display = 'block';
                        }
                    },
                    error: function (error) {
                        // Manipule os erros aqui, se necessário
                        console.log(error.responseText);

                        // Reativa o botão de envio e redefine o texto "Cadastrar"
                        submitButton.disabled = false;
                        submitButton.textContent = 'Cadastrar';
                    }
                });


            });
        });
        
    </script>
    @endcan
</div>
@endsection