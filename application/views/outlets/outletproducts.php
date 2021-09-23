<script src="<?php echo base_url()?>assets/outlets.js"></script>

   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                
                 <div class="card">
                     <div class="container">
                     <h4 class="text text-danger mt-3">Product's in outlets details</h4>
                     </div>
                     <div class="card-body">
                         <div class="my-3">
                            <select class='form-control' id='products_outlet_details' style="max-width:220px">
                             <?php if($outlets_details==0):?>
                                    <option value="">--No outlet found--</option>
                                <?php else:?>
                                    <option value="">--Select outlet--</option>
                                    <?php foreach($outlets_details as $details):?>
                                        <option value="<?php echo $details->outlets_id?>"><?php echo $details->outlets_name?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                            </select>
                         </div>
                        
                        
                        <div class="my-2">
                           <div>
                               <span class='text font-weight-bold'>Total amount of selling price</span> : &nbsp; 
                               <span class='text text-primary font-weight-bold' id='selling_priceamount'>Rs.00.00</span>
                           </div>
                           <div>
                               <span class='text font-weight-bold'>Total amount of cost price :</span>
                               &nbsp;
                               <span class='text text-danger font-weight-bold' id='totalamountofcostprice'>Rs.00.00</span>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="card-body">
                         <div class="container">
                             <div class="row">
                                 <div class="col-md-4 my-2">
                                     <label for="search">Search</label>
                                     <input type="search" class='form-control' id='products_for_outlet_search_input' placeholder='Search'>
                                 </div>
                             </div>
                         </div>
                      <div class="container">
                           <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                              <th>#NO</th>
                                             <th>Product name</th>
                                             <th>Product quantity</th>
                                             <th>Product code</th>
                                             <th>Brand</th>
                                             <th>Category</th>
                                              <th>Sub category</th>
                                             <th>MFD</th>
                                             <th>EXP</th>
                                             <th>Product price</th>
                                             <th>Product cost price</th>
                                             <th>Product picture</th>
                                             <th>Product unit</th>
                                             <th>BATCH NO</th>
                                             <th>Invoice NO</th>
                                             <th>Additional amount</th>
                                             <th>Product description</th>
                                             <th>Action</th>
                                           
                                           </tr>
                                     </thead>
                                     <tbody id='outlets_productdetails'>
                                      
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



    <!--Edit suppliers-->

    <div class="modal fade" id="addbankdetails">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header bg-dark text-white">
                     <div class="modal-title">
                        Save Bank details
                     </div>
                                             <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>

                 </div>
                 <div class="modal-body bg-dark text-white">
                  <form method="POST" id="savebank_details_section">
                      <div class="form-group">
                          <label for="bankName">Bank Name</label>
                          <input type="text" class="form-control" id="bank_details_name">
                      </div>
                      <div class="form-group">
                          <label for="branc_name">Branch Name</label>
                          <input type="text" class="form-control" id="branch_name">
                      </div>
                      <div class="form-group">
                          <label for="account_no">Account NO</label>
                          <input type="tel" class="form-control" id="account_no">
                      </div>
                      <div class="form-group">
                          <label for="">Initial Amount</label>
                          <input type="tel" class="form-control" id="initial_amount">
                      </div>
                      <div class="form-group">
                          <label for="Note">Note</label>
                          <textarea class="form-control" id="bank_note" maxlength="100"></textarea>
                          <span class="text text-danger font-weight-bold" id="bank_note_count">0/100</span>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-success btn-lg" type="submit">
                            SAVE <i class="fa fa-save"></i>
                        </button>
                      </div>
                  </form>
                 </div>
             </div>
         </div>
    </div>
