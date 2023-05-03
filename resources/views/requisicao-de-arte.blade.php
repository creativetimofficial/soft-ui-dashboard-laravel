@extends('layouts.user_type.auth')
@section('content')
    <div class="row" id="contentArt">
        <div class="col-lg-12 col-md-12 mb-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex mb-2">
                        <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3 my-auto">
                            <h6>Requisição de Arte.</h6>
                            <p>Preencha os campos para requisição de arte. As artes terão no mínimo 2 dias de produção.</p>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('requisicao-de-arte/storeform') }}">
                        <div class="mb-3">
                            <label for="description" class="form-label">Ideia/Arte.</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">Referência (opcional) - Link de imagem.</label>
                            <input type="varchar" class="form-control" id="url" name="url"
                                placeholder="Insira o link de imagem aqui">
                        </div>
                        <div class="mb-3">
                            <p class="form-label">Precisa de data para a arte?</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="date_requisition_sim" name="precisa_data"
                                    value="sim">
                                <label class="form-check-label" for="date_requisition_sim">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="date_requisition_nao" name="precisa_data"
                                    value="nao" checked>
                                <label class="form-check-label" for="date_requisition_nao">
                                    Não
                                </label>
                            </div>
                        </div>
                        <div class="mb-3" id="div-data" style="display: none;">
                            <label for="data" class="form-label">Data de entrega (Mínimo 2 dias úteis de
                                produção)</label>
                            <input type="date" class="form-control" id="data" name="date_requisition" disabled>
                        </div>
                        <script>
                            const precisaDataSim = document.getElementById('date_requisition_sim');
                            const precisaDataNao = document.getElementById('date_requisition_nao');
                            const divData = document.getElementById('div-data');
                            const inputData = document.getElementById('data');

                            precisaDataSim.addEventListener('click', function() {
                                divData.style.display = 'block';
                                inputData.disabled = false;
                                inputData.required = 'required';
                            });

                            precisaDataNao.addEventListener('click', function() {
                                divData.style.display = 'none';
                                inputData.disabled = true;
                                inputData.required = '';
                            });
                        </script>

                        <div class="mb-3">
                            <label for="obs " class="form-label">Precisa de dados de loja? Insira os dados
                                necessários.</label>
                            <textarea class="form-control" id="obs" name="obs" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Solicitar Arte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('dashboard')
@endpush
