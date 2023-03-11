<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('common/login');
	}


   public function login_check(){
        $tbl_user='user';
        $usermail=$this->input->post('email');
        $password=$this->input->post('password');
        $result=$this->Common_model->login_check($usermail,$password,$tbl_user);
       
         if($result=='1'||$result=='2'||$result=='3')
        {
           $this->session->set_userdata('user',$result);
           $data['main'] = 'common/main';
           $this->load->view('common/template',$data);
        }
        
        else
         {
             $this->session->set_flashdata('error_msg','Invalid Email ID or Password'); 
             $this->load->view('common/login');
         }
   
      }


   public function logout()
    {
       $this->session->unset_userdata('user');
       $this->load->view('common/login');
    }



 public function add_principal_post()
{
$data['main']='principal/add_principal_post';
$this->load->view('common/template',$data);
}


 public function save_principal(){

        
            $tbl_user  = 'user';

     $hobbie = $this->input->post('hobbies');
     $hobbie = implode(",",$hobbie);

          $ptmp=$_FILES["files"]["tmp_name"];
          $pnm=$_FILES["files"]["name"];
          $pic=time().$pnm;
           move_uploaded_file($ptmp, "upload/$pic");
    

       $save_principal=array(

             'name'    => $this->input->post('name'),
             'email'   =>  $this->input->post('email'),
             'password'=>  $this->input->post('password'),
             'gender'  =>  $this->input->post('gender'),
             'dob'     =>  $this->input->post('dob'),
            'hobbies'  =>$hobbie,
    'qualification'    =>  $this->input->post('qualification'),
            'joindate' =>  $this->input->post('joindate'),
        'resigndate'   =>  $this->input->post('resigndate'),
             'address' =>  $this->input->post('address'),
             'pic'=>   $pic,
              'type'   =>'2'
              );



   $result=$this->Common_model->save_data($save_principal,$tbl_user);
            
            if($result > 0){
              $this->session->set_flashdata('msg',' Recored added Successfully');
              redirect(site_url('Welcome/principaltable'));
                         }
            else{
              $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
              redirect(site_url('Welcome/principaltable'));
             }

       
    }



  public function principaltable()
    {
        
   $data['principal_data'] = $this->Common_model->get_run("SELECT * FROM user  where type='2' ");
   $data['main'] = 'principal/principaltable';
   $this->load->view('common/template', $data);
    }


    public function delete_principal(){
        $id=$this->uri->segment(3);
        $tbl_user='user';
        if (!empty($id)) {
            $result=$this->Common_model->do_delete($tbl_user,$id);
           }
        if($result>0){
     $this->session->set_flashdata('msg',' Recored deleted Successfully');   
       redirect(site_url('Welcome/principaltable'));
        }
        else{
        $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
        redirect(site_url('Welcome/principaltable'));
       
        }
    }


     public function edit_principal(){
        $id=$this->uri->segment(3);
        $user='user';
        $data['edit_principal_data'] = $this->Common_model->getdata_one($user,$id);
        $data['main']='principal/edit_principal_post';
        $this->load->view('common/template',$data);
    }


 //     public function update_principal(){
 
 //       $id = $this->uri->segment(3);
        
 //            $tbl_user='user';

 //     $hobbie = $this->input->post('hobbies');
 //     $hobbie = implode(",",$hobbie);

 //      $update_post=array(

 //             'name'    => $this->input->post('name'),
 //             'email'   =>  $this->input->post('email'),
 //             'password'=>  $this->input->post('password'),
 //             'gender'  =>  $this->input->post('gender'),
 //             'dob'     =>  $this->input->post('dob'),
 //            'hobbies'  =>$hobbie,
 //    'qualification'    =>  $this->input->post('qualification'),
 //            'joindate' =>  $this->input->post('joindate'),
 //        'resigndate'   =>  $this->input->post('resigndate'),
 //             'address' =>  $this->input->post('address'),
 //            'type'   =>'2'
 //              );

 // $new_image=$_FILES['files']['name'];
 //      if ($new_image!='') {
 //             $ptmp=$_FILES["files"]["tmp_name"];
 //          $pnm=$_FILES["files"]["name"];
 //           $pic=time().$pnm;
 //           move_uploaded_file($ptmp, "upload/$pic");

 //        }
 //        else{
 //            $pic=$old_doc;
 //        }

 //   $UpdateResult = $this->Common_model->update_data($update_post,$tbl_user,$id);

        
 //        if($UpdateResult > 0) {
 //          $this->session->set_flashdata('msg',' Recored updated Successfully');   
 //             redirect(site_url('Welcome/principaltable'));
 //        }
 //        else
 //        {
 //           $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
 //           redirect(site_url('Welcome/principaltable'));
 //        }
 //    }


   public function update_principal(){
 
       $id = $this->uri->segment(3);
        
            $tbl_user='user';

     $hobbie = $this->input->post('hobbies');
     $hobbie = implode(",",$hobbie);

        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $gender=$this->input->post('gender');
        $hobbies=$this->input->post('hobbies');
        $qualification=$this->input->post('qualification');
        $joindate=$this->input->post('joindate');
        $resigndate=$this->input->post('resigndate');
        $address=$this->input->post('address');
         $old_doc=$this->input->post('old_doc');
        $new_image=$_FILES['files']['name'];


        if ($new_image!='') {
             $ptmp=$_FILES["files"]["tmp_name"];
          $pnm=$_FILES["files"]["name"];
           $pic=time().$pnm;
           move_uploaded_file($ptmp, "upload/$pic");

        }
        else{
            $pic=$old_doc;
        }


        $update_post=array(
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'gender'=>$gender,
                'hobbies'=>$hobbie,
                'qualification'=>$qualification,
                'joindate'=>$joindate,
                'resigndate'=>$resigndate,
                'address'=>$address,
                'pic'=>$pic,
                'type'=>'2'
        );


   $UpdateResult = $this->Common_model->update_data($update_post,$tbl_user,$id);

        
        if($UpdateResult > 0) {
          $this->session->set_flashdata('msg',' Recored updated Successfully');   
             redirect(site_url('Welcome/principaltable'));
        }
        else
        {
           $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
           redirect(site_url('Welcome/principaltable'));
        }
    }








public function add_teacher_post()
{

$data['main']='teacher/add_teacher_post';
$this->load->view('common/template',$data);
}


public function save_teacher()
{

$tbl_user='user';
$name       =$this->input->post('name');
$email      =$this->input->post('email');
$password   =$this->input->post('password');
$gender     =$this->input->post('gender');
$dob        =$this->input->post('dob');
$qualification=$this->input->post('qualification');
$joindate   =$this->input->post('joindate');
$resigndate =$this->input->post('resigndate');
$address    =$this->input->post('address');

$save_teacher=array(

'name'    =>$name,
'email'   =>$email,
'password'=>$password,
'gender'  =>$gender,
'dob'     =>$dob,
'qualification'=>$qualification,
'joindate'=>$joindate,
'resigndate'=>$resigndate,
'address' =>$joindate,
'type'    =>'3'
);

$result=$this->Common_model->save_data($save_teacher,$tbl_user);
if($result>0)
         {
          $this->session->set_flashdata('msg','Recored added Successfully');
          redirect(site_url('Welcome/teachertable'));
        }
       else
       {
    
          $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
          redirect(site_url('Welcome/teachertable'));

       }


   }


public function teachertable()
{
$data['teacher_data']=$this->Common_model->get_run("SELECT * from user where type='3'");
$data['main']='teacher/teachertable';
$this->load->view('common/template',$data);
}









	
}
