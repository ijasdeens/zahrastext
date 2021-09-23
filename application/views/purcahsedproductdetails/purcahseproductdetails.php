<script src="<?php echo base_url()?>assets/salespurchasedetails.js"></script>

<div class="main-panel">

    <div class="content-wrapper">
          <div class="container">
        <div class="row">
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
                    <button class="btn btn-info" id="purcahse_details_search_btn">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>

        </div>
    </div>
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
             </div>
            <div class="col-md-4 my-4">
                <input type="search" class="form-control" placeholder="Search..." id="search_details_forpurcahse_details">
            </div>
            <div class="container">
                <div class="row my-3">
                   <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-responsive table-dark">
                    <thead>
                        <tr class="text text-center">
                            <th>#NO</th>
                            <th>Invoice</th>
                            <th>Ordered date</th>
                            <th>Customer</th>
                            <th>Customer mobile</th>
                            <th>Discount</th>
                            <th>Discounted amount</th>
                            <th>Total amount</th>
                            <th>Outlet name</th>
                            <th>Products</th>
                        </tr>
                    </thead>
                    <tbody id="show_purchased_details_with_customer">

                    </tbody>
                </table>
                   </div>
                </div>
            </div>

        </div>

    </div>


    <div class="modal fade" id="showoff_modal_section">
        <div class="modal-dialog">
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
                            <th>Name</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>Amount</th>
                        </tr>
                       </thead>
                       <tbody id="product_show_off_details_in_table">

                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!--Edit suppliers-->


