<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pharma_hub";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['add_pharmacy']))
{
    $store_ID = mysqli_real_escape_string($conn, $_POST['store_ID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $query = "INSERT INTO Pharmacy (store_ID,name,phone_number,location) VALUES ('$store_ID','$name','$phone_number','$location')";

    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        header("Location: adminhome.php");
        exit(0);
    }
    else
    {
        header("Location: adminhome.php");
        exit(0);
    }
}



if(isset($_POST['update_pharmacy']))
{
    $store_ID = mysqli_real_escape_string($conn, $_POST['store_ID']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    $query = "UPDATE pharmacy SET name='$name', phone_number='$phone_number', location='$location' WHERE store_ID='$store_ID' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: adminhome.php");
        exit(0);
    }
    else
    {
        header("Location: adminhome.php");
        exit(0);
    }

}



if(isset($_POST['delete_pharmacy']))
{
    $store_ID = mysqli_real_escape_string($conn, $_POST['delete_pharmacy']);

    $query = "DELETE FROM pharmacy WHERE store_ID='$store_ID' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: adminhome.php");
        exit(0);
    }
    else
    {
        header("Location: adminhome.php");
        exit(0);
    }
}


?>