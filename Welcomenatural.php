<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
     
      /*Index */
	public function index()
	{
		$this->load->view('login');
	}
     /*Index*/


     function searchitemData(){
        $word = $_REQUEST["keyword"];
        $content = '';
        if($word!=""){
            $query = $this->users_model->get_run("SELECT * from table_product where name like '%$word%'");
            //echo $this->db->last_query();
            //echo '<pre>';print_r($query);

            $content .='<ul class="countrylist">';
            if($query){
                foreach($query as $row){
                    $name= $row['name'];
                    $price=$row['price'];
                    $shipcharge=$row['shipcharge'];


                    $content .= "<li  onClick=selectCountry('".$name."','".$price."','".$shipcharge."',this.id,'".$row['itemid']."')>".$row["name"]."</li>";
        
                 } 
                $content .='</ul>';
            } 
        }
             echo $content;

     }
	
   /* login */
     public function login()
    {
        $this->load->library('session');

		$email = $_POST['email'];
		$password = $_POST['password'];
		 //$data=$this->users_model->login($email, $password);
        $res=$this->users_model->get_run("Select * from inuser WHERE email= '$email' AND password='$password'");
        if(!empty($res))
		{
            foreach ($res as $value) {  }

                // echo "<pre>";
                // print_r($value);
                // exit();

            if($value['type'] == '1' || $value['type'] == '2'||$value['type'] == '3') {

$res = array(

                                    'id'  =>$value['id'],

                                    'type'  =>$value['type']             

                                );

            $this->session->set_userdata('inuser',$res);



               // $this->session->set_userdata('inuser', $res);

                $data['main'] = 'dashboard';
                $this->load->view('common/template',$data);

            }
            // elseif($value['type'] == '2') {

            //     $this->session->set_userdata('inuser', $res);
            //      $data['main'] = 'admin/main';
            //     $this->load->view('admin/template1',$data);

            // }
        
		}

        else
		{
          echo "<script>alert('Invalid email and password')</script>";
          $this->load->view('login');
		}
    }
/* login */

public function addmorepayment()
    {
       // $this->load->view('addpayment');
     $data['reseller']=$this->users_model->get_run("Select * from inuser where type='3'");
         $data['main'] = 'addmorepayment';
    $this->load->view('common/template', $data);
    }

    public function itemsearch()
    {
       // $this->load->view('addpayment');
     //$data['reseller']=$this->users_model->get_run("Select * from inuser where type='3'");
         $data['main'] = 'itemsearch';
    $this->load->view('common/template', $data);
    }


/*logout*/
 public function logout()
	{
		$this->load->library('session');
		$this->session->unset_userdata('inuser');
		 $this->load->view('login');
	}
/*logout*/

// /*Admin logout*/
//  public function admin_logout()
//     {
//         $this->load->library('session');
//         $this->session->unset_userdata1('inuser');
//          $this->load->view('login');
//     }
// /*Admin logout*/



/*Table_show */
public function table_show()
	{	
    	$data['res']=$this->users_model->info();
        //$this->load->view('table',$data);
        $data['main'] = 'table';
        $this->load->view('common/template', $data);
	}
/*Table_show */



/*Deleteuser */
function deleteuser($id)
{
	$this->load->library('session');
	  $res=$this->users_model->deletedata($id);
    if($res){
        echo "<script>alert('Recored deleted successfully')</script>";
    }
    else{
        echo "<script>alert('Recored deletion Failed')</script>";
    }
           
           //	echo "<script>alert('Recored deleted successfully')</script>";  
                		//$this->load->view('ind');  
    $data['res']=$this->users_model->info();
    $data['main'] = 'table';
    $this->load->view('common/template', $data);        
           
           
}
/*Deleteuser */




/*findforedituser*/
function findforedituser($id)
{
	
	$data['res1']=$this->users_model->finduserinfo($id);
	//$this->load->view('showupdate',$data1);
    $data['main'] = 'showupdate';
    $this->load->view('common/template', $data);	
}

/*findforedituser */


