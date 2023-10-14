<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve advertistment</title>
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
    <!-- start -->
    <div class="container-fluid mt-5">
        <div class="row">
            <main class="col-md-7 offset-md-1 py-5">
                <?php flashMessages(); ?>
                <div class="row mt-3">
                    <?php
if (!isset($_REQUEST['adis'])) {
    echo '<h3>List of Advertistment</h3>';
} else {
    echo '<h3>List of Advertistment: ' . $_REQUEST['adis'] . '</h3>';
}
?>
                    <table class="table table-black table-hover table-striped w-75">
                        <thead>
                            <th>Company name</th>
                            <th>Company email</th>
                            <th>Company Advertisment</th>
                            <th>Approve</th>
                        </thead>
                        <tbody>
                            <?php
if (!isset($_REQUEST['adis'])) {
    $stmt = $pdo->query("SELECT * FROM advertform a INNER JOIN organisation o ON a.or_id = o.or_id WHERE a.status = 1");
} else {
    $stmt = $pdo->prepare("SELECT * FROM advertform a INNER JOIN organisation o ON a.or_id = o.or_id WHERE a.ad_id = :aid");
    $stmt->execute(array(":aid" => $_REQUEST['adis']));
}
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ("<tr>");
echo "<td>" . htmlentities($rows['or_name']) . "</td>";
echo "<td>" . htmlentities($rows['or_email']) . "</td>";
echo '<td><img src="../upload/' .
htmlentities($rows['ad_img']) . '" width="70px" /></td>';
echo ('<td><a class="btn btn-outline-warning"
href="deny.php?adis=' . $rows['ad_id'] . '">Block ADS</a> </td> ');
echo ("</tr>");
}
?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- end -->

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>