  <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
      <h1>Customer</h1>
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
        <h3 class="box-title"> Customer List</h3>
        <button type="button" class="btn btn-primary add_customer" data-toggle="modal" data-target=".bs-example-modal-add_customer" style="float: right" ><i class="fa fa-plus"></i> New Customer</button>
      </div>
      <div class="box-body">
        <div id="table-content ">
          <table id="datatable" class="table table-responsive table-bordered table-hover">
            <thead>
              <tr>
                <th>#SN</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Customer Company</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Balance</th>
                <th>Status </th>
                <th style="width: 8%;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              foreach ($customers as $key => $value) {
              $i++;
              ?>
              <tr class="gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo 'CUST-'.$value['customerID']; ?></td>
                <td><?php echo $value['customerName']; ?></td>
                <td><?php echo $value['compname']; ?></td>
                <td><?php echo $value['mobile']; ?></td>
                <td><?php if($value['email']){echo $value['email'];}else{echo '-';} ?></td>
                <td><?php echo $value['address']; ?></td>
                <td><?php echo '৳.'.number_format($value['balance'], 2); ?></td>
                <td><?php echo $value['status']; ?></td>        
                <td>
                  <button type="button" class="btn btn-success btn-sm customer_edit" data-toggle="modal" data-target=".bs-example-modal-customer_edit" data-id="<?php echo $value['customerID']; ?>" onclick="document.getElementById('customer_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                  <a class=" btn btn-danger btn-sm" href="<?php echo site_url('Customer/delete_customer').'/'.$value['customerID'] ?>" ><i class="fa fa-trash"></i></a>
                </td>
              </tr>   
              <?php } ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    <div id="add_customer" class="modal fade bs-example-modal-add_customer" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Customer Information</h4>
          </div>
          <form autocomplete="off" action="<?php echo base_url('Customer/save_customer');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Customer Name *</label>
                <input type="text" class="form-control" name="customerName" placeholder="Customer Name" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Company Name</label>
                <input type="text" class="form-control" name="compname" placeholder="Customer Company" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Contact Number *</label>
                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@sunshine.com" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Address *</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Opening Balance</label>
                <input type="text" class="form-control" name="balance" placeholder="Amount" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                <label>Status</label>
                <div>
                  <input type="radio" name="status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                  <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
                </div>
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

    <div id="customer_edit" class="modal fade bs-example-modal-customer_edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Update Customer Information</h4>
          </div>
          <form autocomplete="off" action="<?php echo base_url('Customer/update_customer');?>" method="post">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Customer Name *</label>
                <input type="text" class="form-control" name="customerName" id="customerName" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Chemist Name</label>
                <input type="text" class="form-control" name="compname" id="compname" >
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
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Status</label>
                <select class="form-control" name="status" id="status" >
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <input type="hidden" id="cus_id" name="cus_id" >
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
        $(".customer_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="cus_id"]').val(catid);
        });

        $('.customer_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>Customer/get_customer_data';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["customerName"];
              var HTML2 = data["compname"];
              var HTML3 = data["mobile"];
              var HTML4 = data["email"];
              var HTML5 = data["address"];
              var HTML6 = data["balance"];
              var HTML7 = data["status"];
              var HTML8 = data["company"];
      //alert(HTML8);
              $("#customerName").val(HTML);
              $("#compname").val(HTML2);
              $("#mobile").val(HTML3);
              $("#email").val(HTML4);
              $("#address").val(HTML5);
              $("#balance").val(HTML6);
              $("#status").val(HTML7);
              $("#warehouse").val(HTML8);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>