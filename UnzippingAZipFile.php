
<?php
// assuming file.zip is in the same directory as the executing script.
$file = '/Applications/MAMP/htdocs/HMS/QuantCongress.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
  // extract it to the path we determined above
  $zip->setPassword('1234567');
  $zip->extractTo($path);
  $zip->close();
  echo "WOOT! $file extracted to $path";
} else {
  echo "Doh! I couldn't open $file";
}

//renaming the uploaded file into a new file extension
rename ("/Applications/MAMP/htdocs/HMS/QuantCongressUSA2011AlgoTradingLAST.pdf", "QuantCongress.hg");

?>