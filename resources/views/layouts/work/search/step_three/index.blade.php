@extends('layouts.app_customer')

@section('content')

<style>
    /*CSS para impressão*/
    @media print {
        .print{
            display: block !important;
        }
        .no-print{
            display: none;
        }
    }
    body {
        /* margin:0; */
        /* padding:0; */
        line-height: 1.4em;
        padding-bottom: 70px;
    }
    @page {
        margin: 0.5cm;
    }

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
    /* input[type=checkbox] {
        -moz-appearance:none !important;
        -webkit-appearance:none !important;
        -o-appearance:none !important;
        outline: none !important;
        content: none !important;
    }
    input[type=checkbox]:before {
        font-family: "FontAwesome" !important;
        content: "\f00c" !important;
        font-size: 10px !important;
        color: transparent !important;
        background: #fef2e0 !important;
        display: block !important;
        width: 12px !important;
        height: 12px !important;
        border: 1px solid black !important;
        margin-right: 1px !important;
    }

    input[type=checkbox]:checked:before {
        color: black !important;
    } */

    .alinhadoDireita {
        text-align:right;
    }

    .margin{
        margin-top:-20px;
    }

    .pg{
        page-break-after: always;
    }
</style>

<div class="container pt-5">
    @include('layouts.alerts.success')
    <div class="row mt-2">
        <div class="col-md-2">
            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendEmail"><i class="fa fa-check"></i> Enviar link por e-mail</a>
        </div>
    </div>
    
    <!--ENVIAR LINK DE OBRAS POR EMAIL-->
    <div class="modal fade" id="sendEmail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
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
    </script>

    @forelse ($works as $work)
        <div class="row mt-2">
            <div class="col-md-12">
                <img src="{{ asset('images/relatorio-obras.png') }}" class="img-fluid" alt="Descrição da Imagem" />
                <p class="pt-1">
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
        {{-- <div class="row mt-2">
            <div class="col-md-4">
                <button class='btn btn-primary' type='button' onclick='' title="DESATIVAR OBRA"> Desativar</button>
                <a class="btn btn-default" title="Cadastrar SIG" onclick=""> NOVO SIG</a>
            </div>
        </div> --}}
        
        @can('ver-sig')
            <div class="row mt-2">
                <div class="col-md-4">
                    <a class="btn btn-primary" title="Cadastrar SIG"
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
        
        @can('ver-sig')
        <!-- The Modal -->
        <div class="modal" id="sig">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastro de SIG-Obra</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('sig.store') }}" method="post">
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
                                    <input type="text" name="appointment_date" class="form-control datepicker" value="">
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
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
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
                sigLinks.forEach(link => {
                    link.addEventListener('click', function (event) {
                        event.preventDefault();
                        const workId = this.getAttribute('data-work-id');
                        const workOldCode = this.getAttribute('data-code');
                        modalCode.textContent = workOldCode;
                        modalWorkIdInput.value = workId;
                    });
                });
            });
        </script>
    @endcan
    
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="text-success"><b>DADOS DA OBRA {{ $loop->iteration }}:</b></p>
                <table class="table table-condensed mt-2">
                    <tr>
                        <td style="width:85% !important;"><strong>Nome da Obra</strong>:  {{ $work->name }}<br>
                            <strong>Endereço</strong>:
                                {{ $work->address }}, {{ $work->number }}<br>
                            <strong>Bairro</strong>:
                                {{ $work->district }}<br>
                            <strong>Cidade</strong>:
                                {{ $work->city }} <strong>Estado:</strong> {{ $work->state }}-
                            <strong>CEP:</strong> {{ $work->zip_code }}<br>
                            <strong>Segmento</strong>:
                            <span class="text-uppercase">{{ $work->segment_description }}</span> -
                            <b>Subtipo</b>: {{ $work->segment_sub_type_description }}<br>

                            <strong>Início da obra</strong>
                            @if(isset($work->started_at))
                            {{ \Carbon\Carbon::parse($work->started_at)->format('d/m/Y') }}
                            @endif

                            <strong>Término da obra</strong>
                            @if(isset($work->ends_at))
                            {{ \Carbon\Carbon::parse($work->ends_at)->format('d/m/Y') }}
                            @endif -

                            <strong>Início / Término</strong>:
                            {{ $work->start_and_end }}<br>
                            <strong>Fase</strong>: {{ $work->phase_description }}
                            <strong>Estágio</strong>: {{ $work->stage_description }}<br>
                            <strong>Área total construída (m<sup>2</sup>)</strong>: {{ $work->total_project_area }}<br>
                            <strong>Padrão</strong>: {{ $work->investment_standard }}<br>
                            <strong>Valor do investimento</strong>: R$ {{ convertDecimalToBRL($work->price) }}<br>
                        </td>
                        <td style="width:15% !important;">
                            <picture>
                                <img src="" class="img-fluid" alt=""/>
                            </picture>
                        </td>
                    </tr>
                </table>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <p></p>
                            <strong>Detalhes:</strong> {{ $work->notes }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if ($work->segment_description == \App\Models\Work::RESIDENTIAL_SEGMENT)
            <!--INFORMAÇÕES ADICIONAIS-->
            <div class="row mt-2">
                <div class="col-md-12">
                    <p class="text-success"><b>DESCRIÇÃO:</b></p>
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
                                <strong>Área(s) de Serv. / Terraço(s) / Varanda(s)</strong>: {{ $work->tower }}
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

        <!--Informações adicionais -->
        <div class="row mt-2">
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
                        <td colspan="4" class="py-2">
                            <strong>Acabamento</strong>: {{ $work->completion }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--AREA DE LAZER-->
        <div class="row mt-2">
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
                        <td colspan="6" class="py-3">
                            <strong>Outros</strong>: {{ $work->other_leisure }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--CONTATOS-->
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="boxtitle text-success"><strong>CONTATO(s) DA OBRA</strong></p>
                <table class="table table-condensed">
                    <tr>
                        <td><strong>Nome</strong></td>
                        <td><strong>Cargo</strong></td>
                        <td><strong>Empresa</strong></td>
                        <td><strong>Telefone 1</strong></td>
                        <td><strong>Telefone 2</strong></td>
                        <td><strong>Telefone 3</strong></td>
                        <td><strong>Telefone 4</strong></td>
                        <td><strong>E-mail 1</strong></td>
                        <td><strong>E-mail 2</strong></td>
                        <td><strong>E-mail 3</strong></td>
                    </tr>
                    @foreach ((new \App\Models\Work)->find($work->id)->contacts as $contact)
                        <tr>
                            <td style="padding: 5px 0 5px 0 !important;">
                                {{ $contact->name }}
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                {{ optional($contact->position)->description }}
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                {{ optional($contact->company)->trading_name }}
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->ddd && $contact->main_phone)
                                ({{ $contact->ddd }}) {{ $contact->main_phone }}
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->ddd_two && $contact->phone_two)
                                ({{ $contact->ddd_two }}) {{ $contact->phone_two }}
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->ddd_three && $contact->phone_three)
                                ({{ $contact->ddd_three }}) {{ $contact->phone_three }}
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->ddd_four && $contact->phone_four)
                                ({{ $contact->ddd_four }}) {{ $contact->phone_four }}
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->email)
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->email)
                                 <a href="mailto:{{ $contact->secondary_email }}">{{ $contact->secondary_email }}</a>
                                @endif
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                @if ($contact->email)
                                 <a href="mailto:{{ $contact->tertiary_email }}">{{ $contact->tertiary_email }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <!--EMPRESAS PARTICIPANTES-->
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="boxtitle text-success"><strong>EMPRESA(s) PARTICIPANTE(s)</strong></p>
                <table class="table table-condensed">

                    <tbody>
                        @foreach ((new \App\Models\Work)->find($work->id)->companies as $company)
                            <tr>
                                <td class="pt-2" colspan="4">
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
                                    <strong>Endereço:</strong> {{ $company->address }}, {{ $company->number }} - {{ $company->district }}
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
                                    <strong>E-mail 1:</strong> <a href="mailto:{{ $company->primary_email }}">{{ $company->primary_email }}</a>
                                </td>
                                <td colspan="2">
                                    <strong>E-mail 2:</strong> <a href="mailto:{{ $company->secondary_email }}">{{ $company->secondary_email }}</a>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                        
                    <table class="table">
                        <thead> 
                            <tr>
                                <td><strong>Contato(s):</strong></td>
                            </tr>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>Telefone 1</th>
                                <th>Telefone 2</th>
                                <th>Telefone 3</th>
                                <th>Telefone 4</th>
                                <th>E-mail 1</th>
                                <th>E-mail 2</th>
                                <th>E-mail 3</th>
                             </tr>
                        </thead>

                        <tbody>
                            @foreach (
                                (new \App\Models\Work)->find($work->id)->companyContacts()
                                    ->where('contact_work.company_id', $company->id)
                                    ->get() as $workCompanyContact
                                )
                                <!--CONTATOS-->
                                
                                @if($workCompanyContact)
                                <tr>
                                    <td>
                                        {{ $workCompanyContact->name }}
                                    </td>
                                    <td>
                                        {{ optional($workCompanyContact->position)->description }}
                                    </td>
                                    <td>
                                        ({{ $workCompanyContact->ddd }})
                                        {{ $workCompanyContact->main_phone }}
                                    </td>
                                    <td>
                                        ({{ $workCompanyContact->ddd_two }})
                                        {{ $workCompanyContact->phone_two }}
                                    </td>
                                    <td>
                                        ({{ $workCompanyContact->ddd_three }})
                                        {{ $workCompanyContact->phone_three }}
                                    </td>
                                    <td>
                                        ({{ $workCompanyContact->ddd_four }})
                                        {{ $workCompanyContact->phone_four }}
                                    </td>
                            
                                    <td>
                                        <a href="mailto:{{ $workCompanyContact->email }}">{{ $workCompanyContact->email }}</a>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $workCompanyContact->secondary_email }}">{{ $workCompanyContact->secondary_email }}</a>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $workCompanyContact->tertiary_email }}">{{ $workCompanyContact->tertiary_email }}</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
        @empty
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="text-center">
                    Nenhuma obra encontrada com base nos critérios selecionados.
                </p>
            </div>
        </div>
    @endforelse
</div>
@endsection