<?php
include("include/config.php");
session_start();

if(!isset($_SESSION["aid"])){
	header("location:index.php");
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from user_info where user_id= '$id'";
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
$qry="SELECT * FROM user_info  LIMIT $startfrom,$num_rec_per_page";
$result = $db->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT * FROM user_info WHERE user_id like '%$search%' or first_name like '%$search%' or last_name like '%$search%'";
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
                    <h1 class="page-header">View Members</h1>
                </div>
            </div>
            <div class="panel-body">
            <form action="adminVUser.php" method="POST">
            <input type="submit" name="search" value="Search" style="float: right;"/>
            <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVUser.php'>
                                        <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Mobile</th><th>regDate</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["user_id"]. "</td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["last_name"]."</td>
                                            <td>" . $row["email"]."</td>
                                            <td>" . $row["mobile"]."</td>
                                            <td>" . $row["regDate"]."</td>
                                            <td><button><a href='adminVUser.php?id=".$row["user_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button></td></tr>";
                                        }
                                        echo "</table>";

                                        $qry="select * from user_info";
                                        $result=$db->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "0 User Record";
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
