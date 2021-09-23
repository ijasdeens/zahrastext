$(document).ready(function(){

    const base_url = $('#base_url').val();




    $('#print_sales_report_section').click(function(){

        var printContents = $('#print_container').html();
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;



    });


    $('#search_result_for_sale').click(function(){
        let outlet_details = $('#outlet_details').val();
        let from_date_for_sale_report = $('#from_date_for_sale_report').val();
        let end_date = $('#end_date').val();

        if(outlet_details==''){
            alert('Please choose outlet');
            return false;
        }

        if(from_date_for_sale_report==''){
            alert('Please choose the starting date');
            return false;
        }

        if(end_date==''){
            alert('Please enter the finishing date');
            return false;
        }


         let count = 0;
        let html = '';


        let totalamountforprint = 0.00;

          $.ajax({
            url: base_url + 'Controllerunit/search_sales_report_product',
            method: 'POST',
            data:{
                outlet_details:outlet_details,
                from_date_for_sale_report:from_date_for_sale_report,
                end_date:end_date
            },
            success: function (data) {
              let getData = JSON.parse(data);
                if(getData=='0'){
                 $('#sales_report_product').html('<tr><td><span class="text text-danger font-weight-bold">No data found</span></td></tr>');
                      $('#sales_report_total_for_print').html('Total amount : Rs.'+parseFloat(totalamountforprint.toFixed(2)));
                    return false;
                }
                else {
                    getData.map(d => {
                    let totalAmount = parseFloat(d.total_amount);
                    let discounted_amount = parseFloat(d.discounted_amount.split('.')[1]);
                        totalamountforprint+= parseFloat(d.total_amount);

                    let recievedAmount = (totalAmount - discounted_amount);
                        ++count;
                        console.log(d.totalAmount);

                     html+=`<tr class='text text-center'>
                    <td>${count}</td>
                     <td>
                    ${d.ordered_date}
                    </td>
                    <td>
                    Rs. ${d.total_amount}
                    </td>
                    <td>
                    ${d.discount}
                    </td>
                    <td>
                    ${d.discounted_amount}
                    </td>
                    <td>

                    Rs.${recievedAmount}
                    </td>
                    <td>
                    <button class="btn btn-link showcustomerdetails" customer_id="${d.customer_id}">Click</button>
                    </td>
                     </tr>`;
                    });
                        $('#sales_report_product').html(html);
                      $('#sales_report_total_for_print').html('Total amount : Rs.'+totalamountforprint.toFixed(2));
                }

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

     });



    $('body').delegate('.showcustomerdetails','click',function(){
    let customer_id = $(this).attr('customer_id');

    let html = '';

    if(customer_id==0){
        alert('Walk-in customer');
    }
    else {

               $.ajax({
            url: $('#base_url').val() + 'Controllerunit/getcustomerdetailsforsalesreport',
            method: 'POST',
            data:{
                customer_id:customer_id
            },
            success: function (data) {
              let getData = JSON.parse(data);
                if(getData=='0'){
                    $('#attachcustomerdetails_showoff').html('<span class="text text-danger font-weight-bold">No data found</span>');


                    return false;
                }
                else {
                    getData.map(d => {
                        html+=`<tr>
<td>1</td>
<td>${d.customer_name}</td>
<td>${d.customer_mobile}</td>
</tr>`;
                    });
                    $('#attachcustomerdetails_showoff').html(html);
                     $('#showoffcustomerdetailsinmodal').modal('show');


                }

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    }

});


    $('body').delegate('.showproductdetails','click',function(){
        let outlet_id = Number($(this).attr('outlet_id'));
        let invoice_no = Number($(this).attr('invoice_no'));
        let order_summery_id = Number($(this).attr('order_summery_id'));

            $('#showoffproductdetailsforsales').modal('show');
        return false;

               $.ajax({
            url: $('#base_url').val() + 'Controllerunit/showproductdetailsforreport',
            method: 'POST',
            data:{
                outlet_id:outlet_id,
                invoice_no:invoice_no,
                order_summery_id:order_summery_id

            },
            success: function (data) {
            console.clear();
                console.log(JSON.parse(data));

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });


}); //End of script

