$(document).ready(function () {
	const base_url = $("#base_url").val();

 

	$("#outlet_selection_for_repot").change(function (e) {
		let value = e.target.value;
		let count = 0;

		let totalAmountforselling = 0.0;

		let html = null;
		$.ajax({
			url: base_url + "Controllerunit/getselctedoutletreport",
			method: "POST",
			data: {
				value: value,
			},
			success: function (data) {
				let getData = JSON.parse(data);

				if (getData == 0) {
					$("#outlets_report").html(
						'<tr><td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td></tr>'
					);
					$("#total_amount_for_selling").html(
						"Total amount of selling price : Rs.0.00"
					);
					return false;
				}

				getData.map((d) => {
					count++;
					totalAmountforselling += parseFloat(d.product_cost);
					html += `<tr class="text text-center">
                    <td>${count}</td>
                    <td>${d.product_name}</td>
                    <td>${d.product_unit}</td>
                <td>${d.product_quantity}</td>
                    <td>${d.product_cost}</td>
                    </tr>`;
				});

				$("#outlets_report").html(html);
				$("#total_amount_for_selling").html(
					"Total amount of selling price : Rs." +
						totalAmountforselling.toFixed(2)
				);
			},
			error: function (err) {
				console.error("Error found", err);
			},
		});
	});

	$("#print_outletstockbtn").click(function () {
		var printContents = $("#print_section_for_outletstock").html();
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	});



}); //End of script 
