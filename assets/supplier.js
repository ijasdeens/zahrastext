$(document).ready(function () {

	const base_url = $('#base_url').val();

	function getchequedetailsforsuppliers(fromdate = null, todate = null) {
 
		let html = ''; 
		let count = 0; 


		let statuschecker = ''; 

		let bounced_chequeamount = 0.00; 
		let completed_chequeamount = 0.00; 
		let pending_chequeamount = 0.00; 
	
		$.ajax({
			url: base_url + 'Controllerunit/getchequedetailsforsuppliers',
			method: 'POST',
			data: {
				fromdate:fromdate,
				todate:todate
			},
			success: function (data) {
				 let getData = JSON.parse(data); 
				 if(getData==0){
					 $('#pendingchequesforsuppliersection').html('<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>');
				 }
				 else {
					 getData.map(d => {

 						 if(d.cheque_status=='pending'){
							pending_chequeamount+=parseFloat(d.amount).toFixed(2); 
							statuschecker = '<span class="badge badge-warning">Pending</span>'; 
						 }
						 else if(d.cheque_status=='bounce'){
							bounced_chequeamount+=parseFloat(d.amount).toFixed(2);
							statuschecker = '<span class="badge badge-danger">Bounced</span>'; 
						 }
						 else {
							completed_chequeamount+=parseFloat(d.amount).toFixed(2); 
							statuschecker ='<span class="badge badge-success">Completed</span>'; 
						 }
						html+=`<tr>
						<td>${++count}</td>
						<td>${d.bank_name}</td>
						<td>${d.branch_name}</td>
						<td>${d.account_no}</td>
						<td>${d.cheque_date}</td>
						<td>Rs.${parseFloat(d.amount).toFixed(2)}</td>
						 <td>${statuschecker}</td>
						<td>${d.supplier_name}</td>
						<td>${d.org_name}</td>
						<td>${d.mobile_number}</td>
						<td>${d.note}</td>
						<td>
						<div class="dropdown">
  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item editsupplierdata" 
	bank_name='${d.bank_name}'
	branch_name = '${d.branch_name}'
	account_no = '${d.account_no}'
	amount = '${d.amount}'
	cheque_status = '${d.cheque_status}'
	supplier_name = '${d.supplier_name}'
	org_name = '${d.org_name}'
	mobile_number = '${d.mobile_number}'
	note = '${d.note}'
	supplier_cheques_id= '${d.supplier_cheques_id}'
	date = '${d.cheque_date}'
	
	href="#">Edit <i class="fa fa-pencil" aria-hidden='true'></i></a>
    <a class="dropdown-item deletesupplierchecks" supplier_cheques_id='${d.supplier_cheques_id}' href="#">Delete <i class="fa fa-trash" aria-hidden='true'></i></a>
    <a class="dropdown-item changecheckstatusforsupplier" supplier_cheques_id='${d.supplier_cheques_id}' href="#">change check status <i class="fa fa-refresh"></i></a>
  </div>
</div>
						</td>
						</tr>`;
					 }); 

					 $('#pendingchequesforsuppliersection').html(html);
					 $('#bounced_chequeamount').html('Rs.' + parseFloat(bounced_chequeamount).toFixed(2)); 
					 $('#completedcheque_amount').html('Rs.'+parseFloat(completed_chequeamount).toFixed(2));
					 $('#pendingchequeamount').html('Rs.'+parseFloat(pending_chequeamount).toFixed(2));  
				 }
			 
			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	
	}



	$('body').delegate('.changecheckstatusforsupplier','click',function(){
		let supplier_cheques_id = parseInt($(this).attr('supplier_cheques_id'));
		
		sessionStorage.setItem('cheque_idforupdate',supplier_cheques_id); 
		$('#selectstatusforcheques').modal('show');

	});
	
	$("#searchpendingchequesforsupplierinput").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#pendingchequesforsuppliersection tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});


	$('#frmchosenstatus').submit(function(e){
		e.preventDefault(); 
		let cheque_status_reupdate = $('#cheque_status_reupdate').val(); 
		let cheque_id = Number(sessionStorage.getItem('cheque_idforupdate'));

		if(cheque_status_reupdate==''){
			alert('Please choose one of status for cheques'); 
			$('#cheque_status_reupdate').css('border','2px solid red'); 
			$('#cheque_status_reupdate').focus(); 
			return false; 
		}


		$.ajax({
			url: base_url + 'Controllerunit/changecheckstatusforsupplier',
			method: 'POST',
			data: {
				cheque_status_reupdate: cheque_status_reupdate,
				cheque_id:cheque_id
			},
			success: function (data) {
			 if(data==1){
			 
			 alert('updated successfully'); 
				window.location.reload(); 
			 }
			 else {
				 alert(data); 
			 }
			},
			error: function (err) {
				alert('error ' + err);
				console.error('Error found', err);
			}
		});
		
 
	}); 

	$('#searchforsuppliercheques').click(function(){
		let from_date_searchforpendingcheques = $('#from_date_searchforpendingcheques').val(); 
		let to_date_forchequespendingcheqs = $('#to_date_forchequespendingcheqs').val(); 

		if(from_date_searchforpendingcheques==''){
			alert('From date is required'); 
			return false; 
		}
		if(to_date_forchequespendingcheqs==''){
			alert('To date is required'); 
			return false; 
		}

		getchequedetailsforsuppliers(from_date_searchforpendingcheques,to_date_forchequespendingcheqs);

	}); 


	$('body').delegate('.deletesupplierchecks','click',function(){
		let supplier_cheques_id = parseInt($(this).attr('supplier_cheques_id')); 
	 
		if(confirm("Are you sure you want to delete it?")){
			$.ajax({
				url: base_url + 'Controllerunit/deletesupplierchecks',
				method: 'POST',
				data: {
					supplier_cheques_id: supplier_cheques_id
				},
				success: function (data) {
				 if(data==1){
				 
				 alert('Deleted successfully'); 
					window.location.reload(); 
				 }
				 else {
					 alert(data); 
				 }
				},
				error: function (err) {
					console.error('Error found', err);
				}
			});
	
		}

	}); 


	$('body').delegate('.editsupplierdata','click',function(){
		$('#ubank_name').val($(this).attr('bank_name')); 
		$('#ubranch_name').val($(this).attr('branch_name')); 
		$('#uaccount_no').val($(this).attr('account_no')); 
		$('#ucheques_date').val($(this).attr('date')); 
		$('#ucheque_status').val($(this).attr('cheque_status')); 
		$('#uamountforcheque').val($(this).attr('amount'));
		$('#unoteforcheck').val($(this).attr('note')); 
		$('#usupplier_details_choose').val($(this).attr('supplier_name'));
		sessionStorage.setItem('supplier_id_check',$(this).attr('supplier_cheques_id')); 

		$('#updatechequeforsuppliersmodal').modal('show');
	}); 

	$('#updatesuppliercheques').submit(function(e){
		e.preventDefault(); 

		let bank_name = $('#ubank_name').val(); 
		let branch_name = $('#ubranch_name').val(); 
		let account_no = $('#uaccount_no').val(); 
		let cheques_date = $('#ucheques_date').val(); 
		let supplier_details_choose = $('#supplier_details').val(); 

		let amountforcheque = $('#uamountforcheque').val(); 

		let supplier_id_check = parseInt(sessionStorage.getItem('supplier_id_check')); 

		if(bank_name==''){
			alert('Bank name is require'); 
			return false; 
		}

		if(branch_name==''){
			alert('Branch name is required'); 
			return false; 
		}

		if(account_no==''){
			alert('Account no is required'); 
			return false; 
		}

		if(cheques_date==''){
			alert('Cheque details is required'); 
			return false; 
		}

		if(supplier_details_choose==''){
			alert('Supplier details is required'); 
			return false; 
		}

	 
		let cheque_status = $('#ucheque_status').val(); 
		
		if(isNaN(amountforcheque)){
			alert('Only numbers are accepted in amount field'); 
			return false; 
		}
	 
		$.ajax({
			url: base_url + 'Controllerunit/updatesuppliersections',
			method: 'POST',
			data: {
				bank_name:bank_name,
				branch_name:branch_name,
				account_no:account_no,
				cheques_date:cheques_date,
				supplier_details_choose:supplier_details_choose,
				cheque_status:cheque_status,
				noteforcheck : $('#noteforcheck').val(),
				amountforcheque:amountforcheque,
				supplier_id_check:supplier_id_check

			},
			success: function (data) {
			 if(data==1){
				 alert('Updated successfully'); 
				 window.location.reload(); 
			
				}
			 else {
				alert(data); 
			 }

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});

	})


	$('#savesuppliercheques').submit(function(e){
		e.preventDefault(); 
		let bank_name = $('#bank_name').val(); 
		let branch_name = $('#branch_name').val(); 
		let account_no = $('#account_no').val(); 
		let cheques_date = $('#cheques_date').val(); 
		let supplier_details_choose = $('#supplier_details').val(); 

		let amountforcheque = $('#amountforcheque').val(); 

		if(bank_name==''){
			alert('Bank name is require'); 
			return false; 
		}

		if(branch_name==''){
			alert('Branch name is required'); 
			return false; 
		}

		if(account_no==''){
			alert('Account no is required'); 
			return false; 
		}

		if(cheques_date==''){
			alert('Cheque details is required'); 
			return false; 
		}

		if(supplier_details_choose==''){
			alert('Supplier details is required'); 
			return false; 
		}

		let add_multipleforchequedetails = $("#add_multipleforchequedetails").is(":checked") ? true : false; 
		let cheque_status = $('#cheque_status').val(); 
		
		if(isNaN(amountforcheque)){
			alert('Only numbers are accepted in amount field'); 
			return false; 
		}
	 
		$.ajax({
			url: base_url + 'Controllerunit/savesupplierchequessections',
			method: 'POST',
			data: {
				bank_name:bank_name,
				branch_name:branch_name,
				account_no:account_no,
				cheques_date:cheques_date,
				supplier_details_choose:supplier_details_choose,
				cheque_status:cheque_status,
				noteforcheck : $('#noteforcheck').val(),
				amountforcheque:amountforcheque

			},
			success: function (data) {
			 if(data==1){
				 if(add_multipleforchequedetails==true){
					$('#bank_name').focus();
					$('#savesuppliercheques')[0].reset(); 
					alert('Saved successfully'); 
					getchequedetailsforsuppliers();
					return false; 
					
				 }
				 else {
					alert('Saved successfully'); 
					window.location.reload(); 

				 }
			
				}
			 else {
				alert(data); 
			 }

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});



	})


	const showOffSupplier = () => {
		let html = null;
		let count = 0;

		$.ajax({
			url: base_url + 'Controllerunit/showOffSupplier',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					html = "No data found";
				} else {
					getData.map(d => {
						count++;
						html += `<tr>
<td>${count}</td>
<td>${d.supplier_name}</td>
<td>${d.mobile_number}</td>
<td>${d.org_name}</td>
<td>${d.supplier_addresses}</td>
<td>${d.supplier_accountno}</td>
<td>${d.bank_name}</td>
<td>
<button class="btn btn-primary btn-sm editSupplier" supplier_id="${d.supplier_id}" supplier_name="${d.supplier_name}" mobileNumber="${d.mobile_number}" orgName="${d.org_name}">EDIT</button>
			   					<button class="btn btn-danger btn-sm deleteSupplier" supplier_id="${d.supplier_id}">Delete</button>
</td>
</tr>`;
					});

					$('#showOffSuppliers').html(html);

				}



			},
			error: function (err) {
				console.error('Error found', err);
			}
		});


	}

	showOffSupplier();

	$('body').delegate('.editSupplier','click',function(){
		let supplier_id = parseInt($(this).attr('supplier_id')); 
		let supplier_name = $(this).attr('supplier_name'); 
		let mobileNumber = $(this).attr('mobileNumber'); 
		let orgName = $(this).attr('orgName'); 
		
		
		$('#hidden_id').val(supplier_id); 
		$('#u_supplierName').val(supplier_name); 
		$('#u_mobileNumber').val(mobileNumber); 
		$('#u_orgName').val(orgName); 
		
		$('#updatesuppliers').modal('show'); 
		
			
		
		
	});
	
	$('#frmUpdatesupplier').submit(function(){
		
	 	let u_supplierName = $('#u_supplierName').val(); 
		let u_mobileNumber = $('#u_mobileNumber').val(); 
		let u_orgName = $('#u_orgName').val(); 
		
		let frmUpdatesupplier = $('#frmUpdatesupplier').val(); 
		let u_accountNo = $('#u_accountNo').val(); 
		
		let u_bankname = $('#u_bankname').val(); 
		let u_address = $('#u_address').val(); 
		
		let id = parseInt($('#hidden_id').val()); 
		
		
		if(u_supplierName==""){
			alert('Supplier name is required'); 
			return false; 
		}
	
		if(u_mobileNumber==""){
			alert('Mobile number is required'); 
			return false; 
		}
		
		if(u_orgName==""){
			alert('Organization is required'); 
			return false; 
		}
		
		if(id==""){
			alert('Id is required'); 
			return false; 
		}
		
		$.ajax({
				url: base_url + 'Controllerunit/updateSuppliers',
				method: 'POST',
				data: {
					u_supplierName: u_supplierName,
					u_mobileNumber:u_mobileNumber,
					u_orgName:u_orgName,
					id:id,
					u_bankname:u_bankname,
					u_address:u_address,
					u_accountNo:u_accountNo
					
				},
				success: function (data) {
					alert('Updated successfully');
					window.location.reload();

				},
				error: function (err) {
					console.error('Error found', err);
				}
			});
		
		
		
		
	}); 
	
	
	
	
	$('body').delegate('.deleteSupplier', 'click', function () {
		let supplier_id = parseInt($(this).attr('supplier_id'));

		if (confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: base_url + 'Controllerunit/deleteSuppliers',
				method: 'POST',
				data: {
					supplier_id: supplier_id
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

	$('#frmsaveSupplier').submit(function (e) {
		e.preventDefault();

		let supplierName = $('#supplierName').val();
		let mobileNumber = $('#mobileNumber').val();
		let orgName = $("#orgName").val();
		let suppliers_address = $('#suppliers_address').val(); 
		let suppliers_accountNo = $('#suppliers_accountNo').val(); 
		let bank_name = $('#bank_name').val(); 
		
		
		if (supplierName == "") {
			alert('Supplier name is required');
			return false;
		}

		if (mobileNumber == "") {
			alert('Supplier number is required');
			return false;
		}

		if (isNaN(mobileNumber)) {
			alert('Only number is required');
			return false;
		}
		
		if(suppliers_address==""){
			alert('Supplier address is required'); 
			return false; 
		}
		
		if(suppliers_accountNo==""){
			alert('Account number is required'); 
			return false; 
		}
		
		if(bank_name==""){
			alert('Bank name is required'); 
			return false;
		}


		$.ajax({
			url: base_url + 'Controllerunit/addSuppliers',
			method: 'POST',
			data: {
				supplierName: supplierName,
				mobileNumber: mobileNumber,
				orgName: orgName,
				suppliers_address:suppliers_address,
				suppliers_accountNo:suppliers_accountNo,
				bank_name:bank_name
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

	getchequedetailsforsuppliers();
});