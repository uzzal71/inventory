<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Purchase</h1>
    </section>
    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Purchase Information</h3>
        </div>
        <div class="box-body">      
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo site_url("Purchase/savedPurchase") ?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" name="date" class="form-control datepicker" value="<?php echo date('d-m-Y') ?>" required >
                        </div> 
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Challan Number *</label>
                            <input type="text" name="challanNo" class="form-control" placeholder="Challan No" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Select Product *</label>                        
                            <select name="productID" id="products" class="form-control chosen" required >
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
                                    <th>Product</th>
                                    <th>Quantity</th>      
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="mtable">

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Price *</label>
                            <input type="text" class="form-control" readonly name="totalPrice" id="totalPrice" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Paid Amount *</label>
                            <input type="text" class="form-control" name="Paid" onkeyup="calculate_remain()" id="Paid" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Due Price</label>
                            <input type="text" class="form-control" readonly name="due" id="remainging" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option value="">Select Account Type</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Number *</label>
                            <select name="accountNo" id="accountNo" class="form-control" required >
                                <option value="">Select Account Type First</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-3 col-xs-12" id="ajax_load_supplier">
                            <div id="supplier_hide">
                                <label>Supplier *</label>
                            <select name="suppliers" class="form-control chosen" required >
                                <option value="">Select One</option>
                                <?php foreach ($supplier as $value) { ?>
                                <option value="<?php echo $value['supplierID']; ?>" ><?php echo $value['supplierID'].' ( '.$value['supplierName'].' )'; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                         <!-- modal button -->
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button type="button" style="margin-top: 27px" data-toggle="modal" data-target="#supplierModal">+</button>
                        </div>
                        <!-- modal button -->
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>
                            <input type="text" class="form-control" name="note" placeholder="If have any note">
                        </div>
                    </div>             
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                            <a href="<?php echo site_url('Purchase') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Category Modal -->
<div id="supplierModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Supplier Information</h4>
      </div>
      <div class="modal-body">
        <form action="#" autocomplete="off">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Name *</label>
                <input type="text" class="form-control" name="supplierName" id="supplierName" placeholder="Supplier Name" required >
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Supplier Company *</label>
                <input type="text" class="form-control" name="compname" id="compname" placeholder="Supplier Company" required >
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
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="add_supplier" class="btn btn-primary" data-dismiss="modal">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<style type="text/css">
    .hide {
        display: none;
    }
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('#add_supplier').click(function() {      
        var supplierName = $('#supplierName').val();
        var compname = $('#compname').val();
        var mobile = $('#mobile').val();
        var address = $('#address').val();
        var balance = $('#balance').val();
        var email = $('#email').val();
        var base_url = '<?php echo base_url() ?>'+'Supplier/add_supplier';
        if(supplierName != '' && compname != '' && mobile != '' && address != ''){
        $.ajax({
            type: 'POST',
            url: base_url,
            data: {
                'supplierName': supplierName,
                'compname': compname,
                'mobile': mobile,
                'address': address,
                'balance': balance,
                'email': email
            },
            success: function (data) {                
                $('#ajax_load_supplier').append(data);
                $('#supplier_hide').remove();
                $('#supplierName').val('');
                $('#compname').val('');
                $('#mobile').val('');
                $('#address').val('');
                $('#balance').val('');
                $('#email').val('');
            }
        });
        }else{
            alert("Plese enter all (*) required field!");
            $('#supplierName').val('');
            $('#compname').val('');
            $('#mobile').val('');
            $('#address').val('');
            $('#balance').val('');
            $('#email').val('');
        }
    });
    });
</script>

    <script type="text/javascript">
        $(document).ready(function() {
        $('#products').change(function() {        
            var id = $('#products').val();
            var base_url = '<?php echo base_url() ?>'+'Purchase/getProductOnSupplier/'+id;
        // alert(supplier);
        // alert(base_url);
            $.ajax({
                type: 'GET',
                url: base_url,
                dataType: 'text',
                success: function (data) {
                    var jsondata = JSON.parse(data);                
                    $('#mtable').append(jsondata);
                }
            });
        });
        });
    </script>

    <script type="text/javascript">

        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
        });
        
        function getAccountNo(value,place){
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
                customAlert('Please Select Account Type', "error", true);
            }
        }
    </script>

    <script type="text/javascript">

        function getTotal(id){
            var tp = $('#tp_' + id).val();
            var quantity = $('#quantity_' + id).val();

            var totalPrice = parseFloat(quantity) * parseFloat(tp);
            $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
            calculatePrice();
            }

        function calculatePrice() {
            var totalPrice = Number(0),
                    pruchaseCost;
            $("input[name='total_price[]']").each(function () {
                totalPrice = Number(parseFloat(totalPrice) + parseFloat($(this).val()));
            });
            $('#totalPrice').val(totalPrice.toFixed(2));

            $('#Paid').val(totalPrice.toFixed(2));
            }

        function calculate_remain(){
            var paid = $('#Paid').val();
            var total = $('#totalPrice').val();
            var remaining = parseFloat(total).toFixed(2)-parseFloat(paid).toFixed(2);
            $('#remainging').val(remaining);
            }
    </script>

    <script type="text/javascript">
      $(".chosen").chosen();
    </script>