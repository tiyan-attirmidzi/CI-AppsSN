<!DOCTYPE html>
<html lang="zxx" class="no-js">
  <head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url()?>img/snlogo.png" type="image/x-icon">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>SN HEALTH CENTER</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
      CSS
      ============================================= -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/linearicons.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/main.css">
  <!-- </HEAD> -->
  <!-- </head> -->
  </head>
  <body>
  <?php      
    $message = $this->session->flashdata('notif_regparamedic');
    if($message)
    {
        echo 
          '<script>alert('.$message.')</script>'
        ;
    }
  ?>
    <header id="header">
      <div class="header-top">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6 col-4 header-top-left">
              <a href=""><span class="lnr lnr-phone-handset"></span> <span class="text"><span class="text">+6282234229752</span></span></a>
              <a href="mailto:snalkobarhealthcenter@gmail.com"><span class="lnr lnr-envelope"></span> <span class="text"><span class="text">snalkobar.healthcenter@gmail.com</span></span></a>           
            </div>
          </div>
        </div>
      </div>
      <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
          <div id="logo">
            <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>/img/logo-up.png" alt="" title="" /></a>
          </div>
          <nav id="nav-menu-container">
            <ul class="nav-menu">
              <li><a href="">Beranda</a></li>
              <li><a href="#tentang">Tentang</a></li>
              <li class="menu-has-children"><a href="">Layanan</a>
                <ul>
                  <?php foreach ($service as $values) { ?>
                  <li><a href="<?php echo  site_url('home/service/'.$values->service_id); ?>"><?php echo $values->service_name?></a></li>
                  <?php } ?>
                </ul>
              </li> 
              <li class="menu-has-children"><a href="">Daftar</a>
                <ul>
                  <li><a href="<?php echo base_url();?>registration_patient">Daftar Pasien</a></li>
                  <li><a href="<?php echo base_url();?>registration_paramedic">Daftar Tenaga Kesehatan</a></li>
                </ul>
              </li> 
              <li><a href="#kontak">Kontak</a></li>
            </ul>
          </nav>
          <!-- #nav-menu-container -->                    
        </div>
      </div>
    </header>
    <!-- #header -->
    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-center">
          <div class="banner-content col-lg-8 col-md-12">
            <h1>
              Melayani Dengan Hati    
            </h1>
            <p class="pt-10 pb-10 text-white">
              Sehari sebelum perawatan, silahkan menghubungi kontak person kami untuk persetujuan kontrak perawatan
            </p>
            
          </div>
        </div>
      </div>
    </section><br><br><br><br><br>
    <!-- End banner Area -->
    <!-- Start appointment Area -->
    <section class="appointment-area">
      <div class="container">
        <div class="row justify-content-between align-items-center pb-1200 appointment-wrap">
          <div class="col-lg-5 col-md-6 appointment-left">
            <h1>
              Waktu Operasional
            </h1>
            <p>
              Kamu bisa melakukan request layanan kesehatan <b>SN AL Kobar Health Center</b> di waktu berikut.
            </p>
            <ul class="time-list">
              <li class="d-flex justify-content-between">
                <span>Senin-Sabtu</span>
                <span>08.00 - 21.00 WITA</span>
              </li>
              <li class="d-flex justify-content-between">
                <span>Minggu</span>
                <span><b>Libur</b></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- End appointment Area -->
    <!-- Start facilities Area -->
    <section class="facilities-area section-gap">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="menu-content pb-70 col-lg-7">
            <div class="title text-center">
              <h1 class="mb-10">Kenapa Harus Kami ?</h1>
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. </p> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="single-facilities">
              <span class="lnr lnr-thumbs-up"></span>
              <a href="<?php echo base_url()?>assets/front/#">
                <h4>Tenaga Medis Kompeten</h4>
              </a>
              <p>
                Kami menyediakan perawat khusus yang berkompetensi dibidangnya untuk memberikan layanan perawatan kesehatan.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="single-facilities">
              <span class="lnr lnr-heart-pulse"></span>
              <a href="<?php echo base_url()?>assets/front/#">
                <h4>Layanan Unggulan</h4>
              </a>
              <p>
                Kami menyediakan jasa layanan kesehatan unggulan dengan konsep home care dan konsultasi kesehatan.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="single-facilities">
              <span class="lnr lnr-magic-wand"></span>
              <a href="<?php echo base_url()?>assets/front/#">
                <h4>Kelas Bimbingan</h4>
              </a>
              <p>
                Kami menyediakan kelas bimbingan kesehatan dengan konsep kelas dan dibimbing oleh Mentor Professional Dibidangnya.
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="single-facilities">
              <span class="lnr lnr-phone-handset"></span>
              <a href="<?php echo base_url()?>assets/front/#">
                <h4>Respon Sigap</h4>
              </a>
              <p>
                Kami menyipakan kontak konsultasi untuk memberikan informasi seputar masalah kesehatan anda kapanpun dan dimanapun.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End facilities Area -->
    <!-- Start offered-service Area -->
    <section class="offered-service-area section-gap" id="tentang">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-8 offered-left">
            <h1 class="text-white">Tentang <b>SN Heath Care</b></h1>
            <p>
              SN Al Kobar Health Care adalah klinik kesehatan yang mengusung konsep home care dan kelas bimbingan kesehatan sebagai solusi pelayanan kesehatan yang sigap dan cermat.
            </p>
            <div class="service-wrap row">
              <div class="col-lg-6 col-md-6">
                <div class="single-service">
                  <div class="thumb">
                    <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Ruangan Pendaftaran dan Apotek.jpg" alt="">     
                  </div>
                  <a href="<?php echo base_url()?>assets/front/#">
                    <h4 class="text-white">Ruangan Pendaftaran dan Apotek</h4>
                  </a>
                  <!-- <p>
                    Jasa paramedis kami siap datang untuk memberi layanan kesehatan sesuai kebutuhan medis anda.
                  </p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="single-service">
                  <div class="thumb">
                    <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Ruang Tunggu.jpg" alt="">     
                  </div>
                  <a href="<?php echo base_url()?>assets/front/#">
                    <h4 class="text-white">Ruang Tunggu</h4>
                  </a>
                  <!-- <p>
                    Jasa paramedis kami siap datang untuk memberi layanan kesehatan sesuai kebutuhan medis anda.
                  </p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="single-service">
                  <div class="thumb">
                    <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Ruang Tindakan 1.jpg" alt="">     
                  </div>
                  <a href="<?php echo base_url()?>assets/front/#">
                    <h4 class="text-white">Ruang Tindakan</h4>
                  </a>
                 <!--  <p>
                    Jasa paramedis kami siap datang untuk memberi layanan kesehatan sesuai kebutuhan medis anda.
                  </p> -->
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="single-service">
                  <div class="thumb">
                    <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Ruangan Praktik.jpg" alt="">     
                  </div>
                  <a href="<?php echo base_url()?>assets/front/#">
                    <h4 class="text-white">Ruangan Praktik</h4>
                  </a>
                  <!-- <p>
                    Kelas kesehatan juga diadakan sebagai solusi kebutuhan kesehatan anda.
                  </p> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="offered-right relative">
              <div class="overlay overlay-bg"></div>
              <h3 class="relative text-white">Layanan</h3>
              <ul class="relative dep-list">
                <?php foreach ($service as $value) { ?>
                  <li><a href="<?php echo  site_url('home/service/'.$value->service_id); ?>"><?php echo $value->service_name?></a></li>
                <?php } ?>
              </ul>
              <a class="viewall-btn" href="<?php echo base_url()?>assets/front/#">View all Department</a>         
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End offered-service Area -->
    <!-- Start team Area -->
    <section class="team-area section-gap">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="menu-content pb-70 col-lg-7">
            <div class="title text-center">
              <h1 class="mb-10">Tenaga Medis Unggulan</h1>
              <p>Dapatkan perawatan kesehatan kami dari tenaga medis unggulan kami yang handal dan kompeten di bidangnya. </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Nurul Fadilah.jpeg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Nurul Fadilah</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Musrianti.jpg" alt="" width="6%">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Musrianti</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Riyang Sunarti.jpg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Riyang Sunarti</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Sitti Aminah.jpg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Sitti Aminah</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Muamal.jpg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Muamal</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Elza Apriliyanti.jpg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Elza Apriliyanti</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 single-team">
            <div class="thumb">
              <img class="img-fluid" src="<?php echo base_url()?>img/lp-img/Intan Wulandari.jpg" alt="">
              <div class="align-items-end justify-content-center d-flex">
                <div class="social-links">
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-facebook"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-twitter"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-dribbble"></i></a>
                  <a href="<?php echo base_url()?>assets/front/#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                  Paramedis
                </p>
                <h4>Intan Wulandari</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End team Area -->              
    <!-- Start feedback Area -->
    <section class="feedback-area section-gap relative">
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 pb-60 header-text text-center">
            <h1 class="mb-10 text-white">Testimoni Pelanggan</h1>
            <p class="text-white">
              Dengarkan apa yang mereka rasakan setelah menggunakan jasa kami.
            </p>
          </div>
        </div>
        <div class="row feedback-contents justify-content-center align-items-center">
          <div class="col-lg-12 feedback-right">
            <div class="active-review-carusel">
              <div class="single-feedback-carusel">
                <img src="<?php echo base_url()?>assets/front/img/r1.png" alt="">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Riska Dianita</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>                                
                  </div>
                </div>
                <p class="text-white">
                  SN Alkobar Health Center adalah solusi nyata untuk layanan Home Care.
                </p>
              </div>
              <div class="single-feedback-carusel">
                <img src="<?php echo base_url()?>assets/front/img/r1.png" alt="">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Andi Musli</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>                            
                    <span class="fa fa-star checked"></span>                            
                  </div>
                </div>
                <p class="text-white">
                  Layanan yang tidak tanggung-tanggung oleh SN Al-Kobar membuat saya sangat puas dengan pelayanan mereka. Terimakasih SN Al Kobar Health Center
                </p>
              </div>
              <div class="single-feedback-carusel">
                <img src="<?php echo base_url()?>assets/front/img/r1.png" alt="">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Firda Rosali</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked "></span>                               
                  </div>
                </div>
                <p class="text-white">
                  Awalnya coba-coba. Ternyata kelas kesehatan ibu hamil yang saya ikut di SN Al Kobar Health Center sangat menarik dan menambah pengetahuan saya seputar kehamilan saya. SN AL-KOBAR IS THE BEST
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End feedback Area -->  
    
    <!-- Start recent-blog Area -->
    <section class="recent-blog-area section-gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 pb-60 header-text">
            <h1>Artikel Kesehatan</h1>
            <p>
              Temukan lebih banyak informasi mengenai tips dan trik kesehatan dari SN Health Care
            </p>
          </div>
        </div>
        <div class="row">
          <?php foreach ($post as $keys) { ?>
            <div class="single-recent-blog col-lg-3 col-md-3">
              <div class="thumb">
                <img class="f-img img-fluid mx-auto" src="<?php echo base_url()?>img/post/<?php echo $keys->post_image; ?>" alt="" widht="30%">   
              </div>
              <a href="<?php echo site_url('home/blog/'.$keys->post_slug) ?>">
                <h4><?php echo $keys->post_title; ?></h4>
              </a>
              <p>
                <?php 
                  $limit = 100;
                  $desc = $keys->post_desc; 
                  echo substr($desc, 0, $limit)." ...";
                ?>
              </p>
              <div class="bottom d-flex justify-content-between align-items-center flex-wrap">
                <div>
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                  <a href="<?php echo base_url('home/blog/'.$keys->post_slug); ?>"><span><?php echo $keys->post_postby; ?></span></a>
                </div>
                <div class="meta">
                  <?php echo $keys->post_postdate; ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- end recent-blog Area -->   
    <!-- start footer Area -->      
    <footer class="footer-area section-gap" id="kontak">
      <div class="container">
        <div class="row">
          <div class="col-lg-2  col-md-6">
            <img src="<?php echo base_url()?>img/snlogo.png" width="150">
          </div>
          <div class="col-lg-4  col-md-6">
            <div class="single-footer-widget mail-chimp">
              <h6 class="mb-20">Kontak Kami</h6>
              <p>
                Jl. D.I Pandjaitan Kompleks Lepo-Lepo Square No. 23, Kel. Wundudopi, Kec. Baruga Kota Kendari
              </p>
              <h3>+6282234229752</h3>
            </div>
          </div>
          <div class="col-lg-6  col-md-12">
            <div class="single-footer-widget newsletter">
              <h6>Newsletter</h6>
              <p>Langganan info dan penawaran menarik dari SN AL-KOBAR HEALTH CENTER.</p>
              <div id="mc_embed_signup">
                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                  <div class="form-group row" style="width: 100%">
                    <div class="col-lg-8 col-md-12">
                      <input name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" required="" type="email">
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <button class="nw-btn primary-btn circle">Subscribe<span class="lnr lnr-arrow-right"></span></button>
                    </div>
                  </div>
                  <div class="info"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between">
          <p class="col-lg-8 col-sm-12 footer-text m-0">
            Copyright &copy;<?php echo date('Y')?> All rights reserved.
          </p>
          <div class="col-lg-4 col-sm-12 footer-social">
            <a href="https://www.facebook.com/snalkobarhealthcenter" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/snalkobar/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="mailto:snalkobar.healthcenter@gmail.com" target="_blank"><i class="fa fa-envelope"></i></a>
          </div>
        </div>
      </div>
    </footer>

    <!-- End footer Area -->
    <script src="<?php echo base_url()?>assets/front/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/jquery-ui.js"></script>                 
    <script src="<?php echo base_url()?>assets/front/js/easing.min.js"></script>            
    <script src="<?php echo base_url()?>assets/front/js/hoverIntent.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/superfish.min.js"></script> 
    <script src="<?php echo base_url()?>assets/front/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/jquery.magnific-popup.min.js"></script> 
    <script src="<?php echo base_url()?>assets/front/js/jquery.tabs.min.js"></script>                       
    <script src="<?php echo base_url()?>assets/front/js/jquery.nice-select.min.js"></script>    
    <script src="<?php echo base_url()?>assets/front/js/owl.carousel.min.js"></script>                                  
    <script src="<?php echo base_url()?>assets/front/js/mail-script.js"></script>   
    <script src="<?php echo base_url()?>assets/front/js/main.js"></script>  
    <!-- </body></html> -->
  </body>
  <!-- </BODY></HTML> -->
</html>