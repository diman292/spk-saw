<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1));
$judul_page = 'Bantuan';
require_once('head.php');
require_once('navbar.php');
?>
<div class="container pt-5 pb-5">
<h2 class="text-primary text-center"><?php echo $judul_page;?></h2>
<hr class="bg-primary">
    <div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           <h5> 1. Kelola Data User</h5>
            </button>
        </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
            <h6>a. Menambah data user</h6>
            <p>  memilih menu User <i class="fa fa-arrow-right"></i> tombol tambah user <i class="fa fa-arrow-right"></i> mengisi form data user <i class="fa fa-arrow-right"></i> tombol tambah user</p>  
            <h6>b. Mengubah data user</h6>    
            <p>  memilih menu User <i class="fa fa-arrow-right"></i> <i class="fa fa-user-edit text-primary"></i> <i class="fa fa-arrow-right"></i> mengubah data yang ingin di ubah <i class="fa fa-arrow-right"></i> tombol simpan</p>
            <h6>c. Menghapus data user</h6>    
            <p>  memilih menu User <i class="fa fa-arrow-right"></i> <i class="fa fa-trash-alt text-primary"></i> dan akan muncul peringatan<i class="fa fa-arrow-right"></i>OK</p>
            <p class="text-warning">Catatan : terdapat 2 jenis role user. role user dengan keterangan "petugas" hanya dapat digunakan untuk mengelola data alternatif & penilaian dan melihat perankingan sedangkan role user dengan keterangan "admin" dapat digunakan untuk mengelola website seperti mengelola user, kriteria dll.</p>
    </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h5> 2. Kelola Data User</h5>
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            <h6>a. Menambah data kriteria</h6>
            <p>  memilih menu kriteria <i class="fa fa-arrow-right"></i> tombol tambah kriteria <i class="fa fa-arrow-right"></i> mengisi form data kriteria <i class="fa fa-arrow-right"></i> tombol tambah kriteria</p>  
            <p class="text-warning">Catatan : Terdapat 2 jenis inputan yang ada pada kriteria yaitu tambah kriteria menggunakan inputan langsung dan tambah kriteria menggunakan variabel (sub kriteria). Untuk tambah kriteria menggunakan inputan langsung seperti mengisi soal pada esay dengan yang diinputkan adalah angka bukan huruf sedangkan untuk tambah kriteria menggunakan variabel sama seperti mengisi soal pilihan ganda.</p>
           <div class="text-center"> <p>1. tambah kriteria menggunakan inputan langsung</p>
            <img src="assets/images/input.png" alt="input" style="max-width: 430px;">
            <p class="pt-4">2. tambah kriteria menggunakan variabel (sub kriteria)</p>
            <img src="assets/images/sub-kriteria.png" alt="subkkriteria" style="max-width: 430px;">
            </div>
          <h6>b. Mengubah data kriteria</h6>    
            <p>  memilih menu kriteria <i class="fa fa-arrow-right"></i> <i class="fa fa-user-edit text-primary"></i> <i class="fa fa-arrow-right"></i> mengubah data yang ingin di ubah <i class="fa fa-arrow-right"></i> tombol simpan</p>
            <h6>c. Menghapus data kriteria</h6>    
            <p>  memilih menu kriteria <i class="fa fa-arrow-right"></i> <i class="fa fa-trash-alt text-primary"></i> dan akan muncul peringatan<i class="fa fa-arrow-right"></i>OK</p>
            <p class="text-warning">Catatan : *jumlah total bobot pada seluruh kriteria adalah 1. contohnya kriteria a memiliki bobot 20% maka yang di masukkan adalah 0.20. 0.20 adalah hasil dari perhitungan 20/100. <br>*untuk urutan order yang dimaksud adalah sebagai nomor urut dari kriteria yang akan ditampilkan.</p>

        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <h5> 3. Kelola Data Alternatif & Penilaian</h5>
            </button>
        </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
        <h6>a. Menambah data Alternatif & Penilaian</h6>
            <p>  memilih menu Alternatif & Penilaian <i class="fa fa-arrow-right"></i> tombol tambah Alternatif & Penilaian <i class="fa fa-arrow-right"></i> mengisi form data Alternatif & Penilaian <i class="fa fa-arrow-right"></i> tombol tambah Alternatif & Penilaian</p>  
            <h6>b. Mengubah data Alternatif & Penilaian</h6>    
            <p>  memilih menu Alternatif & Penilaian <i class="fa fa-arrow-right"></i> <i class="fa fa-user-edit text-primary"></i> <i class="fa fa-arrow-right"></i> mengubah data yang ingin di ubah <i class="fa fa-arrow-right"></i> tombol simpan</p>
            <h6>c. Menghapus data Alternatif & Penilaian</h6>    
            <p>  memilih menu Alternatif & Penilaian <i class="fa fa-arrow-right"></i> <i class="fa fa-trash-alt text-primary"></i> dan akan muncul peringatan<i class="fa fa-arrow-right"></i>OK</p>
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingFour">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <h5> 4. Perankingan</h5>
            </button>
        </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
        <div class="card-body">
        <h6>a. Melihat Hasil Perankingan</h6>
            <p>Untuk melihat hasil perankingan yaitu dengan memilih menu perankingan.<br>
            daftar nama yang menjadi preferensi adalah dengan nilai tertinggi atau dengan keterangan kelayakan penerima "sangat layak sebagai penerima".
            </p> 
        <h6>a. Penyortiran Hasil Perankingan</h6>
        <p>Untuk melihat hasil perankingan yaitu dengan memilih menu perankingan<i class="fa fa-arrow-right"></i> <i class="fa fa-arrow-up text-primary"></i><i class="fa fa-arrow-down text-primary"></i> kolom "Ranking".</p> 
            <div class="text-center"> 
            <p>Untuk lebih jelasnya perhatikan gambar dibawah ini</p>
            <img src="assets/images/ranking.png" alt="sort" style="max-width: 430px;"></div>
             </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingFive">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            <h5> 5. Pertanyaan</h5>
            </button>
        </h2>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
        <div class="card-body">
        <div class="text-center">
        <h5 class="mb-3 mt-3">Informasi lebih lanjut : </h5>
        <hr class="bg-primary">
               <a href="https://www.facebook.com/dimancaiiankqmu"><img class="mr-4" style=" width: 100px; max-height: 100px; border-radius: 10px; object-fit: cover; object-position: center;"  src="assets/images/fb.svg"> </a>
                <a href="https://www.instagram.com/dimans_h/"><img class="mr-4" style="width: 100px; max-height: 100px; border-radius: 10px; object-fit: cover; object-position: center;" src="assets/images/ig.svg"> </a>
               <a href="https://api.whatsapp.com/send?phone=6289636903109"><img style="width: 100px; max-height: 100px; border-radius: 10px; object-fit: cover; object-position: center;" src="assets/images/wa.svg"></a>
            
              </div>
             </div>
        </div>
    </div>
    </div>
</div>


<?php require_once('foot.php'); ?>