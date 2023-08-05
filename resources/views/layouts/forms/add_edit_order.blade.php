<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-input
            label-input-id="work_notes"
            label-text="Informações de Obras:"
            input-type="text"
            input-name="work_notes"
            class-one=""
            input-value="{{ $order->work_notes }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-select
            select-name="situation"
            select-label="Posição:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$situations"
            value="{{ $order->situation }}"
        />
    </div>

    <div class="col-md-4">
        <x-intec-select
            select-name="plan_id"
            select-label="Plano:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$plans"
            value="{{ $order->plan_id }}"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="start_at"
            label-text="Início:"
            input-type="text"
            input-name="start_at"
            class-one="date"
            input-value=""
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="ends_at"
            label-text="Término:"
            input-type="text"
            input-name="ends_at"
            class-one="date"
            input-value=""
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-2">
        <x-intec-input
            label-input-id="original_price"
            label-text="Valor Original:"
            input-type="text"
            input-name="original_price"
            class-one="money"
            input-value=""
            :input-readonly="false"
        />
    </div>
    <div class="col-md-2">
        <x-intec-input
            label-input-id="discount"
            label-text="Desconto Aplicado:"
            input-type="text"
            input-name="discount"
            class-one="money"
            input-value=""
            :input-readonly="false"
        />
    </div>
    <div class="col-md-2">
        <x-intec-input
            label-input-id="final_price"
            label-text="Valor Concedido:"
            input-type="text"
            input-name="final_price"
            class-one="money"
            input-value=""
            :input-readonly="false"
        />
    </div>
    <div class="col-md-2">
        <x-intec-input
            label-input-id="first_due_date"
            label-text="1º Vencimento:"
            input-type="text"
            input-name="first_due_date"
            class-one="date"
            input-value=""
            :input-readonly="false"
        />
    </div>
    <div class="col-md-4">
        <x-intec-select
            select-name="installments"
            select-label="Qtde. de Parcelas:"
            select-class="form-select"
            required=""
            placeholder="-- Selecione --"
            :collection="$installments"
            value="{{ $order->installments }}"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-4">
        <x-intec-input
            label-input-id="easy_payment_condition"
            label-text="Condição Facilitada de Pagamento:"
            input-type="text"
            input-name="easy_payment_condition"
            class-one=""
            input-value="{{ $order->easy_payment_condition }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <x-intec-textarea
            label-textarea-id="notes"
            label-text="RESUMO DO PEDIDO / OBSERVAÇÕES"
            textarea-type="text"
            textarea-name="notes"
            class-one=""
            textarea-value="{{ $order->notes }}"
            :textarea-readonly="false"
            rows="10"
        />
    </div>
</div>