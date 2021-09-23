<script src="<?php echo base_url()?>assets/sendsmscustomers.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">SMS HISTORY</h4>
                       
                         <div class="my-2">
                             <div class="container">
                                 <div class="row">
                                     <div class="col">
                                         FROM 
                                         <input type="date" class='form-control' id='from_date_for_search_ssm'>
                                     </div>
                                     <div class="col">
                                         TO 
                                         <input type="date" class='form-control' id='to_date_for_search_ssm'>
                                     </div>
                                     <div class="col">
                                         <br>
                                         <button class='btn btn-primary' id='search_sms_history'>
                                           Search  <i class='fa fa-search' aria-hidden='true'></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>

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
                                             <th>Sent Message</th>
                                             <th>Mobile</th>
                                             <th>SMS status</th>
                                             <th>SMS date and time</th>
                                          
                                        </tr>
                                     </thead>
                                     <tbody id="smshistory_section">
                                      
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


 
