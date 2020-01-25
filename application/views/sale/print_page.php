<div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Sale Invoice</h1>
    </section>

    <div class="box">
        <div class="box-body">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div id="print">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12" >
                          <div class="col-sm-2 col-md-2 col-xs-2" style="margin-top: 30px;">
                            <img src="<?php echo base_url($company->com_logo); ?>" style="width: 100%;" >
                          </div>
                          <div class="col-sm-6 col-md-6 col-xs-6">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                              <h3><b><?php echo $company->com_name; ?></b></h3>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                              <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_address; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                              <b>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_email; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                              <b>Mobile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $company->com_mobile; ?></b>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top: 25px;">
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <b>Invoice No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['saleID']; ?></b>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <b>Date&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($prints['saleDate'])); ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <h3 style="text-align:center;">Sale Invoice / Bill</h3>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <div class="col-sm-7 col-md-7 col-xs-7">
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>Customer ID&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['customerID']; ?></b>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>Chemist Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['compname']; ?></b>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['address']; ?></b>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>Proprietor&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['customerName']; ?></b>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>Contact No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['mobile']; ?></b>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xs-12">
                                        <b>M.O. Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $prints['employeeName']; ?>-<?php echo $prints['empid']; ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background: #ddd; border: 2px solid #000;">
                                            <th style="border: 1px solid #000;">#SN.</th>
                                            <th style="border: 1px solid #000;">Products</th>
                                            <th style="border: 1px solid #000;">Pack Size</th>
                                            <th style="border: 1px solid #000;">Sale Quantity</th>
                                            <th style="border: 1px solid #000;">Bonus Quantity</th>
                                            <th style="border: 1px solid #000;">Total Quantity</th>
                                            <th style="border: 1px solid #000;">Unit Price</th>
                                            <th style="border: 1px solid #000; width: 15%;">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody style="border: 2px solid #000;">
                                        <?php
                                        $i = 0;
                                        $tsq = 0;
                                        $tbq = 0;
                                        $tq = 0;
                                        $tsa = 0;
                                        $stotal = 0;
                                        $tba = 0;
                                        foreach ($salesp as $value) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td style="border: 1px solid #000;"><?php echo $i; ?></td>
                                            <td style="border: 1px solid #000;"><?php echo $value['productName']; ?></td>
                                            <td style="border: 1px solid #000;"><?php echo $value['packsize']; ?></td>
                                            <td style="border: 1px solid #000;"><?php echo round($value['squantity']); $tsq += $value['squantity']; ?></td>
                                            <td style="border: 1px solid #000;"><?php echo round($value['bquantity']); $tbq += $value['bquantity']; ?></td>
                                            <td style="border: 1px solid #000;"><?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                                            <td style="border: 1px solid #000;">
                                                <?php echo number_format($value['sprice'], 2); $tsa += $value['sprice']; ?>
                                                <?php $tba += ($value['bquantity']*$value['sprice']); ?>
                                            </td>
                                            <td style="border: 1px solid #000;"><?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tbody style="border: 2px solid #000;">
                                        <tr style="height: 10px;">
                                            <td colspan="3" align="right" >Total</td>
                                            <td><?php echo round($tsq); ?></td>
                                            <td><?php echo round($tbq); ?></td>
                                            <td><?php echo round($tq); ?></td>
                                            <td></td>
                                            <td><?php echo number_format($stotal, 2); ?></td>
                                        </tr> 
                                        <tr style="border: 1px solid #FFFFFF;">
                                            <td colspan="3" align="right">Discount
                                            <?php if($prints['discountType'] == '%') { ?>(<?php echo $prints['discount'].' %'; ?>)<?php } ?></td>
                                            <td colspan="4"></td>
                                            <td><?php echo number_format($prints['discountAmount'], 2); ?></td>
                                        </tr>
                                        <tr style="border: 1px solid #FFFFFF;">
                                            <td colspan="3" align="right">Bonus Amount</td>
                                            <td colspan="4"></td>
                                            <td><?php echo number_format($tba, 2); ?></td>
                                        </tr>
                                        <tr style="border: 1px solid #FFFFFF;">
                                            <td colspan="3" align="right">In Total</td>
                                            <td colspan="4"></td>
                                            <td><?php echo number_format(($stotal-$prints['discountAmount']), 2); ?></td>
                                        </tr>
                                        <tr style="border: 1px solid #FFFFFF;">
                                            <td colspan="3" align="right">Paid Amount</td>
                                            <td colspan="4"></td>
                                            <td><?php echo number_format($prints['paidAmount'], 2); ?></td>
                                        </tr>
                                        <tr style="border: 1px solid #FFFFFF;">
                                            <td colspan="3" align="right">Net Value</td>
                                            <td colspan="4"></td>
                                            <td><?php echo number_format(($stotal-($prints['discountAmount']+$prints['paidAmount'])), 2); ?></td>
                                        </tr>
                                        <tr style="border: 2px solid #000; text-align: right;">
                                            <td colspan="8">
                                                <?php $twa = abs($stotal-($prints['discountAmount']+$prints['paidAmount'])); ?>
                                                ( In Words : <?php echo convertNumberToWordsForIndia($stotal-$prints['discountAmount']); ?> )
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">  
                                    <div class="col-xs-4 col-sm-4 col-md-4">  
                                        <p>Previous Due</p>
                                        <p>
                                            <?php
                                            //$pd = (($csdue->total+$cra->sctotal+$cpa->total+$prints['balance'])-($csdue->ptotal+$csdue->tda+$cvpa->total+$cra->total));
                                            $balance = $this->pm->get_exist_balance($prints['customerID']);
                                            $pd = $balance - ($stotal-($prints['discountAmount']+$prints['paidAmount']));
                                            ?>
                                            <?php echo number_format($pd, 2); ?>
                                        </p>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <p>Current Invoice</p>
                                        <p>
                                            <?php echo number_format(($stotal-($prints['discountAmount']+$prints['paidAmount'])), 2); ?>
                                        </p>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <p>Total Dues</p>
                                        <p>
                                            <?php echo number_format((($stotal+$pd)-($prints['discountAmount']+$prints['paidAmount'])), 2); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    <?php if($prints['note'] != null){ ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            Note / Remarks
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <?php echo $prints['note']; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div align="center">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p>------------------------------</p>
                                    <p>Authorized Signature</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p>------------------------------</p>
                                    <p>Receiver's Signature</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-xs-12" style="text-align: center;margin-top: 20px">
                    <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <a href="<?php echo site_url('Sale') ?>" class="btn btn-danger btn-lg pull-right" style="margin-right:10px"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php
        function convertNumberToWordsForIndia($number){
            $words = array(
                '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
                '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
                '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
                '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
                '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
                '80' => 'eighty','90' => 'ninty');
    
    //First find the length of the number
            $number_length = strlen($number);
    //Initialize an empty array
            $number_array = array(0,0,0,0,0,0,0,0,0);        
            $received_number_array = array();
    
    //Store all received numbers into an array
            for($i=0;$i<$number_length;$i++){    
                $received_number_array[$i] = substr($number,$i,1);    
                }
    //Populate the empty array with the numbers received - most critical operation
            for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ 
                $number_array[$i] = $received_number_array[$j]; 
                }
            $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
            for($i=0,$j=1;$i<9;$i++,$j++){
        //"01,23,45,6,78"
        //"00,10,06,7,42"
        //"00,01,90,0,00"
                if($i==0 || $i==2 || $i==4 || $i==7){
                    if($number_array[$j]==0 || $number_array[$i] == "1"){
                        $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
                        $number_array[$i] = 0;
                        }
                    }
                }
            $value = "";
            for($i=0;$i<9;$i++){
                if($i==0 || $i==2 || $i==4 || $i==7){    
                    $value = $number_array[$i]*10; 
                    }
                else{ 
                    $value = $number_array[$i];    
                    }            
                if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
                if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
                if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
                if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
                if($i==6 && $value!=0){    $number_to_words_string.= "Hundred "; }            
                    }
                if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
                return ucwords(strtolower($number_to_words_string)." Taka Only.");
            }
    ?>