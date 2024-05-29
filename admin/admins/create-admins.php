<?php global $conn;
require "../../config/config.php" ?>
<?php require "../layouts/header.php"; ?>


<?php
if(isset($_POST['submit'])){
    if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } elseif ($conn->query("SELECT * FROM admin WHERE email = '$_POST[email]'")->rowCount() > 0) {
        echo "<script>alert('email already exists');</script>";
    } elseif ($conn->query("SELECT * FROM admin WHERE adminname = '$_POST[username]'")->rowCount() > 0) {
        echo "<script>alert('username already exists');</script>";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO admin (adminname, email, password) VALUES (:username, :email, :password)");
        $insert->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        header('location: admins.php');



    }
}
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />

                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>







                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"?>
