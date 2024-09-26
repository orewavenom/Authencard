<?php

/* Time zone for date time */
date_default_timezone_set('Asia/Kolkata');

/* Session for checking logged-in admin */
include 'session.php';
include 'connect_database.php';

/* Random generate String for image name */
function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/* Random generate Student ID Number */
function generateSID($length = 8) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/* Update users data ro info on submit*/
if (isset($_POST['resetuserdata'])) {

    if ($_POST['name'] != '' && $_POST['guardian'] != '' && $_POST['address'] != '' && $_POST['phone'] != '' && $_POST['email'] != '' && $_POST['designation'] != '' && $_POST['dob'] != '' && $_POST['blood_grp'] != '') {

        $id             = mysqli_real_escape_string($db, $_POST['id']);
        $name           = mysqli_real_escape_string($db, $_POST['name']);
        $guardian       = mysqli_real_escape_string($db, $_POST['guardian']);
        $address        = mysqli_real_escape_string($db, $_POST['address']);
        $phone          = mysqli_real_escape_string($db, $_POST['phone']);
        $email          = mysqli_real_escape_string($db, $_POST['email']);
        $designation    = mysqli_real_escape_string($db, $_POST['designation']);
        $dob            = mysqli_real_escape_string($db, $_POST['dob']);
        $blood_grp      = mysqli_real_escape_string($db, $_POST['blood_grp']);
        //$sid            = generateSID();
        $created        = date("d-m-Y h:i:sA");
        $mtitle         = mysqli_real_escape_string($db, $_POST['type']);

        $orgName        = $_FILES['filed']['name'];
        $orgtmpName     = $_FILES['filed']['tmp_name'];
        $temp           = explode(".", $orgName);
        $extension      = end($temp);
        $filename       = basename($_FILES["filed"]["name"]);
        $filename       = generateRandomString() . strrchr($filename, '.');

        if ($mtitle!='') {
            $mtitle = $mtitle;
        }else{
            $mtitle = "";
        }

        $check = "SELECT * FROM new_users WHERE id='$id' ";
        $checks = mysqli_query($db, $check);
        $found = mysqli_num_rows($checks);
        if ($found != 0) {

            $f = move_uploaded_file($orgtmpName, 'images/' . $filename);
            if ($f && $orgName!='') { //image is a folder in which you will save documents
                $queryz = "UPDATE new_users SET profile='$filename' WHERE id='$id' ";
                $db->query($queryz) or die('Errorr, query failed to upload picture');
            }

            $quer = "UPDATE new_users1 SET title='$mtitle', name='$name', guardian='$guardian', address='$address', phone='$phone', email='$email', designation='$designation', dob='$dob', blood_grp='$blood_grp' WHERE id='$id' ";

            $run = mysqli_query($db, $quer);

            if ($run) {
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }

        }else{
            echo json_encode(array("statusCode"=>202));
        }

    }else{
        echo json_encode(array("statusCode"=>203));
    }

}

/* Add new user's (student) data to database */
if (isset($_POST['addmember'])) {

    if ($_POST['name'] != '' && $_POST['guardian'] != '' && $_POST['address'] != '' && $_POST['phone'] != '' && $_POST['email'] != '' && $_POST['designation'] != '' && $_POST['dob'] != '' && $_POST['blood_grp'] != '') {

        $name           = mysqli_real_escape_string($db, $_POST['name']);
        $guardian       = mysqli_real_escape_string($db, $_POST['guardian']);
        $address        = mysqli_real_escape_string($db, $_POST['address']);
        $phone          = mysqli_real_escape_string($db, $_POST['phone']);
        $email          = mysqli_real_escape_string($db, $_POST['email']);
        $designation    = mysqli_real_escape_string($db, $_POST['designation']);
        $dob            = mysqli_real_escape_string($db, $_POST['dob']);
        $blood_grp      = mysqli_real_escape_string($db, $_POST['blood_grp']);
        $sid            = generateSID();
        $created        = date("d-m-Y h:i:sA");
        //$pagex          = mysqli_real_escape_string($db, $_POST["page"]);
        $mtitle         = mysqli_real_escape_string($db, $_POST['type']);

        $orgName        = $_FILES['filed']['name'];
        $orgtmpName     = $_FILES['filed']['tmp_name'];
        $temp           = explode(".", $orgName);
        $extension      = end($temp);
        $filename       = basename($_FILES["filed"]["name"]);
        $filename       = generateRandomString() . strrchr($filename, '.');

        if ($mtitle!='') {
            $mtitle = $mtitle;
        }else{
            $mtitle = "";
        }

        $check = "SELECT * FROM new_users WHERE name='$name' AND email='$email'";
        $checks = mysqli_query($db, $check);
        $found = mysqli_num_rows($checks);
        if ($found == 0) {

            if ($orgName!='') {
                move_uploaded_file($orgtmpName, 'images/' . $filename);
            }else{
                $filename = 'sample.png';
            }
            
            $query = "INSERT INTO new_users (title, name, guardian, address, phone, email, designation, dob, blood_grp, student_id, profile, created) VALUES ('$mtitle', '$name', '$guardian', '$address', '$phone', '$email', '$designation', '$dob', '$blood_grp', '$sid', '$filename', '$created')";

            $run = mysqli_query($db, $query);

            if ($run) {
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
            
        } else {
            echo json_encode(array("statusCode"=>202));
        }
    } else {
        echo json_encode(array("statusCode"=>203));
    }
}

/* Delete user from database */
if (isset($_POST['did'])) {
    $id = $_POST['did'];
    $querry = "SELECT * FROM visitors WHERE id='$id' ";
    $results = mysqli_query($db, $querry);
    $checks = mysqli_num_rows($results);
    if ($checks != 0) {
        $querry = "DELETE FROM visitors WHERE id='$id'";
        $results = mysqli_query($db, $querry);
        
        if ($results) {
            echo "success";
        }else{
            echo "failed";
        }

    }else{
        echo "error";
    }

}

if (isset($_POST['tid'])) {
    $id = $_POST['tid'];
    $querry = "SELECT * FROM teachers WHERE id='$id' ";
    $results = mysqli_query($db, $querry);
    $checks = mysqli_num_rows($results);
    if ($checks != 0) {
        $querry = "DELETE FROM teachers WHERE id='$id'";
        $results = mysqli_query($db, $querry);
        
        if ($results) {
            echo "success";
        }else{
            echo "failed";
        }

    }else{
        echo "error";
    }

}


/* Upload csv file to bulk register of users */
if (isset($_POST["bulk_reg"])) {
    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $c = 0;
    $count = 0;
    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {

        $mtitle         = $filesop[0];
        $name           = $filesop[1];
        $guardian       = $filesop[2];
        $address        = $filesop[3];
        $phone          = $filesop[4];
        $email          = $filesop[5];
        $designation    = $filesop[6];
        $dob            = $filesop[7];
        $blood_grp      = $filesop[8];
        $sid            = generateSID();
        $created        = date("d/m/Y h:i:sA");
        $filename       = 'sample.png';

        $count++;
        if ($count > 1) {
            $query = "INSERT INTO new_users (title, name, guardian, address, phone, email, designation, dob, blood_grp, student_id, profile, created) VALUES ('$mtitle', '$name', '$guardian', '$address', '$phone', '$email', '$designation', '$dob', '$blood_grp', '$sid', '$filename', '$created')";
            $db->query($query) or die('Error1, query failed');
            $c = $c + 1;
        }
    }
    if (isset($c)) {
        header("Location:../bulk_register.php?status=ok");
    } else {
        header("Location:../bulk_register.php?status=no");
    }
}


?>
