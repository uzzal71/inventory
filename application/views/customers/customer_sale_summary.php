<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>Customer Sales Summary</h1>
    </section>
    <div class="box">
        <div class="box-body">
            <div id="table-content">
                <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0"width="100%">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Party Name</th>
                      <th>Previous Year Net Due</th>
                      <th>GrossSales-<?php echo Date('Y')?></th>
                      <th>Discount Amount</th>
                      <th>Discount Percentage</th>
                      <th>Net Value-<?php echo Date('Y')?></th>
                      <th>Total Net Value(Previous Year+<?php echo Date('Y')?> Net value)</th>
                      <th>Total Collection-<?php echo Date('Y')?></th>
                      <th>Total Due</th>
                      <th>Collection Percentage</th>
                      <th>Closing Due before-<?php echo Date('Y')?></th>
                      <th>Average Net Sales</th>
                      <th>Average Net Collection</th>
                      <th>Signature</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    foreach ($customers as $key => $row) { ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $this->pm->get_customer_name($row['customer_id']); ?></td>
                      <td><?php
                        $previous_year_net_due = $this->pm->get_previous_year_net_due($row['customer_id']);
                        if($previous_year_net_due){echo '৳.'.$previous_year_net_due;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                      $gross_sale_current_year = $this->pm->get_gross_sale_current_year($row['customer_id']);
                      if($gross_sale_current_year){echo '৳.'.$gross_sale_current_year;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                      $discount_amount = $this->pm->get_discount_amount($row['customer_id']);
                      if($discount_amount){echo '৳.'.$discount_amount;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                        if($gross_sale_current_year != 0) {
                          $discount_percentage = number_format(($discount_amount * 100) / $gross_sale_current_year, 2);
                          if($discount_percentage){echo $discount_percentage.' %';}else{echo '0 %';}
                        }
                        else {
                          echo '0 %';;
                        }                       
                      ?></td>
                      <td><?php
                        echo '৳.';
                        $net_value = $gross_sale_current_year - $discount_amount; 
                        echo $net_value;
                        ?></td>
                      <td><?php
                        echo '৳.';
                        $total_net_value = $previous_year_net_due + $net_value;
                        echo $total_net_value;
                      ?></td>
                      <td><?php
                        $total_collection_current_year = $this->pm->total_collection_current_year_sale($row['customer_id']) + $this->pm->total_collection_current_year_voucher($row['customer_id']);
                        if($total_collection_current_year){echo '৳.'.$total_collection_current_year;}else{echo '৳.0.00';}
                        //echo $total_collection_current_year;
                      ?></td>
                      <td><?php
                        // $total_due_current_year = $this->pm->total_due_current_year($row['customer_id']);
                        $total_due_current_year = $total_net_value - $total_collection_current_year;
                        if($total_due_current_year){echo '৳.'.$total_due_current_year;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                        $collection_percentage = number_format((($total_collection_current_year * 100) / $total_net_value), 2);
                        if($collection_percentage){echo $collection_percentage.'%';}else{echo '0%';}
                      ?></td>
                      <td><?php
                        $closing_due = $total_collection_current_year - $previous_year_net_due;
                        if($closing_due){echo '৳.'.$closing_due;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                      $month = date('m', strtotime('month'));
                      $average_net_sales = $total_net_value / $month;
                      if($average_net_sales){echo '৳.'.$average_net_sales;}else{echo '৳.0.00';}
                      ?></td>
                      <td><?php
                      $month = date('m', strtotime('month'));
                      $average_net_collection = $total_collection_current_year / $month;
                      if($average_net_collection){echo '৳.'.$average_net_collection;}else{echo '৳.0.00';}
                      ?></td>
                      <td></td>
                    </tr>
                    <?php }
                    ?>                    
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
$('#dtHorizontalVerticalExample').DataTable({
  "scrollX": true,
  "scrollY": 300,
  buttons: [
    'excel'
  ],
});
$('.dataTables_length').addClass('bs-select');
});

$(document).ready( function () {
  var table = $('#example').DataTable({
  dom: 'Bfrtip',
  scrollX: true,
  scrollY: "600px",
  scrollCollapse: true,
  buttons: [
    { extend: 'copyHtml5', text: 'Copy to Clipboard' },
    { extend: 'excelHtml5', text: 'Excel' },
    { extend: 'pdfHtml5', text: 'PDF', orientation: 'landscape',},
    { extend: 'print', text: 'Print', autoPrint: true}
  ]
    });
} );

</script>

<style type="text/css">
    .dtHorizontalVerticalExampleWrapper {
max-width: 600px;
margin: 0 auto;
}
#dtHorizontalVerticalExample th, td {
white-space: nowrap;
}
table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}
</style>