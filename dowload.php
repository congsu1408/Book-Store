<?php global $conn;
require "includes/header.php" ?>
<?php require "config/config.php" ?>


<?php

$select = $conn->query("SELECT * FROM cart WHERE user_id = '$_SESSION[id]' ");
$select->execute();
$products = $select->fetchAll(PDO::FETCH_OBJ);


$zipname = 'bookstore.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
foreach ($products as $product) {
    $zip->addFile("books/" . $product->pro_file);
}
$zip->close();


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);

$select = $conn->query("DELETE FROM cart WHERE user_id = '$_SESSION[id]' ");
$select->execute();

header("Location: index.php");
exit();

?>
