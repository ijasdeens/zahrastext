<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controllerunit extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->library('session');
           //$this->load->library('Zend');
         
           $this->load->helper('cookie');


    }


    public function index()
    {
        if($this->session->userdata('admin_id')!=''){
              $data['alloutlets'] = $this->main_model->alloutlets();

              $result = $this->main_model->homewarehouse_summery_details(); 

            $warehouse_cost_amount = 0; 
            $product_price_total = 0; 
            $typesofproductcount = 0; 
            $quantity = 0; 

            $costdummery = 0; 
            $quantitydummy = 0; 

            $pricedummery = 0; 
            $pricequantitydummy = 0; 

            if($result!=0){
                foreach($result as $myres) {
                    $costdummery = floatval($myres->product_cost); 
                    $quantitydummy = (int)$myres->quantity; 
                    $pricedummery = floatval($myres->product_price); 
                    $pricequantitydummy = (int)$myres->quantity; 

                    $warehouse_cost_amount +=($costdummery * $quantitydummy); 
                    $product_price_total+=($pricedummery * $pricequantitydummy); 
                    $typesofproductcount=count($result); 
                    $quantity+= floatval($myres->quantity);
                }
    
            }
            else {
                $warehouse_cost_amount = 0.00; 
                $product_price_total = 0.00; 
                $typesofproductcount = 0; 
                $quantity = 0; 
 
            }
           

            $data['warehouse_cost_amount'] = $warehouse_cost_amount; 
            $data['product_price'] = $product_price_total; 
            $data['typesofproduct'] = $typesofproductcount; 
            $data['quantity'] = $quantity; 


           $this->load->view('layouts/header');
        $this->load->view('home/home',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

    public function choose_outlets_for_particularsearch(){
        $event_value = (int)$this->security->xss_clean($_POST['event_value']); 
        $result = $this->main_model->choose_outlets_for_particularsearch($event_value);
        
        $sumofcost = 0.00; 
        $sumofprice = 0.00; 
        $sumofproduct = 0.00; 
        $sumofquantity = 0; 

        $productsellingprice =0.00; 

        if($result==0){
            return json_encode($result); 
        } 
        else {
            $sumofproduct = count($result); 
            foreach($result as $res){
                $productcostsection = floatval($res->product_cost);
                $product_quantity = floatval($res->product_quantity); 
                $productsellingprice = floatval($res->product_price);
                $sumofcost+=floatval($productcostsection * $product_quantity); 
                $sumofprice+=floatval($productsellingprice * $product_quantity); 
                $sumofquantity+=(int)$res->product_quantity; 
            }
            $data = array(
                'sumofcost' => number_format($sumofcost,2), 
                'sumofprice' => number_format($sumofprice,2), 
                'sumofquantity' => number_format($sumofquantity), 
                'sumofproducts' => number_format($sumofproduct)
            ); 
            echo json_encode($data);
        }
    }


    public function salespersonlogout(){
        $this->session->sess_destroy();
    }

    public function Suppliers()
    {
        if($this->session->userdata('admin_id')!=''){
             $data['alloutlets'] = $this->main_model->alloutlets();
           $this->load->view('layouts/header');
        $this->load->view('Suppliers/Suppliers',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

   public function sendsmstocustomer()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['customer_details'] = $this->main_model->getcustomerdetailsformessage();

           $this->load->view('layouts/header');
            $this->load->view('sendsmscustomers/sendsmscustomers',$data);
            $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }


     //smshistory


     
   public function smshistory()
   {
       if($this->session->userdata('admin_id')!=''){

      
          $this->load->view('layouts/header');
           $this->load->view('smshistory/smshistory');
           $this->load->view('layouts/footer');

       }
       else {
             redirect(base_url() . 'Controllerunit/loginoutlet');
       }
    }

    public function showoffsmshistorysection(){
        $result = $this->main_model->showoffsmshistorysection(); 
        echo json_encode($result); 
    }

    public function showsmshistory_mobileperson_details(){
        $mobile = $this->security->xss_clean($_POST['mobile']); 
        $result = $this->main_model->showsmshistory_mobileperson_details($mobile); 
        echo json_encode($result) ;
    }


    public function groupsms()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['customer_details'] = $this->main_model->getcustomerdetailsformessage();
            $data['group_details'] = $this->main_model->group_details();
           $this->load->view('layouts/header');
            $this->load->view('Groupsms/groupsms',$data);
            $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }




    public function savecustomerdisplayads()
    {
        if($this->session->userdata('admin_id')!=''){

            $result  = $this->main_model->getalladsfordisplaysection();
            foreach($result as $res){
                $data['first_ad'] = $res->customer_ads_1;
                $data['second_ad'] = $res->customer_ads_2;
                $data['third_ad'] = $res->customer_ads_3;
                $data['fourth_ad'] = $res->customer_ads_4;
            }

            $this->load->view('layouts/header');
            $this->load->view('Saveads/Saveads',$data);
            $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }


     public function checkoutletidexist(){
        echo 'My id'.$this->session->outlet_id; 
     }



    public function getpurchasedetails()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['outletdetails'] = $this->main_model->getoutletsforpurcahsedetails();

             $this->load->view('layouts/header');
            $this->load->view('purcahsedproductdetails/purcahseproductdetails',$data);
            $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }



   public function returndetails()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['outletdetails'] = $this->main_model->getoutletsforpurcahsedetails();

             $this->load->view('layouts/header');
            $this->load->view('returndetails/returndetails',$data);
            $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }





           public function creategroups()
            {
              $data['group_details'] = $this->main_model->group_details();
                $data['customer_details'] = $this->main_model->getcustomerdetailsformessage();
                if($this->session->userdata('admin_id')!=''){
                   $this->load->view('layouts/header');
                    $this->load->view('Smsgroups/Smsgroups',$data);
                    $this->load->view('layouts/footer');

                }
                else {
                      redirect(base_url() . 'Controllerunit/loginoutlet');
                }
             }


           public function displayallproductdetials(){
               $products = $this->main_model->getProductsforoutlet($this->session->outlet_id);
               echo json_encode($products);  
           } 
             


    public function salesunit(){
        if($this->session->userdata('cashier_id')!='' || $this->session->userdata('outlet_id')!=''){

                $outletid = (int)$this->session->userdata('outlet_id');

                $data['products'] = $this->main_model->getProductsforoutlet($outletid);
                $data['customerbase'] = $this->main_model->showOffCustomers();
                $data['holdingproducts'] = $this->main_model->getholdingproducts($this->session->outlet_id);
                $data['allholdingproductsforlist'] = $this->main_model->allholdingproductsforlist($this->session->outlet_id);
                $data['holdingitemtodisplay'] = $this->main_model->holdingitemtodisplay($this->session->holder_id,$this->session->outlet_id);
                $data['getproductsforreminder'] =  $this->main_model->getproductsforreminder($outletid);
                $data['warehouse_request_product'] = $this->main_model->warehouse_request_product($outletid);


                $resultdata = $this->main_model->getgeneralsettingsforcashier(); 
                
                foreach($resultdata as $mydata){
                    $data['productreminder_privillage'] = $mydata->outlet_alert_quantity; 
                    $data['expire_date_reminder_privillage'] = $mydata->expire_date_reminder_privillage; 
                    $data['view_salessummery_privillage'] = $mydata->view_salessummery_privillage;
                    $data['view_salesection_privillage'] = $mydata->view_salesection_privillage;
                    $data['warehouse_productsreminder_privillage'] = $mydata->warehouse_productsreminder_privillage;
                    $data['chequeshowcashier'] = $mydata->chequeshowcashier; 
                    $data['admin_check_show'] = $mydata->admin_check_show;
                    $this->session->set_userdata('expiry_reminder_date',$mydata->warehouse_expiredatebefore);
                    $this->session->set_userdata('checks_expiry_date_reminder',$mydata->cheque_days_ago);
                }

 
             $data['expenses_type'] = $this->main_model->selectedgetexpensestype();

                $companylogo = $this->main_model->companylogotaker();

                foreach($companylogo as $logo){
                    $data['logo_area'] = $logo->logo;
                    $this->session->set_userdata('logo',$logo->logo);


                }
                $from_to_search_purdate = ''; 
                $to_to_search_purdate = ''; 
                $status_cehcker = '';

                $this->session->set_userdata('from_to_search_purdate_session',$from_to_search_purdate); 
                $this->session->set_userdata('to_to_search_purdate_session',$to_to_search_purdate); 
                $this->session->set_userdata('status_checker_session',$status_cehcker); 

                $from_date_expense_list=''; 
                $to_expense_list = ''; 
                $this->session->set_userdata('fromdateforexpense',$from_date_expense_list); 
                 $this->session->set_userdata('todateforexpense',$to_expense_list); 

                

                 $name   = 'user';
                 $value  = 'Raj';
                 $expire = time()+1000;
                 $path  = '/';
                 $secure = TRUE;
         
                 setcookie($name,$value,$expire,$path); 
         

                


        


            $this->load->view('salesunit/salesunit',$data);
        }
        else {
              redirect(base_url() . 'Controllerunit/cashierlogin');
        }

    }


    public function product_details_outlet_expired_showoffs(){
        $expired_date_before = (int)$this->session->expiry_reminder_date; 

     $currentdate = $this->security->xss_clean($_POST['currentdate']); 
     $checkabledate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($currentdate)));

      
    
     $expdate = '';
         $result = $this->main_model->product_details_outlet_expired_showoff($this->session->outlet_id); 
        foreach($result as $res){
            $checkabledate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($res->exp)));
            if($checkabledate<=$currentdate){
                $this->main_model->saveexpireddetailsforfrontend($this->session->outlet_id,$res->product_id); 
             }

        }
    }

  
    public function getexpiringcheckdetails(){
        $expired_date_before = (int)$this->session->expiry_reminder_date; 

        $currentdate = $this->security->xss_clean($_POST['currentdate']); 
        $checkabledate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($currentdate)));


        $expdate = '';

        $result = $this->main_model->getexpiringcheckdetails(); 

        $bank_name = ''; 
        $branch_name = ''; 
        $account_no = 0; 
        $cheque_date = ''; 
        $supplier_id = 0; 
        $amount = 0; 
        $note = '';
        $status = '';  


        if($result!=0){
            foreach($result as $res){
                $bank_name = $res->bank_name; 
                $branch_name = $res->branch_name; 
                $account_no = $res->account_no; 
                $cheque_date = $res->cheque_date; 
                $supplier_id = $res->supplier_id_fk;
                $note = $res->note; 
                $amount = $res->amount; 
                $status = $res->cheque_status; 

            }
            
        $savedetailsresult = $this->main_model->saveexpireddetailsforsupplier($status, $bank_name, $branch_name, $account_no, $cheque_date, $supplier_id, $note, $amount); 
            
        }
         
    }


    public function getdetailsofexpiredchecksforsupplier(){
      
         $expired_date_before = (int)$this->session->checks_expiry_date_reminder; 

        $currentdate = $this->security->xss_clean($_POST['currentdate']); 
        $checkabledate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($currentdate)));
   
      
 
        $expdate = '';

        $data = array(); 

        $getresultofsuppliercheques = $this->main_model->getdetailsofexpiredchecksforsupplier(); 
        if($getresultofsuppliercheques!=0){
            foreach($getresultofsuppliercheques as $res){
            $expdate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($res->cheque_date)));
                if($checkabledate<=$currentdate){
                   echo $this->main_model->savealldetailsforexpiredsection($expdate,$res->supplier_cheques_id,$res->cheque_date,$res->cheque_status); 
                }
                else {
                    echo 'my bad';
                }
            }
        }
        else {
           
        }

    }

    public function admin_status_action_pending_activator(){
        $chques_id_fk = $this->security->xss_clean($_POST['chques_id_fk']); 
        $check_fk = $this->security->xss_clean($_POST['check_fk']); 
        $result = $this->main_model->admin_status_action_pending_activator($chques_id_fk,$check_fk); 
        echo $result; 
    }
    public function admin_status_action_bounce_activator(){
        $chques_id_fk = $this->security->xss_clean($_POST['chques_id_fk']); 
        $check_fk = $this->security->xss_clean($_POST['check_fk']); 
        $result = $this->main_model->admin_status_action_bounce_activator($chques_id_fk,$check_fk); 
        echo $result; 
    }
    
    public function admin_statis_action_completed_activator(){
        $chques_id_fk = $this->security->xss_clean($_POST['chques_id_fk']); 
        $check_fk = $this->security->xss_clean($_POST['check_fk']); 
        $result = $this->main_model->admin_statis_action_completed_activator($chques_id_fk,$check_fk); 
        echo $result; 
    }


    public function chequesbyadmindetails(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 
        $checkstatus = $this->security->xss_clean($_POST['checkstatus']); 

        $result = $this->main_model->chequesbyadmindetails($fromdate, $todate, $checkstatus); 
        echo json_encode($result); 


    }

 
    public function detectexpirechecksbyadmindetails(){
        $expired_date_before = (int)$this->session->checks_expiry_date_reminder; 
        $currentdate = $this->security->xss_clean($_POST['currentdate']); 
        $checkabledate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($currentdate)));

        $getadmindetailsresult = $this->main_model->getexpirechecksbyadmin(); 

        $expdate = ''; 
 
        if($getadmindetailsresult!=0){
            foreach($getadmindetailsresult as $res){
                $expdate = date('Y-m-d',strtotime('-'.$expired_date_before.' day', strtotime($res->cheque_date)));
                if($checkabledate<=$currentdate){
                   $this->main_model->savealldetailsforadminsection($expdate, $res->chequesbyadmin_id,$res->cheque_date,$res->cheque_status);  
                }
            }
        }


    }

    
 

    public function muteexpproduct(){
        $product_id_fk = $this->security->xss_clean($_POST['product_id_fk']); 
        $result = $this->main_model->muteexpproduct($product_id_fk, $this->session->outlet_id); 
        echo $result; 
    }

    public function unmuteexpproduct(){
        $product_id_fk = $this->security->xss_clean($_POST['product_id_fk']); 
        $result = $this->main_model->unmuteexpproduct($product_id_fk, $this->session->outlet_id); 
        echo $result; 
    }

    public function salescustomerdisplay(){
        if($this->session->userdata('cashier_id')!=''){

                $outletid = (int)$this->session->userdata('outlet_id');

            $result = $this->main_model->getalladsfordisplaysection();

            foreach($result as $res){
                $data['first_ads'] = $res->customer_ads_1;
                $data['seconds_ads'] = $res->customer_ads_2;
                $data['third_ads'] = $res->customer_ads_3;
                $data['fourth_ads'] = $res->customer_ads_4;
            }



            $this->load->view('salesunit/Customerdisplay',$data);
        }
        else {
              redirect(base_url() . 'Controllerunit/cashierlogin');
        }

    }


     public function undorequestsection(){
        $product_id = (int)$this->security->xss_clean($_POST['product_id']);
        $outletid = (int)$this->session->userdata('outlet_id');
        $result = $this->main_model->undorequestsection($outletid,$product_id);
        echo $result;
    }


    public function requestquantity(){
        $value = (int)$this->security->xss_clean($_POST['value']);
        $product_id = (int)$this->security->xss_clean($_POST['product_id']);
        $outletid = (int)$this->session->userdata('outlet_id');
        $fulltimewithdate = $this->security->xss_clean($_POST['fulltimewithdate']);

        $data = array(
            'product_id' => $product_id,
            'request_quantity'=> $value,
            'outlet_id' => $outletid,
            'status' => 'Pending',
            'dateandtime' => $fulltimewithdate
        );

        $result = $this->main_model->requestquantity($data);


    }

 
    

    


    public function showoffallchequedetailsbyadmin(){
        $result = $this->main_model->showoffallchequedetailsbyadmin();
        echo json_encode($result);
    }

    public function list_all_holdshowoffproduct(){
        $id = $this->security->xss_clean($_POST['shopping_hold_id']);
        $result = $this->main_model->list_all_holdshowoffproduct($id);
        echo json_encode($result);
    }

    public function getproductback(){
        $shopping_hold = $this->security->xss_clean($_POST['shopping_hold']);
        $fulltimewithdate = $this->security->xss_clean($_POST['fulltimewithdate']);
        $result = $this->main_model->getproductback($shopping_hold);
        $this->load->library('cart');
        $type = 'sales';

        foreach($result as $items){

            $data = array(
            'id'      => $items->products_id,
            'qty'     => $items->quantity,
            'price'   => $items->product_price,
            'name'    => $items->product_name,
            'availablequantity' => $items->product_quantity,
            'product_pic' => $items->product_pic,
            'product_unit' =>$items->product_unit,
            'product_code' => $items->product_code, 
            'actual_price' => $items->actual_price, 
                'type' => $type
             );


            echo $this->cart->insert($data);

        }

        $this->main_model->makeupdateforpdocut($shopping_hold,$fulltimewithdate);
     }

    public function cashierlogin(){
        if($this->session->userdata('cashier_id')==''){
                $this->load->view('salesunit/saleslogin');
         }
        else {
            redirect(base_url() . 'Controllerunit/salesunit');
        }
    }



    public function passalldetailstoformsection(){
        $discountpercentage = $this->security->xss_clean($_POST['discountpercentage']);
        $dicountvalue = $this->security->xss_clean($_POST['dicountvalue']);
        $paying_amount_given = $this->security->xss_clean($_POST['paying_amount_given']);
        $recieved_amount = $this->security->xss_clean($_POST['recieved_amount']);
        $balance_amount = $this->security->xss_clean($_POST['balance_amount']);
        $totalamount = $this->security->xss_clean($_POST['totalamount']);
        $amounttoshowoffpaying = $this->security->xss_clean($_POST['amounttoshowoffpaying']);


          $this->session->set_userdata('discountpercentage', $discountpercentage);
          $this->session->set_userdata('dicountvalue', $dicountvalue);
          $this->session->set_userdata('paying_amount_given', $paying_amount_given);
          $this->session->set_userdata('recieved_amount', $recieved_amount);
          $this->session->set_userdata('balance_amount', $balance_amount);
          $this->session->set_userdata('totalamount', $totalamount);
          $this->session->set_userdata('amounttoshowoffpaying', $amounttoshowoffpaying);


    }


    public function getsalesdetails(){
        ?>
 <div class="pl-1 font-weight-bold text-primary" id="paying_amount_cus_dis"><h4>Total amount : <?php echo $this->session->totalamount;?></h4></div>
          <div class="pl-1 font-weight-bold text-primary" id="discount_per_dis"><h4>Discount percentage : <?php echo $this->session->discountpercentage?></h4></div>
          <div class="pl-1 font-weight-bold text-primary" id="discounted_amount"><h4>Discounted Amount : <?php echo $this->session->dicountvalue;?></h4></div>
          <div class="pl-1 font-weight-bold text-primary" id="discount_amount_cus"><h4>Paying amount : <?php echo $this->session->amounttoshowoffpaying;?></h4></div>
        <?php
    }



