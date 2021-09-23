<script src="<?php echo base_url()?>assets/chequedetails.js"></script>
<div class="main-panel">
     <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addexpenses">ADD Expenses</button>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <input type="text" class="form-control" placeholder="Search..." id="searchexpensesType">
            </div>

            <div class="table table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr class="text text-center">
                            <th class="text text-center">#NO</th>
                            <th class="text text-center">Name</th>
                            <th class="text text-center">Status</th>
                            <th class="text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="expensesType">
                     <?php if($expensestypes=="0"):?>
                     <span class="text text-danger font-weight-bold">No data found</span>
                     <?php else:?>
                     <?php
                        $count =1;
                        ?>
                     <?php foreach($expensestypes as $expense):?>
                     <tr class="text text-center">
                         <td><?php echo $count++;?></td>
                         <td>
                             <?php echo $expense->expense_name?>
                         </td>
                         <td>
                            <?php
                             if($expense->outlet_on_status==0){
                                 ?>
                                    <span class="badge badge-danger">Unavailable for Branches</span>
                                 <?php
                             }
                             else {
                                 ?>
                                  <span class="badge badge-success">Available for branches</span>
                                 <?php
                             }
                             ?>
                         </td>
                         <td>
                         <button class="btn btn-outline-info editexpenses_details btn-sm" expenseId="<?php echo $expense->expense_typeid?>"><i class="fa fa-edit"></i></button>
                             <button class="btn btn-outline-danger btn-sm deleteexpenses_details" expenseId="<?php echo $expense->expense_typeid?>">
                                 <i class="fa fa-trash" aria-hidden="true"></i>
                             </button>
                             <?php
                                if($expense->outlet_on_status==0){
                                    ?>
                                       <button class="btn btn-outline-success enable_for_outlet btn-sm" expenseId="<?php echo $expense->expense_typeid?>">
                                Enable <i class="fa fa-arrow-up"></i>
                             </button>
                                    <?php

                                }
                             else {
                                 ?>
                                    <button class="btn btn-outline-primary disable_for_outlet btn-sm" expenseId="<?php echo $expense->expense_typeid?>">
                                Disabled <i class="fa fa-arrow-down"></i>
                             </button>
                                 <?php

                             }
                             ?>

                         </td>
                     </tr>
                     <?php endforeach;?>
                     <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addexpenses">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body bg-dark text-white">
                    <form method="POST" id="frmexpensesType">
                        <div class="form-group">
                            <label>Expenses Type</label>
                            <input type="text" class="form-control" required id="expensesName" autofocus>
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

