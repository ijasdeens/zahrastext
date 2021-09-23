<script src="<?php echo base_url()?>assets/chequedetails.js"></script>

   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Bank accounts</h4>
                             <div class="float-right">
                                  <button class="btn btn-outline-info" data-toggle="modal" data-target="#addbankdetails">Add Bank details</button>
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
                                              <th>Account NO </th>
                                             <th>Bank Name</th>
                                             <th>Branch</th>
                                             <th>Amount</th>
                                              <th>Note</th>
                                             <th>Primary</th>
                                             <th>Action</th>
                                           </tr>
                                     </thead>
                                     <tbody>
                                      <?php if($bankaccountdetials=="0"):?>
                                          <tr>
                                              <td><span class="text text-danger">No data found</span></td>
                                          </tr>
                                      <?php else:?>
                                          <?php foreach($bankaccountdetials as $details):?>
                                              <tr class="text text-center">
                                                  <td><?php echo $details->bank_account_no?></td>
                                                  <td><?php echo $details->bank_name?></td>
                                                  <td><?php echo $details->branch_name?></td>
                                                  <td><?php echo number_format($details->initial_amount,2)?></td>
                                                  <td><?php echo $details->initial_note?></td>
                                                  <td>
                                                      <?php
                                                        if($details->primary_bank==1){
                                                          ?>
                                                          <span class="badge badge-primary">Primary</span>
                                                          <?php
                                                        }
                                                      else {
                                                        ?>
                                                          <span class="badge badge-danger">Non-primary</span>
                                                        <?php
                                                      }
                                                      ?>
                                                  </td>
                                                  <td>
                                              <button class="btn btn-outline-danger deletebankaccountdetails btn-sm" deleteaccountid="<?php echo $details->bank_details_id?>"><i class="fa fa-trash"></i></button>
                                                <?php
                                                        if($details->primary_bank==1){
                                                            ?>
                                                                <button class="btn btn-outline-info btnmakenoneprimary btn-sm" title="Make it as primary account" bank_details_id='<?php echo $details->bank_details_id?>'>Make non-primary <i class="fa fa-arrow-down"></i></button>
                                                            <?php

                                                        }
                                                      else {
                                                            ?>
                                                    <button class="btn btn-outline-info btnmakeprimary btn-sm" title="Make it as primary account" bank_details_id='<?php echo $details->bank_details_id?>'>Make primary <i class="fa fa-arrow-up"></i></button>
                                                            <?php
                                                      }
                                                      ?>
                                                    &nbsp;
                                                    <br><br>
                                                   <div class="dropdown">
  <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   ADD / SUBTRACT cash
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <a class="dropdown-item add_cash_to_bank_account_temp" initial_amount='<?php echo $details->initial_amount?>' bank_details_id='<?php echo $details->bank_details_id?>' href="#">ADD CASH / Subtract Amount &nbsp;<i class="fa fa-plus"></i></a>
    
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
                     </div>
                 </div>
            </div>


        </div>

    </div>

 
    
    <div class="modal fade" id="banksubtractiondetailshandler">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header bg-dark text-white">
                     <div class="modal-title">
                     Update amount
                     </div>
                                             <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>

                 </div>
                 <div class="modal-body bg-dark text-white">
                 <div class="form-group">
                          <label for="bankName">Amount</label>
                          <input type="tel" class="form-control" id="bank_update_amount" placeholder='Amount to update'>
                      </div>
                      <div class="form-group">
                          <label for="note">Note</label>
                          <input type="text" class='form-control' id='bank_details_note' placeholder='Ex : Updated for fuel '>
                      </div>
                     <div class="form-group">
                         <div class="d-flex justify-content-between">
                             <div class="p-2">
                                 <button class='btn btn-primary' id='add_amount_to_bankdetails'>ADD + </button>
                             </div>
                             <div class="p-2">
                                 <button class='btn btn-danger' id='subtract_amount_to_bankdetails'>Subtract - </button>
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
