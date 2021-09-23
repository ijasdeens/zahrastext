$(document).ready(function () {

    const base_url = $('#base_url').val();


    $('#mainloginform').submit(function (e) {
        e.preventDefault();

        let mobNumber = $("#mobNumber").val();
        let mobPassword = $('#mobPassword').val();

        $.ajax({
            url: base_url + 'Controllerunit/mainloginareaforadmin',
            method: 'POST',
            data: {
                 mobNumber:mobNumber,
                mobPassword:mobPassword
            },
            success: function (data) {
                 if(data==0){
                     alert('Mobile number or password is incorrect');
                     return false;
                 }
                else {
                     window.location.reload();
                }
                //window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });



});
