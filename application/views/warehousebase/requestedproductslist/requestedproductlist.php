<script src="<?php echo base_url()?>assets/warehosueaddproduct.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">

            <div class="col-md-12 my-12">
                <input type="text" class="form-control" placeholder="Search..." id="search_product">
                <div class="table table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr class="text text-center">
                            <th>#NO</th>
                            <th>Name</th>
                            <th>Barcode</th>
                            <th>Requested quantity</th>
                            <th>Brand</th>
                            <th>Date and time</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="showOffAvailableProducts">

                            <?php if($completedrequested_product!=0):?>
                            <?php  $count=1;?>
                            <?php foreach($completedrequested_product as $product):?>
                            <tr class="text text-center">
                                <td><?php echo $count++;?></td>
                                <td><?php echo $product->product_name?></td>
                                <td><?php echo $product->products_code?></td>
                                <td><?php echo $product->request_quantity?></td>
                                <td><?php echo $product->brands_name?></td>
                                <td><?php echo $product->dateandtime?></td>
                                <td><?php echo $product->status=='Pending' ? '<span class="badge badge-warning">Pending</span>' : '<span class="badge badge-success">Completed</span>' ?></td>

                            </tr>
                            <?php endforeach;?>
                            <?php else:?>
                            <tr>
                                <td>
                                    <span class="text text-danger font-weight-bold">NO DATA FOUND</span>
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>



