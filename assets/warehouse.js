$(document).ready(function () {
    const base_url = $('#base_url').val();


    const viewWarehouseDetails = () => {

        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/viewWarehouseDetails',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);

                if (getData == "0") {
                    html = `No data found`;
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr>
<td>${count}</td>
<td>${d.warehouse_name}</td>
<td>${d.warehouse_address}</td>
<td>${d.main_mobile}</td>
<td>
<button class="btn btn-danger deleteWarehouseDetails btn-sm" warehouse_id="${d.warehouse_id}">Delete</button>

<button class="btn btn-primary editWarehousedetails btn-sm" id="${d.warehouse_id}" name="${d.warehouse_name}" address="${d.warehouse_address}" mobile="${d.main_mobile}">Edit</button>
</td>
</tr>`;
                    });
                }

                $('#showOffWarehouse').html(html);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

    viewWarehouseDetails();


    $('body').delegate('.editWarehousedetails', 'click', function () {
        $('#hidden_id').val($(this).attr('id'));
        $('#u_warehouseName').val($(this).attr('name'));
        $('#u_address').val($(this).attr('address'));
        $('#u_mobile').val($(this).attr('mobile'));

        $('#updateWarehouse').modal('show');

    });


    $('#frmUpdatewarehouse').submit(function(e){
        e.preventDefault();

        let id = parseInt($('#hidden_id').val());
        let name = $('#u_warehouseName').val();
        let address = $('#u_address').val();
        let u_mobile = $('#u_mobile').val();


        if(name==""){
            alert('Name is required');
            return false;
        }

        if(address==""){
            alert('Address is required');
            return false;
        }

        if(u_mobile==""){
            alert('Mobile number is required');
            return false;
        }

        if(isNaN(u_mobile)){
            alert('Only digits allowed');
            return false;
        }

         $.ajax({
                url: base_url + 'Controllerunit/updatewarehouse',
                method: 'POST',
                data: {
                    id: id,
                    name:name,
                    address:address,
                    u_mobile:u_mobile,

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


    $('body').delegate('.deleteWarehouseDetails', 'click', function () {
        let warehouse_id = parseInt($(this).attr('warehouse_id'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteWarehouseDetails',
                method: 'POST',
                data: {
                    warehouse_id: warehouse_id

                },
                success: function (data) {
                    alert('Saved successfully');
                    window.location.reload();

                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });



        }


    });


    $('#frmSaveWarehouse').submit(function (e) {
        e.preventDefault();

        let warehouseName = $("#warehouseName").val();
        let warehouseAddress = $("#warehouseAddress").val();
        let warehouseMobile = $('#warehouseMobile').val();


        $.ajax({
            url: base_url + 'Controllerunit/saveWraehouse',
            method: 'POST',
            data: {
                warehouseName: warehouseName,
                warehouseAddress: warehouseAddress,
                warehouseMobile: warehouseMobile,

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
