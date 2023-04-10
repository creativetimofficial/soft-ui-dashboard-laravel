  <footer class="footer py-3">
    <div class="container">
      <div class="row">
      {{-- <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="https://github.com/gbflores" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Sobre
          </a>
          <a href="https://github.com/gbflores" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Projeto
          </a>
          <a href="https://github.com/gbflores" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Maxxi
          </a>
          <a href="https://github.com/gbflores" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              DMSYS
          </a>
          <a href="https://github.com/gbflores" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Contato
          </a>
      </div> --}}
        @if (!auth()->user() || \Request::is('static-sign-up')) 
          <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
              <a href="https://www.instagram.com/maxxieconomica/" target="_blank" class="text-secondary me-xl-4 me-4">
                  <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
              </a>
          </div>
        @endif
      </div>
      @if (!auth()->user() || \Request::is('static-sign-up')) 
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Criado por 
              <a style="color: #252f40;" href="https://www.maxxieconomica.com" class="font-weight-bold ml-1" target="_blank">Maxxi Econômica</a>
              &
              <a style="color: #252f40;" href="" class="font-weight-bold ml-1" target="_blank">Dmsys Tecnologia</a>.
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>