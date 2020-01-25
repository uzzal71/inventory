<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cost extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Expense Type';

    $data['cost'] = $this->pm->get_data('cost_type',false);

    $data['content'] = $this->load->view('costs/costTypes',$data,true);
    $this->load->view('themes/adminlte', $data);
}

public function save_expense_type()
    {
    $info = $this->input->post();

    $data = array(
        'costName' => $info['expensetName'],
        'status'   => $info['status'],            
        'regby'    => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('cost_type',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Expense Type add Successfully !</h4>
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
    redirect('Cost');
}

public function get_Cost_Type_data()
    {
    $section = $this->pm->get_cost_type_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_cost_type()
    {
    $info = $this->input->post();

    $data = array(
        'costName' => $info['expensetName'],
        'status'   => $info['status'],             
        'upby'     => $this->session->userdata('admin_id')
            );

    $where = array(
        'costTypeId' => $info['cat_id']
            );

    $result = $this->pm->update_data('cost_type',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Expense Type update Successfully !</h4>
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
    redirect('Cost');
}

public function cost_type_delete($id)
    {
    $where = array(
        'costType' => $id
            );
    $empu = $this->pm->get_data('vaucher',$where);
    $data['empu'] = $empu[0];

    if ($empu[0] == null)
        {

        $cwhere = array(
            'costTypeId' => $id
                );

        $result = $this->pm->delete_data('cost_type',$cwhere);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Expense Type delete Successfully !</h4>
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
            <h4><i class="icon fa fa-ban"></i> All ready add this Expense Type !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Cost');
}

public function company_profile()
    {
    $data['title'] = 'Company Profile';
        
    $data['content'] = $this->load->view('company_profile',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

private function set_upload_options()
    {   
    $new_file_name = uniqid() .$_FILES['userfile']['name']; // unique name of every file 
    // echo $new_file_name;exit();
    $config = array();
    $config['upload_path'] = './upload/company/';
    $config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG';
    $config['max_size'] = '0'; // 0 = no file size limit
    $config['max_width']  = '0';
    $config['max_height']  = '0';
    $config['encrypt_name']  = FALSE; //true if encrypted name is required
    $config['overwrite']     = FALSE;
    $config['file_name'] = $new_file_name;
    return $config;
}

public function save_company_profile()
    {
    $this->load->library('upload');
    $this->load->helper('path');
    $this->load->helper('url');

    $files = $_FILES;

    $f=$this->upload->initialize($this->set_upload_options());   

    if($this->upload->do_upload()== false)
        {
        $img = $this->db->select('com_pid,com_logo')->from('com_profile')->where('com_pid',1)->get()->row();

        $info = [
            'com_name'    => $this->input->post('com_name'),
            'com_address' => $this->input->post('com_address'),
            'com_mobile'  => $this->input->post('com_mobile'),
            'com_email'   => $this->input->post('com_email'),
            'com_web'     => $this->input->post('com_web'),
            'regby'       => $this->session->userdata('admin_id'),
            'com_logo'    => $img->com_logo
                ];
//var_dump($info); exit();

        unset($info['mysubmit']);
        if ($img->com_pid == null)
            {
            $this->pm->insert_data('com_profile', $info);
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Company Profile Add Successfully !</h4>
                </div>'
                    ];
            }
        else{
            $where = array(
            'com_pid' => $img->com_pid
                );
            $this->pm->update_data('com_profile', $info, $where);
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Company Profile update Successfully !</h4>
                </div>'
                    ];
            }
        $this->session->set_userdata($sdata);
        redirect('profile');
        }
    else
        { 
        $data = $this->upload->data();
        $fn = $data['file_name'];
        $path = $_SERVER['DOCUMENT_ROOT'];  

        $path2 = set_realpath('/upload/company/').$fn;

        $info = [
            'com_name'    => $this->input->post('com_name'),
            'com_address' => $this->input->post('com_address'),
            'com_mobile'  => $this->input->post('com_mobile'),
            'com_email'   => $this->input->post('com_email'),
            'com_web'     => $this->input->post('com_web'),
            'regby'       => $this->session->userdata('admin_id'),
            'com_logo'    => $path2
                ];
//var_dump($info); exit();

        unset($info['mysubmit']);
        $cimg = $this->db->select('com_pid')->from('com_profile')->where('com_pid',1)->get()->row();

        if ($cimg->com_pid == null)
            {
            $this->pm->insert_data('com_profile', $info);
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Company Profile Add Successfully !</h4>
                </div>'
                    ];
            }
        else{
            $where = array(
            'com_pid' => $cimg->com_pid
                );
            $this->pm->update_data('com_profile', $info, $where);
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Company Profile update Successfully !</h4>
                </div>'
                    ];
            }
        $this->session->set_userdata($sdata);
        redirect('profile');
        }
}








}