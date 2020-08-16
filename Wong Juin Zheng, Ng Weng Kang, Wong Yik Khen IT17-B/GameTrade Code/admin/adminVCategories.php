<?php
include("include/config.php");
session_start();

if(!isset($_SESSION["aid"])){
	header("location:index.php");
}

if(isset($_POST['edit'])){
    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];
    $categoryDesc = $_POST['categoryDesc'];

    if(empty($categoryName) || empty($categoryDesc)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('categoriesEdit.php');</script>";
        exit();
    
    }else{
        $sql="UPDATE categories SET cat_title='$categoryName', cat_desc='$categoryDesc' where cat_id='$categoryId'"; 
        $result = $db->query($sql);
        echo "<script>alert('Edit Successfully');</script>";
        echo "<script>window.location.assign('adminVCategories.php');</script>";
    }

}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from categories where cat_id= '$id'";
    $result = $db->query($sql);
}

//pagination
$num_rec_per_page=5;
if(isset($_GET['pg']))
{
    $pg=$_GET['pg'];
}
else
{
    $pg=1;
}
$startfrom=( $pg-1 ) * $num_rec_per_page;
$qry="SELECT * FROM categories  LIMIT $startfrom,$num_rec_per_page";
$result = $db->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT * FROM categories WHERE cat_title like '%$search%' or cat_desc like '%$search%'";
        $result = $db->query($sql);
    }
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
            <form action="adminVCategories.php" method="POST">
            <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="adminICategories.php"></i>Add Category</a></button>
            <input type="submit" name="search" value="Search" style="float: right;"/>
            <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVCategories.php'><tr><th>Category ID</th><th>Category Name</th><th>Category Description</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>
                                            <td>" . $row["cat_id"]. "</td>
                                            <td>" . $row["cat_title"]. "</td>
                                            <td>" . $row["cat_desc"]."</td>
                                            <td><button><a href='categoriesEdit.php?edit=".$row["cat_id"]."'>Edit</a></button>  
                                            <button><a href='adminVCategories.php?id=".$row["cat_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button></td></tr>";
                                        }
                                        echo "</table>";

                                        $qry="select * from categories";
                                        $result=$db->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "0 Category Record";
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