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

        case 'nouser':
          echo "<p style='color: red; text-align: center'>Sorry:) No such user</p>";
          break;

          case 'wrongauth':
          echo "<p style='color: red; text-align: center'>Invalid email, username or password!</p>";
          break;

        default:
          echo "<p style='color: red; text-align: center'>Error! Strange error.</p>";
          break;
      }
    }
   ?>

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
