<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Sale</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Sale Information</h3>
        </div>
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo base_url() ?>Sale/savedSale" >
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" class="form-control datepicker" name="date" value="<?php echo date('d-m-Y') ?>" required >
                        </div>
                        <input type="hidden" class="form-control" name="company" id="company" value="<?php echo $_SESSION['company']; ?>" required >
                        <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_customer">
                            <div id="customer_hide">
                            <label>Customer *</label>
                            <select class="form-control chosen" name="customerID" id="customerID" onchange="myFunction()" required >
                                <option value="">Select One</option>
                                <?php foreach($customer as $value):?>
                                <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerName'].' ( '.$value['customerID'].' )'; ?></option>
                                <?php endforeach;?>
                            </select>
                            </div>
                        </div>
                         <!-- modal button -->
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#customerModal">+</button>
                        </div>
                        <!-- modal button -->
                    </div>

                    <!-- Customer summary -->
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
                          <table class="table table-bordered" style="width: 98%;margin: 0px auto">
                              <tr>
                                <td>Total Sales: <span id="total_amount"></span> Taka</td>
                                <td>Total Due: <span id="total_due"></span> Taka</td>
                              </tr>
                              <tr>
                                <td>Payment Amount: <span id="total_paid1"></span> Taka</td>
                                <td>Payment(%): <span id="payment_percentage"></span> %</td>
                              </tr>
                          </table>
                    </div>
                    <!-- Customer summary -->

                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Product</label>
                            <select name="productID" id="productID" class="form-control chosen" required >
                                <option value="">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                       
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
                        <table id="mtable" class="table table-bordered table-striped">
                            <thead class="btn-default">
                                <tr>
                                    <th>Products</th>
                                    <th>Total Quantity</th>
                                    <th>Pack Size</th>
                                    <th>Quantity</th>
                                    <th>Bonus Quantity</th>              
                                    <th>Sale Price</th>
                                    <th>Total Price</th>                      
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Amount *</label>
                            <input type="text" readonly name="totalprice" class="form-control" id="totalprice" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Paid Amount *</label>
                            <input type="text" id="total_paid" class="form-control" name="total_paid" onkeyup="calculate_remain()" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Due Amount </label>
                            <input type="text" readonly name="due" class="form-control" id="total_remain"  >
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
                            <label>Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" onkeyup="discountType()" value="0" >
                            <input type="hidden" class="form-control" id="discounttype" name="discounttype" >
                            <input type="hidden" class="form-control" id="discountamount" name="discountamount" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>
                            <input type="text" class="form-control" name="note" placeholder="If have any note">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                            <a href="<?php echo site_url('Sale') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
        $('#productID').change(function() { 
    
            var id = $('#productID option:selected').val();
            var id2 = $('#company').val();
            var table = 'products';
            var info = {'id':id,'id2':id2,'table':table};
            var base_url = '<?php echo base_url() ?>' + 'Sale/getDetails/';

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
        });
    </script>

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
    function myFunction() {
        var customerID = $('#customerID').val();
        var base_url = '<?php echo base_url() ?>' + 'Customer/customer_info';
        $.ajax({
            type: 'POST',
            url: base_url,
            data:{'customerID': customerID},
            success: function (data) {  
                if(data == null) {
                    var span = document.getElementById("total_amount");
                    span.textContent = '0';

                    var span = document.getElementById("total_paid1");
                    span.textContent = '0';

                    var span = document.getElementById("total_due");
                    span.textContent = '0';

                    var span = document.getElementById("payment_percentage");
                    span.textContent = '0';
                }else{
                var jsondata = JSON.parse(data);
                var total_amount = jsondata['total_amount'];
                var td = jsondata['total_paid'];
                var total_payment_voucher = jsondata['total_payment_voucher'];
                
                if(total_payment_voucher == null) {
                    var total_paid = td;
                }else{
                    var total_paid = parseInt(td) + parseInt(total_payment_voucher);
                }

                var total_due = jsondata['total_due'];

                if(total_amount == null) {
                    var span = document.getElementById("total_amount");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_amount");
                    span.textContent =total_amount;
                }
                if(total_paid == null) {
                    var span = document.getElementById("total_paid1");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_paid1");
                    span.textContent = total_paid;
                }
                if(total_due == null) {
                    var span = document.getElementById("total_due");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_due");
                    span.textContent = total_due;
                }

               var payment_percentage = ((total_paid * 100) / parseInt(total_amount));

               if(payment_percentage) {
                    var span = document.getElementById("payment_percentage");
                    span.textContent = payment_percentage.toFixed(2);
               }else {
                    var span = document.getElementById("payment_percentage");
                    span.textContent = '0';
               }
                }                    
                
                
                }
            });
    }

    $(document).ready(function() {
    $('#customerID').onchange(function() { 
        var customerID = $('#customerID').val();
        var base_url = '<?php echo base_url() ?>' + 'Customer/customer_info';

        $.ajax({
            type: 'POST',
            url: base_url,
            data:{'customerID': customerID},
            success: function (data) {
                if(data == null) {
                    var span = document.getElementById("total_amount");
                    span.textContent = '0';

                    var span = document.getElementById("total_paid1");
                    span.textContent = '0';

                    var span = document.getElementById("total_due");
                    span.textContent = '0';

                    var span = document.getElementById("payment_percentage");
                    span.textContent = '0';
                }else{
                    var jsondata = JSON.parse(data);
                var total_amount = jsondata['total_amount'];
                var td = jsondata['total_paid'];
                var total_payment_voucher = jsondata['total_payment_voucher'];
                
                if(total_payment_voucher == null) {
                    var total_paid = td;
                }else{
                    var total_paid = parseInt(td) + parseInt(total_payment_voucher);
                }

                var total_due = jsondata['total_due'];

                if(total_amount == null) {
                    var span = document.getElementById("total_amount");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_amount");
                    span.textContent =total_amount;
                }
                if(total_paid == null) {
                    var span = document.getElementById("total_paid1");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_paid1");
                    span.textContent = total_paid;
                }
                if(total_due == null) {
                    var span = document.getElementById("total_due");
                    span.textContent = '0';
                }else {
                    var span = document.getElementById("total_due");
                    span.textContent = total_due;
                }

               var payment_percentage = ((total_paid * 100) / parseInt(total_amount));

               if(payment_percentage) {
                    var span = document.getElementById("payment_percentage");
                    span.textContent = payment_percentage.toFixed(2);
               }else {
                    var span = document.getElementById("payment_percentage");
                    span.textContent = '0';
               }
                }                    
                
                
                }
            });
        });
    });
