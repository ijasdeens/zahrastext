<script src="<?php echo base_url()?>assets/addbrands.js"></script>
<div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addbrandsModal">ADD BRANDS</button>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <input type="text" class="form-control" placeholder="Search..." id="search_brands_section">
            </div>

            <div class="table table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th class="text text-center">#NO</th>
                            <th class="text text-center">Name</th>
                            <th class="text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="showOffBrands">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addbrandsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>

                        <input type="checkbox" class="form-control" id="addmultiple"> ADD MULTIPLE
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmaddbrand">
                        <div class="form-group">
                            <label>Brands Name</label>
                            <input type="text" class="form-control" required id="brandsName" autofocus>
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




    <div class="modal fade" id="editBrandsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                     Update brands all

                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="formupdatebrands">
                        <div class="form-group">
                            <label>Brands Name</label>
                            <input type="text" class="form-control" required id="ubrandsName" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-info btn-sm" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
