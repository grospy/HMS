<?php
/**
 * Instructions for loading ICD10 Database
 *
 */



require_once("../../interface/globals.php");

?>
<div class="dialog"><p>
<?php echo xlt("Steps to install the ICD 10 database"); ?>:
<ol>
<li><?php echo xlt("The raw data feed release can be obtained from"); ?> <b><a href="https://www.cms.gov/Medicare/Coding/ICD10"><?php echo xlt("this location"); ?></a></b>
<li><?php echo xlt("Place the downloaded ICD 10 database zip files into the following directory"); ?>: contrib/icd10
</li>
<li><?php echo xlt("Return to this page and you will be able to complete the ICD10 installation process by clicking on the ICD10 section header"); ?>
</li>
</ol>
</p>
</div>
