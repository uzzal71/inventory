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
                <form method="POST" action="<?php echo base_url() ?>Returns/updateReturns" >
                    <input type="hidden" name="returnId" value="<?php echo $returns['returnId']; ?>">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label>Date *</label>
                            <input type="text" class="form-control datepicker" name="date" value="<?php echo date('d-m-Y',strtotime($returns['returnDate'])) ?>" required >
                        </div>
                        <input type="hidden" class="form-control" name="company" value="<?php echo $returns['company']; ?>" required >
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label>Customer *</label>
                            <select class="form-control" name="customer" required >
                                <option value="">Select One</option>
                                <?php foreach ($customer as $value) { ?>
                                <option <?php echo ($returns['customerID'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID'] ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">
                            <label>Product *</label>
                            <select name="productID" id="productID" class="form-control chosen" >
                                <option value="">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>                                       
                        <div class="form-group col-md-3 col-sm-3 col-xs-12">            
                            <button style="margin-top: 25px" type="button" id="add_product" class="btn btn-primary" ><i class='fa fa-plus'></i> Add Product</button>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
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
                                <?php
                                foreach($rproduct as $value){
                                $id = $value['productID'];
                                ?>
                                <tr>
                                    <td>
                                        <b><?php echo $value['productName'] ?></b>
                                        <input type='hidden' name='productID[]' value="<?php echo $id; ?>">
                                    </td>       
                                    <td>
                                        <input type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='pices[]' id='pices_<?php echo $id ?>' value="<?php echo $value['quantity']?>">
                                    </td>
                                    <td>
                                        <input type='hidden' onkeyup='totalPrice(<?php echo $id ?>)' name='salePrice[]' id='salePrice_<?php echo $id ?>' value="<?php echo $value['salePrice']?>">
                                        <?php echo $value['salePrice']?>
                                    </td>
                                    <td>
                                        <input type='text' class='totalPrice'  name='totalPrice[]' readonly id='totalPrice_<?php echo $id ?>' value="<?php echo $value['totalPrice']?>">
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-danger" value="Remove" onClick="$(this).parent().parent().remove();">
                                    </td>
                                </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Amount *</label>
                            <input type="text" class="form-control" name="totalprice" id="totalprice" readonly required value="<?php echo $returns['totalPrice']?>" >
                            <input type="hidden" class="form-control" name="exists_totalprice" id="exists_totalprice" readonly required value="<?php echo $returns['totalPrice']?>" >
                        </div>
                        <input type="hidden" class="form-control" name="employee" value="<?php echo $returns['empid']; ?>" required >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Service Charge</label>
                            <input type="text" class="form-control" name="scharge" id="scharge" value="<?php echo $returns['scharge']?>"  onkeyup="discountType()" >
                            <input type="hidden" class="form-control" id="sctype" name="sctype" >
                            <input type="hidden" class="form-control" id="scAmount" name="scAmount" value="<?php echo $returns['scAmount']?>"  >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Invoice No. *</label>
                            <input type="text" class="form-control" name="invoice" value="<?php echo $returns['invoice']; ?>" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option value="">Select One</option>
                                <option <?php echo ($returns['accountType'] == 'Cash')?'selected':''?> value="Cash">Cash</option>
                                <option <?php echo ($returns['accountType'] == 'Bank')?'selected':''?> value="Bank">Bank</option>
                                <option <?php echo ($returns['accountType'] == 'Mobile')?'selected':''?> value="Mobile">Mobile</option>
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
                            <input type="text" class="form-control" name="note" value="<?php echo $returns['note']; ?>" >
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?php echo site_url('Returns') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        $('#add_product').on('click',function(){
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
        $(document).ready(function() {
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val("<?php echo $returns['accountNo'] ?>");
            });

        var url = '<?php echo site_url('Sale')?>';

        $('#accountType').on('change', function () {
            var value = $(this).val();
            $('#accountNo').empty();
            getAccountNo(value,'#accountNo');
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