<?php

 include('Config/DB_connect.php');

 // Writing the query 
 $sql = 'SELECT Title, Ingredients, ID  FROM content';

 // Fetching the results(query)
 $result = mysqli_query($conn, $sql);

 // Storing the query
 $pizzas = mysqli_fetch_all($result ,MYSQLI_ASSOC);

 // Clearing the fetched data to use again
 mysqli_free_result($result);

 // Closing the connection
 mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'Templates/Header.php' ?>

<h4 class="center grey-text">PIZZAS !</h4>
<div class="container">
    <div class="row">

        <?php  foreach($pizzas as $pizz) { ?>   

            <div class="col s6 md3">`
                <div class="card z-depth-0">
                    <div class="card-content center">

                        <h5><?php echo htmlspecialchars($pizz['Title']);?></h5>
                        <br>
                        <h6>Ingredients</h6>
                        
                        <ul>
                            <?php foreach(explode(',',$pizz['Ingredients']) as $ing){?>
                            <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php } ?>
                        </ul>
                    
                    </div>
                    <div class="card-action right-align ">
                        <a href="Details.php?Id=<?php echo $pizz['ID'] ?>" class="brand-text">More Info</a>
                    </div>
                </div>  
            </div>
            
            <?php } ?>

    </div>

</div>

<?php include 'Templates/Footer.php' ?>
</html>