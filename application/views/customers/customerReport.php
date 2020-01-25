  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Customer Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url() ?>Customer/all_customer_reports" method="get">
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
                <div>
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
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <?php if(isset($_GET['search'])) { ?>
                    <?php if ($report == 'dailyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                    </div>

                    <?php } else if ($report == 'monthlyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Reports in : <?php echo $name.' '.$year; ?></b></h3>
                    </div>

                    <?php } else if ($report == 'yearlyReports') { ?>
                    <div class="box-header" style="text-align: center;">
                      <h3 class="box-title"><b>Customer Reports in : <?php echo $year; ?></b></h3>
                    </div>
                    <?php } ?>
                  <?php } ?>
                  <div id="table-content">
                    <table id="datatable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#SN.</th>
                          <th>Customer ID</th>
                          <th>Customer</th>
                          <th>Mobile</th>
                          <th>Sales</th>
                          <th>Paid</th>
                          <th>Payment</th>
                          <th>Returns</th>
                          <th>Customer Pay</th>
                          <th>Total Due</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 0;
                        $tob = 0;
                        $tgs = 0;
                        $tda = 0;
                        $tpa = 0;
                        $paa = 0;
                        $tcpa = 0;
                        $tdue = 0;
                        $tr = 0;
                        foreach ($customer as $rep){
                        $i++;
                        $id = $rep['customerID'];

                        if(isset($_GET['search']))
                          {
                          $report = $_GET['reports'];
                          $data['report'] = $report;

                          if($report == 'dailyReports')
                            {
                            $tsale = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal")
                                          ->FROM('sales')
                                          ->WHERE('customerID',$id)
                                          ->where('saleDate >=', $sdate)
                                          ->where('saleDate <=', $edate)
                                          ->get()
                                          ->row();

                            $tvp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Credit Voucher')
                                          ->WHERE('customerID',$id)
                                          ->where('voucherdate >=', $sdate)
                                          ->where('voucherdate <=', $edate)
                                          ->get()
                                          ->row();

                            $tcp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Customer Pay')
                                          ->WHERE('customerID',$id)
                                          ->where('voucherdate >=', $sdate)
                                          ->where('voucherdate <=', $edate)
                                          ->get()
                                          ->row();

                            $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                          ->FROM('returns')
                                          ->WHERE('customerID',$id)
                                          ->where('returnDate >=', $sdate)
                                          ->where('returnDate <=', $edate)
                                          ->get()
                                          ->row();
                            }
                          else if($report == 'monthlyReports')
                            {
                            $tsale = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal")
                                          ->FROM('sales')
                                          ->WHERE('customerID',$id)
                                          ->where('MONTH(saleDate)',$month)
                                          ->where('YEAR(saleDate)',$year)
                                          ->get()
                                          ->row();

                            $tvp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Credit Voucher')
                                          ->WHERE('customerID',$id)
                                          ->where('MONTH(voucherdate)',$month)
                                          ->where('YEAR(voucherdate)',$year)
                                          ->get()
                                          ->row();

                            $tcp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Customer Pay')
                                          ->WHERE('customerID',$id)
                                          ->where('MONTH(voucherdate)',$month)
                                          ->where('YEAR(voucherdate)',$year)
                                          ->get()
                                          ->row();

                            $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                          ->FROM('returns')
                                          ->WHERE('customerID',$id)
                                          ->where('MONTH(returnDate)',$month)
                                          ->where('YEAR(returnDate)',$year)
                                          ->get()
                                          ->row();
                            }
                          else if($report == 'yearlyReports')
                            {
                            $tsale = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal")
                                          ->FROM('sales')
                                          ->WHERE('customerID',$id)
                                          ->where('YEAR(saleDate)',$year)
                                          ->get()
                                          ->row();

                            $tvp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Credit Voucher')
                                          ->WHERE('customerID',$id)
                                          ->where('YEAR(voucherdate)',$year)
                                          ->get()
                                          ->row();

                            $tcp = $this->db->select("SUM(`totalamount`) as total")
                                          ->FROM('vaucher')
                                          ->WHERE('vauchertype','Customer Pay')
                                          ->WHERE('customerID',$id)
                                          ->where('YEAR(voucherdate)',$year)
                                          ->get()
                                          ->row();

                            $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                          ->FROM('returns')
                                          ->WHERE('customerID',$id)
                                          ->where('YEAR(returnDate)',$year)
                                          ->get()
                                          ->row();
                            }
                          }
                        else
                          {
                          $tsale = $this->db->select("SUM(`totalAmount`) as total,SUM(`paidAmount`) as ptotal,SUM(`discountAmount`) as dtotal")
                                        ->FROM('sales')
                                        ->WHERE('customerID',$id)
                                        ->get()
                                        ->row();

                          $tvp = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('vauchertype','Credit Voucher')
                                        ->WHERE('customerID',$id)
                                        ->get()
                                        ->row();

                          $tcp = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('vauchertype','Customer Pay')
                                        ->WHERE('customerID',$id)
                                        ->get()
                                        ->row();

                          $trp = $this->db->select("SUM(`totalPrice`) as total,SUM(`scAmount`) as stotal")
                                        ->FROM('returns')
                                        ->WHERE('customerID',$id)
                                        ->get()
                                        ->row();
                          }
                        ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $rep['customerID']; ?></td>
                          <td><?php echo $rep['customerName']; ?></td>
                          <td><?php echo $rep['mobile']; ?></td>
                          <!-- <td><?php echo number_format($rep['balance'], 2); $tob += $rep['balance']; ?></td> -->
                          <td><?php echo number_format(($tsale->total), 2); $tgs += ($tsale->total); ?></td>
                          
                          <td><?php echo number_format($tsale->ptotal, 2); $tpa += $tsale->ptotal; ?></td>
                          <td><?php echo number_format($tvp->total, 2); $paa += $tvp->total; ?></td>
                          <td><?php echo number_format(($trp->total-$trp->stotal), 2); $tr += ($trp->total-$trp->stotal); ?></td>
                          <td><?php echo number_format($tcp->total, 2); $tcpa += $tcp->total; ?></td>
                          <td>
                            <?php 
                          //$tduea = (($rep['balance']+$tsale->total+$tcp->total)-($tsale->dtotal+$tsale->ptotal+$trp->stotal+$tvp->total+$trp->total)); ?>
                            <?php echo number_format($rep['balance'], 2); $tdue += $rep['balance']; ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" >Total</th>
                          <!-- <th><?php echo number_format($tob, 2); ?></th> -->
                          <th><?php echo number_format($tgs, 2); ?></th>
                          <th><?php echo number_format($tpa, 2); ?></th>
                          <th><?php echo number_format($paa, 2); ?></th>
                          <th><?php echo number_format($tr, 2); ?></th>
                          <th><?php echo number_format($tcpa, 2); ?></th>
                          <th><?php echo number_format($tdue, 2); ?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div><br><br>
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