<?php

include_once("../../globals.php");
include_once($GLOBALS["srcdir"] . "/api.inc");
function hpi_report($pid, $encounter, $cols, $id)
{
    $count = 0;
    $data = formFetch("form_hpi", $id);
    $width = 100/$cols;
    if ($data) {
        print "<table cellspacing=3px><tr>";
        foreach ($data as $key => $value) {
            if ($key == "id" || $key == "pid" || $key == "user" ||
            $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "complaint" ||
            $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
                continue;
            }

            if ($value == "on") {
                $value = "yes";
            }

            $key=ucwords(str_replace("_", " ", $key));
            print "<td width='${width}%' valign='top'><span class=bold>$key: </span><span class=text>$value</span></td>";
            $count++;
            if ($count == $cols) {
                $count = 0;
                print "</tr><tr>\n";
            }
        }
    }

    print "</tr></table>";
}
