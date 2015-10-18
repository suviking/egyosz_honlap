<?php

require_once("include/cookiecheck.php");
require_once("theme/currentTheme.php");

$title = $maintitle;
require_once("include/head.php");

require_once("theme/" .$theme. "/index.php");
exit;
?>