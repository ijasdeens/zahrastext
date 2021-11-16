<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <title>Point of sale</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>assets_ss/images/logos/squanchy.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url()?>assets_ss/images/logos/squanchy.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url()?>assets_ss/images/logos/squanchy.jpg">
    <!-- jQuery -->
    <!-- Bootstrap4 files-->
    <link href="<?php echo base_url()?>assets_ss/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets_ss/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets_ss/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets_ss/css/OverlayScrollbars.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    <!-- Font awesome 5 -->
    <style>
     
        .avatar {
            vertical-align: middle;
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .bg-default,
        .btn-default {
            background-color: #f2f3f8;
        }

        .btn-error {
            color: #ef5f5f;
        }


        .project-tab {
    padding: 10%;
    margin-top: -8%;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
}

#footer_section_elipline{
    position: fixed;
   left: 0;
  
   height: 45px;
   bottom: 0;
   width: 100%;
   background-color: white;
   box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
   text-align: center;
   z-index: 99;


        }


    </style>

    <style>


    </style>
    <!-- custom style -->
</head>
 
 

<body class="drawer drawer--right">
<header role="banner">
    <button type="button" class="drawer-toggle drawer-hamburger d-none">
      <span class="sr-only">toggle navigation</span>
      <span class="drawer-hamburger-icon"></span>
    </button>
    <nav class="drawer-nav" role="navigation">
      <ul class="drawer-menu justify-content-center text-center">
        <li><a class="drawer-brand" href="#">payment method&nbsp;<img src="https://image.flaticon.com/icons/png/512/1019/1019607.png" style="max-width:20px; max-height:20px;"></a></li>
        <li><a class="" href="javascript:void(0);" data-toggle='modal' data-target='#paywithCheque'>
        <img src="https://image.flaticon.com/icons/png/512/2693/2693286.png" style="max-width:100px; max-height:100px;"> <br/>
        <h4>Pay by Cheque</h4>
        </a></li>
        <br>
        <li><a class="" href="javascript:void(0);" data-toggle='modal' data-target='#paywithcashmodal'>
        <img src="https://image.flaticon.com/icons/png/512/639/639365.png" style="max-width:100px; max-height:100px;"> <br/>
        <h4>Pay with Cash </h4>
        </a></li>
        <br>
        <li><a class="" href="#" id='credit_details_for_saveing'>
        <img src="https://image.flaticon.com/icons/png/512/712/712772.png" style="max-width:100px; max-height:100px;"> <br/>
        <h4>Credit</h4>
        </a></li>
      </ul>
    </nav>
  </header>
  <main role="main">
    <!-- Page content -->

  </main>

     <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        <img class="logo" src="<?php echo base_url()?>assets/logoimage/<?php echo $this->session->logo?>" class="img-fluid w-100 h-100">
                        <h2 class="logo-text">
                            Outlet Name :
                            <?php echo $this->session->outlets_name?>
                        </h2>
                         
                        <div class="row mt-2">
                          <div class="col">
                              
                        <?php if($warehouse_productsreminder_privillage==1):?>
                        <label></label>
                        <a href="#warehousefinishingproductmodal" data-toggle='modal' class='btn btn-warning m-btn m-btn--icon m-btn--icon-only'>
                            <i class='fa fa-bell'></i>Warehouse &nbsp; <span class='font-weight-bold badge badge-danger' id='show_unmuted_count_section'>0</span>
                        </a>
                        <?php endif;?>
                    </div>
                      
                   
                    <div class="col mt-4">
                    <?php if($expire_date_reminder_privillage==1):?>
                        <a href="#getexpireddetailsmodal" data-toggle='modal' class='btn btn-warning m-btn m-btn--icon m-btn--icon-only'>
                            <i class='fa fa-bell'></i>Expiry &nbsp; <span class="font-weight-bold badge badge-danger" id='expired_date_count'>0</span>
                        </a>
                        <?php endif;?>
                    </div>
                        </div>
                      

                    </div>

                    <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-6">
                    <form action="#" class="search-wrap">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search by product name" id="product_search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                            </div>
                        </div>
                    </form>
                    <!-- search-wrap .end// -->

                </div>
                <!-- col.// willback-->
                
                <div class="col-lg-3 col-sm-6">
                    <div class="widgets-wrap d-flex justify-content-end">
                    <div class="widget-header" title='Products which have run out of'>

                            <a href="#" class="icontext">
                    <a href="#showrunningoutproducts" data-toggle='modal' class="btn btn-warning m-btn m-btn--icon m-btn--icon-only">
                     <i class="fa fa-bell"></i>&nbsp;<span class="badge badge-danger">
                     <?php echo $getproductsforreminder==0 ? 0 :  count($getproductsforreminder)?>

                     </span>
                                 </a>
                            </a>
                        </div>

                        <div class="widget-header">
                            <a href="#" class="icontext">
                    <a href="#holdamountforcustomer" data-toggle='modal' class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                     <i class="fa fa-shopping-cart"></i>&nbsp;<span class="badge badge-danger"><?php echo $holdingproducts?></span>
                                                        </a>
                            </a>
                        </div>
                        <!-- widget .// -->

                        <div class="widget-header dropdown">
                            <a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
                            <small>Hello  <?php echo $this->session->staffname;?></small>&nbsp;
                    <img src="<?php echo base_url()?>assets_ss/images/avatars/bshbsh.png" class="avatar" alt="">

                </a>

                            <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#userchangepasswordmodal" data-toggle='modal'><i class="fa fa-lock"></i> Change password</a>
                                <a class="dropdown-item" id='logout_section' href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
                             </div>
                            <!--  dropdown-menu .// -->
                            <br/>
                            <br/>

                        </div>
                        <!-- widget  dropdown.// -->
                    </div>
                    <!-- widgets-wrap.// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->

            <div class="row my-2">
                <div class="col-md-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex flex-row">
                                    <div class="p-2">
                                        Customer type :
                                    </div>
                                    <div class="p-2">
                                        <select name="customer_type_select" id="customer_typeselect">
                                            <option value="walkin">Walk in customer</option>
                                            <option value="chosencustomer">Choosen customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2 d-none" id="customer_tag">Customer</div>
                        <div class="p-2 d-none" id="customertypechosensection">
                            <div class="input-group">
                                <input type="tel" class="form-control" placeholder="Search by mobile number" id="mobilenumberforcutomersearch">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-round btn-lg" data-toggle='modal' data-target='#addcustomersection'>
                    <i class="fa fa-plus"></i>
                  </button> &nbsp; <button class="btn btn-link d-none" data-toggle='modal' data-target='#view_details_section'><u><small>VIEW DETAILS</small></u></button>
                                </div>
                            </div>
                            <span class="text" id="messagesectionoffound"></span>
                            <div>
                                Name : <span class="font-weight-bold text-danger" id='customer_name_text'></span> <br>
                                Address : <span class="font-weight-bold text-danger" id='customer_address_text'></span> <br>
                                Credit : <span class="font-weight-bold text-danger" id='customer_credit_liner'></span>
                                
                            </div>
                        </div>


 
                      </div>
 <div class="float-left">
                    <span class='text text-danger font-weight-bold' id='full_time'></span>
                    </div> <br><br>
                    <div class="float-left">
                            <button class="btn btn-primary btn-sm" data-toggle='modal' data-target='#returnproductModal'>Return products <i class="fa fa-undo-alt"></i></button>

                    </div>
                    <div class="float-left">
                        
                        <div class="dropdown ml-2">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Expenses
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#expense_list_section" data-toggle='modal'> <i class="fa fa-money-bill-alt" aria-hidden="true"></i>&nbsp;ADD EXPENSES</a>
    <a class="dropdown-item" href="#showexpenses" data-toggle='modal'> <i class='fa fa-eye'></i> Show Expenses</a>
 
  </div>
