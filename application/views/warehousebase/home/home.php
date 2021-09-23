<script src="<?php echo base_url()?>assets/warehosueaddproduct.js"></script>
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row purchace-popup">

			<div class="col-md-12 my-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">ADD PRODUCT DETAILS</h4>
						
						<form method="POST" id="saveupperbatch">
							 <div class="row">
								 
							  <div class="col">
							  	<div class="form-group">
										<label>Supplier name</label>
										 
							 				<select id="supplier_for_product" class="form-control" required>
							 				<?php if($Suppliers=="0"):?>
							 				<option value="">--No supplier found--</option>
							 				<?php else:?>
												<?php foreach($Suppliers as $supply):?>
												<option value="<?php echo $supply->supplier_id?>">
													<?php echo $supply->supplier_name?>/<?php echo $supply->org_name?>
												</option>
												<?php endforeach;?>							 				
							 				<?php endif;?>
							 				</select>
										 
									</div>
							  </div>
							  <div class="col">
								  <label for="warehouse_details">Select warehouse</label>
								  
								  <select id="warehouse_details_for_selecting" class="form-control" required>
							 				<?php if($warehousedetails=="0"):?>
							 				<option value="">--No Warehouse found--</option>
							 				<?php else:?>
												<option value="">--Select warehouse--</option>
												<?php foreach($warehousedetails as $supply):?>
												<option value="<?php echo $supply->warehouse_id?>">
													<?php echo $supply->warehouse_name?>/<?php echo $supply->warehouse_address?>
												</option>
												<?php endforeach;?>							 				
							 				<?php endif;?>
							 				</select>
								 	
							  </div>
							  <div class="col">
							  	<div class="form-group">
							  		<label for="batchno">Batch NO</label>
							  	 <input type="text" class="form-control" id="batchNo" maxlength="480">
							  	</div>
							  </div>
							  
							    <div class="col">
							  	<div class="form-group">
							  		<label for="invoiceId">Invoice ID</label>
							  	 <input type="text" class="form-control" id="invoiceId" readonly>
							  	</div>
							  </div>  
							   <div class="col">
							  	<div class="form-group">
							  		<label for="invoiceId">Supplier invoice</label>
							  	 <input type="text" class="form-control" id="Invoice_manual">
							  	</div>
							  </div> 
							  
							    <div class="col">
							  	<div class="form-group my-4">
							  		 <input type="submit" class="form-control btn btn-info" value="RESET">
							  	</div>
							  </div>
							  
							 </div>
						</form>					
						<hr>
						<form class="form-sample" id="addProductdetails">
							<div class="row">
						
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Products Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="productsName" placeholder="Ex : Anchor" required>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product code</label>
										<div class="col-sm-9">
											 <div class='ml-auto'>
												 <button class='btn btn-link' id='search_bybarcodesection'><u>Search</u></button>
											 </div>
											<input type="text" class="form-control" id="product_code" placeholder="Ex :236854" required>
											<button class="btn btn-sm btn-outline-primary btn-block" id="generateproductcodebtn">Generate code</button>
											<span class="text text-danger" id="product_code_error"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Brand</label>
										<div class="col-sm-9">

											<select class="form-control" id="brands_name" required>
                                <option>--Select brand--</option> 
 							    <?php if($brands!="0"):?>
                                <?php foreach($brands as $brand) : ?>
                                 <option value="<?php echo $brand->brands_id?>"><?php echo $brand->brands_name?></option>
                                 <?php endforeach;?>
                                 <?php else:?>
 								  <option>--No data found--</option>
                                 <?php endif?>    
                               </select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Submitted Date</label>
										<div class="col-sm-9">
											<input class="form-control" type="text" id="submitted_date" required disabled>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category</label>
										<div class="col-sm-9">
											<select class="form-control" id="categories_name" required>
                              <option>--Choose categories--</option>
                            	  <?php if($categories!="0"):?>
                                <?php foreach($categories as $category) : ?>
                                 <option value="<?php echo $category->main_categoriesid?>"><?php echo $category->categoris_name?></option>
                                 <?php endforeach;?>
                                 <?php else:?>
 								  <option>--No data found--</option>
                                 <?php endif?>  
                              </select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Sub category</label>
										<div class="col-sm-9">
											<select class="form-control" id="sub_categories" required>
                            	 <option>--Select main categories--</option>
                              </select>
										</div>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Manufectured date</label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="manugectured_date" required>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Expired date</label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="exp_date" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product cost</label>
										<div class="col-sm-9">
											<input type="tel" class="form-control" required id="prudct_cost">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product price</label>
										<div class="col-sm-9">
											<input type="tel" class="form-control" required id="product_price">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Quantity</label>
										<div class="col-sm-9">
											<input type="tel" class="form-control" id="quantity" required>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Alert quantity</label>
										<div class="col-sm-9">
											<input type="quantity" class="form-control" id="alert_quantity" required>
										</div>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Picture</label>
										<div class="col-sm-9">
										
											<input type="file" class="form-control" id="picture">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Description</label>
										<div class="col-sm-9">
											<textarea id="description" class="form-control"></textarea>
										</div>
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product Unit</label>
										<div class="col-sm-9">
											 <input type="text" class="form-control" id="product_unit" required>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Additional amount</label>
										<div class="col-sm-9">
											 <input type="text" class="form-control" id="additional_amount" required>
										</div>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-success btn-block form-control" type="submit" id="saveProductsallbtn">
                      		SAVE <i class="icon-magnifier-add"></i>
                      	</button>

						  <button class="btn btn-info btn-block form-control d-none" type="buton" id="updateproductsallbtn">
                      		Update <i class="fa fa-refresh"></i>
                      	</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


		</div>