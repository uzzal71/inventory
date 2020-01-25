<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Sale</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Update Sale Information</h3>
        </div>
        <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo base_url() ?>Sale/updateSale" >
                    <input type="hidden" name="saleID" value="<?php echo $sale['saleID']; ?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" class="form-control datepicker" name="date" value="<?php echo date('d-m-Y',strtotime($sale['saleDate'])) ?>" required >
                        </div>
                        <input type="hidden" class="form-control" id="company" name="company" value="<?php echo $sale['company']; ?>" required >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Customer *</label>
                            <select class="form-control chosen" name="customerID" required >
                                <option value="">Select One</option>
                                <?php foreach($customer as $value):?>
                                <option <?php echo ($sale['customerID'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Product</label>
                            <select name="productID" id="productID" class="form-control chosen">
                                <option value="">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px" >
                        <table id="mtable" class="table table-bordered table-striped">
                            <thead class="btn-default">
                                <tr>
                                    <th>Products</th>
                                    <th>Stock Quantity</th>
                                    <th>Pack Size</th>
                                    <th>Quantity</th>
                                    <th>Bonus Quantity</th>              
                                    <th>Sale Price</th>
                                    <th>Total Price</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                foreach($salesp as $value){
                                $id = $value['productID'];

                                $sqt = $this->db->select('totalPices')
                                            ->from('stock')
                                            ->where('company',$sale['company'])
                                            ->where('product',$id)
                                            ->get()
                                            ->row();
                                ?>
                                <tr>
                                    <td>
                                        <b><?php echo $value['productName']; ?></b>
                                        <input type='hidden' name='productID[]' value="<?php echo $value['productID']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $sqt->totalPices; ?>
                                    </td> 
                                    <td>
                                        <input type='text' name='packsize[]' value="<?php echo $value['packsize']?>">
                                    </td>
                                    <td>
                                        <input type='text' onkeyup='totalPrice(<?php echo $id ?>)' name='pices[]' id='pices_<?php echo $id ?>' value="<?php echo $value['squantity']; ?>">
                                    </td>
                                    <td>
                                        <input type='text' name='bquantity[]' value="<?php echo $value['bquantity']?>">
                                    </td>
                                    <td>
                                        <input type='hidden' onkeyup='totalPrice(<?php echo $id ?>)' name='salePrice[]' id='salePrice_<?php echo $id ?>' value="<?php echo $value['sprice']?>">
                                        <?php echo $value['sprice']?>
                                    </td>
                                    <td>
                                        <input type='text' class='totalPrice' name='totalPrice[]' readonly id='totalPrice_<?php echo $id ?>' value="<?php echo $value['totalPrice'] ?>" >
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-danger" value="remove" onClick="$(this).parent().parent().remove();">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Amount *</label>
                            <input type="text" readonly name="totalprice" class="form-control" id="totalprice" required value="<?php echo $sale['totalAmount']; ?>" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Amount *</label>
                            <input type="text" id="total_paid" class="form-control" name="total_paid" onkeyup="calculate_remain()" value="<?php echo $sale['paidAmount']; ?>" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Due Amount </label>
                            <input type="text" readonly name="due" class="form-control" id="total_remain" value="<?php echo $sale['totalAmount']-$sale['paidAmount']; ?>"  >
                            <input type="hidden" name="exists_due" class="form-control" id="exists_due" value="<?php echo $sale['totalAmount']-$sale['paidAmount']; ?>"  >
                        </div>
                        <input type="hidden" class="form-control" name="employee" value="<?php echo $sale['empid']; ?>" required >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option value="">Select One</option>
                                <option <?php echo ($sale['accountType'] == 'Cash')?'selected':''?> value="Cash">Cash</option>
                                <option <?php echo ($sale['accountType'] == 'Bank')?'selected':''?> value="Bank">Bank</option>
                                <option <?php echo ($sale['accountType'] == 'Mobile')?'selected':''?> value="Mobile">Mobile</option>
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
                            <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $sale['discount']; ?>" onkeyup="discountType()" value="0" >
                            <input type="hidden" class="form-control" id="discounttype" name="discounttype" >
                            <input type="hidden" class="form-control" id="discountamount" name="discountamount" value="<?php echo $sale['discountAmount']; ?>" >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>
                            <input type="text" class="form-control" name="note" value="<?php echo $sale['note']; ?>" >
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?php echo site_url('Sale') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>
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
        $(document).ready(function() {
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val("<?php echo $sale['accountNo'] ?>");
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
            var disc = $('#discount').val();
            var discc = disc.slice(-1);
            var disca = disc.substring(0, disc.length - 1);
        //alert(disca);
            $('#discounttype').val(discc);
            $('#discountamount').val(disca);
            }
    </script>

    <script type="text/javascript">
      $(".chosen").chosen();
    </script>