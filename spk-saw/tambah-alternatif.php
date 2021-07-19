<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1, 2)); ?>

<?php
$errors = array();
$sukses = false;

$nama_alternatif = (isset($_POST['nama_alternatif'])) ? trim($_POST['nama_alternatif']) : '';
$alamat = (isset($_POST['alamat'])) ? trim($_POST['alamat']) : '';
$kriteria = (isset($_POST['kriteria'])) ? $_POST['kriteria'] : array();


if(isset($_POST['submit'])):	
	
	// Validasi
	if(!$nama_alternatif) {
		$errors[] = 'Nama Alternatif tidak boleh kosong';
	}	
	 
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$handle = $pdo->prepare('INSERT INTO alternatif (nama_alternatif, alamat, tanggal_input) VALUES (:nama_alternatif, :alamat, :tanggal_input)');
		$handle->execute( array(
			'nama_alternatif' => $nama_alternatif,
			'alamat' => $alamat,
			'tanggal_input' => date('Y-m-d')
		) );
		$sukses = "Nama alternatif <strong>{$nama_alternatif}</strong> berhasil dimasukkan.";
		$id_alternatif = $pdo->lastInsertId();
		
		// Jika ada kriteria yang diinputkan:
		if(!empty($kriteria)):
			foreach($kriteria as $id_kriteria => $nilai):
				$handle = $pdo->prepare('INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, nilai) VALUES (:id_alternatif, :id_kriteria, :nilai)');
				$handle->execute( array(
					'id_alternatif' => $id_alternatif,
					'id_kriteria' => $id_kriteria,
					'nilai' =>$nilai
				) );
			endforeach;
		endif;
		
		redirect_to('list-alternatif.php?status=sukses-baru');		
		
	endif;

endif;
?>

<?php
$judul_page = 'Tambah alternatif';
require_once('head.php');
require_once('navbar.php');
?>
<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
			<div class="card-header pt-2 bg-primary text-white">
				<h3> <i class="fa fa-plus" >&nbsp</i>Tambah Alternatif & Penilaian</h3>
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
					<form action="tambah-alternatif.php" method="post">
	
						<div class="form-group">					
							<label>Nama<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="nama_alternatif" value="<?php echo $nama_alternatif; ?>">
						</div>					
						<div class="form-group">					
							<label>Alamat<span class="text-danger">*</span></label>
							<textarea name="alamat" class="form-control" cols="30" rows="2"><?php echo $alamat; ?></textarea>
						</div>			
						
						<h3>Nilai Kriteria</h3>
						<?php
						$query = $pdo->prepare('SELECT id_kriteria, nama, ada_pilihan FROM kriteria ORDER BY urutan_order ASC');			
						$query->execute();
						// menampilkan berupa nama_kriteria field
						$query->setFetchMode(PDO::FETCH_ASSOC);
						
						if($query->rowCount() > 0):
						
							while($kriteria = $query->fetch()):							
							?>
							
								<div class="form-group">					
									<label><?php echo $kriteria['nama']; ?></label>
									<?php if(!$kriteria['ada_pilihan']): ?>
										<input type="number" class="form-control" step="0.001" name="kriteria[<?php echo $kriteria['id_kriteria']; ?>]">								
									<?php else: ?>
								

										<select name="kriteria[<?php echo $kriteria['id_kriteria']; ?>]" class="form-control">
											<option >-- Pilih Variabel --</option>
											<?php
											$query3 = $pdo->prepare('SELECT * FROM pilihan_kriteria WHERE id_kriteria = :id_kriteria ORDER BY urutan_order ASC');			
											$query3->execute(array(
												'id_kriteria' => $kriteria['id_kriteria']
											));
											// menampilkan berupa nama_kriteria field
											$query3->setFetchMode(PDO::FETCH_ASSOC);
											if($query3->rowCount() > 0): while($hasl = $query3->fetch()):
											?>
												<option value="<?php echo $hasl['nilai']; ?>"><?php echo $hasl['nama']; ?></option>
											<?php
											endwhile; endif;
											?>
										</select>
										
									<?php endif; ?>
								</div>	
							
							<?php
							endwhile;
							
						else:					
							echo '<p>Kriteria masih kosong.</p>';						
						endif;
						?>
						<div class="form-group">
							<button type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control">Tambah Alternatif & Penilaian</button>
						</div>
					</form>
				</div>
			</div>
			</div>				
		</div>
	</div><!-- .container -->
</div><!-- .main-content-row -->


<?php
require_once('foot.php');