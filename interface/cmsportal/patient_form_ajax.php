<?php
/**
 * Patient matching and selection for the WordPress Patient Portal.
 *
 * Copyright (C) 2014 Rod Roark <rod@sunsetsystems.com>
 *
 */




require_once("../globals.php");
require_once("portal.inc.php");

$result = cms_portal_call(array(
  'action'    => 'adduser',
  'newlogin'  => $_REQUEST['login'],
  'newpass'   => $_REQUEST['pass'],
  'newemail'  => $_REQUEST['email'],
));

if ($result['errmsg']) {
    echo xl('Failed to add patient to portal') . ": " . $result['errmsg'];
}
