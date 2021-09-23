$(document).ready(function(){

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
    

    $('#exporttoexcelsupplierdeetails').click(function(){
        let filename = prompt("Name your file"); 

        if(filename==null){
            exportTableToExcel('full_supplierdetails','Supplier details'); 
        }
        else {
            exportTableToExcel('full_supplierdetails',filename); 

        }
    }); 

    $("#search_details_forsupplier").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#supplierdetailsproductsearch tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $('#searchforsupplierinvoicetoo').click(function(){
        let supplier_details = $('#supplior_details_section_md').val(); 
        let invoice_no = $("#invoice_no").val(); 
        

         let salesprice = 0; 
         let staticquanttiy = 0; 
         let costpricedummy = 0; 
         
         let salespricedummy = 0; 
 
         let costpriceind = 0; 
        let html = null;


                        $.ajax({
                            url: base_url + 'Controllerunit/searchforsupplierinvoicetoobutton',
                            method: 'POST',
                            data:{
                                supplier_details:supplier_details,
                                invoice_no:invoice_no
                            },
                            success: function (data) {
                              let getData = JSON.parse(data);
                                if(getData==0){
                                    html=`<tr><td><span class="text texdt-danger font-weight-bold">NO DATA FOUND</span></td></tr>`;
                                    $('#supplierdetailsproductsearch').html(html);
                                }
                                else {
                                    getData.map(d => {
                                        
                                        salesprice = parseFloat(d.product_price).toFixed(2);
                                        staticquanttiy = parseInt(d.static_count_fromsupplier); 
                                        
                                        salespricedummy+= (salesprice * staticquanttiy); 

                                        costpriceind = parseFloat(d.product_cost).toFixed(2); 

                                        costpricedummy+= (costpriceind * staticquanttiy); 

                                        let balance_qty = parseFloat(d.static_count_fromsupplier - d.quantity); 
                                        html+=`<tr class="text text-center">
<td>${d.products_code}</td>
<td>${d.product_name}</td>
<td>${d.product_unit}</td>
<td>${d.mfd}</td>
<td>${d.exp}</td>
<td>${d.product_cost}</td>
<td>${d.product_price}</td>
<td>${d.quantity}</td>
<td>${d.static_count_fromsupplier}</td>
<td>${d.static_count_fromsupplier!=0 ? balance_qty : d.static_count_fromsupplier }</td>
<td>${d.batch_no}</td>
<td>${d.invoice_no}</td>
<td>${d.Invoice_manual}</td>
</tr>`;
                                    });
                                    $('#supplierdetailsproductsearch').html(html);
                                    $('#total_salesamount').html('Rs. '+ parseFloat(salespricedummy.toFixed(2))); 
                                    $("#total_costamountfromsupplier").html('Rs. ' + parseFloat(costpricedummy).toFixed(2)); 
                                }

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });


    }); 

/*

    $('#supplior_details_section_md').change(function(e){
        let value = parseInt(e.target.value);
        value = Number(value);

        let html = null;


                        $.ajax({
                            url: base_url + 'Controllerunit/supplior_details_section_md',
                            method: 'POST',
                            data:{
                                value:value
                            },
                            success: function (data) {
                              let getData = JSON.parse(data);
                                if(getData==0){
                                    html=`<tr><td><span class="text texdt-danger font-weight-bold">NO DATA FOUND</span></td></tr>`;
                                    $('#supplierdetailsproductsearch').html(html);
                                }
                                else {
                                    getData.map(d => {
                                        let balance_qty = parseFloat(d.static_count_fromsupplier - d.quantity); 
                                        html+=`<tr class="text text-center">
<td>${d.products_code}</td>
<td>${d.product_name}</td>
<td>${d.product_unit}</td>
<td>${d.mfd}</td>
<td>${d.exp}</td>
<td>${d.product_cost}</td>
<td>${d.product_price}</td>
<td>${d.quantity}</td>
<td>${d.static_count_fromsupplier}</td>
<td>${d.static_count_fromsupplier!=0 ? balance_qty : d.static_count_fromsupplier }</td>
<td>${d.batch_no}</td>
<td>${d.invoice_no}</td>
<td>${d.Invoice_manual}</td>
</tr>`;
                                    });
                                    $('#supplierdetailsproductsearch').html(html);
                                }

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });






    }); */




}); //End of script 
