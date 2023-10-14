<?php session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";
if (!isset($_SESSION['monitorid'])) {
    header("Location: ../monitor/mlogin.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitors Details</title>
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


    <!-- display profile picture -->
    <?php 

if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // Prepare and execute the SQL query to retrieve monitor details by ID
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE c_id = :clientId");
    $stmt->bindValue(':clientId',$clientId,PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the monitor details
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

// If the monitor ID is not found or not provided, you can handle the situation accordingly (e.g., redirect to an error page)
if (!$client) {
    // Redirect to some error page or back to the list of monitors page
    // header("Location: listmonitors.php");
    // exit;
    echo "client not found!";
    exit;
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>View Client Profile</title>
        <!-- Add your CSS styling or use a separate CSS file -->
    </head>

    <body>
        </head>

        <body>
            <div class="container my-5">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <h1>Client Profile</h1>
                                <img src="<?php echo '../upload/' . htmlentities($client['c_profilepicture']); ?>"
                                    alt="Monitor Profile Picture">
                                <p><strong>First Name:</strong> <?php echo htmlentities($client['c_fname']); ?></p>
                                <p><strong>Last Name:</strong> <?php echo htmlentities($client['c_lname']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlentities($client['c_email']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlentities($client['c_address']); ?></p>
                            </div>

                            <div class="col-6 mt-5">
                                <label>Client's Learner</label>
                                <embed src="../upload/<?php echo htmlentities($client['c_learner']); ?>"
                                    type="application/pdf" width="100%" height="300px" />
                            </div>
                        </div>

                    </div>


                    </a>
                </div>
            </div>



            <!-- start of footer-->
            <?php include_once("../php/footer.php") ?>
            <!-- end of footer-->
        </body>

    </html>