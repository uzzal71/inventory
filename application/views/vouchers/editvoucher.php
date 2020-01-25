<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Update Voucher Information </h1>
    </section>

    <div class="box">
        <div class="box-body">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="POST" action="<?php echo site_url('Voucher/update_voucher') ?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" name="vuid" class="form-control" value="<?php echo $voucher->vuid; ?>" >
                        <input type="hidden" name="vauchertype" class="form-control" value="<?php echo $voucher->vauchertype; ?>" >
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" name="date" class="form-control datepicker" value="<?php echo date('d-m-Y', strtotime($voucher->voucherdate)); ?>" >
                        </div>

                        <?php if($voucher->vauchertype == "Credit Voucher" || $voucher->vauchertype == "Customer Pay"){ ?>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Customer *</label>
                                <select class="form-control chosen" name="customerID" >
                                    <option value="">Select One</option>
                                    <?php foreach($customers as $value):?>
                                    <option <?php echo ($voucher->customerID == $value['customerID'])?'selected':''?> value="<?php echo $value['customerID']; ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        <?php } else if($voucher->vauchertype == 'Credit Voucher'){ ?>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Invoice No. *</label>
                                <input type="text" class="form-control" name="invoice" value="<?php echo $voucher->invoice; ?>"  >
                            </div>
                        <?php } else if($voucher->vauchertype == 'Debit Voucher'){ ?>
                        <div class="form-group col-md-4">
                            <label>Employee *</label>
                            <select class="form-control chosen" name="employee" >
                                <option value="">Select One</option>
                                <?php foreach($emp as $value):?>
                                <option <?php echo ($voucher->employee == $value['employeeID'])?'selected':''?> value="<?php echo $value['employeeID']; ?>" ><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Expences Type *</label>
                            <select class="form-control chosen" name="costType" >
                                <option value="">Select One</option>
                                <?php foreach($costType as $value):?>
                                <option <?php echo ($voucher->costType == $value['costTypeId'])?'selected':''?> value="<?php echo $value['costTypeId']; ?>"><?php echo $value['costName']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <?php } else if($voucher->vauchertype == 'Supplier Pay'){ ?>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Supplier *</label>
                                <select class="form-control chosen" name="supplier" >
                                    <option value="">Select One</option>
                                    <?php foreach($supplier as $value):?>
                                    <option <?php echo ($voucher->supplier == $value['supplierID'])?'selected':''?> value="<?php echo $value['supplierID']; ?>"><?php echo $value['supplierID'].' ( '.$value['supplierName'].' )'; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account Type *</label>
                            <select class="form-control" name="accountType" id="accountType" required >
                                <option value="">Select One</option>
                                <option <?php echo ($voucher->accountType == 'Cash')?'selected':''?> value="Cash">Cash</option>
                                <option <?php echo ($voucher->accountType == 'Bank')?'selected':''?> value="Bank">Bank</option>
                                <option <?php echo ($voucher->accountType == 'Mobile')?'selected':''?> value="Mobile">Mobile</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Account No *</label>
                            <select class="form-control" name="accountNo" id="accountNo" required >
                                <option value="">Select One</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row" style="background-color:#298894; color: black;" align="center">
                            <?php foreach ($voucherp as $value) { ?>
                            <div class="form-group col-md-8 col-sm-8 col-xs-8">
                                <label>Particulars</label>
                                <input type="text" class="form-control" value="<?php echo $value['particulars']; ?>"  name="particular[]" >
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" name="amount[]" value="<?php echo $value['amount']; ?>" >
                                    <input type="hidden" class="form-control" name="exits_amount[]" value="<?php echo $value['amount']; ?>" >
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?php echo site_url('Voucher') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $(document).ready(function() {
            var value = $("#accountType").val();
            $('#accountNo').empty();
            getAccountNo(value, '#accountNo');
            $('#accountNo').val("<?php echo $voucher->accountNo ?>");
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
      $(".chosen").chosen();
    </script>