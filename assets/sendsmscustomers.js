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


    const showoffsmshistorysection = () => {

        let count = 0; 
        let html = ''; 
 

        $.ajax({
            url: base_url + 'Controllerunit/showoffsmshistorysection',
            method: 'POST',
            success: function (data) {
               let getData = JSON.parse(data); 
                console.log(getData); 

                if(getData==0){
                    $('#smshistory_section').html('<tr><td><span class="text text-danger font-weight-bold">NO data found</span></td></tr>');
                    return false; 
                }
                else {
                    getData.map(d => {
                        html+=`<tr class="text text-center">
                        <td>${++count}</td>
                        <td>${d.smshistory_sms}</td>
                        <td><a href='#' class="btn btn-link showsmshistory_mobileperson_details" mobile='${d.smshistory_tomobile}'><u>${d.smshistory_tomobile}</u></a></td>
                        <td>${d.smshistory_status=='Pending' ? `<span class="bdage badge-warning">Pending</span>` : `<span class="badge badge-success">Sent</span>`}</td>
                        <td>${d.smshistory_date_time}</td>

                        </tr>`;
                    }); 

                    $('#smshistory_section').html(html);
                }


              


            },
            error: function (err) {

            }
        });



    }

    showoffsmshistorysection();

    $('body').delegate('.showsmshistory_mobileperson_details','click',function(){
        let mobile = $(this).attr('mobile'); 
       
        if(mobile==''){
            alert('No data found'); 
            window.location.reload(); 
        }
        else {
            
            let html = ''; 

            $.ajax({
                url: base_url + 'Controllerunit/showsmshistory_mobileperson_details',
                method: 'POST',
                data:{
                    mobile:mobile
                },
                success: function (data) {
                    let getData = JSON.parse(data); 
                    if(getData==0){
                        alert('Person for mobile number has been deleted from customer section');
                        return false;  
                    }
                    else {
                         getData.map(d => {
                            html=`Name : ${d.customer_name} ,customer Mobile : ${d.customer_mobile}, Customer Address : ${d.customer_address}`;
                         }); 
                         alert(html);
                    }
                  
                },
                error: function (err) {
    
                }
            });
    
        }

    }); 


    $('#search_sms_history').click(function(){
        let from_date_for_search_ssm = $('#from_date_for_search_ssm').val(); 
        let to_date_for_search_ssm = $('#to_date_for_search_ssm').val(); 
        
        if(from_date_for_search_ssm==''){
            alert('Please enter the date for from section'); 
            $('#from_date_for_search_ssm').css('border','2px solid red'); 
            return false; 
        }

        if(to_date_for_search_ssm==''){
            alert('Please enter the date for to section'); 
            $("#to_date_for_search_ssm").css('border','2px solid red'); 
            return false; 

        }

        let count = 0; 
        let html = ''; 

        $.ajax({
            url: base_url + 'Controllerunit/search_sms_history_date',
            method: 'POST',
            data:{
                from_date_for_search_ssm:from_date_for_search_ssm,
                to_date_for_search_ssm:to_date_for_search_ssm
            },
            success: function (data) {
                let getData = JSON.parse(data); 
                console.log(getData); 

                if(getData==0){
                    $('#smshistory_section').html('<tr><td><span class="text text-danger font-weight-bold">NO data found</span></td></tr>');
                    return false; 
                }
                else {
                    getData.map(d => {
                        html+=`<tr class="text text-center">
                        <td>${++count}</td>
                        <td>${d.smshistory_sms}</td>
                        <td><a href='#' class="btn btn-link showsmshistory_mobileperson_details" mobile='${d.smshistory_tomobile}'><u>${d.smshistory_tomobile}</u></a></td>
                        <td>${d.smshistory_status=='Pending' ? `<span class="bdage badge-warning">Pending</span>` : `<span class="badge badge-success">Sent</span>`}</td>
                        <td>${d.smshistory_date_time}</td>

                        </tr>`;
                    }); 

                    $('#smshistory_section').html(html);
                }


              
            },
            error: function (err) {

            }
        });



    }); 


    $('.send_ind_message').click(function(){
        let customer_mobile = $(this).attr('customer_mobile');
        sessionStorage.setItem('customer_mobile',customer_mobile);
        $('#singlsendsmsModal').modal('show');
    });



    $('#single_message_to_message').keyup(function(e){
        let count = e.target.value.length;

        $('#single_letter_count').html(count);

    });



      $('#frmsendsms').submit(function(e){
        e.preventDefault();

        let message_to_message = $('#message_to_message').val();

        if(message_to_message==''){
            alert('Please type sms first');
            return false;
        }

          $.ajax({
            url: base_url + 'Controllerunit/sendsmssectiontoall',
            method: 'POST',
            data:{
                message_to_message:message_to_message, 
                date : getfulldate(), 
                dateandtime : getdateandtime()
            },
            success: function (data) {
                alert('Message has been sent successfully');
                window.location.reload();
            },
            error: function (err) {

            }
        });



    });






        $('#singlesmssendfrm').submit(function(e){
        e.preventDefault();

        let single_message_to_message = $('#single_message_to_message').val();
        if(single_message_to_message==''){
            alert('Please enter the message first');
            return false;
        }

        let customer_mobile = parseInt(sessionStorage.getItem('customer_mobile'));
       



          $.ajax({
            url: base_url + 'Controllerunit/sendindmessage',
            method: 'POST',
            data:{
                single_message_to_message:single_message_to_message,
                customer_mobile:customer_mobile,
                fulldate : getfulldate(), 
                dateandtime : getdateandtime()
            },
            success: function (data) {
                $('#singlesmssendfrm').find('btn-success').css('d-none');
                alert('Message has been sent successfully');
                window.location.reload();
            },
            error: function (err) {

            }
        });


     });




});
