<?php
/**
 *
 * QRDA Download
 *
 */

    // This program exports(Download) to QRDA Category III XML.

    require_once("../interface/globals.php");

    $qrda_fname = $_GET['qrda_fname'];
        check_file_dir_name($qrda_fname);
if ($qrda_fname != "") {
    $qrda_file_path = $GLOBALS['OE_SITE_DIR'] . "/documents/cqm_qrda/";
    $xmlurl = $qrda_file_path.$qrda_fname;

    header("Pragma: public"); // required
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false); // required for certain browsers
    header('Content-type: application/xml');
    header("Content-Disposition: attachment; filename=\"".basename($xmlurl)."\";");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ". filesize($xmlurl));
    ob_clean();
    flush();
    readfile($xmlurl);
} else {
    echo xlt("File path not found.");
}
