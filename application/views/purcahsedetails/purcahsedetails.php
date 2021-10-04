<script src="<?php echo base_url()?>assets/purcahsedetails.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">

            </div>
                <div class="col-md-12">
             <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text text-danger font-weight-bold">Purcahse details</h4>
                     <form method='POST' id='frm_purcahsedetails' class="purcahse_detaildform">
                         <div class="row">
                             <div class="col">
                                 <label for="supplier_name">Supplier name</label>
                               <select class="form-control" id="supplier_name_section" required>
                               <?php if($allsuppliers==0):?>
                                    <option value="">--No data found--</option>
                                    <?php else:?>
                                        <option value="">--Select one--</option>
                                        <?php foreach($allsuppliers as $supplier):?>
                                            <option value="<?php echo $supplier->supplier_id?>"><?php echo $supplier->org_name?> / <?php echo $supplier->supplier_name?></option>
                                            <?php endforeach; ?>
                                    <?php endif;?>
                               </select>
                                    
                             </div>
                             <div class="col-md-3">
                                 <label for="Refrencno">Ref No</label>
                                 <input type="text" class='form-control' id='ref_no_forsupplier' required>
                             </div>
                             <div class="col-md-3">
                                 <label>Purcahse date</label>
                                 <input type="date" class='form-control' id='purcahse_date' required>
                             </div>
                             <div class="col-md-3">
                                 <label for="payment">Total payment to be paid for supplier</label>
                                 <input type="text" class='form-control' id='totalpaymenttotbepaid' required>
                             </div>
                             <div class="col-md-3">
                                 <label for="paidamount">Paid amount</label>
                                 <input type="text" class='form-control' id='paid_amount' required>
                             </div>
                             <div class="col-md-3">
                                 <label for="bill_attachment">Bill attachment</label>
                                 <input type="file" class='form-control' id='bill_attachment_file'>
                             </div>
                             <div class="col-md-12 my-2">
                                 <input type="submit" class='form-control btn btn-success' id='save_trigger' value='save'>
                                 <input type="submit" class='form-control btn btn-info d-none' id='update_trigger' value='Update'>
                             </div>
                         </div>
                     </form>
                  </div>
                </div>
             </div>


        </div>
            <div class="col-md-12 my-4">
            <input type="text" class="form-control" placeholder="Search..." id="search_customer_details">
                    <div class="table table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th class="text text-center">#NO</th>
                                    <th class="text text-center">Supplier name</th>
                                    <th calss="text text-center">Supplier company name</th>
                                    <th class="text text-center">Refno</th>
                                    <th class="text text-center">Purcahsed date</th>
                                    <th class="text text-center">Total payment</th>
                                    <th calss="text text-center">Paid amount</th>
                                    <th class="text text-center">Bill attachment</th>
                                    <th class="text text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="showoffpurcahswdetailssection" class="text-center">

                            </tbody>
                        </table>
                    </div>
            </div>


    </div>
