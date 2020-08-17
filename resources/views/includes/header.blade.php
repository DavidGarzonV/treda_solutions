<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('/')}}">Treda solutions | David Garz&oacute;n</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{request()->is("store") ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/store')}}">Carga de informaci&oacute;n</a>
                </li>
                <li class="nav-item {{request()->is("test") ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('/test')}}">Prueba t&eacute;cnica</a>
                </li>
            </ul>
            @if (Auth::check())      
            <div class="my-2 my-lg-0">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{url('auth/logout')}}">Cerrar sesi&oacute;n</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </nav>
</header>