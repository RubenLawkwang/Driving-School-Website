<?php 
require_once "../db/emailconfig.php";
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();


// start of registration
if (isset($_POST['btnsignup'])) {
    $msg = validateFirstName();
    $msg2 = validateFileProfilePic();
    $msg3 = validateEmail();
    $msg4 = validatePass();
    if (is_string($msg) || is_string($msg2) || is_string($msg3) || is_string($msg4)) {
    $_SESSION['errormsg'] = $msg . " " . $msg2 . " " .$msg3 . " " .$msg4;
    header("Location: regiser.php");
    return;
    }
    //Check if email address already exists in database
    //add sql to search table client by email
    $stmt = $pdo->prepare("select * from clients where c_email=:em");
    //retrieve txtemail value
    $stmt->execute(array(":em" => $_POST["txtemail"] ));
    $srow = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($srow === false) {
    //later we will insert the record
    $check = hash('md5', $_POST['txtpass']);
    //add the sql insert to register user
    $sql = "insert into clients (c_fname, c_lname, c_address, c_email, c_password, c_dob,
    c_username, c_learner, 
    c_phonenumber, c_profilepicture, loc_id) 
    values (:fn, :ln, :address, :email, :password, :dob, :username, :learner, :pnumber, :filen, :loc) ";
    $filename = $_FILES['profilepic']['name'];
    $filelearner = $_FILES['learner']['name'];
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
    array(
    ':fn' => $_POST['txtfname'],
    ':filen' => $filename,
    ':ln' => $_POST['txtlname'],
    ':email' => $_POST['txtemail'],
    ':password' => $check,
    ':address' => $_POST['txtaddress'],
    ':dob' => $_POST['txtdob'],
    ':username' => $_POST['txtuname'],
    ':learner' => $filelearner,
    ':pnumber' => $_POST['txtnumber'],
    ':loc' => $_POST['ddlevst']

    )
    );
    
    move_uploaded_file($_FILES["profilepic"]["tmp_name"], "../upload/" .
    $filename);
    move_uploaded_file($_FILES["learner"]["tmp_name"], "../upload/" .
    $filelearner);
    sendEmail();
     //endEmail();
    header("refresh:3, url=login.php");
    
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


    <!--  start of registration section-->

    <div class="container-fluid" style="background-color: #002a77">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <h3><?php flashMessages(); ?></h3>
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                        Customer Sign up
                                    </p>

                                    <form class="mx-1 mx-md-4" method="post" action="./regiser.php"
                                        enctype="multipart/form-data">
                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtfname" name="txtfname" class="form-control" />
                                                <label class="form-label" for="txtfname">First Name</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtlname" name="txtlname" class="form-control" />
                                                <label class="form-label" for="txtlname">Last Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="date" id="txtdob" name="txtdob" class="form-control" />
                                                <label class="form-label" for="txtdob">DOB</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtuname" name="txtuname" class="form-control" />
                                                <label class="form-label" for="txtuname">Username</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtemail" name="txtemail" class="form-control" />
                                                <label class="form-label" for="txtemail">Email</label>
                                            </div>
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
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtnumber" name="txtnumber"
                                                    class="form-control" />
                                                <label class="form-label" for="form3Example3c">Phone Number</label>
                                            </div>
                                        </div>




                                        <!-- start of upload Profile pic-->
                                        <div class="my-4">
                                            <label class="form-label" for="profilepic">Upload Your Profile
                                                Picture</label>
                                            <input type="file" class="form-control" id="profilepic" name="profilepic" />
                                        </div>
                                        <!-- end of upload profile pic-->

                                        <!-- upload learner -->
                                        <div class="my-4">
                                            <label class="form-label" for="learner">Upload Your learner</label>
                                            <input type="file" class="form-control" id="learner" name="learner" />
                                        </div>

                                        <!-- end of upload learner -->

                                        <!-- start of district-->
                                        <div class="mb-3">
                                            <select id="ddlevst" name="ddlevst" class="form-select form-select-md mb-3"
                                                aria-label=".form-select-lg example">
                                                <option>Chose your district</option>
                                                <?php
//add sql to search tbleventstatus and display event in ascending order
$sql1 = $pdo->query("select * from location");
foreach ($sql1 as $row) {
//assign the id and name attribute to the option tag
echo "<option value='" . $row['loc_id'] . "'>" . $row['loc_district'] .
"</option>";
}
?>
                                            </select>
                                        </div>

                                        <!-- end of district-->

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtaddress" name="txtaddress"
                                                    class="form-control" />
                                                <label class="form-label" for="txtaddress">Address</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="form2Example3c" />
                                            <label class="form-check-label" for="form2Example3">
                                                Remember Me
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="btnsignup" class="btn btn-primary btn-lg">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="../image/9.jpg" class="img-fluid" alt="Sample image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of register-->


    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>