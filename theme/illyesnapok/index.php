<?php
///The index.php for the illyesnapok theme.

if (!include("include/cookiecheck.php"))
{
	header("Location: logout.php");
}


#location radio button synthax

echo ("
	<p>Az alábbi űrlap kitöltésével tudod regisztrálni a produkciódat. <a href='logout.php'>Kijelentkezés</a></p>
	
	<form action='theme/" .$theme. "/perfReg.php' id='regForm'>
		<fieldset>
			<legend>Általános információk: </legend>
			<table>
				<tr>
					<td>Produkció címe:</td>
					<td colspan='2'><input name='perfName' type='text' maxlength='30' size='30' required='required'></td>
				</tr>

				<tr>
					<td>Résztvevők száma:</td>
					<td colspan='2'><input name='participants' type='number' min='1' max='700' size='3' value='1'></td>
				</tr>

				<tr>
					<td>Kategória:</td>
					<td colspan='2'>
						<select name='category' require='require'>
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
					<td><input name='wiredMic' type='number' min='0' max='2'></td>
					<td>Ebből állványos: </td>
					<td><input name='wiredMicStand' type='number' min='0' max='2'></td>
				</tr>

				<tr>
					<td>Vezetéknélküli mikrofon: </td>
					<td><input name='wirelessMic' type='number' min='0' max='3'></td>
					<td>Ebből állványos: </td>
					<td><input name='wirelessMicStand' type='number' min='0' max='3'></td>
				</tr>

				<tr>
					<td>Térmikrofon (állvánnyal):</td>
					<td colspan='3'><input name='fieldMic' type='number' min='0' max='4'></td>
				</tr>

				<tr>
					<td>Hangszermikrofon (állvánnyal):</td>
					<td colspan='3'><input name='instMic' type='number' min='0' max='2'></td>
				</tr>

				<tr>
					<td>Székek: </td>
					<td colspan='3'><input name='chair' type='number' min='0' max='9'></td>
				</tr>

				<tr>
					<td>Lejátszandó zenefájl:</td>
					<td>Van: <input name='ifMusicFile' type='checkbox' value='yes'></td>
					<td>Fájl(ok) neve:</td>
					<td><input name='musicFileName' type='text' size='30'></td>
				</tr>

				<tr>
					<td>Projektor: </td>
					<td>Kell: <input name='ifProjector' type='checkbox' value='yes'></td>
					<td>Kivetítendő fájl(ok) neve:</td>
					<td><input name='projFileName' type='text' size='30'></td>
				</tr>

				<tr>
					<td>Külön fénytechinkai igény: </td>
					<td colspan='3'>Van: <input name='ifExtraLight' type='checkbox' value='yes'></td>
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
					<td><textarea form='regForm' name='participantUsernames' rows='5' cols='30' maxlength='10000' id='addedUserField'></textarea></td>
					
				</tr>

				<tr>
					<td>Egyéb kérés: </td>
					<td colspan='2'><textarea form='regForm' cols='30' rows='5' maxlength='100' name='comment'></textarea></td>
				</tr>
			</table>
		</fieldset>
		<input type='submit'>
	</form>
	");





 ?>
