<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index() // user type need to be off when this software live
    {
    $data['title'] = 'User';
    
    $field = array(
        'users' => 'users.user_id,users.empid,users.user_name,users.role,users.status',
        'employees' => 'employees.employeeID,employees.employeeName,employees.phone,employees.email',
        'access_lavels' => 'lavelName'
            );
    $join = array(
        'employees' => 'employees.employeeID = users.empid',
        'access_lavels' => 'access_lavels.accessLavelId = users.role'
            );
    $other = array(
        'order_by' => 'user_id'
            );

    $data['users'] = $this->pm->get_data('users',false,$field,$join,$other);

    $awhere = array(
        'status' => 'Active'
            );
    $data['accessLavels'] = $this->pm->get_data('access_lavels',$awhere);
    $data['emp'] = $this->pm->get_employee();
    
    $data['content'] = $this->load->view('users/users',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function check_username()
  {
  $grup = $this->pm->check_user_name($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function SaveUser()
    {
    $info = $this->input->post(); 

    $sdata = array(
        'empid'     => $info['emp'],
        'user_name' => $info['uname'],
        'password'  => $info['password'],
        'role'      => $info['utype'],
        'status'    => $info['status'],        
        'regby'     => $this->session->userdata('admin_id')
            );
   
    $result = $this->pm->insert_data('users',$sdata);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>User add Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('User');
}

public function get_user_data()
  {
  $grup = $this->pm->get_user_data($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function update_User()
    {
    $info = $this->input->post(); 

    $sdata = array(
        'empid'     => $info['emp'],
        'user_name' => $info['uname'],
        'password'  => $info['password'],
        'role'      => $info['utype'],
        'status'    => $info['status'],      
        'upby'      => $this->session->userdata('admin_id')
            );

    $where = array(
        'user_id' => $info['user_id']
            );
        
    $result = $this->pm->update_data('users',$sdata,$where);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>User update Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('User');
}

public function delete_user($id)
    {
    $where = array(
        'user_id' => $id
            );
        
    $result = $this->pm->delete_data('users',$where);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>User delete Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('User');
}






}