function editorder($id)
{
	$con = array('id'=>$id);
	 $data['reseller']=$this->users_model->get_run("Select * from inuser where type='3'");

	$data['res1']=$this->users_model->orderdata(' tbl_order',$con,1);
	
	//echo $this->db->last_query();
	//$this->load->view('showupdate',$data1);
    $data['main'] = 'editorder';
    $this->load->view('common/template', $data);	
}






  public function edit_order(){
        date_default_timezone_set("Asia/Kolkata");
        $current_date_time = date("Y-m-d H:i:s");
     //echo '<pre>';print_r($this->input->post());
    $item          = $this->input->post('item');
    $shipcharge         = $this->input->post('shipcharge');
    $price        = $this->input->post('price');
    $quantity          = $this->input->post('quantity');
    $total          = $this->input->post('total');
    $total_amount = $this->input->post('alltotal');
    $id          = $this->input->post('id');
    // exit;
        $tbl_order    = 'tbl_order';
        $to_name       = $this->input->post('to_name');
        $to_address    = $this->input->post('to_address');
        $to_pincode    = $this->input->post('to_pincode');
        $to_mobile_no  = $this->input->post('to_mobile_no');
        $reseller_name = $this->input->post('reseller_name');
        $tracking_id = $this->input->post('tracking_id');
        $date          = $this->input->post('date');
        $dispatch          = $this->input->post('dispatch');
        
        $save_order      = array(
            'to_name'        => $to_name,
            'to_address'     => $to_address,
            'to_pincode'     => $to_pincode,
            'to_mobile_no'   => $to_mobile_no,
            'reseller_name'  => $reseller_name,
            'tracking_id'  => $tracking_id,
            'date'           => $date,
            'create_at'      => $current_date_time,
            'total_amount' => $total_amount,
            'dispatch' => $dispatch
        );

            //$result=$this->users_model->save_data($save_order,$tbl_order);
            
            
$this->db->where("id",$id);
 $this->db->update('tbl_order',$save_order);
            
            $this->users_model->alldeletedata('tbl_order_item',array('orderid'=>$id));
       if($item){
        //   echo '<pre>';print_r($item);
        //   exit;
            foreach( $item as $k=> $ite){
                if(!empty($shipcharge[$k]) || !empty($price[$k]) || !empty($quantity[$k]) || !empty($total[$k])){
                    $orderData = array(
                        'orderid'=> $id,
                        'itemid'=>$ite,
                        'shippingcharge'=>$shipcharge[$k],
                        'price'=>$price[$k],
                        'quantity'=>$quantity[$k],
                        'total'=>$total[$k],
                    );
                    
                   $this->users_model->save_data($orderData,'tbl_order_item');
                }
                   
            }
       }
            
            if($result > 0){
                //$this->session->set_flashdata('msg','Order Add Successfully');
                redirect(base_url('index.php/welcome/orderlist'));  
                      
            }
            else{
               // $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
                redirect(base_url('index.php/welcome/orderlist'));

            }
    }

/*Updateuserdetails*/
function updateuserdetails()
{
	$this->load->library('session');
 $data = array(  
              
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'email'=>$this->input->post('email'),
                'password'=>$this->input->post('password'),
                'status'=>$this->input->post('status'),
                );  
$this->db->where("id",$data['id']);
 $this->db->update('inuser',$data);
    //echo "<script>alert('Recored updated successfully')</script>";  
    $data['res']=$this->users_model->info();
    $data['main'] = 'table';
    $this->load->view('common/template', $data);
           
    } 
/*Updateuserdetails */


function user_profile()
{

// $CI->load->library('session');  

// $session_data = $CI->session->userdata('inuser');

    $data['main'] = 'update_profile';
    $this->load->view('common/template', $data);
}

