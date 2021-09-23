$(document).ready(function(){
    const base_url = $('#base_url').val(); 
 

    $('#warehouse_report_section_selector').change(function(){
        let selectedvalue = Number($(this).val());

        let count = 0; 
        let html = ''; 

        let sumofproduct = 0; 
        let sumofquantity = 0; 
        let sumofsellingprice = 0; 
        let totalproducts = 0; 
        let sumofcost = 0; 
          
    $.ajax({
        url:base_url + 'Controllerunit/getallproductsbasedonwarehouse',
        method:'POST',
        data:{
            selectedvalue:selectedvalue
        }, 
        success:function(data){
         let getData = JSON.parse(data); 
        
            if(getData==0){
                $('#warehousereport_display').html('<tr><td colspan="2">NO DATA FOUND</td></tr>'); 
                return false; 
            }
            else {
               getData.map(d => {
                totalproducts++;
                sumofcost+=parseFloat(d.product_cost); 
                sumofsellingprice+=parseFloat(d.product_price);
                sumofquantity+=parseInt(d.quantity); 
                
                 html+=`<tr>
                <td>${++count}</td>
                <td>${d.product_name}</td>
                <td>${d.products_code}</td>
                <td>${d.brands_name==null ? '-' : d.brands_name}</td>
                <td>${d.categoris_name==null ? '-' : d.brands_name}</td>
                <td>${d.sub_cat_id}</td>
                <td>${d.mfd}</td>
                <td>${d.exp}</td>
                <td>Rs.${parseFloat(d.product_cost).toFixed(2)}</td>
                <td>Rs.${parseFloat(d.product_price).toFixed(2)}</td>
                <td>${d.quantity}</td>
                <td>${d.alert_quantity}</td>
                <td style="cursor:pointer;">
                <a href='${base_url}assets/img/uploaded_photos/${d.product_pic}' target='_blank'>
                <img src="${base_url}assets/img/uploaded_photos/${d.product_pic}" alt='pictures' class="img-fluid"/>
                
                </a>
                </td>
                <td>
                ${d.product_unit}
                </td>
                <td>${d.product_desc}</td>
                <td>${d.batch_no}</td>
                <td>${d.invoice_no}</td>
                
                
                </tr>`;
               }); 
            }
            $('#warehousereport_display').html(html);
            $('#sumofcostsectionforall').html('Rs.'+sumofcost.toFixed(2)); 
            $('#sumofsellingpriceforall').html('Rs.'+sumofsellingprice.toFixed(2)); 
            $('#sumoftotalquantityforall').html('Rs.'+sumofquantity); 
            $('#sumoftotalproductsforall').html('Rs.'+totalproducts);
        },
        error:function(err){
            console.clear(); 
            console.log('Error found from get al products based on warehouse',err);
        }
    })
    }); 


    $('body').delegate('.delete_particular_product','click',function(e){
        e.stopImmediatePropagation()

        let products_id = Number($(this).attr('products_id'));
       
        if(confirm("Are you sure you want to delete it? Note : If you delete here, all products in outlets will automatically be deleted")){
            $.ajax({
                url:base_url + 'Controllerunit/warehousesectiondelete',
                method:'POST',
                data:{
                    products_id:products_id,
                 
                },
                success:function(data){
                    alert('Deleted successfully');
                    window.location.reload();
                },
                error:function(err){
                    console.log('Error found',err);
                }
            })
    
        }
        
    }); 


    $("#print_warehousestock").click(function () {
		var printContents = $("#print_section_for_outletstock_warehouse").html();
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	});




}); //End of script ;