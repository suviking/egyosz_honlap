<?php
#The index.php for the illyesnapok theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}




if (!isset($_GET["adminpage"]))		#dont wanted to use the admin site, goes directly to the registration form
{

	if ($user["accessLevel"] < 4) 	#checks if the user has the right to access the admin page and if it does the program creates a link to there
	{
		$adminLink = 
		"<li>
			<a href='?adminpage=1'>Admin felület</a>
		</li>";
	}
	if ($user["accessLevel"] == 3 OR $user["accessLevel"] == 2)	#if the user not a student but not an admin - redirect to adminpage
	{
		header("Location: ?adminpage=1");
		exit;
	}

###################################
###### the registration from ######
###################################
	echo "
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
			<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					" .$adminLink. "
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlapon, " .$user["firstName"]. "!  Az alábbi űrlap kitöltésével tudod regisztrálni a produkciódat.</h2>

		<div class='jumbotron col-lg-12'>

			<form action='theme/illyesnapok/perfReg.php' id='regForm' class='form-horizontal' method='POST'>
				<fieldset>
					<legend>Általános információk</legend>

					<div class='form-group'>
						<label for='title' class='col-lg-2 control-label'>Produkció címe</label>
						<div class='col-lg-4'>
							<input id='title' class='form-control' name='title' type='text' maxlength='25' size='30' required='required'>
						</div>
					</div>

					<div class='form-group'>
						<label for='partNo' class='col-lg-2 control-label'>Résztvevők száma</label>
						<div class='col-lg-4'>
							<input id='partNo' class='form-control' name='partNo' type='number' min='1' max='700' size='3' value='1'>
						</div>
					</div>

					<div class='form-group'>
						<label for='category' class='col-lg-2 control-label'>Kategória</label>
						<div class='col-lg-4'>
							<select class='form-control' id='category' name='category' require='require'>
								<optgroup label='Ének-zene'>
									<optgroup label='&nbsp;- Könnyűzene'>
										<option name='EZ_K_egy'>&nbsp;Könnyűzene - Egyéni vagy duó</option>
										<option name='EZ_K_csop'>&nbsp;Könnyűzene - Csoportos</option>
										<option name='EZ_K_zk'>&nbsp;Könnyűzene - Zenekar</option>
										<option name='EZ_K_oszt'>&nbsp;Osztályének</option>
									</optgroup>
									<optgroup label='&nbsp;- Komolyzene'>
										<option name='EZ_kom_egy'>&nbsp;Komolyzene - Egyéni vagy duó</option>
										<option name='EZ_kom_csop'>&nbsp;Komolyzene - Csoportos</option>
									</optgroup>
								</optgroup>
								<optgroup label='Vers és próza'>
										<option name='VP_V'>&nbsp;Vers</option>
										<option name='VP_P'>&nbsp;Próza</option>
								</optgroup>
								<optgroup label='Egyéb'>
										<option name='E_vid'>&nbsp;Egyéb - Videó</option>
										<option name='E_jel'>&nbsp;Egyéb - Jelenet</option>
										<option name='E_egyeb'>&nbsp;Egyéb</option>
									<optgroup label='&nbsp;- Tánc'>
										<option name='E_T_egy'>&nbsp;Tánc - Egyéni vagy párban</option>
										<option name='E_T_csop'>&nbsp;Tánc - Csoportos</option>
										<option name='E_T_oszt'>&nbsp;Osztálytánc</option>
									</optgroup>
								</optgroup>
							</select>
						</div>
					</div>

					<div class='form-group'>
						<label for='duration' class='col-lg-2 control-label'>Produkció hossza</label>
						<div class='col-lg-4 input-group'>
							<input id='duration' class='form-control' name='duration' type='number' min='1' max='15' size='3' value='2'>
							<span class='input-group-addon'>perc &nbsp;(Inkább felfele kerekíts!)</span>
						</div>
					</div>

					<div class='form-group'>
						<label class='col-lg-2 control-label'>Helyszín</label>
						<div class='col-lg-4'>
							<div class='radio radio-primary'>
								<label>
									<input name='location' type='radio' value='szinpad' checked>Színpad
								</label>
							</div>
							<div class='radio radio-primary'>
								<label>
									<input name='location' type='radio' value='aula'>Aula
								</label>
							</div>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Technikai igények</legend>

					<div class='form-group'>
						<label for='wiredMic' class='col-lg-2 control-label'>Vezetékes mikrofon</label>
						<div class='col-lg-4'>
							<input id='wiredMic' class='form-control' name='wiredMic' type='number' min='0' max='2' value='0'>
						</div>
						<label for='wiredMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wiredMicStand' class='form-control' name='wiredMicStand' type='number' min='0' max='2' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='wirelessMic' class='col-lg-2 control-label'>Vezetéknélküli mikrofon</label>
						<div class='col-lg-4'>
							<input id='wirelessMic' class='form-control' name='wirelessMic' type='number' min='0' max='3' value='0'>
						</div>
						<label for='wirelessMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wirelessMicStand' class='form-control' name='wirelessMicStand' type='number' min='0' max='3' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='microport' class='col-lg-2 control-label'>Mikroport</label>
						<div class='col-lg-4'>
							<input id='microport' class='form-control' name='microport' type='number' min='0' max='2' value='0'>
						</div>
					</div>


					<div class='form-group'>
						<label for='fieldMic' class='col-lg-2 control-label'>Térmikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='fieldMic' class='form-control' name='fieldMic' type='number' min='0' max='4' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='instMic' class='col-lg-2 control-label'>Hangszermikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='instMic' class='form-control' name='instMic' type='number' min='0' max='2' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack63' class='col-lg-2 control-label'>Jack 6.3mm</label>
						<div class='col-lg-4'>
							<input id='jack63' class='form-control' name='jack63' type='number' min='0' max='2' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack35' class='col-lg-2 control-label'>Jack 3.5mm</label>
						<div class='col-lg-4'>
							<input id='jack35' class='form-control' name='jack35' type='number' min='0' max='2' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='guitarAmp' class='col-lg-2 control-label'>Ha hozol gitárerősítőt</label>
						<div class='col-lg-4'>
							<input id='guitarAmp' class='form-control' name='guitarAmp' type='number' min='0' max='5' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='piano' class='col-lg-2 control-label'>Zongora</label>
						<div class='col-lg-4'>
							<input id='piano' class='form-control' name='piano' type='number' min='0' max='1' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='musicStand' class='col-lg-2 control-label'>Kottatartó (nekünk csak egy van)</label>
						<div class='col-lg-4'>
							<input id='musicStand' class='form-control' name='musicStand' type='number' min='0' max='1' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='chair' class='col-lg-2 control-label'>Székek</label>
						<div class='col-lg-4'>
							<input id='chair' class='form-control' name='chair' type='number' min='0' max='9' value='0'>
						</div>
					</div>

					<div class='form-group'>
						<label for='ifMusicFile' class='col-lg-2 control-label'>Lejátszandó zenefájl</label>
						<div class='col-lg-1 checkbox' id='ifMusicFile'>
							<label>
								<input name='ifMusicFile' type='checkbox' value='yes'>
								 Van
							</label>
						</div>
						<label for='musicFile' class='col-lg-2 control-label'>Fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='musicFile' class='form-control' name='musicFile' type='text' size='30'>
						</div>
					</div>

					<div class='form-group'>
						<label for='ifProjector' class='col-lg-2 control-label'>Projektor</label>
						<div class='col-lg-1 checkbox' id='ifProjector'>
							<label>
								<input name='ifProjector' type='checkbox' value='yes'>
								 Kell
							</label>
						</div>
						<label for='projectorFile' class='col-lg-2 control-label'>Kivetítendő fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='projectorFile' class='form-control' name='projectorFile' type='text' size='30'>
						</div>
					</div>

					<div class='form-group'>
						<label for='lightRequest' class='col-lg-2 control-label'>Külön fénytechinkai igény</label>
						<div class='col-lg-10 checkbox' id='lightRequest'>
							<label>
								<input name='ifExtraLight' type='checkbox' value='yes'>
								 Van - Az egyéb kéréshez is írhatod, vagy meg is kereshetsz vele minket!
							</label>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Egyéb</legend>

					<div class='form-group'>
						<label for='email' class='col-lg-2 control-label'>E-mail cím, amin elérünk</label>
						<div class='col-lg-4'>
							<input id='email' class='form-control' name='email' type='email' size='30' required='required'>
						</div>
					</div>

					<br>

					<div class='form-group'>
						<label for='userSearch' class='col-lg-2 control-label'>Résztvevők hozzáadása</label>
						<div class='col-lg-4'>
							<p>Osztálytánc és osztályének esetén nem kell kitölteni, elég a résztvevők számát beírni fenn</p>
							<div id='hintField' style='' class='well'></div>
						</div>
						<div class='col-lg-6'>
							<textarea class='form-control' form='regForm' name='particUsers' rows='5' maxlength='10000' id='addedUserField' onKeyUp='showUser(this.value)'></textarea>
						</div>
					</div>

					<div class='form-group'>
						<label for='comment' class='col-lg-2 control-label'>Egyéb kérés</label>
						<div class='col-lg-4'>
							<textarea class='form-control' id='comment' form='regForm' cols='30' rows='5' maxlength='500' name='comment'></textarea>
						</div>
					</div>

					<!--<div class='form-group'>
						<label for='' class='col-lg-2 control-label'></label>
						<div class='col-lg-4'>
							<input id='' class='form-control' >
						</div>
					</div>-->

					<div class='form-group col-lg-10 col-lg-offset-2'>
						 <button type='submit' class='btn btn-primary'>Elküldés</button>
					</div>

				</fieldset>
			</form>
		</div>
	";
#####
}
else if (isset($_GET["adminpage"]) AND $_GET["adminpage"] == 1) 	#the DEFAULT admin page
{
	if (!include("include/cookiecheck.php"))
	{
		header("Location: logout.php");
		exit;
	}



	if ($user["accessLevel"] < 3)		#case of the user is an admin, or can edit, or can see everything, accessLevel 0, 1, 2 in order
	{

		require("include/head.php");


		########the top bar of the website
			echo("
			<div class='navbar navbar-warning'>
				<div class='navbar-header'>
					<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
				</div>
				<div class='navbar-collapse collapse navbar-warning-collapse'>
					<ul class='nav navbar-nav navbar-right'>
						<li>
							<a href='index.php'>Vissza a regisztrációs űrlaphoz</a>
						</li>
						<li>
							<a href='logout.php'>Kijelentkezés</a>
						</li>
					</ul>
				</div>
			</div>

			<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!</h2>
				");
		#########

		if (isset($_GET["orderby"]))
		{
			$orderby = $_GET["orderby"];
		}
		else
		{
			$orderby = "id";
		}

		$stmt = $db->prepare("SELECT * FROM performances WHERE deleted = 0 ORDER BY ?") OR die($db->error);
		$stmt->bind_param("s", $orderby);
		$stmt->execute() OR die($db->error);
		$result = $stmt->get_result();
		$stmt->close();

		$rows = array();
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		$result->free();
		$userFunctionKeys = "";


		if (empty($rows)) 		#rows array is empty --> no registrations wre sent yet
		{
			echo("<p>Nincs még regisztrált előadás.</p>");
			$resultField = "";
		}
		else 		#rows array is not empty --> registration(s) was(were) made already --> displays the not deleted ones
		{
			$resultField = "";
			for ($i = 0; $i < count($rows); $i++)
			{
				$resultField .= "<tr>";
				for ($j = 0; $j < 29; $j++)
				{
					$resultField .= "<td><input type='text' value='" .$rows[$i][$j]. "' disabled></td>";
				}
		########set users function keys (delete, edit, add)
				if ($user["accessLevel"] < 2)
				{
					$userFunctionKeys = "<td><a href='index.php?adminpage=2&id=" .$rows[$i]["id"]. "'>Szerkesztés</a>
											<a href='index.php?adminpage=3&id=" .$rows[$i]["id"]. "'>Törlés</a></td>";
				}
		#########
				$resultField .= $userFunctionKeys . "</tr>";
			}
		}
			echo("<table><tr>
				<td>id</td> <td>regStudID</td> <td>title</td> <td><a href='?adminpage=1&orderby=category'>category</a></td> <td>partNo</td> 
				<td><a href='?adminpage=1&orderby=location'>location</a></td> <td>duration</td> <td>wiredMic</td> <td>wiredMicStand</td> <td>wirelessMic</td> 
				<td>wirelessMicStand</td> <td>microport</td> <td>fieldMic</td> <td>instMic</td> <td>chair</td> <td>musicFile</td> <td>projectorFile</td> 
				<td>lightRequest</td> <td>email</td> <td>particUsers</td> <td>piano</td> <td>jack63</td> <td>jack35</td> <td>musicStand</td> <td>guitarAmp</td> 
				<td>comment</td> <td>dateOfReg</td> <td>deleted</td> <td>uniqueTimeStamp</td>
				</tr>" .$resultField. "</table>");
		
	}
	else if ($user["accessLevel"] == 3)	#case of the user is a headteacher, only can see the performances in its own class, accessLevel 3
	{
		
	}
	else 		#user is not an admin
	{
		header("Location: logout.php");
		exit;
	}

}
else if (isset($_GET["adminpage"]) AND $_GET["adminpage"] == 2) 	#EDIT - here the user (with the appropriate access level) can edit the choosen performance
{
	$stmt = $db->prepare("SELECT * FROM performances WHERE id = ?") OR die($db->error);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute() OR die($db->error);
	$result = $stmt->get_result();
	$stmt->close();

	$rows = array();
	while ($row = $result->fetch_array())
	{
		$rows[] = $row;
	}
	$result->free();

	$selected = $rows[0]["category"];
	$chechked = $rows[0]["location"];
	#######the registration form to edit values
		echo("
		<div class='navbar navbar-warning'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
			</div>
			<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li>
						<a href='?adminpage=1'>Vissza</a>
					</li>
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlap admin felületén, " .$user["firstName"]. "!  Az alábbi űrlap kitöltésével tudod szerkeszteni az adott produkciót.</h2>

		<div class='jumbotron col-lg-12'>

			<form action='theme/illyesnapok/perfReg.php?edit' id='regForm' class='form-horizontal' method='POST'>
				<fieldset>
					<legend>Általános információk</legend>

					<div class='form-group'>
						<label for='title' class='col-lg-2 control-label'>Produkció címe</label>
						<div class='col-lg-4'>
							<input id='title' class='form-control' name='title' type='text' maxlength='25' size='30' required='required' value='" .$rows[0]["title"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='partNo' class='col-lg-2 control-label'>Résztvevők száma</label>
						<div class='col-lg-4'>
							<input id='partNo' class='form-control' name='partNo' type='number' min='1' max='700' size='3' value='" .$rows[0]["partNo"]. "'>
						</div>
					</div>");
					?>

					<div class='form-group'>
						<label for='category' class='col-lg-2 control-label'>Kategória</label>
						<div class='col-lg-4'>
							<select class='form-control' id='category' name='category' require='require'>
								<optgroup label='Ének-zene'>
									<optgroup label='&nbsp;- Könnyűzene'>
										<option <?php if($selected == 'Könnyűzene - Egyéni vagy duó'){echo("selected");}?> >&nbsp;Könnyűzene - Egyéni vagy duó</option>
										<option <?php if($selected == 'Könnyűzene - Csoportos'){echo("selected");}?> >&nbsp;Könnyűzene - Csoportos</option>
										<option <?php if($selected == 'Könnyűzene - Zenekar'){echo("selected");}?> >&nbsp;Könnyűzene - Zenekar</option>
										<option <?php if($selected == 'Könnyűzene - Osztályének'){echo("selected");}?> >&nbsp;Osztályének</option>
									</optgroup>
									<optgroup label='&nbsp;- Komolyzene'>
										<option <?php if($selected == 'Komolyzene - Egyéni vagy duó'){echo("selected");}?> >&nbsp;Komolyzene - Egyéni vagy duó</option>
										<option <?php if($selected == 'Komolyzene - Csoportos'){echo("selected");}?> >&nbsp;Komolyzene - Csoportos</option>
									</optgroup>
								</optgroup>
								<optgroup label='Vers és próza'>
										<option <?php if($rows[0]["category"] == " Vers"){echo("selected");}?> >&nbsp;Vers</option>
										<option <?php if($selected == 'Próza'){echo("selected");}?> >&nbsp;Próza</option>
								</optgroup>
								<optgroup label='Egyéb'>
										<option <?php if($selected == 'Egyéb - Videó'){echo("selected");}?> >&nbsp;Egyéb - Videó</option>
										<option <?php if($selected == 'Egyéb - Jelenet'){echo("selected");}?> >&nbsp;Egyéb - Jelenet</option>
										<option <?php if($selected == 'Egyéb'){echo("selected");}?> >&nbsp;Egyéb</option>
									<optgroup label='&nbsp;- Tánc'>
										<option <?php if($selected == 'Tánc - Egyéni vagy párban'){echo("selected");}?> >&nbsp;Tánc - Egyéni vagy párban</option>
										<option <?php if($selected == 'Tánc - Csoportos'){echo("selected");}?> >&nbsp;Tánc - Csoportos</option>
										<option <?php if($selected == 'Osztálytánc'){echo("selected");}?> >&nbsp;Osztálytánc</option>
									</optgroup>
								</optgroup>
							</select>
						</div>
					</div>
					<?php echo("
					<div class='form-group'>
						<label for='duration' class='col-lg-2 control-label'>Produkció hossza</label>
						<div class='col-lg-4 input-group'>
							<input id='duration' class='form-control' name='duration' type='number' min='1' max='15' size='3' value='" .$rows[0]["duration"]. "'>
							<span class='input-group-addon'>perc &nbsp;(Inkább felfele kerekíts!)</span>
						</div>
					</div>

					<div class='form-group'>
						<label class='col-lg-2 control-label'>Helyszín</label>
						<div class='col-lg-4'>
							<div class='radio radio-primary'>
								<label>
									<input name='location' type='radio' value='szinpad' checked>Színpad
								</label>
							</div>
							<div class='radio radio-primary'>
								<label>
									<input name='location' type='radio' value='aula'>Aula
								</label>
							</div>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Technikai igények</legend>

					<div class='form-group'>
						<label for='wiredMic' class='col-lg-2 control-label'>Vezetékes mikrofon</label>
						<div class='col-lg-4'>
							<input id='wiredMic' class='form-control' name='wiredMic' type='number' min='0' max='2' value='" .$rows[0]["wiredMic"]. "'>
						</div>
						<label for='wiredMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wiredMicStand' class='form-control' name='wiredMicStand' type='number' min='0' max='2' value='" .$rows[0]["wiredMicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='wirelessMic' class='col-lg-2 control-label'>Vezetéknélküli mikrofon</label>
						<div class='col-lg-4'>
							<input id='wirelessMic' class='form-control' name='wirelessMic' type='number' min='0' max='3' value='" .$rows[0]["wirelessMic"]. "'>
						</div>
						<label for='wirelessMicStand' class='col-lg-2 control-label'>Ebből állványos</label>
						<div class='col-lg-4'>
							<input id='wirelessMicStand' class='form-control' name='wirelessMicStand' type='number' min='0' max='3' value='" .$rows[0]["wirelessMicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='microport' class='col-lg-2 control-label'>Mikroport</label>
						<div class='col-lg-4'>
							<input id='microport' class='form-control' name='microport' type='number' min='0' max='2' value='" .$rows[0]["microport"]. "'>
						</div>
					</div>


					<div class='form-group'>
						<label for='fieldMic' class='col-lg-2 control-label'>Térmikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='fieldMic' class='form-control' name='fieldMic' type='number' min='0' max='4' value='" .$rows[0]["fieldMic"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='instMic' class='col-lg-2 control-label'>Hangszermikrofon (állvánnyal)</label>
						<div class='col-lg-4'>
							<input id='instMic' class='form-control' name='instMic' type='number' min='0' max='2' value='" .$rows[0]["instMic"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack63' class='col-lg-2 control-label'>Jack 6.3mm</label>
						<div class='col-lg-4'>
							<input id='jack63' class='form-control' name='jack63' type='number' min='0' max='2' value='" .$rows[0]["jack63"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='jack35' class='col-lg-2 control-label'>Jack 3.5mm</label>
						<div class='col-lg-4'>
							<input id='jack35' class='form-control' name='jack35' type='number' min='0' max='2' value='" .$rows[0]["jack35"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='guitarAmp' class='col-lg-2 control-label'>Ha hozol gitárerősítőt</label>
						<div class='col-lg-4'>
							<input id='guitarAmp' class='form-control' name='guitarAmp' type='number' min='0' max='5' value='" .$rows[0]["guitarAmp"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='piano' class='col-lg-2 control-label'>Zongora</label>
						<div class='col-lg-4'>
							<input id='piano' class='form-control' name='piano' type='number' min='0' max='1' value='" .$rows[0]["piano"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='musicStand' class='col-lg-2 control-label'>Kottatartó (nekünk csak egy van)</label>
						<div class='col-lg-4'>
							<input id='musicStand' class='form-control' name='musicStand' type='number' min='0' max='1' value='" .$rows[0]["musicStand"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='chair' class='col-lg-2 control-label'>Székek</label>
						<div class='col-lg-4'>
							<input id='chair' class='form-control' name='chair' type='number' min='0' max='9' value='" .$rows[0]["chair"]. "'>
						</div>
					</div>

					<div class='form-group'>
						<label for='ifMusicFile' class='col-lg-2 control-label'>Lejátszandó zenefájl</label>
						<div class='col-lg-1 checkbox' id='ifMusicFile'>
							<label>
								<input name='ifMusicFile' type='checkbox' value='yes'>
								 Van
							</label>
						</div>
						<label for='musicFile' class='col-lg-2 control-label'>Fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='musicFile' class='form-control' name='musicFile' type='text' size='30'>
						</div>
					</div>

					<div class='form-group'>
						<label for='ifProjector' class='col-lg-2 control-label'>Projektor</label>
						<div class='col-lg-1 checkbox' id='ifProjector'>
							<label>
								<input name='ifProjector' type='checkbox' value='yes'>
								 Kell
							</label>
						</div>
						<label for='projectorFile' class='col-lg-2 control-label'>Kivetítendő fájl(ok) neve</label>
						<div class='col-lg-4'>
							<input id='projectorFile' class='form-control' name='projectorFile' type='text' size='30'>
						</div>
					</div>

					<div class='form-group'>
						<label for='lightRequest' class='col-lg-2 control-label'>Külön fénytechinkai igény</label>
						<div class='col-lg-10 checkbox' id='lightRequest'>
							<label>
								<input name='ifExtraLight' type='checkbox' value='yes'>
								 Van - Az egyéb kéréshez is írhatod, vagy meg is kereshetsz vele minket!
							</label>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Egyéb</legend>

					<div class='form-group'>
						<label for='email' class='col-lg-2 control-label'>E-mail cím, amin elérünk</label>
						<div class='col-lg-4'>
							<input id='email' class='form-control' name='email' type='email' size='30' required='required' value='" .$rows[0]["email"]. "'>
						</div>
					</div>

					<br>

					<div class='form-group'>
						<label for='userSearch' class='col-lg-2 control-label'>Résztvevők hozzáadása</label>
						<div class='col-lg-4'>
							<p>Osztálytánc és osztályének esetén nem kell kitölteni, elég a résztvevők számát beírni fenn</p>
							<div id='hintField' style='' class='well'></div>
						</div>
						<div class='col-lg-6'>
							<textarea class='form-control' form='regForm' name='particUsers' rows='5' maxlength='10000' id='addedUserField' onKeyUp='showUser(this.value)'>".
							$rows[0]["particUsers"]."</textarea>
						</div>
					</div>

					<div class='form-group'>
						<label for='comment' class='col-lg-2 control-label'>Egyéb kérés</label>
						<div class='col-lg-4'>
							<textarea class='form-control' id='comment' form='regForm' cols='30' rows='5' maxlength='500' name='comment'>".$rows[0]["comment"]."</textarea>
						</div>
					</div>
					<!--<div class='form-group'>
						<label for='' class='col-lg-2 control-label'></label>
						<div class='col-lg-4'>
							<input id='' class='form-control' >
						</div>
					</div>-->

					<div class='form-group col-lg-10 col-lg-offset-2'>
						 <button type='submit' class='btn btn-primary'>Elküldés</button>
					</div>

				</fieldset>
			</form>
		</div>");

	#######

}
else if (isset($_GET["adminpage"]) AND $_GET["adminpage"] == 3) 	#DELETE - here the user (with the appropriate access level) can delete the choosen performance
{
	if (!include("include/cookiecheck.php"))
	{
		header("Location: logout.php");
		exit;
	}

	####checks if the user has the access level to delete a performance
	if ($user["accessLevel"] > 1)		#the user does not have the access level to delete
	{
		header("Location: logout.php");
		exit;
	}
	else 		#the user does have the access level to delete
	{
		if ($stmt = $db->prepare("UPDATE performances SET deleted = 1 WHERE id = ?")) {} else {die($db->error());}
		$stmt->bind_param("i", $_GET["id"]);
		if ($stmt->execute())
		{
			echo("<p>Sikeresen kitörölted a produkciót a listából.</p>");
			header("Refresh: 3; url='index.php?adminpage=1'");
		}
		$stmt->close();
	}
}	
else 	#every other cases are invalid links --> logging out for security reasons 
{
	header("Location: logout.php");
	exit;
}
?>