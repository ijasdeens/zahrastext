$(document).ready(function () {


	const base_url = $('#base_url').val();

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

	$("#cashierlogin").submit(function (e) {
		e.preventDefault();

		let mobNumber = $('#mobNumber').val();
		let mobPassword = $('#mobPassword').val();


		if (mobNumber == '') {
			alert('Mobile number is required');
			return false;
		}
		if (mobPassword == '') {
			alert('Password is required');
			return false;
		}


		$.ajax({
			url: base_url + 'Controllerunit/loginforcashier',
			method: 'POST',
			data:{
				mobNumber:mobNumber,
				mobPassword:mobPassword,
				timeline : getdateandtime()
			},
			success: function (data) {
				 
				 if(data==0){
					 alert('Your credentials are wrong or you are not authorized to enter');
					 return false; 
				 }
				else {
					window.location.reload(); 
				}
			},
			error: function (err) {
				console.error('Error found', err);
			}
		});


	});

});