$(document).ready(function(){
      console.clear();
    const base_url = $('#base_url').val();


   setInterval(function(){
         $.ajax({
            url: base_url + 'Controllerunit/gettotal',
            method: 'POST',
            success: function (data) {
                $('#product_details').html(data);
             },
            error: function (err) {
                console.error('Error found', err);
            }
        });
   },200);


     setInterval(function(){
         $.ajax({
            url: base_url + 'Controllerunit/getsalesdetails',
            method: 'POST',
            success: function (data) {

                $('#customer_display_acc').html(data);
             },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    },300);




});