</div>


                    </div>
                    
                    <div class="float-right" style="right:0;position:absolute;">


</div>
        

                </div>
                <div class="col-md-3">
             <div class="input-group">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default bg-secondary text-white btn-flat" data-toggle="modal" readonly data-target="#configure_search_modal"><i class="fa fa-barcode"></i></button>
                </div>
                <input class="form-control" id="search_by_barcode" placeholder="Scan barcode here" type="text" autocomplete="off" style="border-color:green;border-width:4px;">
                <span class="input-group-btn">
                 </span>
            </div>
                  </div>
                <div class="col">
                     <a href="<?php echo base_url()?>Controllerunit/salescustomerdisplay" class="form-control btn btn-info" target="_blank">Customer display <i class="fa fa-desktop"></i></a>
                </div><div class="col">
                     <a href="javascript:void(0)" class="form-control btn btn-primary" id="generate_report_for_admin">SEND REPORT TO ADMIN <i class=""></i></a>
                </div>
                
                <div class="col">
                    <button class='btn btn-info btn-sm' id='trigger_initial_payment'>Initial payment <i class="fa fa-money-bill-alt" aria-hidden='true'></i></button>
                </div>
              
                <div class="col">
                <?php if($view_salessummery_privillage==1):?>
                <button class="btn btn-block my-2 btn-success" id='view_all_sales_from_cashier'>View details</button>
                <?php endif;?>
            </div>
               
                 
                
                <div class="col">
                <?php if($view_salesection_privillage==1):?>
                <button class="btn btn-block my-2 btn-success" id='VIEW_ALL_SALES_DETAILS_BY_FRONT' data-toggle='modal' data-target='#modal_section_modal'>
                    SALES SECTION
                </button>
                <?php endif;?>
                </div>
                          
                <div class="col">
                <?php if($chequeshowcashier==1):?>
                <button class="btn btn-block my-2 btn-warning" data-toggle='modal' data-target='#supplier_cheques_details_modal'>
                   Supplier Check details <i class="fa fa-money-bill-alt"></i>&nbsp; 
                    <span class="badge badge-danger" id='check_details_count_for_moving'>0</span>
                </button>
                <?php endif;?>
                </div>

                <div class="col">
                <?php if($admin_check_show==1):?>
                <button class="btn btn-block my-2 btn-warning" data-toggle='modal' data-target='#checks_by_admin_modal'>
                  Cheques by admin <i class="fa fa-money-bill-alt"></i>&nbsp; 
                    <span class="badge badge-danger" id='checks_by_admin_count'>0</span>
                </button>
                <?php endif;?>
                </div>
                
            </div>
        
          
        </div>
        <!-- container.// -->
    </section>
    <!-- ========================= SECTION CONTENT ========================= -->

    <div class="modal fade" id='checks_by_admin_modal'>
        <div class="modal-dialog modal-lg">
            <div class="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text text-danger font-weight-bold">Cheques by admin</h4>
                    <button class='btn btn-sm btn-outline-danger' data-dismiss='modal'>X</button>
                    
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                       <label for="from_date_by_admin">FROM :</label>
                                       <input type="date" class='form-control' id='from_date_by_admin'>
                                    </div>
                                    <div class="col">
                                        <label for="to_date_by_admin">TO :</label>
                                        <input type="date" class='form-control' id='to_date_by_admin'>
                                    </div>
                                    <div class="col">
                               <label for="status">Status</label>
                               <select name="status_check" id="status_to_date_for_supplierchecks_byadmin" class='form-control'>
                                <option value="">--Select one--</option>
                                <option value="pending">Pending</option>
                                <option value="bounce">Bounced</option>
                                <option value="completed">Completed</option>
                               </select>
                            </div>
                                    <div class="col">
                                        <br>    
                                        <button class='btn btn-info my-2' id='searchforadmin_area_bycheck'>Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table table-responsive">
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>#NO</th>
                                        <th>Customer name</th>
                                        <th>Check amount</th>
                                        <th>Check status</th>
                                        <th>Bank name</th>
                                        <th>Branch name</th>
                                        <th>Check date</th>
                                        <th>Check amount</th>
                                        <th>Check number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id='checks_by_admin_section_print'>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            

    <div class="modal fade" id='supplier_cheques_details_modal'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class='text text-danger font-weight-bold'>Supplier checks</h4>
                    <button class='btn btn-sm btn-outline-danger' data-dismiss='modal'>X</button>
                </div>
                <div class="modal-body">
                    <div class='container my-2'>
                        <div class="row">
                            <div class="col">
                                <label for="From">From</label>
                                <input type="date" class='form-control' id='form_date_for_supplierchecks'>
                            </div>
                            <div class="col">
                                <label for="to">To</label>
                                <input type="date" class='form-control' id='to_date_for_supplierchecks'>
                            </div>
                            <div class="col">
                               <label for="status">Status</label>
                               <select name="status_check" id="status_to_date_for_supplierchecks" class='form-control'>
                                <option value="">--Select one--</option>
                                <option value="pending">Pending</option>
                                <option value="bounce">Bounced</option>
                                <option value="completed">Completed</option>
                               </select>
                            </div>
                            <div class="col">
                                <br>
                              
                                <button id='search_supplier_checks' class='form-control btn btn-primary my-2'>Search <i class='fa fa-search' aria-hidden='true'></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="container my-2">
                        <div class="row">
                            <div class="col-md-12">
                                <span class='text text-danger font-weight-bold'>Total amount of completed checks :</span> &nbsp; <span id='total_completed_amount'>Rs.0.00</span>
                            </div>
                            <div class="col-md-12">
                                <span class='text text-primary font-weight-bold'>Total amount of pending checks : </span> &nbsp; <span id='total_amount_of_pending_checks'>Rs.0.00</span>
                            </div>
                            <div class="col-md-12">
                                <span class='text text-info font-weight-bold'>Total amount of bounced checks : </span> &nbsp; <span id='total_amount_bounced_checks'>Rs.0.00</span> 
                            </div>
                        </div>
                    </div>
                    <table class='table table-responsive'>
                        <thead>
                            <tr class='text text-center'>
                                <th>#NO</th>
                                <th>Supplier name</th>
                                <th>Supplier Mobile</th>
                                <th>Supplier company name</th>
                                <th>Supplier addresses</th>
                                <th>Supplier account</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                 <th>Account NO</th>
                                <th>Cheques date</th>
                                <th>Cheques status</th>
                                <th>Note</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='getsupplier_detailsforgettingarea'>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <section class="section-content padding-y-sm bg-default ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 card padding-y-sm card">
                    <ul class="nav bg radius nav-pills nav-fill mb-3 bg d-none" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="pill" href="#nav-tab-card">
        <i class="fa fa-tags"></i> All</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
        <i class="fa fa-tags "></i>  Category 1</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        <i class="fa fa-tags "></i>  Category 2</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        <i class="fa fa-tags "></i>  Category 3</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        <i class="fa fa-tags "></i>  Category 4</a></li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        <i class="fa fa-tags "></i>  Category 5</a></li>
                    </ul>
                    <span id="items">
