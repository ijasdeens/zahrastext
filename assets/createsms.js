$(document).ready(function(){
const base_url = $('#base_url').val();


function getdateandtime() {
    var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "October",
        "November",
        "December",
    ];
    var days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    var d = new Date();
    var day = days[d.getDay()];
    var hr = d.getHours();
    var min = d.getMinutes();
    if (min < 10) {
        min = "0" + min;
    }
    var ampm = "AM";
    if (hr > 12) {
        hr -= 12;
        ampm = "PM";
    }
    var date = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();

    let fullTime =
        month + "/" + date + "/" + year + "  " + hr + ":" + min + " " + ampm;

    return fullTime;
}

 
 function getfulldate() {
    var today = new Date();

    let date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
    var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    let mydate = [year, month, day].join("-");

    return mydate;
}



    $('body').delegate('.deletegroupbtnforsms','click',function(){
        let group_id = parseInt($(this).attr('group_id')); 

        if(confirm("Are you sure you want to delete it?")){
            $.ajax({
                url: base_url + 'Controllerunit/deletegroupbtnforsms',
                method: 'POST',
                data:{
                    group_id:group_id
                },
                success: function (data) {
                  
                    alert('Group has been deleted successfully');
                    window.location.reload();
                },
                error: function (err) {
                    console.log('Error',err);
                }
            });

        }

    });


      $('#frmcreategroups').submit(function(e){
        e.preventDefault();

        let create_group_name = $('#create_group_name').val();
        if(create_group_name==''){
            alert('Please enter the group name');
            return false;
        }

          $.ajax({
            url: base_url + 'Controllerunit/checknamexist',
            method: 'POST',
            data:{
                create_group_name:create_group_name
            },
            success: function (data) {

                if(data==1){
                    alert('The name already exist. Please choose another name');
                    return false;
                }
                else {

                          $.ajax({
                            url: base_url + 'Controllerunit/creategroupsforsms',
                            method: 'POST',
                            data:{
                                create_group_name:create_group_name
                            },
                            success: function (data) {
                                console.clear();
                                console.log(data);
                                alert('Group has been created successfully');
                                window.location.reload();
                            },
                            error: function (err) {

                            }
                        });



                }
            },
            error: function (err) {

            }
        });





    });



    $('.editgroup_name').click(function(e){
        let group_id= parseInt($(this).attr('group_id'));
        group_id = Number(group_id);
        let group_name = $(this).attr('group_name');

        $('#update_create_group_name').val(group_name);

        sessionStorage.setItem('group_id',group_id);
          $('#updateexampleModal').modal('show');

    });


    $('#frmupdategroup').submit(function(e){
        e.preventDefault();


        let update_create_group_name = $('#update_create_group_name').val();
        if(update_create_group_name==''){
            alert('Please enter the group name');
            return false;
        }


                        $.ajax({
                            url: base_url + 'Controllerunit/updategroupname',
                            method: 'POST',
                            data:{
                                update_create_group_name:update_create_group_name,
                                group_id: sessionStorage.getItem('group_id')
                            },
                            success: function (data) {
                                alert('Update successfully');
                                window.location.reload();
                            },
                            error: function (err) {

                            }
                        });





    });


        $('.add_customer_sms_group').click(function(e){


        $('#group_id_hidden_id').val($(this).attr('group_id'));


        $('#addgroupsforcustomertosmss').modal('show');
    });


    $('#frmsms_group_message_section').submit(function(e){
        e.preventDefault();


        let group_sms_contact_text = $('#group_sms_contact_text').val();
        let group_id_hidden_id = parseInt($('#group_id_hidden_id').val());

                        $.ajax({
                            url: base_url + 'Controllerunit/sendgroupsmsbyid',
                            method: 'POST',
                            data:{
                                group_sms_contact_text:group_sms_contact_text,
                                group_id_hidden_id:group_id_hidden_id,
                                fulldate : getfulldate(), 
                                dateandtime : getdateandtime()

                            },
                            success: function (data) {
                              alert('Send successfully');
                                window.location.reload();

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });



/*
    $('.addtogroupbtnforsms').click(function(){
        let group_id = parseInt($('#group_id_hidden_id').val());
        let customer_id = parseInt($(this).attr('customer_id'));
        customer_id = Number(customer_id);

                        $.ajax({
                            url: base_url + 'Controllerunit/addcustomers_to_group_for_smssection',
                            method: 'POST',
                            data:{
                                group_id:group_id,
                                customer_id:customer_id

                            },
                            success: function (data) {
                                console.log(data);
                                alert('Customer has successfully been added to group.');
                                window.location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });


                });
*/

        $('body').delegate('.deltecontact_details','click',function(){
            let customer_id = Number($(this).attr('customer_id')); 
            let group_id = Number(sessionStorage.getItem('group_id_for_show_deelete')); 
 
            if(confirm("Are you sure you want to delete it?")){
                
                $.ajax({
                    url: base_url + 'Controllerunit/deltecontact_details_accurate',
                    method: 'POST',
                    data:{
                        customer_id:customer_id,
                        group_id:group_id
                    },
                    success: function (data) {
                        console.log(data);
                        alert('Customer has successfully been deleted from group.');
                        window.location.reload();
                    },
                    error: function (err) {
                        alert(err);
                    }
                });

            }
        }); 


       $('.addtogroupbtnforsms').click(function(){
        let group_id = parseInt($('#group_id_hidden_id').val());
        let customer_id = parseInt($(this).attr('customer_id'));
        customer_id = Number(customer_id);

                        $.ajax({
                            url: base_url + 'Controllerunit/addcustomers_to_group_for_smssection',
                            method: 'POST',
                            data:{
                                group_id:group_id,
                                customer_id:customer_id

                            },
                            success : (data) =>  {
                                if(data==0){
                                    alert('Customer has already been added. Please choose different one'); 
                                    $(this).css('border','2px solid red'); 
                                    return false; 
                                }
                                else {
                                    alert('Customer has successfully been added to group.');
                                    window.location.reload();

                                }
                               
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });


                });



        $('.show_contact_details_btn').click(function(){
        let group_id = $(this).attr('group_id');
        group_id = parseInt(group_id);
        group_id = Number(group_id);

        sessionStorage.setItem('group_id_for_show_deelete',group_id);

        let html = null;
        let count = 0;

                        $.ajax({
                            url: base_url + 'Controllerunit/getcontactdetailsforsms',
                            method: 'POST',
                            data:{
                                group_id:group_id,
                            },
                            success: function (data) {
                            let getData = JSON.parse(data);
                                console.log(getData);

                                if(getData==0){
                                    $('#show_releated_sms'+group_id).html('<span class="text text-danger font-weight-bold">No data found</span>');

                                }
                                else {
                                    getData.map(d => {
                                   html+=`<tr>
                                <td>${++count}</td>
                                <td>${d.customer_name}</td>
                                <td>${d.customer_mobile}</td>
                                <td>
                                <button class="btn btn-outline-danger btn-sm deltecontact_details" customer_id='${d.customer_id}'><i class="fa fa-trash" aria-hidden='true'></i></button>
                                </td>
                                </tr>`;
                                    });
                                    $('#show_releated_sms'+group_id).html(html);
                                }
                            },
                            error: function (err) {
                                console.clear();
                                console.error('SMS CONTACT ERROR FOUND',err);
                            }
                        });




    });




    $('.send_sms_group_section').click(function(e){
        e.preventDefault();
        let group_id = parseInt($(this).attr('group_id'));
         $("#group_id_hidden_id").val(group_id);
        $('#group_sms_sectionmodal').modal('show');
    });



    $('#group_sms_contact_text').keyup(function(e){
        let length = e.target.value.length;

        if(length >=130){
              $('#letter_count_for_group_sms_text').html(`<span class="font-weight-bold text-danger">${length}/150</span>`);
        }
        else {
              $('#letter_count_for_group_sms_text').html(`<span class="font-weight-bold">${length}/150</span>`);
        }

        if(length==0){
             $('#letter_count_for_group_sms_text').html(`<span class="">${length}/150</span>`);
        }

    });



}); //end of script
