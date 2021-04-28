<?php
  include_once('includes/header.php')
 ?>

 <main class="form-signin body-form">

   <?php
     if(isset($_GET["error"])){
       $error = $_GET["error"];
       switch ($error) {
         case 'emptyinpute' :
           echo "<p style='color: red; text-align: center'>All fields must be filed:)</p>";
           break;

         case 'passwordmismatch':
           echo "<p style='color: red; text-align: center'>Passwords does not match!</p>";
           break;


         case 'nouser':
           echo "<p style='color: red; text-align: center'>User does not exist in our database.</p>";
           break;

         case 'failure':
           echo "<p style='color: red; text-align: center'>Error Occure. Please try again</p>";
           break;

         case 'updated':
           echo "<p style='color: green; text-align: center'>Your password Changed. Proceed to Log In</p>";
           break;

         default:
           echo "<p style='color: red; text-align: center'>Error! Strange error.</p>";
           break;
       }
     }
    ?>
 <!---Alart------------------>
    <?php if (isset($_SESSION['res-paword'])) { ?>
    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible fade show text-center">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?= $_SESSION['res']; ?>
   </div>
 <?php } unset($_SESSION['res-paword']); unset($_SESSION['res_type']); ?>

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
