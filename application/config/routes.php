<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['units'] = 'Category/product_units';
$route['brands'] = 'Category/product_brands';

$route['profile'] = 'Cost/company_profile';




$route['income-list'] = 'income';
$route['income-search'] = 'income';
$route['expense-list'] = 'expense';
$route['expense-search'] = 'expense';

$route['assets-add'] = 'admin/assets';
$route['a-head-save'] = 'admin/assets/assets_head_save';
$route['assets-save'] = 'admin/assets/assets_save';

$route['liability-add'] = 'admin/liability';
$route['l-head-save'] = 'admin/liability/liability_head_save';
$route['liability-save'] = 'admin/liability/liability_save';

$route['equity-add'] = 'admin/equity';
$route['e-head-save'] = 'admin/equity/equity_head_save';
$route['equity-save'] = 'admin/equity/equity_save';

$route['purchase-list'] = 'admin/purchase';
$route['purchase-search'] = 'admin/purchase';
$route['search-purchase'] = 'purchase';
$route['expense'] = 'expense/expense_reports';
$route['expense-data'] = 'expense/expense_reports';
$route['salary-sheet'] = 'expense/salary_sheet';

//$route['electricity-bill'] = 'expense/electricity_bill';
$route['office-cost'] = 'expense/office_cost';
$route['expense'] = 'expense/expense_reports';

// costing
$route['total-cost'] = 'cost/total_cost';
$route['search-total-cost'] = 'cost/total_cost';

$route['customer-reports'] = 'cost/customer_monthly_report';
$route['search-customer-report'] = 'cost/customer_monthly_report';
$route['sales-man-report'] = 'cost/sales_man_report';
$route['search-sales-man-report'] = 'cost/sales_man_report';
$route['trail-balance'] = 'cost/trail_balance';
$route['all-sales'] = 'cost/all_sales';
$route['prints/(:num)'] = 'cost/prints/$1';
$route['search-total-trail'] = 'cost/trail_balance';
$route['balance-sheet'] = 'cost/balance_sheet';
$route['journal'] = 'cost/journal';
$route['search-journal'] = 'cost/journal';
$route['warranty'] = 'cost/warranty';
$route['add-bonus'] = 'cost/add_bonus';



$route['supplier-report'] = 'cost/supplier_report';
$route['search-supplier-report'] = 'cost/supplier_report';
$route['supplier-details'] = 'cost/supplier_report_details';

$route['product-report'] = 'cost/products_report';

