<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$type = (isset($_POST['type'])) ? trim($_POST['type']) : '';
$bobot = (isset($_POST['bobot'])) ? trim($_POST['bobot']) : '';
$jenis_nilai = (isset($_POST['jenis_nilai'])) ? trim($_POST['jenis_nilai']) : 0;
$pilihan = (isset($_POST['pilihan'])) ? $_POST['pilihan'] : '';
$urutan_order = (isset($_POST['urutan_order'])) ? trim($_POST['urutan_order']) : 0;

if(isset($_POST['submit'])):	
	
	// Validasi nama Kriteria
	if(!$nama) {
		$errors[] = 'nama kriteria tidak boleh kosong';
	}		
	// Validasi Tipe
	if(!$type) {
		$errors[] = 'Type kriteria tidak boleh kosong';
	}
	// Validasi Bobot
	if(!$bobot) {
		$errors[] = 'Bobot kriteria tidak boleh kosong';
	}	
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$handle = $pdo->prepare('INSERT INTO kriteria (nama, type, bobot, urutan_order, ada_pilihan) VALUES (:nama, :type, :bobot, :urutan_order, :jenis_nilai)');
		$handle->execute( array(
			'nama' => $nama,
			'type' => $type,
			'bobot' => $bobot,
			'urutan_order' => $urutan_order,
			'jenis_nilai' => $jenis_nilai			
		) );
		$id_kriteria = $pdo->lastInsertId();
		
		if($id_kriteria && $jenis_nilai == 1 && !empty($pilihan)): foreach($pilihan as $pil):
			
			$nama = (isset($pil['nama'])) ? trim($pil['nama']) : '';
			$nilai = (isset($pil['nilai'])) ? floatval($pil['nilai']) : '';
			$urutan_order = (isset($pil['urutan']) && $pil['urutan']) ? (int) trim($pil['urutan']) : 0;
						
			
			if($nama != '' && ($nilai >= 0)):
				
				$prepare_query = 'INSERT INTO pilihan_kriteria (nama, id_kriteria, nilai, urutan_order) VALUES  (:nama, :id_kriteria, :nilai, :urutan_order)';
				$data = array(
					'nama' => $nama,
					'id_kriteria' => $id_kriteria,
					'nilai' => $nilai,
					'urutan_order' => $urutan_order	
				);		
				$handle = $pdo->prepare($prepare_query);		
				$sukses = $handle->execute($data);				
				
			endif;		
		endforeach; endif;
		
		redirect_to('list-kriteria.php?status=sukses-baru');		
	
	endif;

endif;
?>

<?php
$judul_page = 'Tambah Kriteria';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-primary text-white">
					<h3> <i class="fa fa-plus" >&nbsp</i>Tambah Kriteria</h3>

				
					<?php if(!empty($errors)): ?>
					
						<div class="msg-box warning-box">
							<p><strong>Error:</strong></p>
							<ul>
								<?php foreach($errors as $error): ?>
									<li><?php echo $error; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						
					<?php endif; ?>			
				</div>
				<div class="card-body">
					<form action="tambah-kriteria.php" method="post">
					
						<div class="form-group">					
							<label>Nama Kriteria <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="nama"  value="<?php echo $nama; ?>">
						</div>
						<div class="form-group">					
							<label>Type Kriteria <span class="text-danger">*</span></label>
							<select name="type" class="form-control">
								<option value="benefit" <?php selected($type, 'benefit'); ?>>Benefit</option>
								<option value="cost" <?php selected($type, 'cost'); ?>>Cost</option>						
							</select>
						</div>
						<div class="form-group">					
							<label>Bobot Kriteria <span class="text-danger">*</span></label>
							<input type="number" class="form-control" name="bobot" value="<?php echo $bobot; ?>" step="0.01">
						</div>
						<div class="form-group">					
							<label>Urutan Order</label>
							<input type="number" class="form-control" name="urutan_order" value="<?php echo $urutan_order; ?>">
						</div>
						<div class="sembunyikan form-group">					
							<label >Cara Penilaian</label>
							<select name="jenis_nilai" class="form-control " id="jenis-nilai">
								<option value="0"disable>Input Langsung</option>
								
															
							</select>
						</div>
						
						<div class="form-group list-var sembunyikan" id="list">					
							<h3>Pilihan Variabel</h3>
							<table id="pilihan-var" class="pure-table pure-table-striped">
								<thead>
									<tr>
										<th>Nama Variabel</th>
										<th style="width: 120px;">Nilai</th>									
										<th style="width: 50px;">Urutan</th>									
										<th>Hapus</th>									
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<div class="align-right">
								<a href="#" class="btn btn-outline-primary tambah-pilihan">Tambah Pilihan</a>
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control">Tambah Kriteria</button>
						</div>
					</form>
					
					<?php //endif; ?>			
				</div>
		</div>
	
	</div><!-- .container -->
</div><!-- .main-content-row -->


<?php
require_once('foot.php');