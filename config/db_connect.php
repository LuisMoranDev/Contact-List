<?php 

    $conn = mysqli_connect('localhost', 'louthe18', 'test123', 'contact_list');

    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }
    
?> 