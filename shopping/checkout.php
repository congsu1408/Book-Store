<?php require"../includes/header.php" ?>
<?php require"../config/config.php" ?>
<?php require"../vendor/autoload.php" ?>
<?php
if(!isset($_SESSION['username'])){
    header("location: ".APPURL ." ");
}

/* at the top of 'check.php' */
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location:' . APPURL . ''));
}
?>
    <!-- Heading -->
    <h2 class="my-5 h2 text-center">Checkout</h2>

    <!--Grid row-->
    <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

            <!--Card-->
            <div class="card">

                <!--Card content-->
                <form class="card-body" method="post" action="charge.php">

                    <!--Grid row-->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-6 mb-2">

                            <!--firstName-->
                            <div class="md-form">
                                <label for="firstName"  class="">First name</label>

                                <input type="text" name="fname" id="firstName" class="form-control">
                            </div>

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-6 mb-2">

                            <!--lastName-->
                            <div class="md-form">
                                <label for="lastName" class="">Last name</label>

                                <input type="text" name="lname" id="lastName" class="form-control">
                            </div>

                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!--Username-->
                    <div class="md-form mb-5">
                        <label for="email" class="">Username</label>

                        <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                    </div>

                    <!--email-->
                    <div class="md-form mb-5">
                        <label for="email" class="">Email</label>

                        <input type="text" id="email" name="email" class="form-control" placeholder="youremail@example.com">
                    </div>


                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Continue to checkout</button>

                </form>

            </div>

        </div>
    </div>
<?php require"../includes/footer.php" ?>
