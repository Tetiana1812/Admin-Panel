<?php
#**********************************************************************************#
			
			
				#***********************************#
				#********** CONFIGURATION **********#
				#***********************************#
				
				// include(Pfad zur Datei): Bei Fehler wird das Skript weiter ausgeführt. Problem mit doppelter Einbindung derselben Datei
				// require(Pfad zur Datei): Bei Fehler wird das Skript gestoppt. Problem mit doppelter Einbindung derselben Datei
				// include_once(Pfad zur Datei): Bei Fehler wird das Skript weiter ausgeführt. Kein Problem mit doppelter Einbindung derselben Datei
				// require_once(Pfad zur Datei): Bei Fehler wird das Skript gestoppt. Kein Problem mit doppelter Einbindung derselben Datei
				require_once("include/config.inc.php");
				require_once("include/form.inc.php");
				require_once("include/db.inc.php");
				require_once("include/classLoader.inc.php");
				
				#********** INCLUDE CLASSES **********#
				spl_autoload_register('classLoader');

				#********** INITIALIZE VARIABLEN **********#
				$motorObjektSave = NULL;
				$karosserieObjektSave = NULL;

#**********************************************************************************#

				#***************************************************#
				#********** ESTABLICH DATABASE CONNECTION **********#
				#***************************************************#

				$pdo = dbConnect('auto');

			
#**********************************************************************************#
			
				#**********************************************#
				#********** FETCH KAROSSERIE FROM DB **********#
				#**********************************************#
if(DEBUG)		echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Fetching all Karosserie from DB. <i>(" . basename(__FILE__) . ")</i></p>\n";

				$karosserieArray = Karosserie::fetchAllFromDb($pdo);

/* if(DEBUG)	echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)		print_r($karosserieArray);					
if(DEBUG)		echo "</pre>";  */
#**********************************************************************************#

				#*****************************************#
				#********** FETCH MOTOR FROM DB **********#
				#*****************************************#
if(DEBUG)		echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Fetching all Motors from DB. <i>(" . basename(__FILE__) . ")</i></p>\n";

				$motorArray = Motor::fetchAllFromDb($pdo);

/* if(DEBUG)		echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)			print_r($motorArray);					
if(DEBUG)			echo "</pre>";  */
#**********************************************************************************#

				#*******************************************#
				#********** PROCESS FORM NEW AUTO **********#
				#*******************************************#
