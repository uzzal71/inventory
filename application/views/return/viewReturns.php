<div class="content-wrapper">
    <section class="content-header" style="background: #f2f2f2;padding-bottom: 10px">
      <h1>Returns Details</h1>
    </section>

    
    <div class="box">
        <div class="box-body" >
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div id="print">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12" >
                          <div class="col-sm-2 col-md-2 col-xs-2" style="margin-top: 30px;">
                            <img src="<?php echo base_url($company->com_logo); ?>"  style="width: 100%;">
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
                          <div>
                              <div class="col-sm-4 col-md-4 col-xs-4" style="margin-top: 25px;" >
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Return No.&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['returnId']; ?></b>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <b>Invoice No.&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['invoice']; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Date&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($returns['returnDate'])); ?></b>
                            </div>
                        </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <h3 style="text-align: center;">Products Return</h3>
                        </div>
                        <div class="col-sm-7 col-md-7 col-xs-7" style="margin-left: -20px;">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Customer ID&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['customerID']; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Customer Name&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['customerName']; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Address&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['address']; ?></b>
                            </div>
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <b>Contact No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $returns['mobile']; ?></b>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="background: #ddd; border: 2px solid #000;">
                                        <th style="border: 1px solid #000;">#SN.</th>
                                        <th style="border: 1px solid #000;">Product Name</th>
                                        <th style="border: 1px solid #000;">Product Quantity</th>
                                        <th style="border: 1px solid #000;">Unit Price</th>
                                        <th style="border: 1px solid #000; width: 15%;">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 2px solid #000;">
                                    <?php
                                    $i = 0;
                                    $tq = 0;
                                    $stotal = 0;
                                    foreach ($rproduct as $value) {
                                    $i++;
                                    ?>
                                    <tr style="min-height: 200px;">
                                        <td style="border: 1px solid #000;"><?php echo $i; ?></td>
                                        <td style="border: 1px solid #000;"><?php echo $value['productName']; ?></td>
                                        <td style="border: 1px solid #000;"><?php echo round($value['quantity']); $tq += $value['quantity']; ?></td>
                                        <td style="border: 1px solid #000;"><?php echo number_format($value['salePrice'], 2); ?></td>
                                        <td style="border: 1px solid #000;"><?php echo number_format($value['totalPrice'], 2); $stotal += $value['totalPrice']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tbody style="border: 2px solid #000;">
                                    <tr style="border: 1px solid #FFFFFF;">
                                        <td colspan="2" align="right" >Sub Total : </td>
                                        <td><?php echo $tq; ?></td>
                                        <td></td>
                                        <td><?php echo number_format($stotal, 2); ?></td>
                                    </tr>
                                    <tr style="border: 1px solid #FFFFFF;">
                                        <td colspan="2" align="right">Service Charge <?php if($returns['sctype'] == '%') { ?>(<?php echo $returns['scharge']; ?>)<?php } ?> : </td>
                                        <td colspan="2"></td>
                                        <td><?php echo number_format($returns['scAmount'], 2); ?></td>
                                    </tr>
                                    <tr style="border: 1px solid #FFFFFF;">
                                        <td colspan="2" align="right">Total : </td>
                                        <td colspan="2"></td>
                                        <td><?php echo number_format($stotal-$returns['scAmount'], 2); ?></td>
                                    </tr>
                                </tbody>
                                <tbody style="border: 2px solid #000; text-align: right;">
                                    <tr>
                                        <?php $twa = abs($stotal-$returns['scAmount']); ?>
                                        <td colspan="5">( In Words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo convertNumberToWordsForIndia($twa); ?> )</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if($returns['note'] != null){ ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            Note / Remarks
                        </div>
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <?php echo $returns['note']; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <br><br>
                    <div class="row">
                        <table class="col-md-12">
                            <tr align="center">
                                <td class="col-md-3 col-sm-3 col-xs-3">
                                    <p>------------------------------</p>
                                    <p>Customer</p>
                                </td>
                                <td class="col-md-3 col-sm-3 col-xs-3">
                                    <p><?php echo $returns['employeeName']; ?></p>
                                    <p>Prepared By</p>
                                </td>
                                <td class="col-md-3 col-sm-3 col-xs-3">
                                    <p>------------------------------</p>
                                    <p>Verified By</p>
                                </td>
                                <td class="col-md-3 col-sm-3 col-xs-3">
                                    <p>------------------------------</p>
                                    <p>Authorized By</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
                <div class="form-group col-md-12" style="text-align: center;margin-top: 20px">
                    <a href="javascript:void(0)" style="width: 100px;" value="Print" onclick="printDiv('print')" class="btn btn-primary"><i class="fa fa-print"> </i>  Print</a>
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <a href="<?php echo site_url('Returns') ?>" class="btn btn-danger btn-lg pull-right" style="margin-right:10px"><i class="fa fa-arrow-left"></i> Back</a>
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