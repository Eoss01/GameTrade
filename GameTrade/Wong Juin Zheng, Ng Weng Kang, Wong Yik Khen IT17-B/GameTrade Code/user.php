<?php
include("include/config.php");


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
                                    $sql = "SELECT * FROM users";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><tr><th>ID</th><th>Username</th><th>Password</th><th>Email</th><th>ContactNo</th><th>Address</th><th>Operation</th></tr>";
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                            <td>" . $row["id"]. "</td>
                                            <td>" . $row["username"]. "</td>
                                            <td>" . $row["password"]. "</td>
                                            <td>" . $row["email"]."</td>
                                            <td>" . $row["contactNo"]."</td>
                                            <td>" . $row["address"]."</td>
                                            <td><a href='userInfo.php?edit=".$row["id"]."'>Edit</a></td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
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