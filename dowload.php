<?php
global $conn;
session_start();
require "includes/header.php";
require "config/config.php";

try {
    $select = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
    $select->execute(['user_id' => $_SESSION['id']]);
    $products = $select->fetchAll(PDO::FETCH_OBJ);

    if (count($products) > 0) {
        $zipname = 'bookstore.zip';
        $zip = new ZipArchive;

        if ($zip->open($zipname, ZipArchive::CREATE) !== TRUE) {
            exit("Cannot open <$zipname>\n");
        }

        foreach ($products as $product) {
            if (file_exists("books/" . $product->pro_file)) {
                $zip->addFile("books/" . $product->pro_file, $product->pro_file);
            } else {
                echo "File " . $product->pro_file . " does not exist.\n";
            }
        }
        $zip->close();

        ob_end_clean();
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
        unlink($zipname);

        $delete = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $delete->execute(['user_id' => $_SESSION['id']]);
    } else {
        echo "No products in cart.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

header("Location: index.php");
exit();
?>
