<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Voucher</h1>
    </section>

    <?php
    $exception = $this->session->userdata('exception');
    if(isset($exception))
    {
    echo $exception;
    $this->session->unset_userdata('exception');
    } ?>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Voucher List</h3>
            <a href="<?php echo site_url('Voucher/new_voucher') ?>" class="btn btn-primary" style="float: right" ><i class="fa fa-plus"></i> New Voucher</a>
        </div>
        <div class="box-body">
            <div id="table-content ">
                <table id="datatable" class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Vaucher Type</th>
                            <th>Customer</th>
                            <th>Emplyoee</th>
                            <th>Supplier</th>
                            <th>Amount</th>
                            <th style="width: 12%;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Date</th>
                            <th>Vaucher Type</th>
                            <th>Customer</th>
                            <th>Emplyoee</th>
                            <th>Supplier</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($vaucher as $value) {
                        $i++;
                        $cid = $value['customerID'];
                        $eid = $value['employee'];
                        $sid = $value['supplier'];

                        $customer = $this->db->select('customerID,customerName')
                                            ->from('customers')
                                            ->where('customerID',$cid)
                                            ->get()
                                            ->row();

                        $employee = $this->db->select('employeeID,employeeName')
                                            ->from('employees')
                                            ->where('employeeID',$eid)
                                            ->get()
                                            ->row();

                        $supplier = $this->db->select('supplierID,supplierName')
                                            ->from('suppliers')
                                            ->where('supplierID',$sid)
                                            ->get()
                                            ->row();
                //var_dump($customer,$eid); exit();
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($value['voucherdate'])); ?></td>
                            <td><?php echo $value['vauchertype']; ?></td>
                            <td>
                                <?php if($value['customerID'] == 0){ ?>
                                <?php echo 'N/A'; ?>
                                <?php } else{ ?>
                                <?php echo $customer->customerName; ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($value['employee'] == 0){ ?>
                                <?php echo 'N/A'; ?>
                                <?php } else{ ?>
                                <?php echo $employee->employeeName; ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($value['supplier'] == 0){ ?>
                                <?php echo 'N/A'; ?>
                                <?php } else{ ?>
                                <?php echo $supplier->supplierName; ?>
                                <?php } ?>
                            </td>
                            <td><?php echo $value['totalamount']; ?></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="<?php echo site_url('Voucher/voucher_details').'/'.$value['vuid'] ?>" ><i class="fa fa-eye"></i></a>
                                <a class="btn btn-success btn-sm" href="<?php echo site_url('Voucher/voucher_edit').'/'.$value['vuid'] ?>" ><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('Voucher/voucher_delete').'/'.$value['vuid'] ?>" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>