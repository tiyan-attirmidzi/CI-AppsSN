    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/user"><i class="material-icons">person</i> User</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit User</li>
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
            
                $datetime = new DateTime($keys[0]['user_registerdate']);
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
                                EDIT DATA USER
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/user/update'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <?php if($keys[0]['user_image']) { ?>
                                                <img style="width : 50%" class="center" src="<?php echo base_url('img/user/').$keys[0]['user_image']; ?>"> 
                                            <?php } else { ?>
                                                <?php if($keys[0]['user_sex'] == 'Laki-laki') { ?> 
                                                    <img style="width : 50%" class="center" src="<?php echo base_url('img/').'man.png'; ?>"> 
                                                <?php } else { ?>
                                                    <img style="width : 50%" class="center" src="<?php echo base_url('img/').'girl.png'; ?>"> 
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_email">Email</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="email" id="user_email" class="form-control" name="user_email" placeholder="Masukkan Alamat Email" value="<?php echo $keys[0]['user_email']; ?>">
                                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $keys[0]['user_id']; ?>">
                                                    <input type="hidden" class="form-control" name="user_password_old" value="<?php echo $keys[0]['user_password']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="district_id">Wilayah</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="district_id" name="district_id">
                                                <option value="">--- Pilih Wilayah ---</option>
                                                <?php foreach ($district as $key) { ?>
                                                    <option value="<?php echo $key->district_id;?>" <?php if($keys[0]['district_id'] == $key->district_id) echo 'selected'; ?>><?php echo $key->district_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('district_id'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="user_address" placeholder="Masukkan Alamat Lengkap"><?php echo $keys[0]['user_address']; ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_address'); ?></span>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="user_name">Nama Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Masukkan Nama Lengkap" value="<?php echo $keys[0]['user_name']; ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 

                                                    if ($keys[0]['user_sex'] == "Laki-laki") 
                                                    {
                                                        echo "
                                                            <input name='user_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='user_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' />
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='user_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green'/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='user_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_sex'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_datebirth">Tanggal Lahir</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="user_datebirth" class="datepicker form-control" name="user_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo $keys[0]['user_datebirth']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_datebirth'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_phone">Nomor Handphone</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_phone" class="form-control" name="user_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo $keys[0]['user_phone']; ?>">
                                                    </div>
                                                    <div class="help-info">Ex: 082324252627</div>
                                                    <span class='text-danger'><?php echo form_error('user_phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_image">Ganti Foto</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="user_image" class="form-control" name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_status">Status Akun</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 
                                                    if ($keys[0]['user_status'] == "1") 
                                                    {
                                                        echo "
                                                            <input name='user_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='user_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' />
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='user_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green'/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='user_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_status'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan Perubahan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/user'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

            <!-- Change Password -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Ganti Password
                                <!-- <small>Masukkan Data Yang Valid</small> -->
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/user/change_password'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="user_passwordnew">Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="user_passwordnew" class="form-control" name="user_passwordnew" placeholder="Masukkan Password Baru" value="<?php echo set_value('user_passwordnew'); ?>">
                                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $keys[0]['user_id']; ?>">
                                                    <input type="hidden" class="form-control" name="user_name" value="<?php echo $keys[0]['user_name']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_passwordnew'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user_passwordnew_conf">Konfirmasi Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="user_passwordnew_conf" class="form-control" name="user_passwordnew_conf" placeholder="Masukkan Konfirmasi Password Baru" value="<?php echo set_value('user_passwordnew_conf'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('user_passwordnew_conf'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Ganti Password</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/user'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Change Password -->
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
