  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Sales Report</h1>
    </section>

    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-xs-12">
            <form action="<?php echo base_url() ?>Sale/all_sales_reports" method="get">
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
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Start Date *</label>
                      <input type="text" class="form-control datepicker" name="sdate" value="<?php echo date('d-m-Y') ?>" id="sdate" required="" >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>End Date *</label>
                      <input type="text" class="form-control datepicker" name="edate" value="<?php echo date('d-m-Y') ?>" id="edate" required="" >
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Company / Warehouse</label>
                      <select name="dcompany" class="form-control" id="dcompany" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($comp as $value) { ?>
                        <option value="<?php echo $value['companyID']; ?>" ><?php echo $value['companyName']; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Customer</label>
                      <select name="dcustomer" class="form-control" id="dcustomer" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($customer as $value) { ?>
                        <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Employee / Salesman</label>
                      <select name="demployee" class="form-control" id="demployee" required="" >
                        <option value="All">Select All</option>
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
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
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
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
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
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Company / Warehouse</label>
                      <select name="mcompany" class="form-control" id="mcompany" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($comp as $value) { ?>
                        <option value="<?php echo $value['companyID']; ?>" ><?php echo $value['companyName']; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Customer</label>
                      <select name="mcustomer" class="form-control" id="mcustomer" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($customer as $value) { ?>
                        <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Employee / Salesman</label>
                      <select name="memployee" class="form-control" id="memployee" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($employee as $value) { ?>
                        <option value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                        <?php } ?>
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
                      <label>Company / Warehouse</label>
                      <select name="ycompany" class="form-control" id="ycompany" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($comp as $value) { ?>
                        <option value="<?php echo $value['companyID']; ?>" ><?php echo $value['companyName']; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Customer</label>
                      <select name="ycustomer" class="form-control" id="ycustomer" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($customer as $value) { ?>
                        <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Employee / Salesman</label>
                      <select name="yemployee" class="form-control" id="yemployee" required="" >
                        <option value="All">Select All</option>
                        <?php foreach ($employee as $value) { ?>
                        <option value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                        <?php } ?>
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
                <h3 class="box-title"><b>Sales Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
              </div>

            <?php } else if ($report == 'monthlyReports') { ?>
              <div class="box-header" style="text-align: center;">
                <h3 class="box-title"><b>Sales Reports in : <?php echo $name.' '.$year; ?></b></h3>
              </div>

            <?php } else if ($report == 'yearlyReports') { ?>
              <div class="box-header" style="text-align: center;">
                <h3 class="box-title"><b>Sales Reports in : <?php echo $year; ?></b></h3>
              </div>
            <?php } ?>
          <?php } ?>
          <div id="table-content">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#SN.</th>
                  <th>Date</th>
                  <th>Company</th>
                  <th>Employee</th>
                  <th>Customer</th>
                  <th>Grand Total</th>
                  <th>Paid Amount</th>
                  <th>Discount Amount</th>
                  <th>Due Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $ts = 0;
                $tp = 0;
                $td = 0;
                $tdue = 0;
                foreach ($sales as $sale){
                $i++;
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($sale->saleDate)); ?></td>
                  <td><?php echo $sale->companyName; ?></td>
                  <td><?php echo $sale->employeeName; ?></td>
                  <td><?php echo $sale->customerName; ?></td>
                  <td><?php echo number_format($sale->totalAmount, 2); $ts += $sale->totalAmount; ?></td>
                  <td><?php echo number_format($sale->paidAmount, 2); $tp += $sale->paidAmount; ?></td>
                  <td><?php echo number_format($sale->discountAmount, 2); $td += $sale->discountAmount; ?></td>
                  <!--<td><?php echo number_format(($sale->totalAmount-($sale->paidAmount)), 2); $tdue1 += ($sale->totalAmount-($sale->paidAmount)); ?></td>-->
                  <td><?php echo number_format((($sale->totalAmount-($sale->paidAmount)) - $sale->discountAmount), 2); $tdue += (($sale->totalAmount-($sale->paidAmount)) - $sale->discountAmount); ?></td>
                </tr>  
                <?php } ?>
              </tbody>
              <tfoot>
                <th colspan="5" style="text-align: right;">Total</th>
                <th><?php echo number_format($ts, 2); ?></th>
                <th><?php echo number_format($tp, 2); ?></th>
                <th><?php echo number_format($td, 2); ?></th>
                <th><?php echo number_format($tdue, 2); ?></th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">      
        <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
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
          $('#dcompany').attr('required','required');
          $('#dcustomer').attr('required','required');
          $('#demployee').attr('required','required');

          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcompany').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');

          $('#ryear').removeAttr('required','required');
          $('#ycompany').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcompany').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');

          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#mcompany').attr('required','required');
          $('#mcustomer').attr('required','required');
          $('#memployee').attr('required','required');

          $('#ryear').removeAttr('required','required');
          $('#ycompany').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');
          $('#yemployee').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcompany').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          $('#demployee').removeAttr('required','required');

          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcompany').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          $('#memployee').removeAttr('required','required');

          $('#ryear').attr('required','required');
          $('#ycompany').attr('required','required');
          $('#ycustomer').attr('required','required');
          $('#yemployee').attr('required','required');
          });
        });
    </script>
    
        <script type="text/javascript">
        $(document).ready(function(){
 
          // Initialize select2
          $("#demployee").select2();
          $("#memployee").select2();
          $("#yemployee").select2();
          
          $("#dcustomer").select2();
          $("#dcustomer").select2();
          $("#ycustomer").select2();


        });
        
         </script>