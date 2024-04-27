<?php global $conn;
require "../includes/header.php" ?>
<?php require "../config/config.php" ?>

<?php
if(isset($_POST['delete'])){
    $delete = $conn->prepare("DELETE FROM cart WHERE user_id = '$_SESSION[id]' ");
    $delete->execute();
}
?>


<?php require "../includes/footer.php" ?>
