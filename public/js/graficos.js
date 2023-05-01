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
              console.log(value.NombreMateria);
              console.log(promedioMateriaInt);
              promedioMateria.push(contenidoMaterias);
    
            });
            graficoTorta(promedioMateria);
            
            $.each(allDataEstudiantes, function (name, value) {
              let promedioEstudianteInt = parseFloat(value.promedio_calificacion);
              let contenidoEstudiantes = {
                name: value.nombreestudiante,
                y: promedioEstudianteInt
              }
              console.log(value.nombreestudiante);
              console.log(promedioEstudianteInt);
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
      alert('cambioo');
      evenAjaxGrafics();
    });
    
  /*data: [
    {
      name: 'Chrome',
      y: 61.04,
      drilldown: 'Chrome'
    },*/
  /** obtain data ini ajax */




  // Create the chart


  
  

  /* let form = $("#form_grafico");
   form.submit(function (e) {
     e.preventDefault();
 
     
    let formSubmit = $(this),
    urlAction = formSubmit.attr('type_form'),
    idUpdate = formSubmit.attr('idUpdate');
     let formData = formSubmit.serializeArray(),
     path = "graficos/info";
 
 
 
 
     $.ajax({
         type: "POST",
         url: path,
         data: formData,
         beforeSend: function(){
           alert('jaja');
         },
         success: function (data) {
           alert('jaj2a');
             let datas = data,
             response = datas.response,
             info = datas.info;
             if(data.response == 'success'){
                 
                 $('.comments').load(window.location + ' .comments >  *');
                 divInfo.show();
                 divInfo.attr('class','alert alert-success');
                 divInfo.text(info); 
             }
             clean_form(form);
             setTimeout(function(e){
                 divInfo.hide();
                 $(".id_update").val('');
             },2000);
         }
     });
 });*/

});