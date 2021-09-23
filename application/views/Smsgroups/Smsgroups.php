<script src="<?php echo base_url()?>assets/createsms.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Create Group</h4>
                       <center>
                           <button class="btn btn-outline-info btn-lg" data-toggle='modal' data-target='#exampleModal'>Create Group</button>
                       </center>
                     </div>

                 </div>
                 <hr>
                 <hr>
                 <br>

            </div>


        </div>
        <div class="container">
            <div class="row">


                     <?php if($group_details==0):?>
                  <span class="text text-danger font-weight-bold">No group found yet</span>
                   <?php else:?>
                   <?php foreach($group_details as $details):?>
                   <div class="col-md-5">
                         <div class="card">

                         <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between">
                            <div class="p-2"><?php echo $details->groups_name?> <a href="#" class="btn btn-link btn-sm btn-info editgroup_name" group_id='<?php echo $details->groups_id?>' group_name='<?php echo $details->groups_name?>'>
                                <i class="fa fa-edit"></i>
                            </a></div>
                            <div class="p-2">
                                <button class="btn btn-primary btn-sm add_customer_sms_group" group_id='<?php echo $details->groups_id?>'><i class="fa fa-plus"></i> ADD CONTACT</button>
                            </div>
                            <div class="p-2">
                                <button class="btn btn-outline-danger btn-sm deletegroupbtnforsms" group_id='<?php echo $details->groups_id?>'><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;DELETE</button>
                            </div>
                        </div>
                        <br>
                        <div>
                            <button class="btn btn-block btn-lg btn-outline-warning send_sms_group_section"  group_id='<?php echo $details->groups_id?>'>SEND GROUP SMS <i class="fa fa-send"></i></button>
                        </div>
                         </div>

                        <div class="card-body">
                           <center>
                               <button class="btn btn-link btn-sm show_contact_details_btn" group_id='<?php echo $details->groups_id?>'><u>SHOW CONTACTS</u></button>
                           </center>
                            <div class="table table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#NO</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_releated_sms<?php echo $details->groups_id?>">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   </div>
                   <?php endforeach;?>
                   <?php endif;?>


            </div>
        </div>

    </div>




    <!--Edit suppliers-->
<div class="modal fade" id="exampleModal" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   Create Group
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmcreategroups">
                        <div class="form-group">
                           <input type="text" class="form-control" id="create_group_name">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success btn-sm" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--    Single SMS send modal-->


    <!--Edit suppliers-->
<div class="modal fade" id="updateexampleModal" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   Edit group
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmupdategroup">
                        <div class="form-group">
                           <input type="text" class="form-control" id="update_create_group_name">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success btn-sm" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--    Single SMS send modal-->

<div class="modal fade" id="addgroupsforcustomertosmss" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <b>ADD TO GROUP</b>
                    <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>X</button>
                </div>
                <div class="modal-body bg-dark text-white">
                    <input type="search" class="form-control" id="search_area_forcustomer_selection" placeholder="Search">
                    <hr>
                    <div class="">
                        <table class="table table-bordered">
                            <thead class="text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text text-center text-white">
                                <?php if($customer_details==0):?>
                                    <tr>
                                        <td><span class="text text-danger font-weight-bold">NO DATA FOUND</span></td>
                                    </tr>
                                <?php else:?>

                                 <center>
                                        <?php foreach($customer_details as $customer):?>
                                          <tr>

                                    <td><?php echo $customer->customer_name?></td>
                                    <td><?php echo $customer->customer_mobile;?></td>
                                    <td>
                                        <button class="btn btn-outline-primary addtogroupbtnforsms" customer_id='<?php echo $customer->customer_id?>'>ADD</button>
                                    </td>
                                </tr>
                                    <?php endforeach;?>
                                 </center>

                                <?php endif;?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>


<div class="modal fade" id="group_sms_sectionmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white">SEND GROUP SMS</h4>
                <button class="btn btn-danger btn-sm" data-dismiss='modal'><i class="fa fa-close" aria-hidden='true'></i></button>
            </div>
            <div class="modal-body bg-dark text-white">
                <form method="POST" id="frmsms_group_message_section">
                    <div class="form-group">
                        <label for="SMS">Type message </label>
                        <textarea class="form-control" id="group_sms_contact_text" maxlength="150"></textarea>
                        <span class="text text-mute" id="letter_count_for_group_sms_text">0/150</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="SEND" class="form-control btn btn-block btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="group_id_hidden_id">

