<script src="<?php echo base_url()?>assets/supplier.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                    </div>
                    <hr>
                    <div class="card-body">
                    <div class="my-2">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label>FROM</label>
                                            <input type="date" class='form-control' id='from_date_searchforpendingcheques'>
                                        </div>
                                        <div class="col">
                                            <label>TO</label>
                                            <input type="date" class='form-control' id='to_date_forchequespendingcheqs'>
                                        </div>
                                        <div class="col">
                                            
                                            <br>
                                            <button class='btn btn-primary' id='searchforsuppliercheques'>Search <i class='fa fa-search'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <input type="search" class="form-control" id="searchpendingchequesforsupplierinput" placeholder="Search">
                                </div>
                                
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                  <span class='text text-info'>Total amount of bounced cheques : </span> &nbsp; <span class="text text-primary font-weight-bold" id='bounced_chequeamount'>Rs.00.0</span>
                              </div>
                              <div class="col-md-12">
                                  <span class='text text-info'>Total amount of completed cheques : </span> &nbsp; <span class="text text-primary font-weight-bold" id='completedcheque_amount'>Rs.00.0</span>
                              </div>
                              <div class="col-md-12">
                                  <span class='text text-info'>Total amount of pending cheques : </span> &nbsp; <span class="text text-primary font-weight-bold" id='pendingchequeamount'>Rs.00.0</span>
                              </div>


                            </div>
                            <div class="container">
                                <div class="row my-3">
                                <div class="float-right ml-auto">
                                    <button class='btn btn-success' data-toggle='modal' data-target='#addchequeModalforsuppliers'>ADD <i class="fa fa-plus"></i></button>
                                </div>
                                </div>
                            </div>
                          
                            <div class="row">

                                <div class="table table-responsive">

                                    <table class="table table-dark table-responsive">
                                        <thead>
                                            <tr class="text text-center">
                                                <th>#NO</th>
                                                <th>Bank Name</th>
                                                <th>Branch Name</th>
                                                <th>Account NO</th>
                                                <th>Date</th>
                                                 <th>Amount (Rs)</th>
                                                <th>Status</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier organization</th>
                                                <th>Supplier number</th>
                                                <th>Note</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody id="pendingchequesforsuppliersection">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <div class="modal fade" id="addchequeModalforsuppliers">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text text-danger">Cheque section</h4>
                    <div class='my-2'>
                        <label for="">ADD MULTIPLE</label>
                        <input type="checkbox" class='form-control' id='add_multipleforchequedetails'>
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="savesuppliercheques">
                        <div class="form-group">
                            <label for="bank_namew">Bank Name <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="text" class='form-control' id='bank_name' required>
                        </div>
                        <div class="form-group">
                            <label for="branch_name">Branch name <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="text" class='form-control' id='branch_name' required>
                        </div>
                        <div class="form-group">
                            <label for="accountno">Account NO <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="tel" class='form-control' id='account_no' required>
                        </div>
                        <div class="form-group">
                            <label for="chquesdate">Chques date <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="date" class='form-control' id='cheques_date' required>
                        </div>
                        <div class="form-group">
                            <label for="chequedetailsstatus">Cheque status <span class="text text-danger font-weight-bold">*</span></label>
                            <select id="cheque_status" class='form-control'>
                                <option value="pending">Pending to be deposited</option>
                                <option value="bounce">Cheque bounce</option>
                                <option value="completed">Completed</option>
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="tel" class='form-control' id='amountforcheque' required>
                        </div>
                        <div class="form-group">
						 <label for="note">Note </label>
						 <textarea class='form-control' id='noteforcheck'></textarea>
					 </div>
                        <div class="form-group">
                            <label for="supplier_details">Supplier details <span class="text text-danger font-weight-bold">*</span></label>
                          
                            <select id="supplier_details" id='supplier_details_choose' class='form-control' required>
                                <?php if($suppliers==0):?>
                                    <option value="">--No supplier found--</option>
                                    <?php else:?>
                                        <?php foreach($suppliers as $supplier):?>
                                              <option value="<?php echo $supplier->supplier_id?>"><?php echo $supplier->org_name .' / '. $supplier->supplier_name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class='form-control btn btn-primary btn-block' value='SAVE'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id='selectstatusforcheques'>
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">
                       Cheque status update
                    </h4>
                    <button class='btn btn-danger btn-sm' data-dismiss='modal'>X</button>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method='POST' id='frmchosenstatus'>
                    <div class="form-group">
                            <label for="chequedetailsstatus">Cheque status<span class="text text-danger font-weight-bold">*</span></label>
                            <select id="cheque_status_reupdate" class='form-control'>
                                <option value="">--Select one--</option>
                                <option value="pending">Pending to be deposited</option>
                                <option value="bounce">Cheque bounce</option>
                                <option value="completed">Completed</option>
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <button class='btn btn-block btn-primary form-control' id='chequestatus_updatebutton' type='submit'>Update <i class="fa fa-refresh" aria-hidden='true'></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
    <div class="modal fade" id="updatechequeforsuppliersmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text text-danger">Cheque section</h4>
                    <div class='my-2'>
                     
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="updatesuppliercheques">
                        <div class="form-group">
                            <label for="bank_namew">Bank Name <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="text" class='form-control' id='ubank_name' required>
                        </div>
                        <div class="form-group">
                            <label for="branch_name">Branch name <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="text" class='form-control' id='ubranch_name' required>
                        </div>
                        <div class="form-group">
                            <label for="accountno">Account NO <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="tel" class='form-control' id='uaccount_no' required>
                        </div>
                        <div class="form-group">
                            <label for="chquesdate">Chques date <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="date" class='form-control' id='ucheques_date' required>
                        </div>
                        <div class="form-group">
                            <label for="chequedetailsstatus">Cheque status <span class="text text-danger font-weight-bold">*</span></label>
                            <select id="ucheque_status" class='form-control'>
                                <option value="pending">Pending to be deposited</option>
                                <option value="bounce">Cheque bounce</option>
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount <span class="text text-danger font-weight-bold">*</span></label>
                            <input type="tel" class='form-control' id='uamountforcheque' required>
                        </div>
                        <div class="form-group">
						 <label for="note">Note </label>
						 <textarea class='form-control' id='unoteforcheck'></textarea>
					 </div>
                        <div class="form-group">
                            <label for="supplier_details">Supplier details <span class="text text-danger font-weight-bold">*</span></label>
                          
                            <select id="usupplier_details" id='usupplier_details_choose' class='form-control' required>
                                <?php if($suppliers==0):?>
                                    <option value="">--No supplier found--</option>
                                    <?php else:?>
                                        <?php foreach($suppliers as $supplier):?>
                                              <option value="<?php echo $supplier->supplier_id?>"><?php echo $supplier->org_name .' / '. $supplier->supplier_name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class='form-control btn btn-primary btn-block' value='Update'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


     

    <!--Edit suppliers-->
