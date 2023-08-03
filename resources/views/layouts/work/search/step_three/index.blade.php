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

<div class="">
    @foreach ($works as $work)
        <div class="row mt-2">
            <div class="col-md-12">
                <p>
                    <strong>Código</strong>: {{ $work->old_code }} -
                    Última Atualização:
                        @if (isset($work->last_review))
                        <strong>{{ \Carbon\Carbon::parse($work->last_review)->format('d/m/Y') }}</strong> -
                        @endif
                    Revisão: <strong>{{ $work->revision }}</strong> -
                    Emitido em: <strong>{{ date('d/m/Y h:i:s') }}</strong>
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
    
        <div class="row mt-2">
            <div class="col-md-12">
                <p class="text-success"><b>DADOS DA OBRA:</b></p>
                <table class="table table-condensed">
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
                            {{ optional($work->started_at)->format('d/m/Y') }}
                            <strong>Término da obra</strong>
                            {{ optional($work->ends_at)->format('d/m/Y') }} -
                            <strong>Início / Término</strong>:
                            {{ $work->start_and_end }}<br>
                            <strong>Fase</strong>: {{ $work->phase_description }}
                            <strong>Estágio</strong>: {{ $work->stage_description }}<br>
                            <strong>Área total construída (m<sup>2</sup>)</strong>: {{ $work->total_project_area }}<br>
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
                        <td><strong>Obra</strong></td>
                        <td><strong>Telefone</strong></td>
                        <td><strong>Telefone2</strong></td>
                        <td><strong>Celular</strong></td>
                        <td><strong>Celular 2</strong></td>
                        <td><strong>E-mail</strong></td>
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
                                {{ optional($contact->company)->company_name }}
                            </td>
                            <td style="padding: 5px 0 5px 0 !important;">
                                {{ $work->name }}
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
                                {{ $contact->email }}
                                @endif

                                <a href="mailto:" class="no-print"></a>
                                <span class="print" style="display:none;"></span>
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
                                <td colspan="2">
                                    <strong>Modalidade(s):</strong> ??? -
                                    <strong>Razão social:</strong> {{ $company->company_name }} -
                                    <strong>CNPJ:</strong> {{ $company->cnpj }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Nome Fantasia:</strong> {{ $company->trading_name }}
                                </td>
                                <td>
                                    <strong>Atividade:</strong>
                                    @foreach (
                                        (new \App\Models\Work)->find($work->id)
                                            ->companyActivityFields()
                                            ->where('activity_field_work.company_id', $company->id)
                                            ->get() as $workCompanyActivity
                                        )
                                        {{ $workCompanyActivity->description }} <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Endereço:</strong> {{ $company->address }}
                                </td>
                                <td>
                                    <strong>Site:</strong> {{ $company->home_page }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Cidade:</strong> {{ $company->city }}
                                </td>
                                <td>
                                    <strong>E-mail:</strong> {{ $company->primary_email }}
                                </td>
                                <td>
                                    <strong>E-mail Secundário:</strong> {{ $company->secondary_email }}
                                </td>
                            </tr>

                            @foreach (
                                (new \App\Models\Work)->find($work->id)->companyContacts()
                                    ->where('contact_work.company_id', $company->id)
                                    ->get() as $workCompanyContact
                                )
                                <!--CONTATOS-->
                                <tr>
                                    <td>
                                        <strong>Nome</strong>:
                                        {{ $workCompanyContact->name }}
                                    </td>
                                    <td>
                                        <strong>Cargo</strong>:
                                        {{ optional($workCompanyContact->position)->description }}
                                    </td>
                                    <td>
                                        <strong>Celular</strong>:
                                        ({{ $workCompanyContact->ddd }})
                                        {{ $workCompanyContact->main_phone }}
                                    </td>
                                    <td>
                                        <strong>Telefone</strong>:
                                        ({{ $workCompanyContact->ddd_two }})
                                        {{ $workCompanyContact->phone_two }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    @endforeach
</div>
@endsection