<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_GET['delete'])){
    $delete=$_GET['delete'];
    $sql="delete from address_book where id = '$delete'";
    $result = $con->query($sql);
}

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
$qry="SELECT * FROM address_book WHERE user_id = '$user_id' LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);



?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>GameTrade</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
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
<?php include("include/wheader.php"); ?>
<?php include("include/usidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Address Book</h1><button class="pull-right" data-toggle="modal" data-target="#addAddress"><i class="fa fa-plus-circle"><a href="userInsertAddress.php"></i>Add Address</a></button>
                </div>
            </div>
            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='addressBook.php'><tr><th>No</th><th>Address</th><th>City</th><th>Postcode</th><th>State</th><th>Creation Date</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["id"]. "</td>
                                            <td>" . $row["address"]. "</td>
                                            <td>" . $row["city"]. "</td>
                                            <td>" . $row["postcode"]."</td>
                                            <td>" . $row["state"]."</td>
                                            <td>" . $row["creation_date"]."</td>
                                            <td>
                                            <button><a href='addressBook.php?delete=".$row["id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button>
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from address_book where user_id = '$user_id'";
                                        $result=$con->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "0 Address Record";
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