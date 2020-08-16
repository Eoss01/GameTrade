<?php
include("include/config.php");  
if(isset($_POST['submit'])) {
    $categoryId = $_POST['categoryId'];
    $brandId = $_POST['brandId'];
    $productName = $_POST['productName'];
    $productPrice= $_POST['productPrice'];
    $productDesc = $_POST['productDesc']; 

    $productImage1 = $_FILES['productImage1']['name'];
    $tmp_name = $_FILES['productImage1']['tmp_name'];
    $productImage2 = $_FILES['productImage2']['name'];
    $tmp_name = $_FILES['productImage2']['tmp_name'];
    $productImage3 = $_FILES['productImage3']['name'];
    $tmp_name = $_FILES['productImage3']['tmp_name'];

    $location = "product_images/";  
    move_uploaded_file($tmp_name, $location.$productImage1);   
    move_uploaded_file($tmp_name, $location.$productImage2);  
    move_uploaded_file($tmp_name, $location.$productImage3);  
    $productQuantity = $_POST['productQuantity'];
    $productStype = $_POST['productStype'];
    $productKey = $_POST['productKey'];
    $words = "/^[a-zA-Z0-9_.-]*$/";
    $number = "/^[a-zA-Z0-9_.-]*$/";


    if(empty($productName) || empty($productPrice) || empty($productDesc) || empty($productQuantity) || empty($productStpe) || empty($productKey)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('adminIProduct.php');</script>";
        exit();
    
    }else{
        if(empty($productImage)){
            echo "<script>alert('Please upload the images for the product');</script>";
            echo "<script>window.location.assign('adminIProduct.php');</script>";
            exit();
        
    }
        if(!preg_match($words,$productDesc)){
            echo "<script>alert('Please fill in a valid product description(can include a-z,A-Z,0-9)');</script>";
            echo "<script>window.location.assign('adminIProduct.php');</script>";
            exit();
    
    }
        if(!preg_match($number,$productPrice)){
		echo "<script>alert('Please fill in a valid product price in digits');</script>";
        echo "<script>window.location.assign('adminIProduct.php');</script>";
        exit();
    }        
        if(!preg_match($number,$productQuantity)){
		echo "<script>alert('Please fill in a valid product quantity in digits');</script>";
        echo "<script>window.location.assign('adminIProduct.php');</script>";
        exit();
    }
    
    $sql = "SELECT product_title FROM products WHERE product_title = '$productName' LIMIT 1" ;
    $check_query = mysqli_query($db,$sql);
	$count_product = mysqli_num_rows($check_query);
	if($count_product > 0){
		echo "<script>alert('Product existed, please fill another product name');</script>";
		echo "<script>window.location.assign('adminICategories.php');</script>";
    
    }else{
        $sql = "INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image1,product_image2,product_image3,product_quantity,product_stype,product_keywords) VALUES ('$categoryId','$brandId','$productName','$productPrice','$productDesc','$productImage1','$productImage2','$productImage3','$productQuantity','$productStype','$productKey')";
        $run_query = mysqli_query($db,$sql);
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('adminVProduct.php');</script>";

    }
    
}
    }


$db->close();
?>