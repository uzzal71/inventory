<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prime_model extends CI_Model {

public function get_data($table, $where = false, $fields = false, $join_table = false, $other = false)
    {
        //pega os campos passados para o select
    if ($fields != false)
        {
        foreach ($fields as $coll => $value)
            {
            $this->db->select($value);
            }
        }
        //pega a tabela
    $this->db->from($table);
        // join table name and col on coz value
    if ($join_table != false)
        {
        if (is_array($other) && array_key_exists('join', $other))
            {
            foreach ($join_table as $coll => $value)
                {
                $this->db->join($coll, $value, $other['join']);
                }
            } 
        else
            {
            foreach ($join_table as $coll => $value)
                {
                $this->db->join($coll, $value);
                }
            }
        }
        // where col value as array
    if ($where != false)
        {
        $this->db->where($where);
        }
        // other value like order by, group by and limit for other array
    if ($other != false)
        {
        if (array_key_exists('or_where', $other))
            {
            $this->db->or_where($other['or_where']);
            }
        if (array_key_exists('order_by', $other))
            {
            $this->db->order_by($other['order_by'], 'desc');
            }
        if (array_key_exists('group_by', $other))
            {
            $this->db->group_by($other['group_by']);
            }
        if (array_key_exists('limit', $other))
            {
            if (array_key_exists('offset', $other))
                {
                $this->db->limit($other['limit'], $other['offset']);
                }
            else
                {
                $this->db->limit($other['limit']);
                }
            }

        if (array_key_exists('like', $other))
            {
            foreach ($other['like'] as $key => $value)
                {
                $this->db->like($key, $value);
                }
            }
        if (array_key_exists('or_like', $other))
            {
            foreach ($other['or_like'] as $key => $value)
                {
                $this->db->or_like($key, $value);
                }
            }
        }

    $query = $this->db->get();
        //return a result
    $result = $query->result_array();
        // print_r($this->db->last_query());
    return $result;
}

public function insert_data($table,$data)
    {
    $this->db->insert($table,$data);
    
    return $this->db->insert_id();
}

// get_exist_blance($data['customerID'])
public function get_exist_balance($id) {
    $query = $this->db->select('balance')
                      ->from('customers')
                      ->where('customerID', $id)
                      ->get()
                      ->row();
    return $query->balance;
}

public function update_data($table,$data = false,$where = false)
    {
    $this->db->update($table,$data,$where);
    
    return $this->db->affected_rows();
}

public function delete_data($table,$where)
    {
    $this->db->where($where);
    $this->db->delete($table);
    
    return $this->db->affected_rows();
}

public function count_all($tbl)
    {
    return $this->db->count_all($tbl);
}

public function all_query($sql)
    {
    return $result = $this->db->query($sql)->result_array();
}

public function get_supplier_data($id)
    {
    $query = $this->db->select('*')
                    ->from('suppliers')
                    ->where('supplierID',$id)
                    ->get()
                    ->row();
    return $query; 
}

public function get_customer_data($id)
    {
    $query = $this->db->select('*')
                    ->from('customers')
                    ->where('customerID',$id)
                    ->get()
                    ->row();
    return $query; 
}

public function get_designation_data($id)
    {
    $query = $this->db->select('*')
                    ->from('designation')
                    ->where('dpt_id',$id)
                    ->get()
                    ->result();
    return $query; 
}

public function get_emp_data($id)
    {
    $query = $this->db->select('employees.*,companys.companyID,companys.companyName')
                    ->from('employees')
                    ->join('companys','companys.companyID = employees.company','left')
                    ->where('employeeID',$id)
                    ->get()
                    ->row();
    return $query; 
}

public function get_dept_data($id)
    {
    $query = $this->db->select('*')
                    ->from('department')
                    ->where('dpt_id',$id)
                    ->get()
                    ->row();
    return $query; 
}

public function get_desg_data($id)
    {
    $query = $this->db->select('designation.*,department.*')
                    ->from('designation')
                    ->join('department','department.dpt_id = designation.dpt_id','left')
                    ->where('desg_id',$id)
                    ->get()
                    ->row();
    return $query; 
}

public function get_employee()
    {
    $emp = $this->db->select('empid')
          ->from('users')
          ->get()
          ->result_array();
    //var_dump($emp); exit();
    $emp_id = array_map (function($value){
    return $value['empid'];
    },$emp);
//var_dump($emp_id); exit();
    if ($emp_id == null) {
    $emp_id = 0;
    }

    return $this->db->select('employeeID,employeeName')
                ->from('employees')
                ->where_not_in('employeeID',$emp_id)
                ->get()
                ->result();
}

public function check_user_name($id)
    {
    $query = $this->db->select('*')
                  ->from('users')
                  ->where('user_name',$id)
                  ->get();

    $count_row = $query->num_rows();

    if($count_row == 0)
      {
      return 1;
      }
    else
      {
      return 0;
      }
}

public function get_user_data($id)
    {
    $query = $this->db->select('
                            users.*,
                            employees.employeeID,
                            employees.employeeName,
                            access_lavels.accessLavelId,
                            access_lavels.lavelName')
                  ->from('users')
                  ->join('employees','employees.employeeID = users.empid','left')
                  ->join('access_lavels','access_lavels.accessLavelId = users.role','left')
                  ->where('user_id',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_category_data($id)
    {
    $query = $this->db->select('*')
                  ->from('categories')
                  ->where('categoryID',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_unit_data($id)
    {
    $query = $this->db->select('*')
                  ->from('sma_units')
                  ->where('id',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_brands_data($id)
    {
    $query = $this->db->select('*')
                  ->from('product_brands')
                  ->where('id',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_user_role_data($id)
    {
    $query = $this->db->select('*')
                  ->from('access_lavels')
                  ->where('accessLavelId',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_bank_account($id)
    {
    $query = $this->db->select('*')
                  ->from('bankaccount')
                  ->where('bankAccountId',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_cash_account($id)
    {
    $query = $this->db->select('*')
                  ->from('cash')
                  ->where('cashId',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_mobile_transaction($id)
    {
    $query = $this->db->select('*')
                  ->from('mobileaccount')
                  ->where('mobileAccountId',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_company_data($id)
    {
    $query = $this->db->select('*')
                  ->from('companys')
                  ->where('companyID',$id)
                  ->get()
                  ->row();
    return $query;
}

public function get_salary_emp($id,$id2)
  {
  $emp = $this->db->select('empid')
                ->from('employee_payment')
                ->where('year',$id)
                ->where('month',$id2)
                //->where('company',$id3)
                ->get()
                ->result_array();
  //var_dump($emp); exit();
  $emp_id = array_map (function($value){
    return $value['empid'];
    },$emp);

  if ($emp_id == null) {
    $emp_id = 0;
  }

  $emps = $this->db->select('
                    employees.employeeID,
                    employees.employeeName,
                    employees.dpt_id,
                    employees.desg_id,
                    employees.joiningDate,
                    employees.company,
                    employees.salary,
                    department.dpt_id,
                    department.dept_name,
                    designation.desg_id,
                    designation.desg_name')
                ->from('employees')
                ->join('department','department.dpt_id = employees.dpt_id','left')
                ->join('designation','designation.desg_id = employees.desg_id','left')
                ->where_not_in('employees.employeeID',$emp_id)
                //->where('employees.company',$id3)
                ->group_by('employeeID')
                ->get()
                ->result();
  return $emps;
}

public function company_details()
    {
    $query = $this->db->select('*')
                ->from('com_profile')
                ->where('com_pid',1)
                ->get()
                ->row();
    return $query;  
}

public function get_voucher($id)
    {
    $query = $this->db->select('
                            vaucher.*,
                            customers.customerID,
                            customers.customerName,
                            customers.compname,
                            customers.mobile as cmobile,
                            customers.address as caddress,
                            suppliers.supplierID,
                            suppliers.supplierName,
                            suppliers.mobile as smobile,
                            suppliers.address as saddress,
                            employees.employeeID,
                            employees.employeeName,
                            employees.phone,
                            cost_type.costTypeId,
                            cost_type.costName')
                    ->from('vaucher')
                    ->join('customers','customers.customerID = vaucher.customerId','left')
                    ->join('employees','employees.employeeID = vaucher.employee','left')
                    ->join('suppliers','suppliers.supplierID = vaucher.supplier','left')
                    ->join('cost_type','cost_type.costTypeId = vaucher.costType','left')
                    ->where('vaucher.vuid',$id)
                    ->get()
                    ->row();
    return $query;  
}

public function get_sales_data()
    {
    $query = $this->db->select('
                            sales.*,
                            customers.customerID,
                            customers.customerName,
                            employees.employeeID,
                            employees.employeeName,
                            companys.companyID,
                            companys.companyName')
                    ->from('sales')
                    ->join('customers','customers.customerID = sales.customerID','left')
                    ->join('employees','employees.employeeID = sales.empid','left')
                    ->join('companys','companys.companyID = sales.company','left')
                    ->get()
                    ->result();
    return $query;  
}

public function get_dall_sales_data($sdate,$edate,$company,$customer,$employee)
    {
    if ($company == 'All' && $customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.company',$company)
                        ->get()
                        ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.company',$company)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('sales.saleDate >=',$sdate)
                        ->where('sales.saleDate <=',$edate)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_mall_sales_data($month,$year,$company,$customer,$employee)
    {
    if ($company == 'All' && $customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->get()
                        ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('MONTH(saleDate)',$month)
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_yall_sales_data($year,$company,$customer,$employee)
    {
    if ($company == 'All' && $customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($company == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All' && $employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->get()
                        ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($customer == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    else if ($employee == 'All')
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select('
                                sales.*,
                                customers.customerID,
                                customers.customerName,
                                employees.employeeID,
                                employees.employeeName,
                                companys.companyID,
                                companys.companyName')
                        ->from('sales')
                        ->join('customers','customers.customerID = sales.customerID','left')
                        ->join('employees','employees.employeeID = sales.empid','left')
                        ->join('companys','companys.companyID = sales.company','left')
                        ->where('YEAR(saleDate)',$year)
                        ->where('sales.company',$company)
                        ->where('sales.customerID',$customer)
                        ->where('sales.empid',$employee)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_all_purchses_data()
    {
    $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->get()
                    ->result();
    return $query;
}

public function get_dall_purchses_data($sdate,$edate,$company,$supplier)
    {
    if ($company == 'All' && $supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('purchase.purchaseDate >=',$sdate)
                    ->where('purchase.purchaseDate <=',$edate)
                    ->get()
                    ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('purchase.purchaseDate >=',$sdate)
                    ->where('purchase.purchaseDate <=',$edate)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();

        }
    else if ($supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('purchase.purchaseDate >=',$sdate)
                    ->where('purchase.purchaseDate <=',$edate)
                    ->where('purchase.company',$company)
                    ->get()
                    ->result();
        }
    else
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('purchase.purchaseDate >=',$sdate)
                    ->where('purchase.purchaseDate <=',$edate)
                    ->where('purchase.company',$company)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();
        }
    return $query;  
}

public function get_mall_purchses_data($month,$year,$company,$supplier)
    {
    if ($company == 'All' && $supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();

        }
    else if ($supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.company',$company)
                    ->get()
                    ->result();
        }
    else
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.company',$company)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();
        }
    return $query;  
}

public function get_yall_purchses_data($year,$company,$supplier)
    {
    if ($company == 'All' && $supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->result();
        }
    else if ($company == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();

        }
    else if ($supplier == 'All')
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.company',$company)
                    ->get()
                    ->result();
        }
    else
        {
        $query = $this->db->select('
                            purchase.*,
                            companys.companyID,
                            companys.companyName,
                            suppliers.supplierID,
                            suppliers.supplierName')
                    ->from('purchase')
                    ->join('suppliers','suppliers.supplierID = purchase.supplier','left')
                    ->join('companys','companys.companyID = purchase.company','left')
                    ->where('YEAR(purchaseDate)',$year)
                    ->where('purchase.company',$company)
                    ->where('purchase.supplier',$supplier)
                    ->get()
                    ->result();
        }
    return $query;  
}

public function customer_sales_due_details($id,$cusid)
    {
    $query = $this->db->select("
                        SUM(`totalAmount`) as total,
                        SUM(`paidAmount`) as ptotal,
                        SUM(`discountAmount`) as tda")
                    ->FROM('sales')
                    ->where_not_in('saleID',$id)
                    ->WHERE('customerID',$cusid)
                    ->get()
                    ->row();
    return $query;  
}

public function customer_vaucher_paid_details($cusid)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$cusid)
                    ->where('vauchertype','Credit Voucher')
                    ->get()
                    ->row();
    return $query; 
}

public function customer_vaucher_pay_details($cusid)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$cusid)
                    ->where('vauchertype','Customer Pay')
                    ->get()
                    ->row();
    return $query; 
}

public function customer_returns_details($cusid)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$cusid)
                    ->get()
                    ->row();
    return $query; 
}

public function total_purchase_amount()
    {
    $query = $this->db->select("SUM(`totalPrice`) as total")
                    ->FROM('purchase')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_sale_amount()
    {
    $query = $this->db->select("
                        SUM(`totalAmount`) as total,
                        SUM(`discountAmount`) as tda")
                    ->FROM('sales')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_bank_amount()
    {
    $query = $this->db->select("SUM(`balance`) as total")
                    ->FROM('bankaccount')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_pbank_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    ->where('accountType','Bank')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_sbank_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    ->where('accountType','Bank')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_rbank_amount()
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as totalsca")
                    ->FROM('returns')
                    ->where('accountType','Bank')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cvbank_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Bank')
                    ->where('vauchertype','Credit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_dvbank_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Bank')
                    ->where('vauchertype','Debit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_spvbank_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Bank')
                    ->where('vauchertype','Supplier Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cpvbank_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Bank')
                    ->where('vauchertype','Customer Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_empbank_amount()
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->from('employee_payment')
                    ->where('accountType','Bank')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cash_amount()
    {
    $query = $this->db->select("SUM(`balance`) as total")
                    ->FROM('cash')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_pcash_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    ->where('accountType','Cash')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_scash_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    ->where('accountType','Cash')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_rcash_amount()
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as totalsca")
                    ->FROM('returns')
                    ->where('accountType','Cash')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cvcash_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Cash')
                    ->where('vauchertype','Credit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_dvcash_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Cash')
                    ->where('vauchertype','Debit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_spvcash_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Cash')
                    ->where('vauchertype','Supplier Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cpvcash_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Cash')
                    ->where('vauchertype','Customer Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_empcash_amount()
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->from('employee_payment')
                    ->where('accountType','Cash')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_mobile_amount()
    {
    $query = $this->db->select("SUM(`balance`) as total")
                    ->FROM('mobileaccount')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_pmobile_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    ->where('accountType','Mobile')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_smobile_amount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    ->where('accountType','Mobile')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_rmobile_amount()
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as totalsca")
                    ->FROM('returns')
                    ->where('accountType','Mobile')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cvmobile_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Mobile')
                    ->where('vauchertype','Credit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_dvmobile_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Mobile')
                    ->where('vauchertype','Debit Voucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_spvmobile_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Mobile')
                    ->where('vauchertype','Supplier Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cpvmobile_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('accountType','Mobile')
                    ->where('vauchertype','Customer Pay')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_empmobile_amount()
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->from('employee_payment')
                    ->where('accountType','Mobile')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function get_voucher_data()
    {
    $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                    ->from('vaucher')
                    ->join('companys','companys.companyID = vaucher.company','left')
                    ->get()
                    ->result();
    return $query;  
}

public function get_dall_voucher_data($sdate,$edate,$vtype)
    {
    if($vtype == 'All')
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('voucherdate >=', $sdate)
                        ->where('voucherdate <=', $edate)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('voucherdate >=', $sdate)
                        ->where('voucherdate <=', $edate)
                        ->where('vauchertype',$vtype)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_mall_voucher_data($month,$year,$vtype)
    {
    if($vtype == 'All')
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('MONTH(voucherdate)',$month)
                        ->where('YEAR(voucherdate)',$year)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('MONTH(voucherdate)',$month)
                        ->where('YEAR(voucherdate)',$year)
                        ->where('vauchertype',$vtype)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_yall_voucher_data($year,$vtype)
    {
    if($vtype == 'All')
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('YEAR(voucherdate)',$year)
                        ->get()
                        ->result();
        }
    else
        {
        $query = $this->db->select("vaucher.*,companys.companyID,companys.companyName")
                        ->from('vaucher')
                        ->join('companys','companys.companyID = vaucher.company','left')
                        ->where('YEAR(voucherdate)',$year)
                        ->where('vauchertype',$vtype)
                        ->get()
                        ->result();
        }
    return $query;  
}

public function get_cost_type_data($id)
    {
    $query = $this->db->select("*")
                    ->from('cost_type')
                    ->where('costTypeId',$id)
                    ->get()
                    ->result();
  
    return $query;  
}

public function get_all_sales_data()
    {
    $query = $this->db->select('*')
                    ->from('sales')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->result();
    return $query; 
}

public function get_all_purchases_data()
    {
    $query = $this->db->select('*')
                    ->from('purchase')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->result();
    return $query; 
}

public function get_all_emp_payments_data()
    {
    $query = $this->db->select('*')
                    ->from('employee_payment')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->result();
    return $query; 
}

public function get_all_returns_data()
    {
    $query = $this->db->select('*')
                    ->from('returns')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->result();
    return $query; 
}

public function get_all_vouchers_data()
    {
    $query = $this->db->select('*')
                    ->from('vaucher')
                    //->where('company',$_SESSION['company'])
                    ->get()
                    ->result();
    return $query; 
}

public function get_dallsales_data($sdate,$edate)
    {
    $query = $this->db->select('*')
                    ->from('sales')
                    //->where('company',$_SESSION['company'])
                    ->where('saleDate >=', $sdate)
                    ->where('saleDate <=', $edate)
                    ->get()
                    ->result();
    return $query; 
}

public function get_dall_purchases_data($sdate,$edate)
    {
    $query = $this->db->select('*')
                    ->from('purchase')
                    //->where('company',$_SESSION['company'])
                    ->where('purchaseDate >=', $sdate)
                    ->where('purchaseDate <=', $edate)
                    ->get()
                    ->result();
    return $query; 
}

public function get_dall_emp_payments_data($sdate,$edate)
    {
    $query = $this->db->select('*')
                    ->from('employee_payment')
                    //->where('company',$_SESSION['company'])
                    ->where('regdate >=', $sdate)
                    ->where('regdate <=', $edate)
                    ->get()
                    ->result();
    return $query; 
}

public function get_dall_returns_data($sdate,$edate)
    {
    $query = $this->db->select('*')
                    ->from('returns')
                    //->where('company',$_SESSION['company'])
                    ->where('returnDate >=', $sdate)
                    ->where('returnDate <=', $edate)
                    ->get()
                    ->result();
    return $query; 
}

public function get_dall_vouchers_data($sdate,$edate)
    {
    $query = $this->db->select('*')
                    ->from('vaucher')
                    //->where('company',$_SESSION['company'])
                    ->where('voucherdate >=', $sdate)
                    ->where('voucherdate <=', $edate)
                    ->get()
                    ->result();
    return $query; 
}

public function get_mallsales_data($month,$year)
    {
    $query = $this->db->select('*')
                    ->from('sales')
                    //->where('company',$_SESSION['company'])
                    ->where('MONTH(saleDate)',$month)
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_mall_purchases_data($month,$year)
    {
    $query = $this->db->select('*')
                    ->from('purchase')
                    //->where('company',$_SESSION['company'])
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_mall_emp_payments_data($month,$year)
    {
    $query = $this->db->select('*')
                    ->from('employee_payment')
                    //->where('company',$_SESSION['company'])
                    ->where('MONTH(regdate)',$month)
                    ->where('YEAR(regdate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_mall_returns_data($month,$year)
    {
    $query = $this->db->select('*')
                    ->from('returns')
                    //->where('company',$_SESSION['company'])
                    ->where('MONTH(returnDate)',$month)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_mall_vouchers_data($month,$year)
    {
    $query = $this->db->select('*')
                    ->from('vaucher')
                    //->where('company',$_SESSION['company'])
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_yallsales_data($year)
    {
    $query = $this->db->select('*')
                    ->from('sales')
                    //->where('company',$_SESSION['company'])
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_yall_purchases_data($year)
    {
    $query = $this->db->select('*')
                    ->from('purchase')
                    //->where('company',$_SESSION['company'])
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_yall_emp_payments_data($year)
    {
    $query = $this->db->select('*')
                    ->from('employee_payment')
                    //->where('company',$_SESSION['company'])
                    ->where('YEAR(regdate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_yall_returns_data($year)
    {
    $query = $this->db->select('*')
                    ->from('returns')
                    //->where('company',$_SESSION['company'])
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function get_yall_vouchers_data($year)
    {
    $query = $this->db->select('*')
                    ->from('vaucher')
                    //->where('company',$_SESSION['company'])
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->result();
    return $query; 
}

public function total_salesamount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_purchasesamount()
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_emp_payments_amount()
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->FROM('employee_payment')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_returns_amount()
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal")
                    ->FROM('returns')
                    //->WHERE('company',$_SESSION['company'])
                    ->get()
                    ->row();
    return $query;  
}

public function total_cvoucher_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Credit Voucher')
                    ->get()
                    ->row();
    return $query;  
}

public function total_dvoucher_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Debit Voucher')
                    ->get()
                    ->row();
    return $query;  
}

public function total_cusvoucher_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Customer Pay')
                    ->get()
                    ->row();
    return $query;  
}

public function total_svoucher_amount()
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Supplier Pay')
                    ->get()
                    ->row();
    return $query;  
}

public function total_dsales_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('saleDate >=', $sdate)
                    ->where('saleDate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_dpurchases_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('purchaseDate >=', $sdate)
                    ->where('purchaseDate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_demp_payments_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->FROM('employee_payment')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('regdate >=', $sdate)
                    ->where('regdate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_dreturns_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal")
                    ->FROM('returns')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('returnDate >=', $sdate)
                    ->where('returnDate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_dcvoucher_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Credit Voucher')
                    ->where('voucherdate >=', $sdate)
                    ->where('voucherdate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ddvoucher_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Debit Voucher')
                    ->where('voucherdate >=', $sdate)
                    ->where('voucherdate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_dcusvoucher_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Customer Pay')
                    ->where('voucherdate >=', $sdate)
                    ->where('voucherdate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_dsvoucher_amount($sdate,$edate)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Supplier Pay')
                    ->where('voucherdate >=', $sdate)
                    ->where('voucherdate <=', $edate)
                    ->get()
                    ->row();
    return $query;  
}

public function total_msales_amount($month,$year)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('MONTH(saleDate)',$month)
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_mpurchases_amount($month,$year)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('MONTH(purchaseDate)',$month)
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_memp_payments_amount($month,$year)
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->FROM('employee_payment')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('MONTH(regdate)',$month)
                    ->where('YEAR(regdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_mreturns_amount($month,$year)
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal")
                    ->FROM('returns')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('MONTH(returnDate)',$month)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_mcvoucher_amount($month,$year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Credit Voucher')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_mdvoucher_amount($month,$year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Debit Voucher')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_mcusvoucher_amount($month,$year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Customer Pay')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_msvoucher_amount($month,$year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Supplier Pay')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ysales_amount($year)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('sales')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ypurchases_amount($year)
    {
    $query = $this->db->select("SUM(`paidAmount`) as total")
                    ->FROM('purchase')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('YEAR(purchaseDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_yemp_payments_amount($year)
    {
    $query = $this->db->select("SUM(`salary`) as total")
                    ->FROM('employee_payment')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('YEAR(regdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_yreturns_amount($year)
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal")
                    ->FROM('returns')
                    //->WHERE('company',$_SESSION['company'])
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ycvoucher_amount($year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Credit Voucher')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ydvoucher_amount($year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Debit Voucher')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ycusvoucher_amount($year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Customer Pay')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function total_ysvoucher_amount($year)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    //->WHERE('company',$_SESSION['company'])
                    ->WHERE('vauchertype','Supplier Pay')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query;  
}

public function supplier_purchases_due_details($id,$sid)
    {
    $query = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
                    ->FROM('purchase')
                    ->where_not_in('purchaseID',$id)
                    ->where('supplier',$sid)
                    ->get()
                    ->row();
    return $query;  
}

public function supplier_paid_details($sid)
    {
    $query = $this->db->select("SUM(`totalamount`) as total")
                    ->FROM('vaucher')
                    ->where('supplier',$sid)
                    ->get()
                    ->row();
    return $query;  
}

public function get_customer_sales_data($id)
    {
    $query = $this->db->select("*")
                    ->FROM('sales')
                    ->where('customerID',$id)
                    ->get()
                    ->result();
    return $query;  
}

public function get_customer_vouchers_data($id)
    {
    $query = $this->db->select("*")
                    ->FROM('vaucher')
                    ->where('customerID',$id)
                    ->get()
                    ->result();
    return $query;  
}

public function get_customer_returns_data($id)
    {
    $query = $this->db->select("*")
                    ->FROM('returns')
                    ->where('customerID',$id)
                    ->get()
                    ->result();
    return $query;  
}

public function get_dcustomer_sales_data($id,$sdate,$edate)
    {
    $query = $this->db->select("*")
                    ->FROM('sales')
                    ->where('customerID',$id)
                    ->where('saleDate >=',$sdate)
                    ->where('saleDate <=',$edate)
                    ->get()
                    ->result();
    return $query;  
}

public function get_dcustomer_vouchers_data($id,$sdate,$edate)
    {
    $query = $this->db->select("*")
                    ->FROM('vaucher')
                    ->where('customerID',$id)
                    ->where('voucherdate >=',$sdate)
                    ->where('voucherdate <=',$edate)
                    ->get()
                    ->result();
    return $query;  
}

public function get_dcustomer_returns_data($id,$sdate,$edate)
    {
    $query = $this->db->select("*")
                    ->FROM('returns')
                    ->where('customerID',$id)
                    ->where('returnDate >=',$sdate)
                    ->where('returnDate <=',$edate)
                    ->get()
                    ->result();
    return $query;  
}

public function get_mcustomer_sales_data($id,$month,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('sales')
                    ->where('customerID',$id)
                    ->where('MONTH(saleDate)',$month)
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_mcustomer_vouchers_data($id,$month,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('vaucher')
                    ->where('customerID',$id)
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_mcustomer_returns_data($id,$month,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('returns')
                    ->where('customerID',$id)
                    ->where('MONTH(returnDate)',$month)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_ycustomer_sales_data($id,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('sales')
                    ->where('customerID',$id)
                    ->where('YEAR(saleDate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_ycustomer_vouchers_data($id,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('vaucher')
                    ->where('customerID',$id)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_ycustomer_returns_data($id,$year)
    {
    $query = $this->db->select("*")
                    ->FROM('returns')
                    ->where('customerID',$id)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->result();
    return $query;  
}

public function get_scustomer_cvouchers_data($id,$sdate,$edate)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('voucherdate >=',$sdate)
                    ->where('voucherdate <=',$edate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_scustomer_dvouchers_data($id,$sdate,$edate)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('voucherdate >=',$sdate)
                    ->where('voucherdate <=',$edate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_scustomer_returns_data($id,$sdate,$edate)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('returnDate >=',$sdate)
                    ->where('returnDate <=',$edate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_mscustomer_cvouchers_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_mscustomer_dvouchers_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('MONTH(voucherdate)',$month)
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_mscustomer_returns_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('MONTH(returnDate)',$month)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_yscustomer_cvouchers_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_yscustomer_dvouchers_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('YEAR(voucherdate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_yscustomer_returns_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('YEAR(returnDate)',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pdcustomer_sales_data($id,$sdate)
    {
    $query = $this->db->select('SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal')
                    ->from('sales')
                    ->where('customerID',$id)
                    ->where('saleDate <',$sdate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_psdcustomer_cvouchers_data($id,$sdate)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('voucherdate <',$sdate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_psdcustomer_dvouchers_data($id,$sdate)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('voucherdate <',$sdate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_psdcustomer_returns_data($id,$sdate)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('returnDate <',$sdate)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pmcustomer_sales_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal')
                    ->from('sales')
                    ->where('customerID',$id)
                    ->where('MONTH(saleDate) <',$month)
                    ->where('YEAR(saleDate) <=',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pmscustomer_cvouchers_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('MONTH(voucherdate) <',$month)
                    ->where('YEAR(voucherdate) <=',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pmscustomer_dvouchers_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('MONTH(voucherdate) <',$month)
                    ->where('YEAR(voucherdate) <=',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pmscustomer_returns_data($id,$month,$year)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('MONTH(returnDate) <',$month)
                    ->where('YEAR(returnDate) <=',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pycustomer_sales_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal')
                    ->from('sales')
                    ->where('customerID',$id)
                    ->where('YEAR(saleDate) <',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pyscustomer_cvouchers_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Credit Voucher')
                    ->where('YEAR(voucherdate) <',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pyscustomer_dvouchers_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalamount`) as total')
                    ->from('vaucher')
                    ->where('customerID',$id)
                    ->where('vauchertype','Customer Pay')
                    ->where('YEAR(voucherdate) <',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_pyscustomer_returns_data($id,$year)
    {
    $query = $this->db->select('SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal')
                    ->from('returns')
                    ->where('customerID',$id)
                    ->where('YEAR(returnDate) <',$year)
                    ->get()
                    ->row();
    return $query; 
}

public function get_demp_sales_data($id,$sdate,$edate)
    {
    $query = $this->db->select('
                            SUM(`totalAmount`) as total,
                            SUM(`paidAmount`) as ptotal,
                            SUM(`discountAmount`) as dtotal,
                            customers.customerID,
                            customers.compname,
                            customers.address,
                            customers.balance')
                    ->from('sales')
                    ->join('customers','customers.customerID = sales.customerID','left')
                    ->where('empid',$id)
                    ->where('saleDate >=',$sdate)
                    ->where('saleDate <=',$edate)
                    ->group_by('sales.customerID')
                    ->get()
                    ->result();
    return $query; 
}


public function get_memp_sales_data($id,$month,$year)
    {
    $query = $this->db->select('
                            SUM(`totalAmount`) as total,
                            SUM(`paidAmount`) as ptotal,
                            SUM(`discountAmount`) as dtotal,
                            customers.customerID,
                            customers.compname,
                            customers.address,
                            customers.balance')
                    ->from('sales')
                    ->join('customers','customers.customerID = sales.customerID','left')
                    ->where('empid',$id)
                    ->where('MONTH(saleDate)',$month)
                    ->where('YEAR(saleDate)',$year)
                    ->group_by('sales.customerID')
                    ->get()
                    ->result();
    return $query; 
}

public function get_yemp_sales_data($id,$year)
    {
    $query = $this->db->select('
                            SUM(`totalAmount`) as total,
                            SUM(`paidAmount`) as ptotal,
                            SUM(`discountAmount`) as dtotal,
                            customers.customerID,
                            customers.compname,
                            customers.address,
                            customers.balance')
                    ->from('sales')
                    ->join('customers','customers.customerID = sales.customerID','left')
                    ->where('empid',$id)
                    ->where('YEAR(saleDate)',$year)
                    ->group_by('sales.customerID')
                    ->get()
                    ->result();
    return $query; 
}

//category_add
public function category_add($data) {
    $this->db->insert('categories',$data);
    return $this->db->insert_id();
}

// brand_add($data)
public function brand_add($data) {
    $this->db->insert('product_brands',$data);
    return $this->db->insert_id();
}

// unit_add($data)
public function unit_add($data){
    $this->db->insert('sma_units',$data);
    return $this->db->insert_id();
}

//supplier_add($data)
public function supplier_add($data) {
    $this->db->insert('suppliers',$data);
    return $this->db->insert_id();
}

// customer_add($data)
public function customer_add($data) {
    $this->db->insert('customers',$data);
    return $this->db->insert_id();
}

// get_customer_name
public function get_customer_name($id) {
    $query = $this->db->select('customerName')
                    ->from('customers')
                    ->where('customerID',$id)
                    ->get()
                    ->row();
    return $query->customerName;
}

// get_previous_year_net_due($row['customer_id'])
public function get_previous_year_net_due($id) {
    $sql = "SELECT (SUM(totalAmount)-SUM(paidAmount)) as previous_year_net_due FROM sales WHERE YEAR(saleDate) = YEAR(DATE_SUB(NOW(),INTERVAL 1 YEAR)) AND customerID = $id";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->previous_year_net_due;
}

// get_gross_sale_current_year
public function get_gross_sale_current_year($id) {
    $sql = "SELECT SUM(totalAmount)as gross_sale_current_year FROM sales WHERE YEAR(saleDate) = YEAR(CURDATE()) AND customerID = $id";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->gross_sale_current_year;
}

// get_discount_amount
public function get_discount_amount($id) {
    $sql = "SELECT SUM(discountAmount)as discount_amount FROM sales WHERE YEAR(saleDate) = YEAR(CURDATE()) AND customerID = $id";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->discount_amount;
}

// total_collection_current_year_sale($row['customer_id'])
public function total_collection_current_year_sale($id){
    $sql = "SELECT SUM(`paidAmount`) as paid_amount_sale FROM sales where `customerID` = $id AND YEAR(saleDate) = YEAR(CURDATE())";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->paid_amount_sale;
}

// total_collection_current_year_voucher($row['customer_id'])
public function total_collection_current_year_voucher($id){
    $sql = "SELECT SUM(`totalamount`) as paid_amount_voucher FROM vaucher WHERE vauchertype = 'Credit Voucher' AND `customerID` = $id AND YEAR(voucherdate) = YEAR(CURDATE())";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->paid_amount_voucher;
}

// total_due_current_year($row['customer_id'])
public function total_due_current_year($id) {
    $sql = "SELECT (SUM(totalAmount)-SUM(paidAmount)) as current_year_net_due FROM sales WHERE YEAR(saleDate) = YEAR(CURDATE()) AND customerID = $id";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->current_year_net_due;
}



// get_amount_and_employee($result)
public function get_amount_and_employee_return($id) {
    $query = $this->db->select('customerID, totalPrice')
                      ->from('returns')
                      ->where('returnId', $id)
                      ->get()
                      ->row();
    return $query;
}

// get_amount_and_employee_voucher($id) 
public function get_amount_and_employee_voucher($id) {
    $query = $this->db->select('customerID, totalamount')
                      ->from('vaucher')
                      ->where('vuid', $id)
                      ->get()
                      ->row();
    return $query;
}

// get_amount_and_employee_sale($id)
public function get_amount_and_employee_sale($id) {
    $query = $this->db->select('customerID, totalAmount, paidAmount')
                      ->from('sales')
                      ->where('saleID', $id)
                      ->get()
                      ->row();
    return $query;
}

// get_discount($row['customer_id']." %"
public function get_discount($id) {
    $query = $this->db->select('discount, discountType')
                      ->from('sales')
                      ->where('customerID', $id)
                      ->get()
                      ->row();
    return $query;
}

// get_employee_closing_balance($value->customerID)
public function get_employee_closing_balance($id) {
    $sql = "SELECT closing_balance FROM customers WHERE customerID = $id";
    $result = $this->db->query($sql);
    $value = $result->row();
    return $value->closing_balance;
}






}