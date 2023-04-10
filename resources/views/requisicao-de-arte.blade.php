@extends('layouts.user_type.auth')
<script src="../assets/js/plugins/jquery.js"></script>
@section('content')
    <div class="row" id="contentArt">
        <div class="col-lg-12 col-md-12 mb-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex mb-2">
                        <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                            <i class="fa fa-list" text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3 my-auto">
                            <h6>Pedidos da Loja</h6>
                            <p class="text-sm mt-2">Essa página é apenas para consulta e facilidade de copiar o código ou
                                número do pedido e verificar o status do mesmo.</p>
                        </div>
                    </div>
                    {{ toMoney('56.00') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')
@endpush
