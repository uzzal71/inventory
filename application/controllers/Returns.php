<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Returns extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Returns';
    
    $other = array(
        'join' => 'left',
        'order_by' => 'returnId'
            );
    $field = array(
        'returns' => 'returns.*',
        'customers' => 'customers.customerName',
        'employees' => 'employees.employeeName',
        'companys' => 'companys.companyName'
            );
    $join = array(
        'employees' => 'employees.employeeID = returns.empid',
        'customers' => 'customers.customerID = returns.customerID',
        'companys' => 'companys.companyID = returns.company'
            );

    $data['return'] = $this->pm->get_data('returns',false,$field,$join,$other);

    $data['content'] = $this->load->view('return/returns',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function new_return()
    {
    $data['title'] = 'Returns';

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);
    $data['company'] = $this->pm->get_data('companys',false);
    $data['employee'] = $this->pm->get_data('employees',false);

    $data['content'] = $this->load->view('return/newReturn',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function getDetails()
    {
    $join = false;
    $other = false;
    $table = $this->input->post('table');
    $id = $this->input->post('id');
 
    if ($table == "products") {
        $where = array('productID' => $id);
        }

    $products = $this->pm->get_data($table,$where,false,$join,$other);
    $str='';
    foreach($products as $value){
        $id=$value['productID'];
        $str.="<tr>
        <td>".$value['productcode']."-".$value['productName']."<input type='hidden' name='productName[]' value='".$value['productID']."'><input type='hidden' name='productID[]' value='".$value['productID']."'>
        </td>
        <td><input type='text' onkeyup='totalPrice(".$id.")' name='pices[]' id='pices_".$value['productID']."' value='0'>
        </td>
        <td>".$value['sprice']."<input type='hidden' onkeyup='totalPrice(".$id.")' name='salePrice[]' id='salePrice_".$value['productID']."' value='".$value['sprice']."'>
        </td>
        <td>
        <input type='text' class='totalPrice' name='totalPrice[]' readonly id='totalPrice_".$value['productID']."' value='0'>
        </td>
        <td><input type='button' class='btn btn-danger' value='Remove' onClick='$(this).parent().parent().remove();''></td>

        </tr>";
        }
    echo json_encode($str);
}

public function saveReturns()
    {
    $info = $this->input->post();

    if ($info['sctype'] == '%')
        {
        $amount = ($info['totalprice']*$info['scAmount'])/100;
        }
    else
        {
        $amount = $info['scharge'];
        }

    $sale = array(
        'returnDate' => date('Y-m-d', strtotime($info['date'])),
        'company'    => $_SESSION['company'],
        'empid'      => $_SESSION['empid'],
        'customerID' => $info['customerID'],
        'invoice'    => $info['invoice'],
        'totalPrice' => $info['totalprice'],
        'scharge'    => $info['scharge'],      
        'sctype'     => $info['sctype'],
        'scAmount'   => $amount,
        'accountType' => $info['accountType'],
        'accountNo'  => $info['accountNo'], 
        'note'       => $info['note'],          
        'regby'      => $this->session->userdata('admin_id')
    );

    $return_balance = $sale['totalPrice'];
    $current_due = $this->pm->get_exist_balance($sale['customerID']);
    $balance = $current_due-$return_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $sale['customerID']);
    $this->db->update('customers', $data_array);
    
    $result = $this->pm->insert_data('returns', $sale);
       
    $length = count($info['productID']);

    for ($i = 0;$i < $length;$i++)
        {
        $return_product = array(
            'rt_id'      => $result,
            'productID'  => $info['productID'][$i],
            'quantity'   => $info['pices'][$i],
            'salePrice'  => $info['salePrice'][$i],
            'totalPrice' => $info['totalPrice'][$i],
            'regby'      => $this->session->userdata('admin_id')
                );

        $rp_id = $this->pm->insert_data('returns_product',$return_product);

        $pid = $info['productID'][$i];
        $aid = $_SESSION['company'];

        $swhere = array(
            'product' => $pid,
            'company' => $aid
                    );

        $stpd = $this->pm->get_data('stock',$swhere);

        $this->pm->delete_data('stock',$swhere);

        if($stpd[0])
            {
            $tquantity = $info['pices'][$i]+$stpd[0]['totalPices'];
            }
        else{
            $tquantity = $info['pices'][$i];
            }

        $stock_info = array(
            'company'    => $_SESSION['company'],
            'product'    => $info['productID'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => 'R001',
            'status'     => 'Active',
            'created_by' => $this->session->userdata('admin_id')
                    );
    //var_dump($stock_info);    
        $this->pm->insert_data('stock',$stock_info); 
        }
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Products Returns add Successfully !</h4>
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
    redirect('Returns');
}

public function viewReturns($id)
    {
    $data['page_name'] = 'Returns View';

    $other = array(
        'join' => 'left'
            );

    $where = array(
        'returnId' => $id
            );

    $field = array(
        'returns' => 'returns.*',
        'customers' => 'customers.*',
        'employees' => 'employees.employeeName'
            );
    $join = array(
        'employees' => 'employees.employeeID = returns.empid',
        'customers' => 'customers.customerID = returns.customerID'
            );

    $returns = $this->pm->get_data('returns',$where,$field,$join,$other);
    $data['returns'] = $returns[0];


    $rwhere = array(
        'rt_id' => $id,            
            );
    $rfield = array(
        'returns_product' => 'returns_product.*',
        'products' => 'products.productName,products.productcode'
            );
    $rjoin = array(
        'products' => 'returns_product.productID = products.productID',
            );

    $data['rproduct']=$this->pm->get_data('returns_product',$rwhere,$rfield,$rjoin,$other);
    $data['company'] = $this->pm->company_details();

    $data['content'] = $this->load->view('return/viewReturns',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function editReturns($id)
    {
    $data['title'] = 'Returns Edit';    

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);
    $data['company'] = $this->pm->get_data('companys',false);
    $data['employee'] = $this->pm->get_data('employees',false);

    $swhere = array(
        'returnId' => $id
            );
    $sales = $this->pm->get_data('returns',$swhere);
    $data['returns'] = $sales[0];

    $where = array(
        'rt_id' => $id            
            );
    $field = array(
        'returns_product' => 'returns_product.*',
        'products' => 'products.productName,products.productcode'
            );
    $join = array(
        'products'=>'returns_product.productID = products.productID'
            );
    $other = array(
        'join'=>'left'
            );
    $data['rproduct'] = $this->pm->get_data('returns_product',$where,$field,$join,$other);

    $data['content'] = $this->load->view('return/editReturn',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function updateReturns()
    {
    $info = $this->input->post();

    if ($info['sctype'] == '%')
        {
        $amount = ($info['totalprice']*$info['scAmount'])/100;
        }
    else
        {
        $amount = $info['scharge'];
        }

    $sale = array(
        'returnDate' => date('Y-m-d', strtotime($info['date'])),
        'company'    => $info['company'],
        'empid'      => $info['employee'],
        'customerID' => $info['customer'],
        'invoice'    => $info['invoice'],
        'totalPrice' => $info['totalprice'],
        'scharge'    => $info['scharge'],      
        'sctype'     => $info['sctype'],
        'scAmount'   => $amount,
        'accountType' => $info['accountType'],
        'accountNo'  => $info['accountNo'], 
        'note'       => $info['note'],          
        'upby'       => $this->session->userdata('admin_id')
    );

    $old_balance = $info['exists_totalprice'];
    $new_balance = $sale['totalPrice'];

    $current_due = $this->pm->get_exist_balance($sale['customerID']);

    if($new_balance > $old_balance){
        $payment_balance = $new_balance - $old_balance;
        $balance = $current_due+$payment_balance;
    }else if($new_balance < $old_balance){
        $payment_balance = $old_balance - $new_balance;
        $balance = $current_due-$payment_balance;
    }else {
        $balance = $current_due;   
    }

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $sale['customerID']);
    $this->db->update('customers', $data_array);

    $where = array(
        'returnId' => $info['returnId']
            );

    $result = $this->pm->update_data('returns',$sale,$where);

    $rwhere = array(
        'rt_id' => $info['returnId']
            );

    $pp = $this->pm->get_data('returns_product',$rwhere);
    $this->pm->delete_data('returns_product',$rwhere);
       
    $length = count($info['productID']);
//var_dump($length); exit();
    for ($i = 0;$i < $length;$i++)
        {
        $return_product = array(
            'rt_id'      => $info['returnId'],
            'productID'  => $info['productID'][$i],
            'quantity'   => $info['pices'][$i],
            'salePrice'  => $info['salePrice'][$i],
            'totalPrice' => $info['totalPrice'][$i],
            'regby'      => $this->session->userdata('admin_id')
                );

        $rp_id = $this->pm->insert_data('returns_product',$return_product);

        $pid = $info['productID'][$i];
        $aid = $info['company'];

        $swhere = array(
            'product' => $pid,
            'company' => $aid
                    );

        $stpd = $this->pm->get_data('stock',$swhere);

        $this->pm->delete_data('stock',$swhere);

        if($stpd[0])
            {
            if($pp[0])
                {
                $tquantity = ($info['pices'][$i]+$stpd[0]['totalPices'])-$pp[0]['quantity'];
                }
            else
                {
                $tquantity = $info['pices'][$i]+$stpd[0]['totalPices'];
                }
            }
        else{
            $tquantity = $info['pices'][$i];
            }

        $stock_info = array(
            'company'    => $info['company'],
            'product'    => $info['productID'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => 'R001',
            'status'     => 'Active',
            'created_by' => $this->session->userdata('admin_id')
                    );
    //var_dump($stock_info);    
        $this->pm->insert_data('stock',$stock_info); 
        }
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Products Returns update Successfully !</h4>
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
    redirect('Returns');
}

public function deleteReturns($id)
    {
    $where = array(
        'returnId' => $id
            );

    $info = $this->pm->get_amount_and_employee_return($id);

    $return_balance = $info->totalPrice;
    $current_due = $this->pm->get_exist_balance($info->customerID);
    $balance = $current_due+$return_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $info->customerID);
    $this->db->update('customers', $data_array);

    $result = $this->pm->delete_data('returns',$where);

    $rwhere = array(
        'rt_id' => $id
            );
    $this->pm->delete_data('returns_product',$rwhere);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Products Returns delete Successfully !</h4>
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
    redirect('Returns');
}






}
