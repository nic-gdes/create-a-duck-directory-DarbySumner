<?php

// Create connection DB with mysqli_connect
$conn = mysqli_connect( "db:3306" , "root" , "root" , "db" );

// Verify connection with mysqli_connect_errno and mysquil_connect_error
if( mysqli_connect_errno() ) {
    echo "Database error: " . mysqli_connect_error();
    exit();
}
?>