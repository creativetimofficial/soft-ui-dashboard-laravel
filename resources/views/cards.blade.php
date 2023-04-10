@extends('layouts.user_type.auth')

@section('content')

<section class="py-3">
    <div class="row">
      @foreach ($cards as $card)
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
                Acessar
                <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
              </a>
              <hr class="horizontal dark" />
              <div class="row">
                <div class="col-4">
                  <p class="text-secondary text-sm font-weight-bold mb-0">Leituras: @if($card->read) {{count($card->read)}} @else 0 @endif</p>
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

@endsection

@push('dashboard')
@endpush