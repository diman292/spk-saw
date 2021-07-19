<?php require_once('includes/init.php'); ?>

<?php
$errors = array();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['username']) ? trim($_POST['password']) : '';

if(isset($_POST['submit'])):
	
	// Validasi
	if(!$username) {
		$errors[] = 'Username tidak boleh kosong';
	}
	if(!$password) {
		$errors[] = 'Password tidak boleh kosong';
	}
	
	if(empty($errors)):
		
		$query = $pdo->prepare('SELECT * FROM user WHERE username = :username');
		$query->execute( array(
			'username' => $username
		) );
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$user = $query->fetch();
		
		if($user) {
			$hashed_password = sha1($password);
			if($user['password'] === $hashed_password) {
				$_SESSION["user_id"] = $user["id_user"];
				$_SESSION["username"] = $user["username"];
				$_SESSION["role"] = $user["role"];
				redirect_to("index.php?status=sukses-login");
			} else {
				$errors[] = 'Maaf, anda salah memasukkan username / password';
			}
		} else {
			$errors[] = 'Maaf, anda salah memasukkan username / password';
		}
		
	endif;

endif;	
?>

<?php
$judul_page = 'Login';
require_once('head.php');
require_once('navbar.php');
?>
<body>

<div class="container pt-5 pb-1">
	<div class="d-flex justify-content-center"> 
		<div class="col-12 col-sm-8 col-md-4">    
        
			<?php if(!empty($errors)): ?>
				
				<div class="alert alert-warning " role="alert">
					<p><strong>Error:</strong></p>
					<ul>
						<?php foreach($errors as $error): ?>
							<li><?php echo $error; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>

				
			<?php endif; ?>	
		
			
		<div class="card">
			<div class="card-header bg-primary">
                <h3 class="text-center text-light">Login SPK-SAW</h3>	
            
			</div>		
		
	    	<div class="card-body">
           
				<form action="login.php" method="post">
					<div class="form-group">					
						<label class="fas fa-user">&nbsp Username</label>
						<input type="text" class="form-control"name="username" placeholder="username" value="<?php echo htmlentities($username); ?>">
					</div>
					<div class="form-group">					
						<label class="fas fa-unlock">&nbsp Password</label>
						<input type="password" class="form-control"name="password" placeholder="password" >
					</div>
					<div class="form-group">
						<button type="submit" name="submit" value="submit" class="btn btn-outline-primary form-control">Login</button>

					</div>
				</form>
		    </div>

			
        </div>
        </div>
		</div>
        </div>
	</div><!-- .container -->

<?php
require_once('foot.php');