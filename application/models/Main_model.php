<?php
class Main_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


     public function addSupplier($data){
        return $this->db->insert('supplier',$data);
    }


    public function showOffSuppliers(){
        $this->db->select('*');
        $this->db->from('supplier');
        $result = $this->db->get();


        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function frmBankDetails_section($data){
        return $this->db->insert('bank_details',$data);
    }


    public function getbankaccountdetails(){

        $this->db->select('*');
        $this->db->from('bank_details');
        $result = $this->db->get();
          if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }

    public function deleteaccountdetailss($deleteaccountid){
        return $this->db->where('bank_details_id',$deleteaccountid)->delete('bank_details');
    }



    public function deleteSuppliers($id){
        return $this->db->where('supplier_id',$id)->delete('supplier');
    }

    public function updateSuppliers($data,$id){
        return $this->db->where('supplier_id',$id)->update('supplier',$data);
    }


    public function warehouseMobile($data){
        return $this->db->insert('tbl_warehouse',$data);
    }

    public function viewWarehouseDetails(){
         $this->db->select('*');
         $this->db->from('tbl_warehouse');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function deleteWarehouseDetails($warehouse_id){
        return $this->db->where('warehouse_id',$warehouse_id)->delete('tbl_warehouse');
    }

    public function updatewarehouse($data,$id){
        return $this->db->where('warehouse_id',$id)->update('tbl_warehouse',$data);
    }

    

    public function savebrandsName($brandsName){
        return $this->db->insert('brands',array('brandds_name' => $brandsName));
    }

    public function saveBrand($brandsName){
        return $this->db->insert('brands',array('brands_name' => $brandsName));
    }

    public function savecategoriesName($categoriesName){
        return $this->db->insert('main_categories',array('categoris_name' => $categoriesName));
    }

    public function showOffBrands(){
        $this->db->select('*');
        $this->db->from('brands');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deleteBrands($brands_id){
        return $this->db->where('brands_id',$brands_id)->delete('brands');

    }
    public function deltecategories($catId){
        return $this->db->where('main_categoriesid',$catId)->delete('main_categories');

    }


    public function updatebrandssection($brandsName,$hidden_id){
        return $this->db->where('brands_id',$hidden_id)->update('brands',array('brands_name' => $brandsName));
    }

    public function updatecategories($id,$categoriesName){
        return $this->db->where('main_categoriesid',$id)->update('main_categories',array('categoris_name' => $categoriesName));

    }


    public function savesubcategory($main_category,$sub_category){
        return $this->db->insert('sub_category',array('main_cat_id' => $main_category,'sub_cat_id' => $sub_category));
    }




    public function showOffCategories(){
            $this->db->select('*');
        $this->db->from('main_categories');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function showoffsubCategory(){
        $this->db->select('main_categories.categoris_name,sub_category.sub_cat_id,sub_category.main_cat_id,sub_category.sub_categoryid,main_categories.main_categoriesid');
        $this->db->from('sub_category');
        $this->db->join('main_categories','main_categories.main_categoriesid=sub_category.main_cat_id');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deletesubcategories($id){
        return $this->db->where('sub_categoryid',$id)->delete('sub_category');
    }


    public function updatesubcategory($data,$id){
        return $this->db->where('sub_categoryid',$id)->update('sub_category',$data);
    }

    public function getallfinishingproductsfromwarehouse(){
        $this->db->select('products_section.quantity,products_section.alert_quantity,products_section.product_unit,warehouse_finished_product.product_id_fk,warehouse_finished_product.product_id_fk,warehouse_finished_product.warehouse_mute_option,warehouse_finished_product.outlet_id,products_section.product_name,products_section.product_price,products_section.product_unit');
        $this->db->from('warehouse_finished_product'); 
        $this->db->join('products_section','products_section.products_id=warehouse_finished_product.product_id_fk'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function mute_warehouserunningproduct($productid){
       return $this->db->where('warehouse_finished_product_id',$productid)->update('warehouse_finished_product',array('warehouse_mute_option' => 0)); 
    }

    public function unmute_warehouserunningproduct($productid){
        return $this->db->where('warehouse_finished_product_id',$productid)->update('warehouse_finished_product',array('warehouse_mute_option' => 1)); 
     }
 
     public function changecheckstatusforsupplier($cheqeustatus, $chequeid){
        return $this->db->where('supplier_cheques_id',$chequeid)->update('supplier_cheques',array('cheque_status' => $cheqeustatus)); 
     }

    

    public function saveproductdetailsforwarehouse($outlet_id,$productid){
        $this->db->select('warehouse_finished_product_id'); 
        $this->db->from('warehouse_finished_product'); 
        $this->db->where('product_id_fk',$productid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
          return 0;
        }
        else {
            return $this->db->insert('warehouse_finished_product',array('product_id_fk' => $productid,'outlet_id' => $outlet_id,'warehouse_mute_option' => 1));
        }
    }


    public function getwarehousefinishingproducts(){
        $this->db->select('quantity,alert_quantity,products_id');
        $this->db->from('products_section'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0 ){
            return $result->result(); 
        } 
        else {
            return 0;
        }
    }

    public function savecustomers($customerMobileNumber,$customerName,$customeraddress){

        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_mobile',$customerMobileNumber);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            $this->db->insert('customer',array('customer_name' =>$customerName,'customer_mobile' => $customerMobileNumber,'customer_address' => $customeraddress));
        }


    }


    public function searchmobilenumber($value){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_mobile',$value);
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function saveshoppinghold($datetime,$customerid,$holdprice,$outletid){
        $status = 1;
        $this->db->insert('shopping_hold',array('status' => $status,'customer_id' => $customerid,'date' => $datetime,'grand_total' => $holdprice,'outlet_id_fk' => $outletid));
        return $this->db->insert_id();
    }

    public function saveproductsforhold($data){
        return $this->db->insert('shopping_hold_products',$data);
    }

    public function holdingitemtodisplay($id,$outletid){
        $this->db->select('*');
        $this->db->from('shopping_hold');
        $this->db->join('customer','customer.customer_id=shopping_hold.customer_id','left');
        $this->db->join('shopping_hold_products','shopping_hold_products.sh_products_id=shopping_hold.shopping_hold','left');
        $this->db->join('products_section','products_section.products_id=shopping_hold_products.sh_products_id','left');
        $this->db->where('outlet_id_fk',$outletid);
        $this->db->where('sh_products_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deetedraftsection($shopping_hold){
        return $this->db->where('shopping_hold',$shopping_hold)->delete('shopping_hold');
    }




    public function getholdingproducts($id){
        $status = 1;
        $availablestatus = 0;
        $this->db->select('*');
        $this->db->from('shopping_hold');
        $this->db->where('status',$status);
        $this->db->where('outlet_id_fk',$id);
        $this->db->where('hold_returned_status', $availablestatus);
         return  $this->db->count_all_results();

    }

    public function allholdingproductsforlist($id){
        $status = 1;
        $availablestatus = 0;
        $this->db->select('*');
        $this->db->from('shopping_hold');
        $this->db->join('customer','customer.customer_id=shopping_hold.customer_id');
        $this->db->where('status',$status);
        $this->db->where('hold_returned_status', $availablestatus);
        $this->db->where('outlet_id_fk',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function list_all_holdshowoffproduct($id){
        $this->db->select('shopping_hold_products.quantity,products_section.product_name,products_section.product_price');
        $this->db->from('shopping_hold_products');
        $this->db->join('products_section','products_section.products_id=shopping_hold_products.sh_products_id');
        $this->db->where('shopping_hold_products.shopping_hold_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function getproductback($id){
        $this->db->select('products_section.product_unit,products_section.product_pic,products_for_outlet.product_quantity,products_section.products_id,shopping_hold_products.quantity,products_section.product_name,products_section.product_price');
        $this->db->from('shopping_hold_products');
        $this->db->join('products_section','products_section.products_id=shopping_hold_products.sh_products_id');
        $this->db->join('products_for_outlet','products_for_outlet.product_id=products_section.products_id');
        $this->db->where('shopping_hold_products.shopping_hold_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function makeupdateforpdocut($shopping_hold,$fulltimewithdate){
        return $this->db->where('shopping_hold',$shopping_hold)->update('shopping_hold', array('hold_returned_time' => $fulltimewithdate,'hold_returned_status' => 1));
    }


    public function showOffCustomers(){
        $this->db->select('*');
        $this->db->from('customer');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function showOffStaff(){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->join('outlets','outlets.outlets_id=staff.working_outlet');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



    public function deletecustomer($customer_id){
        return $this->db->where('customer_id',$customer_id)->delete('customer');
    }

    public function savestaffs($data){
        return $this->db->insert('staff',$data);
    }

    public function delestaff($staff_id){
        return $this->db->where('staff_id',$staff_id)->delete('staff');
    }


    public function updatestaffs($data,$id){
        return $this->db->where('staff_id',$id)->update('staff',$data);
    }


    public function loginintowarehouse($mobNumber,$mobPassword){
        $this->db->select('staff_id,staff_name,staff_mobile,joint_date,responsibility');
        $this->db->from('staff');
        $this->db->where('staff_mobile',$mobNumber);
        $this->db->where('password',$mobPassword);
        $this->db->where('warehouse_ok',1);
        $result = $this->db->get();

        if($result->num_rows() > 0){
             return $result->result();
        }
        else {
            return 0;
        }
    }

    public function updateallproducts($data,$productid){
        return $this->db->where('products_code',$productid)->update('products_section',$data);
    }



    public function choosesubcategories($value){
        $this->db->select('*');
        $this->db->from('sub_category');
        $this->db->where('main_cat_id',$value);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function saveproductdetails($data){
        return $this->db->insert('products_section',$data);
    }

    public function viewproducts(){
         $this->db->select('products_section.static_count_fromsupplier,products_section.additional_amount,products_section.products_code,products_section.product_unit,products_section.product_name,products_section.mfd,products_section.exp,products_section.product_cost,products_section.product_price,products_section.quantity,products_section.product_pic,products_section.product_desc, products_section.alert_quantity,brands.brands_name,main_categories.categoris_name,sub_category.sub_cat_id,products_section.products_id,supplier.supplier_name,products_section.batch_no,products_section.invoice_no');
        $this->db->from('products_section');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left');
        $this->db->join('main_categories','main_categories.main_categoriesid=products_section.category_id','left');
        $this->db->join('sub_category','sub_category.sub_categoryid=products_section.sub_categoryid','left');
        $this->db->join('supplier','supplier.supplier_id=products_section.supplier_det','left');
        $this->db->order_by('products_section.products_id','desc');

        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }
 
    public function search_bybarcodesection($code){
        $this->db->select('*');
        $this->db->from('products_section'); 
        $this->db->where('products_code',$code); 
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0; 
        }
    }

    public function getallproductsbasedonwarehouse($value){
        $this->db->select('products_section.products_code,products_section.product_unit,products_section.product_name,products_section.mfd,products_section.exp,products_section.product_cost,products_section.product_price,products_section.quantity,products_section.product_pic,products_section.product_desc, products_section.alert_quantity,brands.brands_name,main_categories.categoris_name,sub_category.sub_cat_id,products_section.products_id,supplier.supplier_name,products_section.batch_no,products_section.invoice_no');
        $this->db->from('products_section');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left');
        $this->db->join('main_categories','main_categories.main_categoriesid=products_section.category_id','left');
        $this->db->join('sub_category','sub_category.sub_categoryid=products_section.sub_categoryid','left');
        $this->db->join('supplier','supplier.supplier_id=products_section.supplier_det','left');
        $this->db->order_by('products_section.products_id','desc');
        $this->db->where('products_section.warehouse_id',$value);

        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function deleteproduct($products_id){
        return $this->db->where('products_id',$products_id)->delete('products_section');
    }


    public function showOutlets(){
        $this->db->select('*');
        $this->db->from('products_for_outlet');
        $result = $this->db->get();

        if($result->num_rows() > 0){
          return $result->result();
        }
        else {
            return 0;
        }

    }


     public function saveoutlets($data){
         return $this->db->insert('outlets',$data);
     }


     public function mainloginareaforadmin($number,$password){
        $this->db->select('admin_id');
        $this->db->from('admin');
        $this->db->where('admin_mob',$number);
        $this->db->where('admin_password',$password);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }

    public function getProductsforoutlet($id){
        $this->db->select('*');
        $this->db->from('products_for_outlet');
        $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id','left');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left');
        $this->db->where('outlet_id',$id);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function requestquantity($data){
        return $this->db->insert('warehouse_request_product',$data);
    }

    public function undorequestsection($outletid,$product_id){
      //getback

        $checkarray = array(
            'outlet_id' => $outletid,
            'product_id' => $product_id
        );

        return $this->db->where($checkarray)->delete('warehouse_request_product');

    }

    public function warehouse_request_product($outletid){
        $status = 'Pending';
         $this->db->select('product_id,status');
         $this->db->from('warehouse_request_product');
         $this->db->where('outlet_id',$outletid);
         $this->db->where('status',$status);
         $result = $this->db->get();
         if($result->num_rows() > 0){
             return $result->result();
         }
         else {
             return 0;
         }
    }

    public function getallresultdata($id,$date){
        $this->db->select('total_amount');
        $this->db->from('order_summery');
        $this->db->where('outlet_id',$id);
         $this->db->where('SUBSTRING(ordered_date,1,10)',$date);
        $result = $this->db->get();
        if($result->num_rows() > 0 ){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function getCreditsbycustomerdetails($date,$outletid){
        $this->db->select('sales_credit_details.sales_credit_amount,order_summery.total_amount,order_summery.invoice_no,order_summery.ordered_date,order_summery.discount,order_summery.discounted_amount,customer.customer_name,customer.customer_mobile,customer.customer_address');
        $this->db->from('order_summery'); 
        $this->db->join('customer','customer.customer_id=order_summery.customer_id'); 
        $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=order_summery.order_summery_id'); 
        $this->db->where('order_summery.payment_method', 'Credit');
        $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)',$date);  
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }       
        else {
            return 0;
        }
    } 

    public function saverefundamountforregisterdetails($refundedamount, $date,$outletid){
        return $this->db->query('update register_details_section set refunded_amount=(refunded_amount + '.$refundedamount.') where date="'.$date.'" and outlet_id='.$outletid.'');
    }
    

    public function getCreditsbycustomerdetailswithdate($fromdate,$todate,$outletid){
        $this->db->select('sales_credit_details.sales_credit_amount,order_summery.total_amount,order_summery.invoice_no,order_summery.ordered_date,order_summery.discount,order_summery.discounted_amount,customer.customer_name,customer.customer_mobile,customer.customer_address');
        $this->db->from('order_summery'); 
        $this->db->join('customer','customer.customer_id=order_summery.customer_id'); 
        $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=order_summery.order_summery_id'); 
        $this->db->where('order_summery.payment_method', 'Credit');
        $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)>=',$fromdate);  
        $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)<=',$todate);  

        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }       
        else {
            return 0;
        }
    } 


    public function updatestaffsection($data, $id){
        return $this->db->where('staff_id',$id)->update('staff',$data);
    }


    public function getproductsforreminder($id){

        $alertqty = 0;

        $getquery = $this->db->query('select outlet_alert_quantity from general_setting');
        foreach($getquery->result() as $query){
            $alertqty = $query->outlet_alert_quantity;
        }


        if($alertqty!==0){
                   $this->db->select('*');
        $this->db->from('products_for_outlet');
        $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id');
        $this->db->where('outlet_id',$id);
        $this->db->where('products_for_outlet.product_quantity<',$alertqty);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


        }



    }

    public function alert_quantity_for_outlets_text($id){
        $this->db->where('general_setting_id',1)->update('general_setting',array('outlet_alert_quantity' => $id));
    }


    public function loginforcashier($mobNumber,$mobPassword){
        $status = 1;

        $this->db->select('staff.staff_name,staff.staff_id,outlets.outlets_name,staff.working_outlet,outlets.outlet_mob,outlets.addresses');
        $this->db->from('staff');
        $this->db->join('outlets','outlets.outlets_id=staff.working_outlet');
        $this->db->where('staff.staff_mobile',$mobNumber);
        $this->db->where('staff.password',$mobPassword);
        $this->db->where('cashier_ok',$status);

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }




    public function getselctedoutletreport($value){

        if($value=='All'){
             $this->db->select('*');
            $this->db->from('products_for_outlet');
            $this->db->join('outlets','outlets.outlets_id=products_for_outlet.outlet_id');
            $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id');
            $result = $this->db->get();

            if($result->num_rows() > 0){
                return $result->result();
            }
            else {
                return 0;
            }

         }
        else {

         $this->db->select('*');
        $this->db->from('products_for_outlet');
        $this->db->join('outlets','outlets.outlets_id=products_for_outlet.outlet_id');
        $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id');
        $this->db->where('outlets.outlets_id',$value);
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }




        }



    }


    public function alloutlets(){
        $this->db->select('*');
        $this->db->from('outlets');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deleteoutlet($value){
        return $this->db->where('outlets_id',$value)->delete('outlets');

    }


    public function saveinoutlets($outlet_data,$hidden_id,$qty){
        $this->db->select('product_id'); 
        $this->db->from('products_for_outlet'); 
        $this->db->where('product_id',$hidden_id); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
        return $this->db->query('update products_for_outlet set product_quantity=(product_quantity + '.$qty.') where product_id = '.$hidden_id.' ');

        }
        else {
            return $this->db->insert('products_for_outlet',$outlet_data);

        }
    }

    public function updateproductsection($balance,$hidden_product_id){
        return $this->db->where('products_id',$hidden_product_id)->update('products_section', array('quantity' => $balance));
    }

    public function saveadmindetails($admin_name,$admin_mobile,$admin_gmail){
        return $this->db->where('admin_id',1)->update('admin',array('admin_name' => $admin_name,'admin_mob' => $admin_mobile,'admin_gmail' => $admin_gmail));
    }


    public function changepassword($oldPassword, $newpassword){
        $this->db->select('admin_id');
        $this->db->from('admin');
        $this->db->where('admin_password',$oldPassword);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $this->db->where('admin_id',1)->update('admin',array('admin_password' => $newpassword));
        }
        else {
            return 0;
        }


    }

    public function increasequantityforunit($ouetletid,$productid,$itemqty){
        $checkarray = array('outlet_id' => $ouetletid,'product_id' => $productid);

        $oldquantity = 0;

        $this->db->select('product_quantity');
        $this->db->from('products_for_outlet');
        $this->db->where($checkarray);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            return $result->result();
        }



    }

    public function choose_outlets_for_particularsearch($value){
        
         $this->db->select('products_section.product_cost,products_section.product_price,products_for_outlet.products_for_outlet,products_for_outlet.product_id,products_for_outlet.product_quantity'); 
         $this->db->from('products_for_outlet'); 
         $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id');
        if($value!='-'){
            $this->db->where('products_for_outlet.outlet_id',$value); 
        } 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }
        else {
            return 0;
        }

    }

    public function homewarehouse_summery_details(){
        $this->db->select('quantity,products_id,product_cost,product_price');
        $this->db->from('products_section'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        } 
        else {
            return 0;
        }
    }

    public function print_return_invoice_section($data){
        return $this->db->insert('return_product_details_all',$data);
    }

    public function checkavailableproductscount(){
        $this->db->select('product_name,quantity,alert_quantity,product_pic,products_code,products_id');
        $this->db->from('products_section');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function showAdmindetails(){
        $this->db->select('admin_mob,admin_gmail,admin_name');
        $this->db->from('admin');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else{
            return 0;
        }
    }


    public function personchangeprofile($person_name,$person_tel,$admin_id){
        return $this->db->where('staff_id',$admin_id)->update('staff',array('staff_name' => $person_name,'staff_mobile' => $person_tel));
    }


    public function changepasswordforstaff($current_password,$newPassword,$admin_id){
         $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('password',$current_password);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $this->db->where('staff_id',$admin_id)->update('staff',array('password' => $newPassword));
        }
        else {
            return 0;
        }

    }


    public function checkProductcodeExist($value){
       $this->db->select('products_id');
        $this->db->from('products_section');
        $this->db->where('products_code',$value);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            return 0;
        }
    }

    public function getSuppliers(){
        $this->db->select('*');
        $this->db->from('supplier');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function removeproductsall($products_id){
        return $this->db->where('products_id',$products_id)->delete('products_section');
    }


    public function refillquantity($product_id,$refill_quantity){
        return $this->db->where('products_id',$product_id)->update('products_section', array('quantity' => $refill_quantity));
    }


    public function createInvoice(){
         $query = $this->db->query("SELECT max(invoice_id) as invoiceid from invoice_id_generator");
        $row = $query->row_array();
        return $row['invoiceid'];
    }


    public function saveupperbatch($invoiceId){
        return $this->db->insert('invoice_id_generator',array('Id_k' => $invoiceId));
    }


    public function expensesType($expensesName){
        return $this->db->insert('expense_type',array('expense_name' => $expensesName));

    }

    public function showexpeseType(){
        $this->db->select('*');
        $this->db->from('expense_type');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deleteexpenses($expenseId){
        return $this->db->where('expense_typeid',$expenseId)->delete('expense_type');
    }



    public function showexpensesList(){
        $this->db->select('*');
        $this->db->from('expenses_list');
       $this->db->join('expense_type','expense_type.expense_typeid=expenses_list.expense_type');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function delete_expense_details($id){
        return $this->db->where('expenses_list_id',$id)->delete('expenses_list');

    }

    public function saveexpensesList($data){
        return $this->db->insert('expenses_list',$data);
    }


    public function removelistexpense($exp_id){
        return $this->db->where('expenses_list_id',$exp_id)->delete('expenses_list');
    }

    public function activecashierbtn($exp_id){
        return $this->db->where('staff_id',$exp_id)->update('staff',array('cashier_ok' => true));

    }
        public function activeforwarehouse($activewarehoue) {
            return $this->db->where('staff_id',$activewarehoue)->update('staff',array('warehouse_ok' => 1)); 
        }


        public function inactivecashierbtn($exp_id){
        return $this->db->where('staff_id',$exp_id)->update('staff',array('cashier_ok' => false));

    }

    public function inactivewarehouse($id){
        return $this->db->where('staff_id',$id)->update('staff',array('warehouse_ok' => 0)); 
    }


    public function update_all_details_general($data){
        return $this->db->where('general_settings_id',1)->update('general_settings',$data);
    }
    public function getwarehousedetails(){
        $this->db->select('*'); 
        $this->db->from('tbl_warehouse'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function getalldetailsforsettings(){
        $this->db->select('*');
        $this->db->from('general_settings');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function listallchecksection(){
        $this->db->select('*');
        $this->db->from('cheques_details');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



    public function savechequedetails($data){
        return $this->db->insert('cheques_details',$data);
    }


    public function givendetailsfrm($hidden_id,$cheque_status,$suppliers_details,$time){
        $this->db->where('cheque_details_id',$hidden_id)->update('cheques_details',array('status' => $cheque_status));

         $this->db->select('cheque_id');
         $this->db->from('cheque_status');
        $this->db->where('cheque_id',$hidden_id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $this->db->where('cheque_id',$hidden_id)->update('cheque_status',array('status' => $cheque_status,'given_date' => $time));
        }
        else {
            return $this->db->insert('cheque_status',array('cheque_id' => $hidden_id,'given_to_sup' => $suppliers_details,'status' => $cheque_status,'given_date' => $time));

        }

     }



    public function getchequespeopledetails(){
        $this->db->select('*');
        $this->db->from('cheque_status');
         $this->db->join('cheques_details','cheques_details.cheque_details_id=cheque_status.cheque_status_Id');
        $this->db->join('supplier','supplier.supplier_id=cheque_status.given_to_sup');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }


    public function getindividulareport($id){
        $this->db->select('*');
        $this->db->from('cheque_status');
         $this->db->join('cheques_details','cheques_details.cheque_details_id=cheque_status.cheque_status_Id');
        $this->db->join('supplier','supplier.supplier_id=cheque_status.given_to_sup');
        $this->db->where('cheque_status.given_to_sup',$id);
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }


    public function saveamountforall($data){
        $this->db->insert('order_summery',$data);
        return $this->db->insert_id();
    }




    public function getbankdetails(){
        $this->db->select('*');
        $this->db->from('bank_details');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function savepayingloanamount($data){
        $this->db->insert('loanpaiddetails',$data); 
    }

    public function getloanpaymentmentcheckmethod($fromdate, $todate, $paymentmethod, $outletid ){
        $this->db->select('*'); 
        $this->db->from('loanpaiddetails');
        if($fromdate!=null){
            $this->db->where('date>=',$fromdate); 
        } 
        if($todate!=null){
            $this->db->where('date<=',$todate); 
        }
        if($paymentmethod!=null){
            $this->db->where('loan_paid_method',$paymentmethod); 
        }
        $this->db->where('outlet_id_fk',$outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function detectpaymentforcheck($summery_id_fk,$cheque_loan_amount){
        $mycheckloan = floatval($cheque_loan_amount); 
        return $this->db->query("update sales_credit_details set sales_credit_amount=(sales_credit_amount - ".$mycheckloan.") where summery_id_fk=".$summery_id_fk."");
    }


    public function savepaymentdetailsforreigsterdetails($mydate, $outletid,$loanamount) {
         return $this->db->query('update register_details_section set cheque_payment=(cheque_payment + '.$loanamount.') where date="'.$mydate.'" and outlet_id='.$outletid.' '); 
    }

    public function submit_loan_chequessection($data){
        return $this->db->insert('paying_method_cheque',$data); 
    }


    public function paying_method_cheque($data){
        return $this->db->insert('paying_method_cheque',$data);
    }

    public function savecreditamountnow($credit_data){
        return $this->db->insert('sales_credit_details',$credit_data);
    }

    public function checkstaffoldpassword($currentpassword,$cahsierid){
        $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('staff_id',$cahsierid);
        $this->db->where('password',$currentpassword);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            0;
        }
    }

    public function savedatafordetailsproduct($data,$productid,$outletid,$summeryids,$name, $currentquantity, $prid, $outid,$todaydate){
       
        $result = true; 
        
        $totalamount = 0; 
        $discountamount = 0; 

        if($result){
            $this->db->select('total_amount,discounted_amount'); 
            $this->db->from('order_summery'); 
            $this->db->where('order_summery_id',$summeryids); 
            $this->db->where('outlet_id',$outletid); 
            $result = $this->db->get(); 
            $row = $result->result(); 
            
            foreach($row as $text){
                $totalamount = floatval($text->total_amount); 
                $discountamount = floatval($text->discounted_amount); 
            }   


            $this->db->select('details_of_product_id'); 
            $this->db->from('detailsofproduct'); 
            $this->db->where('product_id',$productid); 
            $this->db->where('outlet_id',$outletid);
            $result = $this->db->get(); 
            if($result->num_rows() > 0) {
            $query = $this->db->query('update detailsofproduct set total_amount=(total_amount + '.$totalamount.'), quantity=(quantity + '.$currentquantity.'), discount_amount=( discount_amount + '.$discountamount.') where product_id='.$productid.' and outlet_id='.$outletid.'');
                 
            }
            else {
                $result = $this->db->insert('detailsofproduct',array('Name' => $name, 'quantity' => $currentquantity, 'quantity' => $currentquantity,'total_amount' => $totalamount,'discount_amount' => $discountamount,'product_id' => $productid,'outlet_id' => $outletid, 'date' => $todaydate)); 
            }




        }
        
        
    }

    
    public function getdetailsofsoldproduct($date){
        $this->db->select('*'); 
        $this->db->from('detailsofproduct'); 
        $this->db->where('date',$date); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function changepasswordforstaffs($newpassword,$cashier_id){
      return $this->db->where('staff_id',$cashier_id)->update('staff', array('password' => $newpassword));
    }

    public function saveorderdetails($data){
        return $this->db->insert('order_details',$data);
    }

    public function reduceProductQuantity($answer,$product_id,$outletid){

        $checkarray = array(
            'outlet_id' => $outletid,
            'product_id' => $product_id
        );
        return $this->db->where($checkarray)->update('products_for_outlet', array('product_quantity' => $answer));
    }


    public function searchsalesfordate($from_date,$to_date){


    }

    public function create_invoice_id(){
       $this->db->select_max('order_summery_id');
        $this->db->from('order_summery');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function getallproductdetailsforbarcode(){
        $this->db->select('product_price,products_id,product_name,products_code,mfd,exp,product_unit');
        $this->db->from('products_section');
        $this->db->order_by("products_id ", "desc");
        $this->db->limit(6,0);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function updateoutletsections($data,$id){
        return $this->db->where('outlets_id',$id)->update('outlets',$data); 
    }

    public function passwordverificationfordelete($password){
        $this->db->select('admin_id'); 
        $this->db->from('admin'); 
        $this->db->where('admin_password',$password); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return 1; 
        }
        else {
            return 0;
        }
    }

    public function getpoductbysearching($value){
         $this->db->select('product_price,products_id,product_name,products_code,mfd,exp,product_unit');
        $this->db->from('products_section');
        $this->db->order_by("products_id ", "desc");
        $this->db->limit(10,0);
        $this->db->like('product_name',$value);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function sales_report_product(){
        $this->db->select('*');
        $this->db->from('order_summery');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

      public function search_sales_report_product($outlet_details,$from_date_for_sale_report,$end_date){
        $this->db->select('*');
        $this->db->from('order_summery');
        $this->db->where('outlet_id',$outlet_details);
        $this->db->where('SUBSTRING(ordered_date,1,10)>=',$from_date_for_sale_report);
        $this->db->where('SUBSTRING(ordered_date,1,10)<=',$end_date);
         $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function gettotalsalesanddiscount($date){
        $this->db->select('order_summery.total_amount,order_summery.discounted_amount'); 
        $this->db->from('order_summery');
        $this->db->where('SUBSTRING(ordered_date,1,10)',$date); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }





    public function getsoldproductdetails($outlet_id,$invoice_no,$order_summery_id){
        $this->db->select('products_section.product_name,order_details.choosen_quantity,order_details.status,products_section.product_price');
        $this->db->where('order_details.summery_id',$order_summery_id);
        $this->db->from('order_details');
        $this->db->join('products_section','products_section.products_id=order_details.product_id');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function showcustomerdetailsforsales($customer_id){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_id',$customer_id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function takeProfitsandsalesdetails($outletid, $fromdate, $todate){
        $this->db->select('order_summery.total_amount,order_summery.discounted_amount,sales_credit_details.sales_credit_amount');
        $this->db->from('order_summery');
        $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=order_summery.order_summery_id','left');
        if($outletid!=null){
            $this->db->where('order_summery.outlet_id',$outletid);
        }
        if($fromdate!=null){
             $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)>=',$fromdate);
        }

        if($todate!=null){
              $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)<=',$todate);
        }

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function getpurchaseDue(){
      $this->db->select('sales_credit_amount');
      $this->db->from('sales_credit_details');
      $result = $this->db->get();
         if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function getotherxpenes($outletid,$fromdate,$todate){
      $this->db->select('expense_amount');
      $this->db->from('expenses_list');
      if($outletid!=null){
          $this->db->where('outlet_id_fk',$outletid);
      }
      if($fromdate!=null){
          $this->db->where('expense_date>=',$fromdate);
      }

      if($todate!=null){
          $this->db->where('expense_date<=',$todate);
      }

      $result = $this->db->get();
      if($result->num_rows() > 0){

          return $result->result();
      }
        else {
            return 0;
        }


    }

    public function savesendsmsrecoredid($data){
      $this->db->insert('smshistory',$data);
    }

    public function search_sms_history_date($fromdate, $todate){
        $this->db->select('*'); 
        $this->db->from('smshistory'); 
        $this->db->where('smshistory_date>=',$fromdate); 
        $this->db->where('smshistory_date<=', $todate); 
        $this->db->order_by('smshistory_id','desc');
        $result = $this->db->get(); 
        if($result->num_rows() > 0 ){
            return $result->result(); 
        }
        else {
            return 0; 
        }
    }

    public function recordsmshistory($data){
        $this->db->insert('smshistory',$data);
    }


    public function getcustomerdetailsformessage(){
        $this->db->select('*');
        $this->db->distinct('customer_mobile');
        $this->db->from('customer');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function group_details(){
        $this->db->select('*');
        $this->db->from('groups_for_sms');
       // $this->db->join('group_sms_contact','group_sms_contact.group_id_fk=groups_for_sms.groups_id','left');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function checknamexist($name){
        $this->db->select('*');
        $this->db->from('groups_for_sms');
        $this->db->where('groups_name',$name);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            return 0;
        }
    }



    public function creategroupsforsms($name){
        return $this->db->insert('groups_for_sms',array('groups_name' => $name));
    }


    public function deletegroupforsms($id){
        return $this->db->where('groups_id',$id)->delete('groups_for_sms');
    }

    public function updategroupname($name, $id){
        $this->db->where('groups_id',$id)->update('groups_for_sms',array('groups_name' => $name));
    }

    public function getcontactdetailsforsms($id){

            $this->db->select('group_sms_contact.group_sms_contact_id,group_sms_contact.customer_id,customer.customer_name,customer.customer_mobile');
        $this->db->from('group_sms_contact');
        $this->db->join('customer','customer.customer_id=group_sms_contact.customer_id');
        $this->db->where('group_sms_contact.group_id_fk',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function frmsms_group_message_section_forall($id){

            $this->db->select('customer.customer_mobile');
        $this->db->from('group_sms_contact');
        $this->db->join('customer','customer.customer_id=group_sms_contact.customer_id');
        $this->db->where('group_sms_contact.group_id_fk',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }



    public function deletecontactdetails($id){
        return $this->db->where('customer_id',$id)->delete('group_sms_contact');
    }

    public function checkinggroupexisting($customerid,$groupid){
        $this->db->select('group_sms_contact_id');
        $this->db->from('group_sms_contact');
        $this->db->where('group_id_fk',$groupid);
        $this->db->where('customer_id',$customerid);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            return 0;
        }
    }

    public function savecontact_details_forsms($customerid,$groupid){
        return $this->db->insert('group_sms_contact',array('group_id_fk' => $groupid,'customer_id' => $customerid));
    }

    public function saverecordeddetails($data){
        $this->db->insert('smshistory',$data);
    }

    public function addcustomers_to_group_for_smssection($group_id,$customerid){
        $this->db->select('group_id_fk'); 
        $this->db->from('group_sms_contact'); 
        $this->db->where('group_id_fk',$group_id); 
        $this->db->where('customer_id', $customerid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return 0; 
        }
        else {
        return $this->db->insert('group_sms_contact',array('group_id_fk' => $group_id,'customer_id' => $customerid));

        }
    }

    public function getoutletcredits($outletid, $fromdate,$todate){
        $statuscredit = 'Credit';

         $this->db->select('total_amount');
        $this->db->from('order_summery');

          if($outletid!=null){
            $this->db->where('order_summery.outlet_id',$outletid);
        }
        if($fromdate!=null){
             $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)>=',$fromdate);
        }

        if($todate!=null){
              $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)<=',$todate);
        }

     $this->db->where('payment_method',$statuscredit);

    $result = $this->db->get();
    if($result->num_rows() > 0){
        return $result->result();
    }
        else {
            return 0;
        }


    }





    public function frm_first_ads_section($name){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_1' => $name));
    }


    public function first_ads_remove(){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_1' => ''));
    }





    public function frm_second_ads_section($name){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_2' => $name));
    }


        public function remove_second_ads_section(){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_2' => ''));
    }






    public function frm_third_ads_section($name){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_3' => $name));
    }


   public function remove_third_ad_section(){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_3' => ''));
    }





    public function frm_forth_ads_section($name){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_4' => $name));
    }

    public function fourth_remove_pic(){
        return $this->db->where('customer_ads_dis_id',1)->update('customer_dis_ads',array('customer_ads_4' => ''));
    }



    public function getalladsfordisplaysection(){
        $this->db->select('*');
        $this->db->from('customer_dis_ads');
        $result = $this->db->get();
        return $result->result();

    }


    public function getgeneral_setting(){
        $this->db->select('*');
        $this->db->from('general_setting');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }





    public function savegeneralsettings($pictureName,$company_name,$company_address,$company_hotline){
        if($pictureName==''){
            return $this->db->where('general_setting_id',1)->update('general_setting',array('company_name' => $company_name,'company_address' => $company_address,'main_hotline_number' => $company_hotline));

        }
        else {
            return $this->db->where('general_setting_id',1)->update('general_setting',array('company_name' => $company_name,'logo' => $pictureName,'company_address' => $company_address,'main_hotline_number' => $company_hotline));

        }
    }

    public function getresultsofoutlets(){
        $this->db->select('*'); 
        $this->db->from('outlets');
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function products_outlet_detailsget($value){
        $this->db->select('products_for_outlet.product_id,products_section.products_code, products_section.mfd, products_section.exp, products_section.product_cost,products_section.product_price,products_section.quantity,products_section.alert_quantity,products_section.product_pic,products_section.product_desc,products_section.product_name,products_section.product_unit,products_section.batch_no,products_section.supplier_det,products_section.batch_no,products_section.invoice_no,products_section.additional_amount,brands.brands_name,main_categories.categoris_name,sub_category.sub_cat_id as sub_categoryname, products_for_outlet.product_quantity as outletquantity');
        $this->db->from('products_for_outlet'); 
        $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id','left');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left'); 
        $this->db->join('main_categories','main_categories.main_categoriesid=products_section.category_id','left'); 
        $this->db->join('sub_category','sub_category.sub_categoryid=products_section.sub_categoryid','left');
        $this->db->where('products_for_outlet.product_id',$value); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }

    }


    public function deleteproductsforoutlet($id){
        return $this->db->where('product_id',$id)->delete('products_for_outlet');
    }
    
    public function searchinvoicebasedpurchase($fromdate,$todate,$outletid){
        $this->db->select('customer.customer_name,customer.customer_mobile,order_summery.invoice_no,order_summery.ordered_date,order_summery.order_summery_id');
        $this->db->from('order_summery');
        $this->db->join('customer','customer.customer_id=order_summery.customer_id','left');
       $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)>=',$fromdate);
       $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)<=',$todate);
       $this->db->where('order_summery.outlet_id',$outletid);

        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function getproductdetails($order_summery_id){
        $this->db->select('order_summery.discount,order_summery.discounted_amount,order_summery.total_amount as fulltotalamount,products_section.products_id as product_id,products_section.product_name,products_section.product_price,order_details.choosen_quantity,products_section.products_id,products_section.products_code,order_details.choosen_quantity,order_details.sub_total');
        $this->db->from('order_details');
        $this->db->join('products_section','products_section.products_id=order_details.product_id','left');
        $this->db->join('order_summery','order_summery.order_summery_id=order_details.summery_id','left');
        $this->db->where('order_details.summery_id',$order_summery_id);
        $result = $this->db->get();
        if($result->num_rows() >0){
            return $result->result();
        }
        else {
            return 0;
        }


    }


    public function savetemporaryforsalesunitreturn($data){
        return $this->db->insert('return_temp_details',$data);
    }


    public function product_details_to_display_forinvoice_return($outletid){
        $this->db->select('*');
        $this->db->from('return_temp_details');
        $this->db->where('outlet_id',$outletid);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function deltetemporarycopy($id){
        $this->db->where('outlet_id',$id)->delete('return_temp_details');
    }


    public function return_product_to_sale($returnedquantityvalue,$outletid,$ordersummeryid,$productid){
      $this->db->select('product_quantity');
      $this->db->from('products_for_outlet');
      $this->db->where('product_id',$productid);
      $this->db->where('outlet_id',$outletid);
      $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function reupdatequantityintodb($totalqty, $product_id,$outletid){
         $wherearray = array(
        'outlet_id' => $outletid,
            'product_id' => $product_id
        );

    $updateresult = $this->db->where($wherearray)->update('products_for_outlet',array('product_quantity' => $totalqty));
    return $updateresult;

    }


    public function reduceresultfromqty($subtractedqty,$product_id,$outletid,$order_summery_id){
        $this->db->select('choosen_quantity');
        $this->db->from('order_details');
        $this->db->where('product_id',$product_id);
        $this->db->where('summery_id',$order_summery_id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }


    public function updatequantitytooutlet($answerqty,$order_summery_id,$product_id,$outletid){
        $checkdataarray = array(
        'summery_id' => $order_summery_id,
            'product_id' => $product_id
        );
        $status = 0;

        if($answerqty==0){
           $this->db->where($checkdataarray)->update('order_details',array('choosen_quantity' => $answerqty,'status' => $status));
         }
        else {

            $this->db->where($checkdataarray)->update('order_details',array('choosen_quantity' => $answerqty));

        }


    }



    public function bringcheckdetailstofront(){
        $this->db->select('sales_credit_details.sales_credit_amount, paying_method_cheque.paying_method_cheque_id,paying_method_cheque.account_no,paying_method_cheque.cheque_status,customer.customer_name,customer.customer_mobile,paying_method_cheque.summery_id,paying_method_cheque.cheque_status');
        $this->db->from('paying_method_cheque');
       $this->db->join('order_summery','order_summery.order_summery_id=paying_method_cheque.summery_id','left');
         $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=paying_method_cheque.summery_id','left');
        $this->db->join('customer','customer.customer_id=order_summery.customer_id','left');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


       public function geallbydateforcheckdetails($fromdate,$todate,$status){
        $this->db->select('sales_credit_details.sales_credit_amount, paying_method_cheque.paying_method_cheque_id,paying_method_cheque.account_no,paying_method_cheque.cheque_status,customer.customer_name,customer.customer_mobile,paying_method_cheque.summery_id,paying_method_cheque.cheque_status');
        $this->db->from('paying_method_cheque');
       $this->db->join('order_summery','order_summery.order_summery_id=paying_method_cheque.summery_id');
         $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=paying_method_cheque.summery_id');
        $this->db->join('customer','customer.customer_id=order_summery.customer_id');
        
        if($fromdate!=''){
        $this->db->where('paying_method_cheque.cheque_date>=',$fromdate);

        }
        if($todate!=''){
        $this->db->where('paying_method_cheque.cheque_date<=',$todate);

        }

        if($status!=''){
        $this->db->where('paying_method_cheque.cheque_status',$status);

        }
 
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



 
    public function companylogotaker(){
        $this->db->select('logo');
        $this->db->from('general_setting');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function check_details_view($id){
        $this->db->select('*');
        $this->db->from('paying_method_cheque');
        $this->db->where('paying_method_cheque_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



    public function select_pending_save($status,$paying_method_cheque_id){
        return $this->db->where('paying_method_cheque_id',$paying_method_cheque_id)->update('paying_method_cheque',array('cheque_status' => $status));

    }


    public function select_option_pass($status,$paying_method_cheque_id){
        return $this->db->where('paying_method_cheque_id',$paying_method_cheque_id)->update('paying_method_cheque',array('cheque_status' => $status));

    }



    public function select_returned($status,$paying_method_cheque_id){
        return $this->db->where('paying_method_cheque_id',$paying_method_cheque_id)->update('paying_method_cheque',array('cheque_status' => $status));

    }
    public function select_postponed($status,$paying_method_cheque_id){
        return $this->db->where('paying_method_cheque_id',$paying_method_cheque_id)->update('paying_method_cheque',array('cheque_status' => $status));

    }



    public function savebank_details_section($data){
        return $this->db->insert('bank_details',$data);
    }

    public function deletebankaccountdetails($deleteaccountid){
        return $this->db->where('bank_details_id',$deleteaccountid)->delete('bank_details');
    }


    public function makeprimaryaccount($status, $id){
        $this->db->update('bank_details',array('primary_bank' => 0));
        $this->db->where('bank_details_id',$id)->update('bank_details',array('primary_bank' => 1));
    }

    public function getcashfrombankaccount($id){
        $this->db->select('initial_amount');
        $this->db->from('bank_details');
        $this->db->where('bank_details_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



    public function makenonprimaryforbankaccountdetails($status,$bankdetails){
        $this->db->where('bank_details_id',$bankdetails)->update('bank_details',array('primary_bank' => 0));

    }


    public function add_cash_to_bank_account($id,$answertosummery){
        return $this->db->where('bank_details_id',$id)->update('bank_details',array('initial_amount' => $answertosummery));
    }

    public function subtract_cash_to_bank_account($id,$answertosummery){
        return $this->db->where('bank_details_id',$id)->update('bank_details',array('initial_amount' => $answertosummery));
    }


    public function deleteexpensedetailsection($expneseid){
        return $this->db->where('expense_typeid',$expneseid)->delete('expense_type');
    }



    public function frmexpensesType_save($name){
        return $this->db->insert('expense_type',array('expense_name' => $name,'outlet_on_status' => 0));
    }


    public function enable_for_outlet_toexpenses($expenseid){

        return $this->db->where('expense_typeid',$expenseid)->update('expense_type',array('outlet_on_status' => 1));
    }

    public function disable_for_outlet_for_expense($expenseid){

        return $this->db->where('expense_typeid',$expenseid)->update('expense_type',array('outlet_on_status' => 0));
    }


    public function editexpenses_details($expenseid,$value){
        return $this->db->where('expense_typeid',$expenseid)->update('expense_type',array('expense_name' => $value));
    }

    public function getexpensestype(){
        $this->db->select('*');
        $this->db->from('expense_type');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


       public function selectedgetexpensestype(){
        $this->db->select('*');
        $this->db->from('expense_type');
        $this->db->where('outlet_on_status',1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }





    public function save_expneses_details_manually($data){
        return $this->db->insert('expenses_list',$data);
    }



    public function update_expense_details_manually($data,$id){
        return $this->db->where('expenses_list_id',$id)->update('expenses_list',$data);
    }


    public function search_expenses_list_btn_for_list($fromate,$todate){

          $this->db->select('*');
        $this->db->from('expenses_list');
       $this->db->join('expense_type','expense_type.expense_typeid=expenses_list.expense_type');

        if($fromate!=''){
        $this->db->where('expenses_list.expense_date>=',$fromate);

        }
        if($todate!=''){
         $this->db->where('expenses_list.expense_date<=',$todate);
         }


        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function save_frm_expense_list_section($data){
        return $this->db->insert('expenses_list',$data);
    }

    public function savetemporarydateforsale($data,$outletid){

        $this->db->select('outlet_id');
        $this->db->from('temporary_data_of_sale');
        $this->db->where('outlet_id',$outletid);
        $result =$this->db->get();
        if($result->num_rows() > 0){
            return $this->db->where('outlet_id',$outletid)->update('temporary_data_of_sale',$data);
        }
        else {
            return $this->db->insert('temporary_data_of_sale',$data);

         }

    }

    public function getallsaveddetailsalong($ouetletid){
        $this->db->select('*');
        $this->db->from('temporary_data_of_sale');
         $this->db->where('outlet_id',$ouetletid);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function savetempodeletealldataforreturnedatablerarydateforsale($id){
        return $this->db->where('outlet_id',$id)->delete('returned_print_data');
    }


    public function resultupdateqtysectionforoutlet($currentquanbtitysection,$outletid,$itemid){
        $checkarray = array('outlet_id' => $outletid,'product_id' => $itemid);
        return $this->db->where($checkarray)->update('products_for_outlet',array('product_quantity' => $currentquanbtitysection));
    }


    public function getordersummeryid(){
        $maxid = 0;
        $row = $this->db->query('select max(order_summery_id) as maxinvoice from order_summery')->row();
        if($row){
            $maxid = (int)$row->maxinvoice;
            $maxid++;
            return $maxid;

        }
    }


    public function print_return_invoice_section_for_bought_product($productid, $summeryid){
        $this->db->select('choosen_quantity');
        $this->db->from('order_details');
        $this->db->where('product_id',$productid);
        $this->db->where('summery_id',$summeryid);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function makereducesectionfororderedetails($id,$summeryidsection,$reduceanswer){
        $checkarray = array('summery_id' => $summeryidsection,'product_id' => $id);

        $status = 0;

        if($reduceanswer==0){
            $status = 0;
        }
        else {
            $status = 1;
        }

        return $this->db->where($checkarray)->update('order_details',array('choosen_quantity' => $reduceanswer,'status' => $status));
    }


    public function showoffpurcahsedetailssectuion(){
        $this->db->select('order_summery.total_amount,order_summery.ordered_date,order_summery.discount,order_summery.discounted_amount,order_summery.payment_method,order_summery.invoice_no,customer.customer_name,customer.customer_mobile,order_summery.order_summery_id,outlets.outlets_name');
             $this->db->from('order_summery');
         $this->db->join('customer','customer.customer_id=order_summery.customer_id','left');
         $this->db->join('outlets','outlets.outlets_id=order_summery.outlet_id','left');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }






    public function show_all_sumemry_details_for_return($order_summery_id){
        $this->db->select('order_summery.ordered_date,order_summery.discount,order_summery.discounted_amount,order_summery.payment_method,order_summery.invoice_no,customer.customer_name,customer.customer_mobile,order_summery.order_summery_id,outlets.outlets_name,order_summery.total_amount');
             $this->db->from('order_summery');
         $this->db->join('customer','customer.customer_id=order_summery.customer_id','left');
         $this->db->join('outlets','outlets.outlets_id=order_summery.outlet_id','left');
        $this->db->where('order_summery.order_summery_id',$order_summery_id);
        $result = $this->db->get();
        
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }







    public function getAllkindofreturneddetails(){
        $this->db->select('*');
        $this->db->from('return_product_details_all');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }







   public function showoffpurcahsedetailssectuionwithdate($fromdate,$todate,$outletid){
        $this->db->select('order_summery.total_amount,order_summery.ordered_date,order_summery.discount,order_summery.discounted_amount,order_summery.payment_method,order_summery.invoice_no,customer.customer_name,customer.customer_mobile,order_summery.order_summery_id,outlets.outlets_name');
             $this->db->from('order_summery');
         $this->db->join('customer','customer.customer_id=order_summery.customer_id','left');
         $this->db->join('outlets','outlets.outlets_id=order_summery.outlet_id','left');
        $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)>=',$fromdate);
       $this->db->where('SUBSTRING(order_summery.ordered_date,1,10)<=',$todate);
       if($outletid!=''){
           $this->db->where('order_summery.outlet_id',$outletid);
       }

        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }




    public function getoutletsforpurcahsedetails(){
        $this->db->select('outlets_id,outlets_name');
        $this->db->from('outlets');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }





    public function checkstaffmobilenumber($staffmob){
        $this->db->select('staff_mobile');
        $this->db->from('staff');
        $this->db->where('staff_mobile',$staffmob);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return 1;
        }
        else {
            return 0;
        }
    }




    public function getpurchasedproductsfordetails($ordersummeryid){
        $this->db->select('order_details.choosen_quantity,products_section.product_name,products_section.product_price');
        $this->db->from('order_details');
        $this->db->join('products_section','products_section.products_id=order_details.product_id','left');
        $this->db->where('order_details.summery_id',$ordersummeryid);
        $result = $this->db->get();

        if($result->num_rows() > 0) {
            return $result->result();
        }
        else {
            return 0;
        }
    }




    public function sendgroupsmsbyid($id){
        $this->db->select('customer.customer_mobile');
        $this->db->from('group_sms_contact');
        $this->db->join('customer','customer.customer_id=group_sms_contact.customer_id');
        $this->db->where('group_sms_contact.group_id_fk',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }



    public function savechequesbyadmin($data){
        return $this->db->insert('chequesbyadmin',$data);
    }


    public function showoffallchequedetailsbyadmin(){
        $this->db->select('*');
        $this->db->from('chequesbyadmin');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function select_pending_by_admin($paying_method_cheque_id,$attribute){
        return $this->db->where('chequesbyadmin_id',$paying_method_cheque_id)->update('chequesbyadmin',array('cheque_status' => $attribute));
    }



     public function select_pass_by_admin($paying_method_cheque_id,$attribute){
        return $this->db->where('chequesbyadmin_id',$paying_method_cheque_id)->update('chequesbyadmin',array('cheque_status' => $attribute));
    }



     public function select_returned_by_admin($paying_method_cheque_id,$attribute){
        return $this->db->where('chequesbyadmin_id',$paying_method_cheque_id)->update('chequesbyadmin',array('cheque_status' => $attribute));
    }




     public function select_postponed_by_admin($paying_method_cheque_id,$attribute){
        return $this->db->where('chequesbyadmin_id',$paying_method_cheque_id)->update('chequesbyadmin',array('cheque_status' => $attribute));
    }



    public function removechequedetailsbyadmin($paying_method_cheque_id){
        return $this->db->where('chequesbyadmin_id',$paying_method_cheque_id)->delete('chequesbyadmin');
    }


    public function showoffallchequedetailsbyadminsearch($from_date_check_cheque,$to_date_check_cheque,$check_details_status){
        $this->db->select('*');
        $this->db->from('chequesbyadmin');
        $this->db->where('cheque_date>=',$from_date_check_cheque);
        $this->db->where('cheque_date<=',$to_date_check_cheque);
        $this->db->where('cheque_status',$check_details_status);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function getsupplierdetails(){
        $this->db->select('supplier_id,supplier_name,mobile_number');
        $this->db->from('supplier');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function supplior_details_section_md(){


        $this->db->select('*');
        $this->db->from('products_section');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }


    }


    public function getrequestedproduct(){
        $this->db->select('*');
        $this->db->from('warehouse_request_product');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }


    public function completedrequested_product(){
        $status = 'Completed';


        $this->db->select('products_section.product_name,products_section.products_code,brands.brands_name,outlets.outlets_name,warehouse_request_product.request_quantity,warehouse_request_product.status,warehouse_request_product.dateandtime');
        $this->db->from('warehouse_request_product');
        $this->db->join('products_section','products_section.products_id=warehouse_request_product.product_id','left');
        $this->db->join('outlets','outlets.outlets_id=warehouse_request_product.outlet_id','left');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left');
        $this->db->where('status',$status);
       $this->db->order_by('warehouse_request_product.warehouse_req_pr_id','desc');
         $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }

    public function change_status_from_wr($id){
        $status = 'Completed';
        return $this->db->where('warehouse_req_pr_id',$id)->update('warehouse_request_product',array('status' => $status));
    }

  public function requestedproduct(){
        $status = 'Pending';


        $this->db->select('products_section.product_name,warehouse_request_product.warehouse_req_pr_id,products_section.products_code,brands.brands_name,outlets.outlets_name,warehouse_request_product.request_quantity,warehouse_request_product.status,warehouse_request_product.dateandtime');
        $this->db->from('warehouse_request_product');
        $this->db->join('products_section','products_section.products_id=warehouse_request_product.product_id','left');
        $this->db->join('outlets','outlets.outlets_id=warehouse_request_product.outlet_id','left');
        $this->db->join('brands','brands.brands_id=products_section.brand_id','left');
        $this->db->where('status',$status);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }

    }


    public function getcustomerdetailsforsalesreport($id){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_id',$id);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

    public function showproductdetailsforreport($outletid, $invoiceid, $summeryid){


    }



    public function getadminresult(){
        $this->db->select('admin_mob');
        $this->db->from('admin');
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

  

    public function showoffdeTecutedPanel_expenselist($date,$outletid){
        
        $this->db->select('expenses_list.expenses_list_id,expenses_list.expense_note,expenses_list.expense_date,expenses_list.expense_amount,expense_type.expense_name');
        $this->db->from('expenses_list'); 
        //$this->db->where('expenses_list.expense_date',$date);
        $this->db->where('expenses_list.outlet_id_fk',$outletid); 
        $this->db->join('expense_type','expense_type.expense_typeid=expenses_list.expense_type','left');
       
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        } 
        else {
            return 0;
        }
    }

    public function getexpenesesdetails($outeledid, $time){
        $this->db->select('expense_amount');
        $this->db->from('expenses_list');
        $this->db->where('outlet_id_fk',$outeledid);
        $this->db->where('expense_date',$time);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result->result();
        }
        else {
            return 0;
        }
    }

 
    
    public function search_expense_bydate($fromdate, $expiredate){
        $this->db->select('expenses_list.expenses_list_id,expenses_list.expense_note,expenses_list.expense_date,expenses_list.expense_amount,expense_type.expense_name');
        $this->db->from('expenses_list'); 
        $this->db->join('expense_type','expense_type.expense_typeid=expenses_list.expense_type','left');
        $this->db->where('expenses_list.expense_date >=',$fromdate);
        $this->db->where('expenses_list.expense_date <=',$expiredate);

        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        } 
        else {
            return 0;
        }
    }


    public function getSalessummerydetails($date){
        $this->db->select('*'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function getsalessummerydataforprint($date){
        $this->db->select('*'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function getsupplierdetailssecion(){
        $this->db->select('*');
        $this->db->from('supplier'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        } 
        else {
            return 0;
        }
    }


    public function deletegroupbtnforsms($id){
      $this->db->where('groups_id',$id)->delete('groups_for_sms'); 
      $this->db->where('group_id_fk',$id)->delete('group_sms_contact');

    }

    public function getagentdetails($agent,$platform,$time,$ipaddress){
        return $this->db->insert('agent_counter',array('ipaddress' => $ipaddress,'agent_type' => $agent, 'agent_platform' => $platform,'agent_login_time' => $time,'section' => 'cashier')); 
    }

    public function getagentdetailsforadmin($agent,$platform,$time,$ipaddress){
        return $this->db->insert('agent_counter',array('ipaddress' => $ipaddress,'agent_type' => $agent, 'agent_platform' => $platform,'agent_login_time' => $time,'section' => 'admin')); 
    }

    public function delete_expense_list_from_cashier($myvalue){
        $this->db->where('expenses_list_id',$myvalue)->delete('expenses_list'); 
    }

    public function deltecontact_details_accurate($customerid,$groupid){
       $this->db->where(array('group_id_fk' => $groupid,'customer_id' => $customerid))->delete('group_sms_contact'); 
    }

    public function getshowOffDetails(){
        $this->db->select('admin_name,admin_mob,admin_gmail'); 
        $this->db->from('admin'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0; 
        }
    }

    public function checkinitialpaymentstatus($value){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date', $value); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return 1; 
        }
        else {
            return 0;
        }

    }

    public function updateinitialpaymentsection($date, $initialpayment,$outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date', $date); 
        $this->db->where('outlet_id',$outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
             $this->db->where(array('date ' => $date, 'outlet_id' => $outletid))->update('register_details_section',array('cash_in_hand' => $initialpayment)); 
            // $this->db->update('detailsofproduct', array('date' => $date));
        }
        else {
            //$this->db->update('date',$date);
            return $this->db->insert('register_details_section',array('cash_in_hand' => $initialpayment,'date' => $date, 'outlet_id' => $outletid)); 
            
            
        }
    }

    public function registerDetailsection($date){
        $this->db->select('*'); 
        $this->db->where('date',$date); 
        $this->db->from('register_details_section'); 
        $result = $this->db->get(); 

        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function chequeSaveDetailsforregister($date, $value,$outletid){

        $value = floatval($value);
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('outlet_id',$outletid); 
        $this->db->where('date',$date);
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set cheque_payment=(cheque_payment + '.$value.') where date="'.$date.'"  and  outlet_id='.$outletid.'');
        }
        else {
            return $this->db->insert('register_details_section',array('cheque_payment' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }
    }

    

    
    public function refillwarehousection($fillablevalue,$id){
        return $this->db->query('update products_section set quantity=(quantity + '.$fillablevalue.') where products_id='.$id.''); 
    }

    public function subtract_products($fillablevalue,$id){
        return $this->db->query('update products_section set quantity=(quantity - '.$fillablevalue.') where products_id='.$id.''); 
    }


    
    public function saveCashpaymentforregisterdetails($date, $value,$outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $this->db->where('outlet_id',$outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set cash_payment=(cash_payment + '.$value.') where date="'.$date.'" and outlet_id='.$outletid.' ');
        }
        else {
            return $this->db->insert('register_details_section',array('cash_payment' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }
    }

    public function savedetailsforcreditinregister($date, $value, $outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $this->db->where('outlet_id', $outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set credit_payment=(credit_payment + '.$value.') where date="'.$date.'" and outlet_id='.$outletid.'');
        }
        else {
            return $this->db->insert('register_details_section',array('credit_payment' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }

    }

    public function saveexpensedetailsforregister($value, $date, $outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $this->db->where('outlet_id', $outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set expenses_amount_reg=(expenses_amount_reg + '.$value.') where date="'.$date.'" and outlet_id='.$outletid.'');
        }
        else {
            return $this->db->insert('register_details_section',array('expenses_amount_reg' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }


        
    }

    public function subtractexpenseamount($value,$date, $outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $this->db->where('outlet_id', $outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set expenses_amount_reg=(expenses_amount_reg - '.$value.') where date="'.$date.'" and outlet_id='.$outletid.'');
        }
        else {
            return $this->db->insert('register_details_section',array('expenses_amount_reg' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }
        
    }



    //copyback
    public function showoffsalesunitsection($date,$outletid){
        $this->db->select('order_summery.discount_from_total_amount,sales_credit_details.sales_credit_amount,customer.customer_name,customer.customer_mobile,customer.customer_address,order_summery.invoice_no,order_summery.customer_id,order_summery.payment_method,order_summery.order_summery_id,order_summery.total_amount,order_summery.discounted_amount,order_summery.ordered_date,order_summery.additional_text');
        $this->db->from('order_summery'); 
        $this->db->join('customer','customer.customer_id=order_summery.customer_id','left'); 
        $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=order_summery.order_summery_id','left');
        $this->db->where('SUBSTRING(ordered_date,1,10)',$date);
     //   $this->db->where('sales_credit_amount.outlet_id',$outletid); 
        $this->db->order_by('order_summery_id','desc');
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
        
    }

    public function showoffsalesunitsectionbysearch($fromdate, $todate, $statuschecker,$outletid){
       
         $this->db->select('order_summery.discount_from_total_amount,sales_credit_details.sales_credit_amount,customer.customer_name,customer.customer_mobile,customer.customer_address,order_summery.invoice_no,order_summery.customer_id,order_summery.payment_method,order_summery.order_summery_id,order_summery.total_amount,order_summery.discounted_amount,order_summery.ordered_date,order_summery.additional_text');
        $this->db->from('order_summery'); 
        $this->db->join('customer','customer.customer_id=order_summery.customer_id','left'); 
        $this->db->join('sales_credit_details','sales_credit_details.summery_id_fk=order_summery.order_summery_id','left');
        if($fromdate!=null){
            $this->db->where('SUBSTRING(ordered_date,1,10)>=',$fromdate);

        }
        if($todate!=null){
            $this->db->where('SUBSTRING(ordered_date,1,10)<=',$todate);
         }
        if($statuschecker!=null){
            $this->db->where('order_summery.payment_method',$statuschecker); 
         }
        $this->db->where('order_summery.outlet_id',$outletid); 

        $this->db->order_by('order_summery_id','desc');
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
        

    }

    public function view_cus_details_fr_section($val){
        $this->db->select('customer_name,customer_mobile'); 
        $this->db->from('customer'); 
        $this->db->where('customer_id',$val); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }


    public function view_summery_id_fr($orders,$outletid){
        $this->db->select('sales_credit_details.sales_credit_amount,order_summery.ordered_date,sales_credit_details.summery_id_fk'); 
        $this->db->from('sales_credit_details'); 
        $this->db->join('order_summery','order_summery.order_summery_id=sales_credit_details.summery_id_fk');
        $this->db->where('sales_credit_details.summery_id_fk',$orders); 
        $this->db->where('sales_credit_details.outlet_id',$outletid);
        
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
     
    }

    

    public function savecreditdetailsbyregisterfromcash($value,$date, $outletid){
        $this->db->select('register_details_id'); 
        $this->db->from('register_details_section'); 
        $this->db->where('date',$date);
        $this->db->where('outlet_id',$outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
           return  $this->db->query('update register_details_section set credit_payment=(credit_payment + '.$value.') where outlet_id='.$outletid.'   ');
        }
        else {
            return $this->db->insert('register_details_section',array('credit_payment' => $value,'date' => $date, 'outlet_id' => $outletid)); 
        }
        
    }

    public function detectcreditdetailsbycash($recamount, $ordereddate, $summeryid,$balanceamount){
        
       
      
            $recamount = floatval($recamount);
            $this->db->select('sales_credti_id'); 
            $this->db->from('sales_credit_details'); 
            $this->db->where('summery_id_fk',$summeryid);
            $result = $this->db->get(); 
            if($result->num_rows() > 0){
                
                if($balanceamount==0){
                    $this->db->where('summery_id_fk',$summeryid)->delete('sales_credit_details');
                     $this->db->query('update order_summery set payment_method="Cash" where order_summery_id='.$summeryid.'');
                    return $this->db->query('update register_details_section set credit_payment=(credit_payment - '.$recamount.') where date="'.$ordereddate.'" ');
 
                }
                else {
                    $this->db->query('update register_details_section set credit_payment=(credit_payment - '.$recamount.') where date="'.$ordereddate.'"');

                    return $this->db->query('update sales_credit_details set sales_credit_amount=(sales_credit_amount - '.$recamount.') where summery_id_fk='.$summeryid.''); 
                }
            }
            else {
                return 'notdetected';

            }
     }

    public function savecreditdetailssection($data){
        $this->db->insert('sales_credit_details',$data);
    }

    public function update_privillagesforcashier($data){
        return $this->db->update('general_setting',$data);
    }

    public function update_products_expiredatesystembtn($days){
        $this->db->update('general_setting',array('warehouse_expiredatebefore' => $days)); 
    }

    public function getgeneralsettingsforcashier(){
        $this->db->select('*'); 
        $this->db->from('general_setting');
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function getAllsettings(){
        $this->db->select('*'); 
        $this->db->from('general_setting'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function product_details_outlet_expired_showoff($outletid){
        $this->db->select('products_for_outlet.product_id,products_for_outlet.product_quantity,products_section.products_code,products_section.mfd,products_section.exp,products_section.product_name,products_section.product_unit,products_section.batch_no');
        $this->db->from('products_for_outlet'); 
        $this->db->join('products_section','products_section.products_id=products_for_outlet.product_id');
        $this->db->where('products_for_outlet.outlet_id',$outletid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function retriewdataforexpiredata($outletid){
       $this->db->select('expired_productlist.product_id_fk,expired_productlist.mute_option,products_section.products_code,products_section.mfd,products_section.exp,products_section.product_price,products_section.product_name,products_section.product_unit');
       $this->db->from('expired_productlist');
       $this->db->join('products_section','products_section.products_id=expired_productlist.product_id_fk'); 
       $this->db->where('expired_productlist.outlet_id',$outletid);
       $result = $this->db->get(); 
       if($result->num_rows() > 0) {
           return $result->result(); 
       }
       else {
           return 0; 
       }
       
    }

    public function muteexpproduct($productid, $outletid){
        return $this->db->where(array('product_id_fk' => $productid, 'outlet_id' => $outletid))->update('expired_productlist',array('mute_option' => 0));
    }
    //unmuteexpproduct

    public function unmuteexpproduct($productid, $outletid){
        return $this->db->where(array('product_id_fk' => $productid, 'outlet_id' => $outletid))->update('expired_productlist',array('mute_option' => 1));
    }

    public function showoffsmshistorysection(){
        $this->db->select('*'); 
        $this->db->from('smshistory'); 
        $this->db->order_by('smshistory_id','desc'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function saveexpireddetailsforfrontend($outletid, $productid){
        $this->db->select('expired_productlist_id'); 
        $this->db->from('expired_productlist'); 
        $this->db->where('outlet_id',$outletid); 
        $this->db->where('product_id_fk',$productid); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            
        }
        else {
            $this->db->insert('expired_productlist',array('product_id_fk' => $productid, 'outlet_id' => $outletid,'mute_option' => 1)); 
        }
    }



    public function showsmshistory_mobileperson_details($mobile){
        $this->db->select('*'); 
        $this->db->from('customer'); 
        $this->db->where('customer_mobile', $mobile);
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function savechequedetailsprivillagesform($value,$enablechequedetailscashier,$showadminvalue){
     
        return $this->db->update('general_setting',array('cheque_days_ago' => $value, 'chequeshowcashier' => $enablechequedetailscashier,'admin_check_show' => $showadminvalue)); 
    }

    public function add_cash_to_bank_account_temp($bankid, $amount, $fulldate){
        return $this->db->where('bank_details_id',$bankid)->update('bank_details',array('initial_amount' => $amount)); 
    }

    public function subtractionsline_cash_to_bank_account_temp($bankid, $amount){
        return $this->db->where('bank_details_id',$bankid)->update('bank_details',array('initial_amount' => $amount)); 
       
    }

    public function saveintoledgerforsubtraction($bank_details_id, $answertosummery, $fulldate,$bank_details_note){

        $accountno = 0; 
        $bankname = ''; 
        $branchname = ''; 
        $primaryaccount = 0; 
        
        $this->db->select('*'); 
        $this->db->from('bank_details'); 
        $this->db->where('bank_details_id',$bank_details_id); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            foreach($result->result() as $row){
                $accountno = $row->bank_account_no;
                $bankname = $row->bank_name;
                $branchname = $row->branch_name;
                $primaryaccount = $row->primary_bank;
            }

            return $this->db->insert('accountnoledger',array('accountnoledgernumber' => $accountno, 'date' => $fulldate, 'banknameledger' => $bankname, 'branchnameledger' => $branchname,'amountledger' => $answertosummery,'typeledger' => 'Subtracted','note' => $bank_details_note,'primary_account' => $primaryaccount));

        }
        else {
            return 0; 
        }

    }

    public function saveintoledger($bank_details_id, $answertosummery, $fulldate,$bank_details_note){
        
        $accountno = 0; 
        $bankname = ''; 
        $branchname = ''; 
        $primaryaccount = 0; 
        
        $this->db->select('*'); 
        $this->db->from('bank_details'); 
        $this->db->where('bank_details_id',$bank_details_id); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            foreach($result->result() as $row){
                $accountno = $row->bank_account_no;
                $bankname = $row->bank_name;
                $branchname = $row->branch_name;
                $primaryaccount = $row->primary_bank;
            }

            return $this->db->insert('accountnoledger',array('accountnoledgernumber' => $accountno, 'date' => $fulldate, 'banknameledger' => $bankname, 'branchnameledger' => $branchname,'amountledger' => $answertosummery,'typeledger' => 'Added','note' => $bank_details_note,'primary_account' => $primaryaccount));

        }
        else {
            return 0; 
        }
    }

    public function getbankaccountdetailsbyid($id){
        $this->db->select('*'); 
        $this->db->from('bank_details'); 
        $this->db->where('bank_details_id',$id); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0 ){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function account_no_section_ledger($fromdate, $todate){
        $this->db->select('*'); 
        $this->db->from('accountnoledger'); 
        if($fromdate!=null){
            $this->db->where('date>=',$fromdate); 
        }

        if($todate!=null){
            $this->db->where('date<=',$todate); 
        }
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }


    public function saveexpireddetailsforsupplier($status, $bank_name, $branch_name, $account_no, $cheque_date, $supplier_id, $note, $amount){
        return $this->db->insert('expired_cheques', array('bank_name' => $bank_name,'branch_name' => $branch_name, 'account_no' => $account_no, 'check_date' => $cheque_date, 'cheque_status' => $status,'supplier_id' => $supplier_id,'note' => $note, 'amount' => $amount,'bywhom' => 'supplier'));

    }

    public function getdetailsofexpiredchecksforsupplier(){
        $this->db->select('supplier_cheques_id,cheque_date,cheque_status'); 
        $this->db->from('supplier_cheques');
        $result = $this->db->get(); 
        if($result->num_rows() > 0 ){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function getexpirechecksbyadmin(){
        $this->db->select('chequesbyadmin_id,cheque_date,cheque_status'); 
        $this->db->from('chequesbyadmin'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function admin_status_action_pending_activator($id,$checkid){
        $this->db->where('chequesbyadmin_id',$checkid)->update('chequesbyadmin',array('cheque_status' => 'Pending'));
      return $this->db->where('expired_checks_id',$id)->update('expired_checks',array('status' => 'Pending')); 
    }
    public function admin_status_action_bounce_activator($id,$checkid){
        $this->db->where('chequesbyadmin_id',$checkid)->update('chequesbyadmin',array('cheque_status' => 'bounce'));

        return $this->db->where('expired_checks_id',$id)->update('expired_checks',array('status' => 'bounce')); 
    }

    public function admin_statis_action_completed_activator($id,$checkid){
        $this->db->where('chequesbyadmin_id',$checkid)->update('chequesbyadmin',array('cheque_status' => 'completed'));
        return $this->db->where('expired_checks_id',$id)->update('expired_checks',array('status' => 'completed')); 

    }


    public function chequesbyadmindetails($fromdate, $todate, $checkstatus){
        $type ='admin'; 
        $this->db->select('expired_checks.chques_id_fk,chequesbyadmin.bank_name, chequesbyadmin.branch_name,chequesbyadmin.cheque_no,chequesbyadmin.cheque_date,chequesbyadmin.cheque_status,chequesbyadmin.customer_name,chequesbyadmin.cheque_amount,expired_checks.expired_date,expired_checks.expired_checks_id'); 
        $this->db->from('chequesbyadmin');
        $this->db->join('expired_checks','expired_checks.chques_id_fk=chequesbyadmin.chequesbyadmin_id'); 
        if($fromdate!=null){
            $this->db->where('chequesbyadmin.cheque_date>=',$fromdate); 
        } 
        if($todate!=null){
            $this->db->where('chequesbyadmin.cheque_date<=',$todate); 
        }
        if($checkstatus!=null){
            $this->db->where('chequesbyadmin.cheque_status',$checkstatus); 
        }
        $this->db->where('expired_checks.type',$type); 

        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0;
        }
    }


    public function savealldetailsforadminsection($expireddate, $adminchequeid, $chequedate, $chequestatus){
        $type = 'admin'; 
        $this->db->select('expired_checks_id'); 
        $this->db->from('expired_checks'); 
        $this->db->where('type',$type);
        $this->db->where('chques_id_fk',$adminchequeid);
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            
        } 
        else {
            return $this->db->insert('expired_checks',array('chques_id_fk' => $adminchequeid,'type' => $type,'status' => $chequestatus,'expired_date' => $expireddate,'check_date' =>$chequedate)); 
        }
    }


    public function getexpiringcheckdetails(){
        $this->db->select('*'); 
        $this->db->from('supplier_cheques'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        }
        else {
            return 0;
        }
    }

    public function searchforsupplierinvoicetoobutton($supplierdetails, $invoiceno){
        $this->db->select('*'); 
        $this->db->from('products_section'); 
        if($supplierdetails!=''){
            $this->db->where('supplier_det',$supplierdetails); 
        }
        if($invoiceno!=''){
            $this->db->where('Invoice_manual',$invoiceno); 
        }
        $this->db->order_by('accountnoledger_id','desc'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0) {
            return $result->result(); 
        }
        else {
            return 0; 
        }

    }

    public function savesupplierchequessections($data){
        return $this->db->insert('supplier_cheques',$data);
    }

    public function getchequedetailsforsuppliers($fromdate, $todate){
        $this->db->select('*');
        $this->db->from('supplier_cheques');
        if($fromdate!=null){
            $this->db->where('supplier_cheques.cheque_date>=',$fromdate); 
        }
        if($todate!=null){
            $this->db->where('supplier_cheques.cheque_date<=',$todate);
        }
        $this->db->join('supplier','supplier.supplier_id=supplier_cheques.supplier_id_fk'); 
        $result = $this->db->get(); 
        if($result->num_rows() > 0){
            return $result->result(); 
        } 
        else {
            return 0;
        }

    }

    public function deletesupplierchecks($id){
        return $this->db->where('supplier_cheques_id',$id)->delete('supplier_cheques');
    }

    public function updatesuppliersections($data,$id){
        return $this->db->where('supplier_cheques_id',$id)->update('supplier_cheques',$data); 
    }

    public function savealldetailsforexpiredsection($expiredata, $checkid, $checkdate, $checkstatus){
        $type='supplier';  
        $this->db->select('expired_checks_id'); 
         $this->db->from('expired_checks'); 
         $this->db->where('chques_id_fk',$checkid); 
         $this->db->where('type',$type); 
         $result = $this->db->get(); 

         if($result->num_rows() > 0) {
              
         }
         else {
             return $this->db->insert('expired_checks',array('check_date' => $checkdate,'chques_id_fk' => $checkid, 'type' => $type,'status' => $checkstatus, 'expired_date' => $expiredata)); 

         }

    }

    public function getsuppliercheckdetails($fromdate, $todate, $status){
        $type = 'supplier'; 

        $this->db->select('expired_checks.chques_id_fk,expired_checks.type, expired_checks.status,expired_checks.expired_date,expired_checks.check_date,expired_checks.expired_checks_id,supplier_cheques.bank_name,supplier_cheques.branch_name,supplier_cheques.account_no,supplier_cheques.cheque_date, supplier_cheques.cheque_status,supplier_cheques.note,supplier_cheques.amount,supplier.supplier_name,supplier.mobile_number,supplier.org_name,supplier.supplier_addresses,supplier.supplier_accountno,supplier.bank_name'); 
        $this->db->from('expired_checks'); 
        $this->db->join('supplier_cheques','supplier_cheques.supplier_cheques_id=expired_checks.chques_id_fk','left');
        $this->db->join('supplier','supplier.supplier_id=supplier_cheques.supplier_id_fk','left');  
        $this->db->order_by('expired_checks.expired_checks_id','desc');
        $this->db->where('expired_checks.type',$type); 
        if($fromdate!=null){
            $this->db->where('expired_checks.check_date>=',$fromdate); 
        }
        if($todate!=null){
            $this->db->where('expired_checks.check_date<=',$todate); 
        }
        if($status!=null){
            $this->db->where('supplier_cheques.cheque_status',$status); 
        }

    $result = $this->db->get(); 
    if($result->num_rows() > 0) {
        return $result->result(); 
    }
    else {
        return 0;
    }

    }

    public function updatecheckstatusfromcashier($cashierid){
          $this->db->where('supplier_cheques_id',$cashierid)->update('supplier_cheques',array('cheque_status' => 'pending'));
        return $this->db->where('expired_checks.chques_id_fk',$cashierid)->update('expired_checks',array('status' => 'pending')); 
    }
 
    public function updatestatustobounce($cashierid){

        $this->db->where('supplier_cheques_id',$cashierid)->update('supplier_cheques',array('cheque_status' => 'bounce'));
        return $this->db->where('expired_checks.chques_id_fk',$cashierid)->update('expired_checks',array('status' => 'bounce')); 
    }

    public function updatestatustocomplete($cashierid){
        $this->db->where('supplier_cheques_id',$cashierid)->update('supplier_cheques',array('cheque_status' => 'completed'));
        return $this->db->where('expired_checks.chques_id_fk',$cashierid)->update('expired_checks',array('status' => 'completed')); 
    }


    
    public function savecashamount($data){
        $this->db->insert('order_summery',$data);
        return $this->db->insert_id();
    }

} //end of script

?>
