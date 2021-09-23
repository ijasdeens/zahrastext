<script src="<?php echo base_url()?>assets/staffbase.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
                 <div class="col-md-12">
             <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text text-danger font-weight-bold">Save Staff</h4>
                     <form class="forms-sample" id="frmstaff">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" id="staffName" placeholder="Staff Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mobile</label>
                        <input type="tel" class="form-control" id="staffmob" placeholder="Staff Mobile" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Responsiblity</label>
                        <input type="text" class="form-control" id="responsibility" placeholder="responsibility">
                      </div>
                      <div class="form-group">
                          <label>Joint date</label>
                          <input type="date" class="form-control" id="joint_date">
                      </div>
                      <div class="form-group">
                          <label>Working outlets</label>
                       <select id="working_outlets" class="form-control" required>
                           <?php if($outlets=="0"):?>
                           <option>--No data found--</option>
                           <?php else:?>
                            <?php foreach($outlets as $outlet):?>
                            <option value="<?php echo $outlet->outlets_id?>">
                                <?php echo $outlet->outlets_name;?>
                            </option>
                            <?php endforeach;?>
                           <?php endif;?>
                       </select>
                      </div>
                       <div class="form-group">
                         <button class="btn btn-success btn-block form-control" type="button" id="save_staff_section">SAVE</button>
                         <button class='btn btn-primary btn-block form-control d-none' type='button' id='edit_staff_section'>Update</button>
                      </div>

                    </form>
                  </div>
                </div>
             </div>


        </div>

            <div class="col-12 stretch-card grid-margin">
             </div>
            <div class="col-md-12 my-4">
            <div class="my-2">

            </div>
            <input type="search" class="form-control" placeholder="Search..." id="searchStaff">
                    <div class="table table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th class="text text-center">#NO</th>
                                    <th class="text text-center">Name</th>
                                    <th class="text text-center">Mobile</th>
                                    <th class="text text-center">Responsibility</th>
                                    <th class="text text-center">Joint date</th>
                                    <th class="text text-center">Allocated Outlets</th>
                                    <th class="text text-center">Cashier LOGIN</th>
                                    <th class='text text-center'>Warehouse LOGIN</th>
                                    <th class="text text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="showoffStaff">
                             </tbody>
                        </table>
                    </div>
            </div>


    </div>
