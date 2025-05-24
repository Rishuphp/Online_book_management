<?php
session_start();

include "user-header.php";
 

     

    include "db_conn.php";

  

    if(isset($_GET['name'])){
        $title =$_GET['name'];
    }else $title = '';

    if(isset($_GET['email'])){
        $desc =$_GET['email'];
    }else $desc = '';

    if(isset($_GET['password'])){
        $category =$_GET['password'];
    }else $category = '';

   
    
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Book</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container">
            
            <form action="php/user-profile.php" class="shadow p-4 rounded mt-5" style="width: 90%; max-width:50rem;" method="POST" enctype="multipart/form-data" >
                <h1 class="text-center pb-5 display-4 fs-3">
                    <?php
 $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
                     if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
                   <img src="uploads/cover/<?= $fetch_profile['image']; ?>" alt="" width="140" style="border-radius: 63px; height:140px">

                
                   <?php 
                     }else{
                       ?> 
            <img src=img/user.png style="width: 130px;">
                    <?php } ?>
                </h1>
                <?php
                if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>

                    </div>
                <?php } ?>
                <?php
                if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']); ?>

                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" name="name_id" value="<?=$fetch_profile['id'];?>" hidden >
                    <input type="text" name="name" value="<?=$fetch_profile['name'];?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label"> User Email</label>
                    <input type="text" name="email"value="<?=$fetch_profile['email'];?>" class="form-control">
                </div>
                
                  <div class="mb-3">
                    <label class="form-label"> User Password</label>
                    <input type="password" name="password"value="<?=$fetch_profile['password'];?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" value="<?=$fetch_profile['image'];?>" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        </div>
    </body>

    </html>
   
 