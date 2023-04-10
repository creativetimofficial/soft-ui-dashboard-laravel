@php
    $user = Auth::user();
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 text-wrap" href="{{ route('dashboard') }}">
            <img src="../assets/img/logo.png" class="img-fluid h-100 p-3" alt="...">
        </a>
    </div>
    <hr class="horizontal dark mt-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-secondary text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-tachometer"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Design</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('artes') ? 'active' : '' }} " href="{{ url('artes') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-paint-brush"></i>
                    </div>
                    <span class="nav-link-text ms-1">Artes</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('requisicao-de-arte') ? 'active' : '' }} "
                    href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-paint-brush"></i>
                    </div>
                    <span class="nav-link-text ms-1">Requisição de Arte</span>
                </a>
            </li> --}}
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Ecommerce</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('cancelamentos') ? 'active' : '' }}"
                    href="{{ url('cancelamentos') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-success text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cancelamentos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('estornos') ? 'active' : '' }}" href="{{ url('estornos') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-success text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <span class="nav-link-text ms-1">Estornos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('pedidos') ? 'active' : '' }}" href="{{ url('pedidos') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-success text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-list"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pedidos</span>
                </a>
            </li>
            {{-- <li class="nav-item">
        <a class="nav-link {{ (Request::is('sugestoes') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-success text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-paperclip"></i>
          </div>
          <span class="nav-link-text ms-1">Sugestões</span>
        </a>
      </li> --}}
            @if ($user->role_id == 2)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('financeiro') ? 'active' : '' }}"
                        href="{{ url('financeiro') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-success text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-list"></i>
                        </div>
                        <span class="nav-link-text ms-1">Financeiro</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CAMPANHAS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('campanha/plano-de-sucesso') ? 'active' : '' }}"
                    href="{{ url('campanha/plano-de-sucesso') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <span class="nav-link-text ms-1">Plano de Sucesso</span>
                </a>
            </li>
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">FAQ / Wiki</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('informativos') ? 'active' : '' }} "
                    href="{{ url('informativos') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-tasks"></i>
                    </div>
                    <span class="nav-link-text ms-1">Informativos</span>
                </a>
            </li>
            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Cadastro</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('usuario') ? 'active' : '' }} " href="{{ url('usuario') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuário</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
