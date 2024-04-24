<?php global $conn;
require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php

    if(isset($_POST['submit'])){
        $pro_id = $_POST['pro_id'];
        $pro_name = $_POST['pro_name'];
        $pro_image = $_POST['pro_image'];
        $pro_price = $_POST['pro_price'];
        $pro_amount = $_POST['pro_amount'];
        $pro_file = $_POST['pro_file'];
        $user_id = $_POST['user_id'];

        $insert = $conn->prepare("INSERT INTO cart (pro_id, pro_name, pro_image, pro_price, pro_amount, pro_file, user_id) VALUES (:pro_id, :pro_name, :pro_image, :pro_price, :pro_amount, :pro_file, :user_id)");

        $insert->execute([
            'pro_id' => $pro_id,
            'pro_name' => $pro_name,
            'pro_image' => $pro_image,
            'pro_price' => $pro_price,
            'pro_amount' => $pro_amount,
            'pro_file' => $pro_file,
            'user_id' => $user_id
        ]);

    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //checking if the product exists
        $select = $conn->query("SELECT * FROM cart WHERE pro_id = '$id' AND user_id = '$_SESSION[id]' ");
        $select->execute();

        $product = $conn->query("SELECT * FROM products WHERE id = $id AND status = 1 ");
        $product->execute();
        $product = $product->fetch(PDO::FETCH_OBJ);
    } else{
        echo "404";
    }

?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" src="../images/<?php echo $product->image ?>" width="250" /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"> <a href="<?php echo APPURL ?>" class="ml-1 btn btn-primary"><i class="fa fa-long-arrow-left"></i> Back</a> </div> <i class="fa fa-shopping-cart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3">
                                    <h5 class="text-uppercase"><?php echo $product->name ?></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">$<?php echo $product->price ?></span>
                                    </div>
                                </div>
                                <p class="about"><?php echo $product->description ?></p>
                                <form method="post" id="form-data">
                                    <div class="">
                                        <input name="pro_id" type="text"  class="form-control" value="<?php echo $product->id ?>">
                                    </div>
                                    <div class="">
                                        <input name="pro_name" type="text"  class="form-control" value="<?php echo $product->name ?>">
                                    </div>
                                    <div class="">
                                        <input name="pro_image" type="text"  class="form-control" value="<?php echo $product->image ?>">
                                    </div>
                                    <div class="">
                                        <input name="pro_price" type="text"  class="form-control" value="<?php echo $product->price ?>">
                                    </div>
                                    <div class="">
                                        <input name="pro_amount" type="text"  class="form-control" value="1">
                                    </div>
                                    <div class="">
                                        <input name="pro_file" type="text"  class="form-control" value="<?php echo $product->file ?>">
                                    </div>
                                    <div class="">
                                        <input name="user_id" type="text"  class="form-control" value="<?php echo $_SESSION['id'] ?>">
                                    </div>
                                    <div class="cart mt-4 align-items-center">
                                        <?php if($select->rowCount()>0): ?>
                                        <button name="submit" type="submit" disabled class="btn btn-primary text-uppercase mr-2 px-4"><i class="fas fa-shopping-cart"></i> Add to cart</button>
                                        <?php else: ?>
                                        <button name="submit" type="submit" class="btn btn-primary text-uppercase mr-2 px-4"><i class="fas fa-shopping-cart"></i> Add to cart</button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php require"../includes/footer.php" ?>

<script>
    $(document).ready(function(){
        $(document).on('submit', function (e){
            e.preventDefault();
            var formdata = $('#form-data').serialize() + "&submit=submit";

            $.ajax({
                url: 'single.php',
                type: 'post',
                data: formdata,
                success: function(){
                    alert('Product added to cart')
                }
            })
        })
    });
</script>
