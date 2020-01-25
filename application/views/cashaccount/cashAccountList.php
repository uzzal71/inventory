<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Cash Transaction</h1>
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
            <h3 class="box-title">Cash Transaction List</h3>
            <button type="button" class="btn btn-primary add_cash" data-toggle="modal" data-target=".bs-example-modal-acash" style="float: right" ><i class="fa fa-plus"></i> New Cash Account</button>
        </div>
        <div class="box-body">
            <div id="table-content ">
                <table id="datatable" class="table-responsive table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Cash Name</th>
                            <th>Opening Balance</th>
                            <th>Current Balance</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $tba = 0;
                        foreach ($cashList as $key => $value) {
                        $id = $value['cashId'];
                        //var_dump($id);

                        $sa = $this->db->select('SUM(paidAmount) as total')
                                    ->from('sales')
                                    ->where('accountType','Cash')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($sa); //exit();
                        if($sa == null){
                            $saa = 0;
                            }
                        else{
                            $saa = $sa->total;
                        }

                        $pa = $this->db->select("SUM(paidAmount) as total")
                                    ->from('purchase')
                                    ->where('accountType','Cash')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                    //var_dump($pa);// exit();
                        if($pa == null){
                            $paa = 0;
                            }
                        else{
                            $paa = $pa->total;
                        }

                        $va = $this->db->select("SUM(totalamount) as total")
                                    ->from('vaucher')
                                    ->where('accountType','Cash')
                                    ->where('vauchertype','Credit Voucher')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($va); //exit();
                        if($va == null){
                            $vaa = 0;
                            }
                        else{
                            $vaa = $va->total;
                        }

                        $va2 = $this->db->select("SUM(totalamount) as total")
                                    ->from('vaucher')
                                    ->where('accountType','Cash')
                                    ->where_not_in('vauchertype','Credit Voucher')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($va2); //exit();
                        if($va2 == null){
                            $vaa2 = 0;
                            }
                        else{
                            $vaa2 = $va2->total;
                        }
                        $tva = $vaa-$vaa2;

                        $temp = $this->db->select("SUM(salary) as total")
                                    ->from('employee_payment')
                                    ->where('accountType','Cash')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($temp); //exit();
                        if($temp == null){
                            $tempa = 0;
                            }
                        else{
                            $tempa = $temp->total;
                        }

                        $tr = $this->db->select("SUM(totalPrice) as total,SUM(scAmount) as sctotal")
                                    ->from('returns')
                                    ->where('accountType','Cash')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($tr); //exit();
                        if($tr == null){
                            $tra = 0;
                            }
                        else{
                            $tra = $tr->total-$tr->sctotal;
                        }

                        $td = $this->db->select("SUM(totalPrice) as total,SUM(scAmount) as sctotal")
                                    ->from('damages')
                                    ->where('accountType','Cash')
                                    ->where('accountNo',$id)
                                    ->get()
                                    ->row();
                        //var_dump($td); exit();
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
                            <td><?php echo $value['cashName']; ?></td>
                            <td><?php echo number_format(($value['balance']), 2); ?></td>
                            <td><?php echo number_format(((($value['balance'])+$saa+$tva)-($paa+$tempa+$tra+$tda)), 2); $tba += ((($value['balance'])+$saa+$tva)-($paa+$tempa+$tra+$tda)); ?></td>
                            <td><?php echo $value['status']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($value['createdDate'])); ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm cash_edit" data-toggle="modal" data-target=".bs-example-modal-ecash" data-id="<?php echo $value['cashId']; ?>" onclick="document.getElementById('cash_edit').style.display='block'" ><i class="fa fa-edit"></i></button>
                                <a href="<?php echo site_url('CashAccount/cash_account_delete') . '/' . $value['cashId'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Mobile Account ?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Cash Name</th>
                            <th>Balance</th>
                            <td><?php echo number_format(($tba), 2); ?></td>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div id="add_cash" class="modal fade bs-example-modal-acash" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Cash Transaction Information</h4>
                </div>
                <form action="<?php echo base_url('CashAccount/SaveCashAccount');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Cash Name *</label>
                            <input type="text" name="cashName" class="form-control" placeholder="Cash Name" required >
                        </div>
                        <div class="form-group">
                            <label>Cash Amount</label>
                            <input type="text" name="balance" class="form-control" placeholder="Cash Amount" required >
                        </div>
                        <div class="form-group" >
                            <label>Status</label>
                            <div>
                                <input type="radio" name="status" value="Active" checked="checked" >&nbsp;Active&nbsp;&nbsp;
                                <input type="radio" name="status" value="Inactive" >&nbsp;Inactive
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="cash_edit" class="modal fade bs-example-modal-ecash" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Cash Transaction Information</h4>
                </div>
                <form action="<?php echo base_url('CashAccount/SaveCashAccount');?>" method="post">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Cash Name *</label>
                            <input type="text" name="cashName" id="cashName" class="form-control" placeholder="Cash Name" required >
                        </div>
                        <div class="form-group">
                            <label>Cash Amount</label>
                            <input type="text" name="balance" id="balance" class="form-control" placeholder="Cash Amount" required >
                        </div>
                        <div class="form-group" >
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" >
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="cashId" name="cashId" >
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
        $(".cash_edit").click(function () {
          var catid = $(this).data('id');
//alert(l_id);
          $('input[name="cashId"]').val(catid);
        });

        $('.cash_edit').click(function() {
          var id = $(this).data('id');
    //alert(id);
          var url = '<?php echo base_url() ?>CashAccount/get_cash_account';
    //alert(url);
            $.ajax({
              method: 'POST',
              url     : url,
              dataType: 'json',
              data    : {'id' : id},
              success:function(data){ 
    //alert(data);
              var HTML = data["cashName"];
              var HTML2 = data["balance"];
              var HTML3 = data["status"];
    //alert(HTML);
              $("#cashName").val(HTML);
              $("#balance").val(HTML2);
              $("#status").val(HTML3);
              },
              error:function(){
              alert('error');
              }
            });
        });
      });
    </script>