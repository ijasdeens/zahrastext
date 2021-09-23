<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesrepside extends CI_Controller {
 
	 public function index(){
		 if($this->session->userdata('rep_id')!=''){
			$this->load->view('salesrep/layouts/header');
        $this->load->view('salesrep/customerdetails/customerdetails');
        $this->load->view('salesrep/layouts/footer');
		 }
		 else {
			 redirect(base_url() . 'Salesrepside/loginoutlet');
		 }
		 
	 }
	
	public function savecustomerdetails(){
		 if($this->session->userdata('rep_id')!='')
		 {
		 $this->load->view('salesrep/layouts/header');
        $this->load->view('salesrep/customerdetails/customerdetails');
        $this->load->view('salesrep/layouts/footer');
		 
		 }
		else {
			redirect(base_url() . 'Salesrepside/loginoutlet');
		}
	}
	
	
	public function duecollectiondetails(){
		 if($this->session->userdata('rep_id')!='')
		 {
		 $this->load->view('salesrep/layouts/header');
        $this->load->view('salesrep/duecollectiondetails/duecollectiondetails');
        $this->load->view('salesrep/layouts/footer');
		 
		 }
		else {
			redirect(base_url() . 'Salesrepside/loginoutlet');
		}
	}
	
	
	
	 
		public function loginoutlet()
		{
			
		if($this->session->userdata('rep_id')==''){
	     $this->load->view('salesrep/loginoutlet/loginoutlet');
 		}
		else {
			redirect(base_url() . 'Salesrepside/index');
 		}
			
			
		}
	 
	
	public function fetchproductdetails(){
		$result = $this->main_model->chooseallproducts();
		echo json_encode($result);
		
	}
	public function makeorder(){
	    if($this->session->userdata('rep_id')!=''){
		$data['discountvalue'] = $this->main_model->takealldiscountvalue();	
		 $this->load->view('salesrep/layouts/header',$data);
        $this->load->view('salesrep/productdetails/productdetails');
        $this->load->view('salesrep/layouts/footer');
		
		}
		else {
			redirect(base_url() . 'Salesrepside/loginoutlet');
		}
		
	 }
	 
 	
 	public function showsalesRep(){
		$result = $this->main_model->showsalesRep(); 
		echo json_encode($result); 
		
	}
	
	
	
	public function showcustomerdetails(){
		 	$result = $this->main_model->showcustomerdetails(); 
		echo json_encode($result); 
 
	}
	
	
	
	public function saveoffcustomerdetails(){
		$customername = $this->security->xss_clean($_POST['customername']); 
		$customer_nic = $this->security->xss_clean($_POST['customer_nic']); 
		$customer_phoneNo = $this->security->xss_clean($_POST['customer_phoneNo']); 
		$customerforwardmessage = $this->security->xss_clean($_POST['customerforwardmessage']); 
		
		$image1 = ''; 
		
		
		
		       $config['upload_path']="./assets/img/shopphotos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);
		 
		 if(isset($_FILES['shopimage']['name'])){

         $config['upload_path']="/assets/img/shopphotos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);
 
             if($this->upload->do_upload("shopimage")){
            $data = $this->upload->data();
            $image1 = $data['file_name'];
		 	
			 }
	}
		
		
		$data = array(
		'customer_name' => $customername, 
			'customer_nic' => $customer_nic, 
			'customer_phoneNo' =>$customer_phoneNo, 
			'shop_photo' => $image1,
			'customer_moneyforward' => $customerforwardmessage
		); 
		
		$result = $this->main_model->savecustomerdetails($data); 
		
	}
	
	
	
	
	public function deleteCustomerdetails(){
		$customer_id=(int)$this->security->xss_clean($_POST['customer_id']); 
		$photoLink = $this->security->xss_clean($_POST['photoLink']); 
		
		$path ="./assets/img/shopphotos/".$photoLink;
		
		unlink($path);
		
		$result = $this->main_model->deleteCustomerdetails($customer_id); 
		echo $result;	
		
	 	
	}
	
	
	public function updateallcustomerdetails(){
		
			$customername = $this->security->xss_clean($_POST['customername']); 
		$customer_nic = $this->security->xss_clean($_POST['customer_nic']); 
		$customer_phoneNo = $this->security->xss_clean($_POST['customer_phoneNo']); 
		$shop_photooldphoto = $this->security->xss_clean($_POST['shop_photooldphoto']); 
	 
		$hidden_id = (int)$this->security->xss_clean($_POST['hidden_id']); 
   		$image1 = ''; 
		
   		 $config['upload_path']="./assets/img/shopphotos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);
		 
		 if(isset($_FILES['shopimage']['name'])){
		 
		$config['upload_path']="/assets/img/shopphotos";
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload',$config);
 
             if($this->upload->do_upload("shopimage")){
            $data = $this->upload->data();
            $image1 = $data['file_name'];
		 	
			 }
			 
		$data = array(
		'customer_name' => $customername, 
			'customer_nic' => $customer_nic, 
			'customer_phoneNo' =>$customer_phoneNo, 
			'shop_photo' => $image1
		); 
		
 		$path ="./assets/img/shopphotos/".$shop_photooldphoto;
 		unlink($path);
	 	$result = $this->main_model->updateallcustomerdetails($data,$hidden_id); 
 			 
	}
		else {
		$data = array(
		'customer_name' => $customername, 
			'customer_nic' => $customer_nic, 
			'customer_phoneNo' =>$customer_phoneNo
		); 
		
		$result = $this->main_model->updateallcustomerdetails($data,$hidden_id); 
				
	 	}
		
  	}
	
	
	public function addtocart(){
		$product_id = (int)$this->security->xss_clean($_POST['product_id']);
		$availablequantity = (int)$this->security->xss_clean($_POST['availablequantity']);
		$price = (int)$this->security->xss_clean($_POST['price']);
		$productName = $this->security->xss_clean($_POST['productName']);
		
	 	$data = array(
        'id'      => $product_id,
        'qty'     => 1,
        'price'   => $price,
        'name'    => $productName,
			'currentquantity' => $availablequantity
   		);

		$this->cart->insert($data);
  	}
	
	public function showoffwhatisinsidecart(){
		 	  $output = '';
		 foreach($this->cart->contents() as $row){
			 
			 $output.='<tr>
											<td>'.$row['name'].'</td>
											<td><input type="tel" style="text-align:center"  pattern="\d{1,5}" class="quantityvalue" availablequantity='.$row['currentquantity'].' title="Only digits" value="'.$row['qty'].'" productid='.$row['rowid'].'></td>
											<td>RS. '.$this->cart->format_number($row['subtotal']).'</td>
											<td><button productsid='.$row['rowid'].' class="btn btn-danger btn-sm removefromcard"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
										</tr>';
			 
		 }  
		 
		 
	 echo $output; 
		
 	}
	
	
	 
	public function takeTotalAmounts(){
		echo $this->cart->total();
	}
	
	
	   public function removefromcard(){
		    $rowId = $this->security->xss_clean($_POST['productid']); 
        
        $this->cart->remove($rowId);
        
    }
	
	public function countcardquantit(){
			$data = $this->cart->contents();
		
		echo json_encode($data); 
		
	}

	
	public function quantityaddedtovalue(){
		$productid = $this->security->xss_clean($_POST['productid']);
		$value = $this->security->xss_clean($_POST['value']);
		
		$data = array(
        'rowid' => $productid,
        'qty'   =>$value
			);
		$this->cart->update($data);
		
		
	}
	
	
	public function findoutcustomer(){
		$value = $this->security->xss_clean($_POST['value']); 
		
		$result = $this->main_model->findoutcustomer($value);
		echo json_encode($result);
	}
	
	
	public function placetheorder(){
		$hidden_id = (int)$this->security->xss_clean($_POST['id']);
		$paymentType = $this->security->xss_clean($_POST['pType']);
		$uniqueKey = $this->security->xss_clean($_POST['uniqueKey']);
		$date = $this->security->xss_clean($_POST['date']);
		
		$recievedAmount = $this->security->xss_clean($_POST['recievedAmount']);
		
		$key = md5(microtime().rand()).$uniqueKey;
	 	 
		if($hidden_id=="" || $paymentType=="" || $uniqueKey=="" || $date==""){
			echo 'Something is missing';
			exit();
		}
		$duechecker = 0;  
		$aprice = 0; 
		$percent = 0; 
		$total= 0; 
		$beforediscount = 0; 
		$totalprice =  $this->cart->total();
		$percent = (int)$paymentType;
	 	 
		
		 $beforediscount = $totalprice; 
		$old_price = $totalprice;

		$discount_value = ($old_price / 100) * $percent;

		$total = $old_price - $discount_value;
		 
		$duechecker = $total - $recievedAmount; 
		
		if($duechecker!=0){
		 $this->main_model->makeduepayment($duechecker,$hidden_id,$key);
		
		}
 
		foreach($this->cart->contents() as $row){
              $this->main_model->placeorder($hidden_id,$paymentType,$key,$row['id'],$row['qty'],$row['subtotal']); 
           }
		
		 $mydate=getdate(date("U"));
 	 
		 $status = 'Pending';
		
		 $data = array(
		'unique_key' => $key, 
			'date' => $date,
			'total_amount' => $beforediscount,
			'given_discount' => $percent,
			'after_discount' => $total, 
			'status' => $status
		); 
		
		$this->main_model->makesummeryforsale($data);
		 
		$this->cart->destroy();
 	}
	
	
	public function takesolddetails(){
		$result = $this->main_model->takesolddetails();
		 echo json_encode($result);
	
	}
	 
	
	
	public function salesreplogin(){
		$inputMobile = $this->security->xss_clean($_POST['inputMobile']);
		$inputPassword = $this->security->xss_clean($_POST['inputPassword']);
		$inputPassword= md5($inputPassword.'bmideen');
		
		$userId = null; 
		$username = null; 
		if($inputMobile=="" || $inputPassword==""){
			exit(); 
		}
 	 	$result = $this->main_model->salesreplogin($inputMobile,$inputPassword);
		 
		if($result!='0'){
			foreach($result as $res){
				$userId = $res->rep_id;
				$username = $res->rep_name;
			}
				 $this->session->set_userdata('rep_id', $userId);
		 	$this->session->set_userdata('username', $username);
	 		
			
		}
		
	 	echo json_encode($result); 
		
		 
	}
	
	public function logout(){
			$this->session->unset_userdata('rep_id');
			$this->session->unset_userdata('username');
		redirect(base_url() . 'Salesrepside/loginoutlet');
	}
	
	
	public function makeduepayment(){
		$totalamount = $this->cart->total();
		$recievedAmount = $this->security->xss_clean($_POST['recievedAmount']);
		$id = (int)$this->security->xss_clean($_POST['id']);
		
		$aftersubtract = ($totalamount-$recievedAmount);
  		$result = $this->main_model->makeduepayment($aftersubtract,$id);
 	}
	
	
	public function settleamount(){
		$recievedAmount = $this->security->xss_clean($_POST['recievedAmount']);
		$id = $this->security->xss_clean($_POST['id']);
		$uniquekey = $this->security->xss_clean($_POST['uniquekey']);
 		$result = $this->main_model->settleamount($recievedAmount,$id,$uniquekey);
		echo $result; 
	}
   	
}