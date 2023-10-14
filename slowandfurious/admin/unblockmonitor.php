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
    <title>Unblock User</title>
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
    echo '<h3>List of Unblock Monitors</h3>';
} else {
    echo '<h3>List of Unblock Monitors: ' . $_REQUEST['mid'] . '</h3>';
}
?>
                    <table class="table table-black table-hover table-striped w-75">
                        <thead>
                            <th>Client Firstname</th>
                            <th>Client Lastname</th>
                            <th>Phone Number</th>
                            <th>Profile Picture</th>
                            <th>Unblock</th>
                        </thead>
                        <tbody>
                            <?php
if (!isset($_REQUEST['mid'])) {
    $stmt = $pdo->query("SELECT * FROM monitors WHERE m_status = 0");
} else {
    $stmt = $pdo->prepare("SELECT * FROM monitors WHERE m_id = :mid");
    $stmt->execute(array(":mid" => $_REQUEST['mid']));
}
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ("<tr>");
echo "<td>" . htmlentities($rows['m_fname']) . "</td>";
echo "<td>" . htmlentities($rows['m_lname']) . "</td>";
echo "<td>" . htmlentities($rows['m_phonenumber']) . "</td>";
echo '<td><img src="../upload/' .
htmlentities($rows['m_profilepicture']) . '" width="70px" /></td>';
echo ('<td><a class="btn btn-outline-warning"
href="unblockm.php?mid=' . $rows['m_id'] . '">Unblock Monitor</a> </td> ');
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