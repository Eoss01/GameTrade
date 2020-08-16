<?php
include("include/config.php");

if(isset($_POST['edit'])){
    $a = $_POST['brandId'];
    $b = $_POST['brandName'];
    $c = $_POST['brandDesc'];
    
    $sql="UPDATE brands SET brand_title='$b', brand_desc='$c' where brand_id='$a'"; 
    $result = $db->query($sql);

    if($db->query($sql)===TRUE)
    {
        echo "<script>alert('Edit Successfully');</script>";
        
    }
    else
    {
        echo "Error: ".$sql."<br>".$db->error;
    }

}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from brands where brand_id= '$id'";
    $result = $db->query($sql);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GameTrade Admin Controller</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<script>
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}
</script>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Brands</h1>
                </div>
            </div>
            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php
                                    $results_per_page = 5;
                                    $sql = "SELECT * FROM brands";
                                    $result = $db->query($sql);
                                    $number_of_results = mysqli_num_rows($result);
                                    $number_of_pages = ceil($number_of_results/$results_per_page);
                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                      } else {
                                        $page = $_GET['page'];
                                      }
                                    $this_page_first_result = ($page-1)*$results_per_page;
                                    $sql='SELECT * FROM brands LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                                    $result = mysqli_query($db, $sql);


                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><tr><th> Brand ID</th><th>Brand Name</th><th>Brand Description</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result))  {
                                            echo "<tr>
                                            <td>" . $row["brand_id"]. "</td>
                                            <td>" . $row["brand_title"]. "</td>
                                            <td>" . $row["brand_desc"]."</td>
                                            <td><a href='brandsEdit.php?edit=".$row["brand_id"]."'>Edit</a>  /
                                            <a href='adminVBrands.php?id=".$row["brand_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                    for ($page=1;$page<=$number_of_pages;$page++) {
                                        echo '<ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="adminVBrands.php?page=' . $page . '">' . $page . '</a>
                                                    </li>
                                                </ul>';
                                        }
                                        ?>
                                        <?php

                                    ?>
                                </div>



        </div>
    </div>

</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>
