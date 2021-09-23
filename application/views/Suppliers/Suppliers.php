<script src="<?php echo base_url()?>assets/supplier.js"></script>
	<div class="main-panel">

	<div class="content-wrapper">
		<div class="row purchace-popup">
			<div class="col-12 stretch-card grid-margin">
				<div class="card card-secondary">
					<button class="btn btn-info" data-toggle="modal" data-target="#addsuppliers">ADD supplier details</button>
				</div>
				  
			
			</div>
			<div class="col-md-4 my-4">
				<input type="text" class="form-control" placeholder="Search...">
			</div>
			
			 <div class="table table-responsive">
			   	<table class="table table-dark">
			   		<thead>
			   			<tr>
			   				<th>#NO</th>
			   				<th>Name</th>
			   				<th>Mobile number</th>
			   				<th>Company name</th>
			   				<th>Address</th>
			   				<th>Account NO</th>
			   				<th>Banks</th>
			   				
			   				<th>Action</th>		
			   				</tr>
			   		</thead>
			   		<tbody id="showOffSuppliers">
			   		 
			   		</tbody>
			   	</table>
			   </div>
		</div>
	 
	</div>
	
<div class="modal fade" id="addsuppliers">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>ADD SUPPLIERS</h4>
			</div>
			<div class="modal-body bg-dark text-white">
				<form method="POST" id="frmsaveSupplier">
					<div class="form-group">
						<label>Supplier name <span class='text text-danger font-weight-bold'>*</span></label>
						<input type="text" class="form-control" required id="supplierName" autofocus>
					</div>
					<div class="form-group">
						<label>Mobile number <span class='text text-danger font-weight-bold'>*</span></label>
						<input type="tel" class="form-control" required id="mobileNumber">
					</div>
				  	<div class="form-group">
						<label>Organization Name <span class='text text-danger font-weight-bold'>*</span></label>
						<input type="text" class="form-control" id="orgName">
					</div>
			    	<div class="form-group">
						<label>Address <span class='text text-danger font-weight-bold'>*</span></label>
					 	<textarea class="form-control" id="suppliers_address" required></textarea>
					</div>
			    	<div class="form-group">
			    		<label>Account NO <span class='text text-danger font-weight-bold'>*</span></label>
			    		<input type="tel" class="form-control" id="suppliers_accountNo" required>
			    	</div>
			    	<div class="form-group">
			    		<label>Bank name <span class='text text-danger font-weight-bold'>*</span></label>
			    		<input type="text" class="form-control" id="bank_name" required>
			    	</div>
			    	
			    	 
				    <div class="form-group">
				    	<input type="submit" class="form-control btn btn-success btn-sm" value="SAVE">
				    </div>
				 
				 
				</form>
			</div>
		</div>
	</div>
</div>


<!--Edit suppliers-->




<div class="modal fade" id="updatesuppliers">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Update suppliers</h4>
			</div>
			<div class="modal-body bg-dark text-white">
				<form method="POST" id="frmUpdatesupplier">
					<div class="form-group">
						<label>Supplier name</label>
						<input type="text" class="form-control" required id="u_supplierName" autofocus>
					</div>
					<div class="form-group">
						<label>Mobile number</label>
						<input type="tel" class="form-control" required id="u_mobileNumber">
					</div>
				 	<div class="form-group">
						<label>Organization Name</label>
						<input type="text" class="form-control" id="u_orgName">
					</div>
			    	<div class="form-group">
			    		<label>Address</label>
			    		<textarea class="form-control" id="u_address"></textarea>
			    	</div>
			    	<div class="form-group">
			    		<label>Account NO</label>
			    		<input type="tel" class="form-control" id="u_accountNo">
			    	</div>
			    	<div class="form-group">
			    		<label>Bank name</label>
			    		<input type="text" class="form-control" id="u_banknumber">
			    	</div>
				    <div class="form-group">
				    	<input type="submit" class="form-control btn btn-info btn-sm" value="UPDATE">
				    </div>
				 
				 
				</form>
			</div>
		</div>
	</div>
</div>