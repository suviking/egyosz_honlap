<?php

require_once("include/cookiecheck.php");
require_once("theme/currentTheme.php");

require_once("include/head.php");

echo $headerText."<div class='navbar-collapse collapse navbar-warning-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li>
						<a href='index.php'>Vissza</a>
					</li>
					<li>
						<a href='logout.php'>Kijelentkezés</a>
					</li>
				</ul>
			</div>
		</div>

		<div class='jumbotron' style='margin: 5%; margin-left: 10%; margin-right: 10%; padding: 3%;'>
			<h2 align='center'>Illyés Napok produkciók</h2>
			<h2 align='center'>Szabályzat, jelentkezés, fájlok leadása</h2>
			<br>
			<div class='panel panel-warning'>
				<div class='panel-heading'><h4>Színdarab:</h4></div>
				<ul style='font-size: 125%;'>
					<li>A színdarabok maximum időtartama 12 perc. Ez már magában kell, hogy foglalja a színpad előkészítését, kellékek
					felpakolását, a színdarab végén a lepakolást.</li>
					<li>Az időtúllépésért pontlevonás jár.</li>
					<li>Minden, a színdarabhoz szükséges fájl a többi fájl leadásával azonos módon, azonos határidővel kell leadni.</li>
					<li>Ha külön hang- és fénytechnikai igényed van, azt a 
					<span class='text-primary' data-toggle='tooltip' data-placement='top' title='' 
					data-original-title='2016. 12. 05. 24:00'>JELENTKEZÉSI határidőig</span> 
					kell jelezned.</li>
				</ul>
				<button type='button' class='btn btn-default' data-toggle='tooltip' data-placement='top' title='' data-original-title='Tooltip on right'>Right</button>
			</div>"; ?>
			<button type="button" class="btn btn-default" data-toggle="tooltip" placement="top" title="" data-original-title="Tooltip on right">Right</button>
			<?php
			echo "<div class='panel panel-warning'>
				<div class='panel-heading'><h4>Videó:</h4></div>
				<ul style='font-size: 125%;'>
					<li>A videók maximum időtartama 5 perc lehet. Időtúllépésért pontlevonás jár.</li>
					<li>A videókat maximum 1080p felbontásban (FullHD) lehet leadni.</li>
					<li>A videód maximum 500MB lehet.</li>
				</ul>
			</div>

			<p>Jelentkezni az <a href='illyes-egyosz.tk'>illyes-egyosz.tk</a> weboldalon tudsz az iskolai felhasználóneveddel 
			és az OM azonosítóddal (7&nbsp-essel kezdődő). A jelentkezés határideje <strong>2016. 12. 05. (hétfő) 24:00.</strong> 
			Ez után a rendszer lezár és már nincs mód a jelentkezésed elfogadására.</p>


			<p>A fájlokat a saját google-drive fiókba töltsétek fel, majd az 
			<a href='mailto:illyes.egyosz+files@gmail.com?Subject=IllyesNapokFile' target='_top'>illyes.egyosz+files@gmail.com</a> 
			címre osszátok meg. 
			Bármi kérdésetek merül ezzel fel, a stúdió szívesen segít. A fájlok leadási határideje 
			<strong>2016.&nbsp12.&nbsp15.&nbsp(csütörtök)&nbsp24:00.</strong> Az ezután elküldött fájlokat már technikai okokból nem 
			tudjuk elfogadni.</p>
		</div>
		";





?>