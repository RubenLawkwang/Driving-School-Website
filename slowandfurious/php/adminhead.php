<!-- start of navbar-->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #002a77">
    <div class="container-fluid">
        <a class="navbar-brand" href="../admin/adminhome.php">Adminsection</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../admin/adminhome.php">Home</a>
                </li>
                <?php
                    if (isset($_SESSION['adminid'])) {
    echo '<div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><span class="logged-in">' . $_SESSION["fn"] . '</span></a>
              <div class="dropdown-menu fade-up m-0">
              <a href="../logout.php" class="nav-item nav-link" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none;">Logout</a>
              
              </div>
          </div>';
                    }
                    ?>
                <?php 
                 if (isset($_SESSION['adminid'])) {
                echo'<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Manage Users
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="../admin/adviewuser.php">Block Client</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../admin/unblockuser.php">Unblock Client</a>
                        </li>
                        <li>
                        <a class="dropdown-item" href="../admin/unblockmonitor.php">Unblock Monitors</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../admin/blockmonitor.php">Block Monitors</a>
                    </li>
                    </ul>
                </li>';
                 }
                ?>
                <?php 
                 if (isset($_SESSION['adminid'])) {
                echo'<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Manage Companies ads
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="../admin/apprads.php">Approve Company ads</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../admin/denyads.php">Deny Company ads</a>
                        </li>
                    </ul>
                </li>';
                 }
                ?>
                <?php 
                 if (isset($_SESSION['adminid'])) {
                echo'<li class="nav-item">
                   
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Functions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="../admin/addlocation.php">Add Location</a>
                            <a class="dropdown-item" href="../admin/viewlocation.php">View Location</a>
                            <a class="dropdown-item" href="../admin/deletelocation.php">Delete Location</a>
                            <a class="dropdown-item" href="../admin/createcaegory.php">Add Category</a>
                            <a class="dropdown-item" href="../admin/veiwtransmissioncat.php">View Transmission
                                Category</a>
                            <a class="dropdown-item" href="../admin/deletetranscategory.php">Delete Transmission
                                Category</a>
                        </li>
                    </ul>

                </li>
            </ul>';
                 }
            ?>

        </div>
    </div>
</nav>
<!-- end of navbar-->