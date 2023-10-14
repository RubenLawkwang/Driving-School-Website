<?php
require_once "../db/emailmonitor.php";
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();

// start of registration
if (isset($_POST['btnsignup'])) {
    $msg = validateFirstName();
    $msg1 = validateFirstName();
    $msg2 = validateEmail();
    $msg3 = validatePass();


    if (is_string($msg) || is_string($msg2) || is_string($msg3)) {
        $_SESSION['errormsg'] = $msg . " " . $msg2 . " " . $msg3;
        header("Location: mregister.php");
        return;
    }
    //Check if email address already exists in database
    //add sql to search table client by email
    $stmt = $pdo->prepare("select * from monitors where m_email=:em");
    //retrieve txtemail value
    $stmt->execute(array(":em" => $_POST["txtemail"]));
    $srow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($srow === false) {
        //later we will insert the record
        $check = hash('md5', $_POST['txtpass']);
        //add the sql insert to register user
        $sql = "insert into monitors (m_fname, m_lname, m_address, m_email, m_password, m_dob, 
    m_certification, 
    m_phonenumber, m_profilepicture, loc_id, m_experience) 
    values (:fn, :ln, :address, :email, :password, :dob, :certification, :pnumber, :filen, :loc, :experience) ";
        $filename = $_FILES['mprofile']['name'];
        $filecertfi = $_FILES['mcertification']['name'];
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
                ':certification' => $filecertfi,
                ':pnumber' => $_POST['txtnumber'],
                ':experience' => $_POST['txtexp'],
                ':loc' => $_POST['ddlevst']

            )
        );

        move_uploaded_file($_FILES["mprofile"]["tmp_name"], "../upload/" .
            $filename);
        move_uploaded_file($_FILES["mcertification"]["tmp_name"], "../upload/" .
            $filecertfi);
        sendEmail();
        header("refresh:3, url=mlogin.php");
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
    <title>Monitor Registration</title>

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

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Monitor Registration</p>

                                    <form class="mx-1 mx-md-4" method="post" action="mregister.php" enctype="multipart/form-data">
                                        <h3><?php flashMessages(); ?></h3>
                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="txtfname" name="txtfname" class="form-control" />
                                                <label class="form-label" for="txtfname">First Name</label>
                                            </div>
                                        </div>

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txtlname" name="txtlname" class="form-control" />
                                            <label class="form-label" for="txtlname">Last Name</label>
                                        </div>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="txtemail" name="txtemail" class="form-control" />
                                            <label class="form-label" for="txtemail">Your Email</label>
                                        </div>




                                        <div class="form-outline flex-fill mb-0">
                                            <input type="date" id="txtdob" name="txtdob" class="form-control" />
                                            <label class="form-label" for="txtdob">Date Of Birth</label>
                                        </div>



                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txtnumber" name="txtnumber" class="form-control" />
                                            <label class="form-label" for="form3Example3c">Phone Number</label>
                                        </div>




                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txtaddress" name="txtaddress" class="form-control" />
                                            <label class="form-label" for="txtaddress">Address</label>
                                        </div>



                                        <div class="mb-3">
                                            <select id="ddlevst" name="ddlevst" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
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


                                        <!-- start of upload Profile pic-->
                                        <div class="my-4">
                                            <label class="form-label" for="mprofile">Upload Your Profile
                                                Picture</label>
                                            <input type="file" class="form-control" id="mprofile" name="mprofile" />
                                        </div>
                                        <!-- end of upload profile pic-->

                                        <!-- upload learner -->
                                        <div class="my-4">
                                            <label class="form-label" for="mcertification">Upload Your Teaching
                                                Certification</label>
                                            <input type="file" class="form-control" id="mcertification" name="mcertification" />
                                        </div>

                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="txtexp" name="txtexp" class="form-control" />
                                            <label class="form-label" for="txtexp">Years of experience</label>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="txtpass" name="txtpass" class="form-control" />
                                                <label class="form-label" for="txtpass">Password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="txtcpass" name="txtcpass" class="form-control" />
                                                <label class="form-label" for="txtcpass">Repeat your
                                                    password</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="btnsignup" class="btn btn-primary btn-lg">Register</button>
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