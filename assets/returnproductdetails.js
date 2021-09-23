$(document).ready(function(){

    const base_url = $('#base_url').val();


const getAllkindofreturneddetails = () => {

    let count = 0;
    let html = null;

     $.ajax({
            url: base_url + 'Controllerunit/getAllkindofreturneddetails',
            method: "POST",
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData==0){
                    $('#showreturnedproductdetails').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                }
                else {
                    getData.map(d => {
                html+=`<tr class="text text-center">
                <td>${++count}</td>
                <td>${d.product_name}</td>
<td>${d.returned_quantity}</td>
<td>${d.product_code}</td>
<td>Rs.${parseFloat(d.price).toFixed(2)}</td>
<td>Rs.${parseFloat(d.price * d.returned_quantity).toFixed(2)}</td>
<td>
<button class="btn btn-link show_all_sumemry_details" order_summery_id='${d.order_summery_id}'>SHOW SUMMERY</button>
</td>

                </tr>`;
                    });
                    $('#showreturnedproductdetails').html(html);
                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




}


getAllkindofreturneddetails();




      $("#search_return_details_section").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showreturnedproductdetails tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });





    $('body').delegate('.show_all_sumemry_details',"click",function(){
        let order_summery_id=parseInt($(this).attr('order_summery_id'));

    
        let count = 0;
        let html = null;

                $.ajax({
            url: base_url + 'Controllerunit/show_all_sumemry_details_for_return',
            method: "POST",
            data:{
              order_summery_id:order_summery_id
            },
            success: function (data) {
             let getData = JSON.parse(data);
             console.clear(); 
             console.log(getData); 
 

                if(getData==0){
                    $('#return_products_details_showoff').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                }
                else {
                    getData.map(d => {
                        html+=`<tr>
<td>${++count}</td>
<td>${d.ordered_date}</td>
<td>${d.discount}%</td>
<td>${d.discounted_amount}</td>
<td>${d.total_amount}</td>
<td>${d.payment_method}</td>
<td>${d.outlets_name}</td>
<td>${d.invoice_no}</td>
<th>${d.customer_name}</th>
<td>${d.customer_mobile}</td>
</tr>`;
                    });
                    $('#return_products_details_showoff').html(html);
                }

                $('#show_off_modal_for_summery_projects').modal('show');

                console.log(getData);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });





});
