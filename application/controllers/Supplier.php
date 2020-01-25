<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->load->model("Supplier_model","supplier");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Supplier';
    $data['suppliers'] = $this->supplier->get_supplier();
    $data['content'] = $this->load->view('suppliers/suppliers',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function save_supplier()
    {
    $info = $this->input->post();

    $data = array(
        'supplierName' => $info['supplierName'],
        'compname'     => $info['compname'],
        'company'      => $_SESSION['company'],
        'mobile'       => $info['mobile'],
        'email'        => $info['email'],
        'address'      => $info['address'],
        'balance'      => $info['balance'],            
        'regby'        => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('suppliers',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Supplier add Successfully !</h4>
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
    redirect('Supplier');
}

public function get_supplier_data()
    {
    $section = $this->pm->get_supplier_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_supplier()
    {
    $info = $this->input->post();

    $data = array(
        'supplierName' => $info['supplierName'],
        'compname'     => $info['compname'],
        'company'      => $info['company'],
        'mobile'       => $info['mobile'],
        'email'        => $info['email'],
        'address'      => $info['address'],
        'balance'      => $info['balance'],            
        'upby'         => $this->session->userdata('admin_id')
            );

    $where = array(
        'supplierID' => $info['sup_id']
            );

    $result = $this->pm->update_data('suppliers',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Supplier update Successfully !</h4>
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
    redirect('Supplier');
}

public function delete_supplier($id)
    {
    $where = array(
        'supplierID' => $id
            );

    $result = $this->pm->delete_data('suppliers',$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Supplier delete Successfully !</h4>
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
    redirect('Supplier');
}

public function supplier_report()
    {
    $data = [
        'title' => 'Supplier Reports'
            ];

    $data['supplier'] = $this->pm->get_data('suppliers',false);
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

    $data['content'] = $this->load->view('suppliers/supplier_report', $data, TRUE);
    $this->load->view('themes/adminlte',$data);
}

//add_supplier
public function add_supplier() {
    $data = array();
    $data['supplierName'] = $_POST['supplierName'];
    $data['compname'] = $_POST['compname'];
    $data['mobile'] = $_POST['mobile'];
    $data['address'] = $_POST['address'];
    $data['balance'] = $_POST['balance'];
    $data['email'] = $_POST['email'];
    $data['regby'] = $this->session->userdata('admin_id');
    $result = $this->pm->supplier_add($data);
    if($result) {
        //echo "Category Successfully!";
        $suppliers = $this->pm->get_data('suppliers',false);
        $append = '<div id="supplier_hide"><label>Supplier *</label>
                    <select name="suppliers" class="form-control chosen" required >
                    <option value="">Select One</option>
                    ';
        foreach($suppliers as $value) {
            $append .= '<option value=" '.$value['supplierID'] .' ">'.$value['supplierID'].' ( '.$value['supplierName'].' )'.'</option>';
        }
        $append .= ' </select></div>';
        echo $append;
    }else{
        echo "Supplier Added Failed!";
    }
}






}