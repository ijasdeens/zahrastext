$(document).ready(function () {

    const base_url = $('#base_url').val();

    const fetchtotalsalesdetails = () => {
        let totalAmount = 0;
        $.ajax({
            url: base_url + 'Accountantside/fetchtotalsalesdetails',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#totalsalesdetails').html('Rs. 0.00');
                    return false;
                }
                totalAmount += parseFloat(getData.map(d => d.after_discount));
                $('#totalsalesdetails').html('Rs.' + totalAmount.toFixed(2));
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

        console.log(totalAmount);

    }

    $("#searchAlldata").click(() => {
        let fromDate = $("#fromDate").val();
        let toDate = $("#toDate").val();

        if (fromDate == "") {
            alert('Please enter the from date');
            return false;
        }
        if (toDate == "") {
            alert('Please enter the ToDate');
            return false;
        }

        $.ajax({
            url: base_url + 'Accountantside/searchReports',
            method: 'POST',
            data: {
                fromDate: fromDate,
                toDate: toDate
            },
            success: function (data) {
                console.log(data);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    const showoffduecollection = () => {
        fetchtotalsalesdetails();
        let totalDue = 0;
        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'Accountantside/duecollectiondetails',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#showoffduecollection').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    totalDue += parseFloat(d.due_amount);
                    html += `<tr>
                <td>${count}</td>
<td>${d.customer_name}</td>
<td>${d.customer_phoneNo}</td>
<td>Rs . ${d.due_amount}</td>
                 </tr>`;
                });

                $('#showoffduecollection').html(html);
                $('#totalDueamount').html('Total due to be collected : Rs. <b>' + totalDue.toFixed(2) + '</b>');



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }
    showoffduecollection();



    const showoffproductdetails = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'Accountantside/showoffproducts',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#showoffproductdetails').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                    <td>${count}</td>
<td>${d.batch_no}</td>
<td>${d.product_name}</td>
<td>${d.manufectureDate}</td>
<td>${d.expirydate}</td>
<td>${d.quantity}</td>
<td>${d.costprice}</td>
<td>${d.sellingprice}</td>
<td>
<button class="btn btn-outline-danger deleteProducts btn-sm" products_id="${d.products_id}">Delete</button>
&nbsp;
<button class="btn btn-outline-primary editproducts btn-sm" batchNo="${d.batch_no}" product_id="${d.products_id}" product_name="${d.product_name}" manufectureDate="${d.manufectureDate}" expiryDate="${d.expirydate}" quantity="${d.quantity}" costprice="${d.costprice}" sellingprice="${d.sellingprice}">Edit</button>
</td>
                 </tr>`;
                });

                $('#showoffproductdetails').html(html);



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    showoffproductdetails();


    $('#saveproductsform').submit(function (e) {
        e.preventDefault();
        let batchNo = $("#batchNo").val();
        let productsName = $("#productsName").val();
        let ManufectureDate = $('#ManufectureDate').val();
        let expiryDate = $('#expiryDate').val();
        let costprice = $('#costprice').val();
        let sellingprice = $("#sellingprice").val();
        let quantity = $('#quantity').val();


        if (batchNo == "") {
            alert('Please enter the batch No');
            $('#batchNo').css('border', '2px solid red');
            return false;
        }

        if (productsName == "") {
            alert('Please enter the products name');
            $('#productsName').css('border', '2px solid red');
            return false;
        }

        if (ManufectureDate == "") {
            alert('Please enter the manufecture date');
            $('#ManufectureDate').css('border', '2px solid red');
            return false;
        }

        if (expiryDate == "") {
            alert('Please enter expiry date');
            $('#expiryDate').css('border', '2px solid red');
            return false;
        }

        if (costprice == "") {
            alert('Please enter the cost price');
            $('#costprice').css('border', '2px solid red');
            return false;
        }

        if (sellingprice == "") {
            alert('Please enter the selling price');
            $('#sellingprice').css('border', '2px solid red');
            return false;
        }

        $.ajax({
            url: base_url + 'Accountantside/saveproducts',
            method: "POST",
            data: {
                batchNo: batchNo,
                productsName: productsName,
                ManufectureDate: ManufectureDate,
                expiryDate: expiryDate,
                costprice: costprice,
                sellingprice: sellingprice,
                quantity: quantity
            },
            success: function (data) {
                alert('Product has been saved successfully');
                $("#saveproductsform")[0].reset();
                $('#batchNo').focus();
                showoffproductdetails();
            },
            error: function (err) {
                console.error('Error found', err);

            }
        });

    });

/*<button class="btn btn-outline-primary editproducts btn-sm" batchNo="${d.batch_no}" product_id="${d.products_id}" product_name="${d.product_name}" manufectureDate="${d.manufectureDate}" expiryDate="${d.expirydate}" quantity="${d.quantity}" costprice="${d.costprice}" sellingprice="${d.sellingprice}">Edit</button>*/

    $('body').delegate('.editproducts', 'click', function () {
        let batchNo = $(this).attr('batchNo');
        let product_name = $(this).attr('product_name');
        let manufectureDate = $(this).attr('manufectureDate');
        let expiryDate = $(this).attr('expiryDate');
        let quantity = parseInt($(this).attr('quantity'));
        let costprice = $(this).attr('costprice');
        let sellingprice = $(this).attr('sellingprice');
        let product_id = parseInt($(this).attr('product_id'));



        $('#hidden_id').val(product_id);
        $("#uproductsName").val(product_name);
        $("#uManufectureDate").val(manufectureDate);
        $('#uexpiryDate').val(expiryDate);
        $('#uquantity').val(quantity);
        $("#ucostprice").val(costprice);
        $("#usellingprice").val(sellingprice);

        $('#ubatchNo').val(batchNo);

        $("#producteditmodal").modal('show');
    });


    $('body').delegate('.deleteProducts', 'click', function (e) {

        e.preventDefault();
        let products_id = parseInt($(this).attr('products_id'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Accountantside/deleteProducts',
                method: "POST",
                data: {
                    products_id: products_id
                },
                success: function (data) {
                    alert('Product has been deleted');
                    showoffproductdetails();
                },
                error: function (err) {
                    console.error('Error found', err);

                }
            });


        }

    });


    $('#updateproductform').submit(function (e) {
        e.preventDefault();

        let hidden_id = parseInt($('#hidden_id').val());
        let ubatchNo = $("#ubatchNo").val();
        let uproductsName = $("#uproductsName").val();
        let uManufectureDate = $('#uManufectureDate').val();
        let uexpiryDate = $("#uexpiryDate").val();
        let uquantity = $('#uquantity').val();
        let ucostprice = $("#ucostprice").val();
        let usellingprice = $('#usellingprice').val();

        if (ubatchNo == "") {
            alert('Please enter the batch No');
            $('#ubatchNo').css('border', '2px solid red');
            return false;
        }

        if (uproductsName == "") {
            alert('Please enter the products name');
            $('#uproductsName').css('border', '2px solid red');
            return false;
        }

        if (uManufectureDate == "") {
            alert('Please enter the manufecture date');
            $('#uManufectureDate').css('border', '2px solid red');
            return false;
        }

        if (uexpiryDate == "") {
            alert('Please enter expiry date');
            $('#uexpiryDate').css('border', '2px solid red');
            return false;
        }

        if (uquantity == "") {
            alert('Please enter the cost price');
            $('#uquantity').css('border', '2px solid red');
            return false;
        }

        if (usellingprice == "") {
            alert('Please enter the selling price');
            $('#usellingprice').css('border', '2px solid red');
            return false;
        }

        $.ajax({
            url: base_url + 'Accountantside/updateProducts',
            method: "POST",
            data: {
                hidden_id: hidden_id,
                ubatchNo: ubatchNo,
                uproductsName: uproductsName,
                uManufectureDate: uManufectureDate,
                uexpiryDate: uexpiryDate,
                uquantity: uquantity,
                ucostprice: ucostprice,
                usellingprice: usellingprice
            },
            success: function (data) {
                 alert('Updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);

            }
        });


    });


    $("#searchproductdetails").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffproductdetails tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#searchtotalsales").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffduecollection tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });




}) //end of sum
