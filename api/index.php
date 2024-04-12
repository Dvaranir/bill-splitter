<?php
require_once '../kernel.php';
require_once ROOT_DIR . '/settings/headers.php';

$input = json_decode(file_get_contents('php://input'), true);

$request_controller = $_GET['controller'];
$controller = ROOT_DIR . "/api/controllers/$request_controller.controller.php";

if (!file_exists($controller)) $Kernel->e404();

require_once($controller);
