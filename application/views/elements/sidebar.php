<?php $pages = $this->session->userdata('pages'); ?>
  <aside class="main-sidebar" style="background-color: #000;">
    <section class="sidebar">

      <ul class="sidebar-menu">
      <?php if(in_array("Dashboard", $pages)):?>
        <li>
          <a href="<?php echo site_url('Home')?>"><i class="fa fa-home"></i><span>Dashboard</span></a>
        </li>
      <?php endif?>

      <?php if(in_array("Products List", $pages) || in_array("Add Product", $pages) ):?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Products List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Product')?>"><i class="fa fa-list"></i><span>List Product</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Product", $pages)):?>
            <li>
              <a href="<?php echo site_url('Product/NewProduct')?>"><i class="fa fa-plus"></i><span>Add Product</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Purchase List", $pages) || in_array("Add Purchase", $pages) ):?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Purchase List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Purchase')?>"><i class="fa fa-list"></i><span>Purchase List</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Purchase", $pages)):?>
            <li>
              <a href="<?php echo site_url('Purchase/newPurchase')?>"><i class="fa fa-plus"></i><span>Add Purchase</span></a>
            </li>
          <?php endif?>
          
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Sales List", $pages) || in_array("Add Sales", $pages) ):?>
        <li class="treeview">
          <a href="#"><i class="fa fa-money"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Sales List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Sale')?>"><i class="fa fa-list"></i><span>Sale List</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Sales", $pages)):?>
            <li>
              <a href="<?php echo site_url('Sale/newSale')?>"><i class="fa fa-plus"></i><span>New Sale</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Returns List", $pages) || in_array("Add Return", $pages)):?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-retweet"></i>
            <span>Returns</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(in_array("Returns List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Returns')?>"><i class="fa fa-list"></i><span>Return List</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Return", $pages)):?>
            <li>
              <a href="<?php echo site_url('Returns/new_return')?>"><i class="fa fa-plus"></i><span>Add Return</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Quotation List", $pages) || in_array("Add Quotation", $pages)):?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-qrcode"></i>
            <span>Quotation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Quotation List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Quotation')?>"><i class="fa fa-list"></i><span>Quotation List</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Quotation", $pages)):?>
            <li>
              <a href="<?php echo site_url('Quotation/new_quotation')?>"><i class="fa fa-plus"></i><span>Add Quotation</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Voucher", $pages)):?>
        <li class="treeview">
          <a href="#"><i class="fa fa-credit-card"></i>
            <span>Money Receipt</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(in_array("Voucher", $pages)):?>
            <li>
              <a href="<?php echo base_url('Voucher')?>"><i class="fa fa-list"></i><span>Voucher</span></a>
            </li>
          <?php endif?>
          
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Bank Account", $pages) || in_array("Cash Account", $pages) || in_array("Mobile Account", $pages)):?>
        <li class="treeview">
          <a href="#"> <i class="fa fa-exchange"></i>
            <span>Bank & Cash Transaction </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Bank Account", $pages)):?>
            <li>
              <a href="<?php echo site_url('BankAccount')?>"><i class="fa fa-bank"></i><span>Bank Account</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Cash Account", $pages)):?>
            <li>
              <a href="<?php echo site_url('CashAccount')?>"><i class="fa fa-money"></i><span>Cash Account</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Mobile Account", $pages)):?>
            <li>
              <a href="<?php echo site_url('MobileAccount')?>"><i class="fa fa-mobile fa-lg"></i><span>Mobile Account</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Employee Payment List", $pages) || in_array("Add Employee Payment", $pages)):?>
        <li class="treeview">
          <a href="#"> <i class="fa fa-briefcase"></i>
            <span>Employee Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Employee Payment List", $pages)):?>
            <li>
              <a href="<?php echo site_url('Employee_payment')?>"><i class="fa fa-list"></i><span>Employee Payment List</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Add Employee Payment", $pages)):?>
            <li>
              <a href="<?php echo site_url('Employee_payment/AddInfo')?>"><i class="fa fa-list"></i><span>Employee Payment</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Sales Reports", $pages) || in_array("Purchase Reports", $pages) || in_array("Customer Reports", $pages) || in_array("SalesMan / Employee Report", $pages)|| in_array("Supplier Report", $pages)):?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i><span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul  class="treeview-menu">
          <?php if(in_array("Sales Reports", $pages)):?>
            <li>
              <a href="<?php echo base_url() ?>Sale/all_sales_reports"><i class="fa fa-list"></i>Sales Report</a>
            </li>
          <?php endif?>
          <?php if(in_array("Purchase Reports", $pages)):?>
            <li>
              <a href="<?php echo site_url('Purchase/all_purchases_reports')?>"> <i class="fa fa-list"></i><span>Purchases Report</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Customer Reports", $pages)):?>
            <li>
              <a href="<?php echo site_url('Customer/all_customer_reports')?>"> <i class="fa fa-list"></i><span>Customers Report</span></a>
            </li>
          <?php endif?>
            <li>
              <a href="<?php echo site_url('Customer/customer_ledger')?>"> <i class="fa fa-list"></i><span>Customer Ledger</span></a>
            </li>
            <li>
              <a href="<?php echo site_url('Customer/customer_reports')?>"> <i class="fa fa-list"></i><span>Customer Sales Reports</span></a>
            </li>
            <li>
              <a href="<?php echo site_url('Customer/customer_sale_summary')?>"> <i class="fa fa-list"></i><span>Customer Sales Summary</span></a>
            </li>
          <?php if(in_array("SalesMan / Employee Report", $pages)):?>
            <li>
              <a href="<?php echo base_url() ?>Employee/sales_Man_Report"><i class="fa fa-list"></i>Employee Report</a>
            </li>
          <?php endif?>
            <!--<li>
              <a href="<?php echo base_url() ?>Employee/emp_sales_reports"><i class="fa fa-list"></i>Employee Sales Report</a>
            </li>
            -->
            <li>
              <a href="<?php echo base_url() ?>Employee/emp_product_sales_reports"><i class="fa fa-list"></i>Emp. Sale Product Report</a>
            </li>
            <li>
              <a href="<?php echo site_url('Product/product_sales_reports')?>"> <i class="fa fa-list"></i><span>Sale Product Report</span></a>
            </li>
          <?php if(in_array("Supplier Report", $pages)):?>
            <li>
              <a href="<?php echo site_url('Supplier/supplier_report')?>"><i class="fa fa-list"></i><span>Supplier Report</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Voucher Report", $pages)):?>
            <li>
              <a href="<?php echo site_url('Voucher/voucher_report')?>"><i class="fa fa-list"></i><span>Voucher Report</span></a>
            </li>
          <?php endif?>
            <li>
              <a href="<?php echo site_url('AccountBalance/transactions_list')?>"><i class="fa fa-list"></i><span>All Transaction</span></a>
            </li>
            <li>
              <a href="<?php echo site_url() ?>Voucher/profit_loss"> <i class="fa fa-list"></i><span>Profit / Loss Reports</span></a>
            </li>
            <?php if(in_array("Product Stock Report", $pages)):?>
            <li>
              <a href="<?php echo site_url('Product/product_reports')?>"> <i class="fa fa-list"></i><span>Stock Report</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

      <?php if(in_array("Company / Warehouse", $pages)|| in_array("Supplier", $pages)|| in_array("Customer", $pages)|| in_array("Employee", $pages)|| in_array("Users", $pages)|| in_array("Category", $pages)|| in_array("Units", $pages)|| in_array("Brands", $pages)|| in_array("Department", $pages)|| in_array("Designation", $pages)|| in_array("Users Role", $pages)|| in_array("Expense Type", $pages)|| in_array("Access Permission", $pages)|| in_array("Company Profile", $pages)):?>
        <li class="treeview">
          <a href="#" ><i class="fa fa-gears"></i><span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(in_array("Company / Warehouse", $pages)):?>
            <li>
              <a href="<?php echo site_url('Company')?>"><i class="fa fa-plus"></i><span>Company / Warehouse</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Supplier", $pages)):?>
            <li>
              <a href="<?php echo site_url('Supplier')?>"><i class="fa fa-plus"></i><span>Supplier</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Customer", $pages)):?>
            <li>
              <a href="<?php echo site_url('Customer')?>"><i class="fa fa-plus"></i><span>Customer</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Employee", $pages)):?>
            <li>
              <a href="<?php echo site_url('Employee')?>"><i class="fa fa-plus"></i><span>Employee</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Users", $pages)):?>
            <li>
              <a href="<?php echo site_url('User')?>"><i class="fa fa-plus"></i><span>Users</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Category", $pages)):?>
            <li>
              <a href="<?php echo site_url('Category')?>"><i class="fa fa-plus"></i><span>Category</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Units", $pages)):?>
            <li>
              <a href="<?php echo site_url('units')?>"><i class="fa fa-plus"></i><span>Units</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Brands", $pages)):?>
            <li>
              <a href="<?php echo site_url('brands')?>"><i class="fa fa-plus"></i><span>Brands</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Department", $pages)):?>
            <li>
              <a href="<?php echo base_url() ?>Employee/emp_department"><i class="fa fa-plus"></i>Department</a>
            </li>
          <?php endif?>
          <?php if(in_array("Designation", $pages)):?>
            <li>
              <a href="<?php echo base_url() ?>Employee/emp_designation"><i class="fa fa-plus"></i>Designation</a>
            </li>
          <?php endif?>
          <?php if(in_array("Users Role", $pages)):?>
            <li>
              <a href="<?php echo site_url('AccessLavels')?>"><i class="fa fa-plus"></i><span>User Rules</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Expense Type", $pages)):?>
            <li>
              <a href="<?php echo site_url('Cost')?>"><i class="fa fa-plus"></i><span>Expense Type</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Access Permission", $pages)):?>
            <li>
              <a href="<?php echo site_url('AccessPermission')?>"><i class="fa fa-plus"></i><span>Permissions</span></a>
            </li>
          <?php endif?>
          <?php if(in_array("Company Profile", $pages)):?>
            <li>
              <a href="<?php echo site_url('profile')?>"><i class="fa fa-plus"></i><span>Company Profile</span></a>
            </li>
          <?php endif?>
          </ul>
        </li>
      <?php endif?>

        <li>
          <a href="<?php echo site_url('Login/logout')?>"> <i class="fa fa-user"></i><span>Logout</span></a>
        </li>
      </ul>
    </section>
<!-- /.sidebar -->
  </aside>