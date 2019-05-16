    <section class="content">

        <div class="container-fluid">

            <!-- Service -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="row clearfix">
                            <div class="body">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <img src="<?php echo base_url()?>/img/service/<?php echo $service[0]['service_image']; ?>" height="150" alt="img01" class="center">
                                    </div>
                                    <div class="col-md-6">
                                        <h3><?php echo $service[0]['service_name']; ?></h3>
                                        <p><?php echo $service[0]['service_desc']; ?></p>
                                        <?php echo $service[0]['service_pricerange']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Service -->

            <!-- contract -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>PESAN / KONTRAK</h2>
                        </div>
                        <div class="row clearfix">
                            <div class="body">   

                                <!-- Medical Checkup -->
                                <?php if ($service[0]['service_id'] == 5) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Medical Checkup -->

                                <!-- Healthy Food Cathering -->
                                <?php if ($service[0]['service_id'] == 9) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                        <h2 class="card-inside-title align-center">Paket Yang Tersedia</h2>
                                        <div class="col-md-12">
                                            <?php foreach ($healthyfood as $key) { ?>
                                                <div class="col-md-4">
                                                    <div class="thumbnail"><br>
                                                        <img src="<?php echo base_url()?>/img/package/<?php echo $key->package_image?>" height="150" alt="img01">
                                                        <div class="caption">
                                                            <h3><?php echo $key->package_name; ?></h3><hr>
                                                            <p>
                                                                <input name="package_price" type="hidden" value="<?php echo $key->package_price; ?>"/>
                                                                <input name="package_id" type="radio" id="radio_<?php echo $key->package_id; ?>" value="<?php echo $key->package_id; ?>" class="with-gap radio-col-green"/>
                                                                <label for="radio_<?php echo $key->package_id; ?>"> Pilih</label>
                                                                <div class="align-right">
                                                                    Rp.<?php echo number_format($key->package_price); ?>
                                                                </div>
                                                            </p>
                                                        </div>  
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <h2 class="card-inside-title align-center">Data Diri Pasien</h2>
                                        <div class="col-md-12">
                                            <label for="patient_noktp">Nomor Induk Kependudukan (KTP)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_noktp" class="form-control" name="patient_noktp" placeholder="Masukkan Nomor KTP" value="<?php echo set_value('patient_noktp'); ?>">
                                                    <input type="hidden" id="service_id" class="form-control" name="service_id" value="<?php echo $service[0]['service_id']; ?>">
                                                    <input type="hidden" id="user_id" class="form-control" name="user_id" value="<?php echo $user[0]->user_id; ?>">
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
                                                    <input type="text" id="patient_job" class="form-control" name="patient_job" placeholder="Masukkan Pekerjaan" value="<?php echo set_value('patient_job'); ?>" >
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
                                        <h2 class="card-inside-title align-center">Perjanjian</h2>
                                        <div class="col-md-12">
                                            <label for="transaction_arrangementdate">Tanggal Mulai Pengantaran</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="transaction_arrangementdate" class="datetimepicker form-control" name="transaction_arrangementdate" placeholder="Masukkan Tanggal Mulai Perawatan" value="<?php echo set_value('transaction_arrangementdate'); ?>">
                                                    <input type="hidden" name="paramediccategory_id" value="<?php echo $service[0]['paramediccategory_id']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transaction_arrangementdate'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="transaction_note">Pesan Untuk Catering</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="transaction_note" placeholder="Masukkan Pesan"><?php echo set_value('transaction_note'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transaction_note'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="transactiondetail_locationvisit">Alamat Pengantaran</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="transactiondetail_locationvisit" placeholder="Masukkan Alamat Lengkap Tempat Pemerikassan"><?php echo set_value('transactiondetail_locationvisit'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transactiondetail_locationvisit'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green btn-lg waves-effect">Pesan</button>
                                            <button type="reset" onclick="window.location.href='<?php echo base_url();?>patient/order'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Healthy Food Cathering -->

                                <!-- Sunat Modern -->
                                <?php if ($service[0]['service_id'] == 18) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Sunat Modern -->

                                <!-- Perawatan Luka -->
                                <?php if ($service[0]['service_id'] == 19) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                        <h2 class="card-inside-title align-center">Data Diri Pasien</h2>
                                        <div class="col-md-12">
                                            <label for="patient_noktp">Nomor Induk Kependudukan (KTP)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="patient_noktp" class="form-control" name="patient_noktp" placeholder="Masukkan Nomor KTP" value="<?php echo set_value('patient_noktp'); ?>" autofocus>
                                                    <input type="hidden" id="service_id" class="form-control" name="service_id" value="<?php echo $service[0]['service_id']; ?>">
                                                    <input type="hidden" id="user_id" class="form-control" name="user_id" value="<?php echo $user[0]->user_id; ?>">
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
                                                    <input type="text" id="patient_job" class="form-control" name="patient_job" placeholder="Masukkan Pekerjaan" value="<?php echo set_value('patient_job'); ?>" >
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
                                        <h2 class="card-inside-title align-center">Perjanjian</h2>
                                        <div class="col-md-12">
                                            <label for="transaction_arrangementdate">Tanggal Mulai Perawatan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="transaction_arrangementdate" class="datetimepicker form-control" name="transaction_arrangementdate" placeholder="Masukkan Tanggal Mulai Perawatan" value="<?php echo set_value('transaction_arrangementdate'); ?>">
                                                    <input type="hidden" name="paramediccategory_id" value="<?php echo $service[0]['paramediccategory_id']; ?>">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transaction_arrangementdate'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="transaction_note">Pesan Untuk Tenaga Kesehatan</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="transaction_note" placeholder="Masukkan Pesan"><?php echo set_value('transaction_note'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transaction_note'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="paramedic_chose">Tenaga Kesehatan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <input name="paramedic_chose" type="radio" id="radio_1" class="with-gap radio-col-green"/>
                                                <label for="radio_1">Di Tentukan Pasien</label>
                                                <input name="paramedic_chose" type="radio" id="radio_2" class="with-gap radio-col-green" checked/>
                                                <label for="radio_2">Di Tentukan Pihak SN Health Center</label>
                                            </div>
                                            <select class="form-control show-tick selectt" id="paramedic_id" name="paramedic_id">
                                                <option value="">Pilih Tenaga Kesehatan</option>
                                                <?php foreach ($paramedic as $key) { ?>
                                                    <option value="<?php echo $key->paramedic_id; ?>"><?php echo $key->paramedic_name; ?></option>
                                                <?php }; ?>
                                            </select>
                                            <span class='text-danger'><?php echo form_error('paramedic_chose'); ?></span>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                // By Default Disable radio button
                                                $(".selectt").attr('disabled', true);
                                                // Disable radio buttons function on Check Disable radio button.
                                                $("form input:radio").change(function() {
                                                    if ($(this).attr('checked')) {
                                                        $(".selectt").attr('checked', false);
                                                        $(".selectt").attr('disabled', true);
                                                    }
                                                    // Else Enable radio buttons.
                                                    else {
                                                        $(".selectt").attr('disabled', false);
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="col-md-12">
                                            <label for="transactiondetail_locationvisit">Alamat Pemerikasaan</label>
                                            <span class='text'> *</span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" class="form-control no-resize" name="transactiondetail_locationvisit" placeholder="Masukkan Alamat Lengkap Tempat Pemerikassan"><?php echo set_value('transactiondetail_locationvisit'); ?></textarea>
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transactiondetail_locationvisit'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green btn-lg waves-effect">Pesan</button>
                                            <button type="reset" onclick="window.location.href='<?php echo base_url();?>patient/order'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Perawatan Luka -->   

                                <!-- Perawatan Lansia -->
                                <?php if ($service[0]['service_id'] == 20) { ?>
                                    <div class="col-md-12">
                                        <label for="user_name">Nomor Induk Kependudukan (KTP)</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="user_name" class="form-control select2" name="user_name" placeholder="Masukkan Nomor KTP" value="<?php echo set_value('user_name'); ?>" autofocus>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_name'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="user_name">Nama Lengkap</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Masukkan Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_name'); ?></span>
                                        </div>
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
                                        <label for="paramedic_religion">Agama</label>
                                        <span class='text-danger'> *</span>
                                        <select class="form-control show-tick" id="paramedic_religion" name="paramedic_religion">
                                            <option value="">Agama Pasien</option>
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
                                            <option value="">Pendidikan Terakhir Pasien</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                        <span class='text-danger'><?php echo form_error('paramedic_lasteducation'); ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="user_name">Pekerjaan</label>
                                        <span class='text-danger'> *</span>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="user_name" class="form-control" name="user_name" placeholder="Masukkan Pekerjaan" value="<?php echo set_value('user_name'); ?>" >
                                            </div>
                                            <span class='text-danger'><?php echo form_error('user_name'); ?></span>
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
                                        <label for="district_id">Wilayah</label>
                                        <span class='text-danger'> *</span>
                                        <select class="form-control show-tick" id="district_id" name="district_id">
                                            <option value="">Wilayah Pasien</option>
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
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-green btn-lg waves-effect">Pesan</button>
                                        <button type="reset" onclick="window.location.href='<?php echo base_url();?>admin/order'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                    </div>
                                <?php } ?>
                                <!-- END Perawatan Lansia -->

                                <!-- Dokter Umum -->
                                <?php if ($service[0]['service_id'] == 21) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Dokter Umum -->

                                <!-- Hypno Birthing -->
                                <?php if ($service[0]['service_id'] == 22) { ?>
                                    <?php echo form_open_multipart('patient/order/approval'); ?>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Hypno Birthing -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# contract -->

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