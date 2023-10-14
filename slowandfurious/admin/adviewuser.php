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
    <title>Block User</title>
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
if (!isset($_REQUEST['cid'])) {
    echo '<h3>List of Clients</h3>';
} else {
    echo '<h3>List of Clients: ' . $_REQUEST['cid'] . '</h3>';
}
?>
                    <table class="table table-black table-hover table-striped w-75">
                        <thead>
                            <th>Cient Firstname</th>
                            <th>Client Lastname</th>
                            <th>Phone Number</th>
                            <th>Picture</th>
                            <th>Block</th>
                        </thead>
                        <tbody>
                            <?php
if (!isset($_REQUEST['cid'])) {
    $stmt = $pdo->query("SELECT * FROM clients WHERE c_status = 1");
} else {
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE c_id = :cid");
    $stmt->execute(array(":cid" => $_REQUEST['cid']));
}
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ("<tr>");
echo "<td>" . htmlentities($rows['c_fname']) . "</td>";
echo "<td>" . htmlentities($rows['c_lname']) . "</td>";
echo "<td>" . htmlentities($rows['c_phonenumber']) . "</td>";
echo '<td><img src="../upload/' .
htmlentities($rows['c_profilepicture']) . '" width="70px" /></td>';
echo ('<td><a class="btn btn-outline-warning"
href="blockuser.php?cid=' . $rows['c_id'] . '">Block User</a> </td> ');
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