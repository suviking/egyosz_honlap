<?php
#The index.php for the illyesnapok theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
	exit;
}

echo "
	<div class='navbar navbar-warning'>
		<div class='navbar-header'>
			<a class='navbar-brand' href='http://" . $_SERVER['HTTP_HOST'] . "'>$maintitle</a>
		</div>
		<div class='navbar-collapse collapse navbar-warning-collapse'>
			<ul class='nav navbar-nav navbar-right'>
				<li>
					<a href='./logout.php'>Kijelentkezés</a>
				</li>
			</ul>
		</div>
	</div>

	<h2 class='well'>Az alábbi űrlap kitöltésével tudod regisztrálni a produkciódat.</h2>

	<div class='jumbotron col-lg-12'>

		<form action='theme/illyesnapok/perfReg.php' id='regForm' class='form-horizontal' method='POST'>
			<fieldset>
				<legend>Általános információk</legend>

				<div class='form-group'>
					<label for='title' class='col-lg-2 control-label'>Produkció címe</label>
					<div class='col-lg-4'>
						<input id='title' class='form-control' name='title' type='text' maxlength='30' size='30' required='required'>
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
<<<<<<< HEAD
					</td>
				</tr>

				<tr>
					<td>Produkció hossza:</td>
					<td colspan='2'><input name='duration' type='number' min='1' max='15' size='3' value='2'> perc &nbsp;(Inkább fölfele kerekíts!)</td>
				</tr>

				<tr>
					<td>Helyszín:</td>
					<td><input name='location' type='radio' value='szinpad' checked>Színpad</td>
					<td><input name='location' type='radio' value='aula'>Aula</td>
				</tr>
			</table> 
		</fieldset>

		<fieldset>
			<legend>Technikai igények: </legend>
			<table>
				<tr>
					<td>Vezetékes mikrofon: </td>
					<td><input name='wiredMic' type='number' min='0' max='2' value='0'></td>
					<td>Ebből állványos: </td>
					<td><input name='wiredMicStand' type='number' min='0' max='2' value='0'></td>
				</tr>

				<tr>
					<td>Vezetéknélküli mikrofon: </td>
					<td><input name='wirelessMic' type='number' min='0' max='3' value='0'></td>
					<td>Ebből állványos: </td>
					<td><input name='wirelessMicStand' type='number' min='0' max='3' value='0'></td>
				</tr>

				<tr>
					<td>Mikroport: </td>
					<td colspan='3'><input name='microport' type='number' min='0' max='2' value='0'></td>
				</tr>

				<tr>
					<td>Térmikrofon (állvánnyal):</td>
					<td colspan='3'><input name='fieldMic' type='number' min='0' max='4' value='0'></td>
				</tr>

				<tr>
					<td>Hangszermikrofon (állvánnyal):</td>
					<td colspan='3'><input name='instMic' type='number' min='0' max='2' value='0'></td>
				</tr>

				<tr>
					<td>Székek: </td>
					<td colspan='3'><input name='chair' type='number' min='0' max='9' value='0'></td>
				</tr>

				<tr>
					<td>Lejátszandó zenefájl:</td>
					<td>Van: <input name='ifMusicFile' type='checkbox' value='yes'></td>
					<td>Fájl(ok) neve:</td>
					<td><input name='musicFile' type='text' size='30'></td>
				</tr>

				<tr>
					<td>Projektor: </td>
					<td>Kell: <input name='ifProjector' type='checkbox' value='yes'></td>
					<td>Kivetítendő fájl(ok) neve:</td>
					<td><input name='projectorFile' type='text' size='30'></td>
				</tr>

				<tr>
					<td>Külön fénytechinkai igény: </td>
					<td colspan='3'>Van: <input name='lightRequest' type='checkbox' value='yes'> - Az egyéb kéréshez is írhatod, vagy meg is kereshetsz vele minket!</td>
				</tr>
			</table>
		</fieldset>

		<fieldset>
			<legend>Egyéb:</legend>
			<table>
				<tr>
					<td>E-mail cím, amin elérünk: </td>
					<td colspan='2'><input name='email' type='email' size='30' required='required'></td>
				</tr>

				<tr>
					<td>Résztvevők hozzáadása:</td>
					<td><input type='text' id='userSearch' size='30' onKeyUp='showUser(this.value)'> <br /> <div id='hintField' style='height:30px;'></div></td>
					<td><textarea form='regForm' name='particUsers' rows='5' cols='30' maxlength='10000' id='addedUserField'></textarea></td>
					
				</tr>

				<tr>
					<td>Egyéb kérés: </td>
					<td colspan='2'><textarea form='regForm' cols='30' rows='5' maxlength='500' name='comment'></textarea></td>
				</tr>
			</table>
		</fieldset>
		<input type='submit' value='Regisztrálás!'>
	</form>
	");




exit;
 ?>
=======
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

			</fieldset>
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
						<input class='form-control' type='text' id='userSearch' size='30' onKeyUp='showUser(this.value)'>
						<div id='hintField' style='' class='well'></div>
					</div>
					<div class='col-lg-6'>
						<textarea class='form-control' form='regForm' name='particUsers' rows='5' maxlength='10000' id='addedUserField'></textarea>
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

?>
>>>>>>> origin/master
