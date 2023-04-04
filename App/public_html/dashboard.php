<?php
session_start();
use classes\dashboard;
use function classes\test;
require_once dirname(dirname(__DIR__))."/vendor/autoload.php";


new classes\dashboardheader();

new dashboard();

new classes\footer();

?>