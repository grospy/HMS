<?php
/**
 * Controller to handle user password change requests.
 *
 */


require_once("../globals.php");
require_once("$srcdir/authentication/password_change.php");

$curPass=$_REQUEST['curPass'];
$newPass=$_REQUEST['newPass'];
$newPass2=$_REQUEST['newPass2'];

if ($newPass!=$newPass2) {
    echo "<div class='alert alert-danger'>" . xlt("Passwords Don't match!") . "</div>";
    exit;
}

$errMsg='';
$success=update_password($_SESSION['authId'], $_SESSION['authId'], $curPass, $newPass, $errMsg);
if ($success) {
    echo "<div class='alert alert-success'>" . xlt("Password change successful") . "</div>";
} else {
    // If update_password fails the error message is returned
    echo "<div class='alert alert-danger'>" . text($errMsg) . "</div>";
}
