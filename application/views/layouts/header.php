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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                    <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">
                        <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-3">

                            </div>
                            <span class="profile-text font-weight-normal">Suppliers / Warehouse</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                            <a class="dropdown-item" href="<?php echo base_url()?>Controllerunit/Suppliers">
                   Suppliers </a>
                            <a class="dropdown-item" href="<?php echo base_url()?>Controllerunit/warehouse">
                   Warehouse </a>
                         </div>
                        &nbsp;
                        <button class='btn btn-outline-info btn-sm d-none' data-toggle='modal' data-target='#trigger_setTimesection'>Set time
                        <img src="https://www.flaticon.com/svg/static/icons/svg/850/850960.svg" alt="timer_image" style="max-height:25px; max-width:25px;">
                        </button>
                        </li>
                         <div class="ml-3 d-none">
                             SMS BALANCE : <span class='text text-danger font-weight-bold' id='sms_balance_count'>3</span>
                         </div>
                </h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <li class="nav-item d-none"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
                    <li class="nav-item"><a href="<?php echo base_url()?>" class="nav-link"><i class="icon-chart"></i></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="icon-speech"></i>
                 <span class="badge badge-pill badge-danger" id="ranoutproductcount">0</span>
              </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3" href="<?php echo base_url()?>Controllerunit/viewunavailabilityproducts">
                                <p class="mb-0 font-weight-medium float-left">Warehouse Messages </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <div id="print_dec_qty_pr_section">
                             </div>

                        </div>
                    </li>

<!--
                    <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">
                        <a class="nav-link d-flex align-items-center dropdown-toggle d-none" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-3">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <span class="profile-text font-weight-normal d-none">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2 d-none" aria-labelledby="LanguageDropdown">
                            <a class="dropdown-item">
                  <i class="flag-icon flag-icon-us"></i> English </a>
                            <a class="dropdown-item">
                  <i class="flag-icon flag-icon-fr"></i> French </a>
                            <a class="dropdown-item">
                  <i class="flag-icon flag-icon-ae"></i> Arabic </a>
                            <a class="dropdown-item">
                  <i class="flag-icon flag-icon-ru"></i> Russian </a>
                        </div>
                    </li>
-->


                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="<?php echo base_url()?>images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal admin_name"> Henry Klein </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="<?php echo base_url()?>images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 admin_name">Ijas deen</p>
                                <p class="font-weight-light text-muted mb-0 admin_email"></p>
                            </div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#profileModal"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>

                            <a class="dropdown-item" data-toggle="modal" data-target="#changePasswordmodal"><i class="dropdown-item-icon icon-energy text-primary"></i> Change password</a>

                            <a class="dropdown-item" id="mainlogoutbtn"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
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
                                <p class="profile-name admin_name"></p>
                                <p class="designation">MAIN ADMIN</p>
                            </div>
                            <div class="icon-container">
                                <i class="icon-bubbles"></i>
                                <div class="dot-indicator bg-danger"></div>
                            </div>
                        </a>
                    </li>

     <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    <li class="nav-item nav-category">
                        <span class="nav-link">Dashboard&nbsp;<i class="fa fa-angle-double-down"></i></span>
                    </li>
  </a>



                    <div class="collapse" id="collapseExample">
  <div class="">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
  </div>
</div>







                     <a class="" data-toggle="collapse" href="#collapseproducts" role="button" aria-expanded="false" aria-controls="collapseExample">
      <li class="nav-item nav-category"><span class="nav-link">Products &nbsp;<i class="fa fa-angle-double-down" aria-hidden="true"></i></span> </li>

           </a>

                <div class="collapse" id="collapseproducts">
                        <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/addbrands">
                <span class="menu-title">ADD BRANDS</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/addcategories">
                <span class="menu-title">ADD Categories</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/subcategory">
                <span class="menu-title">ADD Sub categories</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>


                </div>


<!--                    People-->


                     <a class="" data-toggle="collapse" href="#peoplecollapsesection" role="button" aria-expanded="false" aria-controls="collapseExample">
        <li class="nav-item nav-category"><span class="nav-link">People&nbsp; <i class="fa fa-angle-double-down"></i></span></li>

           </a>
                    <div class="collapse" id="peoplecollapsesection">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/customerbase">
                <span class="menu-title">ADD CUSTOMERS</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/staffbase">
                <span class="menu-title">ADD STAFFS</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                    </div>





