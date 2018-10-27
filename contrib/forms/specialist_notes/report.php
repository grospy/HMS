<?php


include_once("../../globals.php");
include_once($GLOBALS["srcdir"] . "/api.inc");

function specialist_notes_report($pid, $encounter, $cols, $id)
{
    $cols = 1; // force always 1 column
    $count = 0;
    $data = sqlQuery("SELECT * " .
    "FROM form_specialist_notes WHERE " .
    "id = '$id' AND activity = '1'");
    if ($data) {
        print "<table cellpadding='0' cellspacing='0'>\n<tr>\n";
        foreach ($data as $key => $value) {
            if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" ||
             $key == "authorized" || $key == "activity" || $key == "date" ||
             $value == "" || $value == "0" || $value == "0.00") {
                continue;
            }

            if ($key == 'followup_required') {
                $value = 'Yes';
            }

            $key=ucwords(str_replace("_", " ", $key));
            print "<td valign='top'><span class='bold'>$key: </span><span class='text'>$value &nbsp;</span></td>\n";
            $count++;
            if ($count == $cols) {
                $count = 0;
                print "</tr>\n<tr>\n";
            }
        }

        print "</tr>\n</table>\n";
    }
}
