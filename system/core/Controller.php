<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

    /**
     * Reference to the CI singleton
     *
     * @var	object
     */
    private static $instance;

    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct() {
        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');
        $this->load->initialize();
        log_message('info', 'Controller Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Get the CI singleton
     *
     * @static
     * @return	object
     */
    public static function &get_instance() {
        return self::$instance;
    }


    /* for access permission */
public function checkPermission()
    {
    $controller = get_called_class();
        
    if(!$this->session->userdata('username'))
        {
        redirect('Login');
        }
    else
        {
        $pwhere = array(
            'controllerName' => $controller
                );
        $pageInfo = $this->pm->get_data('pages',$pwhere);

        $rwhere = array(
            'pageId' => $pageInfo[0]['pageId'],
            'accessLavel' => $this->session->userdata('role'),
                );
        $info = $this->pm->get_data('page_access_relationship',$rwhere);  

        if(count($info)>0)
            {
            if($info[0]['status'] == "Active")
                {
                // get all page name that ar permitted to access for current user;
                $rwhere = array(
                    'page_access_relationship.status' => 'Active',           
                    'accessLavel' => $this->session->userdata('role'),
                        );
                $field = array(
                    'pages' => 'pages.pageName'
                        );
                $join = array(
                    'pages'=>'pages.pageId=page_access_relationship.pageId'
                        );
                $info = $this->pm->get_data('page_access_relationship',$rwhere,$field,$join);
                
                foreach ($info as $key => $value)
                    {
                    $pages[] = $value['pageName'];
                    }
                 // page name into session               
                $this->session->set_userdata('pages',$pages);
                return true;
                }
            else
                {
                if($this->session->userdata('pages'))
                    {
                    redirect('Home');    
                    }
                else
                    {
                    $this->session->set_flashdata('error','Not permission to access');
                    redirect('Noaccess');
                    }
                }
            }
        else
            {
            $this->session->set_flashdata('msg','Not permission to access');
            redirect('Home');
            }
        }
}
/* For account update */

public function accTransUpdate($info) {
    $accountType = $info['accountType'];
        // check account type bank
    if ($info['accountType'] == 'bank') {
        $bwhere = array(
            'bankAccountId' => $info['accountNo']
            );
        $bankAccounts = $this->pm->get_data('bankaccount', $bwhere);
        if ($info['transfarType'] == 'withdraw') {
            $bankAmount = $bankAccounts[0]['balance'] - $info['amount'];
        }
        if ($info['transfarType'] == 'deposit') {
            $bankAmount = $bankAccounts[0]['balance'] + $info['amount'];
        }
        $bdata = array(
            'balance' => $bankAmount
            );
        $this->pm->update_data('bankaccount', $bdata, $bwhere);
    }
        // if account type in mobile
    if ($info['accountType'] == 'mobile') {
        $bwhere = array(
            'mobileAccountId' => $info['accountNo']
            );
        $bankAccounts = $this->pm->get_data('mobileaccount', $bwhere);
        if ($info['transfarType'] == 'withdraw') {
            $mobileAmount = $bankAccounts[0]['balance'] - $info['amount'];
        }
        if ($info['transfarType'] == 'deposit') {
            $mobileAmount = $bankAccounts[0]['balance'] + $info['amount'];
        }

        $bdata = array(
            'balance' => $mobileAmount
            );
        $this->pm->update_data('mobileaccount', $bdata, $bwhere);
    }

        // if account type in mobile
    if ($info['accountType'] == 'cash') {
        $bwhere = array(
            'cashId' => $info['accountNo']
            );
        $bankAccounts = $this->pm->get_data('cash', $bwhere);
        if ($info['transfarType'] == 'withdraw') {
            $mobileAmount = $bankAccounts[0]['balance'] - $info['amount'];
        }
        if ($info['transfarType'] == 'deposit') {
            $mobileAmount = $bankAccounts[0]['balance'] + $info['amount'];
        }

        $bdata = array(
            'balance' => $mobileAmount
            );
        $this->pm->update_data('cash', $bdata, $bwhere);
    }
        // insert transaction 
    $transaction = array(
        'transactionType' => $info['accountType'],
        'transactionAccountId' => $info['accountNo'],
        'amount' => $info['amount'],
        'amountType' => $info['transfarType'],
        'transactionDate' => date('Y-m-d h:i:s', strtotime($info['transactionDate'])),
        'tableName' => $info['tableName'],
        'primaryKeyName' => $info['primaryKeyName'],
        'primaryKeyId' => $info['primaryKeyId']
        );

    $transaction = $this->pm->insert_data('transactions', $transaction);

    return $transaction;
}

public function daily_tranaction($info){
     $transaction = array(       
        'transactionType' => $info['accountType'],
        'transactionAccountId' => $info['accountNo'],
        'amount' => $info['amount'],       
        'transactionDate' => date('Y-m-d', strtotime($info['transactionDate'])),
        'tableName' => $info['tableName'],
        'primaryKeyName' => $info['primaryKeyName'],
        'primaryKeyId' => $info['primaryKeyId'],
        'createdBy' => $this->session->userdata('user_id'),
        'createdDate'=>date('Y-m-d')
        );
    $transaction = $this->pm->insert_data('daily_transactions', $transaction);

    return $transaction;
}

public function updateStock($info) {
    if ($info['tableName'] == 'stock') {
        $where = array(
            'product' => $info['productId']
            );
        $stockQuentity = $this->pm->get_data($info['tableName'], $where);
        if ($info['action'] == 'sub') {
            $newQuentity = array(
                'totalPices' => $stockQuentity[0]['totalPices'] - $info['quantity']
                );
            $result = $this->pm->update_data($info['tableName'], $newQuentity, $where);
        }
        if ($info['action'] == 'add') {
            if (count($stockQuentity) > 0) {
                    // check exixting in stock this product if exixist then                    
                $newQuentity = array(
                    'totalPices' => $stockQuentity[0]['totalPices'] + $info['quantity']
                    );
                $result = $this->pm->update_data($info['tableName'], $newQuentity, $where);
            } else {
                    // if not exixiting then
                $data = array(
                    'product' => $info['productId'],
                    'totalPices' => $info['quantity']
                    );
                $result = $this->pm->insert_data($info['tableName'], $data);
            }
        }

        return $result;
    }
    if ($info['tableName'] == 'damage_stock' || $info['tableName'] == 'dismiss_stock' || $info['tableName'] == 'return_stock') {
        $where = array(
            'productId' => $info['productId']
            );
        $stockQuentity = $this->pm->get_data($info['tableName'], $where);
        if ($info['action'] == 'sub') {
            $newQuentity = array(
                'totalQuantity' => $stockQuentity[0]['totalQuantity'] - $info['quantity']
                );
            $result = $this->pm->update_data($info['tableName'], $newQuentity, $where);
        }
        if ($info['action'] == 'add') {
            if (count($stockQuentity) > 0) {
                    // update table
                $newQuentity = array(
                    'totalQuantity' => $stockQuentity[0]['totalQuantity'] + $info['quantity']
                    );
                $result = $this->pm->update_data($info['tableName'], $newQuentity, $where);
            } else {
                    // insert table into table
                $data = array(
                    'productId' => $info['productId'],
                    'totalQuantity' => $info['quantity']
                    );
                $result = $this->pm->insert_data($info['tableName'], $data);
            }
            return $result;
        }
    }
}

public function accountNo($accountType,$accountNo){
 if ($accountType == 'bank') {
        $bwhere = array(
            'bankAccountId' => $accountNo
            );
        $bankAccounts = $this->pm->get_data('bankaccount', $bwhere);
        $value=$bankAccounts[0];
        return $value['bankName'] . ' ' . $value['branchName'] . ' ' . $value['accountNo'] . ' ' . $value['accountName'] ;
        
    }
     if ($accountType == 'mobile') {
        $bwhere = array(
            'mobileAccountId' => $accountNo
            );
        $bankAccounts = $this->pm->get_data('mobileaccount', $bwhere); 
         $value=$bankAccounts[0];
       return $value['accountName'] . ' ' . $value['accountNo'];
        
    }
     if ($accountType == 'cash') {
        $bwhere = array(
            'cashId' => $accountNo
            );
        $bankAccounts = $this->pm->get_data('cash', $bwhere);
         $value=$bankAccounts[0];
       return $value['cashName'];
    }

}

// get  pagination
     public function common_pagination($base_url, $total, $per_page = 5, $uri_segment = 3) {
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = ' &gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = ' &lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current-link"><a>';        
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return $config['per_page'];
    }


}
