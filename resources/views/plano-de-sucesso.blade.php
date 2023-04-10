@extends('layouts.user_type.auth')
@php
    $totalItens = 0;
    $totalVendaMeta = 0;
    $totalVendaVenda = 0;
    $totalClientesMeta = 0;
    $totalClientesVenda = 0;
    $totalLojas = 0;
@endphp
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
                            <h6>Plano de Sucesso (Última atualização:
                                {{ \Carbon\Carbon::parse($dateUpdated)->format('d/m/Y H:i') }})</h6>
                            <p class="text-sm mt-2">Resultado da campanha Plano de Sucesso Maxxi 2023 (resultados por
                                região).
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive pb-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-xs font-weight-bold mb-0">
                                            ID<br>Loja / Progresso</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Ticket<br>Ticket Atual</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Venda<br>Venda Atual</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Desconto<br>Desconto Atual</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Genéricos<br>Genéricos Atual</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Perfumaria<br>Perfumaria Atual</th>
                                        <th class="text-xs font-weight-bold mb-0">
                                            Meta Clientes<br>Clientes Atual</th>
                                    </tr>
                                </thead>
                                <tbody class="pb-3">
                                    @foreach ($results as $result)
                                        @php
                                            $totalLojas++;
                                            
                                            $itens = 0;
                                            if ($result->ticket_atual >= $result->ticket_meta) {
                                                $itens++;
                                            }
                                            if ($result->venda_atual >= $result->venda_meta) {
                                                $itens++;
                                            }
                                            if ($result->desconto_atual <= $result->desconto_meta) {
                                                $itens++;
                                            }
                                            if ($result->genericos_atual >= $result->genericos_meta) {
                                                $itens++;
                                            }
                                            if ($result->perfumaria_atual >= $result->perfumaria_meta) {
                                                $itens++;
                                            }
                                            if ($result->clientes_atual >= $result->clientes_meta) {
                                                $itens++;
                                            }
                                            
                                            $totalVendaMeta += $result->venda_meta;
                                            $totalVendaVenda += $result->venda_atual;
                                            $totalClientesMeta += $result->clientes_meta;
                                            $totalClientesVenda += $result->clientes_atual;
                                            
                                            $totalItens += $itens;
                                            
                                            $total = 100;
                                            $width = 100 / 6;
                                            
                                            switch ($itens) {
                                                case '1':
                                                case '2':
                                                    $progressBar = 'bg-danger';
                                                    break;
                                                case '3':
                                                case '4':
                                                    $progressBar = 'bg-secondary';
                                                    break;
                                                case '5':
                                                    $progressBar = 'bg-info';
                                                    break;
                                                case '6':
                                                    $progressBar = 'bg-success';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                            $progress = $itens * $width;
                                        @endphp
                                        <tr>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                Loja {{ $result->cdloja }} - {{ $result->descricaoloja }}<br>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-xs me-2">{{ $itens }}/6</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar {{ $progressBar }}" role="progressbar"
                                                                aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                                                aria-valuemax="100" style="width: {{ $progress }}%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ toMoney($result->ticket_meta) }}<br>
                                                <span
                                                    class="text-bold @if ($result->ticket_atual >= $result->ticket_meta) text-success @else text-danger @endif text-xs">{{ toMoney($result->ticket_atual) }}</span>
                                            </td>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ toMoney($result->venda_meta) }}<br>
                                                <span
                                                    class="text-bold @if ($result->venda_atual >= $result->venda_meta) text-success @else text-danger @endif text-xs">{{ toMoney($result->venda_atual) }}</span>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ $result->desconto_meta }}%<br>
                                                <span
                                                    class="text-bold @if ($result->desconto_atual >= $result->desconto_meta) text-danger @else text-success @endif text-xs">{{ $result->desconto_atual }}%</span>
                                            </td>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ $result->genericos_meta }}%<br>
                                                <span
                                                    class="text-bold @if ($result->genericos_atual >= $result->genericos_meta) text-success @else text-danger @endif text-xs">{{ $result->genericos_atual }}%</span>
                                            </td>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ $result->perfumaria_meta }}%<br>
                                                <span
                                                    class="text-bold @if ($result->perfumaria_atual >= $result->perfumaria_meta) text-success @else text-danger @endif text-xs">{{ $result->perfumaria_atual }}%</span>
                                            </td>
                                            <td class="text-xs text-secondary mb-0 text-center">
                                                {{ $result->clientes_meta }}<br>
                                                <span
                                                    class="text-bold @if ($result->clientes_atual >= $result->clientes_meta) text-success @else text-danger @endif text-xs">{{ $result->clientes_atual }}</span>
                                            </td>
                                            {{-- <td class="align-middle text-center text-sm">
                                                {{ $result->order_number }}<br>{{ $result->order_id }}</td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $result->attendant_name ? $result->attendant_name : 'Não informado' }}<br>{{ $result->attendant_cpf ? $result->attendant_cpf : 'Não informado' }}
                                            </td>
                                            <td class="align-middle text-center text-sm w-50 text-wrap">
                                                <p class="font-weight-bold mb-0 text-sm">{{ $result->observation }}
                                                </p>
                                                <br>
                                                {{ $result->check_products == 1 ? 'Ofereceu produtos.' : 'Não ofereceu produtos.' }}
                                                <br>
                                                {{ $result->check_stores == 1 ? 'Verificou troca de filial.' : 'Não verificou troca de filial.' }}
                                                <br>
                                                {{ $result->check_transfer == 1 ? 'Tentou transferência.' : 'Não tentou transferência.' }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $result->nf ? $result->nf : 'Sem NF' }}<br>{{ $result->client_cpf }}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $result->store_id }}<br>{{ $result->total }}</td>
                                            <td class="align-middle text-center text-sm">
                                                <select name="changeStatus" class="changeStatus"
                                                    id="changeStatus-{{ $result->id }}">
                                                    <option @if ($result->status == 'pending') selected="selected" @endif
                                                        value="pending">Pendente</option>
                                                    <option @if ($result->status == 'request') selected="selected" @endif
                                                        value="request">Requisitado</option>
                                                    <option @if ($result->status == 'done') selected="selected" @endif
                                                        value="done">Finalizado</option>
                                                    <option @if ($result->status == 'denied') selected="selected" @endif
                                                        value="denied">Negado</option>
                                                </select>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-xs text-secondary mb-0 text-start">
                                            <strong>Total de Lojas:</strong> {{ $totalLojas }}
                                            <br>
                                            <strong>Total Progresso:</strong> {{ $totalItens }}/{{ $totalLojas * 6 }}
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                            {{ toMoney(number_format($totalVendaMeta / $totalClientesMeta, 2)) }}<br>
                                            <span
                                                class="text-bold @if ($totalVendaVenda / $totalClientesVenda >= $totalVendaMeta / $totalClientesMeta) text-success @else text-danger @endif text-xs">{{ toMoney(number_format($totalVendaVenda / $totalClientesVenda, 2)) }}<br></span>
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                            {{ toMoney($totalVendaMeta) }}<br>
                                            <span
                                                class="text-bold @if ($totalVendaVenda >= $totalVendaMeta) text-success @else text-danger @endif text-xs">{{ toMoney($totalVendaVenda) }}</span>
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                        </td>
                                        <td class="text-xs text-secondary mb-0 text-center">
                                            {{ $totalClientesMeta }}<br>
                                            <span
                                                class="text-bold @if ($totalClientesVenda >= $totalClientesMeta) text-success @else text-danger @endif text-xs">{{ $totalClientesVenda }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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

        });
    </script>
@endpush
