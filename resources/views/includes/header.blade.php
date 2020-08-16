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
        </div>
    </nav>
</header>