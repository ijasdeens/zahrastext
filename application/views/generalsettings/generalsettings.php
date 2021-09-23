<script src="<?php echo base_url()?>assets/generalsetting.js"></script>
   <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
             <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Product quantity alert</h4>
                     </div>
                     <hr>
                     <div class="card-body bg-dark text-white">
                        <form method="POST" id="alert_quantity_frm">
                            <div class="form-group">
                                <label for="alert_quantity_for_outlets">Alert quantity for outlets</label>
                                <input type="tel" class="form-control" id="alert_quantity_for_outlets_text" value="<?php echo $alert_quantity?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">SAVE</button>
                            </div>
                        </form>
                     </div>
                 </div>
            </div>
           <br>
           
           <br>

           <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Days before from expire date to remind for products at warehouse</h4>
                     </div>
                     <hr>
                     <div class="card-body bg-dark text-white">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="">How many days ago for warehouse products expire</label><br>
                                    <span>(DAYS)</span>
                                    <input type="tel" class='form-control' id='days_forexpirecounter' value='0'>
                                </div>
                                 
                            </div>
                            <br>
                            <button class='btn btn-block btn-success' id='update_products_expiredatesystembtn'>UPDATE</button>
                        </div>
                     </div>
                 </div>
            </div>

           <br>
           
           <br>
           <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Privillages for cashiers</h4>
                         <br>
                         NOTE :<span class='form-text text-info font-weight-bold'>If you disable any of following privillage, that will be hidden from cashier panel and cashier will not be able to access that</span>
                     </div>
                     <hr>
                     <div class="card-body bg-dark text-white">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="">Warehouse running out products reminder</label><br>
                                  
                                    <br>
                                     <select class='form-control' id='warehouse_pr_reminder'>
                                         <option value="1">Enable</option>
                                         <option value="0">Disable</option>
                                     </select>
                                </div>
                                <div class="col">
                                    <label for="">Expiry date reminder</label><br>
                                   
                                    <br>
                                     <select class='form-control' id='warehouse_exp_reminder_section'>
                                         <option value="1">Enable</option>
                                         <option value="0">Disable</option>
                                     </select>
                                </div>
                                <div class="col">
                                    <label for="">VIEW SALES SUMMERY</label><br>
                                   
                                    <br>
                                     <select class='form-control' id='sales_summmery_viewer'>
                                         <option value="1">Enable</option>
                                         <option value="0">Disable</option>
                                     </select>
                                </div>
                                
                                 
                                 
                            </div>
                            <div class="row">
                            <div class="col mt-4">
                                    <label for="">VIEW SALES SECTION</label><br>
                                 
                                    <br>
                                     <select class='form-control' id='sales_section_reminder'>
                                         <option value="1">Enable</option>
                                         <option value="0">Disable</option>
                                     </select>
                                </div>
                               
                                 </div>
                            

                            <br>
                            <button class='btn btn-block btn-success' id='update_privillagesforcashier'>UPDATE</button>
                        </div>
                     </div>
                 </div>
            </div>

           <br>
           <br>

           <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">Privillages for cheques</h4>
                         <br>
                        
                     </div>
                     <hr/>
                     <div class="card-body bg-dark text-white">
                        <div class="container">
                            <form id='cheque_details_privillagesform' method='POST'>
                                <div class="form-group">
                                    <label for="cheques">How many days ago since chque date ( in Days)</label>
                                    <br>
                                    
                                    <input type="tel" class='form-control' id='chque_date_remindersection' value='0'>
                                </div>
                                <div class="form-group">
                                    <label for="showofftofront">SHOW SUPPLIER CHECK DETAILS IN CASHIER</label>
                                    <select id="showchqueetailsincashier" class='form-control'>
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="showofftofront">SHOW CHECKS BY ADMIN IN CASHIER</label>
                                    <select id="showcheckbyadminincashier" class='form-control'>
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>

                                
                                <div class="form-group">
                                    <input type="submit" class='form-control btn btn-success' id='cheque_date_remindersavebutton' value='Update'>
                                </div>
                            </form>
                        </div>
                
                     </div>
                 </div>
            </div>

           <br>
           <br>



            <div class="col-12 stretch-card grid-margin">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="text text-danger">General settings</h4>
                     </div>
                     <hr>
                     <div class="card-body bg-dark text-white">
                      <center>
                    <?php if($logo==''):?>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/600px-No_image_available.svg.png" alt="alter_mind_section" class='img-fluid' style="max-width:100px; max-height:200px;">
                     <?php else:?>
                     <img src="<?php echo base_url()?>assets/logoimage/<?php echo $logo?>" alt="alter_mind_section" class='img-fluid' style="max-width:100px; max-height:200px;">
                     <?php endif;?>

                      </center>
                      <div class="container">
                           <div class="row">
                              <div class="col-md-12">
                       <form method="POST" id="frm_general_settings_update_section">
                                  <div class="form-group">
                                     <label for="company_name">Company Name</label>
                                     <input type="text" class="form-control" id="company_name" value="<?php echo $company_name;?>">
                                 </div>
                                 <div class="form-group">
                                     <label for="logo_img">Logo</label>
                                     <input type="file" class="form-control" id="logo_img">
                                 </div>
                                <div class="form-group">
                                      <label for="company_address">Company address</label>
                                     <input type="text" class="form-control" id="company_address" value="<?php echo $company_address?>">
                                 </div>
                             <div class="form-group">
                                      <label for="hotline_number">Main hotline Number</label>
                                     <input type="tel" class="form-control" id="hotline_number" value="<?php echo $main_hotline_number?>">
                                 </div>
                                 <div class="form-group">
                                   <button type="button" class="form-control btn btn-primary" id=save_general_setting_name>SAVE</button>
                                </div>

                             </form>
                          </div>
                           </div>
                      </div>
                     </div>
                 </div>
            </div>


        </div>

    </div>




    <!--Edit suppliers-->
