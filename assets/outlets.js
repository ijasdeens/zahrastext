$(document).ready(function(){
    const base_url = $('#base_url').val();


       $("#search_outlets_bar").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showOffOutlets tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    
    $("#products_for_outlet_search_input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#outlets_productdetails tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



    $('.edit_content_for_outlet').click(function(){
      

        $("#outlet_name_update").val($(this).attr('outlet_name')); 
        $('#outlet_name_mobile_update').val($(this).attr('outlet_mobile')); 
        $('#outlet_address_for_update').val($(this).attr('outlet_address')); 

        sessionStorage.setItem('outlet_id_update',$(this).attr('outlet_id')); 
        $('#editcontent_for_outletsectionmodal').modal('show'); 
    }); 

    $('#frm_update_outlet_section').submit(function(e){
        let name = $('#outlet_name_update').val(); 
        let mobile = $('#outlet_name_mobile_update').val(); 
        let address = $('#outlet_address_for_update').val(); 

        if(name==''){
            alert('Name is required'); 
            return false; 
        }
        if(mobile==''){
            alert('Mobile number is required'); 
            return false; 
        }
        if(address==''){
            alert('Address is required'); 
            return false; 
        }

        
        $.ajax({
            url:base_url + 'Controllerunit/updateoutletsections',
            method:'POST',
            data:{
                name:name, 
                mobile:mobile, 
                address:address,
                id : Number(sessionStorage.getItem('outlet_id_update'))
            },
            success:function(data){
                 if(data==1){
                     alert('Updated successfully'); 
                     window.location.reload(); 
                 }
                 else {
                     alert(data); 
                 }
            },
            error:function(err){
                console.log('Error found',err);
            }
        });

       
    }); 




    $("#frmsaveOutlets").submit(function(event){
        event.preventDefault();

        let outlets_name = $('#outlets_name').val();
        let hot_mob_number = $('#hot_mob_number').val();
        let outlet_address = $('#outlet_address').val();


        if(outlets_name==""){
            alert('outlets name is required');
            return false;
        }

        if(hot_mob_number==""){
            alert('Outlet number is required');
            return false;
        }

        

      
        if(outlet_address==""){
            alert('Outlet address is required');
            return false;
        }


        $.ajax({
            url:base_url + 'Controllerunit/saveoutlets',
            method:'POST',
            data:{
                outlets_name:outlets_name,
                hot_mob_number:hot_mob_number,
                outlet_address:outlet_address
            },
            success:function(data){
                alert('Saved successfully');
                window.location.reload();
            },
            error:function(err){
                console.log('Error found',err);
            }
        }); 


    });


    $('.delete_outlet').click(function(){
        let value = parseInt($(this).attr('outlet_id'));
        sessionStorage.setItem('delte_outlet_id',value); 

        $('#password_verification_fordelete').modal('show'); 
        return false; 
        

    });

    $('#verify_outlets_form').submit(function(e){
        e.preventDefault(); 
        let password_to_delete = $('#password_to_delete').val(); 
        if(password_to_delete==''){
            alert('Please enter the password'); 
            return false; 
        }
        else {

            if(confirm("Are you sure you want to delete it?")){
                $.ajax({
                    url:base_url + 'Controllerunit/passwordverificationfordelete',
                    method:'POST',
                    data:{
                        password_to_delete:password_to_delete
                    },
                    success:function(data){
                        if(data==1){
                            let value = Number(sessionStorage.getItem('delte_outlet_id')); 
                            $.ajax({
                                url:base_url + 'Controllerunit/delete_outlet',
                                method:'POST',
                                data:{
                                    value:value
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
                        else {
                            alert('Password is incorrect. Please type correct password'); 
                            $('#password_to_delete').css('border','2px solid red'); 
                            $('#password_to_delete').focus(); 
                            return false; 
                        }
                    },
                    error:function(err){
                        console.log('Error found',err);
                    }
                })
            }




        }
    })

 
    $('#products_outlet_details').change(function(event){
        let value = Number(event.target.value); 

        let html = ''; 
        let count = 0;
         
        $.ajax({
            url:base_url + 'Controllerunit/products_outlet_detailsget',
            method:'POST',
            data:{
                value:value
            },
            success:function(data){
              let getData = JSON.parse(data); 
              if(getData==0){
                $('#outlets_productdetails').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
              } 
              else {
                getData.map(d => {
                    html+=`<tr class="text text-center">
                    <td>${++count}</td>
                    <td>${d.product_name}</td>
                    <td>${d.quantity}</td>
                    <td>${d.products_code}</td>
                    <td>${d.brands_name}</td>
                    <td>${d.categoris_name}</td>
                    <td>${d.sub_categoryname}</td>
                    <td>${d.mfd}</td>
                    <td>${d.exp}</td>
                    <td>${d.product_price}</td>
                    <td>${d.product_cost}</td>
                    <td>
                    <img src='${base_url}assets/img/uploaded_photos/${d.product_pic}' style="max-width:50px; max-height:50" class='img-fluid'/>
                    </td>
                    <td>
                    ${d.product_unit}
                    </td>
                    <td>
                    ${d.batch_no}
                    </td>
                    <td>
                    ${d.invoice_no}
                    </td>
                    <td>
                    ${d.additional_amount}
                    </td>
                    <td>
                    ${d.product_desc}
                    </td>
                    <td>
                    <button class="btn btn-danger btn-sm deleteproductsforoutlet" product_id='${d.product_id}'>Delete <i class="fa fa-trash" aria-hidden='true'></i></button>
                    </td>

                    </tr>`;
                }); 

                $('#outlets_productdetails').html(html);
              }
            },
            error:function(err){
                console.log('Error found',err);
            }
        })

        
    }); 


    $('body').delegate('.deleteproductsforoutlet','click',function(){
        let product_id = parseInt($(this).attr('product_id')); 

        if(confirm("Are you sure you want to delete it?")){
            $.ajax({
            url:base_url + 'Controllerunit/deleteproductsforoutlet',
            method:'POST',
            data:{
                product_id:product_id
            },
            success:function(data){
                if(data==1){
                    alert('Deleted successfully'); 
                    window.location.reload(); 
                }
            },
            error:function(err){
                console.log('Error found',err);
            }
        })

        }

    }); 



});
