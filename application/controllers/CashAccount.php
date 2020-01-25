<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CashAccount extends  CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Cash Transaction';

    $data['cashList'] = $this->pm->get_data('cash',false);

    $data['content'] = $this->load->view('cashaccount/cashAccountList',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function get_cash_account()
  {
  $grup = $this->pm->get_cash_account($_POST['id']);
  $someJSON = json_encode($grup);
  echo $someJSON;
}

public function SaveCashAccount()
    {
    $table = 'cash';
    $info = $this->input->post();
    
    if ($this->input->post('cashId'))
        {
        $cashId = $info['cashId'];
        unset($info['mysubmit']);
        unset($info['cashId']);
        $where = array(
            'cashId' => $cashId
                );
        $update = $this->pm->update_data($table, $info, $where);
        if ($update)
            {
            $this->session->set_flashdata('msg', 'Successfully Updated Cash Account');
            }
        }
    else
        {
        unset($info['mysubmit']);
        $insert = $this->pm->insert_data($table, $info);
        if ($insert)
            {
            $this->session->set_flashdata('msg', 'Successfully Inserted cash Account');
            }
        }
    redirect('CashAccount');
}

public function cash_account_delete($id)
    {
    $where = array(
        'cashId' => $id
            );

    $cost_id = $this->pm->delete_data('cash',$where);
    if ($cost_id)
        {
        $this->session->set_flashdata('msg','Cash Account Delete Successfully');
        }
    else
        {
        $this->session->set_flashdata('msg','Cash Account no inserted!!! something wrong');
        }
    redirect('CashAccount');
}




 
}