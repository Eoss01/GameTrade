<?php
include("include/db.php");  
if(isset($_POST['submit'])) {
    $UserId = $_POST['userId'];
    $CatIdTitle = $_POST['categoryId'];
    $BrandIdTitle = $_POST['brandId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productDiscount = $_POST['productBPrice'];
    $productDesc = $_POST['productDesc'];
    $productImage = $_FILES['productImage']['name'];
    $tmp_name = $_FILES['productImage']['tmp_name'];
    $location = "product_images/";  
    move_uploaded_file($tmp_name, $location.$productImage);   
    $productQuantity = $_POST['productQuantity'];
    $productStype = $_POST['productStype'];
    $productRentPrice = $_POST['rentPrice'];
    $productKey = $_POST['productKey'];
    

    if(empty($productName) || empty($productPrice) || empty($productDiscount) || empty($productDesc) || empty($productQuantity) || empty($productStype) || empty($productKey)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('userInsertProduct.php');</script>";
        exit();
    
    }else{

        if(empty($productImage)){
            echo "<script>alert('Please upload the images for the product');</script>";
            echo "<script>window.location.assign('userInsertProduct.php');</script>";
            exit();    
    }   
        if (empty($productRentPrice)){ 
            $noRentProduct = "0";
    }
    $sql = "SELECT product_title FROM products WHERE product_title = '$productName' LIMIT 1" ;
    $check_query = mysqli_query($con,$sql);
	$count_product = mysqli_num_rows($check_query);
	if($count_product > 0){
		echo "<script>alert('Product existed, please fill another specific product name');</script>";
		echo "<script>window.location.assign('userInsertProduct.php');</script>";
    
    }else{
        $noRentProduct = "'$noRentProduct'";
        $sql = "INSERT INTO products(user_id,product_cat,product_brand,product_title,product_price,product_bprice,product_desc,product_image,product_quantity,product_stype,product_rentprice,product_keywords) VALUES ('$UserId','$CatIdTitle','$BrandIdTitle','$productName','$productPrice','$productDiscount','$productDesc','$productImage','$productQuantity','$productStype','$productRentPrice','$productKey')";
        $run_query = mysqli_query($con,$sql);
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('userViewProduct.php');</script>";
}
    }
}


$con->close();
?>