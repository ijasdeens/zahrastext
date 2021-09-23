$(document).ready(function () {


    const base_url = $('#base_url').val();


    const showOffBrands = () => {
        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showOffBrands',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    html = `<span class="text text-danger">No data found</span>`;
                    $("#showOffBrands").html(html);
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr>
<td class="text text-center">${count}</td>
<td class="text text-center">
${d.brands_name}
</td>
<td class="text text-center">
<button class="btn btn-outline-danger deletebrands" brands_id="${d.brands_id}">Delete</button>
&nbsp;
<button class="btn btn-primary editBrands" brands_id="${d.brands_id}" brands_name="${d.brands_name}">Edit</button>
</td>
</tr>`;

                    });
                    $("#showOffBrands").html(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    }

    showOffBrands();


    $('body').delegate('.editBrands', 'click', function () {
        let brands_id = parseInt($(this).attr('brands_id'));
        let brands_name = $(this).attr('brands_name');

        $('#ubrandsName').val(brands_name);
        $('#hidden_id').val(brands_id);
        $('#editBrandsModal').modal('show');
    });

    $('#formupdatebrands').submit(function (event) {
        event.preventDefault();
        let brandsName = $('#ubrandsName').val();
        let hidden_id = parseInt($('#hidden_id').val());


        if (brandsName == "") {
            alert('Please enter the brand name');
            $("#ubrandsName").focus();
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/updatebrands',
            method: 'POST',
            data: {
                brandsName: brandsName,
                hidden_id: hidden_id

            },
            success: function (data) {
                 window.location.reload();
                alert('Updated successfully');
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });



    $('body').delegate('.deletebrands', 'click', function () {
        let brands_id = parseInt($(this).attr('brands_id'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteBrands',
                method: 'POST',
                data: {
                    brands_id: brands_id,
                },
                success: function (data) {

                    window.location.reload();
                    alert('Deleted successfully');
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }
    });



      $("#search_brands_section").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showOffBrands tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



    $('#frmaddbrand').submit(function (event) {
        event.preventDefault();
        let brandsName = $('#brandsName').val();
        let checkbox = $('#addmultiple').is(':checked') ? true : false;


        if (brandsName == "") {
            alert('Please enter the brand name');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/saveBrand',
            method: 'POST',
            data: {
                brandsName: brandsName,

            },
            success: function (data) {

                if (checkbox) {
                    alert('Saved successfully');
                    $('#frmaddbrand')[0].reset();
                    $('#brandsName').focus();
                    showOffBrands();
                } else {
                    window.location.reload();
                    alert('Saved successfully');
                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });






});
