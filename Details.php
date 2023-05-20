<?php

$var1 = 10;
$res = $var1 > 20 ? 'good' : 'bad';


include('Config/DB_connect.php');

if(isset($_POST['delete'])){

    $Delete_matarial = mysqli_real_escape_string($conn, $_POST['deleting_material']);

    $sql = "DELETE FROM content WHERE Id = $Delete_matarial";

    if(mysqli_query($conn,$sql)){
        header('location: Index.php');
    }
    else{
        echo 'Error ' . mysqli_error($conn);
    }
}
else{

}

if(isset($_GET['Id'])){

    $id = mysqli_real_escape_string($conn,$_GET['Id']);

    $sql = "SELECT * FROM content WHERE Id = $id";

    $result = mysqli_query($conn,$sql);

    $list = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

}



?>
    
<!DOCTYPE html>
<html lang="en">

<!-- Including Header -->
<?php include 'Templates/Header.php'; ?>

<br>

<div class="container center">
    <div class="col s6 md3">
        <div class="card z-depth-0">
            <div class="card-content center">
           
                <?php if($list) : ?>
                    <h6>Name</h6>
                    <h5><?php echo htmlspecialchars($list['Title']) ?></h5>
                    <br>
                    <h6>Ingredients</h6>
                    <h5><?php echo htmlspecialchars($list['Ingredients']) ?></h5>
                    <br>
                    <h6>Created by</h6>
                    <h5><?php echo htmlspecialchars($list['Email']) ?></h5>
                    <br>
                    <h6>Time</h6>
                    <h5><?php echo htmlspecialchars($list['Created_at']) ?></h5>
                <?php else : ?>
                    <h4><?php echo "There is no such pizza" ?></h4>
                <?php endif; ?>

                <form class="container" action="Details.php" method="POST">
                    <input type="hidden" name="deleting_material" value="<?php echo $list['Id'] ?>">
                    <input type="submit" class="btn center" value="Delete" name="delete">
                </form>
        </div>
    </div>  
</div>

<?php include 'Templates/Footer.php'; ?>
    
</html>