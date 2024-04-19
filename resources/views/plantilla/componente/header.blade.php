<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom align-items-center">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img width="100px" height="100px" src="{{asset('assets/img/header.png')}}" alt="">
        <span class="fs-4 fw-bold">Módulo de Graficado del Delito</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="{{route('Inicio')}}" class="nav-link {{request()->routeIs('Inicio') ? 'active' : ''}}"" aria-current="page"><i class="bi bi-house-door-fill"></i> Inicio</a></li>
        <li class="nav-item"><a href="{{route('Crimen')}}" class="nav-link {{request()->routeIs('Crimen') ? 'active' : ''}}""><i class="bi bi-pie-chart-fill"></i> Módulo Graficador</a></li>
      </ul>
    </header>
  </div>