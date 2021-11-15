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
  font-size: 11px;
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
  min-height: 0px !important;
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
  font-size: 11px;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: 11px;
}
#invoice-POS #legalcopy {
  margin-top: 1mm;
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
           <span id="date_time" style="font-weight:bold"></span> <br/>
                
           <?php
           $myinvoiceid = (int)$invoice_id_no; 
           
             
           ?>
         
            <span style="font-weight:bold">Invoice ID : <?php echo $myinvoiceid?></span><br>
            <span style="font-weight:bold">Note : <?php echo $addtional_information;?></span>

        </p>

          
      </div>
    </div><!--End Invoice Mid-->
    <span>------------------------------------------------</span>
    <div id="bot">

                    <div id="table">
                        <table style="text-align:center" id='maintablesectionforproducts'>
                          <thead>
                                <tr class="tabletitle">
                                <td class="item"><h4>ITEM</h4></td>
                                <td class="Hours"><h4>QTY</h4></td>
                                <td class="Rate"><h4>Price</h4></td>
                                <td class="Hours"><h4>Dis amount</h4></td>
                                 <td class="rate"><h4>AMOUNT</h4></td>
                            </tr>
                          </thead>
                           <?php
                            $numberofItems = 0;
                            $numberofpcs = 0;

                            $priceforactual = 0.00; 
                            $priceforchange = 0.00;
                            $priceforanswer = 0; 


                            $totalamountofsection = 0.00; 
                            

                            ?>

                           <tbody id="product_details_to_display_forinvoice">
                               
                                  <?php foreach($boughproducts as $product):?>
                                <?php
                                 $priceforactual+=floatval($product->actual_price) * $product->choosen_quantity;
                                 $priceforchange+=floatval($product->sub_total) * $product->choosen_quantity; 
                                 
                               ++$numberofItems;
                               $numberofpcs+=floatval($product->choosen_quantity);
                               ?>
                                <tr class="service" style="font-weight:bold">
                <td class="tableitem" style="font-weight:bold">
                       <p class="itemtext" style="font-weight:bold"><?php echo $product->product_name?>   <br>
                      <small style="font-weight:bold"><?php echo $product->product_code_no?></small></p>


                </td>
                <?php

                $getactualprice = ($product->actual_price - $product->sub_total) * $product->choosen_quantity; 
                $totalamountofsection+=floatval($getactualprice); 
                ?>
                 <td class="tableitem"><p class="itemtext" style="font-weight:bold"><?php echo $product->choosen_quantity?></p></td>
                <td class="tableitem"><p class="itemtext" style="font-weight:bold">
                <?php echo number_format($product->actual_price,2)?> <br>
                <?php echo number_format($product->sub_total,2);?></p>
              
              </td>
                <td class="tableitem"><p class="itemtext" style="font-weight:bold"><?php echo number_format($getactualprice,2)?></p></td>

                <td class="tableitem"><p class="itemtext"><?php echo number_format($totalamountofsection,2);?></p></td>
            </tr>
                                <?php endforeach;?>
 
                           </tbody>
                                  <!--
                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:9px;font-weight:bold">SUB TOTAL</td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="display_sub_total_print"></h2></td>

                            </tr>
                               <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Discount</td>

                              <td colspan="2"><h2 id="discount_percentage">*/</h2></td>
                                <td class="payment"><h2> /h2></td>
                            </tr>
                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Dis amount from total</td>

                              <td colspan="2"><h2 id="discount_from_total"></h2></td>
                                <td class="payment"><h2>Rs.  </td>
                            </tr>
                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Individual Dis amount</td>

                              <td colspan="2"><h2 id="discount_from_total"></h2></td>
                                <td class="payment"><h2>Rs.</td>
                            </tr>

                                <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">Sub total</td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="given_cash_amounts"> </h2></td>
                            </tr>
                            
                           </tr>
                                <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;font-weight:bold">No of Pcs  </td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="given_cash_amounts">No of Items :  </h2></td>
                            </tr>
-->

                        </table>
                        <?php
                        $mynumberformataccount = floatval($this->session->subtractedamountfromtotal); 
                        ?>
                        <p style="float:right">
                                  <span style="font-size:11px;font-weight:bold">Sub total :</span> 
                                  <span style="font-size:11px; font-weight:bold"><?php echo $before_discount_sub_total?></span>
                                  <br>
                                  <span style="font-size:11px; font-weight:bold">Discount : </span>
                            <span style="font-size:11px; font-weight:bold">%<?php echo $discount?></span>
                                  <br>
                                  <span style="font-size:11px; font-weight:bold">Dis amount from total : </span>
                                  <span style="font-size:11px; font-weight:bold"><?php echo $discountedamount?></span>
                                  <br>
                                  <span style="font-size:11px; font-weight:bold">Individual Dis amount : </span>
                                  <span style="font-size:11px; font-weight:bold">
                                <?php
                                echo $individual_discountamount; 
                                ?>
                                </span><br>
                                <span style="font-size:11px; font-weight:bold">Sub total :</span>
                                <span style="font-size:11px; font-weight:bold"><?php echo floatval(number_format($before_discount_sub_total,2))?></span>

                          </div>
                         
                         <?php
                         $recievedamount = floatval($recieved_amount_fromcus); 
                         $mainbalancesystem = floatval($balance_amount_from_cus); 
                         ?>
                                 
                        <center>
                          <p style="font-weight:bold; font-size:11px;">Given amount : Rs.<?php echo number_format($recievedamount,2)?>
                        <br>
                        Balance payment : Rs.<?php echo number_format($mainbalancesystem,2)?>
                      <br>

                      </p>
                      
                           
                        </center>
                        
                    </div><!--End Table-->

                     


                    </div>
                    <p>------------------------------------------------</p>

                    
                    <div class="">
                      <p style="font-weight:bold; font-size:11px;">Please bring your bill while coming to return your products. <br>Exchange is only acceptable by 7 Days
                    <br>
                    Thank you for purchasing <br>
                    <span>---------------------------------------------------------------------</span>

                    POS System delivered by CodeAccelerator - 075-89 53 142
                    </p> 
                     </div>
                  
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
                    //         $.ajax({
                    //     url: $('#base_url').val() + 'Controllerunit/deletesessionforcarts',
                    //     method: 'POST',
                    //     success: function (data) {

                    //     },
                    //     error: function (err) {
                    //         console.error('Error found', err);
                    //     }
                    // });

}); 
</script>

    <script>

  var d = new Date();
  var n = d.toLocaleString();

  document.getElementById("date_time").innerHTML = n;


    </script>





</body>
</html>
