    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li class="active"><i class="material-icons">person</i> Profil</li>
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

            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT PROFIL
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/profile/edit_account'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="name_admin">Nama</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="name_admin" class="form-control" placeholder="Nama" value="<?php echo $admin[0]->name_admin; ?>" name="name_admin">
                                                    <input name="id_admin" type="hidden" class="form-control" placeholder="id" value="<?php echo $admin[0]->id_admin; ?>" required>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('name_admin'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="username_admin">Username</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="username_admin" class="form-control" placeholder="Nama" value="<?php echo $admin[0]->username_admin; ?>" name="username_admin">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('username_admin'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email_admin">Email</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="email_admin" class="form-control" placeholder="Nama" value="<?php echo $admin[0]->email_admin; ?>" name="email_admin">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('email_admin'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="phone_admin">Nomor Handphone</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="phone_admin" class="form-control" placeholder="Nama" value="<?php echo $admin[0]->phone_admin; ?>" name="phone_admin">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('phone_admin'); ?></span>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <img src="<?php echo base_url();?>img/admin/<?php echo $admin[0]->image; ?>" class="img-resposive center" width="50%">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="admin_image">Ganti Foto</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="admin_image" class="form-control" name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan Perubahan</button>
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
                        <?php echo form_open_multipart('admin/profile/change_password'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="admin_passwordnew">Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="admin_passwordnew" class="form-control" name="admin_passwordnew" placeholder="Masukkan Password Baru" value="<?php echo set_value('admin_passwordnew'); ?>">
                                                    <input type="hidden" class="form-control" name="id_admin" value="<?php echo $admin[0]->id_admin; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('admin_passwordnew'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="admin_passwordnew_conf">Konfirmasi Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="admin_passwordnew_conf" class="form-control" name="admin_passwordnew_conf" placeholder="Masukkan Konfirmasi Password Baru" value="<?php echo set_value('admin_passwordnew_conf'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('admin_passwordnew_conf'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Ganti Password</button>
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

