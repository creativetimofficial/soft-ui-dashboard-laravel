@extends('layouts.user_type.auth')

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
                            <h6>Financeiro</h6>
                            <p class="text-sm mt-2">Página com requisições das lojas/clientes para cancelamentos/estornos.
                            </p>
                        </div>
                    </div>




                    <div class="col-12">
                        <div class="accordion" id="accordionPendings">
                            <div class="accordion-item mb-3">
                                <h5 class="accordion-header" id="headingPending">
                                    <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePendings" aria-expanded="true"
                                        aria-controls="collapsePendings">
                                        <span
                                            class="badge badge-primary badge-pill text-white">{{ $ordersP ? count($ordersP) : 0 }}</span>
                                        &nbsp;&nbsp;
                                        Pendentes
                                        <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                        <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                                <div id="collapsePendings" class="accordion-collapse collapse show"
                                    aria-labelledby="headingPending" data-bs-parent="#accordionPendings" style="">
                                    <div class="accordion-body text-sm opacity-8">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Pedido<br>ID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Atendente<br>Cpf</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center w-50 text-wrap">
                                                        Observações</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        NF<br>CPF Cliente</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Cdloja<br>Total</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            @foreach ($ordersP as $oP)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oP->order_number }}<br>{{ $oP->order_id }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oP->attendant_name ? $oP->attendant_name : 'Não informado' }}<br>{{ $oP->attendant_cpf ? $oP->attendant_cpf : 'Não informado' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm w-50 text-wrap">
                                                        <p class="font-weight-bold mb-0 text-sm">{{ $oP->observation }}</p>
                                                        <br>
                                                        {{ $oP->check_products == 1 ? 'Ofereceu produtos.' : 'Não ofereceu produtos.' }}
                                                        <br>
                                                        {{ $oP->check_stores == 1 ? 'Verificou troca de filial.' : 'Não verificou troca de filial.' }}
                                                        <br>
                                                        {{ $oP->check_transfer == 1 ? 'Tentou transferência.' : 'Não tentou transferência.' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oP->nf ? $oP->nf : 'Sem NF' }}<br>{{ $oP->client_cpf }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oP->store_id }}<br>{{ $oP->total }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        <select name="changeStatus" class="changeStatus"
                                                            id="changeStatus-{{ $oP->id }}">
                                                            <option
                                                                @if ($oP->status == 'pending') selected="selected" @endif
                                                                value="pending">Pendente</option>
                                                            <option
                                                                @if ($oP->status == 'request') selected="selected" @endif
                                                                value="request">Requisitado</option>
                                                            <option
                                                                @if ($oP->status == 'done') selected="selected" @endif
                                                                value="done">Finalizado</option>
                                                            <option
                                                                @if ($oP->status == 'denied') selected="selected" @endif
                                                                value="denied">Negado</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="accordion" id="accordionRequests">
                            <div class="accordion-item mb-3">
                                <h5 class="accordion-header" id="headingRequests">
                                    <button class="accordion-button border-bottom font-weight-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseRequests" aria-expanded="true"
                                        aria-controls="collapseRequests">
                                        <span
                                            class="badge badge-secondary badge-pill">{{ $ordersR ? count($ordersR) : 0 }}</span>
                                        &nbsp;&nbsp;
                                        Requisições
                                        <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                        <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                                <div id="collapseRequests" class="accordion-collapse collapse show"
                                    aria-labelledby="headingRequests" data-bs-parent="#accordionRequests" style="">
                                    <div class="accordion-body text-sm opacity-8">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Pedido<br>ID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Atendente<br>Cpf</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Observações</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        NF<br>CPF Cliente</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Cdloja<br>Total</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            @foreach ($ordersR as $oR)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oR->order_number }}<br>{{ $oR->order_id }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oR->attendant_name ? $oR->attendant_name : 'Não informado' }}<br>{{ $oR->attendant_cpf ? $oR->attendant_cpf : 'Não informado' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm w-50 text-wrap">
                                                        <p class="font-weight-bold mb-0 text-sm">{{ $oR->observation }}</p>
                                                        <br>
                                                        {{ $oR->check_products == 1 ? 'Ofereceu produtos.' : 'Não ofereceu produtos.' }}
                                                        <br>
                                                        {{ $oR->check_stores == 1 ? 'Verificou troca de filial.' : 'Não verificou troca de filial.' }}
                                                        <br>
                                                        {{ $oR->check_transfer == 1 ? 'Tentou transferência.' : 'Não tentou transferência.' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oR->nf ? $oR->nf : 'Sem NF' }}<br>{{ $oR->client_cpf }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oR->store_id }}<br>{{ $oR->total }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        <select name="changeStatus" class="changeStatus"
                                                            id="changeStatus-{{ $oR->id }}">
                                                            <option
                                                                @if ($oR->status == 'pending') selected="selected" @endif
                                                                value="pending">Pendente</option>
                                                            <option
                                                                @if ($oR->status == 'request') selected="selected" @endif
                                                                value="request">Requisitado</option>
                                                            <option
                                                                @if ($oR->status == 'done') selected="selected" @endif
                                                                value="done">Finalizado</option>
                                                            <option
                                                                @if ($oR->status == 'denied') selected="selected" @endif
                                                                value="denied">Negado</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="accordion" id="accordionDone">
                            <div class="accordion-item mb-3">
                                <h5 class="accordion-header" id="headingDone">
                                    <button class="accordion-button border-bottom font-weight-bold collapsed"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseDone"
                                        aria-expanded="true" aria-controls="collapseDone">
                                        <span
                                            class="badge badge-success badge-pill">{{ $ordersD ? count($ordersD) : 0 }}</span>
                                        &nbsp;&nbsp;
                                        Finalizados
                                        <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                        <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                                <div id="collapseDone" class="accordion-collapse collapse show"
                                    aria-labelledby="headingDone" data-bs-parent="#accordionDone" style="">
                                    <div class="accordion-body text-sm opacity-8">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Pedido<br>ID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Atendente<br>Cpf</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Observações</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        NF<br>CPF Cliente</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Cdloja<br>Total</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            @foreach ($ordersD as $oD)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oD->order_number }}<br>{{ $oD->order_id }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oD->attendant_name ? $oD->attendant_name : 'Não informado' }}<br>{{ $oD->attendant_cpf ? $oD->attendant_cpf : 'Não informado' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm w-50 text-wrap">
                                                        <p class="font-weight-bold mb-0 text-sm">{{ $oD->observation }}
                                                        </p>
                                                        <br>
                                                        {{ $oD->check_products == 1 ? 'Ofereceu produtos.' : 'Não ofereceu produtos.' }}
                                                        <br>
                                                        {{ $oD->check_stores == 1 ? 'Verificou troca de filial.' : 'Não verificou troca de filial.' }}
                                                        <br>
                                                        {{ $oD->check_transfer == 1 ? 'Tentou transferência.' : 'Não tentou transferência.' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oD->nf ? $oD->nf : 'Sem NF' }}<br>{{ $oD->client_cpf }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oD->store_id }}<br>{{ $oD->total }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        <select name="changeStatus" class="changeStatus"
                                                            id="changeStatus-{{ $oD->id }}">
                                                            <option
                                                                @if ($oD->status == 'pending') selected="selected" @endif
                                                                value="pending">Pendente</option>
                                                            <option
                                                                @if ($oD->status == 'request') selected="selected" @endif
                                                                value="request">Requisitado</option>
                                                            <option
                                                                @if ($oD->status == 'done') selected="selected" @endif
                                                                value="done">Finalizado</option>
                                                            <option
                                                                @if ($oD->status == 'denied') selected="selected" @endif
                                                                value="denied">Negado</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-12">
                        <div class="accordion" id="accordionDenied">
                            <div class="accordion-item mb-3">
                                <h5 class="accordion-header" id="headingDenied">
                                    <button class="accordion-button border-bottom font-weight-bold collapsed"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseDenied"
                                        aria-expanded="true" aria-controls="collapseDenied">
                                        <span
                                            class="badge badge-danger badge-pill text-white">{{ $ordersDe ? count($ordersDe) : 0 }}</span>
                                        &nbsp;&nbsp;
                                        Negados
                                        <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                        <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                                <div id="collapseDenied" class="accordion-collapse collapse show"
                                    aria-labelledby="headingDenied" data-bs-parent="#accordionDenied" style="">
                                    <div class="accordion-body text-sm opacity-8">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Pedido<br>ID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Atendente<br>Cpf</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Observações</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        NF<br>CPF Cliente</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Cdloja<br>Total</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            @foreach ($ordersDe as $oDe)
                                                <tr>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oDe->order_number }}<br>{{ $oDe->order_id }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oDe->attendant_name ? $oDe->attendant_name : 'Não informado' }}<br>{{ $oDe->attendant_cpf ? $oDe->attendant_cpf : 'Não informado' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm w-50 text-wrap">
                                                        <p class="font-weight-bold mb-0 text-sm">{{ $oDe->observation }}
                                                        </p>
                                                        <br>
                                                        {{ $oDe->check_products == 1 ? 'Ofereceu produtos.' : 'Não ofereceu produtos.' }}
                                                        <br>
                                                        {{ $oDe->check_stores == 1 ? 'Verificou troca de filial.' : 'Não verificou troca de filial.' }}
                                                        <br>
                                                        {{ $oDe->check_transfer == 1 ? 'Tentou transferência.' : 'Não tentou transferência.' }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oDe->nf ? $oDe->nf : 'Sem NF' }}<br>{{ $oDe->client_cpf }}
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        {{ $oDe->store_id }}<br>{{ $oDe->total }}</td>
                                                    <td class="align-middle text-center text-sm">
                                                        <select name="changeStatus" class="changeStatus"
                                                            id="changeStatus-{{ $oDe->id }}">
                                                            <option
                                                                @if ($oDe->status == 'pending') selected="selected" @endif
                                                                value="pending">Pendente</option>
                                                            <option
                                                                @if ($oDe->status == 'request') selected="selected" @endif
                                                                value="request">Requisitado</option>
                                                            <option
                                                                @if ($oDe->status == 'done') selected="selected" @endif
                                                                value="done">Finalizado</option>
                                                            <option
                                                                @if ($oDe->status == 'denied') selected="selected" @endif
                                                                value="denied">Negado</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection


@push('dashboard')
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('.changeStatus').change(function(e) {
                e.preventDefault();
                var value = this.id;
                var newstatus = this.value;
                var splitted = value.split("-");
                console.log(splitted[1]);
                $.ajax({
                    type: "GET",
                    url: '{{ route('change-order') }}',
                    data: {
                        id: splitted[1],
                        status: newstatus
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
