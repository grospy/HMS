<?php
/**
 * Instructions for loading RXNORM Database
 *
 */



require_once("../../interface/globals.php");

?>
<div class="dialog"><p>
<?php echo xlt("Steps to install the RxNorm database"); ?>:
<ol>
<li><?php echo xlt("The first step is to open an account with the Unified Medical Language System web site"); ?> <b><a href="https://utslogin.nlm.nih.gov/cas/login"><?php echo xlt("here"); ?></a></b></li>
<li><?php echo xlt("Then the raw data feed release can be obtained from"); ?> <b><a href="http://www.nlm.nih.gov/research/umls/rxnorm/docs/rxnormfiles.html"><?php echo xlt("this location"); ?></a></b>
<li><?php echo xlt("Place the downloaded RxNorm database zip file into the following directory"); ?>: contrib/rxnorm. 
</li>
<li><?php echo xlt("Return to this page and you will be able to complete the RxNorm installation process by clicking on the RXNORM section header"); ?>
</li>
</ol>
<h5 class="error_msg"><?php echo xlt("NOTE: Only the full monthly RxNorm release is currently supported"); ?></h5>
<h5 class="error_msg"><?php echo xlt("NOTE: The import can take up to several hours"); ?></h5>
</p>
</div>
