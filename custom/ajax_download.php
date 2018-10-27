<?php
/**
 *
 * QRDA Ajax Download
 */




require_once("../interface/globals.php");
require_once("$srcdir/report_database.inc");
require_once("../ccr/uuid.php");
require_once("qrda_category1_functions.php");
require_once("qrda_category1.inc");
require_once("qrda_functions.php");

$reportID = $_POST['reportID'];
$ruleID = $_POST['ruleID'];
$counter = $_POST['counter'];
$fileName = ( isset($_GET['fileName']) ) ? $_GET['fileName'] : "";
$provider_id = $_POST['provider_id'];

if ($fileName) {
    $fileList = explode(",", $fileName);
    //if ( strpos($fileName,",") !== FALSE ) {
    if (count($fileList) > 1) {
        // Multiple files, zip them together
        $zip = new ZipArchive;
        $currentTime = date("Y-m-d-H-i-s");
        global $qrda_file_path;
        $finalZip = $qrda_file_path . "QRDA_2014_1_" . $currentTime . ".zip";
        if ($zip->open($finalZip, ZIPARCHIVE::CREATE) != true) {
            echo xlt("FAILURE: Couldn't create the zip");
        }

        foreach ($fileList as $eachFile) {
                        check_file_dir_name($eachFile);
            $zip->addFile($qrda_file_path.$eachFile, $eachFile);
        }

        $zip->close();
        foreach ($fileList as $eachFile) {
            unlink($qrda_file_path.$eachFile);
        }
    } else {
        $finalZip = $qrda_file_path.$fileList[0];
    }

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Length: " . filesize($finalZip));
    header("Content-Disposition: attachment; filename=" . basename($finalZip) . ";");
    header("Content-Description: File Transfer");
    readfile($finalZip);
    unlink($finalZip);
    exit(0);
}

$report_view = collectReportDatabase($reportID);
$dataSheet = json_decode($report_view['data'], true);
$target_date = $report_view['date_target'];

$criteriaPatients = getCombinePatients($dataSheet, $reportID);
$patients = $criteriaPatients[$ruleID];

//var_dump($dataSheet);

$from_date = date('Y', strtotime($target_date))."-01-01";
$to_date =  date('Y', strtotime($target_date))."-12-31";

if (count($patients)) {
    $zip = new ZipArchive;
    global $qrda_file_path;
    $currentTime = date("Y-m-d-H-i-s");
    $zipFile = $reportID . "_NQF_" . $ruleID . "_" . $currentTime . ".zip";
    $zipFileFullPath = $qrda_file_path . $zipFile;
    if (file_exists($zipFileFullPath)) {
        unlink($zipFileFullPath);
    }

    foreach ($patients as $patient) {
        $xml = new QRDAXml($ruleID);
        $fileName = mainQrdaCatOneGenerate($xml, $patient, $ruleID, $provider_id);
        $files[] = $fileName;
    }

    if ($zip->open($zipFileFullPath, ZIPARCHIVE::CREATE) != true) {
        echo xlt("FAILURE: Couldn't create the zip");
    }

    foreach ($files as $eachFile) {
        $filePath = $qrda_file_path . $eachFile;
        $zip->addFile($filePath, $eachFile);
    }

    $zip->close();
    //Deleting the files after closing the zip
    foreach ($files as $eachFile) {
        $filePath = $qrda_file_path . $eachFile;
        unlink($filePath);
    }

    echo $zipFile;
} else {
    echo xlt("FAILURE: No patients for measure") . " " . text($ruleID);
}
