<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountantside extends CI_Controller {
 
	  public function index(){
		  if($this->session->userdata('accountantid')!=''){
			      $this->load->view('accountant/layouts/header');
			  $this->load->view('accountant/mainpage/index');
        	$this->load->view('accountant/layouts/footer');
		  }
		  else {
		 	redirect(base_url() . 'Accountantside/loginoutlet'); 
			  
		  }
	 
	 }
	
		
	public function logout(){
		$this->session->unset_userdata('accountantid');
		redirect(base_url() . 'Accountantside/loginoutlet');
	}
   	
	
	  public function duecollection(){ 
		  if($this->session->userdata('accountantid')!=''){
			   $this->load->view('accountant/layouts/header');
        $this->load->view('accountant/duecollection/duecollection');
        $this->load->view('accountant/layouts/footer');
		  }
		  else {
			  redirect(base_url() . 'Accountantside/loginoutlet'); 
		  }
		
	 }
	
	   public function totalSales(){
		   if($this->session->userdata('accountantid')!=''){
			      $this->load->view('accountant/layouts/header');
        $this->load->view('accountant/totalsales/totalsales');
        $this->load->view('accountant/layouts/footer');
		   }
		   else {
			   	redirect(base_url() . 'Accountantside/loginoutlet');
		   }
	  
	 }
	 
	  public function duecollectiondetails(){
		 $result =$this->main_model->duecollectiondetails();
		 echo json_encode($result);
	 
	 }
	
	 public function fetchtotalsalesdetails(){
		 $result = $this->main_model->fetchtotalsalesdetails();
		 echo json_encode($result);
	 	 
	 }
	
	 public function loginoutlet()
		{
	  
		 if($this->session->userdata('accountantid')==''){
	     $this->load->view('accountant/loginoutlet/loginoutlet');
 	 	
		 }
		else {
			redirect(base_url().'Accountantside/index');
 		}
			
		}
	
		public function accountantloginarea(){
		$inputMobile = $this->security->xss_clean($_POST['inputmobile']);
		$inputPassword = $this->security->xss_clean($_POST['inputPassword']);
		$inputPassword= md5($inputPassword.'bmideen');
		
		$userId = null; 
		$username = null; 
		if($inputMobile=="" || $inputPassword==""){
			exit(); 
		}
			
 	 	$result = $this->main_model->accountantloginarea($inputMobile,$inputPassword);
		 
		if($result){
			foreach($result as $res){
				$userId = $res->acc_id;
				$username = $res->acc_name;
			}
				 $this->session->set_userdata('accountantid', $userId);
		 	$this->session->set_userdata('username', $username);
	 		
			
		}
		
	 	echo json_encode($result); 
		
		 
	}
	
	  
	 public function saveproducts(){
		$batchNo = $this->security->xss_clean($_POST['batchNo']); 
		$productsName = $this->security->xss_clean($_POST['productsName']); 
		$ManufectureDate = $this->security->xss_clean($_POST['ManufectureDate']); 
		$expiryDate = $this->security->xss_clean($_POST['expiryDate']); 
		$costprice = $this->security->xss_clean($_POST['costprice']); 
		$sellingprice = $this->security->xss_clean($_POST['sellingprice']); 
		$quantity = $this->security->xss_clean($_POST['quantity']); 
		
		
		if($batchNo=="" || $productsName=="" || $ManufectureDate=="" || $ManufectureDate=="" || $expiryDate=="" || $costprice=="" || $sellingprice==""){
			exit();
		}
		
		$data = array(
		'batch_no' => $batchNo, 
			'manufectureDate' => $ManufectureDate, 
			'expirydate' => $expiryDate, 
			'quantity' => $quantity,
			'costprice' => $costprice, 
			'sellingprice' => $sellingprice, 
			'product_name' => $productsName
		);
		
		
		$result = $this->main_model->saveproducts($data);
		echo $result; 
		
		
	}
	
	 
	 public function showoffproducts(){
		 $result = $this->main_model->showoffproducts();
		 echo json_encode($result);
	 }
	
	public function deleteProducts(){
		$id = $this->security->xss_clean($_POST['products_id']); 
		$deleteProducts =$this->main_model->deleteProducts($id); 
		echo $deleteProducts; 
	}
	
	
	public function updateProducts(){
		$hidden_id = (int)$this->security->xss_clean($_POST['hidden_id']);
		$ubatchNo = $this->security->xss_clean($_POST['ubatchNo']); 
		$uproductsName = $this->security->xss_clean($_POST['uproductsName']); 
		$uManufectureDate = $this->security->xss_clean($_POST['uManufectureDate']); 
		$uexpiryDate = $this->security->xss_clean($_POST['uexpiryDate']); 
		$uquantity = (int)$this->security->xss_clean($_POST['uquantity']); 
		$ucostprice = (int)$this->security->xss_clean($_POST['ucostprice']); 
		$usellingprice = (int)$this->security->xss_clean($_POST['usellingprice']);
		
	 
		$data = array(
		'batch_no' => $ubatchNo, 
			'manufectureDate' => $uManufectureDate, 
			'expirydate' => $uexpiryDate, 
			'quantity' => $uquantity,
			'costprice' => $ucostprice, 
			'sellingprice' => $usellingprice, 
			'product_name' => $uproductsName
		);
		
		 $result = $this->main_model->updateProducts($data,$hidden_id);
		echo $result; 
		
		 
	}
	
	 public function showofffetchcollection(){
			$result = $this->main_model->showofffetchcollection();
		echo json_encode($result); 
	
 	 }
	
	
	public function searchReports(){
	 $fromDate = $this->security->xss_clean($_POST['fromDate']); 
	 $toDate = $this->security->xss_clean($_POST['toDate']);
		
		$result = $this->main_model->searchReports($fromDate,$toDate);
		echo json_encode($result);
		
	}

}