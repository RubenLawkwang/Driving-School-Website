<!-- start of navbar-->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #002a77">
    <div class="container-fluid">
        <a class="navbar-brand" href="../client/index.php">S&Furious</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../client/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../client/vallcourses.php">Course</a>
                </li>
                <!--  temporary unavailable
                <li class="nav-item">
                    <a class="nav-link" href="admin/adminhome.php">Admin functions</a>
                </li> -->

                <!-- testing comments -->


                <?php 
                 if (isset($_SESSION['monitorid'])) {

                    echo'<li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../monitor/viewpayment.php">View Payment Recieve</a>
                </li>';
            }
                    ?>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="monitor/createcourse.php">Monitor Functions</a>
                </li> test functions-->
                <?php 
                 if (isset($_SESSION['monitorid'])) {
                echo'<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Monitor functions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="../monitor/createcourse.php">Add Course</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../monitor/viewcourse.php">View Course</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="../monitor/deletecourse.php">Delete Course</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../monitor/viewmessage.php">Accept Message requests</a>
                        </li>

                        <li>
                        <a class="dropdown-item" href="../monitor/replymessage.php">Reject Message requests</a>
                    </li>
                    </ul>


                </li>';
                 }
                ?>

                <!-- client functions -->
                <?php 
                 if (isset($_SESSION['clientid'])) {
                echo'<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Client functions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="viewrequest.php">View Request Sent</a>
                        </li>

                    </ul>


                </li>';
                 }
                ?>
                <!-- end of client functions -->
                <!-- login -->
                <?php
                    if (isset($_SESSION['clientid'])) {
    echo '<div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><span class="logged-in">' . $_SESSION["fn"] . '</span></a>
              <div class="dropdown-menu fade-up m-0">
              <a href="updateprofile.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Update Profile</a>
              <a href="../logout.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Logout</a>
              <a href="../client/changepassc.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Change Password</a>
              
              </div>
          </div>';
                    }
                    elseif(isset($_SESSION['monitorid'])) {
                        echo '<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><span class="logged-in">' . $_SESSION["fn"] . '</span></a>
                        <div class="dropdown-menu fade-up m-0">
                        <a href="../monitor/mupdateprofile.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Update Profile</a>
                        <a href="../logout.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Logout</a>
                        <a href="../monitor/changepasswordm.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Change Password</a>
                        
                        </div>
                    </div>';

                    }

                    elseif(isset($_SESSION['organisationid'])) {
                        echo '<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><span class="logged-in">' . $_SESSION["fn"] . '</span></a>
                        <div class="dropdown-menu fade-up m-0">
                        <a href="../logout.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Logout</a>
                        
                        </div>
                    </div>';

                    }
           

else{
    echo '<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
    <div class="dropdown-menu fade-up m-0">
        <a href="../client/login.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Log in as Client</a>
        <a href="../monitor/mlogin.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Log in as Monitor</a>
        <a href="../admin/adminlogin.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Log in as Admin</a>
        <a href="../org/orglogin.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Log in as organisation</a>
        
    </div>
</div>';
}
?>


                <?php
                    if (!isset($_SESSION["clientid"]) && !isset($_SESSION["monitorid"]) ) {
                echo'<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Registration
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="regiser.php">Customer Registration</a>
                        </li>
                        <li>
                        <a class="dropdown-item" href="../monitor/mregister.php">Monitor Registration</a>
                    </li>
                    <li>
                    <a class="dropdown-item" href="../org/orgregister.php">Organisation Registration</a>
                </li>
                        </ul>';
                                      }                  
?>
                <!-- <li class="nav-item">

                </li> -->
                </li>
                <!-- end of login -->
            </ul>

        </div>
    </div>

</nav>
<!-- end of navbar-->