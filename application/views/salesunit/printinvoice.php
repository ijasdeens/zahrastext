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

</style>



</head>
<body onload="window.print()">


  <input type="hidden" id="base_url" value="<?php echo base_url()?>">
   <div id="invoice-POS">

    <center id="top">
      <div style="margin-top:10px;">
     <img src="<?php echo base_url()?>assets/logoimage/<?php echo $this->session->logo?>" alt="LOGO" class="img-fluid" style="min-width:100%;min-height:100%;"> <br>
      <b><?php echo $this->session->outlets_name?></b>
      </div>
      <div class="info">

        <h2></h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p style="font-weight:bold">
            Address :    <?= $this->session->address?><br/>
              Phone   : <?php echo $this->session->outlet_mobile?> <br/>
               Cashier : <?php echo $this->session->staffname;?> <br>
                

        </p>

           <p id="date_time" style="font-weight:bold"></p> 
           <?php
           $myinvoiceid = (int)$invoice_id; 
             
           ?>
         
            <p style="font-weight:bold">Invoice ID : <?php echo --$myinvoiceid?></p>
            <p style="font-weight:bold">Note : <?php echo $this->session->addtional_information;?></p>
      </div>
    </div><!--End Invoice Mid-->
    <span>------------------------------------------</span>
    <div id="bot">

                    <div id="table">
                        <table style="text-align:center">
                          <thead>
                                <tr class="tabletitle">
                                <td class="item"><h2>ITEM</h2></td>
                                <td class="Hours"><h2>QTY</h2></td>
                                <td class="Rate"><h2>Price</h2></td>
                                <td class="Hours"><h2>Dis amount</h2></td>
                                 <td class="rate"><h2>AMOUNT</h2></td>
                            </tr>
                          </thead>
                           <?php
                            $numberofItems = 0;
                            $numberofpcs = 0;

                            $priceforactual = 0.00; 
                            $priceforchange = 0.00;
                            $priceforanswer = 0; 
                            

                            ?>

                           <tbody id="product_details_to_display_forinvoice">
                                <?php foreach($this->cart->contents() as $items):?>
                                <?php
                                 $priceforactual+=floatval($items['actual_price']) * $items['qty'];
                                 $priceforchange+=floatval($items['price']) * $items['qty']; 
                                 
                               ++$numberofItems;
                               $numberofpcs+=floatval($items['qty']);
                               ?>
                                <tr class="service" style="font-weight:bold">
                <td class="tableitem" style="font-weight:bold">
                       <p class="itemtext" style="font-weight:bold"><?php echo $items['name']?>   <br>
                      <small style="font-weight:bold"><?php echo $items['product_code']?></small></p>


                </td>
                <?php

                $getactualprice = ($items['actual_price'] - $items['price']) * $items['qty']; 
                ?>
                 <td class="tableitem"><p class="itemtext" style="font-weight:bold"><?php echo $items['qty']?></p></td>
                <td class="tableitem"><p class="itemtext" style="font-weight:bold">
                <?php echo $this->cart->format_number($items['actual_price'])?> <br>
                <?php echo $this->cart->format_number($items['price']);?></p>
              
              </td>
                <td class="tableitem"><p class="itemtext" style="font-weight:bold"><?php echo number_format($getactualprice,2)?></p></td>

                <td class="tableitem"><p class="itemtext"><?php echo $this->cart->format_number($items['subtotal']);?></p></td>
            </tr>
                                <?php endforeach;?>
 
                           </tbody>

                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">SUB TOTAL</td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="display_sub_total_print"><?php echo $before_discount_sub_total?></h2></td>

                            </tr>
                               <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Discount</td>

                              <td colspan="2"><h2 id="discount_percentage"><?php echo $discount_percentage?></h2></td>
                                <td class="payment"><h2><?php echo  $discount_amount?></h2></td>
                            </tr>
                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Dis amount from total</td>

                              <td colspan="2"><h2 id="discount_from_total"></h2></td>
                                <td class="payment"><h2>Rs. <?php echo number_format($this->session->subtractedamountfromtotal,2)?></td>
                            </tr>
                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Individual Dis amount</td>

                              <td colspan="2"><h2 id="discount_from_total"></h2></td>
                                <td class="payment"><h2>Rs. <?php 
                                $answer = ($priceforactual - $priceforchange);
                                echo number_format($answer,2); 
                                ?></td>
                            </tr>

                                <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Sub total</td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="given_cash_amounts"><?php echo substr($paying_amount,4)?></h2></td>
                            </tr>
                            
                           </tr>
                                <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">No of Pcs <?php echo $numberofpcs?></td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="given_cash_amounts">No of Items : <?php echo $numberofItems?></h2></td>
                            </tr>


                        </table>
                        <center>
                          <p style="font-weight:bold; font-size:15px;">Given amount : Rs.<?php echo $this->session->recieved_amount==null ? 0. : number_format($this->session->recieved_amount,2)?></p>
                          <p style="font-weight:bold;font-size:15px;">Balance payment : Rs.<?php echo $this->session->mainbalance==null ? 0. : number_format($this->session->mainbalance,2)?></p>
                        </center>
                    </div><!--End Table-->
                    <span>------------------------------------------</span>


                    </div>
                    
                    <div class="my-4">
                    
                      <p style="font-weight:bold">Please bring your bill while coming to return your products.</p> 
                      <p style="font-weight:bold">Exchange is only acceptable by 7 days</p>
                      <p style="font-weight:bold">Thank you for purcahsing.</p>
                    </div>
                    <span>--------------------------------------------</span>
                    
                  <span style="font-size:12px; font-weight: bold;">  POS System delivered by CodeAccelerator - 075-89 53 142</span>
                </div><!--End InvoiceBot-->
  </div>
  <!--End Invoice-->


<script>
    setTimeout(function(){

 //window.close();


    },1000)
    </script>

    <script>
$(document).ready(function(){
                            $.ajax({
                        url: $('#base_url').val() + 'Controllerunit/deletesessionforcarts',
                        method: 'POST',
                        success: function (data) {

                        },
                        error: function (err) {
                            console.error('Error found', err);
                        }
                    });

});
</script>

    <script>

  var d = new Date();
  var n = d.toLocaleString();

  document.getElementById("date_time").innerHTML = n;


    </script>





</body>
</html>
