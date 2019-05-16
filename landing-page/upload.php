<?php
	date_default_timezone_set('Asia/Makassar');
  include "function_images.php";
  //error_reporting(0);
	$hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "db_lulomart";
  
  # Koneksi dan memilih database di server
  mysql_connect($hostname,$username,$password) or die("Koneksi Gagal");
  mysql_select_db($database) or die("Database Tidak Ditemukan");

  $cek  	= mysql_query("SELECT * FROM table_register WHERE register_transaction_code='$_POST[register_transaction_code]' 
                          AND register_paid_amount='$_POST[register_paid_amount]' AND register_paid_status='N'");
	$ketemu = mysql_num_rows($cek);

	if($ketemu!=0){
		$x=mysql_fetch_array($cek);
    $type=explode('image/', $_FILES['fupload']['type']);
    if($type[1] != 'png' AND $type[1] != 'jpg' AND $type[1] != 'jpeg'){
      echo "Verifikasi Gagal. File yang anda upload bukan  <b>gambar (.jpg, .jpeg, .png)</b>. Akan Redirect Ke Halaman Utama dalam 5 Detik";
      echo '<meta http-equiv="refresh" content="5; url=http://localhost/lp_lulo/">';
    }else{
      Uploadfoto($x['member_id'].'.'.$type[1], $type[1]);
      $foto='thumb_'.$x['member_id'].'.'.$type[1];
      mysql_query("update table_register set
                      register_paid_status      = 'Y',
                      register_upload_payment   = '$foto'
                    where register_id           = '$x[register_id]'
                  ");
                  
      echo "Verifikasi Berhasil. Tunggu Informasi Registration Code Melalui Email/SMS. Akan Redirect Ke Halaman Utama dalam 5 Detik";
      echo '<meta http-equiv="refresh" content="5; url=http://localhost/lp_lulo/">';
    }
    
	}else{
		echo "Verifikasi Gagal. Trx. Code dan Jumlah Pembayaran Tidak Cocok Atau <b>Pembayaran sudah di verifikasi sebelumnya</b>. Akan Redirect Ke Halaman Utama dalam 5 Detik";
		echo '<meta http-equiv="refresh" content="5; url=http://localhost/lp_lulo/">';
	}

  
	
?>