<?php 
session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";

////////////////
if (!isset($_SESSION['clientid'])) {
    header("Location: regiser.php");
    exit; // Ensure the script stops execution after redirecting
}
//date_default_timezone_set
$d = new DateTime('now');
$d->setTimezone(new DateTimeZone('GMT+4'));
////////////////////////////////
$monitorID = $_GET['m_id'] ?? '';
$dcourseID = $_GET['dc_id'] ?? '';
$datemess = $d->format('Y-m-d');
/////////////////////////////
if (isset($_POST['btnsignup'])) {
    $message = $_POST['txtmessage'];
    $monitorID = $_POST['m_id'];
    $dcourseID = $_POST['dc_id'];
    $client_id = $_SESSION['clientid'];
     
//add the sql insert to register user
$stmt = $pdo->prepare("SELECT * FROM message WHERE c_id = :clientid AND dc_id = :courseid");

  $stmt->execute(
    array(
      ":clientid" => $_SESSION["clientid"],
      ":courseid" => $_GET["dc_id"]
    ));

    $srow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($srow === false){
    $sql = "insert into message (m_id, c_id, messages, dc_id, ms_date, status) 
    values (:mid, :cid, :mess, :did, :datenow, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt -> bindParam(':cid', $client_id);
    $stmt -> bindParam(':mid', $monitorID);
    $stmt -> bindParam(':did', $dcourseID);
    $stmt -> bindParam(':mess', $message);
    $stmt -> bindParam(':datenow', $datemess);
    $stmt->execute();
    $_SESSION['successmsg'] = 'Message send successfully to Monitor';
    header('Location: messagem.php');
    return;

    }
    else {
        $_SESSION['errormsg'] = 'You cannot send more than one request';
    }
}

    // end of registration


    
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


    <div class="container my-5">
        <h3><?php flashMessages(); ?></h3>
        <!-- form section-->
        <form id="frmadd" class="row g-3" method="post" enctype="multipart/form-data">


            <div style="text-align: center;  display: flex; align-items: center; justify-content: center;">
                <img src="../image/sub.png" alt="Submit a request" width="width-value" height="height-value"
                    style="vertical-align: middle;">
            </div>


            <h2 class="my-3 text-center">Send a essage request monitor</h2>

            <div class="col-md-6" style="display:none;">
                <label for="dc_id">Course ID:</label>
                <input type="text" name="dc_id" id="dc_id" value="<?php echo $dcourseID; ?>" readonly
                    class="form-control">
            </div>

            <div class="col-md-6" style="display:none;">
                <label for="m_id">Monitor ID:</label>
                <input type="text" name="m_id" id="m_id" value="<?php echo $monitorID; ?>" readonly
                    class="form-control">
            </div>

            <div class="col-12">
                <label for="txtmessage" class="form-label">Message</label>
                <textarea class="form-control" id="txtmessage" name="txtmessage" rows="4"></textarea>
            </div>

            <div class="col-12">
                <button type="submit" name="btnsignup" class="btn btn-primary btn-lg">Send message request</button>
            </div>
        </form>
        <!-- end of form-->
    </div>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>