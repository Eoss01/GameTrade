<?php
include("include/config.php");

if(isset($_POST['edit'])){
    $a = $_POST['categoryId'];
    $b = $_POST['categoryName'];
    $c = $_POST['categoryDesc'];
    
    $sql="UPDATE categories SET cat_title='$b', cat_desc='$c' where cat_id='$a'"; 
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
    $sql="delete from categories where cat_id= '$id'";
    $result = $db->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>GameTrade Admin Controller</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script>
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}
</script>
</head>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Categories</h1>
                </div>
            </div>
            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php
                                     $results_per_page = 5;
                                     $sql = "SELECT * FROM categories";
                                     $result = $db->query($sql);
                                     $number_of_results = mysqli_num_rows($result);
                                     $number_of_pages = ceil($number_of_results/$results_per_page);
                                     if (!isset($_GET['page'])) {
                                         $page = 1;
                                       } else {
                                         $page = $_GET['page'];
                                       }
                                     $this_page_first_result = ($page-1)*$results_per_page;
                                     $sql='SELECT * FROM categories LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                                     $result = mysqli_query($db, $sql);

                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><tr><th> Category ID</th><th>Category Name</th><th>Category Description</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>
                                            <td>" . $row["cat_id"]. "</td>
                                            <td>" . $row["cat_title"]. "</td>
                                            <td>" . $row["cat_desc"]."</td>
                                            <td><a href='categoriesEdit.php?edit=".$row["cat_id"]."'>Edit</a>  /
                                            <a href='adminVCategories.php?id=".$row["cat_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                    for ($page=1;$page<=$number_of_pages;$page++) {
                                        echo '<ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="adminVCategories.php?page=' . $page . '">' . $page . '</a>
                                                    </li>
                                                </ul>';
                                        }
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