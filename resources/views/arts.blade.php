@extends('layouts.user_type.auth')

@section('content')
    <section class="py-3">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex mb-2">
                            <a href="https://1drv.ms/f/s!AtRXG4Vg2pI-3Q9nZXS0S-DjM-Mo?e=2eO4xy" target="_blank">
                                <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                                    <i class="fa fa-drafting-compass text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="ms-3 my-auto">
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                    href="https://1drv.ms/f/s!AtRXG4Vg2pI-3Q9nZXS0S-DjM-Mo?e=2eO4xy" target="_blank">
                                    <h6>Diretório de Arquivos</h6>
                                </a>
                                <p class="text-sm mt-2">Acesse esse link para baixar imagens de campanhas e arquivos de
                                    divulgação</p>
                            </div>
                        </div>
                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                            href="https://1drv.ms/f/s!AtRXG4Vg2pI-3Q9nZXS0S-DjM-Mo?e=2eO4xy" target="_blank">
                            Acessar
                            <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
                        </a>
                        <hr class="horizontal dark" />
                        <div class="row">
                            <div class="col-12">
                                <p class="text-secondary text-sm font-weight-bold mb-0">
                                    Link externo ao OneDrive com diversos arquivos<br>Não compartilhar externamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($arts as $art)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex mb-2">
                                <a href="{{ route('arte', ['id' => $art->id]) }}">
                                    <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                                        <i class="{{ $art->image_group }} text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <div class="ms-3 my-auto">
                                    <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                        href="{{ route('arte', ['id' => $art->id]) }}">
                                        <h6>{{ $art->title }}</h6>
                                    </a>
                                    <p class="text-sm mt-2">{{ $art->summary }}</p>
                                </div>
                            </div>
                            <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                href="{{ route('arte', ['id' => $art->id]) }}">
                                Acessar
                                <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
                            </a>
                            <hr class="horizontal dark" />
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Downloads Hoje:
                                        {{ count($art->download) }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Criado em:
                                        {{ \Carbon\Carbon::parse($art->created_at)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-2 text-end">
                                    <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                        data-original-title="{{ $art->user['title'] }}">
                                        <img alt="Image placeholder"
                                            src="../../../assets/img/users/{{ $art->user['photo'] }}" class="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('dashboard')
@endpush

<style>
    iframe {
        border-radius: 0.5rem;
        width: 74px !important;
        height: 74px !important;
    }
</style>
