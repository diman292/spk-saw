<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$aktif='active';
$errors = array();
$sukses = false;

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
	
	$username = (isset($result['username'])) ? trim($result['username']) : '';
	$nama = (isset($result['nama'])) ? trim($result['nama']) : '';
	$email = (isset($result['email'])) ? trim($result['email']) : '';
	$alamat = (isset($result['alamat'])) ? trim($result['alamat']) : '';
	$role = (isset($result['role'])) ? trim($result['role']) : '';	
}

if(isset($_POST['submit'])):	
	
	$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
	$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
	$alamat = (isset($_POST['alamat'])) ? trim($_POST['alamat']) : '';
	$role = (isset($_POST['role'])) ? trim($_POST['role']) : '';
	$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$password2 = (isset($_POST['password2'])) ? trim($_POST['password2']) : '';
	
	// Validasi Nama
	if(!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}		
	// Validasi Email
	if(!$email) {
		$errors[] = 'Email tidak boleh kosong';
	}
	// Validasi role
	if(!$role) {
		$errors[] = 'Role tidak boleh kosong';
	}
	
	// Validasi ID
	if(!$id_user) {
		$errors[] = 'Id User salah';
	}
	
	if($password && ($password != $password2)) {
		$errors[] = 'Password harus sama keduanya';
	}
	
	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$prepare_query = 'UPDATE user SET nama = :nama, alamat = :alamat, email = :email, role = :role WHERE id_user = :id_user';
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'email' => $email,
			'role' => $role,
			'id_user' => $id_user
		);
		if($password) {
			$prepare_query = 'UPDATE user SET nama = :nama, password = :password, alamat = :alamat, email = :email, role = :role WHERE id_user = :id_user';
			$data['password'] = sha1($password);
		}		
		$handle = $pdo->prepare($prepare_query);		
		$sukses = $handle->execute($data);
	
	endif;

endif;
?>

<?php
$judul_page = 'Edit User';
require_once('head.php');
require_once('navbar.php');
?>
<div class="container pt-5 pb-5">
	<div class="row ">
		<div class="col col-md-8 mx-auto">
			<div class="card mb-5">
				<div class="card-header pt-2 bg-primary text-white">
                    <h3> <i class="fa fa-user-edit" ></i> <?php echo $judul_page; ?></h3>
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
				<div class="alert alert-success" role="alert">
				<p>Data berhasil disimpan</p>
				</div>	
				
			<?php elseif($ada_error): ?>
				
				<p><?php echo $ada_error; ?></p>
			
			<?php else: ?>				
				<div class="card-body">
                    <form action="edit-user.php?id=<?php echo $id_user; ?>" method="post">
                        <div class="form-group sembunyikan">					
                            <label><span class="text-danger">Username (tidak dapat diubah)</span></label>
                            <p><?php echo $result['username']; ?></p>
                        </div>					
                        <div class="form-group">					
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                        </div>
                        <div class="form-group">					
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">					
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
                        </div>
                        <div class="form-group">					
                            <label>Role</label>
                            <select class="form-control" name="role">
                                <option value="2" <?php selected($role, 2); ?>>Petugas</option>
                                <option value="1" <?php selected($role, 1); ?>>Administrator</option>						
                            </select>
                        </div>
                        <div class="form-group">					
                            <label>Ganti Password? (Kosongkan jika tidak ingin mengubah password)</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">					
                            <label>Password Lagi (Kosongkan jika tidak ingin mengubah password)</label>
                            <input type="password" class="form-control" name="password2">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control">Simpan</button>
                        </div>
                           
                    </form>
                </div>
			<?php endif; ?>			
			
		</div>
	
	</div><!-- .container -->
	</div><!-- .main-content-row -->


<?php
require_once('foot.php');