<?php



include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormNursingNotes.class.php");

$c = new C_FormNursingNotes();
echo $c->default_action();
