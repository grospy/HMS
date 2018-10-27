<?php
/**
 * Instanciate a router and route the interface request to the appropriate
 * controller and method in the ESign/ library directory.
 **/

use ESign\Router;

require_once "../globals.php";
require_once $GLOBALS['srcdir']."/ESign/Router.php";
$router = new Router();
$router->route();
