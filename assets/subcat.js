$(document).ready(function () {
    const base_url = $('#base_url').val();





      $("#search_sub_categories_section").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffsubcats tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



    const showoffMaincategory = () => {

        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showOffCategories',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#main_category').html('<option>--No data found--</option>');
                    return false;
                } else {
                    getData.map(d => {
                        count++;
                        html += `<option value="${d.main_categoriesid}">${d.categoris_name}</option>`;
                    });

                    $('#main_category').html(html);
                    $('#umain_category').html(html);

                }

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showoffMaincategory();


    const showoffsubCategory = () => {
        let count = 0;
        let html = null;
        $.ajax({
            url: base_url + 'Controllerunit/showoffsubCategory',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#showoffsubcats').html('<span class="text text-danger font-weight-bold">No data found</span>');
                    return false;
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr class="text text-center">
<td class="text text-center">${count}</td>
<td class="text text-cetner">${d.categoris_name}</td>
<td class="text text-center">${d.sub_cat_id}</td>
<td class="text text-center">
<button class="btn btn-danger deletesubcategories" sub_cat_id="${d.sub_categoryid}">Delete</button>
&nbsp;
<button class="btn btn-primary editsubcategories" main_category_id="${d.main_categoriesid}" sub_category_name="${d.sub_cat_id}" sub_id="${d.sub_categoryid}">Edit</button>
</td>
<tr>`;
                    });

                    $('#showoffsubcats').html(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }
    showoffsubCategory();

    $('body').delegate('.editsubcategories', 'click', function () {

        let main_category_id = parseInt($(this).attr('main_category_id'));
        let sub_category_name = $(this).attr('sub_category_name').toString();
        let sub_id = parseInt($(this).attr('sub_id'));

        $("#umain_category").val(main_category_id);

        $('#usub_category').val(sub_category_name);
        $('#hidden_id').val(sub_id);
        $('#editsubcategory').modal('show');


    });


    $('#frmupdatecateogry').submit(function (event) {
        event.preventDefault();
       let id = parseInt($('#hidden_id').val());
        let main_category = parseInt($('#umain_category').val());
        let usub_category = $('#usub_category').val();

        $.ajax({
            url: base_url + 'Controllerunit/updatesubcategory',
            method: 'POST',
            data:{
                id: id,
                umain_category: main_category,
                usub_category: usub_category
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



    $('body').delegate('.deletesubcategories', 'click', function () {
        let sub_cat_id = parseInt($(this).attr('sub_cat_id'));

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deletesubcategories',
                method: 'POST',
                data: {
                    sub_cat_id: sub_cat_id
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


    $('#frmsavesubcategory').submit(function (e) {
        e.preventDefault();
        let main_category = $('#main_category').val();
        let sub_category = $('#sub_category').val();

         let checkall = $('#add_multiplesub').is(':checked') ? true : false;

        if (main_category == "") {
            alert('Please choose the main category');
        }
        if (sub_category == "") {
            alert('Please choose the sub category');
        }

        main_category = parseInt(main_category)
        $.ajax({
            url: base_url + 'Controllerunit/savesubcategory',
            method: 'POST',
            data: {
                main_category: main_category,
                sub_category: sub_category
            },
            success: function (data) {
                if (checkall) {
                    $('#frmsavesubcategory')[0].reset();
                    $('#sub_category').focus();
                    alert('Saved successfully');
                    showoffMaincategory();
                } else {
                    alert('Saved successfully');
                    window.location.reload();
                }


            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });


});
