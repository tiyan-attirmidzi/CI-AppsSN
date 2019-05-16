<?php

function Uploadfoto($fupload_name,$type){
  //direktori gambar
  $vdir_upload = "upload/payment/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  if($type=='jpeg' or $type=='jpg'){
    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi medium 360 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width2 = 390;
    $dst_height2 = ($dst_width2/$src_width)*$src_height;

    //proses perubahan ukuran
    $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    //Simpan gambar
    imagejpeg($im2,$vdir_upload . "thumb_" . $fupload_name);

  }else{
    $im_src = imagecreatefrompng($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);

    //Simpan dalam versi medium 360 pixel
    //Set ukuran gambar hasil perubahan
    $dst_width2 = 390;
    $dst_height2 = ($dst_width2/$src_width)*$src_height;

    //proses perubahan ukuran
    $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
    imagealphablending($im2, FALSE);
    imagesavealpha($im2, TRUE);
    imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

    /*$background = imagecolorallocate($im2 , 0, 0, 0);
    imagecolortransparent($im2, $background);
    imagealphablending($im2, false);
    imagesavealpha($im2, true);*/


    //Simpan gambar
    imagepng($im2,$vdir_upload . "thumb_" . $fupload_name);
  }
  
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im2);
  unlink($vfile_upload);
}

?>
