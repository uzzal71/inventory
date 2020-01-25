<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Purchase</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Update Purchase</h3>
        </div>
        <div class="box-body">      
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo site_url("Purchase/updatePurchase") ?>">
                    <input type="hidden" name="purhcase_id" value="<?php echo $purchase['purchaseID']; ?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" name="date" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($purchase['purchaseDate'])) ?>" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Challan No *</label>
                            <input type="text" value="<?php echo $purchase['challanNo']; ?>" name="challanNo" class="form-control" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Select Product *</label>                        
                            <select name="productID" id="products" class="form-control chosen" >
                                <option value="">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="mtable" class="table table-bordered table-striped">
                            <thead class="btn-default">
                                <tr>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($purchesProducts as $value):
                                $id = $value['productID'];
                                ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" readonly name="product_name[]" value="<?php echo $value['productName']; ?>">
                                        <input type="hidden" readonly='readonly' name='product_id[]' value="<?php echo $value['productID']; ?>">
                                    </td> 
                                    <td>
                                        <input type='text' class="form-control" id="quantity_<?php echo $value['productID']?>" onkeyup="getTotal('<?php echo $id ?>')" name='quantity[]' value="<?php echo $value['quantity']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $value['pprice']; ?>
                                        <input type='hidden' onkeyup='getTotal(<?php echo $value['productID']?>)' id='tp_<?php echo $id; ?>' name='pprice[]' value='<?php echo $value['pprice']?>'>
                                    </td>
                                    <td>
                                        <input readonly='readonly' type='text' id='totalPrice_<?php echo $id; ?>' name='total_price[]' value='<?php echo $value['totalPrice']; ?>'>
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-danger" value="Remove" onClick="$(this).parent().parent().remove();">
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>  
                    </div>    

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Price *</label>
                            <input type="text" class="form-control" readonly name="totalPrice" id="totalPrice" required value="<?php echo $purchase['totalPrice']; ?>" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Paid Amount *</label>
                            <input type="text" class="form-control" name="Paid" onkeyup="calculate_remain()" id="Paid" required value="<?php echo $purchase['paidAmount']; ?>" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Due Price</label>
                            <input type="text" class="form-control" readonly name="due" id="remainging" value="<?php echo ($purchase['totalPrice']-$purchase['paidAmount']); ?>" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option <?php echo ($purchase['accountType'] == 'Cash')?'selected':''?> value="Cash">Cash</option>
                                <option <?php echo ($purchase['accountType'] == 'Bank')?'selected':''?> value="Bank">Bank</option>
                                <option <?php echo ($purchase['accountType'] == 'Mobile')?'selected':''?> value="Mobile">Mobile</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Number *</label>
                            <select name="accountNo" id="accountNo" class="form-control" required >
                                <option value="">Select Account Type First</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Supplier *</label>
                            <select name="suppliers" class="form-control chosen" required >
                                <option value="">Select One</option>
                                <?php foreach ($supplier as $value) { ?>
                                <option <?php echo ($purchase['supplier'] == $value['supplierID'])?'selected':''?> value="<?php echo $value['supplierID']; ?>" ><?php echo $value['supplierID'].' ( '.$value['supplierName'].' )'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" name="company" value="<?php echo $purchase['company']; ?>" required >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>
                            <input type="text" class="form-control" name="note" value="<?php echo $purchase['note']?>" >
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?php echo site_url('Purchase') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>
    
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

        $(document).ready(function(){
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val("<?php echo $purchase['accountNo'] ?>");
            });
        var url='<?php echo base_url("Purchase")?>';

        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            });
    // change account get sub account name
        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            });

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
                customAlert('Please Select Account Type', "error", true);
            }
        }
    </script>

    <script type="text/javascript">

        function getTotal(id) {        
            var tp = $('#tp_'+id).val();
            var quantity = $('#quantity_'+id).val();
        // alert(tp);
        // alert(quantity);
            var totalPrice = parseFloat(quantity)*parseFloat(tp);
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

            $('#Paid').val(totalPrice);
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