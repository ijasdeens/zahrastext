$(document).ready(function () {
	const base_url = $('#base_url').val();


	const refreshSection = (value) => {

		let number =0; 
		let html = null; 
		getDescription(value);
		$.ajax({
			url: base_url + 'Controllerunit/searchAllforextraitem',
			method: 'POST',
			data: {
				code: value
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#showOffQuantityitems').html('<span class="text text-danger font-weight-bold">No data found</span>')
				} else {
				 		getData.map(d => {
							number++;
							html += `<tr>
								<td>
								${number}
								</td>
								<td>
								${d.size}
								</td>
								<td>
								${d.quatity}
								</td>
								<td>${d.old_quantity}</td>
								<td>
								<input type="text" value="" currentQuantity="${d.quatity}" size_id="${d.size_id}" class="extraquantitysection text-center"/>
								</td>
								</tr>`;
						});

						$('#showOffQuantityitems').html(html);


				}

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});




	}




	const getDescription = (value) => {
		$.ajax({
			url: base_url + 'Controllerunit/getDescription',
			method: 'POST',
			data: {
				code: value
			},
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#productdescription').html('<span class="text text-danger font-weight-bold">No data found</span>')
				} else {
					getData.map(d => {
						html = `${d.category_name} - ${d.sub_categoryName} - ${d.p_code} - ${d.p_name}`;
						if (d.picture_papth != "") {
							$('#imagesectionforexisting').attr('src', base_url + 'assets/img/uploaded_photos/' + d.picture_papth);
						} else {
							$('#imagesectionforexisting').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png');
						}

					});

					$('#productdescription').html(html);


				}

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}


	$('#searchAllforextraitem').keyup(function (event) {
		let code = $(this).val();
		let html = null;
		let number = 0;
		if (event.keyCode === 13) {
			getDescription(code);
			$.ajax({
				url: base_url + 'Controllerunit/searchAllforextraitem',
				method: 'POST',
				data: {
					code: code
				},
				success: function (data) {
					let getData = JSON.parse(data);
					if (getData == "0") {
						$('#showOffQuantityitems').html('<span class="text text-danger font-weight-bold">No data found</span>')
					} else {
						getData.map(d => {
							number++;
							html += `<tr>
								<td>
								${number}
								</td>
								<td>
								${d.size}
								</td>
								<td>
								${d.quatity}
								</td>
								<td>${d.old_quantity}</td>
								<td>
								<input type="text" value="" currentQuantity="${d.quatity}" size_id="${d.size_id}" class="extraquantitysection text-center"/>
								</td>
								</tr>`;
						});

						$('#showOffQuantityitems').html(html);


					}

					 

				},
				error: function (err) {
					console.error('Error found', err);
				}
			});
		}
	})


	$('body').delegate('.extraquantitysection', 'keyup', function (event) {
		let extraQuantity = $(this).val();
		
		
		if(extraQuantity==""){
			toastr.warning("Please enter the quantity"); 
			$(this).css('border','2px solid red'); 
			return false; 
		}
		
		let currentQuanttiy = parseInt($(this).attr('currentquantity'));
		let size_id = parseInt($(this).attr('size_id'));
		let total = 0;
		let searchAllforextraitem = $('#searchAllforextraitem').val(); 
		if (event.keyCode === 13) {
			if (isNaN(extraQuantity)) {
				toastr.error('Only numbers allowed');
				$(this).css('border', '2px solid red');
				return false;
			} else {
				extraQuantity = parseInt(extraQuantity);
				total = (currentQuanttiy + extraQuantity);

				$(this).css('border', '');
				$.ajax({
					url: base_url + 'Controllerunit/extraquantitysection',
					method: 'POST',
					data: {
						size_id: size_id,
						total: total,
						currentQuanttiy: currentQuanttiy
					},
					success: function (data) {
						toastr.success('Updated successfully');
						refreshSection(searchAllforextraitem); 
					},
					error: function (err) {
						console.error('Error found', err);
					}
				});


			}

		}







	});



}); //End of organization