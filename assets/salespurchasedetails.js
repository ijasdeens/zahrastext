$(document).ready(function(){

    const base_url = $('#base_url').val();


const showoffpurcahsedetails = () => {
    let count = 0;
    let html = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showoffpurcahsedetailssectuion',
            method: "POST",
            success: function (data) {
             let getData = JSON.parse(data);

                if(getData==0){
                    $('#show_purchased_details_with_customer').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                    return false;
                }
                else {
                    getData.map(d => {
                     html+=`<tr class="text text-center">
<td>${++count}</td>
<td>${d.invoice_no}</td>
<td>${d.ordered_date}</td>
<td>${d.customer_name==null ? 'Walk-in' : d.customer_name}</td>
<td>${d.customer_mobile==null ? 'Walk-in' : d.customer_mobile}</td>
<td>${d.discount}</td>
<td>${d.discounted_amount}</td>
<td>${parseFloat(d.total_amount).toFixed(2)}</td>
<td>${d.outlets_name}</td>
<td>
<button class="btn btn-link showoffproductdetails_section" order_summery_id='${d.order_summery_id}'>
SHOW PRODUCT
</button>

</td>
</tr>`;
                    });

                    $('#show_purchased_details_with_customer').html(html);
                }


            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



}

showoffpurcahsedetails();

 
      $("#search_details_forpurcahse_details").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#show_purchased_details_with_customer tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



$('#purcahse_details_search_btn').click(function(){
 

let from_date_starting_again_searc = $('#from_date_starting_again_searc').val();
    let to_date_searching_for_purcahse_details = $('#to_date_searching_for_purcahse_details').val();

    let outlet_details_section  =$('#outlet_details_section').val();

    if(from_date_starting_again_searc==''){
        $('#from_date_starting_again_searc').focus();
        $('#from_date_starting_again_searc').css('border','2px solid red');
        alert('Please choose a date for "FROM"');
        return false;
    }

    if(to_date_searching_for_purcahse_details==''){
        $('#to_date_searching_for_purcahse_details').focus();
        $('#to_date_searching_for_purcahse_details').css('border','2px solid red');
        alert('Please choose a date for "TO"');l
        return false;
    }



  let count = 0;
    let html = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showoffpurcahsedetailssectuionwithdate',
            method: "POST",
            data:{
                from_date_starting_again_searc:from_date_starting_again_searc,
                to_date_searching_for_purcahse_details:to_date_searching_for_purcahse_details,
                outlet_details_section:outlet_details_section
            },
            success: function (data) {
             let getData = JSON.parse(data);
             console.clear(); 
             console.log('Purcahse details',getData);
            if(getData==0){
                    $('#show_purchased_details_with_customer').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                    return false;
                }
                else {
                    getData.map(d => {
                     html+=`<tr class="text text-center">
<td>${++count}</td>
<td>${d.invoice_no}</td>
<td>${d.ordered_date}</td>
<td>${d.customer_name}</td>
<td>${d.customer_mobile}</td>
<td>${d.discount}</td>
<td>${d.discounted_amount}</td>
<td>${parseFloat(d.total_amount).toFixed(2)}</td>
<td>${d.outlets_name}</td>
<td>
<button class="btn btn-link showoffproductdetails_section" order_summery_id='${d.order_summery_id }'>
SHOW PRODUCT
</button>


</td>
</tr>`;
                    });

                    $('#show_purchased_details_with_customer').html(html);
                }


            },
            error: function (err) {
                console.clear(); 
                console.error('Error found from purcahse details', err);
            }
        });



});


    $('body').delegate('.showoffproductdetails_section','click',function(){
        let order_summery_id = parseInt($(this).attr('order_summery_id'));

        let html = null;
        let count = 0;

      
        $("#showoff_modal_section").modal('show');

           $.ajax({
            url: base_url + 'Controllerunit/getpurchasedproductsfordetails',
            method: "POST",
            data:{
              order_summery_id:order_summery_id
            },
            success: function (data) {
             let getData = JSON.parse(data);
                if(getData==0){
                    $('#product_show_off_details_in_table').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                    return false; 
                }
                else {
                    getData.map(d => {
                        html+=`<tr>
<td>${++count}</td>
<td>${d.product_name}</td>
<td>${d.choosen_quantity}</td>
<td>${(parseFloat(d.product_price).toFixed(2))}</d>
<td>${(parseFloat((d.product_price * d.choosen_quantity)))}</td>

</tr>`;
                    });

                    $('#product_show_off_details_in_table').html(html);

                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });




}); //End of script
