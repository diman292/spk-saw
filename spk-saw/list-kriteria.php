<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$judul_page = 'List Kriteria';
require_once('head.php');
require_once('navbar.php');

?>


<div class="container pt-5 pb-5">
	<div class="row">
        <div class="col">
			
					<?php
					$status = isset($_GET['status']) ? $_GET['status'] : '';
					$msg = '';
					switch($status):
						case 'sukses-baru':
							$msg = 'Kriteria baru berhasil dibuat';
							break;
						case 'sukses-hapus':
							$msg = 'Kriteria behasil dihapus';
							break;
						case 'sukses-edit':
							$msg = 'Kriteria behasil diedit';
							break;
					endswitch;
					
					if($msg):
						echo '<div class="alert alert-secondary" role="alert">';
						echo '<p><span class="fa fa-bullhorn"></span> &nbsp; '.$msg.'</p>';
						echo '</div>';
					endif;
					?>
			<div class="card  mb-5 ">	
				<div class="card-header">	
					<h3><i class="fas fa-gavel "></i> List Kriteria</h3>
						<hr class="bg-primary"><br>
					<div class="row">
					<div class="col-7 col-md-6 col-lg-6">
						<a class="btn btn-primary" href="tambah-kriteria.php" role="button">Tambah Kriteria Menggunakan Input Langsung</a>&nbsp;
						</div>
						<div class="col-5 col-md-6 col-lg-6 ">
					<a class="btn btn-primary" href="tambah-kriteria-variabel.php" role="button">Tambah Kriteria Menggunakan Variabel (Sub Kriteria)</a>
					</div>
					</div>	
					<br>
					<?php
					
					$query = $pdo->prepare('SELECT * FROM kriteria ORDER BY urutan_order ASC');			
					$query->execute();
					// menampilkan berupa nama field
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					if($query->rowCount() > 0):
					?>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover table-bordered" id="table_id">
							<thead class="table-primary">
								<tr>
									<th>Nama Kriteria</th>
									<th>Type</th>
									<th>Bobot</th>
									<th>Urutan</th>
									<th>Cara Penilaian</th>
									<th class="text-center">Aksi</th>
									
								</tr>
							</thead>
							<tbody>
								<?php while($hasil = $query->fetch()): ?>
									<tr>
										<td><?php echo $hasil['nama']; ?></td>
										<td>
										<?php
										if($hasil['type'] == 'benefit') {
											echo 'Benefit';
										} elseif($hasil['type'] == 'cost') {
											echo 'Cost';
										}
										?>
										</td>
										<td><?php echo $hasil['bobot']; ?></td>							
										<td><?php echo $hasil['urutan_order']; ?></td>							
										<td><?php echo ($hasil['ada_pilihan']) ? 'Pilihan': 'Inputan'; ?></td>							
									
										<td class="text-center"><a href="single-kriteria.php?id=<?php echo $hasil['id_kriteria']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="Lihat"> </i> </a>&nbsp;
										<a href="edit-kriteria.php?id=<?php echo $hasil['id_kriteria']; ?>"><i class="fa fa-user-edit" data-toggle="tooltip" title="Edit"> </i></a>&nbsp;
										<a href="hapus-kriteria.php?id=<?php echo $hasil['id_kriteria']; ?>" class="yakin-hapus"><i class="fa fa-trash-alt" data-toggle="tooltip" title="Delete"> </i></a>&nbsp;</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>

						<?php else: ?>
							<p>Maaf, belum ada data untuk kriteria.</p>
						<?php endif; ?>
				
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<?php
require_once('foot.php');?>