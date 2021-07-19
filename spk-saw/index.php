<?php
require_once('includes/init.php');
$judul_page = 'Home';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container-fluid pt-5 pb-2">
  <div class="cintainer">

    <div class="col-md-8 offset-4 mx-auto">
      <div id="slider" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#slider" data-slide-to="0" class="active  "></li>
          <li data-target="#slider" data-slide-to="1" class=""></li>
          <li data-target="#slider" data-slide-to="2"  class=""></li>
          <li data-target="#slider" data-slide-to="3" class=""></li>
          <li data-target="#slider" data-slide-to="4"  class=""></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/images/statistik-min.jpg" style="max-height: fit-content;" class="d-block w-100 " alt="1">
            <div class="carousel-caption d-md-block ">
              <h2 class="mt-5 text-light" style="text-shadow: 3px 2px 1px black;"><strong>Selamat Datang</strong></h2>
              <h3 class="text-light" style="text-shadow: 3px 2px 1px black;"><strong>Sistem Pendukung Keputusan Menggunakan Metode Simple Additive Weighting</strong></h3>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/keputusan-min.jpg"  class="d-block w-100" alt="2">
            <div class="carousel-caption  d-md-block">
            <h1 class="sembunyikan" style="text-shadow: 3px 2px 1px black;"><strong>SPK-SAW</strong></h1>
              <h3 class="text-light" style="text-shadow: 3px 2px 1px black;"><strong>Membantu Dalam Pengambilan Keputusan</strong></h3>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/matematis-min.jpg" class="d-block w-100" alt="3">
            <div class="carousel-caption  d-md-block">
            <h1 class="sembunyikan" style="text-shadow: 3px 2px 1px black;"><strong>SPK-SAW</strong></h1>
            <h3 class="text-light" style="text-shadow: 3px 2px 1px black;"><strong>Menggunakan Perhitungan Matematis</strong></h3>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/komputer-min.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption  d-md-block">
            <h1 class="sembunyikan" style="text-shadow: 3px 2px 1px black;"><strong>SPK-SAW</strong></h1>
            <h3 class="text-light" style="text-shadow: 3px 2px 1px black;"><strong>Terkomputerisasi</strong></h3>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/fast-min.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption  d-md-block">
            <h1 class="sembunyikan" style="text-shadow: 3px 2px 1px black;"><strong>SPK-SAW</strong></h1>
            <h3 class="text-light" style="text-shadow: 3px 2px 1px black;"><strong>Mempercepat Penyeleksian</strong></h3>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon " aria-hidden="true"></span>
          <span class="sr-only" >Previous</span>
        </a>
        <a class="carousel-control-next sembunyikan" href="#slider" role="button" data-slide="next">
          <span class="carousel-control-next-icon " aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        </div>
      </div>
      </div>
  </div>
</div>




<?php
require_once('about.php');
require_once('foot.php');
?>