function update_user_profile()
{
          if(!empty($_FILES['profile_pic']['name'])){

        $config['upload_path'] = "assets/profile_pic/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_pic')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $uploaded_pic = $data['image_metadata']['file_name'];

                    $data = array('id'=>$this->input->post('id'),'profile_pic'=>$uploaded_pic);
                    $this->db->where("id",$data['id']);
                    $this->db->update('inuser',$data);
        }
    }
     


    if(empty($this->input->post('password'))){
    $data1 = array(  
              
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                );


    $this->db->where("id",$data['id']);
    $this->db->update('inuser',$data);
    $data['main'] = 'update_profile';
    $this->load->view('common/template', $data);

    }
    else
    {

    $data = array(  
              
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'password'=>$this->input->post('password'),
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                );

    $this->db->where("id",$data['id']);
    $this->db->update('inuser',$data);
    $data['main'] = 'update_profile';
    $this->load->view('common/template', $data);
    }

}



/* add*/
public function add()
	{
	    $data['main'] = 'adduser';
    $this->load->view('common/template', $data);
	    
	//	$this->load->view('adduser');
	}
      /* add */



/*Insert user */
 function insertuser()
   {
 $this->load->library('session');
 $data = array(  
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'email'=>$this->input->post('email'),
                'password'=>$this->input->post('password'),
                'status'=>$this->input->post('status'),
                 'type'=>'2',
                              );  
      
     $this->db->insert('inuser',$data);
    //echo  "<script>alert('Record inserted successfully')</script>";
      $data['res']=$this->users_model->info();
    //$this->load->view('table',$data);
        $data['main'] = 'table';
        $this->load->view('common/template', $data);
}

/*Insert user */



   /*select category*/
    public function selectcategory()
	{
		$this->load->view('category');
	}
     /*select category */


   /*Insert category*/
    public function insertcategory()
	{
   $this->load->library('session');
   $data = array(  
                'category'=> $this->input->post('category'),  
                'subcategory'=>$this->input->post('subcategory'), 
                'status'=>$this->input->post('status'), 
                );      
     $this->db->insert('choice_category',$data);
    // echo  "<script>alert('Record inserted successfully')</script>";
     return $this->load->view('ind');
	}
     /*Insert category */




     /*Table_product */
public function table_product()
    {   
    $data['res']=$this->users_model->info1();
    //$this->load->view('table1',$data);
    $data['main'] = 'table1';
    $this->load->view('common/template', $data);
    }
   /*Table_product*/





     /*Table_product */
public function table_product1()
    {   
    $data['res']=$this->users_model->info1();
   // $this->load->view('admin/table1',$data);
     $data['main'] = 'admin/table1';
    $this->load->view('admin/template1',$data);
    }
   /*Table_product*/






   




/*Deleteproduct */
function deleteproduct($itemid)
{
    $this->load->library('session');
      $res=$this->users_model->deletedata1($itemid);
    if($res){

             echo "<script>alert('Recored deleted successfully')</script>";                        
           
           }
       else{

             echo "<script>alert('Recored deletion Failed')</script>";  

            }
    $data['res']=$this->users_model->info1();
    $data['main'] = 'table1';
    $this->load->view('common/template', $data);  
}
/*Deleteproduct */




/*Deleteproduct */
function deleteproduct1($itemid)
{
    $this->load->library('session');
      $res=$this->users_model->deletedata1($itemid);

       if($res){

             echo "<script>alert('Recored deleted successfully')</script>";                        
           
           }
       else{

             echo "<script>alert('Recored deletion Failed')</script>";  

            }
   
            $data['res']=$this->users_model->info1();
   // $this->load->view('admin/table1',$data); 
     $data['main'] = 'admin/table1';
    $this->load->view('admin/template1',$data); 
}
/*Deleteproduct */




/* addproduct*/
public function addproduct()
    {
       // $this->load->view('addproduct');
         $data['main'] = 'addproduct';
    $this->load->view('common/template', $data);
    }
/* addproduct */


/* addproduct*/
public function addproduct1()
    {
        //$this->load->view('admin/addproduct');
         $data['main'] = 'admin/addproduct';
    $this->load->view('admin/template1',$data);
    }
/* addproduct */






