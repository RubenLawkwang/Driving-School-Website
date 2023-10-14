<?php
require_once "../db/pdo.php";
require "../db/util.php";
session_start();

// date_default_timezone_set
if (isset($_POST['btncancel'])) {
    header('Location: adminhome.php');
    return;
}

// Add a name to the button
if (isset($_POST['btnaddevent'])) {
    // Validate category name
    $msg = validatecategoryname();
    if (!is_null($msg)) {
        $_SESSION['errormsg'] = $msg;
        header("Location: createcaegory.php");
        return;
    }

    // Check for duplicate category
    $msg = valiDupliCategory($pdo);
    if (!empty($msg)) {
        $_SESSION['errormsg'] = $msg;
        header("Location: createcaegory.php");
        return;
    }

    // Add the insert statement
    $sql = "INSERT INTO category (cars) VALUES (:car)";
    $stmt = $pdo->prepare($sql);

    // Add codes to retrieve the form values
    $stmt->execute(array(':car' => $_POST['transminame']));

    $_SESSION["successmsg"] = "Car added";
    header('Location: createcaegory.php');
    return;
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
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/adminhead.php")
        ?>
        <!-- end of navbar-->
    </header>

    <section class="container">
        <div class="container-fluid mt-5">
            <div class="row">
                <main class="col-md-7 offset-md-1 py-5">

                    <h3><?php flashMessages(); ?></h3>

                    <form id="frmadd" class="row" method="post" enctype="multipart/form-data">
                        <h2 class="mt-3">Add a cars</h2>
                        <div class="col-md-6 pt-5">
                            <div class="mb-3">
                                <label for="transminame" class="form-label">Add a car</label>
                                <input type="text" class="form-control" name="transminame" id="transminame" />
                            </div>


                        </div>



                        </select>
            </div>

        </div>
        <button type="submit" name="btnaddevent" class="col-12 btn btn-primary btn-lg mx-auto">
            Add Transmisson
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