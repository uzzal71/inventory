<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Sale';
    
    $other = array(
        'join' => 'left',
        'order_by' => 'saleID'
            );
    $field = array(
        'sales' => 'sales.*',
        'customers' => 'customers.customerName',
        'employees' => 'employees.employeeName',
        'companys' => 'companys.companyName'
            );
    $join = array(
        'employees' => 'employees.employeeID = sales.empid',
        'customers' => 'customers.customerID = sales.customerID',
        'companys' => 'companys.companyID = sales.company'
            );
    $data['sales'] = $this->pm->get_data('sales',false,$field,$join,$other);

    $data['content'] = $this->load->view('sale/Sales',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function newSale()
    {
    $data['title'] = 'Sale';

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);

    $data['content'] = $this->load->view('sale/NewSale',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function getDetails()
    {
    $join = false;
    $other = false;
    $table = $this->input->post('table');
    $id = $this->input->post('id');
    //$id2 = $this->input->post('id2');
 
    if ($table == "products") 
        {
        $where = array(
            'productID' => $id
            //'company' => $id2
                );
        $join = array(
            'stock' => 'products.productID = stock.product'
                );
        $other = array(
            'join' => 'left'
                );
        }
    $products = $this->pm->get_data($table, $where, false, $join, $other);
    $str='';
    foreach($products as $value){
        $id = $value['productID'];
        $tpq = $value['totalPices'];
        $str.="<tr>
        <td>".$value['productcode']."-".$value['productName']."<input type='hidden' name='productName[]' value='".$value['productID']."'><input type='hidden' name='productID[]' value='".$value['productID']."'>
        </td>
        <td>".$tpq."<input type='hidden' readonly name='stockLimit[]' id='stockLimit' value='".$tpq."'>
        </td>
        <td><input type='text'  name='packsize[]' id='packsize_".$value['productID']."' >
        </td>
        <td><input type='text' onkeyup='totalPrice(".$id.")' name='pices[]' id='pices_".$value['productID']."' value='0' max='$tpq' min='1'>
        </td>
        <td><input type='text'  name='bquantity[]' id='bquantity_".$value['productID']."' value='0' max='$tpq' >
        </td>
        <td>".$value['sprice']."<input type='hidden' onkeyup='totalPrice(".$id.")' name='salePrice[]' id='salePrice_".$value['productID']."' value='".$value['sprice']."'>
        </td>
        <td>
        <input type='text' class='totalPrice'  name='totalPrice[]' readonly id='totalPrice_".$value['productID']."' value='0'>
        </td>
        <td><input type='button' class='btn btn-danger' value='remove' onClick='$(this).parent().parent().remove();''></td>

        </tr>";
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
        $accounts = $this->pm->get_data('bankaccount', $where);
        if (count($accounts) == 0)
            {
            $str .= "<option value='0'>Please Add Bank account</option>";
            } 
        else 
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='" . $value['bankAccountId'] . "'>" . $value['bankName'] . ' ' . $value['branchName'] . ' ' . $value['accountNo'] . ' ' . $value['accountName'] . "</option>";
            }
        }
        } 
    else if ($accountType == 'Mobile')
        {
        $accounts = $this->pm->get_data('mobileaccount', $where);
        if (count($accounts) == 0) 
            {
            $str .= "<option value='0'>Please Add mobile account</option>";
            } 
        else 
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='" . $value['mobileAccountId'] . "'>" . $value['accountName'] . ' ' . $value['accountNo'] . "</option>";
                }
            }
        } 
    else if ($accountType == 'Cash') 
        {
        $accounts = $this->pm->get_data('cash', $where);
        if (count($accounts) == 0) 
            {
            $str .= "<option value='0'>Please Add cash account</option>";
            } 
        else 
            {
            foreach ($accounts as $key => $value) {
                $str .= "<option value='" . $value['cashId'] . "'>" . $value['cashName'] . "</option>";
                }
            }
        } 
    else 
        {
        $str .= "<option >Please account Type</option>";
        }
    echo json_encode($str);
}

