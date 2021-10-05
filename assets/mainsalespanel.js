$(document).ready(function () {
	const base_url = $("#base_url").val();

	function openloanrecieptamount(balance_amount,payment_to_bepadi,recieving_amount){
	 
		$.ajax({
			url: base_url + "Controllerunit/loanpayingreports",
			method: "POST",
			data:{
				balance_amounts:balance_amount,
				payment_to_bepadis:payment_to_bepadi,
				recieving_amounts:recieving_amount
			}, 
	 		success: function (data) {
				 
				window.open(
					`${base_url}/Controllerunit/loanpayingreports`,
					"_blank"
				);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

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


	function checkAlldetails() {
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

		$.ajax({
			url: base_url + "Controllerunit/checkinitialpaymentstatus",
			method: "POST",
			data: {
				value: mydate,
			},
			success: function (data) {
				if (data == 0) {
					$("#initial_payment_modal").modal("show");
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	checkAlldetails();

	function registerDetailsection() {
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

		$.ajax({
			url: base_url + "Controllerunit/registerDetailsection",
			method: "POST",
			data: {
				mydate: mydate,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.log(getData);
				if (getData != 0) {
					getData.map((d) => {
						$("#cashon_hands").html(
							"Rs." + parseFloat(d.cash_in_hand).toFixed(2)
						);
						$("#cash_payments").html(
							"Rs." + parseFloat(d.cash_payment).toFixed(2)
						);
						$("#cheque_payments").html(
							"Rs." + parseFloat(d.cheque_payment).toFixed(2)
						);
						$("#Total_refunds").html(
							"Rs." + parseFloat(d.refunded_amount).toFixed(2)
						);
						$("#credit_sales").html(
							"Rs." + parseFloat(d.credit_payment).toFixed(2)
						);
					});
				} else {
					$("#cashon_hands").html("Rs." + parseFloat(0).toFixed(2));
					$("#cash_payments").html("Rs." + parseFloat(0).toFixed(2));
					$("#cheque_payments").html("Rs." + parseFloat(0).toFixed(2));
					$("#Total_refunds").html("Rs." + parseFloat(0).toFixed(2));
					$("#credit_sales").html("Rs." + parseFloat(0).toFixed(2));
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	registerDetailsection();



	function chequeSaveDetailsforregister(value) {
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

	 

		$.ajax({
			url: base_url + "Controllerunit/chequeSaveDetailsforregister",
			method: "POST",
			data: {
				mydate: mydate,
				myvalue: value,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				
				console.log('From check payment register details',getData);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	function savedetailsforcreditinregister(value) {
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

		$.ajax({
			url: base_url + "Controllerunit/savedetailsforcreditinregister",
			method: "POST",
			data: {
				mydate: mydate,
				myvalue: value,
			},
			success: function (data) {
			 
				let getData = JSON.parse(data);
				console.log(getData);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	function saveCashpaymentforregisterdetails(value) {
		$.ajax({
			url: base_url + "Controllerunit/saveCashpaymentforregisterdetails",
			method: "POST",
			data: {
				mydate: getfulldate(),
				myvalue: value,
			},
			success: function (data) {
				let getData = JSON.parse(data);
			 
				console.log('Save cash payment details for register',getData);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	$("#save_payment_section_details_forInitial").click(function () {
		let initial_payment_section = $("#initial_payment_section").val();

		if (initial_payment_section == "") {
			toastr.error("Initial payment is required");
			$("#initial_payment_section").css("border", "2px solid red");
			$("#initial_payment_section").focus();
			return false;
		}
		if (isNaN(initial_payment_section)) {
			toastr.error("Only digits are accepted");
			$("#initial_payment_section").css("border", "2px solid red");
			$("#initial_payment_section").focus();
			return false;
		}

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

		$.ajax({
			url: base_url + "Controllerunit/updateinitialpaymentsection",
			method: "POST",
			data: {
				mydate: mydate,
				initial_payment_section: initial_payment_section,
			},
			success: function (data) {
				alert("Updated successfully");
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#customer_typeselect").change(function () {
		let type_customer = $(this).val();
		if (type_customer != "walkin") {
			$("#customer_tag").removeClass("d-none");
			$("#customertypechosensection").removeClass("d-none");
		} else {
			$("#customer_tag").addClass("d-none");
			$("#customertypechosensection").addClass("d-none");

			$.ajax({
				url: base_url + "Controllerunit/resetidforcustomers",
				method: "POST",
				success: function (data) {},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$("#trigger_initial_payment").click(function () {
		$("#initial_payment_modal").modal("show");
	});

	const create_invoice_id = () => {
		let invoice_id = null;
		$.ajax({
			url: base_url + "Controllerunit/create_invoice_id",
			method: "POST",
			success: function (mydata) {
				let getData = JSON.parse(mydata);

				data = parseInt(
					getData.map((d) =>
						d.order_summery_id == null ? 0 : d.order_summery_id
					)
				);

				data++;

				if (data < 100) {
					invoice_id = "00" + data;
				} else if (data < 10) {
					invoice_id += "000" + data;
				} else if (data > 100) {
					invoice_id = data;
				}

				if (invoice_id == null) {
					alert("Invoice is not found");
					window.location.reload();
				} else {
					$("#invoice_id_hidden").val(invoice_id);
					sessionStorage.setItem("sales_invoice_id", invoice_id);
					$("#reciept_invoice_section").html("Reciept : " + invoice_id);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};
	create_invoice_id();

	const deletealldataforreturnedatable = () => {
		$.ajax({
			url:
				base_url +
				"Controllerunit/savetempodeletealldataforreturnedatablerarydateforsale",
			method: "POST",
			success: function (data) {},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	deletealldataforreturnedatable();

	function savecurrentdateinsession(){
		
		$.ajax({
			url: base_url + "Controllerunit/savecurrentdateinsession",
			method: "POST",
			data:{
				currentdate : getfulldate()
			}, 
			success: function (data) {
               
	 		},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}
    
	savecurrentdateinsession();

    function getoutlet_id(){
        $.ajax({
			url: base_url + "Controllerunit/getoutlet_id",
			method: "POST",
			success: function (data) {
               
			 sessionStorage.setItem('outlet_id',data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
    }

    getoutlet_id();

	const savetemporarydateforsale = () => {
		let discountpercentage = $("#discountpercentage").html();
		let subtractamounttotally = $("#subtractamounttotally").html();
		let totalamount = $("#totalamount").html();
		let amounttoshowoffpaying = $("#amounttoshowoffpaying").html();

		let dicountvalue = $("#dicountvalue").html();

		let individualdiscountamount = $('#individualdiscountamount').html(); 



		$.ajax({
			url: base_url + "Controllerunit/savetemporarydateforsale",
			cache: true,
			data: {
				discountpercentage: discountpercentage,
				subtractamounttotally: subtractamounttotally,
				totalamount: totalamount,
				amounttoshowoffpaying: amounttoshowoffpaying,
				dicountvalue: dicountvalue,
				individualdiscountamount:individualdiscountamount
			},
			method: "POST",
			success: function (data) {
				console.log(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	savetemporarydateforsale();
	setInterval(function () {
		savetemporarydateforsale();
	}, 1500);

	function getdateandtime() {
		var months = [
			"January",
			"February",
			"March",
			"April",
			"May",
			"Jun",
			"Jul",
			"Aug",
			"Sep",
			"October",
			"November",
			"December",
		];
		var days = [
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday",
		];
		var d = new Date();
		var day = days[d.getDay()];
		var hr = d.getHours();
		var min = d.getMinutes();
		if (min < 10) {
			min = "0" + min;
		}
		var ampm = "AM";
		if (hr > 12) {
			hr -= 12;
			ampm = "PM";
		}
		var date = d.getDate();
		var month = d.getMonth() + 1;
		var year = d.getFullYear();

		let fullTime =
			month + "/" + date + "/" + year + "  " + hr + ":" + min + " " + ampm;

		return fullTime;
	}

	const deltetemporarycopy = () => {
		$.ajax({
			url: base_url + "Controllerunit/deltetemporarycopy",
			method: "POST",
			success: function (mydata) {},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	deltetemporarycopy();

	const fulltimewithdate = () => {
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

		let fulltime = new Date().toLocaleTimeString();
		return mydate + " " + fulltime;
	};

	const getonlydate = () => {
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

		let fulltime = new Date().toLocaleTimeString();
		return mydate;
	};

	const showOffTimeForFront = () => {
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

		let fulltime = new Date().toLocaleTimeString();
		$("#full_time").html(
			"Time : " + mydate.toString() + " " + fulltime.toString()
		);
	};

	setInterval(showOffTimeForFront, 1500);

	function fetchDatafordiscount() {
		let percentagevalue = 0;
		$.ajax({
			url: base_url + "Controllerunit/fetchDatafordiscount",
			method: "POST",
			data: {
				percentagevalue: percentagevalue,
			},
			success: function (data) {
				let item = JSON.parse(data);

				$("#totalamount").html("Rs." + item.total);
				$("#amounttoshowoffpaying").html("<br/>Rs." + item.total);
			 
				$("#amounttoshowoffpaying_second").html("<br/>Rs." + item.total);

				$("#totalamounttocalculate").val(item.valuetototal);
 
				$("#total_amount_cash").val(item.valuetototal);

				$("#paying_amount_given").val(item.valuetototal);

				$("#discountpercentage").html(0 + "%");
				$("#percentage_for_print_inv").html(0 + "%");
				$('#subtractamounttotally').html(0); 

				$("#dicountvalue").html("Rs.0");
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	$("#subtractamounttotally").click(function () {
		var amount = prompt("Enter Amount to subtract :", "");
		let totalamounttocalculate = $("#totalamounttocalculate").val();
		totalamounttocalculate = parseFloat(totalamounttocalculate);
		amount = parseFloat(amount);
		$('#subtractamounttotally').html(parseFloat(amount).toFixed(2)); 
		let answer = 0;
		if (amount != null) {
			answer = totalamounttocalculate - amount;
					

			$("#totalamounttocalculate").val(answer);
			$("#paying_amount_given").val(answer);

			$("#total_amount_cash").val(answer);

			$("#totalamount").html("Rs." + totalamounttocalculate.toFixed(2));
			$("#amounttoshowoffpaying").html("<br/>Rs." + answer.toFixed(2));
			$("#after_subtracted").html("<br/> <b>Rs." + answer.toFixed(2) + "</b>");

			$.ajax({
				url: base_url + "Controllerunit/savesubtractedamounttocache",
				data:{
					answer:amount
				}, 
				method: "POST",
				success: function (mydata) {
				 
					console.log(mydata); 
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});


		}
	});

	$("#discountpercentage").click(function () {
		var percentage = prompt("Enter percentage :", "");
		let totalamounttocalculate = $("#totalamounttocalculate").val();

		let percentagevalue = null;
		if (percentage != null) {
			$("#discountpercentage").html(percentage + "%");
			$("#percentage_for_print_inv").html(percentage + "%");
			percentagevalue = (totalamounttocalculate / 100) * percentage;
			$("#dicountvalue").html("Rs." + percentagevalue.toFixed(2));
			$("#percentage_value").html("Rs. " + percentagevalue.toFixed(2));
			$.ajax({
				url: base_url + "Controllerunit/fetchDatafordiscount",
				method: "POST",
				data: {
					percentagevalue: percentagevalue,
				},
				success: function (data) {
					toastr.info("Discounted successfully");
					let item = JSON.parse(data);
					totalamounttocalculate = parseFloat(totalamounttocalculate);

					$("#totalamount").html("Rs." + totalamounttocalculate.toFixed(2));
					$("#amounttoshowoffpaying").html("<br/>Rs." + item.total);
					$("#after_subtracted").html("<br/> <b>Rs." + item.total + "</b>");

					$("#totalamounttocalculate").val(item.valuetototal - percentagevalue);
					$("#paying_amount_given").val(item.valuetototal - percentagevalue);

					$("#total_amount_cash").val(item.valuetototal - percentagevalue);
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$("#paying_amount").keyup(function () {
		let paying_amount = $(this).val();
		let total_amount_cash = parseFloat($("#total_amount_cash").val());
		let answer = 0;

		if (isNaN(paying_amount)) {
			toastr.warning("Only numbers are allowed");
			$(this).val("");
			$(this).css("border", "2px solid red");
			return false;
		}

		$(this).css("border", "1px solid black");

		if (paying_amount > total_amount_cash) {
			$('#balanbce_status_for_sales').html('Balance');
			$('#balanbce_status_for_sales').removeClass('badge badge-danger');  
 			$('#balanbce_status_for_sales').addClass('badge badge-success badge-info'); 
	
		}
		else if(paying_amount==total_amount_cash){

			$('#balanbce_status_for_sales').html('Cash');
			$('#balanbce_status_for_sales').removeClass('badge badge-danger'); 
			$('#balanbce_status_for_sales').removeClass('badge badge-success'); 
			$('#balanbce_status_for_sales').addClass('badge badge-info');  

		}
		
		else {
			$('#balanbce_status_for_sales').html('Credit');
			$('#balanbce_status_for_sales').removeClass('badge badge-success badge-info'); 
			$('#balanbce_status_for_sales').addClass('badge badge-danger');  


		}
		

		paying_amount = parseFloat(paying_amount);
		answer = total_amount_cash - paying_amount;
		$("#balance_amountbycash").val(answer);
	});

	function getCustomeridbfortemp() {
		$.ajax({
			url: base_url + "Controllerunit/getCustomeridbfortemp",
			method: "POST",
			success: function (data) {
				$("#temp_customer_id").val(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	$("#mobilenumberforcutomersearch").keyup(function (e) {
		if (e.keyCode === 13) {
			let value = $(this).val();
			if (value == "") {
				toastr.warning("Please enter the mobile number to search");
				return false;
			}

			if (isNaN(value)) {
				toastr.error("Only numbers are allowed");
				return false;
			}

			if (value.length != 10) {
				toastr.error("Mobiler number must be 10 digits");
				return false;
			}

			$.ajax({
				url: base_url + "Controllerunit/searchmobilenumber",
				method: "POST",
				data: {
					value: value,
				},
				success: function (data) {
					if (data == 1) {
						$("#messagesectionoffound").removeClass("text-danger");
						$("#messagesectionoffound").addClass("text-success");
						$("#messagesectionoffound").html("Found ✔");
						getCustomeridbfortemp();
					} else {
						$("#messagesectionoffound").removeClass("text-success");
						$("#messagesectionoffound").addClass("text-danger");
						$("#messagesectionoffound").html("Not found ❎");
					}
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	function enterKey() {
		return $.Event("keypress", { which: 13 });
	}

	$("#savecustomer").submit(function (e) {
		e.preventDefault();
		let customer_name = $("#customer_name").val();
		let customer_mobile = $("#customer_mobilenumber").val();
		let customer_address = $("#customer_address").val();

		if (customer_name == "") {
			toastr.danger("Customer name is required");
			return false;
		}
		if (customer_mobile == "") {
			alert("Customer mobile number is required");
			return false;
		}

		$.ajax({
			url: base_url + "Controllerunit/savecustomers",
			method: "POST",
			data: {
				customerName: customer_name,
				customerMobileNumber: customer_mobile,
				customer_address: customer_address,
			},
			success: function (data) {
				if (data == 1) {
					toastr.info(
						"Customers already exist. Please search using mobile number"
					);
					$("#mobilenumberforcutomersearch").focus();
					setTimeout(function () {
						$("#addcustomersection").modal("hide");
						$("#mobilenumberforcutomersearch").focus();
					}, 100);
					return false;
				} else {
					$("#addcustomersection").modal("hide");
					$("#mobilenumberforcutomersearch").val(customer_mobile);
					$("#mobilenumberforcutomersearch").focus();
					$("#mobilenumberforcutomersearch").trigger(enterKey());
					toastr.success("Saved successfully");
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	const addcardzahras = () => {
		$("#paying_amount_cus_dis").html("asdsad");
	};

	const getsubtotalanddiscount = () => {
		let totalvalue = 2.5;

		$.ajax({
			url: base_url + "Controllerunit/getsubtotalanddiscount",
			method: "POST",
			success: function (data) {
				$("#subtotalvalue").html("<strong>Rs." + data + "</strong>");
				$("#after_subtracted").html("<strong>Rs." + data + "</strong>");
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	const getdataforprintfromshoppingcart = () => {
		getsubtotalanddiscount();
		$.ajax({
			url: base_url + "Controllerunit/getdataforprintfromshoppingcart",
			method: "POST",
			success: function (data) {
				console.log(data);
				$("#product_details_to_display_forinvoice").html(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

 

	$(document).on("keypress", ".fullquantity_fromcashier", function(e){
        if(e.which == 13){
             let value = $(this).val(); 
			 let rowid = $(this).attr('rowid'); 
			 if(isNaN(value)){
				 toastr.error("Only numbers are accepted for quantity"); 
				 $(this).css('border','2px solid red'); 
				 $(this).focus(); 
			 } 
			 else {
				$.ajax({
					url: base_url + "Controllerunit/changequantitysectionfromcashier",
					method: "POST",
					data:{
						value:value,
						rowid:rowid
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
						console.error("Error found", err);
					},
				});
					 

			 }
        }
    });

	const fetchAllshoppingcartdata = () => {
		let totalnumberofpcs = 0;
		fetchDatafordiscount();
		getdataforprintfromshoppingcart();

		let totalvaluesection = 0.00; 

		$.ajax({
			url: base_url + "Controllerunit/fetchAllshoppingcartdata",
			method: "POST",
			success: function (data) {
			 
				console.log('From fetch all shopping data',data);
				$("#showOffAllcartdetails").html(data);

				$(".fullquantity").each(function () {
					totalnumberofpcs += parseInt($(this).val());
				});
 

				$("#numberof_pcs_for_print").html("No of Pcs : " + totalnumberofpcs);
			},
			error: function (err) {
				console.error("Error found from fetch ordered products", err);
			},
		});
	};

	fetchAllshoppingcartdata();

	$("#btnholdamountforcustomer").click(function () {
		if ($("#mobilenumberforcutomersearch").val() == "") {
			toastr.error("Please choose the customer");
			$("#mobilenumberforcutomersearch").focus();
			return false;
		}

		if ($("#messagesectionoffound").html() != "Found ✔") {
			toastr.error("Please choose the customer");
			$("#mobilenumberforcutomersearch").focus();
			return false;
		}

		$(this).attr("disabled", true);
		$.ajax({
			url: base_url + "Controllerunit/holdorders",
			method: "POST",
			data: {
				datetime: fulltimewithdate(),
			},
			success: function (data) {
				alert("Orders are on holding");
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});


	
	$("#btnholdamountforcustomer_second").click(function () {
		if ($("#mobilenumberforcutomersearch").val() == "") {
			toastr.error("Please choose the customer");
			$("#mobilenumberforcutomersearch").focus();
			return false;
		}

		if ($("#messagesectionoffound").html() != "Found ✔") {
			toastr.error("Please choose the customer");
			$("#mobilenumberforcutomersearch").focus();
			return false;
		}

		$(this).attr("disabled", true);
		$.ajax({
			url: base_url + "Controllerunit/holdorders",
			method: "POST",
			data: {
				datetime: fulltimewithdate(),
			},
			success: function (data) {
				alert("Orders are on holding");
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});




	$(".btnaddshoppingcart").click(function () {
		$.ajax({
			url: base_url + "Controllerunit/addtocartshoppingcart",
			method: "POST",
			data: {
				product_price: $(this).attr("product_price"),
				product_id: $(this).attr("product_id"),
				product_pic: $(this).attr("product_pic"),
				product_unit: $(this).attr("product_unit"),
				availablequantity: $(this).attr("availablequantity"),
				product_name: $.trim($(this).attr("product_name")),
				product_code: $(this).attr("product_code"),
			},
			success: function (data) {
			 
				console.log('ADD TO CART',data); 
				toastr.info("Added successfully");
				fetchAllshoppingcartdata();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("body").delegate(".increasequantity", "click", function () {
		let qty = parseInt($(this).attr("qty"));
		let rowid = $(this).attr("rowid");

		$.ajax({
			url: base_url + "Controllerunit/increasequantity",
			method: "POST",
			data: {
				qty: qty,
				rowid: rowid,
			},
			success: function (data) {
				toastr.info("Increased...");
				fetchAllshoppingcartdata();
				fetchallindividualdiscount(); 
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("body").delegate(".decreasequantity", "click", function () {
		let qty = parseInt($(this).attr("qty"));
		let rowid = $(this).attr("rowid");

		$.ajax({
			url: base_url + "Controllerunit/decreasequantity",
			method: "POST",
			data: {
				qty: qty,
				rowid: rowid,
			},
			success: function (data) {
				toastr.warning("Decreased...");
				fetchAllshoppingcartdata();
				fetchallindividualdiscount();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("body").delegate(".deleteproduct", "click", function () {
		let rowid = $(this).attr("rowid");

		$.ajax({
			url: base_url + "Controllerunit/deleteproductforcart",
			method: "POST",
			data: {
				rowid: rowid,
			},
			success: function (data) {
				alert("Removed successfully");
				fetchAllshoppingcartdata();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#clear_all_in_cart").click(function () {
		if (confirm("Are you sure you want to remove all in cart?")) {
			$.ajax({
				url: base_url + "Controllerunit/removeallincart",
				method: "POST",
				success: function (data) {
					toastr.error("Everything is removed from cart...");
					fetchAllshoppingcartdata();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});


	$("#clear_all_in_cart_second").click(function () {
		if (confirm("Are you sure you want to remove all in cart?")) {
			$.ajax({
				url: base_url + "Controllerunit/removeallincart",
				method: "POST",
				success: function (data) {
					toastr.error("Everything is removed from cart...");
					fetchAllshoppingcartdata();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});








	$(".deletedraft").click(function () {
		let shopping_hold = parseInt($(this).attr("shopping_hold"));

		if (confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: base_url + "Controllerunit/deletedraftsection",
				method: "POST",
				data: {
					shopping_hold: shopping_hold,
				},
				success: function (data) {
					alert("Deleted successfully");
					window.location.reload();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$(".list_all_hold_products_btn").click(function () {
		let shopping_hold_id = parseInt($(this).attr("shopping_hold_id"));
		let html = "";

		$.ajax({
			url: base_url + "Controllerunit/list_all_holdshowoffproduct",
			method: "POST",
			data: {
				shopping_hold_id: shopping_hold_id,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					alert("No product is found");
					return false;
				} else {
					console.log(getData);
					getData.map((d) => {
						let quantity = parseInt(d.quantity);
						let price = parseFloat(d.product_price);
						html += `<tr>
                        <td>${d.product_name}</td>
                        <td>${d.quantity}</td>
                        <td>${d.product_price}</td>
                        <td>${quantity * price}</td>
                        </tr>`;
					});
					$("#list_out_product_section").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$(".getholdbackbtn").click(function () {
		if ($("#showOffAllcartdetails tr").length != 0) {
			toastr.error("Products are already available in cart. Please remove all");
			return false;
		}
		let shopping_hold = parseInt($(this).attr("shopping_hold"));
		if (confirm("Are you sure you want to return it to sales panel?")) {
			$.ajax({
				url: base_url + "Controllerunit/getproductback",
				method: "POST",
				data: {
					shopping_hold: shopping_hold,
					fulltimewithdate: fulltimewithdate(),
				},
				success: function (data) {
					window.location.reload();
					fetchAllshoppingcartdata();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$(".request_quantity").keyup(function () {
		let value = $(this).val();
		let warehousequantity = parseInt($(this).attr("warehousequantity"));

		if (isNaN(value)) {
			toastr.error("Only numbers are acceptable in that field");
			$(this).val("");
			return false;
		}
		value = parseInt(value);

		if (value > warehousequantity) {
			toastr.info(
				"Requested quantity can not be more than available quantity in warehouse"
			);
			$(this).val(warehousequantity);
		}
	});

	$(".undo_request").click(function () {
		let product_id = parseInt($(this).attr("product_id"));
		if (confirm("Aer you sure you want to undo requrest?")) {
			$.ajax({
				url: base_url + "Controllerunit/undorequestsection",
				data: {
					product_id: product_id,
				},
				method: "POST",
				success: function (data) {
					alert("Request has been undone");
					window.location.reload();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$(".request_quantity_btn").click(function () {
		let value = parseInt(
			$(this).parent().parent().find(".request_quantity").val()
		);
		let product_id = parseInt($(this).attr("product_id"));

		if (value == "") {
			toastr.warning("Please enter the value in request quantity field");
			return false;
		}
		$.ajax({
			url: base_url + "Controllerunit/requestquantity",
			data: {
				value: value,
				product_id: product_id,
				fulltimewithdate: fulltimewithdate(),
			},
			method: "POST",
			success: function (data) {
				alert("Request has been sent to warehouse");
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	const reduceProductQuantity = (lastinsertid) => {
		$.ajax({
			url: base_url + "Controllerunit/reduceProductQuantity",
			method: "POST",
			data: {
				todydate: getfulldate(),
				summeryid:lastinsertid 
			},
			success: function (data) {
			 
				console.log("Reduce quantity", data);
				alert("Order has been made successfully");
				window.open(
					`${base_url}/Controllerunit/printinvoicesettings`,
					"_blank"
				);
			},

			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	$("#charge_for_sales").click(function () {
		if ($("#customer_typeselect").val() != "walkin") {
			if ($("#messagesectionoffound").html() != "Found ✔") {
				toastr.info("Please choose the customer");
				$("#mobilenumberforcutomersearch").focus();
				return false;
			}
		}

		



		if ($("#showOffAllcartdetails tr").length == 0) {
			toastr.warning("Please add product");
			return false;
		}

		$(".drawer").drawer("open");
	});


	
	$("#charge_for_sales_second").click(function () {
		if ($("#customer_typeselect").val() != "walkin") {
			if ($("#messagesectionoffound").html() != "Found ✔") {
				toastr.info("Please choose the customer");
				$("#mobilenumberforcutomersearch").focus();
				return false;
			}
		}

		



		if ($("#showOffAllcartdetails tr").length == 0) {
			toastr.warning("Please add product");
			return false;
		}

		$(".drawer").drawer("open");
	});








	$("#recieved_amount").keyup(function () {
		let recievedAmount = parseFloat($(this).val());
		let paying_amount_given = parseFloat($("#paying_amount_given").val());

		$("#given_cash_by_customer").html(recievedAmount.toFixed(2));

		let answer = paying_amount_given - recievedAmount;
		$("#cheque_amount_balance").val(answer);
		answer = parseFloat(answer);
		$("#customer_given_balance").html(answer.toFixed(2));

		localStorage.setItem("customer_given_amount", answer.toFixed(2));
	});

	setInterval(function () {
		let total_amount_cash = $("#total_amount_cash").val();
		let balance_amount = $("#balance_amount").val();
		let paying_amount = $("#paying_amount").val();

		let discountpercentage = $("#discountpercentage").html();
		let dicountvalue = $("#dicountvalue").html();
		let totalamount = $("#totalamount").html();

		let amounttoshowoffpaying = $("#amounttoshowoffpaying").html();



		$.ajax({
			url: base_url + "Controllerunit/passalldetailstoformsection",
			method: "POST",
			data: {
				discountpercentage: discountpercentage,
				dicountvalue: dicountvalue,
				paying_amount_given: total_amount_cash,
				recieved_amount: paying_amount,
				balance_amount: balance_amount,
				fulltimewithdate: fulltimewithdate(),
				totalamount: totalamount,
				amounttoshowoffpaying: amounttoshowoffpaying,
			},
			success: function (data) {
				//console.log(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}, 500000);

	const savecreditdetailsbyregisterfromcash = (data) => {
		$.ajax({
			url: base_url + "Controllerunit/savecreditdetailsbyregisterfromcash",
			method: "POST",
			data: {
				saveabledata: data,
				todaydate: getfulldate(),
			},
			success: function (data) {
				//console.log(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};
	//   $this->session->set_userdata('last_insert_id',$last_insert_id);

	$('#paywithcashmodal').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });

	$("#paybycashfrm").submit(function (e) {
		e.preventDefault();
		let total_amount_cash = parseFloat($("#total_amount_cash").val());
		let balance_amount =Math.abs($("#balance_amountbycash").val());
		let paying_amount = parseFloat($("#paying_amount").val());

		let discountpercentage = $("#discountpercentage").html();
		let dicountvalue = $("#dicountvalue").html();

		let sales_invoice_id = sessionStorage.getItem("sales_invoice_id");

		let additional_information = $('#additional_information').val(); 

		if (sales_invoice_id == null) {
		}

		if ((total_amount_cash < paying_amount) || (total_amount_cash==paying_amount)) {
			$.ajax({
				url: base_url + "Controllerunit/saveassessiontogetback",
				method: "POST",
				data: {
					balance_amount : balance_amount 
				},
				success: function (data) {
				 
					 
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
			 
		
		}

		else {
		 //yellback
			if ($("#messagesectionoffound").html() != "Found ✔") {
				 alert("Please choose customer by entering mobile number. Because balance amount will be considered as a credit"); 
				 window.location.reload(); 
			}
			else {
				  
			savecreditdetailsbyregisterfromcash(balance_amount);
 			}
		}

		 

	 

		if (paying_amount == "") {
			toastr.error("Paying amount is required");
			$("#paying_amount").focus();
			return false;
		}

		if (balance_amount == NaN) {
			alert("Please enter recieving amount");
			$("#paying_amount").focus();
			$("#paying_amount").css("border", "2px solid red");
			return false;
		}

	 

		saveCashpaymentforregisterdetails(total_amount_cash);

		$.ajax({
			url: base_url + "Controllerunit/savecashamount",
			method: "POST",
			data: {
				discountpercentage: discountpercentage,
				dicountvalue: dicountvalue,
				paying_amount_given: total_amount_cash,
				recieved_amount: paying_amount,
				balance_amount: balance_amount,
				fulltimewithdate: fulltimewithdate(),
				sales_invoice_id: sales_invoice_id,
				additional_information:additional_information
			},
			success: function (data) {
				//alert(data);
			   console.log(data);
				reduceProductQuantity(data);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#cashier_change_password").submit(function (e) {
		e.preventDefault();
		let current_password = $("#current_password").val();
		let newpassword = $("#newpassword").val();

		if (current_password == "" || newpassword == "") {
			window.location.reload();
		}

		$.ajax({
			url: base_url + "Controllerunit/checkstaffoldpassword",
			method: "POST",
			data: {
				current_password: current_password,
			},
			success: function (data) {
				if (data == 0) {
					toastr.error("Your old password is wrong. Please check again");
					$("#current_password").focus();
					$("#current_password").css("border", "2px solid red");
					return false;
				} else {
					$.ajax({
						url: base_url + "Controllerunit/changepasswordforstaffs",
						method: "POST",
						data: {
							newpassword: newpassword,
						},
						success: function (data) {
							alert("Password has been changed successfully");
							window.location.reload();
						},
						error: function (err) {
							console.error("Error found", err);
						},
					});
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});
	$('#credit_details_for_saveing').click(function(){
		$('#paywithcreditamountdetailsmodal').modal('show'); 
		$('#amount_for_credit_details').val(parseFloat($('#totalamounttocalculate').val()).toFixed(2)); 
	}); 

	$('#frm_paycreditsection').submit(function(e){
		e.preventDefault(); 



		let value = $("#totalamounttocalculate").val();
		let additional_information = $('#sec_additional_information').val(); 

		let discountpercentage = $("#discountpercentage").html();
		let dicountvalue = $("#dicountvalue").html();
		let sales_invoice_id = sessionStorage.getItem("sales_invoice_id");
		let temp_customerid = Number($("#temp_customer_id").val());

		if (temp_customerid == "" && temp_customerid == 0) {
			toastr.error("Please choose customer by mobile number");
			$(".drawer").drawer("close");
			$("#customer_typeselect").focus();
			$("#customer_typeselect").css("border", "2px solid red");
			return false;
		}

		if (value == "") {
			window.location.reload();
		} else {
			savedetailsforcreditinregister(value);
			$.ajax({
				url: base_url + "Controllerunit/creditdetailsforsaving",
				method: "POST",
				data: {
					discountpercentage: discountpercentage,
					dicountvalue: dicountvalue,
					fulltimewithdate: fulltimewithdate(),
					sales_invoice_id: sales_invoice_id,
					value: value,
					additional_information:additional_information
				},
				success: function (data) {
					reduceProductQuantity();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	})

	$("#scredit_details_for_saveing").click(function () {
	
	});

	$("#frm_paywithcheque").submit(function (e) {
		e.preventDefault();

		let temp_customerid = Number($("#temp_customer_id").val());

		let bank_name = $("#bank_name").val();
		let bank_branch = $("#bank_branch").val();
		let account_no = $("#account_no").val();
		let paying_amount_given = $("#paying_amount_given").val();
		let cheque_date = $("#cheque_date").val();
		let recieved_amount = $("#recieved_amount").val();
		let cheque_amount_balance = $("#cheque_amount_balance").val();

		let discountpercentage = $("#discountpercentage").html();
		let dicountvalue = $("#dicountvalue").html();

		let sales_invoice_id = sessionStorage.getItem("sales_invoice_id");

		let paywithcheck_additoinalinformation = $('#paywithcheck_additoinalinformation').val(); 

		if (temp_customerid == "" || temp_customerid == 0) {
			toastr.error("Please choose customer by mobile number");
			$("#paywithcashmodal").modal("hide");
			$("#customer_typeselect").focus();
			$("#customer_typeselect").css("border", "2px solid red");
			return false;
		}

		if (
			bank_name != "" &&
			bank_branch != "" &&
			account_no != "" &&
			paying_amount_given != "" &&
			cheque_date != "" &&
			recieved_amount != "" &&
			cheque_amount_balance != ""
		) {
			chequeSaveDetailsforregister(paying_amount_given);

			$.ajax({
				url: base_url + "Controllerunit/savechequepayment",
				method: "POST",
				data: {
					discountpercentage: discountpercentage,
					dicountvalue: dicountvalue,
					bank_name: bank_name,
					bank_branch: bank_branch,
					account_no: account_no,
					paying_amount_given: paying_amount_given,
					cheque_date: cheque_date,
					recieved_amount: recieved_amount,
					cheque_amount_balance: cheque_amount_balance,
					fulltimewithdate: fulltimewithdate(),
					sales_invoice_id: sales_invoice_id,
					paywithcheck_additoinalinformation:paywithcheck_additoinalinformation
				},
				success: function (data) {
					reduceProductQuantity();
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$("#logout_section").click(function () {
		$.ajax({
			url: base_url + "Controllerunit/salespersonlogout",
			method: "POST",
			success: function (data) {
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#search_by_barcode").keyup(function (e) {
		if (e.keyCode === 13) {
			let value = $(this).val();
			 
			$(this).val("");
			$(this).focus();
			let result = false; 

			$(".btnaddshoppingcart").each(function () {
				if ($(this).attr("product_code") == value) {
					$(this).click();
					result = false; 
					return false;
				} else {
					result = true; 
					 
				}
			});

			if(result==true){
				alert('No product found with barcode'); 
			}
		}
	});

	//product_search
	$("#product_search").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$(".all_products_cracker .product_wrapper").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});


    //

	//searchmutedproductssection
    

	$("#searchmutedproductssection").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#product_details_outlet_expired_showoff tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});

	$("#searchforfinishingproductsatwarehouse").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#show_off_producsofrunninginwarehouse tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});


	$("#btnsearchreturnproduct").click(function () {
		let html = null;
		let from_date = $("#from_date").val();
		let to_date = $("#to_date").val();

		if (from_date == "") {
			alert("Please enter the from date to submit");
			return false;
		}
		if (to_date == "") {
			alert("Pleae enter the finishing date to submit");
			return false;
		}

		$.ajax({
			url: base_url + "Controllerunit/searchinvoicebasedpurchase",
			method: "POST",
			data: {
				from_date: from_date,
				to_date: to_date,
			},
			success: function (data) {
				let getData = JSON.parse(data);

				if (getData == 0) {
					$("#all_details_for_return_product").html(
						'<span class="text text-danger font-weight-bold">NO DATA FOUND</span>'
					);
					return false;
				} else {
					$("#all_details_for_return_product").html("");
					getData.map((d) => {
						html = `<tr>
<td>${d.invoice_no}</td>
<td>${d.customer_name == null ? "Walkin customer" : d.customer_name}</td>
<td>${d.customer_mobile == null ? "Walkin Customer" : d.customer_mobile}</td>
<td><button class='btn btn-link btn-sm  show_products_details_btn' ordered_date = '${
							d.ordered_date
						}' order_summery_id='${
							d.order_summery_id
						}'>SHOW products</button></td>
<td>
${d.ordered_date}
</td>
</tr>`;
						$("#all_details_for_return_product").append(html);
					});
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("body").delegate(".show_products_details_btn", "click", function () {
		let order_summery_id = parseInt($(this).attr("order_summery_id"));
		order_summery_id = Number(order_summery_id);

		let ordered_date = $(this).attr("ordered_date").substring(0, 10);

		sessionStorage.setItem("ordered_dateforreturn", ordered_date);

		$("#hidden_order_summery_id").val(order_summery_id);
		let html = '';

		let sumoftotalvalue = 0.00; 

		$.ajax({
			url: base_url + "Controllerunit/getproductdetails",
			method: "POST",
			data: {
				order_summery_id: order_summery_id,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.clear(); 
				console.log(getData); 
				if (getData == 0) {
					$("#product_name_section_display").html(
						'<span class="text text-danger font-weight-bold">NO DATA FOUND</span>'
					);
					$('#total_amount_section').html('Rs.'+parseFloat(0).toFixed(2));
					return false;
				} else {
					$("#product_name_section_display").html("");


					getData.map((d) => {
						$('#total_amount_section').html('Rs.'+parseFloat(d.fulltotalamount).toFixed(2));
						sessionStorage.setItem('fulltotalamount',d.fulltotalamount); 
						let subtotal = parseFloat(d.sub_total * d.choosen_quantity);
						sumoftotalvalue = parseFloat(d.sub_total * d.choosen_quantity); 
						html += `<tr>
<td>${d.product_name}</td>
<td class='choosen_quantity_column'>${d.choosen_quantity}</td>
<td class="sub_total_amount_for_total">${parseFloat(d.sub_total).toFixed(2)}</td>
<td>
${subtotal.toFixed(2)}
</td>
<td class='text-center'>
<input type='tel' class='form-control return_quantity_value text-center' value='${d.choosen_quantity}'/>
${
	d.choosen_quantity == 0
		? `<button class="btn btn-primary btn-sm btn-block"  disabled><i class="fa fa-undo" aria-hidden="true"></i> Return</button>`
		: `<button class="btn btn-primary btn-sm return_product_to_sale btn-block" product_id='${d.product_id}' product_name='${d.product_name}' price='${d.sub_total}' discount='${d.discount}' discounted_amount='${d.discounted_amount}' total_amount='${d.fulltotalamount}' products_code='${d.products_code}' choosen_quantity='${d.choosen_quantity}'><i class="fa fa-undo" aria-hidden="true"></i> Return</button>`
}

</td>
</tr>`;
 

					});
					$("#product_name_section_display").html(html);

				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	const productarray = [];

	//meback
	const product_details_to_display_forinvoice_return = () => {
		let html = null;

		let totalvalueofamount = 0;

		let count = 0;

		$.ajax({
			url:
				base_url +
				"Controllerunit/product_details_to_display_forinvoice_return",
			method: "POST",
			success: function (data) {
				let getData = JSON.parse(data);
				console.log(getData);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	
	$("#print_return_invoice").click(function () {
		let totalrefundableamount =0.00; 

		$('.sub_total_amount_for_total').each(function(e){
			totalrefundableamount+=parseFloat($(this).html()); 
		})

		let refundedamount = prompt("Refunded amount",parseFloat(sessionStorage.getItem('fulltotalamount')).toFixed(2));

		let ordered_dateforreturn = sessionStorage.getItem("ordered_dateforreturn");

		 
		if (refundedamount != null) {
			refundedamount = parseFloat(refundedamount).toFixed(2); 

			if(refundedamount <= parseFloat(sessionStorage.getItem('fulltotalamount')).toFixed(2)){
				
			if ($(".return_quantity_value").val() !== 0) {
				$.ajax({
					url: base_url + "Controllerunit/print_return_invoice_section",
					method: "POST",
					data: {
						refundedamount: refundedamount,
						ordered_dateforreturn: ordered_dateforreturn,
					},
					success: function (data) {
						window.open(
							`${base_url}/Controllerunit/gotoreturnsalesunit`,
							"_blank"
						);
						console.log(data);
					},
					error: function (err) {
						console.error("Error found", err);
					},
				});
			} else {
				alert("There is no product to return");
			}

			}
			else {
				alert('Refunded amount can not exceed the total amount'); 
				window.location.reload(); 
			 
			}

		}
	});

	//whileback

	generaldatasection = 0; 

	$("body").delegate(".return_product_to_sale", "click", function () {
		let choosen_quantity_html = parseInt(
			$.trim($(this).parent().parent().find(".choosen_quantity_column").html())
		);

		let return_quantity_val = parseInt(
			$(this).parent().parent().find(".return_quantity_value").val()
		);

		let hidden_order_summery_id = parseInt($("#hidden_order_summery_id").val());

		let order_summery_id = parseInt($("#hidden_order_summery_id").val());

		let product_id = parseInt($(this).attr("product_id"));

		let html = null;
		let productpricesection = parseFloat($(this).attr('price')); 
 
		if (return_quantity_val > choosen_quantity_html) {
			alert("Returning quantity can not go over purcahsed quantity");
			$(this)
				.parent()
				.parent()
				.find(".return_quantity_value")
				.css("border", "2px solid red");
			$(this).parent().parent().find(".return_quantity_value").focus();
			return false;
		}
		generaldatasection+=parseFloat(return_quantity_val * productpricesection).toFixed(2); 

		$('#sumofsubtotaltotal_amount_section').html('Rs.'+parseFloat(generaldatasection).toFixed(2)); 

		let product_name = $(this).attr("product_name");
		let price = $(this).attr("price");
		let discount = $(this).attr("discount");
		let discounted_amount = $(this).attr("discounted_amount");
		let total_amount = $(this).attr("total_amount");

		let products_code = $(this).attr("products_code");
		let choosen_quantity = $(this).attr("choosen_quantity");

		toastr.info(
			`${return_quantity_val} ${product_name} ${
				return_quantity_val > 1 ? "have been" : "has been "
			} added for return report`
		);




		$.ajax({
			url: base_url + "Controllerunit/addproductsforreturn",
			method: "POST",
			data: {
				product_name: product_name,
				price: price,
				discount: discount,
				discounted_amount: discounted_amount,
				total_amount: total_amount,
				order_summery_id: order_summery_id,
				return_quantity_val: return_quantity_val,
				products_code: products_code,
				choosen_quantity: choosen_quantity,
				product_id: product_id,
			},
			success: function (data) {
				console.log(data);
				fetchAllshoppingcartdata();

				//                                   $.ajax({
				//                            url: base_url + 'Controllerunit/gotoreturnsalesunit',
				//                            method: 'POST',
				//                            success: function (data) {
				//
				//                               console.log(data);
				//                            },
				//                            error: function (err) {
				//                                console.error('Error found', err);
				//                            }
				//                        });
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#search_returnproduct").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$("#all_details_for_return_product tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});

	function saveexpensedetailsforregister(amount,date){
		$.ajax({
			url: base_url + "Controllerunit/saveexpensedetailsforregister",
			method: "POST",
			data: {
				amount:amount, 
				date:date
			},
			success: function (data) {
				 if(data!=1){
					 alert(data); 
				 }
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});

	}

	$("#save_frm_expense_list_section").submit(function (e) {
		e.preventDefault();

		let expense_type = $("#expense_type").val();

		let expense_date = $("#expense_date").val();

		let expense_amount = $("#expense_amount").val();

		let note_for_expense_section = $("#note_for_expense_section").val();

		if (expense_type == "") {
			alert("Expense type is required");
			return false;
		}

		if (expense_date == "") {
			alert("Expense date is required");
			return false;
		}

		if (expense_amount == "") {
			alert("Expense amount is required");
			return false;
		}

		if (note_for_expense_section == "") {
			alert("Note section is required");
			return false;
		}
		saveexpensedetailsforregister(expense_amount, getfulldate());

		$.ajax({
			url: base_url + "Controllerunit/save_frm_expense_list_section",
			method: "POST",
			data: {
				expense_type: expense_type,
				expense_date: expense_date,
				expense_amount: expense_amount,
				note_for_expense_section: note_for_expense_section,
			},
			success: function (data) {
				alert("Saved successfully");
				window.location.reload();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#generate_report_for_admin").click(function () {
		$.ajax({
			url: base_url + "Controllerunit/generate_report_for_admin_section",
			method: "POST",
			data: {
				getonlytime: getonlydate(),
			},
			success: function (data) {
				toastr.info("Report has been sent to admin");
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	//baby 
	function fetchallindividualdiscount(){
		$.ajax({
			url: base_url + "Controllerunit/fetchallindividualdiscount",
			method: "POST",
			success: function (data) {
				 console.clear(); 
				 
				 $("#individualdiscountamount").html('Rs.'+data); 
			},
			error: function (err) {
				alert(err);
				console.error("Error found", err);
			},
		});

	}

	$("body").delegate(".edit_price_update", "click", function () {
		let rowid = $(this).attr("rowid");
		let valuetochange = prompt("Enter new price ");
		if (valuetochange != null) {
			$.ajax({
				url: base_url + "Controllerunit/edit_price_update_section",
				method: "POST",
				data: {
					rowid: rowid,
					valuetochange: valuetochange,
				},
				success: function (data) {
					 
					console.log('Edit price update',data); 
					toastr.info("Updated successfully");
					fetchAllshoppingcartdata();
					fetchallindividualdiscount();
					savetemporarydateforsale();
					
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	const showoffdeTecutedPanel = () => {
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

		let html = 0;
		let count = 0;

		console.log("date", mydate);

		let totalamountsection = 0;

		$.ajax({
			url: base_url + "Controllerunit/showoffdeTecutedPanel_expenselist",
			method: "POST",
			data: {
				mydate: mydate,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.log('expense list ',getData); 
				if (getData == 0) {
					$("#cashier_expense_list_section_outcome").html(
						'<span class="text text-danger font-weight-bold">NO EXPENSES FOUND</span>'
					);

				 
				} else {
					 
					getData.map((d) => {
						totalamountsection += parseFloat(d.expense_amount);
						html = `<tr class="text text-center">
                        <td>${++count}</td>
                        <td>${d.expense_name}</td>
                        <td>${d.expense_date}</td>
                        <td>Rs.${parseFloat(d.expense_amount).toFixed(2)}</td>
                        <td>${d.expense_note}</td>
                        <td>
                        <button class="btn btn-danger btn-sm delete_expense_list" expense_amount="${d.expense_amount}" expense_id="${
													d.expenses_list_id
												}">
                        <i class="fa fa-trash" aria-hidden='true'></i>
                        </button>
                        </td>
                        </tr>
                        `;
						$("#cashier_expense_list_section_outcome").append(html);
					});
					$(".calculated_totalamount").html(
						"Rs." + parseFloat(totalamountsection).toFixed(2)
					);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	showoffdeTecutedPanel();

	function subtractexpenseamount(expenseamount, getfulldate){
		$.ajax({
			url: base_url + "Controllerunit/subtractexpenseamount",
			method: "POST",
			data: {
				expenseamount: expenseamount,
				getfulldate:getfulldate
				
			},
			success: function (data) {
				console.log('Subtravted amount expense',data); 
				registerDetailsection(); 
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});

	}


	//bullback

	$("body").delegate(".delete_expense_list", "click", function () {
		let value = parseInt($(this).attr("expense_id"));
		let expense_amount = parseFloat($(this).attr('expense_amount')); 
	 

		if (confirm("Are you sure you want to delete it?")) {
			subtractexpenseamount(expense_amount,getfulldate());

			$.ajax({
				url: base_url + "Controllerunit/delete_expense_list_from_cashier",
				method: "POST",
				data: {
					value: value,
					
				},
				success: function (data) {
					toastr.error("Deleted successfully");
					showoffdeTecutedPanel();
					registerDetailsection(); 
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$("#search_expensebutton").click(function () {
		let from_date_expense_list = $("#from_date_expense_list").val();
		let to_expense_list = $("#to_expense_list").val();

		if (from_date_expense_list == "") {
			toastr.warning("Please enter the 'FROM' date");
			return false;
		}
		if (to_expense_list == "") {
			toastr.warning("Please enter the 'TO' date");
			return false;
		}

		let html = "";
		let count = 0;

		let totalamountsection = 0;

		$.ajax({
			url: base_url + "Controllerunit/search_expense_bydate",
			method: "POST",
			data: {
				from_date_expense_list: from_date_expense_list,
				to_expense_list: to_expense_list,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					$("#cashier_expense_list_section_outcome").html(
						'<span class="text text-danger font-weight-bold">NO EXPENSES FOUND</span>'
					);

					return false;
				} else {
					console.log(getData);

					getData.map((d) => {
						totalamountsection += parseFloat(d.expense_amount);

						html = `<tr class="text text-center">
                        <td>${++count}</td>
                        <td>${d.expense_name}</td>
                        <td>${d.expense_date}</td>
                        <td>Rs.${parseFloat(d.expense_amount).toFixed(2)}</td>
                        <td>${d.expense_note}</td>
                        <td>
                        <button class="btn btn-danger btn-sm delete_expense_list" expense_amount='${d.expense_amount}' expense_id="${
													d.expenses_list_id
												}">
                        <i class="fa fa-trash" aria-hidden='true'></i>
                        </button>
                        </td>
                        </tr>
                        `;
						$("#cashier_expense_list_section_outcome").append(html);
					});
					$(".calculated_totalamount").html("Rs." + totalamountsection);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	const showoffsalesunitsection = () => {
		let html = "";

		$.ajax({
			url: base_url + "Controllerunit/showoffsalesunitsection",
			method: "POST",
			data: {
				fulldate: getfulldate(),
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.log('Show off sales unit section',getData);

				if (getData == 0) {
					$("#showoff_sales_side_section").html(
						'<span class="text text-danger font-weight-bold">NO DATA FOUND</span>'
					);
				} else {
					getData.map((d) => {
						html += `<tr>
                        <td>${d.invoice_no}</td>
                        <td>
                        ${d.customer_name==null ? 'walk-in' : d.customer_name}
                        </td>
						<td>${d.customer_mobile==null ? 'walk-in' : d.customer_mobile}</td>
						<td>${d.customer_address==null ? 'walk-in' : d.customer_address}</td>
                        <td>
                         <span class="badge ${
														d.payment_method == "Cash"
															? "badge-success"
															: "badge-danger"
													}">${d.payment_method}</span>
                        </td>
                        <td>
						Rs.
                         ${d.sales_credit_amount==null ? 0 : parseFloat(d.sales_credit_amount).toFixed(2)}
                        </td>
                        <td>
                           Rs. ${parseFloat(d.total_amount).toFixed(2)}
                        </td>
                        <td>
                        ${d.discounted_amount}
                        </td>
						<td>
						${parseFloat(d.discount_from_total_amount).toFixed(2)}
						</td>
                            <td>
                            ${d.ordered_date}
                            </td>
							<td>
							${d.additional_text}
							</td>

                        <td>
                        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item pay_amount_bycashloan" summery_id='${
			d.order_summery_id
		}' ordered_date='${d.ordered_date}' payment_method='${
							d.payment_method
						}' loanamount='${
							d.payment_method == "Credit"
								? `${d.order_summery_id}`
								: `${d.order_summery_id}`
						}'}''  data-toggle='modal'>Pay credit by cash <i class="fa fa-money-bill-alt"></i></a>
    <a class="dropdown-item pay_by_creditcheck" href="#" summery_id='${
			d.order_summery_id
		}' ordered_date='${d.ordered_date}' payment_method='${
							d.payment_method
						}' loanamount='${
							d.payment_method == "Credit"
								? `${d.order_summery_id}`
								: `${d.order_summery_id}`
						}'}''>Pay credit by cheque <i class="fa fa-credit-card"></i></a>
    
  </div>
</div>
                        </td>
 
                        </tr>`;
					});
					$(".showoffsales_side_section").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	showoffsalesunitsection();

	$("#cheque_loan_amount").keydown(function () {
		let typingamount = parseFloat($(this).val());
		let balance_for_cheque_amount = parseFloat(
			$("#balance_for_cheque_amount").val()
		);

		if (typingamount == balance_for_cheque_amount) {
			$("#display_status_loan_for_cheque").html("FULLY PAID");
			$("#display_status_loan_for_cheque").removeClass("badge-danger");
			$("#display_status_loan_for_cheque").addClass("badge-success");
		} else {
			$("#display_status_loan_for_cheque").html("Pending");
			$("#display_status_loan_for_cheque").removeClass("badge-success");
			$("#display_status_loan_for_cheque").addClass("badge-danger");
		}

		if (typingamount > balance_for_cheque_amount) {
			toastr.error("Typing amount can not be more than balance amount");
			$("#cheque_loan_amount").css("border", "2px solid red");
			$("#cheque_loan_amount").val(
				parseFloat($("#balance_for_cheque_amount").val())
			);
			$("#cheque_loan_amount").focus();
			return false;
		}
	});

	$("body").delegate(".pay_by_creditcheck", "click", function () {
		let summery_id = $(this).attr("summery_id");
		let ordered_date = $(this).attr("ordered_date");
		let payment_method = $(this).attr("payment_method");

		let loanamount = $(this).attr("loanamount");

		sessionStorage.setItem("ordered_date", ordered_date);

		$("#repayment_cheque_system").modal("show");
		$("#modal_section_modal").modal("hide");

		$.ajax({
			url: base_url + "Controllerunit/view_summery_id_fr",
			method: "POST",
			data: {
				value: loanamount,
			},
			success: function (data) {
				let getData = JSON.parse(data);

				if (getData == 0) {
					toastr.error("No payment pending to be paid");
					$("#payloanbycashbtn").attr("disabled", true);
					return false;
				}
				$("#payloanbycashbtn").attr("disabled", false);

				getData.map((d) => {
					$("#balance_for_cheque_amount").val(
						parseFloat(d.sales_credit_amount).toFixed(2)
					);
					sessionStorage.setItem("summery_id_fk", d.summery_id_fk);
				});
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#submit_loan_chequessection").submit(function (event) {
		event.preventDefault();

		let cheque_loan_number = $("#cheque_loan_number").val();

		let cheque_loan_amount = $("#cheque_loan_amount").val();

		let bank_name_for_loan_cheque = $("#bank_name_for_loan_cheque").val();

		let branch_name_for_laon_chque = $("#branch_name_for_laon_chque").val();

		let cheque_date_for_loan_name = $("#cheque_date_for_loan_name").val();

		let summery_id_fk = parseInt(sessionStorage.getItem("summery_id_fk"));

		let balance_for_cheque_amount = parseFloat($('#balance_for_cheque_amount').val()).toFixed(2);

		let status =
			$("#display_status_loan_for_cheque").html() == "FULLY PAID"
				? "Completed"
				: "Pending";

		let ordered_date = sessionStorage.getItem("ordered_date").substring(0, 10);
		ordered_date = $.trim(ordered_date);

		if (cheque_loan_number == "") {
			toastr.error("Please enter the loan Number");
			$("#cheque_loan_number").focus();
			$("#cheque_loan_number").css("border", "2px solid red");
			return false;
		}

		if (isNaN(cheque_loan_number)) {
			toastr.warning("Only numbers are allowed");
			$("#cheque_loan_number").focus();
			$("#cheque_loan_number").css("border", "2px solid red");
			return false;
		}

		if (cheque_loan_amount == "") {
			alert("Amount is required");
			window.location.reload();
		}

		if (isNaN(cheque_loan_amount)) {
			toastr.warning("Only numbers are allowed");
			$("#cheque_loan_amount").focus();
			$("#cheque_loan_amount").css("border", "2px solid red");
			return false;
		}

		if (bank_name_for_loan_cheque == "") {
			alert("Bank name is required");
			return false;
		}

		cheque_loan_amount = parseFloat(cheque_loan_amount).toFixed(2); 
		let balanceamount =0.00; 
		balanceamount = ( balance_for_cheque_amount - cheque_loan_amount ); 

		//balance, payment to be paid, recieving 


		$.ajax({
			url: base_url + "Controllerunit/submit_loan_chequessection",
			method: "POST",
			data: {
				cheque_loan_number: cheque_loan_number,
				branch_name_for_laon_chque: branch_name_for_laon_chque,
				cheque_date_for_loan_name: cheque_date_for_loan_name,
				bank_name_for_loan_cheque: bank_name_for_loan_cheque,
				summery_id_fk: summery_id_fk,
				recieveddate: getfulldate(),
				status: status,
				ordered_date_sec: ordered_date,
				cheque_loan_amount: cheque_loan_amount,
				balanceamount:balanceamount,
				balance_for_cheque_amount:balance_for_cheque_amount,
				todaydate:getfulldate() 
			},
			success: function (data) {
				if (data == 1) {
					chequeSaveDetailsforregister(parseFloat(cheque_loan_amount).toFixed(2)); 
					alert('Payment has been detected successfully by check payment'); 
		openloanrecieptamount(balanceamount,balance_for_cheque_amount,cheque_loan_amount); 
					
					//window.location.reload(); 
					
				} else {
					alert(data);
				 
					console.log(data);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("body").delegate(".pay_amount_bycashloan", "click", function () {
		$("#modal_section_modal").modal("hide");
		$("#repayloanbycash").modal("show");

		let payment_method = $(this).attr("payment_method");
		let loanamount = $(this).attr("loanamount");

		let ordered_date = $(this).attr("ordered_date");

		sessionStorage.setItem("ordered_date_sec", ordered_date);

		$("#temp_key_id").val(loanamount);

		sessionStorage.setItem("payment_method", payment_method);

		if (payment_method == "Creditss") {
			$("#payment_to_bepadi").val(loanamount);
			sessionStorage.setItem("summery_id_fk", $(this).attr("summery_id"));
		} else {
			$.ajax({
				url: base_url + "Controllerunit/view_summery_id_fr",
				method: "POST",
				data: {
					value: loanamount,
				},
				success: function (data) {
					let getData = JSON.parse(data);

					if (getData == 0) {
						toastr.error("No payment pending to be paid");
						$("#payloanbycashbtn").attr("disabled", true);
						return false;
					}
					$("#payloanbycashbtn").attr("disabled", false);

					getData.map((d) => {
						$("#payment_to_bepadi").val(
							parseFloat(d.sales_credit_amount).toFixed(2)
						);
						sessionStorage.setItem("summery_id_fk", d.summery_id_fk);

						console.log(d.ordered_date);
					});
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	 


	$("#payloanbycashbtn").click(function (event) {
		event.stopImmediatePropagation();

		let balance_amount = $("#balance_amount").val();
		let payment_to_bepadi = $("#payment_to_bepadi").val();
		let recieving_amount = $("#recieving_amount").val();

		let date = sessionStorage.getItem("date_to_payloan");

		let payment_method = sessionStorage.getItem("payment_method");

		let ordered_date_sec = sessionStorage
			.getItem("ordered_date_sec")
			.substring(0, 10);

		let invoice_id = sessionStorage.getItem("summery_id_fk");

		if (recieving_amount == "") {
			toastr.error("Please enter the recieving Amount");
			$("#recieving_amount").focus();
			$("#recieving_amount").css("border", "2px solid red");
			return false;
		}

		if (isNaN(recieving_amount)) {
			toastr.error("Only numbers are allowed");
			$("#recieving_amount").focus();
			$("#recieving_amount").css("border", "2px solid red");
			return false;
		}

		if (balance_amount == NaN) {
			toastr.error("Recieving amount is invalid.");
			$("#recieving_amount").focus();
			$("#recieving_amount").css("border", "2px solid red");
			return false;
		}
 
	
		$.ajax({
			url: base_url + "Controllerunit/detectcreditdetailsbycash",
			method: "POST",
			data: {
				recieving_amount: recieving_amount,
				ordered_date_sec: ordered_date_sec,
				summery_id: invoice_id,
				balance_amount: balance_amount,
				payment_to_bepadi:payment_to_bepadi,
				date : getfulldate() 

			},
			success: function (data) {
				alert('Product has been detected'); 
				saveCashpaymentforregisterdetails(recieving_amount);
		openloanrecieptamount(balance_amount,payment_to_bepadi,recieving_amount); 

			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#recieving_amount").keyup(function () {
		let value = parseFloat($(this).val());
		let payment_to_bepadi = $("#payment_to_bepadi").val();

		let answer = payment_to_bepadi - value;

		if (value > payment_to_bepadi) {
			toastr.warning("Recieving amount can not be larger than payment");
			$("#recieving_amount").val(payment_to_bepadi);
			$("#balance_amount").val(0);
			return false;
		}
		sessionStorage.setItem("balance_payment_for_credit", answer);
		$("#balance_amount").val(answer);
	});

	$("#search_bydateforfrontedn").click(function () {
		let from_to_search_purdate = $("#from_to_search_purdate").val()=='' ? null : $("#from_to_search_purdate").val();
		let to_to_search_purdate = $("#to_to_search_purdate").val()=='' ? null : $("#to_to_search_purdate").val();
		let status_cehcker = $('#status_cehcker').val()=='' ? null : $('#status_cehcker').val(); 
 
	 
 
		let html = "";

		$.ajax({
			url: base_url + "Controllerunit/showoffsalesunitsectionbysearch",
			method: "POST",
			data: {
				from_to_search_purdate: from_to_search_purdate,
				to_to_search_purdate: to_to_search_purdate,
				status_cehcker:status_cehcker
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.log('Show off sales unit section',getData);

				if (getData == 0) {
					$("#showoff_sales_side_section").html(
						'<span class="text text-danger font-weight-bold">NO DATA FOUND</span>'
					);
				} else {
					getData.map((d) => {
						html += `<tr>
                        <td>${d.invoice_no}</td>
                        <td>
                        ${d.customer_name==null ? 'walk-in' : d.customer_name}
                        </td>
						<td>${d.customer_mobile==null ? 'walk-in' : d.customer_mobile}</td>
						<td>${d.customer_address==null ? 'walk-in' : d.customer_address}</td>
                        <td>
                         <span class="badge ${
														d.payment_method == "Cash"
															? "badge-success"
															: "badge-danger"
													}">${d.payment_method}</span>
                        </td>
                        <td>
						Rs.
                         ${d.sales_credit_amount==null ? 0 : parseFloat(d.sales_credit_amount).toFixed(2)}
                        </td>
                        <td>
                           Rs. ${parseFloat(d.total_amount).toFixed(2)}
                        </td>
                        <td>
                        ${d.discounted_amount}
                        </td>
						<td>${parseFloat(d.discount_from_total_amount).toFixed(2)}</td>
                            <td>
                            ${d.ordered_date}
                            </td>
							<td>
							${d.additional_text}
							</td>

                        <td>
                        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item pay_amount_bycashloan" summery_id='${
			d.order_summery_id
		}' ordered_date='${d.ordered_date}' payment_method='${
							d.payment_method
						}' loanamount='${
							d.payment_method == "Credit"
								? `${d.order_summery_id}`
								: `${d.order_summery_id}`
						}'}''  data-toggle='modal'>Pay credit by cash <i class="fa fa-money-bill-alt"></i></a>
    <a class="dropdown-item pay_by_creditcheck" href="#" summery_id='${
			d.order_summery_id
		}' ordered_date='${d.ordered_date}' payment_method='${
							d.payment_method
						}' loanamount='${
							d.payment_method == "Credit"
								? `${d.order_summery_id}`
								: `${d.order_summery_id}`
						}'}''>Pay credit by cheque <i class="fa fa-credit-card"></i></a>
    
  </div>
</div>
                        </td>
 
                        </tr>`;
					});
					$(".showoffsales_side_section").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	function gettotalsalesanddiscount() {
		let sumoftotal = 0;
		let sumofdiscount = 0;

		$.ajax({
			url: base_url + "Controllerunit/gettotalsalesanddiscount",
			method: "POST",
			data: {
				todaydate: getfulldate(),
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					$("#total_sales").html("Rs.0.00");
					$("#sumofdiscounts").html("Rs.0.00");
				} else {
					getData.map((d) => {
						sumofdiscount += parseFloat(d.discounted_amount.substring(3));
						sumoftotal += parseFloat(d.total_amount);
					});

					$("#total_sales").html("Rs." + parseFloat(sumoftotal).toFixed(2));
					$("#sumofdiscounts").html(
						"Rs." + parseFloat(sumofdiscount).toFixed(2)
					);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}
	gettotalsalesanddiscount();

	const getSalessummerydetails = () => {
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

		let count = 0;
		let html = "";

		let total_payments = 0;

		$.ajax({
			url: base_url + "Controllerunit/getSalessummerydetails",
			method: "POST",
			data: {
				mydate: mydate,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData != 0) {
					getData.map((d) => {
						$("#cashon_hands").html(
							"Rs." + parseFloat(d.cash_in_hand).toFixed()
						);
						$("#cash_payments").html(
							"Rs." + parseFloat(d.cash_payment).toFixed()
						);
						$("#cheque_payments").html(
							"Rs." + parseFloat(d.cheque_payment).toFixed()
						);
						$("#Total_refunds").html(
							"Rs." + parseFloat(d.refunded_amount).toFixed()
						);
						$('#expenses_amount').html("Rs."+ parseFloat(d.expenses_amount_reg).toFixed(2)); 

						total_payments += parseFloat(d.cash_in_hand);
						total_payments += parseFloat(d.cash_payment);
						total_payments += parseFloat(d.cheque_payment);
					});
					$("#total_payment").html(
						"Rs." + parseFloat(total_payments).toFixed(2)
					);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	getSalessummerydetails();

	$("#view_all_sales_from_cashier").click(function () {
		$("#sales_modal_section").modal("show");
	});

	const resetCustomerid = () => {
		$.ajax({
			url: base_url + "Controllerunit/resetcustomerid",
			method: "POST",
			success: function (data) {},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	resetCustomerid();

	function getdetailsofsoldproduct() {
		let html = "";
		let count = 0;

		let amountofsale = 0;
		let amountofdiscount = 0;
		let sumofqty = 0;

		$.ajax({
			url: base_url + "Controllerunit/getdetailsofsoldproduct",
			method: "POST",
			data: {
				fulldate: getfulldate(),
			},
			success: function (data) {
				let getData = JSON.parse(data);
				console.log("Get details of sold product", getData);

				if (getData == 0) {
					$("#show_sold_product_details_bybrand").html(
						'<span class="text text-danger">NO DATA FOUND FOR TODAY</span>'
					);
				} else {
					getData.map((d) => {
						amountofsale += parseFloat(d.total_amount);
						amountofdiscount += parseFloat(d.discount_amount);
						sumofqty += parseInt(d.quantity);

						html += `<tr class="text-center">
                    <td>${++count}</td>
                    <td>${d.Name}</td>
                    <td>${d.quantity}</td>
                    <td>${parseFloat(d.total_amount).toFixed(2)}</td>
                   
                    </tr>`;
					});
					html += `<tr style="background-color:rgb(223, 240, 216)">
                <td></td><td></td>
               
                
                <td>
                <span class="font-weight-bold">SUM OF QTY : ${sumofqty}</span>
                </td>
                <td>
                <span class="float-right mr-4 font-weight-bold">
                Discounted(-) : ${amountofdiscount.toFixed(2)}
                <br/>
                Grand Total : ${(amountofsale - amountofdiscount).toFixed(2)}
               
              
                </span>
                </td>
                </tr>
                
                `;

					$("#total_sales").html(
						"Rs." + (amountofsale - amountofdiscount).toFixed(2)
					);

					$("#show_sold_product_details_bybrand").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	}

	// getdetailsofsoldproduct();

	$("#search_detailssectionforfrontendpurcahse").on("keyup", function () {
		var value = $(this).val().toLowerCase();
		$(".showoffsales_side_section tr").filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});

	$("body").delegate(".view_cus_details_fr", "click", function () {
		let value = parseInt($(this).attr("customer_id"));

		let html = "";
		if (value == 0) {
			alert("Walkin customer type");
			return false;
		} else {
			$.ajax({
				url: base_url + "Controllerunit/view_cus_details_fr_section",
				method: "POST",
				data: {
					value: value,
				},
				success: function (data) {
					let getData = JSON.parse(data);
					if (getData == 0) {
						alert("DATA NOT FOUND. It seems like data has been deleted");
						return false;
					} else {
						getData.map((d) => {
							html += `Person name : ${d.customer_name}   Customer Mobile : ${d.customer_mobile}`;
						});
						alert(html);
					}
				},
				error: function (err) {
					console.error("Error found", err);
				},
			});
		}
	});

	$("body").delegate(".view_summery_id_fr", "click", function () {
		let order_summery_id = Number($(this).attr("order_summery_id"));

		let html = "";

		$.ajax({
			url: base_url + "Controllerunit/view_summery_id_fr",
			method: "POST",
			data: {
				value: order_summery_id,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					alert("No pending payment found");
					return false;
				}
				getData.map((d) => {
					html += `Payment to be paid : Rs. ${parseFloat(
						d.sales_credit_amount
					).toFixed(2)}`;
				});
				alert(html);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	const getCreditsbycustomerdetails = () => {
		let html = "";
		$.ajax({
			url: base_url + "Controllerunit/getCreditsbycustomerdetails",
			method: "POST",
			data: {
				date: getfulldate(),
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					$("#allcredit_details_forsalesectionfront").html(
						'<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>'
					);
				} else {
					getData.map((d) => {
						html += `<tr>
                    <td>${d.invoice_no}</td>
                    <td>${d.customer_name}</td>
                    <td>${d.customer_mobile}</td>
                    <td>${d.customer_address}</td>
                    <td>${d.ordered_date}</td>
                    <td>${d.discount}</td>
                    <td>${d.discounted_amount}</td>
                    <td>${d.total_amount}</td>
                    <td>${parseFloat(d.sales_credit_amount).toFixed(2)}</td>
               
                    </tr>`;
					});

					$("#allcredit_details_forsalesectionfront").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	};

	getCreditsbycustomerdetails();


    function getallfinishingproductsfromwarehouse(){
        let count = 0; 
        let html = ''; 

        let muted_prodductscount = 0; 
        let unmuted_productscount = 0; 
        $.ajax({
			url: base_url + "Controllerunit/getallfinishingproductsfromwarehouse",
			method: "POST",
			success: function (data) {
				 let getData = JSON.parse(data); 
                 console.log(getData);
                  if(getData==0){
                      $('#show_off_producsofrunninginwarehouse').html('<tr><td colspan="2"><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>'); 
                    return false; 
                    }
                  else {
                    getData.map(d => {
                        if(d.warehouse_mute_option==1){
                            muted_prodductscount+=1
                        }
                        else {
                            unmuted_productscount+=1;
                        }
                       
                        html+=`<tr class="text text-center">
                        <td>${++count}</td>
                        <td>${d.product_name}</td>
                        <td>${d.product_unit}</td>
                        <td>${d.quantity}</td>
                        <td>${d.alert_quantity}</td>
                        <td>${d.warehouse_mute_option==1  ? `<span class="badge badge-success">Unmute</span>` : `<span class="badge badge-danger">Muted</span>`}</td>
                        <td> 
                            ${d.warehouse_mute_option==0  ? `<button product_id_fk='${d.product_id_fk}' class="btn btn-outline-danger btn-sm mute_warehouserunningproduct">MUTE</button>` : `<button product_id_fk='${d.product_id_fk}' class="btn btn-success btn-sm unmute_warehouserunningproduct">UNMUTE</button>`}
                        </td>
                        
                        </tr>`; 
                    }); 


                    $('#show_off_producsofrunninginwarehouse').html(html);
                    $('#Muted_products').html('Muted Products : '+unmuted_productscount); 
                    $('#unmuted_products').html('Unmuted Products :'+muted_prodductscount);
                    $('#show_unmuted_count_section').html(muted_prodductscount);


                  }
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});


    }

    $('body').delegate('.mute_warehouserunningproduct','click',function(){
        let product_id_fk = parseInt($(this).attr('product_id_fk')); 
 
        if(confirm("Are you sure you want to mute it?")){
            $.ajax({
                url: base_url + "Controllerunit/mute_warehouserunningproduct",
                method: "POST",
                data:{
                    product_id_fk:product_id_fk
                }, 
                success: function (data) {
				 
					console.log('asd',data); 
                      toastr.info("Muted successfully"); 
                     getallfinishingproductsfromwarehouse();
                },
                error: function (err) {
                    console.error("Error found", err);
                },
            });
        }


    }); 


//mute_warehouserunningproduct

$('body').delegate('.unmute_warehouserunningproduct','click',function(){
    let product_id_fk = parseInt($(this).attr('product_id_fk')); 

    if(confirm("Are you sure you want to unmute it?")){
        $.ajax({
            url: base_url + "Controllerunit/unmute_warehouserunningproduct",
            method: "POST",
            data:{
                product_id_fk:product_id_fk
            }, 
            success: function (data) {
                  toastr.success("Unmuted successfully"); 
                 getallfinishingproductsfromwarehouse();
            },
            error: function (err) {
                console.error("Error found", err);
            },
        });
    }


});

 
 

    function getwarehousefinishingproducts(){
        $.ajax({
			url: base_url + "Controllerunit/getwarehousefinishingproducts",
			method: "POST",
			success: function (data) {
				 console.log('Finishing products',data);
                 getallfinishingproductsfromwarehouse();
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});

    }

    getwarehousefinishingproducts();


 


	$("#creditsearchsectionfromdatetodate").click(function () {
		let fromdate = $("#from_date_by_customer_searchcredit").val();
		let todate = $("#to_date_by_customer_search_credit").val();

		if (fromdate == "") {
			toastr.error("Please enter the date for 'FROM'");
			$("#from_date_by_customer_searchcredit").css("border", "2px solid red");
			$("#from_date_by_customer_searchcredit").focus();
			return false;
		}

		if (todate == "") {
			toastr.error("Please enter the date for 'TO'");
			$("#to_date_by_customer_search_credit").css("border", "2px solid red");
			$("#to_date_by_customer_search_credit").focus();
			return false;
		}

		let html = "";
		$.ajax({
			url: base_url + "Controllerunit/getCreditsbycustomerdetailswithdate",
			method: "POST",
			data: {
				fromdate: fromdate,
				todate: todate,
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == 0) {
					$("#allcredit_details_forsalesectionfront").html(
						'<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>'
					);
				} else {
					getData.map((d) => {
						let mytotalamount = parseFloat(d.total_amount);
						let mycrediteamount = parseFloat(d.sales_credit_amount);
						let answer = mytotalamount - mycrediteamount;

						html += `<tr>
                    <td>${d.invoice_no}</td>
                    <td>${d.customer_name}</td>
                    <td>${d.customer_mobile}</td>
                    <td>${d.customer_address}</td>
                    <td>${d.ordered_date}</td>
                    <td>${d.discount}</td>
                    <td>${d.discounted_amount}</td>
                    <td>${d.total_amount}</td>
                    <td>${parseFloat(d.sales_credit_amount).toFixed(2)}</td>
                    <td>${parseFloat(answer).toFixed(2)}</td>
                    </tr>`;
					});

					$("#allcredit_details_forsalesectionfront").html(html);
				}
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});


	


	function retriewdataforexpiredata(){

		let count = 0; 
		let html = '';

		let mutedhtml = ''; 
		
		let currentdate = getfulldate(); 

		let count_mutedproducts = 0 


		let counted_systemforfront = 0; 

		$.ajax({
			url: base_url + "Controllerunit/retriewdataforexpiredata",
			method: "POST",
			success: function (data) {
			let getData = JSON.parse(data); 
			if(getData==1){
				$('#product_details_outlet_expired_showoff').html('<span class="text text-danger font-weight-bold">NO DATA FOUND</span>');
				$('#expired_date_count').html(count);
				$('#muted_products_count').html(count_mutedproducts); 

				return false; 
			}
			else {
				  getData.map(d => {
					  if(d.mute_option==1){
						counted_systemforfront++;
						  ++count;
						html+=`<tr class="text text-center">
						<td>${count}</td>
						<td>${d.product_name}</td>
						<td>${d.product_unit}</td>
						<td>${d.mfd}</td>
						<td>${d.exp}</td>
						<td>${d.products_code}</td>
						<td>Rs.${parseFloat(d.product_price).toFixed(2)}</td>
						<td>
						${d.exp <=currentdate ? '<span class="badge badge-danger font-weight-bold">EXPIRED</span>' : '<span class="badge badge-warning">EXPIRING SOON</span>'}
						</td>
						<td>
						 ${d.mute_option==1 ? `<button product_id_fk="${d.product_id_fk}" class="btn btn-outline-danger muteexpproduct btn-sm">MUTE</button>` : `<button class="btn btn-info btn-sm muteexpproduct" product_id='${d.product_id_fk}'>UNMUTE</button>`}
						</td>
	
						</tr>`;

					  }
					  else {
						 ++count_mutedproducts;
						mutedhtml+=`<tr class="text text-center">
						<td>${++count}</td>
						<td>${d.product_name}</td>
						<td>${d.product_unit}</td>
						<td>${d.mfd}</td>
						<td>${d.exp}</td>
						<td>${d.products_code}</td>
						<td>Rs.${parseFloat(d.product_price).toFixed(2)}</td>
						<td>
						${d.exp <=currentdate ? '<span class="badge badge-danger font-weight-bold">EXPIRED</span>' : '<span class="badge badge-warning">EXPIRING SOON</span>'}
						</td>
						<td>
						 ${d.mute_option==1 ? `<button product_id_fk="${d.product_id_fk}" class="btn btn-outline-danger muteexpproduct btn-sm">MUTE</button>` : `<button class="btn btn-info btn-sm unmuteexpproduct" product_id='${d.product_id_fk}'>UNMUTE</button>`}
						</td>
	
						</tr>`;
					  }
					  $('#expired_date_count').html(counted_systemforfront);
					  $('#muted_products_count').html(count_mutedproducts); 
				  }); 
				
				

				  $('#product_details_outlet_expired_showoff').html(html);
				  $('#muted_product_details_outlet_expired_showoff').html(mutedhtml);
			}
			 
			},
			error: function (err) {
				console.error("Retrieve expired date", err);
			},
		});

	}

	$('body').delegate('.muteexpproduct ','click',function(){
		let product_id_fk = Number($(this).attr('product_id_fk'));

		if(confirm("Are yo sure you want to mute it?")){
			
		$.ajax({
			url: base_url + "Controllerunit/muteexpproduct",
			method: "POST",
			data:{
				product_id_fk:product_id_fk
			}, 
			success: function (data) {
				toastr.info("It has been muted successfully"); 
				retriewdataforexpiredata(); 
			 
			},
			error: function (err) {
				console.error("Exipiry date founder error", err);
			},
		});

		}
	 
	}); 

	$('body').delegate('.unmuteexpproduct','click',function(){
		let product_id_fk = Number($(this).attr('product_id'));

		 

		if(confirm("Are yo sure you want to mute it?")){
			
		$.ajax({
			url: base_url + "Controllerunit/unmuteexpproduct",
			method: "POST",
			data:{
				product_id_fk:product_id_fk
			}, 
			success: function (data) {
			 
				console.log('Resultdata', data)
				toastr.warning("It has been unmuted successfully"); 
				retriewdataforexpiredata(); 
			 
			},
			error: function (err) {
				console.error("Exipiry date founder error", err);
			},
		});

		}

	}); 


	function product_details_outlet_expired_showoff(){

		$.ajax({
			url: base_url + "Controllerunit/product_details_outlet_expired_showoffs",
			method: "POST",
			data:{
				currentdate : getfulldate()
			}, 
			success: function (data) {
				retriewdataforexpiredata();
				console.log('Outlet expired date show off',data);
			},
			error: function (err) {
				console.error("Exipiry date founder error", err);
			},
		});

	}

	product_details_outlet_expired_showoff();



	
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

	function convertintoexcelfile(tableid, name){

	}

$('#exportexcelsectionforsummery').click(function(){
    let name = prompt("Name your file"); 
	if(name==null){
		exportTableToExcel('cashinhandssectionsummery','Salessummery');
	}
	else {
		exportTableToExcel('cashinhandssectionsummery',name);

	}
}); 

function printDiv(divName) {
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;

	document.body.innerHTML = printContents;

	window.print();

	document.body.innerHTML = originalContents;
}

$('#exporttoexcelwholedata').click(function(){
	let name  = prompt("Name your file"); 
	if(name==null){
		printDiv('salessidedetailsfromfrontexcel'); 
		exportTableToExcel('salessidedetailsfromfrontexcel','Salesdetailsfromtcashier'); 
	}
	else {
		printDiv('salessidedetailsfromfrontexcel'); 

		exportTableToExcel('salessidedetailsfromfrontexcel',name);
	}
}); 


$('#exportexcelforcreditdetails').click(function(){
	let name = prompt("Name your file"); 
	if(name==null){
		exportTableToExcel('creditdetailsectionallforexport','creditdetailsexported'); 
	}
	else {
		exportTableToExcel('creditdetailsectionallforexport',name); 
	}
	
}); 

 

const detectexpirechecksbyadmindetails = () => {
 
	$.ajax({
		url: base_url + "Controllerunit/detectexpirechecksbyadmindetails",
		method: "POST",
		data:{
			currentdate : getfulldate()
		}, 
		success: function (data) {
		 
		},
		error: function (err) {
			
			console.error("Exipiry date founder error", err);
		},
	});

}

	


 
   const chequesbyadmindetails = (fromdate = null, todate = null, checkstatus = null) => {
	let html = ''; 
	let count = 0; 

	let statuschecker = ''; 

	let pending_count = 0; 
	let complete_count = 0; 
	let bounce_count = 0; 


	let completed_amount = 0.00; 
	let pending_amount = 0.00; 
	let bounce_amount = 0.00;
	
	let total_count_to_showofftoout  = 0; 


	$.ajax({
		url: base_url + "Controllerunit/chequesbyadmindetails",
		method: "POST",
		data:{
			fromdate:fromdate,
			todate:todate,
			checkstatus:checkstatus
		}, 
		success: function (data) {
			 
			let getData = JSON.parse(data); 
			if(getData==0){
				 $('#checks_by_admin_section_print').html('<tr><span class="text text-danger font-weight-bold">No data found</span></tr>'); 
			} 
			else {
				console.log('required data',getData); 
				getData.map(d => {
					if(d.cheque_status=='completed'){
						statuschecker = '<span class="badge badge-success">Completed</span>'; 
						completed_amount+=parseFloat(d.amount).toFixed(2);
						complete_count+=1; 
					}
					else if(d.cheque_status=='bounce'){
						statuschecker = '<span class="badge badge-danger">bounced</span>'; 
						bounce_amount+=parseFloat(d.amount).toFixed(2); 
						bounce_count+=1; 	
					}
					else {
						statuschecker = '<span class="badge badge-warning">Pending</span>'; 
						pending_amount+=parseFloat(d.amount).toFixed(2);
						pending_count+=1;
					}

					total_count_to_showofftoout+=(bounce_count + pending_count); 

					html+=`<tr>
					<td>${++count}</td>
					<td>${d.customer_name}</td>
					<td>${d.cheque_amount}</td>
					<td>${statuschecker}</td>
					<td>${d.bank_name}</td>
					<td>${d.branch_name}</td>
					<td>${d.cheque_date}</td>
					<td>${parseFloat(d.cheque_amount).toFixed(2)}</td>
					<td>${d.cheque_no}</td>
					<td>
					<div class="dropdown show">
					<a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLinkarea" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Status action
				  </a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLinkarea">
					<a class="dropdown-item admin_status_action_pending" check_fk='${d.chques_id_fk}' chques_id_fk='${d.expired_checks_id}' href="#">Pending</a>
					<a class="dropdown-item admin_status_action_bounce" check_fk='${d.chques_id_fk}' chques_id_fk='${d.expired_checks_id}' href="#">Bounce</a>
					<a class="dropdown-item admin_statis_action_completed" check_fk='${d.chques_id_fk}' chques_id_fk='${d.expired_checks_id}' href="#">Completed</a>
				  </div>
				  </div>
					</td>
					</tr>`;
				}); 

				$('#checks_by_admin_section_print').html(html);
				$('#checks_by_admin_count').html(total_count_to_showofftoout); 
			}
		},
		error: function (err) {
			
			console.error("chequesbyadmindetails date founder error", err);
		},
	});


   }

   chequesbyadmindetails(); 

   $('#searchforadmin_area_bycheck').click(function(){
	let from_date_by_admin = $('#from_date_by_admin').val(); 
	let to_date_by_admin = $('#to_date_by_admin').val(); 
	let status_to_date_for_supplierchecks = $('#status_to_date_for_supplierchecks_byadmin').val(); 

	chequesbyadmindetails(from_date_by_admin,to_date_by_admin,status_to_date_for_supplierchecks); 

}); 




   $('body').delegate('.admin_statis_action_completed','click',function(){
	let chques_id_fk = Number($(this).attr('chques_id_fk')); 
	let check_fk = Number($(this).attr('check_fk')); 

 

	$.ajax({
		url: base_url + "Controllerunit/admin_statis_action_completed_activator",
		method: "POST",
		data:{
			chques_id_fk : chques_id_fk,
			check_fk:check_fk
		}, 
		success: function (data) {
			if(data==1){
				toastr.info("Updated successfully"); 
				chequesbyadmindetails(); 
			}
			else {
				alert(data);
			}
		 
		},
		error: function (err) {
			
			console.error("Exipiry date founder error", err);
		},
	});

}); 


   $('body').delegate('.admin_status_action_bounce','click',function(){
	let chques_id_fk = Number($(this).attr('chques_id_fk')); 
	let check_fk = Number($(this).attr('check_fk')); 

	 
	$.ajax({
		url: base_url + "Controllerunit/admin_status_action_bounce_activator",
		method: "POST",
		data:{
			chques_id_fk : chques_id_fk,
			check_fk:check_fk
		}, 
		success: function (data) {
			if(data==1){
				toastr.info("Updated successfully"); 
				chequesbyadmindetails(); 
			}
			else {
				alert(data);
			}
		 
		},
		error: function (err) {
			
			console.error("Exipiry date founder error", err);
		},
	});

}); 




   $('body').delegate('.admin_status_action_pending','click',function(){
		let chques_id_fk = Number($(this).attr('chques_id_fk')); 
		let check_fk = Number($(this).attr('check_fk')); 
 
		$.ajax({
			url: base_url + "Controllerunit/admin_status_action_pending_activator",
			method: "POST",
			data:{
				chques_id_fk : chques_id_fk,
				check_fk:check_fk
			}, 
			success: function (data) {
				if(data==1){
					toastr.info("Updated successfully"); 
					chequesbyadmindetails(); 
				}
				else {
					alert(data);
				}
			 
			},
			error: function (err) {
				
				console.error("Exipiry date founder error", err);
			},
		});

   }); 



 const getallsupplierchequedetails = (fromdate=null, todate=null, checkstatus = null ) => {

	let html = ''; 
	let count = 0; 

	let statuschecker = ''; 

	let pending_count = 0; 
	let complete_count = 0; 
	let bounce_count = 0; 


	let completed_amount = 0.00; 
	let pending_amount = 0.00; 
	let bounce_amount = 0.00; 


	let total_count_to_showofftoout = 0; 

	$.ajax({
		url: base_url + "Controllerunit/getsuppliercheckdetails",
		method: "POST",
		data:{
			fromdate:fromdate,
			todate:todate,
			checkstatus:checkstatus
		}, 
		success: function (data) {
			 let getData = JSON.parse(data); 
		 
			 console.log('Get supplier details',getData); 
			 if(getData==0){
				 $('#getsupplier_detailsforgettingarea').html('<span class="text text-danger font-weight-bold">No data found</span>'); 
			 }
			 else {
				getData.map(d => {
					if(d.cheque_status=='completed'){
						statuschecker = '<span class="badge badge-success">Completed</span>'; 
						completed_amount+=parseFloat(d.amount).toFixed(2);
						complete_count+=1; 
					}
					else if(d.cheque_status=='bounce'){
						statuschecker = '<span class="badge badge-danger">bounced</span>'; 
						bounce_amount+=parseFloat(d.amount).toFixed(2); 
						bounce_count+=1; 	
					}
					else {
						statuschecker = '<span class="badge badge-warning">Pending</span>'; 
						pending_amount+=parseFloat(d.amount).toFixed(2);
						pending_count+=1;
					}

					total_count_to_showofftoout+=(bounce_count + pending_count); 

					html+=`<tr class="text text-center">
					<td>${++count}</td>
					<td>${d.supplier_name}</td>
					<td>${d.mobile_number}</td>
					<td>${d.org_name}</td>
					<td>${d.supplier_addresses}</td>
					<td>${d.supplier_accountno}</td>
					<td>${d.bank_name}</td>
					<td>${d.branch_name}</td>
					<td>${d.account_no}</td>
					<td>${d.cheque_date}</td>
					<td>${statuschecker.toString()}</td>
					<td>${d.note}</td>
					<td>${parseFloat(d.amount).toFixed(2)}</td>
					<td>
					<div class="dropdown show">
  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status action
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item status_action_pending" chques_id_fk='${d.chques_id_fk}' href="#">Pending</a>
    <a class="dropdown-item status_action_bounce" chques_id_fk='${d.chques_id_fk}' href="#">Bounce</a>
    <a class="dropdown-item statis_action_completed" chques_id_fk='${d.chques_id_fk}' href="#">Completed</a>
  </div>
</div>
					</td>
				 
					</tr>`;
				}); 

				$('#getsupplier_detailsforgettingarea').html(html);
				$('#check_details_count_for_moving').html(total_count_to_showofftoout); 
				
	$('#total_completed_amount').html('Rs.'+parseFloat(completed_amount).toFixed(2)); 
	$("#total_amount_of_pending_checks").html('Rs.'+parseFloat(pending_amount).toFixed(2));
	$('#total_amount_bounced_checks').html('Rs.'+parseFloat(bounce_amount).toFixed(2)); 
			 }
		},
		error: function (err) {
			console.error("Exipiry date founder error", err);
		},
	});

 }

 
$('#search_supplier_checks').click(function(){
	let form_date_for_supplierchecks = $('#form_date_for_supplierchecks').val(); 
	let to_date_for_supplierchecks = $("#to_date_for_supplierchecks").val(); 
	let status_to_date_for_supplierchecks = $('#status_to_date_for_supplierchecks').val(); 
 
	getallsupplierchequedetails(form_date_for_supplierchecks,to_date_for_supplierchecks,status_to_date_for_supplierchecks); 
 
}); 

 $('body').delegate('.status_action_pending','click',function(){
	let chques_id_fk = parseInt($(this).attr('chques_id_fk')); 
	$.ajax({
		url: base_url + "Controllerunit/updatecheckstatusfromcashier",
		method: "POST",
		data:{
			chques_id_fk :chques_id_fk
		}, 
		success: function (data) {
 			 if(data==1){
				 toastr.info("Check status has successfully been updated"); 
				getallsupplierchequedetails(); 
			 }
			 else {
				 alert(data); 
			 }
			 
		},
		error: function (err) {
			console.error("Exipiry date founder error", err);
		},
	});
	
 }); 


 $('body').delegate('.status_action_bounce','click',function(){
	let chques_id_fk = parseInt($(this).attr('chques_id_fk')); 
	$.ajax({
		url: base_url + "Controllerunit/updatestatustobounce",
		method: "POST",
		data:{
			chques_id_fk :chques_id_fk
		}, 
		success: function (data) {
			console.log(data); 
			 if(data==1){
				 toastr.info("Check status has successfully been updated"); 
				getallsupplierchequedetails(); 
			 }
			 else {
				 alert(data); 
			 }
			 
		},
		error: function (err) {
			console.error("Exipiry date founder error", err);
		},
	});
	
 }); 


 
 $('body').delegate('.statis_action_completed','click',function(){
	let chques_id_fk = parseInt($(this).attr('chques_id_fk')); 
	$.ajax({
		url: base_url + "Controllerunit/updatestatustocomplete",
		method: "POST",
		data:{
			chques_id_fk :chques_id_fk
		}, 
		success: function (data) {
			console.log(data);
			 if(data==1){
				 toastr.info("Check status has successfully been updated"); 
				getallsupplierchequedetails(); 
			 }
			 else {
				 alert(data); 
			 }
			 
		},
		error: function (err) {
			console.error("Exipiry date founder error", err);
		},
	});
	
 }); 






 const getdetailsofexpiredchecksforsupplier = () => {
	$.ajax({
		url: base_url + "Controllerunit/getdetailsofexpiredchecksforsupplier",
		method: "POST",
		data:{
			currentdate : getfulldate()
		}, 
		success: function (data) {
			getallsupplierchequedetails(); 
			 
		},
		error: function (err) {
			console.error("Exipiry date founder error", err);
		},
	});
 }

 getdetailsofexpiredchecksforsupplier();
  

 detectexpirechecksbyadmindetails(); 


 
 function getloanpaymentmentcheckmethod(fromdate = null, todate = null, paymentmethod = null) {

	let count = 0; 
	let html = ''; 

	$.ajax({
		url: base_url + "Controllerunit/getloanpaymentmentcheckmethod",
		method: "POST",
		data: {
			 fromdate:fromdate, 
			 todate:todate, 
			 paymentmethod:paymentmethod 
		},
		success: function (data) {
			 let getData = JSON.parse(data); 
			 if(getData==0){
				$("#loanpaymentmentcheckmethod").html('<tr><td><span class="text text-danger font-weight-bold">No data found</span></td></tr>');
				return false; 
			 }
			 else {
				 getData.map(d => {
					html+=`<tr>
					<td>${++count}</td>
					<td>${d.invoiceidsec}</td>
					<td>Rs.${parseFloat(d.loan_previous_amount).toFixed(2)}</td>
					<td>Rs.${parseFloat(d.loan_recieving_amount).toFixed(2)}</td>
					<td>Rs. ${parseFloat(d.loan_balance_amount).toFixed(2)}</td>
					<td>${d.loan_paid_method=='Check' ? '<span class="badge badge-info">Check</span>' : '<span class="badge badge-success">Cash</span>'}</td>
					<td>${d.date}</td>
					</tr>`;
				 }); 
				 $('#loanpaymentmentcheckmethod').html(html); 
			 }
		},
		error: function (err) {
			console.error("Error found", err);
		},
	});

}

getloanpaymentmentcheckmethod(); 


$('#search_loan_amount_section').click(function(){
	let from_date_fr_loan = $('#from_date_fr_loan').val(); 
	let to_date_fr_loan = $('#to_date_fr_loan').val(); 
	let payment_method_forloan = $('#payment_method_forloan').val()=='' ? null : $('#payment_method_forloan').val(); 

	getloanpaymentmentcheckmethod(from_date_fr_loan,to_date_fr_loan,payment_method_forloan); 


}); 


}); //End of script
