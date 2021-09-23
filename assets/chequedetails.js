$(document).ready(function(){

const base_url = $('#base_url').val();


function getfulldate() {
    var today = new Date();

    let date =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        today.getDate();
    var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = "0" + month;
    if (day.length < 2) day = "0" + day;

    let mydate = [year, month, day].join("-");

    return mydate;
}



    $("#searchexpensesType").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#expensesType tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#search_check_details_byadmin").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#displaychequedetailsfromadmin tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

 
    






const bringcheckdetailstofront = () => {

        let count = 0;
    let html = null;

                        $.ajax({
                            url: base_url + 'Controllerunit/bringcheckdetailstofront',
                            method: 'POST',
                            data:{

                            },
                            success: function (data) {
                               let getData = JSON.parse(data);
                                console.clear();
                                console.log(getData);
                                if(getData==0){
                                    $('#display_check_details_for_customers').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                                }
                                else {
                                    getData.map(d => {
                                         html+=`<tr class="text text-center">
<td>${d.customer_name==null ? 'Walking customer' : d.customer_name}</td>
<td>${d.customer_mobile==null ? 'Walking customer' : d.customer_mobile}</td>

<td>
${d.summery_id}
</td>
<td>
<button class='check_details_view btn btn-link' paying_method_cheque_id='${d.paying_method_cheque_id}'>
<i class='fa fa-eye'></i> VIEW
</button>
</td>
<td>
${d.account_no}
</td>
<td>
${parseFloat(d.sales_credit_amount).toFixed(2)}
</td>
<td>
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle btn-sm status_section_for_chque" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item select_pending" href="#" attribute='Pending' paying_method_cheque_id='${d.paying_method_cheque_id}'>Pending</a>
    <a class="dropdown-item select_pass" href="#" attribute='Pass' paying_method_cheque_id='${d.paying_method_cheque_id}'>Pass</a>
    <a class="dropdown-item select_returned" href="#" attribute='Returned' paying_method_cheque_id='${d.paying_method_cheque_id}'>Returned</a>
    <a class="dropdown-item select_postponed" href="#" attribute='Postponed' paying_method_cheque_id='${d.paying_method_cheque_id}'>Postponed</a>
  </div>
</div>

</td>

</tr>`;
  });
                                    $('#display_check_details_for_customers').html(html);
                                }
                            },
                            error: function (err) {
                                 console.error('Bring check details front error found',err);
                            }
                        });


}


bringcheckdetailstofront();




    $('body').delegate('.select_postponed','click',function(){
        const status = 'Postponed';

           let paying_method_cheque_id = parseInt($(this).attr('paying_method_cheque_id'));


                    $.ajax({
                            url: base_url + 'Controllerunit/select_postponed',
                            method: 'POST',
                            data:{
                                status:status,
                                paying_method_cheque_id:paying_method_cheque_id
                            },
                            success: function (data) {
                               alert('Updated successfully');
                                window.location.reload();

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });







    $('body').delegate('.select_returned','click',function(){
        const status = 'Returned';

           let paying_method_cheque_id = parseInt($(this).attr('paying_method_cheque_id'));


                    $.ajax({
                            url: base_url + 'Controllerunit/select_returned',
                            method: 'POST',
                            data:{
                                status:status,
                                paying_method_cheque_id:paying_method_cheque_id
                            },
                            success: function (data) {
                               alert('Updated successfully');
                                window.location.reload();

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });




    $('body').delegate('.select_pass','click',function(){
        const status = 'Pass';

           let paying_method_cheque_id = parseInt($(this).attr('paying_method_cheque_id'));


                    $.ajax({
                            url: base_url + 'Controllerunit/select_option_pass',
                            method: 'POST',
                            data:{
                                status:status,
                                paying_method_cheque_id:paying_method_cheque_id
                            },
                            success: function (data) {
                               alert('Updated successfully');
                                window.location.reload();

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });



    $('body').delegate('.select_pending','click',function(){
        const status = 'Pending';

        let paying_method_cheque_id = parseInt($(this).attr('paying_method_cheque_id'));

                    $.ajax({
                            url: base_url + 'Controllerunit/select_pending_save',
                            method: 'POST',
                            data:{
                                status:status,
                                paying_method_cheque_id:paying_method_cheque_id
                            },
                            success: function (data) {
                               alert('Updated successfully');
                                window.location.reload();

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });


    });




    $('body').delegate('.check_details_view','click',function(){
        $('#check_details_modal').modal('show');

        let html = null;
        let count = 0;

        let paying_method_cheque_id = parseInt($(this).attr('paying_method_cheque_id'));
        paying_method_cheque_id = Number(paying_method_cheque_id);

                         $.ajax({
                            url: base_url + 'Controllerunit/check_details_view',
                            method: 'POST',
                            data:{
                                paying_method_cheque_id:paying_method_cheque_id

                            },
                            success: function (data) {
                                let getData = JSON.parse(data);
                                 if(getData=='0'){
                                     $('#check_details_display_section').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                                 }
                                else {
                                    getData.map(d => {

          html+=`<tr>
<td>${d.bank_name}</td>
<td>${d.branch_name}</td>
<td>${d.cheque_date}</td>

<td>
${d.account_no}
</td>


<td>
<span class='badge badge-info'>${d.cheque_status}</span>
</td>
</tr>`;



                                    });

                                    $('#check_details_display_section').html(html);
                                }

                            },
                            error: function (err) {
                                alert(err);
                            }
                        });




    });





    $("#search_check_details").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#display_check_details_for_customers tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });




    $('#search_cheqe_details_btn').click(function(){
        let from_date_check_cheque = $('#from_date_check_cheque').val();
        let to_date_check_cheque = $('#to_date_check_cheque').val();

        let check_details_status = $('#check_details_status').val();


          let count = 0;
        let html = null;

                        $.ajax({
                            url: base_url + 'Controllerunit/geallbydateforcheckdetails',
                            method: 'POST',
                            data:{
                                from_date_check_cheque:from_date_check_cheque,
                                to_date_check_cheque:to_date_check_cheque,
                                check_details_status:check_details_status
                            },
                            success: function (data) {
                               let getData = JSON.parse(data);
                                console.log(getData);
                                if(getData==0){
                                    $('#display_check_details_for_customers').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                                }
                                else {
                                    getData.map(d => {

                                        html+=`<tr class="text text-center">
<td>${d.customer_name}</td>
<td>${d.customer_mobile}</td>

<td>
${d.summery_id}
</td>
<td>
<button class='check_details_view btn btn-link' paying_method_cheque_id='${d.paying_method_cheque_id}'>
<i class='fa fa-eye'></i> VIEW
</button>
</td>
<td>
${d.account_no}
</td>
<td>
${parseFloat(d.sales_credit_amount).toFixed(2)}
</td>
<td>
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle btn-sm status_section_for_chque" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item select_pending" href="#" attribute='Pending' paying_method_cheque_id='${d.paying_method_cheque_id}'>Pending</a>
    <a class="dropdown-item select_pass" href="#" attribute='Pass' paying_method_cheque_id='${d.paying_method_cheque_id}'>Pass</a>
    <a class="dropdown-item select_returned" href="#" attribute='Returned' paying_method_cheque_id='${d.paying_method_cheque_id}'>Returned</a>
    <a class="dropdown-item select_postponed" href="#" attribute='Postponed' paying_method_cheque_id='${d.paying_method_cheque_id}'>Postponed</a>
  </div>
</div>

</td>

</tr>`;
                                    });
                                    $('#display_check_details_for_customers').html(html);
                                }
                            },
                            error: function (err) {
                                 console.error('Bring check details front error found',err);
                            }
                        });





    });



    $('#bank_note').keyup(function(e){
        let value = e.target.value.length;
        if(value <=100){
                   $('#bank_note_count').html(value+'/100')

        }


    });



    $('#savebank_details_section').submit(function(e){
        e.preventDefault();

        let bank_details_name = $('#bank_details_name').val();
        let branch_name = $('#branch_name').val();
        let initial_amount = $('#initial_amount').val();
        let bank_note = $('#bank_note').val();

        let account_no = $('#account_no').val();



        if(bank_details_name==''){
            alert('Bank name is required');
            $('#bank_details_name').css('border','2px solid red');
            $('#bank_details_name').focus();
            return false;
        }

        if(branch_name==''){
            alert('Branch name is required');
            $('#branch_name').css('border','2px solid red');
            $('#branch_name').focus();
            return false;
        }

        if(isNaN(initial_amount)){
            alert('Only numbers are accepted');
            $('#initial_amount').css('border','2px solid red');
            $('#initial_amount').focus();
            return false;
        }

        if(initial_amount==''){
            alert('Initial amount is required');
            $('#initial_amount').css('border','2px solid red');
            $('#initial_amount').focus();
            return false;

        }

        if(account_no==''){
            alert('Account No is required');
            $('#account_no').focus();
            $('#account_no').css('border','2px solid red');
            return false;
        }


        if(bank_note==''){
            alert('Bank note is required');
            $('#bank_note').css('border','2px solid red');
            $('#bank_note').focus();
            return false;
        }

                   $.ajax({
                            url: base_url + 'Controllerunit/savebank_details_section',
                            method: 'POST',
                            data:{
                                bank_details_name:bank_details_name,
                                branch_name:branch_name,
                                initial_amount:initial_amount,
                                bank_note:bank_note,
                                account_no:account_no
                            },
                            success: function (data) {
                                alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });



    });


    $('.btnmakeprimary').click(function(e){

        let bank_details_id = parseInt($(this).attr('bank_details_id'));
        let status = 1;

                   if(confirm("Are you sure you want to change it?")){
                            $.ajax({
                            url: base_url + 'Controllerunit/makeprimaryaccount',
                            method: 'POST',
                            data:{
                               status:status,
                              bank_details_id:bank_details_id
                            },
                            success: function (data) {
                                alert('Primary bank details has been updated successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });
                   }


    });



    $('.add_cash_to_bank_account').click(function(e){
        let bank_details_id = parseInt($(this).attr('bank_details_id'));

        bank_details_id = Number(bank_details_id);

        let value = prompt("Type value ");

        if(value!=null){

                        $.ajax({
                            url: base_url + 'Controllerunit/add_cash_to_bank_account',
                            method: 'POST',
                            data:{
                               bank_details_id:bank_details_id,
                              value:value
                            },
                            success: function (data) {
                                alert('Added successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });






        }

    });


    $('.add_cash_to_bank_account_temp').click(function(){
        let bank_details_id = parseInt($(this).attr('bank_details_id')); 
        $('#banksubtractiondetailshandler').modal('show'); 
        sessionStorage.setItem('bank_details_id',bank_details_id); 
        sessionStorage.setItem('inital_amount',$(this).attr('initial_amount')); 
    }); 

    $('#subtract_amount_to_bankdetails').click(function(){

        let bank_id = parseInt(sessionStorage.getItem('bank_details_id')); 

        let bank_update_amount =$('#bank_update_amount').val(); 
        let bank_details_note = $('#bank_details_note').val(); 

        let currentAmount = parseFloat(sessionStorage.getItem('initial_amount')); 

        if(bank_update_amount==''){
            alert('Amount is required'); 
            $('#bank_update_amount').focus(); 
            return false; 
        }
        if(bank_details_note==''){
            alert('Note is required'); 
            $('#bank_update_amount').focus(); 
            return false; 
        }

        if(currentAmount==''){
            alert('Current amount is required'); 
            window.location.reload(); 
            return false; 
        }

        if(isNaN(bank_update_amount)){
            alert('Only numbers are accepted'); 
            $('#bank_update_amount').focus(); 
            $('#bank_update_amount').css('border','2px solid red'); 
            return false; 
        }
        bank_update_amount = parseFloat(bank_update_amount); 
      
        if(currentAmount > bank_update_amount){
            alert('Entered amount is greater than current amount in bank account. so it can not be subtracted'); 
            $('#bank_update_amount').focus(); 
            $('#bank_update_amount').css('border','2px solid red'); 
            return false; 
        }

        
        $.ajax({
            url: base_url + 'Controllerunit/subtractionsline_cash_to_bank_account_temp',
            method: 'POST',
            data:{
               bank_details_id:bank_id,
               bank_update_amount:bank_update_amount,
              fulldate : getfulldate(),
              bank_details_note:bank_details_note
            },
            success: function (data) {
             alert('Amount has been subtracted successfully');
             window.location.reload(); 
             
            },
            error: function (err) {
                alert(err); 
                 console.log('Error message',err);
            }
        });


    }); 
  
    $('#add_amount_to_bankdetails').click(function(){
        let bank_id = parseInt(sessionStorage.getItem('bank_details_id')); 

        let bank_update_amount =$('#bank_update_amount').val(); 
        let bank_details_note = $('#bank_details_note').val(); 

        let currentAmount = parseFloat(sessionStorage.getItem('initial_amount')); 

        if(bank_update_amount==''){
            alert('Amount is required'); 
            $('#bank_update_amount').focus(); 
            return false; 
        }
        if(bank_details_note==''){
            alert('Note is required'); 
            $('#bank_update_amount').focus(); 
            return false; 
        }

        if(currentAmount==''){
            alert('Current amount is required'); 
            window.location.reload(); 
            return false; 
        }

        if(isNaN(bank_update_amount)){
            alert('Only numbers are accepted'); 
            $('#bank_update_amount').focus(); 
            $('#bank_update_amount').css('border','2px solid red'); 
            return false; 
        }
      

        
        $.ajax({
            url: base_url + 'Controllerunit/add_cash_to_bank_account_temp',
            method: 'POST',
            data:{
               bank_details_id:bank_id,
               bank_update_amount:bank_update_amount,
              fulldate : getfulldate(),
              bank_details_note:bank_details_note
            },
            success: function (data) {
             alert('Amount has been added successfully');
             window.location.reload(); 
             
            },
            error: function (err) {
                alert(err); 
                 console.log('Error message',err);
            }
        });



        
    }); 



  $('.subtract_cash_to_bank_account').click(function(e){
        let bank_details_id = parseInt($(this).attr('bank_details_id'));

        bank_details_id = Number(bank_details_id);

        let value = prompt("Amount");
        let refrencno = prompt("Refrence NO"); 
        if(refrencno==null){
            alert('Refrence No is required'); 
            return false; 
        }

                    if(value!=null){

                        $.ajax({
                            url: base_url + 'Controllerunit/subtract_cash_to_bank_account',
                            method: 'POST',
                            data:{
                               bank_details_id:bank_details_id,
                              value:value,
                              refrencno:refrencno,
                              fulldate : getfulldate()
                            },
                            success: function (data) {
                                alert('Added successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });


        }

    });



    $('.btnmakenoneprimary').click(function(e){

        let bank_details_id = parseInt($(this).attr('bank_details_id'));
        let status = 0;

                   if(confirm("Are you sure you want to change it?")){

                            $.ajax({
                            url: base_url + 'Controllerunit/makenonprimaryforbankaccountdetails',
                            method: 'POST',
                            data:{
                               status:status,
                              bank_details_id:bank_details_id
                            },
                            success: function (data) {
                                alert('Bank account has been changed as "Non-primary" account');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });


                   }


    });




    $('.deletebankaccountdetails').click(function(e){
        let deleteaccountid = $(this).attr('deleteaccountid');

        if(deleteaccountid==''){
            alert('Id is required');
            return false;
        }


        if(confirm("Are you sure you want to delete it?")){

                  $.ajax({
                            url: base_url + 'Controllerunit/deletebankaccountdetails',
                            method: 'POST',
                            data:{
                               deleteaccountid:deleteaccountid
                            },
                            success: function (data) {
                                alert('Deleted successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });

        }



    });


    $('#frmexpensesType').submit(function(e){
        e.preventDefault();

        let expensesName = $('#expensesName').val();

        if(expensesName==''){
            alert('Expense name is required');
            $('#expensesName').css('border','2px solid red');
            $('#expensesName').focus();
            return false;
        }


                     $.ajax({
                            url: base_url + 'Controllerunit/frmexpensesType_save',
                            method: 'POST',
                            data:{
                               expensesName:expensesName
                            },
                            success: function (data) {
                                alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });





    })



    $('.deleteexpenses_details').click(function(){
        let expenseId = parseInt($(this).attr('expenseId'));
        expenseId = Number(expenseId);


        if(confirm("Are you sure you want to delete it?")){

                        $.ajax({
                            url: base_url + 'Controllerunit/deleteexpensedetailsection',
                            method: 'POST',
                            data:{
                               expenseId:expenseId
                            },
                            success: function (data) {

                                alert('Deleted successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });

        }



    });



    $('.enable_for_outlet').click(function(e){
        let expenseId = parseInt($(this).attr('expenseId'));
        expenseId = Number(expenseId);


        if(expenseId==''){
        alert('Id is required');
            window.location.reload();
        }


                        $.ajax({
                            url: base_url + 'Controllerunit/enable_for_outlet_toexpenses',
                            method: 'POST',
                            data:{
                               expenseId:expenseId
                            },
                            success: function (data) {

                                alert('Enabled for branch successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });





    });


 $('.disable_for_outlet').click(function(e){
        let expenseId = parseInt($(this).attr('expenseId'));
        expenseId = Number(expenseId);


        if(expenseId==''){
        alert('Id is required');
            window.location.reload();
        }


                        $.ajax({
                            url: base_url + 'Controllerunit/disable_for_outlet_for_expense',
                            method: 'POST',
                            data:{
                               expenseId:expenseId
                            },
                            success: function (data) {

                                alert('Disabled for branch successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });





    });




    $('.editexpenses_details').click(function(e){

    let expenseId= parseInt($(this).attr('expenseId'));


        let value = prompt("Enter the value to update");
        if(value!=null){


                        $.ajax({
                            url: base_url + 'Controllerunit/editexpenses_details',
                            method: 'POST',
                            data:{
                               expenseId:expenseId,
                                value:value
                            },
                            success: function (data) {

                                alert('Updated successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });




        }


    });


    const expenseListforsaveing = () => {

            let count = 0;
        let html = null;
        let totalexpensesAmount = 0.00;

                        $.ajax({
                            url: base_url + 'Controllerunit/showexpensesList',
                            method: 'POST',
                            success: function (data) {
                               let getData = JSON.parse(data);
                               if(getData=='0'){
                                $("#expensesListsection").html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                                     $('#total_expenses_list').html('Rs.'+totalexpensesAmount.toFixed(2));
                               }
                                else {
                                    getData.map(d => {
                                        totalexpensesAmount+=parseFloat(d.expense_amount);
                                        html+=`<tr class="text text-center">
<td>${++count}</td>
<td>${d.expense_name}</td>
<td>${d.expense_date}</td>
<td>${parseFloat(d.expense_amount).toFixed(2)}</td>
<td>${d.expense_note}</td>
<td>
<button class="btn btn-info btn-sm edit_expense_details" expense_note='${d.expense_note}' expense_amount='${d.expense_amount}' expense_date='${d.expense_date}' expense_name='${d.expense_type}' expenses_list_id='${d.expenses_list_id}'><i class="fa fa-edit"></i></button>
<button class="btn btn-danger btn-sm delete_expense_details" expenses_list_id='${d.expenses_list_id}'>
<i class="fa fa-trash" aria-hidden='true'></i>
</button>
</td>
</tr>`;
                                    });
                                    $('#expensesListsection').html(html);
                                    $('#total_expenses_list').html('Rs.'+totalexpensesAmount.toFixed(2));
                                }


                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });

    }

expenseListforsaveing();


    $('body').delegate('.edit_expense_details','click',function(){
        let expense_note = $(this).attr('expense_note');
        let expense_amount = $(this).attr('expense_amount');
        let expense_date = $(this).attr('expense_date');
        let expense_name = $(this).attr('expense_name');
        let expenses_list_id =$(this).attr('expenses_list_id');

        $('#hidden_id_for_update').val(expenses_list_id);

        $('#uexpense_type').val(expense_name);
        $('#uexpense_date').val(expense_date);
        $('#uexpense_amount').val(expense_amount);
        $("#uexpense_note_for_list_out").val(expense_note);

        $('#update_expense_list_modal').modal('show');

    });


   $('body').delegate('.delete_expense_details','click',function(){
       let expenses_list_id =parseInt($(this).attr('expenses_list_id'));
       expenses_list_id = Number(expenses_list_id);

        if(confirm("Are you sure you want to delete it?")){

                        $.ajax({
                            url: base_url + 'Controllerunit/delete_expense_details',
                            method: 'POST',
                            data:{
                               expenses_list_id:expenses_list_id,
                            },
                            success: function (data) {

                                alert('Deleted successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });

       }


   });

    $('#save_expneses_details_manually').submit(function(e){
        e.preventDefault();


        let expense_type = $('#expense_type').val();

        let expense_date =$('#expense_date').val();

        let expense_amount =$('#expense_amount').val();

        let expense_note = $('#expense_note_for_list_out').val();



        if(isNaN(expense_amount)){
            alert('Only numbers are accepted');
            $('#expense_amount').focus();
            $('#expense_amount').css('border','2px solid red');
            return false;
        }

        if(expense_date==''){
            alert('Expense date is required');
            $('#expense_date').focus();
            $('#expense_date').css('border','2px solid red');
            return false;
        }

        if(expense_amount==''){
            alert('Expense amount is required');
            $('#expense_amount').focus();
            $("#expense_amount").css('border','2px solid red');
            return false;
        }




                        $.ajax({
                            url: base_url + 'Controllerunit/save_expneses_details_manually',
                            method: 'POST',
                            data:{
                               expense_type:expense_type,
                                expense_date:expense_date,
                                expense_amount:expense_amount,
                                expense_note:expense_note,
                                hidden_id_for_update:$('#hidden_id_for_update').val()
                            },
                            success: function (data) {
                                alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });




    });




    $('#update_expense_details_manually').submit(function(e){
        e.preventDefault();

                        $.ajax({
                            url: base_url + 'Controllerunit/update_expense_details_manually',
                            method: 'POST',
                            data:{
                               uexpense_type:$('#uexpense_type').val(),
                                uexpense_date:$('#uexpense_date').val(),
                                uexpense_amount:$('#uexpense_amount').val(),
                                uexpense_note_for_list_out:$('#uexpense_note_for_list_out').val(),
                                hidden_id_for_update:$('#hidden_id_for_update').val()
                            },
                            success: function (data) {
                                alert('updated successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });

    });



    $('#search_expenses_list_btn_for_list').click(function(e){
        let from_date_to_check_expenses = $('#from_date_to_check_expenses').val();


        let to_date_to_check_expenses = $('#to_date_to_check_expenses').val();

        let html = null;
        let count = 0;

        let totalexpenseamount = 0;


                            $.ajax({
                            url: base_url + 'Controllerunit/search_expenses_list_btn_for_list',
                            method: 'POST',
                            data:{
                               from_date_to_check_expenses:from_date_to_check_expenses,
                                to_date_to_check_expenses:to_date_to_check_expenses,
                            },
                            success: function (data) {

                                       let getData = JSON.parse(data);
                               if(getData=='0'){
                                $("#expensesListsection").html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                                    $('#total_expenses_list').html('Rs.'+totalexpenseamount.toFixed(2));
                               }
                                else {
                                    getData.map(d => {
                                        totalexpenseamount+=parseFloat(d.expense_amount);
                                        html+=`<tr class="text text-center">
<td>${++count}</td>
<td>${d.expense_name}</td>
<td>${d.expense_date}</td>
<td>${parseFloat(d.expense_amount).toFixed(2)}</td>
<td>${d.expense_note}</td>
<td>
<button class="btn btn-info btn-sm edit_expense_details" expense_note='${d.expense_note}' expense_amount='${d.expense_amount}' expense_date='${d.expense_date}' expense_name='${d.expense_type}' expenses_list_id='${d.expenses_list_id}'><i class="fa fa-edit"></i></button>
<button class="btn btn-danger btn-sm delete_expense_details" expenses_list_id='${d.expenses_list_id}'>
<i class="fa fa-trash" aria-hidden='true'></i>
</button>
</td>
</tr>`;
                                    });
                                    $('#expensesListsection').html(html);
                                    $('#total_expenses_list').html('Rs.'+totalexpenseamount.toFixed(2));
                                }
 
                            },
                            error: function (err) {
                                 console.log('Error message',err);
                            }
                        });
 
    });




      $('#frmchecksection').submit(function (e) {
        e.preventDefault();
        let cheque_no = $('#cheque_no').val();
        let cheqe_date = $("#cheqe_date").val();
        let bank_name = $("#bank_name").val();
        let amount = $('#amount').val();

        if (isNaN(cheque_no)) {
            alert('Only numbers are allowed for cheque no');
            return false;
        }

        if (isNaN(amount)) {
            alert('Only numbers are allowed for amount section');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/savechequedetails',
            method: 'POST',
            data: {
                cheque_no: cheque_no,
                cheqe_date: cheqe_date,
                bank_name: bank_name,
                amount: amount
            },
            success: function (data) {
                alert('Data has been saved successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });




    $('#search_cheqe_details_btn_by_admin').click(function(){
        let from_date_check_cheque = $('#from_date_check_cheque').val();
        let to_date_check_cheque = $('#to_date_check_cheque').val();

        let check_details_status = $("#check_details_status").val();

        if(from_date_check_cheque==''){
            alert('Please choose "From date"');
            return false;
        }


        if(to_date_check_cheque==''){
            alert("Please choose 'To date'");
            return false;
        }



        if(check_details_status==''){
            alert('Please choose "Status"');
            return false;
        }

        let statuschecker = ''; 

        let total_pending_amount = 0; 
        let total_bounced_amount = 0; 
        let total_completed_amount = 0; 

       


               $.ajax({
            url: base_url + 'Controllerunit/showoffallchequedetailsbyadminsearch',
            method: 'POST',
                   data:{
                       from_date_check_cheque:from_date_check_cheque,
                       to_date_check_cheque:to_date_check_cheque,
                       check_details_status:check_details_status
                   },
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData==0){
                    $('#displaychequedetailsfromadmin').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                }
                else{
                getData.map(d => {
                    if(d.cheque_status=='Pending'){
                        statuschecker ='<span class="text text-warning font-weight-bold">Pending</span>'; 
                        total_pending_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }
                    else if(d.cheque_status=='bounce'){
                        statuschecker ='<span class="text text-danger font-weight-bold">Bounced</span>'; 
                        total_bounced_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }
                    else {
                        statuschecker = '<span class="text text-success font-weight-bold">Completed</span>'; 
                        total_completed_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }

                    html+=`<tr class="text text-center">
<td>${d.bank_name}</td>
<td>${d.branch_name}</td>
<td>${d.cheque_no}</td>
<td>${d.cheque_amount}</td>
<td>${d.cheque_date}</td>
 <td>${statuschecker}</td>
<td>${d.customer_name}</td>
<td>
<button class="btn btn-danger btn-sm removechequedetailsbyadmin" chequesbyadmin_id='${d.chequesbyadmin_id}'><i class="fa fa-trash" aria-hidden='true'></i></button>&nbsp;
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle btn-sm status_section_for_chque" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(11px, 32px, 0px);">
    <a class="dropdown-item select_pending_by_admin" href="#" attribute="Pending" paying_method_cheque_id="${d.chequesbyadmin_id}">Pending</a>
    <a class="dropdown-item select_pass_by_admin" href="#" attribute="bounce" paying_method_cheque_id="${d.chequesbyadmin_id}">Pass</a>
    <a class="dropdown-item select_postponed_by_admin" href="#" attribute="completed" paying_method_cheque_id="${d.chequesbyadmin_id}">Completed</a>
  </div>
</div>
</td>
</tr>`;
                });
                    $('#displaychequedetailsfromadmin').html(html);
                    $("#total_pending_checks").html('Rs.'+parseFloat(total_pending_amount).toFixed(2)); 
                    $('#total_bounced_checks').html('Rs.'+parseFloat(total_bounced_amount).toFixed(2)); 
                    $('#total_completed_checks').html('Rs.'+parseFloat(total_completed_amount).toFixed(2)); 

                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

 
    });





    const showoffallchequedetailsbyadmin = () => {
        let html = null;

        let total_pending_amount = 0; 
        let total_bounced_amount = 0; 
        let total_completed_amount = 0; 

        let statuschecker = ''; 

              $.ajax({
            url: base_url + 'Controllerunit/showoffallchequedetailsbyadmin',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData==0){
                    $('#displaychequedetailsfromadmin').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
                }
                else{
                getData.map(d => {
                    if(d.cheque_status=='Pending'){
                        statuschecker ='<span class="text text-warning font-weight-bold">Pending</span>'; 
                        total_pending_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }
                    else if(d.cheque_status=='bounce'){
                        statuschecker ='<span class="text text-danger font-weight-bold">Bounced</span>'; 
                        total_bounced_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }
                    else {
                        statuschecker = '<span class="text text-success font-weight-bold">Completed</span>'; 
                        total_completed_amount+=parseFloat(d.cheque_amount).toFixed(2); 
                    }

                    html+=`<tr class="text text-center">
<td>${d.bank_name}</td>
<td>${d.branch_name}</td>
<td>${d.cheque_no}</td>
<td>${d.cheque_amount}</td>
<td>${d.cheque_date}</td>
 <td>${statuschecker}</td>
<td>${d.customer_name}</td>
<td>
<button class="btn btn-danger btn-sm removechequedetailsbyadmin" chequesbyadmin_id='${d.chequesbyadmin_id}'><i class="fa fa-trash" aria-hidden='true'></i></button>&nbsp;
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle btn-sm status_section_for_chque" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(11px, 32px, 0px);">
    <a class="dropdown-item select_pending_by_admin" href="#" attribute="Pending" paying_method_cheque_id="${d.chequesbyadmin_id}">Pending</a>
    <a class="dropdown-item select_pass_by_admin" href="#" attribute="bounce" paying_method_cheque_id="${d.chequesbyadmin_id}">bounced</a>
    <a class="dropdown-item select_postponed_by_admin" href="#" attribute="completed" paying_method_cheque_id="${d.chequesbyadmin_id}">Completed</a>
  </div>
</div>
</td>
</tr>`;
                });
                    $('#displaychequedetailsfromadmin').html(html);
                    $("#total_pending_checks").html('Rs.'+parseFloat(total_pending_amount).toFixed(2)); 
                    $('#total_bounced_checks').html('Rs.'+parseFloat(total_bounced_amount).toFixed(2)); 
                    $('#total_completed_checks').html('Rs.'+parseFloat(total_completed_amount).toFixed(2)); 

                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    }



$('body').delegate('.removechequedetailsbyadmin','click',function(){

    let paying_method_cheque_id  = parseInt($(this).attr('chequesbyadmin_id'));


         if(confirm("Are you sure you want to delete it?")){
               $.ajax({
            url: base_url + 'Controllerunit/removechequedetailsbyadmin',
            method: 'POST',
            data: {
                paying_method_cheque_id:paying_method_cheque_id,

            },
            success: function (data) {
                 alert('Data has been Deleted successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

         }


});




$('body').delegate('.select_pending_by_admin','click',function(){

    let paying_method_cheque_id  = parseInt($(this).attr('paying_method_cheque_id'));
    let attribute = $(this).attr('attribute');

           $.ajax({
            url: base_url + 'Controllerunit/select_pending_by_admin',
            method: 'POST',
            data: {
                paying_method_cheque_id:paying_method_cheque_id,
                attribute:attribute
            },
            success: function (data) {
                 alert('Data has been updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



});


    $('body').delegate('.select_postponed_by_admin','click',function(){

    let paying_method_cheque_id  = parseInt($(this).attr('paying_method_cheque_id'));
    let attribute = $(this).attr('attribute');

           $.ajax({
            url: base_url + 'Controllerunit/select_postponed_by_admin',
            method: 'POST',
            data: {
                paying_method_cheque_id:paying_method_cheque_id,
                attribute:attribute
            },
            success: function (data) {
                 alert('Data has been updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



});









$('body').delegate('.select_returned_by_admin','click',function(){

    let paying_method_cheque_id  = parseInt($(this).attr('paying_method_cheque_id'));
    let attribute = $(this).attr('attribute');

           $.ajax({
            url: base_url + 'Controllerunit/select_returned_by_admin',
            method: 'POST',
            data: {
                paying_method_cheque_id:paying_method_cheque_id,
                attribute:attribute
            },
            success: function (data) {
                 alert('Data has been updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



});












$('body').delegate('.select_pass_by_admin','click',function(){

    let paying_method_cheque_id  = parseInt($(this).attr('paying_method_cheque_id'));
    let attribute = $(this).attr('attribute');

           $.ajax({
            url: base_url + 'Controllerunit/select_pass_by_admin',
            method: 'POST',
            data: {
                paying_method_cheque_id:paying_method_cheque_id,
                attribute:attribute
            },
            success: function (data) {
                 alert('Data has been updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



});










showoffallchequedetailsbyadmin();


    $('#savechequedetailsbyadmin').submit(function(e){
        e.preventDefault();

             $.ajax({
            url: base_url + 'Controllerunit/savechequesbyadmin',
            method: 'POST',
            data: {
                cheque_no: $('#cheque_no').val(),
                cheqe_date: $('#cheqe_date').val(),
                bank_name: $('#bank_name').val(),
                branch_name : $('#branch_name').val(),
                customer_name : $("#customer_name").val(),
                amount : $('#amount').val(),
                cheque_status_details:$('#cheque_status_details').val(), 
              
            },
            success: function (data) {

                alert('Data has been saved successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });


    
function account_no_section_ledger(fromdate = null, todate = null){

    let html = null; 
    let count = 0; 

    let cashin = 0; 
    let cashout = 0; 

    $.ajax({
        url: base_url + 'Controllerunit/account_no_section_ledger',
        method: 'POST',
        data:{
            fromdate:fromdate,
            todate:todate
        }, 
         success: function (data) {
           let getData = JSON.parse(data); 
           if(getData==0){
               $('#account_no_section_ledger').html('<span class="text text-danger font-weight-bold">NO DATA FOUND</span>');
               $('#cashinsection').html('Rs.00.00'); 
               $('#cashoutsection').html('Rs.00.00');
               return false; 
            
           }
           else {
               console.log(getData);
                getData.map(d => {
                    if(d.typeledger=='Subtracted'){
                        cashout+=parseFloat(d.amountledger); 
                    }
                    else {
                        cashin+=parseFloat(d.amountledger); 
                    }

                    html+=`<tr class="text-center">
                    <td>${d.accountnoledgernumber}</td>
                    <td>${d.banknameledger}</td>
                    <td>${d.branchnameledger}</td>
                    <td>Rs.${parseFloat(d.amountledger).toFixed(2)}</td>
                    <td>${d.typeledger=="Subtracted" ? '<span class="badge badge-danger">Subtracted</span>' : '<span class="badge badge-success">Added</span>'}</td>
                    <td>${d.date}</td>
                    <td>${d.note}</td>
                    <td>${d.primary_account==1 ? '<span class="badge badge-success">Primary account</span>' : '<span class="badge badge-warning">Non-primary account</span>'}</td>
                    </tr>`;
                }); 
                $('#account_no_section_ledger').html(html);
                $('#cashinsection').html('Rs.'+parseFloat(cashin).toFixed(2)); 
                $('#cashoutsection').html('Rs.'+parseFloat(cashout).toFixed(2));
           }
        },
        error: function (err) {
            alert(err);
            console.log(err);
        }
    });


}

account_no_section_ledger();
  

$('#btnsearch_getresultfordate').click(function(){
    let from_date_cashflowledger = $('#from_date_cashflowledger').val(); 
    let to_date_cashflowledger= $('#to_date_cashflowledger').val(); 


    if(from_date_cashflowledger==''){
        alert('From date is required');
        return false; 
    }

    if(to_date_cashflowledger==''){
        alert('To date is required'); 
        return false; 
    }
    account_no_section_ledger(from_date_cashflowledger,to_date_cashflowledger);



}); 



}); //End of script
