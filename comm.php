<?php
class Common_model extends CI_Model {


public function get_run($run)
{
$query = $this->db->query($run);
return $query->result_array();  
}


public function login_check($email,$password)
{

$this->db->where('email',$email);
$this->db->where('password',$password);
$query = $this->db->get('user');
if($query->num_rows() == 1)  
{
$result=$query->result();

$sessiondata = array(
'id'  =>$result[0]->id,
'email'  =>$result[0]->email,
'type'=>$result[0]->type
  );

$this->session->set_userdata('cart',$sessiondata);
$kr=$this->session->cart;
 return $kr;


} 
else

{		
return false;
}

}



public function save_data($insert_data,$table)
{

$this->db->insert($table,$insert_data);
$insert_id = $this->db->insert_id();
return $insert_id;
}



public function do_delete($table,$id){

$this->db->where('id',$id);

$this->db->delete($table);

return ($this->db->affected_rows()!=1)? false : true;

}


public function getdata_one($table,$id)
{
$this->db->where('id',$id);
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


}
