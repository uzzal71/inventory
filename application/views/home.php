<?php $pages = $this->session->userdata('pages'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- <img src="<?php echo base_url(); ?>assets/img/comingsoon.gif" style="width: 100%; height: 100%;"> -->
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Product/product_reports')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Product</span>
                            <span class="info-box-number"><?php echo $tproduct; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Purchase/all_purchases_reports')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Purchase</span>
                            <span class="info-box-number"><?php echo number_format(($tpurchase->total), 2) ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Sale/all_sales_reports')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sales</span>
                            <span class="info-box-number"><?php echo number_format(($tsales->total), 2);// echo number_format(($tsales->total-$tsales->tda), 2) ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Quotation')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Quotation</span>
                            <span class="info-box-number"><?php echo $tuotation; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Employee')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Employee</span>
                            <span class="info-box-number"><?php echo $temployee; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('Customer')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Customers</span>
                            <span class="info-box-number"><?php echo $tcustomer; ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url('BankAccount')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-university"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Bank Amount</span>
                            <?php $tba = (($tba->total+$tsba->total+$tcvba->total)-($tpba->total+$tdvba->total+$tspvba->total+$tcpvba->total+$tempba->total+($trba->total-$trba->totalsca))); ?>
                            <span class="info-box-number"><?php echo number_format($tba, 2); ?></span>
                        </div>
                    </div>
                </a>    
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url('CashAccount')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Cash Amount</span>
                            <?php $tca = (($tca->total+$tsca->total+$tcvca->total)-($tpca->total+$tdvca->total+$tspvca->total+$tcpvca->total+$tempca->total+($trca->total-$trca->totalsca))); ?>
                            <span class="info-box-number"><?php echo number_format($tca, 2); ?></span>
                        </div>
                    </div>
                </a>    
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo base_url('MobileAccount')?>"> 
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-mobile"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mobile Amount</span>
                            <?php $tmat = (($tma->total+$tsma->total+$tcvma->total)-($tpma->total+$tdvma->total+$tspvma->total+$tcpvma->total+$tempma->total+($trma->total-$trma->totalsca))); ?>
                            <span class="info-box-number"><?php echo number_format($tmat, 2); ?></span>
                        </div>
                    </div>
                </a>    
            </div>
        </div>
    </section>
</div>