<div class="row all_products_cracker" id='outletproductdetailsection'>


                </div>
                <!-- row.// -->
                </span>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <span id="cart">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Item</th>
  <th scope="col" width="120">Qty</th>
  <th scope='col' width="120">Barcode</th>
  <th scope='col' width='120'>Unit</th>
  <th scope='col' width='120'>Actual price</th>
  <th scope="col" width="120">Price(Rs)</th>

  <th>Sub total(Rs)</th>
  <th scope="col" class="text-right" width="200">Delete</th>
</tr>
</thead>
<tbody id="showOffAllcartdetails">

</tbody>
</table>
</span>
                    <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                </div>
                <!-- card.// -->
                <div class="box">
                    <dl class="dlist-align">

                    </dl>
                    <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right"><a href="#" id="discountpercentage">0%</a></dd>
                    </dl>
                     <dl class="dlist-align">
                        <dt>SUBTRACT:</dt>
                        <dd class="text-right"><a href="#" id="subtractamounttotally">0.00</a></dd>
                    </dl>

                    <dl class="dlist-align">
                        <dt>Dis-amount</dt>
                        <dd class="text-right" id="dicountvalue">Rs.0</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Individual dis-amount</dt>
                        <dd class="text-right pt-3" id="individualdiscountamount">Rs.0</dd>
                    </dl>
                   <br>
                   <hr>
                    <br>
                
                    <dl class="dlist-align">
                        <dt>Total: </dt>
                        <dd class="text-right h4 b" id="totalamount"></dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Paying Amount: </dt>
                        <dd class="text-right h4 b" id="amounttoshowoffpaying">0</dd>
                    </dl>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn  btn-default btn-error btn-lg btn-block" id="clear_all_in_cart"><i class="fa fa-times-circle "></i> Clear </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn  btn-primary btn-lg btn-block" id='charge_for_sales'><i class="fa fa-shopping-bag"></i> Charge </a>
                        </div>
                        <div class="col-md-12 my-2">
                            <button class="btn btn-outline-dark btn-block" id="btnholdamountforcustomer">Hold</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="totalamounttocalculate">
                <!-- box.// -->
            </div>
        </div>
        </div>

         <div class="modal fade" id="holdamountforcustomer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text text-white">
                        <h4 class="text text-white font-weight-bold">HOLD SECTION</h4>
                    </div>
                    <div class="modal-header">
                        <div class="table table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Customer name</th>
                                        <th>Mobile number</th>
                                        <th>Product LIST</th>
                                        <th>Grand total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($allholdingproductsforlist==0):?>
                                    <tr>
                                        <td colspan="4"><span class="text text-danger font-weight-bold">No data found</span></td>
                                    </tr>
                                    <?php else:?>
                                    <?php foreach($allholdingproductsforlist as $item):?>
                                    <tr>
                                        <td>
                                            <?php echo $item->date?>
                                        </td>
                                        <td>
                                            <?php echo $item->customer_name?>
                                        </td>
                                        <td>
                                            <?php echo $item->customer_mobile?>
                                        </td>
                                        <td>
                                             <a href="#" class='btn btn-link list_all_hold_products_btn' shopping_hold_id="<?php echo $item->shopping_hold?>">
                                              View product
                                             </a>
                                        </td>
                                        <td>
                                            <?php echo $item->grand_total?>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <div class="p-1">
                                                    <button class="btn btn-sm btn-outline-danger deletedraft" shopping_hold="<?php echo $item->shopping_hold?>">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>

                                                </div>
                                                <div class="p-1">
                                                    <button class="btn btn-sm btn-success getholdbackbtn" shopping_hold="<?php echo $item->shopping_hold?>">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class='modal-body'>

                    <div class='table table-responsive'>
                         <table class='table table-bordered'>
                            <thead>
                            <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>product code</th>
                            <th>Actual price</th>
                            <th>Price</th>
                            <th>Sub total</th>
                            </tr>
                            </thead>
                            <tbody id='list_out_product_section' class='text text-center'>

                            </tbody>
                         </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id='expired_details_section_modal'>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class='text text-danger font-weight-bold'>Expired and expiring cheque</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table responsive">
                            <thead>
                                <tr>
                                    <th>#NO</th>
                                    <th>Bank Name</th>
                                    <th>Branch name</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id='modal_open_section_for_checkpassword'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text text-danger font-weight-bold">Check password for deleting</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" method='POST'>
                            <div class="form-group">
                                <label for="password">Type your password</label>
                                <input type="password" class="form-control" id='password_checkerforinvoice' placeholder="Please enter your login password here to verify">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-sm form-control" type='button' id='verifybuttontoinvoicedelete'>Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id='modal_section_modal'>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class='text text-danger font-weight-bold'>Sales SIDE</h4>
           <button class='btn btn-outline-danger' data-dismiss='modal'>X</button>

                    </div>
                    <div class="modal-body">
                    <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Sales</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Credits by Customer's details</a>
                                <a class="nav-item nav-link" id="nav-profil-loan" data-toggle="tab" href="#nav-loan" role="tab" aria-controls="nav-profile" aria-selected="false">Paid loan amount</a>
                            </div>
                        </nav>
                     
                         
                        <div class="tab-content" id="nav-tabContent">
                        


                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            
                            <div class="my-2">
                               <div class="row">
                                   <div class="col">
                                       <label for="FROM">FROM</label>
                                       <input type="date" class='form-control' id='from_to_search_purdate'>
                                   </div>

                                   <div class="col">
                                       <label for="TO">TO</label>
                                       <input type="date" class='form-control' id='to_to_search_purdate'>
                                   </div>
                                   
                                   <div class='col'>
                                     <label for="">  Status</label>
                                       <select class='form-control' id='status_cehcker'>
                                           <option value="">--select one--</option>
                                           <option value="Cash">Cash</option>
                                           <option value="Credit">Credit</option>
                                       </select>
                                   </div>
                                   <div class="col">
                                       <label for="">Mobile NO or Invoice NO</label>
                                       <input type="text" class="form-control" id='mobile_no_or_invoice_text' placeholder="Mob/Invoice">
                                   </div>
                                   <div class="col">
                                     
                                        <button class="btn btn-info my-4 py-2" id='search_bydateforfrontedn'>Search <i class="fa fa-search" aria-hidden='true'></i></button>
                                       

                                   </div>
                                   <br>
                                   
 
                               </div>
                               <div class="float-right">
                                   
                               </div>
                            </div>
                              <div class="my-2">
                                  <div class="float-right my-2">
                                  <button class='btn btn-success my-4 py-2 btn-sm d-none' id='exporttoexcelwholedata'><i class="fa fa-file-excel-o"></i>  Export as excel</button>
                                <br>
                                <a href="<?php echo base_url()?>Controllerunit/getloanamountbycustomer" target="_blank" class="btn btn-danger btn-sm">Get loan amount by customer</a>
                                <br/>
                                <button class="btn btn-primary my-2 py-2" id='regulateloanbutton'>Regulate loan</button>

                                <a href="<?php echo base_url()?>Controllerunit/printsalessidesection" target="_blank" class="btn btn-primary btn-sm">Print <i class="fa fa-print"></i></a>

                                </div>
                                  <input type="search" class='form-control' id='search_detailssectionforfrontendpurcahse' placeholder='Search'>
                              </div>
                                <table class="table table-responsive" cellspacing="0" id='salessidedetailsfromfrontexcel'>
                                    <thead>
                                        <tr>
                                            <th>Invoice NO</th>
                                            <th>Customer name</th>
                                            <th>Customer mobile</th>
                                            <th>Customer address</th>
                                            <th>Payment Method</th>
                                            <th>Credit</th>
                                            <th>Total amount</th>
                                            <th>Discounted Amount</th>
                                            <th>Discount from total </th>
                                            <th>purcahsed date</th>
                                            <th>To whom</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='showoff_sales_side_section' class='showoffsales_side_section'>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="my-2">
                                    <div class="row">
                                        <div class="col">
                                            <label for="from_datedate">From date</label>
                                            <input type="date" class='form-control' id='from_date_by_customer_searchcredit'>
                                        </div>
                                        <div class="col">
                                            <label for="to">TO DATE</label>
                                            <input type="date" class='form-control' id='to_date_by_customer_search_credit'>
                                        </div>
                                        <div class="col mt-4">
                                          <button type='button' class='form-control btn btn-primary mt-1' id='creditsearchsectionfromdatetodate'>Search <i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <div class="float-right my-3">
                                        <button class='btn btn-success' id='exportexcelforcreditdetails'>Export to excel</button>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <input type="search" class='form-control' id='search_creditdetailsbycustomer' placeholder='Search by terms'>
                                </div>
                                <table class="table table-responsive" cellspacing="0" id='creditdetailsectionallforexport'>
                                    <thead>
                                        <tr>
                                            <th>Invoice NO</th>
                                            <th>Customer name</th>
                                            <th>Customer mobile</th>
                                            <th>Customer Address</th>
                                            <th>Purcahsed order date</th>
                                            <th>Discount</th>
                                            <th>Discounted Amount</th>
                                            <th>Total amount</th>
                                            <th>Credited Amount</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id='allcredit_details_forsalesectionfront'>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-content fade" id='nav-loan' role="tabpanel" aria-labelledby="nav-profile-loan">
                            <div class="my-2">
                                 <div class="container">
                                     <div class="row">
                                         <div class="col">
                                             <label for="from">From</label>
                                             <input type="date" class='form-control' id='from_date_fr_loan'>
                                         </div>
                                         <div class="col">
                                             <label for="to">To</label>
                                             <input type="date" class='form-control' id='to_date_fr_loan'>
                                         </div>
                                         <div>
                                             <label for="mobile_date_fr_section">Mob : </label>
                                             <input type="tel" placeholder="Ex : 07589531...." class="form-control" id='mobile_date_fr_section'>
                                         </div>
                                         <div class="col">
                                             <label for="status">Payment method</label>
                                             <select id="payment_method_forloan" class='form-control'>
                                                 <option value="">--select one--</option>
                                                 <option value="Cash">Cash</option>
                                                 <option value="Check">check</option>
                                             </select>
                                         </div>

                                         <div class="col">
                                         <button class="btn btn-info my-4 py-2" id='search_loan_amount_section'>Search <i class="fa fa-search" aria-hidden='true'></i></button>
                                        <br>
                                        <a target="_blank" href="<?php echo base_url()?>Controllerunit/paidloanprint" class="btn btn-primary my-2 py-2">Print <i class="fa fa-print" aria-hidden='true'></i></a> 
                                        </div>

                                        <br>
                                        
                                           
                                     </div>
                                        <div class="my-2">
                                            <div class="my-2">
                                                <span class="text text-primary font-weight-bold">Total paid amount : </span> <span class="text text-info font-weight-bold" id='total_paidamounthtml'></span> <br>
                                                <span class="text text-primary font-weight-bold">Total amount to be paid : </span> <span class="text text-info font-weight-bold" id='total_amonttoebpaid'></span>
                                            </div>
                                        </div>
                                     <div class="">
                                         <div class="table tabel-responsive">
                                             <table class="table table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>#NO</th>
                                                        <th>Invoice ID</th>
                                                        <th>Customer name</th>
                                                        <th>Customer mobile</th>
                                                        <th>Customer address</th>
                                                        <th>Previous amount</th>
                                                        <th>Paid amount</th>
                                                        <th>Amount to be paid</th>
                                                        <th>Payment method</th>
                                                        <th>Date</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody id='loanpaymentmentcheckmethod'>
                                                    
                                                </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                        </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Contest Name</th>
                                            <th>Date</th>
                                            <th>Award Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">Work 1</a></td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#">Work 2</a></td>
                                            <td>Moe</td>
                                            <td>mary@example.com</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#">Work 3</a></td>
                                            <td>Dooley</td>
                                            <td>july@example.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                                   
                    </div>
                </div>
            </div>
        </div>

                    <div class="modal fade" id='repayloanbycash'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class='modal-title'>PAY LOAN BY CASH</h4>
                                    <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>X</button>
                                </div>
                                <div class='modal-body'>
                                    <form method='POST' id=''>
                                        <div class="form-group">
                                            <label for="">Payment to be paid</label>
                                            <input type="tel" class='form-control' id='payment_to_bepadi' readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Recieving Amount</label>
                                            <input type="tel" class='form-control' id='recieving_amount'>
                                        </div>
                                        <div class="form-group">
                                            <label for="balance_amount">Balance amount</label>
                                            <input type="tel" class='form-control' id='balance_amount' readonly>
                                        </div>

                                        <div class="form-group">
                                            <input type="button" id='payloanbycashbtn' class='form-control btn btn-block btn-primary' value='PAY'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



        <div class='modal fade' id='showrunningoutproducts'>
         <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
           The products that run out of.
           <button class='btn btn-outline-danger' data-dismiss='modal'>X</button>
          </div>
            <div class="modal-body">
            <?php if($getproductsforreminder==0):?>
            <span class='text text-danger font-weight-bold'>No data found</span>
            <?php else:?>
             <div class="table table-responsive">
               <table class='table table-bordered'>
               <thead>
               <tr>
               <td>#NO</td>
               <td>Product name</td>
               <td>UNIT</td>
               <td>Product quantity</td>
               <td>Request quantity</td>
               <td>Quantity in warehouse</td>
               <td>Action</td>
               </tr>
               </thead>
               <tbody>
               <?php $count =1;?>
               <?php foreach($getproductsforreminder as $product):?>
               <tr>
               <td><?php echo $count++;?></td>
               <td><?php echo $product->product_name?></td>
               <td><?php echo $product->product_unit?></td>
               <td><?php echo $product->product_quantity?></td>
                <td>
                 <input type="text" class='form-control request_quantity' value='1' warehousequantity="<?php echo $product->quantity?>"/>
               </td>
               <td>
               <?php echo $product->quantity?>
               </td>
                <?php if($warehouse_request_product==0):?>
                    <td>
               <button class='request_quantity_btn btn btn-primary' product_id="<?php echo $product->product_id?>">Request to warehouse</button>
               </td>
                <?php else:?>
                <?php foreach($warehouse_request_product as $product):?>
                    <td>
               <button class='undo_request btn btn-warning' product_id="<?php echo $product->product_id?>">Undo request <i class='fa fa-undo' aria-hidden='true'></i></button>
               </td>
                <?php endforeach;?>
                <?php endif;?>
           </tr>
               <?php endforeach;?>
               </tbody>
               </table>
             </div>
            <?php endif;?>
            </div>
         </div>
         </div>
        </div>

                    <!--Change password modal-->
                <div class='modal fade' id='userchangepasswordmodal'>
                 <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header justify-content-center">
                   <h4>CHANGE PASSWORD</h4>
                   </div>
                   <div class="modal-body">
                   <form method='POST' id='cashier_change_password'>
                   <div class="form-group">
                   <label for="usercurrentpassword">Current Password</label>
                   <input type="password" class="form-control" id='current_password' required>
                   </div>
                   <div class="form-group">
                   <label for="newpassword">New password</label>
                   <input type="password" class="form-control" id='newpassword' required>
                   </div>
                   <div class="form-group">
                    <input type="submit" value="CHANGE PASSWORD" class="form-control btn btn-outline-info">
                   </div>
                   </div>
                 </div>
                   </form>
                 </div>
                </div>



        <div class="modal fade" id='paywithcashmodal'>
          <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header justify-content-center">
                    <div class="justify-content-center">
                    <img src="https://www.flaticon.com/premium-icon/icons/svg/536/536054.svg" class='img-fluid' style="max-width:150px;max-height:150px">
                    <h4>Pay By Cash</h4>
                    </div>

           </div>
             <div class="modal-body">
                <form method='POST' id='#'>
                <div class="form-group">
                <label for="cash">Paying amount</label>
                <input type="tel" class='form-control' disabled id='total_amount_cash'>
                </div>

                 <div class="form-group">
                <label for="payingamount">Recieving amount</label>
                <input type="text" class='form-control' id='paying_amount'>
                </div>
                <div class="form-group">
                    <label for="status">
                        Status : 
                    </label>
                    <span class='badge badge-success' id='balanbce_status_for_sales'>Balance</span>

                </div>

                <div class="form-group">
                <label for="balanceamount">Balance</label>
                <input type="text" class='form-control' id='balance_amountbycash' disabled>
                </div>
                <div class="form-group">
                    <label for="additional_information">Additional Information</label>
                    <textarea class='form-control' id='additional_information'></textarea>
                </div>

                <div class="form-group">
                <input type="button" id='paybycashbutton' value="Pay" class="form-control btn btn-outline-success btn-lg">
                </div>
                </form>
             </div>
          </div>
          </div>
        </div>

        <div class="modal fade" id='paywithcreditamountdetailsmodal'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="justify-content-center text-center">
                        <img src="https://image.flaticon.com/icons/png/512/712/712772.png" style="max-width:100px; max-height:100px; border-radius:360px;">
        <h4>Pay with Credit</h4>
                        </div>
                        <div class="modal-body">
                            <form method='POST' id='#'>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class='form-control' id='amount_for_credit_details' readonly>
                                </div>
                                <div class="form-group">
                                    <label>Additional information</label>
                                    <textarea class="form-control" id='sec_additional_information'></textarea>
                                </div>
                                <div class="form-group">
                                  <button type='button' class="form-control btn btn-success btn-lg" id='savecreditamountsectionbutton'>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


         <div class='modal fade' id='paywithCheque'>
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header justify-content-center">
        <div class="justify-content-center text-center">
        <img src="https://www.flaticon.com/premium-icon/icons/svg/3397/3397271.svg" style="max-width:100px; max-height:100px; border-radius:360px;">
        <h4>Pay with Cheque</h4>
        </div>
          </div>
        <div class='modal-body'>
         <form method='POST' id='frm_paywithcheque'>
         <div class="form-group">
         <label>Bank Name</label>
         <input type="text" name="bank_name" id="bank_name" class='form-control' required>
         </div>
         <div class="form-group">
         <label>Branch</label>
         <input type="text" class='form-control' id='bank_branch' required>
         </div>
         <div class="form-group">
           <label>Cheque NO</label>
           <input type="tel" id="account_no" class="form-control" required>
         </div>
         <div class="form-group">
         <label for="amount">Paying amount</label>
         <input type="tel" id="paying_amount_given" class="form-control" readonly>
         </div>
         <div class="form-group">
         <label for="cheque_date">Cheque Date</label>
         <input type="date" class='form-control' id='cheque_date' required>
         </div>
         <div class="form-group">
         <label for="recieving_amount">Recieving Amount</label>
         <input type="tel" class='form-control' id='recieved_amount' required>
         </div>
         <div class="form-group">
         <label>Balance</label>
         <input type="tel" class='form-control' id='cheque_amount_balance' readonly value='0'>
         </div>
         <div class="form-group">
             <label for="paywithcheck">Additional Information</label>
             <textarea class='form-control' id='paywithcheck_additoinalinformation'></textarea>
         </div>

         <div class="form-group">
        <button type='button' id='submitformamountsectionforchecks' class="form-control btn btn-outline-success">Submit</button>
         </div>
         </form>
        </div>
        </div>
        </div>
        </div>

        <!-- container //  -->
    </section>
    <div class="modal fade" id="addcustomersection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text text-white">
                    <h4 class="text text-white font-weight-bold">Save customer</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="savecustomer">

                        <div class="form-group">
                            <label>Customer name</label>
                            <input type="name" class="form-control" id="customer_name" autofocus required>
                        </div>
                        <div class="form-group">
                            <label>Customer mobile number</label>
                            <input type="tel" class="form-control" id="customer_mobilenumber" required>
                        </div>
                        <div class="form-group">
                            <label for="">Customer Address</label>
                            <textarea class='form-control' id='customer_address'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="outstandingcreditamount">Outstanding credit</label>
                            <input type='text' class="form-control" id='outstandingcreditamount' value="0"/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-success btn-lg form-control" type="submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

                    



         <div class="modal fade" id='returnproductModal'>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text text-white">
                        <h4 class="text text-white font-weight-bold">Return product section</h4>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="from_date">From :</label>&nbsp;
                            <input type="date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="to_date">To : </label>&nbsp;
                            <input type="date" id="to_date" class="form-control">
                        </div>

                    </div>
                    <div class="row my-4">
                         <div class="col-md-12">
                            <button class="btn btn-outline-info btn-block" id="btnsearchreturnproduct">
                                Search <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                        <div class="row my-4">
                           <div class="col-md-2"></div>
                            <div class="col-md-9">
                                <div>
                               <label for="">Search  :</label><br>

                                <input type="search" class="form-control" id="search_returnproduct" placeholder="Invoice or customer NO or customer name">
                            </div>
                            </div>
                        </div>

                         <div class="container">
                             <div class="row my-4">
                            <div class="table table">
                                 <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Invoice NO</th>
                                        <th>Customer name</th>
                                        <th>Payment method</th>
                                        <th>Mobile</th>
                                        <th>Product list</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="all_details_for_return_product">
