<?php
include('include/db_connect.php');

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    $query = $mysqli->query("SELECT * FROM states WHERE country_id = ".$_POST['country_id']." AND status = 1 ORDER BY state_name ASC");

    $rowCount = $query->num_rows;

    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
	echo "asdasd";
    $query = $mysqli->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");
    $rowCount = $query->num_rows;

    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}




?>
