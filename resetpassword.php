<?php
  include_once('includes/header.php')
 ?>

 <!---Alart------------------>

  <?php if (isset($_SESSION['res-paword'])) { ?>
    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?= $_SESSION['res-paword']; ?>
   </div>
 <?php } unset($_SESSION['res-paword']); unset($_SESSION['res_type']); ?>

 <main class="form-signin body-form">

   <form action="includes/signup.inc.php" method="post">
     <h1 class="h3 mb-3 fw-normal form-xtras">Reset Your Password</h1>
     <div class="form-floating">
       <input type="text" name="uName" class="form-control item" id="floatingInput" placeholder="username">
     </div>
     <div class="form-floating">
       <input type="password" name="pWord" class="form-control item" id="floatingInput" placeholder="New Password">
     </div>
     <div class="form-floating">
       <input type="password" name="cpWord" class="form-control item" id="floatingInput" placeholder="Confirm New Password">
     </div>
     <div class="form-xtras">
       <button class="w-100 btn btn-lg btn-primary form-xtras" type="submit" name="reset">Reset Password</button>
     </div>
   </form>

 </main>





<?php
  include_once('includes/footer.php')
 ?>
