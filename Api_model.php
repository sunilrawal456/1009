<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Api_model extends CI_Model {



	function __construct()

	{

		parent::__construct();

	    $this->load->library('upload');

		$this->load->library('session'); 

	}



    public function LoginCheck($useremail,$password)

    {

        $this->db->where('email',$useremail);

        $this->db->where('password',$password);

        $query = $this->db->get('tbl_admin');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'password' =>$result[0]->password,

                              'username'=>$result[0]->username,

                              'role'     =>$result[0]->role,

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {		

        return -1;

        }

    }

    public function CustomerLoginWithMpin($mpin,$mobile_no)

    {

        $this->db->where('mpin',$mpin);

         $this->db->where('mobile_no',$mobile_no);

        $query = $this->db->get('tbl_customer');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'first_name'=>$result[0]->first_name,

                              'last_name'=>$result[0]->last_name,

                              'mobile_no'=>$result[0]->mobile_no,
                              
                              'mpin'=>$result[0]->mpin,

                              'status'=>$result[0]->status

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {       

        return -1;

        }

    }


      public function customer_login($mobile_no)

    {
         $this->db->where('mobile_no',$mobile_no);

        $query = $this->db->get('tbl_customer');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'first_name'=>$result[0]->first_name,

                              'last_name'=>$result[0]->last_name,

                              'mobile_no'=>$result[0]->mobile_no,
                              
                              'mpin'=>$result[0]->mpin,

                              'status'=>$result[0]->status

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {       

        return -1;

        }

    }

    public function customer_login_law($mobile_no)

    {
         $this->db->where('mobile_no',$mobile_no);

        $query = $this->db->get('law_customer');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'first_name'=>$result[0]->first_name,

                              'last_name'=>$result[0]->last_name,

                              'mobile_no'=>$result[0]->mobile_no,
                              
                              'gender'=>$result[0]->gender,

                              'role'=>$result[0]->role

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {       

        return -1;

        }

    }




        public function customer_login_law_que($mobile_no)

    {
         $this->db->where('mobile_no',$mobile_no);

        $query = $this->db->get('que_customer');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'first_name'=>$result[0]->first_name,

                              'last_name'=>$result[0]->last_name,

                              'mobile_no'=>$result[0]->mobile_no,
                              
                              'gender'=>$result[0]->gender,

                              'role'=>$result[0]->role

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {       

        return -1;

        }

    }






public function business_login_que($mobile_no)

    {
         $this->db->where('mobile_no',$mobile_no);
        $query = $this->db->get('que_business');

        if($query->num_rows() > 0)  

        {
        $result=$query->result();
        $sessiondata = array(

                              'business_id' =>$result[0]->business_id,
                            'business_name' =>$result[0]->business_name,
                                     'image'=>$result[0]->image,
                               'category_id'=>$result[0]->category_id,
                            'subcategory_id'=>$result[0]->subcategory_id,
                                      'late'=>$result[0]->late,
                                      'long'=>$result[0]->long,
                                   'address'=>$result[0]->address,
                                   'phone_id'=>$result[0]->phone_id,
                                   'monday' =>$result[0]->monday,
                                  'tuesday' =>$result[0]->tuesday,
                                'wednesday' =>$result[0]->wednesday,
                                  'thursday'=>$result[0]->thursday,
                                    'friday'=>$result[0]->friday,
                                  'saturday'=>$result[0]->saturday,
                                    'sunday'=>$result[0]->sunday,

                             );

        $this->session->set_userdata($sessiondata);
        return $result;
         } 

        else

        {       
        return -1;
        }

    }




    public function check_customer($mobile_no)
    {
        $this->db->where('mobile_no',$mobile_no);
        $query = $this->db->get('tbl_customer');
        if($query->num_rows() > 0)  
        {
            $result=$query->result();
            return $result[0]->id;
        } 
        else
        {       
            return -1;
        }
    }

    public function CustomerLoginCheck($mobile_no,$password)

    {

        $this->db->where('mobile_no',$mobile_no);

        $this->db->where('password',$password);

        $query = $this->db->get('tbl_customer');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'password' =>$result[0]->password,

                              'first_name'=>$result[0]->first_name,

                              'last_name'=>$result[0]->last_name,

                              'mobile_no'=>$result[0]->mobile_no,
                              
                              'status'=>$result[0]->status

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {		

        return -1;

        }

    }

    public function BuildingLoginCheck($useremail,$password)

    {

        $this->db->where('email',$useremail);

        $this->db->where('password',$password);

        $query = $this->db->get('tbl_building');

        if($query->num_rows() > 0)  

        {

        $result=$query->result();

        $sessiondata = array(

                              'id'       =>$result[0]->id,

                              'email'    =>$result[0]->email,

                              'password' =>$result[0]->password,

                              // 'username'=>$result[0]->username,

                              // 'role'     =>$result[0]->role,

                            );

        $this->session->set_userdata($sessiondata);

        return $result;

        } 

        else

        {		

        return -1;

        }

    }



	public function session_check()

	{

		if($this->session->userdata('id')=='')

		{

		    return false;

		}

		else

		{

     		return true;        



		}

	}



	public function save_data($insert_data,$table)

	{

		$this->db->insert($table,$insert_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}



	public function get_data($table)

	{

		$query=$this->db->get($table);

		return $query->result_array();

	}



	public function do_delete($table,$id)

	{

		$this->db->where('id',$id);

		$this->db->delete($table);

		return ($this->db->affected_rows()!=1)? false : true;

	}


    public function do_delete_notification($table,$notification_id)
  {

        $this->db->where('notification_id',$notification_id);
        $this->db->delete($table);
        return ($this->db->affected_rows()!=1)? false : true;

  }



    public function do_delete_like($table,$forum_id,$customer_id)

    {

        $this->db->where('forum_id',$forum_id);

        $this->db->where('customer_id',$customer_id);

        $this->db->delete($table);

        return ($this->db->affected_rows()!=1)? false : true;

    }





	public function getdata_one($table,$id)

	{

		$this->db->where('id',$id);

		$q = $this->db->get($table);

		return $result = $q->result_array();

	}



    public function get_data_one($table,$id,$col)

	{

		$this->db->where($col,$id);

		$q = $this->db->get($table);

		return $result = $q->result_array();

	}





	public function update_data($save,$table,$id) 

	{

	    $this->db->where('id', $id);

	    $data=$this->db->update($table, $save);



		if($data)

		   return true;

		else

		    return false;

	}



public function update_business_data($save,$table,$business_id) 

    {

        $this->db->where('business_id', $business_id);

        $data=$this->db->update($table, $save);
        
        if($data)

           return true;

        else

            return false;

    }



public function update_data_que($save,$table,$customer_id) 

    {

        $this->db->where('customer_id', $customer_id);

        $data=$this->db->update($table, $save);



        if($data)

           return true;

        else

            return false;

    }


public function update_business_notification($save,$table,$business_id) 

    {

        $this->db->where('business_id', $business_id);

        $data=$this->db->update($table, $save);



        if($data)

           return true;

        else

            return false;

    }




	public function upddata($data,$table,$id) {

    $this->db->where('id', $id);

    $this->db->update($table,$data);

 	return true;

    }





    public function get_run($run)

	{

		$query = $this->db->query($run);

		return $query->result_array();	

	}





    function upload_file($path,$image_name,$tmp_name)

    {

		if(move_uploaded_file($tmp_name,$path.$image_name) && is_writable($path))

		{

		    $display_message = 1;

		    $display_message = $path.$image_name;

		}

		else

		{

	    	$display_message = '';

		}

       return $display_message;

    }



	public function Change_Forget_Password($email){

		$this->db->where('email',$email);

		$query = $this->db->get('tbl_admin');

		if($query->num_rows() == 1)  {

		$result=$query->result_array();

		return $result;

		} 

		else{   

		return -1;

		}

	}



	public function update_for_all($update_data,$table,$id,$col_name)

	{

		$this->db->where($col_name,$id);

		return ( $this->db->update($table, $update_data) != 1) ? false : true;

	}

	public function send_mail($email,$subject,$message)
	{
		$this->email->from('testing.developer999@gmail.com');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->set_mailtype("html");
		$this->email->message($message);
		return $this->email->send();
	}

	public function push_notification($title,$body,$phone_id)
  	{ 
        define('API_ACCESS_KEY','AAAAK3YIGMk:APA91bEtMigmWfiP4uD_rAqeks_FGUcwYaYnkw6D4NXJl_V6X5mvjgmj3ZrJsrX0Jsz_h3KkGG2Nqb0E3fn2iamnLy_-cl0iq_dsWOOfP4HtKWPNhjV6kYwWSv__aYRKdoSjGm2PZ51G');

        // $phone_id[]='cXUfj3MNBPQ:APA91bHEg6zddFf7Sc9QATMs0OOXsYmFLVki-KWB-FlVtiywm1RIqVV1MejGCjsoigeWeGqBBf6pgQZO63Lz5QIH7nUtbgB_r2C-94FoSzl_JhKZdVREUJ3W_X5oCb_vk0veafJx23hC';
        $tag='ABC';
        $color='#FF4081';
        $icon=base_url().'images/logo/movie_logo.jpeg';
        
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = API_ACCESS_KEY;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','tag'=>$tag,'color'=>$color,'icon'=>$icon,'click_action'=>'com.example.amoghcinema.NotificationActivity');
        // $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('registration_ids' => $phone_id, 'notification' => $notification,'priority'=>'high');
        
        $json = json_encode($arrayToSend);
        
        $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
        // if ($response === FALSE) {
        //     die('FCM Send Error: ' . curl_error($ch));
        //     }
            curl_close($ch);
            return $response;        
     }

     public function law_push_notification($title,$body,$phone_id)
    { 
        define('API_ACCESS_KEY','AAAAOBT6nRk:APA91bHgtHNIs0saaPpGEWpEaC0CCRkMns7R_9-8J3FUo2pELhiMPiyEhJC0Ew6b5tqDOH5zvVsOpa0uWGb9TI8qjACiiSRay7e0yc2mDYbjZxtNK5Jdi5lAvvr9-_1xB4A5tfUsDRIL');

        $tag='ABC';
        $color='#FF4081';
        
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = API_ACCESS_KEY;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','tag'=>$tag,'color'=>$color);
        $arrayToSend = array('registration_ids' => $phone_id, 'notification' => $notification,'priority'=>'high');
        
        $json = json_encode($arrayToSend);
        
        $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        
            curl_close($ch);
            return $response;        
     }

    public function law_push_notification_single($title,$body,$phone_id)
    { 
        define('API_ACCESS_KEY','AAAAOBT6nRk:APA91bHgtHNIs0saaPpGEWpEaC0CCRkMns7R_9-8J3FUo2pELhiMPiyEhJC0Ew6b5tqDOH5zvVsOpa0uWGb9TI8qjACiiSRay7e0yc2mDYbjZxtNK5Jdi5lAvvr9-_1xB4A5tfUsDRIL');
        $tag='ABC';
        $color='#FF4081';
        
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = API_ACCESS_KEY;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','tag'=>$tag,'color'=>$color);
         $arrayToSend = array('to' => $phone_id, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);

        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        $response = curl_exec($ch);
            curl_close($ch);
            return $response;        
     }

     public function push_notification_single($title,$body,$phone_id)
  	{ 
        // define('API_ACCESS_KEY','AAAAK3YIGMk:APA91bEtMigmWfiP4uD_rAqeks_FGUcwYaYnkw6D4NXJl_V6X5mvjgmj3ZrJsrX0Jsz_h3KkGG2Nqb0E3fn2iamnLy_-cl0iq_dsWOOfP4HtKWPNhjV6kYwWSv__aYRKdoSjGm2PZ51G');

        define('API_ACCESS_KEY','AAAAK3YIGMk:APA91bEtMigmWfiP4uD_rAqeks_FGUcwYaYnkw6D4NXJl_V6X5mvjgmj3ZrJsrX0Jsz_h3KkGG2Nqb0E3fn2iamnLy_-cl0iq_dsWOOfP4HtKWPNhjV6kYwWSv__aYRKdoSjGm2PZ51G');

        // $phone_id[]='cXUfj3MNBPQ:APA91bHEg6zddFf7Sc9QATMs0OOXsYmFLVki-KWB-FlVtiywm1RIqVV1MejGCjsoigeWeGqBBf6pgQZO63Lz5QIH7nUtbgB_r2C-94FoSzl_JhKZdVREUJ3W_X5oCb_vk0veafJx23hC';
        $tag='ABC';
        $color='#FF4081';
        $icon=base_url().'images/logo/movie_logo.jpeg';
        
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = API_ACCESS_KEY;
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1','tag'=>$tag,'color'=>$color,'icon'=>$icon,'click_action'=>'com.example.amoghcinema.NotificationActivity');
        // $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $phone_id, 'notification' => $notification,'priority'=>'high');
        
        $json = json_encode($arrayToSend);
        
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        $response = curl_exec($ch);
        
        // if ($response === FALSE) {
        //     die('FCM Send Error: ' . curl_error($ch));
        //     }
            curl_close($ch);
            return $response;        
     }







}

?>