</script>

    

    <script type="text/javascript">

        function totalPrice(id){
            var pices = $('#pices_'+id).val();
            var salePrice = $('#salePrice_'+id).val();

            var totalPrice = (parseFloat(salePrice).toFixed(2)*pices);
            $('#totalPrice_'+id).val(parseFloat(totalPrice).toFixed(2));
            
            var paid = $('#paid_'+id).val();
            if(paid == 0)
                {
                $('#paid_'+id).val(parseFloat(totalPrice).toFixed(2));
                }
            else
                {
                $('#paid_'+id).val(paid);  
                }
            var remaining = parseFloat(totalPrice)-parseFloat(paid);
            $('#remaining_'+id).val(parseFloat(remaining).toFixed(2));
            
            calculateTotalPrice();
            }

        function calculateTotalPrice() {
            var sum=0;
            $(".totalPrice").each(function () {
                sum += parseFloat($(this).val());
            });
            $('#totalprice').val(parseFloat(sum).toFixed(2));
            $('#total_paid').val(parseFloat(sum).toFixed(2));
            }

        function calculate_remain(){
            var paid = $('#total_paid').val();
            var total = $('#totalprice').val();
            var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
            $('#total_remain').val(remaining);
            }
    </script>

    <script type="text/javascript">

        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');

        });

        function getAccountNo(value, place) {
            $(place).empty();
            if (value != '') {
                $.ajax({
                    url: 'getAccountNo',
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
            var discount = $('#discount').val();
            var discc = discount.slice(-1);
            var disca = discount.substring(0, discount.length - 1);

            $('#discounttype').val(discc);
            $('#discountamount').val(disca);
            }
    </script>

    <script type="text/javascript">
      $(".chosen").chosen();
    </script>