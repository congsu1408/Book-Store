<?php global $conn;
require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php require "../vendor/autoload.php" ?>
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

    if(isset($_POST['submit'])){
        if(empty($_POST['email']) OR empty($_POST['username']) OR empty($_POST['fname']) OR empty($_POST['lname'])){
            echo "<script>alert('All fields are required')</script>";
        } else{
            $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, price) VALUES (:email, :username, :fname, :lname, :price)");
            $insert-> execute([
                ':email' => $_POST['email'],
                ':username' => $_POST['username'],
                ':fname' => $_POST['fname'],
                ':lname' => $_POST['lname'],
                ':price' => $_SESSION['price']
            ]);
        }
    }

?>

<h2 class="my-5 h2 text-center"></h2>
<div class="hero-wrap js-fullheight" style="margin-top: -25px;);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <h2 class="subheading">Pay with Paypal </h2>

                <h1 class="mb-4"></h1>

                <div class="container">
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src="https://www.paypal.com/sdk/js?client-id=AWlLj4yWLgTZkBZH7Ofyl-hTB5657VoAATmUokDvuCqGNOkPgHbuMb157UZUw5-0d0TBvc7pDzR4rBMv&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                    <script>
                        var price = <?php echo $_SESSION['price']; ?>;
                        paypal.Buttons({
                            // Sets up the transaction when a payment button is clicked
                            createOrder: (data, actions) => {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: price// Can also reference a variable or function
                                        }
                                    }]
                                });
                            },
                            // Finalize the transaction after payer approval
                            onApprove: (data, actions) => {
                                return actions.order.capture().then(function(orderData) {

                                    window.location.href='http://localhost/bookstore/dowload.php';
                                });
                            }
                        }).render('#paypal-button-container');
                    </script>

                </div>

                <p><a href="http://localhost/bookstore/" class="btn btn-primary">Go Home</a> </p>
            </div>
        </div>
    </div>
</div>

<?php require "../includes/footer.php" ?>
