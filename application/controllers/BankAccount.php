<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BankAccount extends  CI_Controller {

public function __construct()
    {
    parent::__construct(); 
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Bank Transaction';    

    $data['bankAccountList'] = $this->pm->get_data('bankaccount',false);

    $data['content'] = $this->load->view('bankaccount/bankAccountList',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function get_bank_trans()
    {
    $grup = $this->pm->get_bank_account($_POST['id']);
    $someJSON = json_encode($grup);
    echo $someJSON;
}

public function SaveBankAccount()
    {
    $table = 'bankaccount';
    $info = $this->input->post();
    if ($this->input->post('bankAccountId')) {
        $bankAccountId = $info['bankAccountId'];
        unset($info['mysubmit']);
        unset($info['bankAccountId']);
        $where = array(
            'bankAccountId' => $bankAccountId
        );
        $update = $this->pm->update_data($table, $info, $where);
        if ($update) {
            $this->session->set_flashdata('msg', 'Successfully Updated Bank Account');
            redirect('BankAccount');
        }
    } else {
        unset($info['mysubmit']);
        $insert = $this->pm->insert_data($table, $info);
        if ($insert) {
            $this->session->set_flashdata('msg', 'Successfully Inserted Bank Account');
            redirect('BankAccount');
        }
    }
}

public function bank_account_delete($id)
    {
    $where = array(
        'bankAccountId' => $id
            );

    $cost_id = $this->pm->delete_data('bankaccount',$where);
    if ($cost_id)
        {
        $this->session->set_flashdata('msg','Bank Account Delete Successfully');
        }
    else
        {
        $this->session->set_flashdata('msg','Bank Account no inserted!!! something wrong');
        }
    redirect('BankAccount');
}






}