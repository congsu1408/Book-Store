<?php global $conn;
require '../includes/header.php' ?>
<?php require '../config/config.php' ?>

<?php

    if(isset($_POST['submit'])){
        if(empty($_POST['email']) or empty($_POST['password'])){
            echo "<script>alert('one or more inputs are empty');</script>";
        } else {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $login->execute();

            if ($login->rowCount() > 0) {
                $user = $login->fetch();
                if (password_verify($password, $user['password'])) {
                    echo "<script>alert('login successful');</script>";
                } else {
                    echo "<script>alert('email or password are wrong');</script>";
                }
            } else {
                echo "<script>alert('email or password are wrong');</script>";

            }
        }
    }
    ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="form-control mt-5" method="post" action="login.php">
                    <h4 class="text-center mt-3"> Login </h4>
                    <div class="">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="">
                            <input name="email" type="email"  class="form-control" id="" value="">
                        </div>
                    </div>
                    <div class="">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="">
                            <input name="password" type="password" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <button name="submit" class="w-100 btn btn-lg btn-primary mt-4 mb-4" type="submit">login</button>

                </form>
            </div>
        </div>


<?php require '../includes/footer.php' ?>
