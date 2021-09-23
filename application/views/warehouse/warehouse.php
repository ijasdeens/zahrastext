<script src="<?php echo base_url()?>assets/warehouse.js"></script>
    <div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#warehouseModal">Add warehouse</button>
                </div>
             </div>
            <div class="col-md-4 my-4">
                <input type="text" class="form-control" placeholder="Search...">
            </div>

             <div class="table table-responsive">
                   <table class="table table-dark">
                       <thead>
                           <tr>
                               <th>#NO</th>
                               <th>Name</th>
                               <th>Warehouse Address</th>
                               <th>Main Mobile</th>
                               <th>Action</th>
                               </tr>
                       </thead>
                       <tbody id="showOffWarehouse">

                       </tbody>
                   </table>
               </div>
        </div>

    </div>

<div class="modal fade" id="warehouseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>ADD WAREHOUSES</h4>
            </div>
            <div class="modal-body bg-dark text-white">
                <form method="POST" id="frmSaveWarehouse">
                    <div class="form-group">
                        <label>Warehouse Name</label>
                        <input type="text" class="form-control" required id="warehouseName" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Warehouse Address</label>
                        <input type="text" class="form-control" required id="warehouseAddress">
                    </div>
                     <div class="form-group">
                        <label>Warehouse Mobile</label>
                        <input type="text" class="form-control" id="warehouseMobile">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success btn-sm" value="SAVE">
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<!--Edit suppliers-->




<div class="modal fade" id="updateWarehouse">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Update Warehosue</h4>
            </div>
            <div class="modal-body bg-dark text-white">
                <form method="POST" id="frmUpdatewarehouse">
                    <div class="form-group">
                        <label>Warehouse Name</label>
                        <input type="text" class="form-control" required id="u_warehouseName" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="tel" class="form-control" required id="u_address">
                    </div>
                     <div class="form-group">
                        <label>Main Mobile Number</label>
                        <input type="text" class="form-control" id="u_mobile">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-info btn-sm" value="UPDATE">
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
