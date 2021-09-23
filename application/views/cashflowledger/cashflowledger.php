<script src="<?php echo base_url()?>assets/chequedetails.js"></script>

   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Cashflow ledger</h4>
                        <div class="row">
                            <div class="col">
                                <label>FROM</label>
                                <input type='date' class='form-control' id='from_date_cashflowledger'/>
                            </div>
                            <div class="col">
                            <label>To</label>
                                <input type='date' class='form-control' id='to_date_cashflowledger'/>
                            </div>
                            <div class="col">
                                <br>
                                <button class='btn btn-primary btn-lg' id='btnsearch_getresultfordate'>Search</button>
                            </div>
                        </div>
                        <div class="my-2">
                           <div>
                               <span class='text font-weight-bold'>Cash-in</span> : &nbsp; 
                               <span class='text text-primary font-weight-bold' id='cashinsection'>Rs.00.00</span>
                           </div>
                           <div>
                               <span class='text font-weight-bold'>Cash out :</span>
                               &nbsp;
                               <span class='text text-danger font-weight-bold' id='cashoutsection'>Rs.00.00</span>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">
                           <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                              <th>Account NO</th>
                                             <th>Bank Name</th>
                                             <th>Branch</th>
                                             <th>Amount</th>
                                             <th>Type</th>
                                             <th>Date</th>
                                              <th>Note</th>
                                             <th>Primary account</th>
                                           
                                           </tr>
                                     </thead>
                                     <tbody id='account_no_section_ledger'>
                                      
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
