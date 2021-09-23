<script src="<?php echo base_url()?>assets/supplierreport.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Supplier report</h4>
                       </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                             <label for="">Supplier</label>
                              <select id="supplior_details_section_md" class="form-control">
                                <?php if($supplier_details==0):?>
                                <option value="">--NO data found--</option>
                                <?php else:?>
                                <option value="">--Choose Supplier--</option>
                                <?php foreach($supplier_details as $details):?>
                                <option value="<?php echo $details->supplier_id?>"><?php echo $details->supplier_name?> (<?php echo $details->mobile_number?>)</option>
                                <?php endforeach;?>

                                <?php endif;?>
                             </select>
                            </div>
                            <div class="col-md-4">
                                <label for="InvoiceNo">Supplier Invoice</label>
                                <input type="text" class='form-control' id='invoice_no' placeholder='Supplier invoice No'>
                            </div>
                            <div class="col-md-4">
                                <br>
                              <button class='btn btn-primary btn-lg my-3' id='searchforsupplierinvoicetoo'>Search</button>
                            </div>
                        </div>
                        <br>
                        <div class="float-right">
                                <button class='btn btn-primary' id='exporttoexcelsupplierdeetails'><i class="fa fa-file-excel-o"></i>   Export to excel</button>
                            </div>
                            <br>
                            <br><br>
                            <div>
                                <span class='text text-dark font-weight-bold'>Total sales amount from supplier : </span> &nbsp;
                                <span class='text text-primary font-weight-bold' id='total_salesamount'></span>
                            </div>
                            <div>
                                <span class='text text-dark font-weight-bold'>Total cost amount from supplier : </span> &nbsp; 
                                <span class='text text-primary font-weight-bold' id='total_costamountfromsupplier'></span>
                            </div>
                            <br><br>
                        <div class="d-flex">
                           
                             <input type="search" class="form-control" id="search_details_forsupplier" placeholder="Search Check details">
                        </div>
                           <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark" id='full_supplierdetails'>
                                     <thead>
                                         <tr class="text text-center">
                                             <th>Product Code</th>
                                             <th>Product Name</th>
                                             <th>Unit</th>
                                             <th>MFD</th>
                                             <th>EXP</th>
                                             <th>Product cost</th>
                                             <th>Product price</th>
                                             <th>Given QTY</th>
                                             <th>Static Supplier qty</th>
                                             <th>Balance qty</th>
                                             <th>Batch</th>
                                             <th>Invoice NO</th>
                                             <th>Manul Invoice</th>
                                          </tr>
                                     </thead>
                                     <tbody id="supplierdetailsproductsearch">

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
                    <option value="Pending">Pending</option>
                    <option value="Pass">Pass</option>
                    <option value="Returned">Returned</option>
                    <option value="Postponed">Postponed</option>
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
