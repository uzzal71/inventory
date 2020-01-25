    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="https://sunshine.com.bd/">Sunshine It</a></strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
    <script type="text/javascript" src="<?php echo site_url('assets/plugins/chosen/js/chosen.jquery.js')?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/plugins/chosen/js/prism.js')?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/plugins/chosen/js/init.js')?>"></script>


    <script src="<?php echo site_url('assets/plugins/fastclick/fastclick.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo site_url('assets/dist/js/app.min.js') ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo site_url('assets/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo site_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo site_url('assets/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo site_url('assets/plugins/chartjs/Chart.min.js') ?>"></script>
   
    <script src="<?php echo site_url('assets/backend/dist/js/pages/dashboard2.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo site_url('assets/backend/dist/js/demo.js') ?>"></script>
    
        <!-- select2 start -->
    <script src='<?php echo site_url('assets/select2/dist/js/select2.min.js') ?>' type='text/javascript'></script>

    <!-- CSS -->
    <link href='<?php echo site_url('assets/select2/dist/css/select2.min.css') ?>' rel='stylesheet' type='text/css'>

    <!-- select2 end -->
    

    <script type="text/javascript">
        function printDiv(divName) {
            $('#header').show();
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            }
    </script>


    <script type="text/javascript">
        $('#datatable').dataTable();

        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $('#example').dataTable({
            paging: false,
            searching: false
        });
    </script>