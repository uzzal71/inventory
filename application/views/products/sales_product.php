  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Product Sale Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Product/product_sales_reports" method="get">
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
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Product wise Monthly sales Reports in : <?php echo $year; ?></b></h3>
                </div>
                <?php } else { ?>
                <div class="box-header" style="text-align: center;">
                  <h3 class="box-title"><b>Product wise All sales Reports</b></h3>
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
                                      ->where('YEAR(saleDate)',$year)                                      ->get()
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
                                      ->get()
                                      ->row();
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
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: center;" >
                    <p>------------------------------</p>
                    <p>Prepared By</p>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: center;">
                    <p>------------------------------</p>
                    <p>Checked By</p>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: center;">
                    <p>------------------------------</p>
                    <p>Verified By</p>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: center;">
                    <p>------------------------------</p>
                    <p>Authorized By</p>
                  </div>
                </div>
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