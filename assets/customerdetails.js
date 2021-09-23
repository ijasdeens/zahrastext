$(document).ready(function () {
	const base_url = $('#base_url').val();


	const showoffcustomerdetails = () => {
		let number = 0;
		let html = null;
		$.ajax({
			url: base_url + 'Controllerunit/showoffcustomerdetails',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#customerDetails').html('<span class="text text-danger font-weight-bold">No data found</span>')
				} else {
					getData.map(d => {
						number++;
						html += `<tr>
<td>${d.c_fullname}</td>
<td>${d.c_shortname}</td>
<td>${d.c_contactno}</td>
<td>${d.c_nic}</td>
<td>${d.c_address}</td>
<td>${d.t_id}</td>
<td>${d.c_creditperiod}</td>
<td>${d.c_creditlimit}</td>
<td>${d.c_type}</td>
<td>
<button class="btn btn-outline-danger btn-sm deleteAll" customer_id="${d.c_id}">
 
DELETE
</button>
&nbsp; 
<button class="btn btn-oultine-primary btn-sm editAll" fullName="${d.c_fullname}" c_shortname="${d.c_shortname}" c_contactno="${d.c_contactno}" c_nic="${d.c_nic}" c_address="${d.c_address}" c_creditperiod="${d.c_creditperiod}" c_creditlimit="${d.c_creditlimit}" c_type="${d.c_type}" town_id="${d.town_id}" customer_id="${d.c_id}">
 EDIT
</button>

<td>
</tr>`;
					});
					$('#totalcustomercount').html('Total customers : ' + number);
					$('#customerDetails').html(html);

				}

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}

	showoffcustomerdetails();

	const showOffTown = () => {
		let html = null;

		$.ajax({
			url: base_url + 'Controllerunit/showOffTown',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#customerDetails').html('<span class="text text-danger font-weight-bold">No data found</span>')
				} else {
					getData.map(d => {

						html += `<option value="${d.t_id}">(${d.t_code}) - ${d.t_name}</option>`;
					});
					$('#customer_town').html(html);
					$('#ecustomer_town').html(html);

				}

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}


	showOffTown();

	$('body').delegate('.deleteAll', 'click', function (e) {
		e.stopImmediatePropagation();
		let customer_id = parseInt($(this).attr('customer_id'));

		if (confirm("Are you sure you want to delete it?")) {

			$.ajax({
				url: base_url + 'Controllerunit/deleteCustomer',
				method: 'POST',
				data: {
					customer_id: customer_id

				},
				success: function (data) {
					toastr.error('Deleted successfully');
					showoffcustomerdetails();

				},
				error: function (err) {
					console.error('Error found', err);
				}
			});

		}


	});

	/*
	<button class="btn btn-oultine-primary btn-sm editAll" fullName="${d.c_fullname}" c_shortname="${d.c_shortname}" c_contactno="${d.c_contactno}" c_nic="${d.c_nic}" c_address="${d.c_address}" c_creditperiod="${d.c_creditperiod}" c_creditlimit="${d.c_creditlimit}" c_type="${d.c_type}" town_id="${d.town_id}" customer_id="${d.c_id}">
 EDIT
</button>

	*/

	$('body').delegate('.editAll', 'click', function () {
		$('#updatecustomermodal').modal('show');

		$('#ecustomerFullName').val($(this).attr('fullName'));
		$('#ecustomerShortName').val($(this).attr('c_shortname'));
		$('#ecustomerContactNo').val($(this).attr('c_contactno'));
		$('#ecutomerNIC').val($(this).attr('c_nic'));
		$('#ecustomerAddress').val($(this).attr('c_address'));
		$('#ecustomer_town').val($(this).attr('town_id'));
		$('#ecutomer_creditperiod').val($(this).attr('c_creditperiod'));
		$('#ecreditlimit').val($(this).attr('c_creditlimit'));
		$('#eperson_type').val($(this).attr('c_type'));
		$('#hidden_id').val($(this).attr('customer_id'));

	});



	$("#cutomer_creditperiod").keyup(function (e) {
		e.stopImmediatePropagation();
		let value = $(this).val();

		if (isNaN(value)) {
			toastr.error("Only numbers allowed in credit period section");
			$('#cutomer_creditperiod').focus();
			$('#btnsavecustomer').attr('disabled', true);
			return false;
		} else {
			$('#btnsavecustomer').attr('disabled', false);
		}

	});



	$("#ecutomer_creditperiod").keyup(function (e) {
		e.stopImmediatePropagation();
		let value = $(this).val();

		if (isNaN(value)) {
			toastr.error("Only numbers allowed in credit period section");
			$('#ecutomer_creditperiod').focus();
			$('#btnUpdate').attr('disabled', true);
			return false;
		} else {
			$('#btnUpdate').attr('disabled', false);
		}

	});




	$("#customerContactNo").keyup(function (e) {
		e.stopImmediatePropagation();
		let value = $(this).val();

		if (value.length > 10) {
			toastr.error("Only 10 digits allowed");
			$('#customerContactNo').focus();
			$('#btnsavecustomer').attr('disabled', true);
			return false;
		} else {
			$('#btnsavecustomer').attr('disabled', false);
		}

		if (isNaN(value)) {
			toastr.error("Please enter only numbers in mobile number section");
			$('#customerContactNo').focus();
			$('#btnsavecustomer').attr('disabled', true);
			return false;
		} else {
			$('#btnsavecustomer').attr('disabled', false);
		}

	});	
	
	$("#ecustomerContactNo").keyup(function (e) {
		e.stopImmediatePropagation();
		let value = $(this).val();

		if (value.length > 10) {
			toastr.error("Only 10 digits allowed");
			$('#ecustomerContactNo').focus();
			$('#btnsavecustomer').attr('disabled', true);
			return false;
		} else {
			$('#btnUpdate').attr('disabled', false);
		}

		if (isNaN(value)) {
			toastr.error("Please enter only numbers in mobile number section");
			$('#ecustomerContactNo').focus();
			$('#btnsavecustomer').attr('disabled', true);
			return false;
		} else {
			$('#btnUpdate').attr('disabled', false);
		}

	});


	


	$('#btnsavecustomer').click(function (e) {
		e.stopImmediatePropagation();

		if (isNaN($('#creditlimit').val())) {
			$('#creditlimit').focus();

			toastr.error("Only numbers allowed in credit limit section");

			return false;
		}

		if($('#customerContactNo').val().length!=10){
			toastr.error('Mobile number should be 10 digits'); 
			return false; 
		}

		e.stopImmediatePropagation();
		$.ajax({
			url: base_url + 'Controllerunit/savecustomerdetails',
			method: 'POST',
			data: {
				customerFullName: $('#customerFullName').val(),
				customerShortName: $('#customerShortName').val(),
				customerContactNo: $('#customerContactNo').val(),
				cutomerNIC: $('#cutomerNIC').val(),
				customerAddress: $('#customerAddress').val(),
				customer_town: $('#customer_town').val(),
				cutomer_creditperiod: $('#cutomer_creditperiod').val(),
				creditlimit: $('#creditlimit').val(),
				person_type: $('#person_type').val(),


			},
			success: function (data) {
				toastr.success('Saved successfully');
				showoffcustomerdetails();
				$('#customerdetailsModal').modal('hide');


			},
			error: function (err) {
				console.error('Error found', err);
			}
		});


	});




	$('#btnUpdate').click(function (e) {
		e.stopImmediatePropagation();

		
		
		if (isNaN($('#ecreditlimit').val())) {
			$('#creditlimit').focus();

			toastr.error("Only numbers allowed in credit limit section");

			return false;
		}

		if($('#ecustomerContactNo').val().length!=10){
			toastr.error('Mobile number should be 10 digits'); 
			return false; 
		}


		$.ajax({
			url: base_url + 'Controllerunit/updatecustomers',
			method: 'POST',
			data: {
				customerFullName: $('#ecustomerFullName').val(),
				customerShortName: $('#ecustomerShortName').val(),
				customerContactNo: $('#ecustomerContactNo').val(),
				cutomerNIC: $('#ecutomerNIC').val(),
				customerAddress: $('#ecustomerAddress').val(),
				customer_town: $('#ecustomer_town').val(),
				cutomer_creditperiod: $('#ecutomer_creditperiod').val(),
				creditlimit: $('#ecreditlimit').val(),
				person_type: $('#eperson_type').val(),
				customerId: $('#hidden_id').val()

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







	$('#customerFullName').keyup(function (event) {
		if (event.keyCode === 13) {

			$('#customerShortName').focus();
		}

	});

	$('#customerShortName').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#customerContactNo').focus();
		}

	});


	$('#customerContactNo').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#cutomerNIC').focus();
		}

	});

	$('#cutomerNIC').keyup(function (event) {
		if (event.keyCode === 13) {
			$('#customerAddress').focus();
		}

	});
	$('#customerAddress').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#customer_town').focus();
		}

	});

	$('#cutomer_creditperiod').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#creditlimit').focus();
		}

	});

	$('#creditlimit').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#person_type').focus();
		}

	});

	$('#person_type').keyup(function (event) {
		if (event.keyCode === 13) {

			$('#savecustomer').focus();
		}

	});




	//For updates 



	$('#ecustomerFullName').keyup(function (event) {
		if (event.keyCode === 13) {

			$('#ecustomerShortName').focus();
		}

	});

	$('#ecustomerShortName').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#ecustomerContactNo').focus();
		}

	});


	$('#ecustomerContactNo').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#ecutomerNIC').focus();
		}

	});

	$('#ecutomerNIC').keyup(function (event) {
		if (event.keyCode === 13) {
			$('#ecustomerAddress').focus();
		}

	});
	$('#ecustomerAddress').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#ecustomer_town').focus();
		}

	});

	$('#ecutomer_creditperiod').keyup(function (event) {
		if (event.keyCode === 13) {


			$('#ecreditlimit').focus();
		}

	});

	$('#ecreditlimit').keyup(function (event) {
		if (event.keyCode === 13) {

			$('#eperson_type').focus();
		}

	});

	$('#eperson_type').keyup(function (event) {
		if (event.keyCode === 13) {

			$('#btnUpdate').focus();
		}

	});



	$("#searchCustomer").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#customerDetails tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});




});