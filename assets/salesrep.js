$(document).ready(function () {


	const base_url = $('#base_url').val();

	totalamountforduecollection = 0;

	discountedValueasgeneral = 0;

	const increaseCustomerId = () => {
		let number = 0;
		$.ajax({
			url: base_url + 'controllerunit/increaseCustomerId',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);
				number = getData.map(d => d.cusIds);
				number++;

				$('.customeridauto').val('cus_' + number);
			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}

	increaseCustomerId();

	const showoffduecollection = () => {

		let totalDue = 0;
		let html = null;
		let count = 0;
		$.ajax({
			url: base_url + 'Accountantside/duecollectiondetails',
			method: 'POST',
			success: function (data) {

				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#showoffduecollectionforrep').html('<span class="text text-danger">No data found</span');
					return false;
				}

				getData.map(d => {
					count++;
					totalDue += parseFloat(d.due_amount);
					html += `<tr>
				<td>${count}</td>
<td>${d.customer_name}</td>
<td>${d.customer_phoneNo}</td>
<td>Rs . ${d.due_amount}</td>
<td>
<button class="btn btn-info btn-sm paymentmodaltrigger" loanamount="${d.due_amount}" cus_id="${d.customer_id}" unique_key="${d.unique_key}">Collect pament</button>
</td>
	 			</tr>`;
				});

				$('#showoffduecollectionforrep').html(html);
				$('#totalDueamounts').html('Total due to be collected : Rs. <b>' + totalDue.toFixed(2) + '</b>');


			},
			error: function (err) {
				console.error('Error found', err);
			}
		});


	}
	showoffduecollection();





	const countcardquantit = () => {
		$.ajax({
			url: base_url + 'salesrepside/countcardquantit',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);

				let array = Object.keys(getData).map(i => getData[i]);
				$('.cardcounts').html('<i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;' + array.length);
				$('#notificationforshoppingcart').html(array.length);
				if (array.length == 0) {
					$("#btnmakeorder").attr('disabled', 'disabled');
				} else {
					$("#btnmakeorder").attr('disabled', false);
				}
			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}



	const takeTotalAmounts = () => {
		$.ajax({
			url: base_url + 'salesrepside/takeTotalAmounts',
			method: 'POST',
			success: function (data) {

				$('#totalAmountshowcase').html('Total amount : Rs. ' + data);
				$("#totalamounttoget").val(data);

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}


	const orderedItems = () => {
		$.ajax({
			url: base_url + 'salesrepside/showoffwhatisinsidecart',
			method: 'POST',
			success: function (data) {

				$('#showoffOrderitems').html(data);
				takeTotalAmounts();
				countcardquantit();

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});


	}
	orderedItems();

	const fetchproductdetails = () => {
		let html = null;
		let count = 0;

		$.ajax({
			url: base_url + 'salesrepside/fetchproductdetails',
			method: 'POST',
			success: function (data) {

				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#allproductdetails').html('<span class="text text-danger">No data found</span');
					return false;
				}

				getData.map(d => {
					count++;
					html += `<tr>
					<td>${count}</td>
	 		 <td>${d.product_name}</td>
<td>${d.quantity}</td>
<td>${d.sellingprice}</td>
<td>
<button class="btn btn-outline-success addtocart" product_id="${d.products_id}" availablequantity="${d.quantity}" price="${d.sellingprice}" product_name="${d.product_name}">
<i class="fa fa-shopping-cart"></i>&nbsp; 
ADD TO CART
</button>
</td>
				</tr>`;
				});

				$('#allproductdetails').html(html);



			},
			error: function (err) {
				console.error('Error found', err);
			}
		});

	}

	fetchproductdetails();
	const showoffCustomerdetails = () => {

		let html = null;
		let count = 0;
		$.ajax({
			url: base_url + 'salesrepside/showcustomerdetails',
			method: 'POST',
			success: function (data) {

				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#customerDetails').html('<span class="text text-danger">No data found</span');
					return false;
				}

				getData.map(d => {
					count++;
					html += `<tr>
					<td>${count}</td>
	 				<td>${d.customer_name}</td>
					<td>${d.customer_phoneNo}</td>
					<td>${d.customer_nic}</td>
					<td>${d.customer_moneyforward}</td>
					<td>
				${d.shop_photo!="" ? `<img src="${base_url}assets/img/shopphotos/${d.shop_photo}" style="max-width:80px;max-height:80px;cursor:pointer;" class="img-fluid imageopen">` : `<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/480px-No_image_available.svg.png" style="max-width:80px;max-height:80px;cursor:pointer;" class="img-fluid imageopen">`}

</td>
	 
				</tr>`;

				});

				$('#customerDetails').html(html);



			},
			error: function (err) {
				console.error('Error found', err);
			}
		});



	}
	showoffCustomerdetails();


	const smsSender = (smssenderTel, sendMessage) => {

		let number = parseInt(smssenderTel);
		$.ajax({
			url: base_url + 'Controllerunit/smssender',
			method: "POST",
			data: {
				smssenderTel: number,
				sendMessage: sendMessage,
			},
			success: function (data) {
				console.log(data);
				alert('SMS SENT successfully');
				window.location.reload();
			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}



	$('#savecustomerdetails').submit(function (e) {
		e.preventDefault();
		$('#btnsavecustomers').val('saving...........Please wait');
		$("#btnsavecustomers").attr('disabled', true);

		let customername = $('#customername').val();
		let customer_nic = $('#customer_nic').val();
		let customer_phoneNo = $('#customer_phoneNo').val();
		let shopimage = $("#shopimage")[0].files[0];
		let customerforwardmessage = $('#customerforwardmessage').val();
		let Message = "Registered successfully at Nowfarspicy."

		let formdata = new FormData();

		formdata.append('customername', customername);
		formdata.append('customer_nic', customer_nic);
		formdata.append('customer_phoneNo', customer_phoneNo);
		formdata.append('shopimage', shopimage);
		formdata.append('customerforwardmessage', customerforwardmessage);

		$.ajax({
			url: base_url + 'salesrepside/saveoffcustomerdetails',
			type: "post",
			data: formdata,
			processData: false,
			contentType: false,
			cache: false,
			success: function (data) {
				alert('Saved successfully');
				smsSender(customer_phoneNo, Message);
			},
			error: function (err) {
				console.log('Error found', err);
			}
		});




	});




	$('body').delegate('.deletecustomerDetails', 'click', function () {

		let customer_id = parseInt($(this).attr('customer_id'));
		let photoLink = $(this).attr('pic_photo');

		if (confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: base_url + 'salesrepside/deleteCustomerdetails',
				method: "POST",
				data: {
					customer_id: customer_id,
					photoLink: photoLink
				},
				success: function (data) {
					swal("Customer has successfully been deleted");
					showoffCustomerdetails();
				},
				error: function (err) {

				}
			});
		}

	});


	$('body').delegate('.editcustomerDetails', 'click', function () {
		let customer_id = parseInt($(this).attr('customer_id'));
		let customer_name = $(this).attr('customer_name');
		let customer_nic = $(this).attr('customer_nic');
		let customer_phoneNo = $(this).attr('customer_phoneNo');
		let shopUrl = $(this).attr('shop_url');

		$('#shop_photooldphoto').val($(this).attr('photoLink'));

		$('#editcustomerdetailsModal').modal('show');

		$('#hidden_id').val(customer_id);
		$('#ucustomername').val(customer_name);
		$('#ucustomer_nic').val(customer_nic);
		$('#ucustomer_phoneNo').val(customer_phoneNo);

		$('#updatecustomerdetailsphoto').attr('src', shopUrl);


	});




	$('#updatecustomerdetails').submit(function (e) {

		e.preventDefault();

		let customername = $('#ucustomername').val();
		let customer_nic = $('#ucustomer_nic').val();
		let customer_phoneNo = $('#ucustomer_phoneNo').val();
		let shopimage = $("#uushopimage")[0].files[0];
		let shop_photooldphoto = $('#shop_photooldphoto').val();
		let hidden_id = parseInt($('#hidden_id').val());

		let formdata = new FormData();

		formdata.append('customername', customername);
		formdata.append('customer_nic', customer_nic);
		formdata.append('customer_phoneNo', customer_phoneNo);
		formdata.append('shopimage', shopimage);
		formdata.append('shop_photooldphoto', shop_photooldphoto);
		formdata.append('hidden_id', hidden_id);

		$.ajax({
			url: base_url + 'salesrepside/updateallcustomerdetails',
			type: "post",
			data: formdata,
			processData: false,
			contentType: false,
			cache: false,
			success: function (data) {

				$("#editcustomerdetailsModal").modal('hide');
				$('#updatecustomerdetails')[0].reset();
				swal("Saved successfully", "Customer has been updated succesfully", "info");
				showoffCustomerdetails();
			},
			error: function (err) {
				console.log('Error found', err);
			}
		});

	});


	const showoffwhatisinsidecart = () => {
		$.ajax({
			url: base_url + 'salesrepside/showoffwhatisinsidecart',
			method: "POST",
			success: function (data) {


			},
			error: function (err) {
				alert('Error message' + err);
			}
		});

	}
	showoffwhatisinsidecart();

	$('body').delegate('.addtocart', 'click', function () {
		let product_id = parseInt($(this).attr('product_id'));
		let availablequantity = parseInt($(this).attr('availablequantity'));
		let price = parseFloat($(this).attr('price'));
		let productName = $(this).attr('product_name');
		
		
		let quantityvalue = parseInt($('.quantityvalue').val());
		
		if (product_id == "" || availablequantity == "" || price == "" || productName == "") {
			alert('Field missing');
			return false;
		}
		quantityvalue++; 
		
		if(quantityvalue >availablequantity){
			 alert('Quantity exceeded');
			return false; 
		}
		
		 
	 
		$.ajax({
			url: base_url + 'salesrepside/addtocart',
			method: "POST",
			data: {
				product_id: product_id,
				availablequantity: availablequantity,
				price: price,
				productName: productName
			},
			success: function (data) {

				alert('Added to cart successfully');
				orderedItems();
			},
			error: function (err) {
				alert('Error message' + err);
			}
		});

	});


	$("#searchproducts").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#allproductdetails tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});


	$('body').delegate('.removefromcard', 'click', function () {
		let productid = $(this).attr('productsid');

		if (confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: base_url + 'salesrepside/removefromcard',
				method: "POST",
				data: {
					productid: productid
				},
				success: function (data) {

					alert('Item removed from cart');
					orderedItems();
				},
				error: function (err) {
					alert('Error message' + err);
				}
			});
		}

	});



	$('body').delegate('.quantityvalue', 'keyup', function () {
		const numberReg = /^[0-9]+$/;
		let value = $(this).val();
		let productid = $(this).attr('productid');
		let availablequantity = parseInt($(this).attr('availablequantity'));
		if (value == "") {

			alert('Please choose Quantity');
			return false;
		}

		if (value > availablequantity) {
			alert('Maximum available quantity :' + availablequantity);
			$(this).val(availablequantity);
			value = availablequantity;
		}

		$.ajax({
			url: base_url + 'salesrepside/quantityaddedtovalue',
			method: "POST",
			data: {
				productid: productid,
				value: value
			},
			success: function (data) {

				orderedItems();
			},
			error: function (err) {
				alert('Error message' + err);
			}
		});


	});


	$('#searchcustomer').keyup(function () {
		let value = $(this).val();
		$('#okaymessageshown').removeClass('badge badge-success');
		$('#okaymessageshown').removeClass('badge badge-danger');
		$('#okaymessageshown').addClass('spinner-border text-primary');
		$('#okaymessageshown').html('');
		$('#hidden_customerid').html('');
		let id = 0;
		if (value == "") {
			$('#okaymessageshown').html('');
			return false;
		}

		$.ajax({
			url: base_url + 'salesrepside/findoutcustomer',
			method: "POST",
			data: {
				value: value,

			},
			success: function (data) {
				let getData = JSON.parse(data);

				if (data == 0) {
					$('#okaymessageshown').removeClass('badge badge-success');

					$('#okaymessageshown').addClass('badge badge-danger text-white');
					$('#okaymessageshown').html('Not found  ❎ ');
					$("#btnmakeorder").attr('disabled', true);

				} else {
					$('#okaymessageshown').removeClass('badge badge-danger');

					$('#okaymessageshown').addClass('badge badge-success');
					$('#okaymessageshown').html('Found ✅');
					id = getData.map(d => d.customer_id);
					id = parseInt(id);
					$("#hidden_customerid").val(id);
					$('#btnmakeorder').attr('disabled', false);


				}

			},
			error: function (err) {
				alert('Error message' + err);
			}
		});

	});

	const takesolddetails = (getId, hidden_id, paymentType, orderingdate) => {

		let uniqueKey = parseInt(getId);
		let id = hidden_id;
		let pType = paymentType;
		let date = orderingdate;

		let recievedAmount = parseFloat($("#recievedAmount").val());
		$.ajax({
			url: base_url + 'salesrepside/placetheorder',
			method: "POST",
			data: {
				uniqueKey: uniqueKey,
				id: id,
				pType: pType,
				date,
				recievedAmount: recievedAmount
			},
			success: function (data) {
				alert('Order made successfully');
				window.location.reload();

			},
			error: function (err) {
				console.log(err);
			}
		});




	}


	const makeduepayment = (userid) => {
		let recievedAmount = parseFloat($("#recievedAmount").val());
		let id = parseInt(userid);

		if (recievedAmount != "" || recievedAmount == 0) {

			$.ajax({
				url: base_url + 'salesrepside/makeduepayment',
				method: "POST",
				data: {
					recievedAmount: recievedAmount,
					id: id
				},
				success: function (data) {

				},
				error: function (err) {
					alert('Error message' + err);
				}
			});

		} else {
			$('#recievedAmount').css('border', '2px solid red');
			alert('Please enter the recieved amount');
			return false;
		}

	}

	$("#recievedAmount").keyup(function (e) {
		let value = e.target.value;
		if (value == "") {
			$("#balancetobegiven").html('Rs.' + discountedValueasgeneral);

		} else if (value > discountedValueasgeneral) {
			$(this).val(discountedValueasgeneral);
			$("#balancetobegiven").html('Rs.0.00');
		} else {
			let balance = discountedValueasgeneral - value;
			$("#balancetobegiven").html('Rs.' + balance.toFixed(2));

		}

	});


	$('#paymentType').change(function (e) {
		let value = parseInt(e.target.value);

		let oldprice, newprice, discountvalue, discountedAmount, balance = null;

		oldprice = parseFloat($("#totalamounttoget").val());
		discountvalue = (oldprice / 100) * value;
		discountedAmount = oldprice - discountvalue;

		$("#discountedValue").html('Rs.' + discountvalue.toFixed(2));
		$('#discountpercentage').html(value + '%');
		$('#amountforrecieving').html('Rs.' + discountedAmount.toFixed(2));
		$('#balancetobegiven').html('Rs.' + discountedAmount.toFixed(2));

		let recievedAmount = parseFloat($("#recievedAmount").val());
		discountedValueasgeneral = discountedAmount


	});

	$('#btnmakeorder').click(() => {

		$(this).attr('Placing order............Please wait');
		$(this).attr('disabled', true);
		let hidden_id = parseInt($('#hidden_customerid').val());
		let paymentType = $("#paymentType").val();
		let orderingdate = $("#orderingdate").val();
		let searchcustomer = $("#searchcustomer").val();

		if (searchcustomer == "") {
			alert('Please choose the person');
			$("#searchcustomer").css('border', '2px solid red');
			return false;
		}

		if (hidden_id == "") {
			alert('Please select customer');
			return false;
		}

		if (paymentType == "-" || paymentType == "") {
			alert('Please choose the payment type');
			return false;
		}

		if (orderingdate == "") {
			alert('Please enter the date');
			return false;
		}


		let getId = 0;
		$.ajax({
			url: base_url + 'salesrepside/takesolddetails',
			method: "POST",
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					getId = 0;
				} else {
					getData.map(d => {
						getId = parseInt(d.solddetails_id);
					});
				}

				getId++;
				takesolddetails(getId, hidden_id, paymentType, orderingdate);
			},
			error: function (err) {
				alert('Error message' + err);
			}
		});

	});

	$("#searchdue").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#showoffduecollectionforrep tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});


	$('body').delegate('.paymentmodaltrigger', 'click', function () {
		$('#loanamount').val($(this).attr('loanamount'));
		$("#payableamount").val($(this).attr('loanamount'));
		$('#hidden_id').val($(this).attr('cus_id'));
		$('#uniquekey').val($(this).attr('unique_key'))
		$('#duecollectormodal').modal('show');
	});

	$('#payingamount').keyup(function () {
		let payingamount = $('#payingamount').val();
		let loan = $('#loanamount').val();

		if (payingamount > loan) {
			$("#payingamount").val(loan);
		}
		let sum = (loan - payingamount);
		totalamountforduecollection = sum;
		$('#balancefromdata').html('Balance : ' + sum.toFixed(2));

	});

	$("#frmpaydue").submit(function (e) {
		e.preventDefault();
		let id = parseInt($("#hidden_id").val());
		if ($('#payingamount').val() == "" || $("#loanamount").val() == "" || id == "") {
			alert('Fields are missing');
			return false;
		}

		if ($('#payingamount').val() == "" && $("#loanamount").val() == "" && id == "") {
			alert('Fields are missing');
			return false;
		}

		let uniquekey = $('#uniquekey').val();
		$.ajax({
			url: base_url + 'salesrepside/settleamount',
			method: "POST",
			data: {
				recievedAmount: totalamountforduecollection,
				id: id,
				uniquekey: uniquekey
			},
			success: function (data) {
				alert('Payment updated');
				window.location.reload();
			},
			error: function (err) {
				alert('Error message' + err);
			}
		});
	});





}); //end of dc