<!--                    ADD PEOPLE-->



                     <a class="" data-toggle="collapse" href="#outletcollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
           <li class="nav-item nav-category"><span class="nav-link">Outlets &nbsp;<i class="fa fa-angle-double-down"></i></span></li>
           </a>


                    <div class="collapse" id="outletcollapse">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/createoutlets">
                <span class="menu-title">Create outlets</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/productsinoutlets">
                <span class="menu-title">Products in outlets</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                    </div>

                      <a class="" data-toggle="collapse" href="#expensescollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                               <li class="nav-item nav-category"><span class="nav-link">Expenses&nbsp; <i class="fa fa-angle-double-down"></i></span></li>
                      </a>

                   <div class="collapse" id="expensescollapse">
                         <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/expensetype">
                <span class="menu-title">Expense type</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/expensesList">
                <span class="menu-title">Expenses List</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                   </div>


                 <a class="" data-toggle="collapse" href="#settingsCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                               <li class="nav-item nav-category"><span class="nav-link">Settings&nbsp; <i class="fa fa-angle-double-down"></i></span></li>
                      </a>
                <div class="collapse" id="settingsCollapse">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/gotosetting">
                <span class="menu-title">General settings</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                </div>


                   <a class="" data-toggle="collapse" href="#accountscollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                               <li class="nav-item nav-category"><span class="nav-link">Accounts&nbsp; <i class="fa fa-angle-double-down"></i></span></li>
                      </a>
                    <div class="collapse" id="accountscollapse">
                           <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/chequedetails">
                <span class="menu-title">Cheque Details</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/chequesbyadmin">
                <span class="menu-title">Cheques by admin</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                 <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/bankaccounts">
                <span class="menu-title">Bank accounts</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/cashflowledger">
                <span class="menu-title">Cash flow ledger</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/suppliercheckdetails">
                <span class="menu-title">Cheques for supplier</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>


                 <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/maintaincheques">
                <span class="menu-title">Supplier cheques</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>


                    </div>

             <a class="" data-toggle="collapse" href="#stockreportsection" role="button" aria-expanded="false" aria-controls="collapseExample">
                               <li class="nav-item nav-category"><span class="nav-link">Reports&nbsp; <i class="fa fa-angle-double-down"></i></span></li>
                      </a>

                    <div class="collapse" id="stockreportsection">
                       <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/outletreports">
                <span class="menu-title">Outlet Stock report</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/salesreports">
                <span class="menu-title">Outlet wise Sales report</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/Warehousereportsection">
                <span class="menu-title">Warehouse</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>



                    </div>

                      <a class="" data-toggle="collapse" href="#smssectionsection" role="button" aria-expanded="false" aria-controls="collapseExample">
                               <li class="nav-item nav-category"><span class="nav-link">sms&nbsp; <i class="fa fa-angle-double-down"></i></span></li>
                      </a>

                        <div class="collapse" id="smssectionsection">

                 <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/sendsmstocustomer">
                <span class="menu-title">SEND SMS</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                  <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/creategroups">
                <span class="menu-title">Create Group</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                    
                  <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/smshistory">
                <span class="menu-title">SMS history</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                        </div>


                   <a class="" data-toggle="collapse" href="#customer_display_adscollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
              <li class="nav-item nav-category"><span class="nav-link">Customer display ads &nbsp;<i class="fa fa-angle-double-down"></i></span></li>

                      </a>

                      <div class="collapse" id="customer_display_adscollapse">
                               <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/savecustomerdisplayads">
                <span class="menu-title">All ads</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>


                      </div>


    <a class="" data-toggle="collapse" href="#returnpurcahsedetailscollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
              <li class="nav-item nav-category"><span class="nav-link">Return / purcahse details &nbsp;<i class="fa fa-angle-double-down"></i></span></li>

                      </a>

                    <div class="collapse" id="returnpurcahsedetailscollapse">
                             <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/getpurchasedetails">
                <span class="menu-title">Purcahse Details</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>
                          <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/returndetails">
                <span class="menu-title">Return details</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url()?>Controllerunit/reportsofsupplierdetails">
                <span class="menu-title">Supplier report</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
                    </li>



                    </div>




                     </ul>

             </nav>

            <div class="modal fade" id="profileModal">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h4 class="text text-danger">PROFILE SECTION</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="frmProfile">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="admin_name" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="tel" class="form-control" id="admin_tel" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <label>Gmail</label>
                                    <input type="email" class="form-control" id="admin_email" placeholder="Enter your email here">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-success form-control btn-block">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="changePasswordmodal">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h4 class="text text-danger">Change password SECTION</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="frmchangepassword">
                                <div class="form-group">
                                    <label>Current password</label>
                                    <input type="password" class="form-control" id="current_password" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <label>New password</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="Enter your name" required>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-outline-info form-control btn-block">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

             <div class="modal fade" id="addexpensesListmodal">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h4 class="text text-danger font-weight-bold">
                                ADD EXPENSES
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="frmaddexpenses">
                                <div class="form-group">
                                    <label for="expenses">Expenses Type</label>
                                    <select id="expenses_type" class="form-control">
                               </select>
                                </div>

                                <div class="form-group">
                                    <label for="expenses">Expense Amount</label>
                                    <input type="tel" id="expense_amout" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenses">Date of expense</label>
                                    <input type="date" id="date_of_expense" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="expenseNote">Expense Note</label>
                                    <textarea class="form-control" id="expense_note" maxlength="490" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="form-control" value="Save expenses">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


