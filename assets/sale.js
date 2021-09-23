$(document).ready(function () {
    let base_url = $('#base_url').val();


     const searchshortNames = () => {

        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/searchshortNames',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {


                } else {
                    getData.map(d => {
                        html += `<option value="${d.c_shortname}"></option>`;
                    });


                }

                $('#codes_area').html(html);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    }


    searchshortNames();
    $('#searchcustomersec').keyup(function (event) {

        if (event.keyCode === 13) {

            let value = $(this).val();

            let html = null;
            $.ajax({
                url: base_url + 'Controllerunit/searchproductsforsale',
                method: 'POST',
                data: {
                    value: value
                },
                success: function (data) {
                    let getData = JSON.parse(data);
                    console.log(getData);
                    if (getData == "0") {
                        toastr.error("No customer found");
                        return false;
                    } else {
                        $("#itemCode").focus();
                        getData.map(d => {
                            $('#credtiLimit').html(d.c_creditlimit);
                            $('#creditPeriod').html(d.c_creditperiod);
                            $('#customerContactNo').html(d.c_contactno);
                        });


                    }
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });


        }
    })


    $('#itemCode').keyup(function (event) {
        let value = $(this).val();

        if (event.keyCode === 13) {
            let html = null;
            $.ajax({
                url: base_url + 'Controllerunit/searchProductsunit',
                method: 'POST',
                data: {
                    value: value
                },
                success: function (data) {
                    let getData = JSON.parse(data);
                    console.log(getData);
                    if (getData == "0") {
                        toastr.error("No data found");
                        return false;
                    } else {
                        getData.map(d => {
                            html += `<tr>
<td>${d.size}</td>
<td>${d.quantity}</td>
<td>
<input type="text" availablequantity="${d.quantity}" class="purchaseQuantity text-center" value="1"/>
</td>
<td>
<button class="btn btn-info add-tocart" size="${d.size}" quantity="${d.quantity}" size_id="${d.size_id}">
<i class="fa fa-shopping-cart" aria-hidden="true"></i>
</button>
</td>
</tr>`;
                        });

                        $('#salesProducts').html(html);
                    }
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }




    });




    $('body').delegate('.add-tocart', 'click', function () {
        let purchaseQuantity = parseInt($(this).parent().parent().find('.purchaseQuantity').val());
        let size = parseInt($(this).attr('size'));
        let quantity = parseInt($(this).attr('quantity'));
        let size_id = parseInt($(this).attr('size_id'));




        $.ajax({
            url: base_url + 'Controllerunit/addtocart',
            method: 'POST',
            data: {
                purchaseQuantity: purchaseQuantity,
                size: size,
                quantity: quantity,
                size_id: size_id
            },
            success: function (data) {
                toastr.success('Added to cart successfully');

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });



    $('body').delegate('.purchaseQuantity', 'keyup', function () {

        let availableQuantit = parseInt($(this).attr('availablequantity'));
        let purcahseQuantity = $(this).val();

        if (isNaN(purcahseQuantity)) {
            toastr.error("Only numbers allowed");
            $(this).val('');
            return false;
        }

        purcahseQuantity = parseInt(purcahseQuantity);

        if (purcahseQuantity > availableQuantit) {
            toastr.warning("Purchase quantity exceeds available quantity");
            $(this).val(availableQuantit);
            return false;
        }



    });


});
