<?php 
session_start();
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
    $MonitorsID = $_GET['id'];

    // Prepare and execute the SQL query to retrieve monitor details by ID
    $stmt = $pdo->prepare("SELECT * FROM monitors 
     WHERE m_id = :clientId");
    $stmt->bindValue(':clientId',$MonitorsID,PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the monitor details
    $monitors = $stmt->fetch(PDO::FETCH_ASSOC);
}

// If the monitor ID is not found or not provided, you can handle the situation accordingly (e.g., redirect to an error page)
if (!$monitors) {
    // Redirect to some error page or back to the list of monitors page
    // header("Location: listmonitors.php");
    // exit;
    echo "Monitors not found!";
    exit;
}




     $monitorID = $_GET['id'];
     $client_id = $_SESSION['clientid'];
     if (isset($_POST['btnsignup'])) {

    //later we will insert the record
    //add the sql insert to register user
     $stmt = $pdo->prepare("SELECT * FROM recommendation WHERE c_id = :clientid AND m_id = :courseid");
     $message = $_POST['txtcomment'];
     $stmt->execute(
     array(
     ":clientid" => $_SESSION["clientid"],
     ":courseid" => $_GET["id"]
     ));
     $srow = $stmt->fetch(PDO::FETCH_ASSOC);
     if ($srow === false){
     $sql = "insert into recommendation (comments, c_id, m_id, r_status)
     values (:comments, :cid, :mid, 1)";
     $stmt = $pdo->prepare($sql);
     $stmt -> bindParam(':cid', $client_id);
     $stmt -> bindParam(':mid', $monitorID);
     $stmt -> bindParam(':comments', $message);
     $stmt->execute();
   
     }


     }

?>





    <!DOCTYPE html>
    <html>

    <head>
        <title>View Monitor Profile</title>
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
                                <h3><?php flashMessages(); ?></h3>
                                <h1>Monitor Profile</h1>
                                <img src="<?php echo '../upload/' . htmlentities($monitors['m_profilepicture']); ?>"
                                    alt="Monitor Profile Picture">
                                <p><strong>First Name:</strong> <?php echo htmlentities($monitors['m_fname']); ?></p>
                                <p><strong>Last Name:</strong> <?php echo htmlentities($monitors['m_lname']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlentities($monitors['m_email']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlentities($monitors['m_address']); ?></p>
                                <p><strong>Year of Experience:</strong>
                                    <?php echo htmlentities($monitors['m_experience']); ?>
                                </p>
                            </div>

                            <div class="col-6 mt-5">
                                <label>Monitor Teaching Certification</label>
                                <embed src="../upload/<?php echo htmlentities($monitors['m_certification']); ?>"
                                    type="application/pdf" width="100%" height="300px" />
                            </div>
                        </div>

                    </div>
                    <form id="frmadd" class="row g-3" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="txtcomment" class="form-label">Leavue a review</label>
                            <textarea class="form-control" id="txtcomment" name="txtcomment" rows="4"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" name="btnsignup" class="btn btn-primary btn-lg">Leave a
                                review</button>
                        </div>
                    </form>

                    </a>
                </div>
            </div>



            <!-- start of footer-->
            <?php include_once("../php/footer.php") ?>
            <!-- end of footer-->
        </body>

    </html>