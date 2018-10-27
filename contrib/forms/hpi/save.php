<?php

include_once("../../globals.php");
include_once("$srcdir/api.inc");

require("C_FormHPI.class.php");
$c = new C_FormHPI();
echo $c->default_action_process($_POST);
@formJump();
