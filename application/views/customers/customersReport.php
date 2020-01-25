  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Customer Sale Reports</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url() ?>Customer/customer_reports" method="get">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <b>
                      <input type="radio" name="reports" value="ocust" id="ocust" required >&nbsp;&nbsp;Only Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                    <b>Chemist Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['compname']; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Proprietor&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['customerName']; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['address']; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Contact No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $customer['mobile']; ?></b>
                  </div>
                </div>

                <?php if ($report == 'dailyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Gross Sales & Collection with statements : <?php echo $sdate.' - '.$edate; ?></b></h3>
                </div>

                <?php } else if ($report == 'monthlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Gross Sales & Collection with statements : <?php echo $name.' '.$year; ?></b></h3>
                </div>

                <?php } else if ($report == 'yearlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Gross Sales & Collection with statements : <?php echo $year; ?></b></h3>
                </div>
                <?php } ?>
                  
                <div id="table-content">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#SN.</th>
                        <th>Date</th>
                        <th>Invoice No.</th>
                        <th>Gross Sales</th>
                        <th>Discount</th>
                        <th>Bonus</th>
                        <th>Net Sales</th>
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
                        <th>Total Due</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      $ts = 0;
                      $td = 0;
                      $tb = 0;
                      $tn = 0;
                      $tp = 0;
                      $tda = 0;
                      foreach ($sale as $value){
                      $i++;
                      $sba = $this->db->select("SUM(`bonusAmount`) as pba")
                                    ->FROM('sale_product')
                                    ->where('saleID',$value->saleID)
                                    ->get()
                                    ->row();

                      $ccva = $this->db->select("SUM(`totalamount`) as total")
                                    ->FROM('vaucher')
                                    ->where('invoice',$value->saleID)
                                    ->where('accountType','Cash')
                                    ->get()
                                    ->row();
                      if ($ccva)
                        {
                        $tccva = $ccva->total;
                        }
                      else
                        {
                        $tccva = 0;
                        }

                      $bcva = $this->db->select("SUM(`totalamount`) as total")
                                    ->FROM('vaucher')
                                    ->where('invoice',$value->saleID)
                                    ->where('accountType','Bank')
                                    ->get()
                                    ->row();

                      if ($bcva)
                        {
                        $tbcva = $bcva->total;
                        }
                      else
                        {
                        $tbcva = 0;
                        }

                      $mcva = $this->db->select("SUM(`totalamount`) as total")
                                    ->FROM('vaucher')
                                    ->where('invoice',$value->saleID)
                                    ->where('accountType','Mobile')
                                    ->get()
                                    ->row();

                      if ($mcva)
                        {
                        $tmcva = $mcva->total;
                        }
                      else
                        {
                        $tmcva = 0;
                        }
                      $pat = $tccva+$tbcva+$tmcva;

                      $return = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as sctotal")
                                    ->FROM('returns')
                                    ->where('invoice',$value->saleID)
                                    ->get()
                                    ->row();
                      ?>
                      <tr class="gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($value->saleDate)); ?></td>
                        <td><?php echo $value->saleID; ?></td>
                        <td><?php echo number_format(($value->totalAmount), 2); $ts += $value->totalAmount; ?></td> 
                        <td><?php echo number_format(($value->discountAmount), 2); $td += $value->discountAmount; ?></td>
                        <td><?php echo number_format($sba->pba, 2); $tb += $sba->pba; ?></td>
                        <td><?php echo number_format(($value->totalAmount-$value->discountAmount), 2); $tn += ($value->totalAmount-$value->discountAmount); ?></td>
                        <td>
                          <table class="table table-bordered table-striped">
                            <tbody>
                              <tr>
                                <td>
                                  <?php if($value->accountType == 'Cash') { ?>
                                  <?php echo number_format(($value->paidAmount+$tccva), 2); ?>
                                  <?php } else{ ?>
                                  <?php echo number_format($tccva, 2); ?>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php if($value->accountType == 'Bank') { ?>
                                  <?php echo number_format(($value->paidAmount+$tbcva), 2); ?>
                                  <?php } else{ ?>
                                  <?php echo number_format($tbcva, 2); ?>
                                  <?php } ?>
                                </td> 
                                <td>
                                  <?php if($value->accountType == 'Mobile') { ?>
                                  <?php echo number_format(($value->paidAmount+$tbcva), 2); ?>
                                  <?php } else{ ?>
                                  <?php echo number_format($tmcva, 2); ?>
                                  <?php } ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td><?php echo number_format(($value->paidAmount+$pat), 2); $tp += $value->paidAmount+$pat; ?></td>
                        <td>
                          <?php if($return) { ?>
                          <?php echo number_format(($return->total-$return->sctotal), 2); ?>
                          <?php } else{ ?>
                          <?php echo "00"; ?>
                          <?php } ?>
                        </td>
                        <td><?php echo number_format(($value->totalAmount-(($value->paidAmount+$value->discountAmount)+($return->total-$return->sctotal)+$pat)), 2); $tda += ($value->totalAmount-(($value->paidAmount+$value->discountAmount)+($return->total-$return->sctotal)+$pat)); ?></td> 
                      </tr>   
                      <?php } ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3" >Total</th>
                        <th><?php echo number_format($ts, 2); ?></th>
                        <th><?php echo number_format($td, 2); ?></th>
                        <th><?php echo number_format($tb, 2); ?></th>
                        <th><?php echo number_format($tn, 2); ?></th>
                        <th></th>
                        <th><?php echo number_format($tp, 2); ?></th>
                        <th></th>
                        <th><?php echo number_format($tda, 2); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><br>

                <!--<div class="col-sm-12 col-md-12 col-xs-12">
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Total Net Sales Amount (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format($tn, 2); ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Total Paid Amount (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format($tp, 2); ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Total Due Amount (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format($tda, 2); ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <?php $payments = ($cvoucher->total+$return->total)-($dvoucher->total+$return->sctotal); ?>
                    <b>Total Payments Amount (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format($payments, 2); ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <?php if($psale){ ?>
                    <?php $pdue = ($psale->total+$pdvoucher->total+$customer['balance'])-($psale->ptotal+$psale->dtotal+$pcvoucher->total+($preturn->total-$preturn->sctotal)); ?>
                    <?php } else { ?>
                    <?php $pdue = $customer['balance']; ?>
                    <?php } ?>
                    <b>Previous Due (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format($pdue, 2); ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Net Payable Amount (Taka)&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo number_format((($tda+$pdue)), 2); ?></b>
                  </div>
                </div>-->

                <br>

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