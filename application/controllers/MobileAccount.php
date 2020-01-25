<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MobileAccount extends  CI_Controller {

public function __construct()
    {
    parent::__construct();        
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Mobile Transaction';
  
    $data['maccount'] = $this->pm->get_data('mobileaccount',false);
//var_dump($data['maccount']); exit();
    $data['content'] = $this->load->view('mobileaccount/mobileAccountList',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function get_mobile_trans()
    {
    $grup = $this->pm->get_mobile_transaction($_POST['id']);
    $someJSON = json_encode($grup);
    echo $someJSON;
}

public function SaveMobileAccount()
    {
    $table = 'mobileaccount';
    $info = $this->input->post();
    
    if ($this->input->post('mobileAccountId'))
        {
        $mobileAccountId = $info['mobileAccountId'];
        unset($info['mysubmit']);
        unset($info['mobileAccountId']);
        $where = array(
            'mobileAccountId' => $mobileAccountId
                );
        $update = $this->pm->update_data($table, $info, $where);
        if ($update)
            {
            $this->session->set_flashdata('msg', 'Successfully Updated Mobile Account');
            redirect('MobileAccount');
            }
        }
    else
        {
        unset($info['mysubmit']);
        $insert = $this->pm->insert_data($table, $info);
        
        if ($insert)
            {
            $this->session->set_flashdata('msg', 'Successfully Inserted Mobile Account');
            redirect('MobileAccount');
            }
        }
}

public function mobile_account_delete($id)
    {
    $where = array(
        'mobileAccountId' => $id
            );

    $cost_id = $this->pm->delete_data('mobileaccount',$where);
    if ($cost_id)
        {
        $this->session->set_flashdata('msg','Mobile Account Delete Successfully');
        }
    else
        {
        $this->session->set_flashdata('msg','Mobile Account no Delete!!! something wrong');
        }
    redirect('MobileAccount');
}






   
}