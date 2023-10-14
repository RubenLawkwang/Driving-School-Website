<?php 
session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Recieve</title>
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



    <!-- login section-->
    <?php
$stmt = $pdo->prepare('SELECT * FROM payment 
INNER JOIN clients ON payment.c_id = clients.c_id  
INNER JOIN drivingcourse ON payment.dc_id = drivingcourse.dc_id 
WHERE payment.m_id = :mid');
$stmt->execute(array(':mid' => $_SESSION["monitorid"]));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <!-- end of login-->
    <?php foreach ($rows as $row): ?>

    <div class="container my-5">
        <div class="card-body">
            <h3><?php flashMessages(); ?></h3>
            <h1 class="text-center">Payment Recieve <h1>
                    <h5 class="card-text">Course Title: <?php echo htmlentities($row['dc_title']); ?></h5>
                    <h5 class="card-text">Client Name: <?php echo htmlentities($row['c_fname']); ?></h5>
                    <h5 class="card-text">Course Price: <?php echo htmlentities($row['dc_price']); ?></h5>
                    <h5 class="card-text">Payment Date: <?php echo htmlentities($row['pay_date']); ?></h5>
                    <h5 class="card-text">Payment Reference Number: <?php echo htmlentities($row['receipt']); ?></h5>

        </div>

    </div>


    <?php endforeach; ?>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>