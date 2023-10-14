<?php
require_once "../db/emailconfig.php";
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();

// start of registration
if (isset($_POST['btnsignup'])) {
    $msg = validateOrgName();
    $msg1 = validateOrgEmail();
    $msg2 = validateOrgAddress();
    $msg3 = validateOrgPassword();

    if (is_string($msg) || is_string($msg1) || is_string($msg2) || is_string($msg3)) {
        $_SESSION['errormsg'] = $msg . " " . $msg1 . " " .$msg2 . " " .$msg3;
        header("Location: orgregister.php");
        return;
    }

    
    // //if (is_string($msg)) {
    // $_SESSION['errormsg'] = $msg;
    // header("Location: orgregister.php");
    // return;
    // }
    //Check if email address already exists in database
    //add sql to search table client by email
    $stmt = $pdo->prepare("select * from organisation where or_email=:em");
    //retrieve txtemail value
    $stmt->execute(array(":em" => $_POST["txtemail"] ));
    $srow = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($srow === false) {
    //later we will insert the record
    $check = hash('md5', $_POST['txtpass']);
    //add the sql insert to register user
    $sql = "insert into organisation (or_name, or_address, or_email, or_password) 
    values (:name, :address, :email, :password) ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
    array(
    ':name' => $_POST['txtname'],
    ':address' => $_POST['txtaddress'],
    ':email' => $_POST['txtemail'],
    ':password' => $check
    )
    );
    
     //sendEmailOrg();
    header("refresh:3, url=orglogin.php");
    
    } else {
    $_SESSION['errormsg'] = "Email already exists!";
    }
    }
    
    // end of registration
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisation Registration</title>

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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Organisation Registration
                                    </p>

                                    <form class="mx-1 mx-md-4" method="post" action="orgregister.php"
                                        enctype="multipart/form-data">
                                        <h3><?php flashMessages(); ?></h3>
                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtname" name="txtname" class="form-control" />
                                                <label class="form-label" for="txtname">Organisation Name</label>
                                            </div>
                                        </div>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="txtemail" name="txtemail" class="form-control" />
                                            <label class="form-label" for="txtemail">Organisation Email</label>
                                        </div>

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txtaddress" name="txtaddress" class="form-control" />
                                            <label class="form-label" for="txtaddress">Organisation Address</label>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="txtpass" name="txtpass"
                                                    class="form-control" />
                                                <label class="form-label" for="txtpass">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="txtcpass" name="txtcpass"
                                                    class="form-control" />
                                                <label class="form-label" for="txtcpass">Repeat your
                                                    password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="btnsignup"
                                                class="btn btn-primary btn-lg">Register</button>
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