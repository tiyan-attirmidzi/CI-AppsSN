    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/paramedic"><i class="material-icons">group</i> Tenaga Kesehatan</a></li>
                <li class="active"><i class="material-icons">group_add</i> Tambah Tenaga Kesehatan</li>
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
                                TAMBAH TENAGA KESEHATAN
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('admin/paramedic/insert'); ?>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Data Diri Tenaga Kesehatan</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <label for="paramedic_ktp">Nomor KTP (Kartu Tanda Penduduk)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_ktp" class="form-control" name="paramedic_ktp" placeholder="Masukkan Nomor KTP" value="<?php echo set_value('paramedic_ktp'); ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_ktp'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_name">Nama Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_name" class="form-control" name="paramedic_name" placeholder="Masukkan Nama Lengkap" value="<?php echo set_value('paramedic_name'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <input name="paramedic_sex" type="radio" id="radio_39" value="Laki-laki" class="with-gap radio-col-green"/>
                                                <label for="radio_39">Laki-laki</label>
                                                <input name="paramedic_sex" type="radio" id="radio_40" value="Perempuan" class="with-gap radio-col-green" />
                                                <label for="radio_40">Perempuan</label>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_sex'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_datebirth">Tanggal Lahir</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_datebirth" class="datepicker form-control" name="paramedic_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo set_value('paramedic_datebirth'); ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_datebirth'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="paramedic_phone">Nomor Handphone</label>
                                                <span class='text-danger'> *</span>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="paramedic_phone" class="form-control" name="paramedic_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo set_value('paramedic_phone'); ?>">
                                                    </div>
                                                    <div class="help-info">Ex: 082324252627</div>
                                                    <span class='text-danger'><?php echo form_error('paramedic_phone'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_religion">Agama</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramedic_religion" name="paramedic_religion">
                                                <option value="">Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramedic_religion'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_lasteducation">Pendidikan Terakhir</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramedic_lasteducation" name="paramedic_lasteducation">
                                                <option value="">Pendidikan Terakhir</option>
                                                <option value="SMA">SMA</option>
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramedic_lasteducation'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramediccategory_id">Profesi</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="paramediccategory_id" name="paramediccategory_id">
                                                <option value="">Profesi</option>
                                                <?php foreach ($paramediccategory as $key) { ?>
                                                    <option value="<?php echo $key->paramediccategory_id; ?>"><?php echo $key->paramediccategory_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramediccategory_id'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="district_id">Wilayah</label>
                                            <span class='text-danger'> *</span>
                                            <select class="form-control show-tick" id="district_id" name="district_id">
                                                <option value="">Wilayah</option>
                                                <?php foreach ($district as $key) { ?>
                                                    <option value="<?php echo $key->district_id; ?>"><?php echo $key->district_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('district_id'); ?></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="paramedic_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="paramedic_address" placeholder="Masukkan Alamat Lengkap"><?php echo set_value('paramedic_address'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_address'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <h2 class="card-inside-title">Akun Tenaga Kesehatan</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label for="paramedic_email">Email</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" id="paramedic_email" class="form-control" name="paramedic_email" placeholder="Masukkan Alamat Email" value="<?php echo set_value('paramedic_email'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_email'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="paramedic_password">Password</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="paramedic_password" class="form-control" name="paramedic_password" placeholder="Masukkan Password" value="<?php echo set_value('paramedic_password'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_password'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="paramedic_passwordconf">Konfirmasi Password</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="paramedic_passwordconf" class="form-control" name="paramedic_passwordconf" placeholder="Masukkan Ulang Password" value="<?php echo set_value('paramedic_passwordconf'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_passwordconf'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="paramedic_status">Status</label>
                                        <span class='text-danger'> *</span>
                                        <div class="demo-radio-button">
                                            <input name="paramedic_status" type="radio" id="radio_1" value="1" class="with-gap radio-col-green"/>
                                            <label for="radio_1">Aktif</label>
                                            <input name="paramedic_status" type="radio" id="radio_2" value="0" class="with-gap radio-col-green" />
                                            <label for="radio_2">Non Aktif</label>
                                        </div>
                                        <span class='text-danger'><?php echo form_error('paramedic_status'); ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="paramedic_image">Foto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" id="paramedic_image" class="form-control" name="userfile">
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div class="col-md-12">
                                    <h2 class="card-inside-title">Data Kompetensi / Pernah Mengikuti Pelatihan (Lampirkan jika ada)</h2>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="paramedic_btcls">Basic Trauma Cardiac Life Support (BTCLS)</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_btcls" class="form-control" name="paramedic_btcls">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_wc">Wound Care</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_wc" class="form-control" name="paramedic_wc">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_hn">Hipnoterapi Nurse</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_hn" class="form-control" name="paramedic_hn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_sm">Sunat Modern</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_sm" class="form-control" name="paramedic_sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_dk">Disaster / Komunitas</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_dk" class="form-control" name="paramedic_dk">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="paramedic_nc">Nenonatal Care</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_nc" class="form-control" name="paramedic_nc">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_g">Geriatrik</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_g" class="form-control" name="paramedic_g">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_ppgd">Pertolongan Pertama Gawat Darurat (PPGD)</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_ppgd" class="form-control" name="paramedic_ppgd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_icu">Intensive Care Unit (ICU)</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_icu" class="form-control" name="paramedic_icu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_nicu">Neonatal Intensive Care Unit (NICU)</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_nicu" class="form-control" name="paramedic_nicu">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h2 class="card-inside-title">Pemberkasan (Lampirkan Dokumen Berikut)</h2>                                    
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="paramedic_it">Foto Copy Ijazah Terakhir</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_it" class="form-control" name="paramedic_it">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_fcktp">Foto Copy KTP</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_fcktp" class="form-control" name="paramedic_fcktp">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_str">Foto Copy STR</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_str" class="form-control" name="paramedic_str">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="paramedic_skbs">Foto Copy SKBS</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_skbs" class="form-control" name="paramedic_skbs">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_kta">Foto Copy KTA Profesi</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_kta" class="form-control" name="paramedic_kta">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_rp">Rekomendasi Profesi</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" id="paramedic_rp" class="form-control" name="paramedic_rp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-green btn-lg waves-effect">Tambah</button>
                                    <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/paramedic'" class="btn btn-default btn-lg waves-effect">Kembali</button>
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
