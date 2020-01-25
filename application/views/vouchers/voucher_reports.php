  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Voucher Report</h1>
    </section>

    <div class="box">
      <div class="box-body">
        <div class="row" style="margin-bottom: 20px;">
          <div class="col-sm-12 col-md-12 col-xs-12">
            <form action="<?php echo base_url() ?>Voucher/voucher_report" method="get">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <b>
                    <input type="radio" name="reports" value="dailyReports" id="daily" required >&nbsp;&nbsp;Daily Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="reports" value="monthlyReports" id="monthly" required >&nbsp;&nbsp;Monthly Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="reports" value="yearlyReports" id="yearly" required >&nbsp;&nbsp;Yearly Reports
                  </b>
                </div>

                <div class="hidden" id="dreports">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Start Date *</label>
                      <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('d-m-Y') ?>" id="sdate" required="" >
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>End Date *</label>
                      <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('d-m-Y') ?>" id="edate" required="" >
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                      <label>Voucher Type *</label>
                      <select class="form-control" name="dvtype" id="dvtype" required="" >
                        <option value="All">All</option>
                        <option value="Credit Voucher">Credit Voucher</option>
                        <option value="Debit Voucher">Debit Voucher</option>
                        <option value="Customer Pay">Customer Pay</option>
                        <option value="Supplier Pay">Supplier Pay</option>
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
                      <label>Voucher Type *</label>
                      <select class="form-control" name="mvtype" id="mvtype" required="" >
                        <option value="All">All</option>
                        <option value="Credit Voucher">Credit Voucher</option>
                        <option value="Debit Voucher">Debit Voucher</option>
                        <option value="Customer Pay">Customer Pay</option>
                        <option value="Supplier Pay">Supplier Pay</option>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <div class="form-group">
                        <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="hidden" id="yreports">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
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
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Voucher Type *</label>
                      <select class="form-control" name="yvtype" id="yvtype" required="" >
                        <option value="All">All</option>
                        <option value="Credit Voucher">Credit Voucher</option>
                        <option value="Debit Voucher">Debit Voucher</option>
                        <option value="Customer Pay">Customer Pay</option>
                        <option value="Supplier Pay">Supplier Pay</option>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                      <div class="form-group">
                        <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>

        <div id="print">
          <div class="col-sm-12 col-md-12 col-xs-12" id="header" style="display: none" >
            <div class="col-sm-2 col-md-2 col-xs-2" style="margin-top: 30px;">
              <img src="<?php echo base_url($company->com_logo); ?>" style="width: 100%;" >
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
            <?php if ($report == 'dailyReports') { ?>
              <div class="box-header" style="text-align: center;">
                <h3 class="box-title"><b>Voucher Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
              </div>

            <?php } else if ($report == 'monthlyReports') { ?>
              <div class="box-header" style="text-align: center;">
                <h3 class="box-title"><b>Voucher Reports in : <?php echo $name.' '.$year; ?></b></h3>
              </div>

            <?php } else if ($report == 'yearlyReports') { ?>
              <div class="box-header" style="text-align: center;">
                <h3 class="box-title"><b>Voucher Reports in : <?php echo $year; ?></b></h3>
              </div>
            <?php } ?>
          <?php } ?>
          <div id="table-content">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#SN'</th>
                  <th>Date</th>
                  <th>Voucher Type</th>
                  <th>Company</th>
                  <th>Customer</th>
                  <th>Employee</th>
                  <th>Supplier</th>
                  <th>Credit Amount</th>
                  <th>Debit Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $tc = 0;
                $td = 0;
                foreach ($voucher as $value){
                $i++;
                $cid = $value->customerID;
                $eid = $value->employee;
                $sid = $value->supplier;

                $customer = $this->db->select('customerID,customerName')
                                    ->from('customers')
                                    ->where('customerID',$cid)
                                    ->get()
                                    ->row();

                $employee = $this->db->select('employeeID,employeeName')
                                    ->from('employees')
                                    ->where('employeeID',$eid)
                                    ->get()
                                    ->row();

                $supplier = $this->db->select('supplierID,supplierName')
                                    ->from('suppliers')
                                    ->where('supplierID',$sid)
                                    ->get()
                                    ->row();
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($value->voucherdate)); ?></td>
                  <td><?php echo $value->vauchertype; ?></td>
                  <td><?php echo $value->companyName; ?></td>
                  <td>
                    <?php if($value->customerID == 0){ ?>
                    <?php echo 'N/A'; ?>
                    <?php } else{ ?>
                    <?php echo $customer->customerName; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($value->employee == 0){ ?>
                    <?php echo 'N/A'; ?>
                    <?php } else{ ?>
                    <?php echo $employee->employeeName; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($value->supplier == 0){ ?>
                    <?php echo 'N/A'; ?>
                    <?php } else{ ?>
                    <?php echo $supplier->supplierName; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($value->vauchertype == 'Credit Voucher'){ ?>
                    <?php echo number_format($value->totalamount, 2); $tc += $value->totalamount; ?>
                    <?php } else{ ?>
                    <?php echo '00'; ?>
                    <?php } ?>
                  </td>
                  <td>
                    <?php if($value->vauchertype == 'Debit Voucher' || $value->vauchertype == 'Customer Pay' || $value->vauchertype == 'Supplier Pay'){ ?>
                    <?php echo number_format($value->totalamount, 2); $td += $value->totalamount; ?>
                    <?php } else{ ?>
                    <?php echo '00'; ?>
                    <?php } ?>
                  </td>
                </tr>  
                <?php } ?>
              </tbody>
              <tfoot>
                <th colspan="7" style="text-align: right;">Total</th>
                <th><?php echo number_format($tc, 2); ?></th>
                <th><?php echo number_format($td, 2); ?></th>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">      
          <a href="javascript:void(0)" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
        </div>
        <div class="col-sm-12 col-md-12 col-xs-12">
          <a href="<?php echo site_url('Voucher') ?>" class="btn btn-danger btn-lg pull-right" style="margin-right:10px"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
      </div>
    </div>
  </div>

    <script>
      $(document).ready(function() {
        $('#daily').click(function(){
          $('#dreports').removeAttr('class','hidden');
          $('#mreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').attr('required','required');
          $('#edate').attr('required','required');
          $('#dvtype').attr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mvtype').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yvtype').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dvtype').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#mvtype').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yvtype').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dvtype').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mvtype').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#yvtype').attr('required','required');
          });
        });
    </script>