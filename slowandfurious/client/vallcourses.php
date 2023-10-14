<?php 
session_start();
require_once "../db/pdo.php";
require_once "../db/util.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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

    <!-- start of section -->
    <section class=" container-fluid">
        <div style="text-align: center;">
            <h3
                style="font-size: 24px; font-weight: bold; color: #333; border-bottom: 2px solid #333; padding-bottom: 10px;">
                As a user, you can view all the courses that our monitors have posted.
                To request a course, you should first create an account.
            </h3>
        </div>

        <div class="card-group my-5 py-5" style="width: 500px; height: 300;">
            <?php 
$stmt = $pdo->query("SELECT d.dc_title, d.dc_price, d.dc_description,
d.cat_id, d.cartype, d.dc_img, c.cars, d.dc_id, d.m_id, m.m_fname, m.m_lname, m.m_id 
FROM drivingcourse d 
JOIN category c ON d.cat_id = c.cat_id 
JOIN monitors m ON d.m_id = m.m_id");

 $stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $title = htmlentities($row['dc_title']);
    $price = htmlentities($row['dc_price']);
    $desc = htmlentities($row['dc_description']);
    $cartype = htmlentities($row['cartype']);
    $img = htmlentities($row['dc_img']);
    $cars = htmlentities($row['cars']);
    $monitorn = htmlentities($row['m_fname']);
    $monitorl = htmlentities($row['m_lname']);
    $monitorID = htmlentities($row['m_id']);
    $dcourseID = htmlentities($row['dc_id']);



    ?>

            <div class="card">

                <img src="../upload/<?php echo $img; ?>" class="card-img-top" style="max-height: 500px;"
                    alt="work image">

                <div class="card-body">
                    <label>Course Tile</label>
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <label>Course Price</label>
                    <h5 class="card-title">Rs<?php echo $price; ?></h5>
                    <label>Course Descriotion </label>
                    <p class="card-text"><?php echo $desc; ?></p>
                    <label>Car Transmission </label>
                    <p class="card-text"><?php echo $cartype; ?></p>
                    <label>Model of Car</label>
                    <p class="card-text"><?php echo $cars; ?></p>
                    <label>Monitor name</label>
                    <p class="card-text"><?php echo $monitorn . ". " . $monitorl; ?></p>


                    <form action="messagem.php" method="GET">
                        <input type="hidden" name="dc_id" value="<?php echo $dcourseID; ?>">
                        <input type="hidden" name="m_id" value="<?php echo $monitorID; ?>">
                        <button type="submit" class="button" style="vertical-align: middle"><span>Messsage
                                Monitor</span></button>
                    </form>

                </div>
            </div>




            <?php
}


?>
        </div>
    </section>
    <!-- end of section -->




    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>