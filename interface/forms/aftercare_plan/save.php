<?php
/**
 *
 */
 

include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

if (! $encounter) { // comes from globals.php
    die(xl("Internal error: we do not seem to be in an encounter!"));
}

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$sets = "pid = {$_SESSION["pid"]},
  groupname = '" . $_SESSION["authProvider"] . "',
  user = '" . $_SESSION["authUser"] . "',
  authorized = $userauthorized, activity=1, date = NOW(),
  provider          =  '" .add_escape_custom($_POST["provider"]) . "',
  client_name          = '" .add_escape_custom($_POST["client_name"]) . "',
  admit_date          = '" .add_escape_custom($_POST["admit_date"]) . "',
  discharged          = '" .add_escape_custom($_POST["discharged"]) . "',
  goal_a_acute_intoxication          =  '" . add_escape_custom($_POST["goal_a_acute_intoxication"]) . "',
  goal_a_acute_intoxication_I          = '" . add_escape_custom($_POST["goal_a_acute_intoxication_I"]) . "',
  goal_a_acute_intoxication_II          =  '" . add_escape_custom($_POST["goal_a_acute_intoxication_II"]) . "',
  goal_b_emotional_behavioral_conditions          =  '" . add_escape_custom($_POST["goal_b_emotional_behavioral_conditions"]) . "',
  goal_b_emotional_behavioral_conditions_I          = '" . add_escape_custom($_POST["goal_b_emotional_behavioral_conditions_I"]) . "',
  goal_c_relapse_potential                           = '" . add_escape_custom($_POST["goal_c_relapse_potential"]) . "',
  goal_c_relapse_potential_I                    =  '" . add_escape_custom($_POST["goal_c_relapse_potential_I"]) . "'";

  
if (empty($id)) {
    $newid = sqlInsert("INSERT INTO form_aftercare_plan SET $sets");
    addForm($encounter, "Aftercare Plan", $newid, "aftercare_plan", $pid, $userauthorized);
} else {
    sqlStatement("UPDATE form_aftercare_plan SET $sets WHERE id = '". add_escape_custom("$id"). "'");
}

$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
