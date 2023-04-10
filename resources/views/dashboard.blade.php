@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Acessos Informativos</p>
                <h5 class="font-weight-bolder mb-0">
                  {{$totalInfos}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fas fa-drafting-compass text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Informativos</p>
                <h5 class="font-weight-bolder mb-0">
                  {{$totalCards}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-file-alt text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Usuários</p>
                <h5 class="font-weight-bolder mb-0">
                  {{$totalUsers}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Downloads</p>
                <h5 class="font-weight-bolder mb-0">
                  {{$totalDownloads}}
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-download text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="py-3">
    <div class="row mt-4">
      <div class="col-md-8 me-auto text-left">
        <h5>Últimos informativos.</h5>
        <p>Acompanhe os últimos informativos criados sobre os processos internos.</p>
      </div>
    </div>
    <div class="row">
      @foreach ($cardsList as $card)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="d-flex mb-2">
                <a href="{{route('informativo',['id' => $card->id])}}">
                  <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                    <i class="{{$card->image_group}} text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </a>
                <div class="ms-3 my-auto">
                  <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('informativo',['id' => $card->id])}}">
                    <h6>{{$card->title}}</h6>
                  </a>
                  <p class="text-sm mt-2">{{$card->summary}}</p>
                </div>
              </div>
              <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('informativo',['id' => $card->id])}}">
                Ler Informativo
                <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
              </a>
              <hr class="horizontal dark" />
              <div class="row">
                <div class="col-4">
                  <p class="text-secondary text-sm font-weight-bold mb-0">Leituras: {{count($card->read)}}</p>
                </div>
                <div class="col-6">
                  <p class="text-secondary text-sm font-weight-bold mb-0">Criado em: {{\Carbon\Carbon::parse($card->created_at)->format('d/m/Y')}}</p>
                </div>
                <div class="col-2 text-end">
                  <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="{{$card->user['title']}}">
                    <img alt="Image placeholder" src="../../../assets/img/users/{{$card->user['photo']}}" class="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  <section class="">
    <div class="row mt-4">
      <div class="col-md-8 me-auto text-left">
        <h5>Últimas artes automáticas.</h5>
        <p>Acompanhe as últimas artes automáticas que podem ser geradas.</p>
      </div>
    </div>
    <div class="row">
      @foreach ($infosList as $info)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="d-flex mb-2">
                <a href="{{route('arte',['id' => $info->id])}}">
                  <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                    <i class="{{$info->image_group}} text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </a>
                <div class="ms-3 my-auto">
                  <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('arte',['id' => $info->id])}}">
                    <h6>{{$info->title}}</h6>
                  </a>
                  <p class="text-sm mt-2">{{$info->summary}}</p>
                </div>
              </div>
              <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('arte',['id' => $info->id])}}">
                Acessar Página
                <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
              </a>
              <hr class="horizontal dark" />
              <div class="row">
                <div class="col-4">
                  <p class="text-secondary text-sm font-weight-bold mb-0">Acessos Hoje: {{count($info->read)}}</p>
                </div>
                <div class="col-6">
                  <p class="text-secondary text-sm font-weight-bold mb-0">Criado em: {{\Carbon\Carbon::parse($info->created_at)->format('d/m/Y')}}</p>
                </div>
                <div class="col-2 text-end">
                  <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="{{$info->user['title']}}">
                    <img alt="Image placeholder" src="../../../assets/img/users/{{$info->user['photo']}}" class="" />
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