<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->load->model("Purchase_model","purchase");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Purchase';

    // $join = array(
    //     'suppliers' => 'suppliers.supplierID = purchase.supplier',
    //     'companys' => 'companys.companyID = purchase.company'
    //         );
    // $other = array(
    //     'order_by'=>'purchaseID'
    //         );
    // $field = array(
    //     'purchase' => 'purchase.*',
    //     'suppliers' => 'suppliers.supplierName',
    //     'companys' => 'companys.companyName'
    //         );    
    $data['purchase'] = $this->purchase->get_purchase();

    $data['content'] = $this->load->view('purchase/purchaseList',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function newPurchase() 
    {
    $data['title'] = 'Purchase';

    $data['product'] = $this->pm->get_data('products',false);
    $data['supplier'] = $this->pm->get_data('suppliers',false);

    $data['content'] = $this->load->view('purchase/newPurchase',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function getProductOnSupplier($id)
    {
    $str = "";

    $where = array(
        'productID' => $id
            );

    $productlist = $this->pm->get_data('products',$where);
    foreach ($productlist as $value) {
        $id = $value['productID'];
        $str .= "<tr>
        <td>".$value['productName']."<input type='hidden' readonly='readonly' name='product_id[]' value='".$value['productID']."'></td>
        <td><input type='text' id='quantity_".$value['productID']."' onkeyup='getTotal(".$id.")' name='quantity[]' value='00'></td>
        <td>".$value['pprice']."<input type='hidden' onkeyup='getTotal(".$id.")' id='tp_".$value['productID']."' name='pprice[]' value='".$value['pprice']."'></td>
        <td><input readonly='readonly' type='text' id='totalPrice_" . $value['productID']."' name='total_price[]' value='0.00' readonly></td>
        <td><input type='button' class='btn btn-danger' value='remove' onClick='$(this).parent().parent().remove();''></td>";
    }
    echo json_encode($str);
}

public function getAccountNo()
    {
    $str = '';
    $where = array(
        'status' => 'Active'
            );

    $accountType = $this->input->post('id');
    
    if ($accountType == 'Bank')
        {
        $accounts = $this->pm->get_data('bankaccount',$where);
        if (count($accounts) == 0)
            {
            $str .= "<option value='0'>Please Add Bank account</option>";
            }
        else
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='".$value['bankAccountId']."'>".$value['bankName'].' '.$value['branchName'].' '.$value['accountNo'].' '.$value['accountName']."</option>";
                }
            }
        }
    else if ($accountType == 'Mobile')
        {
        $accounts = $this->pm->get_data('mobileaccount',$where);
        if(count($accounts) == 0)
            {
            $str .= "<option value='0'>Please Add mobile account</option>";
            }
        else
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='".$value['mobileAccountId']."'>".$value['accountName']. ' '.$value['accountNo']."</option>";
                }
            }
        }
    else if($accountType == 'Cash')
        {
        $accounts = $this->pm->get_data('cash',$where);
        if (count($accounts) == 0)
            {
            $str .= "<option value='0'>Please Add cash account</option>";
            }
        else
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='".$value['cashId']."'>".$value['cashName']."</option>";
                }
            }
        }
    else
        {
        $str .= "<option >Please Select Account Type</option>";
        }
    echo json_encode($str);
}

