$(document).ready(function(){



    const getdataforprintfromshoppingcart = () => {
        getsubtotalanddiscount();
          $.ajax({
            url: base_url + 'Controllerunit/getdataforprintfromshoppingcart',
            method: 'POST',
            success: function (data) {

                console.log(data);
                $('#product_details_to_display_forinvoice').html(data);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }




});
