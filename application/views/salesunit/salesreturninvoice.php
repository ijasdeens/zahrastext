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
     <img src="<?php echo base_url()?>assets/logoimage/<?php echo $this->session->logo?>" alt="LOGO" class="img-fluid" style="min-width:100%;max-height:100%;"> <br>
      <b><?php echo $this->session->outlets_name?></b>
      </div>
      <div class="info">

        <h2></h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2><br>
        <h2>RETURNED PRODUCTS BILL </h2>
        <p>
            Address :    <?= $this->session->address?><br/>
              Phone   : <?php echo $this->session->outlet_mobile?> <br/>
               Cashier : <?php echo $this->session->staffname;?> <br>
               <br>


        </p>

           <p id="date_time"></p> <br>
           <p>Invoice : <?php echo $invoice_id?></p>
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

                    <div id="table">
                        <table style="text-align:center">
                          <thead>
                                <tr class="tabletitle">
                                <td class="item"><h2>ITEM</h2></td>
                                <td class="Hours"><h2>QTY</h2></td>
                                <td class="Rate"><h2>Price</h2></td>
                                <td class="rate"><h2>AMOUNT</h2></td>
                            </tr>
                          </thead>
                           <?php
                            $numberofItems = 0;
                            $numberofpcs = 0;
                            $totalsubtotal = 0;
                            ?>

                       <tbody>


                            <?php foreach($this->cart->contents() as $items):?>
                            <?php ++$numberofItems?>
                            <tr class="service">

                                <td class="tableitem">
                       <p class="itemtext"><?php echo $items['name']?>   <br>
                      <small><?php echo $items['product_code']?></small></p>


                </td>

                             <td class="tableitem">
                       <p class="itemtext"><?php echo $items['qty']?> </p>
                            <?php
                                 $numberofpcs+=(int)$items['qty'];

                                 ?>
                             </td>

                             <td class="tableitem">
                       <p class="itemtext"><?php echo $this->cart->format_number($items['price'])?> </p>

                             </td>

                 <td class="tableitem">
                       <p class="itemtext"><?php echo $this->cart->format_number($items['subtotal'])?> </p>
                                <?php
                     $totalsubtotal+=floatval($items['subtotal'])
                     ?>

                             </td>

                            </tr>

                             <?php endforeach;?>
                       </tbody>

                            <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;">SUB TOTAL</td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id=""><?php echo number_format($totalsubtotal,2)?></h2></td>

                            </tr>


                            <hr>
                           </tr>

                                 <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;"></td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="given_cash_amounts"></td>
                            </tr>

                               <tr class="tabletitle tablebottomsection">
                                <td style="font-size:12px;">No of Pcs : <?php echo $numberofpcs;?></td>
                                <td></td>
                                <td></td>
                                <td class="payment"><h2 id="">No of Items : <?php echo $numberofItems;?></td>
                            </tr>


                        </table>
                    </div><!--End Table-->


                    </div>
                    <div class="my-4">
                    <span style="font-size:12px; font-weight: bold;">  POS System delivered by CodeAccelerator - 0758953142</span>
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
