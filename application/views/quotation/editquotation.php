<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Quotation</h1>
    </section>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Quotation Information</h3>
        </div>
        <div class="box-body">      
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form method="POST" action="<?php echo site_url("Quotation/update_Quotation ") ?>">
                    <input type="hidden" name="qutid" value="<?php echo $quotation['qutid']?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Quotation Date *</label>
                            <input type="text" name="date" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($quotation['quotationDate'])) ?>" required >
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Customer *</label>                        
                            <select name="customer" class="form-control chosen" required >
                                <option value=" ">Select One</option>
                                <?php foreach($customer as $value):?>
                                <option <?php echo ($quotation['customerID'] == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Select Product</label>                        
                            <select name="productID" id="products" class="form-control chosen" >
                                <option value=" ">Select One</option>
                                <?php foreach($product as $value): ?>
                                <option value="<?php echo $value['productID']; ?>"><?php echo $value['productName']; ?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12"  style="margin-top:20px">
                        <table id="mtable" class="table table-bordered table-striped">
                            <thead class="btn-default">
                                <tr>
                                    <th>Product info</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php foreach($pquotation as $value):
                                $pid = $value['productID'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $value['productName']; ?>
                                        <input type="hidden" readonly='readonly' name='product_id[]' value="<?php echo $value['productID'];?>">
                                    </td> 
                                    <td>
                                        <input type='text' id="quantity_<?php echo $value['productID']?>" onkeyup="getTotal('<?php echo $pid?>')" name='quantity[]' value="<?php echo $value['quantity']; ?>">
                                    </td>
                                    <td>
                                        <?php echo $value['salePrice']?>
                                        <input type='hidden' onkeyup='getTotal(<?php echo $value['productID']?>)' id='tp_<?php echo $pid?>' name='tp[]' readonly='readonly' value='<?php echo $value['salePrice']?>'>
                                    </td>
                                    <td>
                                        <input readonly='readonly' type='text' id='totalPrice_<?php echo $pid?>' name='total_price[]' value='<?php echo $value['totalPrice']?>'>
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-danger" value="Remove" onClick="$(this).parent().parent().remove();">
                                    </td>
                                </tr>
                                 <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px" >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Total Price</label>                        
                            <input type="text" class="form-control" readonly name="totalPrice" id="totalPrice" value="<?php echo $quotation['totalPrice']?>">
                        </div> 
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Note</label>                        
                            <input type="text" class="form-control" value="<?php echo $quotation['note']?>" name="note" >
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?php echo site_url('Quotation') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
            var base_url = '<?php echo base_url() ?>'+'Quotation/getProductOnSupplier/' + id;
    // alert(id);
    // alert(base_url);
            $.ajax({
                type: 'GET',
                url: base_url,
                dataType: 'text',
                success: function (data) {
                    //$('#mtable').find("tr").remove();
                    var jsondata = JSON.parse(data);                
                    $('#tbody').append(jsondata);
                }
            });
        });
        });
    </script>

    <script type="text/javascript">

        function getTotal(id){
            var tp = $('#tp_'+id).val();
            var quantity = $('#quantity_'+id).val();
        
            var totalPrice = parseFloat(quantity) * parseFloat(tp);
            $('#totalPrice_' + id).val(parseFloat(totalPrice).toFixed(2));
            calculatePrice();
            }

    // function add total price
        function calculatePrice(){
            var totalPrice = Number(0),
                    pruchaseCost;
            $("input[name='total_price[]']").each(function () {
                totalPrice = Number(parseFloat(totalPrice) + parseFloat($(this).val()));
            });
            $('#totalPrice').val(totalPrice.toFixed(2));
            }
    </script>

    <script type="text/javascript">
      $(".chosen").chosen();
    </script>