<?php


include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormHand.class.php");

$c = new C_FormHand();
echo $c->view_action($_GET['id']);
