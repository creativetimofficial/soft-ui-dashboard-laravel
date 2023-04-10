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
                            <h6>Arquivos</h6>
                            <p class="text-sm mt-2">Arquivos de campanha para downloads</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body p-3 text-center">
                    <div class="d-flex mb-2">
                        <iframe
                            src="https://onedrive.live.com/embed?cid=3E92DA60851B57D4&resid=3E92DA60851B57D4%2111209&authkey=APohId8U_lc43Z0"
                            frameborder="0" scrolling="no"></iframe>
                    </div>
                    <div class="row">
                        <iframe
                            src="https://onedrive.live.com/embed?cid=3E92DA60851B57D4&resid=3E92DA60851B57D4%2111210&authkey=AA6SQdmIlLiY1Hs"
                            frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard')
@endpush

@push('script')
@endpush

<style>
    iframe .namePlate .titleArea {
        display: none;
    }
</style>
