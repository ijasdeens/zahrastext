$(document).ready(function () {


	const base_url = $('#base_url').val();

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
				mobPassword:mobPassword
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