@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        @foreach ($card as $cd)
            <div class="col-lg-8 col-md-8 mb-8">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex mb-2">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                <i class="{{$cd->image_group}} text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                            <div class="ms-3 my-auto">
                                <h6>{{$cd->title}}</h6>
                                <p class="text-sm mt-2">{{$cd->summary}}</p>
                            </div>
                        </div>
                        <p class="text-sm mt-2">{!!$cd->description!!}</p>
                        <hr class="horizontal dark" />
                        <div class="row">
                            <div class="col-4">
                                <p class="text-secondary text-sm font-weight-bold mb-0">Leituras: {{count($cd->read)}}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-secondary text-sm font-weight-bold mb-0">Criado em: {{\Carbon\Carbon::parse($cd->created_at)->format('d/m/Y')}}</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="{{$cd->user['title']}}">
                                    <img alt="Image placeholder" src="../../../assets/img/users/{{$cd->user['photo']}}" class="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-lg-4 col-md-4 mb-4">
            <div class="row">
                <div class="col-md-8 me-auto text-left">
                    <h5>Outros Informativos</h5>
                </div>
            </div>
            @foreach ($othersCards as $otherCd)
                <div class="card mb-4">
                  <div class="card-body p-3">
                    <div class="d-flex mb-2">
                      <a href="{{route('informativo',['id' => $otherCd->id])}}">
                        <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                            <i class="{{$otherCd->image_group}} text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                      </a>
                      <div class="ms-3 my-auto">
                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('informativo',['id' => $otherCd->id])}}">
                          <h6>{{$otherCd->title}}</h6>
                        </a>
                        <p class="text-sm mt-2">{{$otherCd->summary}}</p>
                      </div>
                    </div>
                    <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('informativo',['id' => $otherCd->id])}}">
                      Ler Informativo
                      <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
                    </a>
                    <hr class="horizontal dark" />
                    <div class="row">
                      <div class="col-4">
                        <p class="text-secondary text-sm font-weight-bold mb-0">Leituras: {{count($otherCd->read)}}</p>
                      </div>
                      <div class="col-6">
                        <p class="text-secondary text-sm font-weight-bold mb-0">Criado em: {{\Carbon\Carbon::parse($otherCd->created_at)->format('d/m/Y')}}</p>
                      </div>
                      <div class="col-2 text-end">
                        <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-original-title="{{$otherCd->user['title']}}">
                          <img alt="Image placeholder" src="../../../assets/img/users/{{$otherCd->user['photo']}}" class="" />
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('dashboard')
@endpush