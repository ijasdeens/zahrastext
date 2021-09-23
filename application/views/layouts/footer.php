  <div class="modal fade" id='trigger_setTimesection'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
      <h4 class='modal-title'>Reminder (Days)</h4>

      <button class='btn btn-outline-danger btn-sm' data-dismiss='modal'>X</button>
       </div>
        <div class="modal-body">
          <form id='frm_remidner_save'>
            <div class="form-group">
              <label>Cheques</label>
              <input type='tel' value='0' id='cheques_reminder' class='form-control'/>
            </div>
            <div class="form-group">
             <label for="credit_reminder">Credits</label>
             <input type='tel' value='0' id='credits_reminder' class='form-control'/>
            </div>
             <div class="form-group">
             <label for="credit_reminder">Expire date</label>
             <input type='tel' value='0' id='expire_date_products' class='form-control'/>
            </div>
           <div class="form-group">
            <input type='submit' class='form-control btn btn-info' id='add' value='Save'/>
            </div>
          </form>
        </div>
    </div>
  </div>

  </div>

  <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Developed by Ijas deen (0758953142)</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
       <script src="<?php echo base_url();?>assets/general.js"></script>

    <!-- plugins:js -->
    <script src="<?php echo base_url();?>vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo base_url();?>vendors/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>vendors/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>vendors/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url();?>vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url();?>js/off-canvas.js"></script>
    <script src="<?php echo base_url();?>js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?php echo base_url();?>js/dashboard.js"></script>



    <!-- End custom js for this page -->
  </body>
</html>
