<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Bank Transaction</h1>
    </section>

    <?php if ($this->session->flashdata('msg')) { ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-success"></i> Success</h4>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <?php } ?>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Bank Transaction List</h3>
            <button type="button" class="btn btn-primary add_bank" data-toggle="modal" data-target=".bs-example-modal-abank" style="float: right" ><i class="fa fa-plus"></i> New Bank Account</button>
        </div>
        <div class="box-body">
            <div id="table-content ">
                <table id="datatable" class="table-responsive table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Account Name</th>
                            <th>Account No</th>
                            <th>Bank Name</th>
                            <th>Branch Name</th>
                            <th>Opening Balance</th>
                            <th>Current Balance</th>
                            <th>Status</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $tba = 0;
                        foreach ($bankAccountList as $key => $value) {
                        $id = $value['bankAccountId'];
                        //var_dump($id);
                        $sa = $this->db->select('SUM(paidAmount) as total')
                                    ->from('sales')
                                    ->where('accountType','Bank')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($sa); exit();
                        if($sa == null){
                            $saa = 0;
                            }
                        else{
                            $saa = $sa->total;
                        }

                        $pa = $this->db->select("SUM(paidAmount) as total")
                                    ->from('purchase')
                                    ->where('accountType','Bank')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                    //var_dump($pa); exit();
                        if($pa == null){
                            $paa = 0;
                            }
                        else{
                            $paa = $pa->total;
                        }

                        $va = $this->db->select("SUM(totalamount) as total")
                                    ->from('vaucher')
                                    ->where('accountType','Bank')
                                    ->where('vauchertype','Credit Voucher')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($pa); //exit();
                        if($va == null){
                            $vaa = 0;
                            }
                        else{
                            $vaa = $va->total;
                        }

                        $va2 = $this->db->select("SUM(totalamount) as total")
                                    ->from('vaucher')
                                    ->where('accountType','Bank')
                                    ->where_not_in('vauchertype','Credit Voucher')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($pa); //exit();
                        if($va2 == null){
                            $vaa2 = 0;
                            }
                        else{
                            $vaa2 = $va2->total;
                        }
                        $tva = $vaa-$vaa2;

                        $temp = $this->db->select("SUM(salary) as total")
                                    ->from('employee_payment')
                                    ->where('accountType','Bank')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($pa); //exit();
                        if($temp == null){
                            $tempa = 0;
                            }
                        else{
                            $tempa = $temp->total;
                        }

                        $tr = $this->db->select("SUM(totalPrice) as total,SUM(scAmount) as sctotal")
                                    ->from('returns')
                                    ->where('accountType','Bank')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($pa); //exit();
                        if($tr == null){
                            $tra = 0;
                            }
                        else{
                            $tra = $tr->total-$tr->sctotal;
                        }

                        $td = $this->db->select("SUM(totalPrice) as total,SUM(scAmount) as sctotal")
                                    ->from('damages')
                                    ->where('accountType','Bank')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($pa); //exit();
                        if($td == null){
                            $tda = 0;
                            }
                        else{
                            $tda = $td->total-$td->sctotal;
                        }

                        $i++;
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['accountName']; ?></td>
                            <td><?php echo $value['accountNo']; ?></td>
                            <td><?php echo $value['bankName']; ?></td>
                            <td><?php echo $value['branchName']; ?></td>
                            <td><?php echo number_format(($value['balance']), 2); ?></td>
                            <td><?php echo number_format(((($value['balance'])+$saa+$tva)-($paa+$tempa+$tra+$tda)), 2); $tba += ((($value['balance'])+$saa+$tva)-($paa+$tempa+$tra+$tda)); ?></td>
                            <td><?php echo $value['status']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm bank_edit" data-toggle="modal" data-target=".bs-example-modal-ebank" data-id="<?php echo $value['bankAccountId']; ?>" onclick="document.getElementById('bank_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                                <a href="<?php echo site_url('BankAccount/bank_account_delete') . '/' . $value['bankAccountId'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Mobile Account ?');" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Account Name</th>
                            <th>Account No</th>
                            <th>Bank Name</th>
                            <th>Branch Name</th>
                            <th>Opening Balance</th>
                            <td><?php echo number_format(($tba), 2); ?></td>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="add_bank" class="modal fade bs-example-modal-abank" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Bank Transaction Information</h4>
                </div>
                <form action="<?php echo base_url('BankAccount/SaveBankAccount');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account Name *</label>
                            <input type="text" class="form-control" name="accountName" placeholder="Account Name" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account No *</label>
                            <input type="text" class="form-control" name="accountNo" placeholder="Account No" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Bank Name *</label>
                            <input type="text" class="form-control" name="bankName" placeholder="Bank Name" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Branch Name</label>
                            <input type="text" class="form-control" name="branchName" placeholder="Branch Name" >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account Balance</label>
                            <input type="text" class="form-control" name="balance" placeholder="Account Balance" >
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

    <div id="bank_edit" class="modal fade bs-example-modal-ebank" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Bank Transaction Information</h4>
                </div>
                <form action="<?php echo base_url('BankAccount/SaveBankAccount');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account Name *</label>
                            <input type="text" class="form-control" name="accountName" id="accountName" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account No *</label>
                            <input type="text" class="form-control" name="accountNo" id="accountNo" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Bank Name *</label>
                            <input type="text" class="form-control" name="bankName" id="bankName" required >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Branch Name</label>
                            <input type="text" class="form-control" name="branchName" id="branchName" >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Account Balance</label>
                            <input type="text" class="form-control" name="balance" id="balance" >
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" >
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="bankAccountId" name="bankAccountId" >
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".bank_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="bankAccountId"]').val(catid);
        });

        $('.bank_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>BankAccount/get_bank_trans';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["accountNo"];
              var HTML2 = data["accountName"];
              var HTML3 = data["bankName"];
              var HTML6 = data["branchName"];
              var HTML4 = data["balance"];
              var HTML5 = data["status"];
    //alert(HTML);
              $("#accountNo").val(HTML);
              $("#accountName").val(HTML2);
              $("#bankName").val(HTML3);
              $("#branchName").val(HTML6);
              $("#balance").val(HTML4);
              $("#status").val(HTML5);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>