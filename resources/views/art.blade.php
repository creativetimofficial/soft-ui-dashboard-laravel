@extends('layouts.user_type.auth')
<script src="../assets/js/plugins/jquery.js"></script>
@section('content')
    <div class="row" id="contentArt">
        <div class="col-lg-8 col-md-8 mb-8">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex mb-2">
                        <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                            <i class="{{ $art->image_group }} text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                        <div class="ms-3 my-auto">
                            <h6>{{ $art->title }}</h6>
                            <p class="text-sm mt-2">{{ $art->summary }}</p>
                        </div>
                    </div>
                    <p class="text-sm mt-2">{!! $art->description !!}</p>
                    @if ($art->function == 'files')
                        @php
                            $path = public_path('assets/img/functions/files/');
                            $imgs = glob($path . '*.{jpg,png,gif}', GLOB_BRACE);
                        @endphp
                        <div class="row">
                            @foreach ($imgs as $file)
                                @php
                                    $fileArr = explode('/', $file);
                                @endphp
                                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                    {{-- <a download="../assets/img/functions/files/{{end($fileArr)}}" target="_blank" href="../assets/img/functions/files/{{end($fileArr)}}"> --}}
                                    <img class="images" src="../assets/img/functions/files/{{ end($fileArr) }}"
                                        style="max-width:100%;max-height:100%;">
                                    {{-- </a> --}}
                                    <a download="../assets/img/functions/files/{{ end($fileArr) }}"
                                        onclick="return addDownload({{ $art->id }},'{{ route('add-download') }}');"
                                        target="_blank" class="mt-2 btn btn-primary"
                                        href="../assets/img/functions/files/{{ end($fileArr) }}">Download</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('createart', ['id' => $art->function]) }}" method="post" id="formArt"
                        name="formArt">
                        @csrf
                        <input type="hidden" name="art_id" id="art_id" value="{{ $art->id }}">
                        @if ($art->fields != '')
                            <div class="mb-3">
                                @php
                                    $fieldsSelect = explode('|', $art->fields);
                                @endphp
                                <label for="type" class="form-label">Tipo</label>
                                <select class="form-control" name="type" id="type">
                                    @foreach ($fieldsSelect as $fSelect)
                                        <option value="{{ $fSelect }}">{{ ucfirst($fSelect) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @foreach ($art->allfields as $artField)
                            <div class="mb-3">
                                <label for="{{ $artField->field }}"
                                    class="form-label @if ($artField->class == 'primeirobloco d-none') {{ $artField->class }} @endif">{{ $artField->name }}</label>
                                @switch($artField->type)
                                    @case('text')
                                        <input class="form-control {{ $artField->class }}" name="{{ $artField->field }}"
                                            id="{{ $artField->field }}" {!! $artField->other !!} {{ $artField->function }}
                                            type="{{ $artField->type }}">
                                    @break

                                    @case('date')
                                        <input class="form-control {{ $artField->class }}" name="{{ $artField->field }}"
                                            id="{{ $artField->field }}" {!! $artField->other !!} {{ $artField->function }}
                                            type="text" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @break

                                    @case('select')
                                        <select class="form-control {{ $artField->class }}" name="{{ $artField->field }}"
                                            id="{{ $artField->field }}" {!! $artField->other !!} {{ $artField->function }}>
                                            @php $fieldsSelect = explode(',', ($artField->values)); @endphp
                                            @foreach ($fieldsSelect as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    @break

                                    @case('textarea')
                                        <textarea class="form-control {{ $artField->class }}" name="{{ $artField->field }}" id="{{ $artField->field }}"
                                            {!! $artField->other !!} {{ $artField->function }} type="{{ $artField->type }}"></textarea>
                                    @break
                                @endswitch
                            </div>
                        @endforeach
                        <div
                            class="mb-3 @if (count($art->allfields) > 0 && $art->function == 'qrcode') primeirobloco d-none @endif  @if (count($art->allfields) > 0 && $art->function == 'qrcodebf') primeirobloco d-none @endif @if (count($art->allfields) > 0 && $art->function == 'promo') primeirobloco d-none @endif">
                            <button type="submit" class="btn bg-gradient-warning btn-lg">Download</button>
                        </div>
                    </form>
                    <hr class="horizontal dark" />
                    <div class="row">
                        <div class="col-3">
                            <p class="text-secondary text-sm font-weight-bold mb-0">Acessos Hoje: {{ count($art->read) }}
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="text-secondary text-sm font-weight-bold mb-0">Downloads Hoje:
                                {{ count($art->download) }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-secondary text-sm font-weight-bold mb-0">Criado em:
                                {{ \Carbon\Carbon::parse($art->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-2 text-end">
                            <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                data-original-title="{{ $art->user['title'] }}">
                                <img alt="Image placeholder" src="../../../assets/img/users/{{ $art->user['photo'] }}"
                                    class="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 mb-4">
            <div class="row">
                <div class="col-md-8 me-auto text-left">
                    <h5>Outras Artes</h5>
                </div>
            </div>
            @foreach ($othersArts as $otherArt)
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex mb-2">
                            <a href="{{ route('arte', ['id' => $otherArt->id]) }}">
                                <div class="avatar avatar-xl bg-gradient-warning border-radius-md p-2">
                                    <i class="{{ $otherArt->image_group }} text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="ms-3 my-auto">
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                    href="{{ route('arte', ['id' => $otherArt->id]) }}">
                                    <h6>{{ $otherArt->title }}</h6>
                                </a>
                                <p class="text-sm mt-2">{{ $otherArt->summary }}</p>
                            </div>
                        </div>
                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                            href="{{ route('informativo', ['id' => $otherArt->id]) }}">
                            Acessar
                            <i class="fas fa-hand-point-left text-sm ms-1" aria-hidden="true"></i>
                        </a>
                        <hr class="horizontal dark" />
                        <div class="row">
                            <div class="col-4">
                                <p class="text-secondary text-sm font-weight-bold mb-0">Leituras:
                                    {{ count($otherArt->download) }}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-secondary text-sm font-weight-bold mb-0">Criado em:
                                    {{ \Carbon\Carbon::parse($otherArt->created_at)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-2 text-end">
                                <a class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                    data-original-title="{{ $otherArt->user['title'] }}">
                                    <img alt="Image placeholder"
                                        src="../../../assets/img/users/{{ $otherArt->user['photo'] }}" class="" />
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

@if ($art->function == 'qrcode' || $art->function == 'qrcodebf')
    <script>
        $(document).ready(function() {
            $('#product_id1').focus();
            $("#product_id1").bind("keypress", function(e) {
                var cdproduto = $('#product_id1').val();
                if (cdproduto.length > 2) {
                    if (e.keyCode === 13) {
                        var data = $('#formArt').serialize();
                        $.ajax({
                            type: "GET",
                            url: "https://maxxieconomica.com/api/busca-impresso-novo",
                            data: {
                                data,
                                cdproduto: cdproduto
                            },
                            success: function(response) {
                                if (response.message == 'success') {
                                    $('.primeirobloco.d-none').each(function(index, element) {
                                        $(this).removeClass('d-none');
                                        $(this).addClass('d-block');
                                    });
                                    if (response.datapromo != '0') {
                                        $('#textovalidade1').val('PROMOÇÃO VÁLIDA ATÉ ' +
                                            response.datapromo +
                                            ' OU ENQUANTO DURAREM OS ESTOQUES.');
                                    } else {
                                        $('#textovalidade1').val(
                                            "PROMOÇÃO VÁLIDA SOMENTE DE <?php echo date('d/m/Y'); ?> ATÉ <?php echo date('d/m/Y', strtotime('+1 month')); ?> OU ENQUANTO DURAREM OS ESTOQUES."
                                            );
                                    }
                                    $('#nomeproduto1').val(response.nomeproduto);
                                    if (response.quantidade > 0) {
                                        $('#quantidade1').val(response.quantidade);
                                    } else {
                                        $('#quantidade1').val('');
                                    }
                                    $('#precoprincipal1').val(response.precoprincipal);
                                    $('#precounitario1').val(response.precounitario);
                                    $('#qrcode1').val(response.qrcode);
                                    return false;
                                } else {
                                    $('.primeirobloco.d-block').each(function(index, element) {
                                        $(this).removeClass('d-block');
                                        $(this).addClass('d-none');
                                    });
                                    document.getElementById("formArt").reset();
                                    return false;
                                }
                            }
                        });
                        return false;
                    } else {
                        console.log('error');
                    }
                }
            });
        });
    </script>
@endif

@if ($art->function == 'promo')
    <script>
        $(document).ready(function() {
            $('#product_id1').focus();
            $("#product_id1").bind("keypress", function(e) {
                var cdproduto = $('#product_id1').val();
                if (cdproduto.length > 2) {
                    if (e.keyCode === 13) {
                        var data = $('#formArt').serialize();
                        $.ajax({
                            type: "GET",
                            url: "https://maxxieconomica.com/api/busca-impresso-novo",
                            data: {
                                data,
                                cdproduto: cdproduto
                            },
                            success: function(response) {
                                if (response.message == 'success') {
                                    $('.primeirobloco.d-none').each(function(index, element) {
                                        $(this).removeClass('d-none');
                                        $(this).addClass('d-block');
                                    });
                                    if (response.datapromo != '0') {
                                        $('#textovalidade1').val('PROMOÇÃO VÁLIDA ATÉ ' +
                                            response.datapromo +
                                            ' OU ENQUANTO DURAREM OS ESTOQUES.');
                                    } else {
                                        $('#textovalidade1').val(
                                            "PROMOÇÃO VÁLIDA SOMENTE DE <?php echo date('d/m/Y'); ?> ATÉ <?php echo date('d/m/Y', strtotime('+1 month')); ?> OU ENQUANTO DURAREM OS ESTOQUES."
                                            );
                                    }
                                    $('#nomeproduto1').val(response.nomeproduto);
                                    $('#quantidade1').val(response.quantidade);
                                    $('#precoprincipal1').val(response.precoprincipal);
                                    $('#precounitario1').val(response.precounitario);
                                    $('#qrcode1').val(response.cdproduto);
                                    return false;
                                } else {
                                    $('.primeirobloco.d-block').each(function(index, element) {
                                        $(this).removeClass('d-block');
                                        $(this).addClass('d-none');
                                    });
                                    document.getElementById("formArt").reset();
                                    return false;
                                }
                            }
                        });
                        return false;
                    } else {
                        console.log('error');
                    }
                }
            });
        });
    </script>
@endif