<!--                                    It will be rendered via -->
                                    </tbody>
                                 </table>
                            </div>
                         </div>
                         </div>
                         <div class="container my-4">
                           <hr>
                            <div class="row my-4">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <span class="total_amount_tobepaid badge badge-primary">Total amount : </span>&nbsp; <span id='total_amount_section'>Rs.0.00</span>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                           <input type="search" name="search" id="searcchbybarcodeinreturn" placeholder="Barcode here......" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row my-2 d-none">
                                        <div class="col">
                                            <span class="total_sub_total badge badge-info">Sum of sub total : </span>&nbsp; <span id='sumofsubtotaltotal_amount_section'>Rs.0.00</span>
                                        </div>
                                        
                                    </div>
                                </div>
                                  <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product name</th>
                                                <th>Barcode</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Sub total</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>
                                        <tbody id="product_name_section_display">

                                        </tbody>
                                    </table>
                            </div>
                         </div>
                         <div class="col-md-12">
                             <button class="btn btn-primary form-control" id="print_return_invoice">RETURN PRINT <i class="fa fa-print"></i></button>
                         </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade" id="showcreditdetailsmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text text-white">
                        <h4 class="modal-title text-white">CREDIT DETAILS</h4>
                        <button class="btn btn-danger btn-sm" data-dismiss='modal'>X</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#NO</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Credit balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>David</td>
                                    <td>0758953142</td>
                                    <td>500</td>
                                    <td>
                                        <button class="btn btn-sm btn-info">Paid</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<input type="hidden" id="invoice_id_hidden">


 
