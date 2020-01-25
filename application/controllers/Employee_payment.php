<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_payment extends CI_Controller {

public function __construct()
    {
    parent::__construct();       
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Employee Payments';

    $field = array(
        'employee_payment' => 'employee_payment.*',
        'employees' => 'employees.employeeName',
        'companys' => 'companys.companyName'
            );
    $join = array(
        'employees' => 'employee_payment.empid = employees.employeeID',
        'companys' => 'companys.companyID = employee_payment.company'
            );
    $other = array(
        'order_by' => 'empPid'
            );

    $data['employees'] = $this->pm->get_data('employee_payment',false,$field,$join,$other);

    $data['content'] = $this->load->view('employeePayment/infos',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function AddInfo()
    {
    $data['title'] = 'Employee Payment';

    $data['company'] = $this->pm->get_data('companys',false);

    $data['content'] = $this->load->view('employeePayment/addInfo',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function get_emp_salary()
    {
    //$id = 2019; $id2 = 10; $id3 = 3;
    $section = $this->pm->get_salary_emp($_POST['id'],$_POST['id2']);
//var_dump($section); exit();
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function Saveinfo()
    {        
    $info = $this->input->post();

    $length = count($info['checkbox']);
//var_dump($length); exit();
    for ($i = 0; $i < $length; $i++)
        {
        $emps = array(
            'empid'       => $info['checkbox'][$i],
            'company'     => $_SESSION['company'],
            'month'       => $info['month'],
            'year'        => $info['year'],
            'salary'      => $info['salary'][$i],
            'accountType' => $info['accountType'],
            'accountNo'   => $info['accountNo'],
            'note'        => $info['note'],
            'regby'       => $this->session->userdata('admin_id')
                    );
       
        $result = $this->pm->insert_data('employee_payment',$emps);
        }
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee Payments add Successfully !</h4>
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
    redirect('Employee_payment');
}

public function emp_payment_details($id)
    {
    $data['title'] = 'Employee Payment';

    $data['company'] = $this->pm->company_details();

    $where = array(
        'empPid' => $id
            );
    $join = array(
        'employees' => 'employees.employeeID = employee_payment.empid'
            );
    $collection = $this->pm->get_data('employee_payment',$where,false,$join);
    $data['empp'] = $collection[0];

    $data['content'] = $this->load->view('employeePayment/emppDetails',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}







}