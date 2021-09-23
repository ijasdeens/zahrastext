$(document).ready(function () {
    const base_url = $('#base_url').val();




      $("#search_customer_details").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffCustomerbase tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    const showOffCustomers = () => {

        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showOffCustomers',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.clear();
                console.log(getData);
                if (getData == "0") {
                    $("#showoffCustomerbase").html('<span class="text text-danger font-weight-bold">No data found</span>');
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr class="text text-center">
<td>${count}</td>
<td>${d.customer_name}</td>
<td>${d.customer_mobile}</td>
<td>
<button class="btn btn-danger btn-sm deletecustomer" customer_id="${d.customer_id}">Delete</button>
</td>
</tr>`;

                    });
                    $('#showoffCustomerbase').html(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }

    $('body').delegate('.deletecustomer', 'click', function () {
        let customer_id = parseInt($(this).attr('customer_id'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Controllerunit/deletecustomer',
                method: 'POST',
                data: {
                    customer_id: customer_id,
                },
                success: function (data) {

                    alert('Deleted successfully');
                    $('#frmsaveCustomer')[0].reset();
                    $('#customerName').focus();
                    showOffCustomers();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });



        }


    });



    showOffCustomers();


    $('#frmsaveCustomer').submit(function (event) {
        event.preventDefault();



        let customerName = $('#customerName').val();
        let customerMobileNumber = $('#customerMobileNumber').val();

        if (customerName == "") {
            alert('Customer name is required');
            $('#customerName').focus();
            return false;
        }

        if (customerName == "") {
            alert('Customer mobile number is required');
            $('#customerMobileNumber').focus();
            return false;
        }

        if (isNaN(customerMobileNumber)) {
            alert('Only numbers allowed');
            $('#customerMobileNumber').focus();
            return false;
        }


        $.ajax({
            url: base_url + 'Controllerunit/savecustomers',
            method: 'POST',
            data: {
                customerMobileNumber: customerMobileNumber,
                customerName: customerName
            },
            success: function (data) {

                alert('Saved successfully');
                $('#frmsaveCustomer')[0].reset();
                $('#customerName').focus();
                showOffCustomers();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });


});
