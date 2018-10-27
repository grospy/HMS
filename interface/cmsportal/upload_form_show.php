<?php
/**
 * View a file upload from the CMS Patient Portal.
 *
 */




require_once("../globals.php");
require_once("portal.inc.php");

$uploadid = $_REQUEST['id'];

if (!empty($_REQUEST['messageid'])) {
    $result = cms_portal_call(array('action' => 'getmsgup', 'uploadid' => $uploadid));
} else {
    $result = cms_portal_call(array('action' => 'getupload', 'uploadid' => $uploadid));
}

if ($result['errmsg']) {
    die(text($result['errmsg']));
}

$filesize = strlen($result['contents']);

header('Content-Description: File Transfer');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header("Content-Disposition: attachment; filename=\"{$result['filename']}\"");
header("Content-Type: {$result['mimetype']}");
header("Content-Length: $filesize");

// With JSON-over-HTTP we would need to base64_decode the contents.
echo $result['contents'];
