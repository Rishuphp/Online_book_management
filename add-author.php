<?php
session_start();

if(isset($_SESSION['user_id']) &&
isset($_SESSION['user_email'])){
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Author</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">ADMIN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Store</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="add-book.php">Add Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-category.php">Add Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="add-author.php">Add Author</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LogOut</a>
        </li>
      
            
      </ul>
      
    </div>
  </div>
</nav>
 <form action="php/add-author.php" class="shadow p-4 rounded mt-5" style="width: 90%; max-width:50rem;" method="POST">
    <h1 class="text-center pb-5 display-4 fs-3">
        Add New Author
    </h1>
     <?php
        if(isset($_GET['error'])){ ?>
<div class="alert alert-danger" role="alert">
  <?= htmlspecialchars($_GET['error']); ?>
  
</div>
       <?php } ?> 
        <?php
        if(isset($_GET['success'])){ ?>
<div class="alert alert-success" role="alert">
  <?= htmlspecialchars($_GET['success']); ?>
  
</div>
       <?php } ?> 
     <div class="mb-3">
    <label  class="form-label">Author Name</label>
    <input type="text" name="author_name" class="form-control" >
  </div>
  <button type="submit" class="btn btn-primary">Add Author</button>
 </form>
    </div>
</body>
</html>
<?php }else{
     header("Location: login.php");
     exit ;
} ?>