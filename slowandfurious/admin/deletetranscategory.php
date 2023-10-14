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
        include_once("../php/adminhead.php")
        ?>
        <!-- end of navbar-->
    </header>
    <div class="container-fluid mt-5">
        <div class="row">
            <main class="col-md-8 offset-md-1 py-5">
                <h3><?php flashMessages(); ?></h3>
                <div class="row mt-3">
                    <h3>Remove Category</h3>
                    <table class="table table-dark table-hover table-striped">
                        <thead>
                            <th>Transmission Category</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
$stmt = $pdo->query("SELECT * FROM category");
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
$xyz = $rows['cat_id'];
echo ("<tr>");
echo "<td>" . htmlentities($rows['cars']) . "</td>";
// echo '<td><img src="../upload/' .
// htmlentities($rows['stand_pic']) . '" width="50px" /></td>';
//the action should point to delete.php

//add a querystring sid in the url referring to the column stand_type_id
echo '<form id="frmdel"
action="delete.php?cid=' . $rows["cat_id"] .'" method="post">
<td><button type="submit" name="btndel"
class="col-12 btn btn-outline-danger btn-lg mx-auto">
Delete stand
</button></td></tr>
</form>';
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