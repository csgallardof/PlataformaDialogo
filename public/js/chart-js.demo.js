//*************
// INFO GENERAL
//*************

// white
var white = 'rgba(255,255,255,1.0)';
var fillBlack = 'rgba(45, 53, 60, 0.6)';
var fillBlackLight = 'rgba(45, 53, 60, 0.2)';
var strokeBlack = 'rgba(45, 53, 60, 0.8)';
var highlightFillBlack = 'rgba(45, 53, 60, 0.8)';
var highlightStrokeBlack = 'rgba(45, 53, 60, 1)';

// blue
var fillBlue = 'rgba(52, 143, 226, 0.6)';
var fillBlueLight = 'rgba(52, 143, 226, 0.2)';
var strokeBlue = 'rgba(52, 143, 226, 0.8)';
var highlightFillBlue = 'rgba(52, 143, 226, 0.8)';
var highlightStrokeBlue = 'rgba(52, 143, 226, 1)';

// grey
var fillGrey = 'rgba(182, 194, 201, 0.6)';
var fillGreyLight = 'rgba(182, 194, 201, 0.2)';
var strokeGrey = 'rgba(182, 194, 201, 0.8)';
var highlightFillGrey = 'rgba(182, 194, 201, 0.8)';
var highlightStrokeGrey = 'rgba(182, 194, 201, 1)';

// green
var fillGreen = 'rgba(0, 172, 172, 0.6)';
var fillGreenLight = 'rgba(0, 172, 172, 0.2)';
var strokeGreen = 'rgba(0, 172, 172, 0.8)';
var highlightFillGreen = 'rgba(0, 172, 172, 0.8)';
var highlightStrokeGreen = 'rgba(0, 172, 172, 1)';

// purple
var fillPurple = 'rgba(114, 124, 182, 0.6)';
var fillPurpleLight = 'rgba(114, 124, 182, 0.2)';
var strokePurple = 'rgba(114, 124, 182, 0.8)';
var highlightFillPurple = 'rgba(114, 124, 182, 0.8)';
var highlightStrokePurple = 'rgba(114, 124, 182, 1)';

//*******************
//GLOBAL FUNCTIONS
//*****************

var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //Enero is 0!
var hora = hoy.getHours();
var minuto = hoy.getMinutes();

var yyyy = hoy.getFullYear();
if(dd<10){
    dd='0'+dd;
}
if(mm<10){
    mm='0'+mm;
}
var diahoy = dd+'/'+mm+'/'+yyyy+' '+hora+':'+minuto;

var chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

var COLORS = [
	'#4dc9f6',
	'#f67019',
	'#f53794',
	'#537bc4',
	'#acc236',
	'#166a8f',
	'#00a950',
	'#58595b',
	'#8549ba'
];

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// ****************
//vars graficas
// ****************

var doughnutData;
var barChartData;
var pieData;
var radarChartData;
var radarChartData2;

//*******************
///INICIO
//*******************

