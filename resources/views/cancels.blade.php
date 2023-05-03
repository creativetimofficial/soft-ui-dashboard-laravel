@extends('layouts.user_type.auth', ['parentFolder' => 'ecommerce', 'childFolder' => 'cancelamentos'])
<script src="../assets/js/plugins/jquery.js"></script>
@section('content')
    <div class="row" id="contentArt">
        <div class="col-lg-12 col-md-12 mb-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex mb-2">
                        <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                            <i class="fa fa-shopping-cart" text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3 my-auto">
                            <h6>Cancelamentos</h6>
                            <p class="text-sm mt-2">Para realizar o cancelamento, insira o número identificador ou número do
                                pedido nos campos abaixo.<br>
                                Após, clique em pesquisar e preencha os campos em aberto para cancelamento.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-2">
                            <form action="{{ route('cancel-order') }}" method="post" id="formArt" name="formArt">
                                @csrf
                                <input type="text" name="store_id" id="store_id" style="display:none;"
                                    value="{{ $user->store_id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb-2">
                                        <div class="mb-3">
                                            <label for="order_id" class="form-label">Número Identificador*</label>
                                            <input class="form-control mb-2" name="order_id" id="order_id" type="text"
                                                required
                                                onkeypress="return event.keyCode === 8 || event.keyCode === 13 || event.charCode >= 48 && event.charCode <= 57">
                                            <label for="order_number" class="form-label">Número Pedido*</label>
                                            <input class="form-control mb-2" name="order_number" id="order_number"
                                                type="text" required>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="total_order" class="form-label d-none">Valor Pedido</label>
                                                    <input class="form-control mb-2 d-none" name="total_order"
                                                        id="total_order" type="text">
                                                </div>
                                                <div class="col-6">
                                                    <label for="nf" class="form-label d-none">Nro Nota Fiscal (se
                                                        tiver)</label>
                                                    <input class="form-control mb-2 d-none" name="nf" id="nf"
                                                        onkeypress="return event.keyCode === 8 || event.keyCode === 13 || event.charCode >= 48 && event.charCode <= 57"
                                                        type="text">
                                                </div>
                                            </div>
                                            <label for="cpf" class="form-label d-none">Cpf Cliente*</label>
                                            <input class="form-control mb-2 d-none" name="cpf" id="cpf"
                                                type="text" required>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" id="searchOrder"
                                                class="btn bg-gradient-warning btn-lg">Procurar</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-2">
                                        <label for="observation" class="form-label d-none">Motivo do Cancelamento*</label>
                                        <textarea class="form-control mb-2 d-none" name="observation" id="observation" type="text" required rows="3"></textarea>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="attendant_name" class="form-label d-none">Nome do
                                                    Atendente*</label>
                                                <input class="form-control mb-2 d-none" name="attendant_name"
                                                    id="attendant_name" type="text" required>
                                            </div>
                                            <div class="col-6">
                                                <label for="attendant_cpf" class="form-label d-none">Cpf do
                                                    Atendente*</label>
                                                <input class="form-control mb-2 d-none" name="attendant_cpf"
                                                    onkeypress="return event.keyCode === 8 || event.keyCode === 13 || event.charCode >= 48 && event.charCode <= 57"
                                                    id="attendant_cpf" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input mt-0 d-none" value="1" type="checkbox"
                                                value="" id="check_products" name="check_products">
                                            <label class="custom-control-label d-none" for="check_products">Ofereci outros
                                                produtos</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input mt-0 d-none" value="1" type="checkbox"
                                                value="" id="check_transfer" name="check_transfer">
                                            <label class="custom-control-label d-none" for="check_transfer">Verifiquei
                                                possibilidade de transferência</label>
                                        </div>
                                        <div class="form-check mt-2 mb-3">
                                            <input class="form-check-input mt-0 d-none" value="1" type="checkbox"
                                                value="" id="check_stores" name="check_stores">
                                            <label class="custom-control-label d-none" for="check_stores">Verifiquei
                                                possibilidade de troca de filial</label>
                                        </div>
                                        <div class="mb-3 d-none">
                                            <button type="submit" id="cancelOrder" onclick="return false;"
                                                class="btn bg-gradient-danger btn-lg">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="payment_id" id="payment_id">
                            </form>
                            <hr class="horizontal dark" />
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Total Cancelamentos:
                                        {{ $totalCancel }}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Total Cancelamentos da loja:
                                        {{ $totalCancelStore }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')
@endpush

<script>
    $(document).ready(function() {
        $("#formArt").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });

        $('#order_number').val();
        $('#total_order').val();

        $('#cancelOrder').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Deseja cancelar?',
                text: "Verifique os campos antes de confirmar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, cancelar!',
                cancelButtonText: 'Não!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formArt').submit();
                }
            })
        });

        $('#searchOrder').click(function(e) {
            e.preventDefault();
            var _token = '6b1ef7260104873eb0c5ee35b9c7435a';
            var store_id = $('#store_id').val();
            var order_id = $('#order_id').val();
            var order_number = $('#order_number').val();
            if (order_id == '' && order_number == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Preencha o campo identificador ou número do pedido para buscar informações do pedido.'
                });
                return false;
            }
            if (order_id != '' && order_number != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Preencha apenas um campo para retornar o pedido desejado.'
                });
                return false;
            }
            if (order_id != '' && order_number == '') {
                $.ajax({
                    type: "GET",
                    url: "https://maxxieconomica.com/api/json-api/ordernumber",
                    data: {
                        order_id: order_id,
                        order_number: order_number,
                        store_id: store_id,
                        _token: _token
                    },
                    success: function(response) {
                        $('#order_number').val(response.numero_pedido);
                        $('#cpf').val(response.cpf);
                        $('#payment_id').val(response.tipo_pagamento);
                        $('#total_order').val(response.vlr_total_frete);
                        $('#order_number').attr("readonly", true);
                        $('#total_order').attr("readonly", true);
                        $('#cpf').attr("readonly", true);
                        $('.d-none').each(function(index, element) {
                            $(this).removeClass('d-none');
                            $(this).addClass('d-block');
                        });
                        Swal.fire({
                            icon: 'success',
                            title: 'Pedido Encontrado',
                            text: 'Valide os campos e confira os dados para confirmar cancelamento.'
                        });
                        return true;
                    },
                    error: function(response) {
                        $('#order_number').val();
                        $('#cpf').val();
                        $('#payment_id').val();
                        $('#total_order').val();
                        $('#order_number').attr("readonly", false);
                        $('#total_order').attr("readonly", false);
                        $('#cpf').attr("readonly", false);
                        $('.d-block').each(function(index, element) {
                            $(this).removeClass('d-block');
                            $(this).addClass('d-none');
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro ao encontrar pedido.',
                            text: 'Motivo: ' + response.responseJSON.message
                        });
                        return false;
                    }
                });
            }
            if (order_id == '' && order_number != '') {
                $.ajax({
                    type: "GET",
                    url: "https://maxxieconomica.com/api/json-api/orderstring",
                    data: {
                        order_id: order_id,
                        order_number: order_number,
                        store_id: store_id,
                        _token: _token
                    },
                    success: function(response) {
                        $('#order_id').val(response.id);
                        $('#cpf').val(response.cpf);
                        $('#payment_id').val(response.tipo_pagamento);
                        $('#total_order').val(response.vlr_total_frete);
                        $('#order_id').attr("readonly", true);
                        $('#total_order').attr("readonly", true);
                        $('#cpf').attr("readonly", true);
                        $('.d-none').each(function(index, element) {
                            $(this).removeClass('d-none');
                            $(this).addClass('d-block');
                        });
                        Swal.fire({
                            icon: 'success',
                            title: 'Pedido Encontrado',
                            text: 'Valide os campos e confira os dados para confirmar cancelamento.'
                        });
                        return true;
                    },
                    error: function(response) {
                        $('#order_id').val();
                        $('#cpf').val();
                        $('#payment_id').val();
                        $('#total_order').val();
                        $('#order_id').attr("readonly", false);
                        $('#total_order').attr("readonly", false);
                        $('#cpf').attr("readonly", false);
                        $('.d-block').each(function(index, element) {
                            $(this).removeClass('d-block');
                            $(this).addClass('d-none');
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro ao encontrar pedido.',
                            text: 'Motivo: ' + response.responseJSON.message
                        });
                        return false;
                    }
                });
            }
        });
    });
</script>
