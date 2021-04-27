
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

        case 'invaliduid':
          echo "<p style='color: red; text-align: center'>Invalide username format:)</p>";
          break;

          case 'invalidemail':
          echo "<p style='color: red; text-align: center'>Invalid email format!</p>";
          break;

          case 'passwordtooshort':
          echo "<p style='color: red; text-align: center'>Password shoult be at least 6-charracter:)</p>";
          break;

          case 'passwordmismatch':
          echo "<p style='color: red; text-align: center'>Passwords does not match!</p>";
          break;

          case 'takenuid':
          echo "<p style='color: red; text-align: center'>Username Already taken.Choose another username</p>";
          break;

          case 'stmterror':
            echo "<p style='color: red; text-align: center'>Error! Please try again.</p>";
            break;

        default:
          echo "<p style='color: red; text-align: center'>Error! Strange error.</p>";
          break;
      }
    }
   ?>

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
