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

<div class="container pt-3">
    
    @include('layouts.alerts.success')
    <div class="row mt-2 hidden">
        <div class="col-md-2">
            <a href="" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#sendEmail"><i class="fa fa-check"></i> Enviar link por e-mail</a>
        </div>
    </div>
    
    <!--ENVIAR LINK DE OBRAS POR EMAIL-->
    <div class="modal fade" id="sendEmail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enviar link de empresa(s) por e-mail</h4>
                </div>
                <div class="modal-body">
   
                    <form id="emailForm" action="{{ route('send.email-company') }}" method="post">
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
        
        /*Desativa EMPRESA*/
        function fncXMHide(className) {
            const elements = document.querySelectorAll('.' + className);
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
            fncLoadPageBreak();
        }
    </script>
    
    @forelse ($companies as $company)
        <div class="obra-info info-{{ $company->id }} obra">
            <div class="row mt-2">
                <div class="col-md-12">
                    <img src="{{ asset('images/relatorio-empresas.png') }}" class="img-fluid" alt="PESQUISA DE EMPRESA">
                    <p class="pt-1">
                        Última Atualização:
                        <strong>{{ optional($company->last_review)->format('d/m/Y') }}</strong> -
                        Revisão: <strong>{{ $company->revision }}</strong> -
                        Emitido em:
                        <strong>
                            {{ now()->setTimezone(
                            config('timezones.brazil'))->format('d/m/Y') }}
                        </strong>
                    </p>
                </div>
            </div>

            <!--BOTÕES-->
            @can('ver-sig-empresa')
              <div class="row mt-2 hidden">
                  <div class="col-md-4">
                      <button class="btn btn-primary text-white" type='button' onclick='fncXMHide("info-{{ $company->id }}")' title="DESATIVAR EMPRESA"> <i class="fa fa-eye"></i> Desativar</button>
                      <a class="btn btn-primary text-white" title="Cadastrar SIG"
                          href="javascript:void(0)"
                          data-bs-toggle="modal"
                          data-bs-target="#sig"
                          data-company-id="{{ $company->id }}"
                          data-name="{{ $company->name }}"
                          >
                          <i class="fa fa-check"></i> NOVO SIG
                      </a>
                  </div>
              </div>
            @endcan

            <div class="row mt-2 mb-3">
                <div class="col-md-12">
                    <p class="text-success"><b>DADOS DA EMPRESA {{ $loop->iteration }}:</b></p>
                    
                    <hr>
                    
                    <table class="table table-condensed mt-2">
                        <tr>
                            <td style="width:78% !important;">
                                <strong>Razão Social:</strong>  {{ $company->company_name }}<br>

                                <strong>Endereço:</strong> {{ $company->address }}, {{ $company->number }}<br>

                                <strong>Cidade:</strong> {{ $company->city }}<br>

                                <strong>Segmento:</strong> {{ optional($company->activityField)->description }}<br>

                                <strong>CNPJ:</strong> {{ $company->cnpj }}<br>
                            </td>
                            <td>
                                <strong>Fantasia:</strong>  {{ $company->trading_name }}<br>

                                <strong>Bairro</strong>: {{ $company->district }}<br>

                                <strong>Estado:</strong> {{ $company->state }} <strong>CEP:</strong> {{ $company->zip_code }}<br>

                                <strong>Site:</strong> {{ $company->home_page }}<br>

                                <strong>E-mail 1:</strong> <a href="mailto:{{ $company->primary_email }}">{{ $company->primary_email }}</a><br>

                                <strong>E-mail 2:</strong> <a href="mailto:{{ $company->secondary_email }}">{{ $company->secondary_email }}</a><br>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <strong>Observações:</strong> {{ $company->notes }}
                            </td>
                        </tr>
                        
                        @foreach ($company->contacts()->where('contacts.archived', false)->orderBy('name', 'asc')->get() as $contact)
                            <tr>
                                <td class="pt-3">
                                    <strong>Contato:</strong> {{ $contact->name }}<br>
                                    <strong>Cargo:</strong> {{ optional($contact->position)->description }}<br>
                                    <strong>Telefone 1:</strong> ({{ $contact->ddd }}) {{ $contact->main_phone }}<br>
                                    <strong>Telefone 2:</strong> ({{ $contact->ddd_two }}) {{ $contact->phone_two }}<br>
                                    <strong>Telefone 3:</strong> ({{ $contact->ddd_three }}) {{ $contact->phone_three }}<br>
                                    <strong>Telefone 4:</strong> ({{ $contact->ddd_four }}) {{ $contact->phone_four }}<br>
                                </td>
                                <td class="pt-3">
                                    <strong>E-mail 1:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
                                    <strong>E-mail 2:</strong> <a href="mailto:{{ $contact->secondary_email }}">{{ $contact->secondary_email }}</a><br>
                                    <strong>E-mail 3:</strong> <a href="mailto:{{ $contact->tertiary_email }}">{{ $contact->tertiary_email }}</a><br>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    
                        <hr> 
                </div>
            </div>
        </div>
    
        @empty
        <div class="row mt-2 mb-3">
            <div class="col-md-12">
                <p class="text-center">
                    Nenhuma empresa encontrada com base nos critérios selecionados.
                </p>
            </div>
        </div>
        
    @endforelse
    
    @can('ver-sig-empresa')
    <!-- The Modal -->
    <div class="modal" id="sig">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Cadastro de SIG-Empresa</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('sig-company.store') }}" method="post" id="sig-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Empresa:</strong> <span id="modal-name"></span></p>
                            </div>
                        </div>

                        <!--Inputs hidden -->
                        <input type="hidden" name="company_id" value="" id="modal-company-id-input">

                        <div class="row">
                            <div class="col-md-4">
                                <label>Agendar para</label>
                                <input type="text" name="appointment_date" class="form-control datepicker" value="" required="">
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

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label"><strong>Sig(s) cadastrados</strong></label>
                            <div class="table-responsive" style="overflow: auto; height: 200px;">
                                <table class="table table-condensed">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Criado</th>
                                            <th>Agendado</th>
                                            <th>Empresa</th>
                                            <th>Relator</th>
                                            <th>Prioridade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                        @forelse($reports as $report)
                                            
                                            <tr class="report-row" data-company-id="{{ $report->company_id }}">
                                                <td>
                                                    {{ $report->created_at->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    {{ optional($report->appointment_date)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-primary"><strong></strong></td>
                                                <td>{{ $report->user->name }}</td>
                                                <td>{{ $report->priority }}</td>
                                                <td class="text-primary"><strong>{{ $report->status }}</strong></td>
                                            </tr>

                                            @if ($report->notes)
                                            <tr class="report-row" data-company-id="{{ $report->company_id }}">
                                                <td colspan="6"><strong>Descrição:</strong> *{{ $report->notes }}</td>
                                            </tr>
                                            
                                            
                                            @endif

                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    Nenhum SIG de empresa encontrado.
                                                </td>
                                            </tr>
                                        @endforelse
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>                            
                    </div>
                </div> <!-- /.modal-body -->
            </div> <!-- /.modal-content -->
        </div>
    </div>
    <script>
        /*Botão Sig*/
        document.addEventListener('DOMContentLoaded', function () {
            const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
            const modalName = document.getElementById('modal-name');
            const modalCompanyIdInput = document.getElementById('modal-company-id-input');
            const submitButton = document.getElementById('submit-button'); // Adicione um ID ao botão

            sigLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const companyId = this.getAttribute('data-company-id');
                    const comapnyName = this.getAttribute('data-name');
                    modalName.textContent = comapnyName;
                    modalCompanyIdInput.value = companyId;

                    // Filtra as linhas da tabela
                    const reportRows = document.querySelectorAll('.report-row');
                    reportRows.forEach(row => {
                        const reportCompanyId = row.getAttribute('data-company-id');
                        if (reportCompanyId === companyId) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
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

         /*Botão Sig*/
         document.addEventListener('DOMContentLoaded', function () {
            const sigLinks = document.querySelectorAll('a[data-bs-target="#sig"]');
            const modalName = document.getElementById('modal-name');
            const modalCompanyIdInput = document.getElementById('modal-company-id-input');

            sigLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const companyId = this.getAttribute('data-company-id');
                    const comapnyName = this.getAttribute('data-name');
                    modalName.textContent = comapnyName;
                    modalCompanyIdInput.value = companyId;

                    // Filtra as linhas da tabela
                    const reportRows = document.querySelectorAll('.report-row');
                    reportRows.forEach(row => {
                        const reportCompanyId = row.getAttribute('data-company-id');
                        if (reportCompanyId === companyId) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
    @endcan

</div>
@endsection