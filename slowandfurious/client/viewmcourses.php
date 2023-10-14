<?php session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";
if (!isset($_SESSION['clientid'])) {
    header("Location: ../client/login.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
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

if (isset($_GET['cid'])) {
    $monitorId = $_GET['cid'];
    
    // Prepare and execute the SQL query to retrieve monitor details by ID
    
    // Prepare and execute the SQL query to retrieve monitor details and category details by ID
     $stmt = $pdo->prepare("SELECT * FROM drivingcourse dc INNER JOIN category c
     ON dc.dc_id = c.dc_id WHERE dc.dc_id = :monitorId");
    $stmt->execute(array(":monitorId" => $monitorId));
    // Fetch the monitor details
    $monitor = $stmt->fetch(PDO::FETCH_ASSOC);

    
}

// If the monitor ID is not found or not provided, you can handle the situation accordingly (e.g., redirect to an error page)
// if (!$monitor) {
//     // Redirect to some error page or back to the list of monitors page
//     // header("Location: listmonitors.php");
//     // exit;
//     echo "Course not found!";
//     exit;
// }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>View Coruse</title>
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
                                <h1>Course Poster</h1>
                                <img src="<?php echo '../upload/' . htmlspecialchars($monitorId['dc_img']); ?>"
                                    alt="Course Poster">
                                <p><strong>Course Title:</strong> <?php echo htmlspecialchars($monitor['dc_title']); ?>
                                </p>
                                <p><strong>Price Rs:</strong> <?php echo htmlspecialchars($monitor['dc_price']); ?></p>
                                <p><strong>Course Description:</strong>
                                    <?php echo htmlspecialchars($monitor['dc_description']); ?></p>
                                <p><strong>Car:</strong> <?php echo htmlspecialchars($monitor['cars']); ?></p>
                                <p><strong>Car Gear:</strong> <?php echo htmlspecialchars($monitor['cartype']); ?></p>
                            </div>

                        </div>

                    </div>


                    <button type="button" class="btn btn-secondary">View the monitor course</button>
                    </a>
                </div>
            </div>


            <!-- start of footer-->
            <?php include_once("../php/footer.php") ?>
            <!-- end of footer-->
        </body>

    </html>