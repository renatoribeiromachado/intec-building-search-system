@extends('layouts.app_customer')

@section('content')
    <div class="container pb-4 bg-light border">
        <div class="row mt-4">
            <div class="col-md-12">
                <h4><i class="fa fa-check"></i> EDITAR PEDIDO</h4>
            </div>
        </div>

        @include('layouts.alerts.all-errors')
        @include('layouts.alerts.success')

        <form action="{{ route('associate.order.update', [$company->id, $order->id]) }}" method="post" role="form">
            @csrf
            @method('put')

            @include('layouts.forms.add_edit_order')

            <div class="row mt-4">
                <div class="col-md-12">
                    <button
                        type="submit"
                        class="btn btn-success"
                        >
                        Atualizar Pedido
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')

    <script>

        $(document).ready(function () {

            $('#installments').on("change", function () {

                let installments = $( this ).val();

                let easyPaymentCondition = document
                    .querySelector("input[id='easy_payment_condition']");

                let finalPrice = document.querySelector("input[id='final_price']").value;

                if (finalPrice.length > 0) {

                    $.ajax({
                        type: "POST",
                        url: base_url() + 'v1/calculate-installments',
                        data: {
                            final_price: finalPrice,
                            installments: installments
                        },
                        success: function (return_data) {

                            let easyPaymentCondition = document.querySelector("input[id='easy_payment_condition']");

                            easyPaymentCondition.value = `${return_data.message}`;
                        },
                        error: function (event) {
                            console.log(event)
                        }
                    });

                }

                $('#final_price').trigger('input');

            });

            //set initial state.
            $('#discount_in_percentage').val(this.checked);

            $('#discount_in_percentage').on("change", function () {
                getFinalPrice();
            });

            $('#original_price').on("focusout", function () {
                getFinalPrice();
            });

            $('#discount').on("focusout", function () {
                getFinalPrice();
            });

            $('#applyDiscountButton').on("click", function () {
                getFinalPrice();
            });
        
            function getFinalPrice() {

                let originalPrice = document.querySelector("input[id='original_price']").value;

                if (originalPrice <= 0) {
                    return false;
                }

                let discount = document.querySelector("input[id='discount']").value;

                let discountInPercentageInput = document.querySelector("input[id='discount_in_percentage']");

                let discountInPercentage = 1;

                if (! discountInPercentageInput.checked) {
                    discountInPercentage = 0;
                }

                if (originalPrice.length > 0) {

                    $.ajax({
                        type: "POST",
                        url: base_url() + 'v1/apply-discount',
                        data: {
                            original_price: originalPrice,
                            discount: discount,
                            discount_in_percentage: discountInPercentage
                        },
                        success: function (return_data) {

                            let finalPrice = document.querySelector("input[id='final_price']");

                            finalPrice.value = Number(return_data.final_price);

                            if (finalPrice.value < 0) {
                                let message = `O desconto aplicado resultou em um número negativo `;
                                message += `R$ ${finalPrice.value}. Confira os valores novamente.`;

                                alert(message);

                                finalPrice.value = 0;
                            }

                            finalPrice.value = parseFloat(finalPrice.value).toFixed(2);

                            $('#final_price').trigger('input');

                        },
                        error: function (event) {
                            console.log(event)
                        }
                    });

                }
                else {
                    
                }

            }

        });

    </script>

@endpush
