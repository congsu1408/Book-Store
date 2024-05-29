<?php global $conn;
require "../layouts/header.php"; ?>
<?php require "../../config/config.php" ?>

<?php
if(!isset($_SESSION['adminname'])){
    header("location: ".ADMINURL." ");
    exit();
}

$admins = $conn->query("SELECT * FROM admin");
$admins->execute();
$alladmins = $admins->fetchAll(PDO::FETCH_OBJ);

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete = $conn->prepare("DELETE FROM admin WHERE id = :id");
    $delete->execute([
        'id' => $id
    ]);
    header("Location: admins.php?message=success");
    exit();
}

?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
                <?php if (isset($_GET['message']) && $_GET['message'] == 'success'): ?>
                    <div class="alert alert-success" role="alert">
                        Admin deleted successfully!
                    </div>
                <?php endif; ?>
             <a href="../admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">username</th>
                        <th scope="col">email</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <?php if(count($alladmins) == 0): ?>
                    <tr>
                        <td colspan="3" class="text-center">No admins</td>
                    </tr>
                    <?php endif; ?>
                    <tbody>
                    <?php foreach($alladmins as $admin): ?>
                    <tr>
                        <th scope="row"><?php echo $admin->id ?></th>
                        <td><?php echo $admin->adminname ?></td>
                        <td><?php echo $admin->email ?></td>
                        <td>
                            <form method="POST" action="admins.php">
                                <input type="hidden" name="id" value="<?php echo $admin->id ?>">
                                <button name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>


                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"?>
