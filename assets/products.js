$(document).ready(function () {
    const base_url = $('#base_url').val();

    const noImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png";


    const showOffcodes = () => {
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showOffcodes',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {

                } else {

                    getData.map(d => {

                        html += `<option value="${d.p_code}">`;
                    });

                    $('#codes').html(html);

                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showOffcodes();

    const showOffSupplierInfo = () => {
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showOffSupplierInfo',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#supplier_info').html('<option>--No data found--</option>')
                } else {

                    getData.map(d => {

                        html += `<option value="${d.c_id}">${d.c_fullname}</option>`;
                    });

                    $('#supplier_info').html(html);
                    $('#usupplier_info').html(html);


                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

    showOffSupplierInfo();

    const showoffProducts = () => {
        let number = 0;
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showoffProducts',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#showoffProducts').html('<span class="text text-danger font-weight-bold">No data found</span>')
                } else {

                    getData.map(d => {
                        number++;
                        html += `<tr>
<td>${d.p_code}</td>
<td>${d.p_name}</td>
<td>
<a href="#" picturepath="${d.picture_papth}" class="btn btn-link showPicture">Click to see picture</a>
</td>

<td>
${d.p_color}
</td>

<td>${d.mc_name}</td>
<td>${d.sc_name}</td>

<td>${d.p_unitprice}</td>
<td>${d.p_oldprice}</td>
<td>${d.p_unitprofit}</td>
<td>${d.p_unitdiscount}</td>
<td>${d.p_unitsalesamount}</td>
<td>${d.p_discounttype}</td>
<td>${d.p_recieveddatetime}</td>
<td>${d.p_lastupdateddatetime}</td>
<td>${d.p_companydiscount}</td>
<td>
<button class="btn btn-danger btn-sm deleteProducts" product_id="${d.p_id}" picture_papth="${d.picture_papth}">Delete</button>


<button class="btn btn-info btn-sm editProducts" product_id="${d.p_id}" productCode="${d.p_code}" productName="${d.p_name}" productColor="${d.p_color}" productSize="${d.p_size}" maincategoryId="${d.mc_id}" subCategoryId="${d.sc_id}" quantity="${d.p_qty}" unitPrice="${d.p_unitprice}" oldPrice="${d.p_oldprice}" unitProfit="${d.p_unitprofit}" unitDiscount="${d.p_unitdiscount}" p_unitsalesamount="${d.p_unitsalesamount}" p_discounttype="${d.p_discounttype}" p_recieveddatetime="${d.p_recieveddatetime}" p_lastupdateddatetime="${d.p_lastupdateddatetime}" p_companydiscount="${d.p_companydiscount}" supplier_id="${d.c_id}" picture_papth="${d.picture_papth}">Edit</button>

</td>

</tr>`;
                    });

                    $('#showoffProducts').html(html);
                    $('#totalproductscount').html('Total products count : ' + number);


                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    showoffProducts();

    $('body').delegate('.showPicture', 'click', function () {
        let picturepath = $(this).attr('picturepath');

        let path = base_url + 'assets/img/uploaded_photos/' + picturepath;
        let win = window.open(path, '_blank');
        if (win) {
            win.focus();
        } else {
            alert('Could not find a file');
        }


    });

    $('body').delegate('.deleteProducts', 'click', function () {
        let product_id = parseInt($(this).attr('product_id'));
        let picture_papth = $(this).attr('picture_papth');

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteProducts',
                method: 'POST',
                data: {
                    product_id: product_id,
                    picture_papth: picture_papth
                },
                success: function (data) {
                    alert('Deleted successfully');
                    window.location.reload();

                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }

    });


    const showOffCategories = () => {
        let number = 0;
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showOffCategories',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#maincategoryforproduct').html('<option>--No category found---</option>')
                } else {
                    html += `<option>--Select category--</option>`;
                    getData.map(d => {
                        number++;
                        html += `<option value="${d.category_id}">${d.category_name}</option>`;
                    });

                    $('#maincategoryforproduct').html(html);
                    $('#umaincategoryforproduct').html(html);


                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showOffCategories();



    function getAllsubcategories(myvalue, subCategory) {
        let value = myvalue;
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/getsubcategories',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#subcategoryforproduct').html('<option>No Sub category found</option>')
                } else {
                    getData.map(d => {

                        html += `<option value="${d.sub_categoryid}">${d.sub_categoryName}</option>`;
                    });


                    $('#usubcategoryforproduct').html(html);

                    $('#usubcategoryforproduct').val(subCategory);
                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    $("#maincategoryforproduct").change((e) => {
        let value = parseInt(e.target.value);


        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/getsubcategories',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#subcategoryforproduct').html('<option>No Sub category found</option>')
                } else {
                    getData.map(d => {

                        html += `<option value="${d.sub_categoryid}">${d.sub_categoryName}</option>`;
                    });

                    $('#subcategoryforproduct').html(html);
                    $('#usubcategoryforproduct').html(html);


                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });





    $("#umaincategoryforproduct").change((e) => {
        let value = parseInt(e.target.value);


        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/getsubcategories',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#usubcategoryforproduct').html('<option>No Sub category found</option>')
                } else {
                    getData.map(d => {

                        html += `<option value="${d.sub_categoryid}">${d.sub_categoryName}</option>`;
                    });

                    $('#usubcategoryforproduct').html(html);
                    $('#usubcategoryforproduct').html(html);


                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });





    $('#selectType').change(e => {
        let value = e.target.value;

        if (value == "new") {
            $("#itemcodefornew").removeClass('d-none');
            $('#productcdoeforexisting').addClass('d-none');
            $('#fornewone').removeClass('d-none');
            $('#forexsiting').addClass('d-none');
            $('#savevProductspanel').removeClass('d-none');
            $('#semiUpdatepanel').addClass('d-none');
        } else {
            $('#productcdoeforexisting').removeClass('d-none');
            $("#itemcodefornew").addClass('d-none');
            $("#existingitemcode").focus();
            $('#fornewone').addClass('d-none');
            $('#forexsiting').removeClass('d-none');
            $('#savevProductspanel').addClass('d-none');
            $('#semiUpdatepanel').removeClass('d-none');
        }
    });



    $('#semiUpdate').click(function (e) {

        e.stopImmediatePropagation();

        let productSize = $('#productSize').val();
        let id = $('#hidden_id').val();
        let productQuantity = $('#productQuantity').val();

        let existingitemcode = $("#existingitemcode").val();

        if (isNaN(productQuantity)) {
            toastr.error('Only numbers allowed');
            $('#productQuantity').focus();
            return false;
        }

        if (isNaN(productSize)) {
            toastr.error('Only numbers allowed');
            $('#productSize').focus();
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/semiUpdate',
            method: 'POST',
            data: {
                productSize: productSize,
                id: id,
                productQuantity: productQuantity,
                existingitemcode: existingitemcode
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



    $('#saveproducts').click(function () {


        var months = ["January", "February", "March", "April", "May", "Jun", "Jul", "Aug", "Sep", "October", "November", "December"];
        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
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
        var month = (d.getMonth() + 1);
        var year = d.getFullYear();


        let fullTime = month + "/" + date + "/" + year + "  " + hr + ":" + min + " " + ampm;

        let checkMultiproductmode = $('#closeAll').is(':checked') ? true : false;


        let formdata = new FormData();

        let imageUpload = $('#imgInp')[0].files[0];


        let productCode = $('#productCode').val();
        let productName = $('#productName').val();
        let productColor = $('#productColor').val();
        let productSize = $('#productSize').val();
        let maincategoryforproduct = $('#maincategoryforproduct').val();
        let productQuantity = $('#productQuantity').val();
        let productunitpricing = $("#productunitpricing").val();
        let productunitprofit = $('#productunitprofit').val();
        let productunitdiscount = $('#productunitdiscount').val();
        let supplier_info = $("#supplier_info").val();
        let subcategoryforproduct = $('#subcategoryforproduct').val();
        let companyDiscount = $("#companyDiscount").val();

        let chooseDiscount = $('#chooseDiscount').val();


        let perUnitSalesAmount = parseInt($('#itemUnitsalesAmountshow').html());

        if (productCode == "") {
            toastr.error('Please enter the product code');
            $("#productCode").focus();
            return false;
        }

        if (productName == "") {
            toastr.error('Please enter the product name');
            $('#productName').focus();
            return false;
        }

        if (productColor == "") {
            toastr.error('Please enter the product color');
            $('#productColor').focus();
            return false;
        }
        if (productSize == "") {
            toastr.error('Please enter the product Size');
            $('#productSize').focus();
            return false;
        }

        if (maincategoryforproduct == "") {
            toastr.error('Pleaseselect the product main category');
            $('#maincategoryforproduct').focus();
            return false;
        }


        if (productQuantity == "") {
            toastr.error('Please enter product quantity');
            $('#productQuantity').focus();
            return false;
        }

        if (productunitpricing == "") {
            toastr.error('Please enter the product pricing');
            $('#productunitpricing').focus();
            return false;
        }
        if (productunitprofit == "") {
            toastr.error('Please enter the product profit');
            $('#productunitprofit').focus();
            return false;
        }


        if (supplier_info == "") {
            toastr.error('Please enter the product supplier info');
            $('#supplier_info').focus();
            return false;
        }



        formdata.append('productCode', productCode);
        formdata.append('productName', productName);
        formdata.append('productColor', productColor);
        formdata.append('productSize', productSize);
        formdata.append('maincategoryforproduct', maincategoryforproduct);
        formdata.append('productQuantity', productQuantity);
        formdata.append('productunitpricing', productunitpricing);
        formdata.append('productunitprofit', productunitprofit);
        formdata.append('productunitdiscount', productunitdiscount);
        formdata.append('supplier_info', supplier_info);
        formdata.append('imageUpload', imageUpload);
        formdata.append('subcategoryforproduct', subcategoryforproduct);
        formdata.append('fullTime', fullTime);
        formdata.append('chooseDiscount', chooseDiscount);
        formdata.append('companyDiscount', companyDiscount);
        formdata.append('perUnitSalesAmount', perUnitSalesAmount);

        $('#saveproducts').val('Saving.........');

        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/saveProducts',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data == true) {
                    if (checkMultiproductmode) {
                        alert('Saved successfully');
                        $('#savecategoryform')[0].reset();
                        $("#productCode").focus();
                        $('#blah').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png');
                        $('.closebtnforpicture').addClass('d-none');
                        $('#imgInp').val('');
                        $('#saveproducts').val('Save');
                        showoffProducts();
                    } else {
                        alert('Saved successfully');
                        window.location.reload();
                    }


                }


            },
            error: function (err) {
                console.log('Error found', err);
            }
        });




    }); //End of function


    $('#productCode').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productName').focus();
        }

    });


    $('#productColor').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productSize').focus();
        }

    });

    $('#productName').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productColor').focus();
        }

    });


    $('#productSize').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#maincategoryforproduct').focus();
        }

    });

    $('#maincategoryforproduct').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#subcategoryforproduct').focus();
        }

    });

    $('#subcategoryforproduct').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productQuantity').focus();
        }

    });


    $('#productQuantity').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productunitpricing').focus();
        }

    });

    $('#productunitpricing').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#productunitprofit').focus();
        }

    });

    $('#productunitprofit').keyup(function (event) {
        if (event.keyCode === 13) {
            if ($('#chooseDiscount').val() == "unitdiscount") {
                $('#productunitdiscount').focus();
            } else {
                $('#companyDiscount').focus();
            }

        }

    });

    $('#uproductunitprofit').keyup(function (event) {
        if (event.keyCode === 13) {
            if ($('#uchooseDiscount').val() == "unitdiscount") {
                $('#uproductunitdiscount').focus();
            } else {
                $('#ucompanyDiscount').focus();
            }

        }

    });

    $('#companyDiscount').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#customerDiscount').focus();

        }
    });

    $('#productunitdiscount').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#supplier_info').focus();
        }

    });

    $('#supplier_info').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#saveproducts').focus();
        }

    });

    /*Picture preview code*/

    // Code By Webdevtrick ( https://webdevtrick.com )

    $('.closebtnforpicture').click(function () {
        $('#blah').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png');
        $('.closebtnforpicture').addClass('d-none');
        $('#imgInp').val('');
    })


    function readURL(input) {
        if (input.files && input.files[0]) {
            $('.closebtnforpicture').removeClass('d-none');
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });


    $('#productunitdiscount').keyup(function () {
        let value = parseInt($(this).val());
        let price = $('#productunitpricing').val();

        if (value != "") {
            if (price == "") {
                toastr.error('Please enter price');
                $('#productunitpricing').focus();
                return false;
            } else {
                let percentage = (value / 100) * price;
                $('#itemTotalDiscountAmountshow').html(percentage);
            }


        } else {
            $('#itemTotalDiscountAmountshow').html(0);
        }
    });



    $('#uproductunitdiscount').keyup(function () {
        let value = parseInt($(this).val());
        let price = $('#uproductunitpricing').val();

        if (value != "") {
            if (price == "") {
                toastr.error('Please enter price');
                $('#uproductunitpricing').focus();
                return false;
            } else {
                let percentage = (value / 100) * price;
                $('#uitemTotalDiscountAmountshow').html(percentage);
            }


        } else {
            $('#uitemTotalDiscountAmountshow').html(0);
        }
    });



    $('#productunitprofit').keyup(function () {
        if ($(this).val() != "") {
            let productunitprofit = parseFloat($('#productunitprofit').val());
            let productunitpricing = parseFloat($('#productunitpricing').val());
            let productQuantity = parseInt($('#productQuantity').val());

            let itemUnitSalesAmount = productunitpricing + productunitprofit;
            let itemTotalSalesAmount = itemUnitSalesAmount * productQuantity;
            let itemTotalProfitAmount = productunitprofit * productQuantity;


            $('#itemUnitsalesAmountshow').html(itemUnitSalesAmount);
            $("#itemTotalSalesAmountshow").html(itemTotalSalesAmount);
            $("#itemTotalProfitamountshow").html(itemTotalProfitAmount);

        } else {

            $('#itemUnitsalesAmountshow').html(0);
            $("#itemTotalSalesAmountshow").html(0);
            $("#itemTotalProfitamountshow").html(0);

        }

    });


    /*
<button class="btn btn-info btn-sm editProducts" product_id="${d.p_id}" productCode="${d.p_code}" productName="${d.p_name}" productColor="${d.p_color}" productSize="${d.p_size}" maincategoryId="${d.mc_id}" subCategoryId="${d.sc_id}" quantity="${d.p_qty}" unitPrice="${d.p_unitprice}" oldPrice="${d.p_oldprice}" unitProfit="${d.p_unitprofit}" unitDiscount="${d.p_unitdiscount}" p_unitsalesamount="${d.p_unitsalesamount}" p_discounttype="${d.p_discounttype}" p_recieveddatetime="${d.p_recieveddatetime}" p_lastupdateddatetime="${d.p_lastupdateddatetime}" p_companydiscount="${d.p_companydiscount}" supplier_id="${d.c_id}" picture_papth="${d.picture_papth}">Edit</button>*/


    $('body').delegate('.editProducts', 'click', function () {
        $('#updateproductdetailsModal').modal('show');

        $('#hidden_id').val($(this).attr('product_id'));
        $('#uproductCode').val($(this).attr('productCode'));
        $('#uproductName').val($(this).attr('productName'));
        $('#uproductColor').val($(this).attr('productColor'));
        $('#uproductSize').val($(this).attr('productSize'));
        $('#umaincategoryforproduct').val($(this).attr('maincategoryId'));
        $('#usubcategoryforproduct').val($(this).attr('subCategoryId'));
        $('#uproductQuantity').val($(this).attr('quantity'));
        $('#uproductunitpricing').val($(this).attr('unitPrice'));

        $('#uproductunitprofit').val($(this).attr('unitProfit'));

        $('#uproductunitdiscount').val($(this).attr('unitDiscount'));

        $('#usupplier_info').val($(this).attr('supplier_id'));
        $('#current_price').val($(this).attr('unitPrice'));

        getAllsubcategories($(this).attr('maincategoryId'), $(this).attr('subCategoryId'));
        let productunitprofit = parseFloat($(this).attr('unitProfit'));
        let productunitpricing = parseFloat($(this).attr('unitPrice'));
        let productQuantity = parseInt($(this).attr('quantity'));


        let itemUnitSalesAmount = productunitpricing + productunitprofit;
        let itemTotalSalesAmount = itemUnitSalesAmount * productQuantity;
        let itemTotalProfitAmount = productunitprofit * productQuantity;

        $('#ublah').attr('src', base_url + 'assets/img/uploaded_photos/' + $(this).attr('picture_papth'));

        $('#uitemUnitsalesAmountshow').html(itemUnitSalesAmount);
        $("#uitemTotalSalesAmountshow").html(itemTotalSalesAmount);
        $("#uitemTotalProfitamountshow").html(itemTotalProfitAmount);


        let discountType = $(this).attr('p_discounttype');


        $('#ucompanyDiscount').val($(this).attr('p_companydiscount'));

        if (discountType == "unitdiscount") {
            $('#uprofitdiscountsection').addClass('d-none');
            $('#uunitdiscountSection').removeClass('d-none');
        } else {
            $('#uprofitdiscountsection').removeClass('d-none');
            $('#uunitdiscountSection').addClass('d-none');
            $('#ucustomerDiscount').val($(this).attr('unitDiscount'));
        }

        //getback
        let picture_papth = $(this).attr('picture_papth');

        $('#uimgInp').val(picture_papth);

        if (picture_papth == "") {
            $('#ublah').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png');
        }





        let value = $(this).attr('unitDiscount');
        let price = productunitpricing;

        if (value != "") {
            if (price == "") {
                toastr.error('Please enter price');
                $('#productunitpricing').focus();
                return false;
            } else {
                let percentage = (value / 100) * price;
                $('#itemTotalDiscountAmountshow').html(percentage);
            }


        } else {
            $('#itemTotalDiscountAmountshow').html(0);
        }



    });


    $('#uproductunitprofit').keyup(function () {
        if ($(this).val() != "") {
            let productunitprofit = parseFloat($('#uproductunitprofit').val());
            let productunitpricing = parseFloat($('#uproductunitpricing').val());
            let productQuantity = parseInt($('#uproductQuantity').val());

            let itemUnitSalesAmount = productunitpricing + productunitprofit;
            let itemTotalSalesAmount = itemUnitSalesAmount * productQuantity;
            let itemTotalProfitAmount = productunitprofit * productQuantity;


            $('#uitemUnitsalesAmountshow').html(itemUnitSalesAmount);
            $("#uitemTotalSalesAmountshow").html(itemTotalSalesAmount);
            $("#uitemTotalProfitamountshow").html(itemTotalProfitAmount);

        } else {

            $('#uitemUnitsalesAmountshow').html(0);
            $("#uitemTotalSalesAmountshow").html(0);
            $("#uitemTotalProfitamountshow").html(0);

        }

    });



    $('#uproductCode').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductName').focus();
        }

    });


    $('#uproductColor').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductSize').focus();
        }

    });

    $('#uproductName').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductColor').focus();
        }

    });


    $('#uproductSize').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#umaincategoryforproduct').focus();
        }

    });

    $('#umaincategoryforproduct').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#usubcategoryforproduct').focus();
        }

    });

    $('#usubcategoryforproduct').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductQuantity').focus();
        }

    });


    $('#uproductQuantity').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductunitpricing').focus();
        }

    });

    $('#uproductunitpricing').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductunitprofit').focus();
        }

    });

    $('#uproductunitprofit').keyup(function (event) {
        if (event.keyCode === 13) {

            $('#uproductunitdiscount').focus();
        }

    });

    $('#uproductunitdiscount').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#usupplier_info').focus();
        }

    });

    $('#usupplier_info').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#usaveproducts').focus();
        }

    });



    $('#chooseDiscount').change(function () {
        let discountType = $(this).val();

        if (discountType == "unitdiscount") {
            $('#profitdiscountsection').addClass('d-none');
            $('#unitdiscountSection').removeClass('d-none');
        } else {
            $('#profitdiscountsection').removeClass('d-none');
            $('#unitdiscountSection').addClass('d-none');
        }

    });

    $('#uchooseDiscount').change(function () {
        let discountType = $(this).val();

        if (discountType == "unitdiscount") {
            $('#uprofitdiscountsection').addClass('d-none');
            $('#uunitdiscountSection').removeClass('d-none');
        } else {
            $('#uprofitdiscountsection').removeClass('d-none');
            $('#uunitdiscountSection').addClass('d-none');
        }

    });

    $("#ucustomerDiscount").keyup(function () {
        let customerDiscount = parseInt($(this).val());
        let companyDiscount = parseInt($('#ucompanyDiscount').val());


        if (customerDiscount > companyDiscount) {
            toastr.warning('Customer discount exceeds company discount');
        }


        let value = customerDiscount;
        let price = $('#uproductunitpricing').val();

        if (value != "") {
            if (price == "") {
                toastr.error('Please enter price');
                $('#uproductunitpricing').focus();
                return false;
            } else {
                let percentage = (value / 100) * price;
                $('#uitemTotalDiscountAmountshow').html(percentage);
            }


        } else {
            $('#uitemTotalDiscountAmountshow').html(0);
        }




    });




    $("#customerDiscount").keyup(function () {
        let customerDiscount = parseInt($(this).val());
        let companyDiscount = parseInt($('#companyDiscount').val());


        if (customerDiscount > companyDiscount) {
            toastr.warning('Customer discount exceeds company discount');
        }


        let value = customerDiscount;
        let price = $('#productunitpricing').val();

        if (value != "") {
            if (price == "") {
                toastr.error('Please enter price');
                $('#productunitpricing').focus();
                return false;
            } else {
                let percentage = (value / 100) * price;
                $('#itemTotalDiscountAmountshow').html(percentage);
            }


        } else {
            $('#itemTotalDiscountAmountshow').html(0);
        }




    });






    $('#usaveproducts').click(function () {


        var months = ["January", "February", "March", "April", "May", "Jun", "Jul", "Aug", "Sep", "October", "November", "December"];
        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
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
        var month = (d.getMonth() + 1);
        var year = d.getFullYear();


        let fullTime = month + "/" + date + "/" + year + "  " + hr + ":" + min + " " + ampm;

        let checkMultiproductmode = false;


        let formdata = new FormData();

        let imageUpload = $('#uimgInp')[0].files[0];


        let productCode = $('#uproductCode').val();
        let productName = $('#uproductName').val();
        let productColor = $('#uproductColor').val();

        let maincategoryforproduct = $('#umaincategoryforproduct').val();

        let productunitpricing = $("#uproductunitpricing").val();
        let productunitprofit = $('#uproductunitprofit').val();
        let productunitdiscount = $('#uproductunitdiscount').val();
        let supplier_info = $("#usupplier_info").val();
        let subcategoryforproduct = $('#usubcategoryforproduct').val();
        let companyDiscount = $("#ucompanyDiscount").val();

        let chooseDiscount = $('#uchooseDiscount').val();
        let productId = parseInt($('#hidden_id').val());

        let perUnitSalesAmount = parseInt($('#uitemUnitsalesAmountshow').html());

        if (productCode == "") {
            toastr.error('Please enter the product code');
            $("#uproductCode").focus();
            return false;
        }

        if (productName == "") {
            toastr.error('Please enter the product name');
            $('#uproductName').focus();
            return false;
        }

        if (productColor == "") {
            toastr.error('Please enter the product color');
            $('#uproductColor').focus();
            return false;
        }
        if (productSize == "") {
            toastr.error('Please enter the product Size');
            $('#uproductSize').focus();
            return false;
        }

        if (maincategoryforproduct == "") {
            toastr.error('Pleaseselect the product main category');
            $('#umaincategoryforproduct').focus();
            return false;
        }


        if (productQuantity == "") {
            toastr.error('Please enter product quantity');
            $('#uproductQuantity').focus();
            return false;
        }

        if (productunitpricing == "") {
            toastr.error('Please enter the product pricing');
            $('#uproductunitpricing').focus();
            return false;
        }
        if (productunitprofit == "") {
            toastr.error('Please enter the product profit');
            $('#uproductunitprofit').focus();
            return false;
        }

        if (productunitdiscount == "") {
            toastr.error('Please enter the product discount');
            $('#uproductunitdiscount').focus();
            return false;
        }

        if (supplier_info == "") {
            toastr.error('Please enter the product supplier info');
            $('#usupplier_info').focus();
            return false;
        }

        let current_price = $("#current_price").val();

        formdata.append('productCode', productCode);
        formdata.append('productName', productName);
        formdata.append('productColor', productColor);
        formdata.append('productSize', 1);
        formdata.append('maincategoryforproduct', maincategoryforproduct);
        formdata.append('productQuantity', 1);
        formdata.append('productunitpricing', productunitpricing);
        formdata.append('productunitprofit', productunitprofit);
        formdata.append('productunitdiscount', productunitdiscount);
        formdata.append('supplier_info', supplier_info);
        formdata.append('imageUpload', imageUpload);
        formdata.append('subcategoryforproduct', subcategoryforproduct);
        formdata.append('fullTime', fullTime);
        formdata.append('chooseDiscount', chooseDiscount);
        formdata.append('companyDiscount', companyDiscount);
        formdata.append('perUnitSalesAmount', perUnitSalesAmount);
        formdata.append('productId', productId);
        formdata.append('oldprice', current_price);

        $('#usaveproducts').val('Updating.........');

        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/updateproducts',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                console.clear();
                console.log(data);
                if (data == true) {
                    if (checkMultiproductmode) {
                        alert('Updated successfully');
                        window.location.reload();
                    } else {
                        alert('Updated successfully');
                        window.location.reload();
                    }


                }


            },
            error: function (err) {
                console.log('Error found', err);
            }
        });




    }); //End of function


    $('#productSize').keyup(function () {
        let value = $('#existingitemcode').val();

        let size = $(this).val();
        if ($('#selectType').val() == "existing") {
            $.ajax({
                url: base_url + 'Controllerunit/checkSizeExist',
                method: 'POST',
                data: {
                    value: value,
                    size: size
                },
                success: function (data) {
                    let getData = JSON.parse(data);
                    if (getData == "1") {
                        toastr.info('Size already exist');
                        return false;
                    }

                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }

    });


    $('#existingitemcode').keyup(function (event) {
        if (event.keyCode === 13) {
            $('#loaderattribute').removeClass('d-none');
            let value = $(this).val();

            let html = null;
            $.ajax({
                url: base_url + 'Controllerunit/getexistingproducts',
                method: 'POST',
                data: {
                    value: value
                },
                success: function (data) {
                    $('#loaderattribute').addClass('d-none');

                    let getData = JSON.parse(data);

                    if (getData == "0") {
                        toastr.error('No data found with this product code');
                        return false;
                    } else {

                        getData.map(d => {

                            $('#hidden_id').val(d.p_id);
                            $("#productName").val(d.p_name);
                            $("#productColor").val(d.p_color);
                            $("#productSize").val(d.p_size);
                            $("#maincategoryforproduct").val(d.mc_id);
                            $("#subcategory_text").val(d.sc_name);
                            $("#productQuantity").val(d.p_qty);
                            $("#productunitpricing").val(d.p_unitprice);
                            $("#productunitprofit").val(d.p_unitprofit);
                            $("#chooseDiscount").val(d.p_discounttype);
                            $('#companyDiscount').val(d.p_companydiscount);
                            $('#productunitdiscount').val(d.p_unitdiscount);
                            $('#supplier_info').val(d.c_id);





                            $("#productName").attr('disabled', true);
                            $("#productColor").attr('disabled', true);
                            $("#maincategoryforproduct").attr('disabled', true);
                            $("#subcategoryforproduct").attr('disabled', true);

                            $("#productunitpricing").attr('disabled', true);
                            $("#productunitprofit").attr('disabled', true);
                            $("#chooseDiscount").attr('disabled', true);
                            $('#companyDiscount').attr('disabled', true);
                            $('#productunitdiscount').attr('disabled', true);
                            $('#imgInp').attr('disabled', true);

                            if (d.picture_papth == "") {
                                $('#blah').attr('src', noImage);
                            }



                            if (d.p_discounttype == "unitdiscount") {
                                $('#profitdiscountsection').addClass('d-none');
                                $('#unitdiscountSection').removeClass('d-none');
                                $('#productunitdiscount').val(d.p_unitdiscount);
                            } else {
                                $('#profitdiscountsection').removeClass('d-none');
                                $('#unitdiscountSection').addClass('d-none');
                                $('#customerDiscount').val(d.p_unitdiscount);
                            }




                            let productunitprofit = parseFloat($('#productunitprofit').val());
                            let productunitpricing = parseFloat($('#productunitpricing').val());
                            let productQuantity = parseInt($('#productQuantity').val());

                            let itemUnitSalesAmount = productunitpricing + productunitprofit;
                            let itemTotalSalesAmount = itemUnitSalesAmount * productQuantity;
                            let itemTotalProfitAmount = productunitprofit * productQuantity;


                            $('#itemUnitsalesAmountshow').html(itemUnitSalesAmount);
                            $("#itemTotalSalesAmountshow").html(itemTotalSalesAmount);
                            $("#itemTotalProfitamountshow").html(itemTotalProfitAmount);




                            let value = parseInt(d.p_unitdiscount);
                            let price = $('#productunitpricing').val();

                            if (value != "") {
                                if (price == "") {
                                    toastr.error('Please enter price');
                                    $('#productunitpricing').focus();
                                    return false;
                                } else {
                                    let percentage = (value / 100) * price;
                                    $('#itemTotalDiscountAmountshow').html(percentage);
                                }


                            } else {
                                $('#itemTotalDiscountAmountshow').html(0);
                            }


                        });


                    }

                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }



    });



    $("#searchproducts").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffProducts tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $('#changeSizes').click(function () {
        $('#changeSizesmodal').modal('show');
        $("#updateproductdetailsModal").modal('hide');


        let hidden_id = $('#hidden_id').val();
        let uproductCode = $('#uproductCode').val();

        let number = 0;
        let html = "";

        $.ajax({
            url: base_url + 'Controllerunit/editAllsizes',
            method: 'POST',
            data: {
                hidden_id: hidden_id,
                uproductCode: uproductCode
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#showOffSizes').html('<span class="text text-danger">No data found</span>');
                    return false;
                }

                getData.map(d => {
                    number++;
                    html += `<tr>
<td>${number}</td>
<td>
<input type="text" class="sizes_area text-center" size_id="${d.size_id}" value="${d.size}"/>
</td>
<td>
<input type="text" class="quantity_area text-center" value="${d.quatity}" size_id="${d.size_id}"/>
</td>
<td>
<button class="btn btn-sm btn-danger deleteQuantityandSize" size_id="${d.size_id}" size="${d.size}" quatity="${d.quatity}">Remove</button>
</td>
</tr>`;
                });

                $('#showOffSizes').html(html);



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });



    $('#backtoEdit').click(function () {
        $('#updateproductdetailsModal').modal('show');
        $("#changeSizesmodal").modal('hide');
    });

    $('body').delegate('.sizes_area', 'keyup', function (event) {
        if (event.keyCode === 13) {
            alert('it works');
        }
    });


    /*<button class="btn btn-sm btn-danger deleteQuantityandSize" size_id="${d.size_id}" size="${d.size}" quatity="${d.quatity}">Remove</button>*/


    $('body').delegate('.deleteQuantityandSize', 'click', function () {
        let size_id = parseInt($(this).attr('size_id'));
        let quatity = parseInt($(this).attr('quatity'));

        $(this).parent().parent().remove();

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteQuantityandSize',
                method: 'POST',
                data: {
                    size_id: size_id,
                    quatity: quatity
                },
                success: function (data) {
                    toastr.error('Removed successfully');

                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }



    });



    $('.closebtnforpicture').click(function () {
        $('#ublah').attr('src', noImage);
        $('.closebtnforpicture').addClass('d-none');
        $('#uimgInp').val('');
    })


    function ureadURL(input) {
        if (input.files && input.files[0]) {
            $('.closebtnforpicture').removeClass('d-none');
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ublah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#uimgInp").change(function () {
        ureadURL(this);
    });


    $('body').delegate('.sizes_area ','keyup',function(){
        let value = $(this).val();
        let size_id = parseInt($(this).attr('size_id'));

        if(isNaN(value)){
            toastr.error('Only numbers allowed');
            $(this).focus();
            return false;
        }



            $.ajax({
                url: base_url + 'Controllerunit/updatesizes_area',
                method: 'POST',
                data: {
                    value: value,
                    size_id:size_id
                },
                success: function (data) {


                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });



    })



    $('body').delegate('.quantity_area  ','keyup',function(){
        let value = $(this).val();
        let size_id = parseInt($(this).attr('size_id'));

        if(isNaN(value)){
            toastr.error('Only numbers allowed');
            $(this).focus();
            return false;
        }



            $.ajax({
                url: base_url + 'Controllerunit/updatequantity_area',
                method: 'POST',
                data: {
                    value: value,
                    size_id:size_id
                },
                success: function (data) {


                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });



    })



}); //end of program
