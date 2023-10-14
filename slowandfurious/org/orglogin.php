<?php 
session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";


//check to see if the session exists
if (isset($_SESSION["clientid"]) ) {
header("Location: ../client/index.php");
}


if (isset($_POST['btnlogin']) && isset($_POST["txtemail"]) &&
isset($_POST["txtpass"])
) {
    
// delete any previously defined session variable
unset($_SESSION["email"]);
$msg = validateEmail();
$msg2 = validatePass();

if (is_string($msg) || is_string($msg2)) {
$_SESSION['errormsg'] = "$msg <br/> $msg2";
header('Location: orglogin.php');
return;
} else {
    
//encrypt password
$check = hash('md5',$_POST['txtpass']);
//add a where clause to check whether there is a matching email and password
$stmt = $pdo->prepare('SELECT or_id, or_name FROM organisation
where or_email=:em and or_password=:pw and or_status=1');
$stmt->execute(array(':em' => $_POST['txtemail'], ':pw' => $check));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


if ($row !== false) {
$_SESSION["successmsg"] = "Logged in.";
//create two more session variables fn and cid
$_SESSION["fn"] = $row["or_name"];

//to store the first name and client_id
$_SESSION["organisationid"] = $row["or_id"];

//redirect user to updateprofile
header("Location: ../client/index.php");
//send error messages to apache log file
error_log("Login successful for " . $_POST['txtemail']);
return;
} else {
$_SESSION["errormsg"] = "Incorrect credentials, please try again!";
header('Location: orglogin.php');
//send error messages to apache log file
error_log("Login failed " . $_POST['txtemail'] . " $check");
return;
}
}
}


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
    <div class="container-fluid"
        style="background: radial-gradient(circle, rgba(78,47,60,1) 0%, rgba(18,36,57,1) 100%);">
        <div class="container">
            <section class="">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong" style="border-radius: 1rem">
                                <div class="card-body p-5 text-center">
                                    <h3><?php flashMessages(); ?> </h3>
                                    <h3 class="mb-5">Organisation login</h3>
                                    <form id="frmlogin" method="post" enctype="multipart/form-data">
                                        <div class="form-outline mb-4">
                                            <input type="email" id="txtemail-2" name="txtemail"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="txtemail">Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="txtpass" name="txtpass"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="txtpass">Password</label>
                                        </div>

                                        <!-- Checkbox -->
                                        <div class="form-check d-flex justify-content-start mb-4">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="form1Example3" />
                                            <label class="form-check-label" for="form1Example3">
                                                Remember password
                                            </label>
                                        </div>

                                        <button type="submit" name="btnlogin" class="btn btn-primary btn-lg btn-block">
                                            Login
                                        </button>

                                        <hr class="my-4" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end of login-->


    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>