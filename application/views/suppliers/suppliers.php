  <div class="content-wrapper" style="min-height: 1126px;">   
    <section class="content-header">
      <h1>Supplier</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Supplier List</h3>
        <button type="button" class="btn btn-primary add_supplier" data-toggle="modal" data-target=".bs-example-modal-add_supplier" style="float: right" ><i class="fa fa-plus"></i> New Supplier</button>
      </div>

      <div class="box-body">
        <div id="table-content ">
          <table id="datatable" class="table table-responsive table-bordered table-hover">
            <thead>
              <tr>
                <th>#SN.</th>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Supplier Company</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Balance</th>
                <th style="width: 8%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 0;
              foreach ($suppliers as $key => $value) {
              $i++; 
              ?>
              <tr class="gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo 'SUP-'.$value['supplierID']; ?></td>
                <td><?php echo $value['supplierName']; ?></td>
                <td><?php echo $value['compname']; ?></td>
                <td><?php echo $value['mobile']; ?></td>
                <td><?php if($value['email']){echo $value['email'];}else{echo '-';} ?></td>
                <td><?php echo $value['address']; ?></td>  
                <td><?php echo number_format($value['balance'], 2); ?></td>
                <td>
                  <button type="button" class="btn btn-success btn-sm supplier_edit" data-toggle="modal" data-target=".bs-example-modal-supplier_edit" data-id="<?php echo $value['supplierID']; ?>" onclick="document.getElementById('supplier_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                  <a class=" btn btn-danger btn-sm" href="<?php echo site_url('Supplier/delete_supplier').'/'.$value['supplierID'] ?>" ><i class="fa fa-trash"></i></a>
                </td>
              </tr>   
              <?php } ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


    <div id="add_supplier" class="modal fade bs-example-modal-add_supplier" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Supplier Information</h4>
          </div>
          <form autocomplete="off" action="<?php echo base_url('Supplier/save_supplier');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Name *</label>
                <input type="text" class="form-control" name="supplierName" placeholder="Supplier Name" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Company *</label>
                <input type="text" class="form-control" name="compname" placeholder="Supplier Company" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Contact Number *</label>
                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@example.com" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Address *</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Opening Balance</label>
                <input type="text" class="form-control" name="balance" placeholder="Amount" >
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="supplier_edit" class="modal fade bs-example-modal-supplier_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Update Supplier Information</h4>
          </div>
          <form autocomplete="off" action="<?php echo base_url('Supplier/update_supplier');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Name *</label>
                <input type="text" class="form-control" name="supplierName" id="supplierName" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Company *</label>
                <input type="text" class="form-control" name="compname" id="compname" required >
              </div>
              <input type="hidden" class="form-control" name="company" id="warehouse" required >
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Contact Number *</label>
                <input type="text" class="form-control" name="mobile" id="mobile" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Address *</label>
                <input type="text" class="form-control" name="address" id="address" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Opening Balance</label>
                <input type="text" class="form-control" name="balance" id="balance" >
              </div>
            </div>
            <input type="hidden" id="sup_id" name="sup_id" >
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function(){
        $(".supplier_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="sup_id"]').val(catid);
        });

        $('.supplier_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Supplier/get_supplier_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["supplierName"];
              var HTML2 = data["compname"];
              var HTML3 = data["mobile"];
              var HTML4 = data["email"];
              var HTML5 = data["address"];
              var HTML6 = data["balance"];
              var HTML7 = data["company"];
    //alert(HTML);
              $("#supplierName").val(HTML);
              $("#compname").val(HTML2);
              $("#mobile").val(HTML3);
              $("#email").val(HTML4);
              $("#address").val(HTML5);
              $("#balance").val(HTML6);
              $("#warehouse").val(HTML7);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>