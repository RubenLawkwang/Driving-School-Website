<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <?php include_once("../php/csslinks.php");
    include_once("../php/jslinks.php")
    ?>
</head>

<body>
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/header.php")
        ?>
        <!-- end of navbar-->
    </header>
    <div class="container-fluid mt-5">
        <div class="row">
            <main class="col-md-8 offset-md-1 py-5">
                <h3><?php flashMessages(); ?></h3>
                <div class="row mt-3">
                    <h3>Remove Driving Course</h3>
                    <tbody>
                        <?php
// Assuming you have already established a PDO connection to the database
// $pdo = new PDO("mysql:host=hostname;dbname=database_name", "username", "password");

// Assuming you have the monitor's ID stored in a session variable called $_SESSION['monitorid']
if (!isset($_SESSION['monitorid'])) {
    echo "Monitor ID is not set.";
    exit;
}

$monitorid = $_SESSION['monitorid'];

// SQL query to fetch only the courses posted by the monitor
$sql = "SELECT * FROM drivingcourse WHERE m_id = :monitorid";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Bind the monitor's ID to the placeholder
$stmt->bindParam(':monitorid', $monitorid, PDO::PARAM_INT);

// Execute the query
if ($stmt->execute()) {
    // Check if there are any posted courses for the monitor
    if ($stmt->rowCount() === 0) {
        echo "No courses posted by this monitor.";
    } else {
        // Fetch the data and display it in a table
        echo "<table class='table table-dark table-hover table-striped'>";
        echo "<tr><th>Course Title</th><th>Price</th><th>Course Description</th><th>Course Type</th><th>Car Type</th><th>Action</th></tr>";
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Assuming you have specific columns in your drivingcourse table,
            // you can access them using $rows['column_name']
            $dc_img = htmlentities($rows['dc_img']);
            $dc_title = htmlentities($rows['dc_title']);
            $dc_price = htmlentities($rows['dc_price']);
            $dc_description = htmlentities($rows['dc_description']);
            $cartype = htmlentities($rows['cartype']);
            $dc_id = $rows['dc_id'];

            echo "<tr>";
            echo "<td>" . $dc_img . "</td>";
            echo "<td>" . $dc_title . "</td>";
            echo "<td>" . $dc_price . "</td>";
            echo "<td>" . $dc_description . "</td>";
            echo "<td>" . $cartype . "</td>";
            //echo '<td><form id="frmdel" action="deletecourse.php" method="post">';
            echo '<form id="frmdel"
action="delete.php?sid=' . $rows["dc_id"] . '" method="post">
<td><button type="submit" name="btndel" 
class="col-12 btn btn-outline-danger btn-lg mx-auto ">
Delete Course
</button></td></tr>';
            echo '<input type="hidden" name="dc_id" value="' . $dc_id . '">';
            //echo '<button type="submit" name="btndel" class="col-12 btn btn-outline-danger btn-lg mx-auto">Delete Stand</button>';
            echo '</form></td>';
            echo "</tr>";
        }
        echo "</table>";
    }
} else {
    // Handle the case when the query fails
    echo "Error executing the query: " . $stmt->errorInfo()[2];
}
?>

                    </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>