<?php

/* ---------------------------------------------
 * Konek ke database & load fungsi-fungsi
 * ------------------------------------------- */
require_once('includes/init.php');

/* ---------------------------------------------
 * Load Header
 * ------------------------------------------- */
$judul_page = 'Perankingan Menggunakan Metode SAW';
require_once('head.php');
require_once('navbar.php');
/* ---------------------------------------------
 * Set jumlah digit di belakang koma
 * ------------------------------------------- */
$digit = 2;

/* ---------------------------------------------
 * Fetch semua kriteria
 * ------------------------------------------- */
$query = $pdo->prepare('SELECT id_kriteria, nama, type, bobot
	FROM kriteria ORDER BY urutan_order ASC');
$query->execute();
$query->setFetchMode(PDO::FETCH_ASSOC);
$kriterias = $query->fetchAll();

/* ---------------------------------------------
 * Fetch semua alternatif (alternatif)
 * ------------------------------------------- */
$query2 = $pdo->prepare('SELECT id_alternatif, nama_alternatif FROM alternatif');
$query2->execute();			
$query2->setFetchMode(PDO::FETCH_ASSOC);
$alternatifs = $query2->fetchAll();


/* >>> Langkah 1 ===================================
 * Matrix Keputusan (X)
 * ------------------------------------------- */
$matriks_x = array();
$list_kriteria = array();
foreach($kriterias as $kriteria):
	$list_kriteria[$kriteria['id_kriteria']] = $kriteria;
	foreach($alternatifs as $alternatif):
		
		$id_alternatif = $alternatif['id_alternatif'];
		$id_kriteria = $kriteria['id_kriteria'];
		
		// Fetch nilai dari db
		$query3 = $pdo->prepare('SELECT nilai FROM nilai_alternatif
			WHERE id_alternatif = :id_alternatif AND id_kriteria = :id_kriteria');
		$query3->execute(array(
			'id_alternatif' => $id_alternatif,
			'id_kriteria' => $id_kriteria,
		));			
		$query3->setFetchMode(PDO::FETCH_ASSOC);
		if($nilai_alternatif = $query3->fetch()) {
			// Jika ada nilai kriterianya
			$matriks_x[$id_kriteria][$id_alternatif] = $nilai_alternatif['nilai'];
		} else {			
			$matriks_x[$id_kriteria][$id_alternatif] = 0;
		}

	endforeach;
endforeach;

/* >>> Langkah 3 ===================================
 * Matriks Ternormalisasi (R)
 * ------------------------------------------- */
$matriks_r = array();
foreach($matriks_x as $id_kriteria => $nilai_alternatifs):
	
	$tipe = $list_kriteria[$id_kriteria]['type'];
	foreach($nilai_alternatifs as $id_alternatifx => $nilai) {
		if($tipe == 'benefit') {
			$nilai_normal = $nilai / max($nilai_alternatifs);
		} elseif($tipe == 'cost') {
			$nilai_normal = min($nilai_alternatifs) / $nilai;
		}
		
		$matriks_r[$id_kriteria][$id_alternatifx] = $nilai_normal;
	}
	
endforeach;


/* >>> Langkah 4 ================================
 * Perangkingan
 * ------------------------------------------- */

$ranks = array();
foreach($alternatifs as $alternatif):

	$total_nilai = 0;
	foreach($list_kriteria as $kriteria) {
	
		$bobot = $kriteria['bobot'];
		$id_alternatif = $alternatif['id_alternatif'];
		$id_kriteria = $kriteria['id_kriteria'];
		
		$nilai_r = $matriks_r[$id_kriteria][$id_alternatif];
		$total_nilai = $total_nilai + ($bobot * $nilai_r);

	}
	
	$ranks[$alternatif['id_alternatif']]['id_alternatif'] = $alternatif['id_alternatif'];
	$ranks[$alternatif['id_alternatif']]['nama_alternatif'] = $alternatif['nama_alternatif'];
	$ranks[$alternatif['id_alternatif']]['nilai'] = $total_nilai;
	
endforeach;
 
?>

<div class="sembunyikan container pt-5 pb-5">
    <div class="row">   
        <div class="col">	
			<h1 class="text-primary fas fa-balance-scale text-center pb-5"> <?php echo $judul_page; ?></h1>
			<br>
			
			<!-- Langkah 1. Matriks Keputusan(X) ==================== -->	
			<div class="card pt-2">
				<div class="card-header">	
					<h3 class="text-center text-primary">Langkah 1 : Matriks Keputusan (X)</h3>
					<hr class="bg-primary">
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-hover table-bordered">
							<thead class="table-primary">
								<tr class="super-top">
									<th rowspan="2" class="super-top-left">Nama Alternatif</th>
									<th colspan="<?php echo count($kriterias); ?>">Kriteria</th>
								</tr>
								<tr>
									<?php foreach($kriterias as $kriteria ): ?>
										<th scope="col"><?php echo $kriteria['nama']; ?></th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach($alternatifs as $alternatif): ?>
									<tr>
										<td><?php echo $alternatif['nama_alternatif']; ?></td>
										<?php						
										foreach($kriterias as $kriteria):
											$id_alternatif = $alternatif['id_alternatif'];
											$id_kriteria = $kriteria['id_kriteria'];
											echo '<td>';
											echo $matriks_x[$id_kriteria][$id_alternatif];
											echo '</td>';
										endforeach;
										?>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="sembunyikan container pb-5">
    <div class="row">   
        <div class="col">			
			<!-- Langkah 2. Bobot Preferensi (W) ==================== -->
			<div class="card ">
				<div class="card-header">
					<h3 class="text-center text-primary">Langkah 2: Bobot Preferensi (W)</h3>			
					<hr class="bg-primary">
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-hover table-bordered">
							<thead class="table-primary">
								<tr>
									<th scope="col">Nama Kriteria</th>
									<th scope="col">Type</th>
									<th scope="col">Bobot (W)</th>						
								</tr>
							</thead>
							<tbody>
								<?php foreach($kriterias as $hasil): ?>
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
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="sembunyikan container pb-5">
    <div class="row">   
        <div class="col">			
			<!-- Step 3: Matriks Ternormalisasi (R) ==================== -->
			<div class="card">
				<div class="card-header">
					<h3 class="text-center text-primary">Langkah 3: Matriks Ternormalisasi (R)</h3>			
					<hr class="bg-primary">
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-hover table-bordered" id="table_id">
							<thead class="table-primary">
								<tr class="super-top">
									<th rowspan="2" class="super-top-left">Nama Alternatif</th>
									<th colspan="<?php echo count($kriterias); ?>">Kriteria</th>
								</tr>
								<tr>
									<?php foreach($kriterias as $kriteria ): ?>
										<th scope="col"><?php echo $kriteria['nama']; ?></th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach($alternatifs as $alternatif): ?>
									<tr>
										<td><?php echo $alternatif['nama_alternatif']; ?></td>
										<?php						
										foreach($kriterias as $kriteria):
											$id_alternatif = $alternatif['id_alternatif'];
											$id_kriteria = $kriteria['id_kriteria'];
											echo '<td>';
											echo round($matriks_r[$id_kriteria][$id_alternatif], $digit);
											echo '</td>';
										endforeach;
										?>
									</tr>
								<?php endforeach; ?>				
							</tbody>
						</table>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>

<div class="container pt-5 pb-5">
    <div class="row">   
        <div class="col">
			<!-- Langkah 4: Perangkingan ==================== -->
			<?php		
			$sorted_ranks = $ranks;		
			// Sorting
			if(function_exists('array_multisort')):
				$nama = array();
				$nilai = array();
				
				foreach ($sorted_ranks as $key => $row) {
					$nilai[$key] = $row['nilai'];
					$nama[$key]  = $row['nama_alternatif'];
					
				}
				array_multisort($nilai, SORT_DESC, $nama, SORT_DESC, $sorted_ranks);
			endif;
			?>		
			<div class="card">
				<div class="card-header">
					<h3 class="text-center text-primary">Perangkingan (V)</h3>			
					<hr class="bg-primary">
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center table-hover table-bordered" id="table_id">
							<thead class="table-primary">					
								<tr>
									
									<th class="super-top-left">Nama Alternatif</th>
									<th scope="col">Ranking</th>
									<th scope="col">Kelayakan Penerima</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($sorted_ranks as $alternatif ): ?>
									<tr>
										<td><?php echo $alternatif['nama_alternatif']; ?></td>
										<td><?php echo round($alternatif['nilai'], $digit);
										?></td>
										<td><?php 
										 $ket = $alternatif['nilai']; 
										if ($ket<=0.20 || $ket<=0.2){
											echo "Sangat Tidak Layak Sebagai Penerima";
										}elseif (($ket>0.20 ||$ket>0.2)  && ($ket <=0.40 || $ket<=0.4)){ echo "Tidak Layak Sebagai Penerima";}
										elseif (($ket>0.40 ||$ket>0.4)  && ($ket <=0.60 || $ket<=0.6)){ echo "Cukup Layak Sebagai Penerima";}
										elseif (($ket>0.60 ||$ket>0.6)  && ($ket <=0.80 || $ket<=0.8)){ echo "Layak Sebagai Penerima";}
										else echo "Sangat Layak Sebagai Penerima"

										 ?></td>
																					
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once('foot.php');