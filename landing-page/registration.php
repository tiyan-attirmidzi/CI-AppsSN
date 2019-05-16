<?php
	date_default_timezone_set('Asia/Makassar');

	$hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "db_lulomart";
  
  # Koneksi dan memilih database di server
  mysql_connect($hostname,$username,$password) or die("Koneksi Gagal");
  mysql_select_db($database) or die("Database Tidak Ditemukan");

  $cek  	= mysql_query("SELECT * FROM table_member WHERE username_member='$_POST[username_member]'");
	$ketemu = mysql_num_rows($cek);

	if($ketemu==0){
		$member_code				= 'mmbr'	.date('YmdHis').rand(100000,999999);
		$register_id				= 'reg'		.date('YmdHis').rand(100000,999999);
		$register_trx_code	= date('YmdHis').rand(1,9999);
		$register_code			= date('YmdHis').rand(1,999);
		$register_paid 			= '100'.rand(100,999);
		$password 					= md5($_POST['password_member']);

		mysql_query("insert into table_member set  
										member_id 			= '$member_code', 
										member_name 		= '$_POST[member_name]',
										member_address 	= '$_POST[member_address]',
										member_phone 		=	'$_POST[member_phone]',
										member_active 	= 'N',
										username_member = '$_POST[username_member]',
										password_member = '$password'
                ");

		mysql_query("insert into table_register set  
										register_id 							= '$register_id',
										register_transaction_code = '$register_trx_code',
										register_code 						= '$register_code',
										register_paid_amount			= '$register_paid',
										register_paid_status			= 'N',
										member_id									= '$member_code'
                ");
		  
		
?>

<!-- Start Page -->
<html>
  <head>
    <meta charset="utf-8" />
    <title>Transaction Code : <?php echo $register_trx_code."-".$_POST['member_name']?></title>
    <link rel="stylesheet" type="text/css" href="css/regis-style.css">
  </head>
  <body>
    <br>
    <br>
    <br>
    <div id="wrapper">
      <table border="0" style="border-collapse: collapse; width: 100%; height: auto;">
        <tr>
          <td width="100%" align="center">
            <center>
              <img src="images/logoblack.png" style="width: 60px;" />
            </center>
          </td>
        </tr>
        <tr>
          <td width="100%" align="center">
            <h2 style="padding-top: 0px; font-size: 24px;"><strong><?php echo $_POST['member_name']?></strong></h2>
          </td>
        </tr>
      </table>
      <div style="clear:both;"></div>
      <table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000; border-collapse: collapse;">
        <tbody>
          <tr>
            <td colspan="2" style="text-align:left; border-top:1px solid #000; padding-top:5px;">
              Your Trx. Code:
              <br><b><?php echo $register_trx_code;?></b><br><br>
            </td>
            <td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;"></td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:left; padding-top: 5px; border-top: 1px solid #000;">
              Must Paid: 
              <br><b><?php echo "Rp. ". number_format($register_paid, 0, '.', '.')?></b><br><br>
            </td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:left; padding-top: 5px; border-top: 1px solid #000;">
              Transfer To: 
              <br>Bank BNI:
              <br><b>7887389023</b><br><br>
            </td>
          </tr>
        </tbody>
      </table>
      <div style="border-top:1px solid #000; padding-top:10px;">
        Thank You For Registration!    
      </div>
      <div style="padding-top:10px; color: red; text-align: left">
        Syarat & Ketentuan : <br>
        <ul>
          <li><i>Transfer Ke Rek. BNI LuloMart sesuai jumlah yang tertera</i></li>
          <li><i>Masukkan Transaction(Trx) Code sebagai info tambahan saat proses transfer (untuk mempercepat proses verifikasi)</i></li>
          <li><i>Upload bukti transaksi di Menu Upload</i></li>
          <li><i>Tunggu Balasan Email/SMS LuloMart untuk Registration Code</i></li>
          <li><i>Berikan Registration Code anda kepada referal</i></li>
        </ul>   
      </div>

      <div id="bkpos_wrp">
        <a href="./" style="width:100%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#005b8a; border:0px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;">Back To Website</a>
      </div>
      <div id="bkpos_wrp">
        <button type="button" onClick="window.print();return false;" style="width:101%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 0px; font-weight:bold;">Print</button>
      </div>
      
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
      $(window).load(function() { window.print(); });
    </script>
  </body>
</html>
<!-- End Page -->







<?php
		//echo '<meta http-equiv="refresh" content="2; url=http://localhost/lp_lulo/">';
	}else{
		echo "Registrasi Gagal. Username sudah digunakan. Akan Redirect Ke Halaman Utama dalam 5 Detik";
		echo '<meta http-equiv="refresh" content="5; url=http://localhost/lp_lulo/">';
	}

  
	
?>