<?php

include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormHPI.class.php");

$c = new C_FormHPI();
echo $c->view_action($_GET['id']);
