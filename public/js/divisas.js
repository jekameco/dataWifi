//https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/{date}/{endpoint}

$(document).ready(function () {
  const API_URL = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1',
    form = $("#form_divisa");

  let arrayDivisas = [],
    divisa_date = $('#divisa_date_divisa'),
    countryDivisa = {
      'Euro': 'eur',
      'Dolar': 'usd',
      'Yuan': 'cny'
    };

    /** functions */
  function obtenerRegistros(divisa, date) {
    let valueDivisa = [];
    $.ajax({
      url: `${API_URL}/${date}/currencies/${divisa}/cop.json`,
      type: "GET",
      dataType: "json",
      async: false,
      success: function (data) {
        $.each(data, function (name, value) {

          if (name == 'cop') {
            valueDivisa = [value];
          }
        });
      }
    });

    return valueDivisa;
  }

  function rowsDivisa(date) {

    $.each(countryDivisa, function (name, value) {

      let valueDivisaTotal = obtenerRegistros(value, date);
      $("tbody").append(`<tr><th >${name}</th><td>${valueDivisaTotal}</td></tr>`);

    });
  }

  /** start obtain divisa */
  rowsDivisa(divisa_date.val());


/** submit */
  form.submit(function (e) {
    alert('jenn');
    e.preventDefault();
    $('tbody').empty();


    rowsDivisa(divisa_date.val());

  });

});