/*Insert product */
 function insertproduct()
   {
 $this->load->library('session');
 $data = array(  
                'itemid' => $this->input->post('itemid'),  
                'name'=> $this->input->post('name'),  
                'price'=>$this->input->post('price'), 
                'status'=>$this->input->post('status'),
                'shipcharge'=>$this->input->post('shipcharge'),
                              );  
      
     $this->db->insert('table_product',$data);
    // echo  "<script>alert('Record inserted successfully')</script>";
    $data['res']=$this->users_model->info1();
   // $this->load->view('table1',$data);
     $data['main'] = 'table1';
    $this->load->view('common/template', $data);
}

/*Insert product */




/*Insert product */
 function insertproduct1()
   {
 $this->load->library('session');
 $data = array(  
                'itemid' => $this->input->post('itemid'),  
                'name'=> $this->input->post('name'),  
                'price'=>$this->input->post('price'), 
                'status'=>$this->input->post('status'),
                'shipcharge'=>$this->input->post('shipcharge'),
                              );  
      
     $this->db->insert('table_product',$data);
    // echo  "<script>alert('Record inserted successfully')</script>";
    $data['res']=$this->users_model->info1();
    //$this->load->view('admin/table1',$data);
     $data['main'] = 'admin/table1';
    $this->load->view('admin/template1',$data);
}

/*Insert product */



/*findforeditproduct*/
function findforeditproduct($itemid)
{
    
    $data['res1']=$this->users_model->findproductinfo($itemid);
    //$this->load->view('showupdate1',$data1); 
     $data['main'] = 'showupdate1';
    $this->load->view('common/template', $data);
}

/*findforeditproduct */



/*findforeditproduct*/
function findforeditproduct1($itemid)
{
    
    $data['res1']=$this->users_model->findproductinfo($itemid);
   // $this->load->view('admin/showupdate1',$data1); 
     $data['main'] = 'admin/showupdate1';
    $this->load->view('admin/template1',$data);
}

/*findforeditproduct */



/*Updateproductdetails*/
function updateproductdetails()
{
    $this->load->library('session');
 $data = array(  
              
                'itemid' => $this->input->post('itemid'),  
                'name'=> $this->input->post('name'),  
                'price'=>$this->input->post('price'),
                 'shipcharge'=>$this->input->post('shipcharge'),
                 'status'=>$this->input->post('status'),
                );  
$this->db->where("itemid",$data['itemid']);
 $this->db->update('table_product',$data);
  //  echo "<script>alert('Recored updated successfully')</script>";  
      $data['res']=$this->users_model->info1();
    //$this->load->view('table1',$data);
     $data['main'] = 'table1';
    $this->load->view('common/template', $data);
        
    } 
/*Updateproductdetails */




/*Updateproductdetails*/
function updateproductdetails1()
{
    $this->load->library('session');
 $data = array(  
              
                'itemid' => $this->input->post('itemid'),  
                'name'=> $this->input->post('name'),  
                'price'=>$this->input->post('price'),
                 'shipcharge'=>$this->input->post('shipcharge'),
                 'status'=>$this->input->post('status'),
                );  
$this->db->where("itemid",$data['itemid']);
 $this->db->update('table_product',$data);
  //  echo "<script>alert('Recored updated successfully')</script>";  
      $data['res']=$this->users_model->info1();
    //$this->load->view('admin/table1',$data);
     $data['main'] = 'admin/table1';
    $this->load->view('admin/template1',$data);
        
    } 
/*Updateproductdetails */



   /*Table_reseller */
public function table_reseller()
    {   
    $data['res']=$this->users_model->info2();
    //$this->load->view('reseller',$data);
    $data['main'] = 'reseller';
    $this->load->view('common/template', $data);
    }
   /*Table_reseller*/





   /*Table_reseller */
public function table_reseller1()
    {   
    $data['res']=$this->users_model->info2();
    //$this->load->view('admin/reseller',$data);
    $data['main'] = 'admin/reseller';
    $this->load->view('admin/template1',$data);
    }
   /*Table_reseller*/




   /*findforeditreseller*/
function findforeditreseller($id)
{
    
    $data['res1']=$this->users_model->findresellerinfo($id);
    //$this->load->view('updatereseller',$data1); 
    $data['main'] = 'updatereseller';
    $this->load->view('common/template', $data);    
}

