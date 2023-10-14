<?php
session_start(); 
require_once "../db/pdo.php";
require_once "../db/util.php";

//date_default_timezone_set
if (!isset($_SESSION['organisationid'])) {
    header("Location: orgregister.php");
    exit; // Ensure the script stops execution after redirecting
}
//Add a name to the button
if (isset($_POST['btnsignup'])) {
    $msg2 = validateimage();
    $msg3 = validateurl();
    $orgid = $_SESSION['organisationid'];

    if (is_string($msg2) || is_string($msg3)) {
        $_SESSION['errormsg'] = $msg . "</br>" . $msg2 . "</br>" . $msg3 . "</br>" . $msg4 . "</br>" . $msg6;      header("Location: adsform.php");
      return;
    }
//add the insert statement
$sql = "INSERT INTO advertform (ad_img, websiteurl, status, or_id) VALUES (:post, :eurl, 0, :adsid)";
$filename = $_FILES['profilepic']['name'];
$stmt = $pdo->prepare($sql);
//add codes to retrieve the form values
$stmt->execute(
array(
':post' => $filename,
':eurl' => $_POST['txturl'],
':adsid' => $orgid

)
);

move_uploaded_file($_FILES["profilepic"]["tmp_name"], "../upload/" .
$filename);

$_SESSION["successmsg"] = "Advertistment Added";
header('Location: adsform.php');
return;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register your advertistment</title>

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




    <section class="container-fluid my-5">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Submit your advertisment
                                    </p>

                                    <form class="mx-1 mx-md-4" method="post" action="adsform.php"
                                        enctype="multipart/form-data">
                                        <h3><?php flashMessages(); ?></h3>

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txturl" name="txturl" class="form-control" />
                                            <label class="form-label" for="txturl">Website Url</label>
                                        </div>

                                        <div class="my-4">
                                            <label class="form-label" for="profilepic">Upload Your ads</label>
                                            <input type="file" class="form-control" id="profilepic" name="profilepic" />
                                        </div>


                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="submit" name="btnsignup"
                                                    class="btn btn-primary btn-lg">Submit your ads</button>
                                            </div>
                                        </div>


                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>