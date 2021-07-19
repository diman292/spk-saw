<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1, 2)); ?>

<?php
$ada_error = false;
$result = '';

$id_alternatif = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(!$id_alternatif) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT id_alternatif FROM alternatif WHERE id_alternatif = :id_alternatif');
	$query->execute(array('id_alternatif' => $id_alternatif));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		
		$handle = $pdo->prepare('DELETE FROM nilai_alternatif WHERE id_alternatif = :id_alternatif');				
		$handle->execute(array(
			'id_alternatif' => $result['id_alternatif']
		));
		$handle = $pdo->prepare('DELETE FROM alternatif WHERE id_alternatif = :id_alternatif');				
		$handle->execute(array(
			'id_alternatif' => $result['id_alternatif']
		));
		redirect_to('list-alternatif.php?status=sukses-hapus');
		
	}
}
?>

<?php
$judul_page = 'Hapus alternatif';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
	
		
			<h1><?php echo $judul_page; ?></h1>
			
			<?php if($ada_error): ?>
			
				<?php echo '<p>'.$ada_error.'</p>'; ?>	
			
			<?php endif; ?>
			
		
	    </div><!-- .container -->
	</div><!-- .main-content-row -->
</div>

<?php
require_once('foot.php');