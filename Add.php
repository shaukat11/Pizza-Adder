<?php

// Including the database file
include('Config/DB_connect.php');


$email = $title = $ingredients = "";
$error = array('email'=>"", 'title'=>"", 'ingredients'=>"");

if(isset($_POST['submit'])){

    // Email check
    if(empty($_POST['email'])){
        $error['email'] = "Enter Email";
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] = "Enter a valid email address";
        }
    }

    // Title Check
    if(empty($_POST['title'])){
        $error['title'] = "Enter a title";
    }else{
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
        $error['title'] = "Enter a valid title";}
    }

    // ingredients check
    if(empty($_POST['ingredients'])){
        $error['ingredients'] = "Enter a ingredients";
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients))
        {$error['ingredients'] = "Enter a valid ingredients";
        }    
    } 

    if(array_filter($error)){
        // Error in the input
    }
    else{

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO content(Title,Ingredients,Email) VALUES('$title','$ingredients','$email')";

        if(mysqli_query($conn,  $sql)){
            header('Location:Index.php');
        }else{
            echo "query error" . mysqli_error($conn);
        }

        
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'Templates/Header.php' ?>

    <section class="container grey-text">
        <h4 class="center">Add A Pizza</h4>
        <br>
            <form class="white container" action="Add.php" method="POST">

                <label for="Email">Your Email</label>
                <input type="email" name="email" value="<?php echo  htmlspecialchars($email) ?>">
                <div class="red-text"><?php echo $error['email'] ?></div>
                <br> <br>
                <label for="title">Pizza Tilte</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>"> 
                <div class="red-text"><?php echo $error['title'] ?></div>
                <br> <br>
                <label for="Ingredients">Pizza Ingredients:</label>
                <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
                <div class="red-text"><?php echo $error['ingredients'] ?></div>
                <br> <br>
                <div class="center">
                    <input class="btn brand z-depth-0" type="submit" name="submit" value="Make">
                </div>
                
            </form>
    </section>
     
    <br>

    <?php include 'Templates/Footer.php' ?>
</html>