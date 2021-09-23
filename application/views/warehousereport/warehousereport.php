<script src="<?php echo base_url()?>assets/warehousereports.js"></script>
        <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-4">
                                 <h4 class="text text-danger">Warehouse Report</h4>
                                    <div class="d-flex flex-row">
                                       <div class="p-1">Select warehouse</div>
                                       <div class="p-1">
                                           <select class="form-control" id="warehouse_report_section_selector">
                                           <?php if($warehousedetails==0):?>
                                           <option value="">--No warehouse found--</option>
                                           <?php else:?>
                                           <option value="">--Select warehouse--</option>
                                          
                                            <?php foreach($warehousedetails as $warehousesection):?>
                                            <option value="<?php echo $warehousesection->warehouse_id?>">
                                                <?php echo $warehousesection->warehouse_name?>
                                            </option>
                                            <?php endforeach;?>
                                           <?php endif;?>
                                           </select>
                                       </div>

                                   </div>

                             </div>

                         </div>
                         <div class="float-right">
                             <button class="btn btn-primary" id="print_warehousestock">PRINT <i class="fa fa-print" aria-hidden="true"></i></button>
                         </div>

                     </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">
                            <div class="my-2">
                                <input type="search" class='form-control' id='search_warehousereport' placeholder='Search warehouse details'>
                            </div>
                            <div class="my-2">
                                 <div>
                                     <span class='text text-info font-weight-bold'>Sum of cost :</span> &nbsp; 
                                     <span class='font-weight-bold' id='sumofcostsectionforall'>Rs.00</span>
                                 </div>
                                 <div>
                                     <span class='text text-info font-weight-bold'>Sum of selling price  :</span> &nbsp; 
                                     <span class='font-weight-bold' id='sumofsellingpriceforall'>Rs.00</span>
                                 </div>
                                 <div>
                                     <span class='text text-info font-weight-bold'>Total quantity :</span> &nbsp; 
                                     <span class='font-weight-bold' id='sumoftotalquantityforall'>0</span>
                                 </div>

                                 <div>
                                     <span class='text text-info font-weight-bold'>Total products :</span> &nbsp; 
                                     <span class='font-weight-bold' id='sumoftotalproductsforall'>0</span>
                                 </div>



                            </div>


                          <div class="row">
                             <div class="table table-responsive" id="print_section_for_outletstock_warehouse">
                                <span class="text text-danger font-weight-bold" id="total_amount_for_selling"></span>
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                              <th>#NO</th>
                                             <th>Product name</th>
                                             <th>Product code</th>
                                             <th>Brands</th>
                                             <th>Main category</th>
                                             <th>Sub category</th>
                                             <th>MFD</th>
                                             <th>EXP</th>
                                             <th>Product cost</th>
                                             <th>Product price</th>
                                             <th>Quantity</th>
                                             <th>Alert quantity</th>
                                             <th>Product pic</th>
                                             <th>Product Unit</th>
                                             <th>Product description</th>
                                             <th>BATCH NO</th>
                                             <th>Invoice NO</th>
                                            
                                                 </tr>
                                     </thead>
                                     <tbody id="warehousereport_display">

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
