<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Voucher Information </h1>
    </section>

    <div class="box">
        <div class="box-body">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="POST" action="<?php echo site_url("Voucher/save_voucher") ?>">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                            <label>Date *</label>
                            <input type="text" name="date" class="form-control datepicker" value="<?php echo date('d-m-Y') ?>" required >
                        </div>
                        <div class="form-group col-md-8 col-sm-8 col-xs-12">
                            <label>Voucher Type *</label>
                            <div>
                                <input type="radio" name="vaucher" value="Credit Voucher" id="credit" required >&nbsp;&nbsp;Credit Voucher&nbsp;&nbsp;
                                <input type="radio" name="vaucher" value="Debit Voucher" id="debit" required >&nbsp;&nbsp;Debit Voucher&nbsp;&nbsp;
                                <input type="radio" name="vaucher" value="Customer Pay" id="customerPay" required >&nbsp;&nbsp;Customer Pay&nbsp;&nbsp;
                                <input type="radio" name="vaucher" value="Supplier Pay" id="supplierPay" required >&nbsp;&nbsp;Supplier Pay
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="hidden" id="customer">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Customer *</label>
                                <select class="form-control" name="customerID" id="customerID" required="" >
                                    <option value="">Select One</option>
                                    <?php foreach($customer as $value):?>
                                    <option value="<?php echo $value['customerID']; ?>"><?php echo $value['customerID'].' ( '.$value['customerName'].' )'; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hidden" id="custinvno">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Invoice No. *</label>
                                <input type="text" class="form-control" name="invoice" id="invoice" placeholder="Invoice No." required="" >
                            </div>
                        </div>
                        <div class="hidden" id="employee">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Employee *</label>
                                <select class="form-control" name="employee" id="employeeID" required="" >
                                    <option value="">Select One</option>
                                    <?php foreach($emp as $value):?>
                                    <option value="<?php echo $value['employeeID']; ?>"><?php echo $value['employeeID'].' ( '.$value['employeeName'].' )'; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Expences Type *</label>
                                <select class="form-control" name="costType" id="costTypeId" required="" >
                                    <option value="">Select One</option>
                                    <?php foreach($costType as $value):?>
                                    <option value="<?php echo $value['costTypeId']; ?>"><?php echo $value['costName']; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="hidden" id="supplier">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Supplier *</label>
                                <select class="form-control" name="supplier" id="supplierID" required="" >
                                    <option value="">Select One</option>
                                    <?php foreach($supplier as $value):?>
                                    <option value="<?php echo $value['supplierID']; ?>"><?php echo $value['supplierID'].' ( '.$value['supplierName'].' )'; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
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
                                <option value="">Select One</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row" style="background-color:#298894; color: black;" align="center">
                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <label>Particulars</label>
                                <input type="text" class="form-control" name="particular[]" placeholder="Particulars" required >
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" name="amount[]" placeholder="Amount" required >
                                </div>
                            </div>
                            <div class="form-group col-md-2 col-sm-2 col-xs-2">
                                <label>Add</label>
                                <button type="button" class="form-control btn btn-defult" id="addmore">Add</button>
                            </div>
                        </div>

                        <div class="row">   
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <ol id="list" style="list-style-type:none;"></ol>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
                        <div class="col-md-9 col-md-offset-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i> Submit</button>
                            <a href="<?php echo site_url('Voucher') ?>" class="btn btn-danger" style="margin-right:10px"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </form>

                <div class="hidden">
                    <div id="product">
                        <li class="ct">
                            <div class="row" style="background-color:#c5c745; border-radius: 4px; border:1px solid #fff; color: black; margin-left: -55px;" >
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row" >
                                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                    <label>Particulars</label>
                                    <input type="text" id="partc" name="particular[]" placeholder="Particulars" class="form-control" required >
                                  </div>
                                  <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                    <label>Amount</label>
                                    <input type="text" id="quantity" name="amount[]" placeholder="Amount" class="form-control" required >
                                  </div>
                                  <div class="form-group col-md-2 col-sm-2 col-xs-2">
                                    <input type="button" class="btn btn-danger" value="Remove" onClick="$(this).parent().parent().remove();" style="margin-top: 25px;" >
                                  </div>
                                </div>
                            </div>
                            </div>
                        </li>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){
            $('#credit').click(function(){
                $('#customer').removeAttr('class','hidden');
                $('#employee').attr('class','hidden');
                $('#supplier').attr('class','hidden');
                $('#custinvno').removeAttr('class','hidden');

                $('#customerID').attr('required','required');
                $('#invoice').attr('required','required');
                $('#employeeID').removeAttr('required','required');
                $('#costTypeId').removeAttr('required','required');
                $('#supplierID').removeAttr('required','required');
                });

            $('#debit').click(function(){
                $('#employee').removeAttr('class','hidden');
                $('#customer').attr('class','hidden');
                $('#supplier').attr('class','hidden');
                $('#custinvno').attr('class','hidden');

                $('#customerID').removeAttr('required','required');
                $('#invoice').removeAttr('required','required');
                $('#employeeID').attr('required','required');
                $('#costTypeId').attr('required','required');
                $('#supplierID').removeAttr('required','required');
                });

            $('#customerPay').click(function(){
                $('#customer').removeAttr('class','hidden');
                $('#employee').attr('class','hidden');
                $('#supplier').attr('class','hidden');
                $('#custinvno').attr('class','hidden');

                $('#customerID').attr('required','required');
                $('#invoice').removeAttr('required','required');
                $('#employeeID').removeAttr('required','required');
                $('#costTypeId').removeAttr('required','required');
                $('#supplierID').removeAttr('required','required');
                });

            $('#supplierPay').click(function(){
                $('#supplier').removeAttr('class','hidden');
                $('#customer').attr('class','hidden');
                $('#employee').attr('class','hidden');
                $('#custinvno').attr('class','hidden');

                $('#customerID').removeAttr('required','required');
                $('#invoice').removeAttr('required','required');
                $('#employeeID').removeAttr('required','required');
                $('#costTypeId').removeAttr('required','required');
                $('#supplierID').attr('required','required');
                });
            });
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
                    url: '<?php echo site_url()?>Sale/getAccountNo',
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
                    content: 'Select Account Type',
                    type: "red",
                    icon: 'fa fa-warning',
                    theme: "material",
                });
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $("#addmore").click(function(){
              $("#list").append($("#product").html());
              $("ol li.ct input").removeAttr("id");
            });

            $("#remove_more").click(function(){
              $('li.ct').has('input:checkbox:checked').remove();
            });
        });
    </script>