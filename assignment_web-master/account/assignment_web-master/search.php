<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <title> Search</title>
</head>
<body>
<div class="container">
   <div class="row">
   <div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
   <div class="row">

   <?php 

     $conn = new mysqli('localhost', 'root', '', 'web_ass_2');
     if(isset($_GET['search'])){
        $searchKey = $_GET['search'];
        $sql = "SELECT * FROM account WHERE username LIKE '%$searchKey%'";
     }else
     $sql = "SELECT * FROM account";
     $result = $conn->query($sql);
   ?>

   <form id="form1" action="" method="GET"> 
     <div class="col-md-6">
        <input id="search" type="text" name="search" class='form-control' placeholder="Search By Name" onfocus="this.value=''" value=<?php echo @$_GET['search']; ?> > 
     </div>
     <div class="col-md-6 text-left">
      <button onclick="myFunction()" class="btn searchClear">Search</button>
     </div>

   </form>
   

   <br> 
   <br>
</div>


<table class="table table-bordered">
  <tr>
     <th>ID</th>
     <th>Username</th>
     <th>Password</th>
     <th>Email</th>
     <th>Role</th>
  </tr>
  <?php while( $row = $result->fetch_object() ): ?>
  <tr>
     <td><?php echo $row->account_id ?></td>
     <td><?php echo $row->username ?></td>
     <td><?php echo $row->password ?></td>
     <td><?php echo $row->email ?></td>
     <td><?php echo $row->role ?></td>
  </tr>
  <?php endwhile; ?>
</table>
</div>
</div>
</div>
</body>
</html>