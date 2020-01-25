<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Quotation Information</h1>
    </section>

    <div class="box">
        <div class="box-body">     
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="print">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <h3 style="text-align: center;">Quotation Invoice</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Customer ID&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $quotation['customerID']; ?></b>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Customer Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $quotation['customerName']; ?></b>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $quotation['address']; ?></b>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Contact No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $quotation['mobile']; ?></b>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Quotation No.&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $quotation['qutid']; ?></b>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <b>Date&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($quotation['quotationDate'])); ?></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
                            <table class="table table-bordered table-striped">
                                <thead class="btn-default">
                                    <tr>
                                        <th style="width: 5%;">#SN.</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>      
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($pquotation as $value):
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value['productName']; ?></td>
                                        <td><?php echo $value['quantity']; ?></td>
                                        <td><?php echo number_format($value['salePrice'], 2); ?></td>
                                        <td><?php echo number_format($value['totalPrice'], 2); ?></td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                                <tbody style="border: 2px solid #000;">
                                    <tr style="border: 1px solid #FFFFFF;">
                                        <td colspan="4" align="right" >Total Price : </td>
                                        <td><?php echo number_format($quotation['totalPrice'], 2); ?></td>
                                    </tr>
                                </tbody>
                                <tbody style="border: 2px solid #000; text-align: right;">
                                    <tr>
                                        <?php $twa = abs($quotation['totalPrice']); ?>
                                        <td colspan="5">( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumberToWordsForIndia($twa); ?> )</td>
                                    </tr>
                                </tbody>
                                <?php if($quotation['note']){ ?>
                                <tbody>
                                    <tr>
                                        <td colspan="5">Remarks / Note</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><?php echo $quotation['note']; ?></td>
                                    </tr>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div align="center">
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <p>------------------------------</p>
                                        <p>Customer</p>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <p>------------------------------</p>
                                        <p>Prepared By</p>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <p>------------------------------</p>
                                        <p>Verified By</p>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <p>------------------------------</p>
                                        <p>Authorized By</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
                    <a href="javascript:void(0)" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i> Print</a>
                </div>          
                <a href="<?php echo site_url('Quotation') ?>" class="btn btn-danger btn-lg pull-right" style="margin-right:10px">Back</a>
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