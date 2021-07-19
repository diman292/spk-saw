<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php

$ada_error = false;
$result = '';

$id_user = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if(!$id_user) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT id_user, username, nama, email, alamat, role FROM user WHERE user.id_user = :id_user');
	$query->execute(array('id_user' => $id_user));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	}
}
?>

<?php
$judul_page = 'Detail User';
require_once('head.php');
require_once('navbar.php');
?>

<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-success text-white">
                <h3 class="fas fa-user "> <?php echo $judul_page; ?></h3>
                </div>
                    <?php if($ada_error): ?>
                    
                        <?php echo '<p>'.$ada_error.'</p>'; ?>
                        
                    <?php elseif(!empty($result)): ?>
                <div class="card-body">
                        <h5>Username</h5>
                        <p><?php echo $result['username']; ?></p>
                        <hr class="bg-primary">
                        <h5>Nama</h5>
                        <p><?php echo $result['nama']; ?></p>
                        <hr class="bg-primary">  
                        <h5>Email</h5>
                        <p><?php echo $result['email']; ?></p>
                        <hr class="bg-primary">
                        <h5>Alamat</h5>
                        <p><?php echo $result['alamat']; ?></p>
                        <hr class="bg-primary">
                        <h5>Role</h5>
                        <p><?php
                        if($result['role'] == 1) {
                            echo 'Administrator';
                        } elseif($result['role'] == 2) {
                            echo 'Petugas';
                        }
                        ?></p>
                    
                    <?php endif; ?>
                    <hr class="bg-primary">
                    <div class="pt-3 pb-2">
                            <a class="btn btn-outline-info" href="edit-user.php?id=<?php echo $id_user; ?>" role="button"><span class="text-danger"></span><i class="fas fa-edit"></i>Edit</a>&nbsp;
                            <a class=" yakin-hapus btn btn-outline-danger" href="hapus-user.php?id=<?php echo $id_user; ?>" role="button"><span class="fas fa-trash-alt"></span>Hapus</a>
                            </div>
                </div>   
                <div class="card-footer bg-success">
                
                </div>
		    </div>
        </div>
	</div>
</div>


<?php
require_once('foot.php');