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
    <title>Login page</title>
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
    $stmt = $pdo->prepare('SELECT c.c_fname, m.messages, dc.dc_title AS dc_title, dc.dc_id, dc.dc_price, c.c_id, m.ms_id
                      FROM clients c
                      JOIN message m ON c.c_id = m.c_id
                      JOIN  drivingcourse dc ON dc.dc_id = m.dc_id
                      WHERE m.m_id = :mid');
    $stmt->execute(array(':mid' => $_SESSION["monitorid"]));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- end of login-->
    <?php foreach ($rows as $row) : ?>

        <div class="container my-5">
            <div class="card-body">
                <h3><?php flashMessages(); ?></h3>
                <h5 class="card-text">Course Title: <?php echo htmlentities($row['dc_title']); ?></h5>
                <h5 class="card-text">Course Title: <?php echo htmlentities($row['dc_price']); ?></h5>
                <p class="card-title">Client Name: <?php echo htmlentities($row['c_fname']); ?></p>
                <p class="card-title">Messages: <?php echo htmlentities($row['messages']); ?></p>
                <form action="rejectrequest.php" method="GET">
                    <input type="hidden" name="ms_id" value="<?php echo htmlspecialchars($row['ms_id']); ?>">
                    <input type="hidden" name="c_id" value="<?php echo htmlspecialchars($row['c_id']); ?>">
                    <input type="hidden" name="monitorid" value="<?php echo htmlspecialchars($_SESSION['monitorid']); ?>">
                    <button type="submit" name="dc_id" class="button" <?php echo htmlspecialchars($row['dc_id']); ?> style="vertical-align: middle"><span>Reject Request</span></button>

                </form>

            </div>

        </div>


    <?php endforeach; ?>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>