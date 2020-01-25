  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Employee Sale Product Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Employee/emp_product_sales_reports" method="get">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                  <b>
                    <input type="radio" name="reports" value="dailyReports" id="daily" required >&nbsp;&nbsp;All Sales Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="reports" value="yearlyReports" id="yearly" required >&nbsp;&nbsp;Yearly Reports
                  </b>
                </div>
                <div class="hidden" id="dreports">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                      <label>Employee *</label>
                      <select name="employeeID" class="form-control" id="employeeID" required="" >
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
                    <label>Employee *</label>
                    <select name="yemployeeID" class="form-control" id="yemployeeID" required="" >
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
              <div class="col-sm-12 col-md-12 col-xs-12">
              <?php if(isset($_GET['search'])) { ?>
                <?php if ($report == 'yearlyReports') { ?>
                <div class="col-sm-12 col-md-12 col-xs-12">
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Officer's Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $emp['employeeName']; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Area&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $emp['empaddress']; ?></b>
                  </div>
                  <div class="col-sm-12 col-md-12 col-xs-12">
                    <b>Position&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $emp['dept_name']; ?></b>
                  </div>
                </div>
                
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Officer wise Monthly sales Reports in : <?php echo $year; ?></b></h3>
                </div>
                <?php } else { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Officer wise All sales Reports</b></h3>
                </div>
                <?php } ?>

                <div id="table-content">
                  <table id="datatable" class="table table-bordered table-striped" style="font-size: 10px;" >
                    <thead>
                      <tr>
                        <th>#SN.</th>
                        <th>Products Name</th>
                        <th>January</th>
                        <th>February</th>
                        <th>March</th>
                        <th>April</th>
                        <th>May</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th>
                        <th>Total Sales</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;
                      foreach ($product as $value){
                      $i++;
                      $id = $value['productID'];

                      if(isset($_GET['search']))
                        {
                        $report = $_GET['reports'];
                //var_dump($report); exit();
                        if($report == 'yearlyReports')
                          {
                          $jants = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',1)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $febts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',2)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $marts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',3)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $aprts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',4)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $mayts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',5)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $junts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',6)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $jults = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',7)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $augts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',8)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $septs = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',9)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $octts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',10)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $novts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',11)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $dects = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',12)
                                        ->where('YEAR(saleDate)',$year)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();
                          }
                        else
                          {
                          $jants = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',1)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $febts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',2)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $marts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',3)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $aprts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',4)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $mayts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',5)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $junts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',6)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $jults = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',7)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $augts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',8)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $septs = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',9)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $octts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',10)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $novts = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',11)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();

                          $dects = $this->db->select("
                                                sale_product.saleID,
                                                SUM(`quantity`) as total,
                                                sales.saleID,
                                                sales.saleDate,
                                                sales.empid")
                                        ->FROM('sale_product')
                                        ->join('sales','sales.saleID = sale_product.saleID','left')
                                        ->WHERE('productID',$id)
                                        ->where('MONTH(saleDate)',12)
                                        ->where('empid',$empid)
                                        ->get()
                                        ->row();
                          }
                        }
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['productName']; ?></td>
                        <td>
                          <?php if($jants){ ?>
                          <?php echo round($jants->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($febts){ ?>
                          <?php echo round($febts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($marts){ ?>
                          <?php echo round($marts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($aprts){ ?>
                          <?php echo round($aprts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($mayts){ ?>
                          <?php echo round($mayts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($junts){ ?>
                          <?php echo round($junts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($jults){ ?>
                          <?php echo round($jults->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($augts){ ?>
                          <?php echo round($augts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($septs){ ?>
                          <?php echo round($septs->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($octts){ ?>
                          <?php echo round($octts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($novts){ ?>
                          <?php echo round($novts->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($dects){ ?>
                          <?php echo round($dects->total); ?>
                          <?php } else { ?>
                          <?php echo '0 '; ?>
                          <?php } ?>
                        </td>
                        <td>
                          <?php echo round($jants->total+$febts->total+$marts->total+$aprts->total+$mayts->total+$junts->total+$jults->total+$augts->total+$septs->total+$octts->total+$novts->total+$dects->total); ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
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
          $('#yreports').attr('class','hidden');

          $('#employeeID').attr('required','required');
          
          $('#ryear').removeAttr('required','required');
          $('#yemployeeID').removeAttr('required','required');
          });

        $('#yearly').click(function(){
          $('#yreports').removeAttr('class','hidden');
          $('#dreports').attr('class','hidden');

          $('#employeeID').removeAttr('required','required');
          
          $('#ryear').attr('required','required');
          $('#yemployeeID').attr('required','required');
          });
        });
    </script>