<input type="hidden" id="hidden_order_summery_id">

<!--    Return invoice    -->

<input type="hidden" id="invoice_id_hidden">

 <div class="modal fade" id='showexpenses'>
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header bg-dark text-white">
                 <div class="modal-title">Show expenses</div>
                 <button class='btn btn-outline-danger btn-sm' data-dismiss='modal'>X</button>
             </div>
             <div class="modal-body">
                 <div class="container">
                     <div class="row my-2">
                         <div class="col-md-3">
                             <label for="From">From</label>
                             <input type="date" class='form-control' id='from_date_expense_list'>
                         </div>
                         <div class="col-md-3">
                             <label for="TO">TO</label>
                             <input type="date" class='form-control' id='to_expense_list'>
                             
                         </div>
                         <div class="col-md-3 py-2">
                           <label for=""></label>
                           <button class='btn btn-primary btn-sm my-4 btn-lg' id='search_expensebutton'>
                                 Search <i class='fa fa-search'></i>
                             </button>
                         </div>
                     </div>
                     <div class="float-right">
                         Total amount : <span class="calculated_totalamount font-weight-bold text-danger"></span>
                     </div>
                     <br>
                     <div class="float-right">
                         <a href="<?php echo base_url()?>Controllerunit/totalexpenseprint" target="_blank" class="btn btn-primary">Print <i class="fa fa-print"></i></a>
                     </div>
                     <br>
                     <table class='table table-striped table-responsive'>
                         <thead>
                             <tr>
                                 <th>#NO</th>
                                 <th>Expense Type</th>
                                 <th>Expense date</th>
                                 <th>Expense amount</th>
                                 <th>Expense Note</th>
                                 <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody id='cashier_expense_list_section_outcome'>

                         </tbody>
                     </table>

                 </div>
             </div>
         </div>
     </div>
 </div>


