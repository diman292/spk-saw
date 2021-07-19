
<div class="container pb-5">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top ">
    <a class="navbar-brand" href="index.php"><h3 class="text-light">SPK-SAW</h3></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container p-1">  
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto sf-menu">
          <?php $user_role = get_role(); ?>
          <?php if($user_role == 'admin'):?>
            
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)></span></a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="bantuan.php">Help</a></li> 
      
            <li class="nav-item active">
            <a class="nav-link"href="list-user.php">User</a></li>
                
      
            <li class="nav-item active">
            <a class="nav-link" href="list-kriteria.php">Kriteria</a></li>

            
          <?php endif; ?>
            <?php if($user_role == 'admin' || $user_role == 'petugas'): ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="list-alternatif.php">Alternatif & Penilaian</a></li>
            <?php endif; ?>
                  <li class="nav-item active">
                    <a class="nav-link" href="ranking-saw.php">Perankingan</a></li>
            
                <?php if(isset($_SESSION['user_id'])): ?>
                              <li class="nav-item active">
                    <a class="nav-link button yakin" href="logout.php">Logout</a></li>
                <?php else: ?>
                              <li class="nav-item active">
                    <a class="nav-link" href="login.php" class="button">Login</a></li>
            <?php endif; ?>
          </div>	

        </ul>
      </div>
  </nav>
</div>