//spoof 

     public function loginforcashier(){

        $agent = '';


        $this->load->library('user_agent');

if ($this->agent->is_browser())
{
        $agent = $this->agent->browser().' '.$this->agent->version();
}
elseif ($this->agent->is_robot())
{
        $agent = $this->agent->robot();
}
elseif ($this->agent->is_mobile())
{
        $agent = $this->agent->mobile();
}
else
{
        $agent = 'Unidentified User Agent';
}

    $time = $this->security->xss_clean($_POST['timeline']); 

    $ipaddress = md5(
        $_SERVER['REMOTE_ADDR'] .
        $_SERVER['HTTP_USER_AGENT']
    );

        $mobNumber = $this->security->xss_clean($_POST['mobNumber']);
        $mobPassword = $this->security->xss_clean($_POST['mobPassword']);

        $result = $this->main_model->loginforcashier($mobNumber,$mobPassword);

        

            if($result==0){
              echo 0;
            }
        else {
           // $this->main_model->getagentdetails($agent,$this->agent->platform(),$time,$ipaddress);
        foreach($result as $row){
            $this->session->set_userdata('cashier_id', $row->staff_id);
            $this->session->set_userdata('outlet_id', $row->working_outlet);
            $this->session->set_userdata('staffname', $row->staff_name);
            $this->session->set_userdata('outlets_name', $row->outlets_name);
            $this->session->set_userdata('outlet_mobile',$row->outlet_mob);
            $this->session->set_userdata('address',$row->addresses);


        }
            echo 1;
         }




    }

    public function checkstaffoldpassword(){
        $current_password = $this->security->xss_clean($_POST['current_password']);
        $cashier_id = (int)$this->session->cashier_id;
        $result = $this->main_model->checkstaffoldpassword($current_password,$cashier_id);
        echo $result;

    }

    public function changepasswordforstaffs(){
      $newpassword = $this->security->xss_clean($_POST['newpassword']);
      $cashier_id = (int)$this->session->cashier_id;
      $reuslt = $this->main_model->changepasswordforstaffs($newpassword,$cashier_id);
      echo $reuslt;
    }


    public function createoutlets()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['alloutlets'] = $this->main_model->alloutlets();
               $this->load->view('layouts/header');
        $this->load->view('outlets/outlets',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }


    public function warehouse()
    {
        if($this->session->userdata('admin_id')!=''){

           $this->load->view('layouts/header');
        $this->load->view('warehouse/warehouse');
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

    public function expensetype()
    {
        if($this->session->userdata('admin_id')!=''){
            $data['expensestypes'] = $this->main_model->showexpeseType();
           $this->load->view('layouts/header');
        $this->load->view('expensetype/expensetype',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

    public function expensesList()
    {
        if($this->session->userdata('admin_id')!=''){
         $data['allexps'] = $this->main_model->showexpensesList();

        $data['expenses_type'] = $this->main_model->getexpensestype();

            $this->load->view('layouts/header');
        $this->load->view('expenseslist/expenseslist',$data);
        $this->load->view('layouts/footer');

    }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

    public function showOffExpensesTypeto(){
        $result =  $this->main_model->showexpeseType();
        echo json_encode($result);
    }

   


    public function showexpensesList(){
         $result = $this->main_model->showexpensesList();
        echo json_encode($result);
    }

    public function save_expneses_details_manually(){
        $expense_type = $this->security->xss_clean($_POST['expense_type']);
        $expense_date = $this->security->xss_clean($_POST['expense_date']);
        $expense_amount = $this->security->xss_clean($_POST['expense_amount']);
        $expense_note = $this->security->xss_clean($_POST['expense_note']);


        $data = array(
            'expense_type' => $expense_type,
            'expense_note' => $expense_note,
            'expense_date' => $expense_date,
            'expense_amount' => $expense_amount
        );

        $result = $this->main_model->save_expneses_details_manually($data);
        echo json_encode($result);


    }


    public function delete_expense_details(){
        $expenses_list_id = (int)$this->security->xss_clean($_POST['expenses_list_id']);
        $result = $this->main_model->delete_expense_details($expenses_list_id);
        echo json_encode($result);
    }



    public function warehouselogin()
    {

         if($this->session->userdata('warehouse_adminid')==''){

        $this->load->view('warehousebase/login/login');

         }
        else {
              redirect(base_url() . 'Controllerunit/addproducts');
        }
     }

    public function loginoutlet(){

        if($this->session->userdata('admin_id')==''){

        $this->load->view('mainlogin/mainlogin');

         }
        else {
              redirect(base_url() . 'Controllerunit/index');
        }
    }


    //ijasdeen
    public function addproducts()
    {
        if($this->session->userdata('warehouse_adminid')!=''){
            $data['brands'] = $this->main_model->showOffBrands();
            $data['categories'] = $this->main_model->showOffCategories();
            $data['Suppliers'] = $this->main_model->getSuppliers();
             
            $data['warehousedetails'] = $this->main_model->getwarehousedetails();


                        $data['requested_product'] = $this->main_model->requestedproduct();

                 $this->load->view('warehousebase/layouts/header',$data);
         $this->load->view('warehousebase/home/home',$data);
            $this->load->view('warehousebase/layouts/footer');

         }
        else {
              redirect(base_url() . 'Controllerunit/warehouselogin');
        }
     }



    public function viewproducts()
    {
        if($this->session->userdata('warehouse_adminid')!=''){

             $data['product_details'] = $this->main_model->viewproducts();
            $data['outlets_details'] = $this->main_model->alloutlets();
             $data['requested_product'] = $this->main_model->requestedproduct();

            $this->load->view('warehousebase/layouts/header',$data);
                $this->load->view('warehousebase/viewproducts/viewproducts',$data);
                $this->load->view('warehousebase/layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/warehouselogin');
        }
     }


     //elimination

     public function getallproductsbasedonwarehouse(){
         $selectedvalue = $this->security->xss_clean($_POST['selectedvalue']); 
         $result = $this->main_model->getallproductsbasedonwarehouse($selectedvalue); 
         echo json_encode($result);
     }





    public function requestedproductlist()
    {
        if($this->session->userdata('warehouse_adminid')!=''){

             $data['product_details'] = $this->main_model->viewproducts();
            $data['outlets_details'] = $this->main_model->alloutlets();
             $data['requested_product'] = $this->main_model->requestedproduct();

             $data['completedrequested_product'] = $this->main_model->completedrequested_product();

           $this->load->view('warehousebase/layouts/header',$data);
                $this->load->view('warehousebase/requestedproductslist/requestedproductlist',$data);
                $this->load->view('warehousebase/layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/warehouselogin');
        }
     }








    public function printbarcodes()
    {
        if($this->session->userdata('warehouse_adminid')!=''){
                        $data['requested_product'] = $this->main_model->requestedproduct();

            $this->load->view('warehousebase/layouts/header',$data);
                $this->load->view('warehousebase/printbarcodes/printbarcodes');
                $this->load->view('warehousebase/layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/warehouselogin');
        }
     }

    //getback
       public function getallforblank($code='23432'){
           $this->zend->load('Zend/Barcode');


       }



    public function customerbase()
    {
        if($this->session->userdata('admin_id')!=''){
          $this->load->view('layouts/header');
        $this->load->view('customerbase/customerbase');
        $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

     public function addpurcahsedetails(){
        if($this->session->userdata('admin_id')!=''){
            $data['allsuppliers'] = $this->main_model->getsupplierdetails(); 
            $this->load->view('layouts/header');
          $this->load->view('purcahsedetails/purcahsedetails',$data);
          $this->load->view('layouts/footer');
  
          }
          else {
                redirect(base_url() . 'Controllerunit/loginoutlet');
          }

     }

    public function staffbase()
    {
        if($this->session->userdata('admin_id')!=''){
          $data['outlets'] = $this->main_model->alloutlets();
          $this->load->view('layouts/header');
        $this->load->view('staffbase/staffbase',$data);
        $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }

    public function maintaincheques()
    {
        if($this->session->userdata('admin_id')!=''){

         $data['suppliers'] = $this->main_model->getsupplierdetailssecion(); 

          $this->load->view('layouts/header');
        $this->load->view('suppliercheques/suppliercheques',$data);
        $this->load->view('layouts/footer');

        }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }


    public function subcategory()
    {
        if($this->session->userdata('admin_id')!=''){
           $this->load->view('layouts/header');
        $this->load->view('subcategories/subcategories');
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }



    public function reportsofsupplierdetails()
    {
        if($this->session->userdata('admin_id')!=''){

            $data['supplier_details'] = $this->main_model->getsupplierdetails();

           $this->load->view('layouts/header');
        $this->load->view('reportsofsupplierdetails/reportsofsupplierdetails',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }



     public function refillwarehousection(){
         $typedvalue = $this->security->xss_clean($_POST['typedvalue']); 
         $id =(int) $this->security->xss_clean($_POST['id']); 
         $result = $this->main_model->refillwarehousection($typedvalue,$id);
        echo $result;
     }

     public function subtract_products(){
        $typedvalue = $this->security->xss_clean($_POST['typedvalue']); 
        $id =(int) $this->security->xss_clean($_POST['id']); 
        $result = $this->main_model->subtract_products($typedvalue,$id);
       echo $result;
    }



     public function warehousesectiondelete(){
         $products_id = (int)$this->security->xss_clean($_POST['products_id']); 
        echo $this->main_model->warehousesectiondelete($products_id); 
        }

        public function search_bybarcodesection(){
            $product_code = $this->security->xss_clean($_POST['product_code']); 
            $result = $this->main_model->search_bybarcodesection($product_code); 
            echo json_encode($result); 
        }



    public function viewunavailabilityproducts()
    {
        if($this->session->userdata('admin_id')!=''){
            $data['products'] = $this->main_model->checkavailableproductscount();
           $this->load->view('layouts/header');
        $this->load->view('unavailableprodut/unavailableproduct',$data);
        $this->load->view('layouts/footer');
         }
        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }
     }


    public function removeproductsall(){
        $products_id = (int)$this->security->xss_clean($_POST['products_id']);
        $this->main_model->removeproductsall($products_id);
    }


        public function addbrands()
        {

        if($this->session->userdata('admin_id')!=''){
           $this->load->view('layouts/header');
        $this->load->view('addbrands/addbrands');
        $this->load->view('layouts/footer');

        }

        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }

         }

    public function addcategories()
        {

        if($this->session->userdata('admin_id')!=''){
           $this->load->view('layouts/header');
        $this->load->view('categories/categories');
        $this->load->view('layouts/footer');

        }

        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }

         }
         public function gotosetting()
        {

        if($this->session->userdata('admin_id')!=''){

           $result  = $this->main_model->getgeneral_setting();

            foreach($result as $res){
                $data['company_name'] = $res->company_name;
                $data['logo'] = $res->logo;
                $data['company_address'] = $res->company_address;
                $data['main_hotline_number'] = $res->main_hotline_number;
                $data['alert_quantity'] = $res->outlet_alert_quantity;
            }




           $this->load->view('layouts/header');
        $this->load->view('generalsettings/generalsettings',$data);
        $this->load->view('layouts/footer');

        }

        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }

         }

        public function chequedetails()
        {

        if($this->session->userdata('admin_id')!=''){

            $data['customer_details'] = $this->main_model->showOffCustomers();
            $data['bankaccountdetials'] = $this->main_model->getbankdetails();

           $this->load->view('layouts/header');
        $this->load->view('cheques/cheques',$data);
        $this->load->view('layouts/footer');

        }

        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }

         }


      public function chequesbyadmin()
        {

        if($this->session->userdata('admin_id')!=''){

             $data['bankaccountdetials'] = $this->main_model->getbankdetails();

           $this->load->view('layouts/header');
        $this->load->view('chequesbyadmin/chequesbyadmin',$data);
        $this->load->view('layouts/footer');

        }

        else {
              redirect(base_url() . 'Controllerunit/loginoutlet');
        }

         }





        public function bankaccounts()
        {

            if($this->session->userdata('admin_id')!=''){

                $data['bankaccountdetials'] = $this->main_model->getbankaccountdetails();

                $this->load->view('layouts/header');
            $this->load->view('bankaccounts/bankaccounts',$data);
            $this->load->view('layouts/footer');

            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }


         
        public function cashflowledger()
        {

            if($this->session->userdata('admin_id')!=''){



                $this->load->view('layouts/header');
            $this->load->view('cashflowledger/cashflowledger');
            $this->load->view('layouts/footer');

            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }


           
        public function productsinoutlets()
        {

            if($this->session->userdata('admin_id')!=''){
                $data['outlets_details'] = $this->main_model->getresultsofoutlets(); 
 
                $this->load->view('layouts/header');
            $this->load->view('outlets/outletproducts',$data);
            $this->load->view('layouts/footer');

            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }






        public function outletreports()
        {

            if($this->session->userdata('admin_id')!=''){
                $data['alloutlets'] = $this->main_model->alloutlets();
                $this->load->view('layouts/header');
            $this->load->view('outletreports/outletreports',$data);
            $this->load->view('layouts/footer');

            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }


        public function salesreports()
        {

            if($this->session->userdata('admin_id')!=''){
                $data['alloutlets'] = $this->main_model->alloutlets();

                $this->load->view('layouts/header');
            $this->load->view('Salesreport/Salesreport',$data);
            $this->load->view('layouts/footer');

            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }

         //Warehousereportsection

         
        public function Warehousereportsection()
        {

            if($this->session->userdata('admin_id')!=''){
                $data['warehousedetails'] = $this->main_model->getwarehousedetails();

                $this->load->view('layouts/header');
            $this->load->view('warehousereport/warehousereport',$data);
            $this->load->view('layouts/footer');
            
            }

            else {
                  redirect(base_url() . 'Controllerunit/loginoutlet');
            }

         }



        public function deleteaccountdetailss(){
            $deleteaccountid = (int)$this->security->xss_clean($_POST['deleteaccountid']);

            $result = $this->main_model->deleteaccountdetailss($deleteaccountid);

        }


        public function getselctedoutletreport(){
             $value = $this->security->xss_clean($_POST['value']);
             $result = $this->main_model->getselctedoutletreport($value);
            echo json_encode($result);



        }



        public function update_all_details_general(){
            $company_name = $_POST['company_name'];
            $commpan_general_hot_number = $_POST['commpan_general_hot_number'];
            $owner_name = $_POST['owner_name'];

            $data = array(
            'company_name' => $company_name,
             'company_hot' => $commpan_general_hot_number,
                'company_ownername' => $owner_name
            );

            $result = $this->main_model->update_all_details_general($data);


        }



        public function frmBankDetails_section(){
            $account_no = $this->security->xss_clean($_POST['account_no']);
            $bank_name = $this->security->xss_clean($_POST['bank_name']);
            $branch_name = $this->security->xss_clean($_POST['branch_name']);
            $initial_amount = $this->security->xss_clean($_POST['initial_amount']);
            $Note = $this->security->xss_clean($_POST['Note']);

            $data = array(
            'bank_account_no' => $account_no,
                'bank_name' => $bank_name,
                'branch_name' => $branch_name,
                'initial_amount' => $initial_amount,
                'initial_note' => $Note
            );


            $result = $this->main_model->frmBankDetails_section($data);
            echo json_encode($result);
        }




    public function addSuppliers(){
        $supplierName = $this->security->xss_clean($_POST['supplierName']);
        $mobileNumber = $this->security->xss_clean($_POST['mobileNumber']);
        $orgName = $this->security->xss_clean($_POST['orgName']);
        $suppliers_address = $this->security->xss_clean($_POST['suppliers_address']);
        $suppliers_accountNo = $this->security->xss_clean($_POST['suppliers_accountNo']);
        $bank_name = $this->security->xss_clean($_POST['bank_name']);

        $data = array(
        'supplier_name' => $supplierName,
            'mobile_number' => $mobileNumber,
            'org_name' => $orgName,
            'supplier_addresses' => $suppliers_address,
            'supplier_accountno' => $suppliers_accountNo,
            'bank_name' => $bank_name
        );

        $result = $this->main_model->addSupplier($data);

    }

    public function showOffSupplier(){
        $result = $this->main_model->showOffSuppliers();
         echo json_encode($result);
    }


    public function givendetalsfrm(){
        $hidden_id =(int)$this->security->xss_clean($_POST['hidden_id']);
        $cheque_status = $this->security->xss_clean($_POST['cheque_status']);
        $suppliers_details = $this->security->xss_clean($_POST['suppliers_details']);
        $crrentTImedate = $this->security->xss_clean($_POST['crrentTImedate']);

        $result = $this->main_model->givendetailsfrm($hidden_id,$cheque_status,$suppliers_details,$crrentTImedate);
        echo json_encode($result);

    }


    public function deleteSuppliers(){
        $id =(int)$this->security->xss_clean($_POST['supplier_id']);
        $result = $this->main_model->deleteSuppliers($id);
         echo json_encode($result);
    }


    public function updateSuppliers(){
         $u_mobileNumber = $this->security->xss_clean($_POST['u_mobileNumber']);
        $u_orgName = $this->security->xss_clean($_POST['u_orgName']);
        $id =(int)$this->security->xss_clean($_POST['id']);
        $u_supplierName = $this->security->xss_clean($_POST['u_supplierName']);
        $u_bankname = $this->security->xss_clean($_POST['u_bankname']);
        $u_address = $this->security->xss_clean($_POST['u_address']);
        $u_accountNo = $this->security->xss_clean($_POST['u_accountNo']);

        $data = array(
        'supplier_name' => $u_supplierName,
            'mobile_number' => $u_mobileNumber,
            'org_name' => $u_orgName,
            'supplier_addresses' => $u_address,
            'supplier_accountno' => $u_accountNo,
            'bank_name' => $u_bankname
        );

        $result = $this->main_model->updateSuppliers($data,$id);
        echo json_encode($result);


    }

    public function saveWraehouse(){
        $warehouseName = $this->security->xss_clean($_POST['warehouseName']);
        $warehouseAddress = $this->security->xss_clean($_POST['warehouseAddress']);
        $warehouseMobile = $this->security->xss_clean($_POST['warehouseMobile']);


        $data = array(
        'warehouse_name' => $warehouseName,
            'warehouse_address' => $warehouseAddress,
            'main_mobile' => $warehouseMobile
        );


         $result = $this->main_model->warehouseMobile($data);
        echo json_encode($result);



    }

    public function updatewarehouse(){
        $id = (int)$this->security->xss_clean($_POST['id']);
        $name = $this->security->xss_clean($_POST['name']);
        $address = $this->security->xss_clean($_POST['address']);
        $u_mobile = $this->security->xss_clean($_POST['u_mobile']);

        $data = array(
        'warehouse_name' => $name,
            'warehouse_address' => $address,
            'main_mobile' => $u_mobile
        );


         $result = $this->main_model->updatewarehouse($data,$id);
        echo json_encode($result);



    }



    public function viewWarehouseDetails(){
         $result = $this->main_model->viewWarehouseDetails();
        echo json_encode($result);


    }


    public function deleteWarehouseDetails(){
        $warehouse_id = $this->security->xss_clean($_POST['warehouse_id']);

         $result = $this->main_model->deleteWarehouseDetails($warehouse_id);
        echo json_encode($result);

    }


    public function saveBrand(){
        $brandsName = $this->security->xss_clean($_POST['brandsName']);
          $result = $this->main_model->saveBrand($brandsName);
        echo json_encode($result);

    }
    public function updatebrands(){
        $brandsName = $this->security->xss_clean($_POST['brandsName']);
        $hidden_id = $this->security->xss_clean($_POST['hidden_id']);
       $result = $this->main_model->updatebrandssection($brandsName,$hidden_id);
        echo json_encode($result);


    }

    public function savecategoriesName(){
        $categoriesName = $this->security->xss_clean($_POST['categoriesName']);
        $result = $this->main_model->savecategoriesName($categoriesName);
        echo json_encode($result);
    }

    public function personchangeprofile(){
        $person_name =$this->security->xss_clean($_POST['person_name']);
        $person_tel = $this->security->xss_clean($_POST['person_tel']);
        $admin_id = $this->session->warehouse_adminid;
        $this->session->set_userdata('staff_name', $person_name);
        $result = $this->main_model->personchangeprofile($person_name,$person_tel,$admin_id);
         echo json_encode($result);

    }

    public function changepasswordforstaff(){
        $current_password = $this->security->xss_clean($_POST['current_password']);
        $new_password = $this->security->xss_clean($_POST['new_password']);
        $admin_id = $this->session->warehouse_adminid;

            $result = $this->main_model->changepasswordforstaff($current_password,$new_password,$admin_id);
         echo json_encode($result);

    }

    public function signoutstaff(){
        $this->session->sess_destroy();
    }

    public function showOffBrands(){
         $result = $this->main_model->showOffBrands();
        echo json_encode($result);
    }

     public function deltecategories(){
         $catId = $this->security->xss_clean($_POST['categoryId']);
          $result = $this->main_model->deltecategories($catId);
         echo json_encode($result);
     }

    public function updatecategories(){
        $id = (int)$this->security->xss_clean($_POST['id']);
        $categoriesName = $this->security->xss_clean($_POST['categoriesName']);
          $result = $this->main_model->updatecategories($id,$categoriesName);
         echo json_encode($result);

    }





    public function deleteBrands(){
        $brands_id = $this->security->xss_clean($_POST['brands_id']);
         $result = $this->main_model->deleteBrands($brands_id);

    }

    public function showOffCategories(){
         $result = $this->main_model->showOffCategories();
        echo json_encode($result);
    }

    public function savesubcategory(){
        $main_category = $this->security->xss_clean($_POST['main_category']);
        $sub_category = $this->security->xss_clean($_POST['sub_category']);

        $result = $this->main_model->savesubcategory($main_category,$sub_category);
        echo json_encode($result);
    }

    public function showoffsubCategory(){
        $result = $this->main_model->showoffsubCategory();
        echo json_encode($result);

    }


    public function deletesubcategories(){
        $sub_cat_id  = (int)$this->security->xss_clean($_POST['sub_cat_id']);
        $result = $this->main_model->deletesubcategories($sub_cat_id);
        echo json_encode($result);

    }

    public function updatesubcategory(){
        $id =(int) $this->security->xss_clean($_POST['id']);
        $umain_category =$this->security->xss_clean($_POST['umain_category']);
        $usub_category =$this->security->xss_clean($_POST['usub_category']);

        $data = array(
        'main_cat_id' => $umain_category,
            'sub_cat_id' => $usub_category
        );
        $result = $this->main_model->updatesubcategory($data,$id);


    }

    public function savecustomers(){
        $customerMobileNumber = $this->security->xss_clean($_POST['customerMobileNumber']);
        $customerName = $this->security->xss_clean($_POST['customerName']);
        $customer_address = $this->security->xss_clean($_POST['customer_address']); 
        $outstandingcreditamount = $this->security->xss_clean($_POST['outstandingcreditamount']); 

            $result = $this->main_model->savecustomers($customerMobileNumber,$customerName,$customer_address,$outstandingcreditamount);

            echo $result;

    }

    public function checkpasswordbeforedeleteinginvoice(){
        $order_id = $this->security->xss_clean($_POST['order_id']); 
        $total_amount_todelete = $this->security->xss_clean($_POST['total_amount_todelete']); 
        $ordereddate = $this->security->xss_clean($_POST['ordereddate']); 
        $password = $this->security->xss_clean($_POST['password']); 
        $payment_method = $this->security->xss_clean($_POST['payment_method']); 

        $customermobile = $this->security->xss_clean($_POST['customermobile']); 
        $sales_credit_amount = $this->security->xss_clean($_POST['sales_credit_amount']); 

        $ordereddate = substr($ordereddate, 0,10); 

        $checkapsswordresult = $this->main_model->checkpasswordsection($password, $this->session->cashier_id); 
         
        if( $checkapsswordresult==1){
            if($sales_credit_amount!=0){
            $this->main_model->subtractamountfromcustomer($customermobile,$sales_credit_amount ); 
          }

            $this->main_model->deleteinvoicesection($order_id, $this->session->outlet_id); 
             
            $subtractamountresult = $this->main_model->subtractamountsection($total_amount_todelete,$ordereddate,$payment_method, $this->session->outlet_id); 

            echo  $subtractamountresult;

        }
        else {
            echo "Invalid password"; 
        }



    }


    public function searchmobilenumber(){
        $myarraydata = array(); 

        $customerid = 0; 

        $value = $this->security->xss_clean($_POST['value']);
        $result = $this->main_model->searchmobilenumber($value);
        if($result==0){
            echo 0;
        }
        else{
            foreach($result as $customer){
            $customerid = $customer->customer_id; 
            $value = floatval($customer->customer_credit); 

                 $myarraydata = array(
                    'customer_name' => $customer->customer_name, 
                    'customer_address' => $customer->customer_address,
                    'customer_credit_details' => number_format( $value,2), 
                    'status' => 1
                ); 

            }
            $this->session->set_userdata('customer_id',$customerid);

            echo json_encode($myarraydata);
           
        }



    }

    public function resetcustomerid(){
        $this->session->set_userdata('customer_id',0);
        
        
    }

    public function getCustomeridbfortemp(){
         echo $this->session->customer_id; 
    }


    public function resetidforcustomers(){
        $this->session->set_userdata('customer_id',0);

    }


    public function showOffCustomers(){
        $result = $this->main_model->showOffCustomers();
        echo json_encode($result);
     }

    public function showOffStaff(){
        $result = $this->main_model->showOffStaff();
        echo json_encode($result);
     }



    public function deletecustomer(){
        $customer_id =(int) $this->security->xss_clean($_POST['customer_id']);
        $result = $this->main_model->deletecustomer($customer_id);
    }

    public function savestaffs(){
        $staffName = $this->security->xss_clean($_POST['staffName']);
        $responsibility = $this->security->xss_clean($_POST['responsibility']);
        $joint_date = $this->security->xss_clean($_POST['joint_date']);
        $staffmob = $this->security->xss_clean($_POST['staffmob']);
        $working_outlets = $this->security->xss_clean($_POST['working_outlets']);


        $data = array(
        'staff_name' => $staffName,
            'staff_mobile' => $staffmob,
            'joint_date' => $joint_date,
            'responsibility' => $responsibility,
            'password' => $staffmob,
            'working_outlet' => $working_outlets
        );

        $result = $this->main_model->savestaffs($data);
        echo json_encode($result);

    }


    public function checkstaffmobilenumber(){
        $staffmob = $this->security->xss_clean($_POST['staffmob']);
         $result = $this->main_model->checkstaffmobilenumber($staffmob);
        echo json_encode($result);
    }


    public function updatestaffs(){
        $staffName = $this->security->xss_clean($_POST['staffName']);
        $responsibility = $this->security->xss_clean($_POST['responsibility']);
        $joint_date = $this->security->xss_clean($_POST['joint_date']);
        $staffmob = $this->security->xss_clean($_POST['staffmob']);

        $id = $this->security->xss_clean($_POST['id']);


        $data = array(
        'staff_name' => $staffName,
            'staff_mobile' => $staffmob,
            'joint_date' => $joint_date,
            'responsibility' => $responsibility
        );

        $result = $this->main_model->updatestaffs($data,$id);
        echo json_encode($result);

    }




    public function delestaff(){
        $staff_id =(int)$this->security->xss_clean($_POST['staff_id']);

        $result = $this->main_model->delestaff($staff_id);
        echo json_encode($result);

    }


    public function loginintowarehouse(){
        $mobNumber = $this->security->xss_clean($_POST['mobNumber']);
        $mobPassword = $this->security->xss_clean($_POST['mobPassword']);

        $result = $this->main_model->loginintowarehouse($mobNumber,$mobPassword);

        if($result=="0"){
            echo json_encode($result);
         }
        else {
        foreach($result as $row){
            $this->session->set_userdata('warehouse_adminid', $row->staff_id);
            $this->session->set_userdata('staff_name', $row->staff_name);
            $this->session->set_userdata('joint_date', $row->joint_date);
            $this->session->set_userdata('responsibility', $row->responsibility);

        }
            echo json_encode($result);
         }


     }

    public function choosesubcategories(){
        $value = $this->security->xss_clean($_POST['value']);
        $result = $this->main_model->choosesubcategories($value);
            echo json_encode($result);

    }

    public function delete_purcahsedetails(){
        $purcahse_details_id = (int)$this->security->xss_clean($_POST['purcahse_details_id']); 
        $this->main_model->delete_purcahsedetails($purcahse_details_id); 

    }

    public function frm_purcahsedetails(){
        $supplier_name_section = $this->security->xss_clean($_POST['supplier_name_section']); 
        $ref_no_forsupplier = $this->security->xss_clean($_POST['ref_no_forsupplier']); 
        $purcahse_date = $this->security->xss_clean($_POST['purcahse_date']); 
        $paid_amount = $this->security->xss_clean($_POST['paid_amount']); 
        $total_amount = $this->security->xss_clean($_POST['total_amount']); 

        if(isset($_FILES['bill_attachmentpic']['name'])){
            
         $config['upload_path']="./assets/img/uploaded_photos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);
        if($this->upload->do_upload("bill_attachmentpic")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $data = array(
                'purcahse_details_ref' => $ref_no_forsupplier, 
                'purcahse_details_date' => $purcahse_date, 
                'purcahse_details_total_payment' => $total_amount, 
                'paid_amount' => $paid_amount, 
                'bill_url' => $pictureName, 
                'supplier_id_fk' => $supplier_name_section
            ); 

            $this->main_model->frm_purcahsedetails($data); 

        }

        }
        else {
            $data = array(
                'purcahse_details_ref' => $ref_no_forsupplier, 
                'purcahse_details_date' => $purcahse_date, 
                'purcahse_details_total_payment' => $total_amount, 
                'paid_amount' => $paid_amount, 
                'supplier_id_fk' => $supplier_name_section
            
            ); 

            $this->main_model->frm_purcahsedetails($data); 


        }

    }

    public function getpurcahsedetailsforsupplier(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 
        $supplier= $this->security->xss_clean($_POST['supplier']); 
        $refrenceno = $this->security->xss_clean($_POST['refrenceno']); 

        $result = $this->main_model->getpurcahsedetailsforsupplier($fromdate, $todate, $supplier,$refrenceno);
        echo json_encode($result);  

    }

    public function updateallproducts(){

        $productName = $this->security->xss_clean($_POST['productName']);
        $product_code = $this->security->xss_clean($_POST['product_code']);
        $brands_name = $this->security->xss_clean($_POST['brands_name']);
        $submitted_date = $this->security->xss_clean($_POST['submitted_date']);
        $categories_name = $this->security->xss_clean($_POST['categories_name']);
        $sub_categories = $this->security->xss_clean($_POST['sub_categories']);
        $mfd = $this->security->xss_clean($_POST['mfd']);
        $exp = $this->security->xss_clean($_POST['exp']);
        $product_cost = $this->security->xss_clean($_POST['product_cost']);
        $product_price = $this->security->xss_clean($_POST['product_price']);
        $quantity = $this->security->xss_clean($_POST['quantity']);
        $alert_quantity = $this->security->xss_clean($_POST['alert_quantity']);
        $description = $this->security->xss_clean($_POST['description']);
       // $picture = $this->security->xss_clean($_POST['uploadedpic']);
    //    $noImage = $this->security->xss_clean($_POST['noImage']);
        $product_unit = $this->security->xss_clean($_POST['product_unit']);

        $supplier_for_product = $this->security->xss_clean($_POST['supplier_for_product']);

        $batchNo = $this->security->xss_clean($_POST['batchNo']);


        $invoiceId = $this->security->xss_clean($_POST['invoiceId']);
        

        $supplier_invoice = $_POST['supplier_invoice'];
        $warehouse_id = $this->security->xss_clean($_POST['warehouse_id']); 


         $additional_amount = $this->security->xss_clean($_POST['additional_amount']);

        if(isset($_FILES['noImage']['name'])){

         $config['upload_path']="./assets/img/uploaded_photos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("noImage")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];


        $data = array(
        'products_code' => $product_code,
            'product_name' => $productName,
            'brand_id' => $brands_name,
            'category_id' => $categories_name,
            'sub_categoryid' => $sub_categories,
            'mfd' => $mfd,
            'exp' => $exp,
            'product_cost' => $product_cost,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'alert_quantity' => $alert_quantity,
            'product_desc' => $description,
            'product_pic' => $pictureName,
            'product_unit' => $product_unit,
            'supplier_det' => $supplier_for_product,
            'batch_no' => $batchNo,
            'invoice_no' => $invoiceId,
            'Invoice_manual' => $supplier_invoice,
            'warehouse_id' => $warehouse_id,
            'additional_amount' => $additional_amount, 
            'static_count_fromsupplier' => $quantity
        );
        $result = $this->main_model->updateallproducts($data, $product_code);
        echo json_encode($result);

             }
            else {
                echo  $this->upload->display_errors();
            }



    }
        else {

        $data = array(
        'products_code' => $product_code,
            'product_name' => $productName,
            'brand_id' => $brands_name,
            'category_id' => $categories_name,
            'sub_categoryid' => $sub_categories,
            'mfd' => $mfd,
            'exp' => $exp,
            'product_cost' => $product_cost,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'alert_quantity' => $alert_quantity,
            'product_desc' => $description,
            'product_unit' => $product_unit,
            'supplier_det' => $supplier_for_product,
            'batch_no' => $batchNo,
            'invoice_no' => $invoiceId,
            'Invoice_manual' => $supplier_invoice, 
            'additional_amount' => $additional_amount,
            'static_count_fromsupplier' => $quantity
        );
        $result = $this->main_model->updateallproducts($data,$product_code);
        echo json_encode($result);

        }



    }


    public function saveallproducts(){
        $productName = $this->security->xss_clean($_POST['productName']);
        $product_code = $this->security->xss_clean($_POST['product_code']);
        $brands_name = $this->security->xss_clean($_POST['brands_name']);
        $submitted_date = $this->security->xss_clean($_POST['submitted_date']);
        $categories_name = $this->security->xss_clean($_POST['categories_name']);
        $sub_categories = $this->security->xss_clean($_POST['sub_categories']);
        $mfd = $this->security->xss_clean($_POST['mfd']);
        $exp = $this->security->xss_clean($_POST['exp']);
        $product_cost = $this->security->xss_clean($_POST['product_cost']);
        $product_price = $this->security->xss_clean($_POST['product_price']);
        $quantity = $this->security->xss_clean($_POST['quantity']);
        $alert_quantity = $this->security->xss_clean($_POST['alert_quantity']);
        $description = $this->security->xss_clean($_POST['description']);
       // $picture = $this->security->xss_clean($_POST['uploadedpic']);
        $noImage = $this->security->xss_clean($_POST['noImage']);
        $product_unit = $this->security->xss_clean($_POST['product_unit']);

        $supplier_for_product = $this->security->xss_clean($_POST['supplier_for_product']);

        $batchNo = $this->security->xss_clean($_POST['batchNo']);


        $invoiceId = $this->security->xss_clean($_POST['invoiceId']);
        $noImage = $this->security->xss_clean($_POST['noImage']);

        $supplier_invoice = $_POST['supplier_invoice'];
        $warehouse_id = $this->security->xss_clean($_POST['warehouse_id']); 


        $additional_amount = $this->security->xss_clean($_POST['additional_amount']); 

        if(isset($_FILES['noImage']['name'])){

         $config['upload_path']="./assets/img/uploaded_photos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("noImage")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];


        $data = array(
        'products_code' => $product_code,
            'product_name' => $productName,
            'brand_id' => $brands_name,
            'category_id' => $categories_name,
            'sub_categoryid' => $sub_categories,
            'mfd' => $mfd,
            'exp' => $exp,
            'product_cost' => $product_cost,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'alert_quantity' => $alert_quantity,
            'product_desc' => $description,
            'product_pic' => $pictureName,
            'product_unit' => $product_unit,
            'supplier_det' => $supplier_for_product,
            'batch_no' => $batchNo,
            'invoice_no' => $invoiceId,
            'Invoice_manual' => $supplier_invoice,
            'warehouse_id' => $warehouse_id,
            'additional_amount' => $additional_amount,
            'static_count_fromsupplier' => $quantity
        );
        $result = $this->main_model->saveproductdetails($data);
        echo json_encode($result);

             }
            else {
                echo  $this->upload->display_errors();
            }



    }
        else {

        $data = array(
        'products_code' => $product_code,
            'product_name' => $productName,
            'brand_id' => $brands_name,
            'category_id' => $categories_name,
            'sub_categoryid' => $sub_categories,
            'mfd' => $mfd,
            'exp' => $exp,
            'product_cost' => $product_cost,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'alert_quantity' => $alert_quantity,
            'product_desc' => $description,
            'product_pic' => $noImage,
            'product_unit' => $product_unit,
            'supplier_det' => $supplier_for_product,
            'batch_no' => $batchNo,
            'invoice_no' => $invoiceId,
            'Invoice_manual' => $supplier_invoice,
            'additional_amount' => $additional_amount,
            'static_count_fromsupplier' => $quantity
        );
        $result = $this->main_model->saveproductdetails($data);
        echo json_encode($result);

        }


    }


    public function deleteproduct(){
        $products_id = (int)$this->security->xss_clean($_POST['products_id']);

        $result = $this->main_model->deleteproduct($products_id);
        echo json_encode($result);


    }

    public function saveoutlets(){
        $outlets_name = $this->security->xss_clean($_POST['outlets_name']);
        $hot_mob_number = $this->security->xss_clean($_POST['hot_mob_number']);
        $outlet_address = $this->security->xss_clean($_POST['outlet_address']);

        $data = array(
        'outlets_name' => $outlets_name,
            'outlet_mob' => $hot_mob_number,
            'addresses' => $outlet_address
        );

        $result = $this->main_model->saveoutlets($data);


    }

     public function delete_outlet(){
         $value = $this->security->xss_clean($_POST['value']);
         $result = $this->main_model->deleteoutlet($value);
         echo json_encode($result);
     }

    public function outletassigned(){
        $out_let_qty =$this->security->xss_clean($_POST['out_let_qty']);
        $balance = $this->security->xss_clean($_POST['balance']);
        $outlet_name = $this->security->xss_clean($_POST['outlet_name']);
        $hidden_product_id = (int)$this->security->xss_clean($_POST['hidden_product_id']);
        $current_quantity_for_outlet = $this->security->xss_clean($_POST['current_quantity_for_outlet']); 

       

        $outlet_data = array(
        'outlet_id' => $outlet_name,
            'product_id' => $hidden_product_id,
            'product_quantity' => $out_let_qty
        );


        echo $this->main_model->saveinoutlets($outlet_data,$hidden_product_id,$out_let_qty);

        $result = $this->main_model->updateproductsection($balance,$hidden_product_id);
      //  echo json_encode($result);


    }

    public function saveadmindetails(){
        $admin_name = $this->security->xss_clean($_POST['admin_name']);
        $admin_mobile = $this->security->xss_clean($_POST['admin_mobile']);
        $admin_gmail = $this->security->xss_clean($_POST['admin_gmail']);

        $result = $this->main_model->saveadmindetails($admin_name,$admin_mobile,$admin_gmail);
        echo json_encode($result);


    }


    public function changepassword(){
        $current_password =  $this->security->xss_clean($_POST['current_password']);
        $newPassword =  $this->security->xss_clean($_POST['newPassword']);


        $result = $this->main_model->changepassword($current_password,$newPassword);
        echo json_encode($result);


    }


     public function checkavailableproductscount(){
        $result = $this->main_model->checkavailableproductscount();
        echo json_encode($result);



     }

     public function showAdmindetails(){
        $result = $this->main_model->showAdmindetails();
        echo json_encode($result);

      }


    public function checkProductcodeExist(){
        $value = $this->security->xss_clean($_POST['value']);
        $result = $this->main_model->checkProductcodeExist($value);
        echo json_encode($result);
    }


 
    public function refillquantity(){
        $product_id =(int)$this->security->xss_clean($_POST['product_id']);
        $refill_quantity =(int)$this->security->xss_clean($_POST['refill_quantity']);

        $result = $this->main_model->refillquantity($product_id,$refill_quantity);
        echo json_encode($result);
    }

    


        public function createInvoice(){
            $result = $this->main_model->createInvoice();
             echo $result;
        }

    public function saveupperbatch(){
        $invoiceId = $this->security->xss_clean($_POST['invoiceId']);
        $result = $this->main_model->saveupperbatch($invoiceId);
        echo json_encode($result);
    }

    public function expensesType(){
        $expensesName = $this->security->xss_clean($_POST['expensesName']);
        $result = $this->main_model->expensesType($expensesName);
        echo json_encode($result);
    }

    public function deleteexpenses(){
        $expenseId =(int)$this->security->xss_clean($_POST['expenseId']);
        $result = $this->main_model->deleteexpenses($expenseId);
        echo json_encode($result);
    }

    public function saveexpensesList(){
       $expense_amout = $this->security->xss_clean($_POST['expense_amout']);
       $date_of_expense = $this->security->xss_clean($_POST['date_of_expense']);
       $expense_note = $this->security->xss_clean($_POST['expense_note']);
       $expenses_type = $this->security->xss_clean($_POST['expenses_type']);

        $data = array(
        'expense_type' => $expenses_type,
            'expense_note' => $expense_note,
            'expense_date' => $date_of_expense,
            'expense_amount' => $expense_amout
        );
        $result = $this->main_model->saveexpensesList($data);


    }


    public function removelistexpense(){
        $exp_id = $this->security->xss_clean($_POST['exp_id']);
        $result = $this->main_model->removelistexpense($exp_id);
    }

    public function activecashierbtn(){
        $staff_id = (int)$this->security->xss_clean($_POST['staff_id']);

        $result = $this->main_model->activecashierbtn($staff_id);

    }

     public function activeforwarehouse(){
         $staff_id = (int)$this->security->xss_clean($_POST['staff_id']); 
         $result = $this->main_model->activeforwarehouse($staff_id);
         echo json_encode($result); 
     }

        public function inactivecashierbtn(){
        $staff_id = (int)$this->security->xss_clean($_POST['staff_id']);

        $result = $this->main_model->inactivecashierbtn($staff_id);
        echo json_encode($result);
    
    }

    public function inactivewarehouse(){
        $staff_id = (int)$this->security->xss_clean($_POST['staff_id']);

        $result = $this->main_model->inactivewarehouse($staff_id);
        echo json_encode($result);
    

    }



    public function savechequedetails(){
        $cheque_no = $this->security->xss_clean($_POST['cheque_no']);
        $cheqe_date = $this->security->xss_clean($_POST['cheqe_date']);
        $bank_name = $this->security->xss_clean($_POST['bank_name']);
        $amount = $this->security->xss_clean($_POST['amount']);


        $data = array(
        'cheque_no' => $cheque_no,
            'cheque_date' => $cheqe_date,
            'amount' => $amount,
            'status' => 'Pending',
            'bank_name' => $bank_name

        );

        $result = $this->main_model->savechequedetails($data);

    }

    public function listallchecksection(){
        $result = $this->main_model->listallchecksection();
        echo json_encode($result);
    }

    public function getindividulareport(){
          $person_details = (int)$this->security->xss_clean($_POST['person_details']);
        $result = $this->main_model->getindividulareport($person_details);
        echo json_encode($result);
    }


    public function mainloginareaforadmin(){
     $mobileNumber = $this->security->xss_clean($_POST['mobNumber']);
     $mobPassword = $this->security->xss_clean($_POST['mobPassword']);

        $time = $this->security->xss_clean($_POST['time']); 

        
        $agent = '';


        $this->load->library('user_agent');

        if ($this->agent->is_browser())
        {
                $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
                $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
                $agent = $this->agent->mobile();
        }
        else
        {
                $agent = 'Unidentified User Agent';
        }

        $ipaddress = md5(
            $_SERVER['REMOTE_ADDR'] .
            $_SERVER['HTTP_USER_AGENT']
        );

       $result = $this->main_model->mainloginareaforadmin($mobileNumber,$mobPassword);


    if($result=="0"){
            echo 0;
         }
        else {
            $this->main_model->getagentdetailsforadmin($agent,$this->agent->platform(),$time,$ipaddress);


        foreach($result as $row){
            
            $this->session->set_userdata('admin_id', $row->admin_id);

        }
            echo json_encode($result);

        }



    }

  
    public function mainlogout(){
        echo $this->session->sess_destroy();
    }

    public function fetchallindividualdiscount(){
        if(count($this->cart->contents())!=0){
            $actualprice = 0.00; 
            $discountedamount = 0.00; 
            $answer = 0; 
            foreach($this->cart->contents() as $items){
                $actualprice+=floatval($items['actual_price']) * $items['qty']; 
                $discountedamount+=floatval($items['price']) * $items['qty']; 
            }
            $answer = ($actualprice - $discountedamount); 
            echo number_format($answer,2); 
        }
    }


    public function addtocartshoppingcart(){
        $this->load->library('cart');
           $type = 'sales';


        if(count($this->cart->contents())==0){
             
             $data = array(
        'id'      => $_POST['product_id'],
        'qty'     => 1,
        'price'   =>  $_POST['product_price'],
        'name'    => $_POST['product_name'],
        'availablequantity' => $_POST['availablequantity'],
        'product_pic' => $_POST['product_pic'],
        'product_unit' => $_POST['product_unit'],
        'product_code' => $_POST['product_code'],
        'type' => $type,
        'actual_price' => $_POST['product_price']

        );

        $mydata = array(
            'id'      => $_POST['product_id'],
            'qty'     => 1,
            'price'   =>  $_POST['product_price'],
            'name'    => $_POST['product_name'],
            'availablequantity' => $_POST['availablequantity'],
            'product_pic' => $_POST['product_pic'],
            'product_unit' => $_POST['product_unit'],
            'product_code' => $_POST['product_code'],
            'type' => $type,
            'actual_price' => $_POST['product_price'],
            'outlet_id' => $this->session->outlet_id
    
            );



       // $this->main_model->saveshoppingcartfortemp($mydata); 
        echo $this->cart->insert($data);
        exit(); 
 
        }
        else {

            foreach($this->cart->contents() as $items){
                if($items['type']!=$type){
                    $this->cart->destroy();
                    if($items['id']==$_POST['product_id']){
                        $data = array(
                            'id'      => $_POST['product_id'],
                            'qty'     => 1,
                            'price'   => $_POST['product_price'],
                            'name'    => $_POST['product_name'],
                            'availablequantity' => $_POST['availablequantity'],
                            'product_pic' => $_POST['product_pic'],
                            'product_unit' => $_POST['product_unit'],
                            'product_code' => $_POST['product_code'],
                            'type' => $type,
                            'actual_price' => $_POST['product_price']
                    
                            );
                                 echo $this->cart->insert($data);
                            exit(); 
                    }
                    else {
                        $data = array(
                            'id'      => $_POST['product_id'],
                            'qty'     => 1,
                            'price'   => $_POST['product_price'] ,
                            'name'    => $_POST['product_name'],
                            'availablequantity' => $_POST['availablequantity'],
                            'product_pic' => $_POST['product_pic'],
                            'product_unit' => $_POST['product_unit'],
                            'product_code' => $_POST['product_code'],
                            'type' => $type,
                            'actual_price' => $_POST['product_price']
                    
                            );
                            echo $this->cart->insert($data);
                            exit(); 

                    }
                 

     
          // echo $this->cart->insert($data);
 
                }
                else {
                    if($items['id']==$_POST['product_id']){
                        $data = array(
                            'id'      => $_POST['product_id'],
                            'qty'     => 1,
                            'price'   =>$_POST['product_price'],
                            'name'    => $_POST['product_name'],
                            'availablequantity' => $_POST['availablequantity'],
                            'product_pic' => $_POST['product_pic'],
                            'product_unit' => $_POST['product_unit'],
                            'product_code' => $_POST['product_code'],
                            'type' => $type,
                            'actual_price' => $_POST['product_price']
                    
                            );
                      
                            $this->cart->insert($data); 
                            exit(); 

                    }
                    else {
                        $data = array(
                            'id'      => $_POST['product_id'],
                            'qty'     => 1,
                            'price'   => $_POST['product_price'],
                            'name'    => $_POST['product_name'],
                            'availablequantity' => $_POST['availablequantity'],
                            'product_pic' => $_POST['product_pic'],
                            'product_unit' => $_POST['product_unit'],
                            'product_code' => $_POST['product_code'],
                            'type' => $type,
                            'actual_price' => $_POST['product_price']
                    
                            );
                            
                            $this->cart->insert($data); 
                            exit(); 
                    }

       


 

                }

            } //end of loop


 //echo  $this->cart->insert($data);
        }







    }



    //whileback
    public function addproductsforreturn(){
        $product_name = $this->security->xss_clean($_POST['product_name']);
        $price = $this->security->xss_clean($_POST['price']);
        $discount = $this->security->xss_clean($_POST['discount']);
        $discounted_amount = $this->security->xss_clean($_POST['discounted_amount']);
        $total_amount = $this->security->xss_clean($_POST['total_amount']);
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);
        $products_code = $this->security->xss_clean($_POST['products_code']);
        $return_quantity_val = $this->security->xss_clean($_POST['return_quantity_val']);
        $products_code = $this->security->xss_clean($_POST['products_code']);
        $product_id = $this->security->xss_clean($_POST['product_id']);
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);

        $type='returned';

        $choosen_quantity = $this->security->xss_clean($_POST['choosen_quantity']);

        if(count($this->cart->contents())==0){

            $data = array(
                    'id'      => $product_id,
                    'qty'     => $return_quantity_val,
                    'price'   => $price,
                    'name'    => $product_name,
                    'availablequantity' => 1,
                    'product_code' => $products_code,
                    'type' => $type,
                    'summery_id' => $order_summery_id
                              );
                      $this->cart->insert($data);



        }
        else {
            #if cart is not empty

            foreach($this->cart->contents() as $items){

                if($items['type']==$type){


                    if($items['qty'] <= $choosen_quantity){

                        $data = array(
                    'id'      => $product_id,
                    'qty'     => $return_quantity_val,
                    'price'   => $price,
                    'name'    => $product_name,
                    'availablequantity' => 1,
                    'product_code' => $products_code,
                    'type' => $type,
                    'summery_id' => $order_summery_id
                              );
                      $this->cart->insert($data);

                    }

 
                }
                else {
                        $this->cart->destroy();
                     if($items['qty'] <= $choosen_quantity){

                        $data = array(
                    'id'      => $product_id,
                    'qty'     => $return_quantity_val,
                    'price'   => $price,
                    'name'    => $product_name,
                    'availablequantity' => 1,
                    'product_code' => $products_code,
                    'type' => $type,
                    'summery_id' => $order_summery_id
                              );
                      $this->cart->insert($data);

                    }


                }


                #end of if for type





            } #endof foreach

        } #end of else

        echo json_encode($this->cart->contents());

    }




    public function holdorders(){
        $datetime = $this->security->xss_clean($_POST['datetime']);

        $resultsaveholdcenter = $this->main_model->saveshoppinghold($datetime,$this->session->customer_id,$this->cart->format_number($this->cart->total()),$this->session->outlet_id);

        $this->session->set_userdata('holder_id',$resultsaveholdcenter);
        if($resultsaveholdcenter!=0){

            foreach($this->cart->contents() as $items){
                $data = array(
                'sh_products_id' => $items['id'],
                    'quantity' => $items['qty'],
                    'shopping_hold_id' => $resultsaveholdcenter,
                    'product_code' => $items['product_code'], 
                    'actual_price' => $items['actual_price']

                );
                $result = $this->main_model->saveproductsforhold($data);
                $this->cart->destroy();
            }


        }


    }

    public function create_invoice_id(){

        $result = $this->main_model->create_invoice_id();
       echo json_encode($result);
    }

    public function reduceProductQuantity(){
        $summeryid = $this->security->xss_clean($_POST['summeryid']); 
        $todydate = $this->security->xss_clean($_POST['todydate']);

        $nametaker = ''; 
        
        $last_insert_id =(int)$summeryid;

        $outletid = $this->session->outlet_id; 


        foreach($this->cart->contents() as $items){
            $currentQuantity = (int)$items['qty'];
            $availablequantity = (int)$items['availablequantity'];
            $outletid = (int)$this->session->userdata('outlet_id');
            $answer = $availablequantity - $currentQuantity;
            $productid = (int)$items['id'];
            $nametaker = $items['name']; 

            $result =  $this->main_model->reduceProductQuantity($answer,$productid,$outletid);


        }


            foreach($this->cart->contents() as $items){
            $currentQuantity = (int)$items['qty'];
             $productid = (int)$items['id'];

            $data = array(
                'summery_id' => $last_insert_id,
                'product_id' => $productid,
                'choosen_quantity' => $currentQuantity,
                'status' => 1,
                'sub_total' => $items['price'], 
                'actual_price' => $items['actual_price'],
                'product_code_no' => $items['product_code']
            );

            $datafordetailsproduct = array(
                'Name' => $nametaker,
                'quantity' => $currentQuantity, 
                'product_id' => $productid,
                'outlet_id' => $outletid
        
            ); 


            $result = $this->main_model->saveorderdetails($data);
             $this->main_model->savedatafordetailsproduct($datafordetailsproduct,$productid,$outletid,$last_insert_id,$nametaker,$currentQuantity,$productid,$outletid,$todydate); 


        }

        $this->printinvoicesettings();
       //$this->load->view('salesunit/printinvoice');
    //    $this->cart->destroy();
    }

    public function reprintsection($summeryiddata){
       
        $allsummerydetails = $this->main_model->getallsummerydetails($summeryiddata,$this->session->outlet_id); 
        

        if($allsummerydetails!=0){
            foreach($allsummerydetails as $details){
                $data['ordered_date'] = $details->ordered_date; 
                $data['invoice_id_no'] = $details->order_summery_id;
                $data['addtional_information'] = $details->additional_text; 
                $data['discount_percentage'] = $details->discount_from_total_amount;
                $data['recieved_amount_fromcus'] = $details->recieved_amount_fromcus; 
                $data['balance_amount_from_cus'] = $details->balance_amount_from_cus; 
                $data['discount'] = $details->discount; 
                $data['discountedamount'] = $details->discounted_amount; 
                $data['before_discount_sub_total'] = $details->total_amount; 
                $data['paying_amount'] = $details->paying_amount; 
                $data['discount_percentage'] = $details->discount_percentage; 
                $data['subtract'] = $details->subtract; 
                $data['discount_amount'] = $details->discount_amount; 
                $data['individual_discountamount'] = $details->individual_discountamount; 
               
            }
        }

        $getallproductdetails = $this->main_model->getproductdetailssectionforreprint($summeryiddata, $this->session->outlet_id); 
        
        $data['boughproducts'] = $getallproductdetails; 

        $this->load->view('salesunit/reprintinvoice', $data); 
          
    }


    public function deletesessionforcarts(){
        $this->load->library("cart");
       
        $this->cart->destroy();
      $this->session->set_userdata('mainbalance',0);
      $this->session->set_userdata('subtractedamountfromtotal',0); 

       
    }

    public function getordersummeryid(){
        $result = $this->main_model->getordersummeryid();

    }

    public function passwordverificationfordelete(){
        $password_to_delete = $this->security->xss_clean($_POST['password_to_delete']); 
        $result = $this->main_model->passwordverificationfordelete($password_to_delete); 
        echo $result; 
    }
    
    public function updateoutletsections(){
        $name = $this->security->xss_clean($_POST['name']); 
        $mobile = $this->security->xss_clean($_POST['mobile']); 
        $address = $this->security->xss_clean($_POST['address']); 
        $id = (int) $this->security->xss_clean($_POST['id']); 

        $data = array(
            'outlets_name' => $name, 
            'outlet_mob' => $mobile, 
            'addresses' => $address
        ); 

        $result = $this->main_model->updateoutletsections($data,$id);
        echo $result;  
    

    }


    public function printinvoicesettings(){
        $data['given_amount'] = $this->session->given_amount;

         $outletid = (int)$this->session->outlet_id;
        $result  = $this->main_model->getallsaveddetailsalong($outletid);

        $data['invoice_id'] = $this->main_model->getordersummeryid();

 
        foreach($result as $res){
            $data['before_discount_sub_total'] = $res->total;
            $data['paying_amount'] = $res->paying_amount;
            $data['discount_percentage'] = $res->discount;
            $data['subtract'] =$res->subtract;
            $data['discount_amount'] = $res->discount_amount;
        }

          $this->load->view('salesunit/printinvoice',$data);
           //$this->cart->destroy();
    }
 


    public function savecurrentdateinsession(){
        $currentdate = $this->security->xss_clean($_POST['currentdate']); 
        $this->session->set_userdata('currentdate',$currentdate); 
    }

    public function setdatesforsumemry(){
        $fromdate = $this->security->xss_clean($_POST['fromdate'])=='' ? null : $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate'])=='' ? null : $this->security->xss_clean($_POST['todate']); 
         $this->session->set_userdata('todaydateforsummery',$this->security->xss_clean($_POST['todaydate'])); 

        $this->session->set_userdata('fromdateforsummery',$fromdate); 
        $this->session->set_userdata('todateforsummery',$todate); 

    }
    
 
    public function printotalsummerydetails(){

         
        $fromdatesectionline =  $this->session->fromdateforsummery; 
        $todatelinesection= $this->session->todateforsummery; 
        $todaydate = $this->session->todaydateforsummery;

      
        
        $result = $this->main_model->getsalessummerydataforprint($this->session->outlet_id,$fromdatesectionline,$todatelinesection,$this->session->currentdate); 
        if($result!=0){
            foreach($result as $res){
                $data['cash_in_hand'] = $res->cash_in_hand; 
                $data['cash_payment'] = $res->cash_payment; 
                $data['credit_payment'] = $res->credit_payment; 
                $data['cheque_payment'] = $res->cheque_payment; 
                $data['refunded_amount'] = $res->refunded_amount; 
                $data['date'] = $res->date; 
                $data['expenses_amount_reg'] = $res->expenses_amount_reg;
                $data['recieveddebt_forregister'] = $res->recieveddebt_forregister; 
                 
            }
        }

        $this->load->view('salesunit/reports',$data);
    }


    public function gotoreturnsalesunit(){

         foreach($this->cart->contents() as $items){
             $data['invoice_id'] = $items['summery_id'];
         }

         $this->load->view('salesunit/salesreturninvoice',$data);
    }


    public function gettotal(){
           if(empty($this->cart->contents())){

            exit();
        }
        else {
            foreach($this->cart->contents() as $items){
                ?>
                     <tr class="text text-center">
                            <td><?php echo $items['name']?></td>
                            <td><?php echo $items['product_unit']?></td>
                            <td><?php echo $items['qty']?></td>
                            <td><?php echo $this->cart->format_number($items['price']);?></td>
                            <td><?php echo $this->cart->format_number($items['subtotal']);?></td>
                        </tr>
                <?php
            }



        }

    }



    public function getsubtotalanddiscount(){
        $totalsubtotal = 0;
        foreach($this->cart->contents() as $counteritem){
            $totalsubtotal+=$counteritem['subtotal'];
        }
        echo number_format($totalsubtotal,2);
    }


    public function getdataforprintfromshoppingcart(){
         if(empty($this->cart->contents())){

            exit();
        }


        foreach($this->cart->contents() as $items){
            ?>
            <tr class="service">
                <td class="tableitem"><p class="itemtext"><?php echo $items['name']?></p></td>
                 <td class="tableitem"><p class="itemtext"><?php echo $items['qty']?></p></td>
                <td class="tableitem"><p class="itemtext"><?php echo $this->cart->format_number($items['price']);?></p></td>

                <td class="tableitem"><p class="itemtext"><?php echo $this->cart->format_number($items['subtotal']);?></p></td>
            </tr>
            <?php
        }

    }


    public function fetchAllshoppingcartdata(){

        if(empty($this->cart->contents())){

            exit();
        }

        foreach($this->cart->contents() as $items){

            ?>

        <?php if($items['type']=='sales'):?>
           <tr>
        <td>
            <figure class="media">
                <div class="img-wrap">
                <?php if(substr($items['product_pic'],0,5)=='https'):?>
                <img src="<?php echo $items['product_pic']?>" class="img-thumbnail img-xs">
                <?php else:?>
                <img src="<?php echo base_url()?>assets/img/uploaded_photos/<?php echo $items['product_pic']?>" class="img-thumbnail img-xs">
                <?php endif;?>

                </div>
                <figcaption class="media-body">
                    <h6 class="title text-truncate"><?php echo $items['name'];?></h6> <br/>
                

                </figcaption>
            </figure>
        </td>
        <td class="text-center">
            <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                <button type="button" product_code="<?php echo $items['product_code']?>" myid="<?php echo $items['id']?>" class="m-btn btn btn-default decreasequantity" qty="<?php echo $items['qty']?>"  rowid="<?php echo $items['rowid']?>"><i class="fa fa-minus"></i></button>
                <input type="tel"   availablequantity="<?php echo $items['availablequantity']?>" rowid="<?php echo $items['rowid']?>" class="fullquantity_fromcashier text-center" value="<?php echo $items['qty']?>" style="max-width:50px;">
<!--
                <button type="button" class="m-btn btn btn-default fullquantity" readonly>
                    <?php echo $items['qty']?>
                </button>
-->
                <button type="button" product_code="<?php echo $items['product_code']?>" availablequantity="<?php echo $items['availablequantity']?>" myid="<?php echo $items['id']?>" class="m-btn btn btn-default increasequantity <?php echo $items['rowid']?>" qty="<?php echo $items['qty']?>" rowid="<?php echo $items['rowid']?>"><i class="fa fa-plus"></i></button>
            </div>
        </td>
    <?php
            $this->session->set_userdata('row_id', $items['rowid']);
        ?>
        <td class="product_quantity_xs_time" rowid="<?php echo $items['rowid']?>">
 
            <?php echo $items['product_code']?>
        </td>
        <td>
            <?php echo $items['product_unit']?>
        </td>
        <td>
           
            <?php echo number_format($items['actual_price'],2)?>
        </td>
        <td>
            <div class="price-wrap">
                    <var class='price'>
                    <a href="javascript:void(0);" class="btn btn-link edit_price_update" rowid='<?= $items['rowid']?>'><?php echo $this->cart->format_number($items['price']);?></a>
                    </var>
            </div>
            <!-- price-wrap .// -->
        </td>
        <td>
        <var class="price"><?php echo $this->cart->format_number($items['subtotal']);?></var>
        </td>
        <td class="text-right">
            <a href="javascript:void(0);" class="btn btn-outline-danger btn-round deleteproduct" rowid="<?php echo $items['rowid']?>"> <i class="fa fa-trash"></i></a>
        </td>
    </tr>
        <?php endif;?>

    <?php
        }

     }

    public function fetchDatafordiscount(){
          $value = $this->security->xss_clean($_POST['percentagevalue']);
                  $data = array(
             'total' => $this->cart->format_number($this->cart->total() - $value),
            'row_id' => $this->session->row_id,
            'valuetototal' => $this->cart->total()
        );

         echo json_encode($data);
    }



    public function decreasequantity(){
        $qty = $this->security->xss_clean($_POST['qty']);
        $rowid = $this->security->xss_clean($_POST['rowid']);

         $data = array(
        'rowid' => $rowid,
        'qty'   => ($qty -1)
        );

$this->cart->update($data);


    }
    public function changequantitysectionfromcashier(){
        $value = $this->security->xss_clean($_POST['value']); 
        $rowid = $this->security->xss_clean($_POST['rowid']); 

        $data = array(
            'rowid' => $rowid, 
            'qty' => $value
            
        ); 
        echo $this->cart->update($data);
        
    }


    public function increasequantity(){
        $qty = $this->security->xss_clean($_POST['qty']);
        $rowid = $this->security->xss_clean($_POST['rowid']);

         $data = array(
        'rowid' => $rowid,
        'qty'   => ($qty + 1)
        );

$this->cart->update($data);


    }

    public function increasequantitybybarcode(){
        $rowid = $this->security->xss_clean($_POST['rowid']); 
        $qty = 1; 

        $data = array(
            'rowid' => $rowid,
            'qty'   => ($qty + 1)
            );
    
  $result = $this->cart->update($data);
            echo $result; 
    
    } 



    public function deleteproductforcart(){
        $rowid = $this->security->xss_clean($_POST['rowid']);

         $this->cart->remove($rowid);
    }

    public function deletedraftsection(){
        $shopping_hold = (int)$this->security->xss_clean($_POST['shopping_hold']);
        $result = $this->main_model->deetedraftsection($shopping_hold);
    }



    public function removeallincart(){
        $this->session->set_userdata('subtractedamountfromtotal',0); 
        $this->session->set_userdata('mainbalance',0); 
        $this->cart->destroy();
    }

    public function searchsalesfordate(){
        $from_date = $this->security->xss_clean($_POST['from_date']);
        $to_date = $this->security->xss_clean($_POST['to_date']);
        $outlet_id = $this->session->outlet_id;
        $result = $this->main_model->searchsalesfordate($from_date,$to_date,$outlet_id);

        echo json_encode($result);


    }

    public function getallproductdetailsforbarcode(){
        $result = $this->main_model->getallproductdetailsforbarcode();
        echo json_encode($result);
    }

    public function getpoductbysearching(){
        $value = $this->security->xss_clean($_POST['value']);

         $result = $this->main_model->getpoductbysearching($value);
        echo json_encode($result);
    }



    public function sales_report_product(){
        $result = $this->main_model->sales_report_product();
        echo json_encode($result);
    }



    public function search_sales_report_product(){
        $outlet_details = $this->security->xss_clean($_POST['outlet_details']);
        $from_date_for_sale_report = $this->security->xss_clean($_POST['from_date_for_sale_report']);
        $end_date = $this->security->xss_clean($_POST['end_date']);

       $result = $this->main_model->search_sales_report_product($outlet_details,$from_date_for_sale_report,$end_date);
        echo json_encode($result);
    }




    public function getsoldproductdetails(){
        $outlet_id = $this->security->xss_clean($_POST['outlet_id']);
        $invoice_no = $this->security->xss_clean($_POST['invoice_no']);
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);

        $result = $this->main_model->getsoldproductdetails($outlet_id,$invoice_no,$order_summery_id);
        echo json_encode($result);


    }

    public function showcustomerdetailsforsales(){
        $customer_id = $this->security->xss_clean($_POST['customer_id']);
        $result = $this->main_model->showcustomerdetailsforsales($customer_id);
        echo json_encode($result);
    }


    public function takeProfitsandsalesdetails(){

        $myoutletid = $this->security->xss_clean($_POST['myoutletid']);
        $fromdate = $this->security->xss_clean($_POST['fromdate']);
        $todate = $this->security->xss_clean($_POST['todate']);
        $result = $this->main_model->takeProfitsandsalesdetails($myoutletid,$fromdate,$todate);
        echo json_encode($result);
    }

    public function getpurchaseDue(){
        $result = $this->main_model->getpurchaseDue();
        echo json_encode($result);
    }

    public function getotherxpenes(){
        $outletid = $this->security->xss_clean($_POST['outletid']);
        $fromdate = $this->security->xss_clean($_POST['fromdate']);
        $todate = $this->security->xss_clean($_POST['todate']);

        $result = $this->main_model->getotherxpenes($outletid,$fromdate,$todate);
        echo json_encode($result);

    }


    public function getoutletcredits(){
        $myoutletid = $this->security->xss_clean($_POST['myoutletid']);
        $fromdate = $this->security->xss_clean($_POST['fromdate']);
        $todate = $this->security->xss_clean($_POST['todate']);

        $result = $this->main_model->getoutletcredits($myoutletid,$fromdate,$todate);
        echo json_encode($result);
    }






    public function checknamexist(){
        $create_group_name = $this->security->xss_clean($_POST['create_group_name']);
        $result = $this->main_model->checknamexist($create_group_name);
        echo $result;
    }

    public function creategroupsforsms(){
        $create_group_name = $this->security->xss_clean($_POST['create_group_name']);
        $result = $this->main_model->creategroupsforsms($create_group_name);

    }

    public function deletegroupforsms(){
        $value = $this->security->xss_clean($_POST['value']);
        $result = $this->main_model->deletegroupforsms($value);
        echo json_encode($result);
    }


    public function updategroupname(){
        $update_create_group_name = $this->security->xss_clean($_POST['update_create_group_name']);
        $group_id = $this->security->xss_clean($_POST['group_id']);

        $result = $this->main_model->updategroupname($update_create_group_name,$group_id);



    }

    public function getcontactdetailsforsms(){
        $group_id = (int)$this->security->xss_clean($_POST['group_id']);
        $result = $this->main_model->getcontactdetailsforsms($group_id);
        echo json_encode($result);
    }

    public function deletecontactdetails(){
        $customer_id = $this->security->xss_clean($_POST['customer_id']);
        $result = $this->main_model->deletecontactdetails($customer_id);

     }

    public function checkinggroupexisting(){
        $customer_id = $this->security->xss_clean($_POST['customer_id']);
        $group_id = $this->security->xss_clean($_POST['group_id']);
        $result = $this->main_model->checkinggroupexisting($customer_id,$group_id);
        echo $result;

    }

    public function savecontact_details_forsms(){
        $customer_id = $this->security->xss_clean($_POST['customer_id']);
        $group_id = $this->security->xss_clean($_POST['group_id']);
        $result = $this->main_model->savecontact_details_forsms($customer_id,$group_id);
    }

    public function addcustomers_to_group_for_smssection(){
        $group_id = $this->security->xss_clean($_POST['group_id']);
        $customer_id = $this->security->xss_clean($_POST['customer_id']);


        $result = $this->main_model->addcustomers_to_group_for_smssection($group_id,$customer_id);
        echo $result;



    }



    public function frm_first_ads_section(){

         if(isset($_FILES['img']['name'])){

         $config['upload_path']="./assets/customerdisplayads/";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("img")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $result = $this->main_model->frm_first_ads_section($pictureName);

            echo json_encode(array('Result' =>$result));
            }
            else {
                echo  $this->upload->display_errors();
            }

        }
        else {
              echo  $this->upload->display_errors();
        }



    }


    public function frm_second_ads_section(){

         if(isset($_FILES['img']['name'])){

         $config['upload_path']="./assets/customerdisplayads/";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("img")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $result = $this->main_model->frm_second_ads_section($pictureName);

            echo json_encode(array('Result' =>$result));
            }
            else {
                echo  $this->upload->display_errors();
            }

        }
        else {
              echo  $this->upload->display_errors();
        }



    }



    public function frm_third_ads_section(){

         if(isset($_FILES['img']['name'])){

         $config['upload_path']="./assets/customerdisplayads/";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);

              if($this->upload->do_upload("img")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $result = $this->main_model->frm_third_ads_section($pictureName);

            echo json_encode(array('Result' =>$result));
            }
            else {
                echo  $this->upload->display_errors();
            }

        }
        else {
              echo  $this->upload->display_errors();
        }



    }


     public function frm_forth_ads_section(){

         if(isset($_FILES['img']['name'])){

         $config['upload_path']="./assets/customerdisplayads/";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("img")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $result = $this->main_model->frm_forth_ads_section($pictureName);

            echo json_encode(array('Result' =>$result));
            }
            else {
                echo  $this->upload->display_errors();
            }

        }
        else {
              echo  $this->upload->display_errors();
        }



    }



    public function first_ads_remove(){
        $this->main_model->first_ads_remove();
    }


    public function remove_second_ads_section(){
        $this->main_model->remove_second_ads_section();
    }



    public function remove_third_ad_section(){
        $this->main_model->remove_third_ad_section();
    }

    public function fourth_remove_pic(){
        $this->main_model->fourth_remove_pic();
    }



    public function general_settings_update_section(){
         $hotline_number = $this->security->xss_clean($_POST['hotline_number']);
         $company_name = $this->security->xss_clean($_POST['company_name']);
         $company_address = $this->security->xss_clean($_POST['company_address']);

        $result = $this->main_model->general_settings_update_section($hotline_number,$company_name,$company_address);
        echo $result;


    }


    public function savegeneralsettings(){
        $company_name = $this->security->xss_clean($_POST['company_name']);
        $company_address = $this->security->xss_clean($_POST['company_address']);
        $company_hotline = $this->security->xss_clean($_POST['company_hotline']);


        if(isset($_FILES['imageUpload']['name'])){

         $config['upload_path']="./assets/logoimage/";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);


             if($this->upload->do_upload("imageUpload")){
            $data = $this->upload->data();
            $pictureName = $data['file_name'];

            $result = $this->main_model->savegeneralsettings($pictureName,$company_name,$company_address,$company_hotline);

            echo json_encode(array('Result' =>$result));

            }
            else {
                echo  $this->upload->display_errors();
            }

        }
        else {
              $pictureName = '';
              $result = $this->main_model->savegeneralsettings($pictureName,$company_name,$company_address,$company_hotline);
        echo json_encode(array('Result' =>$result));
        }





    }


    public function searchinvoicebasedpurchase(){
        $from_date = $this->security->xss_clean($_POST['from_date']);
        $to_date = $this->security->xss_clean($_POST['to_date']);

        $outletid = (int)$this->session->userdata('outlet_id');

        $result = $this->main_model->searchinvoicebasedpurchase($from_date,$to_date,$outletid);
        echo json_encode($result);

    }


    public function savetemporarydateforsale(){
        $discountpercentage = $this->security->xss_clean($_POST['discountpercentage']);
        $subtractamounttotally = $this->security->xss_clean($_POST['subtractamounttotally']);
        $totalamount = $this->security->xss_clean($_POST['totalamount']);
        $amounttoshowoffpaying = $this->security->xss_clean($_POST['amounttoshowoffpaying']);

        $dicountvalue = $this->security->xss_clean($_POST['dicountvalue']);
        $individualdiscountamount = $this->security->xss_clean($_POST['individualdiscountamount']); 

                $outletid = (int)$this->session->outlet_id;

        $data = array(
        'discount' => $discountpercentage,
            'subtract' => $subtractamounttotally,
            'discount_amount' => $dicountvalue,
            'total' =>  $totalamount,
            'paying_amount' => $amounttoshowoffpaying,
            'outlet_id' => $outletid,
            'individual_total_discountamount' => $individualdiscountamount
        );

        $result = $this->main_model->savetemporarydateforsale($data,$outletid);
        echo $result;

    }


    public function savegiven_balance()
    {
        $given_amount = $this->security->xss_clean($_POST['given_amount']);
         $this->session->set_userdata('given_amount',$given_amount);
    }

    public function getproductdetails(){
          $outletid = (int)$this->session->userdata('outlet_id');
     $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);
     $result = $this->main_model->getproductdetails($order_summery_id);

     echo json_encode($result);



    }


    public function getallsaveddetailsalong(){
         $outletid = (int)$this->session->userdata('outlet_id');
        $result = $this->main_model->getallsaveddetailsalong($outletid);
        echo json_encode($result);
    }

    public function savetemporaryforsalesunitreturn(){
        $return_quantity_val = $this->security->xss_clean($_POST['return_quantity_val']);
        $hidden_order_summery_id = $this->security->xss_clean($_POST['hidden_order_summery_id']);


        $product_id = $this->security->xss_clean($_POST['product_id']);
        $product_name = $this->security->xss_clean($_POST['product_name']);
        $price = $this->security->xss_clean($_POST['price']);


          $outletid = (int)$this->session->userdata('outlet_id');

        $data = array(
            'qty' => $return_quantity_val,
            'product_name' => $product_name,
            'price' => $price,
            'order_summery_id_fk' => $hidden_order_summery_id,
            'outlet_id' => $outletid,
            'product_id' => $product_id
        );

        $result = $this->main_model->savetemporaryforsalesunitreturn($data);
        echo json_encode($result);

    }


    public function product_details_to_display_forinvoice_return(){
        $outletid = (int)$this->session->userdata('outlet_id');

        $result = $this->main_model->product_details_to_display_forinvoice_return($outletid);
        echo json_encode($result);

    }

    public function deltetemporarycopy(){
        $outletid = (int)$this->session->userdata('outlet_id');
        $this->main_model->deltetemporarycopy($outletid);

    }


    public function bringcheckdetailstofront(){
        $result = $this->main_model->bringcheckdetailstofront();
        echo json_encode($result);
    }

    public function savetempodeletealldataforreturnedatablerarydateforsale(){
                $outletid = (int)$this->session->userdata('outlet_id');
        $result = $this->main_model->savetempodeletealldataforreturnedatablerarydateforsale($outletid);
        echo $result;
    }


    public function return_product_to_sale(){

        $oldqty = 0;
        $newqty = 0;

        $return_quantity_val =(int)$this->security->xss_clean($_POST['return_quantity_val']);
        $order_summery_id =(int)$this->security->xss_clean($_POST['order_summery_id']);

        $outletid = (int)$this->session->userdata('outlet_id');
        $product_id =(int) $this->security->xss_clean($_POST['product_id']);


        $result = $this->main_model->return_product_to_sale($return_quantity_val,$outletid,$order_summery_id,$product_id);




        foreach($result as $res){
            $oldqty =(int)$res->product_quantity;
        }


        $newqty =(int)$return_quantity_val;

        $totalqty =(int)($newqty + $oldqty);

        $updateresult = $this->main_model->reupdatequantityintodb($totalqty, $product_id,$outletid);


        $subtractedqty = (int)($oldqty - $newqty);


        $reduceresult = $this->main_model->reduceresultfromqty($subtractedqty,$product_id,$outletid,$order_summery_id);

        $reducablequantity = 0;


        foreach($reduceresult as $res){
            $reducablequantity = (int)$res->choosen_quantity;

        }
        $answerqty = (int)($reducablequantity -  $newqty);


        $updateqtytooutlet = $this->main_model->updatequantitytooutlet($answerqty,$order_summery_id,$product_id,$outletid);

       echo json_encode($updateqtytooutlet);



    }


    public function select_pending_by_admin(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);
        $attribute = $this->security->xss_clean($_POST['attribute']);

        $this->main_model->select_pending_by_admin($paying_method_cheque_id,$attribute);

    }




      public function select_pass_by_admin(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);
        $attribute = $this->security->xss_clean($_POST['attribute']);

        $this->main_model->select_pass_by_admin($paying_method_cheque_id,$attribute);

    }






      public function select_returned_by_admin(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);
        $attribute = $this->security->xss_clean($_POST['attribute']);

        $this->main_model->select_returned_by_admin($paying_method_cheque_id,$attribute);

    }




      public function select_postponed_by_admin(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);
        $attribute = $this->security->xss_clean($_POST['attribute']);

        $this->main_model->select_postponed_by_admin($paying_method_cheque_id,$attribute);

    }

    public function removechequedetailsbyadmin(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);
        $this->main_model->removechequedetailsbyadmin($paying_method_cheque_id);
    }


    public function showoffallchequedetailsbyadminsearch(){
        $from_date_check_cheque = $this->security->xss_clean($_POST['from_date_check_cheque']);
        $to_date_check_cheque = $this->security->xss_clean($_POST['to_date_check_cheque']);
        $check_details_status = $this->security->xss_clean($_POST['check_details_status']);


        $result = $this->main_model->showoffallchequedetailsbyadminsearch($from_date_check_cheque,$to_date_check_cheque,$check_details_status);
        echo json_encode($result);

    }





    public function check_details_view(){
        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);

        $result = $this->main_model->check_details_view($paying_method_cheque_id);
        echo json_encode($result);
    }

    public function select_pending_save(){
        $status = $this->security->xss_clean($_POST['status']);

        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);

       $result = $this->main_model->select_pending_save($status,$paying_method_cheque_id);



    }


