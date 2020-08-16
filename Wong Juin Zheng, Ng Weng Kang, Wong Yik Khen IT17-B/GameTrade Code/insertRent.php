<?php
include("include/db.php");

session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_POST['submit'])){
    $user_id = $_SESSION["uid"];
    $renter_id = $_POST["renterId"];
    $product_id = $_POST['productId'];
    $product_title = $_POST['productName'];
    $qty = $_POST['qty'];
    $start_date = $_POST['pick_date'];
    $end_date = $_POST['drop_date'];
    $rent_price = $_POST['total'];
    //$quantity = $_POST['quantity'] - $_POST['qty'];

    $sql2 = "SELECT status_detail FROM status WHERE status_id='1'";
    $run = mysqli_query($con,$sql2);
   
    $sql= "INSERT INTO `rent_request`(`user_id`, `renter_id`, `product_id`, `product_title`, `qty`, `rent_price`, `start_date`, `end_date`, `rent_status`) VALUES ('$user_id', '$renter_id', '$product_id', '$product_title', '$qty', '$rent_price', '$start_date', '$end_date', '1')";
    $result = $con->query($sql);

    //$sql3="UPDATE products SET product_quantity = '$quantity' WHERE product_id = '$user_id'";
    //$result2 = $con->query($sql3);

    if($result){
        echo "<script>alert('Insert Successfully');</script>";
        //echo "Error: " . $sql;
        echo "<script>window.location.assign('userRentControl.php');</script>";
    }else{
        echo "<script>alert('Insert Failed');</script>";
    }
}

$con->close();
?>