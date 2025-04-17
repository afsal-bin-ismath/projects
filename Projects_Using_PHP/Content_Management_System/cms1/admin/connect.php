<?php
    $hostname = "localhost";
    $database = "cms1";
    $username = "root";
    $password = "12345";
    $con = mysqli_connect($hostname,$username,$password,$database);
    if ($con->connect_error){
        echo "<script> alert('Database Connection Error! Check Credentials and Database Server!'); <script>";
    }
?>