<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotation extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Quotation';

    $other = array(
        'order_by' => 'qutid'
            );
    $field = array(
        'quotation' => 'quotation.*',
        'customers'=>'customers.*'
            );
    $join = array(
        'customers' => 'customers.customerID = quotation.customerID'
            );
    
    $data['quotation'] = $this->pm->get_data('quotation',false,$field,$join,$other);
//var_dump($data['purchase']); exit();
    $data['content'] = $this->load->view('quotation/quotationlist',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function new_quotation() 
    {
    $data['title'] = 'Quotation';

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);

    $data['content'] = $this->load->view('quotation/newQuotation',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function getProductOnSupplier($id)
    {
    $where = array(
        'productID' => $id
            );

    $productlist = $this->pm->get_data('products',$where);

    $str = "";
    foreach ($productlist as $value) {
        $id = $value['productID'];
        $str .= "<tr>
        <td>".$value['productName']."<input type='hidden' readonly='readonly' name='product_id[]' value='".$value['productID']."'></td>
        <td><input type='text' id='quantity_".$value['productID']."' onkeyup='getTotal(".$id.")' name='quantity[]' value='00'></td>
        <td>".$value['sprice']."<input type='hidden' onkeyup='getTotal(".$id.")' id='tp_".$value['productID']."' name='tp[]' value='".$value['sprice']."'></td>
        <td><input readonly='readonly' type='text' id='totalPrice_".$value['productID']."' name='total_price[]' value='0.00' readonly></td>
        <td><input type='button' class='btn btn-danger' value='remove' onClick='$(this).parent().parent().remove();''></td>";
    }
    echo json_encode($str);
}

public function save_quotation()
    {
    $info = $this->input->post();

    $quotation = array(
        'quotationDate' => date('Y-m-d',strtotime($info['date'])),
        'customerID'    => $info['customer'],
        'totalPrice'    => $info['totalPrice'],
        'totalQuantity' => array_sum($info['quantity']),
        'note'          => $info['note'],
        'regby'         => $this->session->userdata('admin_id')
            );
//var_dump($quotation); exit();
    $result = $this->pm->insert_data('quotation',$quotation);
//var_dump($purchase_id); exit();
    if ($result)
        {
        $length = count($this->input->post('product_id'));
        
        for ($i = 0; $i < $length; $i++)
            {
            if($this->input->post('quantity')[$i] > 0):
            
            $quotation_product = array(
                'qutid'      => $result,
                'productID'  => $this->input->post('product_id')[$i],
                'salePrice'  => $this->input->post('tp')[$i],
                'quantity'   => $this->input->post('quantity')[$i],                 
                'totalPrice' => $this->input->post('total_price')[$i],
                'regby'      => $this->session->userdata('admin_id')
                    );
    //var_dump($purchase_product);            
            $qut_product_id = $this->pm->insert_data('quotation_product',$quotation_product);             
            endif;
            }
        }
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Quotation add Successfully !</h4>
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
    redirect('Quotation');
}

public function view_quotation($id)
    {
    $data['title'] = 'Quotation';

    $where = array(
        'qutid' => $id
            );
    $join = array(
        'products' => 'products.productID = quotation_product.productID'
            );
    $data['pquotation'] = $this->pm->get_data('quotation_product',$where,false,$join);
    
    $field = array(
        'quotation' => 'quotation.*',
        'customers'=>'customers.*'
            );
    $join = array(
        'customers' => 'customers.customerID = quotation.customerID'
            );
    $quotation = $this->pm->get_data('quotation',$where,$field,$join);

    $data['quotation'] = $quotation[0];    
    
    $data['company'] = $this->pm->company_details();
    
    $data['content'] = $this->load->view('quotation/viewquotation',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function edit_quotation($id)
    {
    $data['title'] = 'Quotation';

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);

    $where = array(
        'qutid' => $id
            );
    $join = array(
        'products' => 'products.productID = quotation_product.productID'
            );
    $data['pquotation'] = $this->pm->get_data('quotation_product',$where,false,$join);

    $quotation = $this->pm->get_data('quotation',$where);
    $data['quotation'] = $quotation[0];    
    
    $data['content'] = $this->load->view('quotation/editquotation',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function update_Quotation()
    {
    $info = $this->input->post();

    $where = array(
        'qutid' => $info['qutid']
            );

    $quotation = array(
        'quotationDate' => date('Y-m-d',strtotime($info['date'])),
        'customerID'    => $info['customer'],
        'totalPrice'    => $info['totalPrice'],
        'totalQuantity' => array_sum($info['quantity']),
        'note'          => $info['note'],
        'upby'          => $this->session->userdata('admin_id')
            );

    $result = $this->pm->update_data('quotation',$quotation,$where);

    $this->pm->delete_data('quotation_product',$where);
    
    $length = count($this->input->post('product_id'));

    for ($i = 0; $i < $length; $i++) {

         $quotation_product = array(
            'qutid'      => $info['qutid'],
            'productID'  => $this->input->post('product_id')[$i],
            'salePrice'  => $this->input->post('tp')[$i],
            'quantity'   => $this->input->post('quantity')[$i],                 
            'totalPrice' => $this->input->post('total_price')[$i],
            'regby'      => $this->session->userdata('admin_id')
                );
    //var_dump($quotation_product); exit();
        $qp = $this->pm->insert_data('quotation_product', $quotation_product);
        }
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Quotation update Successfully !</h4>
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
    redirect('Quotation');
}

public function delete_quotation($id)
    {
    $where = array(
        'qutid' => $id
            );

    $result = $this->pm->delete_data('quotation',$where);
    $this->pm->delete_data('quotation_product',$where);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Quotation delete Successfully !</h4>
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
    redirect('Quotation');
}




  



}