// Declaracion de las variables globales
let crimenes = {};
let crimenYears = {};
let grafico = null;
let leyenda = document.getElementById('leyenda');
let botonGenerador = document.getElementById('btngenerador');
let tipoGrafico = document.getElementById('selectorGraficos');
let selectorDatos = document.getElementById('selectorDatos');
let botonEliminar = document.getElementById('btnEliminar');
let botonGuardar = document.getElementById('btnGuardar');
let radioPDF = document.getElementById('radioPDF');
let radioPNG = document.getElementById('radioPNG');

// Peticiones asincronas a la API
fetch('http://127.0.0.1:8000/api/crimenes')
.then(response => response.json())
.then(data => {crimenes = data;});

fetch('http://127.0.0.1:8000/api/years')
.then(response => response.json())
.then(data => {crimenYears = data;});

fetch('http://127.0.0.1:8000/api/modus')
.then(response => response.json())
.then(data => {modusOP = data;});

fetch('http://127.0.0.1:8000/api/victimas')
.then(response => response.json())
.then(data => {victimas = data;});

fetch('http://127.0.0.1:8000/api/delincuentes')
.then(response => response.json())
.then(data => {delincuentes = data;});

fetch('http://127.0.0.1:8000/api/crimendelin')
.then(response => response.json())
.then(data => {crimenDelincuentes = data;});

/* Seccion de las funciones asociadas a los Crimenes */
//Funcion que genera un grafico para la cantidad de crimenes por zona.
function crimenesPorZona(crimenes, id) {
		const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}	
		// Paso 1: Obtener zonas únicas como labels
	const labels = [...new Set(crimenes.map(crimen => crimen.zona))];

		// Paso 2: Obtener tipos de crimen únicos como datasets
		const delitosUnicos = [...new Set(crimenes.map(crimen => crimen.tipo_crimen))];
		const datasets = delitosUnicos.map(delito => {
			return {
				label: delito,
				data: labels.map(zona => {
					const crimenEnZona = crimenes.find(crimen => crimen.zona === zona && crimen.tipo_crimen === delito);
					return crimenEnZona ? crimenEnZona.total : 0;
				}),
			};
		});

	// Crear el gráfico usando Chart.js
		const ctx = document.getElementById('grafico').getContext('2d');
		grafico = new Chart(ctx, {
			type: tipoGrafico.value,
			data: {
				labels: labels,
				datasets: datasets
			},
			options: {
				plugins: {
					legend: {
						display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
						position: posicion,
					}
				},
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	
}
// Esta funcion genera el grafico de la cantidad de crimenes por año
function crimenesPorAno(crimenYears, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}
		
		const uniqueYears = [... new Set(crimenYears.map(year => year.año))];		

		const añosUnicos = [...new Set(crimenYears.map(crimen => crimen.año))];

		// Obtener tipos de crimen únicos
		const tiposUnicos = [...new Set(crimenYears.map(crimen => crimen.tipo_crimen))];

		// Preparar datos para el gráfico
		const datasets = tiposUnicos.map(tipo => {
			return {
				label: tipo,
				data: añosUnicos.map(año => {
					const crimen = crimenYears.find(crimen => crimen.año === año && crimen.tipo_crimen === tipo);
					return crimen ? crimen.cantidad : 0;
				}),
			};
		});

		const data = {
			labels: uniqueYears,
			datasets: datasets,
		};
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};
		grafico = new Chart(id, {type: tipoGrafico.value, data, options});

}
// Esta funcion genera el grafico de la cantidad de crimenes por Modus Operandi
function crimenesPorModus(modusOP, id) {
	
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

	const modusUnicos = [... new Set(modusOP.map(modus => modus.modus_operandi))];
	
		// Obtener los tipos de crimen únicos
		const tiposDelitosUnicos = [...new Set(modusOP.map(item => item.tipo_crimen))];

		// Objeto para almacenar los datos agrupados por tipo de crimen
		const datosAgrupados = {};

		// Agrupar los datos por tipo de crimen
		modusOP.forEach(item => {
			if (!datosAgrupados[item.tipo_crimen]) {
				datosAgrupados[item.tipo_crimen] = {};
			}
			if (!datosAgrupados[item.tipo_crimen][item.modus_operandi]) {
				datosAgrupados[item.tipo_crimen][item.modus_operandi] = 0;
			}
			datosAgrupados[item.tipo_crimen][item.modus_operandi] += item.cantidad;
		});

		// Crear el conjunto de datos para el gráfico
		const datasets = tiposDelitosUnicos.map(tipo => {
			const data = modusUnicos.map(modus => datosAgrupados[tipo][modus] || 0);
			return {
				label: tipo,
				data: data
			};
		});

			const data = {
				labels: modusUnicos,
				datasets: datasets,
			};
			options= {
				plugins: {
					legend: {
						display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
						position: posicion,
					}
				},
			};
			grafico = new Chart(id, {type: tipoGrafico.value, data, options});

}

