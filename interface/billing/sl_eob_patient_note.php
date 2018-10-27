<?php
/**
 * This allos entry and editing of a "billing note" for the patient.
 *
 */

  include_once("../globals.php");
  include_once("../../library/patient.inc");
  include_once("../../library/forms.inc");

  $info_msg = "";
?>
<html>
<head>
<?php html_header_show();?>
<link rel=stylesheet href="<?php echo $css_header;?>" type="text/css">
<title><?php xl('EOB Posting - Patient Note', 'e')?></title>
</head>
<body>
<?php
  $patient_id = $_GET['patient_id'];
if (! $patient_id) {
    die(xl("You cannot access this page directly."));
}

if ($_POST['form_save']) {
    $thevalue = trim($_POST['form_note']);

    sqlStatement("UPDATE patient_data SET " .
    "billing_note = ? " .
    "WHERE pid = ? ", array($thevalue, $patient_id));

    echo "<script language='JavaScript'>\n";
    if ($info_msg) {
        echo " alert('$info_msg');\n";
    }

    echo " window.close();\n";
    echo "</script></body></html>\n";
    exit();
}

  $row = sqlQuery("select fname, lname, billing_note " .
    "from patient_data where pid = '$patient_id' limit 1");
?>
<center>

<h2><?php echo xl('Billing Note for '). $row['fname'] . " " . $row['lname'] ?></h2>
<p>&nbsp;</p>

<form method='post' action='sl_eob_patient_note.php?patient_id=<?php  echo $patient_id ?>'>

<p>
<input type='text' name='form_note' size='60' maxlength='255'
 value='<?php  echo addslashes($row['billing_note']) ?>' />
</p>

<p>&nbsp;</p>
<input type='submit' name='form_save' value='<?php xl("Save", "e")?>'>
&nbsp;
<input type='button' value='<?php xl("Cancel", "e")?>' onclick='window.close()'>

</form>
</center>

</body>
</html>
