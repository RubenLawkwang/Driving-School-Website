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

    <div class="card-group my-5 py-5" style="width: 500px; height: 300;">
        <?php
        
        $messageid = $_GET['ms_id'] ?? '';
        $drivingcourseid = $_GET['dc_id'] ?? '';
        $clientid = $_SESSION['clientid']; 
    
$stmt = $pdo->query("SELECT * FROM message INNER JOIN drivingcourse 
ON message.dc_id = drivingcourse.dc_id INNER JOIN clients ON message.c_id = clients.c_id
INNER JOIN monitors ON message.m_id = monitors.m_id  WHERE message.c_id = $clientid");

 $stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $title = htmlentities($row['dc_title']);
    $price = htmlentities($row['dc_price']);
    $desc = htmlentities($row['dc_description']);
    $cartype = htmlentities($row['cartype']);
    $img = htmlentities($row['dc_img']);
    $monitorn = htmlentities($row['m_fname']);
    $monitorl = htmlentities($row['m_lname']);
    $monitorID = htmlentities($row['m_id']);
    $dcourseID = htmlentities($row['dc_id']);

    $stmt2 = $pdo->prepare("SELECT * FROM message
    where ms_id = :messageid");
    $stmt2->execute(
    array(
    ':messageid' => $row['ms_id']
    )
    );
    $row3 = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    echo '</div>';
    echo '
    </div>
    </div>
    </div>
    </div> <!-- End Item-->';
    

    ?>

        <div class="container">
            <div class="card" style="width:300px;">
                <h3> <?php flashMessages(); ?></h3>
                <img src=" ../upload/<?php echo $img; ?>" class="card-img-top" style="height: 200px;" alt="work image">
                <div class="row">
                    <div class="card-body">

                        <label>Course Tile</label>
                        <h5 class="card-title"><?php echo $title; ?></h5>
                        <label>Course Price</label>
                        <h5 class="card-title">Rs<?php echo $price; ?></h5>
                        <label>Course Descriotion </label>
                        <p class="card-text"><?php echo $desc; ?></p>
                        <label>Car Transmission </label>
                        <p class="card-text"><?php echo $cartype; ?></p>

                        <label>Monitor name</label>
                        <p class="card-text"><?php echo $monitorn . ". " . $monitorl; ?></p>
                        <?php
                if ($row3['status'] === 0) {
                echo ' &nbsp;&nbsp;
                <a class="btn btn-outline-success" href="#?sid=' . $row['ms_id'] . '">
                    <i class="bx bx-heart"></i>&nbsp;Pending</a>&nbsp;';
                }
                else if($row3['status'] === 1){
                    echo ' &nbsp;&nbsp;
                    <a class="btn btn-outline-success" href="payment.php?msid=' . $row['ms_id'] . '&dcid=' . $row['dc_id'] .  '&mid=' . $row['m_id'] . ' ">
                        <i class="bx bx-heart"></i>&nbsp;Proceed to payment</a>&nbsp;';
                
                }
                else {
                    echo ' &nbsp;&nbsp;
                <a class="btn btn-outline-success" href="#?dcid=' . $row['ms_id'] . '">
                    <i class="bx bx-heart"></i>&nbsp;Payment Done</a>&nbsp;';
                }
?>



                    </div>
                </div>
            </div>

        </div>

        <?php
}


?>
    </div>

    <!-- end of section -->




    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <!-- end of footer-->
</body>

</html>