<?php
require_once "../db/pdo.php";
session_start();
if (!isset($_SESSION['monitorid'])) {
    header("Location: mlogin.php");
    exit; // Ensure the script stops execution after redirecting
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> </title>
    <?php include_once("../php/csslinks.php");
    include_once("../php/jslinks.php")
    ?>
</head>


<body>
    <!--start of navbar -->
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/header.php")
        ?>
        <!-- end of navbar-->
    </header>
    <!-- end of navbar-->
    <div class="container-fluid mt-5">
        <div class="row">
            <main class="col-md-7 offset-md-1 py-5">
                <div class="row mt-3">
                    <h3>List of all Courses</h3>
                    <table class="table table-dark table-hover table-striped w-75">
                        <thead>
                            <th>Poster</th>
                            <th>Course Title</th>
                            <th>Price</th>
                            <th>Course Description</th>
                            <th>Course Type</th>
                            <th>Car Type</th>

                        </thead>
                        <tbody>
                            <?php
                            //add the select statement to read table tblstandtype
                            $monitorid = $_SESSION['monitorid'];
                            $stmt = $pdo->query("SELECT * FROM drivingcourse AS dc
                     INNER JOIN category AS c ON dc.cat_id = c.cat_id
                     WHERE dc.m_id = $monitorid");

                            while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                //add the attribute name
                                echo ("<tr>");
                                echo '<td><img src="../upload/' . htmlentities($rows["dc_img"]) . '"
width="70px" /></td>';
                                echo "<td>" . htmlentities($rows["dc_title"]) . "</td>";
                                echo "<td>" . htmlentities($rows["dc_price"]) . "</td>";
                                echo "<td>" . htmlentities($rows["dc_description"]) . "</td>";
                                echo "<td>" . htmlentities($rows["cartype"]) . "</td>";
                                echo "<td>" . htmlentities($rows["cars"]) . "</td>";
                                // echo '<td><img src="../upload/' . htmlentities($rows["stand_pic"]) . '"
                                // width="50px" /></td>';
                                echo ("</tr>");
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