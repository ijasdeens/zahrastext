<script src="<?php echo base_url()?>assets/barcodeprint.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">

            <div class="col-md-12 my-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ADD PRODUCTS TO GENERATE LABELS</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-4">
                               <div class="form-group">
                                 <label for="search_product_text">search product</label>
                                 <input type="search" class="form-control" id="search_product_text" list="productlist">

                                              </div>


                            </div>

                        </div>
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="col">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                  <div class="form-group">
                                    <div class="table table-responsive max-height:10px;">
                                        <table class="table-striped table-responsive">
                                         <thead>
                                             <tr>
                                                 <th>Product name</th>
                                                 <th>Product code</th>
                                                 <th>MFD</th>
                                                 <th>EXP</th>
                                                 <th>Unit</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody id='product_details_forbarcode'>

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
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col">
                          <div class="card my-4">
                    <div class="card-header">
                        <div class="card-title">Selected product</div>
                    </div>
                    <div class="card-body">
                      <form action="<?php echo base_url('Controllerunit/getallforblank')?>" method="POST" target="_blank">
                        <div class="form-group">
                            <label for="product_name">Product name</label>
                            <input type="text" class="form-control" name='product_name' id='product_name'>
                        </div>
                        <div class="form-group">
                            <label for="number_quantity">Number of qty</label>
                            <input type="qty" class="form-control" name="numberofqty" id="numberofqty">
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product ID</label>
                            <input type="tel" class="form-control" name="product_id" readonly id="product_id">
                        </div>
                        <div class="form-group">
                            <label for="Product_price">Price</label>
                            <input type="tel" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Product price</label>
                            <input type="checkbox" name="product_price" id="product_price" class="form-control" checked>
                        </div>
                        <div class="form-group">
                            <label for="mfd">MFD</label>
                            <input type="checkbox" class="form-control" name="mfd">
                        </div>
                        <div class="form-group">
                            <label for="exp">EXP</label>
                            <input type="checkbox" class="form-control" name="exp">
                        </div>

                        <div class="form-group">
                           <button class="btn btn-outline-danger btn-lg">Show preview</button>
                        </div>
                      </form>
                    </div>
                </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

        </div>


