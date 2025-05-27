<?php
session_start();



include "user-header.php";
 include "db_conn.php";

  include "php/func-book.php";
$books = get_all_books($conn);

include "php/func-author.php";
$authors = get_all_author($conn);

include "php/func-category.php";
$categories = get_all_categories($conn);








?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Store</title>
    <link rel="manifest" href="manifest.json">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">   
</head>
<body>
  
       <div class="container">
<form action="search.php" style="width: 100%; max-width:30rem;" method="GET">
  <div class="input-group my-5">
  <input type="text" class="form-control" name="key" placeholder="Search Book...." aria-label="Search Book...." aria-describedby="basic-addon2">
  <button class="input-group-text btn btn-primary" id="basic-addon2">
    <img src="img/search-interface-symbol.png" width="20">
  </button>
</div>
</form>
<div class="d-flex pt-3">
    <?php if($books==0){ ?>
        <div class="alert alert-warning text-center p-5" role="alert">
    <img src="img/warning1.png" width="100">
<br>
  There is no book in the database
</div>
        <?php }else{  ?>
    <div class="pdf-list d-flex flex-wrap">
        <?php foreach($books as $book){ ?>

       
        <div class="card m-1">
            <img src="uploads/cover/<?=$book['cover'];?>" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><?=$book['title'];?></h5>
                <p class="card-text">
                <i><b>By:<?php foreach($authors as $author) { 
                    if($author['id'] == $book['author_id']){
                        echo $author['name'];
                        break;
                    }
                    ?>

               <?php  }  ?><br></b></i>    
                <?=$book['description'];?></p>
               <br><i><b>Category:<?php foreach($categories as $category) { 
                    if($category['id'] == $book['category_id']){
                        echo $category['name'];
                        break;
                    }
                    ?>

               <?php  }  ?><br></b></i>
             <?php  
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
           
         
         
            <a href="uploads/files/<?=$book['file'];?>" class="btn btn-success">Open</a>
            
           
        
        
         <?php
            }else{
         ?>
           
           <a href ="user-login.php" class="btn btn-success">Open
             </a>
         <?php
          }
          ?>
            <?php  
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
           
         
         
            <a href="uploads/files/<?=$book['file'];?>" class="btn btn-primary" download="<?=$book['title'];?>">Download</a>
            
           
        
        
         <?php
            }else{
         ?>
           
           <a href ="user-login.php" class="btn btn-primary">Download
             </a>
         <?php
          }
         ?>

             

            </div>
        </div>
 <?php } ?>
    </div>
        <?php }?>
        <div class="category">
          <div class="list-group">
            <?php if($categories == 0){
               }else{?>
            <a href="#" class="list-group-item list-group-item-action active"
            >Category</a>
            <?php foreach($categories as $category){ ?>

           
            <a href="category.php?id=<?=$category['id'];?>" class="list-group-item list-group-item-action"><?=$category['name'];?></a>
 <?php } } ?>
          </div>
            <div class="list-group mt-5">
            <?php if($authors == 0){
               }else{?>
            <a href="#" class="list-group-item list-group-item-action active"
            >Authors</a>
            <?php foreach($authors as $author){ ?>

           
            <a href="author.php?id=<?=$author['id'];?>" class="list-group-item list-group-item-action"><?=$author['name'];?></a>
 <?php } } ?>
          </div>
        </div>
</div>
   
       </div>
</body>
</html>
