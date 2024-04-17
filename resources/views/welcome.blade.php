@extends('plantilla.Plantilla')

@section('titulo', 'Modulo Graficador del Delito')

@section('contenido')
  {{-- seccion de contenido principal donde se mostrara una pequeña ayuda de como graficar --}}
  <section>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <img class="img-fluid" src="{{asset('assets/img/panel1.png')}}" alt="">
                        </div>
                        <div class="col">
                            <h1 class="display-5">¿Que Encontrarás en este Módulo?...</h1>
                            <p>Este es el módulo de análisis de los datos del Observatorio, aquí los datos son representados mediante gráficos lo cual permite un análisis más preciso de los mismos permitiendo realizar comparativas y consultas de datos combinadas, pueden ser utilizados gran variedad de gráficos interactivos que le ayudaran a realizar un análisis claro y preciso de la información recogida en el observatorio...</p>
                            <a href="{{route('Crimen')}}" class="btn btn-primary">Comenzamos ...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </section>
    
@endsection
