$(document).ready(function () {
    const base_url = $('#base_url').val();


    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
    
        // Create download link element
        downloadLink = document.createElement("a");
    
        document.body.appendChild(downloadLink);
    
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
            // Setting the file name
            downloadLink.download = filename;
    
            //triggering the function
            downloadLink.click();
        }
    }


    $("#productsexporttoexcel").click(function(){
        let name = prompt("Name your file"); 
        if(name==null){
            exportTableToExcel('product_details_toexporthtml','Productdetails');
        }
        else {
            exportTableToExcel('product_details_toexporthtml',name);

        }
    }); 


    $('.refille_outlets').click(function(){
        let id = Number($(this).attr('id')); 

        let typedvalue = prompt("Please enter the value to fill"); 

        if(typedvalue!=''){

            $.ajax({
                url: base_url + 'Controllerunit/refillwarehousection',
                method: 'POST',
                data:{
                    typedvalue:typedvalue,
                    id:id
                },
                  success: function (data) {
                    if(data==1){
                        alert('Updated successfully'); 
                        window.location.reload(); 
                    }
                    else {
                        alert('Not updated, Please contact Developer'); 
                        
                    }
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }
         
    });
     

    //subtract_products


    $('.subtract_products').click(function(){
        let id = Number($(this).attr('id')); 

        let typedvalue = prompt("Please enter the value to fill"); 

        let current_quantity = Number($(this).attr('current_quantity')); 
     

        if(typedvalue!=''){
            if(isNaN(typedvalue)){
                alert('Please enter only numbers'); 
                return false; 
            }

            if(typedvalue > current_quantity){
                alert('Current quantity is lower than typed quantity');
                return false; 
            }

            typedvalue = Number(typedvalue);

            $.ajax({
                url: base_url + 'Controllerunit/subtract_products',
                method: 'POST',
                data:{
                    typedvalue:typedvalue,
                    id:id
                },
                  success: function (data) {
                    if(data==1){
                        alert('Updated successfully'); 
                        window.location.reload(); 
                    }
                    else {
                        alert('Not updated, Please contact Developer'); 
                        
                    }
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }
         
    });
     

    const createInvoice = () => {
        let html = '';

        $.ajax({
            url: base_url + 'Controllerunit/createInvoice',
            method: 'POST',

            success: function (data) {
                if (data == "") {
                    html += `001`;
                    $("#invoiceId").val(html);
                } else {
                    data++;
                    if (data <= 10) {
                        html = `00` + data;
                    }
                    if (data >= 10) {
                        html = `0` + data;
                    }
                    if (data >= 100) {
                        html = +data;
                    }
                    $("#invoiceId").val(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }

    createInvoice();


    $('#saveupperbatch').submit(function (e) {
        $(this).attr('disabled',true);
        e.preventDefault();

        let invoiceId = $("#invoiceId").val();
        if(invoiceId==""){
            alert('Invoice id is missing to reset');
            return false;
        }
        $.ajax({
            url: base_url + 'Controllerunit/saveupperbatch',
            method: 'POST',
            data:{
              invoiceId:invoiceId
            },
            success: function (data) {
                 createInvoice();
                $(this).attr('disabled',false);
                $('#saveupperbatch')[0].reset();
                
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });


    const noImage = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png";

    const getfulltime = () => {

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

        $('#submitted_date').val(fullTime);

    }


    getfulltime();

    $("#categories_name").change(function (event) {
        let value = event.target.value;
        let html = null;

        $.ajax({
            url: base_url + 'Controllerunit/choosesubcategories',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $("#sub_categories").html('<option>--Select main category--</option>');
                } else {
                    getData.map(d => {
                        html += `<option value="${d.sub_categoryid}">${d.sub_cat_id}</option>`;

                    });
                    $("#sub_categories").html(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });


    $('body').delegate('.imageopen', 'click', function () {
        let url = $(this).attr('src');
        var win = window.open(url, '_blank');
        win.focus();
    });


    $('.deleteproduct').click(function (event) {
        let products_id = parseInt($(this).attr('products_id'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Controllerunit/deleteproduct',
                method: 'POST',
                data: {
                    products_id: products_id
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

    $('body').delegate('.assign_outlets', 'click', function () {
        let current_quantity = parseFloat($(this).attr('current_quantity'));
        $('#hidden_product_id').val($(this).attr('products_id'));
        $("#current_quantity_for_outlet").val(current_quantity);
    });


    $('#out_let_qty').keyup(function (event) {
        let value = event.target.value;
        let currentQty = $('#current_quantity_for_outlet').val();

        // if (isNaN(value)) {
        //     alert('Only numbers are allowed');
        //     $('#out_let_qty').val('');
        //     return false;
        // }

        // if (value > currentQty) {
        //     alert('It can not exceed over available quantity');
        //     $('#out_let_qty').val(currentQty);

        // }


    });


    $("#transfer_to_outlet").click(function () {

        let out_let_qty = $('#out_let_qty').val();
        let current_quantity_for_outlet = $('#current_quantity_for_outlet').val();
        
        let balance = 0.00; 

        if(out_let_qty > current_quantity_for_outlet){
            alert("It exceeds its maximum quantity");
            alert("Its maximum quantity is "+ current_quantity_for_outlet);  
            $('#out_let_qty').val(current_quantity_for_outlet); 
            return false; 
        }
        
        let outlet_name = parseInt($('#outlet_name').val());
        let hidden_product_id = parseInt($('#hidden_product_id').val());
 
        var firstValue=current_quantity_for_outlet;
var secondValue=out_let_qty;
var result = parseFloat(firstValue).toFixed(1) -
parseFloat(secondValue).toFixed(1);
console.log("Result is="+result);
        balance = result; 


        $.ajax({
            url: base_url + 'Controllerunit/outletassigned',
            method: 'POST',
            data: {
                out_let_qty: out_let_qty,
                balance: balance,
                outlet_name: outlet_name,
                hidden_product_id: hidden_product_id,
                current_quantity_for_outlet:current_quantity_for_outlet
            },
            success: function (data) {
                if(data==1){
                    alert('Product has been assigned to outlet');
                    window.location.reload();
                }
                else {
                    alert(data); 

                }
               
            },
            error: function (err) {
                alert(err);
                console.error('Error found', err);
            }
        });


    });

    
    function getsubcategorybasedoncategory(maincategoryid,subcategory){
        let value = maincategoryid; 
        let html = null;

        $.ajax({
            url: base_url + 'Controllerunit/choosesubcategories',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $("#sub_categories").html('<option>--Select main category--</option>');
                } else {
                    getData.map(d => {
                        html += `<option value="${d.sub_categoryid}">${d.sub_cat_id}</option>`;

                    });
                    $("#sub_categories").html(html);
                    $('#sub_categories').val(subcategory);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }


    $('#search_bybarcodesection').click(function(){
        let product_code = $('#product_code').val();
        if(product_code==''){
            alert('Please read barcode through barcode scanner to get product'); 
            $('#product_code').css('border','2px solid red'); 
            $('#product_code').focus(); 
            return false; 
        }
        else if(isNaN(product_code)){
            alert('Invalid product code. Please read correct one'); 
            $('#product_code').css('border','2px solid red'); 
            $('#product_code').focus(); 
            return false; 
        }
        else {
            $('#product_code').attr('disable',true); 
            $('#generateproductcodebtn').attr('disable',true);
            $('#product_code_error').html("");
            $.ajax({
                url: base_url + 'Controllerunit/search_bybarcodesection',
                method: 'POST',
                data: {
                    product_code:product_code
                },
                success: function (data) {
                    let getData = JSON.parse(data); 
                    console.clear(); 
                    console.log(getData);
                     
                     if(getData=='0'){
                         alert('Product is not found');
                         return false;  
                     }
                     else {

                         $('#product_code').attr('disabled',true); 
                         $('#generateproductcodebtn').attr('disabled',true);
                         
                        $('#saveProductsallbtn').addClass('d-none'); 
                        $('#updateproductsallbtn').removeClass('d-none');
                         getData.map(d => {
                            getsubcategorybasedoncategory(d.category_id,d.sub_categoryid);
                          $('#productsName').val(d.product_name); 
                          $('#brands_name').val(d.brand_id);
                          $('#categories_name').val(d.category_id); 
                          $('#sub_categories').val(d.sub_categoryid);
                          $('#manugectured_date').val(d.mfd);
                          $('#exp_date').val(d.exp);
                          $('#prudct_cost').val(d.product_cost);
                          $('#product_price').val(d.product_price);
                          $('#quantity').val(d.quantity);
                          $('#alert_quantity').val(d.alert_quantity);
                          $('#description').val(d.product_desc);
                          $('#product_unit').val(d.product_unit);
                          $('#supplier_for_product').val(d.supplier_det);
                          $('#warehouse_details_for_selecting').val(d.warehouse_id);
                          $('#batchNo').val(d.batch_no);
                          $('#invoiceId').val(d.invoice_no);
                          $('#Invoice_manual').val(d.Invoice_manual);
                          $('#additional_amount').val(d.additional_amount);
                         });


                     }
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }
    })


    


    $('#updateproductsallbtn').click(function(e){
       e.preventDefault(); 

       
       const formdata = new FormData();

       let supplier_for_product  = $('#supplier_for_product').val();
       let productName = $('#productsName').val();
       let product_code = $('#product_code').val();
       let brands_name = $('#brands_name').val();
       let submitted_date = $('#submitted_date').val();
       let categories_name = $('#categories_name').val();
       let sub_categories = $('#sub_categories').val();
       let mfd = $('#manugectured_date').val();
       let exp = $('#exp_date').val();
       let product_cost = $('#prudct_cost').val();
       let product_price = $('#product_price').val();

       let quantity = $('#quantity').val();
       let alert_quantity = $('#alert_quantity').val();

       let description = $('#description').val();
       let picture = $('#picture')[0].files[0];
       let batchNo = $('#batchNo').val();
       let invoiceId = $("#invoiceId").val();
       let Invoice_manual = $('#Invoice_manual').val();

       let warehouse_id = $('#warehouse_details_for_selecting').val(); 


       let additional_amount= $('#additional_amount').val(); 

       

       if(warehouse_id==''){
           alert('Please select warehouse details');
           $('#warehouse_details_for_selecting').css('border','2px solid red'); 
           return false;  
       }

       if(batchNo==""){
           alert('Batch no is required');
           return false;
       }

       if(invoiceId==""){
           alert('Invoice id is required');
           return false;
       }

       if(Invoice_manual==''){
           alert('Supplier invoice number is required');
           return false;
       }


       if(picture==undefined){
           picture = noImage;
       }


       if(supplier_for_product==''){
           alert('Please choose the supplier');
           return false;
       }

       if (isNaN(product_cost)) {
           alert('Only numbers are allowed');
           $('#prudct_cost').focus();
           return false;
       }
       if (isNaN(product_price)) {
           alert('Only numbers are allowed');
           $('#product_price').focus();
           return false;
       }

       if (isNaN(quantity)) {
           alert('Only numbers are allowed');
           $("#quantity").focus();
           return false;
       }

       if (isNaN(alert_quantity)) {
           alert('Only numbers are allowed');
           $('#alert_quantity').focus();
           return false;
       }


       formdata.append('productName', productName);
       formdata.append('product_code', product_code);
       formdata.append('brands_name', brands_name);
       formdata.append('submitted_date', submitted_date);
       formdata.append('categories_name', categories_name);
       formdata.append('sub_categories', sub_categories);
       formdata.append('mfd', mfd);
       formdata.append('exp', exp);
       formdata.append('product_cost', product_cost);
       formdata.append('product_price', product_price);
       formdata.append('quantity', quantity);
       formdata.append('alert_quantity', alert_quantity);
       formdata.append('description', description);
       formdata.append('noImage', picture);
       formdata.append('product_unit', $('#product_unit').val());
       formdata.append('batchNo', $('#batchNo').val());
       formdata.append('invoiceId', $('#invoiceId').val());
       formdata.append('supplier_invoice', $('#Invoice_manual').val());

       formdata.append('warehouse_id',warehouse_id);


       formdata.append('supplier_for_product', $('#supplier_for_product').val());

       formdata.append('additional_amount',additional_amount);
       

       $.ajax({
           url: base_url + 'Controllerunit/updateallproducts',
           type: "post",
           data: formdata,
           processData: false,
           contentType: false,
           cache: false,
           success: function (data) {
            alert('Updated successfully'); 
            window.location.reload();  
             
               
           },
           error: function (err) {
               console.clear(); 
               console.log('warehouse save error', err);
           }
       });







    }); 

    $("#addProductdetails").submit(function (event) {
        event.preventDefault();

        const formdata = new FormData();

        let supplier_for_product  = $('#supplier_for_product').val();
        let productName = $('#productsName').val();
        let product_code = $('#product_code').val();
        let brands_name = $('#brands_name').val();
        let submitted_date = $('#submitted_date').val();
        let categories_name = $('#categories_name').val();
        let sub_categories = $('#sub_categories').val();
        let mfd = $('#manugectured_date').val();
        let exp = $('#exp_date').val();
        let product_cost = $('#prudct_cost').val();
        let product_price = $('#product_price').val();

        let quantity = $('#quantity').val();
        let alert_quantity = $('#alert_quantity').val();

        let description = $('#description').val();
        let picture = $('#picture')[0].files[0];
        let batchNo = $('#batchNo').val();
        let invoiceId = $("#invoiceId").val();
        let Invoice_manual = $('#Invoice_manual').val();

        let warehouse_id = $('#warehouse_details_for_selecting').val(); 

        let additional_amount= $('#additional_amount').val(); 

        if(warehouse_id==''){
            alert('Please select warehouse details');
            $('#warehouse_details_for_selecting').css('border','2px solid red'); 
            return false;  
        }

        if(batchNo==""){
            alert('Batch no is required');
            return false;
        }

        if(invoiceId==""){
            alert('Invoice id is required');
            return false;
        }

        if(Invoice_manual==''){
            alert('Supplier invoice number is required');
            return false;
        }


        if(picture==undefined){
            picture = noImage;
        }


        if(supplier_for_product==''){
            alert('Please choose the supplier');
            return false;
        }

        if (isNaN(product_cost)) {
            alert('Only numbers are allowed');
            $('#prudct_cost').focus();
            return false;
        }
        if (isNaN(product_price)) {
            alert('Only numbers are allowed');
            $('#product_price').focus();
            return false;
        }

        if (isNaN(quantity)) {
            alert('Only numbers are allowed');
            $("#quantity").focus();
            return false;
        }

        if (isNaN(alert_quantity)) {
            alert('Only numbers are allowed');
            $('#alert_quantity').focus();
            return false;
        }


        formdata.append('productName', productName);
        formdata.append('product_code', product_code);
        formdata.append('brands_name', brands_name);
        formdata.append('submitted_date', submitted_date);
        formdata.append('categories_name', categories_name);
        formdata.append('sub_categories', sub_categories);
        formdata.append('mfd', mfd);
        formdata.append('exp', exp);
        formdata.append('product_cost', product_cost);
        formdata.append('product_price', product_price);
        formdata.append('quantity', quantity);
        formdata.append('alert_quantity', alert_quantity);
        formdata.append('description', description);
        formdata.append('uploadedpic', picture);
        formdata.append('noImage', picture);
        formdata.append('product_unit', $('#product_unit').val());
        formdata.append('batchNo', $('#batchNo').val());
        formdata.append('invoiceId', $('#invoiceId').val());
        formdata.append('supplier_invoice', $('#Invoice_manual').val());

        formdata.append('warehouse_details_for_selecting',warehouse_id);


        formdata.append('supplier_for_product', $('#supplier_for_product').val());

        formdata.append('additional_amount',additional_amount);

        $.ajax({
            url: base_url + 'Controllerunit/saveallproducts',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                alert('Saved successfully');
                 $("#addProductdetails")[0].reset();
                $("#productsName").focus();
                
            },
            error: function (err) {
                console.clear(); 
                console.log('warehouse save error', err);
            }
        });

    });


    $('#product_code').keyup(function (e) {
        let value = e.target.value;

        $.ajax({
            url: base_url + 'Controllerunit/checkProductcodeExist',
            method: 'POST',
            data: {
                value: value
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "1") {
                    $('#product_code_error').html("Code already exists");
                    $("#saveProductsallbtn").attr('disabled', true);
                    return false;
                } else {
                    $('#product_code_error').html("");

                    $('#saveProductsallbtn').attr('disabled', false);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    $('#generateproductcodebtn').click(function () {
        var d = new Date();
        var n = d.getTime() + d.getDate().toString();
        $('#product_code').val(n.substring(5));
    });




    $("#search_product").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showOffAvailableProducts tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



});
