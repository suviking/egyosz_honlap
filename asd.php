// <?php
// if (!include("include/functions.php")){die("shit");}
// if (!include("include/dbconnect.php")){die("shit");}

// $students = $db->query("SELECT username FROM students ORDER BY id");
// $studentArray = array();

// while ($stud = $students->fetch_assoc())
// {
// 	$studentArray[] = $stud;
// }

// for ($i = 0; $i < 604; $i++)
// {
// 	$db->query("UPDATE students SET username='" . nameString($studentArray[$i]["username"]) . "' WHERE id=" . ($i+1) . ";") OR die($db->error);
// }


// ?>