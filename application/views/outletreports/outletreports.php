<script src="<?php echo base_url()?>assets/outletreport.js"></script>
        <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-4">
                                 <h4 class="text text-danger">Outlet Stock report</h4>
                                    <div class="d-flex flex-row">
                                       <div class="p-1">Select outlet</div>
                                       <div class="p-1">
                                           <select class="form-control" id="outlet_selection_for_repot">
                                           <?php if($alloutlets==0):?>
                                           <option value="">--No outlet found--</option>
                                           <?php else:?>
                                           <option value="">--Select outlets--</option>
                                           <option value="All">All</option>
                                            <?php foreach($alloutlets as $outlets):?>
                                            <option value="<?php echo $outlets->outlets_id?>">
                                                <?php echo $outlets->outlets_name?>
                                            </option>
                                            <?php endforeach;?>
                                           <?php endif;?>
                                           </select>
                                       </div>

                                   </div>

                             </div>

                         </div>
                         <div class="float-right">
                             <button class="btn btn-primary" id="print_outletstockbtn">PRINT <i class="fa fa-print" aria-hidden="true"></i></button>
                         </div>

                     </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">

                          <div class="row">
                             <div class="table table-responsive" id="print_section_for_outletstock">
                                <span class="text text-danger font-weight-bold" id="total_amount_for_selling"></span>
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                              <th>#NO</th>
                                             <th>Product name</th>
                                             <th>Product UNIT</th>
                                             <th>Stock</th>
                                             <th>Selling price</th>
                                                 </tr>
                                     </thead>
                                     <tbody id="outlets_report">

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
