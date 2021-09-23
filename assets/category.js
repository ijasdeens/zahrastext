$(document).ready(function () {
	const base_url = $('#base_url').val();

	const showOffCategories = () => {
		let number = 0;
		let html = null;
		$.ajax({
			url: base_url + 'Controllerunit/showOffCategories',
			method: 'POST',
			success: function (data) {
				let getData = JSON.parse(data);
				if (getData == "0") {
					$('#showoffCategories').html('<span class="text text-danger font-weight-bold">No data found</span>')
				} else {
					getData.map(d => {
						number++;
						html += `<tr>
<td>${number}</td>
<td>${d.category_name}</td>
<td>
<button class="btn btn-outline-danger btn-sm deleteCategories" category_id="${d.category_id}">Delete</button>
<button class="btn btn-outline-primary btn-sm editcategories" category_id="${d.category_id}" category_name="${d.category_name}">Edit</button>
</td>
</tr>`;
					});
					$('#totalcategories').html('Total categories : ' + number);
					$('#showoffCategories').html(html);

				}

			},
			error: function (err) {
				console.error('Error found', err);
			}
		});
	}

	showOffCategories();





	$('body').delegate('.deleteCategories', 'click', function () {
		let category_id = parseInt($(this).attr('category_id'));

		if (confirm("Are you sure you want to delete it?")) {
			$.ajax({
				url: base_url + 'Controllerunit/deletecategories',
				method: 'POST',
				data: {
					category_id: category_id
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


	$('body').delegate('.editcategories', 'click', function () {
		let category_id = parseInt($(this).attr('category_id'));
		let category_name = $(this).attr('category_name');
		$('#updatecategoryDetailsmodal').modal('show');

		$('#ecategoryName').val(category_name);
		$('#hidden_id').val(category_id);



	});


	$('#esavecategoryform').submit(function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + 'Controllerunit/updatecategories',
			method: 'POST',
			data: {
				category_id: $('#hidden_id').val(),
				category_name: $('#ecategoryName').val()
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

	
	
	$('#savecategoryform').submit(function (e) {
		e.preventDefault();

		let categoryName = $('#categoryName').val();

		if (categoryName == "") {
			alert('Fields are important');
			return false;
		}

		$.ajax({
			url: base_url + 'Controllerunit/savecategories',
			method: 'POST',
			data: {
				categoryName: categoryName
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



});