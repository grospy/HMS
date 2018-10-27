<?php
/**
* interface/billing/customize_log.php - starting point for customization of billing log
*
*/



     
require_once("../globals.php");

$filename = $GLOBALS['OE_SITE_DIR'] . '/edi/process_bills.log';


$fh = fopen($filename, 'r');

while ($line = fgets($fh)) {
    echo(text($line));
    echo("<br />");
}

    fclose($fh);