/*findforeditreseller */



/*findforeditresellershow*/
function findforeditresellershow($id)
{
    
    $data['res1']=$this->users_model->findresellerinfo($id);
    //$this->load->view('updatereseller',$data1); 
    $data['main'] = 'resellershow';
    $this->load->view('common/template', $data);    
}

/*findforeditresellershow */












  /*findforeditreseller*/
function findforeditreseller1($id)
{
    
    $data['res1']=$this->users_model->findresellerinfo($id);
    //$this->load->view('admin/updatereseller',$data1); 
        $data['main'] = 'admin/updatereseller';
    $this->load->view('admin/template1',$data);
}

/*findforeditreseller */





/* addreseller*/
public function addreseller()
    {
       // $this->load->view('addreseller');
            $data['main'] = 'addreseller';
    $this->load->view('common/template', $data);
    }
/* addreseller */


/* addreseller*/
public function addreseller1()
    {
       // $this->load->view('admin/addreseller');
            $data['main'] = 'admin/addreseller';
    $this->load->view('admin/template1',$data);
    }
/* addreseller */



/*Insert product */
 function insertreseller()
   {
 $this->load->library('session');
 $data = array(  
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'email'=>$this->input->post('email'),
                'password'=> $this->input->post('password'),  
                'address'=>$this->input->post('address'),
                 'city'=> $this->input->post('city'), 
                 'pincode'=> $this->input->post('pincode'), 
                'state'=>$this->input->post('state'),

                'status'=>$this->input->post('status'),
                   'type'=>'3',
              
                              );  
      
     $this->db->insert('inuser',$data);
     //echo  "<script>alert('Record inserted successfully')</script>";
    $data['res']=$this->users_model->info2();
   // $this->load->view('reseller',$data);
        $data['main'] = 'reseller';
    $this->load->view('common/template', $data);
}

/*Insert product */





/*Insert product */
 function insertreseller1()
   {
 $this->load->library('session');
 $data = array(  
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'),  
                'email'=>$this->input->post('email'),
                'password'=> $this->input->post('password'),  
                'address'=>$this->input->post('address'),
                 'city'=> $this->input->post('city'),  
                'state'=>$this->input->post('state'),

                'status'=>$this->input->post('status'),
                   'type'=>'3',
              
                              );  
      
     $this->db->insert('inuser',$data);
     //echo  "<script>alert('Record inserted successfully')</script>";
    $data['res']=$this->users_model->info2();
   // $this->load->view('admin/reseller',$data);
        $data['main'] = 'admin/reseller';
    $this->load->view('admin/template1',$data);
}

/*Insert product */



/*Deletereseller */
function deletereseller($id)
{
    $this->load->library('session');
      $res=$this->users_model->deletedata2($id);
    if($res){

           echo "<script>alert('Recored deleted successfully')</script>";  
          
           }
     else 
            {
           echo "<script>alert('Recored deletion Failed')</script>";  
            }
             $data['res']=$this->users_model->info2();
                $data['main'] = 'reseller';
    $this->load->view('common/template', $data);
}
/*Deletereseller */






/*Deletereseller */
function deletereseller1($id)
{
    $this->load->library('session');
      $res=$this->users_model->deletedata2($id);
     if($res){

             echo "<script>alert('Recored deleted successfully')</script>";                        
           
           }
       else{

             echo "<script>alert('Recored deletion Failed')</script>";  

            }
            $data['res']=$this->users_model->info2();
   // $this->load->view('admin/reseller',$data); 
        $data['main'] = 'admin/reseller';
    $this->load->view('admin/template1',$data);
}
/*Deletereseller */




/*Updateuserdetails*/
function updateresellerdetails()
{
    $this->load->library('session');
 $data = array(  
              
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'), 
                 'email'=>$this->input->post('email'), 
                'password'=>$this->input->post('password'),
                'address'=> $this->input->post('address'),
                'city'=> $this->input->post('city'),  
                'pincode'=> $this->input->post('pincode'), 
                'state'=>$this->input->post('state'),    
                'status'=>$this->input->post('status'),
                );  
$this->db->where("id",$data['id']);
 $this->db->update('inuser',$data);
   // echo "<script>alert('Recored updated successfully')</script>";  
    $data['res']=$this->users_model->info2();
    //$this->load->view('reseller',$data);
        $data['main'] = 'reseller';
    $this->load->view('common/template', $data);
           
    } 
