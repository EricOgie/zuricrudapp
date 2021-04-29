
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
  <form action="includes/signup.inc.php" method="post">
    <h1 class="h3 mb-3 fw-normal form-xtras">Creat Your Account</h1>
    <div class="form-floating">
      <input type="text" name="fName" class="form-control item" id="floatingInput" placeholder="Frst Name">
    </div>
    <div class="form-floating">
      <input type="text" name="lName" class="form-control item" id="floatingInput" placeholder="Last Name">
    </div>
    <div class="form-floating">
      <input type="text" name="uName" class="form-control item" id="floatingInput" placeholder="Username">
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control item" id="floatingInput" placeholder="name@example.com">
    </div>
    <div class="form-floating">
      <input type="password" name="pWord" class="form-control item" id="floatingInput" placeholder="Password">
    </div>
    <div class="form-floating">
      <input type="password" name="cpWord" class="form-control item" id="floatingInput" placeholder="Confirm Password">
    </div>
    <div class="form-xtras">
      <button class="w-100 btn btn-lg btn-primary form-xtras" type="submit" name="submit">Create Account</button>
    </div>
  </form>
</main>


<?php
  include_once('includes/footer.php')
 ?>
