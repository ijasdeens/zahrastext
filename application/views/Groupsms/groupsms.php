
    <div class="main-panel">

    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Create Group sms</h4>

                     </div>
                     <hr>
                     <div class="card-body">
                      <div class="container">
                            <div class="row">
                             <div class="table table-responsive">
                                 <table class="table table-dark">
                                     <thead>
                                         <tr class="text text-center">
                                              <th>#NO</th>
                                             <th>Customer name</th>
                                             <th>Mobile NO</th>
                                                <th>Action</th>
                                                 </tr>
                                     </thead>
                                     <tbody id="send_sms_for_customer">
                                        <?php
                                         $count = 0;
                                         if($customer_details!=0):?>
                                        <?php foreach($customer_details as $customer):?>
                                        <tr class="text text-center">
                                            <td><?php echo ++$count;?></td>
                                            <td><?php echo $customer->customer_name;?></td>
                                            <td><?php echo $customer->customer_mobile?></td>
                                            <td>
                                                    <div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Group name
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <?php if($group_details!=0):?>
   <?php foreach($group_details as $details):?>
    <a class="dropdown-item add_to_group" href="#" customer_id='<?php echo $customer->customer_id?>' group_id="<?php echo $details->groups_id?>">
    <?php
echo $details->groups_name;
if($details->group_id_fk!=''){
    if($details->group_id_fk==$details->groups_id && $details->customer_id==$customer->customer_id){
        echo '&nbsp;<span class="text text-white p-1">✔️</span>';
    }
}

        ?>
<!---->
    </a>
   <?php endforeach;?>

   <?php endif?>

  </div>
</div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                        <?php else:?>
                                        <tr>
                                            <td><span class="text text-danger font-weight-bold">No data found</span></td>
                                        </tr>
                                        <?php endif;?>
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




    <!--Edit suppliers-->
<div class="modal fade" id="exampleModal" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    SEND SMS
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmsendsms">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" id="message_to_message" maxlength="150"></textarea>
                            <span class="text text-white" id="letter_count">0</span>/150
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success btn-sm" value="SEND">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--    Single SMS send modal-->


<div class="modal fade" id="singlsendsmsModal" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    SEND SMS
                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="singlesmssendfrm">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" id="single_message_to_message" maxlength="150"></textarea>
                            <span class="text text-white" id="single_letter_count">0</span>/150
                        </div>
                     <div class="form-group">
                            <input type="submit" class="form-control btn btn-success btn-sm" value="SEND">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

