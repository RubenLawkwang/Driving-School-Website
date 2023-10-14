<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();
if (isset($_POST['btncancel'])) {
    header('Location: index.php');
    return;
}
if (isset($_POST['txtstandtype'])) {
    //call the validatestandtype function
    $msg = validateStandType();
    if (is_string($msg)) {
        $_SESSION['errormsg'] = $msg;
        header("Location: index.php");
        return;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slow and furious</title>

    <?php include_once("../php/csslinks.php");
    include_once("../php/jslinks.php")
    ?>

    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="../swiper/swiper-bundle.min.css">
</head>


<body>
    <style>
        .swiper-container {
            margin: 0 auto;
            max-width: 500px;
            overflow: hidden;
            position: relative;

        }

        .swiper-pagination {
            position: absolute;
            /*Add this line to position the pagination dots absolutely */
            display: flex;
            justify-content: center;
            bottom: 10px;
            left: 0;
            right: 0;
        }

        .swiper-slide {
            height: 500px;
        }
    </style>
    <header>
        <!--start of navbar -->
        <?php
        include_once("../php/header.php")
        ?>
        <!-- end of navbar-->
    </header>

    <!-- start of section 1 -->
    <section class="container-fluid" style="
background: linear-gradient(90deg, rgba(13,11,52,1) 0%, rgba(70,116,110,1) 37%, rgba(27,87,99,1) 100%); margin:auto;">
        <div class="row">
            <div class="col-6" style="margin-top: 50px; margin-bottom: 50px">
                <img src="../image/mus.jpg" class="img-fluid" />
            </div>
            <div class="col-6 text-white text-center" style="margin-top: 50px">
                <h1>Welcome to Slow & Furious where we will make you the ultimate riders!</h1>

                <p>
                    Welcome to Slow and Furious, your one-stop destination for comprehensive and top-notch driving
                    course tuition! Our website is designed with a passion for empowering aspiring drivers to master the
                    art of driving while ensuring road safety and responsible driving practices.
                </p>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- end of section 1-->



    <!-- section 2 advertisment -->


    <section class="my-5" style="height: 100vh;">
        <h2 style="text-align:center;">Advertise With us</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $stmt = $pdo->query("SELECT * FROM advertform a 
   INNER JOIN organisation r ON a.or_id = r.or_id 
   WHERE a.status = 1");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo ('<div class="swiper-slide">
                <div >
                    <div >
                        <div >
                            <img class="img-fluid" alt="" src="../upload/' . htmlentities($row['ad_img']) . '">
                        </div>
                        <p class="text-center mt-2">' . htmlentities($row['or_name']) . '</p>
                        <p class="text-center mt-2">' . htmlentities($row['websiteurl']) . '</p>
                    </div>
                </div>
            </div>');
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>

        </div>
        <div class="d-flex justify-content-center">
            <a href="../org/adsform.php" class="btn btn-primary">Click here to advertise your company</a>
        </div>
        <h4 class="text-center my-5"> Dont hesistate to submit your advert we will promote your company </h4>
        </div>
    </section>





    <!-- end of advertisment -->

    <!-- start of search monitors -->



    <section class="container-fluid py-5" style="background-color: #EEE3CB;">
        <!-- Carousel wrapper -->
        <h1 class="text-center">Search your monitor </h1>
        <div class="container">
            <div class="container" data-aos="fade-up">
                <div class="row bg-light" data-aos="zoom-in" data-aosdelay="
100">
                    <div class="d-flex justify-content-center">
                        <form name='frmsearchstand'>
                            <div class="row">
                                <div class="col">
                                    <input type='text' class="form-control" onkeyup='ajaxCall()' id='txtstandtype' placeholder="Search by name" />
                                </div>
                                <div class="col">
                                    <input type='text' class="form-control" onkeyup='ajaxCall()' id='txtprice' placeholder="Search by location" />
                                </div>
                                <div class="col">
                                    <select id='ddllocation' class="formcontrol " style="display: none;">
                                        <option value=" -1">Choose
                                            Location</option>
                                        <option value="i">Indoor</option>
                                        <option value="o">Outdoor</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <?php
            $stmt = $pdo->query("SELECT * FROM monitors");
            echo '<div class="row" id="searchresult">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-md-6">
          <div class="card" style="width: 18rem;">';
                echo '<img class="img-fluid" alt="" src="../upload/' . htmlentities($row['m_profilepicture']) . '">' . "\n";
                echo '<div class="card-body">
          <h5 class="card-title">Monitor name:</h5>
          <h4>' . htmlentities($row['m_fname']) . '</h4>
          <h5 class="card-title">Monitor email:</h5>
          <h4>' . htmlentities($row['m_email']) . '</h4>
          <h5 class="card-title">Years of experience:</h5>
          <h4>' . htmlentities($row['m_experience']) . '</h4>';
                echo '<a href="../monitor/viewmprofile.php?id=' . urlencode($row['m_id']) . '" class="btn btn-primary">View profile</a>';

                echo '</div>
      </div>
    </div>';
            }
            echo '</div>';
            ?>

    </section>
    <!-- end of search monitors -->


    <!-- section testimonials-->

    <section class="my-5">
        <h2 style="text-align:center;">Hear what your clients have to say about our Monitors</h2>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $stmt = $pdo->query("SELECT * FROM recommendation r 
   INNER JOIN clients c ON r.c_id = c.c_id INNER JOIN monitors m ON r.m_id = m.m_id
   WHERE r.r_status = 1");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo ('<div class="swiper-slide">
                <div >
                    <div >
                        <div >
                            <img class="img-fluid" alt="" src="../upload/' . htmlentities($row['c_profilepicture']) . '">
                        </div>
                        <p class="text-center mt-2">' . htmlentities($row['c_fname']) . '</p>
                        <p class="text-center mt-2">' . htmlentities($row['c_lname']) . '</p>
                        <p class="text-center mt-2">' . htmlentities($row['comments']) . '</p>
                        <lable class="text-center mt-2">Associated Monitor</label>
                        <p class="text-center mt-2">' . htmlentities($row['m_fname']) . '</p>
                    </div>
                </div>
            </div>');
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        </div>
    </section>


    <!-- end of testimonials-->

    <!-- start of section 6 terms and conditions-->
    <section class="container-fluid text-white" style="background: rgb(13,11,52);
background: linear-gradient(90deg, rgba(13,11,52,1) 0%, rgba(70,116,110,1) 37%, rgba(27,87,99,1) 100%); height: 60vh;">
        <div class="container">
            <h2 class="text-center py-5">Our Terms, Policy and Services</h2>
            <div class="row col-md-12">
                <div class="col-md-3">
                    <h3>Security</h3>
                    <i class="fa-solid fa-key"></i>
                    <p>Our website have the best security against scams</p>
                </div>
                <div class="col-md-3">
                    <h3>Policy</h3>
                    <i class="fa-sharp fa-solid fa-building-shield"></i>
                    <p>
                        Our policy is be great in what you are doing because there
                        are
                    </p>
                </div>

                <div class="col-md-3">
                    <h3>Fast Service</h3>
                    <i class="fa-brands fa-aws"></i>

                    <p>We are fast at delivering goods</p>
                </div>
                <div class="col-md-3">
                    <h3>We are reliable</h3>
                    <i class="fa-regular fa-handshake"></i>
                    <p>Our website provide the best services in the country</p>
                </div>
            </div>
        </div>
    </section>
    <!--end of section 6-->



    <!-- start of footer-->
    <?php include_once("../php/footer.php") ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                // Set the direction to 'horizontal' for horizontal scrolling/swiping
                direction: 'horizontal',
                loop: true, // Set loop to true if you want the slides to repeat
                autoplay: {
                    delay: 3000, // Set the delay between slide changes (in milliseconds)
                },
                pagination: {
                    el: '.swiper-pagination', // Set the class name for the pagination element
                    clickable: true, // Enable clickable pagination bullets
                },
            });
        });
    </script>
    <!-- ---------------------------------- -->

    <script language="javascript" type="text/javascript">
        function ajaxCall() {
            // Get the values from user and pass it to server script
            var st = document.getElementById('txtstandtype').value;
            var pri = document.getElementById('txtprice').value;
            var loc = document.getElementById('ddllocation').value;
            var queryString = "?m_fname=" + st;
            queryString += "&m_email=" + pri + "&loc_id=" + loc;
            $.get("loaddata.php" + queryString, successFn);
        }

        function successFn(result) {
            $('#searchresult').html(result);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>



    <!-- end of footer-->
</body>

</html>