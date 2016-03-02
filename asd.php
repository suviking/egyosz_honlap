<?php
if (!include("include/functions.php")){die("shit");}
if (!include("include/dbconnect.php")){die("shit");}


$result = $db->query("SELECT studentId, L1 FROM lecregistration WHERE studentId = 127");

$row[] = mysqli_fetch_array($result);
print_r($row);
?>
