  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Profit / Loss Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Voucher/profit_loss" method="get">
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
                <?php if ($report == 'dailyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Profit Loss Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                </div>

                <?php } else if ($report == 'monthlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Profit Loss Reports in : <?php echo $name.' '.$year; ?></b></h3>
                </div>

                <?php } else if ($report == 'yearlyReports') { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Profit Loss Reports in : <?php echo $year; ?></b></h3>
                </div>
                <?php } ?>
              <?php } ?>

              <div id="table-content">
                <table class="table table-bordered table-striped table-responsive" style="width: 100%;">
                  <thead>
                    <tr>
                      <th colspan="3" style="text-align: center;">Income</th>
                      <th colspan="3" style="text-align: center;">Expense</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Sales Amount</td>
                      <td><?php echo number_format(($sale->total), 2); ?></td>
                      <td>1</td>
                      <td>Purchase Amount</td>
                      <td><?php echo number_format($purchase->total, 2); ?></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Credit Voucher</td>
                      <td><?php echo number_format($cvoucher->total, 2); ?></td>
                      <td>2</td>
                      <td>Debit Voucher / Expense</td>
                      <td><?php echo number_format($dvoucher->total, 2); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>3</td>
                      <td>Employee Payments</td>
                      <td><?php echo number_format($empp->total, 2); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>4</td>
                      <td>Returns</td>
                      <td><?php echo number_format(($return->total-$return->sctotal), 2); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>5</td>
                      <td>Customer Pay</td>
                      <td><?php echo number_format($cusvoucher->total, 2); ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>6</td>
                      <td>Supplier Pay</td>
                      <td><?php echo number_format($svoucher->total, 2); ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: center;">Total Income</td>
                      <td>
                        <?php $ti = $sale->total+$cvoucher->total; ?>
                        <?php echo number_format($ti, 2); ?>
                        </td>
                      <td colspan="2" style="text-align: center;">Total Expense</td>
                      <td>
                        <?php $te = $purchase->total+$dvoucher->total+$empp->total+($return->total-$return->sctotal)+$cusvoucher->total+$svoucher->total; ?>
                        <?php echo number_format($te, 2); ?>
                        </td>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr style="
                      <?php if ($ti > $te){ ?>
                        background: #a5e4ca; border: 2px solid #000;
                      <?php } else if ($ti < $te){ ?>
                        background: red; border: 2px solid #000;
                      <?php } else{ ?>
                        border: 2px solid #000;
                      <?php } ?>
                      ">
                      <th  colspan="3" style="text-align: right;">Net Profit / Loss</th>
                      <th colspan="3" style="text-align: left;"><?php echo number_format(($ti-$te), 2); ?></th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12" align="center" style="margin-top: 20px;">
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p>-----------------------</p>
                  <p>Prepared By</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p>-----------------------</p>
                  <p>Checked By</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p>-----------------------</p>
                  <p>Verified By</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <p>-----------------------</p>
                  <p>Authorized By</p>
                </div>
              </div>
            </div><br>
            <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
              <a href="javascript:void(0)" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
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
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          
          $('#ryear').removeAttr('required','required');
          });

        $('#monthly').click(function(){
          $('#mreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#yreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          
          $('#month').attr('required','required');
          $('#year').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');
          $('#mreports').attr('class','hidden');

          $('#sdate').removeAttr('required','required');
          $('#edate').removeAttr('required','required');
          
          $('#month').removeAttr('required','required');
          $('#year').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          });
        });
    </script>