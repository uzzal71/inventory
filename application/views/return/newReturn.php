<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Returns</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Return Information</h3>
        </div>
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo base_url() ?>Returns/saveReturns">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group col-md-2 col-sm-2 col-xs-12">
                            <label>Date *</label>
                            <input type="text" class="form-control datepicker" name="date" value="<?php echo date('d-m-Y') ?>" required >
                        </div>                        
                        <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_customer">
                            <div id="customer_hide">
                            <label>Customer *</label>
                            <select class="form-control chosen" name="customerID" id="customerID" required >
                                <option value="">Select One</option>
                                <?php foreach($customer as $value):?>
                                <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                <?php endforeach;?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-md-1 col-sm-1 col-xs-12">
                            <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#customerModal">+</button>
                        </div>  
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label>Product *</label>
                            <select name="productID" id="productID" class="form-control chosen" required >
                                <option value="">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>                                       
                        <!--<div class="form-group col-md-3 col-sm-3 col-xs-12">            
                            <button style="margin-top: 25px" type="button" id="add_product" class="btn btn-primary" ><i class='fa fa-plus'></i> Add Product</button>
                        </div>-->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px" >
                        <table id="mtable" class="table table-bordered table-striped">
                            <thead class="btn-default">
                                <tr>
                                    <th>Products</th>
                                    <th>Quantity</th>              
                                    <th>Sale Price</th>
                                    <th>Total Price</th>                      
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Amount *</label>
                            <input type="text" class="form-control" name="totalprice" id="totalprice" readonly required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Service Charge</label>
                            <input type="text" class="form-control" name="scharge" id="scharge" onkeyup="discountType()" value="0" >
                            <input type="hidden" class="form-control" id="sctype" name="sctype" >
                            <input type="hidden" class="form-control" id="scAmount" name="scAmount" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Invoice No. *</label>
                            <input type="text" class="form-control" name="invoice" placeholder="Sale Invoice No." required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option value="">Select One</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account No *</label>
                            <select class="form-control" name="accountNo" id="accountNo" required >
                                <option value="">Select Account Type First</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>
                            <input type="text" class="form-control" name="note" placeholder="If have any note">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                            <a href="<?php echo site_url('Returns') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div id="customerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customer</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Customer Name *</label>
                <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Customer Name" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Company Name *</label>
                <input type="text" class="form-control" name="compname" id="compname" placeholder="Customer Company" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Contact Number *</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@sunshine.com" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Address *</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Opening Balance</label>
                <input type="text" class="form-control" name="balance" id="balance" placeholder="Amount" >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                <label>Status</label>
                <div>
                  <input type="radio" name="status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                  <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
                </div>
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="add_customer" class="btn btn-success" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#add_customer').click(function() {      
        var customerName = $('#customerName').val();
        var compname = $('#compname').val();
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var balance = $('#balance').val();
        var base_url = '<?php echo base_url() ?>'+'Customer/add_customer';
        if(customerName != '' && compname != '' && mobile != '' && address != ''){
        $.ajax({
            type: 'POST',
            url: base_url,
            data: {
                'customerName': customerName,
                'compname': compname,
                'mobile': mobile,
                'email': email,
                'address': address,
                'balance': balance
            },
            success: function (data) {                
                $('#ajax_load_customer').append(data);
                $('#customer_hide').remove();
                $('#customerName').val('');
                $('#compname').val('');
                $('#mobile').val('');
                $('#email').val('');
                $('#address').val('');
                $('#balance').val('');
            }
        });
        }else{
            alert("Plese enter all (*) required field!");
            $('#customerName').val('');
            $('#compname').val('');
            $('#mobile').val('');
            $('#email').val('');
            $('#address').val('');
            $('#balance').val('');
        }
    });
    });
</script>

    <script type="text/javascript">
        $('#productID').change(function() { 
            var productID = $('#productID option:selected').val();
            var table = 'products';
            var info = {'id':productID,'table':table};
            var base_url = '<?php echo base_url() ?>' + 'Returns/getDetails/';
            
            $.ajax({
                type: 'POST',
                async: false,
                url: base_url,
                data:info,
                dataType: 'json',
                success: function (data) {                            
                    $('#mtable tbody').append(data);
                    }
                });
            });
    </script>

    <script type="text/javascript">

        function totalPrice(id){
            var pices = $('#pices_'+id).val();
            var salePrice = $('#salePrice_'+id).val();
            
            var totalPrice = (parseFloat(salePrice).toFixed(2)*pices);
            $('#totalPrice_'+id).val(parseFloat(totalPrice).toFixed(2));
            
            calculateTotalPrice();
            }

// for calculate total price
        function calculateTotalPrice() {
            var sum=0;
            $(".totalPrice").each(function () {
                sum += parseFloat($(this).val());
            });
            $('#totalprice').val(parseFloat(sum).toFixed(2));
            }
    </script>

    <script type="text/javascript">

        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            });

        var url = '<?php echo site_url('Sale')?>';

        function getAccountNo(value, place) {
            $(place).empty();
            if (value != '') {
                $.ajax({
                    url: url+'/getAccountNo',
                    async: false,
                    dataType: "json",
                    data: 'id=' + value,
                    type: "POST",
                    success: function (data) {
                        $(place).append(data);
                        $(place).trigger("chosen:updated");
                    }
                });

            } else {
                $.alert({
                    title: 'Alert!',
                    content: 'Please Select Account Type',
                    type: "red",
                    icon: 'fa fa-warning',
                    theme: "material",
                });
            }
        }
    </script>

    <script type="text/javascript">
        function discountType(){
            var disc = $('#scharge').val();
            var discc = disc.slice(-1);
            var disca = disc.substring(0, disc.length - 1);
        //alert(disca);
            $('#sctype').val(discc);
            $('#scAmount').val(disca);
            }
    </script>

    <script type="text/javascript">
      $(".chosen").chosen();
    </script>