<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Law_api extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->library('upload');
		$this->load->library('session');
		$this->load->library('email');
    }
   
    public function customer_login()
	{		

		 $mobile_no = $this->input->post('mobile_no');
			

			// if (!empty($mobile_no)) {
   //       		$CheckData = $this->Api_model->get_run("SELECT * FROM law_customer WHERE mobile_no = '$mobile_no'");
   //       		if (empty($CheckData)) {
   //       				echo json_encode(array('msg'=>'Profile No exists','status'=>'0'));
   //       		}
   //       		else 
   //       		{
         			$result    = $this->Api_model->customer_login_law($mobile_no);
         			if($result > 0)
					{
						echo json_encode(array('customer_id'=> $result[0]->id,'msg'=>'Customer Login Successfully','status'=>'1'));
					}
					else
					{
						 echo json_encode(array('msg'=>'Invalid Mobile No','status'=>'0'));
						//echo json_encode(array('msg'=>$msg,'status'=>'0'),JSON_UNESCAPED_UNICODE);
					}
         //}
      // 	}
	}

	public function customer_register()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_customer ='law_customer';
  		$first_name     = $this->input->post('first_name');
  		$last_name     	= $this->input->post('last_name');
  		$email     		= $this->input->post('email');
  		$gender     	= $this->input->post('gender');
  		$age     		= $this->input->post('age');
  		$mobile_no     	= $this->input->post('mobile_no');
  		$phone_id     	= $this->input->post('phone_id');
  	
  		
         if (!empty($mobile_no)) {
         		$CheckData = $this->Api_model->get_run("SELECT * FROM law_customer WHERE mobile_no = '$mobile_no'");
         		if (!empty($CheckData)) {
         				echo json_encode(array('msg'=>'Profile already exists','status'=>'0'));
         		}
         		else
         		{
         			$save_user 			=  array(
						'first_name'  	=> $first_name,
						'last_name'  	=> $last_name,
						'email'  		=> $email,
						'gender'     	=> $gender,
						'age'     		=> $age,
						'mobile_no' 	=> $mobile_no,
						'phone_id' 		=> $phone_id,
						'role'  		=> 3,
						'createat'		=> $current_date_time
					);
					
					$InsertResult = $this->Api_model->save_data($save_user,$law_customer);

					if ($InsertResult > 0) {
						echo json_encode(array('customer_id' => $InsertResult,'msg'=>'Add Successfully','status'=>'1'));
					}
					else
					{
						echo json_encode(array('msg'=>'Failed','status'=>'0'));
					} 
					
					 
					}
         		}
    }

    public function update_customer()
	{	
		$law_customer ='law_customer';
		$customer_id    = $this->input->post('customer_id');
  		$first_name     = $this->input->post('first_name');
  		$last_name     	= $this->input->post('last_name');
  		$email     		= $this->input->post('email');
  		$gender     	= $this->input->post('gender');
  		$age     		= $this->input->post('age');
  		$image     		= $this->input->post('image');
  		$mobile_no     	= $this->input->post('mobile_no');

  		if (empty($image)) {
  			$update_user 			=  array(
			'first_name'  	=> $first_name,
			'last_name'  	=> $last_name,
			'email'  		=> $email,
			'gender'     	=> $gender,
			'age'     		=> $age,
			'mobile_no' 	=> $mobile_no
			);
  		}
  		else{
  			$path = base_url();

	  		$images 		= explode(",",$image);
			$img 			= $images[1];
			$image_parts 	= explode(";base64,",$img);
			$image_type_aux = explode("images/forum/", $image_parts[0]);
			$image_base64 	= base64_decode($image_parts[0]);
			$profile		= uniqid(). '.png';
			$file 			= 'images/forum/' .$profile;
			file_put_contents($file, $image_base64);
	  	
	  		$update_user 			=  array(
			'first_name'  	=> $first_name,
			'last_name'  	=> $last_name,
			'email'  		=> $email,
			'gender'     	=> $gender,
			'age'     		=> $age,
			'image'     	=> $path.$file,
			'mobile_no' 	=> $mobile_no
			);	
  		}

  		
		
		$UpdateResult = $this->Api_model->update_data($update_user,$law_customer,$customer_id);

		if ($UpdateResult > 0) {
			echo json_encode(array('msg'=>'Update Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}

    public function update_phoneid()
	{	
		$law_customer ='law_customer';
		$id    = $this->input->post('customer_id');
		$phone_id    = $this->input->post('phone_id');
  		
  		$update_phoneid 			=  array(
		'phone_id'  	=> $phone_id
		);
		
		$UpdateResult = $this->Api_model->update_data($update_phoneid,$law_customer,$id);

		if ($UpdateResult > 0) {
			echo json_encode(array('customer_id'=>$id,'msg'=>'Update Phone Id Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 

         		
    }



    public function get_customer_data()
	{	

		$customer_id = $this->input->post('customer_id');

		$customerData 	= $this->Api_model->get_run("SELECT * FROM law_customer WHERE id='$customer_id' ORDER BY id DESC");
		

		$path = base_url();
		$customer = array();
		foreach ($customerData as $key => $value) {
			
			$customer[]			= array(
				'first_name' 		=> $value['first_name'],
				'last_name' 		=> $value['last_name'],
				'email' 			=> $value['email'],
				'gender' 			=> $value['gender'],
				'age' 				=> $value['age'],
				'mobile_no' 		=> $value['mobile_no'],
				'role'  			=> $value['role'],
				'image'  			=> $value['image'],
				'phone_id'  		=> $value['phone_id'],
				
			);
		}

		if(!empty($customerData))
		{
			echo json_encode(array('customer_list'=> $customer,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}  

	public function get_all_customer_data()
	{	
		$customerData 	= $this->Api_model->get_run("SELECT * FROM law_customer WHERE role='3' ORDER BY id DESC");
		

		$path = base_url();
		$customer = array();
		foreach ($customerData as $key => $value) {
			
			$customer[]			= array(
				'customer_id' 		=> $value['id'],
				'first_name' 		=> $value['first_name'],
				'last_name' 		=> $value['last_name'],
				'email' 			=> $value['email'],
				'gender' 			=> $value['gender'],
				'age' 				=> $value['age'],
				'mobile_no' 		=> $value['mobile_no'],
				'role'  			=> $value['role'],
				'image'  			=> $value['image'],
				'phone_id'  		=> $value['phone_id'],
				
			);
		}

		if(!empty($customerData))
		{
			echo json_encode(array('customer_list'=> $customer,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}  

	public function add_appointment()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_appointment ='law_appointment';

  		$customer_id    = $this->input->post('customer_id');
  		$name     		= $this->input->post('name');
  		$age     		= $this->input->post('age');
  		$gender     	= $this->input->post('gender');
  		$image    	 	= $this->input->post('image');
  		$four     		= $this->input->post('four');
  		$past_history   = $this->input->post('past_history');
  		$case_type     	= $this->input->post('case_type');
  		$case_brief     = $this->input->post('case_brief');
  		$notes     		= $this->input->post('notes');

  		$images 		= explode(",",$image);
		$img 			= $images[1];
		$image_parts 	= explode(";base64,",$img);
		$image_type_aux = explode("images/forum/", $image_parts[0]);
		$image_base64 	= base64_decode($image_parts[0]);
		$profile		= uniqid(). '.png';
		$file 			= 'images/forum/' .$profile;
		file_put_contents($file, $image_base64);
  		
  		$path = base_url();

  		if ($four == 'Self') {
  			$Search = $this->Api_model->get_run("SELECT * FROM law_customer WHERE id='$customer_id' ORDER BY id DESC");
  			foreach ($Search as $key => $Svalue) {
  				$nname   = $Svalue['first_name'];
  				$aage = $Svalue['age'];
  				$ggender = $Svalue['gender'];
  				// code...
  			}
  			$save_appointment		=  array(
  				'customer_id'  	=> $customer_id,
				'name'  		=> $nname,
				'age'  			=> $aage,
				'gender'     	=> $ggender,
				'image' 		=> $path.$file,
				'four'  		=> $four,
				'past_history'  => $past_history,
				'case_type'  	=> $case_type,
				'case_brief'    => $case_brief,
				'notes' 		=> $notes,
				'status'  		=> 0,
				'create_at'  	=> $current_date_time,
				);
  		}
  		elseif ($four == 'Other') {
  			$save_appointment		=  array(
				'customer_id'  	=> $customer_id,
				'name'  		=> $name,
				'age'  			=> $age,
				'gender'     	=> $gender,
				'image' 		=> $path.$file,
				'four'  		=> $four,
				'past_history'  => $past_history,
				'case_type'  	=> $case_type,
				'case_brief'    => $case_brief,
				'notes' 		=> $notes,
				'status'  		=> 0,
				'create_at'  	=> $current_date_time,
				);
  		}

  		$InsertResult = $this->Api_model->save_data($save_appointment,$law_appointment);

		if ($InsertResult > 0) {

			$UserPhoneID = $this->Api_model->get_run("SELECT * FROM law_customer WHERE role='2'");
	        //echo $phone_id[] = $UserPhoneID[0]['phone_id'];

	        $count = count($UserPhoneID);
                    
            for ($i=0; $i < $count; $i++) { 
               
               if($UserPhoneID[$i]['phone_id'] != ''){
                    $phone_id[]=$UserPhoneID[$i]['phone_id']; 
               }
            }

	        $title='Add Appointment';
    		$body='Add Appointment Successfully';
    		$PushResult=$this->Api_model->law_push_notification($title,$body,$phone_id); 
    		$json_result = json_decode($PushResult);
			$success = $json_result->success;

			echo json_encode(array('appointment_id' => $InsertResult,'msg'=>'Add Appointment Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}   

	public function change_appointment_status()
	{	
		$law_appointment ='law_appointment';
		$id    = $this->input->post('appointment_id');
		$status    = $this->input->post('status');
  		
  		$update_status 			=  array(
		'status'  	=> $status
		);
		
		$UpdateResult = $this->Api_model->update_data($update_status,$law_appointment,$id);

		if ($UpdateResult > 0) {
			$Result = $this->Api_model->get_run("SELECT customer_id FROM law_appointment WHERE id='$id'");
			$customer_id = $Result[0]['customer_id'];

			$UserPhoneID=$this->Api_model->get_run("SELECT * FROM law_customer WHERE id='$customer_id' AND phone_id!=''");
	        $phone_id = $UserPhoneID[0]['phone_id'];
	        $title='Change Stutus';
    		$body='Change Stutus Successfully';
    		$PushResult=$this->Api_model->law_push_notification_single($title,$body,$phone_id); 
    		$json_result = json_decode($PushResult);
			$success = $json_result->success;
			

			echo json_encode(array('appointment_id'=>$id,'msg'=>'Update Status Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 

         		
    }

	public function get_appointment()
	{	
		$customer_id = $this->input->post('customer_id');

		$appointmentData 	= $this->Api_model->get_run("SELECT * FROM law_appointment WHERE customer_id='$customer_id' ORDER BY id DESC");
		
		$path = base_url();
		$appointment = array();
		foreach ($appointmentData as $key => $value) {
			$appointment_id = $value['id'];

			$Result = $this->Api_model->get_run("SELECT * FROM `law_payment` WHERE customer_id='$customer_id' AND appointment_id='$appointment_id'");
			foreach ($Result as $key => $value) {
				$payment_amount = $value['amount'];
				$payment_create_at = $value['create_at'];
				//$four = $value['four'];
			}

			
			$appointment[]			= array(
				'appointment_id'		=> $value['id'],
				'name' 					=> $value['name'],
				'age' 					=> $value['age'],
				'gender' 				=> $value['gender'],
				'image' 				=> $value['image'],
				'four' 					=> $value['four'],
				'past_history'  		=> $value['past_history'],
				'case_type' 			=> $value['case_type'],
				'case_brief' 			=> $value['case_brief'],
				'notes' 				=> $value['notes'],
				'status' 				=> $value['status'],
				'appointment_create_at' => $value['create_at'],
				'payment_amount'		=> $payment_amount,
				'payment_create_at' 	=> $payment_create_at
				
			);
		}

		if(!empty($appointmentData))
		{
			echo json_encode(array('appointment_list'=> $appointment,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}   

	public function get_appointment_all()
	{	
		$appointmentData 	= $this->Api_model->get_run("SELECT * FROM law_appointment ORDER BY id DESC");
		
		$path = base_url();
		$appointment = array();
		foreach ($appointmentData as $key => $value) {

			$appointment_id = $value['id'];

			$Result = $this->Api_model->get_run("SELECT * FROM `law_payment` WHERE appointment_id='$appointment_id'");
			foreach ($Result as $key => $value) {
				$payment_amount = $value['amount'];
				$payment_create_at = $value['create_at'];
			}
			
			$appointment[]			= array(
				'appointment_id'		=> $value['id'],
				'customer_id' 			=> $value['customer_id'],
				'name' 					=> $value['name'],
				'age' 					=> $value['age'],
				'gender' 				=> $value['gender'],
				'image' 				=> $value['image'],
				'four' 					=> $value['four'],
				'past_history'  		=> $value['past_history'],
				'case_type' 			=> $value['case_type'],
				'case_brief' 			=> $value['case_brief'],
				'notes' 				=> $value['notes'],
				'status' 				=> $value['status'],
				'appointment_create_at'	=> $value['create_at'],
				'payment_amount'		=> $payment_amount,
				'payment_create_at' 	=> $payment_create_at
				
			);
		}

		if(!empty($appointmentData))
		{
			echo json_encode(array('all_appointment_list'=> $appointment,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	} 

	public function get_appointment_detail()
	{	
		$appointment_id = $this->input->post('appointment_id');

		$appointmentData 	= $this->Api_model->get_run("SELECT * FROM law_appointment WHERE id='$appointment_id'");
		
		$path = base_url();
		$appointment = array();
		foreach ($appointmentData as $key => $value) {

			$Result = $this->Api_model->get_run("SELECT * FROM `law_payment` WHERE appointment_id='$appointment_id'");
			foreach ($Result as $key => $value) {
				$payment_amount = $value['amount'];
				$payment_create_at = $value['create_at'];
			}
			
			$appointment[]			= array(
				'customer_id' 			=> $value['customer_id'],
				'name' 					=> $value['name'],
				'age' 					=> $value['age'],
				'gender' 				=> $value['gender'],
				'image' 				=> $value['image'],
				'four' 					=> $value['four'],
				'past_history'  		=> $value['past_history'],
				'case_type' 			=> $value['case_type'],
				'case_brief' 			=> $value['case_brief'],
				'notes' 				=> $value['notes'],
				'status' 				=> $value['status'],
				'appointment_create_at' => $value['create_at'],
				'payment_amount'		=> $payment_amount,
				'payment_create_at' 	=> $payment_create_at
				
			);
		}

		if(!empty($appointmentData))
		{
			echo json_encode(array('appointment_list'=> $appointment,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}   

	public function add_notification()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_notification ='law_notification';

  		$customer_id    		= $this->input->post('customer_id');
  		$message     			= $this->input->post('message');
  		$purpose     			= $this->input->post('purpose');
  		
  		$path = base_url();

  		$save_notification		=  array(
		'customer_id'  		=> $customer_id,
		'message'  			=> $message,
		'purpose'  			=> $purpose,
		'create_at'  		=> $current_date_time
		);
		
		$InsertResult = $this->Api_model->save_data($save_notification,$law_notification);

		if ($InsertResult > 0) {

			$UserPhoneID=$this->Api_model->get_run("SELECT * FROM law_customer WHERE id='$customer_id' AND phone_id!=''");
	        $phone_id = $UserPhoneID[0]['phone_id'];
	        $title= $purpose;
    		$body= $message;
    		$PushResult=$this->Api_model->law_push_notification_single($title,$body,$phone_id); 
    		$json_result = json_decode($PushResult);
			$success = $json_result->success;

			echo json_encode(array('notification_id' => $InsertResult,'msg'=>'Add notification Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}   

	public function get_notification()
	{	
		$customer_id = $this->input->post('customer_id');

		$notificationData 	= $this->Api_model->get_run("SELECT * FROM law_notification WHERE customer_id='$customer_id' ORDER BY id DESC");
		
		$path = base_url();
		$notification = array();
		foreach ($notificationData as $key => $value) {
			
			$notification[]			= array(
				'notification_id'=> $value['id'],
				'message' 		=> $value['message'],
				'purpose' 		=> $value['purpose'],
				'create_at' 	=> $value['create_at']
			);
		}

		if(!empty($notificationData))
		{
			echo json_encode(array('notification_data'=> $notification,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}   

	public function add_document()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_document ='law_document';

  		$customer_id    	= $this->input->post('customer_id');
  		$appointment_id     = $this->input->post('appointment_id');
  		$title     			= $this->input->post('title');
  		
  		$path = base_url();

  		$save_document		=  array(
		'customer_id'  		=> $customer_id,
		'appointment_id'  	=> $appointment_id,
		'title'  			=> $title,
		'create_at'  		=> $current_date_time
		);
		
		$InsertResult = $this->Api_model->save_data($save_document,$law_document);

		if ($InsertResult > 0) {
			echo json_encode(array('document_id' => $InsertResult,'msg'=>'Add Document Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}   

	public function add_document_upload()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_document_upload ='law_document_upload';
		$path = base_url();

  		$document_id    	= $this->input->post('document_id');

  		$fileInfo		= $_FILES["file"]["name"];
		$video          = time()."_".$_FILES['file']['name'];
        $video_tmp      = $_FILES['file']['tmp_name'];
        $move_upload    = move_uploaded_file($video_tmp,'images/law_image/'.$video);

        if($move_upload > 0)
            {
                $videos = $path.'images/law_image/'.$video; 
                $save_document_upload['file'] = $videos;
            }

  		$save_document_upload['document_id']    = $document_id;
        $save_document_upload['create_at']       = $current_date_time;
		
		$InsertResult = $this->Api_model->save_data($save_document_upload,$law_document_upload);

		if ($InsertResult > 0) {
			echo json_encode(array('msg'=>'Add Document Upload Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}   

	public function get_customer_document()
	{	
		$customer_id = $this->input->post('customer_id');

		$documentData 	= $this->Api_model->get_run("SELECT * FROM law_document WHERE customer_id='$customer_id' ORDER BY id DESC");

		// $documentData 	= $this->Api_model->get_run("SELECT d.*, du.file FROM law_document as d, law_document_upload as du WHERE d.id=du.document_id AND customer_id='$customer_id' ORDER BY id DESC");
		
		$path = base_url();
		$document = array();
		foreach ($documentData as $key => $value) {
			
			$document[]			= array(
				'document_id' 			=> $value['id'],
				'appointment_id' 		=> $value['appointment_id'],
				'title' 				=> $value['title'],
				//'file' 					=> $value['file'],
				'create_at' 			=> $value['create_at']
				
			);
		}

		if(!empty($documentData))
		{
			echo json_encode(array('document_list'=> $document,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}   

	public function get_document()
	{	
		$document_id = $this->input->post('document_id');

		$documentData 	= $this->Api_model->get_run("SELECT d.*, du.file FROM law_document as d, law_document_upload as du WHERE d.id=du.document_id AND d.id='$document_id' ORDER BY id DESC");
		
		$path = base_url();
		$document = array();
		foreach ($documentData as $key => $value) {
			
			$document[]			= array(
				'appointment_id' 		=> $value['appointment_id'],
				'title' 				=> $value['title'],
				'file' 					=> $value['file'],
				'create_at' 			=> $value['create_at']
				
			);
		}

		if(!empty($documentData))
		{
			echo json_encode(array('document_list'=> $document,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}  

	public function get_document_all()
	{	
		$documentData 	= $this->Api_model->get_run("SELECT * FROM law_document ORDER BY id DESC");
		//$file='';
		//$documentData 	= $this->Api_model->get_run("SELECT d.*, du.file FROM law_document AS d LEFT OUTER JOIN law_document_upload AS du ON d.id = du.document_id ORDER BY d.id DESC");
		
		$path = base_url();
		$document = array();
		foreach ($documentData as $key => $value) {
			//$file='';
			
			$document[]			= array(
				'document_id' 			=> $value['id'],
				'appointment_id' 		=> $value['appointment_id'],
				'title' 				=> $value['title'],
				//'file' 					=> $value['file'],
				'create_at' 			=> $value['create_at']
				
			);
		}

		if(!empty($documentData))
		{
			echo json_encode(array('all_document_list'=> $document,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	} 

	public function add_payment()
	{	
		date_default_timezone_set("Asia/Kolkata");
		$current_date_time = date('Y-m-d H:i:s');

		$law_payment ='law_payment';

  		$customer_id    	= $this->input->post('customer_id');
  		$appointment_id     = $this->input->post('appointment_id');
  		$amount     		= $this->input->post('amount');
  		
  		$path = base_url();

  		$save_payment		=  array(
		'customer_id'  		=> $customer_id,
		'appointment_id'  	=> $appointment_id,
		'amount'  			=> $amount,
		'create_at'  		=> $current_date_time
		);
		
		$InsertResult = $this->Api_model->save_data($save_payment,$law_payment);

		if ($InsertResult > 0) {
			$UserPhoneID = $this->Api_model->get_run("SELECT * FROM law_customer WHERE role='2'");
	        $count = count($UserPhoneID);
                    
            for ($i=0; $i < $count; $i++) { 
               
               if($UserPhoneID[$i]['phone_id'] != ''){
                    $phone_id[]=$UserPhoneID[$i]['phone_id']; 
               }
            }

	        $title='Add Payment';
    		$body='Add Payment Successfully';
    		$PushResult=$this->Api_model->law_push_notification($title,$body,$phone_id); 
    		$json_result = json_decode($PushResult);
			$success = $json_result->success;


			$CusPhoneID=$this->Api_model->get_run("SELECT * FROM law_customer WHERE id='$customer_id' AND phone_id!=''");
	        $cus_phone_id = $CusPhoneID[0]['phone_id'];
	        $custitle='Add Payment';
    		$cusbody='Add Payment Successfully';
    		$cusPushResult=$this->Api_model->law_push_notification_single($custitle,$cusbody,$cus_phone_id); 
    		$cusjson_result = json_decode($cusPushResult);
			$cussuccess = $cusjson_result->success;

			echo json_encode(array('payment_id' => $InsertResult,'msg'=>'Add Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}

	public function add_coadmin()
	{	
		$law_customer ='law_customer';
  		$first_name     = $this->input->post('first_name');
  		$last_name     	= $this->input->post('last_name');
  		$email     		= $this->input->post('email');
  		$gender     	= $this->input->post('gender');
  		$mobile_no     	= $this->input->post('mobile_no');
  		$age     		= $this->input->post('age');
  		$phone_id     	= $this->input->post('phone_id');
  		$image     		= $this->input->post('image');

  		$path = base_url();

  		$images 		= explode(",",$image);
		$img 			= $images[1];
		$image_parts 	= explode(";base64,",$img);
		$image_type_aux = explode("images/forum/", $image_parts[0]);
		$image_base64 	= base64_decode($image_parts[0]);
		$profile		= uniqid(). '.png';
		$file 			= 'images/forum/' .$profile;
		file_put_contents($file, $image_base64);
  	
  		
         if (!empty($mobile_no)) {
         		$CheckData = $this->Api_model->get_run("SELECT * FROM law_customer WHERE mobile_no = '$mobile_no'");
         		if (!empty($CheckData)) {
         				echo json_encode(array('msg'=>'Profile already exists','status'=>'0'));
         		}
         		else
         		{
         			if (empty($image)) {
				  			$save_user 			=  array(
						'first_name'  	=> $first_name,
						'last_name'  	=> $last_name,
						'email'  		=> $email,
						'gender'     	=> $gender,
						'mobile_no' 	=> $mobile_no,
						'phone_id' 		=> $phone_id,
						'age' 			=> $age,
						'role'  		=> 2
					);
				  		}
				  		else{
				  			$save_user 			=  array(
								'first_name'  	=> $first_name,
								'last_name'  	=> $last_name,
								'email'  		=> $email,
								'gender'     	=> $gender,
								'mobile_no' 	=> $mobile_no,
								'phone_id' 		=> $phone_id,
								'age' 			=> $age,
								'image' 		=> $path.$file,
								'role'  		=> 2
							);
						}
         			
					
					$InsertResult = $this->Api_model->save_data($save_user,$law_customer);

					if ($InsertResult > 0) {
						echo json_encode(array('customer_id' => $InsertResult,'msg'=>'Add Successfully','status'=>'1'));
					}
					else
					{
						echo json_encode(array('msg'=>'Failed','status'=>'0'));
					} 
					
					 
					}
         		}
    }

    public function get_coadmin()
	{	
		//$customer_id = $this->input->post('customer_id');

		$customerData 	= $this->Api_model->get_run("SELECT * FROM law_customer WHERE role='2' ORDER BY id DESC");
		
		$path = base_url();
		$customer = array();
		foreach ($customerData as $key => $value) {
			
			$customer[]			= array(
				'coadmin_id' 		=> $value['id'],
				'first_name' 		=> $value['first_name'],
				'last_name' 		=> $value['last_name'],
				'email' 			=> $value['email'],
				'gender' 			=> $value['gender'],
				'mobile_no' 		=> $value['mobile_no'],
				'role'  			=> $value['role'],
				'age'  				=> $value['age'],
				'image'  			=> $value['image'],
				'phone_id'  		=> $value['phone_id'],
				
			);
		}

		if(!empty($customerData))
		{
			echo json_encode(array('customer_list'=> $customer,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}

	}  

	public function update_coadmin()
	{	
		$law_customer ='law_customer';
		$customer_id    = $this->input->post('customer_id');
  		$first_name     = $this->input->post('first_name');
  		$last_name     	= $this->input->post('last_name');
  		$email     		= $this->input->post('email');
  		$gender     	= $this->input->post('gender');
  		$mobile_no     	= $this->input->post('mobile_no');
  		$age     		= $this->input->post('age');
  		$image     		= $this->input->post('image');

  		if (empty($image)) {
  			$update_user 			=  array(
				'first_name'  	=> $first_name,
				'last_name'  	=> $last_name, 
				'email'  		=> $email,
				'gender'     	=> $gender,
				'mobile_no' 	=> $mobile_no,
				'age' 			=> $age
				);
  		}
  		else{

  			$path = base_url();

	  		$images 		= explode(",",$image);
			$img 			= $images[1];
			$image_parts 	= explode(";base64,",$img);
			$image_type_aux = explode("images/forum/", $image_parts[0]);
			$image_base64 	= base64_decode($image_parts[0]);
			$profile		= uniqid(). '.png';
			$file 			= 'images/forum/' .$profile;
			file_put_contents($file, $image_base64);
	  	
	  		$update_user 			=  array(
			'first_name'  	=> $first_name,
			'last_name'  	=> $last_name, 
			'email'  		=> $email,
			'gender'     	=> $gender,
			'mobile_no' 	=> $mobile_no,
			'age' 			=> $age,
			'image' 		=> $path.$file
			);

  		}

  		
		
		$UpdateResult = $this->Api_model->update_data($update_user,$law_customer,$customer_id);

		if ($UpdateResult > 0) {
			echo json_encode(array('msg'=>'Update Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}

	public function delete_coadmin()
	{	
		$customer_id   	  	 = $this->input->post('customer_id');

        $law_customer='law_customer';
            
	    $result=$this->Api_model->do_delete($law_customer,$customer_id);
		
		if($result > 0) {
			echo json_encode(array('msg'=>'Delete Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		}    
    }


     
       public function add_associate_profile()
	   {	
		 	$law_associate_profile ='law_associate_profile';
		 	$id = $this->input->post('id');
   		$name     		    = $this->input->post('name');
   		$designation       	= $this->input->post('designation');
   		$about   	        = $this->input->post('about');
  	    $image    		    = $this->input->post('image');
  		
		 $path = base_url();

      $images 		= explode(",",$image);
		$img 			= $images[1];
		$image_parts 	= explode(";base64,",$img);
		$image_type_aux = explode("images/forum/", $image_parts[0]);
		$image_base64 	= base64_decode($image_parts[0]);
		$profile		= uniqid(). '.png';
		$file 			= 'images/forum/' .$profile;
		file_put_contents($file, $image_base64);
  		
  		$path = base_url();





	                      $save_user 	=array(
		 				'name'          => $name,
		 				'designation'  	=> $designation,
		 				'about'         => $about,
		 			    'image' 	    =>$path.$file,
						
					);

	                $InsertResult = $this->Api_model->save_data($save_user,$law_associate_profile);

	 			if ($InsertResult > 0) {
		 				echo json_encode(array('id' => $InsertResult,'msg'=>'Add Successfully','status'=>'1'));
		 			}
		 			else
		 			{
						echo json_encode(array('msg'=>'Failed','status'=>'0'));
					} 
					
					 
		}


      public function delete_associate_profile()
	 {	
	 	       $id  = $this->input->post('id');

        $law_associate_profile ='law_associate_profile';
            
	     $result=$this->Api_model->do_delete( $law_associate_profile,$id);
		
	 	if($result > 0) {
			echo json_encode(array('msg'=>'Delete Successfully','status'=>'1'));
	 	}
		else
		{
 		echo json_encode(array('msg'=>'Failed','status'=>'0'));
	 	}    
     }




     public function list_associate_profile()
	{	
		$id = $this->input->post('id');

		$customerData 	= $this->Api_model->get_run("SELECT * FROM  law_associate_profile Where id='$id'");
		
		$path = base_url();
		$customer = array();
		foreach ($customerData as $key => $value) {
			
			$customer[]			= array(
				'name' 		        => $value['name'],
				'designation' 		=> $value['designation'],
				'about' 			=> $value['about'],
			    'image'  			=> $value['image'],
				
				
			);
		}

		if(!empty($customerData))
		{
			echo json_encode(array('customer_list'=> $customer,'msg'=>'Get Data Successfully','status' =>'1')); 
		}
		else
		{
			 echo json_encode(array('msg'=>'Data not found','status'=>'0'));
		}
      }  


      public function edit_associate_profile()
	{	
		$id = $this->input->post('id');
	    $law_associate_profile ='law_associate_profile';

		$name      = $this->input->post('name');
  		$designation     = $this->input->post('designation');
  		$about  = $this->input->post('about');
  	    $image      = $this->input->post('image');

  	     $path = base_url();

        $images 		= explode(",",$image);
		$img 			= $images[1];
		$image_parts 	= explode(";base64,",$img);
		$image_type_aux = explode("images/forum/", $image_parts[0]);
		$image_base64 	= base64_decode($image_parts[0]);
		$profile		= uniqid(). '.png';
		$file 			= 'images/forum/' .$profile;
		file_put_contents($file, $image_base64);
  		
  		$path = base_url();

        
  	
	  	
	  		$update_user 	= array(
			'name'  	    => $name,
			'designation'  	=> $designation, 
			'about'         => $about,
			'image'         => $path.$file,
			
			);
		
     $UpdateResult = $this->Api_model->update_data($update_user, $law_associate_profile,$id);

		if ($UpdateResult > 0) {
			echo json_encode(array('msg'=>'Update Successfully','status'=>'1'));
		}
		else
		{
			echo json_encode(array('msg'=>'Failed','status'=>'0'));
		} 
	}



}



