$(document).ready(function () {

    const base_url = $('#base_url').val();


    const showOffCategories = () => {
        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showOffCategories',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#showoffcategoriessection').html('<span class="text text-danger">No data found</span>');
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr>
<td class="text text-center">${count}</td>
<td class="text text-center">${d.categoris_name}</td>
<td class="text text-center">
<button class="btn btn-outline-danger deletecategories" categoryId="${d.main_categoriesid}">REMOVE</button>
&nbsp;
<button class="btn btn-primary editcategory" categoryId="${d.main_categoriesid}" category_name="${d.categoris_name}">Edit</button>
</td>
</tr>`;
                    });

                    $('#showoffcategoriessection').html(html);
                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    showOffCategories();

    $('body').delegate('.editcategory', 'click', function () {
        let categoryId = parseInt($(this).attr('categoryId'));
        let category_name = $(this).attr('category_name');



        $('#hidden_id').val(categoryId);
        $('#ucategories').val(category_name);
        $("#updatecategories").modal('show');

    });

    $('#formupdatecategories').submit(function (event) {
        event.preventDefault();
        let id = parseInt($('#hidden_id').val());
        let categoriesName = $('#ucategories').val();

        if (categoriesName == "") {
            alert('Please enter the categories');
            $('#ucategories').focus();
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/updatecategories',
            method: 'POST',
            data: {
                id: id,
                categoriesName: categoriesName
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

    $('body').delegate('.deletecategories', 'click', function () {
        let categoryId = parseInt($(this).attr('categoryId'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deltecategories',
                method: 'POST',
                data: {
                    categoryId: categoryId,
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



      $("#search_categories_section").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffcategoriessection tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });







    $('#frmCategoriesName').submit(function (event) {
        event.preventDefault();


        let categoriesName = $('#categoriesName').val();

        let check = $('#addmultiple_categories').is(':checked') ? true : false;


        if (categoriesName == "") {
            alert('Categories name is required');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/savecategoriesName',
            method: 'POST',
            data: {
                categoriesName: categoriesName,
            },
            success: function (data) {
                if (check) {
                    $('#frmCategoriesName')[0].reset();
                    $('#categoriesName').focus();
                    showOffCategories();

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
