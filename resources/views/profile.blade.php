@extends('layouts.user_type.auth')

@section('content')
    <div class="main-content position-relative bg-gray-100">
        <div class="container-fluid">
            <div class="page-header min-height-100 border-radius-xl mt-4"
                style="background-image: url('../assets/img/curved-images/curved-maxxi.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-success opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            @if ($user->photo != '')
                                <img src="../assets/img/users/{{ $user->photo }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @else
                                <img src="../assets/img/users/maxxi.jpg" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @endif
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->name }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-12">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Alterar Dados</h6>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Vincular Código de Loja</h6>
                            <form action="{{ route('salvar-usuario', ['id' => $user->id]) }}" method="post" id="formArt"
                                name="formArt">
                                @csrf
                                <ul class="list-group">
                                    <select class="form-control mb-3" name="store_id" id="store_id"
                                        @if ($user->store_id != '') readonly disabled @endif>
                                        <option value="">Selecione a loja de origem da conta</option>
                                        @foreach ($stores as $store)
                                            <option @if ($store['id'] == $user->store_id) selected="selected" @endif
                                                value="{{ $store['id'] }}">{{ $store['id'] }} -
                                                {{ ucfirst($store['title']) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </ul>
                                <button type="submit" class="btn bg-gradient-warning btn-lg">Salvar</button>
                            </form>
                            {{-- <div class="mb-3">
                                <label for="tem-tele" class="form-label">Tem Tele?</label>
                                <select class="form-select" id="tem-tele" name="tem-tele" required>
                                    <option value="" disabled selected hidden>Selecione uma opção..</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_24" class="form-label">É 24H?</label>
                                <select class="form-select" id="is_24" name="is_24" required>
                                    <option value="" disabled selected hidden>Selecione uma opção...</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    pattern="[0-9]{10,11}" required placeholder="(xx) xxxxx-xxxx">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="adress" name="adress" required
                                    placeholder="Insira o endereço aqui">
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                    pattern="[0-9]{11}" required placeholder="(xx) xxxxx-xxxx">
                            </div>
                            <div class="mb-3">
                                <label for="hours" class="form-label">Horário de Atendimento</label>
                                <textarea class="form-control" id="hours" name="hours" rows="3" required></textarea>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8">
            </div>
        </div>
    </div>
@endsection
