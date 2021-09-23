$(document).ready(function () {

    const base_url = $('#base_url').val();






    const showOffStaff = () => {

        let html = null;
        let count = 0;

        $.ajax({
            url: base_url + 'Controllerunit/showOffStaff',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $("#showoffStaff").html('<span class="text text-danger font-weight-bold">No data found</span>');
                } else {
                    getData.map(d => {
                        count++;
                        html += `<tr class="text text-center">
<td>${count}</td>
<td>${d.staff_name}</td>
<td>${d.staff_mobile}</td>
<td>
${d.responsibility}
</td>
<td>
${d.joint_date}
</td>
<td>
${d.outlets_name}
</td>
<td>${d.cashier_ok==1 ? `<span class="badge badge-success">Active</span>` : `<span class="badge badge-danger">Inactive</span>`}</td>
<td>
${d.warehouse_ok==1 ? `<span class="badge badge-success">Active</span>` : `<span class="badge badge-danger">Inactive</span>`}
</td>
<td>
<td>${d.cashier_ok!=1 ? `<button class="btn btn-info btn-sm activecashierbtn" staff_id="${d.staff_id}">Active cashier</button> ` : `<button class="btn btn-danger btn-sm inactivecashierbtn" staff_id="${d.staff_id}">Inactive cashier</button> `}
<button class="btn btn-primary btn-sm editstaff" staff_id="${d.staff_id}" staff_name="${d.staff_name}" staff_mobile="${d.staff_mobile}" joint_date="${d.joint_date}" responsibility="${d.responsibility}" working_outlet="${d.working_outlet}">Edit</button>&nbsp;
${d.warehouse_ok!=1 ? `<button class="btn btn-info btn-sm activeforwarehouse" staff_id="${d.staff_id}">ACTIVE FOR WAREHOUSE</button>` : `<button class="btn btn-danger btn-sm inactivewarehouse" staff_id="${d.staff_id}">Inactive login from warehouse</button>`}

<button class="btn btn-danger btn-sm deleteStaff" staff_id="${d.staff_id}">Delete</button>
</td>
</tr>`;

                    });
                    $('#showoffStaff').html(html);
                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }


    showOffStaff();

    $('body').delegate('.activecashierbtn', 'click', function () {
        let staff_id = parseInt($(this).attr('staff_id'));

        if (confirm("Are you sure you want to change status?")) {

            $.ajax({
                url: base_url + 'Controllerunit/activecashierbtn',
                method: 'POST',
                data: {
                 staff_id:staff_id
                },
                success: function (data) {
                     alert('Activated as a cahiser');
                    showOffStaff();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }


    });
//



$('body').delegate('.activeforwarehouse', 'click', function () {
    let staff_id = parseInt($(this).attr('staff_id'));


     
    if (confirm("Are you sure you want to change status?")) {

        $.ajax({
            url: base_url + 'Controllerunit/activeforwarehouse',
            method: 'POST',
            data: {
             staff_id:staff_id
            },
            success: function (data) {
                 alert('Activated for entering into warehouse');
                showOffStaff();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


});

$('body').delegate('.inactivecashierbtn', 'click', function () {
        let staff_id = parseInt($(this).attr('staff_id'));

        if (confirm("Are you sure you want to change status?")) {

            $.ajax({
                url: base_url + 'Controllerunit/inactivecashierbtn',
                method: 'POST',
                data: {
                 staff_id:staff_id
                },
                success: function (data) {
                    console.log(data);
                     alert('Activated as a cahiser');
                    showOffStaff();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }


    });

    //inactivewarehouse

    
$('body').delegate('.inactivewarehouse', 'click', function () {
    let staff_id = parseInt($(this).attr('staff_id'));

    if (confirm("Are you sure you want to change status?")) {

        $.ajax({
            url: base_url + 'Controllerunit/inactivewarehouse',
            method: 'POST',
            data: {
             staff_id:staff_id
            },
            success: function (data) {
                console.log(data);
                 alert('Activated as a cahiser');
                showOffStaff();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


});


    $('body').delegate('.editstaff', 'click', function () {
        let staff_id = parseInt($(this).attr('staff_id'));
        let staff_name = $(this).attr('staff_name').toString();
        let staff_mobile = $(this).attr('staff_mobile');
        let joint_date = $(this).attr('joint_date');
        let responsibility = $(this).attr('responsibility');
 

        $('#up_save').attr('type', 'button');
        $('#up_save').text('Update');
        $('#up_save').removeClass('btn-success');
        $('#up_save').addClass('btn-primary');

        $('#staffName').val(staff_name);
        $('#hidden_id').val(staff_id);
        $('#staffmob').val(staff_mobile);
        $('#responsibility').val(responsibility);
        $('#joint_date').val(joint_date);
        $("#working_outlets").val($(this).attr('working_outlet'));
        $('#staffName').focus(); 
        $('#edit_staff_section').removeClass('d-none'); 
        $('#save_staff_section').addClass('d-none');
    });



    $('#edit_staff_section').click(function(){
        let staffName = $('#staffName').val(); 
        let staffmob = $('#staffmob').val(); 
        let joint_date = $('#joint_date').val(); 
        let working_outlets = $('#working_outlets').val(); 

        let staff_id = Number($('#hidden_id').val());

        let responsibility= $('#responsibility').val(); 

        if(staffName==''){
            alert('Staff name is required'); 
            $('#staffName').css('border','2px solid red'); 
            return false; 
        }
        if(staffmob==''){
            alert('Staff mobile is required'); 
            $('#staffmob').css('border','2px solid red'); 
            return false; 
        }
        if(staffmob.length!=10){
            alert('Mobile number must be 10 digits'); 
            $('#staffmob').css('border','2px solid red'); 
            return false; 
         }

       if(joint_date==''){
           alert('Joint date is required'); 
           $('#joint_date').css('border','2px solid red'); 

           return false; 
       } 

       if(working_outlets==''){
           alert('Please choose outlet name for staff'); 
           $('#working_outlets').css('border','2px solid red'); 

           return false; 
       }

       if(responsibility==''){
           alert('Responsibility is required'); 
           $('#responsibility').css('border','2px solid red'); 
           $('#responsibility').focus(); 
       }

       $.ajax({
        url: base_url + 'Controllerunit/editstaffsection',
        method: 'POST',
        data: {
            staff_id:staff_id,
            staffName:staffName,
            staffmob:staffmob,
            joint_date:joint_date,
            working_outlets:working_outlets,
            responsibility:responsibility
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



    $('#up_save').click(function () {


        let staffName = $("#staffName").val();
        let responsibility = $("#responsibility").val();
        let joint_date = $('#joint_date').val();
        let staffmob = $('#staffmob').val()

        let working_outlets = $("#working_outlets").val();

        if (staffName == "") {
            alert('Please enter the staff name');
            $('#staffName').css('border','2px solid red');
            return false;
        }

        if (working_outlets == "") {
            alert('Outlet is required');
            $('#working_outlets').css('border','2px solid red');
            $('#working_outlets').focus();
            return false;
        }
        if (isNaN(staffmob)) {
            alert('Ony numbers are allowed in mobile number');
            $('#staffmob').focus();
            $('#staffmob').css('border','2px solid red');
            return false;
        }

        if (staffmob.length!= 10) {
            alert('Mobile number should be 10 digits');
            $('#staffmob').focus();
            $('#staffmob').css('border','2px solid red');
            return false;
        }

        let id = parseInt($('#hidden_id').val());

              $.ajax({
            url: base_url + 'Controllerunit/checkstaffmobilenumber',
            method: 'POST',
            data: {
                staffmob:staffmob
            },
            success: function(data){
                let getData = JSON.parse(data);
                if(getData==0){
                       $.ajax({
                    url: base_url + 'Controllerunit/updatestaffs',
                    method: 'POST',
                    data: {
                        id: id,
                        staffName: staffName,
                        responsibility: responsibility,
                        joint_date: joint_date,
                        staffmob: staffmob,
                        working_outlets: working_outlets
                    },
                    success: function (data) {
                        $('#frmstaff')[0].reset();
                        $('#up_save').attr('type', 'submit');
                        $('#up_save').text('Save');
                        $('#up_save').removeClass('btn-primary');
                        $('#up_save').addClass('btn-success')

                        showOffStaff();
                    },
                    error: function (err) {
                        console.error('Error found', err);
                    }
                });


                }
                else {
                    alert('The mobile number has already existed');
                    return false;

                }



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });





    });



    $('body').delegate('.deleteStaff', 'click', function () {
        let staff_id = parseInt($(this).attr('staff_id'));


        if (confirm("Are you sure you want to delete it")) {
            $.ajax({
                url: base_url + 'Controllerunit/delestaff',
                method: 'POST',
                data: {
                    staff_id: staff_id
                },
                success: function (data) {
                    alert('Deleted successfully');
                    showOffStaff();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });


        }
    });


    $("#save_staff_section").click(function (event) {

        let staffName = $("#staffName").val();
        let responsibility = $("#responsibility").val();
        let joint_date = $('#joint_date').val();
        let staffmob = $('#staffmob').val();
        let working_outlets = $('#working_outlets').val();


        if (working_outlets == "") {
            alert('Working outlet is required');
            return false;
        }

        if (staffName == "") {
            alert('Please enter the staff name');
            return false;
        }


        if (isNaN(staffmob)) {
            alert('Ony numbers are allowed in mobile number');
            return false;
        }

        if (staffmob.length != 10) {
            alert('Mobile number should be 10 digits');
            return false;
        }
 
         $.ajax({
            url: base_url + 'Controllerunit/checkstaffmobilenumber',
            method: 'POST',
            data: {
                staffmob: staffmob,
             },
            success: function (data) {
                let getData = JSON.parse(data);
                console.clear();
                console.log(getData);
                if(getData==1){
                    alert('The mobile has already existed. Please choose different one');
                    return false;
                }
                else {

                              $.ajax({
                    url: base_url + 'Controllerunit/savestaffs',
                    method: 'POST',
                    data: {
                        staffName: staffName,
                        responsibility: responsibility,
                        joint_date: joint_date,
                        staffmob: staffmob,
                        working_outlets: working_outlets
                    },
                    success: function (data) {
                        alert('Saved successfully');
                        $('#frmstaff')[0].reset();
                        $('#staffName').focus();
                        showOffStaff();
                    },
                    error: function (err) {
                        console.error('Error found', err);
                    }
                });




                }
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });







    });


    $("#searchStaff").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffStaff tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });



});