<div class="modal fade" id="expense_list_section">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text text-white">
            <div class="modal-header">
                <div class="modal-title">Expenses list</div>

            </div>
            <div class="modal-body">
                <form method="POST" id="save_frm_expense_list_section">
                <div class="form-group">
                    <label for="">Expense Type</label>
                   <select id="expense_type" class="form-control" required>
                        <?php if($expenses_type==0):?>
                    <option value="">--NO TYPE FOUND--</option>
                    <?php else:?>
                    <option value="">--SELECT TYPE--</option>

                    <?php foreach($expenses_type as $expense):?>
                    <option value="<?php echo $expense->expense_typeid?>"><?php echo $expense->expense_name?></option>
                    <?php endforeach;?>

                    <?php endif;?>
                   </select>
                </div>
                <div class="form-group">
                    <label for="expense_date">Expense date</label>
                    <input type="date" class="form-control" id="expense_date" required/>
                </div>
                <div class="form-group">
                    <label for="">Expense Amount</label>
                    <input type="tel" class="form-control" id="expense_amount" required/>
                </div>
                <div class="form-group">
                    <label for="">Note for expense</label>
                    <input type="text" class="form-control" id="note_for_expense_section"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-outline-success btn-sm">SAVE <i class="fa fa-save"></i></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>