/*Updateuserdetails */




/*Updateuserdetails*/
function updateresellerdetails1()
{
    $this->load->library('session');
 $data = array(  
              
                'id' => $this->input->post('id'),  
                'name'=> $this->input->post('name'), 
                 'email'=>$this->input->post('email'), 
                'password'=>$this->input->post('password'),
                'address'=> $this->input->post('address'),
                'city'=> $this->input->post('city'),  
                'state'=>$this->input->post('state'),    
                'status'=>$this->input->post('status'),
                );  
$this->db->where("id",$data['id']);
 $this->db->update('inuser',$data);
   // echo "<script>alert('Recored updated successfully')</script>";  
    $data['res']=$this->users_model->info2();
    //$this->load->view('admin/reseller',$data);
        $data['main'] = 'admin/reseller';
    $this->load->view('admin/template1',$data);
           
    } 
/*Updateuserdetails */




 /*Table_payment */
public function payment_show()
    {   
    $data['res']=$this->users_model->paymentinfo();
    //$this->load->view('paymenttable',$data);
    $data['main'] = 'paymenttable';
    $this->load->view('common/template', $data);
    }
   /*Table_pyament*/





/* addpayment*/
public function addpayment()
    {
       // $this->load->view('addpayment');
        //$sess_id = $this->session->userdata('id');

     $data['reseller']=$this->users_model->get_run("Select * from inuser where type='3'");
     $data['main'] = 'addpayment';
     $this->load->view('common/template', $data);
    }
/* addpayment */



/*insert payment */
 function insertpayment()
   {
 $this->load->library('session');
 $data = array(  
                //'id' => $this->input->post('id'),  
                'resellername'=> $this->input->post('resellername'),  
                'amount'=>$this->input->post('amount'), 
                'date'=>$this->input->post('date'),
                
                
                              );  
      
     $this->db->insert('payment',$data);
    // echo  "<script>alert('Record inserted successfully')</script>";
    $data['res']=$this->users_model->paymentinfo();
    //$this->load->view('paymenttable',$data);
     $data['main'] = 'paymenttable';
    $this->load->view('common/template', $data);
}

/*insert product */



/*findforeditadmin*/
function findforeditpayment($id)
{
    

    $data['res1']=$this->users_model->findpaymentinfo($id);
   // $this->load->view('showupdatepayment',$data1); 
     $data['main'] = 'showupdatepayment';
    $this->load->view('common/template', $data);   
}

/*findforeditadmin*/





/*updateadmindetails*/
function updatepaymentdetails()
{
    $this->load->library('session');
 $data = array(  
              
                'id' => $this->input->post('id'),  
                'resellername'=> $this->input->post('resellername'),  
                'amount'=>$this->input->post('amount'),
                'date'=>$this->input->post('date'),
                
                ); 

$this->db->where("id",$data['id']);
$this->db->update('payment',$data);
 // echo "<script>alert('Recored updated successfully')</script>"; 
    $data['res']=$this->users_model->paymentinfo();
  //  $this->load->view('paymenttable',$data);  
     $data['main'] = 'paymenttable';
    $this->load->view('common/template', $data);        
    } 
/*updatepaymentdetails */





/*Deleteadmin */
function deletepayment($id)
{
    $this->load->library('session');
      $res=$this->users_model->deletepaymentdata($id);

     if($res){

             echo "<script>alert('Recored deleted successfully')</script>";                        
           
           }
       else{

             echo "<script>alert('Recored deletion Failed')</script>";  

            }
   
    $data['res']=$this->users_model->paymentinfo();
    //$this->load->view('paymenttable',$data); 
     $data['main'] = 'paymenttable';
    $this->load->view('common/template', $data);       
          
}
/*Deleteadmin*/



