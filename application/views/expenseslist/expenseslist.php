<script src="<?php echo base_url()?>assets/chequedetails.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
                 <div class="col-md-3">
                    FROM :
                    <input type="date" class="form-control" id="from_date_to_check_expenses">
                 </div>
                 <div>
                     TO :
                     <input type="date" class="form-control" id="to_date_to_check_expenses">
                 </div>
                 <div class="ml-4 mt-4">

                     <button class="btn btn-info btn-sm" id="search_expenses_list_btn_for_list">Search <i class="fa fa-search" aria-hidden='true'></i></button>
                 </div>

             </div>
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">

            </div>


            <div class="col-md-4 my-4">
                <input type="text" class="form-control" placeholder="Search..." id="searchexpensesType"> &nbsp; &nbsp;
                <button class="btn btn-info btn-sm btn-block" data-toggle='modal' data-target='#save_expense_list'>Save<i class="fa fa-save"></i></button>
            </div>

            <br><br>

            <div class="table table-responsive">
               <br>
               Total expenses : <span id="total_expenses_list" class="text text-danger font-weight-bold"></span>
               <br>
                <table class="table table-dark">
                    <thead>
                        <tr class="text text-center">
                            <th class="text text-center">#NO</th>
                            <th class="text text-center">Expenses type</th>
                            <th class="text text-center">Expenses date</th>
                            <th class="text text-center">Expenses amount</th>
                            <th class="text text-center">Expense Note</th>
                            <th class="text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="expensesListsection">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


     <!--Edit suppliers-->
<div class="modal fade" id="save_expense_list">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h4 class="modal-title">
                    Save expenses
                </h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="save_expneses_details_manually">
                    <label for="">Expense Type</label>
                    <select id="expense_type" class="form-control" required>
                    <?php if($expenses_type==0):?>
                    <option value="">--No expense type found--</option>
                    <?php else:?>
                                        <option value="">--Select expense type--</option>

                    <?php foreach($expenses_type as $expense):?>
                    <option value="<?php echo $expense->expense_typeid?>"><?php echo $expense->expense_name?></option>
                    <?php endforeach;?>
                   <?php endif?>
                    </select>

                    <div class="form-group">
                        <label for="expnese_date">expnese date</label>
                        <input type="date" class="form-control" id="expense_date">
                    </div>
                    <div class="form-group">
                        <label for="expense_amount">Expense Amount</label>
                        <input type="tel" class="form-control" id="expense_amount">
                    </div>
                    <div class="form-group">
                        <label for="expese_note">Expnese Note</label>
                        <textarea class="form-control" id="expense_note_for_list_out" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-success">Save &nbsp;<i class="fa fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="update_expense_list_modal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h4 class="modal-title">
                    Update expenses
                </h4>
                <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>
            </div>
            <div class="modal-body">
                <form method="POST" id="update_expense_details_manually">
                    <label for="">Expense Type</label>
                    <select id="uexpense_type" class="form-control" required>
                    <?php if($expenses_type==0):?>
                    <option value="">--No expense type found--</option>
                    <?php else:?>
                                        <option value="">--Select expense type--</option>

                    <?php foreach($expenses_type as $expense):?>
                    <option value="<?php echo $expense->expense_typeid?>"><?php echo $expense->expense_name?></option>
                    <?php endforeach;?>
                   <?php endif?>
                    </select>

                    <div class="form-group">
                        <label for="expnese_date">expnese date</label>
                        <input type="date" class="form-control" id="uexpense_date" required>
                    </div>
                    <div class="form-group">
                        <label for="expense_amount">Expense Amount</label>
                        <input type="tel" class="form-control" id="uexpense_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="expese_note">Expnese Note</label>
                        <textarea class="form-control" id="uexpense_note_for_list_out" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary">Update &nbsp;<i class="fa fa-refresh"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<input type="hidden" id="hidden_id_for_update">
