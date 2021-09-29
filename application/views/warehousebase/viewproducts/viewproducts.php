<script src="<?php echo base_url()?>assets/warehosueaddproduct.js"></script>
 
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row purchace-popup">
		  <div class="my-3">
			  Total products : <?php echo $product_details==0 ? 0 : count($product_details)?> <br>
			  <span class='text text-danger font-weight-bold'>NOTE : Be advised that If you delete a product from warehouse, it will automatically be deleted from all outlets. </span>
		  </div>
		 
			<div class="col-md-12 my-12">
			<div class="float-right">
			  <button class='btn btn-primary btn-sm' id='productsexporttoexcel'> <i class="fa fa-file-excel-o"></i> Export to excel</button>
		  </div>
		  <br>
		  <br>
				<input type="text" class="form-control" placeholder="Search..." id="search_product">
				<div class="table table-responsive">
					<table class="table table-dark" id='product_details_toexporthtml'>
						<thead>
							<tr>
							<th class="text text-center">Product name</th>
								<th class="text text-center">Product code</th>
								<th class="text text-center">Brands</th>
								<th class="text text-center">Main category</th>
								<th class="text text-center">Sub category</th>
								<th class="text text-center">MFD</th>
								<th class="text text-center">EXP</th>
								<th class="text text-center">Product cost</th>
								<th class="text text-center">Product price</th>
								<th class='text text-center'>Additional amount</th>
								<th class="text text-center">Quantity</th>
								<th class='text text-center'>Static quantity</th>
								<th class="text text-center">Alert quantity</th>
								<th class="text text-center">Product Pic</th>
								<th class="text text-center">Product Unit</th>
								<th class="text text-center">Product description</th>
								<th class="text text-center">BATCH NO</th>
								<th class="text text-center">INVOICE NO</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody id="showOffAvailableProducts">
							<?php if($product_details=="0"):?>
								<tr>
									<td><span class="text text-danger">No data found</span></td>
								</tr>
							<?php else:?>
							 <?php foreach($product_details as $row):?>
								<tr class="text text-center">
									<td><?php echo $row->product_name?></td>
									<td><?php echo $row->products_code?></td>
									<td><?php echo $row->brands_name?></td>
									<td><?php echo $row->categoris_name?></td>
									<td><?php echo $row->sub_cat_id?></td>
									<td><?php echo $row->mfd?></td>
									<td><?php echo $row->exp?></td>
									<td><?php echo $row->product_cost?></td>
									<td><?php echo $row->product_price?></td>
									<td><?php echo $row->additional_amount?></td>
									<td><?php echo $row->quantity?></td>
									<td><?php echo $row->static_count_fromsupplier?></td>
									<td><?php echo $row->alert_quantity?></td>
									<td>
								 		 <?php if(substr($row->product_pic,0,4)=="http"):?>
								 		  <img src="<?php echo $row->product_pic?>" alt="Pictures" class="imageopen">
								 		 <?php else:?>
								 		  <img src="<?php echo base_url()?>assets/img/uploaded_photos/<?php echo $row->product_pic?>" alt="Pictures" class="imageopen">
								 		 <?php endif;?>
									 
									</td>
									<td>
										 <?php echo $row->product_unit?>	
 									</td>
									<td>
									 <?php echo $row->product_desc?>	
									</td>
									<td>
										<?php echo $row->batch_no?>	
									</td>
									<td>
										<?php echo $row->invoice_no?>	
									</td>
									
									
									<td>
										<div class="btn-group">
                              <button type="button" class="btn btn-primary btn-rounded btn-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
                              <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -2px, 0px);">
                                <a class="dropdown-item deleteproduct" products_id="<?php echo $row->products_id?>">Delete</a>
                                <a class="dropdown-item assign_outlets" products_id="<?php echo $row->products_id?>" current_quantity="<?php echo $row->quantity?>" data-toggle="modal" data-target="#assign_outlets_modal">Assign to outlets</a>
                                <a class='dropdown-item refille_outlets' id='<?php echo $row->products_id?>'>Refill +</a>
								<a class='dropdown-item subtract_products'   id='<?php echo $row->products_id?>' current_quantity="<?php echo $row->quantity?>">Subtract products -</a>
                              </div>
                            </div>
									</td>
								</tr>
							 <?php endforeach;?>	
							<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>


		</div>
		
	
     <div class="modal fade" id="assign_outlets_modal">
     	<div class="modal-dialog">
     		<div class="modal-content bg-dark text-white">
     			<div class="modal-header">
     				 <span class="text text-danger">ASSIGN OUTLETS</span>	
     			</div>
     			<div class="modal-body">
     				<div class="form-group">
 	 				<label>Outlets Name</label>
      				<select id="outlet_name" class="form-control">
      			 	<?php if($outlets_details=="0"):?>
      					<option class="text text-danger">--No data found--</option>
    				<?php else:?>
    				   <?php foreach($outlets_details as $row):?>
    				   <option value="<?=$row->outlets_id?>"><?php echo $row->outlets_name?></option>
    				   <?php endforeach;?>
    				<?php endif;?> 				
     			
      				</select>
      				</div>
      				<div class="form-group">
      					<label>Quantity</label>
      					<input type="text" class="form-control" id="out_let_qty">
      				</div> 
      				<div class="form-group">
      				 <button class="btn btn-outline-primary form-control" id="transfer_to_outlet">Transfer</button>
      				</div>
     			</div> 
     			
     		<input type="hidden" id="current_quantity_for_outlet">
     		<input type="hidden" id="hidden_product_id">