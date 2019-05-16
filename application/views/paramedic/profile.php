    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>paramedic"><i class="material-icons">home</i> Beranda</a></li>
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
            <?php 
            
                $datetime = new DateTime($paramedic[0]->paramedic_registerdate);
                $datee = $datetime->format('l, d F Y H:i:s');
            
            ?>
            <ol class="breadcrumb breadcrumb-bg-orange align-right" style="color : white;">
                Melakukan Registrasi Pada <strong><i><?php echo $datee; ?></i></strong>
            </ol>

            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                EDIT PROFIL
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <?php echo form_open_multipart('paramedic/profile/update'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <?php if($paramedic[0]->paramedic_image) { ?>
                                                <img style="width : 50%" class="center" src="<?php echo base_url('img/paramedic/').$paramedic[0]->paramedic_image; ?>"> 
                                            <?php } else { ?>
                                                <?php if($paramedic[0]->paramedic_image == 'Laki-laki') { ?> 
                                                    <img style="width : 50%" class="center" src="<?php echo base_url('img/').'man.png'; ?>"> 
                                                <?php } else { ?>
                                                    <img style="width : 50%" class="center" src="<?php echo base_url('img/').'girl.png'; ?>"> 
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_noregis">Nomor Registrasi Tenaga Kesehatan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="email" id="paramedic_noregis" class="form-control" name="paramedic_noregis" placeholder="Nomor Registrasi" value="<?php echo $paramedic[0]->paramedic_noregis; ?>" readonly>
                                                    <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_password_old" value="<?php echo $paramedic[0]->paramedic_password; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_noregis'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="district_id">Wilayah</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="district_id" name="district_id">
                                                <option value="">--- Pilih Wilayah ---</option>
                                                <?php foreach ($district as $key) { ?>
                                                    <option value="<?php echo $key->district_id;?>" <?php if($paramedic[0]->district_id == $key->district_id) echo 'selected'; ?>><?php echo $key->district_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('district_id'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="paramedic_address" placeholder="Masukkan Alamat Lengkap"><?php echo $paramedic[0]->paramedic_address; ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_address'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_image">Ganti Foto</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_image" class="form-control" name="userfile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="paramedic_name">Nama Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_name" class="form-control" name="paramedic_name" placeholder="Masukkan Nama Lengkap" value="<?php echo $paramedic[0]->paramedic_name; ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_ktp">Nomor KTP (Kartu Tanda Penduduk)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_ktp" class="form-control" name="paramedic_ktp" placeholder="Masukkan Nomor KTP" value="<?php echo $paramedic[0]->paramedic_noktp; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_ktp'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 

                                                    if ($paramedic[0]->paramedic_sex == "Laki-laki") 
                                                    {
                                                        echo "
                                                            <input name='paramedic_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='paramedic_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' />
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='paramedic_sex' type='radio' id='radio_39' value='Laki-laki' class='with-gap radio-col-green'/>
                                                            <label for='radio_39'>Laki-laki</label>
                                                            <input name='paramedic_sex' type='radio' id='radio_40' value='Perempuan' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_40'>Perempuan</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_sex'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_datebirth">Tanggal Lahir</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_datebirth" class="datepicker form-control" name="paramedic_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo $paramedic[0]->paramedic_datebirth; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_datebirth'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="paramedic_phone">Nomor Handphone</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="paramedic_phone" class="form-control" name="paramedic_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo $paramedic[0]->paramedic_phone; ?>">
                                                    </div>
                                                    <div class="help-info">Ex: 082324252627</div>
                                                    <span class='text-danger'><?php echo form_error('paramedic_phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_religion">Agama</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramedic_religion" name="paramedic_religion">
                                                <option value="">Agama</option>
                                                <?php foreach ($religion as $key) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if($paramedic[0]->paramedic_religion == $key) echo 'selected'; ?>><?php echo $key; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramedic_religion'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_lasteducation">Pendidikan Terakhir</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramedic_lasteducation" name="paramedic_lasteducation">
                                                <option value="">Pendidikan Terakhir Paramedic</option>
                                                <?php foreach ($last_education as $key) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if($paramedic[0]->paramedic_lasteducation == $key) echo 'selected'; ?>><?php echo $key; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramedic_lasteducation'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramediccategory_id">Profesi</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramediccategory_id" name="paramediccategory_id">
                                                <option value="">Profesi</option>
                                                <?php foreach ($paramediccategory as $key) { ?>
                                                    <option value="<?php echo $key->paramediccategory_id; ?>" <?php if($paramedic[0]->paramediccategory_id == $key->paramediccategory_id) echo 'selected'; ?>><?php echo $key->paramediccategory_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramediccategory_id'); ?></span>
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

             <!-- Change Email -->
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Ganti Email
                                <!-- <small>Masukkan Data Yang Valid</small> -->
                            </h2>
                        </div>
                        <?php echo form_open_multipart('paramedic/profile/change_email'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <label for="paramedic_email">Email</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="paramedic_email" class="form-control" name="paramedic_email" placeholder="Masukkan Alamat Email" value="<?php echo $paramedic[0]->paramedic_email; ?>">
                                                <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_email'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Change Email -->

            <!-- Change Status -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Status Penerimaan Pesanan
                                <!-- <small>Masukkan Data Yang Valid</small> -->
                            </h2>
                        </div>
                        <?php echo form_open_multipart('paramedic/profile/change_status'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <div class="demo-radio-button">
                                            <?php 
                                                if ($paramedic[0]->paramedic_online == 1) 
                                                {
                                                    echo "
                                                        <input name='paramedic_online' type='radio' id='radio_11' value='1' class='with-gap radio-col-green' checked/>
                                                        <label for='radio_11'>Menerima Pesanan</label><br>
                                                        <input name='paramedic_online' type='radio' id='radio_12' value='0' class='with-gap radio-col-green' />
                                                        <label for='radio_12'>Tidak Menerima Pesanan</label>
                                                    ";
                                                }
                                                else
                                                {
                                                    echo "
                                                        <input name='paramedic_online' type='radio' id='radio_11' value='1' class='with-gap radio-col-green'/>
                                                        <label for='radio_11'>Menerima Pesanan</label><br>
                                                        <input name='paramedic_online' type='radio' id='radio_12' value='0' class='with-gap radio-col-green' checked/>
                                                        <label for='radio_12'>Tidak Menerima Pesanan</label>
                                                    ";
                                                }
                                            ?>
                                            <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>">
                                        </div>
                                        <span class='text-danger'><?php echo form_error('paramedic_online'); ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Change Status -->

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
                        <?php echo form_open_multipart('paramedic/profile/change_password'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="paramedic_passwordnew">Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="paramedic_passwordnew" class="form-control" name="paramedic_passwordnew" placeholder="Masukkan Password Baru" value="<?php echo set_value('paramedic_passwordnew'); ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_passwordnew'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_passwordnew_conf">Konfirmasi Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="paramedic_passwordnew_conf" class="form-control" name="paramedic_passwordnew_conf" placeholder="Masukkan Konfirmasi Password Baru" value="<?php echo set_value('paramedic_passwordnew_conf'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_passwordnew_conf'); ?></span>
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