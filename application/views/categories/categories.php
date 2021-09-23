<script src="<?php echo base_url()?>assets/addcategories.js"></script>
<div class="main-panel">
 <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addcategories">ADD categories</button>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <input type="search" class="form-control" placeholder="Search..." id="search_categories_section">
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
                    <tbody id="showoffcategoriessection">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addcategories">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                          <input type="checkbox" class="form-control" id="addmultiple_categories"> ADD MULTIPLE
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmCategoriesName">
                        <div class="form-group">
                            <label>Categories Name</label>
                            <input type="text" class="form-control" required id="categoriesName" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-info btn-sm" value="SAVE">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Edit suppliers-->




    <div class="modal fade" id="updatecategories">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                    Updatecate categories
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="formupdatecategories">
                        <div class="form-group">
                            <label>categories Name</label>
                            <input type="text" class="form-control" required id="ucategories" autofocus>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-info btn-sm" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
