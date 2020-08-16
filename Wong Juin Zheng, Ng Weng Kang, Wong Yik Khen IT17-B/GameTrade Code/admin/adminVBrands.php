<?php
include("include/config.php");
session_start();

if(!isset($_SESSION["aid"])){
	header("location:index.php");
}

if(isset($_POST['edit'])){
    $brandId = $_POST['brandId'];
    $brand_title = $_POST['brandName'];
    $brand_desc = $_POST['brandDesc'];

    if(empty($brand_title) || empty($brand_desc)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('brandsEdit.php');</script>";
        exit();
    
    }else{
        $sql="UPDATE brands SET brand_title='$brand_title', brand_desc='$brand_desc' where brand_id='$brandId'"; 
        $result = $db->query($sql);
        echo "<script>alert('Edit Successfully');</script>";
        echo "<script>window.location.assign('adminVBrands.php');</script>";
    }
    
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from brands where brand_id= '$id'";
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
$qry="SELECT * FROM brands  LIMIT $startfrom,$num_rec_per_page";
$result = $db->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT * FROM brands WHERE brand_title like '%$search%' or brand_desc like '%$search%'";
        $result = $db->query($sql);
    }
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
            <form action="adminVBrands.php" method="POST">
            <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="adminIBrands.php"></i>Add Brand</a></button>
            <input type="submit" name="search" value="Search" style="float: right;"/>
            <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVBrands.php'><tr><th> Brand ID</th><th>Brand Name</th><th>Brand Description</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>
                                            <td>" . $row["brand_id"]. "</td>
                                            <td>" . $row["brand_title"]. "</td>
                                            <td>" . $row["brand_desc"]."</td>
                                            <td><button><a href='brandsEdit.php?edit=".$row["brand_id"]."'>Edit</a></button>
                                            <button><a href='adminVBrands.php?id=".$row["brand_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button></td></tr>";
                                        }
                                        echo "</table>";

                                        $qry="select * from brands";
                                        $result=$db->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "0 Brands Record";
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
