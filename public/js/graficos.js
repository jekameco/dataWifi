$(document).ready(function () {
  const path = "graficos/info",
    form = $('#form_grafico');

  let date_start = $('#graficos_date_start'),
    date_end = $('#graficos_date_end'),
    dateForGrafics = $('.dateForGrafics');


  
    function graficoTorta(arrayData) {

      Highcharts.chart('container2', {
        chart: {
          type: 'pie'
        },
        title: {
          text: 'Promedio de las materia',
          align: 'center'
        },
  
        accessibility: {
          announceNewData: {
            enabled: true
          },
          point: {
            valueSuffix: '%'
          }
        },
  
        plotOptions: {
          series: {
            borderRadius: 5,
            dataLabels: {
              enabled: true,
              format: '{point.name}: {point.y:.1f}'
            }
          }
        },
  
        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
  
        series: [
          {
            name: 'Browsers',
            colorByPoint: true,
            data:
              arrayData
  
          }
        ]
      });
    }
  
    function graficoBarras(arrayEstudiante) {
      Highcharts.chart('container1', {
        chart: {
          type: 'column'
        },
        title: {
          align: 'center',
          text: 'Promedio de estudiante por notas cada materia'
        },
        accessibility: {
          announceNewData: {
            enabled: true
          }
        },
        xAxis: {
          type: 'category'
        },
        yAxis: {
          title: {
            text: 'Notas promedio estudiante'
          }
      
        },
        legend: {
          enabled: false
        },
        plotOptions: {
          series: {
            borderWidth: 0,
            dataLabels: {
              enabled: true,
              format: '{point.y:.1f}'
            }
          }
        },
      
        tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
      
        series: [
          {
            name: 'Browsers',
            colorByPoint: true,
            data: arrayEstudiante
          }
        ],
        
      }
        );
    }

    function evenAjaxGrafics() {
      if (date_start.val() != '' && date_end.val() != '') {

        var formData = form.serialize();
        $.ajax({
          type: "POST",
          url: path,
          data: formData,
          beforeSend: function () {
          },
          success: function (data) {
            
            let promedioMateria = [],
            promedioEstudiante = [],
            allData = data.data,
            allDataEstudiantes = data.dataEstudiante;
    
            $.each(allData, function (name, value) {
              let promedioMateriaInt = parseFloat(value.promedioMateria);
              let contenidoMaterias = {
                name: value.NombreMateria,
                y: promedioMateriaInt
              }
              
              promedioMateria.push(contenidoMaterias);
    
            });
            graficoTorta(promedioMateria);
            
            $.each(allDataEstudiantes, function (name, value) {
              let promedioEstudianteInt = parseFloat(value.promedio_calificacion);
              let contenidoEstudiantes = {
                name: value.nombreestudiante,
                y: promedioEstudianteInt
              }

              promedioEstudiante.push(contenidoEstudiantes);
            });
            graficoBarras(promedioEstudiante); 
          }
        });
      }
    }
    evenAjaxGrafics();
    
    
    
    $(document).off('change','.dateForGrafics');
    $(document).on('change','.dateForGrafics',function(){
      evenAjaxGrafics();
    });
    

});