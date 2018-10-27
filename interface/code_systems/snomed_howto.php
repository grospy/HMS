<?php
/**
 * Instructions for loading SNOMED Database
 *
 */



require_once("../../interface/globals.php");

?>
<div class="dialog"><p>
<?php echo xlt("Steps to install the Snomed database"); ?>:
<ol>
<li><?php echo xlt("The first step is to download the SNOMED CT release. Access to SNOMED CT is provided by IHTSDO and their member countries. For more information see") .
" <a href='http://www.ihtsdo.org/snomed-ct/get-snomed-ct'>http://www.ihtsdo.org/snomed-ct/get-snomed-ct</a>."; ?> 
</li>
<li><?php echo xlt("Place the downloaded Snomed database zip file into the following directory"); ?>: contrib/snomed 
</li>
<li><?php echo xlt("Return to this page and you will be able to complete the Snomed installation process by clicking on the SNOMED section header"); ?>
</li>
</ol>
<h5 class="error_msg"><?php echo xlt("NOTE: Only the Biannual International Snomed Releases and the US Snomed Releases are currently supported"); ?></h5>
<h5 class="error_msg"><?php echo xlt("The following International Snomed Release languages are supported"); ?>: <?php echo xlt("English"); ?>, <?php echo xlt("Spanish"); ?></h5>
</p>
</div>
