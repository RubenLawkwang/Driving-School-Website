<?php

function validateStandType(){
if ( strlen($_POST['txtstandtype']) < 1) {
return 'Name is required';
}
}

function validateFileUp(){
if ( strlen($_FILES['filestandpic']['name']) < 1) {
return 'File upload is mandatory!';
}
}

function flashMessages(){
    if ( isset($_SESSION["errormsg"]) ) {
    echo('<p style="color:red">'. $_SESSION["errormsg"] . '</p>');
    //delete the session
    unset($_SESSION["errormsg"]);
    }
    if ( isset($_SESSION['successmsg']) ) {
    echo '<p style="color:green">'. $_SESSION['successmsg'] . '</p>';
    //delete the session
    unset($_SESSION["successmsg"]);
    }
    }

    function validateEventName(){
        if ( strlen($_POST['locname']) < 1) {
        return 'Car category is reqiured';
        }
        }

        function validatecategoryname(){
            if ( strlen($_POST['transminame']) < 1) {
            return 'Car category required';
            }
            }

            

            function validateCourse(){
                if ( strlen($_POST['txttitle']) < 1) {
                return 'Event name required';
                }
                }
// form validation
function validateLirstName(){
    if ( strlen($_POST['txtlname']) < 1) {
    return 'First name is required';
    }
    }                

        // first name validation
        function validateFirstName(){
            if ( strlen($_POST['txtfname']) < 1) {
            return 'First name is required';
            }
            }
    // validate profile picture
    function validateFileProfilePic(){
        if ( strlen($_FILES['profilepic']['name']) < 1) {
        return 'File up is mandatory!';
        }
        }



        //function to check email

        function validateEmail()
{
if (strlen($_POST['txtemail']) < 1) {
return 'Email is required';
} else if (strpos($_POST['txtemail'], '@') < 1) {
return "Invalid Email";
}
}
function validatePass()
{
if (strlen($_POST['txtpass']) < 1) {
return 'Password is required';
}
}






//all pages security
function checkUserAuth(){
    //check monitor auth
    if (!isset($_SESSION['clientid']) && !isset($_SESSION['monitorid'])) {
        header("Location: index.php");
    }
    }


    function validateReference()
    {
    if (strlen($_POST['txtref']) < 1) {
    return 'Juice Reference is required';
    }
    }


    //company
    function validateimage(){
        if ( strlen($_FILES['profilepic']['name']) < 1) {
        return 'Uploading your ads is mendatory!';
        }
        } 
                function validateurl(){
                    if (strlen($_POST['txturl']) < 1) {
                        return 'Please insert your website url';
                        }
                        }
        

// validation for organisation


function validateOrgName(){
    if ( strlen($_POST['txtname']) < 1) {
    return 'Organisation name is required';
    }
    }
    function validateOrgEmail(){
        if ( strlen($_POST['txtemail']) < 1) {
        return 'Email is required';
        }
        }

        function validateOrgAddress(){
            if ( strlen($_POST['txtaddress']) < 1) {
            return 'Address is required';
            }
            }

            function validateOrgPassword(){
                if ( strlen($_POST['txtpass']) < 1) {
                return 'Password is required';
                }
                }


//admin validate username

function validateUsername(){
    if ( strlen($_POST['username']) < 1) {
    return 'Username is required';
    }
    }


    function validateOldPass()
{
if (strlen($_POST['txtoldpass']) < 1) {
return 'Old Password is required';
}
}
function validateNpass(){
    if ($_POST['txtnewpass'] < 1) {
        return 'Password is required';
}
}

function validateCPass()
{
if ($_POST['txtnewpass'] != $_POST['txtcpass']) {
return 'Password does not match';
}
}

/////
function valiDupliCategory($pdo) {
    $carName = $_POST['transminame'];
    $sql_check = "SELECT COUNT(*) FROM category WHERE cars = :car";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(array(':car' => $carName));
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        return "Category already exists.";
    }

    return "";
}





?>