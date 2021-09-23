<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lankan POS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />

   </head>
  <body>
   <input type="hidden" id="base_url" value="<?php echo base_url()?>">
   <input type="hidden" id="hidden_id">
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
           <a class="navbar-brand brand-logo-mini" href="<?php echo base_url();?>"><img src="#" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">
            </h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">

            <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center" id="requested_product_details">
              <a class="nav-link d-flex align-items-center" data-toggle='modal' data-target='#requested_product_details_modal' style="cursor:pointer;">
                <div class="d-inline-flex mr-1">
                   <img src="https://www.flaticon.com/premium-icon/icons/svg/2956/2956820.svg" class="img-fluid" style="width:40px;height:40px;">
                </div>
                <span class="profile-text font-weight-normal badge badge-info">
                    <?php echo $requested_product===0 ? 0 : count($requested_product) ?>
                </span>
              </a>
             </li>
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="<?php echo base_url()?>images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> <?php echo $this->session->staff_name?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo base_url()?>images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3"><?php echo $this->session->staff_name?></p>

                </div>
                <a class="dropdown-item" data-toggle="modal" data-target="#myprofilemodal"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                 <a class="dropdown-item" data-toggle="modal"data-target="#changePasswordstaff"><i class="dropdown-item-icon icon-energy text-primary"></i> Change password</a>

                <a class="dropdown-item" id="signoutsection"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
            </li>
          </ul>




          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">

            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="<?php echo base_url()?>images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $this->session->staff_name?></p>
                  <p class="designation"><?php echo $this->session->responsibility?></p>
                </div>
                <div class="icon-container">
                  <i class="icon-bubbles"></i>
                  <div class="dot-indicator bg-danger"></div>
                </div>
              </a>
            </li>

            <li class="nav-item nav-category"><span class="nav-link">Products</span></li>

         <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Products section</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Controllerunit/addproducts">
                <span class="menu-title">ADD PRODUCTS</span>

              </a>
            </li>
                  <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Controllerunit/viewproducts">
                <span class="menu-title">View products</span>

              </a>
            </li>

                      <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Controllerunit/requestedproductlist">
                <span class="menu-title">Requested products</span>

              </a>
            </li>
                 </li>
                  <li class="nav-item">
              <a class="nav-link" href="#" onclick='alert("Barcode will be hosted as soon as it is hosted to server")'>
                <span class="menu-title">Print barcodes</span>

              </a>
            </li>


                </ul>
              </div>
            </li>




          </ul>
        </nav>


      <div class="modal fade" id="myprofilemodal">
          <div class="modal-dialog">
              <div class="modal-content bg-dark text-white">
                  <div class="modal-header">
                  <h4 class="text text-danger">Change profile section</h4>
                  </div>
                  <div class="modal-body">
                        <form method="POST" id="frmprofilesection">
                        <div class="form-group">
                            <input type="text" class="form-control" id="person_name" placeholder="Enter your name here" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" id="person_tel" placeholder="Enter your mobile number here" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-block btn-outline-info" value="SAVE">
                        </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="changePasswordstaff">
          <div class="modal-dialog">
              <div class="modal-content bg-dark text-white">
                  <div class="modal-header">
                  <h4 class="text text-danger">Change Password</h4>
                  </div>
                  <div class="modal-body">
                        <form method="POST" id="frmchangepassword">
                        <div class="form-group">
                        <label>Current password</label>
                            <input type="password" class="form-control" id="current_password">
                        </div>
                        <div class="form-group">
                         <label>New password</label>
                            <input type="password" class="form-control" id="new_password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-block btn-outline-info" value="SAVE">
                        </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade" id="requested_product_details_modal">
          <div class="modal-dialog modal-lg">
              <div class="modal-content bg-dark text-white">
                  <div class="modal-header">
                  <h4 class="text text-danger">Requested products</h4>
                  <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-bordered text-white">
                        <thead>
                            <tr class="text text-center">
                                <th>#NO</th>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Requested quantity</th>
                                 <th>Brand</th>
                                  <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php if($requested_product!=0):?>
                            <?php  $count=1;?>
                            <?php foreach($requested_product as $product):?>
                            <tr class="text text-center">
                                <td><?php echo $count++;?></td>
                                <td><?php echo $product->product_name?></td>
                                <td><?php echo $product->products_code?></td>
                                <td><?php echo $product->request_quantity?></td>
                                <td><?php echo $product->brands_name?></td>
                                <td><?php echo $product->status?></td>
                                <td>
                                    <button class="btn btn-info change_status_from_wr" warehouse_id='<?php echo $product->warehouse_req_pr_id?>'>Accepted</button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php else:?>
                            <tr>
                                <td>
                                    <span class="text text-danger font-weight-bold">NO DATA FOUND</span>
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
