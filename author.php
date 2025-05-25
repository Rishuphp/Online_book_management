<?php
session_start();

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];
 include "db_conn.php";

 include "user-header.php";

  include "php/func-book.php";
  $books = get_books_by_author($conn,$id);


include "php/func-author.php";
$authors = get_all_author($conn);
$current_author = get_author($conn,$id);


include "php/func-category.php";
$categories = get_all_categories($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $current_author['name']; ?></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">   
</head>
<body>
    <div class="container">
     
<h1 class="display-4 p-3 fs-3">
    <a href="index.php" class="nd">
        <img src="img/left-arrow.png" width="35">
    </a>
    <?= $current_author['name']; ?>
</h1>
<div class="d-flex pt-3">
    <?php if($books==0){ ?>
        <div class="alert alert-warning text-center p-5" role="alert">
    <img src="img/alert.png" width="100">
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
            <a href="uploads/files/<?=$book['file'];?>" class="btn btn-success">Open</a>
            <a href="uploads/files/<?=$book['file'];?>" class="btn btn-primary" download="<?=$book['title'];?>">Download</a>

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
            >Author</a>
            <?php foreach($authors as $author){ ?>

           
            <a href="author.php?id=<?=$author['id'];?>" class="list-group-item list-group-item-action"><?=$author['name'];?></a>
 <?php } } ?>
          </div>
        </div>
</div>
    </div>
</body>
</html>