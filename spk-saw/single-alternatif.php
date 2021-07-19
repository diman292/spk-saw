<?php require_once('includes/init.php'); ?>

<?php
$ada_error = false;
$result = '';
$aktif='active';
$id_alternatif = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(!$id_alternatif) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT * FROM alternatif WHERE id_alternatif = :id_alternatif');
	$query->execute(array('id_alternatif' => $id_alternatif));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	}
}
?>

<?php
$judul_page = 'Detail alternatif';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-success text-white">
                    <h3 class="fas fa-users "> <?php echo $judul_page; ?></h3>
                </div>
                <div class="card-body">
                        <?php if($ada_error): ?>
                        
                            <?php echo '<p>'.$ada_error.'</p>'; ?>
                            
                        <?php elseif(!empty($result)): ?>
                        
                            <h5>Nama</h5>
                            <p><?php echo $result['nama_alternatif']; ?></p>
                            <hr class="bg-primary">
                            <h5>Alamat</h5>
                            <p><?php echo nl2br($result['alamat']); ?></p>
                            <hr class="bg-primary">
                            <h5>Tanggal Input</h5>
                            <p><?php
                                $tgl = strtotime($result['tanggal_input']);
                                echo date('j F Y', $tgl);
                            ?></p>
                            <hr class="bg-primary">
                            <?php
                            $query2 = $pdo->prepare('SELECT nilai_alternatif.nilai AS nilai, kriteria.nama AS nama_kriteria FROM kriteria 
                            LEFT JOIN nilai_alternatif ON nilai_alternatif.id_kriteria = kriteria.id_kriteria 
                            AND nilai_alternatif.id_alternatif = :id_alternatif ORDER BY kriteria.urutan_order ASC');
                            $query2->execute(array(
                                'id_alternatif' => $id_alternatif
                            ));
                            $query2->setFetchMode(PDO::FETCH_ASSOC);
                            $kriterias = $query2->fetchAll();
                            if(!empty($kriterias)):
                            ?>
                            <div class=" table-responsive ">
                                <h3>Nilai Kriteria</h3>
                                <table class="table-bordered table-striped">
                                <thead class="table-success">
                                        <tr>
                                            <?php foreach($kriterias as $kriteria ): ?>
                                                <th style="width: 550px;"><?php echo $kriteria['nama_kriteria']; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php foreach($kriterias as $kriteria ): ?>
                                                <th style="width: 550px;"><?php echo ($kriteria['nilai']) ? $kriteria['nilai'] : 0; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php
                            endif;
                            ?>
                            <hr class="bg-success">
                            <div class="pt-3 pb-2">
                            <a class="btn btn-outline-info" href="edit-alternatif.php?id=<?php echo $id_alternatif; ?>" role="button"><span class="text-danger"></span><i class="fas fa-edit"></i>Edit</a>&nbsp;
                            <a class="btn btn-outline-danger" href="hapus-alternatif.php?id=<?php echo $id_alternatif; ?>" role="button"class="yakin-hapus"><span class="fas fa-trash-alt"></span>Hapus</a>
                            </div>
                            </div>

                        <?php endif; ?>	
                </div>
                <div class="card-footer bg-success">
                </div>		
        
		    </div>
        </div>
	</div>
</div>

<?php
require_once('foot.php');