public function savedPurchase()
    {
    $info = $this->input->post();

    $purchase = array(
        'purchaseDate'=> date('Y-m-d', strtotime($info['date'])),
        'challanNo'   => $info['challanNo'],
        'supplier'    => $info['suppliers'],
        'company'     => $_SESSION['company'],
        'totalPrice'  => $info['totalPrice'],
        'paidAmount'  => $info['Paid'],
        'accountType' => $info['accountType'],
        'accountNo'   => $info['accountNo'],
        'note'        => $info['note'],
        'regby'       => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('purchase',$purchase);

    $length = count($this->input->post('product_id'));
        
    for ($i = 0; $i < $length; $i++)
        {
        $purchase_product = array(
                'purchaseID' => $result,
                'productID'  => $info['product_id'][$i],
                'quantity'   => $info['quantity'][$i],
                'pprice'     => $info['pprice'][$i],                    
                'totalPrice' => $info['total_price'][$i],
                'createdBy'  => $this->session->userdata('admin_id')
                    );
    //var_dump($purchase_product);            
        $purchase_product = $this->pm->insert_data('purchase_product',$purchase_product); 

        $pid = $info['product_id'][$i];
        $aid = $_SESSION['company'];

        $swhere = array(
            'product' => $pid,
            'company' => $aid
                );

        $stpd = $this->pm->get_data('stock',$swhere);

        $this->pm->delete_data('stock',$swhere);

        if($stpd)
            {
            $tquantity = $info['quantity'][$i]+$stpd[0]['totalPices'];
            }
        else{
            $tquantity = $info['quantity'][$i];
            }

        $stock_info = array(
            'company'    => $_SESSION['company'],
            'product'    => $info['product_id'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => $info['challanNo'],
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
            <h4><i class="icon fa fa-check"></i>Purchase add Successfully !</h4>
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
    redirect('Purchase');
}

public function viewPurchase($id)
    {
    $data['title'] = 'Purchase';

    $pwhere = array(
        'purchaseID' => $id
            );
    $pfield = array(
        'purchase_product' => 'purchase_product.*',
        'products' => 'products.productName'
            );
    $pjoin = array(
        'products' => 'products.productID = purchase_product.productID'
            );
    $pother = array(
        'join' => 'left'
            );
    $data['purchesProducts'] = $this->pm->get_data('purchase_product',$pwhere,$pfield,$pjoin,$pother);

    $join = array(
        'suppliers' => 'purchase.supplier = suppliers.supplierID'
            );
    $field = array(
        'purchase' => 'purchase.*',
        'supplier' => 'suppliers.*'
            );
    $purchase = $this->pm->get_data('purchase',$pwhere,$field,$join,$pother);
    $data['purchase'] = $purchase[0];

    $sid = $purchase[0]['supplier'];
//var_dump($cusid); exit();
    $data['csdue'] = $this->pm->supplier_purchases_due_details($id,$sid);
    $data['cvpa'] = $this->pm->supplier_paid_details($sid);
    $data['company'] = $this->pm->company_details();
    
    $data['content'] = $this->load->view('purchase/viewPurchase',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function edit_purchases($id)
    {
    $data['title'] = 'Purchase';

    $pwhere = array(
        'purchaseID' => $id
            );
    $pfield = array(
        'purchase_product' => 'purchase_product.*',
        'products' => 'products.productName'
            );
    $pjoin = array(
        'products' => 'products.productID = purchase_product.productID'
            );
    $pother = array(
        'join' => 'left'
            );

    $data['purchesProducts'] = $this->pm->get_data('purchase_product',$pwhere,$pfield,$pjoin,$pother);

    $purchase = $this->pm->get_data('purchase',$pwhere);
    $data['purchase'] = $purchase[0];

    $data['product'] = $this->pm->get_data('products',false);
    $data['supplier'] = $this->pm->get_data('suppliers',false);
    
    $data['content'] = $this->load->view('purchase/editPurchase',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function updatePurchase()
    {
    $info = $this->input->post();

    $purchase = array(
        'purchaseDate' => date('Y-m-d', strtotime($info['date'])),
        'challanNo'    => $info['challanNo'],
        'supplier'     => $info['suppliers'],
        'company'      => $info['company'],
        'totalPrice'   => $info['totalPrice'],
        'paidAmount'   => $info['Paid'],
        'accountType'  => $info['accountType'],
        'accountNo'    => $info['accountNo'],
        'note'         => $info['note'],
        'upby'         => $this->session->userdata('admin_id')
            );

    $where = array(
        'purchaseID' => $info['purhcase_id']
            );

    $result = $this->pm->update_data('purchase',$purchase,$where);

    $pp = $this->pm->get_data('purchase_product',$where);
    $this->pm->delete_data('purchase_product',$where);

    $length = count($this->input->post('product_id'));
//var_dump($length); exit();
    for ($i = 0; $i < $length; $i++)
        {
        $purchase_product = array(
                'purchaseID' => $info['purhcase_id'],
                'productID'  => $info['product_id'][$i],
                'quantity'   => $info['quantity'][$i],
                'pprice'     => $info['pprice'][$i],                    
                'totalPrice' => $info['total_price'][$i],
                'createdBy'  => $this->session->userdata('admin_id')
                    );
    //var_dump($purchase_product);            
        $purchase_product = $this->pm->insert_data('purchase_product',$purchase_product); 

        $pid = $info['product_id'][$i];
        $aid = $info['company'];

        $swhere = array(
            'product' => $pid,
            'company' => $aid
                    );

        $stpd = $this->pm->get_data('stock',$swhere);

        $this->pm->delete_data('stock',$swhere);

        if($stpd)
            {
            if($pp)
                {
                $tquantity = ($info['quantity'][$i]+$stpd[0]['totalPices'])-$pp[0]['quantity'];
                }
            else
                {
                $tquantity = $info['quantity'][$i]+$stpd[0]['totalPices'];
                }
            }
        else{
            $tquantity = $info['quantity'][$i];
            }

        $stock_info = array(
            'company'    => $info['company'],
            'product'    => $info['product_id'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => $info['challanNo'],
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
            <h4><i class="icon fa fa-check"></i>Purchase update Successfully !</h4>
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
    redirect('Purchase');
}

public function delete_purchases($id)
    {
    $where = array(
        'purchaseID' => $id
            );

    $result = $this->pm->delete_data('purchase',$where);
    $this->pm->delete_data('purchase_product',$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Purchase delete Successfully !</h4>
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
    redirect('Purchase');
}

public function all_purchases_reports()
    {
    $data = [
        'title' => 'Purchase Reports',
        'company' => $this->pm->get_data('companys',false),
        'supplier' => $this->pm->get_data('suppliers',false)
            ];
    //$data['company'] = $this->pm->company_details();
    $data['company1'] = $this->pm->company_details();
    
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

            $company = $_GET['dcompany'];
            $supplier = $_GET['dsupplier'];

            $data['purchase'] = $this->pm->get_dall_purchses_data($sdate,$edate,$company,$supplier);
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

            $company = $_GET['mcompany'];
            $supplier = $_GET['msupplier'];

            $data['purchase'] = $this->pm->get_mall_purchses_data($month,$year,$company,$supplier);
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $company = $_GET['ycompany'];
            $supplier = $_GET['ysupplier'];

            $data['purchase'] = $this->pm->get_yall_purchses_data($year,$company,$supplier);
            }
        }
    else
        {
        $data['purchase'] = $this->pm->get_all_purchses_data();
        }

    $data['content'] = $this->load->view('purchase/purchase_reports',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}







}