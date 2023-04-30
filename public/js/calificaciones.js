$(document).ready(function () {
    

    /** INIT VAR */


    $('#form_calificacion').submit(function (e) {
        e.preventDefault();

        let divInfo = $(".info-put ");
        let form = $(this);
        /** FORMDATA */

        const formData = form.serializeArray();
        let path = "calificacion/create";

        $.ajax({
            type: "POST",
            url: path,
            data: formData,
            beforeSend: function(){
              alert("jenny");
            },
            success: function (data) {
              alert("jennymesa");
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
                },2000);
            }
        });
    });

    /** clean form */
    function clean_form(form){
        form.find('input').val('');
    }
});