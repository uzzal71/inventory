<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

public function __construct(){
    parent::__construct();       
    $this->load->model("prime_model",'pm');            
    $this->checkPermission();    
}

public function index()
    {
    $data['title'] = 'Product'; 

    $other = array(
       'order_by' => 'productID',
       'join' => 'left'         
            );
    $field = array(
        'prouducts' => 'products.*',
        'categories' => 'categories.categoryName',
        'sma_units' => 'sma_units.name'
            );
    $join = array(
        'categories' => 'products.categoryID = categories.categoryID',
        'sma_units' => 'sma_units.id = products.units'
            );

    $data['product'] = $this->pm->get_data('products',false,$field,$join,$other); 
//var_dump($data['products']); exit();
    $data['content'] = $this->load->view('products/productList',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function NewProduct()
    {
    $data['title'] = 'Product';

    $where = array('status' => 'Active');

    $data['category'] = $this->pm->get_data('categories',$where);
    $data['brand'] = $this->pm->get_data('product_brands',$where);
    $data['unit'] = $this->pm->get_data('sma_units',$where);
//var_dump($data['unit']);
    $data['content'] = $this->load->view('products/AddProduct',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function save_product()
    {
    $info = $this->input->post();
//var_dump('hello'); exit();
    $config['upload_path'] = './upload/product/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('userfile'))
        {
        $img = $this->upload->data('file_name');
        }
    else
        {
        $img = '';
        }  

    $info = [
        'productName' => $info['productName'],
        'productcode' => $info['productcode'],
        'warranty'    => $info['warranty'],
        'categoryID'  => $info['categoryID'],
        'brand'       => $info['bandname'],
        'units'       => $info['units'],
        'pprice'      => $info['pprice'],
        'sprice'      => $info['sprice'],
        'image'       => $img,
        'regby'       => $this->session->userdata('admin_id')
            ];
//var_dump($productID); exit();
       
    $result = $this->pm->insert_data('products',$info);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product add Successfully !</h4>
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
    redirect('Product');
}

public function edit_products($id)
    {
    $data['title'] = 'Product';

    $where = array('status' => 'Active');

    $data['category'] = $this->pm->get_data('categories',$where);
    $data['brand'] = $this->pm->get_data('product_brands',$where);
    $data['unit'] = $this->pm->get_data('sma_units',$where);

    $pwhere = array(
        'productID' => $id
            );

    $product = $this->pm->get_data('products',$pwhere);
    $data['product'] = $product[0];
//var_dump($data['unit']);
    $data['content'] = $this->load->view('products/edit_product',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function update_product()
    {
    $info = $this->input->post();
    $pid = $info['productid'];
//var_dump($pid); exit();
    $config['upload_path'] = './upload/product/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|JPG|PNG';
    $config['max_size'] = 0;
    $config['max_width'] = 0;
    $config['max_height'] = 0;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('userfile'))
        {
        $img = $this->upload->data('file_name');
        }
    else
        {
        $pimg = $this->db->select('image')->from('products')->where('productID',$pid)->get()->row();
        if($pimg)
            {
            $img = $pimg->image;
            }
        else
            {
            $img = '';
            }
        }  

    $info = [
        'productName' => $info['productName'],
        'productcode' => $info['productcode'],
        'warranty'    => $info['warranty'],
        'categoryID'  => $info['categoryID'],
        'brand'       => $info['bandname'],
        'units'       => $info['units'],
        'pprice'      => $info['pprice'],
        'sprice'      => $info['sprice'],
        'image'       => $img,
        'upby'        => $this->session->userdata('admin_id')
            ];
//var_dump($info); exit();
    $where = array(
        'productID' => $pid
            );
    //var_dump($where); exit();
    $result = $this->pm->update_data('products',$info,$where);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product update Successfully !</h4>
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
    redirect('Product');
}

public function delete_products($pid)
    {
    $where = array(
        'productID' => $pid
            );
    //var_dump($where); exit();
    $result = $this->pm->delete_data('products',$where);
    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Product delete Successfully !</h4>
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
    redirect('Product');
}

public function product_reports()
    {
    $data['title'] = 'Product Reports'; 
    $data['company'] = $this->pm->company_details();
    $data['comp'] = $this->pm->get_data('companys',false);

    if(isset($_GET['search']))
        {
        $company = $_GET['darea'];

        $other = array(
           'join' => 'left'         
                );

        $where = array(
           'company' => $company         
                );

        $field = array(
            'stock' => 'stock.*',
            'products' => 'products.productName,products.pprice',
            'companys' => 'companys.companyName'
                );
        $join = array(
            'products' => 'products.productID = stock.product',
            'companys' => 'companys.companyID = stock.company'
                );

        $data['stock'] = $this->pm->get_data('stock',$where,$field,$join,$other);
        }
    else
        {
        $other = array(
           'join' => 'left'         
                );

        $field = array(
            'stock' => 'stock.*',
            'products' => 'products.productName,products.pprice',
            'companys' => 'companys.companyName'
                );
        $join = array(
            'products' => 'products.productID = stock.product',
            'companys' => 'companys.companyID = stock.company'
                );

        $data['stock'] = $this->pm->get_data('stock',false,$field,$join,$other);
        }
//var_dump($data['products']); exit();
    $data['content'] = $this->load->view('products/product_report',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function product_sales_reports()
    {
    $data = [
        'title' => 'Product Report'
            ];

    $data['product'] = $this->pm->get_data('products',false);
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $year = $_GET['ryear'];
        $data['year'] = $year;
        }
    else
        {
        }

    $data['content'] = $this->load->view('products/sales_product',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}


//add_cateogry
public function add_cateogry() {
    $data = array();
    $data['categoryName'] = $_POST['category_name'];
    $data['status'] = $_POST['status'];
    $data['created_by'] = $this->session->userdata('admin_id');
    $result = $this->pm->category_add($data);
    if($result) {
        //echo "Category Successfully!";
        $where = array('status' => 'Active');
        $categories = $this->pm->get_data('categories',$where);
        $append = '<div id="category_hide"><label>Category *</label>
                    <select name="categoryID" class="form-control" required >
                    <option value="">Select One</option>';
        foreach($categories as $value) {
            $append .= '<option value=" '.$value['categoryID'] .' ">'.$value['categoryName'].'</option>';
        }
        $append .= ' </select></div>';
        echo $append;
    }else{
        echo "Category Added Failed!";
    }
}

//add_brand
public function add_brand() {
    $data = array();
    $data['name'] = $_POST['brand_name'];
    $data['status'] = $_POST['status'];
    $data['regby'] = $this->session->userdata('admin_id');
    $result = $this->pm->brand_add($data);
    if($result) {
        //echo "Category Successfully!";
        $where = array('status' => 'Active');
        $brands = $this->pm->get_data('product_brands',$where);
        $append = '<div id="brand_hide"><label>Brand Name</label>
                    <select name="bandname" class="form-control">
                    <option value="">Select One</option>';
        foreach($brands as $value) {
            $append .= '<option value=" '.$value['id'] .' ">'.$value['name'].'</option>';
        }
        $append .= ' </select></div>';
        echo $append;
    }else{
        echo "Brand Added Failed!";
    }
}

//add_unit
public function add_unit() {
    $data = array();
    $data['code'] = $_POST['unit_code'];
    $data['name'] = $_POST['unit_name'];
    $data['status'] = $_POST['status'];
    $data['regby'] = $this->session->userdata('admin_id');
    $result = $this->pm->unit_add($data);
    if($result) {
        //echo "Category Successfully!";
        $where = array('status' => 'Active');
        $units = $this->pm->get_data('sma_units',$where);
        $append = '<div id="unit_hide"><label>Product Unit *</label>
                    <select name="units" class="form-control" required >
                    <option value="">Select One</option>';
        foreach($units as $value) {
            $append .= '<option value=" '.$value['id'] .' ">'.$value['name'].'</option>';
        }
        $append .= ' </select></div>';
        echo $append;
    }else{
        echo "Unit Added Failed!";
    }
}






}