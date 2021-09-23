
<script src="<?php echo base_url()?>assets/salesreport.js"></script>

   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card">
                   <div class="card-header">
                       <div class="card-title">
                           Search by date
                       </div>
                   </div>
                    <div class="card-body">
                    <div class="d-flex flex-row">
                       <div class="p-2">
                          <label for="chooseoutlet">Choose outlet</label>
                           <select id="outlet_details" class="form-control">
                               <?php if($alloutlets==0):?>
                                 <option value="">--No data found--</option>
                               <?php else:?>
                               <?php foreach($alloutlets as $outlet):?>
                                  <option value="<?php echo $outlet->outlets_id?>"><?php echo $outlet->outlets_name?></option>
                               <?php endforeach;?>
                               <?php endif;?>

                           </select>
                       </div>
                        <div class="p-2">
                           <label for="startdate">Start date</label>
                            <input type="date" class="form-control" id="from_date_for_sale_report">
                        </div>
                        <div class="p-2">
                           <label for="enddate">End date</label>
                            <input type="date" id="end_date" class="form-control">
                        </div>
                        <div class="p-2">
                            <br><br>
                            <button class="btn btn-outline-primary btn-sm" id="search_result_for_sale">Search</button>
                        </div>
                    </div>
                    <br>
                    <div class="float-right">
                        <button class="btn btn-info" id="print_sales_report_section">PRINT <i class="fa fa-print" aria-hidden="true"></i></button>
                    </div>
                    </div>
                </div>
                <br>
                <br>

            </div>
          </div>

          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-body">
                                      <div class="table table-responsive" id="print_container">
                                      <span class="text text-danger font-weight-bold" id="sales_report_total_for_print">Total amount : </span>
                                  <table class="table table-striped table-responsive">
                                      <thead>
                                          <tr class="text text-center">
                                              <th>#NO</th>

                                              <th>Purchased date</th>
                                              <th>Total price</th>
                                              <th>Discount %</th>
                                              <th>Discounted amount</th>
                                              <th>Recieved amount</th>
                                              <th>Customer details</th>

                                      </thead>
                                      <tbody id="sales_report_product">

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

    </div>

    <div class="modal fade" id="showoffproductdetailsforsales">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Purchased product details</h4>
                    <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>X</button>
                </div>
                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#NO</th>
                                    <th>Product name</th>
                                    <th>QTY</th>
                                    <th>Product price</th>
                                    <th>Product status</th>
                                </tr>
                            </thead>
                            <tbody id="showoffpurchasedproduct_details">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="showoffcustomerdetailsinmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Purchased product details</h4>
                    <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>X</button>
                </div>
                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>#NO</th>
                                    <th>Customer name</th>
                                    <th>Mobile number</th>
                                </tr>
                            </thead>
                            <tbody id="attachcustomerdetails_showoff">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!--Edit suppliers-->
