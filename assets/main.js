$(document).ready(function () {

    const base_url = $('#base_url').val();
 
    const smsSender = (smssenderTel, sendMessage) => {

        $.ajax({
            url: base_url + 'Controllerunit/smssender',
            method: "POST",
            data: {
                smssenderTel: smssenderTel,
                sendMessage: sendMessage,
            },
            success: function (data) {
                console.log(data);
                alert('SMS SENT successfully');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    const increaseCustomerId = () => {
        let number = 0;
        $.ajax({
            url: base_url + 'controllerunit/increaseCustomerId',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                number = getData.map(d => d.cusIds);
                number++;

                $('.customeridauto').val('cus_' + number);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    increaseCustomerId();

    const duecollectiondetailsforadmin = () => {
        let totalAmount = 0;
        $.ajax({
            url: base_url + 'controllerunit/duecollectiondetailsforadmin',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log('Date', getData);
                if (getData == "0") {
                    $('#duecollectiondetailsforadmin').html('Rs. 0.00');
                    return false;
                }
                getData.map(d => {
                    totalAmount += parseFloat(d.due_amount);
                });
                $("#duecollectiondetailsforadmin").html('Rs. ' + totalAmount.toFixed(2));
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    }
    duecollectiondetailsforadmin();


    const fetchtotalsalesdetails = () => {
        let totalAmount = 0;
        $.ajax({
            url: base_url + 'Accountantside/fetchtotalsalesdetails',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#totalsalesuptonow').html('Rs. 0.00');
                    return false;
                }
                totalAmount += parseFloat(getData.map(d => d.after_discount));
                $('#totalsalesuptonow').html('Rs.' + totalAmount.toFixed(2));
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

        console.log(totalAmount);

    }



    fetchtotalsalesdetails();

    const showoffcompletedorderdetails = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/showoffcompletedorderdetails',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#completedorderdetails').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
<td>${count}</td>
<td>${d.customer_name}</td>
<td>${d.customer_phoneNo}</td>
<td>${d.date}</td>
<td>${d.unique_key}</td>
<td>${d.customer_nic}</td>
<td>
<span class="badge badge-success">
${d.status}</span>
</td>
<td>
<button class="btn btn-outline-info btn-sm makependingorder" uniquekey="${d.unique_key}">Make pending</button>
<button class="btn btn-outline-warning btn-sm seeplacedorders" uniquekey="${d.unique_key}" customer_id="${d.customer_id}">Placed orders</button>

</td>
</tr>`;
                });
                $("#completedorderdetails").html(html);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showoffcompletedorderdetails();





    const showoffcustomerdetailsfororder = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/showoffcustomerdetailsfororder',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#showoffcustomersforrorder').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                    <td>${count}</td>
                    <td>${d.customer_name}</td>
                    <td>${d.customer_phoneNo}</td>
                    <td>${d.date}</td>
                    <td>${d.unique_key}</td>
                    <td>${d.customer_nic}</td>
                    <td>
                    <button class="btn btn-outline-primary showofforderstodetails" customer_id="${d.customer_id}" uniquekey="${d.unique_key}">View orders</button>
                    <button class="btn btn-outline-success form-control printbtn" customer_id="${d.customer_id}" uniquekey="${d.unique_key}"><i class="fa fa-print"></i>&nbsp;Print</button>
                    </td>
                    </tr>`;
                });
                $("#showoffcustomersforrorder").html(html);
                $('#totalorderdetails').html(count);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    const discountvalueshowoff = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/discountvalueshowoff',
            method: 'POST',
            success: function (data) {
                let getData = JSON.parse(data);
                console.log(getData);
                if (getData == "0") {
                    $('#discountvalueshowoff').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                    <td>${count}</td>
<td>${d.discount_type}</td>
<td>${d.discount_value}</td>
<td>
<button class="btn btn-danger deletediscount" discount_id="${d.discount_id}">Delete</button>
&nbsp;
<button class="btn btn-primary editdiscount" discount_id="${d.discount_id}" discount_type="${d.discount_type}" discount_value="${d.discount_value}">Edit</button>
</td>
</tr>`;
                });
                $("#discountvalueshowoff").html(html);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    discountvalueshowoff();
    showoffcustomerdetailsfororder();

    const ordereditems = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/ordereditems',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#ordereddate').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                console.log(getData);

                $('#ordereddate').html(html);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }

    //ordereditems();
    const showSalesRep = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/showsalesRep',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#salesRepdetails').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                    <td>${count}</td>
                    <td>${d.rep_name}</td>
                    <td>${d.rep_nic}</td>
                    <td>${d.rep_address}</td>
                    <td>${d.rep_phoneNo}</td>
                     <td>${d.rep_status==1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'}</td>
                    <td>
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item makestatusforrep" href="#" activestatus="${d.rep_status}" accountantId=${d.rep_id}>
                    ${d.rep_status==1 ? 'Inactive' : 'Active'}
                        </a>
                        <a class="dropdown-item editRep" href="#" repid=${d.rep_id} name="${d.rep_name}"  address="${d.rep_address}" nic="${d.rep_nic}" status="${d.rep_status}" mobile="${d.rep_phoneNo}">Edit</a>
                        <a class="dropdown-item deleteRep" href="#" accountantId=${d.rep_id}>Delete</a>
                      </div>
                    </div>

</td>
                </tr>`;
                });

                $('#salesRepdetails').html(html);



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showSalesRep();

    const showoffCustomerdetails = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/showcustomerdetails',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);
                if (getData == "0") {
                    $('#customerDetails').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                    <td>${count}</td>
                     <td>${d.customer_name}</td>
                    <td>${d.customer_phoneNo}</td>
                    <td>${d.customer_nic}</td>
                    <td>Rs.${d.customer_moneyforward}</td>
                    <td>
${d.shop_photo!="" ? `<img src="${base_url}assets/img/shopphotos/${d.shop_photo}" style="max-width:80px;max-height:80px;cursor:pointer;" class="img-fluid imageopen">` : `<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAjVBMVEX///+qqqqmpqaysrIxMTEtLS319fU7Ozunp6c4ODgqKiqXl5c0NDTKysrg4OCjo6N6enra2tqvr69YWFj39/fq6urR0dE/Pz/l5eXDw8O6urrd3d3FxcXV1dXt7e1ERERPT08XFxdtbW0dHR2Ojo6CgoIAAABqamqGhoZ1dXVQUFBaWlobGxsQEBBiYmKxhiw3AAAPG0lEQVR4nO1daWOiOhRlhyBIpaxRxG4ztX3T///zXjb2LSooaM+HmaoBcnLX5AYQhF/84he/uB942t6PKPy95t26O+NBizZBDEUHQSqAP4owDjaRdusOXgDPT2JZRHQMQ2yHYaBfRTlO/OWJVNvuZMytRIbQyYA/Fr+hL+TddjnS9NY70cnIYV6O4UK4s4Nks12vo/V6u0kCewehaziFgA3JEXfrBchSS6DB2CFyiJrdZ2rISG1ENKOJ/oDJrEXpJUg1M4mgznKaFzbYXOpIYZO5SnINHUpPctzTrQpZrstYSg5cT9LDi6DZonSxohUqLon2ftT+XYoIOtnoby5TMW/LNMFwYDRS7y7HRiQDj/q0Ged8kJ5PEsc536VIqHoivRrPC2Y6L4nJaOc8F5Sf4bhj+4a1TBT/1hy3jF/sT3ByP2YctxOcnLMLMuEnxVMFaS0mqYAkTzGAw/Bih8pvyiREo3J04hskAQm79NRJFuVoOMHE16mDKuh11MeH17tWDpsoqHEtF7Al5ujYV7ocGlSXDOr1LoiGlFzRvZIYA6o0180b99QsrmGNHrGKqxs+GlhsGRKc3KlGOGWU3FtMUzUsRkOaOB8Prm6BZdjTayq8xij2gGoQnOz8mmtcxRJ6QLyAMZWR+KJx1aDUDhyKDXGSsBFhX+bcfk66If2YwFKS6cbuROyJLo0+bQyI/s9jmc8j/mBkl4rDrSGPe84LgP3NuEkHNm8pHvOMFyKWxnV6ONLOiiClOF7mgVVU2o11tpGwG1FRCcFbh8Em7NEoJtIMJYiBpSiNEDSiuTmZAsTdXBz6fRwH50mQUbwwCdHwesx0ufylgHj95rI0HGUPhjtSd6bAxf0jYzSPVK0d3oU6hpNRZ16Vyjr2ziUpaiTNYrrUDzyZOnfVwRs1MZoMJKU8z5KQEc7YjRY4u5/B+WNzXRBdO8MUcai/4araKcD+Qjo98LuLMEIKbIonR0V80Hzm9EOQTxeHj3ywM+sdZhVozskJqnylOs9YCE5VuWRROoohnzZX9HCeMO9srY49zr/4Y1uMYuhS/GgG2zhhHovdjDFlbyaBcYKzwTp9u31I52LL7zs2qOkS8tE6+AUjXr74cRNg4xJ5GqJIMdulp34gB8kVMcRFZTNlaHxCXK4IeYWIdzssU4RIiBKHEDcLFiEV4tDC0nKtEIPDEqNFi5AKsX9hAhrLjIUZUEzsX5XCUl7WrKkOecDKUIIuzfCWoxOwlvqnRSJn3jNj9FMYGoAloF8N4aJDBQV2JZ2+xuv7cTGAPcsZKCUdzAjmD5SVdSan2NNetTOToEcTUd66iFrTEFDW0jF3wEq6vOWZJrrVFJmosYRq2hA8o0NNO39YHGDH9op1jw9aFpKOoL8zlh/uKVDQN9o24olnVBlnCrc1N+0ivkTEreq4vZNYgdHO5X7MsEsf5QvrTVpi22PqQBTY9tlPoDBalio8viUo8cV8yZppf15ye4bPpoJgfjRIbv/9I8O5+2e+/eTfrv4z397zT5pp/qvMS7cfikrOdzD27Fpmjn/DA4kXpOqj4yOGHNFQBmmaZv1SARso76+lW4fn5xD9V8/d14pFOm9baarky2BfYaqv8jYQpOFT6Zh3BVg6Ol8KLAtAeq1UVxhehhniiFhfUMNJKcciG2IYWnKNofesW0esUVqc6mqNYonhF8h+C5SvMsPvMA3DwgkcLfAcY9l5kXwwV/RauhOtKbbDuhu1ZC+4sM2h9TIIX8PUqzJ80q1cXf+GZnUdpGCoi+DAvvxQRL1guFZBAEAejFcWKBRYgKvKtfigtZS8Zb54LwNrC5gosqsmil70yDuEz5UjCoZKlCpsB4sK9krBcAW+hE/9i33yLf1JqONEhjjm19tzbrWVgSq861Sjsqt+hKpXbqFUNuKUGTrKB/kOKj+CWTBM0ZAFlspSyRWwmuZyKkO8ubl2Bs5VNsTQ8xSqRdlV1fCj3EQtSVSoMoyAScbirwJLDHcW9kBfmWo+68fmdU9laDdmwRHnEg1iqAkOUPfFVddK9eLf4Xf5Y4nhWvhRsKJEiq6VGB71v+hfB1Dz3oegZSkFXUv0NAaOfm4ajhN/w7PVkjD0Qv2zYBhYVkUtP3W9kyFUCBmsrDlDH5DTRIpFfEPE4kOdYQpUCjNt/txAU2IBZ85GGAou7m3GkHS9hJWudjL0dBWN40FNSgwlQM34LxFl3j6P8n/OYYjztuq+PBwsOA5kDIUvbCsFw8povetKJ0PhU1kJthIKJYYpc50QgIi2Zyml9g+F9zA1KcPTtFRohAvIOTlkDKFlJRnDJO8SxTGsDHKVYaAeUDB0SgzR4WywFWKAfhEZ8VMWP8OM4Wk1Mbe+JCNyrtEwhkiI39lVNVOvuIYwrPjCKkMhtWKLyCpj+BGm7ysM5yvEsvVSYuQZVvp5DGF9EjxUWMyQMUT9tT121UP4VWqxVUBFG2oMkcsMib0xhpqe6hbNN3WaEBz1Q+nwsxkatdVt3gl+xhD5hW+PhQmjEuM/dFBx0zWGkRKSiJExRNZHRYiQ6jiwxsypUpzLcFdj6DmcZbWc4UYBok6v6qVhmls/VEAl4NcZCu9PR6/E8KcUPVc6wOd5DkO/9N15DFHIr9Rnms61AzlD4SlMU3bVWAm/2IzGBeGhmsDXGWagDNcASPlXW6oUWzUM8+H+yD3NaWu59fC3510rLRhGZs5QEM1QObp27HxbNR0dYohEVNqL/B2SObKt6Mr3Ctqx+5kCQDyzpoY/TwxHHq+PZ4PlXc4+b13NNd+ykflUgJldK/hCc1ZFsSzlqR6t1m8mneObbxWGLypmaCo/pe9E0yTj7B9Vy6L+50A9ovYGrGwGbFbNoB31tC3iXWjbuPl6+d6V3WJU7Pe/39/Hlrty965Lvoxct7JzXHQD/LgUtzywmusyTYrEp59ndL7MdDxRzuHy2NO2loZihsveg1HH+iEZLuMuLl7UGT2GDO+f4b0ULSjqvpQ7Hi4G9XjIndMsBvWchjsvXQzqeSn33GIxqM8tuOeHi0F9fsg9x18MGnN83nWaxaCxtMa71iZEf8w/NM4c3szyD+bbodYAI317Jf//eWtOeWotaflTST8ycxFf/pR9hfhSFEmHl0wba22866VoypoV/qBllZyTrViw1gDjmS2GluowLaciLcOQzP4sXXmlLqKYbbOPaTZFVA+D/Wysl/KueQuHMA3p+b1QL1VkPvTQqzUg/e5hWGsZvuIS6Eb+1gE9b4OhlawzDHWzGf546xa2AgKgUNm961beAw2wilO5gdDLsKMlLrLqe0qpxlDl37jQrFvw1p6ewKvwCuiS76a0MioDtrRfbiD0MuxoiRcY6YpOkyH/bphm7YmzfrjXkbVBi45xuY6WLQpWG/Qx7GqJfAKwohZKJzFs1g85a8AiwHUlFdDlIRdYTO5bi4mz2qCPYVdLvOhNXeUlWtqsAXPW8Q/EuXywdXdNzfq90llnqg36GDZbHgVN0/bBk6XSsW4wVPys/DRItaWOz7UXY0PrREFWTzuGgP4AwmNrg26GzZZhiKuDKFo8JRmlerRQWAnxbejGnra9GFz7aT7ZiB9Yeci2aGFtl4XGeoNuhs2WlKGqgNS4mGHbfhqePVFeCGg/VyALfnRXQVYuajboYtjWEmupp22cUDm2M+TX0rY9UTz72lAWQw/zrTyBsZAv3FtFmlNr0MWwuyVSYJVWpy7wNG372nj2Jv6EKauDHWiBQYgUYJDyWtTRoIthd0uBVO7aGXJHi7a9iRz7SyOQ757TU0A5verPuHN/uxp0MOxpKWDNUC5j2L6/dHiPsKODrJa5AqyyDYG13Wb7Q1oadDDsaSmQTVaXMWznMrzPG4Sv+d95nFD01SrbfNHSoINhT0vyK1Hc8xm27/Me3KuPQkPhivL48K6naRE7Gg3aGfa1FPzXUJEZpfL1ax/70L5Xf9AQn/S0cE9etgsmsdLUSjob5AzT77zAmbS3DL/Irz94gsgohcfsoM/qx2PvPKhLHQfumdmbankXyLvKirfPlvXV3eCg0tj2UhQ43+z2lhZgDVI2/q6ZfUOmvKWPA9uEu+6ZGbjvac0qnQyRy94lF7isYtnaALpUHcsFTr+9Jfu5eMPgxi0OgtWPbu9jurrue7r/e9fu5CZZOvtt53H/95De/33Ad6Kmffdy3//9+Pf/TIUHeC7G/T/b5AGeT7P8Zwy5Q67k7p8T9QDP+iLPa1vW83XLwG9KGFq6v/9n7t3/cxMf4NmXC35yIufzSxcsRN5n0N7/c4RPeWz0rHDCQ7rv/nneC30m+0lvKLv75+o/wLsR7v/9Fg/wjpIHeM/Mwt4VdNarm+7+fU8P8M6u+3/v2gO8O+8B3n94/++wXMR7SP2L3kP6AO+SfYD3AdN3Os83t5Evf6czfS/3XGMGNqJzQn0Vd/9udfqSMmmONyfucMdGCWaBM8vIjyO9M9IcllCcmxR3IxJkidG8bDEeOaW0sRTn5FEhluColoMVdUZxEYeJ8VSUAqeohjuPBM5zjSkWynAOb4hzqNjsRSzBCR4BgedSc5hM4aGeaH3FJ2N368BoT6lLGtF/eEtj9CDxB9Ot5JLz33AFLpKMqcMWdqm3S+FscvWJqw10FPvvBpgImnwdDSKWMHq45UBAfOhVvADVVPm6YtzL19DQ/GouEeM1rZFaoHu9hAMHJdEwrrWdYYuN/8qh2KdKI19jUH14vWuVkThkXOOpy6haTPRlijx0CB679KQcET86kLdJpKiqGlI8lVvVYmKA11fQAluRcHTgFF3wqfwk8bb7sxLG0R37Joa1zPjd/lmAlCP6xx7PIDU7O+nt+WFsRGIuSFnPfkFTGd4GEvEZknj7+XaGiPZJlC4m6W2hQ8SHxmte+yQyvTIkAybnqquWQEMyRtf50bBmo4/9Trw9tYPaNnbZ8UgT5nrzlZdAiZGUHAkmER9NLUpiw6HCEyV03DwWLTuAFE1kfTWQxrnQ3vTw1KKNDV3Ujh0hieer+BXhrXdiJhFMU3IQUbizg2SD3zqyXm83SWDvIKLmSBk5LHVxt5619CrwtjtZkjKahCnmmgN/LH5DX8i7ky339vD8JJZFqRBTA4S0KMeJvxzZNaH5myCGooNQkiH+KMI42PjLk1wnPG3vRxT+fviZcr/4xS9+sSD8Dwlg+6V4zK0MAAAAAElFTkSuQmCC" style="max-width:80px;max-height:80px;cursor:pointer;" class="img-fluid imageopen">`}


</td>
                    <td><button class="btn btn-danger deletecustomerDetails" customer_id=${d.customer_id} pic_photo="${d.shop_photo}">Delete</button>
                    <button customer_id=${d.customer_id} customer_name="${d.customer_name}" customer_nic="${d.customer_nic}" customer_phoneNo="${d.customer_phoneNo}" shop_url="${base_url}assets/img/shopphotos/${d.shop_photo}" class="btn btn-primary editcustomerDetails d-none">Edit</button>
</td>
                </tr>`;
                });

                $('#customerDetails').html(html);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    }
    showoffCustomerdetails();

    const showAccountant = () => {

        let html = null;
        let count = 0;
        $.ajax({
            url: base_url + 'controllerunit/showaccountant',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);

                if (getData == "0") {
                    $('#Accountatindetails').html('<span class="text text-danger">No data found</span');
                    return false;
                }

                getData.map(d => {
                    count++;
                    html += `<tr>
                        <td>${count}</td>
                        <td>${d.acc_name}</td>
                        <td>${d.acc_email}</td>
                        <td>${d.acc_nic}</td>
                        <td>${d.acc_address}</td>
                        <td>${d.Mobile}</td>
                        <td>${d.status==1 ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-danger">Inactive</span>'}</td>
                        <td>
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item statusmaker" href="#" activestatus="${d.status}" accountantId=${d.acc_id}>
${d.status==1 ? 'Inactive' : 'Active'}
</a>
                        <a class="dropdown-item editdata" href="#" accountantId=${d.acc_id} name="${d.acc_name}" email="${d.acc_email}" address="${d.acc_address}" nic="${d.acc_nic}" status="${d.status}" mobile="${d.Mobile}">Edit</a>
                        <a class="dropdown-item deleteData" href="#" accountantId=${d.acc_id}>Delete</a>
                      </div>
                    </div>
                    </td>
                    </tr>`;
                });

                $('#Accountatindetails').html(html);



            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showAccountant();


    const showoffExpensedetails = () => {

        let html = null;
        let count = 0;
        let totalexp = 0;
        $.ajax({
            url: base_url + 'controllerunit/showoffExpensedetails',
            method: 'POST',
            success: function (data) {

                let getData = JSON.parse(data);

                if (getData == "0") {
                    $('#expensesDetails').html('<span class="text text-danger">No data found</span');
                    $('#totalExpensesamount').html('Rs.0.00');
                    return false;
                }

                getData.map(d => {
                    count++;
                    totalexp += parseFloat(d.expenses_amount);
                    html += `<tr>
<td>${count}</td>
<td>Rs. ${d.expenses_amount}</td>
<td>${d.expensesReason}</td>
<td>${d.expenses_date}</td>
<td>
<button class="btn btn-outline-danger btn-sm deleteExpenseitem" id=${d.expenses_id}>Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
<button class="btn btn-outline-primary btn-sm editexpenses" id=${d.expenses_id} amount="${d.expenses_amount}" expensesReason="${d.expensesReason}" expenses_date="${d.expenses_date}">Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>

<td>
</tr>`;
                });

                $('#expensesDetails').html(html);
                $('#totalExpensesamount').html('Rs.' + totalexp.toFixed(2));
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }

    showoffExpensedetails();


    $('#frmsaveAccountant').submit(function (e) {
        e.preventDefault();



        let accoutantName = $('#accoutantName').val();
        let accountantEmail = $('#accountantEmail').val();
        let accountantNic = $("#accountantNic").val();

        let accountantAddress = $('#accountantAddress').val();
        let accountantStatus = $('#accoutantStatus').val();

        let accountantpassword = $('#accountantpassword').val();

        let mobileNumber = $('#mobileNumber').val();


        if (accoutantName == "") {
            alert('Name is required');
            return false;
        }


        if (mobileNumber == "") {
            alert('Mobile number is required');
            return false;
        }


        $.ajax({
            url: base_url + 'Controllerunit/saveaccountantdetails',
            method: 'POST',
            data: {
                accoutantName: accoutantName,
                accountantEmail: accountantEmail,
                accountantNic: accountantNic,
                accountantAddress: accountantAddress,
                accountantStatus: accountantStatus,
                accountantpassword: accountantpassword,
                mobileNumber: mobileNumber
            },
            success: function (data) {
                $("#saveaccountModal").modal('hide');
                $('#frmsaveAccountant')[0].reset();
                swal("Saved successfully", "Accountant has been saved", "success");
                showAccountant();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });




    $('body').delegate('.deleteData', 'click', function () {
        let accountantId = parseInt($(this).attr('accountantId'));

        if (accountantId != "") {

            if (confirm("Are you sure you want to delete it?")) {
                $.ajax({
                    url: base_url + 'Controllerunit/deleteAccountant',
                    method: "POST",
                    data: {
                        accountantId: accountantId
                    },
                    success: function (data) {
                        swal("Accountant has been deleted successfully");
                        showAccountant();
                    },
                    error: function (err) {

                    }
                });
            }


        }


    });


    $('body').delegate('.deleteRep', 'click', function () {
        let accountantId = parseInt($(this).attr('accountantId'));

        if (accountantId != "") {

            if (confirm("Are you sure you want to delete it?")) {
                $.ajax({
                    url: base_url + 'Controllerunit/deleteRep',
                    method: "POST",
                    data: {
                        accountantId: accountantId
                    },
                    success: function (data) {
                        swal("Sales rep has been deleted successfully");
                        showSalesRep();
                    },
                    error: function (err) {

                    }
                });
            }


        }


    });



    $('body').delegate('.statusmaker', 'click', function () {


        let id = parseInt($(this).attr('accountantId'));
        let activeStatus = parseInt($(this).attr('activestatus'));

        $.ajax({
            url: base_url + 'Controllerunit/statusmaker',
            method: "POST",
            data: {
                activeStatus: activeStatus == 1 ? 0 : 1,
                id: id
            },
            success: function (data) {
                swal("Status has been updated");
                showAccountant();
            },
            error: function (err) {

            }
        });



    });



    $('body').delegate('.makestatusforrep', 'click', function () {


        let id = parseInt($(this).attr('accountantId'));
        let activeStatus = parseInt($(this).attr('activestatus'));


        $.ajax({
            url: base_url + 'Controllerunit/makestatusforrep',
            method: "POST",
            data: {
                activeStatus: activeStatus == 1 ? 0 : 1,
                id: id
            },
            success: function (data) {

                swal("Status has been updated");
                showSalesRep();
            },
            error: function (err) {

            }
        });



    });





    $('body').delegate('.editdata', 'click', function () {
        let accountantId = parseInt($(this).attr('accountantId'));
        let name = $(this).attr('name');
        let email = $(this).attr('email');
        let address = $(this).attr('address');
        let nic = $(this).attr('nic');
        let status = $(this).attr('status');
        let mobile = $(this).attr('mobile');

        $('#upaccoutantName').val(name);
        $('#upaccountantEmail').val(email);
        $('#upaccountantNic').val(nic);
        $('#upmobileNumber').val(mobile);
        $('#upaccountantAddress').val(address);
        $('#hidden_id').val(accountantId);

        $('#updateAccountantModal').modal('show');



    });


    $('#upfrmsaveAccountant').submit(function (e) {
        e.preventDefault();



        let accoutantName = $('#upaccoutantName').val();
        let accountantEmail = $('#upaccountantEmail').val();
        let accountantNic = $("#upaccountantNic").val();

        let accountantAddress = $('#upaccountantAddress').val();
        let accountantStatus = $('#upaccoutantStatus').val();

        let accountantpassword = $('#upaccountantpassword').val();

        let mobileNumber = $('#upmobileNumber').val();


        if (accoutantName == "") {
            alert('Name is required');
            return false;
        }


        if (mobileNumber == "") {
            alert('Mobile number is required');
            return false;
        }

        let hidden_id = parseInt($('#hidden_id').val());
        $.ajax({
            url: base_url + 'Controllerunit/updateaccountant',
            method: 'POST',
            data: {
                accoutantName: accoutantName,
                accountantEmail: accountantEmail,
                accountantNic: accountantNic,
                accountantAddress: accountantAddress,
                accountantStatus: accountantStatus,
                accountantpassword: accountantpassword,
                mobileNumber: mobileNumber,
                hidden_id: hidden_id
            },
            success: function (data) {
                console.clear();
                console.log(data);
                $("#updateAccountantModal").modal('hide');
                $('#upfrmsaveAccountant')[0].reset();
                swal("Updated successfully", "Accountant has been updated", "success");
                showAccountant();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });






    $("#frmsalesRepaccountant").submit(function (event) {
        event.preventDefault();
        let salesaccoutantName = $('#salesaccoutantName').val();
        let salesaccountantNic = $('#salesaccountantNic').val();
        let salesmobileNumber = $('#salesmobileNumber').val();
        let salesaccountantAddress = $("#salesaccountantAddress").val();
        let salesaccoutantStatus = $('#salesaccoutantStatus').val();
        let salesaccountantpassword = $('#salesaccountantpassword').val();


        if (salesaccoutantName == "") {
            alert('Please enter the name');
            return false;
        }
        if (salesaccountantNic == "") {
            alert('Please enter the NIC');
            return false;
        }
        if (salesmobileNumber == "") {
            alert("Mobile number is required");
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/savesalesaccountant',
            method: 'POST',
            data: {
                salesaccoutantName: salesaccoutantName,
                salesaccountantNic: salesaccountantNic,
                salesmobileNumber: salesmobileNumber,
                salesaccountantAddress: salesaccountantAddress,
                salesaccoutantStatus: salesaccoutantStatus,
                salesaccountantpassword: salesaccountantpassword
            },

            success: function (data) {
                console.clear();
                console.log(data);
                $("#savesalesmanadetails").modal('hide');
                $('#frmsalesRepaccountant')[0].reset();
                swal("Saved", "Sales rep has been saved", "success");
                showSalesRep();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });






    $('#updatesalesForm').submit(function (event) {
        event.preventDefault();

        let updateSlesName = $('#updateSlesName').val();
        let updatesalesNic = $("#updatesalesNic").val();
        let UpdatesalesPhone = $("#UpdatesalesPhone").val();
        let updateSalesAddress = $('#updateSalesAddress').val();

        let updateSalesStatus = $('#updateSalesStatus').val();
        let updateSalesPassword = $('#updateSalesPassword').val();


        let id = parseInt($('#hidden_id').val());


        if (updateSlesName == "") {
            alert('Name is required');
            return false;
        }

        if (updatesalesNic == "") {
            alert('NIC is required');
            return false;
        }

        if (UpdatesalesPhone == "") {
            alert('Please enter the mobile no');
            return false;
        }



        $.ajax({
            url: base_url + 'Controllerunit/updatesalesRep',
            method: 'POST',
            data: {
                updateSlesName: updateSlesName,
                updatesalesNic: updatesalesNic,
                UpdatesalesPhone: UpdatesalesPhone,
                updateSalesAddress: updateSalesAddress,
                updateSalesStatus: updateSalesStatus,
                updateSalesPassword: updateSalesPassword,
                id: id
            },

            success: function (data) {
                console.clear();
                console.log(data);
                $("#updatesalesModal").modal('hide');
                $('#updatesalesForm')[0].reset();
                swal("Updated", "Sales rep has been updated", "info");
                showSalesRep();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });




    });




    $('body').delegate('.editRep', 'click', function () {

        let repId = parseInt($(this).attr('repid'));
        let name = $(this).attr('name');
        let address = $(this).attr('address');
        let nic = $(this).attr('nic');
        let status = $(this).attr('status');
        let mobile = $(this).attr('mobile');

        $('#hidden_id').val(repId);
        $('#updateSlesName').val(name);
        $('#updatesalesNic').val(nic);
        $("#UpdatesalesPhone").val(mobile)
        $('#updateSalesStatus').val(status);
        $('#updateSalesAddress').val(address);
        $("#updatesalesModal").modal('show');

    });

    $('body').delegate('.deleteExpenseitem', 'click', function () {
        let id = parseInt($(this).attr('id'));

        if (confirm("Are you sure you want to delete it?")) {

            $.ajax({
                url: base_url + 'Controllerunit/deleteExpenses',
                method: 'POST',
                data: {
                    id: id

                },

                success: function (data) {
                    $("#expenesmodal").modal('hide');
                    swal("Expenses details deletion", "Deleted successfully", "warning");
                    showoffExpensedetails();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });

        }


    })



    $("#expenseform").submit(function (e) {

        e.preventDefault();

        let expenseAmount = $("#expenseAmount").val();

        let expenseReason = $("#expenseReason").val();

        let expenseDate = $('#expenseDate').val();




        if (expenseAmount == "") {
            alert('Please enter the expense amoutn');
            return false;
        }
        if (expenseReason == "") {
            alert('Please enter the expense reason');
            return false;
        }
        if (expenseDate == "") {
            alert('Please enter the expense date');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/saveExpenses',
            method: 'POST',
            data: {
                expenseAmount: expenseAmount,
                expenseReason: expenseReason,
                expenseDate: expenseDate,

            },

            success: function (data) {
                $("#expenesmodal").modal('hide');
                swal("Expenses", "Expenses added successfully", "success");
                showoffExpensedetails();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });


    $('body').delegate('.editexpenses', 'click', function () {
        let id = parseInt($(this).attr('id'));
        let amount = $(this).attr('amount');
        let expenseDetails = $(this).attr('expensesReason');
        let expenses_date = $(this).attr('expenses_date');

        $('#upexpenseAmount').val(amount);
        $('#upexpenseReason').val(expenseDetails);
        $('#upexpenseDate').val(expenses_date);

        $('#hidden_id').val(id);


        if (amount == "") {
            alert('Amount is required');
            return false;
        }

        if (expenseDetails == "") {
            alert('Expense details is required');
            return false;
        }

        if (expenses_date == "") {
            alert('Expense made date is required');
            return false;
        }

        $('#updateexpensemodal').modal('show');

    });


    $('#upexpenseform').submit(function (e) {
        e.preventDefault();

        let id = parseInt($('#hidden_id').val());
        let expenseAmount = $("#upexpenseAmount").val();
        let expenseReason = $('#upexpenseReason').val();
        let expenseDate = $('#upexpenseDate').val();


        $.ajax({
            url: base_url + 'Controllerunit/updatexpenses',
            method: 'POST',
            data: {
                expenseAmount: expenseAmount,
                expenseReason: expenseReason,
                expenseDate: expenseDate,
                id: id
            },

            success: function (data) {
                $("#updateexpensemodal").modal('hide');
                swal("Expenses details", "Expenses updated successfully", "info");
                showoffExpensedetails();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    $('#searchexpbydate').click(() => {
        let fromexp = $('#fromexp').val();
        let toexp = $('#toexp').val();

        if (fromexp == "") {
            alert('Please choose the from date');
            return false;
        }
        if (toexp == "") {
            alert('Please choose the "To date"');
        }
        let count = 0;
        let html = null;
        let rangetotalAmount = 0;

        $.ajax({
            url: base_url + 'controllerunit/searchexpbydate',
            method: 'POST',
            data: {
                fromexp: fromexp,
                toexp: toexp
            },
            success: function (data) {

                let getData = JSON.parse(data);

                if (getData == "0") {
                    $('#expensesDetails').html('<span class="text text-danger">No data found</span');
                    $('#rangeexpdetails').html('Expenses : Rs.0.00');
                    return false;
                }

                getData.map(d => {
                    count++;
                    rangetotalAmount += parseFloat(d.expenses_amount);
                    html += `<tr>
                    <td>${count}</td>
                    <td>Rs. ${d.expenses_amount}</td>
                    <td>${d.expensesReason}</td>
                    <td>${d.expenses_date}</td>
                    <td>
                    <button class="btn btn-outline-danger btn-sm deleteExpenseitem" id=${d.expenses_id}>Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                    <button class="btn btn-outline-primary btn-sm editexpenses" id=${d.expenses_id} amount="${d.expenses_amount}" expensesReason="${d.expensesReason}" expenses_date="${d.expenses_date}">Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>

                    <td>
                    </tr>`;
                });

                $('#expensesDetails').html(html);
                $('#rangeexpdetails').html(`Expenses from ${fromexp} to ${toexp} : <b>Rs. ${rangetotalAmount.toFixed(2)}</b>`);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });




    $('#savecustomerdetails').submit(function (e) {
        e.preventDefault();
        $("#savebtn").addClass('d-none');
        $("#savesbtn").removeClass('d-none');
        let customername = $('#customername').val();
        let customer_nic = $('#customer_nic').val();
        let customer_phoneNo = parseInt($('#customer_phoneNo').val());

        let moneyforward = $('#forwardedamount').val();


        let shopimage = $("#shopimage")[0].files[0];

        let formdata = new FormData();

        let Message = "Registered successfully at Nowfarspicy. Thank you!";

        formdata.append('customername', customername);
        formdata.append('customer_nic', customer_nic);
        formdata.append('customer_phoneNo', customer_phoneNo);
        formdata.append('shopimage', shopimage);
        formdata.append('customer_moneyforward', moneyforward);

        $.ajax({
            url: base_url + 'controllerunit/savecustomerdetails',
            type: "post",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                alert('Saved successfully');

                smsSender(customer_phoneNo, Message);
            },
            error: function (err) {
                console.log('Error found', err);
            }
        });




    });



    $('body').delegate('.imageopen', 'click', function () {
        let url = $(this).attr('src');
        var win = window.open(url, '_blank');
        win.focus();
    });



    $('body').delegate('.deletecustomerDetails', 'click', function () {

        let customer_id = parseInt($(this).attr('customer_id'));
        let photoLink = $(this).attr('pic_photo');

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deleteCustomerdetails',
                method: "POST",
                data: {
                    customer_id: customer_id,
                    photoLink: photoLink
                },
                success: function (data) {
                    swal("Customer has successfully been deleted");
                    showoffCustomerdetails();
                },
                error: function (err) {

                }
            });
        }

    });


    $("#searchCustomer").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#customerDetails tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#frmsavediscount').submit(function (e) {
        e.preventDefault();

        let discounttype = $("#discounttype").val();
        let discountvalue = $("#discountvalue").val();

        if (discounttype == "") {
            alert('Discount type is required');
            return false;
        }
        if (discountvalue == "") {
            alert('Discount value is required');
            return false;
        }

        $.ajax({
            url: base_url + 'Controllerunit/savediscounttype',
            method: "POST",
            data: {
                discounttype: discounttype,
                discountvalue: discountvalue
            },
            success: function (data) {
                console.log(data);
                swal("Saved successfully");
                $('#discountvaluemodal').modal('hide');
                discountvalueshowoff();
            },
            error: function (err) {

            }
        });
    });


    $('body').delegate('.deletediscount', 'click', function () {
        let discount_id = parseInt($(this).attr('discount_id'));

        if (discount_id == "") {
            alert('Id is missing');
            return false;
        }

        if (confirm("Are you sure you want to delete it?")) {
            $.ajax({
                url: base_url + 'Controllerunit/deletediscount',
                method: "POST",
                data: {
                    discount_id: discount_id,
                },
                success: function (data) {
                    console.log(data);
                    swal("Saved successfully");
                    $('#discountvaluemodal').modal('hide');
                    discountvalueshowoff();
                },
                error: function (err) {
                    console.error('Error found', err);
                }
            });
        }

    });


    /*
    <button class="btn btn-primary editdiscount" discount_id="${d.discount_id}" discount_type="${d.discount_type}" discount_value="${d.discount_value}">Edit</button>
*/

    $('body').delegate('.editdiscount', 'click', function () {
        let discount_id = parseInt($(this).attr('discount_id'));
        let discount_type = $(this).attr('discount_type');
        let discount_value = $(this).attr('discount_value');


        $('#ediscounttype').val(discount_type);
        $('#ediscountvalue').val(discount_value);
        $('#discountvalueeditid').val(discount_id);
        $("#discountvaluemdaledit").modal('show');


    });


    $("#efrmsavediscount").submit(function (e) {
        e.preventDefault();
        let ediscounttype = $('#ediscounttype').val();
        let ediscountvalue = $("#ediscountvalue").val();
        let discountvalueeditid = parseInt($(this).attr('discountvalueeditid'));

        if (ediscounttype == "" || ediscountvalue == "" || discountvalueeditid == "") {
            alert('Fields are missing');
            return false;
        }


        $.ajax({
            url: base_url + 'Controllerunit/updatediscount',
            method: "POST",
            data: {
                discountvalueeditid: discountvalueeditid,
                ediscounttype: ediscounttype,
                ediscountvalue: ediscountvalue
            },
            success: function (data) {
                console.log(data);
                swal("Updated successfully");
                $('#discountvaluemdaledit').modal('hide');
                discountvalueshowoff();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    });



    /*<button class="btn btn-outline-primary showofforderstodetails" customer_id="${d.customer_id}" uniquekey="${d.unique_key}" data-toggle="modal" data-target="#showoffdetailsorderdetails">View orders</button>*/

    function getdiscountvalue(wholeamount, given_discount) {
        let value = (wholeamount / 100) * given_discount;
        return value;
    }

    function getbillnumber() {
        let number = 0;
        let billnumber = 0;

        $.ajax({
            url: base_url + 'Controllerunit/getbillnumber',
            method: "POST",
            success: function (data) {
                let getData = JSON.parse(data);
                number = getData.map(d => d.asmaxid);
                number++;
                if (number.toLocaleString().length < 2) {
                    billnumber = '000' + number;
                }

                if (number.toLocaleString().length >= 2) {
                    billnumber = '00' + number;
                }
                if (number.toLocaleString().length >= 3) {
                    billnumber = number;
                }

                $('#billnumbershown').html(' ' + billnumber);


            },
            error: function (err) {
                console.error('Error found', err);
            }
        });



    }
    getbillnumber();


    function datatosendMessage(getbillnumber, totalamount, wholeamount, given_discount, discountedAmount) {
        //comeback
        console.clear();
        console.log('Bill NO :', $('#billnumbershown').html());
        console.log('Total amount :', totalamount);
        console.log('Whole Amount :', wholeamount);
        console.log('Whole amount : ', wholeamount);
        console.log('Given discount  : ', given_discount);

        let message = `Bill NO : ${$('#billnumbershown').html()}
    Total amount : ${wholeamount}
    Discount : ${given_discount}
    Discounted Amount : ${discountedAmount}
    Payable amount : ${totalamount}`;

        let messages = `Bill NO : ${$('#billnumbershown').html()},Total amount : Rs.${wholeamount},Discount : ${given_discount}, Discounted Amount : Rs.${discountedAmount},Payable amount : Rs.${totalamount}`;

        sessionStorage.setItem('message', messages);


    }

    $('body').delegate('.showofforderstodetails', 'click', function () {


        var today = new Date();

        var date = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();
        let fulltime = new Date().toLocaleTimeString();
        $('#todaydate').html(date);
        $('#printedtime').html(fulltime);
        let customer_id = parseInt($(this).attr('customer_id'));
        let uniquekey = $(this).attr('uniquekey');
        let totalamount = 0;

        let username = null;
        let customer_phoneNo = null;

        let html = null;
        let count = 0;
        let hmlforprint = null;
        let given_discount = null;
        let wholeamount = 0;

        $.ajax({
            url: base_url + 'Controllerunit/getorderdetails',
            method: "POST",
            data: {
                customer_id: customer_id,
                uniquekey: uniquekey
            },
            success: function (data) {
                let getData = JSON.parse(data);

                console.log(getData);
                if (getData.length == 0) {
                    $("#showalldetailstoorders").html('<span class="text text-danger">No order found</span>');
                    return false;
                }

                getData.map(d => {
                    count++;
                    totalamount = d.after_discount;
                    username = d.customer_name;
                    customer_phoneNo = d.customer_phoneNo;
                    uniquekey = d.unique_key;
                    wholeamount = (d.total_amount);
                    given_discount = (d.given_discount);
                    hmlforprint += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td>${d.sub_total}</td>

</tr>`;


                    html += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td><span class="badge badge-warning">${d.status}</span></td>
<td>
    <button class="btn btn-primary btn-sm accepthefood" currentQuantity="${d.currentQuantity}" quantity="${d.quantity}" products_id="${d.products_id}">Accept</button>
</td>

</tr>`;
                });
                html += `<tr>
<td colspan="5">
<b id="printofftotal">Total : Rs. ${totalamount}</b>
</td>
</tr>`;


                hmlforprint += `<tr>
                  <td colspan="3" align="right">Total
            <br/>
                 Discount :
<br/>
Discounted amount :
<br/>
                </td>

                  <td>
    Rs. ${wholeamount}
    <br/>
    ${given_discount}%
    <br/>

    Rs. ${getdiscountvalue(wholeamount,given_discount)}<br/>
    <hr/>
 </td>

    </tr>
<tr>
<td colspan="3" align="right">
<strong>Total value</strong>
</td>
<td>
<strong>Rs .${totalamount}</strong>
</td>
</tr>
`;



                $('#showalldetailstoorders').html(html);
                $("#ordercustomername").html(username);
                $("#customername").html(username);
                $('#customermobilenumber').html(customer_phoneNo);
                $('#customerphone').html(customer_phoneNo);
                $('#printsection').html(hmlforprint);
                $('#unique_key_gens').val(uniquekey);
                $('#billnumbershown').html(getbillnumber());
                datatosendMessage(1, totalamount, wholeamount, given_discount, getdiscountvalue(wholeamount, given_discount))
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });


    /*
    <button class="btn btn-outline-primary showofforderstodetails" customer_id="${d.customer_id}" uniquekey="${d.unique_key}">View orders</button>
    */

    $('body').delegate('.showofforderstodetails', 'click', function () {

        $('#orderedfoodsmodal').modal('show');
    });


    /*<button class="btn btn-outline-primary makependingorder" uniquekey="${d.unique_key}">Make pending</button>*/

    $('body').delegate('.makependingorder', 'click', function (e) {
        e.stopImmediatePropagation();
        let uniquekey = $(this).attr('uniquekey');

        $.ajax({
            url: base_url + 'Controllerunit/makependingorder',
            method: "POST",
            data: {
                uniquekey: uniquekey
            },
            success: function (data) {
                console.log(data);
                alert('Status has been Updated to pending');
                window.location.reload();
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });





    $('body').delegate('.accepthefood', 'click', function () {
        $(this).attr('disabled', true)
        $(this).text('updated');
        let currentQuantity = parseInt($(this).attr('currentQuantity'));
        let quantity = parseInt($(this).attr('quantity'));
        let products_id = parseInt($(this).attr('products_id'));

        let updatedquantity = currentQuantity - quantity;

        $.ajax({
            url: base_url + 'Controllerunit/updateproductquantity',
            method: "POST",
            data: {
                currentQuantity: currentQuantity,
                products_id: products_id,
                quantity: updatedquantity
            },
            success: function (data) {
                console.log(data);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    function updateInvoiceNumber(value) {
        let number = value;
        $.ajax({
            url: base_url + 'Controllerunit/updateInvoiceNumber',
            method: "POST",
            data: {
                number: number
            },
            success: function (data) {
                console.clear();
                console.log(data);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    }

    function getValueofInvoice() {
        let number = 0;
        let billnumber = 0;

        $.ajax({
            url: base_url + 'Controllerunit/getbillnumber',
            method: "POST",
            success: function (data) {
                let getData = JSON.parse(data);
                number = getData.map(d => d.asmaxid);
                number++;
                updateInvoiceNumber(number);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });
    }


    $("#acceptwholeorder").click(function () {
        getValueofInvoice();
        let unique_key_gen = $('#unique_key_gens').val();

        let customermobilenumber = parseInt($('#customermobilenumber').html());

        let message = sessionStorage.getItem('message');

        $.ajax({
            url: base_url + 'Controllerunit/acceptwholeorder',
            method: "POST",
            data: {
                unique_key_gen: unique_key_gen,
            },
            success: function (data) {

                alert('Successfully Order accepted');
                smsSender(customermobilenumber, message);
                smsSender(750550660, message);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });





    $("#placedprintbtn").click(() => {


        var printContents = $('#placedprinttext').html();
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    });



    function printall(divname) {
        var divName = divname;

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }



    $('body').delegate('.seeplacedorders', 'click', function () {
        $('#placedorders').modal('show');

        let customer_id = parseInt($(this).attr('customer_id'));
        let uniquekey = $(this).attr('uniquekey');
        let totalamount = 0;

        let username = null;
        let customer_phoneNo = null;

        let html = null;
        let count = 0;
        let hmlforprints = null;

        $.ajax({
            url: base_url + 'Controllerunit/getorderdetails',
            method: "POST",
            data: {
                customer_id: customer_id,
                uniquekey: uniquekey
            },
            success: function (data) {
                let getData = JSON.parse(data);

                if (getData.length == 0) {
                    $("#showalldetailstoorders").html('<span class="text text-danger">No order found</span>');
                    return false;
                }

                getData.map(d => {
                    count++;
                    totalamount = d.after_discount;
                    username = d.customer_name;
                    customer_phoneNo = d.customer_phoneNo;
                    uniquekey = d.unique_key;
                    hmlforprints += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td>${d.sub_total}</td>
 </tr>`;

                    html += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td><span class="badge badge-success">${d.status}</span></td>
<td>
    <button class="btn btn-primary btn-sm accepthefood"  currentQuantity="${d.currentQuantity}" quantity="${d.quantity}" products_id="${d.products_id}" disabled>Accept</button>
</td>

</tr>`;
                });
                html += `<tr>
<td colspan="5">
<b>Total : Rs. ${totalamount}</b>
</td>
</tr>`;

                hmlforprints += `<tr>
                  <td colspan="3" align="right">Total</td>

                  <td>Rs. ${totalamount}</td>

                  </tr>`;

                $('#placedshowalldetailstoorders').html(html);
                $("#placeordercustomername").html(username);
                $('#customermobilenumber').html(customer_phoneNo);
                $('#placedcustomermobilenumber').html(customer_phoneNo);
                $('#printsections').html(hmlforprints);
                $('#unique_key_gens').val(uniquekey);
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });

    });


    $("#searchallcompleted").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#completedorderdetails tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#searchorderedfoods").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showoffcustomersforrorder tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#smssendform").submit(function (e) {
        e.preventDefault();
        $('#sendMessagebtn').html('Sending......');
        let smssenderName = $('#smssenderName').val();
        let smssenderTel = parseInt($("#smssenderTel").val());
        let sendMessage = $("#sendMessage").val();

        if (smssenderTel == "") {
            alert('Please type Mobile number');
            $('#smssenderTel').css('border', '2px solid red');
            return false;
        }
        if (sendMessage == "") {
            alert('Pelase type message');
            $('#sendMessage').css('border', '2px solid red');
            return false;
        }

        smsSender(smssenderTel, sendMessage);


    });



    $('body').delegate('.printbtn', 'click', function () {


        var today = new Date();

        var date = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();
        let fulltime = new Date().toLocaleTimeString();
        $('#todaydate').html(date);
        $('#printedtime').html(fulltime);
        let customer_id = parseInt($(this).attr('customer_id'));
        let uniquekey = $(this).attr('uniquekey');
        let totalamount = 0;

        let username = null;
        let customer_phoneNo = null;

        let html = null;
        let count = 0;
        let hmlforprint = null;
        let given_discount = null;
        let wholeamount = 0;

        $.ajax({
            url: base_url + 'Controllerunit/getorderdetails',
            method: "POST",
            data: {
                customer_id: customer_id,
                uniquekey: uniquekey
            },
            success: function (data) {
                let getData = JSON.parse(data);

                console.log(getData);
                if (getData.length == 0) {
                    $("#showalldetailstoorders").html('<span class="text text-danger">No order found</span>');
                    return false;
                }

                getData.map(d => {
                    count++;
                    totalamount = d.after_discount;
                    username = d.customer_name;
                    customer_phoneNo = d.customer_phoneNo;
                    uniquekey = d.unique_key;
                    wholeamount = (d.total_amount);
                    given_discount = (d.given_discount);
                    hmlforprint += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td>${d.sub_total}</td>

</tr>`;


                    html += `<tr>
<td>${count}</td>
<td>${d.product_name}</td>
<td>${d.quantity}</td>
<td><span class="badge badge-warning">${d.status}</span></td>
<td>
    <button class="btn btn-primary btn-sm accepthefood" currentQuantity="${d.currentQuantity}" quantity="${d.quantity}" products_id="${d.products_id}">Accept</button>
</td>

</tr>`;
                });
                html += `<tr>
<td colspan="5">
<b>Total : Rs. ${totalamount}</b>
</td>
</tr>`;


                hmlforprint += `<tr>
                  <td colspan="3" align="right">Total
            <br/>
                 Discount :
<br/>
Discounted amount :
<br/>
                </td>

                  <td>
    Rs. ${wholeamount}
    <br/>
    ${given_discount}%
    <br/>

    Rs. ${getdiscountvalue(wholeamount,given_discount)}<br/>
    <hr/>
 </td>

    </tr>
<tr>
<td colspan="3" align="right">
<strong>Total value</strong>
</td>
<td>
<strong>Rs .${totalamount}</strong>
</td>
</tr>
`;



                $('#showalldetailstoorders').html(html);
                $("#ordercustomername").html(username);
                $("#customername").html(username);
                $('#customermobilenumber').html(customer_phoneNo);
                $('#customerphone').html(customer_phoneNo);
                $('#printsection').html(hmlforprint);
                $('#unique_key_gens').val(uniquekey);
                $('#billnumbershown').html(getbillnumber());

                var printContents = $('#printtext').html();
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


    });


    $('#frmsmsGroup').submit(function(e){
        e.preventDefault();

        let groupName = $('#groupName').val();

        if(groupName==""){
            alert('Group name required');
            $("#groupName").focus();
            return false;
        }

         $.ajax({
            url: base_url + 'Controllerunit/savegroupName',
            method: "POST",
            data: {
                groupName: groupName,
            },
            success: function (data) {
                alert(data);

            },
            error: function (err) {
                console.error('Error found', err);
            }
        });


     });


    $('#addsmssendertogroup').click(function(e){
        e.preventDefault();
        alert('It works');
    });









}); //End of script