if(DEBUG)			echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)			print_r($_POST);					
if(DEBUG)			echo "</pre>";

				//Schritt 1 FORM: prüfen, ob Formular abgeschickt wurde
				if( isset($_POST['formNewPkw']) ){
if(DEBUG)			echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Formular 'formNewPkw' wurde abgeschickt. <i>(" . basename(__FILE__) . ")</i></p>\n";

					//Schritt 2 FORM: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$motor_id = cleanString($_POST['motor_id']);
					$karosserie_id = cleanString($_POST['karosserie_id']);
					//$motorObjektSave = new Motor();
					//$karosserieObjektSave = new Karosserie();

					foreach( $motorArray AS $object ){
						if( $object->getMotor_id() == $motor_id ){
if(DEBUG)					echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Motor Objekt wurde gefunden. <i>(" . basename(__FILE__) . ")</i></p>\n";

							$motorObjektSave = $object;
						}
					}

					foreach( $karosserieArray AS $object ){
						if( $object->getKarosserie_id() == $karosserie_id ){
if(DEBUG)					echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Karosserie Objekt wurde gefunden. <i>(" . basename(__FILE__) . ")</i></p>\n";

							$karosserieObjektSave = $object;
						}
					}

/* if(DEBUG)		echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)			print_r($motorObjektSave);					
if(DEBUG)			echo "</pre>"; 


if(DEBUG)			echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)			print_r($karosserieObjektSave);					
if(DEBUG)			echo "</pre>";  */


					//Schritt 4 FORM: Daten weiterverarbeiten

					#**************************************#
					#********** SAVE PKW INTO DB **********#
					#**************************************#

if(DEBUG)			echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Save PKW into DB. <i>(" . basename(__FILE__) . ")</i></p>\n";

					//$motor=NULL, $karosserie=NULL, $pkw_id=NULL
					$pkw = new Pkw($motorObjektSave, $karosserieObjektSave);

					if( !$pkw->saveToDb($pdo) ) {
						//Fehlerfall
if(DEBUG)				echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER beim Speichrn into DB aufgetreten! <i>(" . basename(__FILE__) . ")</i></p>\n";				

					} else {
						//Erfolgsfall
if(DEBUG)				echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: PKW wurde in die DB erfolgreich gespeichrt. <i>(" . basename(__FILE__) . ")</i></p>\n";				

					}

				//PROCESS FORM NEW PKW END
				} elseif( isset($_POST['formNewLkw']) ) {
if(DEBUG)			echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Formular 'formNewLKW' wurde abgeschickt. <i>(" . basename(__FILE__) . ")</i></p>\n";

					//Schritt 2 FORM: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$motor_id 		= cleanString($_POST['motor_id']);
					$lkw_gewicht 	= cleanString($_POST['lkw_gewicht']);
					$lkw_achsen 	= cleanString($_POST['lkw_achsen']);
					$lkw_kabine 	= cleanString($_POST['lkw_kabine']);
					$lkw_aufbau 	= cleanString($_POST['lkw_aufbau']);

					foreach( $motorArray AS $object ){
						if( $object->getMotor_id() == $motor_id ){
if(DEBUG)					echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Motor Objekt wurde gefunden. <i>(" . basename(__FILE__) . ")</i></p>\n";

							$motorObjektSave = $object;
						}
					}

					//Schritt 4 FORM: Daten weiterverarbeiten

					#**************************************#
					#********** SAVE LKW INTO DB **********#
					#**************************************#

if(DEBUG)			echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Save LKW into DB. <i>(" . basename(__FILE__) . ")</i></p>\n";

					//prüfen, ob es LKW odedr Transporter ist
					if( !$_POST['lkw_aufbau'] ){
						//LKW
if(DEBUG)				echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Der Fahrzeug ist LKW. <i>(" . basename(__FILE__) . ")</i></p>\n";
					
						//$gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL
						$lkw = new Lkw($lkw_gewicht, $lkw_achsen, $lkw_kabine, $motorObjektSave);

						if( !$lkw->saveToDb($pdo) ) {
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER beim Speichrn into DB aufgetreten! <i>(" . basename(__FILE__) . ")</i></p>\n";				
	
						} else {
							//Erfolgsfall
if(DEBUG)					echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: LKW wurde in die DB erfolgreich gespeichrt. <i>(" . basename(__FILE__) . ")</i></p>\n";				
	
						}
					}else{
						//Transporter
if(DEBUG)				echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Der Fahrzeug ist Transporter. <i>(" . basename(__FILE__) . ")</i></p>\n";

						//$aufbau=NULL, $gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL
						$transporter = new Transporter($lkw_aufbau, $lkw_gewicht, $lkw_achsen, $lkw_kabine, $motorObjektSave);
					
						if( !$transporter->saveToDb($pdo) ) {
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER beim Speichrn into DB aufgetreten! <i>(" . basename(__FILE__) . ")</i></p>\n";				
	
						} else {
							//Erfolgsfall
if(DEBUG)					echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: Transporter wurde in die DB erfolgreich gespeichrt. <i>(" . basename(__FILE__) . ")</i></p>\n";				
	
						}
					}//SAVE LKW INTO DB END
				
				}//PROCESS FORM NEW LKW END


#**********************************************************************************#
	
				#***************************************#
				#********** FETCH KFZ FROM DB **********#
				#***************************************#
if(DEBUG)		echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Fetching all Autos from DB. <i>(" . basename(__FILE__) . ")</i></p>\n";

				$pkwArray = Pkw::fetchAllFromDb($pdo);
				$lkwArray = Lkw::fetchAllFromDb($pdo);

/* if(DEBUG)	echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)	print_r($pkwArray);					
if(DEBUG)	echo "</pre>"; 

if(DEBUG)	echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)	print_r($lkwArray);					
if(DEBUG)	echo "</pre>";  */

