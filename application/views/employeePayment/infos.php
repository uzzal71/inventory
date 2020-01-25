<div class="content-wrapper" style="min-height: 1126px;">    
    <section class="content-header">
        <h1>Employee Payment</h1>
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
            <h3 class="box-title">Employee Payment List</h3>
            <a href="<?php echo site_url('Employee_payment/AddInfo') ?>" class="btn btn-primary" style="float: right" ><i class="fa fa-plus"></i> New Payment</a>
        </div>
        <div class="box-body">
            <div id="table-content ">
                <table id="datatable" class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#SN.</th>
                            <th>Employee Name</th>
                            <th>Company / Warehouse</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Payment Amount</th>
                            <th>Account Type</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#SN.</th>
                            <th>Employee Name</th>
                            <th>Company / Warehouse</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Payment Amount</th>
                            <th>Account Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($employees as $key => $value) {
                        $i++;
                        ?>
                        <tr class="gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['employeeName']; ?></td>
                            <td><?php echo $value['companyName']; ?></td>
                            <td><?php echo $value['year']; ?></td>
                            <td>
                                <?php
                                $month = $value['month'];
                                if($month == 01){
                                   $name = 'January';
                                }elseif ($month == 02) {
                                    $name = 'February';
                                }elseif ($month == 03) {
                                    $name = 'March';
                                }elseif ($month == 04) {
                                    $name = 'April';
                                }elseif ($month == 05) {
                                    $name = 'May';
                                }elseif ($month == 06) {
                                    $name = 'June';
                                }elseif ($month == 07) {
                                    $name = 'July';
                                }elseif ($month == 8) {
                                    $name = 'August';
                                }elseif ($month == 9) {
                                    $name = 'September';
                                }elseif ($month == 10) {
                                    $name = 'October';
                                }elseif ($month == 11) {
                                    $name = 'November';
                                }else {
                                    $name = 'December';
                                }
                                ?>
                                <?php echo $name; ?>
                            </td>
                            <td><?php echo $value['salary']; ?></td>
                            <td><?php echo $value['accountType']; ?></td>
                            <td>
                                <a class=" btn btn-success btn-sm" href="<?php echo site_url('Employee_payment/emp_payment_details').'/'.$value['empPid'] ?>" ><i class="fa fa-eye"></i> Details</a>
                            </td>
                        </tr>   
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>