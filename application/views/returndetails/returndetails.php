<script src="<?php echo base_url()?>assets/returnproductdetails.js"></script>

<div class="main-panel">

    <div class="content-wrapper">
          <div class="container">
        <div class="row d-none">
            <div class="d-flex flex-row">
                <div class="p-2">FROM : <input type='date' class='form-control' id='from_date_starting_again_searc'/></div>
                <div class="p-2">TO : <input type='date' class='form-control' id='to_date_searching_for_purcahse_details'/></div>
                <div class="p-2">
                    Outlet :
                    <select id="outlet_details_section" class="form-control">
                       <?php if($outletdetails==0):?>
                       <option value="">--NO OUTLET FOUND--</option>
                       <?php else:?>
                             <option value="">--Choose outlets</option>
                        <?php foreach($outletdetails as $outlet):?>
                        <option value="<?php echo $outlet->outlets_id?>"><?php echo $outlet->outlets_name?></option>
                        <?php endforeach;?>
                       <?php endif;?>

                    </select>
                </div>
                <div class="p-2">
                   <br>
                    <button class="btn btn-info" id="purcahse_details_return_search_btn">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>

        </div>
    </div>
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
             </div>
            <div class="col-md-4 my-4">
                <input type="search" class="form-control" placeholder="Search..." id="search_return_details_section">
            </div>
            <div class="container">
                <div class="row my-3">
                   <div class="col-md-12">
                        <table class="table table-striped table-dark">
                    <thead>
                        <tr class="text text-center">
                            <th>#NO</th>
                            <th>Product name</th>
                            <th>Returned quantity</th>
                            <th>Product code</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Summery</th>


                        </tr>
                    </thead>
                    <tbody id="showreturnedproductdetails">

                    </tbody>
                </table>
                   </div>
                </div>
            </div>

        </div>

    </div>


    <div class="modal fade" id="show_off_modal_for_summery_projects">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text text-white">
                     <h2 class="modal-title font-weight-bold">PRODUCT DETAILS</h2>
                     <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>
                         <i class="fa fa-close" aria-hidden="true"></i>
                     </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered bg-dark text-white">
                       <thead>
                            <tr>
                            <th>#NO</th>
                            <th>Ordered date</th>
                            <th>Discount</th>
                            <th>Discounted amount</th>
                            <th>Total amount</th>
                            <th>Payment method</th>
                            <th>Outlet name</th>
                            <th>Invoice</th>
                            <th>Customer name</th>
                            <th>Customer mobile</th>
                        </tr>
                        </thead>
                       <tbody id="return_products_details_showoff">

                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!--Edit suppliers-->


