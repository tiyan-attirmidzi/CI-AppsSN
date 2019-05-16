    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/post"><i class="material-icons">subject</i> Post Blog</a></li>
                <li class="active"><i class="material-icons">add</i> Tambah Blog</li>
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
                                TAMBAH BLOG
                                <!-- <small>Masukkan Data Yang Valid</small> -->
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/post/input'); ?>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label for="post_title">Judul Blog</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="post_title" class="form-control" name="post_title" placeholder="Masukkan Judul Blog" value="<?php echo set_value('post_title'); ?>" autofocus>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('post_title'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="paramediccategory_id">Kategori Blog</label>
                                        <span class='text-danger'> *</span>
                                        <select class="form-control show-tick" id="postcategory_id" name="postcategory_id">
                                            <option value="">Kategori Blog</option>
                                            <?php foreach ($postcategory as $key) { ?>
                                                <option value="<?php echo $key->postcategory_id; ?>"><?php echo $key->postcategory_name; ?></option>
                                            <?php }; ?>
                                        </select>
                                        <span class='text-danger'><?php echo form_error('postcategory_id'); ?></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="post_postby">Di Post Oleh</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="post_postby" class="form-control" name="post_postby" placeholder="Di Post Oleh" value="<?php echo set_value('post_postby'); ?>" autofocus>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('post_postby'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="post_image">Sampul (Cover)</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="post_image" class="form-control" name="userfile" required>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('userfile'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="post_desc">Deskripsi</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="post_desc" class="form-control" id="ckeditor2" cols="30" rows="20"><?php echo set_value('post_desc'); ?></textarea>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('post_desc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="post_status">Status</label>
                                        <span class='text-danger'> *</span>
                                        <div class="demo-radio-button">
                                            <input name="post_status" type="radio" id="radio_1" value="1" class="with-gap radio-col-green"/>
                                            <label for="radio_1">Akrif</label>
                                            <input name="post_status" type="radio" id="radio_2" value="0" class="with-gap radio-col-green" />
                                            <label for="radio_2">Non Aktif</label>
                                        </div>
                                        <span class='text-danger'><?php echo form_error('post_status'); ?></span>
                                    </div>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor');
                                    </script>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor2');
                                    </script>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Tambah</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/post'" class="btn btn-default btn-lg waves-effect">Kembali</button>
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