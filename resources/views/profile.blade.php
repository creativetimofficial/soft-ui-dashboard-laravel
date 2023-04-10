
@extends('layouts.user_type.auth')

@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved-maxxi.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-success opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              @if($user->photo!='')
                <img src="../assets/img/users/{{$user->photo}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              @else 
                <img src="../assets/img/users/maxxi.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              @endif
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{$user->name}}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{$user->email}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Alterar Dados</h6>
            </div>
            <div class="card-body p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder">Vincular Código de Loja</h6>
              <form action="{{route('salvar-usuario',['id'=>$user->id])}}" method="post" id="formArt" name="formArt">
                @csrf
                <ul class="list-group">
                  @php
                      $fieldsSelect = '62|Alvorada - Bela Vista,118|Alvorada - Bela Vista 2,160|Alvorada - Bela Vista 3,161|Alvorada - Jardim Algarve,167|Arroio do Meio,177|Arroio,70|Arroio dos Ratos,33|Bento Gonçalves - Centro,19|Bento Gonçalves - Centro 2,174|Bento Gonçalves - Universitário,98|Bom Princípio,131|Bom Retiro do Sul,83|Butiá,49|Cachoeirinha - Vila Imbuí,8|Campo Bom,43|Canela - Centro ,72|Canela - Centro 2,163|Canela - Centro 3,77|Canoas - Av. Florianópolis,28|Canoas - Av. Rio Grande do Sul,97|Canoas - Av. Rio Grande do Sul 2,5|Canoas - Centro,6|Canoas - Centro 2,103|Canoas - Delivery,170|Canoas - Drive Thru,4|Canoas - Golden Center,10|Canoas - Guajuviras,29|Canoas - Hospital Pronto Socorro,68|Canoas - Mato Grande 1 ,130|Canoas - Mato Grande 2,158|Canoas - Maxplaza,81|Canoas - Niterói,166|Canoas - Niterói 2,117|Canoas - Rio Branco,59|Canoas - Ulbra,95|Canoas - Ulbra 2,26|Capão da Canoa - Centro ,15|Capão da Canoa - Centro 2,85|Caxias do Sul - São Pelegrino,122|Caxias do Sul- Madureira,74|Dois Irmãos - Centro,115|Estância Velha - Centro,57|Esteio - Centro,173|Esteio - Centro 2,51|Estrela - Centro,86|Feliz - Centro,104|Flores da Cunha - Centro,27|Gramado - Centro,105|Gravataí - Morada do Vale I,127|Gravataí - Parque do Itatiaia,109|Gravataí - São Vicente 2,108|Gravataí - São Vicente 3,172|Guaíba - Jardim Iolanda,153|Guaíba - Santa Rita,176|Guaíba - Santa Rita 2,2|Igrejinha - Centro,73|Imbé - Centro,107|Ivoti - Centro,48|Lajeado - Centro 2,144|Lajeado - Montanha,168|Montenegro - Bairro São João,53|Montenegro - Centro,139|Montenegro - Timbaúva,94|Nova Petrópolis - Centro,150|Nova Santa Rita - Berto Círio,110|Nova Santa Rita - Centro,35|Novo Hamburgo - Canudos 3,52|Novo Hamburgo - Canudos 5,25|Novo Hamburgo - Centro,50|Novo Hamburgo - Centro 4,89|Novo Hamburgo - Centro 7,145|Novo Hamburgo - Primavera,76|Novo Hamburgo - Rincão,135|Novo Hamburgo - São José,13|Osório - Centro,157|Osório - Centro,79|Osório - Centro 2,3|Parobé - Centro,21|Pelotas - Centro,1|Pelotas - Centro 1,42|Pelotas - Centro 2,61|Pelotas - Centro 3,99|Portão - Centro,178|Portão - Centro 2,17|POA - Cidade Baixa,11|POA - Cristo Redentor,16|POA - Cristo Redentor 2,120|POA - Dr. Flores,119|POA - Jardim Itu Sabará,136|POA - Lomba do Pinheiro,23|POA - Praça Parobé,44|POA - Sarandi,164|Porto Alegre - Bairro Glória,47|Rio Grande - Centro,123|Rio Grande - Centro 3,155|Rio Grande - Vila São Miguel,46|Rio Pardo - Centro,141|Rolante - Centro,179|Santa Cruz - João Alves,39|Santa Cruz do Sul - Ana Nery,149|Santa Cruz do Sul - Ana Nery 2,30|Santa Cruz do Sul - Centro,132|Santa Cruz do Sul - Centro 2,67|Santo Antônio da Patrulha - Centro,114|Santo Antônio da Patrulha - Centro 2,54|Santo Antônio da Patrulha - Centro 3,129|São Gabriel - Centro,162|São Gabriel - Vila Rocha,60|São José do Norte - Centro 1,80|São José do Norte - Centro 2,101|São Leopoldo - Campina,140|São Leopoldo - Campina 2,14|São Leopoldo - Centro ,12|São Leopoldo - Centro 2,58|São Leopoldo - Feitoria,169|São Leopoldo - Feitoria 2,146|São Leopoldo - Rio Branco,102|São Leopoldo - Rio dos Sinos,175|São Leopoldo - Santo André,87|São Sebastião do Caí - Centro,90|São Sebastião do Caí - Centro 2,22|Sapiranga - Centro,112|Sapiranga - Centro 3,66|Sapiranga - São Luiz,154|Tapes,18|Taquara - Centro,148|Taquara - Centro 2,32|Taquari - Centro,84|Taquari - Centro 2,9|Tramandaí - Centro,88|Tramandaí - Centro 2,134|Tramandaí - Centro 3,37|Três Coroas - Centro,151|Triunfo - Centro,55|Venâncio - Centro 3,20|Venâncio Aires - Centro,36|Venâncio Aires - Centro 2,92|Vera Cruz - Centro,143|Veranópolis - Centro,45|Viamão - Santa Isabel';
                      $fieldsSelect = explode(',',$fieldsSelect);
                  @endphp
                  <select class="form-control mb-3" name="store_id" id="store_id" @if($user->store_id!='') readonly disabled @endif>
                    <option value="">Selecione a loja de origem da conta</option>
                    @foreach ($fieldsSelect as $fSelect)
                        @php $fS = explode('|',$fSelect); @endphp
                        <option @if($fS['0']==$user->store_id) selected="selected" @endif value="{{$fS['0']}}">{{$fS['0']}} - {{ucfirst($fS['1'])}}</option>
                    @endforeach
                  </select>
                </ul>
                <button type="submit" class="btn bg-gradient-warning btn-lg">Salvar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-8">
        </div>
      </div>
    </div>
  </div>
@endsection

