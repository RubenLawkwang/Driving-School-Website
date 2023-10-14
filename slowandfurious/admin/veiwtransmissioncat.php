<?php
session_start();
require_once "../db/pdo.php";
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
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/adminhead.php")
        ?>
        <!-- end of navbar-->
    </header>
    <div class="container-fluid mt-5">
        <div class="row">
            <main class="col-md-7 offset-md-1 py-5">
                <div class="row mt-3">
                    <h3>List of all Cars Category</h3>
                    <table class="table table-dark table-hover table-striped w-75">
                        <thead>
                            <th>Cars</th>

                        </thead>
                        <tbody>
                            <?php
//add the select statement to read table tblstandtype
$stmt = $pdo->query("select * from category");
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
//add the attribute name
echo ("<tr>");
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