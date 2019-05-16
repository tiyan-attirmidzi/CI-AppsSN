    <section class="content">

        <div class="container-fluid">

            <!-- Service -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="row clearfix">
                            <div class="body">
                                <div class="col-md-4">
                                    <h3><strong>Pemesanan</strong></h3>
                                    <h5><?php echo $transaction[0]->transaction_code; ?></h4>
                                    Tanggal : <?php echo $transaction[0]->transaction_date; ?> <br>
                                    Layanan : <?php echo $transaction[0]->service_name; ?> <br>
                                </div>
                                <div class="col-md-4">
                                    <h3><strong>Pasien</strong></h3>
                                    <h5><?php echo $transaction[0]->patient_name; ?></h4>
                                    <p>
                                        Telpon : <?php echo $transaction[0]->patient_phone; ?> <br>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <h3><strong>Waktu & Tempat</strong></h3>
                                    <h5><?php echo $transaction[0]->transactiondetail_locationvisit; ?></h5>
                                    Tanggal Pemerisaan Awal : <?php echo $transaction[0]->transaction_arrangementdate; ?><br>
                                    Tanggal Perjanjian : <?php echo $transaction[0]->transactiondetail_visitdate; ?><br>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="body table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Perawatan</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 

                                                    $no = 1;

                                                    if (is_array($transactiondetail) || is_object($transactiondetail))
                                                    {
                                                        foreach ($transactiondetail as $key) 
                                                        { 
                                                            $id = $key->transaction_id; 
                                                
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $key->transactiondetail_visitdate; ?></td>
                                                        <td>
                                                            <button class="btn btn-white btn-info btn-bold btn-md" onclick="window.location.href='<?php echo base_url();?>paramedic/visitingstage/invoice_print?transaction=<?php echo base64_encode($key->transaction_id); ?>&service=<?php echo base64_encode($key->service_id); ?>&date=<?php echo base64_encode($key->transactiondetail_visitdate); ?>'">
                                                                <i class="material-icons">print</i> Cetak Invoice
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php $no++; }; }; ?>
                                            </tbody>
                                        </table>
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
                            <h2>PEMERIKSAAN (<?php echo $transaction[0]->transactiondetail_visitdate; ?>)</h2>
                        </div>
                        <div class="row clearfix">
                            <div class="body">

                                <!-- Perawatan Luka -->
                                <?php if ($transaction[0]->service_id == 19) { ?>
                                    <?php echo form_open_multipart('paramedic/visitingstage/insert'); ?>
                                        <div class="col-sm-12">
                                            <label for="package_id">Penentuan Paket (Tarif)</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-checkbox">
                                                <?php foreach ($package as $keys) { ?>
                                                    <input type="checkbox" id="md_checkbox_<?php echo $keys->package_id; ?>" name="package_id[]" class="chk-col-green" value="<?php echo $keys->package_id; ?>"/>
                                                    <label for="md_checkbox_<?php echo $keys->package_id; ?>"><?php echo $keys->package_name; ?> Harga Rp.<?php echo number_format($keys->package_price); ?></label><br>
                                                <?php } ?> 
                                                <input type="hidden" name="transaction_id" value="<?php echo $transaction[0]->transaction_id; ?>"/>
                                                <input type="hidden" name="transactiondetail_id" value="<?php echo $transaction[0]->transactiondetail_id; ?>"/>
                                                <input type="hidden" name="transactiondetail_id" value="<?php echo $transaction[0]->transactiondetail_id; ?>"/>
                                                <input type="hidden" name="transactiondetail_locationvisit" value="<?php echo $transaction[0]->transactiondetail_locationvisit; ?>"/>
                                                <input type="hidden" name="service_id" value="<?php echo $transaction[0]->service_id; ?>"/>
                                                <input type="hidden" name="paramediccategory_id" value="<?php echo $transaction[0]->paramediccategory_id; ?>"/>
                                                <input type="hidden" name="paramedic_id" value="<?php echo $paramedic[0]->paramedic_id; ?>"/>
                                                <input type="hidden" name="transactiondetail_visitdate" value="<?php echo $transaction[0]->transactiondetail_visitdate; ?>"/>
                                                <input type="hidden" name="transaction_total" value="<?php echo $transaction[0]->transaction_total; ?>"/>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('package_id'); ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="examination_status">Status Perawatan</label>
                                            <span class='text-danger'> *</span>
                                            <div class="demo-radio-button">
                                                <input name="examination_status" type="radio" id="radio_1" value="2" class="with-gap radio-col-green"/>
                                                <label for="radio_1">Selesai</label>
                                                <input name="examination_status" type="radio" id="radio_2" value="1" class="with-gap radio-col-green" checked/>
                                                <label for="radio_2">Perawatan Akan Dilanjutkan</label>
                                            </div>
                                            <span class='text-danger'><?php echo form_error('examination_status'); ?></span>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="transactiondetail_nextvisitdate" class="datetimepicker form-control" name="transactiondetail_nextvisitdate" placeholder="Masukkan Tanggal Perawatan Selanjutnya">
                                                </div>
                                                <span class='text-danger'><?php echo form_error('transactiondetail_nextvisitdate'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-green btn-lg waves-effect">Selesai</button>
                                            <button type="reset" onclick="window.location.href='<?php echo base_url();?>paramedic/visitingstage'" class="btn btn-default btn-lg waves-effect">Kembali</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                                <!-- END Perawatan Luka -->                              

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