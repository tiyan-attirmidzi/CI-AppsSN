<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>File Dokumen</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <?php foreach ($document as $key) { ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="info-box-4 hover-zoom-effect">
                        <div class="icon">
                            <a href="<?php echo base_url(); ?>document/<?php echo $key->document_file;?>"><i class="material-icons col-blue">file_download</i></a>
                        </div>
                        <div class="content">
                            <div class="number"><?php echo $key->document_name;?></div>
                            <div class="text"><?php echo $key->document_desc;?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- #END# Widgets -->
    </div>
<section>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/demo.js"></script>
</body>
</html>