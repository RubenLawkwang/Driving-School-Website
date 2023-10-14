<?php session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";

//check if the session does not exist
checkUserAuth();


if (isset($_POST['btncancel'])) {
header('Location: index.php');
return;
}
//add sql to search for user details based on the session id
$stmt = $pdo->prepare("SELECT * from clients where c_id=:cid");
$stmt->execute(array(":cid" => $_SESSION["clientid"]));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

$pic = htmlentities($srow['c_profilepicture']);

//update profile

if (isset($_POST['btnupdate'])) {
   
    //add sql to check if the chosen email address is not taken up by OTHER
    //USERS
    $stmt2 = $pdo->prepare("SELECT * FROM clients
    where c_email = :em and c_id != :cid");
    $stmt2->execute(
    array(
    ":em" => $_POST['txtemail'],
    ':cid' => $_SESSION['clientid']
    )
    );
    
    $srow2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($srow2 === false) {
    //add the sql statement to update the client profile
    $sql = "UPDATE clients set c_fname =:fn, c_profilepicture=:filen, c_lname=:ln, 
     c_email=:email, c_username=:uname, c_phonenumber=:num where c_id=:cid";
    $filename = $_FILES['profilepic']['name'];
    $stmt3 = $pdo->prepare($sql);
    $stmt3->execute(
    array(
    ':fn' => $_POST['txtfname'],
    ':filen' => $filename,
    ':ln' => $_POST['txtlname'],
    ':email' => $_POST['txtemail'],
    ':uname' => $_POST['txtuname'],
    ':num' => $_POST['txtnum'],   
    ':cid' => $_SESSION['clientid']
    )
    );
    move_uploaded_file($_FILES["profilepic"]["tmp_name"], "../upload/" .
    $filename);
    $_SESSION['successmsg'] = "Profile Updated";
    header("Location: updateprofile.php");
    return;
   
    } else {
    $_SESSION['errormsg'] = "Email already exists!";
    }
    }

//end of update profile



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title></title>
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
    <div class="container-fluid my-5">
        <main>
            <!-- ======= Breadcrumbs ======= -->
            <div class="breadcrumbs" data-aos="fade-in">
                <div class="container">
                    <h2>Welcome to your profile</h2>
                    <p>Here you can customize your profile </p>

                </div>
            </div>
            <!-- End Breadcrumbs -->
            <!-- ======= Section ======= -->
            <section id="trainers" class="trainers">
                <div class="container" data-aos="fade-up">
                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col-md-5 pt-5 pl-5">

                            <?php
echo '<p><img id="blah" class="zz_image" src="../upload/' . $pic . '"
width="400px" /></p>';
?>
                        </div>
                        <div class="col-md-6 pt-5 offset-md-1">
                            <h3><?php flashMessages(); ?></h3>
                            <form id="frmsignup" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="txtfname" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="txtfname" id="txtfname"
                                        value="<?= $srow['c_fname'] ?>" />
                                </div>
                                <div class="mb-3">

                                    <label for="txtlname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="txtlname" id="txtlname"
                                        value="<?= $srow['c_lname'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="txtemail" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="txtemail" id="txtemail"
                                        value="<?= $srow['c_email'] ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="txtuname" class="form-label">User Name</label>
                                    <input type="text" class="form-control" name="txtuname" id="txtuname"
                                        value="<?= $srow['c_username'] ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="txtnum" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="txtnum" id="txtnum"
                                        value="<?= $srow['c_phonenumber'] ?>" />
                                </div>


                                <div class="mb-3">
                                    <label for="profilepic" class="form-label">Profile
                                        Picture</label>
                                    <input class="form-control form-control-lg" id="profilepic"
                                        onchange="readURL(this);" name="profilepic" type="file" />

                                </div>
                                <button type="submit" name="btnupdate" class="col-12 btn btn-success btn-lg mx-auto">
                                    Update Profile
                                </button>
                                <p></p>
                                <button type="submit" name="btncancel" class="col-12 btn btn-success btn-lg mx-auto">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->
        </main>
    </div>
    <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>


</html>