<?php
  include_once('includes/header.php')
 ?>

 <!---Alart------------------>
  <?php if (isset($_SESSION['response'])) { ?>
    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?= $_SESSION['response']; ?>
   </div>
 <?php } unset($_SESSION['response']); unset($_SESSION['res_type']); ?>

<main class="form-signin body-form">

  <form action="includes/login.inc.php" method="post">
    <h1 class="h3 mb-3 fw-normal form-xtras">Sign In</h1>

    <div class="form-floating">
      <input type="text" name="uName" class="form-control item" id="floatingInput" placeholder="Username or Email">
    </div>

    <div class="form-floating">
      <input type="password" name="pWord" class="form-control item" id="floatingPassword" placeholder="Password">
    </div>

    <div class="form-xtras">
      <div >
        <a href="resetpassword.php">Forgot password</a>
      </div>
    </div>
    <div class="form-xtras">
      <button class="w-100 btn btn-lg btn-primary form-xtras" type="submit" name="submit">Sign In</button>
    </div>

  </form>

</main>

<div class="createlink">
  <p>Don't have an account?</p>
  <a href="signup.php">Click to create your account</a>
</div>


<?php
  include_once('includes/footer.php')
 ?>
