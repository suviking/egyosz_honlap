<?php

#region //including the required files
require_once("include/dbconnect.php");
require_once("include/functions.php");
require_once("theme/currentTheme.php");

$title = $maintitle;
$style = "asd";

require_once("include/head.php");
#endregion



if (isset($_POST["username"]))	//if the user tried to log in
{
	if ($_POST["username"] != "" AND $_POST["password"] != "")	//checks if the user gave a username AND a passowrd
	{
		$username = res($_POST["username"]);
		$password = res($_POST["password"]);
		$cookie = $password;
		$password = sha1($password);

		if ($result = $db->query("SELECT * FROM students WHERE username = '".$username."' AND OM = '".$password."' "))
		{
			if ($result->num_rows == 1) //one row was selected from the database, so the user gave a password-username which can match with a row in the database
			{
				$user = $result->fetch_assoc();
				$cookie = sha1($user["cookie"]);
				setcookie("cookie", $cookie, time() + 1800);
				setcookie("username", $user["username"], time() + 1800);
				header("Location: index.php");

				$result->free();

				exit;
			}
			else //the user gave a password-username which can not match with any row in the database, incorrect passowrd or username
			{
				echo("
				<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
				<hr align='center'size='10' width='816px'>

				<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
					<tr background='style/top_line.png' style='height:32px;'>
						<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
					</tr>
					<tr><td style='padding: 10px;'><a href='logout.php'><img src='style/back_butt.png'></a></td></tr>
					<tr><td style='padding: 20px;padding-top:0px;' align='center'>
						Hibás felhasználóevet vagy jelszót adott meg.
					</td></tr>
				</table>");
				header("Refresh: 3; url=logout.php");
				die();
			}
		}
	}
	else //if the user did not gave a username OR a password
	{
		echo("
			<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
			<hr align='center'size='10' width='816px'>

			<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
				<tr background='style/top_line.png' style='height:32px;'>
					<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
				</tr>
				<tr><td style='padding: 10px;'><a href='logout.php'><img src='style/back_butt.png'></a></td></tr>
				<tr><td style='padding: 20px;padding-top:0px;' align='center'>Nem adott meg felhasználónevet vagy jelszót!</td></tr>
			</table>
			");
		header("Refresh: 3; url = logout.php");
		die();
	}
}
else	//if the user did not tried to log in, the default login form
{
	echo("
		<div align='center'><img src='style/" .$theme. "/head_line.png'></div>
		<hr align='center'size='10' width='816px'>

		<table id='deftable' cellspacing='0' cellpadding='0' align='center'>
			<tr background='style/top_line.png' style='height:32px;'>
				<td style='text-align: right' id='signInText' colspan='2'>Belépés</td>
			</tr>
			<tr>
				<td id='introText' colspan='2'>
					<p><h3>" .$welcomeText. "</h3></p>
				</td>
			</tr>
			<tr>
				<td style='width: 50%; padding: 10px; font-size: 105%;' >" .$discription. "</td>
				<td id='loginForm'>
					<form action='login.php' method='POST'>
						<p>Felhasználónév: <input type='text' name='username'></p>
						<p>Jelszó: <input type='password' name='password'></p>
						<p><input type='image' src='style/small_reg_butt.png' alt='Jelentkezés'></p>
					</form>
				</td>
			</tr>
			<tr>
				<td colspan='2' style='text-align: center; padding: 10px;'><img src='style/logo.png'></td>
			</tr>
			<tr id='bottom_line'>
				<td colspan='2'>
					" .$bottomLineText. "
				</td>
			</tr>
		</table>







		");
}




?>
