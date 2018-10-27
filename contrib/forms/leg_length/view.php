<?php


include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormLegLength.class.php");

$c = new C_FormLegLength();
echo $c->view_action($_GET['id']);
