<div class="row mt-2">
    <div class="col-md-3">
        <x-intec-input
            label-input-id="linked_company"
            {{-- Selecione o CNPJ para esse associado: --}}
            label-text="CNPJ para esse associado:"
            input-type="text"
            input-name="linked_company"
            class-one=""
            input-value="{{ $associate->linked_company
                ? $associate->linked_company
                : '30.252.400/0001-55' }}"
            :input-readonly="true"
        />
    </div>
    
    <div class="col-md-2 mb-2">
        <x-intec-select
            select-name="is_active"
            select-label="Status:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$isActive"
            value="{{ $company->is_active }}"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="phone_one"
            label-text="Telefone:"
            input-type="text"
            input-name="phone_one"
            class-one="phone"
            input-value="{{ $company->phone_one }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="primary_email"
            label-text="E-mail Principal:"
            input-type="email"
            input-name="primary_email"
            class-one=""
            input-value="{{ $company->primary_email }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-input
            label-input-id="company_name"
            label-text="Razão Social:"
            input-type="text"
            input-name="company_name"
            class-one=""
            input-value="{{ $company->company_name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="trading_name"
            label-text="Fantasia:"
            input-type="text"
            input-name="trading_name"
            class-one=""
            input-value="{{ $company->trading_name }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="data_filter_starts_at"
            label-text="Início de Visualização:"
            input-type="text"
            input-name="data_filter_starts_at"
            class-one="date"
            input-value="{{ optional($associate->data_filter_starts_at)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="data_filter_ends_at"
            label-text="Término de Visualização:"
            input-type="text"
            input-name="data_filter_ends_at"
            class-one="date"
            input-value="{{ optional($associate->data_filter_ends_at)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <x-intec-input
            label-input-id="cnpj"
            label-text="CNPJ:"
            input-type="text"
            input-name="cnpj"
            class-one="cnpj"
            input-value="{{ $company->cnpj }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="state_registration"
            label-text="Inscrição Estadual:"
            input-type="text"
            input-name="state_registration"
            class-one=""
            input-value="{{ $company->state_registration }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-select
            select-name="business_branch"
            select-label="Ramo:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$businessBranches"
            value="{{ $associate->business_branch }}"
        />
    </div>

    <div class="col-md-3">
        <x-intec-select
            select-name="activity_field_id"
            select-label="Atividade:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$activityFields"
            value="{{ $company->activity_field_id }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="company_date_birth"
            label-text="Aniversário da empresa:"
            input-type="text"
            input-name="company_date_birth"
            class-one=""
            input-value="{{ $associate->company_date_birth }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="home_page"
            label-text="Site:"
            input-type="text"
            input-name="home_page"
            class-one=""
            input-value="{{ $company->home_page }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="contract_due_date_start"
            label-text="Emissão:"
            input-type="text"
            input-name="contract_due_date_start"
            class-one="date"
            input-value="{{ optional($associate->contract_due_date_start)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-select
            select-name="salesperson_id"
            select-label="Vendedor(a):"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$salespersons"
            value="{{ $associate->salesperson_id }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="zip_code"
            label-text="CEP:"
            input-type="text"
            input-name="zip_code"
            class-one=""
            input-value="{{ $company->zip_code }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-5">
        <x-intec-input
            label-input-id="address"
            label-text="Endereço:"
            input-type="text"
            input-name="address"
            class-one=""
            input-value="{{ $company->address }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="number"
            label-text="Nº:"
            input-type="text"
            input-name="number"
            class-one=""
            input-value="{{ $company->number }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-3">
        <x-intec-input
            label-input-id="complement"
            label-text="Complemento:"
            input-type="text"
            input-name="complement"
            class-one=""
            input-value="{{ $company->complement }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-input
            label-input-id="district"
            label-text="Bairro:"
            input-type="text"
            input-name="district"
            class-one=""
            input-value="{{ $company->district }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-4">
        <x-intec-input
            label-input-id="city"
            label-text="Cidade:"
            input-type="text"
            input-name="city"
            class-one=""
            input-value="{{ $company->city }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-select
            select-name="state"
            select-label="Estado:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$states"
            value="{{ $company->state }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-input
            label-input-id="products_and_services"
            label-text="Produtos e serviços:"
            input-type="text"
            input-name="products_and_services"
            class-one=""
            input-value="{{ $associate->products_and_services }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-textarea
            label-textarea-id="notes"
            label-text="Observações:"
            textarea-type="text"
            textarea-name="notes"
            class-one=""
            textarea-value="{{ $company->notes }}"
            :textarea-readonly="false"
            rows="5"
        />
    </div>
</div>
