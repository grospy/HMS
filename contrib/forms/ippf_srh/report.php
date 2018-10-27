<?php


include_once("../../globals.php");
include_once($GLOBALS["srcdir"] . "/api.inc");

// This function is invoked from printPatientForms in report.inc
// when viewing a "comprehensive patient report".  Also from
// interface/patient_file/encounter/forms.php.
//
function ippf_srh_report($pid, $encounter, $cols, $id)
{
    require_once($GLOBALS["srcdir"] . "/options.inc.php");
    echo "<table>\n";
    display_layout_rows('SRH', sqlQuery("SELECT * FROM form_ippf_srh WHERE id = '$id'"));
    echo "</table>\n";
}
