$(document).ready(function () {
    const base_url = $('#base_url').val();

    const getpurcahsedetailsforsupplier = (fromdate = null, todate = null, supplier = null, refrenceno=null) => {

        let count = 0; 
        let html = ''; 

        $.ajax({
            url: base_url + 'Controllerunit/getpurcahsedetailsforsupplier',
            method: 'POST',
            data: {
                fromdate:fromdate,
                todate:todate,
                supplier:supplier,
                refrenceno:refrenceno
            },
            success: function (data) {
                let getData = JSON.parse(data); 
                if(getData==0){
                    $("#showoffpurcahswdetailssection").html('<tr><td><span class="text text-center font-weight-bold">No data found</span></td></tr>');
                    return false; 
                }
                else {
                    getData.map(d => {
                        html+=`<tr>
                        <td>${++count}</td>
                        <td>${d.supplier_name}</td>
                        <td>${d.org_name}</td>
                        <td>${d.purcahse_details_ref}</td>
                        <td>${d.purcahse_details_date}</td>
                        <td>${parseFloat(d.purcahse_details_total_payment).toFixed(2)}</td>
                        <td>${parseFloat(d.paid_amount).toFixed(2)}</td>
                        <td>
                        ${d.bill_url=='' ? `<a>NO ATTACHMENT</a>` : `
                        <a href='${base_url}assets/img/uploaded_photos/${d.bill_url}' target='_blank' class="bill_url_open"><u>SHOW</u></a>
                        
                        `}
                        </td>
                        <td>
                        <button class="btn btn-info btn-sm edit_purcahsedetails" 
                        supplier_name = "${d.supplier_name}"
                        company_name = "${d.org_name}"
                        purcahse_details_ref = "${d.purcahse_details_ref}"
                        purcahse_details_date="${d.purcahse_details_date}"
                        purcahse_details_totalpayment = "${d.purcahse_details_total_payment}"
                        paying_amount="${d.paid_amount}"
                        supplier_id_fk = "${d.supplier_id_fk}"
                         purcahse_details_id='${d.purcahse_details_id}'>Edit <i class="fa fa-pencil" aria-hidden='true'></i></button>
                        &nbsp; 
                        <button class="btn btn-danger btn-sm delete_purcahsedetails d-none" purcahse_details_id='${d.purcahse_details_id}'>Delete <i class="fa fa-trash" aria-hidden='true'></i></button>
                        </td>
                        </tr>`;
                    }); 
                    $('#showoffpurcahswdetailssection').html(html); 


                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    getpurcahsedetailsforsupplier(); 

    $('body').delegate('.edit_purcahsedetails','click',function(){

    
        $("#ref_no_forsupplier").val($(this).attr('purcahse_details_ref')); 
        $("#supplier_name_section").val($(this).attr('supplier_id_fk')); 
        $("#purcahse_date").val($(this).attr('purcahse_details_date')); 
        $('#totalpaymenttotbepaid').val($(this).attr('purcahse_details_totalpayment')); 

    }); 


    $('body').delegate('.delete_purcahsedetails','click',function(){
        let purcahse_details_id = parseInt($(this).attr('purcahse_details_id')); 

        if(confirm("Are you sure you want to delete it?")){
            $.ajax({
                url: base_url + 'Controllerunit/delete_purcahsedetails',
                method: 'POST',
                data: {
                    purcahse_details_id: purcahse_details_id,
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
 

    $('#frm_purcahsedetails').submit(function(e){
        e.preventDefault();  

        const formData = new FormData(); 

        let paid_amount = $('#paid_amount').val(); 
        if(isNaN(paid_amount)){
            alert('Only numbers are accepted for paid amount');
            $('#paid_amount').css('border','2px solid red');  
            $("#paid_amount").focus(); 
            return false; 
        }
        let totalpaymenttotbepaid = $('#totalpaymenttotbepaid').val(); 
        if(isNaN(totalpaymenttotbepaid)){
            alert('Only numbers are accepted for numbers'); 
            $('#totalpaymenttotbepaid').css('border','2px solid red');  

            $('#totalpaymenttotbepaid').focus(); 
            return false; 
        }
        paid_amount = parseFloat(paid_amount).toFixed(2); 
        totalpaymenttotbepaid = parseFloat(totalpaymenttotbepaid).toFixed(2); 

        formData.append('supplier_name_section',$('#supplier_name_section').val()); 
        formData.append('ref_no_forsupplier',$('#ref_no_forsupplier').val()); 
        formData.append('purcahse_date',$('#purcahse_date').val()); 
        formData.append('paid_amount',paid_amount);
        formData.append('total_amount',totalpaymenttotbepaid); 
        
        let attachment = $('#bill_attachment_file')[0].files[0]; 
        formData.append('bill_attachmentpic',attachment); 

      



        $.ajax({
            url: base_url + 'Controllerunit/frm_purcahsedetails',
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
                alert('Error' + err); 
                console.clear(); 
                console.log('Purcahse save error', err);
            }
        });


    })


      $("#search_customer_details").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffCustomerbase tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    

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


 

});
