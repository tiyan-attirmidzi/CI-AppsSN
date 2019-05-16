    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/user"><i class="material-icons">person</i> User</a></li>
                <li class="active"><i class="material-icons">person_add</i> Tambah User</li>
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
                                TAMBAH USER
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/user/insert'); ?>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Data Diri User</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <label for="user_name">Nama Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Masukkan Nama Lengkap" value="<?php echo set_value('user_name'); ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="user_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <input name="user_sex" type="radio" id="radio_39" value="Laki-laki" class="with-gap radio-col-green"/>
                                                <label for="radio_39">Laki-laki</label>
                                                <input name="user_sex" type="radio" id="radio_40" value="Perempuan" class="with-gap radio-col-green" />
                                                <label for="radio_40">Perempuan</label>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_sex'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="user_datebirth">Tanggal Lahir</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="user_datebirth" class="datepicker form-control" name="user_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo set_value('user_datebirth'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_datebirth'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="user_phone">Nomor Handphone</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_phone" class="form-control" name="user_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                                                    </div>
                                                    <div class="help-info">Ex: 082324252627</div>
                                                    <span class='text-danger'><?php echo form_error('user_phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="district_id">Wilayah</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="district_id" name="district_id">
                                                <option value="">--- Pilih Wilayah ---</option>
                                                <?php foreach ($district as $key) { ?>
                                                    <option value="<?php echo $key->district_id; ?>"><?php echo $key->district_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('district_id'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="user_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="user_address" placeholder="Masukkan Alamat Lengkap"><?php echo set_value('user_address'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_address'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <h2 class="card-inside-title">Akun User</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="user_email">Email</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="user_email" class="form-control" name="user_email" placeholder="Masukkan Alamat Email" value="<?php echo set_value('user_email'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_email'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="user_password">Password</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="user_password" class="form-control" name="user_password" placeholder="Masukkan Password" value="<?php echo set_value('user_password'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="user_passwordconf">Konfirmasi Password</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="user_passwordconf" class="form-control" name="user_passwordconf" placeholder="Masukkan Ulang Password" value="<?php echo set_value('user_passwordconf'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_passwordconf'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="user_status">Status</label>
                                        <span class='text-danger'> *</span>
                                        <div class="demo-radio-button">
                                            <input name="user_status" type="radio" id="radio_1" value="1" class="with-gap radio-col-green"/>
                                            <label for="radio_1">Akrif</label>
                                            <input name="user_status" type="radio" id="radio_2" value="0" class="with-gap radio-col-green" />
                                            <label for="radio_2">Non Aktif</label>
                                        </div>
                                        <span class='text-danger'><?php echo form_error('user_status'); ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="user_image">Foto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="user_image" class="form-control" name="userfile">
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-green btn-lg waves-effect">Tambah</button>
                                    <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/user'" class="btn btn-default btn-lg waves-effect">Kembali</button>
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
