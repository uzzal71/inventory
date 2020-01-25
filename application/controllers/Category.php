<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Product Category';

    $other = array(
        'order_by' => 'categoryID'
            );

    $data['category'] = $this->pm->get_data('categories',false,false,false,$other);
    
    $data['content'] = $this->load->view('category/categories',$data, TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function save_category()
    {
    $info = $this->input->post();

    $data = array(
        'categoryName' => $info['categoryName'],
        'status'       => $info['status'],            
        'created_by'   => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('categories',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Category add Successfully !</h4>
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
    redirect('Category');
}

public function get_category_data()
    {
    $section = $this->pm->get_category_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_category()
    {
    $info = $this->input->post();

    $data = array(
        'categoryName' => $info['categoryName'],
        'status'       => $info['status'],            
        'updated_by'   => $this->session->userdata('admin_id')
            );

    $where = array(
        'categoryID' => $info['cat_id']
            );

    $result = $this->pm->update_data('categories',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Category update Successfully !</h4>
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
    redirect('Category');
}

public function delete_category($id)
    {
    $where = array(
        'categoryID' => $id
            );
    $empu = $this->pm->get_data('products',$where);
    $data['empu'] = $empu[0];

    if ($empu[0] == null)
        {
        $result = $this->pm->delete_data('categories',$where);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Category delete Successfully !</h4>
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
            <h4><i class="icon fa fa-ban"></i> All ready add this Category in Product !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Category');
}

public function product_units()
    {
    $data['title'] = 'Products Units';

    $other = array(
        'order_by' => 'id'
            );

    $data['unit'] = $this->pm->get_data('sma_units',false,false,false,$other);

    $data['content'] = $this->load->view('category/product_units',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function save_units()
    {
    $info = $this->input->post();

    $data = array(
        'name'   => $info['unitName'],
        'code'   => $info['unitCode'],
        'status' => $info['status'],            
        'regby'  => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('sma_units',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Units add Successfully !</h4>
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
    redirect('units');
}

public function get_unit_data()
    {
    $section = $this->pm->get_unit_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_units()
    {
    $info = $this->input->post();

    $data = array(
        'name'   => $info['unitName'],
        'code'   => $info['unitCode'],
        'status' => $info['status'],            
        'upby'   => $this->session->userdata('admin_id')
            );

    $where = array(
        'id' => $info['unit_id']
            );

    $result = $this->pm->update_data('sma_units',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Unit update Successfully !</h4>
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
    redirect('units');
}

public function delete_units($id)
    {
    $where = array(
        'units' => $id
            );
    $empu = $this->pm->get_data('products',$where);
    $data['empu'] = $empu[0];

    if ($empu[0] == null)
        {
        $uwhere = array(
            'id' => $id
                );

        $result = $this->pm->delete_data('sma_units',$uwhere);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Unit delete Successfully !</h4>
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
            <h4><i class="icon fa fa-ban"></i> All ready add this Unit in Product !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('units');
}

public function product_brands()
    {
    $data['title'] = 'Products Brand';

    $other = array(
        'order_by' => 'id'
            );

    $data['brand'] = $this->pm->get_data('product_brands',false,false,false,$other);

    $data['content'] = $this->load->view('category/product_brands',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function save_brands()
    {
    $info = $this->input->post();

    $data = array(
        'name'   => $info['brandName'],
        'status' => $info['status'],            
        'regby'  => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('product_brands',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Brand add Successfully !</h4>
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
    redirect('brands');
}

public function get_brands_data()
    {
    $section = $this->pm->get_brands_data($_POST['id']);
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_brands()
    {
    $info = $this->input->post();

    $data = array(
        'name'   => $info['brandName'],
        'status' => $info['status'],            
        'upby'   => $this->session->userdata('admin_id')
            );

    $where = array(
        'id' => $info['brand_id']
            );

    $result = $this->pm->update_data('product_brands',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Brand update Successfully !</h4>
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
    redirect('brands');
}

public function delete_brands($id)
    {
    $where = array(
        'brand' => $id
            );
    $empu = $this->pm->get_data('products',$where);
    $data['empu'] = $empu[0];

    if ($empu[0] == null)
        {
        $uwhere = array(
            'id' => $id
                );

        $result = $this->pm->delete_data('product_brands',$uwhere);

        if($result)
            {
            $sdata = [
              'exception' =>'<div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Brand delete Successfully !</h4>
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
            <h4><i class="icon fa fa-ban"></i> All ready add this Brand in Product !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('brands');
}







}