/*orderlist */
public function orderlist()
    {   
        $data['res']=$this->users_model->orderinfo();
        //$this->load->view('table',$data);
        $data['main'] = 'ordertable';
        $this->load->view('common/template', $data);
    }
/*orderlist */


/* dashboard*/
public function  dashboard()
    {
        $data['main'] = 'dashboard';
    $this->load->view('common/template',$data);
        
    //  $this->load->view('adduser');
    }
      /* dashboard */

      

       public function ForgotPassword()
   {

        //$this->load->helper(array('form'));
        //$this->load->helper('email');
        
        $table='inuser';
        $email=$this->input->post('email');
        $result=$this->users_model->Change_Forget_Password($email);

 
        if(!($result== -1)){
            $id=$result[0]['id'];
            $random_pass=rand();
            $new_pass=md5($random_pass);
            $random=array('password'=>$new_pass );
            $result=$this->users_model->update_for_all($random,$table,$id,'id');

            // $this->load->library('email');
            // $mail_config['smtp_host'] = 'smtp.gmail.com';
            // $mail_config['smtp_port'] = '587';
            // $mail_config['smtp_user'] = 'sunilrawal160@gmail.com';
            // $mail_config['_smtp_auth'] = TRUE;
            // $mail_config['smtp_pass'] = 'Sunil@456';
            // $mail_config['smtp_crypto'] = 'tls';
            // $mail_config['protocol'] = 'smtp';
            // $mail_config['mailtype'] = 'html';
            // $mail_config['send_multipart'] = FALSE;
            // $mail_config['charset'] = 'utf-8';
            // $mail_config['wordwrap'] = TRUE;

            // $this->email->initialize($mail_config);
            // $this->email->set_newline("\r\n");

            // $this->email->to($email);
            // $this->email->from('testing.developer999@gmail.com', 'OTP');
            // $this->email->subject('Forget Password');
            // $this->email->message('Your New password is:'.$random_pass);

            // //Send email
            //  $send = $this->email->send();
            //  echo '<pre>'; print_r($send);

            // echo $this->email->print_debugger();
            // exit;

             $this->email->from('testing.developer999@gmail.com', 'testing'); 
             $this->email->to($email);
             $this->email->subject('Forget Password'); 
             $this->email->message('Your New password is:'.$random_pass); 
             if($this->email->send()) {
                   // $this->users_model->my_success('Email Send Successfully');
                echo  "<script>alert('Password send successfully')</script>";
                $this->load->view('login');

            }
             else{ 
               // $this->users_model->my_failed();
                    echo  "<script>alert('Unable to send email')</script>";
                    $this->load->view('login');
            }
        }
        else{
            echo "not show";
           // $this->users_model->my_failed();
        }
       // $this->users_model->my_return();
             
      
         
   }





  //   public function ForgotPassword()
  //  {
  //          $table='inuser';
  //        $email = $this->input->post('email'); 
  //        $result = $this->users_model->ForgotPassword($email); 



  //           if(!($result== -1)){
  //           $id=$result[0]['id'];
  //           $random_pass=rand();
  //           $new_pass=md5($random_pass);
  //           $random=array('password'=>$new_pass );
  //           $result=$this->users_model->sendpassword($random,$table,$id,'id');

  //            $this->email->from('sunillnct786@gmail.com', 'sunil'); 
  //            $this->email->to($email);
  //            $this->email->subject('Forget Password'); 
  //            $this->email->message('Your New password is:'.$random_pass); 
  //            if($this->email->send())
  //            {
  //             echo "<script>alert('Email send successfully')</script>"; 
  //             $this->load->view('login'); 
  //            }

  //            else
  //            {
  //               echo "<script>alert('Unable to send email')</script>";
  //                 $this->load->view('login'); 
  //            }
  //     //  if($findemail)
  //     //      {
  //     //   $this->users_model->sendpassword($findemail);
  //     //     } 
  //     //      else
  //     //      {
  //     // echo "<script>alert('Email does not exists')</script>";
  //     // $this->load->view('login');
  //     //      }
         
  //  }

  // }
}






  

?>
