<?php
if(isset($_SESSION['user_id1'])){
   $user_id = $_SESSION['user_id1'];
}else{
   $user_id = '';
};

 include "db_conn.php";

?>
 
 <div class="container">
 <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Online Book Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Store</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
          
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <img src="uploads/cover/<?=$fetch_profile['image']; ?>" width="40" style="border-radius: 25px;height:45px;">
            <?php
            }else{
         ?>
            <img src=img/user.png style="width: 25px;">
         <?php
          }
         ?>
          </a>
          <ul class="dropdown-menu">
           
           
          <div class="profile">
       
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
          <center><img src="uploads/cover/<?= $fetch_profile['image']; ?>" alt="" style="width: 60px; border-radius:30px;"></center>
         <h6 class="text text-center"><?= $fetch_profile['name']; ?></h6>
         <div class="flex">
            <center><a href="user-profile.php" class="btn btn-primary">Profile</a>
            <a href="logout-user.php" onclick="return confirm('logout from this website?');" class="btn btn-primary">Logout</a></center>
         </div>
        
         <?php
            }else{
         ?>
            <h6 class="name text text-center" >Please Login First!</h6>
           <center> <a href="user-login.php" class="btn btn-primary">Login</a></center>
         <?php
          }
         ?>

            </ul>
          </li>
          
        
      
            
      </ul>
    </div>
  </div>
        </div>
</nav>