  <div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Product Stock Report</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box col-md-12 col-sm-12 col-xs-12">
          <div class="box-body">
            <form action="<?php echo base_url() ?>Product/product_reports" method="get">
              <div class="form-group col-md-3 col-sm-3 col-xs-12">
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label>Select Company / Warehouse *</label>
                <select class="form-control" name="darea" required >
                  <option value="">Select One</option>
                  <?php foreach($comp as $value){ ?>
                  <option value="<?php echo $value['companyID']; ?>"><?php echo $value['companyName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-1 col-sm-1 col-xs-12">
                <button type="submit" name="search" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp;Search</button>
              </div>
            </form>
          </div>

          <div class="box-body">
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
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%;">#SN.</th>
                    <th style="width: 15%;">Product's Name</th>
                    <th style="width: 15%;">Company / Warehouse</th>
                    <th style="width: 10%;">Trade Price</th>
                    <th>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th colspan="2" style="text-align: center;">Stock</th>
                          </tr>
                          <tr>
                            <th>Unit</th>
                            <th>Value ( Taka )</th>
                          </tr>
                        </thead>
                      </table>
                    </th>
                    <th>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th colspan="2" style="text-align: center;">New Entry</th>
                          </tr>
                          <tr>
                            <th>Unit</th>
                            <th>Value ( Taka )</th>
                          </tr>
                        </thead>
                      </table>
                    </th>
                    <th>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th colspan="2" style="text-align: center;">Final Stock</th>
                          </tr>
                          <tr>
                            <th>Unit</th>
                            <th>Value ( Taka )</th>
                          </tr>
                        </thead>
                      </table>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  $tpq = 0;
                  $tsq = 0;
                  $tq = 0;
                  foreach ($stock as $result){
                  $i++;
                  $pid = $result['product'];
                  $cid = $result['company'];

                  $pp = $this->db->select('
                                      purchase_product.purchaseID,
                                      purchase_product.productID,
                                      purchase_product.quantity,
                                      purchase_product.pprice,
                                      purchase.purchaseID,
                                      purchase.company')
                                  ->from('purchase_product')
                                  ->join('purchase','purchase.purchaseID = purchase_product.purchaseID','left')
                                  ->where('productID',$pid)
                                  ->where('company',$cid)
                                  ->order_by('purchaseProuctID','DESC')
                                  ->limit(1)
                                  ->get()
                                  ->row();
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['productName']; ?></td>
                    <td><?php echo $result['companyName']; ?></td>
                    <td><?php echo $result['pprice']; ?></td>
                    <td>
                      <table class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                            <td>
                              <?php if(!$pp){ ?>
                              <?php echo round($result['totalPices']); ?>
                              <?php } else { ?>
                              <?php echo round($result['totalPices']-$pp->quantity); ?>
                              <?php } ?>
                            </td>
                            <td>
                              <?php if(!$pp){ ?>
                              <?php echo number_format(($result['totalPices']*$result['pprice']), 2); ?>
                              <?php } else { ?>
                              <?php echo number_format((($result['totalPices']*$result['pprice'])-($pp->quantity*$pp->pprice)), 2); ?>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>                      
                      </table>
                    </td>
                    <td>
                      <table class="table table-bordered table-striped">
                        <tr>
                          <td>
                            <?php if($pp){ ?>
                            <?php echo round($pp->quantity); ?>
                            <?php } else { ?>
                            <?php echo "0" ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?php if($pp){ ?>
                            <?php echo number_format(($pp->quantity*$pp->pprice), 2); ?>
                            <?php } else { ?>
                            <?php echo "0" ?>
                            <?php } ?>
                          </td>
                        </tr>                        
                      </table>
                    </td>
                    <td>
                      <table class="table table-bordered table-striped">
                        <tr>
                          <td><?php echo round($result['totalPices']); ?></td>
                          <td><?php echo number_format(($result['totalPices']*$result['pprice']), 2); ?></td>
                        </tr>                        
                      </table>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4" style="text-align: right;" >Total</th>
                    <th><?php echo $tpq; ?></th>
                    <th><?php echo $tsq; ?></th>
                    <th><?php echo $tq; ?></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
            <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
          </div>
        </div>
      </div>
    </section>
  </div>