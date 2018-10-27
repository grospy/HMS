<?php
/**
 * Instructions for loading ICD9 Database
 *
 */



require_once("../../interface/globals.php");

?>
<div class="dialog"><p>
<?php echo xlt("Steps to install the ICD 9 database"); ?>:
<ol>
<li><?php echo xlt("The raw data feed release can be obtained from"); ?> <b><a href="https://www.cms.gov/Medicare/Coding/ICD9ProviderDiagnosticCodes/codes.html"><?php echo xlt("this location"); ?></a></b>
<li><?php echo xlt("Place the downloaded ICD 9 database zip file into the following directory"); ?>:  contrib/icd9</li>
<li><?php echo xlt("Return to this page and you will be able to complete the ICD9 installation process by clicking on the ICD9 section header"); ?></li>
</ol>
</p>
</div>
