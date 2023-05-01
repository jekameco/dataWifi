$(document).ready(function () {
    

    /** INIT VAR */
    let divInfo = $(".info-put "),
    form = $("#form_materias");
    
    /** edit */
    $(document).off('click','.update_button');
    $(document).on('click','.update_button',function(){
        let id_update = $(this).attr('id_update')
        urlAction = form.attr('type_form','update'),
    
        path = "materia/getData";

        $(".id_update").val(id_update);

        $.ajax({
            type: "POST",
            url: path,
            data: {id_update:id_update},
            beforeSend: function(){
                
            },
            success: function (data) {
                let datas = data,
                response = datas.response,
                dataRow = datas.dataRow,
                info = datas.info;

                if(data.response == 'success'){

                    $.each(dataRow, function(name, value) {
                        name = name.toLowerCase();
                        $("#materias_"+name).val(value);
                      });
                    
                   /* $('.comments').load(window.location + ' .comments >  *');
                    divInfo.show();
                    divInfo.attr('class','alert alert-success');
                    divInfo.text(info); 
                    clean_form(form);
                    setTimeout(function(e){
                        divInfo.hide();
                    },1000);*/
                }
            }
        });

    });
    /** delete */
    $(document).off('click','.delete_button');
    $(document).on('click','.delete_button',function(){
        let id_delete = $(this).attr('id_delete'),
        path = "materia/delete";
        

        $.ajax({
            type: "POST",
            url: path,
            data: {id_delete:id_delete},
            beforeSend: function(){
            },
            success: function (data) {
                let datas = data,
                response = datas.response,
                info = datas.info;
                if(data.response == 'success'){
                    
                    $('.comments').load(window.location + ' .comments >  *');
                    divInfo.show();
                    divInfo.attr('class','alert alert-success');
                    divInfo.text(info); 
                    clean_form(form);
                    setTimeout(function(e){
                        divInfo.hide();
                    },1000);
                }
            }
        });

    });
    

        /** submit */
    form.submit(function (e) {
        e.preventDefault();

        
       let formSubmit = $(this),
       urlAction = formSubmit.attr('type_form'),
       idUpdate = formSubmit.attr('idUpdate');
        let formData = formSubmit.serializeArray(),
        path = "materia/"+urlAction;


        $.ajax({
            type: "POST",
            url: path,
            data: formData,
            beforeSend: function(){
            },
            success: function (data) {
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
    });

    /** clean form */
    function clean_form(formClean){
        formClean.find('input').val('');
    }
});