    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/patient"><i class="material-icons">accessible</i> Pasien</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit Data Pasien</li>
            </ol>
        </div>
        <div class="container-fluid">
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
            <?php 
            
                $datetime = new DateTime($keys[0]['patient_registerdate']);
                $datee = $datetime->format('l, d F Y H:i:s');
            
            ?>
            <ol class="breadcrumb breadcrumb-bg-orange align-right" style="color : white;">
                Telah Melakukan Registrasi Pada <strong><i><?php echo $datee; ?></i></strong>
            </ol>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT DATA PASIEN
                                <small>Masukkan Data Yang Valid (Sesuai Dengan Kartu Tanda Penduduk)</small>
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/patient/update'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="patient_noregis">Nomor Registrasi</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_noregis" class="form-control" name="patient_noregis" value="<?php echo $keys[0]['patient_noregis']; ?>" readonly>
                                                    <input type="hidden" class="form-control" name="patient_id" value="<?php echo $keys[0]['patient_id']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_noregis'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_noktp">Nomor KTP</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_noktp" class="form-control" name="patient_noktp" value="<?php echo $keys[0]['patient_noktp']; ?>" readonly>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_noktp'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_name">Nama Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_name" class="form-control" name="patient_name" placeholder="Masukkan Nama Lengkap" value="<?php echo $keys[0]['patient_name']; ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 

                                                    if ($keys[0]['patient_sex'] == "Laki-laki") 
                                                    {
                                                        echo "
                                                            <input name='patient_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='patient_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' />
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='patient_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green'/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='patient_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('patient_sex'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_datebirth">Tanggal Lahir</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_datebirth" class="datepicker form-control" name="patient_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo $keys[0]['patient_datebirth']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_datebirth'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="patient_religion">Agama</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="patient_religion" name="patient_religion">
                                                <option value="">Agama Paramedis</option>
                                                <?php foreach ($religion as $key) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if($keys[0]['patient_religion'] == $key) echo 'selected'; ?>><?php echo $key; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('patient_religion'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_job">Pekerjaan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_job" class="form-control" name="patient_job" placeholder="Masukkan Nama Pekerjaan" value="<?php echo $keys[0]['patient_job']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_job'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="patient_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="patient_address" placeholder="Masukkan Alamat Lengkap"><?php echo $keys[0]['patient_address']; ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('patient_address'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="patient_phone">Nomor Handphone</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="patient_phone" class="form-control" name="patient_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo $keys[0]['patient_phone']; ?>">
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
