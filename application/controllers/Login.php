<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model",'pm');
}

public function index()
{
    $data['title'] = 'Login';

    $data['company'] = $this->pm->company_details();
        
    $data['content'] = $this->load->view('login',$data,true);
    $this->load->view('themes/login_template',$data);
}

public function loginProcess()
{        
    $where = array(
        'user_name' => $this->input->post('username'),
        'users.status' => 'Active',
        'password' => $this->input->post('password')
            );

    $other = array(
        'join' => 'left'
            );
    $field = array(
        'users'     => 'users.user_id,users.empid,users.user_name,users.role,users.status',
        'employees' => 'employees.employeeName,employees.company'
            );
    $join = array(
        'employees' => 'employees.employeeID = users.empid'
            );
    
    $user_data = $this->pm->get_data('users',$where,$field,$join,$other);

    if (count($user_data) == 1)
        {
        $this->session->set_userdata($user_data[0]);
        $this->session->set_userdata('admin_id',$user_data[0]['user_id']);
        $this->session->set_userdata('username',$user_data[0]['user_name']);
        $this->session->set_userdata('role',$user_data[0]['role']);
        $this->session->set_userdata('empname',$user_data[0]['employeeName']);
        $this->session->set_userdata('empid',$user_data[0]['empid']);
        $this->session->set_userdata('company',$user_data[0]['company']);
        $this->session->set_userdata('logged_in',1);

        $result = $this->pm->company_details();

        $sdata = [
            'company_name' => $result->com_name
                ];
            //var_dump($sdata); exit();
        $this->session->set_userdata($sdata);
        redirect('Home');
        }
    else
        {
        $this->session->set_flashdata('msg','Invalid Login id or Password');
        redirect('Login');
        }
}

public function logout()
    {
    $this->session->sess_destroy();
    redirect('Login');
}





}