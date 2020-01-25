  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Employee Sale Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Employee/emp_sales_reports" method="get">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <b>
                    <input type="radio" name="reports" value="dailyReports" id="daily" required >&nbsp;&nbsp;Daily Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="reports" value="monthlyReports" id="monthly" required >&nbsp;&nbsp;Monthly Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="reports" value="yearlyReports" id="yearly" required >&nbsp;&nbsp;Yearly Reports
                  </b>
                </div>

                <div class="hidden" id="dreports">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Start Date *</label>
                      <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('d-m-Y') ?>" id="sdate" required="" >
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>End Date *</label>
                      <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('d-m-Y') ?>" id="edate" required="" >
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Employee *</label>
                      <select name="demp" class="form-control" id="demployee" required="" >
                        <option value="">Select One</option>
                        <?php foreach ($employee as $value) { ?>
                        <option value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-1 col-sm-1 col-xs-12">
                      <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>

                <div class="hidden" id="mreports">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Month *</label>
                      <select class="form-control" name="month" id="month" required="" >
                        <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Year *</label>
                      <select class="form-control" name="year" id="year" required="" >
                        <option value="">Select Year</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Employee *</label>
                      <select name="memp" class="form-control" id="memployee" required="" >
                        <option value="">Select One</option>
                        <?php foreach ($employee as $value) { ?>
                        <option value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-1 col-sm-1 col-xs-12">
                      <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>

                <div class="hidden" id="yreports">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Year *</label>
                      <select class="form-control" name="ryear" id="ryear" required="" >
                        <option value="">Select Year</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Employee *</label>
                      <select name="yemp" class="form-control" id="yemployee" required="" >
                        <option value="">Select One</option>
                        <?php foreach ($employee as $value) { ?>
                        <option value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-1 col-sm-1 col-xs-12">
                      <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>

              </div>
            </form>
          </div><hr>

          <div class="box-body">
            <div id="print">
              <div class="col-sm-12 col-md-12 col-xs-12" id="header" style="display: none" >
                <div class="col-sm-2 col-md-2 col-xs-2" style="margin-top: 30px;">
                  <img src="<?php echo base_url($company->com_logo); ?>"  style="width: 100%;">
                </div>
                <div class="col-sm-10 col-md-10 col-xs-10">
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <h3><b><?php echo $company->com_name; ?></b></h3>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_address; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_email; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Mobile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_mobile; ?></b>
                  </div>
                </div>
              </div>
              <?php if(isset($_GET['search'])) { ?>
              <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <b>To,</b>
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <b><?php echo $empl['employeeName']; ?>&nbsp;,&nbsp;<?php echo $empl['empArea']; ?></b>
                </div>
              </div>
              <?php } ?>
              <div class="col-sm-12 col-md-12 col-xs-12">
              <?php if(isset($_GET['search'])) { ?>
                <?php if ($report == 'dailyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Employee Sale Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                </div>

                <?php } else if ($report == 'monthlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Employee Sale Reports in : <?php echo $name.' '.$year; ?></b></h3>
                </div>

                <?php } else if ($report == 'yearlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Employee Sale Reports in : <?php echo $year; ?></b></h3>
                </div>
                <?php } ?>

                <div id="table-content">
                  <table id="datatable" class="table table-bordered table-striped" style="font-size: 10px;">
                    <thead>
                      <tr>
                        <th>#SN.</th>
                        <th>Chemist Name</th>
                        <th>Area</th>
                        <th>Opening Balance</th>
                        <th>Sales</th>
                        <th>Discount</th>
                        <th>Bonus</th>
                        <th>Net Sales</th>
                        <th>Paid</th>
                        <th>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th colspan="3" style="text-align: center;">Payments Type</th>
                              </tr>
                              <tr>
                                <th>Cash</th>
                                <th>Bank</th>
                                <th>Mobile</th>
                              </tr>
                            </thead>
                          </table>
                        </th>
                        <th>Payment</th>
                        <th>Return</th>
                        <th>Customer Pay</th>
                        <th>Closing Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      $to = 0;
                      $ts = 0;
                      $td = 0;
                      $tb = 0;
                      $tn = 0;
                      $tpaid = 0;
                      $tp = 0;
                      $tr = 0;
                      $tcp = 0;
                      $tc = 0;
                      $tcap = 0;
                      $tbp = 0;
                      $tmp = 0;
                      foreach ($sale as $value){
                      $i++;

                      if(isset($_GET['search']))
                        {
                        $report = $_GET['reports'];
                        $data['report'] = $report;

                        if($report == 'dailyReports')
                          {
                          $tcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('voucherdate >=',$sdate)
                                        ->where('voucherdate <=',$edate)
                                        ->get()
                                        ->row();

                          $tcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('voucherdate >=',$sdate)
                                        ->where('voucherdate <=',$edate)
                                        ->get()
                                        ->row();

                          $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('returnDate >=', $sdate)
                                        ->where('returnDate <=', $edate)
                                        ->get()
                                        ->row();

                          $ptcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('voucherdate <',$sdate)
                                        ->get()
                                        ->row();

                          $ptcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('voucherdate <',$sdate)
                                        ->get()
                                        ->row();

                          $ptrp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('returnDate <', $sdate)
                                        ->get()
                                        ->row();

                          $tccv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Cash')
                                        ->where('voucherdate >=', $sdate)
                                        ->where('voucherdate <=', $edate)
                                        ->get()
                                        ->row();

                          $tbcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Bank')
                                        ->where('voucherdate >=', $sdate)
                                        ->where('voucherdate <=', $edate)
                                        ->get()
                                        ->row();

                          $tmcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Mobile')
                                        ->where('voucherdate >=', $sdate)
                                        ->where('voucherdate <=', $edate)
                                        ->get()
                                        ->row();
                          
                          $tpba = $this->db->select("SUM(`bonusAmount`) as total,sales.saleDate,sales.customerID")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('saleDate >=', $sdate)
                                        ->where('saleDate <=', $edate)
                                        ->get()
                                        ->row();
                          }
                        else if($report == 'monthlyReports')
                          {
                          $tcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('MONTH(returnDate)',$month)
                                        ->where('YEAR(returnDate)',$year)
                                        ->get()
                                        ->row();

                          $ptcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('MONTH(voucherdate) <',$month)
                                        ->where('YEAR(voucherdate) <=',$year)
                                        ->get()
                                        ->row();

                          $ptcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('MONTH(voucherdate) <',$month)
                                        ->where('YEAR(voucherdate) <=',$year)
                                        ->get()
                                        ->row();

                          $ptrp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('MONTH(returnDate) <',$month)
                                        ->where('YEAR(returnDate) <=',$year)
                                        ->get()
                                        ->row();

                          $tccv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Cash')
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tbcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Bank')
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tmcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Mobile')
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();
                          
                          $tpba = $this->db->select("SUM(`bonusAmount`) as total,sales.saleDate,sales.customerID")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('MONTH(saleDate)',$month)
                                        ->where('YEAR(saleDate)',$year)
                                        ->get()
                                        ->row();
                          }
                        else if($report == 'yearlyReports')
                          {
                          $tcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('YEAR(returnDate)',$year)
                                        ->get()
                                        ->row();

                          $ptcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('YEAR(voucherdate) <',$year)
                                        ->get()
                                        ->row();

                          $ptcpv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Customer Pay')
                                        ->where('YEAR(voucherdate) <',$year)
                                        ->get()
                                        ->row();

                          $ptrp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('YEAR(returnDate) <',$year)
                                        ->get()
                                        ->row();

                          $tccv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Cash')
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tbcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Bank')
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();

                          $tmcv = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('vauchertype','Credit Voucher')
                                        ->where('accountType','Mobile')
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();
                          
                          $tpba = $this->db->select("SUM(`bonusAmount`) as total,sales.saleDate,sales.customerID")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('customerID',$value->customerID)
                                        ->where('YEAR(saleDate)',$year)
                                        ->get()
                                        ->row();
                          }
                        }
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->compname; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td>
                          <?php 
                          //$pbalance = (($value->balance+$ptcv->total)-($ptcpv->total+$ptrp->total));
                            $pbalance = $this->pm->get_employee_closing_balance($value->customerID);
                          ?>
                          <?php echo number_format(($pbalance), 2); $to += $pbalance; ?>
                        </td>
                        <td><?php echo number_format($value->total, 2); $ts += $value->total; ?></td>
                        <td><?php echo number_format($value->dtotal, 2); $td += $value->dtotal; ?></td>
                        <td><?php if($tpba){ ?><?php echo number_format($tpba->total, 2); $tb += $tpba->total; ?><?php } ?></td>
                        <td><?php echo number_format(($value->total-$value->dtotal), 2); $tn += ($value->total-$value->dtotal); ?></td>
                        <td><?php echo number_format($value->ptotal, 2); $tpaid += $value->ptotal; ?></td>
                        <td>
                          <table class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <td>
                                  <?php if($tccv) { ?>
                                  <td><?php echo number_format($tccv->total, 2); $tcap += $tccv->total; ?></td>
                                  <?php } else{ ?>
                                  <?php echo "00"; ?>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php if($tbcv) { ?>
                                  <td><?php echo number_format($tbcv->total, 2); $tbp += $tbcv->total; ?></td>
                                  <?php } else{ ?>
                                  <?php echo "00"; ?>
                                  <?php } ?>
                                </td> 
                                <td>
                                  <?php if($tmcv) { ?>
                                  <td><?php echo number_format($tmcv->total, 2); $tmp += $tmcv->total; ?></td>
                                  <?php } else{ ?>
                                  <?php echo "00"; ?>
                                  <?php } ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td><?php echo number_format($tcv->total, 2); $tp += $tcv->total; ?></td>
                        <td><?php echo number_format(($trp->total-$trp->stotal), 2); $tr += ($trp->total-$trp->stotal); ?></td>
                        <td><?php echo number_format($tcpv->total, 2); $tcp += $tcpv->total; ?></td>
                        <td>
                          <?php $tcb = ($value->total+$tcpv->total)-($pbalance+$value->ptotal+$tcv->total+($trp->total-$trp->stotal)+$value->dtotal); ?>
                          <?php echo number_format($tcb, 2); $tc += $tcb; ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3" style="text-align: right;" >Total</th>
                        <th><?php echo number_format($to,2); ?></th>
                        <th><?php echo number_format($ts, 2); ?></th>
                        <th><?php echo number_format($td, 2); ?></th>
                        <th><?php echo number_format($tb, 2); ?></th>
                        <th><?php echo number_format($tn, 2); ?></th>
                        <th><?php echo number_format($tpaid, 2); ?></th>
                        <th></th>
                        <th><?php echo number_format($tp, 2); ?></th>
                        <th><?php echo number_format($tr, 2); ?></th>
                        <th><?php echo number_format($tcp, 2); ?></th>
                        <th><?php echo number_format($tc, 2); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <table class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                  <tr align="center">
                    <td class="col-md-3 col-sm-3 col-xs-3">
                      <p>------------------------------</p>
                      <p>Prepared By</p>
                    </td>
                    <td class="col-md-3 col-sm-3 col-xs-3">
                      <p>------------------------------</p>
                      <p>Checked By</p>
                    </td>
                    <td class="col-md-3 col-sm-3 col-xs-3">
                      <p>------------------------------</p>
                      <p>Verified By</p>
                    </td>
                    <td class="col-md-3 col-sm-3 col-xs-3">
                      <p>------------------------------</p>
                      <p>Authorized By</p>
                    </td>
                  </tr>
                </table>
              <?php } ?>
              </div>
            </div><br>
            <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
              <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i>  Print</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


    <script>
      $(document).ready(function() {
        $('#daily').click(function(){
          $('#dreports').removeAttr('class','hidden');
          $('#mreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').attr('required','required');
          $('#edate').attr('required','required');
          $('#demployee').attr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#memployee').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#yemployee').attr('required','required');
          });
        });
    </script>