<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Controllerunit';

$route['index'] = 'Controllerunit/index';

$route['Suppliers'] = 'Controllerunit/Suppliers';

$route['warehouse'] = 'Controllerunit/warehouse';


$route['addbrands'] = 'Controllerunit/addbrands';

$route['addcategories'] = 'Controllerunit/addcategories';

$route['subcategory'] = 'Controllerunit/subcategory';

$route['staffbase'] = 'Controllerunit/staffbase';

$route['warehouselogin'] = 'Controllerunit/warehouselogin';

$route['warehousehome'] = 'Controllerunit/warehousehome';


$route['viewproducts'] = 'Controllerunit/viewproducts';

$route['addproducts'] = 'Controllerunit/addproducts';

$route['viewunavailabilityproducts'] = 'Controllerunit/viewunavailabilityproducts';


$route['expensetype'] = 'Controllerunit/expensetype';

$route['gotosetting'] = 'Controllerunit/gotosetting';


$route['chequedetails'] = 'Controllerunit/chequedetails';

$route['maintaincheques'] = 'Controllerunit/maintaincheques';


$route['salesunit'] = 'Controllerunit/salesunit';

$route['groupsms'] = 'Controllerunit/groupsms';

$route['creategroups'] = 'Controllerunit/creategroups';


$route['printinvoicesettings'] = 'Controllerunit/printinvoicesettings';

$route['gotoreturnsalesunit'] = 'Controllerunit/gotoreturnsalesunit';

$route['getpurchasedetails'] = 'Controllerunit/getpurchasedetails';

$route['returndetails'] = 'Controllerunit/returndetails';
 
$route['Warehousereportsection'] = 'Controllerunit/Warehousereportsection';

 
$route['smshistory'] = 'Controllerunit/smshistory';
//cashflowledger
$route['cashflowledger'] = 'Controllerunit/cashflowledger';


$route['printotalsummerydetails'] = 'Controllerunit/printotalsummerydetails';

$route['productsinoutlets'] = 'Controllerunit/productsinoutlets'; 
$route['loanpayingreports'] = 'Controllerunit/loanpayingreports'; 


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
