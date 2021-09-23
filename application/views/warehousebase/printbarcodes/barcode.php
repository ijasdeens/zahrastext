<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="window.print();">
	<div style="margin-left: 5%">
		<?php
		//include 'barcode128.php';
		$product = 'Ancrhor';
		$product_id = 5645646;
		$rate =23423423;

		for($i=1;$i<=5;$i++){
			echo "<p class='inline'><span ><b>Item: $product</b></span>".bar128(stripcslashes(34324))."<span ><b>Price: ".$rate." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>