// Seccion para las funciones de generacion de graficos para las victimas
// cantidad de victimas por edades
function victimasPorEdad(victimas, id) {

    const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}	
    // Obtener un array de todas las edades sin repetir
    const edadesUnicas = [...new Set(victimas.map(item => item.edad))];

    // Contar la cantidad de ocurrencias de cada edad
    const conteoEdades = edadesUnicas.map(edad => {
    return victimas.filter(item => item.edad === edad).length;
    });

    const data = {
        labels: edadesUnicas,
        datasets: [{
            label: 'Cantidad de Victimas por Edad',
            data: conteoEdades,
        }]
    };
	options= {
		plugins: {
			legend: {
				display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
				position: posicion,
			}
		},
	};
    grafico = new Chart(id, {type: tipoGrafico.value, data, options})
}

// funcion para la cantidad de victimas por genero
function victimasPorGenero(victimas, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}
		
		// obtenemos los generos sin repetir
		const generos = [... new Set(victimas.map(eachDatos => eachDatos.genero))];

		const conteoGeneros = generos.map(genero => {
			return victimas.filter(item => item.genero === genero).length;
		});

		const data = {
			labels: generos,
			datasets: [{
				label: 'Cantidad de Victimas por Genero',
				data:conteoGeneros,
			}]
		};

		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};

		grafico = new Chart(id, {type:tipoGrafico.value, data, options})
}

// Seccion para las funciones asociadas a los delincuentes
//funcion para graficar la cantidad de delincuentes por edades
function delincuentesPorEdades(delincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

		// obtenemos las edades sin repetir
		const edadesUnicas = [... new Set(delincuentes.map(edades => edades.edad))];

		// generar para cada edad la cantidad de registros
		const conteoEdades = edadesUnicas.map(edad => {
			return delincuentes.filter(item => item.edad === edad).length
		})

		const data = {
			labels: edadesUnicas,
			datasets: [{
				label: 'Cantidad de delincuentes por Edades',
				data: conteoEdades,
			}]
		};
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};

		grafico = new Chart(id, {type:tipoGrafico.value, data, options})

}

//Funcion para generar la cantidad de delincuentes por genero
function delincuentesPorGenero(delincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

		// obtenemos los generos unicos
		const generosUnicos = [... new Set(delincuentes.map(generos => generos.genero))];

		const conteoGeneros = generosUnicos.map(generos => {
			return delincuentes.filter(item => item.genero === generos).length
		})

		const data = {
			labels: generosUnicos,
			datasets: [{
				label: ['Cantidad de Delincuentes por Género'],
				data: conteoGeneros,
			}]
		};
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};

		grafico = new Chart(id, {type: tipoGrafico.value, data, options});

} 

// funcion para generar la cantidad de delincuentes con o sin antecedentes
function delincuentesPorAntecedentes(delincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

		// obtenemos los modos unicos
		const antecedentes = [... new Set(delincuentes.map(eachDatos => eachDatos.antecedentes))];

		// contamos las ocurrencias
		const conteoAntecedentes = antecedentes.map(antecente => {
			return delincuentes.filter(item => item.antecedentes === antecente).length
		})

		const data = {
			labels: antecedentes,
			datasets: [{
				label: 'Cantidad de Delincuentes con Antecedentes',
				data: conteoAntecedentes,
			}]
		};
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};

		grafico = new Chart(id, {type:tipoGrafico.value, data, options});

}

