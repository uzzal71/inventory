<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends CI_Controller {

public function __construct()
    {
    parent::__construct();       
    $this->load->model("prime_model","pm");
    $this->load->model("employee_model","employee");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Employee';
    $data['employees'] = $this->employee->get_employee();
    $data['dept'] = $this->pm->get_data('department',false);
    $data['company'] = $this->pm->get_data('companys',false);
    
    $data['content'] = $this->load->view('employees/employees',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function get_designation_data()
    {
    $section = $this->pm->get_designation_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function SaveEmployee()
    {       
    $info = $this->input->post();

    $employee = array(
        'employeeName' => $info['employeeName'],
        'dpt_id'       => $info['dpt_id'],
        'desg_id'      => $info['desg_id'],
        'empaddress'   => $info['empaddress'],
        'company'      => $info['company'],
        'phone'        => $info['phone'],
        'email'        => $info['email'],
        'joiningDate'  => date('Y-m-d', strtotime($info['joiningDate'])),
        'salary'       => $info['salary'],
        'nid'          => $info['nid'],
        'status'       => $info['status'],
        'regby'        => $this->session->userdata('admin_id')
                );

    $result = $this->pm->insert_data('employees',$employee);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee add Successfully !</h4>
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
    redirect('Employee');
}

public function get_emp_data()
    {
    $section = $this->pm->get_emp_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_Employee()
    {       
    $info = $this->input->post();

    $employee = array(
        'employeeName' => $info['employeeName'],
        'dpt_id'       => $info['dpt_id'],
        'desg_id'      => $info['desg_id'],
        'empaddress'   => $info['empaddress'],
        'company'      => $info['company'],
        'phone'        => $info['phone'],
        'email'        => $info['email'],
        'joiningDate'  => date('Y-m-d', strtotime($info['joiningDate'])),
        'salary'       => $info['salary'],
        'nid'          => $info['nid'],
        'status'       => $info['status'],
        'upby'         => $this->session->userdata('admin_id')
                );

    $where = array(
        'employeeID' => $info['emp_id']
            );

    $result = $this->pm->update_data('employees',$employee,$where);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee update Successfully !</h4>
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
    redirect('Employee');
}

public function delete_Employee($id)
    {
    // $uwhere = array(
    //     'empid' => $id
    //         );
    // $empu = $this->pm->get_data('users',$uwhere);
    // $data['empu'] = $empu[0];

    // if ($empu[0] == null)
    //     {
        $where = array(
            'employeeID' => $id
                );

        $result = $this->pm->delete_data('employees',$where);
    
        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Employee delete Successfully !</h4>
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
    //     }
    // else
    //     {
    //     $sdata = [
    //       'exception' =>'<div class="alert alert-danger alert-dismissible">
    //         <h4><i class="icon fa fa-ban"></i> All ready add this employee as user !</h4>
    //         </div>'
    //             ];
    //     }
    $this->session->set_userdata($sdata);
    redirect('Employee');
}

public function emp_department()
    {
    $data['title'] = 'Department';

    $data['dept'] = $this->pm->get_data('department',false);

    $data['content'] = $this->load->view('employees/department',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function save_department()
    {       
    $info = $this->input->post();
           
    $data = array(
        'dept_name' => $info['department'],
        'regby'     => $this->session->userdata('admin_id')
            );
    
    $result = $this->pm->insert_data('department',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee department add Successfully !</h4>
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
    redirect('Employee/emp_department');
}

public function get_dept_data()
    {
    $section = $this->pm->get_dept_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_dept()
    {       
    $info = $this->input->post();
           
    $data = array(
        'dept_name' => $info['department'],
        'upby'      => $this->session->userdata('admin_id')
            );

    $where = array(
        'dpt_id' => $info['dept_id']
            );

    $result = $this->pm->update_data('department',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee department update Successfully !</h4>
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
    redirect('Employee/emp_department');
}

public function delete_dept($dpt_id)
    {       
    $info = $this->input->post();

    $where = array(
        'dpt_id' => $dpt_id
            );

    $empd = $this->pm->get_data('employees',$where);
    $data['empd'] = $empd[0];

    if ($empd[0] == null)
        {
        $result = $this->pm->delete_data('department',$where);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Employee department delete Successfully !</h4>
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
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> All ready add this department in employees !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Employee/emp_department');
}

public function emp_designation()
    {
    $data['title'] = 'Employee Designation';

    $data['dept'] = $this->pm->get_data('department',false);

    $field = array(
        'designation' => 'designation.*',
        'department' => 'department.dept_name'
            );

    $other = array(
        'order_by' => 'desg_id'
            );
    $join = array(
        'department' => 'department.dpt_id = designation.dpt_id'
            );

    $data['dsg'] = $this->pm->get_data('designation',false,$field,$join,$other);

    $data['content'] = $this->load->view('employees/designation',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function save_designation()
    {       
    $info = $this->input->post();
           
    $data = array(
        'dpt_id'    => $info['dpt_id'],
        'desg_name' => $info['designation'],
        'regby'     => $this->session->userdata('admin_id')
            );
    
    $result = $this->pm->insert_data('designation',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee designation add Successfully !</h4>
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
    redirect('Employee/emp_designation');
}

public function get_desg_data()
    {
    $section = $this->pm->get_desg_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_desg()
    {       
    $info = $this->input->post();
           
    $data = array(
        'dpt_id'    => $info['dpt_id'],
        'desg_name' => $info['designation'],
        'upby'      => $this->session->userdata('admin_id')
            );

    $where = array(
        'desg_id' => $info['desg_id']
            );

    $result = $this->pm->update_data('designation',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Employee designation update Successfully !</h4>
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
    redirect('Employee/emp_designation');
}

public function delete_designation($desg_id)
    {       
    $info = $this->input->post();
           
    $where = array(
        'desg_id' => $desg_id
            );

    $empd = $this->pm->get_data('employees',$where);
    $data['empd'] = $empd[0];

    if ($empd[0] == null)
        {
        $result = $this->pm->delete_data('designation',$where);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Employee designation delete Successfully !</h4>
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
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> All ready add this designation in employees !</h4>
            </div>'
                ];
        }

    $this->session->set_userdata($sdata);
    redirect('Employee/emp_designation');
}

public function sales_Man_Report()
    {
    $data = [
        'title' => 'Employee Report'
            ];

    $data['employee'] = $this->pm->get_data('employees',false);
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;
            }
        else if ($report == 'monthlyReports')
            {
            $month = $_GET['month'];
            $data['month'] = $month;
            $year = $_GET['year'];
            $data['year'] = $year;
    //var_dump($data['month']); exit();
            if($month == 01)
                {
                $name = 'January';
                }
            elseif ($month == 02)
                {
                $name = 'February';
                }
            elseif ($month == 03)
                {
                $name = 'March';
                }
            elseif ($month == 04)
                {
                $name = 'April';
                }
            elseif ($month == 05)
                {
                $name = 'May';
                }
            elseif ($month == 06)
                {
                $name = 'June';
                }
            elseif ($month == 07)
                {
                $name = 'July';
                }
            elseif ($month == 8)
                {
                $name = 'August';
                }
            elseif ($month == 9)
                {
                $name = 'September';
                }
            elseif ($month == 10)
                {
                $name = 'October';
                }
            elseif ($month == 11)
                {
                $name = 'November';
                }
            else
                {
                $name = 'December';
                }
            $data['name'] = $name;
            $data['report'] = $report;
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;
            }
        }

    $data['content'] = $this->load->view('employees/emp_reports',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function emp_product_sales_reports()
    {
    $data = [
        'title' => 'Employee Sales Report'
            ];

    $data['employee'] = $this->pm->get_data('employees',false);
    $data['product'] = $this->pm->get_data('products',false);
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $empid = $_GET['employeeID'];
            $data['empid'] = $empid;
            $data['report'] = $report;

            $where = array(
                'employeeID' => $_GET['employeeID']
                    );
            $other = array(
                'join' => 'left'
                    );
            $field = array(
                'employees' => 'employees.employeeName,employees.empaddress',
                'department' => 'department.dept_name'
                    );
            $join = array(
                'department' => 'department.dpt_id = employees.dpt_id'
                    );
            $customer = $this->pm->get_data('employees',$where,$field,$join,$other);
            $data['emp'] = $customer[0];
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $empid = $_GET['yemployeeID'];
            $data['year'] = $year;
            $data['empid'] = $empid;
            $data['report'] = $report;

            $where = array(
                'employeeID' => $_GET['yemployeeID']
                    );
            $other = array(
                'join' => 'left'
                    );
            $field = array(
                'employees' => 'employees.employeeName,employees.empaddress',
                'department' => 'department.dept_name'
                    );
            $join = array(
                'department' => 'department.dpt_id = employees.dpt_id'
                    );
            $customer = $this->pm->get_data('employees',$where,$field,$join,$other);
            $data['emp'] = $customer[0];
            }
        }

    $data['content'] = $this->load->view('employees/emp_sproducts_reports',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function emp_sales_reports()
    {
    $data = [
        'title' => 'Employee Sales Report'
            ];

    $data['employee'] = $this->pm->get_data('employees',false);
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $id = $_GET['demp'];
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;

            $where = array(
                'employeeID' => $id
                    );
            $employees = $this->pm->get_data('employees',$where);
            $data['empl'] = $employees[0];

            $data['sale'] = $this->pm->get_demp_sales_data($id,$sdate,$edate);
            }
        else if ($report == 'monthlyReports')
            {
            $id = $_GET['memp'];
            $month = $_GET['month'];
            $data['month'] = $month;
            $year = $_GET['year'];
            $data['year'] = $year;
    //var_dump($data['month']); exit();
            if($month == 01)
                {
                $name = 'January';
                }
            elseif ($month == 02)
                {
                $name = 'February';
                }
            elseif ($month == 03)
                {
                $name = 'March';
                }
            elseif ($month == 04)
                {
                $name = 'April';
                }
            elseif ($month == 05)
                {
                $name = 'May';
                }
            elseif ($month == 06)
                {
                $name = 'June';
                }
            elseif ($month == 07)
                {
                $name = 'July';
                }
            elseif ($month == 8)
                {
                $name = 'August';
                }
            elseif ($month == 9)
                {
                $name = 'September';
                }
            elseif ($month == 10)
                {
                $name = 'October';
                }
            elseif ($month == 11)
                {
                $name = 'November';
                }
            else
                {
                $name = 'December';
                }
            $data['name'] = $name;
            $data['report'] = $report;

            $where = array(
                'employeeID' => $id
                    );

            $employees = $this->pm->get_data('employees',$where);
            $data['empl'] = $employees[0];

            $data['sale'] = $this->pm->get_memp_sales_data($id,$month,$year);
            }
        else if ($report == 'yearlyReports')
            {
            $id = $_GET['yemp'];
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $where = array(
                'employeeID' => $id
                    );

            $employees = $this->pm->get_data('employees',$where);
            $data['empl'] = $employees[0];

            $data['sale'] = $this->pm->get_yemp_sales_data($id,$year);
            }
        }

    $data['content'] = $this->load->view('employees/emp_Sreports',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}






}
