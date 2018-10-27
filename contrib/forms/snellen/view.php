<?php


include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormSnellen.class.php");

$c = new C_FormSnellen();
echo $c->view_action($_GET['id']);