// funcion para generar grafico donde por cada crimen tengamos la cantidad de delincuentes por genero
function delincuentesPorGeneroYCrimen(crimenDelincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

	const crimenesUnicos = [... new Set(crimenDelincuentes.map(crimen => crimen.tipo_crimen))];
	
	const cantidadPorGeneroYCrimen = {};
    
    // Calcular la cantidad de delincuentes por género y tipo de crimen
    crimenesUnicos.forEach(crimen => {
        cantidadPorGeneroYCrimen[crimen] = {
            masculinos: 0,
            femeninos: 0
        };
    });
    
    crimenesUnicos.forEach(crimen => {
        const delincuentes = crimenDelincuentes.filter(d => d.tipo_crimen === crimen);
        delincuentes.forEach(delincuente => {
            cantidadPorGeneroYCrimen[crimen].masculinos += delincuente.masculinos;
            cantidadPorGeneroYCrimen[crimen].femeninos += delincuente.femeninos;
        });
    });
	 const data = {
		labels: crimenesUnicos,
		datasets: [{
			label: 'Masculino',
            data: crimenesUnicos.map(crimen => cantidadPorGeneroYCrimen[crimen].masculinos),
		}, 
		{
			label: 'Femenino',
            data: crimenesUnicos.map(crimen => cantidadPorGeneroYCrimen[crimen].femeninos),

		}]
		},
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};
	grafico = new Chart(id, {type:tipoGrafico.value, data, options});
}

// funcion para generar el grafico, donde por cada crimen tenemos la cantidad de delincuentes con o sin antecedentes
function delicuentesConAntecedentesPorTipoCrimen(crimenDelincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

	const crimenesUnicos = [... new Set(crimenDelincuentes.map(crimen => crimen.tipo_crimen))];

	const cantidadConAntecedentesPorCrimen = {};

    // Calcular la cantidad de delincuentes por género y tipo de crimen
    crimenesUnicos.forEach(crimen => {
        cantidadConAntecedentesPorCrimen[crimen] = {
            con_antecedentes: 0,
            sin_antecedentes: 0
        };
    });

    crimenesUnicos.forEach(crimen => {
        const delincuentes = crimenDelincuentes.filter(d => d.tipo_crimen === crimen);
        delincuentes.forEach(delincuente => {
            cantidadConAntecedentesPorCrimen[crimen].con_antecedentes += delincuente.con_antecedentes;
            cantidadConAntecedentesPorCrimen[crimen].sin_antecedentes += delincuente.sin_antecedentes;
        });
    });
	const data = {
		labels: crimenesUnicos,
		datasets: [{
			label: 'Con Antecedentes',
            data: crimenesUnicos.map(crimen => cantidadConAntecedentesPorCrimen[crimen].con_antecedentes),
		}, 
		{
			label: 'Sin Antecdentes',
            data: crimenesUnicos.map(crimen => cantidadConAntecedentesPorCrimen[crimen].sin_antecedentes),

		}]
		},
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};

	grafico = new Chart(id, {type:tipoGrafico.value, data, options});
	

}

// generamos la funcion para generar el grafico con la cantidad de delincuentes con o sin relacion con las victimas por cada tipo de crimen
function delincuentesConRelacionConVictimaPorTipoDeCrimen(crimenDelincuentes, id) {
	const checkboxes = document.getElementsByClassName('casillas');
		let posicion = null;

		Array.from(checkboxes).forEach(function(item) {
			if (item.checked) {
				posicion = item.value;
			}
		});
		if(grafico) {
			grafico.destroy();
		}

	const crimenesUnicos = [... new Set(crimenDelincuentes.map(crimen => crimen.tipo_crimen))];

	const cantidadConRelacionPorCrimen = {};

    // Calcular la cantidad de delincuentes por género y tipo de crimen
    crimenesUnicos.forEach(crimen => {
        cantidadConRelacionPorCrimen[crimen] = {
            con_relacion: 0,
            sin_relacion: 0
        };
    });

    crimenesUnicos.forEach(crimen => {
        const delincuentes = crimenDelincuentes.filter(d => d.tipo_crimen === crimen);
        delincuentes.forEach(delincuente => {
            cantidadConRelacionPorCrimen[crimen].con_relacion += delincuente.con_relacion;
            cantidadConRelacionPorCrimen[crimen].sin_relacion += delincuente.sin_relacion;
        });
    });

	const data = {
		labels: crimenesUnicos,
		datasets: [{
			label: 'Con Relación',
            data: crimenesUnicos.map(crimen => cantidadConRelacionPorCrimen[crimen].con_relacion),
		}, 
		{
			label: 'Sin Relación',
            data: crimenesUnicos.map(crimen => cantidadConRelacionPorCrimen[crimen].sin_relacion),

		}]
		},
		options= {
			plugins: {
				legend: {
					display: leyenda.checked, // chequea si el check esta ativo para cambiar la propiedad display
					position: posicion,
				}
			},
		};
	grafico = new Chart(id, {type:tipoGrafico.value, data, options});
	

}