public function select_option_pass(){
        $status = $this->security->xss_clean($_POST['status']);

        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);

       $result = $this->main_model->select_option_pass($status,$paying_method_cheque_id);



    }


public function select_returned(){
        $status = $this->security->xss_clean($_POST['status']);

        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);

       $result = $this->main_model->select_returned($status,$paying_method_cheque_id);



    }


public function select_postponed(){
        $status = $this->security->xss_clean($_POST['status']);

        $paying_method_cheque_id = (int)$this->security->xss_clean($_POST['paying_method_cheque_id']);

       $result = $this->main_model->select_postponed($status,$paying_method_cheque_id);

    }


    public function geallbydateforcheckdetails(){
        $from_date_check_cheque = $this->security->xss_clean($_POST['from_date_check_cheque']);
        $to_date_check_cheque = $this->security->xss_clean($_POST['to_date_check_cheque']);

        $check_details_status = $this->security->xss_clean($_POST['check_details_status']);

        $result = $this->main_model->geallbydateforcheckdetails($from_date_check_cheque,$to_date_check_cheque,$check_details_status);
        echo json_encode($result);


    }


    public function savebank_details_section(){
        $bank_details_name = $this->security->xss_clean($_POST['bank_details_name']);
        $branch_name = $this->security->xss_clean($_POST['branch_name']);
        $initial_amount = $this->security->xss_clean($_POST['initial_amount']);
        $bank_note = $this->security->xss_clean($_POST['bank_note']);
        $account_no = $this->security->xss_clean($_POST['account_no']);

        $data = array(
            'bank_account_no' =>$account_no,
            'bank_name' => $bank_details_name,
            'initial_note' => $bank_note,
            'branch_name' => $branch_name,
            'initial_amount' => $initial_amount
        );



        $result = $this->main_model->savebank_details_section($data);
        echo json_encode($result);

    }


    public function deletebankaccountdetails(){
        $deleteaccountid =(int)$this->security->xss_clean($_POST['deleteaccountid']);


        $result = $this->main_model->deletebankaccountdetails($deleteaccountid);
    }

    public function makeprimaryaccount(){
        $status = $this->security->xss_clean($_POST['status']);
        $bank_details_id = $this->security->xss_clean($_POST['bank_details_id']);

        $result = $this->main_model->makeprimaryaccount($status,$bank_details_id);
        echo json_encode($result);

    }


    public function makenonprimaryforbankaccountdetails(){
        $status = $this->security->xss_clean($_POST['status']);
        $bank_details_id = $this->security->xss_clean($_POST['bank_details_id']);


        $result = $this->main_model->makenonprimaryforbankaccountdetails($status,$bank_details_id);
        echo json_encode($result);



    }


    public function add_cash_to_bank_account(){
        $bank_details_id = $this->security->xss_clean($_POST['bank_details_id']);
        $value = floatval($this->security->xss_clean($_POST['value']));
        $myamount = 0.00;

        $answertosummery = 0.99;

        $getamount =  $this->main_model->getcashfrombankaccount($bank_details_id);

        foreach($getamount as $amount){
            $myamount = floatval($amount->initial_amount);
        }


        $answertosummery = ($myamount + $value);

        $result = $this->main_model->add_cash_to_bank_account($bank_details_id,$answertosummery);
        echo json_encode($result);


    }

    public function subtractionsline_cash_to_bank_account_temp(){
        $bank_details_id = (int)$this->security->xss_clean($_POST['bank_details_id']); 
        $bank_update_amount = floatval($this->security->xss_clean($_POST['bank_update_amount'])); 
        $fulldate = $this->security->xss_clean($_POST['fulldate']); 
        $bank_details_note = $this->security->xss_clean($_POST['bank_details_note']); 


        $myamount = 0.00;

        $answertosummery = 0.99;

        $getamount =  $this->main_model->getcashfrombankaccount($bank_details_id);

        foreach($getamount as $amount){
            $myamount = floatval($amount->initial_amount);
        }

         $answertosummery = ($myamount - $bank_update_amount);

        if($answertosummery<=0){
            $answertosummery = 0;
        }

        $result = $this->main_model->subtractionsline_cash_to_bank_account_temp($bank_details_id, $answertosummery);
        if($result==1){
            $myres = $this->main_model->saveintoledgerforsubtraction($bank_details_id, $bank_update_amount, $fulldate,$bank_details_note);
            if($myres==0){
                echo 'Some error occured'; 
            }
        }
        else {
            echo 'Error occured from subtraction'; 
        }
     
    }

    public function account_no_section_ledger(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 

        $result = $this->main_model->account_no_section_ledger($fromdate, $todate); 
        echo json_encode($result);

    }

    public function add_cash_to_bank_account_temp(){
        $bank_details_id = (int)$this->security->xss_clean($_POST['bank_details_id']); 
        $bank_update_amount = floatval($this->security->xss_clean($_POST['bank_update_amount'])); 
        $fulldate = $this->security->xss_clean($_POST['fulldate']); 
        $bank_details_note = $this->security->xss_clean($_POST['bank_details_note']); 


        $myamount = 0.00;

        $answertosummery = 0.99;

        $getamount =  $this->main_model->getcashfrombankaccount($bank_details_id);

        foreach($getamount as $amount){
            $myamount = floatval($amount->initial_amount);
        }

         $answertosummery = ($myamount + $bank_update_amount);

        if($answertosummery<=0){
            $answertosummery = 0;
        }

                 
        $result = $this->main_model->add_cash_to_bank_account_temp($bank_details_id, $answertosummery, $fulldate,$bank_details_note);

        if($result){
            $myres = $this->main_model->saveintoledger($bank_details_id, $bank_update_amount, $fulldate,$bank_details_note, $fulldate);
            if($myres==0){
                echo 'Some error occured'; 
            }
        }
        else {
            echo 0; 
        }

        
    }

    public function subtract_cash_to_bank_account(){
        $bank_details_id = $this->security->xss_clean($_POST['bank_details_id']);
        $value = floatval($this->security->xss_clean($_POST['value']));
        $refrencno = $this->security->xss_clean($_POST['refrencno']); 


        $myamount = 0.00;

        $answertosummery = 0.99;

        $getamount =  $this->main_model->getcashfrombankaccount($bank_details_id);

        foreach($getamount as $amount){
            $myamount = floatval($amount->initial_amount);
        }

         $answertosummery = ($myamount - $value);

        if($answertosummery<=0){
            $answertosummery = 0;
        }

        $accountdetailsresult = $this->main_model->getbankaccountdetailsbyid($bank_details_id); 

        $fulldate = $this->security->xss_clean($_POST['fulldate']); 

        $bankname = ''; 
        $bankaccountno = 0; 
        $bracnname = ''; 
        $primarybankstatus = 0; 

        if($accountdetailsresult!=0){
            foreach($accountdetailsresult as $result){
                
                $bankname = $result->bank_name; 
                $bankaccountno = $result->bank_account_no;
                $bracnname = $result->branch_name; 
                $primarybankstatus = $result->primary_bank; 
            }

            $accountresultarray = array(
                'accountnoledger' => $bankaccountno, 
                'banknameledger' => $bankname, 
                'branchnameledger' => $bracnname, 
                'amountledger' =>  $value,
                'typeledger' => 'Subtract'
                
            ); 

        }

        $result = $this->main_model->subtract_cash_to_bank_account($bank_details_id,$answertosummery);
        echo json_encode($result);


    }

    public function enable_for_outlet_toexpenses(){
        $status = 0;
        $expenseId = $this->security->xss_clean($_POST['expenseId']);
        $result = $this->main_model->enable_for_outlet_toexpenses($expenseId);



    }

    public function disable_for_outlet_for_expense(){
        $status = 0;
        $expenseId = $this->security->xss_clean($_POST['expenseId']);
        $result = $this->main_model->disable_for_outlet_for_expense($expenseId);



    }


        public function editexpenses_details(){
            $expenseId = $this->security->xss_clean($_POST['expenseId']);
            $value = $this->security->xss_clean($_POST['value']);

            $result = $this->main_model->editexpenses_details($expenseId,$value);

        }


    public function deleteexpensedetailsection(){
        $expenseId = $this->security->xss_clean($_POST['expenseId']);
       echo $this->main_model->deleteexpensedetailsection($expenseId);

    }


    public function frmexpensesType_save(){
        $expensesName = $this->security->xss_clean($_POST['expensesName']);
        $result = $this->main_model->frmexpensesType_save($expensesName);
        echo json_encode($result);
    }


    #showback


    public function saveexpensedetailsforregister(){
        $amount = $this->security->xss_clean($_POST['amount']); 
        $date = $this->security->xss_clean($_POST['date']); 

      $result = $this->main_model->saveexpensedetailsforregister($amount, $date, $this->session->outlet_id); 
      echo $result; 
    }

    public function save_frm_expense_list_section(){
        $expense_type = $this->security->xss_clean($_POST['expense_type']);
        $expense_date = $this->security->xss_clean($_POST['expense_date']);
        $expense_amount = $this->security->xss_clean($_POST['expense_amount']);
        $note_for_expense_section = $this->security->xss_clean($_POST['note_for_expense_section']);
        
        


        $data = array(
        'expense_type' => $expense_type,
            'expense_note' => $note_for_expense_section,
            'expense_date' => $expense_date,
            'expense_amount' => $expense_amount,
            'outlet_id_fk' => (int)$this->session->outlet_id
        );

        $result = $this->main_model->save_frm_expense_list_section($data);
        echo json_encode($result);

    }



    public function update_expense_details_manually(){
        $uexpense_type =  $this->security->xss_clean($_POST['uexpense_type']);
        $uexpense_date = $this->security->xss_clean($_POST['uexpense_date']);
        $uexpense_amount = $this->security->xss_clean($_POST['uexpense_amount']);
        $uexpense_note_for_list_out = $this->security->xss_clean($_POST['uexpense_note_for_list_out']);

        $hidden_id_for_update = (int)$this->security->xss_clean($_POST['hidden_id_for_update']);

        $data = array(
            'expense_type' => $uexpense_type,
            'expense_note' => $uexpense_note_for_list_out,
            'expense_date' => $uexpense_date,
            'expense_amount' => $uexpense_amount
        );

        $result = $this->main_model->update_expense_details_manually($data,$hidden_id_for_update);
        echo $result;

    }


    public function search_expenses_list_btn_for_list(){
        $from_date_to_check_expenses = $_POST['from_date_to_check_expenses'];
        $to_date_to_check_expenses = $_POST['to_date_to_check_expenses'];

        $result = $this->main_model->search_expenses_list_btn_for_list($from_date_to_check_expenses,$to_date_to_check_expenses);
        echo json_encode($result);

    }


    
    public function frmsms_group_message_section_forall(){
        $group_id = $this->security->xss_clean($_POST['group_id']);
        $group_sms_contact_text = $this->security->xss_clean($_POST['group_sms_contact_text']);


        $result = $this->main_model->frmsms_group_message_section_forall($group_id);

        foreach($result as $res){
            $mob =(int)$res->customer_mobile;
               $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102221&api_key=nyx0020rtoijsr2te&sender_id=nowfarspicy&to=94". $mob ."&message=". $group_sms_contact_text);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo $server_output;

        }


    }


    #mileback
    public function print_return_invoice_section(){

        $refundedamount = $this->security->xss_clean($_POST['refundedamount']); 
        $ordered_dateforreturn = $this->security->xss_clean($_POST['ordered_dateforreturn']); 


        $this->main_model->saverefundamountforregisterdetails($refundedamount,$ordered_dateforreturn,$this->session->outlet_id); 

         $outletid = (int)$this->session->userdata('outlet_id');
        if(count($this->cart->contents())!=0){
            foreach($this->cart->contents() as $items){
                $oldqtysection = (int)$items['qty'];
                $currentquanttiy = 0;
                $answersectionforquantity = 0;

                $reducequantitytext = 0;
                $reduceanswer = 0;

                $returnedquantitytextforreducing = 0;

                $data = array(
                'product_id' => $items['id'],
                'product_name' => $items['name'],
                'returned_quantity' => $items['qty'],
                'product_code' => $items['product_code'],
                'price' => $items['price'],
                    'type' => 'returned',
                    'order_summery_id' => $items['summery_id'],
                );
                $result = $this->main_model->print_return_invoice_section($data);
                $gteresult = $this->main_model->increasequantityforunit($outletid,$items['id'],$items['qty']);

                foreach($gteresult as $res){
                    $currentquanttiy =(int)$res->product_quantity;
                    $answersectionforquantity = ($currentquanttiy + $oldqtysection);
                }




                $resultupdateqty = $this->main_model->resultupdateqtysectionforoutlet($answersectionforquantity,$outletid,$items['id']);


                $getcurrentquantityofboughtproduct = $this->main_model->print_return_invoice_section_for_bought_product($items['id'],$items['summery_id']);


                foreach($getcurrentquantityofboughtproduct as $myres){
                    $reducequantitytext =(int)$myres->choosen_quantity;
                    $returnedquantitytextforreducing = (int)$items['qty'];
                    $reduceanswer = ($reducequantitytext - $returnedquantitytextforreducing);
                }

                $resultofreduce = $this->main_model->makereducesectionfororderedetails($items['id'],$items['summery_id'],$reduceanswer);


                echo 'Result reduce '. $resultofreduce;
            }
        }
        else {

        }



    }


    public function show_all_sumemry_details_for_return(){
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);
        $result = $this->main_model->show_all_sumemry_details_for_return($order_summery_id);
        echo json_encode($result);

    }


    public function showoffpurcahsedetailssectuion(){
        $result = $this->main_model->showoffpurcahsedetailssectuion();
        echo json_encode($result);
    }


        public function showoffpurcahsedetailssectuionwithdate(){
            $from_date_starting_again_searc = $this->security->xss_clean($_POST['from_date_starting_again_searc']);
            $to_date_searching_for_purcahse_details = $this->security->xss_clean($_POST['to_date_searching_for_purcahse_details']);
            $outlet_details_section = $this->security->xss_clean($_POST['outlet_details_section']);

        $result = $this->main_model->showoffpurcahsedetailssectuionwithdate($from_date_starting_again_searc,$to_date_searching_for_purcahse_details,$outlet_details_section);
        echo json_encode($result);
    }



    public function getpurchasedproductsfordetails(){
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);
        $result = $this->main_model->
            getpurchasedproductsfordetails($order_summery_id);
        echo json_encode($result);
    }


    public function getAllkindofreturneddetails(){
        $result = $this->main_model->getAllkindofreturneddetails();
        echo json_encode($result);
    }

    public function supplior_details_section_md(){

        $result = $this->main_model->supplior_details_section_md();
        echo json_encode($result);


    }



    public function savechequesbyadmin(){
        $cheque_no = $this->security->xss_clean($_POST['cheque_no']);
        $cheqe_date = $this->security->xss_clean($_POST['cheqe_date']);
        $bank_name = $this->security->xss_clean($_POST['bank_name']);
        $customer_name = $this->security->xss_clean($_POST['customer_name']);
        $amount = $this->security->xss_clean($_POST['amount']);
        $cheque_status_details = $this->security->xss_clean($_POST['cheque_status_details']);
        


        $branch_name = $this->security->xss_clean($_POST['branch_name']);
        $data = array(
        'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'cheque_no' => $cheque_no,
            'cheque_date' =>$cheqe_date,
            'cheque_status' => $cheque_status_details,
            'customer_name' => $customer_name,
            'cheque_amount' => $amount
            
        );


        echo $this->main_model->savechequesbyadmin($data);


    }


    public function edit_price_update_section(){
        $rowid = $this->security->xss_clean($_POST['rowid']);
        $valuetochange = $this->security->xss_clean($_POST['valuetochange']);

        $data = array(
        'rowid' => $rowid,
        'price' => $valuetochange
        );

 echo $this->cart->update($data);

    }

  

    public function alert_quantity_for_outlets_text(){
        $alert_quantity_for_outlets_text = (int)$this->security->xss_clean($_POST['value']);
        $result = $this->main_model->alert_quantity_for_outlets_text($alert_quantity_for_outlets_text);

    }



    public function sendgroupsmsbyid(){
        $sendMessage = $this->security->xss_clean($_POST['group_sms_contact_text']);
        $group_id_hidden_id = $this->security->xss_clean($_POST['group_id_hidden_id']);

        $fulldate = $this->security->xss_clean($_POST['fulldate']); 
        $dateandtime = $this->security->xss_clean($_POST['dateandtime']); 

        $result = $this->main_model->sendgroupsmsbyid($group_id_hidden_id);

      
       foreach($result as $res){

           $smssenderTel = (int)$res->customer_mobile;

           
        $data = array(
            'smshistory_sms' => $sendMessage, 
            'smshistory_date' => $fulldate, 
            'smshistory_status' => 'Sent', 
            'smshistory_date_time' => $dateandtime, 
            'smshistory_tomobile' => $res->customer_mobile, 
            'sms_type' => 'From created group'
        ); 

        $this->main_model->saverecordeddetails($data);

               $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=
102408&api_key=24b00v2wnrd7dku6c&sender_id=Zahras&to=94". $smssenderTel ."&message=". $sendMessage);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo json_encode($server_output);




       }

    }


    public function generate_report_for_admin_section(){
        $total = 0;
        $totalexpenses = 0;

        $admin_mob = 0;

        $expeneses = 0;


        $message = '';
        $getonlytime = $this->security->xss_clean($_POST['getonlytime']);
        $getallresultdata = $this->main_model->getallresultdata($this->session->outlet_id,$getonlytime);

        $getadminresult = $this->main_model->getadminresult();

        $getexpensesresult = $this->main_model->getexpenesesdetails($this->session->outlet_id, $getonlytime);



        if(empty($getallresultdata)){
            $total = 0.00;
        }
        else {
            foreach($getallresultdata as $data){
                $total+=floatval($data->total_amount);
            }
        }

        foreach($getadminresult as $ad){
            $admin_mob = (int)$ad->admin_mob;
        }


        if(empty($getexpensesresult)){
            $expeneses = 0.00;
        }
        else {
            foreach($getexpensesresult as $result){
                $expeneses+=floatval($result->expense_amount);
            }

        }


        $message = 'Shop Name : '.$this->session->outlets_name.' , Total sales amount : '. number_format($total,2).' , Total expenses : '. number_format($expeneses,2);


           $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102408&api_key=24b00v2wnrd7dku6c&sender_id=Zahras&to=94". $admin_mob ."&message=". $message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo json_encode($server_output);



    }



    public function getrequestedproduct(){
        $result = $this->main_model->getrequestedproduct();
        echo $result;
    }


    public function sendindmessage(){
        $single_message_to_message = $this->security->xss_clean($_POST['single_message_to_message']);

        $customer_mobile = (int)$this->security->xss_clean($_POST['customer_mobile']);

        $fulldate = $this->security->xss_clean($_POST['fulldate']); 
        $dateandtime = $this->security->xss_clean($_POST['dateandtime']); 

        $data = array(
            'smshistory_sms' => $single_message_to_message, 
            'smshistory_date' => $fulldate, 
            'smshistory_status' => 'Sent', 
            'smshistory_date_time' => $dateandtime, 
            'smshistory_tomobile' => $this->security->xss_clean($_POST['customer_mobile']), 
            'sms_type' => 'Individual'
        ); 

        $this->main_model->savesendsmsrecoredid($data); 



             $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102408&api_key=24b00v2wnrd7dku6c&sender_id=Zahras&to=94". $customer_mobile ."&message=". $single_message_to_message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo json_encode($server_output);



    }


    public function search_sms_history_date(){
        $from_date_for_search_ssm = $this->security->xss_clean($_POST['from_date_for_search_ssm']); 
        $to_date_for_search_ssm = $this->security->xss_clean($_POST['to_date_for_search_ssm']); 

        $result = $this->main_model->search_sms_history_date($from_date_for_search_ssm, $to_date_for_search_ssm);
        echo json_encode($result);  

    }


    public function sendsmssectiontoall(){

        $single_message_to_message = $this->security->xss_clean($_POST['message_to_message']);

        $date = $this->security->xss_clean($_POST['date']); 
        $dateandtime = $this->security->xss_clean($_POST['dateandtime']); 

        $type = 'Group';


       $result = $this->main_model->getcustomerdetailsformessage();



        foreach($result as $res){
            $data = array(
                'smshistory_sms' => $single_message_to_message, 
                'smshistory_date' => $date, 
                'smshistory_status' => 'Sent', 
                'smshistory_date_time' => $dateandtime, 
                'smshistory_tomobile' => $res->customer_mobile, 
                'sms_type' => $type
            );
            $this->main_model->recordsmshistory($data);

            $customer_mobile = (int)$res->customer_mobile;

             $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102408&api_key=24b00v2wnrd7dku6c&sender_id=Zahras&to=94". $customer_mobile ."&message=". $single_message_to_message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo json_encode($server_output);


        }


        }

    public function change_status_from_wr(){
        $warehouse_id = $this->security->xss_clean($_POST['warehouse_id']);
        $result = $this->main_model->change_status_from_wr($warehouse_id);
        echo $result;
    }

    public function getcustomerdetailsforsalesreport(){
        $customer_id = (int)$this->security->xss_clean($_POST['customer_id']);
        $result = $this->main_model->getcustomerdetailsforsalesreport($customer_id);
        echo json_encode($result);
    }

    public function showproductdetailsforreport(){
        $outlet_id = $this->security->xss_clean($_POST['outlet_id']);
        $invoice_no = $this->security->xss_clean($_POST['invoice_no']);
        $order_summery_id = $this->security->xss_clean($_POST['order_summery_id']);

        $result = $this->main_model->showproductdetailsforreport($outlet_id,$invoice_no,$order_summery_id);
        echo json_encode($result);


    }

    public function subtractexpenseamount(){
        $expenseamount = $this->security->xss_clean($_POST['expenseamount']); 
        $getfulldate = $this->security->xss_clean($_POST['getfulldate']); 

        $result = $this->main_model->subtractexpenseamount($expenseamount,$getfulldate,$this->session->outlet_id); 
        echo $result; 
    }

    public function showoffdeTecutedPanel_expenselist(){
        $mydate = $this->security->xss_clean($_POST['mydate']); 
        $mydate  = trim($mydate);
        $result = $this->main_model->showoffdeTecutedPanel_expenselist($mydate, $this->session->outlet_id); 
        echo json_encode($result); 
    }

    public function delete_expense_list_from_cashier(){
        $value = (int)$this->security->xss_clean($_POST['value']); 
        $result = $this->main_model->delete_expense_list_from_cashier($value);
        echo $result; 

    }

    public function search_expense_bydate(){
        $from_date_expense_list= $this->security->xss_clean($_POST['from_date_expense_list']); 
        $to_expense_list= $this->security->xss_clean($_POST['to_expense_list']); 

        $this->session->set_userdata('fromdateforexpense',$from_date_expense_list); 
        $this->session->set_userdata('todateforexpense',$to_expense_list); 

        $result = $this->main_model->search_expense_bydate($from_date_expense_list,$to_expense_list, $this->session->outlet_id); 
        echo json_encode($result);

    }
    
    public function totalexpenseprint(){
        $data['results'] = $this->main_model->search_expense_bydate($this->session->fromdateforexpense,$this->session->todateforexpense,$this->session->outlet_id);
        $this->load->view('salesunit/expensesprint',$data);
    
    }


    public function getSalessummerydetails(){
        $mydate = $this->security->xss_clean($_POST['mydate']); 
        $result = $this->main_model->getSalessummerydetails($mydate); 
        echo json_encode($result); 
    }

    public function getSalessummerydetailsbydate(){
        $from_date_section_to_search = $this->security->xss_clean($_POST['from_date_section_to_search']); 
        $to_date_section_to_search = $this->security->xss_clean($_POST['to_date_section_to_search']); 
        $date = $this->security->xss_clean($_POST['date']); 
        $result = $this->main_model->getSalessummerydetailsbydate($this->session->outlet_id,$date,$from_date_section_to_search, $to_date_section_to_search); 
        echo json_encode($result); 
    }


    public function deletegroupbtnforsms(){
        $group_id =(int)$this->security->xss_clean($_POST['group_id']); 
        $result = $this->main_model->deletegroupbtnforsms($group_id); 
        echo json_encode($result); 
    }

    public function deltecontact_details_accurate(){
        $customer_id = (int)$this->security->xss_clean($_POST['customer_id']); 
        $group_id = (int) $this->security->xss_clean($_POST['group_id']); 
        $result = $this->main_model->deltecontact_details_accurate($customer_id,$group_id); 
        echo json_encode($result); 
    }

    public function getshowOffDetails(){
        $result = $this->main_model->getshowOffDetails(); 
        echo json_encode($result); 
    }

    public function checkinitialpaymentstatus(){
        $value = $this->security->xss_clean($_POST['value']); 
        $result = $this->main_model->checkinitialpaymentstatus($value);
        echo $result; 
    }

    public function updateinitialpaymentsection(){
        $mydate = $this->security->xss_clean($_POST['mydate']); 
        $initial_payment_section = $this->security->xss_clean($_POST['initial_payment_section']); 
        $result = $this->main_model->updateinitialpaymentsection($mydate, $initial_payment_section, $this->session->outlet_id); 
        echo $result; 
    }

    public function registerDetailsection(){
        $mydate = $this->security->xss_clean($_POST['mydate']); 
          $result = $this->main_model->registerDetailsection($mydate); 
          echo json_encode($result); 
     }

    
     public function chequeSaveDetailsforregister(){
        $mydate = $this->security->xss_clean($_POST['mydate']); 
        $value = $this->security->xss_clean($_POST['myvalue']); 
     

        $result = $this->main_model->chequeSaveDetailsforregister($mydate,$value, $this->session->outlet_id); 
        echo json_encode($result);
     }

     public function savedetailsforcreditinregister(){

        $mydate = $this->security->xss_clean($_POST['mydate']); 
        $value = $this->security->xss_clean($_POST['myvalue']); 


        $result = $this->main_model->savedetailsforcreditinregister($mydate,$value, $this->session->outlet_id); 
        echo json_encode($result);
     }     


     
     public function saveCashpaymentforregisterdetails(){
         $mydate = $this->security->xss_clean($_POST['mydate']);
         $myvalue= $this->security->xss_clean($_POST['myvalue']); 

         $result = $this->main_model->saveCashpaymentforregisterdetails($mydate,$myvalue, $this->session->outlet_id); 
        echo json_encode($result);

     }

     public function getdetailsofsoldproduct(){
         $fulldate = $this->security->xss_clean($_POST['fulldate']); 
         $result = $this->main_model->getdetailsofsoldproduct($fulldate); 
         echo json_encode($result); 
        
     }

     public function regulateloanbuttonsection(){
         $result = $this->main_model->regulateloanbuttonsection(); 
         echo $result; 
     }


     public function gettotalsalesanddiscount(){
         $todaydate = $this->security->xss_clean($_POST['todaydate']); 
         $result = $this->main_model->gettotalsalesanddiscount($todaydate); 
         echo json_encode($result); 
     }

     public function showoffsalesunitsection(){
         $fulldate = $this->security->xss_clean($_POST['fulldate']); 
         $result = $this->main_model->showoffsalesunitsection($fulldate, $this->session->outlet_id); 
         echo json_encode($result); 

     }

     public function showoffsalesunitsectionbysearch(){
         $from_to_search_purdate = $this->security->xss_clean($_POST['from_to_search_purdate']); 
         $to_to_search_purdate = $this->security->xss_clean($_POST['to_to_search_purdate']);
         $status_cehcker = $this->security->xss_clean($_POST['status_cehcker']); 
         $mobile_no_or_invoice_text = $this->security->xss_clean($_POST['mobile_no_or_invoice_text']); 

        $this->session->set_userdata('from_to_search_purdate_session',$from_to_search_purdate); 
        $this->session->set_userdata('to_to_search_purdate_session',$to_to_search_purdate); 
        $this->session->set_userdata('status_checker_session',$status_cehcker); 
        $this->session->set_userdata('mobileNumberto_searchsales',$mobile_no_or_invoice_text); 

          $result = $this->main_model->showoffsalesunitsectionbysearch($mobile_no_or_invoice_text,$from_to_search_purdate,$to_to_search_purdate,$status_cehcker, $this->session->outlet_id); 
         echo json_encode($result); 
         
     }

     public function getloanamountbycustomer(){
         $data['results'] = $this->main_model->getloanamountbycustomer(); 
        $this->load->view('salesunit/customersideloanprint',$data);
         

     }

     public function printsalessidesection(){
         $from_to_search_purdate = $this->session->from_to_search_purdate_session; 
         $to_to_search_purdate = $this->session->to_to_search_purdate_session; 
         $status_cehcker = $this->session->status_checker_session;
         $mobile = $this->session->mobileNumberto_searchsales; 

         $data['results'] =  $this->main_model->showoffsalesunitsectionbysearch($mobile,$from_to_search_purdate,$to_to_search_purdate,$status_cehcker, $this->session->outlet_id);
        $this->load->view('salesunit/salessideprint',$data);
    }

     public function view_cus_details_fr_section(){
         $value = $this->security->xss_clean($_POST['value']); 
         $result = $this->main_model->view_cus_details_fr_section($value); 
         echo json_encode($result); 
     }

     public function view_summery_id_fr(){
         $order_summery_id= (int)$this->security->xss_clean($_POST['value']); 
         $result = $this->main_model->view_summery_id_fr($order_summery_id, $this->session->outlet_id); 
         echo json_encode($result);
     }
 
     public function getCreditsbycustomerdetails(){
         $date = $this->security->xss_clean($_POST['date']); 
         $result = $this->main_model->getCreditsbycustomerdetails($date, $this->session->outlet_id); 
         echo json_encode($result); 
     }

     public function getCreditsbycustomerdetailswithdate(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 
        $result = $this->main_model->getCreditsbycustomerdetailswithdate($fromdate,$todate, $this->session->outlet_id); 
        echo json_encode($result); 
    }

 
     public function savecreditdetailsbyregisterfromcash(){
         $saveabledata = $this->security->xss_clean($_POST['saveabledata']); 
         $todaydate = $this->security->xss_clean($_POST['todaydate']); 
         $outletid = (int)$this->session->outlet_id; 
         $result =$this->main_model->savecreditdetailsbyregisterfromcash($saveabledata,$todaydate,$outletid); 
         echo json_encode($result); 
     }

     
     public function loanpayingreports(){
  
        
        $this->load->view('salesunit/loanpayingreports');


     }
 

     public function detectcreditdetailsbycash(){
         $recieving_amount = $this->security->xss_clean($_POST['recieving_amount']); 
         $ordered_date_sec = $this->security->xss_clean($_POST['ordered_date_sec']); 
         $summery_id = $this->security->xss_clean($_POST['summery_id']); 
         $balance_amount = $this->security->xss_clean($_POST['balance_amount']); 
        $payment_to_bepadi = $this->security->xss_clean($_POST['payment_to_bepadi']); 


        $customer_name = $this->security->xss_clean($_POST['customer_name']); 
        $customer_mobile = $this->security->xss_clean($_POST['customer_mobile']); 
        $customer_address = $this->security->xss_clean($_POST['customer_address']); 

        $date = $this->security->xss_clean($_POST['date']); 

        $this->session->set_userdata('recieving_amount_sec',$recieving_amount); 
        $this->session->set_userdata('balanceamount',$balance_amount); 
        $this->session->set_userdata('paymenttobepaid',$payment_to_bepadi); 


        $savedataforloan = array(
            'loan_previous_amount' => $payment_to_bepadi, 
            'loan_recieving_amount' => $recieving_amount, 
            'loan_balance_amount' => $balance_amount, 
            'loan_paid_method' => 'Cash',  
            'outlet_name' => $this->session->outlets_name, 
            'outlet_id_fk' => $this->session->outlet_id, 
            'date' => $date,
            'invoiceidsec' => $summery_id, 
            'customer_name' => $customer_name, 
            'customer_mobile' => $customer_mobile, 
            'customer_address' => $customer_address 
        );

        $this->main_model->savepayingloanamount($savedataforloan,$date, $this->session->outlet_id); 
        
        $this->main_model->addpaymentforloancreditpayment($recieving_amount, $date, $this->session->outlet_id); 
        


         $result = $this->main_model->detectcreditdetailsbycash($recieving_amount, $ordered_date_sec, $summery_id,$balance_amount);
        
        

     }

     public function getloanpaymentmentcheckmethod(){
         $fromdate = $this->security->xss_clean($_POST['fromdate']); 
         $todate = $this->security->xss_clean($_POST['todate']); 
         $paymentmethod = $this->security->xss_clean($_POST['paymentmethod']); 
         $mobile = $this->security->xss_clean($_POST['mobile']); 

         $this->session->set_userdata('fromdateforpaidloan',$fromdate); 
         $this->session->set_userdata('todateforpaidloan',$todate); 
         $this->session->set_userdata('payment_method',$paymentmethod); 
         $this->session->set_userdata('mobileforloanamount',$mobile); 

        $result = $this->main_model->getloanpaymentmentcheckmethod($fromdate,$todate, $paymentmethod, $this->session->outlet_id,$mobile); 
        echo json_encode($result); 

     }

     public function paidloanprint(){
 
        $fromdate = $this->session->fromdateforpaidloan; 
        $todate = $this->session->todateforpaidloan; 
        $paymentmethod = $this->session->payment_method; 
        


        $data['results'] = $this->main_model->filterdataforprint($fromdate,$todate,$paymentmethod, $this->session->outlet_id, $this->session->mobileforloanamount);
         
        

        $this->load->view('salesunit/paidloanprint',$data);
    }

   

     public function submit_loan_chequessection(){
    
         $cheque_loan_number = $this->security->xss_clean($_POST['cheque_loan_number']); 
         $branch_name_for_laon_chque = $this->security->xss_clean($_POST['branch_name_for_laon_chque']); 
         $cheque_date_for_loan_name = $this->security->xss_clean($_POST['cheque_date_for_loan_name']); 
        $bank_name_for_loan_cheque = $this->security->xss_clean($_POST['bank_name_for_loan_cheque']); 
        $summery_id_fk = $this->security->xss_clean($_POST['summery_id_fk']); 
        $recieveddate = $this->security->xss_clean($_POST['recieveddate']); 
        $status = $this->security->xss_clean($_POST['status']); 
        $ordered_date_sec = $this->security->xss_clean($_POST['ordered_date_sec']); 

        $cheque_loan_amount = $this->security->xss_clean($_POST['cheque_loan_amount']); 
        
        $balanceamount = floatval($this->security->xss_clean($_POST['balanceamount']));
        $balance_for_cheque_amount= floatval($this->security->xss_clean($_POST['balance_for_cheque_amount']));  
        $todaydate = $this->security->xss_clean($_POST['todaydate']); 


        $this->session->set_userdata('recieving_amount_sec',$cheque_loan_amount); 
        $this->session->set_userdata('balanceamount',$balanceamount); 
        $this->session->set_userdata('paymenttobepaid',$balance_for_cheque_amount); 


        $customer_name_bycheck = $this->security->xss_clean($_POST['customer_name_bycheck']); 
        $customer_address_bycheck = $this->security->xss_clean($_POST['customer_address_bycheck']); 
        $customer_mobile_bycheck = $this->security->xss_clean($_POST['customer_mobile_bycheck']); 

        $savedataforloan = array(
            'loan_previous_amount' => $balance_for_cheque_amount, 
            'loan_recieving_amount' => $cheque_loan_amount, 
            'loan_balance_amount' => $balanceamount, 
            'loan_paid_method' => 'Check', 
            'outlet_name' => $this->session->outlets_name, 
            'outlet_id_fk' => $this->session->outlet_id, 
            'date' => $todaydate,
            'invoiceidsec' => $summery_id_fk, 
            'customer_name' => $customer_name_bycheck, 
            'customer_mobile' => $customer_mobile_bycheck,
            'customer_address' => $customer_address_bycheck
        );

        $this->main_model->savepayingloanamount($savedataforloan); 




        $data = array(
            'bank_name' => $bank_name_for_loan_cheque, 
            'branch_name' => $branch_name_for_laon_chque, 
            'account_no' => $cheque_loan_number, 
            'cheque_date' => $cheque_date_for_loan_name, 
            'recieving_date' => $recieveddate, 
            'cheque_status' => $status, 
            'summery_id' => $summery_id_fk, 
            'cheque_status' => $status, 
          
        );
        $this->main_model->detectpaymentforcheck($summery_id_fk,$cheque_loan_amount);  
       $this->main_model->submit_loan_chequessection($data);

        echo  $this->main_model->savepaymentdetailsforreigsterdetails($ordered_date_sec,$this->session->outlet_id,$cheque_loan_amount); 


     }

     public function getallfinishingproductsfromwarehouse(){
         $result = $this->main_model->getallfinishingproductsfromwarehouse(); 
         echo json_encode($result); 
     }

     public function getoutlet_id(){
         echo $this->session->outlet_id; 
     }

     public function mute_warehouserunningproduct(){
         $product_id_fk = (int)$this->security->xss_clean($_POST['product_id_fk']); 
         $result = $this->main_model->mute_warehouserunningproduct($product_id_fk);
         echo $result; 
     }

     public function changecheckstatusforsupplier(){
         $cheque_status_reupdate = $this->security->xss_clean($_POST['cheque_status_reupdate']); 
         $cheque_id = $this->security->xss_clean($_POST['cheque_id']); 

        $result = $this->main_model->changecheckstatusforsupplier($cheque_status_reupdate,$cheque_id); 
        echo $result; 

     }


     public function unmute_warehouserunningproduct(){
        $product_id_fk = (int)$this->security->xss_clean($_POST['product_id_fk']); 
        $result = $this->main_model->unmute_warehouserunningproduct($product_id_fk);
        echo $result; 
    }

      
     public function getwarehousefinishingproducts(){
         $result = $this->main_model->getwarehousefinishingproducts(); 
         

         if($result!=0){
             foreach($result as $data){
                 if($data->alert_quantity>=$data->quantity){
                     if($data->alert_quantity!=0){
                        $resdata =  $this->main_model->saveproductdetailsforwarehouse($this->session->outlet_id,$data->products_id); 
                        
                     }
                    
                 }
             }
         }
     }


     public function update_products_expiredatesystembtn(){
         $days_forexpirecounter =(int)$this->security->xss_clean($_POST['days_forexpirecounter']); 
         $this->main_model->update_products_expiredatesystembtn($days_forexpirecounter);

     }

     public function update_privillagesforcashier(){
         $warehouse_pr_reminder = (int)$this->security->xss_clean($_POST['warehouse_pr_reminder']); 
         $warehouse_exp_reminder = (int)$this->security->xss_clean($_POST['warehouse_exp_reminder']); 
         $sales_summmery_viewer= (int)$this->security->xss_clean($_POST['sales_summmery_viewer']); 
         $sales_section_reminder = (int)$this->security->xss_clean($_POST['sales_section_reminder']); 


         $data = array(
             'warehouse_productsreminder_privillage' => $warehouse_pr_reminder, 
             'expire_date_reminder_privillage' => $warehouse_exp_reminder, 
             'view_salessummery_privillage' => $sales_summmery_viewer,
             'view_salesection_privillage' => $sales_section_reminder
         ); 

         $this->main_model->update_privillagesforcashier($data);

     }

     public function getAllsettings(){
         $result = $this->main_model->getAllsettings(); 
         echo json_encode($result); 
     }

   

     public function editstaffsection(){
         $staff_id = $this->security->xss_clean($_POST['staff_id']); 
         $staffName = $this->security->xss_clean($_POST['staffName']); 
         $staffmob = $this->security->xss_clean($_POST['staffmob']); 
         $joint_date = $this->security->xss_clean($_POST['joint_date']);
         $working_outlets = $this->security->xss_clean($_POST['working_outlets']); 
        $responsibility = $this->security->xss_clean($_POST['responsibility']); 

         $data = array(
            'staff_name' => $staffName, 
            'staff_mobile' => $staffmob, 
            'responsibility' => $responsibility,
            'joint_date' => $joint_date, 
            'working_outlet' => $working_outlets
         ); 

         echo $this->main_model->updatestaffsection($data, $staff_id); 

     }

     public function findsmsbalance(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://send.ozonedesk.com/api/v2/status.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102408&api_key=24b00v2wnrd7dku6c");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
 	    echo $server_output; 

     }

     public function smssender(){
        $smssenderTel = (int)$this->security->xss_clean($_POST['smssenderTel']);
        $sendMessage = $this->security->xss_clean($_POST['sendMessage']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://send.ozonedesk.com/api/v2/send.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"user_id=102408&api_key=24b00v2wnrd7dku6c&sender_id=Zahras&to=94". $smssenderTel ."&message=". $sendMessage);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        echo $server_output;


    }


    public function savechequedetailsprivillagesform(){
        $daysbeforeforcheque = $this->security->xss_clean($_POST['daysbeforeforcheque']); 
        $showchqueetailsincashier = $this->security->xss_clean($_POST['showchqueetailsincashier']); 
        $showcheckbyadminincashier = $this->security->xss_clean($_POST['showcheckbyadminincashier']); 
        $result = $this->main_model->savechequedetailsprivillagesform($daysbeforeforcheque,$showchqueetailsincashier,$showcheckbyadminincashier); 
        
        echo $result; 
    }

    public function searchforsupplierinvoicetoobutton(){
        $supplier_details = $this->security->xss_clean($_POST['supplier_details']); 
        $invoice_no = $this->security->xss_clean($_POST['invoice_no']); 

        $result = $this->main_model->searchforsupplierinvoicetoobutton($supplier_details, $invoice_no); 
        echo json_encode($result); 

    }


    public function getchequedetailsforsuppliers(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 

        $result = $this->main_model->getchequedetailsforsuppliers($fromdate, $todate); 
        echo json_encode($result); 
    }

    public function savesupplierchequessections(){
        $data = array(
            'bank_name' => $this->security->xss_clean($_POST['bank_name']), 
            'branch_name' => $this->security->xss_clean($_POST['branch_name']), 
            'account_no' => $this->security->xss_clean($_POST['account_no']),
            'cheque_date' => $this->security->xss_clean($_POST['cheques_date']), 
            'cheque_status' => $this->security->xss_clean($_POST['cheque_status']),
            'supplier_id_fk' => $this->security->xss_clean($_POST['supplier_details_choose']), 
            'note' => $this->security->xss_clean($_POST['noteforcheck']), 
            'amount' => $this->security->xss_clean($_POST['amountforcheque'])
        ); 

        $result = $this->main_model->savesupplierchequessections($data); 
        echo $result; 
    }


    public function updatesuppliersections(){
        $supplier_id_check = (int)$this->security->xss_clean($_POST['supplier_id_check']); 
        $data = array(
            'bank_name' => $this->security->xss_clean($_POST['bank_name']), 
            'branch_name' => $this->security->xss_clean($_POST['branch_name']), 
            'account_no' => $this->security->xss_clean($_POST['account_no']),
            'cheque_date' => $this->security->xss_clean($_POST['cheques_date']), 
            'cheque_status' => $this->security->xss_clean($_POST['cheque_status']),
            'supplier_id_fk' => $this->security->xss_clean($_POST['supplier_details_choose']), 
            'note' => $this->security->xss_clean($_POST['noteforcheck']), 
            'amount' => $this->security->xss_clean($_POST['amountforcheque'])
        ); 

        $result = $this->main_model->updatesuppliersections($data,$supplier_id_check); 
        echo $result; 
    }

    public function products_outlet_detailsget(){
        $value = $this->security->xss_clean($_POST['value']); 
        $result = $this->main_model->products_outlet_detailsget($value); 
        echo json_encode($result); 
    }

    public function deleteproductsforoutlet(){
        $product_id = (int)$this->security->xss_clean($_POST['product_id']); 
        $result = $this->main_model->deleteproductsforoutlet($product_id); 
        echo $result; 
    }

   

    public function deletesupplierchecks(){
        $supplier_cheques_id = (int)$this->security->xss_clean($_POST['supplier_cheques_id']); 

        $result = $this->main_model->deletesupplierchecks($supplier_cheques_id); 
        echo $result; 
    }
 
    public function getsuppliercheckdetails(){
        $fromdate = $this->security->xss_clean($_POST['fromdate']); 
        $todate = $this->security->xss_clean($_POST['todate']); 
        $checkstatus = $this->security->xss_clean($_POST['checkstatus']); 


        $result = $this->main_model->getsuppliercheckdetails($fromdate, $todate, $checkstatus); 
        echo json_encode($result); 

    }

    public function updatecheckstatusfromcashier(){
        $chques_id_fk = (int) $this->security->xss_clean($_POST['chques_id_fk']); 
        $result = $this->main_model->updatecheckstatusfromcashier($chques_id_fk); 
        echo $result; 
    }

    public function updatestatustobounce(){
        $chques_id_fk = (int) $this->security->xss_clean($_POST['chques_id_fk']); 
        $result = $this->main_model->updatestatustobounce($chques_id_fk); 
        echo $result; 
    }

    public function updatestatustocomplete(){
        $chques_id_fk = (int) $this->security->xss_clean($_POST['chques_id_fk']); 
        $result = $this->main_model->updatestatustocomplete($chques_id_fk); 
        echo $result; 

    }


    public function creditdetailsforsaving(){
        $discountpercentage = $this->security->xss_clean($_POST['discountpercentage']);
        $dicountvalue = $this->security->xss_clean($_POST['dicountvalue']);
        $fulltimewithdate = $this->security->xss_clean($_POST['fulltimewithdate']);
        $sales_invoice_id = $this->security->xss_clean($_POST['sales_invoice_id']);
 $outletid = (int)$this->session->userdata('outlet_id');
  $paying_amount_given = $this->security->xss_clean($_POST['value']);
        $additional_information = $this->security->xss_clean($_POST['additional_information']); 

        $this->session->set_userdata('addtional_information',$additional_information); 

        $individualdiscountamount = $this->security->xss_clean($_POST['individualdiscountamount']); 
        $discountpercentagevalue= $this->security->xss_clean($_POST['discountpercentagevalue']); 
        $subtractamounttotally = $this->security->xss_clean($_POST['subtractamounttotally']); 
        $totalamount= $this->security->xss_clean($_POST['totalamount']); 
        $amounttoshowoffpaying = $this->security->xss_clean($_POST['amounttoshowoffpaying']); 
        $dicountvalueinnumber = $this->security->xss_clean($_POST['dicountvalueinnumber']); 
 
         


        $orderedstatus = 1;
        $orderdetailsarray = array(
            'ordered_date' => $fulltimewithdate,
            'ordered_status' => 'Completed',
            'discount' => $discountpercentage,
            'discounted_amount' => $dicountvalue,
            'total_amount' => $paying_amount_given,
            'ordered_status' => $orderedstatus,
            'customer_id' => (int)$this->session->userdata('customer_id'),
            'payment_method' => 'Credit',
            'outlet_id' => $this->session->outlet_id,
            'status' => 'Sold',
            'invoice_no' => $sales_invoice_id,
            'additional_text' => $additional_information, 
            'individual_discountamount' => $individualdiscountamount, 
            'before_discount_sub_total' => $totalamount, 
            'paying_amount' => $amounttoshowoffpaying, 
            'discount_percentage' => $discountpercentagevalue, 
            'subtract' => $subtractamounttotally, 
            'discount_amount' => $dicountvalueinnumber, 
            'discount_from_total_amount' => ($this->session->subtractedamountfromtotal=='NaN' || $this->session->subtractedamountfromtotal==null ) ? 0 : $this->session->subtractedamountfromtotal 

        );

          $last_insert_id = $this->main_model->saveamountforall($orderdetailsarray);

          $this->session->set_userdata('last_insert_id',$last_insert_id);

          echo $last_insert_id; 

        $creditamountdata = array(
            'sales_credit_amount' => $paying_amount_given, 
            'summery_id_fk ' => $last_insert_id,
            'outlet_id' => $this->session->outlet_id,
            'additional_information' => $additional_information
        );

          $this->main_model->savecreditdetailssection($creditamountdata); 
          $this->main_model->savecreditamountforcustomer($this->session->userdata('customer_id'), $paying_amount_given); 
    }






    public function checklinessid(){
        echo $_COOKIE['PHPSESSID']; 

    }

    public function retriewdataforexpiredata(){
        $result =$this->main_model->retriewdataforexpiredata($this->session->outlet_id); 
        echo json_encode($result); 
    }

    public function regulateloanbutton(){
         $this->main_model->regulateloanbutton(); 
    }



    public function savecashamount(){

        $paying_amount_given  = $this->security->xss_clean($_POST['paying_amount_given']);
        $recieved_amount = $this->security->xss_clean($_POST['recieved_amount']);
        $fulltimewithdate = $this->security->xss_clean($_POST['fulltimewithdate']);
        $outletid = (int)$this->session->userdata('outlet_id');

        $discountpercentage = $this->security->xss_clean($_POST['discountpercentage']);
        $dicountvalue = $this->security->xss_clean($_POST['dicountvalue']);

        $balance_amount = $this->security->xss_clean($_POST['balance_amount']);

        $sales_invoice_id = $this->security->xss_clean($_POST['sales_invoice_id']);

        $additional_information = $this->security->xss_clean($_POST['additional_information']); 

        $chequestatus = 'Pending';

       $this->session->set_userdata('recieved_amount',$recieved_amount); 

       $this->session->set_userdata('addtional_information',$additional_information); 

       $getbalanceamount = ($recieved_amount - $paying_amount_given); 

       $individualdiscountamount = $this->security->xss_clean($_POST['individualdiscountamount']); 
       $discountpercentagevalue= $this->security->xss_clean($_POST['discountpercentagevalue']); 
       $subtractamounttotally = $this->security->xss_clean($_POST['subtractamounttotally']); 
       $totalamount= $this->security->xss_clean($_POST['totalamount']); 
       $amounttoshowoffpaying = $this->security->xss_clean($_POST['amounttoshowoffpaying']); 
       $dicountvalueinnumber = $this->security->xss_clean($_POST['dicountvalueinnumber']); 


 


        $orderedstatus = 1;
        $orderdetailsarray = array(
            'ordered_date' => $fulltimewithdate,
            'ordered_status' => 'Completed',
            'discount' => $discountpercentage,
            'discounted_amount' => $dicountvalue,
            'total_amount' => $paying_amount_given,
            'ordered_status' => $orderedstatus,
            'customer_id' => (int)$this->session->userdata('customer_id'),
            'payment_method' => 'Cash',
            'outlet_id' => $outletid,
            'status' => 'Sold',
            'invoice_no' => $sales_invoice_id,
            'additional_text' => $additional_information, 
            'recieved_amount_fromcus' => floatval($this->session->recieved_amount), 
            'balance_amount_from_cus' => floatval($getbalanceamount), 
            'individual_discountamount' => $individualdiscountamount, 
            'before_discount_sub_total' => $totalamount, 
            'paying_amount' => $amounttoshowoffpaying, 
            'discount_percentage' => $discountpercentagevalue, 
            'subtract' => $subtractamounttotally, 
            'discount_amount' => $dicountvalueinnumber, 
            'discount_from_total_amount' => ($this->session->subtractedamountfromtotal=='NaN' || $this->session->subtractedamountfromtotal==null ) ? 0 : $this->session->subtractedamountfromtotal 
       
        );

        $last_insert_id = $this->main_model->savecashamount($orderdetailsarray);
        $this->session->set_userdata('last_insert_id',$last_insert_id);


         

        if($paying_amount_given > $recieved_amount){
            $credit_data = array(
                'sales_credit_amount' => $balance_amount,
                'summery_id_fk' => $last_insert_id, 
                'outlet_id' => $this->session->outlet_id
            );
            $this->main_model->savecreditamountnow($credit_data);
            $this->main_model->savecreditamountforcustomer($this->session->userdata('customer_id'),$balance_amount); 
        }
        echo $last_insert_id; 



    }

    public function saveassessiontogetback(){
        $balance_amount = floatval($this->security->xss_clean($_POST['balance_amount'])); 
        echo $this->session->set_userdata('mainbalance',$balance_amount); 
      
       
    }

    public function savechequepayment(){
        $bank_name = $this->security->xss_clean($_POST['bank_name']);
        $bank_branch = $this->security->xss_clean($_POST['bank_branch']);
        $account_no = $this->security->xss_clean($_POST['account_no']);
        $paying_amount_given  = $this->security->xss_clean($_POST['paying_amount_given']);
        $cheque_date = $this->security->xss_clean($_POST['cheque_date']);

        $recieved_amount = $this->security->xss_clean($_POST['recieved_amount']);
        $cheque_amount_balance = $this->security->xss_clean($_POST['cheque_amount_balance']);
        $fulltimewithdate = $this->security->xss_clean($_POST['fulltimewithdate']);
        $outletid = (int)$this->session->userdata('outlet_id');

        $discountpercentage = $this->security->xss_clean($_POST['discountpercentage']);
        $dicountvalue = $this->security->xss_clean($_POST['dicountvalue']);
        $sales_invoice_id = $this->security->xss_clean($_POST['sales_invoice_id']);

        $paywithcheck_additoinalinformation = $this->security->xss_clean($_POST['paywithcheck_additoinalinformation']); 

        $chequestatus = 'Pending';

        $balanceamount = floatval(($paying_amount_given - $recieved_amount)); 

        $this->session->set_userdata('addtional_information',$paywithcheck_additoinalinformation); 

        $orderedstatus = 1;
        $orderdetailsarray = array(
            'ordered_date' => $fulltimewithdate,
            'ordered_status' => 'Completed',
            'discount' => $discountpercentage,
            'discounted_amount' => $dicountvalue,
            'total_amount' => $paying_amount_given,
            'ordered_status' => $orderedstatus,
            'customer_id' => (int)$this->session->userdata('customer_id'),
            'payment_method' => 'Cheque',
            'outlet_id' => $outletid,
            'status' => 'Sold',
            'invoice_no' => $sales_invoice_id, 
            'additional_text' => $paywithcheck_additoinalinformation,
            'recieved_amount_fromcus' => $recieved_amount, 
            'balance_amount_from_cus' => $balanceamount, 
            'discount_from_total_amount' => ($this->session->subtractedamountfromtotal=='NaN' || $this->session->subtractedamountfromtotal==null ) ? 0 : $this->session->subtractedamountfromtotal 

        );

          $last_insert_id = $this->main_model->saveamountforall($orderdetailsarray);
        
          $this->session->set_userdata('last_insert_id',$last_insert_id);

          if($cheque_amount_balance!=0){
              $credit_data = array(
                  'sales_credit_amount' => $cheque_amount_balance,
                  'summery_id_fk' => $last_insert_id
              );
              $this->main_model->savecreditamountnow($credit_data);
              $this->main_model->savecreditamountforcustomer($this->session->userdata('customer_id'), $cheque_amount_balance); 
          }

          $checkdata = array(
            'bank_name' => $bank_name,
            'branch_name' => $bank_branch,
            'account_no' => $account_no,
            'cheque_date' => $cheque_date,
            'cheque_status' => $chequestatus,
            'summery_id' => $last_insert_id

        );
        $makepaymentwithcheque = $this->main_model->paying_method_cheque($checkdata);

        echo $last_insert_id;
    }
    

    //hulk
    public function savesubtractedamounttocache(){
        $answer = $this->security->xss_clean($_POST['answer']); 
        echo $this->session->set_userdata('subtractedamountfromtotal',$answer); 
    }





}// End of script 
