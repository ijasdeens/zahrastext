<script src="<?php echo base_url()?>assets/subcat.js"></script>
<div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addsubcategory">ADD SUB categories</button>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <input type="search" class="form-control" placeholder="Search..." id="search_sub_categories_section">
            </div>

            <div class="table table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th class="text text-center">#NO</th>
                            <th class="text text-center">Belongs to</th>
                            <th class="text text-center">Sub category Name</th>
                            <th class="text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="showoffsubcats">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addsubcategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                          <input type="checkbox" class="form-control" id="add_multiplesub"> ADD MULTIPLE
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmsavesubcategory">
                        <div class="form-group">
                            <label>Categories Name</label>
                             <select class="form-control" id="main_category">
<!--                                 It is displied via category section-->
                             </select>
                        </div>
                         <div class="form-group">
                             <input type="text" class="form-control" id="sub_category">
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

     <div class="modal fade" id="editsubcategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                           Update sub categories name
                    </div>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmupdatecateogry">
                          <div class="form-group">
                            <label>Categories Name</label>
                             <select class="form-control" id="umain_category">
<!--                                 It is displied via category section-->
                             </select>
                        </div>
                         <div class="form-group">
                             <input type="text" class="form-control" id="usub_category">
                         </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-info btn-sm" value="UPDATE">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

