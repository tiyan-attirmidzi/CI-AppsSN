    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/slider"><i class="material-icons">burst_mode</i> Slider</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit Slider</li>
            </ol>
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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT SLIDER
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/slider/edit'); ?>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <label for="slider_name">Nama Slider</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="slider_name" class="form-control" name="slider_name" placeholder="Masukkan Nama Slider" value="<?php echo $keys[0]['slider_name']; ?>" autofocus>
                                                    <input type="hidden" id="slider_id" class="form-control" name="slider_id" value="<?php echo $keys[0]['slider_id']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('slider_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="slider_image">Ganti Gambar</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="slider_image" class="form-control" name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url(); ?>img/slider/<?php echo $keys[0]['slider_image']; ?>" class="img-resposive center" width="50%">                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="slider_desc">Deskripsi</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="slider_desc" class="form-control" id="ckeditor2" cols="30" rows="20"><?php echo $keys[0]['slider_desc']; ?></textarea>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('slider_desc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="slider_status">Status</label>
                                        <span class='text-danger'> *</span>
                                        <div class="demo-radio-button">
                                            <?php 
                                                if ($keys[0]['slider_status'] == "1") 
                                                {
                                                    echo "
                                                        <input name='slider_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green' checked/>
                                                        <label for='radio_1'>Aktif</label>
                                                        <input name='slider_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' />
                                                        <label for='radio_2'>Non Aktif</label>
                                                    ";
                                                }
                                                else
                                                {
                                                    echo "
                                                        <input name='slider_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green'/>
                                                        <label for='radio_1'>Aktif</label>
                                                        <input name='slider_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' checked/>
                                                        <label for='radio_2'>Non Aktif</label>
                                                    ";
                                                }
                                            ?>
                                        </div>
                                        <span class='text-danger'><?php echo form_error('slider_status'); ?></span>
                                    </div>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor');
                                    </script>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor2');
                                    </script>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/slider'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>   
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
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

    <!-- Autosize Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>tamplate-dashboard/js/demo.js"></script>

</body>
</html> 