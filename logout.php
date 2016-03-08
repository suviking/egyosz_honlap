<?php

setcookie("cookie", "", time() - 1800);
setcookie("username", "", time() - 1800);
setcookie("cookie", "", time() - 1800);
setcookie("username", "", time() - 1800);

header("Location: login.php");
die();


?>
