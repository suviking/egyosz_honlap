<?php

if (!include("../../include/cookiecheck.php"))
{
	header("Location: ../../logout.php");
}


echo("<html><head><meta charset='UTF-8' /></head><body>");

if (!isset($_GET["newPswrd"]))
{
	$q = nameString(res($_GET["q"]));

	$result = $db->query("SELECT * FROM students WHERE username = '" .$q. "'") OR die($db->error);


	$rows = array();
	while($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	$result->free();

	echo("
		<form action='theme/illyesnapok/newPswrd.php?newPswrd' method='POST'>
			<table>
				<tr>
					<th>ID</th>
					<th>username</th>
					<th>fullname</th>
					<th>class</th>
					<th>acces level</th>
					<th>new password</th>
				</tr>
				<tr>
				
					<td><input type='text' value='".$rows[0]["id"]."' disabled><input type='hidden' name='id' value='".$rows[0]["id"]."'></td>
					<td><input type='text' value='".$rows[0]["username"]."' disabled></td>
					<td><input type='text' value='".$rows[0]["fullname"]."' disabled></td>
					<td><input type='text' value='".$rows[0]["class"]."' disabled></td>
					<td><input type='text' value='".$rows[0]["accessLevel"]."' disabled></td>
					<td><input type='password' maxLength='15' name='newPswrd'></td>
					<td><input type='submit' value='Új jelszó mentése'></td>
				</tr>
			</table>
		</form>
		");
}
else if (isset($_GET["newPswrd"]))
{
	$id = $_POST["id"];
	$newPswrd = sha1($_POST["newPswrd"]);

	if ($stmt = $db->prepare("UPDATE students SET OM=? WHERE id=?")) {} else {die($db->error);}
	$stmt->bind_param("si", $newPswrd, $id);
	if ($stmt->execute())
	{
		echo("<p>A jelszó sikeresen megváltozott</p>");
	} 
	else 
	{
		die($db->error);
	}
	$stmt->close();

	header("Refresh: 3; url=../../index.php?adminpage=4");
	exit;

}
else
{
	header("Location: ../../logout.php");
	exit;
}


?>