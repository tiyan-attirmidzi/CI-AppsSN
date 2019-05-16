    <section class="content">

        <div class="container-fluid">
            <h3 class="align-center">Layanan Yang Tersedia</h3><br>
            <?php      
                $message = $this->session->flashdata('notif_success');
                if($message)
                {
                    echo '<p class="alert alert-info text-center">'.$message .'</p>';
                }
                $message = $this->session->flashdata('notif_danger');
                if($message)
                {
                    echo '<p class="alert alert-danger text-center">'.$message .'</p>';
                }
            ?> 
            <!-- Blog -->
            <div class="row clearfix">
                <!-- Blog  -->
                <?php foreach($service as $p) { ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail"><br>
                        <img src="<?php echo base_url()?>/img/service/<?php echo $p->service_image?>" height="150" alt="img01">
                        <div class="caption">
                            <h3><?php echo $p->service_name; ?></h3><hr>
                            <p>
                                <a href="<?php echo base_url(); ?>patient/order/contract?service_id=<?php echo base64_encode($p->service_id); ?>" class="btn btn-primary btn-block waves-effect" role="button">Pesan</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php }; ?>
                <!-- #END# Blog  -->
            </div>
            <!-- #END# Blog -->

        </div>

    </section>

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