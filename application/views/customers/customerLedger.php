  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Customer Ledger</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url() ?>Customer/customer_ledger" method="get">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <b>
                      <input type="radio" name="reports" value="ocust" id="ocust" required >&nbsp;&nbsp;Customer All Ledger&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        <label>Customer *</label>
                        <select name="dcustomer" class="form-control" id="dcustomer" required="" >
                          <option value="">Select One</option>
                          <?php foreach ($cust as $value) { ?>
                          <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
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
                        <label>Customer *</label>
                        <select name="mcustomer" class="form-control" id="mcustomer" required="" >
                          <option value="">Select One</option>
                          <?php foreach ($cust as $value) { ?>
                          <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
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
                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
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
                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label>Customer *</label>
                        <select name="ycustomer" class="form-control" id="ycustomer" required="" >
                          <option value="">Select One</option>
                          <?php foreach ($cust as $value) { ?>
                          <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-1 col-sm-1 col-xs-12">
                        <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
                      </div>
                    </div>
                  </div>

                  <div class="hidden" id="reports">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label>Customer *</label>
                        <select name="customer" class="form-control" id="customer" required="" >
                          <option value="">Select One</option>
                          <?php foreach ($cust as $value) { ?>
                          <option value="<?php echo $value['customerID']; ?>" ><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
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
                <div style="">
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
                        <b>Dealer ID&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['customerID']; ?></b>
                      </div>
                      <div class="col-sm-12 col-md-12 col-xs-12">
                        <b>Dealers Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['compname']; ?></b>
                      </div>
                      <div class="col-sm-12 col-md-12 col-xs-12">
                        <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['address']; ?></b>
                      </div>
                      <div class="col-sm-12 col-md-12 col-xs-12">
                        <b>Proprietor&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['customerName']; ?></b>
                      </div>
                      <div class="col-sm-12 col-md-12 col-xs-12">
                        <b>Contact No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['mobile']; ?></b>
                      </div>
                    </div>
                    <?php if ($report == 'dailyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Ledger Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                    </div>

                    <?php } else if ($report == 'monthlyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Ledger Reports in : <?php echo $name.' '.$year; ?></b></h3>
                    </div>

                    <?php } else if ($report == 'yearlyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Ledger Reports in : <?php echo $year; ?></b></h3>
                    </div>
                    <?php } ?>
                  
                  <div id="table-content">
                    <table id="datatable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#SN.</th>
                          <th>Date</th>
                          <th>Particulars</th>
                          <th>Invoice No.</th>
                          <th>Invoice Value</th>
                          <th>Discount</th>
                          <th>Payment</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($sale != null) { ?>

                        <?php
                        $i = 0;
                        $tsia = 0;
                        $tsda = 0;
                        $tspa = 0;
                        $tsba = 0;
                        foreach ($sale as $value){
                        $i++;
                        ?>
                        <tr class="gradeX">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($value->saleDate)); ?></td>
                          <td><?php echo 'Sales'; ?></td>
                          <td><?php echo $value->saleID; ?></td>
                          <td><?php echo number_format(($value->totalAmount), 2); $tsia += $value->totalAmount; ?></td> 
                          <td><?php echo number_format(($value->discountAmount), 2); $tsda += $value->discountAmount; ?></td> 
                          <td><?php echo number_format(($value->paidAmount), 2); $tspa += $value->paidAmount; ?></td> 
                          <td><?php echo number_format(($value->totalAmount-($value->paidAmount)), 2); $tsba += ($value->totalAmount-($value->paidAmount)); ?></td> 
                        </tr>   
                        <?php } ?> 
                        <?php } else{ ?>
                        <?php $i = 0; ?>
                        <?php $tsia = 0; $tsda = 0; $tspa = 0; $tsba = 0; ?>
                        <?php } ?>

                        <?php if ($voucher != null) { ?>

                        <?php
                        $j = $i;
                        $tvia = 0;
                        $tvpa = 0;
                        $tvba = 0;
                        foreach ($voucher as $key => $value) {
                        $j++;
                        ?>
                        <tr class="gradeX">
                          <td><?php echo $j; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($value->voucherdate)); ?></td>
                          <td>
                            <?php if($value->vauchertype == 'Credit Voucher') { ?>
                            <?php echo 'Voucher'.' ( '.$value->vauchertype.' )'; ?>
                            <?php } else if($value->vauchertype == 'Customer Pay'){ ?>
                            <?php echo 'Voucher'.' ( '.$value->vauchertype.' )'; ?>
                            <?php } else{ ?>
                            <?php echo "N/A"; ?>
                            <?php } ?>
                          </td>
                          <td><?php echo $value->vuid; ?></td>
                          <td><?php echo number_format(($value->totalamount), 2); $tvia += $value->totalamount; ?></td> 
                          <td><?php echo '00'; ?></td> 
                          <td><?php echo number_format(($value->totalamount), 2); $tvpa += $value->totalamount; ?></td> 
                          <td><?php echo number_format(($value->totalamount), 2); $tvba += ($value->totalamount); ?></td> 
                        </tr>   
                        <?php } ?>
                        <?php } else{ ?>
                        <?php $j = $i or $j = 0; ?>
                        <?php $tvia = 0; $tvpa = 0; $tvba = 0; ?>
                        <?php } ?> 

                        <?php if ($return != null) { ?>

                        <?php
                        $k = $j;
                        $tria = 0;
                        $trda = 0;
                        $trpa = 0;
                        $trba = 0;
                        foreach ($return as $key => $value) {
                        $k++;
                        ?>
                        <tr class="gradeX">
                          <td><?php echo $k; ?></td>
                          <td><?php echo date('d-m-Y',strtotime($value->returnDate)); ?></td>
                          <td><?php echo 'Product Returns'; ?></td>
                          <td><?php echo $value->returnId; ?></td>
                          <td><?php echo number_format(($value->totalPrice), 2); $tria += $value->totalPrice; ?></td> 
                          <td><?php echo number_format(($value->scAmount), 2); $trda += $value->scAmount; ?></td> 
                          <td><?php echo number_format(($value->totalPrice-$value->scAmount), 2); $trpa += ($value->totalPrice-$value->scAmount); ?></td> 
                          <td><?php echo number_format(($value->totalPrice-$value->scAmount), 2); $trba += ($value->totalPrice-$value->scAmount); ?></td>
                        </tr>   
                        <?php } ?>
                        <?php } else{ ?>
                        <?php $tria = 0; $trda = 0; $trpa = 0; $trba = 0; ?>
                        <?php } ?> 
                      </tbody>
                    </table>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <table class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                      <tr align="center">
                        <td class="col-md-4 col-sm-4 col-xs-4">
                          <p>------------------------------</p>
                          <p>Prepared By</p>
                        </td>
                        <td class="col-md-4 col-sm-4 col-xs-4">
                          <p>------------------------------</p>
                          <p>Verified By</p>
                        </td>
                        <td class="col-md-4 col-sm-4 col-xs-4">
                          <p>------------------------------</p>
                          <p>Authorized By</p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <?php } ?>
                </div>
              </div><br>
              <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
                <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i>  Print</a>
              </div>
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
          $('#reports').attr('class','hidden');

          $('#sdate').attr('required','required');
          $('#edate').attr('required','required');
          $('#dcustomer').attr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');

          $('#customer').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');
          $('#reports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          $('#mcustomer').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');

          $('#customer').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');
          $('#reports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#ycustomer').attr('required','required');

          $('#customer').removeAttr('required','required');
          });

        $('#ocust').click(function(){
          $('#yreports').attr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');
          $('#reports').removeAttr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          $('#dcustomer').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          $('#mcustomer').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#ycustomer').removeAttr('required','required');

          $('#customer').attr('required','required');
          });
        });
    </script>