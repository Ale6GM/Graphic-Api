@extends('plantilla.Plantilla')

@section('titulo', 'Crimen')

@section('contenido')
  {{-- seccion de contenido principal donde se mostrara una pequeña ayuda de como graficar --}}
  <section>
    <div class="container">
        <div class="row">
            <div>
                <div class="card bg-white">
                    <div class="card-header text-bg-primary text-center">
                        <h4>Sección de Generación De Gráficos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">                        
                            <div>
                                <div class="card">                                
                                    <div class="card-body">
                                        <canvas id="grafico"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div>
                                <div class="card">
                                    <div class="card-header text-bg-primary text-center">
                                        <h5>Parametros del Gráfico</h5>
                                    </div>
                                    <div class="card-body bg-white">
                                        <h6 class="fw-bold">Personalizacion del Grafico</h6>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input border-primary" role="switch" type="checkbox" name="" id="leyenda" checked>
                                            <label class="fw-bold" for="">Leyenda</label>
                                        </div>
                                        <h6 class="fw-bold mb-3">Posición de la Leyenda</h6>
                                        <div class="form-check">
                                            <div class="row">
                                                <div class="form-check col">
                                                    <input class="form-check-input border-primary casillas" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="top" checked>
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault1">
                                                      Arriba
                                                    </label>
                                                  </div>
                                                  <div class="form-check col">
                                                    <input class="form-check-input border-primary casillas" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="bottom">
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault2">
                                                      Abajo
                                                    </label>
                                                  </div>
                                                  <div class="form-check col">
                                                    <input class="form-check-input border-primary casillas" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="right">
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault1">
                                                      Derecha
                                                    </label>
                                                  </div>
                                                  <div class="form-check col">
                                                    <input class="form-check-input border-primary casillas" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="left">
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault2">
                                                      Izquierda
                                                    </label>
                                                  </div>
                                            </div>
    
                                        </div>
                                        <h6 class="fw-bold mt-3">Tipo de Gráfico</h6>
                                        <select class="form-select" id="selectorGraficos">
                                            <option value="bar">Barra</option>
                                            <option value="doughnut">Dona</option>
                                            <option value="polarArea">Area Polar</option>
                                            <option value="radar">Radar</option>
                                            <option value="line">Linea</option>
                                            <option value="pie">Pastel</option>
                                        </select>
    
                                        <h6 class="mt-3 fw-bold">Datos del Gráfico</h6>
                                        <select class="form-select mb-3" id="selectorDatos">
                                            <option value="crimenZ">Crimenes por Zona</option>
                                            <option value="crimenA">Crimenes por Año</option>
                                            <option value="crimenMO">Crimenes por Modus Operandi</option>
                                            <option value="victimaE">Víctimas por Edades</option>
                                            <option value="victimaG">Víctimas por Género</option>
                                            <option value="victimaL">Víctimas con Lesiones</option>
                                            <option value="delincuenteE">Delincuentes por Edades</option>
                                            <option value="delincuenteG">Delincuentes por Género</option>
                                            <option value="delincuenteA">Delincuentes con Antecedentes</option>
                                            <option value="crimenDG">Por crimen cantidad de delincuentes por género </option>
                                            <option value="crimenCDA">Por crimen cantidad de delincuentes antecedentes</option>
                                            <option value="crimenCRV">Por crimen cantidad de delincuentes con relación víctima</option>
                                            <option value="victimaC">Cantidad Victimas por Crimen</option>
                                        </select>
    
                                        <div class="row text-center">
                                            <div class="col">
                                                <button class="btn btn-primary btn-sm mb-2" id="btngenerador">Generar Gráfico</button>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-danger btn-sm mb-2" id="btnEliminar">Eliminar Gráfico</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
    
                                            </div>
                                            <div class="col form-check">
                                                <input class="form-check-input border-primary" type="radio" name="flexRadioDefault" id="radioPDF" value="pdf">
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault2">
                                                      PDF
                                                    </label>
                                            </div>
                                            
                                            <div class="col form-check">
                                                <input class="form-check-input border-primary" type="radio" name="flexRadioDefault" id="radioPNG" value="png">
                                                    <label class="form-check-label fw-bold" for="flexRadioDefault2">
                                                      PNG
                                                    </label>
                                            </div>
                                            <div class="col"></div>
                                            <button id="btnGuardar" class="btn btn-primary btn-sm mt-3">Guardar Gráfico</button>
                                        </div>
    
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </section>
    
@endsection
