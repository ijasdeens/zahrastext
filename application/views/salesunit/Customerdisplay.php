<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">

    <style>
    /* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{

height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
    </style>

</head>
<body>
<div class="">
<input type="hidden" id="base_url" value="<?php echo base_url()?>">
 <div style="background-color:rgb(82, 168, 231);min-width:100%;height:70px;color:white;">
<center><h1 class="py-3">Welcome again</h1></center>
 </div>
 <hr>
<div>
    <div class="row">
        <div class="col-md-2">
            <div id="first_ads">
                <?php if($first_ads!=''):?>
                <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $first_ads?>" alt="First ads" style="" class="img-fluid">
                <?php endif;?>
            </div>

            <br>
             <div id="second_ads">
                <?php if($seconds_ads!=''):?>
                   <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $seconds_ads?>" alt="second ads" style="" class="img-fluid">

                <?php endif;?>
             </div>
        </div>

        <div class="col">
          <div id="customer_display_acc">

          </div>
          <br>
          <div class="my-3">
              <div class="table table-responsive">
                <table class="table table-border">
                    <thead>
                        <tr class="text text-center">
                            <th>Product Name</th>
                            <th>SIZE</th>
                            <th>QTY</th>
                            <th>Price</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody id="product_details">
                        <tr class="text text-center">
                            <td>1</td>
                            <td>SIZE</td>
                            <td>400</td>
                            <td>500</td>
                        </tr>
                           <tr class="text text-center">
                            <td>1</td>
                            <td>SIZE</td>
                            <td>400</td>
                            <td>500</td>

                        </tr>
                            <tr class="text text-center">
                            <td>1</td>
                            <td>SIZE</td>
                            <td>400</td>
                            <td>500</td>
                        </tr>

                    </tbody>
                </table>
              </div>
          </div>
        </div>

        <div class="col-md-2">
            <div class="third_ads">
                <?php if($third_ads!=''):?>
      <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $third_ads?>" alt="Third ads" style="" class="img-fluid">
                <?php endif;?>
            </div>
            <br>
            <br>
            <div class="fourth_ads">
               <?php if($fourth_ads!=''):?>
              <img src="<?php echo base_url()?>assets/customerdisplayads/<?php echo $fourth_ads?>" alt="Fourth ads" style="" class="img-fluid">
               <?php endif;?>

            </div>
        </div>
    </div>
</div>
</div>


    <script src="<?php echo base_url()?>assets/customerdisplay.js" type="text/javascript"></script>
</body>
</html>