// Este Boton ejecuta las funciones generadoras del grafico en dependencia del valor del selector de graficos 
botonGenerador.onclick = function() {
	if(selectorDatos.value == 'crimenZ') {
		crimenesPorZona(crimenes, 'grafico');
	} else if(selectorDatos.value == 'crimenA') {
		crimenesPorAno(crimenYears, 'grafico');
	} else if(selectorDatos.value == 'crimenMO') {
		crimenesPorModus(modusOP, 'grafico');
	} else if(selectorDatos.value == 'victimaE') {
		victimasPorEdad(victimas, 'grafico')
	} else if(selectorDatos.value == 'victimaG') {
		victimasPorGenero(victimas, 'grafico')
	} else if(selectorDatos.value == 'delincuenteE') {
		delincuentesPorEdades(delincuentes, 'grafico')
	} else if(selectorDatos.value == 'delincuenteG') {
		delincuentesPorGenero(delincuentes, 'grafico')
	} else if(selectorDatos.value == 'delincuenteA') {
		delincuentesPorAntecedentes(delincuentes, 'grafico')
	} else if(selectorDatos.value == 'crimenDG') {
		delincuentesPorGeneroYCrimen(crimenDelincuentes, 'grafico')
	} else if(selectorDatos.value == 'crimenCDA') {
		delicuentesConAntecedentesPorTipoCrimen(crimenDelincuentes, 'grafico')
	} else if(selectorDatos.value == 'crimenCRV') {
		delincuentesConRelacionConVictimaPorTipoDeCrimen(crimenDelincuentes, 'grafico')
	}
}



//Funcion para Eliminar un grafico creado
document.getElementById('btnEliminar').addEventListener('click', function() {
	if (grafico == null) {
		Swal.fire({
			title: "Error",
			text: "Aun No se ha generado un grafico",
			icon: 'error'
		})
	} else {
		Swal.fire({
  title: "Esta Seguro que desea eliminar el Grafico?",
  text: "Esta Accion no es Reversible!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, Eliminalo!"
}).then((result) => {
  if (result.isConfirmed) {
  	if (grafico) {
		grafico.destroy();
	}
    Swal.fire({
      title: "Eliminado!",
      text: "Su Grafico ha Sido Eliminado correctamente",
      icon: "success"
    });
  }
});
	}
	
})

//Opciones para pasar al grafico en el formato pdf

let opt = {
	margin:       0.7,
	filename:     'Grafico.pdf',
	image:        { type: 'jpg', quality: 1 },
	html2canvas:  { scale: 2 },
	jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
  };

// para guardar el grafico en los dos formatos
botonGuardar.onclick = function() {
	if(!radioPDF.checked && !radioPNG.checked){
		Swal.fire({
			title: "Error",
			text: "Debes Seleccionar una de las dos Opciones de Guardado",
			icon: "error"
		})
	}
	if(radioPDF.checked) {
		const canvas = document.getElementById('grafico');
		
		if (grafico == null) {
			Swal.fire({
				title: "Error",
				text: "Aun no se ha Generado un Grafico",
				icon: "error"
			})
		} else {
			html2pdf().set(opt).from(canvas).save();
		}
	} if(radioPNG.checked) {
		let canvas = document.getElementById('grafico');

		if (grafico == null) {
		Swal.fire({
			title: "Error",
			text: "Aun no hay un Grafico Generado",
			icon: "error"
		})
		} else {
		let url = canvas.toDataURL('image/png');
		let a = document.createElement('a');
		a.href = url;
		a.download = 'grafico.png';
		document.body.appendChild(a);
		a.click();
		document.body.removeChild(a);
		}
	}
}






