    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/service"><i class="material-icons">library_books</i> Layanan</a></li>
                <li class="active"><i class="material-icons">add</i> Tambah Layanan</li>
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
                                TAMBAH LAYANAN
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/service/input'); ?>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label for="service_name">Nama Layanan</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="service_name" class="form-control" name="service_name" placeholder="Masukkan Nama Layanan" value="<?php echo set_value('service_name'); ?>" autofocus>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('service_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="service_image">Gambar</label>
                                        <span class='text'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="service_image" class="form-control" name="userfile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="service_desc">Deskripsi</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="service_desc" class="form-control" id="ckeditor2" cols="30" rows="20"><?php echo set_value('service_desc'); ?></textarea>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('service_desc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="service_pricerange">Kisaran Harga</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="service_pricerange" class="form-control" id="ckeditor" cols="30" rows="20"><?php echo set_value('service_pricerange'); ?></textarea>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('service_pricerange'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="paramediccategory_id">Penanggung Jawab</label>
                                        <span class='text-danger'> *</span>
                                        <select class="form-control show-tick" id="paramediccategory_id" name="paramediccategory_id">
                                            <option value="">Penanggung Jawab</option>
                                            <?php foreach ($paramediccategory as $key) { ?>
                                                <option value="<?php echo $key->paramediccategory_id; ?>"><?php echo $key->paramediccategory_name; ?></option>
                                            <?php }; ?>
                                        </select>
                                        <span class='text-danger'><?php echo form_error('paramediccategory_id'); ?></span>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="service_status">Status Layanan</label>
                                        <span class='text-danger'> *</span>
                                        <div class="demo-radio-button">
                                            <input name="service_status" type="radio" id="radio_1" value="1" class="with-gap radio-col-green"/>
                                            <label for="radio_1">Aktif</label>
                                            <input name="service_status" type="radio" id="radio_2" value="0" class="with-gap radio-col-green" checked/>
                                            <label for="radio_2">Non Aktif</label>
                                        </div>
                                        <span class='text-danger'><?php echo form_error('service_status'); ?></span>
                                    </div>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor');
                                    </script>
                                    <script>
                                        var ckeditor = CKEDITOR.replace('ckeditor2');
                                    </script>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Tambah</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/service'" class="btn btn-default btn-lg waves-effect">Kembali</button>
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