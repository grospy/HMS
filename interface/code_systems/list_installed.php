<?php
/**
 * This file implements the main jquery interface for loading external
 * database files into openEMR
 *
 */




require_once("../../interface/globals.php");
require_once("$srcdir/acl.inc");

// Control access
if (!acl_check('admin', 'super')) {
    echo xlt('Not Authorized');
    exit;
}

$db = isset($_GET['db']) ? $_GET['db'] : '0';

// Ordering by the imported_date with tiebreaker being the revision_date
$rez = sqlStatement("SELECT DATE_FORMAT(`revision_date`,'%Y-%m-%d') as `revision_date`, `revision_version`, `name` FROM `standardized_tables_track` WHERE upper(`name`) = ? ORDER BY `imported_date` DESC, `revision_date` DESC", array($db));
for ($iter=0; $row=sqlFetchArray($rez); $iter++) {
    $sqlReturn[$iter]=$row;
}

if (empty($sqlReturn)) {
?>
    <div class="stg"><?php echo xlt("Not installed"); ?></div>
<?php
} else {
    if ($sqlReturn[0]['name'] == 'SNOMED' && $sqlReturn[0]['revision_version'] == 'US Extension') {
        // If using the SNOMED US Extension package, then show the preceding SNOMED International Package information first
?>
        <div class="atr"><?php echo xlt("Name") . ": " . text($sqlReturn[1]['name']); ?> </div>
        <div class="atr"><?php echo xlt("Revision") . ": " . text($sqlReturn[1]['revision_version']); ?> </div>
        <div class="atr"><?php echo xlt("Release Date") . ": " . text($sqlReturn[1]['revision_date']); ?> </div>
        <br>
<?php
    }

    // Always show the first item of query results
?>
    <div class="atr"><?php echo xlt("Name") . ": " . text($sqlReturn[0]['name']); ?> </div>
    <div class="atr"><?php echo xlt("Revision") . ": " . text($sqlReturn[0]['revision_version']); ?> </div>
    <div class="atr"><?php echo xlt("Release Date") . ": " . text($sqlReturn[0]['revision_date']); ?> </div>
<?php
}
?>
