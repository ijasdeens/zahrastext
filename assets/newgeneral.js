$(document).ready(function () {
    const base_url = $('#base_url').val();


       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


    alert('It works');

    const otherexpenses = (outletid = null, fromdate = null, todate = null) => {
        let expeneseAmount = 0;
        let reportscount = 0;


         $.ajax({
            url: base_url + 'Controllerunit/getotherxpenes',
            method: 'POST',
             data:{
                 outletid:outletid,
                 fromdate:fromdate,
                 todate:todate
             },
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData==0){

                }
                else {
                    getData.map(d => {
                        expeneseAmount+=parseFloat(d.amount);
                        reportscount+=1;
                    });
                }
                $('#expenses_report').html('Rs.'+(expeneseAmount.toFixed(2)));
                $('#expense_report_count').html(reportscount+' Report(s)');



             },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }



    const getoutletcredits = (outletid = null, fromdate = null, todate = null) => {

        let getTotalamount = 0;

         $.ajax({
            url: base_url + 'Controllerunit/getoutletcredits',
            method: 'POST',
            data:{
                myoutletid: outletid,
                fromdate: fromdate,
                todate:todate
            },
            success: function (data) {
                console.clear();
                let getData = JSON.parse(data);

                if(getData==0){
                    $('#credit_details_forprahraph').val(1);
                }
                else {
                    getData.map(d => {
                       getTotalamount+=parseFloat(d.total_amount);

                    });
                    $('#credit_details_forprahraph').val(getTotalamount);

                    drawChart();
                }

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }


    const takeProfitsandsalesdetails = (outletid = null, fromdate = null, todate = null) => {
        let discounted_amount = 0;
        let totalAmount = 0;
        let profitAmount =0;
        let reportscount = 0;
         let totalDueAmount = 0;
        let duereportcount = 0;

         otherexpenses(outletid,fromdate,todate);
        getoutletcredits(outletid,fromdate,todate);

        $.ajax({
            url: base_url + 'Controllerunit/takeProfitsandsalesdetails',
            method: 'POST',
            data:{
                myoutletid: outletid,
                fromdate: fromdate,
                todate:todate
            },
            success: function (data) {
                 otherexpenses(outletid,fromdate,todate);
        getoutletcredits(outletid,fromdate,todate);
                let getData =JSON.parse(data);
                if(getData==0){
                    $('#total_purcahse').html('RS.00.00');
                    $('#total_profits_amount').html('RS.00.00');
                }
                else {
                     getData.map(d => {
                      reportscount+=1;
                      discounted_amount += parseFloat(d.discounted_amount.split('.')[1]);
                      totalAmount += parseFloat(d.total_amount);
                     if(d.sales_credit_amount==null){
                          $('#purchase_due_amount').html('Rs.00.00');
                     }
                     else {
                        totalDueAmount+=parseFloat(d.sales_credit_amount);
                         duereportcount++;
                     }
                 });
                }

                profitAmount = (totalAmount - discounted_amount);
                 $('#total_purcahse').html('Rs.'+(totalAmount.toFixed(2)));
                     $('#total_profits_amount').html('Rs.'+(profitAmount.toFixed(2)))
                $('#total_purcahse_report_count').html(`${reportscount} Report(s)`);
                $('#total_profits_report').html(`${reportscount} Report(s)`);
                 $('#purchase_due_amount').html('RS.'+(totalDueAmount.toFixed(2)));
                $('#purcahse_due_amount_report').html(duereportcount+' Report(s)');

                $('#total_purchase_forgraph').val(totalAmount);
                $('#total_profits_forgraph').val(profitAmount);

                drawChart();

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

    takeProfitsandsalesdetails();



    const sales_report_product = () => {
        let count = 0;
        let html = '';
          $.ajax({
            url: base_url + 'Controllerunit/sales_report_product',
            method: 'POST',
            success: function (data) {
              let getData = JSON.parse(data);
                if(getData=='0'){
                 $('#sales_report_product').html('<tr><td><span class="text text-danger font-weight-bold">No data found</span></td></tr>');
                    return false;
                }
                else {
                    getData.map(d => {
                    let totalAmount = parseFloat(d.total_amount);
                    let discounted_amount = parseFloat(d.discounted_amount.split('.')[1]);


                    let recievedAmount = (totalAmount - discounted_amount);
                        ++count;
                     html+=`<tr class='text text-center'>
<td>${count}</td>
<td>
<button class='btn btn-link showproductdetails' outlet_id='${d.outlet_id}' invoice_no='${d.invoice_no}' order_summery_id ="${d.order_summery_id }">Click</button>
</td>
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
                }



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

sales_report_product();
    const getCurrentDate = () => {
            var today = new Date();

        let date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        let mydate = [year, month, day].join('-');

        let fulltime = new Date().toLocaleTimeString();
        return mydate + ' ' + fulltime;
    }









    const listallchecksection = () => {
        let count = 0;
        let html = '';

        let pendingamount = 0
        let passamount = 0;
        let returnamount = 0;

        $.ajax({
            url: base_url + 'Controllerunit/listallchecksection',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    html += `<tr></tr>`;
                } else {
                    getData.map(d => {
                        if (d.status == 'Return') {
                            returnamount += parseFloat(d.amount);
                        }
                        if (d.status == 'Pending') {
                            pendingamount += parseFloat(d.amount);
                        }
                        if (d.status == 'Pass') {
                            passamount += parseFloat(d.amount);
                        }


                        count++;
                        html += `<tr class="text text-center">
<td>${count}</td>
<td>${d.cheque_no}</td>
<td>${d.cheque_date}</td>
<td>${d.bank_name}</td>

<td>${d.amount}</td>
<td>${d.status}</td>
<td>
<div class="d-flex flex-row">
<div class="p-1">
<button class="btn btn-outline-info btn-sm makestatus" cheque_details_id="${d.cheque_details_id}">Status</button>
</div>
<div class="p-1">
<button class="btn btn-outline-danger btn-sm" cheque_details_id="${d.cheque_details_id}">Delete</button>
</div>

</div>
</td>
</tr>`;
                    });

                    $('#cheque_details_display').html(html);
                    $("#Pendingpayment").html('Pending Payment : Rs.' + pendingamount);
                    $("#Passpayment").html('Pass Payment : Rs.' + passamount);
                    $("#returnpayment").html('Return Payment : Rs.' + returnamount);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

    listallchecksection();

    $('body').delegate('.makestatus', 'click', function () {
        let cheque_details_id = parseInt($(this).attr('cheque_details_id'));
        $('#hidden_id').val(cheque_details_id);


        $('#chequegivenModal').modal('show');
    });


    $('#frmBankDetails_section').submit(function (e) {
        e.preventDefault();

        let account_no = $("#account_no").val();
        let bank_name = $('#bank_name').val();
        let branch_name = $("#branch_name").val();
        let initial_amount = $('#initial_amount').val();
        let Note = $('#Note').val();


        $.ajax({
            url: base_url + 'Controllerunit/frmBankDetails_section',
            method: 'POST',
            data: {
                account_no: account_no,
                bank_name: bank_name,
                branch_name: branch_name,
                initial_amount: initial_amount,
                Note: Note
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


    $('#mainlogoutbtn').click(function () {

        $.ajax({
            url: base_url + 'Controllerunit/mainlogout',
            method: 'POST',
            success: function (data) {

                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    $('.deleteaccountdetailss', 'click', function () {
        let deleteaccountid = parseInt($(this).attr('deleteaccountid'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Controllerunit/deleteaccountdetailss',
                method: 'POST',
                data: {
                    deleteaccountid: deleteaccountid
                },
                success: function (data) {
                    alert('It has been deleted successfully');
                    window.location.reload();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

         }
    });


    $('#givendetalsfrm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'Controllerunit/givendetalsfrm',
            method: 'POST',
            data: {
                hidden_id: $('#hidden_id').val(),
                cheque_status: $('#cheque_status').val(),
                suppliers_details: $('#suppliers_details').val(),
                crrentTImedate: getCurrentDate()
            },
            success: function (data) {
                console.log(data);
                alert('Data has been updated successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
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



    $('#update_all_details').click(function () {
        let company_name = $('#company_name').val();
        let commpan_general_hot_number = $("#commpan_general_hot_number").val();
        let owner_name = $('#owner_name').val();


        if (company_name == "") {
            alert('Company name is required');
            return false;
        }

        if (commpan_general_hot_number == "") {
            alert('Hot number is required');
            return false;
        }

        if (owner_name == "") {
            alert('Owner name is required');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/update_all_details_general',
            method: 'POST',
            data: {
                company_name: company_name,
                commpan_general_hot_number: commpan_general_hot_number,
                owner_name: owner_name
            },
            success: function (data) {
                alert('Data has been done successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });






    });



    const showAdmindetails = () => {


        $.ajax({
            url: base_url + 'Controllerunit/showAdmindetails',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                getData.map(d => {
                    $('.admin_name').html(d.admin_name);
                    $('.admin_email').html(d.admin_gmail);
                });
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }

    showAdmindetails();
    const checkAvailableproducts = () => {

        let html = '';
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/checkavailableproductscount',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);

                if (getData == "0") {
                    $('#print_dec_qty_pr').html('<span class="text text-danger">No product avialble</span>');
                } else {
                    getData.map(d => {
                        if (d.quantity <= d.alert_quantity) {

                            count++;
                            html = `<a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    ${d.product_pic.substr(0,4)=='http' ? `<img src="${d.product_pic}" alt="image" class="img-sm profile-pic">` : `<img src="${base_url}assets/img/uploaded_photos/${d.product_pic}" alt="image" class="img-sm profile-pic">`}
                    </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">${d.product_name} </p>
                    <p class="font-weight-light small-text text text-danger font-weight-bold">current quantity : ${d.quantity} </p>
                  </div>
                </a>`;
                            $("#print_dec_qty_pr_section").append(html);

                        } else {
                            html = '';
                            html = `<span class="text text-danger font-weight-bold">No data found.</span>`;
                            $('#ranoutproductcount').html(0);
                        }
                    });
                    console.log(html);

                    $('#ranoutproductcount').html(count);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }


    checkAvailableproducts();



    $("#frmProfile").submit(function (event) {
        event.preventDefault();
        let admin_name = $('#admin_name').val();
        let admin_tel = $('#admin_tel').val();
        let admin_email = $("#admin_email").val();


        if (admin_name == "") {
            alert('Admin name is required');
            return false;
        }
        if (admin_tel == "") {
            alert('Admin telephone is required');
            return false;
        }

        if (isNaN(admin_tel)) {
            alert('Only numbers are allowed');
            return false;
        }

        if (admin_tel.length != 10) {
            alert('Mobile number must be 10 digits');
            return false;
        }



        $.ajax({
            url: base_url + 'Controllerunit/saveadmindetails',
            method: 'POST',
            data: {
                admin_name: admin_name,
                admin_mobile: admin_tel,
                admin_gmail: admin_email
            },
            success: function (data) {
                alert("Saved successfully");
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });


    $('#frmchangepassword').submit(function (event) {
        event.preventDefault();

        let current_password = $('#current_password').val();
        let newPassword = $('#newPassword').val();

        $.ajax({
            url: base_url + 'Controllerunit/changepassword',
            method: 'POST',
            data: {
                current_password: current_password,
                newPassword: newPassword,
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    alert("Old password is incorrect");
                    return false;
                } else {
                    alert('Password has been changed successfully');
                    window.location.reload();
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });


    $('#frmprofilesection').submit(function (event) {
        event.preventDefault();
        let person_name = $('#person_name').val();
        let person_tel = $('#person_tel').val();

        if (person_name == "") {
            alert('Person name is required');
            return false;
        }
        if (person_tel == "") {
            alert('Person mobile number is reqired');
            return false;
        }
        if (isNaN(person_tel)) {
            alert('Only numbers are allowed');
            return false;
        }

        if (person_tel.length != 10) {
            alert('Mobile number must be 10 digits');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/personchangeprofile',
            method: 'POST',
            data: {
                person_name: person_name,
                person_tel: person_tel,
            },
            success: function (data) {
                alert('Changed successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });

    $('#frmchangepassword').submit(function (event) {
        event.preventDefault();

        let current_password = $('#current_password').val();
        let new_password = $('#new_password').val();

        if (current_password == "") {
            alert('Old password is required');
            return false;
        }

        if (new_password == "") {
            alert('New password is required');
            return false;
        }



        $.ajax({
            url: base_url + 'Controllerunit/changepasswordforstaff',
            method: 'POST',
            data: {
                current_password: current_password,
                new_password: new_password,
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    alert('Old password is wrong');
                    return false;
                } else {
                    alert('Password has been changed successfully');
                    window.location.reload();
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });



    $('#signoutsection').click(function () {
        if (confirm("Are you sure you want to sign out?")) {

            $.ajax({
                url: base_url + 'Controllerunit/signoutstaff',
                method: 'POST',
                success: function (data) {
                    window.location.reload();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });



        }
    });


    $('.removeproductsall').click(function () {
        let products_id = parseInt($(this).attr('products_id'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Controllerunit/removeproductsall',
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


    $(".refillupdateproducts").click(function () {

        $("#fill_modal").modal('show');
        $("#hidden_id").val($(this).attr('products_id'));
        $("#current_qty_for_refill").val($(this).attr('currentqty'));
    });


    $('#frmrefill').submit(function (e) {
        e.preventDefault();
        let refill_quantity = parseInt($("#refill_quantity").val());
        let product_id = parseInt($('#hidden_id').val());
        let currentqty = parseInt($('#current_qty_for_refill').val());


        refill_quantity = refill_quantity + currentqty;

        $.ajax({
            url: base_url + 'Controllerunit/refillquantity',
            method: 'POST',
            data: {
                product_id: product_id,
                refill_quantity: refill_quantity
            },
            success: function (data) {

                alert('Deleted successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });


    $("#frmexpensesType").submit(function (event) {
        event.preventDefault();

        let expensesName = $("#expensesName").val();

        if (expensesName == "") {
            alert('Expenses name is required');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/expensesType',
            method: 'POST',
            data: {
                expensesName: expensesName,
            },
            success: function (data) {
                alert('Saved successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });


    $('.deleteexpenses').click(function () {
        let expenseId = parseInt($(this).attr('expenseId'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteexpenses',
                method: 'POST',
                data: {
                    expenseId: expenseId,
                },
                success: function (data) {
                    alert('Deleted successfuly');
                    window.location.reload();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }


    });

    $('.removelistexpense').click(function () {
        let exp_id = parseInt($(this).attr('exp_id'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/removelistexpense',
                method: 'POST',
                data: {
                    exp_id: exp_id,
                },
                success: function (data) {
                    alert('Deleted successfuly');
                    window.location.reload();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }


    });


    $('#frmaddexpenses').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'Controllerunit/saveexpensesList',
            method: 'POST',
            data: {
                expense_amout: $('#expense_amout').val(),
                date_of_expense: $('#date_of_expense').val(),
                expense_note: $('#expense_note').val(),
                expenses_type: $('#expenses_type').val()
            },
            success: function (data) {
                alert('Saved successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });



    $('#person_details').change(function (e) {
        e.preventDefault();
        let person_details = parseInt(e.target.value);

        let amount = 0;
        let status = '';

        $.ajax({
            url: base_url + 'Controllerunit/getindividulareport',
            method: 'POST',
            data: {
                person_details: person_details
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == '0') {
                    alert('No data found with this name');
                    return false;
                }

                getData.map(d => {
                    amount += parseFloat(d.amount);
                    status = d.status;
                });

                $('#main_cheque_status').html('Status : ' + status);
                $('#main_total_amount').html('Total Amount : Rs.' + amount);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });

    const showOffExpenses = () => {
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showOffExpensesTypeto',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    html = `<option>--No data found--</option>`;
                    $('#expenses_type').html(html);
                } else {
                    getData.map(d => {
                        html += `<option value="${d.expense_typeid}">${d.expense_name}</option>`;

                    });
                }

                $('#expenses_type').html(html);
            },
            error: function (err) {

            }
        });
    }

    showOffExpenses();


    $("#searchmainchequedetails").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#checkgottenmembers tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



//<button class="btn btn-link showcustomerdetails" customer_id="${d.customer_id}">Click</button>


$('body').delegate('.showcustomerdetails','click',function(){

    let customer_id = parseInt($(this).attr('customer_id'));
    $('#showoffcustomerdetailsinmodal').modal('show');
    let html = null;
     $.ajax({
            url: base_url + 'Controllerunit/showcustomerdetailsforsales',
            method: 'POST',
            data:{
                customer_id:customer_id,
            },
            success: function (data) {
                let getData = JSON.parse(data);

                if(getData==0){
                    $('#attachcustomerdetails').html('<tr><td><span class="text text-danger font-weight-bold">No data found</span></td></tr>');
                }
                else {
                    getData.map(d => {
                        html+=`<tr>
                    <td>1</td>
                    <td>${d.customer_name}</td>
                    <td>
                    ${d.customer_mobile}
                    </td>
                    </tr>`;
                    });
                    $('#attachcustomerdetails').html(html);
                }

            },
            error: function (err) {
               console.clear();
                console.log(err);
            }
        });


});


$('body').delegate('.showproductdetails','click',function(){
     let outlet_id = parseFloat($(this).attr('outlet_id'));
    let invoice_no = $(this).attr('invoice_no');
    let order_summery_id = $(this).attr('order_summery_id');
    $('#showoffproductdetailsforsales').modal('show');

    let count = 0;
    let html = '';

     $.ajax({
            url: base_url + 'Controllerunit/getsoldproductdetails',
            method: 'POST',
            data:{
                outlet_id:outlet_id,
                invoice_no:invoice_no,
                order_summery_id:order_summery_id
            },
            success: function (data) {
                let getData = JSON.parse(data);
                if(getData=='0'){
                    $('#showoffpurchasedproduct_details').html('<tr><span class="text text-danger font-weight-bold">No data found</span></tr>');
                    return false;
                }
                else {
                getData.map(d => {
                    ++count;
                    html+=`<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.choosen_quantity}</td>
<td>${d.product_price}</td>
<td>${d.status==1 ? '<span class="badge badge-success">SOLD</span>' : '<span class="badge badge-danger">Returned</span>'}</td>
</tr>`;
                });

                    $('#showoffpurchasedproduct_details').html(html);
                }

            },
            error: function (err) {
               console.clear();
                console.log(err);
            }
        });

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
                    return false;
                }
                else {
                    getData.map(d => {
                    let totalAmount = parseFloat(d.total_amount);
                    let discounted_amount = parseFloat(d.discounted_amount.split('.')[1]);


                    let recievedAmount = (totalAmount - discounted_amount);
                        ++count;
                     html+=`<tr class='text text-center'>
                    <td>${count}</td>
                    <td>
                    <button class='btn btn-link showproductdetails' outlet_id='${d.outlet_id}' invoice_no='${d.invoice_no}' order_summery_id ="${d.order_summery_id }">Click</button>
                    </td>
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
                }

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

     });



    $('#search_term_byending').click(function(){
        let choose_outlets = $('#choose_outlets').val();
        let starting_date = $('#starting_date').val();
        let ending_date = $('#ending_date').val();

        if(starting_date==''){
            alert('Please choose starting date');
            return false;
        }
        if(ending_date==''){
            alert('Please choose ending date');
            return false;
        }
        takeProfitsandsalesdetails(choose_outlets,starting_date,ending_date);



    });


    $('#message_to_message').keyup(function(e){

        if(e.target.value.length < 150)
            {
                 $('#letter_count').html(e.target.value.length);
            }



    });

    $('#frmsendsms').submit(function(e){
        e.preventDefault();

        $(this).find('.btn-success').attr('disabled',true);

        let message_to_message = $('#message_to_message').val();

        if(message_to_message==''){
            alert('Please type sms first');
            return false;
        }

          $.ajax({
            url: base_url + 'Controllerunit/sendsmssectiontoall',
            method: 'POST',
            data:{
                message_to_message:message_to_message
            },
            success: function (data) {
                alert('Message has been sent successfully');
                window.location.reload();
            },
            error: function (err) {

            }
        });


    });





    $('#singlesmssendfrm').submit(function(e){
        e.preventDefault();

        let single_message_to_message = $('#single_message_to_message').val();
        if(single_message_to_message==''){
            alert('Please enter the message first');
            return false;
        }

        let customer_id = parseInt(sessionStorage.getItem('customer_id'));
        customer_id = Number(customer_id);

          $.ajax({
            url: base_url + 'Controllerunit/sendindmessage',
            method: 'POST',
            data:{
                single_message_to_message:single_message_to_message
            },
            success: function (data) {
                alert('Message has been sent successfully');
                window.location.reload();
            },
            error: function (err) {

            }
        });


     });


    $('.deletegroupbtnforsms').click(function(){
        let value = parseInt($(this).attr('group_id'));
        value = Number(value);

        if(confirm("Are you sure you want to delete it?")){
             $.ajax({
            url: base_url + 'Controllerunit/deletegroupforsms',
            method: 'POST',
            data:{
                value:value
            },
            success: function (data) {
                alert('Group has successfully been deleted');
                window.location.reload();

            },
            error: function (err) {

            }
        });
        }


    });


    $('#frmcreategroups').submit(function(e){
        e.preventDefault();

        let create_group_name = $('#create_group_name').val();
        if(create_group_name==''){
            alert('Please enter the group name');
            return false;
        }

          $.ajax({
            url: base_url + 'Controllerunit/checknamexist',
            method: 'POST',
            data:{
                create_group_name:create_group_name
            },
            success: function (data) {

                if(data==1){
                    alert('The name already exist. Please choose another name');
                    return false;
                }
                else {

                          $.ajax({
                            url: base_url + 'Controllerunit/creategroupsforsms',
                            method: 'POST',
                            data:{
                                create_group_name:create_group_name
                            },
                            success: function (data) {
                                console.clear();
                                console.log(data);
                                alert('Group has been created successfully');
                                window.location.reload();
                            },
                            error: function (err) {

                            }
                        });



                }
            },
            error: function (err) {

            }
        });





    });



    $('.editgroup_name').click(function(e){
        let group_id= parseInt($(this).attr('group_id'));
        group_id = Number(group_id);
        let group_name = $(this).attr('group_name');

        $('#update_create_group_name').val(group_name);

        sessionStorage.setItem('group_id',group_id);
          $('#updateexampleModal').modal('show');

    });


    $('#frmupdategroup').submit(function(e){
        e.preventDefault();


        let update_create_group_name = $('#update_create_group_name').val();
        if(update_create_group_name==''){
            alert('Please enter the group name');
            return false;
        }


                        $.ajax({
                            url: base_url + 'Controllerunit/updategroupname',
                            method: 'POST',
                            data:{
                                update_create_group_name:update_create_group_name,
                                group_id: sessionStorage.getItem('group_id')
                            },
                            success: function (data) {
                                alert('Update successfully');
                                window.location.reload();
                            },
                            error: function (err) {

                            }
                        });





    });


    $('.show_contact_details_btn').click(function(){
        let group_id = $(this).attr('group_id');
        group_id = parseInt(group_id);
        group_id = Number(group_id);

        let html = null;
        let count = 0;

                        $.ajax({
                            url: base_url + 'Controllerunit/getcontactdetailsforsms',
                            method: 'POST',
                            data:{
                                group_id:group_id,
                            },
                            success: function (data) {
                            let getData = JSON.parse(data);
                                console.log(getData);

                                if(getData==0){
                                    $('#show_releated_sms'+group_id).html('<span class="text text-danger font-weight-bold">No data found</span>');

                                }
                                else {
                                    getData.map(d => {
                                   html+=`<tr>
                                <td>${++count}</td>
                                <td>${d.customer_name}</td>
                                <td>${d.customer_mobile}</td>
                                <td>
                                <button class="btn btn-outline-danger btn-sm deltecontact_details" customer_id='${d.customer_id}'><i class="fa fa-trash" aria-hidden='true'></i></button>
                                </td>
                                </tr>`;
                                    });
                                    $('#show_releated_sms'+group_id).html(html);
                                }
                            },
                            error: function (err) {
                                console.clear();
                                console.error('SMS CONTACT ERROR FOUND',err);
                            }
                        });




    });

    $('body').delegate('.deltecontact_details','click',function(){
        let customer_id = parseInt($(this).attr('customer_id'));
        customer_id = Number(customer_id);


        if(confirm("Are you sure you want to delete it?")){

                        $.ajax({
                            url: base_url + 'Controllerunit/deletecontactdetails',
                            method: 'POST',
                            data:{
                                customer_id:customer_id,
                            },
                            success: function (data) {
                                alert('Deleted successfully');
                                window.location.reload();
                            },
                            error: function (err) {

                            }
                        });
        }


    });


    $('.add_to_group').click(function(){
        let customer_id = $(this).attr('customer_id');
        let group_id = $(this).attr('group_id');


                        $.ajax({
                            url: base_url + 'Controllerunit/checkinggroupexisting',
                            method: 'POST',
                            data:{
                                customer_id:customer_id,
                                group_id:group_id
                            },
                            success: function (data) {
                              if(data==1){
                                  alert('Already exist in the group.');
                                return false;
                              }
                                else {
                                     $.ajax({
                            url: base_url + 'Controllerunit/savecontact_details_forsms',
                            method: 'POST',
                            data:{
                                customer_id:customer_id,
                                group_id:group_id
                            },
                            success: function (data) {
                                 alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });

                                }
                            },
                            error: function (err) {

                            }
                        });

    });



    $('.add_customer_sms_group').click(function(e){


        $('#group_id_hidden_id').val($(this).attr('group_id'));


        $('#addgroupsforcustomertosmss').modal('show');
    });


    $('.addtogroupbtnforsms').click(function(){
        let group_id = parseInt($('#group_id_hidden_id').val());
        let customer_id = parseInt($(this).attr('customer_id'));
        customer_id = Number(customer_id);

                        $.ajax({
                            url: base_url + 'Controllerunit/addcustomers_to_group_for_smssection',
                            method: 'POST',
                            data:{
                                group_id:group_id,
                                customer_id:customer_id

                            },
                            success: function (data) {
                                console.log(data);
                                alert('Customer has successfully been added to group.');
                                window.location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });


                });



    $('.send_sms_group_section').click(function(e){
        e.preventDefault();
           let group_id = parseInt($(this).attr('group_id'));
         $("#group_id_hidden_id").val(group_id);
        $('#group_sms_sectionmodal').modal('show');
    });



    $('#group_sms_contact_text').keyup(function(e){
        let length = e.target.value.length;

        if(length >=130){
              $('#letter_count_for_group_sms_text').html(`<span class="font-weight-bold text-danger">${length}/150</span>`);
        }
        else {
              $('#letter_count_for_group_sms_text').html(`<span class="font-weight-bold">${length}/150</span>`);
        }

        if(length==0){
             $('#letter_count_for_group_sms_text').html(`<span class="">${length}/150</span>`);
        }

    });





    $('#frm_general_settings_update_section').submit(function(e){
        e.preventDefault();
       let company_name = $('#company_name').val();
        let company_address = $('#company_address').val();
        let hotline_number = $('#hotline_number').val();

        if(hotline_number==''){
            alert('Please enter the hotline number');
            return false;
        }
        if(company_name==''){
            alert('Company name is required');
            return false;
        }

        if(company_address==''){
            alert('Company address is required');
            return false;
        }

                     $.ajax({
                            url: base_url + 'Controllerunit/general_settings_update_section',
                            method: 'POST',
                            data:{
                                hotline_number:hotline_number,
                                company_name:company_name,
                                company_address:company_address

                            },
                            success: function (data) {
                               alert('Saved successfully');
                                window.location.reload();
                            },
                            error: function (err) {
                                alert(err);
                            }
                        });



    });







}); //end of script
