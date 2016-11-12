<?php
#The index.php for the illyesnapok theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}




if (!isset($_GET["adminpage"]))		#dont wanted to use the admin site, goes directly to the registration form
{
	$adminLink = "
				<li>
					<a href='policy.php'>Szabályzat - Tudnivalók</a>
				</li>";

	if ($user["accessLevel"] < 4) 	#checks if the user has the right to access the admin page and if it does the program creates a link to there
	{
		$adminLink .=
		"<li>
			<a href='?adminpage=1'>Admin felület</a>
		</li>";
	}
	if ($user["accessLevel"] == 3 OR $user["accessLevel"] == 2)	#if the user not a student but not an admin - redirect to adminpage
	{
		header("Location: ?adminpage=1");
		exit;
	}
	$dateNow = time();
	if ($user["accessLevel"] == 4 AND $dateNow > $deadLineTS)
	{
		echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					" .$adminLink. "
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<h2 class='well'>Köszöntünk a honlapon, " .$user["firstName"]. "! A jelenzkezési határidő lejárt. Mostmár nem tudsz jelentkezni.</h2>";
		exit;
	}

###################################
###### the registration from ######
###################################
	echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
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
										<option name='EZ_K_egy'>Könnyűzene - Egyéni vagy duó</option>
										<option name='EZ_K_csop'>Könnyűzene - Csoportos</option>
										<option name='EZ_K_zk'>Könnyűzene - Zenekar</option>
										<option name='EZ_K_oszt'>Osztályének</option>
									</optgroup>
									<optgroup label='&nbsp;- Komolyzene'>
										<option name='EZ_kom_egy'>Komolyzene - Egyéni vagy duó</option>
										<option name='EZ_kom_csop'>Komolyzene - Csoportos</option>
									</optgroup>
								</optgroup>
								<optgroup label='Vers és próza'>
										<option name='VP_V'>Vers</option>
										<option name='VP_P'>Próza</option>
								</optgroup>
								<optgroup label='Egyéb'>
										<option name='E_vid'>Egyéb - Videó</option>
										<option name='E_jel'>Egyéb - Jelenet</option>
										<option name='E_egyeb'>Egyéb</option>
									<optgroup label='&nbsp;- Tánc'>
										<option name='E_T_egy'>Tánc - Egyéni vagy párban</option>
										<option name='E_T_csop'>Tánc - Csoportos</option>
										<option name='E_T_oszt'>Osztálytánc</option>
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
						<label for='userSearch' class='col-lg-2 control-label'>Résztvevők hozzáadása (Osztályprodukciónál nem kell kitölteni!)</label>
						<div class='col-lg-6'>
							<textarea class='form-control' form='regForm' name='particUsers' rows='5' maxlength='10000' id='addedUserField' onKeyUp='showUser(this.value)'></textarea>
						</div>
						<div class='col-lg-4'>
							<div id='hintField' style='visibility:hidden' class='well'></div>
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
else if (isset($_GET["adminpage"])) 	#the DEFAULT admin page
{
	if (!include("theme/adminPage.php"))
	{
		header("Location: logout.php");
		exit;
	}
}
else 	#every other cases are invalid links --> logging out for security reasons
{
	header("Location: logout.php");
	exit;
}
?>
