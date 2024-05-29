<?php
global $conn;
require "../../config/config.php";
  require "../layouts/header.php";

if(isset($_SESSION['username'])){
    header("location: ".ADMINURL ." ");
}
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) or empty($_POST['password'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM admin WHERE email = '$email'");
        $login->execute();

        if ($login->rowCount() > 0) {
            $admin = $login->fetch();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['adminname'] = $admin['adminname'];
                $_SESSION['email'] = $admin['email'];
                $_SESSION['id'] = $admin['id'];
                header("location: ".ADMINURL." ");
            } else {
                echo "<script>alert('email or password are wrong');</script>";
            }
        } else {
            echo "<script>alert('email or password are wrong');</script>";

        }
    }
}
?>
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />

                  </div>


                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />

                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


                </form>

            </div>
       </div>
<?php require "../layouts/footer.php" ?>
