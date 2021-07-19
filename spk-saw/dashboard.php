<?php
require_once('includes/init.php');
cek_login($role = array(1));
$judul_page = 'Dashboard';
require_once('head.php');
require_once('navbar.php');

$sql = "SELECT COUNT(*) FROM user";
$sql1 = "SELECT COUNT(*) FROM kriteria";
$sql2 = "SELECT COUNT(*) FROM alternatif";


$res = $pdo->query($sql);
$res1 = $pdo->query($sql1);
$res2 = $pdo->query($sql2);

$count = $res->fetchColumn();
$count1 = $res1->fetchColumn();
$count2 = $res2->fetchColumn();
?>
<div class="container pt-5 pb-3">
        <div class="row pt-2">
          <div class="col-lg-4 col-md-6 col-sm-6 pb-4">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="text-primary fas fa-user"></i>
                  </div>
                  <p class="card-category">User</p>
                  <h3 class="card-title"><?php echo $count;?> User</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="list-user.php">Lihat Selengkapnya...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 pb-4">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="text-primary fas fa-gavel"></i>
                  </div>
                  <p class="card-category">Kriteria</p>
                  <h3 class="card-title"><?php echo $count1;?> Kriteria</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="list-kriteria.php">Lihat Selengkapnya...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 pb-4">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="text-primary fas fa-users"></i>
                  </div>
                  <p class="card-category">Alternatif</p>
                  <h3 class="card-title"><?php echo $count2;?> Alternatif</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="list-alternatif.php">Lihat Selengkapnya...</a>
                  </div>
                </div>
              </div>
            </div>
        </div>
</div>
<div class="container mt-3 pb-3">
    
        <div class="jumbotron">
                <h1 class="display-5 text-center text-primary">Simple Additive Weighting</h1>
                <p class="lead text-dark">Langkah Metode Simple Additive Weighting (Sari, 2018) : </p>
                <hr class="bg-primary">
                  <p>1. Menentukan alternatif (kandidat). <br>
                      2. Menentukan kriteria yang akan dijadikan acuan dalam pengambilan keputusan.<br>
                      3. Memberikan nilai rating kecocokan setiap alternatif pada setiap kriteria.<br>
                      4. Menentukan bobot preferensi atau tingkat kepentingan untuk setiap kriteria.<br>
                      5. Membuat tabel rating kecocokan dari setiap alternatif pada setiap kriteria.<br>
                      6. Membuat matrik keputusan X yang dibentuk dari tabel rating kecocokan dari <br>
                      setiap alternatif pada setiap kriteria. Nilai X setiap alternatif pada setiap kriteria 
                      yang sudah ditentukan.<br>
                      7. Melakukan normalisasi matrik keputusan X dengan cara menghitung nilai 
                      rating kinerja ternomalisasi dari alternatif Ai pada kriteria Cj. dengan 
                      melakukan pengelompokan, apakah adalah kriteria keuntungan (benefit) atau j 
                      adalah kriteria biaya (cost) maksudnya adalah :<br>
                      a. Dikatakan kriteria keuntungan apabila nilai xij memberikan keuntungan 
                      bagi pengambil keputusan, sebaliknya kriteria biaya apabila xij 
                      menimbulkan biaya bagi pengambil keputusan.<br>
                      b. Apabila berupa kriteria keuntungan maka nilai xij dibagi dengan nilai 
                      Max,i(xij) dari setiap kolom, sedangkan untuk kriteria biaya, nilai 
                      Min,i(xij dari setiap kolom dibagi dengan nilai xij.
                      8. Hasil dari nilai rating kinerja ternomalisasi (rij) membentuk matrik 
                      ternormalisasi.<br>
                      9. Hasil akhir nilai preferensi diperoleh dari penjumlahan untuk setiap perkalian 
                      elemen baris matrik ternormalisasi (R) dengan bobot preferensi (W) yang 
                      bersesuaian elemen kolom matrik (W). Hasil perhitungan nilai Vi yang lebih 
                      besar mengindikasikan bahwa alternatif Ai merupakan alternatif terbaik.<br>
                      10. Menentukan Nilai Indikasi.<br>
                      11. Perangkingan. Perangkingan dilakukan dengan cara mengalikan nilai SAW 
                      dengan nilai Indikasi dan hasil akhir dari nilai akan di rangking sesuai urutan 
                      hasil yang mempunyai nilai paling besar sampai yang terkecil.</p>
        </div>
    </div>
</div>
<?php
require_once('foot.php');
?>