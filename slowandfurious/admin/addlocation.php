<?php
require_once "../db/pdo.php";
require "../db/util.php";
session_start();

// date_default_timezone_set
$d = new DateTime('now');
$d->setTimezone(new DateTimeZone('GMT+4'));
$date = $d->format('Y-m-d');

if (isset($_POST['btncancel'])) {
    header('Location: adminhome.php');
    return;
}

// Add a name to the button
if (isset($_POST['btnaddevent'])) {
    $msg = validateEventName();
    if (is_string($msg) || is_string($msg2)) {
        $_SESSION['error'] = $msg . " " . $msg2;
        header("Location: addlocation.php");
        return;
    }

    // Check if the location already exists
    $locname = $_POST['locname'];
    $sql_check = "SELECT COUNT(*) FROM location WHERE loc_district = :loc";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(array(':loc' => $locname));
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        $_SESSION['errormsg'] = "Location already exists.";
        header("Location: addlocation.php");
        return;
    }

    // Add the insert statement
    $sql_insert = "INSERT INTO location (loc_district) VALUES (:loc)";
    $stmt_insert = $pdo->prepare($sql_insert);

    // Add codes to retrieve the form values
    $stmt_insert->execute(array(':loc' => $_POST['locname']));

    $_SESSION["successmsg"] = "Location added";
    header('Location: addlocation.php');
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
                        <h2 class="mt-3">Location</h2>
                        <div class="col-md-6 pt-5">
                            <div class="mb-3">
                                <label for="locname" class="form-label">District Name</label>
                                <input type="text" class="form-control" name="locname" id="locname" />
                            </div>


                        </div>



                        </select>
            </div>

        </div>
        <button type="submit" name="btnaddevent" class="col-12 btn btn-primary btn-lg mx-auto">
            Add Location
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