<div class="modal fade" id="sales_modal_section">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  text text-white">
            <div class="modal-header bg-dark">
                <div class="modal-title">Register details</div>
                <h4>TODAY SALES SUMMERY</h4>
            <button class="btn btn-outline-danger btn-sm" data-dismiss='modal'>
              X
            </button>
            </div>
            <div class="container">
                
            <div class="my-2">
              
                <button class='btn btn-success btn-sm d-none' id='exportexcelsectionforsummery'>Export as Excel <i class='fa fa-excel'></i></button>
                &nbsp; 
                
                <a href="<?php echo base_url()?>Controllerunit/printotalsummerydetails" target='_blank'   class='btn btn-primary btn-sm' id='print_salesunitsectionforsummery'>Print <i class="fa fa-print"></i> </a>
            </div>
            </div>
            <div class="modal-body text text-dark" id='cashinhandssectionsummery'>
             <div class="container">
                 <div class="row">
                     <div class="col">
                         <label for="from">FROM : </label>
                         <input type="date" class="form-control" id='from_date_section_to_search_forsummey'>
                     </div>
                     <div class="col">
                         <label for="to">To :</label>
                         <input type="date" class="form-control" id='to_date_section_to_search_forsummery'>
                     </div>
                     <div class="col">
                         <button class="btn btn-info my-4" id='search_button_forsummery'>Search <i class="fa fa-search"></i></button>
                     </div>
                 </div>
             </div>  


                <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        Cash in Hands : 
                    </div>
                    <div class="p-1" id='cashon_hands'>
                    Rs.00
                    </div>
                 </div>
                

                <div class="d-flex justify-content-between my-2">
                    <div class="p-1">
                   Cash payment : 
                    </div>
                    <div class="p-1" id='cash_payments'>
                    Rs.00
                    </div>
                 </div>

                
                <div class="d-flex justify-content-between my-2">
                    <div class="p-1">
                     Cheque Payment : 
                    </div>
                    <div class="p-1" id='cheque_payments'>
                    Rs.00
                    </div>

               
                </div>
                <div class="d-flex justify-content-between my-2">
                    <div class="p-1">
                    Expenses : 
                    </div>
                    <div class="p-1" id='expenses_amount'>
                    Rs.00
                    </div>

               
                </div>

                <div class="d-flex justify-content-between my-2">
                    <div class="p-1">
                    Recieved payment for credit : 
                    </div>
                    <div class="p-1" id='recievedpaymentforcreditsection'>
                    Rs.00
                    </div>

               
                </div>


               

                <div class="d-flex justify-content-between my-2 bg-success text-white">
                    <div class="p-1 font-weight-bold">
                   Returned amount
                    </div>
                    <div class="p-1 font-weight-bold" id='Total_refunds'>
                    Rs.00
                    </div>

               
                </div>
                <div class="d-flex justify-content-between my-2 bg-success text-white">
                    <div class="p-1 font-weight-bold">
                   Total Payment
                    </div>
                    <div class="p-1 font-weight-bold" id='total_payment'>
                    Rs.00
                    </div>

               
                </div>
                
                <div class="d-flex justify-content-between my-2 bg-success text-white">
                    <div class="p-1 font-weight-bold">
                  Credit Sales
                    </div>
                    <div class="p-1 font-weight-bold" id='credit_sales'>
                    Rs.00
                    </div>

               
                </div>

                
                <div class="d-flex justify-content-between my-2 bg-success text-white">
                    <div class="p-1 font-weight-bold">
                 Total sales 
                    </div>
                    <div class="p-1 font-weight-bold" id='total_sales'>
                         Rs.00
                    </div>

               
                </div>

                 
                <div class="d-flex justify-content-between my-2 bg-success text-white">
                    <div class="p-1 font-weight-bold">
                Sum of discount
                    </div>
                    <div class="p-1 font-weight-bold" id='sumofdiscounts'>
                         Rs.00
                    </div>

               
                </div>
             
               <hr style="border: 1px solid red;"/>
                    <!--
            <label class='font-weight-bold'>Details of sold products in daily basis</label>
            <table class='table table-striped'>
            <thead>
            <tr class="text text-center">
                <th>#NO</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                
            </tr>
            </thead>
            <tbody id='show_sold_product_details_bybrand'>
                
            </tbody>
         
            </table>
 -->
                         
                </div>   

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id='repayment_cheque_system'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Paying amount by cheque</h4>
                    </div>
                <div class="modal-body">
                    <form id='submit_loan_chequessection'>
                        <div class="form-group">
                            <label for="balance_amount">Balance Amount</label>
                            <input type="tel" class='form-control' id='balance_for_cheque_amount' readonly>
                        </div>

                        <div class="form-group">
                            <label for="cheque_number">Cheque Number</label>
                            <input type="tel" class='form-control' id='cheque_loan_number' required>
                        </div>
                        <div class="form-group">
                            <label for="amount_number">Amount</label>
                            <input type="tel" class='form-control' id='cheque_loan_amount' required>
                        </div>
                        <div class="form-group">
                            <label for="Status">Status</label>
                            <span class='badge badge-danger' id='display_status_loan_for_cheque'>Pending</span>
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class='form-control' id='bank_name_for_loan_cheque' required>
                        </div>
                        <div class="form-group">
                            <label for="branch_name">Branch Name</label>
                            <input type="text" class='form-control' id='branch_name_for_laon_chque' required>
                        </div>
                        <div class="form-group">
                            <label for="cheque_date">Cheque date</label>
                            <input type="date" class='form-control' id='cheque_date_for_loan_name' required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class='form-control btn btn-success' id='submit_loan_button'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id='initial_payment_modal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Initial payment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id='get_initial_payment'>
             <div class="form-group">
                 <label for="initial_payment">Initial payment</label>
                 <input type="tel" class='form-control' id='initial_payment_section' placeholder='Initial payment section'>
             </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='save_payment_section_details_forInitial'>Update</button>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id='warehousefinishingproductmodal'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class='text text-danger font-weight-bold modal-title'>Finishing products at warehouse</h4>
                <button class='btn btn-outline-danger btn-sm' data-dismiss='modal'>X</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="my-2">
                            <input type="search" class='form-control' id='searchforfinishingproductsatwarehouse' placeholder='Please search by using terms in table'>
                            <br>
                            <div id='Muted_products' class='text text-danger font-weight-bold'>Muted Products : 12</div>
                            <div id='unmuted_products' class='text text-info font-weight-bold'>Unmuted Products : 22</div>
                        </div>
                    </div>
                </div>
                <table class='table table-striped'>
                    <thead class='text text-center'>
                        <tr>
                            <th>#NO</th>
                            <th>PRODUCT NAME</th>
                            <th>PRODUCT UNIT</th>
                            <th>Current qty</th>
                            <th>Alert quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='show_off_producsofrunninginwarehouse'>

                    </tbody>
                </table>        
            </div>
        </div>
    </div>
