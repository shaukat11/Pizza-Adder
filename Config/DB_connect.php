<?php 

// Creating the connection
$conn = mysqli_connect('localhost', 'shaukat', '123456', 'ninjapizza');

// Checking the connection
if(!$conn){
    echo "Connection error: ". mysqli_connect_error($conn);
}
?>