                <div class="page-inner">

                    <div class="page-title">
                        <h3 class="breadcrumb-header">Report</h3>
                    </div>

                    <!-- Main Wrapper -->
                    <div id="main-wrapper">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="panel panel-white">
                                    <?php echo form_open('admin/report/cetak'); ?>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <select class="form-control" name="tahun">
                                                    <option value="">-- Pilih Tahun --</option>
                                                    <?php
                                                        for($i=2018;$i<=date("Y");$i++)
                                                        {
                                                            if($i==date("Y"))
                                                            {
                                                                echo "<option value=".$i." selected>".$i."</option>";
                                                            } 
                                                            else 
                                                            {
                                                                echo "<option value=".$i.">".$i."</option>";
                                                            }  
                                                        }   
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Bulan</label>
                                                <select class="form-control" name="bulan">
                                                    <option value="">-- Pilih Bulan --</option>
                                                    <?php 
                                                        $month = array(
                                                            "Januari",
                                                            "Februari",
                                                            "Maret",
                                                            "April",
                                                            "Mei",
                                                            "Juni",
                                                            "Juli",
                                                            "Agustus",
                                                            "September",
                                                            "Oktober",
                                                            "November",
                                                            "Desember"
                                                        );
                                                        $months = array("01","02","03","04","05","06","07","08","09","10","11","12");
                                                        $total = count($month);
                                                        for($i=0; $i<$total; $i++)
                                                        {
                                                            if($i == date('m')-1)
                                                            {
                                                                echo "<option value=".$months[$i]." selected>".$month[$i]."</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value=".$months[$i].">".$month[$i]."</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <select class="form-control" name="tanggal">
                                                    <option value="">-- Pilih Tanggal --</option>
                                                    <?php 
                                                        for($i=1; $i<=31; $i++)
                                                        {
                                                            if($i == date("d"))
                                                            {
                                                                if(strlen($i)==1){
                                                                    echo "<option value=0".$i." selected>".$i."</option>";
                                                                }else{
                                                                    echo "<option value=".$i." selected>".$i."</option>";
                                                                }
                                                                
                                                            }
                                                            else
                                                            {
                                                                if(strlen($i)==1){
                                                                    echo "<option value=0".$i.">".$i."</option>";
                                                                }else{
                                                                    echo "<option value=".$i." >".$i."</option>";
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Main Wrapper -->

                    <div class="page-footer">
                        <p>&copy; 2018 <a href="http://www.technos-studio.com" target="_blank"><b>Techno's Studio</b></a>.</p>
                    </div>

                </div>
                <!-- /Page Inner -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        
        <!-- Javascripts -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/d3/d3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/nvd3/nv.d3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/chartjs/chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ecaps.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/pages/dashboard.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script> -->
    </body>
</html>