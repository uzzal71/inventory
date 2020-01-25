  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Supplier Report </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Supplier/supplier_report" method="get">
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
              <div class="col-sm-12 col-md-12 col-xs-12" >
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
                    <h3 class="box-title"><b>Supplier Reports in : <?php echo $sdate.' - '.$edate; ?></b></h3>
                  </div>

                  <?php } else if ($report == 'monthlyReports') { ?>
                  <div class="box-header" style="text-align: center;">
                    <h3 class="box-title"><b>Supplier Reports in : <?php echo $name.' '.$year; ?></b></h3>
                  </div>

                  <?php } else if ($report == 'yearlyReports') { ?>
                  <div class="box-header" style="text-align: center;">
                    <h3 class="box-title"><b>Supplier Reports in : <?php echo $year; ?></b></h3>
                  </div>
                  <?php } ?>
                <?php } ?>

                <div id="table-content">
                  <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#SN.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Opening Balance</th>
                        <th>Total Purchases</th>
                        <th>Total Paid</th>
                        <th>Total Payments</th>
                        <th>Total Due</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      $tob = 0;
                      $tpa = 0;
                      $tap = 0;
                      $taap = 0;
                      $td = 0;
                      foreach ($supplier as $result){
                      $id = $result['supplierID'];

                      if(isset($_GET['search']))
                        {
                        $report = $_GET['reports'];
                        $data['report'] = $report;

                        if($report == 'dailyReports')
                          {
                          $tpp = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
                                        ->FROM('purchase')
                                        ->WHERE('supplier',$id)
                                        ->where('purchaseDate >=', $sdate)
                                        ->where('purchaseDate <=', $edate)
                                        ->get()
                                        ->row();

                          $tvp = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('supplier',$id)
                                        ->where('voucherdate >=', $sdate)
                                        ->where('voucherdate <=', $edate)
                                        ->get()
                                        ->row();
                          }
                        else if($report == 'monthlyReports')
                          {
                          $tpp = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
                                        ->FROM('purchase')
                                        ->WHERE('supplier',$id)
                                        ->where('MONTH(purchaseDate)',$month)
                                        ->where('YEAR(purchaseDate)',$year)
                                        ->get()
                                        ->row();

                          $tvp = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('supplier',$id)
                                        ->where('MONTH(voucherdate)',$month)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();
                          }
                        else if($report == 'yearlyReports')
                          {
                          $tpp = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
                                        ->FROM('purchase')
                                        ->WHERE('supplier',$id)
                                        ->where('YEAR(purchaseDate)',$year)
                                        ->get()
                                        ->row();

                          $tvp = $this->db->select("SUM(`totalamount`) as total")
                                        ->FROM('vaucher')
                                        ->WHERE('supplier',$id)
                                        ->where('YEAR(voucherdate)',$year)
                                        ->get()
                                        ->row();
                          }
                        }
                      else
                        {
                        $tpp = $this->db->select("SUM(`totalPrice`) as total,SUM(`paidAmount`) as ptotal")
                                      ->FROM('purchase')
                                      ->WHERE('supplier',$id)
                                      ->get()
                                      ->row();

                        $tvp = $this->db->select("SUM(`totalamount`) as total")
                                      ->FROM('vaucher')
                                      ->WHERE('supplier',$id)
                                      ->get()
                                      ->row();
                        }
                      $i++;
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['supplierName']; ?></td>
                        <td><?php echo $result['mobile']; ?></td>
                        <td><?php echo number_format($result['balance'], 2); $tob += $result['balance']; ?></td>
                        <td><?php echo number_format($tpp->total, 2); $tpa += $tpp->total; ?></td>
                        <td><?php echo number_format($tpp->ptotal, 2); $tap += $tpp->ptotal; ?></td>
                        <td><?php echo number_format($tvp->total, 2); $taap += $tvp->total; ?></td>
                        <td>
                          <?php $tduea = ($tpp->total+$result['balance'])-($tpp->ptotal+$tvp->total); ?>
                          <?php echo number_format($tduea, 2); $td += $tduea; ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-right" colspan="3">Total</th>
                        <th class="text-right"><?php echo number_format($tob, 2); ?></th>
                        <th class="text-right"><?php echo number_format($tpa, 2); ?></th>
                        <th class="text-right"><?php echo number_format($tap, 2); ?></th>
                        <th class="text-right"><?php echo number_format($taap, 2); ?></th>
                        <th class="text-right"><?php echo number_format($td, 2); ?></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
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