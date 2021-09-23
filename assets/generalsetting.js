$(document).ready(function(){

    const base_url = $('#base_url').val();

    function getAllsettings(){
        
        $.ajax({    
            url: base_url + 'Controllerunit/getAllsettings',
            method: 'POST',
            success: function (data) {
               let getData = JSON.parse(data);
               console.clear(); 
               console.log('Settings', getData); 
               getData.map(d => {
                    $('#days_forexpirecounter').val(d.outlet_alert_quantity);
                    $('#warehouse_pr_reminder').val(d.warehouse_productsreminder_privillage); 
                    $('#warehouse_exp_reminder_section').val(d.warehouse_productsreminder_privillage); 
                    $('#sales_summmery_viewer').val(d.view_salessummery_privillage);
                    $('#sales_section_reminder').val(d.view_salesection_privillage);
                    $('#chque_date_remindersection').val(d.cheque_days_ago);
                    $('#showchqueetailsincashier').val(d.chequeshowcashier); 
                    $('#showcheckbyadminincashier').val(d.admin_check_show); 
               }); 
            },
            error: function (err) {
                alert(err);
            }
        });

        
        
    }

    getAllsettings(); 

 
    $("#cheque_details_privillagesform").submit(function(event){
        event.preventDefault(); 
        let value = $('#chque_date_remindersection').val(); 

        if(value==''){
            alert('Cheque date reminder in days is required'); 
            $('#chque_date_remindersection').focus(); 
            $('#chque_date_remindersection').css('border','2px solid red'); 
            return false; 
        }
      
        if(isNaN(value)){
            alert('Only numbers are accepted for days'); 
            $('#chque_date_remindersection').focus(); 
            $('#chque_date_remindersection').css('border','2px solid red'); 
            return false; 

        }
        if(value<=0){
            alert('Days must be atleast 1. 0 or lesser than 0 is not acceptable'); 
            $('#chque_date_remindersection').focus(); 
            $('#chque_date_remindersection').css('border','2px solid red'); 
            return false; 
        }
         

        let showchqueetailsincashier = $('#showchqueetailsincashier').val(); 

        let showcheckbyadminincashier = $('#showcheckbyadminincashier').val();


       
     
        
        $.ajax({    
            url: base_url + 'Controllerunit/savechequedetailsprivillagesform',
            method: 'POST',
            data:{
                daysbeforeforcheque:value,
                showchqueetailsincashier:showchqueetailsincashier,
                showcheckbyadminincashier:showcheckbyadminincashier
            },
            success: function (data) {
               if(data==1){
                   alert('Updated successfully'); 
                   window.location.reload(); 
               }
               else {
                   alert(data); 
               }
            },
            error: function (err) {
                console.log(err);
            }
        });



    }); 



    $("#save_general_setting_name").click(function(){

        const formData = new FormData();

    let company_name = $('#company_name').val();
        let company_address = $('#company_address').val();
        let hotline_number = $("#hotline_number").val();



   let imageUpload = $('#logo_img')[0].files[0];



        if(company_name==''){
            alert('Company name is required');
            return false;
        }

        if(hotline_number==''){
            alert('Hot-line number');
            return false;

        }

        if(company_address==''){
            alert('Company address is required');
            return false;
        }


        formData.append('company_name',company_name);
        formData.append('company_address',company_address);
        formData.append('company_hotline',hotline_number);
        formData.append('imageUpload',imageUpload);


          $.ajax({
            url: base_url + 'Controllerunit/savegeneralsettings',
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                 alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });





    });


    $('#update_products_expiredatesystembtn').click(function(){
        let days_forexpirecounter = $('#days_forexpirecounter').val(); 
        if(days_forexpirecounter==''){
            alert('It can not be empty. Please fill it with a number'); 
            $('#days_forexpirecounter').focus(); 
        
            return false; 
        }

        if(isNaN(days_forexpirecounter)){
            alert('Only numbers are allowed');
            $('#days_forexpirecounter').focus(); 

            return false; 
        }


        

        $.ajax({    
            url: base_url + 'Controllerunit/update_products_expiredatesystembtn',
            method: 'POST',
            data:{
                days_forexpirecounter:days_forexpirecounter,

            },
            success: function (data) {
               alert('updated successfully');
                window.location.reload();
            },
            error: function (err) {
                alert(err);
            }
        });



    }); 

    $('#update_privillagesforcashier').click(function(){
       let warehouse_pr_reminder = $('#warehouse_pr_reminder').val(); 
       let warehouse_exp_reminder = $('#warehouse_exp_reminder').val(); 
       let sales_summmery_viewer = $('#sales_summmery_viewer').val(); 
       let sales_section_reminder = $('#sales_section_reminder').val(); 

       $.ajax({    
        url: base_url + 'Controllerunit/update_privillagesforcashier',
        method: 'POST',
        data:{
            warehouse_pr_reminder:warehouse_pr_reminder,
            warehouse_exp_reminder:warehouse_exp_reminder,
            sales_summmery_viewer:sales_summmery_viewer,
            sales_section_reminder:sales_section_reminder
        },
        success: function (data) {
           alert('updated successfully');
            window.location.reload();
        },
        error: function (err) {
            alert(err);
        }
    });




    })



    $('#alert_quantity_frm').submit(function(event){
        event.preventDefault();

        let value = Number($('#alert_quantity_for_outlets_text').val());

        if(value==''){
            alert('Please enter the number');
            return false;
        }


                    $.ajax({
                            url: base_url + 'Controllerunit/alert_quantity_for_outlets_text',
                            method: 'POST',
                            data:{
                                value:value,

                            },
                            success: function (data) {
                               alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });


});
