<?php
//////////////////////////////////////////////////////////////////////


include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

$row = array();

if (! $encounter) { // comes from globals.php
    die("Internal error: we do not seem to be in an encounter!");
}

$formid = $_GET['id'];

// If Save was clicked, save the info.
//
if ($_POST['bn_save']) {
 // If updating an existing form...
 //
    if ($formid) {
        $query = "UPDATE form_hist_exam_plan SET "      .
         "history = '"     . $_POST['form_history']     . "', " .
         "examination = '" . $_POST['form_examination'] . "', " .
         "plan = '"        . $_POST['form_plan']        . "' "  .
         "WHERE id = '$formid'";
        sqlStatement($query);
    } // If adding a new form...
 //
    else {
        $query = "INSERT INTO form_hist_exam_plan ( " .
         "history, examination, plan " .
         ") VALUES ( " .
         "'" . $_POST['form_history']     . "', " .
         "'" . $_POST['form_examination'] . "', " .
         "'" . $_POST['form_plan']        . "' "  .
         ")";
        $newid = sqlInsert($query);
        addForm($encounter, "Hist/Exam/Plan", $newid, "hist_exam_plan", $pid, $userauthorized);
    }

    formHeader("Redirecting....");
    formJump();
    formFooter();
    exit;
}

if ($formid) {
    $row = sqlQuery("SELECT * FROM form_hist_exam_plan WHERE " .
    "id = '$formid' AND activity = '1'") ;
}
?>
<html>
<head>
<?php html_header_show();?>
<link rel=stylesheet href="<?php echo $css_header;?>" type="text/css">
<script language="JavaScript">
</script>
</head>

<body <?php echo $top_bg_line;?> topmargin="0" rightmargin="0" leftmargin="2"
 bottommargin="0" marginwidth="2" marginheight="0">
<form method="post" action="<?php echo $rootdir ?>/forms/hist_exam_plan/new.php?id=<?php echo $formid ?>"
 onsubmit="return top.restoreSession()">

<center>

<p>
<table border='1' width='95%'>

 <tr bgcolor='#dddddd'>
  <td colspan='2' align='center'><b>History, Examination and Plan</b></td>
 </tr>

 <tr>
  <td width='5%'  nowrap> History </td>
  <td width='95%' nowrap>
   <textarea name='form_history' rows='8' style='width:100%'><?php echo $row['history'] ?></textarea>
  </td>
 </tr>

 <tr>
  <td nowrap> Examination </td>
  <td nowrap>
   <textarea name='form_examination' rows='8' style='width:100%'><?php echo $row['examination'] ?></textarea>
  </td>
 </tr>

 <tr>
  <td nowrap> Plan </td>
  <td nowrap>
   <textarea name='form_plan' rows='8' style='width:100%'><?php echo $row['plan'] ?></textarea>
  </td>
 </tr>

</table>

<p>
<input type='submit' name='bn_save' value='Save' />
&nbsp;
<input type='button' value='Cancel' onclick="parent.closeTab(window.name, false)" />
</p>

</center>

</form>
</body>
</html>