</div>

 <div id='footer_section_elipline'>
     <div class="container">
         <div class="row">
         <div class="col-md-2">
                            <a href="#" class="btn  btn-default btn-error btn-sm btn-block" id="clear_all_in_cart_second"><i class="fa fa-times-circle "></i> Clear </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn  btn-primary btn-sm btn-block" id='charge_for_sales_second'><i class="fa fa-shopping-bag"></i> Charge </a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-dark btn-block" id="btnholdamountforcustomer_second">Hold</button>
                        </div>
                        
                        <div class='col-md-2 font-weight-bold'>
                            Paying Amount : <span class="text text-primary" id='amounttoshowoffpaying_second'></span>
                        </div>
                     
         </div>
     </div>
  
 </div>

<div class='modal fade' id='getexpireddetailsmodal'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    EXPIRED DETAILS OF PRODUCTS FROM OUTLET AND WAREHOUSE
                </h4>
                <button class='btn btn-outline-danger btn-sm' data-dismiss='modal'>X</button>
            </div>
            <div class="modal-body">
                <div class="my-2">
                    <input type="search" class='form-control' id='searchmutedproductssection' placeholder='Please search by terms in table'>
                </div> 
                <table class='table table-striped'>
                    <thead class='text text-center'>
                        <tr>
                            <th>#NO</th>
                            <th>Product Name</th>
                            <th>Product Unit</th>
                            <th>MFD</th>
                            <th>EXP</th>
                            <th>Product Code</th>
                            <th>Product price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='product_details_outlet_expired_showoff' style="max-height:200px;">
                            
                    </tbody>
                </table>


                <div class="my-2">

                <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Muted products <span class='text text-black font-weight-bold' id='muted_products_count'>(0)</span>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">

      <table class='table table-striped'>
                    <thead class='text text-center'>
                        <tr>
                            <th>#NO</th>
                            <th>Product Name</th>
                            <th>Product Unit</th>
                            <th>MFD</th>
                            <th>EXP</th>
                            <th>Product Code</th>
                            <th>Product price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='muted_product_details_outlet_expired_showoff'>
                            
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



<input type="hidden" id='temp_customer_id' value=''>

<input type="hidden" id='temp_key_id' value=''>


    <!-- ========================= SECTION CONTENT END// ========================= -->
    <script src="<?php echo base_url()?>assets_ss/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets_ss/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets_ss/js/OverlayScrollbars.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/mainsalespanel.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    <script>
        $(function() {
            //The passed argument has to be at least a empty object or a object with your desired options
            //$("body").overlayScrollbars({ });
            $("#items").height(552);
            $("#items").overlayScrollbars({
                overflowBehavior: {
                    x: "hidden",
                    y: "scroll"
                }
            });
            $("#cart").height(445);
            $("#cart").overlayScrollbars({});
        });
    </script>

    <script>
    $(document).ready(function() {
  $('.drawer').drawer();
});
    </script>

    <script>
    $('.drawer').drawer({
  class: {
    nav: 'drawer-nav',
    toggle: 'drawer-toggle',
    overlay: 'drawer-overlay',
    open: 'drawer-open',
    close: 'drawer-close',
    dropdown: 'drawer-dropdown'
  },
  iscroll: {
    // Configuring the iScroll
    // https://github.com/cubiq/iscroll#configuring-the-iscroll
    mouseWheel: true,
    preventDefault: false
  },
  showOverlay: true
});
    </script>
</body>

</html>
