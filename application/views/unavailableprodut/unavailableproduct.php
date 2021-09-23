<script src="<?php echo base_url()?>assets/warehosueaddproduct.js"></script>

<div class="main-panel">
	<div class="content-wrapper">
		<div class="row purchace-popup">

			<div class="col-md-12 my-12">
				<div class="table table-responsive">
					<table class="table table-dark">
						<thead>
							<tr class="text text-center">
								<th class="text text-center">Product name</th>
								<th>Product code</th>
								<th>Current quantity</th>
								<th>Picture</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody id="showProducts">
					 	
							<?php if($products=="0"):?>
							<tr>
								<td class="text text-danger">No data found</td>
							</tr>
							<?php else:?>
							<?php foreach($products as $product):?>
							<?php
							if($product->quantity <=$product->alert_quantity):
							 
							?>
								<tr class="text text-center">
									<td>
										<?php echo $product->product_name?>
									</td>
									<td>
										<?php echo $product->products_code?>
									</td>
									<td>
										<?php echo $product->quantity?>
									</td>
									<td>
										<?php if(substr($product->product_pic,0,4)=="http"):?>
										  <img src="<?php echo $product->product_pic?>" class="img-fluid">
											  <?php else:?>
											  <img src="<?php echo base_url()?>assets/img/uploaded_photos/<?php echo $product->product_pic?>" class="img-fluid">
											  <?php endif;?>
										
									</td>
									<td>
										<button class="btn btn-danger btn-sm removeproductsall" products_id="<?=$product->products_id?>">Remove</button>
										<button class="btn btn-info btn-sm refillupdateproducts" products_id="<?=$product->products_id?>" currentqty="<?php echo $product->quantity?>">Refill <i class="icon-reload"></i></button>
									</td>
								</tr>
								 
								
								<?php endif;?>
								
								<?php endforeach;?>
							
								<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>


		</div>

	</div>
	<input type="hidden" id="current_qty_for_refill">
	<div class="modal fade" id="fill_modal">
		<div class="modal-dialog">
			<div class="modal-content bg-dark text-white">
					<div class="modal-header">
				<h4>Refill quantity</h4>
			</div>
			<div class="modal-body">
				<form method="POST" id="frmrefill">
					<div class="form-group">
						<label for="refillquantity">Refill quantity</label>
						<input type="tel" class="form-control" id="refill_quantity" required>

					</div>
					<div class="form-group">
						<input type="submit" class="form-control btn btn-outline-warning btn-block form-control" value="REFILL">
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>