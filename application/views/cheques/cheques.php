<script src="<?php echo base_url()?>assets/chequedetails.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Cheque details from customer</h4>
                             <div class="float-right d-none">
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
                                    <option value="Pass">Pass</option>
                                    <option value="Returned">Returned</option>
                                    <option value="Postponed">Postponed</option>
                                </select>
                            </div>
                            <div class="p-2">
                               <br>
                                <button class="btn btn-primary btn-lg" id="search_cheqe_details_btn"><i class="fa fa-search"></i>&nbsp;Search</button>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex">

                            <input type="search" class="form-control" id="search_check_details" placeholder="Search Check details">
                        </div>

                      <br><br>
                          <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                             <th>Customer Name</th>
                                             <th>Customer Mobile</th>
                                             <th>Invoice NO</th>
                                             <th>Cheque details</th>
                                             <th>Cheque Number</th>
                                             <th>Amount to be given</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody id="display_check_details_for_customers">

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




<div class="modal fade" id="check_details_modal">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-dark text-white">
            <div class="modal-title">ALL CHECK DETAILS</div>
            <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>
        </div>
    <div class="modal-body bg-secondary">
       <table class="table table-dark">
         <thead>
            <tr>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>Cheque Date</th>

                <th>Cheque NO</th>
                 <th>Chque Status </th>
            </tr>
        </thead>
        <tbody id="check_details_display_section">

        </tbody>
       </table>
    </div>
    </div>
</div>
</div>


<div class="modal fade" id="product_details_modal">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-dark text-white">
            <div class="modal-title">Product details</div>
            <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>
        </div>
    <div class="modal-body bg-secondary">
       <table class="table table-dark">
         <thead>
            <tr>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>Cheque Date</th>

                <th>Cheque NO</th>
                 <th>Chque Status </th>
            </tr>
        </thead>
        <tbody id="check_details_display_section">

        </tbody>
       </table>
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
        <form method="POST" id="frmchecksection">
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
                <label for="amount">Amount</label>
                <input type="tel" class="form-control" id="amount" required>
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
