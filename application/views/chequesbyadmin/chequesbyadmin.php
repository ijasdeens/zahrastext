<script src="<?php echo base_url()?>assets/chequedetails.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Cheques details by admin</h4>
                             <div class="float-right">
                                  <button class="btn btn-outline-info" data-toggle="modal" data-target="#addchequeModal">Add cheques</button>
                             </div>
                      </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">
                        <div class="d-flex">
                            <div class="p-2">
                                From : <input type="date" class="form-control" id="from_date_check_cheque">
                            </div>
                            <div class="p-2">
                                To : <input type="date" class="form-control" id="to_date_check_cheque">
                            </div>
                            <div class="p-2">
                                Status :
                                <select class="form-control" id="check_details_status">
                                    <option value="">--Choose One --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="bounce">Bounced</option>
                                    <option value="completed">Completed</option>
                                   
                                </select>
                            </div>
                            <div class="p-2">
                               <br>
                                <button class="btn btn-primary btn-lg" id="search_cheqe_details_btn_by_admin"><i class="fa fa-search"></i>&nbsp;Search</button>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex">

                            <input type="search" class="form-control" id="search_check_details_byadmin" placeholder="Search Check details">
                        </div>

                      <br><br>
                      <div class="container my-3">
                          <div class="row">
                              <div class="col-md-12">
                                   <span class='text text-danger font-weight-bold'>Total amount of pending checks : </span> &nbsp; <span id='total_pending_checks' class="font-weight-bold">Rs.0.00</span>
                              </div>
                              <div class="col-md-12">
                                  <span class="text text-info font-weight-bold">Total amount of bounced checks : </span> &nbsp; <span id='total_bounced_checks' class="font-weight-bold">Rs.0.00</span>
                              </div>
                              <div class="col-md-12">
                                  <span class='text text-success font-weight-bold'>Total amount of completed checks : </span>&nbsp; <span class='font-weight-bold' id='total_completed_checks'>Rs.0.00</span>
                              </div>
                          </div>
                      </div>
                          <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                             <th>Bank Name</th>
                                             <th>Branch Name</th>
                                             <th>Cheque NO</th>
                                             <th>Cheque amount</th>
                                             <th>Cheque date</th>
                                             <th>Cheque Status</th>
                                             <th>Customer name</th>

                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody id="displaychequedetailsfromadmin">

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



<div class="modal fade" id="addchequeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
        <h4 class="text text-danger">Cheque section</h4>
    </div>
    <div class="modal-body bg-dark text-white">
        <form method="POST" id="savechequedetailsbyadmin">
            <div class="form-group">
                <label>Cheque No</label>
                <input type="tel" class="form-control" id="cheque_no" required>
            </div>
               <label>Cheque Date</label>
                <div class="form-group">
                <input type="date" class="form-control" id="cheqe_date" required>
            </div>

            <div class="form-group">
                 <label>Bank</label>
                 <select id="bank_name" class="form-control">
                     <?php if($bankaccountdetials==0):?>
                     <option value="">--No bank found--</option>
                     <?php else:?>
                     <?php foreach($bankaccountdetials as $details):?>
                     <option value="<?php echo $details->bank_name?>"><?php echo $details->bank_name?></option>
                     <?php endforeach;?>
                     <?php endif;?>
                 </select>
            </div>
            <div class="form-group">
                <label for="Branch">Branch</label>
                <input type="text" class="form-control" id="branch_name" required>
            </div>
         
            <div class="form-group">
                <label>Customer name</label>
                <input type="text" class="form-control" id="customer_name" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="tel" class="form-control" id="amount" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="cheque_status_details" class="form-control" required>
                    <option value="">--Select one--</option>
                    <option value="bounced">Bounced</option>
                    <option value="pending">pending</option>
                    <option value="completed">Returned</option>
                  
                </select>

            </div>
            <div class="form-group">
                <button class="btn btn-outline-success btn-block form-control">Save</button>
            </div>
        </form>
    </div>
        </div>
    </div>
</div>







    <!--Edit suppliers-->
