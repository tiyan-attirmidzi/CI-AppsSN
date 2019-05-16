    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/paramedic"><i class="material-icons">accessible</i> Pasien</a></li>
                <li class="active"><i class="material-icons">add</i> Tambah Pasien</li>
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
                                TAMBAH PASIEN
                                <small>Masukkan Data Yang Valid (Sesuai Dengan Kartu Tanda Penduduk)</small>
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/patient/insert'); ?>
                                <div class="row clearfix">
                                    <div class="body">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label for="patient_noktp">Nomor KTP</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="patient_noktp" class="form-control" name="patient_noktp" placeholder="Masukkan Nomor KTP" value="<?php echo set_value('patient_noktp'); ?>" autofocus>
                                                    </div>
                                                    <span class='text-danger'><?php echo form_error('patient_noktp'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="patient_name">Nama Lengkap</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="patient_name" class="form-control" name="patient_name" placeholder="Masukkan Nama Lengkap" value="<?php echo set_value('patient_name'); ?>">
                                                    </div>
                                                    <span class='text-danger'><?php echo form_error('patient_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="patient_sex">Jenis Kelamin</label>
                                                <span class='text-danger'> *</span>
                                                <div class="demo-radio-button">
                                                    <input name="patient_sex" type="radio" id="radio_39" value="Laki-laki" class="with-gap radio-col-green"/>
                                                    <label for="radio_39">Laki-laki</label>
                                                    <input name="patient_sex" type="radio" id="radio_40" value="Perempuan" class="with-gap radio-col-green" />
                                                    <label for="radio_40">Perempuan</label>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_sex'); ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="patient_address">Alamat Lengkap</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea rows="4" class="form-control no-resize" name="patient_address" placeholder="Masukkan Alamat Lengkap"><?php echo set_value('patient_address'); ?></textarea>
                                                    </div>
                                                    <span class='text-danger'><?php echo form_error('patient_address'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label for="patient_datebirth">Tanggal Lahir</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="patient_datebirth" class="datepicker form-control" name="patient_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo set_value('patient_datebirth'); ?>">
                                                    </div>
                                                    <span class='text-danger'><?php echo form_error('patient_datebirth'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="patient_religion">Agama</label>
                                                <span class='text-danger'> *</span>
                                                <select class="form-control show-tick" id="patient_religion" name="patient_religion">
                                                    <option value="">Agama Pasien</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                                                </select>
                                                <span class='text-danger'><?php echo form_error('patient_religion'); ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="patient_job">Pekerjaan</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="patient_job" class="form-control" name="patient_job" placeholder="Masukkan Nama Pekerjaan" value="<?php echo set_value('patient_job'); ?>">
                                                    </div>
                                                    <span class='text-danger'><?php echo form_error('patient_job'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="patient_phone">Nomor Handphone</label>
                                                    <span class='text-danger'> *</span>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="patient_phone" class="form-control" name="patient_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo set_value('patient_phone'); ?>">
                                                        </div>
                                                        <div class="help-info">Ex: 082324252627</div>
                                                        <span class='text-danger'><?php echo form_error('patient_phone'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan Perubahan</button>
                                            <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/patient'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                        </div>
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