#**********************************************************************************#
	
?>

<!doctype html>

<html>
	
	<head>
	
		<link rel="stylesheet" href="../../css/main.css">
		<link rel="stylesheet" href="../../css/debug.css">
		
		<meta charset="utf-8">
		<title>Lösung Tag 5</title>
		
		<style>
			datasheet {
				display: inline-block;
				width: 20%;
				border: 1px solid gray;
				border-radius: 5px;
				padding: 20px;
				background-color: lavender;
				margin: 10px;
			}
		</style>
	</head>
	
	<body>
		<h1>Lösung Tag 5</h1>
		
		<br>
		<hr>
		<br>
		
		<h2>Abzubildendes Klassendiagramm</h2>
		<img src="Klassendiagramm-Kfz.png" style="width: 100%">
		
		<br>
		<hr>
		<br>
		
		

		<h3>Karosserie</h3>
		<table>
			<tr>
				<th>ID:</th>
				<th>Bauform:</th>
				<th>Anzahl Türen::</th>
				<th>Anzahl Sitzprätzen:</th>
			</tr>
			<?php forEach( $karosserieArray AS $karosserieObjekt ) : ?>
				<tr>
					<td><?= $karosserieObjekt->getKarosserie_id() ?></td>
					<td><?= $karosserieObjekt->getBauform() ?></td>
					<td><?= $karosserieObjekt->getTueren() ?></td>
					<td><?= $karosserieObjekt->getSitzplaetze() ?></td>
				</tr>
			<?php endforeach ?>
		</table>

		<h3>Motor</h3>
		<table>
			<tr>
				<th>Motor_id</th>
				<th>Name des Motors:</th>
				<th>Hubraum:</th>
				<th>Anzahl Zylinder:</th>
				<th>Leistung:</th>
				<th>Kraftstoff</th>
			</tr>
			<?php forEach( $motorArray AS $motorObjekt ) : ?>
				<tr>
					<td><?= $motorObjekt->getMotor_id() ?></td>
					<td><?= $motorObjekt->getMotor_name() ?></td>
					<td><?= $motorObjekt->getHubraum() ?></td>
					<td><?= $motorObjekt->getZylinder() ?></td>
					<td><?= $motorObjekt->getLeistung() ?></td>
					<td><?= $motorObjekt->getKraftstoff() ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<br>
		<br>
		<br>
		
		<form action="index.php" method="POST">
				<input type="hidden" name="formNewLkw">

				<fieldset>
					<legend>Neuen Lkw anlegen:</legend>
					<br>

					<!-- Neu in PHP8: Der erweiterte Zugriffsoperator ?-> prüft, ob ein Objekt NULL ist
					und ruft den anschließend notierten Getter nur auf, wenn das Objekt nicht NULL ist -->
					<label>Motor:</label>
					<select name="motor_id">
						<?php foreach($motorArray AS $motorObjekt) : ?> 
							<option value="<?= $motorObjekt->getMotor_id() ?>" <?= $motorObjekt->getMotor_id() == $motorObjektSave?->getMotor_id() ? 'selected' : '' ?>><?= $motorObjekt->getMotor_name() ?></option>
						<?php endforeach ?>
					</select>
					<br>
					<br>
					<hr>
					<br>
					<label>LKW Fahrzeug:</label>
				
					<br>
					<br>
					<label>Parameter des Fahrzeugs:</label><br>
					<input type="text" name="lkw_gewicht" id="lkw_gewicht" placeholder="Gewicht">
					<input type="text" name="lkw_achsen" id="lkw_achsen" placeholder="Achsen">
					<input type="text" name="lkw_kabine" id="lkw_kabine" placeholder="Kabinenform">
					<input type="text" name="lkw_aufbau" id="lkw_aufbau" placeholder="Wenn es Transporter ist, Aufbau">
					<br>
					<br>
					<hr>
					<input type="submit" value="Neuen LKW anlegen">
					</fieldset>
				</form>
						<br>
						<br>
						<hr>
				<form action="index.php" method="POST">
					<input type="hidden" name="formNewPkw">
					
					<br>
					<fieldset>
					<legend>Neuen Pkw anlegen:</legend>
					<br>
					<br>
					<label>Motor:</label>
					<select name="motor_id">
						<?php foreach($motorArray AS $motorObjekt) : ?> 
							<option value="<?= $motorObjekt->getMotor_id() ?>" <?= $motorObjekt->getMotor_id() == $motorObjektSave?->getMotor_id() ? 'selected' : '' ?>><?= $motorObjekt->getMotor_name() ?></option>
						<?php endforeach ?>
					</select>
					<br>
					<br>
					<hr>
					<br>
					<label>PKW:</label>
					<select name="karosserie_id">
						<?php foreach($karosserieArray AS $karosserieObjekt) : ?> 
							<option value="<?= $karosserieObjekt->getKarosserie_id() ?>" <?= $karosserieObjekt?->getKarosserie_id() == $karosserieObjektSave?->getKarosserie_id() ? 'selected' : '' ?>><?= $karosserieObjekt->getBauform() ?></option>
						<?php endforeach ?>
					</select>
					<br>
					<br>
					<br>
					
					<input type="submit" value="Neuen Pkw anlegen">

				</fieldset>
			</form>
		
			<?php if( !empty($pkwArray) AND !empty($lkwArray)) : ?>
				<h3>Fahrzeuge, dieschon in der DB ausgespeichert wurden</h3>
				<?php if( !empty($pkwArray) ) : ?>
					<table>
						<tr>
							<th>Fahrzeug</th>
							<th>Karosserie:</th>
							<th>Anzahl Türen:</th>
							<th>Anzahl Sitzplätze:</th>
							<th>Hubraum:</th>
							<th>Zylinder:</th>
							<th>Kraftstoff</th>
						</tr>
						<?php forEach( $pkwArray AS $value ) : ?>
							<tr>
								<td><?= get_class($value) ?></td>
								<td><?= $value->getKarosserie()	->getBauform() 		?></td>
								<td><?= $value->getKarosserie()	->getTueren() 		?></td>
								<td><?= $value->getKarosserie()	->getSitzplaetze() 	?></td>
								<td><?= $value->getMotor()		->getHubraum() 		?></td>
								<td><?= $value->getMotor()		->getZylinder()  	?></td>
								<td><?= $value->getMotor()		->getKraftstoff()  	?></td>
							</tr>
						<?php endforeach ?>
					</table>
					<br>
			
			<?php endif ?>
		
			<br>
			<br>
			<hr>
			<br>
			<?php if( !empty($lkwArray) ) : ?>
			<table>
				<tr>
					<th>Fahrzeug</th>
					<th>Gewicht:</th>
					<th>Achsen:</th>
					<th>Kabinenform:</th>
					<th>Aufbau:</th>
					<th>Leistung:</th>
					<th>Hubraum:</th>
					<th>Zylinder:</th>
					<th>Kraftstoff:</th>
				</tr>
				<?php forEach( $lkwArray AS $value ) : ?>
					<tr>
						<td><?= get_class($value) ?></td>
						<td><?= $value->getGewicht() 		?></td>
						<td><?= $value->getAchsen() 		?></td>
						<td><?= $value->getKabine() 	?></td>
						<td>
							<!-- Unterscheidung nach Objekttyp Lkw/Transporter -->
							<?php if( $value instanceof Transporter ) : ?>
								<?= $value->getAufbau() ?>
								<?php elseif( $value instanceof Lkw ) : ?> 
								<?= '' ?>
							<?php endif ?>
						</td>
						<td><?= $value->getMotor()		->getLeistung() 		?></td>
						<td><?= $value->getMotor()		->getHubraum()  	?></td>
						<td><?= $value->getMotor()		->getZylinder()  	?></td>
						<td><?= $value->getMotor()		->getKraftstoff() 		?></td>
										
					</tr>
				<?php endforeach ?>
			</table>
			<br>
			<br>
			<br>
			<?php endif ?>
			<?php endif ?>
		
		
		
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
	</body>
	
</html>