$(document).ready(function() {

  //************
  //SIPOC CCPT
  //************
	$.ajax({
		url : "js/data-ccpt-sipoc.php",
		type : "GET",
		success : function(data){

			//console.log(data);

			// var datainfo = {
			// 	ccpt : [],
			// 	mesasdedialogo : []
			// };
      //
			// var len = data.length;

      var labels_ccpt = data.map(function(e) {
         return e.nombre_sipoc;
      });
      var data_ccpt = data.map(function(e) {
         return e.total;
      });

      //console.log(datainfo);

      doughnutData = {
  			type: 'doughnut',
  			data: {
  				datasets: [{
  					data: data_ccpt,
  					backgroundColor: [
  						window.chartColors.red,
  						window.chartColors.orange,
  						window.chartColors.yellow,
  						window.chartColors.green,
  						window.chartColors.blue,
  					],
  					label: 'Propuestas por Cadena Productiva al ' + diahoy,
  				}],
  				labels: labels_ccpt
  			},
  			options: {
  				responsive: true,
  				legend: {
  					position: 'top',
  				},
  				animation: {
  					animateScale: true,
  					animateRotate: true
  				}
  			}
  		};

		},
		error : function(data) {
			console.log(data);
		}
	});
  //************
  //FIN SIPOC CCPT
  //************

  //************
  //barchart
  //************
	$.ajax({
		url : "js/data-ccpt-institucionesrank.php",
		type : "GET",
		success : function(data){

			var len = data.length;

      var labels_ccpt = data.map(function(e) {
         return e.responsable_solucion;
      });
      var data_ccpt = data.map(function(e) {
         return e.total;
      });

      barChartData = {
  			labels: labels_ccpt,
  			datasets: [{
  				label: 'Actividades Registradas por Institución al ' + diahoy,
  				backgroundColor: fillGreen,
  				borderColor: fillGrey,
  				borderWidth: 1,
  				data: data_ccpt
  			}]

  		};

      //console.log(barChartData);

		},
		error : function(data) {
			console.log(data);
		}
	});
  //************
  //FIN barchart
  //************

  //************
  //radar2
  //************
	$.ajax({
		url : "js/data-ccpt-porejetematico.php",
		type : "GET",
		success : function(data){

      var labels_ccpt = data.map(function(e) {
         return e.verbo_solucion;
      });

      var data_ccpt = data.map(function(e) {
         return e.total;
      });

      radarChartData2 = {
  			type: 'radar',
  			data: {
  				labels: labels_ccpt,
  				datasets: [{
  					label: 'Propuestas por Eje Tematico al ' + diahoy,
  					backgroundColor: fillBlueLight,
  					borderColor: highlightFillBlue,
  					pointBackgroundColor: fillGreyLight,
  					data: data_ccpt
  				}]
  			},
  			options: {
  				legend: {
  					position: 'top',
  				},
  				scale: {
  					ticks: {
  						beginAtZero: true
  					}
  				}
  			}
  		};

		},
		error : function(data) {
			console.log(data);
		}
	});
  //************
  //FIN radar2
  //************

  //************
  //radar
  //************
	$.ajax({
		url : "js/data-ccpt-porambito.php",
		type : "GET",
		success : function(data){

      var labels_ccpt = data.map(function(e) {
         return e.nombre_ambit;
      });

      var data_ccpt = data.map(function(e) {
         return e.total;
      });

      radarChartData = {
  			type: 'radar',
  			data: {
  				labels: labels_ccpt,
  				datasets: [{
  					label: 'Propuestas por Ambito al ' + diahoy,
  					backgroundColor: fillBlueLight,
  					borderColor: highlightFillBlue,
  					pointBackgroundColor: fillGreyLight,
  					data: data_ccpt
  				}]
  			},
  			options: {
  				legend: {
  					position: 'top',
  				},
  				scale: {
  					ticks: {
  						beginAtZero: true
  					}
  				}
  			}
  		};

		},
		error : function(data) {
			console.log(data);
		}
	});
  //************
  //FIN radar
  //************

  //************
  //pieChart
  //************
	$.ajax({
		url : "js/data-ccpt-estado.php",
		type : "GET",
		success : function(data){

			var datainfo = {
				ccpt : [],
				mesasdedialogo : []
			};

      //console.log(data);

      var labels_ccpt = data.map(function(e) {
         return e.nombre_estado;
      });
      var data_ccpt = data.map(function(e) {
         return e.total;
      });

      console.log(datainfo);

      pieData = {
  			type: 'pie',
  			data: {
  				datasets: [{
  					data: data_ccpt,
  					backgroundColor: [
  						window.chartColors.red,
  						window.chartColors.orange,
  						window.chartColors.yellow,
  						window.chartColors.green,
  						window.chartColors.blue,
  					],
  					label: 'Resumen de Propuestas por Estado ' + diahoy
  				}],
  				labels: labels_ccpt
  			},
  			options: {
  				responsive: true
  			}
  		};

        //console.log(pieData);

		},
		error : function(data) {
			console.log(data);
		}
	});
  //************
  //FIN pieChart
  //************

});
//*******************
///FIN
//*******************

window.onload = function() {

  var ctx1 = document.getElementById('bar-chart').getContext('2d');
  window.myHorizontalBar = new Chart(ctx1, {
    type: 'horizontalBar',
    data: barChartData,
    options: {
      elements: {
        rectangle: {
          borderWidth: 2,
        }
      },
      responsive: true,
      legend: {
        display: true
      },
      plugins: {
        datalabels: {
          color: 'white',
          display: function(context) {
            return context.dataset.data[context.dataIndex] > 0;
          },
          font: {
            weight: 'bold'
          },
          formatter: Math.round
        }
      }
    }
  });

  var ctx2 = document.getElementById('doughnut-chart').getContext('2d');
  window.myDoughnut = new Chart(ctx2, doughnutData);

  var ctx3 = document.getElementById('pie-chart').getContext('2d');
  window.myPie = new Chart(ctx3, pieData);

  window.myRadar1 = new Chart(document.getElementById('radar-chart'), radarChartData);
  window.myRadar2 = new Chart(document.getElementById('radar-chartnew'), radarChartData2);

};
