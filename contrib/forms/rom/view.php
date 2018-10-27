<?php


include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormROM.class.php");

$c = new C_FormROM();
echo $c->view_action($_GET['id']);
