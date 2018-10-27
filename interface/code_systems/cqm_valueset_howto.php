<?php
/**
 * Instructions for loading VALUESET Database
 *
 */



require_once("../../interface/globals.php");

?>
<div class="dialog"><p>
<?php echo xlt("Steps to install the VALUSET database"); ?>:
<ol>
<li><?php echo xlt("The first step is to download the VALUESET release. Access to VALUESET is provided by NLM. Only valueset for Eligible Professionals need to be downloaded and it should be downloaded in XML format from Sorted By CMS ID column. For more details see the below link") .
" <a href='https://vsac.nlm.nih.gov/#download-tab'>https://vsac.nlm.nih.gov/#download-tab</a>."; ?> 
</li>
<li><?php echo xlt("Place the downloaded VALUESET database zip file into the following directory"); ?>: contrib/cqm_valueset 
</li>
<li><?php echo xlt("Return to this page and you will be able to complete the Valueset installation process by clicking on the VALUESET section header"); ?>
</li>
</ol>
<h5 class="error_msg"><?php echo xlt("NOTE: Only the XML formats and Eligible Professionals valuesets supported"); ?></h5>
</p>
</div>
