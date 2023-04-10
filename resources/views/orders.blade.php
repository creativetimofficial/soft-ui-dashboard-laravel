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
                            <p class="text-sm mt-2">Essa página é apenas para consulta e facilidade de copiar o código ou número do pedido e verificar o status do mesmo.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-2">
                            <hr class="horizontal dark" />
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-sm text-center font-weight-bold mt-2">Identificador / Número do Pedido</p>
                                </div>
                                <div class="col-4">
                                    <p class="text-sm text-center font-weight-bold mt-2">Status</p>
                                </div>
                                <div class="col-2">
                                    <p class="text-sm text-center font-weight-bold mt-2">Data</p>
                                </div>
                                <div class="col-2">
                                    <p class="text-sm text-center font-weight-bold mt-2">Valor Total</p>
                                </div>
                            </div>
                            <hr class="horizontal dark" />
                            @foreach ($allData['pedidos'] as $data)
                                <div class="row">
                                    <div class="col-4">
                                        <p class="text-sm text-center mt-2">{{$data['id']}} / {{$data['numero_pedido']}}</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-sm text-center mt-2">
                                            @switch($data['status'])
                                                @case(1)
                                                    Em separação
                                                    @break
                                                @case(2)
                                                    Ticket Impresso / Separando
                                                    @break
                                                @case(3)
                                                    Entregue
                                                    @break
                                                @case(4)
                                                    Cancelado
                                                    @break
                                                @case(5)
                                                @case(7)
                                                    Estornado
                                                    @break
                                                @case(6)
                                                    Análise de pagamento
                                                    @break
                                                @case(8)
                                                    Aguardando Motoboy / Entregue
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <p class="text-sm text-center mt-2">{{\Carbon\Carbon::parse($data['created_at'])->format('d/m/Y')}}</p>
                                    </div>
                                    <div class="col-2">
                                        <p class="text-sm text-center mt-2">R$ {{$data['vlr_total_frete']}}</p>
                                    </div>
                                </div>
                                <hr class="horizontal dark" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')
@endpush