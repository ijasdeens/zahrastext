$(document).ready(function(){
    const base_url = $('#base_url').val();


  const showOffallproductsforbarcode = () => {
      let html = null;
      let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/getallproductdetailsforbarcode',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData==0){
                    $('#product_details_forbarcode').html('<span class="text text-danger font-weight-bold">No data found</span>');
                    return false;
                }

                getData.map(d => {
                    html+=`<tr>
<td>${d.product_name}</td>
<td>${d.products_code}</td>
<td>${d.mfd}</td>
<td>${d.exp}</td>
<td>${d.product_unit}</td>
<td>
<button class='btn btn-primary btn-sm checkme_apps' product_name='${d.product_name}' products_id="${d.products_id}" product_price="${d.product_price}" mfd="${d.mfd}" exp="${d.exp}" product_unit='${d.product_unit}' products_code='${d.products_code}'>Select</button>
</td>
</tr>`;
                });
                $('#product_details_forbarcode').html(html);

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });



  }


  showOffallproductsforbarcode();


    $('#search_product_text').keyup(function(){
        let value = $(this).val();
        let html = null;
        if(value!=''){
              $.ajax({
            url: base_url + 'Controllerunit/getpoductbysearching',
            method: 'POST',
            data:{
                value:value
            },
            success: function (data) {
                let getData = JSON.parse(data);

                if(getData==0){
                    $('#product_details_forbarcode').html('<span class="text text-danger font-weight-bold">No data found</span>');
                    return false;
                }
              getData.map(d => {
                                html+=`<tr>
            <td>${d.product_name}</td>
            <td>${d.products_code}</td>
            <td>${d.mfd}</td>
            <td>${d.exp}</td>
            <td>${d.product_unit}</td>
            <td>
            <button class='btn btn-primary btn-sm checkme_apps' products_id="${d.products_id}" product_price="${d.product_price}" product_name="${d.product_name}" mfd="${d.mfd}" exp="${d.exp}" product_unit='${d.product_unit}' products_code='${d.products_code}'>Select</button>
            </td>
            </tr>`;
                });
                $('#product_details_forbarcode').html(html);

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

        }
        else {
              showOffallproductsforbarcode();

        }

    });


    $('body').delegate('.checkme_apps','click',function(){
        let products_id = parseInt($(this).attr('products_id'));
        let product_price = $(this).attr('product_price');
        let product_name = $(this).attr('product_name');
        let mfd = $(this).attr('mfd');
        let exp = $(this).attr('exp');
        let product_unit = $(this).attr('product_unit');


        $('#product_name').val(product_name);
        $('#numberofqty').val(1);
        $('#product_id').val($(this).attr('products_code'));
        $('#price').val(product_price);



    });



}); //End of script
