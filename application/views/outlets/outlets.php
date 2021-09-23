<script src="<?php echo base_url()?>assets/outlets.js"></script>

<div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addOutlets">ADD Outlets</button>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <input type="search" class="form-control" placeholder="Search..." id="search_outlets_bar">
            </div>

            <div class="table table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                             <th class="text text-center">Outlets Name</th>
                            <th class="text text-center">HOT NUMBER</th>
                            <th class="text text-center">ADDRESSES</th>
                            <th class="text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="showOffOutlets">
                    <?php if($alloutlets=="0"):?>
                    <tr>
                        <td><span class="text text-danger font-weight-bold">No data found</span></td>
                    </tr>
                    <?php else:?>
                    <?php foreach($alloutlets as $outlet):?>
                    <tr>
                        <td class="text text-center"><?= $outlet->outlets_name?></td>
                        <td class="text text-center"><?= $outlet->outlet_mob?></td>
                        <td class="text text-center"><?= $outlet->addresses?></td>
                        <td class="text text-center">
                            <button class="btn btn-danger delete_outlet" outlet_id="<?php echo $outlet->outlets_id?>">Delete <i class="fa fa-trash"></i></button>
                            &nbsp; 
                            <button class='btn btn-info edit_content_for_outlet' 
                            outlet_address="<?= $outlet->addresses?>" outlet_mobile="<?= $outlet->outlet_mob?>" outlet_name="<?= $outlet->outlets_name?>"  outlet_id="<?php echo $outlet->outlets_id?>">Edit <i class="fa fa-pencil"></i></button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id='editcontent_for_outletsectionmodal'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                        <h3 class='modal-title'>Edit outlet section</h3>
                </div>
                <div class="modal-body">
                    <form method='post' id='frm_update_outlet_section'>
                        <div class="form-group">
                            <label for="outlet_name">Outlet name</label>
                            <input type="text" class='form-control' id='outlet_name_update'>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile number</label>
                            <input type="text" class='form-control' id='outlet_name_mobile_update'>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class='form-control' id='outlet_address_for_update'></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class='form-control btn btn-info' id='outlet_name' value='Update'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id='password_verification_fordelete'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h3 class='modal-title'>Verify outlet</h3>
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method='POST' id='verify_outlets_form'>
                        <div class="form-group">
                            <label for="verify_outlets_section">Enter password to delete</label>
                            <input type="password" class='form-control' id='password_to_delete' placeholder='******'>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn-info" id='enterpasswordtodelete' value='Verify'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addOutlets">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     Outlets
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmsaveOutlets">
                        <div class="form-group">
                            <label>Outlets Name</label>
                            <input type="text" class="form-control" required id="outlets_name" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Mobile number</label>
                            <input type="tel" class="form-control" id="hot_mob_number" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" id="outlet_address" required></textarea>
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


