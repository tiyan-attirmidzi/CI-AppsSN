<section class="content">
        <div class="container-fluid">
            <h3>Selamat Datang, <?php echo $user[0]->user_name; ?></h3><br>

            <!-- Iklan -->
            <div class="row clearfix">
                <h4 class="align-center">Iklan SN Al-Kobar Health Center</h4>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php 
                            $imgslider=0;
                            foreach ($slider as $keys ) 
                            {
                                if($imgslider==0)
                                {
                                    echo '
                                        <div class="item active">
                                        <img src="'.base_url().'/img/slider/'.$keys->slider_image.'" height="300" alt="'.$keys->slider_name.'" style="width:100%;">
                                        </div>
                                    ';
                                }
                                else
                                {
                                    echo '
                                        <div class="item">
                                        <img src="'.base_url().'/img/slider/'.$keys->slider_image.'" height="300" alt="'.$keys->slider_name.'" style="width:100%;">
                                        </div>
                                    ';
                                }
                                $imgslider++;
                            } 
                        ?>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- #END# Iklan -->

        </div><br>

        <div class="container-fluid">
            <h4 class="align-center">Artikel Kesehatan</h4>

            <!-- Blog -->
            <div class="row clearfix">
                <!-- Blog  -->
                <?php foreach($post as $p) { ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo base_url()?>/img/post/<?php echo $p->post_image?>" height="150" alt="img01">
                        <div class="caption">
                            <h3><?php echo $p->post_title; ?></h3>
                            <p>
                                <?php echo substr($p->post_desc, 0,100)."..."; ?>
                            </p>
                            <p>
                                <a href="javascript:void(0);" class="btn btn-primary waves-effect" role="button">Detail</a>
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