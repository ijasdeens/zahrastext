$(document).ready(function(){

 const base_url = $('#base_url').val();



   $("#btn_upload_first_adss").click(function(e){

        let formdata = new FormData();
        let image = $('#first_ads')[0].files[0];

        formdata.append('img',image);

        $.ajax({
            url: base_url + 'Controllerunit/frm_first_ads_section',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
              alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });



    });



  $("#second_ads_btn").click(function(e){

        let formdata = new FormData();
        let image = $('#second_ads')[0].files[0];

        formdata.append('img',image);

        $.ajax({
            url: base_url + 'Controllerunit/frm_second_ads_section',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
              alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });



    });







  $("#second_ads_btn").click(function(e){

        let formdata = new FormData();
        let image = $('#second_ads')[0].files[0];

        formdata.append('img',image);

        $.ajax({
            url: base_url + 'Controllerunit/frm_second_ads_section',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
              alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });



    });





  $("#third_ads_btn").click(function(e){

        let formdata = new FormData();
        let image = $('#third_ads')[0].files[0];

        formdata.append('img',image);

        $.ajax({
            url: base_url + 'Controllerunit/frm_third_ads_section',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
              alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });



    });



  $("#frm_fourth_ads_btn").click(function(e){

        let formdata = new FormData();
        let image = $('#fourth_ads')[0].files[0];

        formdata.append('img',image);

        $.ajax({
            url: base_url + 'Controllerunit/frm_forth_ads_section',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
              alert('Saved successfully');
                window.location.reload();

            },
            error: function (err) {
                console.log('Error found', err);
            }
        });



    });




    $('#first_ads_remove').click(function(){

         if(confirm("Are you sure you want to delete it?")){
                   $.ajax({
            url: base_url + 'Controllerunit/first_ads_remove',
            method: 'POST',
            success: function (data) {
               alert('Removed successfully');
                window.location.reload();

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

         }

    });



    $('#remove_second_ads_section').click(function(){

         if(confirm("Are you sure you want to delete it?")){
                   $.ajax({
            url: base_url + 'Controllerunit/remove_second_ads_section',
            method: 'POST',
            success: function (data) {
               alert('Removed successfully');
                window.location.reload();

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

         }

    });



    $('#remove_third_ad_section').click(function(){

         if(confirm("Are you sure you want to delete it?")){
                   $.ajax({
            url: base_url + 'Controllerunit/remove_third_ad_section',
            method: 'POST',
            success: function (data) {
               alert('Removed successfully');
                window.location.reload();

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

         }

    });


    $('#fourth_remove_pic').click(function(){

         if(confirm("Are you sure you want to delete it?")){
                   $.ajax({
            url: base_url + 'Controllerunit/fourth_remove_pic',
            method: 'POST',
            success: function (data) {
               alert('Removed successfully');
                window.location.reload();

             },
            error: function (err) {
                console.error('Error found', err);
            }
        });

         }

    });





})//end of script
