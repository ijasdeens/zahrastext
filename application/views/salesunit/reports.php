<!DOCTYPE html>
<html>
<head>

    <script src="<?php echo base_url()?>assets_ss/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets_ss/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets_ss/js/OverlayScrollbars.js" type="text/javascript"></script>




    <title></title>


<style type="text/css">



#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1rem;
  color: #000;
}
#invoice-POS h2 {
  font-size: 0.75rem;
  text-align: center;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS td:not(:first-child) {
  text-align: center;
}
#invoice-POS p {
  font-size: 1rem;
  color: #000;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
  background-size: 60px 60px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: 0.5em;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 0.75rem;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

    .tablebottomsection{
        margin-top: -20px;
    }

    .details{
      margin-top:5px;
    }

</style>



</head>
<body onload="window.print()">


  <input type="hidden" id="base_url" value="<?php echo base_url()?>">
   <div id="invoice-POS">

    <center id="top">
      <div style="">
      <b></b>
      </div>
      <div class="info">

        <h2></h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
      <div class="info">
        <h2>Sales summery</h2>
        <p>
            Address :    <?= $this->session->address?><br/>
              Phone   : <?php echo $this->session->outlet_mobile?> <br/>
               Cashier : <?php echo $this->session->staffname;?> <br>
               Outlet name : <?php echo $this->session->outlets_name?> <br/>
               <br>

        </p>

           <p id="date_time"></p><br>
           
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

                    <div id="table">
                       <div class='details'>
                         <div class="p-2">
                           Cash IN hand :     Rs.<?php echo number_format($cash_in_hand,2)?>
                         </div>
                          
                        
                         <div class='details'>
                         <div class="p-2">
                           Cash payment :    Rs. <?php echo number_format($cash_payment,2)?>
                         </div>
                         <div class='details'>
                         <div class="p-2">
                         Credit payment :    Rs. <?php echo number_format($credit_payment,2)?>
                         </div>
                         <div class='details'>
                         <div class="p-2">
                         Cheque payment :    Rs. <?php echo number_format($cheque_payment,2)?>
                         </div>

                         <div class='details'>
                         <div class="p-2">
                         Refunded amount :    Rs. <?php echo number_format($refunded_amount,2)?>
                         </div>
                      
                      
                      


                       </div>
                    </div><!--End Table-->


                    </div>
                    <br>
                    <div class="my-4">
                     <center>Sales summery</center>
                    </div>
                    <hr/>
                  <span style="font-size:12px; font-weight: bold;">  POS System delivered by CodeAccelerator - 0758953142</span>
                </div><!--End InvoiceBot-->
  </div>
  <!--End Invoice-->


<script>
    setTimeout(function(){

 //window.close();


    },1000)
    </script>
 

    <script>

  var d = new Date();
  var n = d.toLocaleString();

  document.getElementById("date_time").innerHTML = n;


    </script>





</body>
</html>
