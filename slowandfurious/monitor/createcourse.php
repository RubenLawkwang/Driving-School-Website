<?php
require_once "../db/pdo.php";
require "../db/util.php";
session_start();

if (isset($_POST['btncancel'])) {
    header('Location: createcourse.php');
    return;
}

if (isset($_POST['btnaddevent'])) {
    $msg = validateCourse();
    if (is_string($msg)) {
        $_SESSION['error'] = $msg;
        header("Location: createcourse.php");
        return;
    }
///////////////
//$teid = isset($_GET["dc_id"])? $_GET['dc_id'] : null;
///////////////
//$edor = isset($_GET["m_id"])? $_GET['m_id'] : null;
//////////////
            //////////////////////////////////////////
            $stmt2 = $pdo->prepare("SELECT * FROM drivingcourse WHERE m_id = :mid AND dc_status = 1");
            $stmt2->execute(array(':mid' => $_SESSION['monitorid']));
            
            $srow = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($srow === false) {
/////////////////////////////
    // Insert the course details into the 'drivingcourse' table
    $sql = "INSERT INTO drivingcourse (dc_title, dc_price, dc_description, cartype, m_id, dc_img, cat_id) 
            VALUES (:title, :price, :desc, :ctype, :mid, :img, :cat)";

    $filename = $_FILES['dc_pic']['name'];
    $stmt = $pdo->prepare($sql);
    
    // Sanitize and validate the form inputs before using them in the SQL query
    $title = $_POST['txttitle'];
    $price = $_POST['txtprice'];
    $desc = $_POST['txtdesc'];
    $cat = $_POST['cartyp'];
    $ctype = $_POST['txttransmission'];
    $mid = $_SESSION['monitorid'];


    $stmt->execute(array(
        ':title' => $title,
        ':price' => $price,
        ':desc' => $desc,
        ':ctype' => $ctype,
        ':mid' => $mid,
        ':img' => $filename,
        ':cat' => $cat
    ));

    move_uploaded_file($_FILES["dc_pic"]["tmp_name"], "../upload/" .
    $filename);

    $_SESSION["successmsg"] = "Course created successfully!";
    header('Location: createcourse.php');
    return;
    /////////////////
} 
else {
    // A course already exists for this monitor, display error message
    $_SESSION['errormsg'] = "Only one course can be added!";
    //header('Location: createcourse.php');
    //return;
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <?php include_once("../php/csslinks.php");
    include_once("../php/jslinks.php")
    ?>
</head>

<body>
    <!--start of navbar -->
    <header>
        <?php include_once("../php/header.php") ?>
    </header>
    <!-- end of navbar -->

    <section class="container my-5">
        <h1>Only one course can be added by monitor</h1>
        <div class="container-fluid mt-5">
            <div class="row">
                <main class="col-md-7 offset-md-1 py-5">
                    <h3><?php flashMessages(); ?></h3>
                    <form id="frmadd" class="row" method="post" enctype="multipart/form-data">
                        <h2 class="mt-3">Add course</h2>
                        <div class="col-md-6 pt-5">
                            <div class="mb-3">
                                <label for="txttitle" class="form-label">Course Title</label>
                                <input type="text" class="form-control" name="txttitle" id="txttitle" />
                            </div>
                            <div class="mb-3">
                                <label for="txtdesc" class="form-label">Course Description</label>
                                <textarea class="form-control" id="txtdesc" name="txtdesc"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="txtprice" class="form-label">Course Price</label>
                                <input type="text" class="form-control" id="txtprice" name="txtprice" />
                            </div>
                        </div>
                        <div class="col-md-6 pt-5">
                            <!-- car photo -->
                            <div class="my-4">
                                <label class="form-label" for="dc_pic">Upload Your Course Cover
                                    Picture</label>
                                <input type="file" class="form-control" id="dc_pic" name="dc_pic" />
                            </div>
                            <!-- end of car photo -->
                            <div class="mb-3">
                                <label for="txttransmission" class="form-label">Car Transmission</label>
                                <input type="text" class="form-control" name="txttransmission" id="txttransmission" />
                            </div>

                            <div class="mb-3">
                                <label>Choose a Car model</label>
                                <select id="cartyp" name="cartyp" class="form-select form-select-md mb-3"
                                    aria-label=".form-select-lg example">
                                    <option>Select car</option>
                                    <?php
                                    $sql2 = $pdo->query("SELECT cat_id, cars FROM category");
                                    foreach ($sql2 as $row) {
                                        echo "<option value='" . $row['cat_id'] . "'>" . $row['cars'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" name="btnaddevent" class="col-12 btn btn-primary btn-lg mx-auto">
                                Add Course
                            </button>
                            <p></p>
                            <button type="submit" name="btncancel" class="col-12 btn btn-primary btn-lg mx-auto">
                                Cancel
                            </button>
                    </form>
                </main>
            </div>
        </div>
    </section>

    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>