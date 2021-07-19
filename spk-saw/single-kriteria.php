<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$aktif='active';
$ada_error = false;
$result = '';

$id_kriteria = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(!$id_kriteria) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT * FROM kriteria WHERE kriteria.id_kriteria = :id_kriteria');
	$query->execute(array('id_kriteria' => $id_kriteria));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	}
}
?>

<?php
$judul_page = 'Detail Kriteria';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-secondary text-white">
                    <h3><i class="fas fa-gavel "></i> <?php echo $judul_page; ?></h3>
                    </div>
                    <?php if($ada_error): ?>
                    
                        <?php echo '<p>'.$ada_error.'</p>'; ?>
                        
                    <?php elseif(!empty($result)): ?>
                <div class="card-body">
                    <h5>nama Kriteria</h5>
                    <p><?php echo $result['nama']; ?></p>
                    <hr class="bg-primary">
                    <h5>Type Kriteria</h5>
                    <p><?php
                    if($result['type'] == 'benefit') {
                        echo 'Benefit (keuntungan)';
                    } elseif($result['type'] == 'cost') {
                        echo 'Cost (kerugian)';
                    }
                    ?></p>
                    <hr class="bg-primary">
                    <h5>Bobot Kriteria</h5>
                    <p><?php echo $result['bobot']; ?></p>
                    <hr class="bg-primary">
                    <h5>Urutan Order</h5>
                    <p><?php echo $result['urutan_order']; ?></p>
                    <hr class="bg-primary">
                    <h5>Cara Penilaian</h5>
                    
                    <p><?php
                    if($result['ada_pilihan'] == 1) {
                        echo 'Menggunakan Pilihan Variabel (Sub Kriteria)';
                    } else {
                        echo 'Inputan Langsung';
                    }				
                    ?></p>
                    
                    <?php if($result['ada_pilihan'] == 1): ?>
                        <hr class="bg-primary">
                        <div class=" table-responsive">					
                        <h5>Pilihan Variabel</h5>
                            <table id="pilihan-var" class="table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr >
                                        <th style="width: 550px;"scope="col">Nama Variabel</th>
                                        <th style="width: 100px;"scope="col">Nilai</th>
                                        <th style="width:150px;"scope="col">Urutan Order </th>						
                                    </tr>
                                    
                                </thead>
                                
                                <tbody>
                                
                                    <?php
                                    $query = $pdo->prepare('SELECT * FROM pilihan_kriteria WHERE id_kriteria = :id_kriteria ORDER BY urutan_order ASC');			
                                    $query->execute(array(
                                        'id_kriteria' => $result['id_kriteria']
                                    ));
                                    // menampilkan berupa nama_kriteria field
                                    $query->setFetchMode(PDO::FETCH_ASSOC);
                                    if($query->rowCount() > 0): while($hasile = $query->fetch()):
                                    ?>								
                                        <tr scope="col">
                                            <td><?php echo $hasile['nama']; ?></td>							
                                            <td><?php echo $hasile['nilai']; ?></td>
                                            <td><?php echo $hasile['urutan_order']; ?></td>
                                        </tr>
                                    <?php endwhile; endif;?>
                                    
                                </tbody>
                            </table>
                    <?php endif; ?>
                    </div>
                    <hr class="bg-primary">
                    <div class="pt-3 pb-2">
                     <a class="btn btn-outline-secondary" href="edit-kriteria.php?id=<?php echo $id_kriteria; ?>" role="button"><span class="text-danger"></span><i class="fas fa-edit"></i>Edit</a>&nbsp;
                    <a class="btn btn-outline-danger" href="hapus-kriteria.php?id=<?php echo $id_kriteria; ?>" role="button"><span class="fas fa-trash-alt"></span>Hapus</a>

                    </div>
                </div>
                
                <?php endif; ?>
			<div class="card-footer bg-secondary"></div>
		    </div>
        </div>
	</div><!-- .container -->
</div><!-- .main-content-row -->


<?php
require_once('foot.php');