    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-bg-green">
                <li><a href="<?php echo base_url(); ?>admin"><i class="material-icons">home</i> Beranda</a></li>
                <li><a href="<?php echo base_url(); ?>admin/paramedic"><i class="material-icons">group</i> Tenaga Kesehatan</a></li>
                <li class="active"><i class="material-icons">mode_edit</i> Edit Tenaga Kesehatan</li>
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
            
                $datetime = new DateTime($keys[0]['paramedic_registerdate']);
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
                                EDIT DATA TENAGA KESEHATAN
                                <small>Masukkan Data Yang Valid</small>
                            </h2>
                        </div>
                        <?php echo form_open_multipart('admin/paramedic/update'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <?php if($keys[0]['paramedic_image']) { ?>
                                                <img style="width : 50%" class="center" src="<?php echo base_url('img/paramedic/').$keys[0]['paramedic_image']; ?>"> 
                                            <?php } else { ?>
                                                <?php if($keys[0]['paramedic_sex'] == 'Laki-laki') { ?> 
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
                                                    <input type="email" id="paramedic_noregis" class="form-control" name="paramedic_noregis" placeholder="Masukkan Nomor KTP" value="<?php echo $keys[0]['paramedic_noregis']; ?>" readonly>
                                                    <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $keys[0]['paramedic_id']; ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_password_old" value="<?php echo $keys[0]['paramedic_password']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_noregis'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_email">Email</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="email" id="paramedic_email" class="form-control" name="paramedic_email" placeholder="Masukkan Alamat Email" value="<?php echo $keys[0]['paramedic_email']; ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $keys[0]['paramedic_id']; ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_password_old" value="<?php echo $keys[0]['paramedic_password']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_email'); ?></span>
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
                                            <label for="paramedic_address">Alamat Lengkap</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="paramedic_address" placeholder="Masukkan Alamat Lengkap"><?php echo $keys[0]['paramedic_address']; ?></textarea>
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
                                                    <input type="text" id="paramedic_name" class="form-control" name="paramedic_name" placeholder="Masukkan Nama Lengkap" value="<?php echo $keys[0]['paramedic_name']; ?>" autofocus>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_ktp">Nomor KTP (Kartu Tanda Penduduk)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="paramedic_ktp" class="form-control" name="paramedic_ktp" placeholder="Masukkan Nomor KTP" value="<?php echo $keys[0]['paramedic_noktp']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('paramedic_ktp'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_sex">Jenis Kelamin</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 

                                                    if ($keys[0]['paramedic_sex'] == "Laki-laki") 
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
                                                    <input type="text" id="paramedic_datebirth" class="datepicker form-control" name="paramedic_datebirth" placeholder="Masukkan Tanggal Lahir" value="<?php echo $keys[0]['paramedic_datebirth']; ?>">
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
                                                        <input type="text" id="paramedic_phone" class="form-control" name="paramedic_phone" placeholder="Masukkan Nomor Handphone" value="<?php echo $keys[0]['paramedic_phone']; ?>">
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
                                                <option value="">Agama Tenaga Kesehatan</option>
                                                <?php foreach ($religion as $key) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if($keys[0]['paramedic_religion'] == $key) echo 'selected'; ?>><?php echo $key; ?></option>
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
                                                    <option value="<?php echo $key; ?>" <?php if($keys[0]['paramedic_lasteducation'] == $key) echo 'selected'; ?>><?php echo $key; ?></option>
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
                                                    <option value="<?php echo $key->paramediccategory_id; ?>" <?php if($keys[0]['paramediccategory_id'] == $key->paramediccategory_id) echo 'selected'; ?>><?php echo $key->paramediccategory_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramediccategory_id'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_status">Status Akun</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <?php 
                                                    if ($keys[0]['paramedic_status'] == "1") 
                                                    {
                                                        echo "
                                                            <input name='paramedic_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='paramedic_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' />
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                    else
                                                    {
                                                        echo "
                                                            <input name='paramedic_status' type='radio' id='radio_1' value='1' class='with-gap radio-col-green'/>
                                                            <label for='radio_1'>Aktif</label>
                                                            <input name='paramedic_status' type='radio' id='radio_2' value='0' class='with-gap radio-col-green' checked/>
                                                            <label for='radio_2'>Non Aktif</label>
                                                        ";
                                                    }
                                                ?>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('paramedic_status'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Simpan Perubahan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/paramedic'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

            <!-- Document -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Berkas (File) Tenaga Kesehatan
                                <!-- <small>Masukkan Data Yang Valid</small> -->
                            </h2>
                        </div>
                        <?php echo form_open_multipart(''); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Foto Copy Ijazah Terakhir
                                                <?php if($keys[0]['paramedic_it']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_it']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_it'] == "" || !isset($keys[0]['paramedic_it'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Foto Copy KTP
                                                <?php if($keys[0]['paramedic_fcktp']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_fcktp']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_fcktp'] == "" || !isset($keys[0]['paramedic_fcktp'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Foto Copy STR
                                                <?php if($keys[0]['paramedic_str']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_str']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_str'] == "" || !isset($keys[0]['paramedic_str'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Foto Copy SKBS
                                                <?php if($keys[0]['paramedic_skbs']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_skbs']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_skbs'] == "" || !isset($keys[0]['paramedic_skbs'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Foto Copy KTA Profesi
                                                <?php if($keys[0]['paramedic_kta']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_kta']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_kta'] == "" || !isset($keys[0]['paramedic_kta'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Rekomendasi Profesi
                                                <?php if($keys[0]['paramedic_rp']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_rp']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_rp'] == "" || !isset($keys[0]['paramedic_rp'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Basic Trauma Cardiac Life Support (BTCLS)
                                                <?php if($keys[0]['paramedic_btcls']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_btcls']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_btcls'] == "" || !isset($keys[0]['paramedic_btcls'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Wound Care
                                                <?php if($keys[0]['paramedic_wc']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_wc']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_wc'] == "" || !isset($keys[0]['paramedic_wc'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Hipnoterapi Nurse
                                                <?php if($keys[0]['paramedic_hn']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_hn']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_hn'] == "" || !isset($keys[0]['paramedic_hn'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Sunat Modern
                                                <?php if($keys[0]['paramedic_sm']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_sm']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_sm'] == "" || !isset($keys[0]['paramedic_sm'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Disaster / Komunitas
                                                <?php if($keys[0]['paramedic_dk']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_dk']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_dk'] == "" || !isset($keys[0]['paramedic_dk'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Nenonatal Care
                                                <?php if($keys[0]['paramedic_nc']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_nc']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_nc'] == "" || !isset($keys[0]['paramedic_nc'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Geriatrik
                                                <?php if($keys[0]['paramedic_g']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_g']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_g'] == "" || !isset($keys[0]['paramedic_g'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Pertolongan Pertama Gawat Darurat (PPGD)
                                                <?php if($keys[0]['paramedic_ppgd']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_ppgd']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_ppgd'] == "" || !isset($keys[0]['paramedic_ppgd'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Intensive Care Unit (ICU)
                                                <?php if($keys[0]['paramedic_icu']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_icu']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_icu'] == "" || !isset($keys[0]['paramedic_icu'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            <li class="list-group-item clearfix">
                                                Neonatal Intensive Care Unit (NICU)
                                                <?php if($keys[0]['paramedic_nicu']) { ?>
                                                    <a href="<?php echo base_url() ?>img/paramedic/<?php echo $keys[0]['paramedic_nicu']; ?>" class="btn btn-default waves-effect pull-right">Lihat</a>
                                                <?php } ?>
                                                <?php if($keys[0]['paramedic_nicu'] == "" || !isset($keys[0]['paramedic_nicu'])) { ?>
                                                    <p class="form-control">File Tidak Ada<p>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Document -->

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
                        <?php echo form_open_multipart('admin/paramedic/change_password'); ?>
                            <div class="row clearfix">
                                <div class="body">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label for="paramedic_passwordnew">Password Baru</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="password" id="paramedic_passwordnew" class="form-control" name="paramedic_passwordnew" placeholder="Masukkan Password Baru" value="<?php echo set_value('paramedic_passwordnew'); ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_id" value="<?php echo $keys[0]['paramedic_id']; ?>">
                                                    <input type="hidden" class="form-control" name="paramedic_name" value="<?php echo $keys[0]['paramedic_name']; ?>">
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
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/paramedic'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- #END# Document Nakes -->
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
