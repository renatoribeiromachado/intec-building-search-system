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
            input-value="{{ optional($order->start_at)->format('d/m/Y') }}"
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
            input-value="{{ optional($order->ends_at)->format('d/m/Y') }}"
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
            input-value="{{ convertDecimalToBRL($order->original_price) }}"
            :input-readonly="false"
        />
    </div>
    <div class="col-md-2">
        <x-intec-input
            label-input-id="discount"
            label-text="Valor do Desconto:"
            input-type="text"
            input-name="discount"
            class-one="money"
            input-value="{{ convertDecimalToBRL($order->discount) }}"
            :input-readonly="false"
        />
    </div>

    <div class="col-md-2">
        <div class="d-flex align-items-center" style="height: 84px;">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="discount_in_percentage"
                    name="discount_in_percentage"
                    class="form-check-input"
                    value="1"
                    @if (old('discount_in_percentage', $order->discount_in_percentage) == 1)
                    checked
                    @endif
                    >
                <label class="form-check-label" for="discount_in_percentage">
                Desconto em % ?
                </label>
        </div>
    </div>

    <div class="col-md-2">
        <x-intec-input
            label-input-id="final_price"
            label-text="Valor Concedido:"
            input-type="text"
            input-name="final_price"
            class-one="money"
            input-value="{{ convertDecimalToBRL($order->final_price) }}"
            :input-readonly="true"
        />
    </div>
    <div class="col-md-4">
        <x-intec-input
            label-input-id="first_due_date"
            label-text="1º Vencimento:"
            input-type="text"
            input-name="first_due_date"
            class-one="date"
            input-value="{{ optional($order->first_due_date)->format('d/m/Y') }}"
            :input-readonly="false"
        />
    </div>
</div>

<div class="row mt-2">
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
    <div class="col-md-4">
        <x-intec-input
            label-input-id="easy_payment_condition"
            label-text="Condição Facilitada de Pagamento:"
            input-type="text"
            input-name="easy_payment_condition"
            class-one=""
            input-value="{{ $order->easy_payment_condition }}"
            :input-readonly="true"
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