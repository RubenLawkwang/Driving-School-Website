<?php 
//require_once "../db/emailpayentcon.php";
session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";

if (!isset($_SESSION['clientid'])) {
    header("Location: login.php");
    }
    $teid = $_GET["msid"];
    $stid = $_GET["dcid"];
    $mmid = $_GET["mid"];
    $monitorid = $_SESSION["clientid"];
    //////////////////////////
    $stmt1 = $pdo->prepare("SELECT * FROM message where c_id = :cid
    and dc_id = :teid");
    $stmt1->execute(
    array(
    ":cid" => $monitorid,
    ":teid" => $teid
    )
    );
    $srow1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $stmt = $pdo->prepare("SELECT * FROM drivingcourse where dc_id =
    :stid");
    $stmt->execute(array(":stid" => $_GET['dcid']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pic = htmlentities($row['dc_img']);
    if (isset($_POST['btnreserve'])) {
    $msg = validateReference();
    if (is_string($msg)) {
    $_SESSION['errormsg'] = $msg;
    header("refresh: 1");
    return;
    }
    $d = new DateTime('now');
    $d->setTimezone(new DateTimeZone('GMT+4'));
    $date = $d->format('Y-m-d H:i:s');
   $rec = $_POST["txtref"];
   $sql = "INSERT INTO payment (pay_date, ms_id, c_id, receipt, m_id, dc_id)
   VALUES ( :date, :msid, :cid, :rec, :mid, :dc)";
   $sql1 = "UPDATE message SET status = 2 WHERE ms_id = :msid";
$stmt2 = $pdo->prepare($sql1);
$stmt2->execute(
    array(
        ':msid' => $teid
        
    )
);
   $stmt2 = $pdo->prepare($sql);
   $stmt2->execute(
   array(
   ':msid' => $teid,
   ':date' => $date,
   ':rec' => $rec,
   ':cid' => $_SESSION['clientid'],
   ':mid' => $mmid,
   ':dc' => $stid
   )
   );
   $_SESSION['successmsg'] = "Payment successful";
   header("Location: viewrequest.php");
   return;
   }

   //sendEmailPay();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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



    <!-- Payment section-->
    <main>
        <div class="container my-5">
            <!-- ======= Breadcrumbs ======= -->
            <div class="breadcrumbs" data-aos="fade-in">
                <div class="container">
                    <h2>Proceed to your payment</h2>

                </div>
            </div>

            <!-- End Breadcrumbs -->
            <!-- ======= Trainers Section ======= -->
            <section id="trainers" class="trainers">
                <div class="container" data-aos="fade-up">
                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-md-5 pt-5">
                            <?php
echo '<p><img id="blah" class="zz_image img-fluid h50" src="../upload/' . $pic . '" /></p>';
?>
                        </div>
                        <div class="col-md-6 pt-5 offset-md-1">
                            <h3>
                                <?php
flashMessages();
?>
                            </h3>
                            <form id="frmreserve" method="post" enctype="multipart/form-data"
                                onsubmit="return validate();">
                                <div class="mb-3">
                                    <label for="txtstand" class="formlabel">Course title</label>
                                    <input type="text" class="form-control" name="txtstand" id="txtstand"
                                        readonly="true" value="<?= $row['dc_title']?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="txtprice" class="formlabel">Course Price (Rs.)</label>
                                    <input type="text" class="form-control" name="txtprice" id="txtprice"
                                        readonly="true" value="<?= $row['dc_price'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="txtlocation" class="formlabel">Car Transmission</label>
                                    <input type="text" class="form-control" name="txtlocation" id="txtlocation"
                                        readonly="true" value="<?=
$row['cartype'] ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="txtdesc" class="formlabel">Course Description</label>
                                    <textarea id="txtdesc" readonly="true" class="form-control"
                                        rows="4"><?= $row['dc_description'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="txtref" class="form-label">Juice
                                        reference number</label>
                                    <?php
if ($srow1 == true) {
?>
                                    <input type="text" class="form-control" name="txtref" id="txtref"
                                        value="<?= $srow1["receipt"] ?>" />
                                    <?php
} else {
echo '<input
type="text"
class="form-control"
name="txtref"
id="txtref"
/>';
}
?>
                                </div>

                                <form action="payment.php" method="GET">
                                    <input type="hidden" name="ms_id" value="<?php echo $teid ?>">
                                    <input type="hidden" name="dc_id" value="<?php echo $stid ?>">
                                    <input type="hidden" name="m_id" value="<?php echo $mmid ?>">
                                    <button type="submit" name="btnreserve"
                                        class="col-12 btn btn-primary btn-lg mx-auto">
                                        Make Payment
                                    </button>
                                </form>
                                <p></p>
                                <button type="submit" name="btncancel" class="col-12 btn btn-primary
btn-lg mx-auto">

                                    Cancel
                                </button>


                        </div>
                    </div>
                </div>
            </section>
            <!-- End Trainers Section -->
    </main>
    </div>
    <!-- end of payment-->


    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
    <script type="text/javascript">
    function validate() {
        var result = confirm("Do you want to proceed?");
        return result;
    }
    </script>
</body>

</html>