<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1, 2)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

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

	$id_alternatif = (isset($result['id_alternatif'])) ? trim($result['id_alternatif']) : '';
	$nama = (isset($result['nama_alternatif'])) ? trim($result['nama_alternatif']) : '';
	$alamat = (isset($result['alamat'])) ? trim($result['alamat']) : '';
	$tanggal_input = (isset($result['tanggal_input'])) ? trim($result['tanggal_input']) : '';
}

if(isset($_POST['submit'])):	
	
	$nama = (isset($_POST['nama_alternatif'])) ? trim($_POST['nama_alternatif']) : '';
	$alamat = (isset($_POST['alamat'])) ? trim($_POST['alamat']) : '';
	$tanggal_input = (isset($_POST['tanggal_input'])) ? trim($_POST['tanggal_input']) : '';
	$kriteria = (isset($_POST['kriteria'])) ? $_POST['kriteria'] : array();
	
	// Validasi ID alternatif
	if(!$id_alternatif) {
		$errors[] = 'ID alternatif tidak ada';
	}
	// Validasi
	if(!$nama) {
		$errors[] = 'Nomor alternatif tidak boleh kosong';
	}
	if(!$tanggal_input) {
		$errors[] = 'Tanggal input tidak boleh kosong';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$prepare_query = 'UPDATE alternatif SET nama_alternatif = :nama_alternatif, alamat = :alamat, tanggal_input = :tanggal_input WHERE id_alternatif = :id_alternatif';
		$data = array(
			'nama_alternatif' => $nama,
			'alamat' => $alamat,
			'tanggal_input' => $tanggal_input,
			'id_alternatif' => $id_alternatif,
		);		
		$handle = $pdo->prepare($prepare_query);		
		$sukses = $handle->execute($data);
		
		if(!empty($kriteria)):
			foreach($kriteria as $id_kriteria => $nilai):
				$handle = $pdo->prepare('INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, nilai) 
				VALUES (:id_alternatif, :id_kriteria, :nilai)
				ON DUPLICATE KEY UPDATE nilai = :nilai');
				$handle->execute( array(
					'id_alternatif' => $id_alternatif,
					'id_kriteria' => $id_kriteria,
					'nilai' =>$nilai
				) );
			endforeach;
		endif;
		
		redirect_to('list-alternatif.php?status=sukses-edit');
	
	endif;

endif;
?>

<?php
$aktif='active';
$judul_page = 'Edit alternatif';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-primary text-white">
					<h3> <i class="fa fa-users" ></i> Edit Alternatif & Penilaian</h3>  
                </div>       
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
                        
                        <?php if($sukses): ?>
                        
                            <div class="msg-box">
                                <p>Data berhasil disimpan</p>
                            </div>	
                            
                        <?php elseif($ada_error): ?>
                            
                            <p><?php echo $ada_error; ?></p>
                        
                        <?php else: ?>				
                            <div class="card-body">
                                <form action="edit-alternatif.php?id=<?php echo $id_alternatif; ?>" method="post">
                                    
                                    <div class="form-group">					
                                        <label>Nama <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_alternatif" value="<?php echo $nama; ?>">
                                    </div>					
                                    <div class="form-group">					
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat" cols="30" rows="2"><?php echo $alamat; ?></textarea>
                                    </div>
                                    <div class="form-group">					
                                        <label>Tanggal Input <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="tanggal_input" value="<?php echo $tanggal_input; ?>" class="datepicker">
                                    </div>	
					
                                    
                                    <label><h3>Penilaian</h3></label>
                                    <?php
                                    $query2 = $pdo->prepare('SELECT nilai_alternatif.nilai AS nilai, kriteria.nama AS nama, kriteria.id_kriteria AS id_kriteria, kriteria.ada_pilihan AS jenis_nilai 
                                    FROM kriteria LEFT JOIN nilai_alternatif 
                                    ON nilai_alternatif.id_kriteria = kriteria.id_kriteria 
                                    AND nilai_alternatif.id_alternatif = :id_alternatif 
                                    ORDER BY kriteria.urutan_order ASC');
                                    $query2->execute(array(
                                        'id_alternatif' => $id_alternatif
                                    ));
                                    $query2->setFetchMode(PDO::FETCH_ASSOC);
                                    
                                    if($query2->rowCount() > 0):
                                    
                                        while($kriteria = $query2->fetch()):
                                        ?>
                                            <div class="form-group">					
                                                <label><?php echo $kriteria['nama']; ?></label>
                                                <?php if(!$kriteria['jenis_nilai']): ?>
                                                    <input class="form-control" type="number" step="0.001" name="kriteria[<?php echo $kriteria['id_kriteria']; ?>]" value="<?php echo ($kriteria['nilai']) ? $kriteria['nilai'] : 0; ?>">								
                                                <?php else: ?>
                                                    <select class="form-control" name="kriteria[<?php echo $kriteria['id_kriteria']; ?>]">
                                                        <option value="0">-- Pilih Variabel --</option>
                                                        <?php
                                                        $query3 = $pdo->prepare('SELECT * FROM pilihan_kriteria WHERE id_kriteria = :id_kriteria ORDER BY urutan_order ASC');			
                                                        $query3->execute(array(
                                                            'id_kriteria' => $kriteria['id_kriteria']
                                                        ));
                                                        // menampilkan berupa nama field
                                                        $query3->setFetchMode(PDO::FETCH_ASSOC);
                                                        if($query3->rowCount() > 0): while($hasl = $query3->fetch()):
                                                        ?>
                                                            <option value="<?php echo $hasl['nilai']; ?>" <?php selected($kriteria['nilai'], $hasl['nilai']); ?>><?php echo $hasl['nama']; ?></option>
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
                                        <button type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>			
                        
                    </div>

                
            </div>
        </div>
	</div>
</div>


<?php
require_once('foot.php');