public function savedSale()
    {
    $info = $this->input->post();
    
    $ex_amount = 0;
    $discounttype = '';
    $discount_symbol = '';
    
    if($info['discounttype'] == '%')
    {
        $disa = ($info['totalprice']*$info['discountamount'])/100;
        $ex_amount = ($info['totalprice']-($info['totalprice']*$info['discountamount']/100));
        $discounttype = '%';
        $discount_symbol = substr($info['discount'], 0, -1);
    }
    else{
        $disa = $info['discount'];
        $ex_amount = $info['totalprice'] - $info['discount'];
        $discounttype = '';
        $discount_symbol = $info['discount'];
    }

    $sale = array(
        'saleDate'       => date('Y-m-d',strtotime($info['date'])),
        'company'        => $info['company'],
        'empid'          => $_SESSION['empid'],
        'customerID'     => $info['customerID'],
        'totalAmount'    => $info['totalprice'],
        'paidAmount'     => $info['total_paid'],
        'discount'       => $discount_symbol,             
        'discountType'   => $discounttype,
        'discountAmount' => $disa,
        'accountType'    => $info['accountType'],
        'accountNo'      => $info['accountNo'],
        'note'           => $info['note'],             
        'regby'          => $this->session->userdata('admin_id')
    );

    $due_balance = $ex_amount - $sale['paidAmount'];
    $current_due = $this->pm->get_exist_balance($sale['customerID']);
    $balance = $current_due+$due_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $sale['customerID']);
    $this->db->update('customers', $data_array);

    $result = $this->pm->insert_data('sales',$sale);
       
    $length = count($info['productID']);

    for ($i = 0; $i < $length; $i++)
        {

        $sales_product = array(
            'saleID'     => $result,
            'productID'  => $info['productID'][$i],
            'packsize'  => $info['packsize'][$i],  
            'quantity'   => $info['pices'][$i]+$info['bquantity'][$i],
            'squantity'  => $info['pices'][$i],
            'bquantity'  => $info['bquantity'][$i],
            'sprice'     => $info['salePrice'][$i],
            'totalPrice' => $info['totalPrice'][$i],
            'bonusAmount'=> ($info['salePrice'][$i]*$info['bquantity'][$i]),
            'createdBy'  => $this->session->userdata('admin_id')
                );

        $sales_product = $this->pm->insert_data('sale_product',$sales_product);

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
            $tquantity = $stpd[0]['totalPices']-($info['pices'][$i]+$info['bquantity'][$i]);
            }
        else{
            $tquantity = -''.($info['pices'][$i]+$info['bquantity'][$i]);
            }

        $stock_info = array(
            'company'    => $info['company'],
            'product'    => $info['productID'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => 'S001',
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
            <h4><i class="icon fa fa-check"></i>Product Sale Successfully !</h4>
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
    redirect('Sale');
}

public function view_invoice($id)
    {
    $data['title'] = 'Sale Invoice';

    $where = array(
        'saleID' => $id
            );
    $other = array(
        'join' => 'left'
            );
    $field = array(
        'sales' => 'sales.*',
        'customers' => 'customers.*',
        'employees' => 'employees.employeeName'
            );
    $join = array(
        'employees' => 'employees.employeeID = sales.empid',
        'customers' => 'customers.customerID = sales.customerID'
            );
    $prints = $this->pm->get_data('sales',$where,$field,$join,$other);
    $data['prints'] = $prints[0];

    $pfield = array(
        'sale_product' => 'sale_product.*',
        'products' => 'products.productName,products.productcode'
            );
    $pjoin = array(
        'products' => 'products.productID = sale_product.productID'
            );

    $data['salesp'] = $this->pm->get_data('sale_product',$where,$pfield,$pjoin,$other);
    
    $cusid = $prints[0]['customerID'];
//var_dump($cusid); exit();
    $data['csdue'] = $this->pm->customer_sales_due_details($id,$cusid);
    $data['cvpa'] = $this->pm->customer_vaucher_paid_details($cusid);
    $data['cpa'] = $this->pm->customer_vaucher_pay_details($cusid);
    $data['cra'] = $this->pm->customer_returns_details($cusid);
    $data['company'] = $this->pm->company_details();
    
    $data['content'] = $this->load->view('sale/print_page',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function editSale($id)
    {
    $data['title'] = 'Sale Edit';

    $where = array(
        'saleID' => $id
            );

    $prints = $this->pm->get_data('sales',$where);

    $data['sale'] = $prints[0];

    $other = array(
        'join' => 'left'
            );
    $pfield = array(
        'sale_product' => 'sale_product.*',
        'products' => 'products.productName,products.productcode'
            );
    $pjoin = array(
        'products' => 'products.productID = sale_product.productID'
            );

    $data['salesp'] = $this->pm->get_data('sale_product',$where,$pfield,$pjoin,$other);

    $data['customer'] = $this->pm->get_data('customers',false);
    $data['product'] = $this->pm->get_data('products',false);
    $data['company'] = $this->pm->get_data('companys',false);
    $data['employee'] = $this->pm->get_data('employees',false);

    $data['content'] = $this->load->view('sale/EditSale',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function updateSale()
    {
    $info = $this->input->post();
    
    if($info['discounttype'] == '%')
        {
        $disa = ($info['totalprice']*$info['discountamount'])/100;
        }
    else{
        $disa = $info['discount'];
        }

    $sale = array(
        'saleDate'       => date('Y-m-d', strtotime($info['date'])),
        'company'        => $info['company'],
        'empid'          => $info['employee'],
        'customerID'     => $info['customerID'],
        'totalAmount'    => $info['totalprice'],
        'paidAmount'     => $info['total_paid'],
        'discount'       => $info['discount'],             
        'discountType'   => $info['discounttype'],
        'discountAmount' => $disa,
        'accountType'    => $info['accountType'],
        'accountNo'      => $info['accountNo'],
        'note'           => $info['note'],             
        'upby'          => $this->session->userdata('admin_id')
    );

    $old_balance = $info['exists_due'];
    $new_balance = $sale['totalAmount'] - $sale['paidAmount'];
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

    $balance = $current_due-$due_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $sale['customerID']);
    $this->db->update('customers', $data_array);

    $where = array(
        'saleID' => $info['saleID']
            );
//var_dump($sale); exit();
    $result = $this->pm->update_data('sales',$sale,$where);

    $pp = $this->pm->get_data('sale_product',$where);
    $this->pm->delete_data('sale_product',$where);
       
    $length = count($info['productID']);

    for ($i = 0; $i < $length; $i++)
        {
        $sales_product = array(
            'saleID'     => $info['saleID'],
            'productID'  => $info['productID'][$i], 
            'packsize'  => $info['packsize'][$i],
            'quantity'   => $info['pices'][$i]+$info['bquantity'][$i],
            'squantity'  => $info['pices'][$i],
            'bquantity'  => $info['bquantity'][$i],
            'sprice'     => $info['salePrice'][$i],
            'totalPrice' => $info['totalPrice'][$i],
            'bonusAmount'=> ($info['salePrice'][$i]*$info['bquantity'][$i]),
            'updatedBy'  => $this->session->userdata('admin_id')
                );

        $sales_product = $this->pm->insert_data('sale_product',$sales_product);

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
                $tquantity = ($stpd[0]['totalPices']+$pp[0]['quantity'])-($info['pices'][$i]+$info['bquantity'][$i]);
                }
            else{
                $tquantity = $stpd[0]['totalPices']-($info['pices'][$i]+$info['bquantity'][$i]);
                }
            }
        else{
            $tquantity = -''.($info['pices'][$i]+$info['bquantity'][$i]);
            }

        $stock_info = array(
            'company'    => $info['company'],
            'product'    => $info['productID'][$i],
            'totalPices' => $tquantity,
            'chalanNo'   => 'S001',
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
            <h4><i class="icon fa fa-check"></i>Sale product update Successfully !</h4>
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
    redirect('Sale');
}

public function delete_sales($id)
    {
    $where = array(
        'saleID' => $id
    );

    $info = $this->pm->get_amount_and_employee_sale($id);

    $return_balance = $info->totalAmount - $info->paidAmount;
    $current_due = $this->pm->get_exist_balance($info->customerID);
    $balance = $current_due-$return_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $info->customerID);
    $this->db->update('customers', $data_array);

    $result = $this->pm->delete_data('sales',$where);
    $this->pm->delete_data('sale_product',$where);
    
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Sale product delete Successfully !</h4>
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
    redirect('Sale');
}

public function all_sales_reports()
    {
    $data = [
        'title' => 'Sales Report',
        'comp' => $this->pm->get_data('companys',false),
        'customer' => $this->pm->get_data('customers',false),
        'employee' => $this->pm->get_data('employees',false)
            ];
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

            $company = $_GET['dcompany'];
            $customer = $_GET['dcustomer'];
            $employee = $_GET['demployee'];

            $data['sales'] = $this->pm->get_dall_sales_data($sdate,$edate,$company,$customer,$employee);
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
            $customer = $_GET['mcustomer'];
            $employee = $_GET['memployee'];

            $data['sales'] = $this->pm->get_mall_sales_data($month,$year,$company,$customer,$employee);
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $company = $_GET['ycompany'];
            $customer = $_GET['ycustomer'];
            $employee = $_GET['yemployee'];

            $data['sales'] = $this->pm->get_yall_sales_data($year,$company,$customer,$employee);
            }
        }
    else
        {
        $data['sales'] = $this->pm->get_sales_data();
        }

    $data['content'] = $this->load->view('sale/all_sales',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}






}