<?php
include("include/config.php");  

$categoryId = $_POST['categoryId'];
$brandId = $_POST['brandId'];
$productName = $_POST['productName'];
$productPrice= $_POST['productPrice'];
$productDesc = $_POST['productDesc']; 
$productImage = $_FILES['productImage']['name'];
$tmp_name = $_FILES['productImage']['tmp_name'];
$location = "product_images/$productImage";  
move_uploaded_file($tmp_name, $location);   
$productKey = $_POST['productKey'];

$sql = "INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) VALUES ('$categoryId','$brandId','$productName','$productPrice','$productDesc','$location','$productKey')";
 $result= $db->query($sql);
 echo "<script>alert('Insert Successfully');</script>";
 echo "<script>window.location.assign('adminVProduct.php');</script>";

$db->close();
?>