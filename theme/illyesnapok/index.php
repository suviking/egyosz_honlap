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
							<optgroup label='Egyéni vagy duó'>
								<option value='asdf'>asdf</option>
							</optgroup>
							<optgroup label='Csoportos'>
								<option value='asdf'>asd</option>
							</optgroup>
						</select>
					</td>
				</tr>

				<tr>
					<td>Produkció hossza:</td>
					<td colspan='2'><input name='duration' type='number' min='1' max='15' size='3' value='2'>(Inkább fölfele kerekíts!)</td>
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
					<td><input name='email' type='email' size='30' required='required'></td>
				</tr>

				<tr>
					<td>Résztvevők hozzáadása: </td>
					<td></td>
				</tr>

				<tr>
					<td>Egyéb kérés: </td>
					<td><textarea form='regForm' cols='30' rows='5' maxlength='100'></textarea></td>
				</tr>
			</table>
		</fieldset>
		<input type='submit'>
	</form>
	");





 ?>
