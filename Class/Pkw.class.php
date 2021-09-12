<?php
#*******************************************************************************************#


				#*******************************#
				#********** CLASS PKW **********#
				#*******************************#

#*******************************************************************************************#


				class Pkw extends Kfz {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					private $karosserie;
					private $pkw_id;
					
	
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					
					public function __construct( $motor=NULL, $karosserie=NULL, $pkw_id=NULL ) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";						
						
						// SETTER nur aufrufen, wenn der jeweilige Parameter einen gültigen Wert besitzt
						if($motor)				$this->setMotor($motor);
						if($karosserie)			$this->setKarosserie($karosserie);
						if($pkw_id)				$this->setPkw_id($pkw_id);
						
/* if(DEBUG_C)			echo "<pre class='debugClass'><b>Line  " . __LINE__ .  "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";					
if(DEBUG_C)			print_r($this);					
if(DEBUG_C)			echo "</pre>";	 */					
					}
					
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					#********** Karosserie **********#
					public function getKarosserie() {
						return $this->karosserie;
					}
					public function setKarosserie($value) {						
						// Vor dem Schreiben auf korrekten Datentyp prüfen
						if( !$value instanceof Karosserie ) {
							echo "<p class='error'>Karosserie: Muss ein Objekt der Klasse 'Karosserie' sein!</p>";
						
						} else {
							$this->karosserie		= $value;
						}
					}
					#********** MOTOR **********#
					
					public function getMotor(){
						return $this->motor;
					}

					public function setMotor($value){
						if( !$value instanceof Motor ){
							//Fehlerfall
if(DEBUG)	echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss Objekt der Klasse 'Motor' sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->motor = $value;
						}
					}
					
					#********** PKW_ID **********#
					
					public function getPkw_id(){
						return $this->pkw_id;
					}

					public function setPkw_id($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)	echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss string sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->pkw_id = $value;
						}
					}

					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					


					
					#***********************************************************#
					public static function fetchAllFromDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

						$sql = 'SELECT * FROM pkw
								INNER JOIN motor USING(motor_id)
								INNER join karosserie USING(karosserie_id)
								ORDER BY(pkw_id)';

						$params = array();

						//Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);

						//Schritt 3 DB: SQL-Statement auführen und ggf. Platzhalter füllen
						try {	
							$statement->execute();						
						} catch(PDOException $error) {
if(DEBUG_C)		echo "<p class='debugClass err'><b>Line " . __LINE__ . "</b>: FEHLER: " . $error->GetMessage() . "<i>(" . basename(__FILE__) . ")</i></p>\n";										
							$dbError = 'Fehler beim Zugriff auf die Datenbank!';
						}	

						//Schritt 4 DB: Daten weiterverarbeiten
						//Bei lesendem Zugriff: Datensätze abholen

						$pkwArray = array();

						while ( $row= $statement->fetch(PDO::FETCH_ASSOC)){
							
/* if(DEBUG)				echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)				print_r($row);					
if(DEBUG)				echo "</pre>";  */
							//$hubraum=NULL, $zylinder=NULL, $leistung=NULL, $kraftstoff=NULL
							$motor = new Motor( $row['motor_hubraum'], $row['motor_zylinder'],
												$row['motor_leistung'], $row['motor_kraftstoff'], $row['motor_id']);
							
							//$bauform=NULL, $tueren=NULL, $sitzplaetze=NULL
							$karosserie = new Karosserie( $row['karosserie_bauform'], $row['karosserie_tueren'], 
													      $row['karosserie_sitzplaetze'], $row['karosserie_id']);
							
							//$motor=NULL, $karosserie=NULL, $pkw_id=NULL
							$pkw = new Pkw($motor, $karosserie, $row['pkw_id']);
						

							$pkwArray[] = $pkw;
					

							
							

						}//Schritt 4 DB: Daten weiterverarbeiten END
						
						//Array mit Objekt Pkw zurück geben
						
						return $pkwArray;

					}//FETCH FROM DB END

					#***********************************************************#

					public function saveToDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";
						
						$sql = 'INSERT INTO pkw
						(karosserie_id, motor_id)
						VALUES
						(?, ?)';
						$params = array( $this->getKarosserie()->getKarosserie_id(),
										$this->getMotor()->getMotor_id());

						//Schritt 2 DB: SQL-Statements vorbereiten
						$statement = $pdo->prepare($sql);

						//Schritt 3 DB: SQL-Statement ausführen und ggf. Plathalter füllen
						try {	
							$statement->execute($params);						
						} catch(PDOException $error) {
if(DEBUG_C)					echo "<p class='debugClass err'><b>Line " . __LINE__ . "</b>: FEHLER: " . $error->GetMessage() . "<i>(" . basename(__FILE__) . ")</i></p>\n";										
							$dbError = 'Fehler beim Zugriff auf die Datenbank!';
						}	

						//Schritt 4 DB: Daten weiterverarbeiten
						//Bei schreibendem Zugriff: Schreiberfolg prüfen
						$rowCount = $statement->rowCount();
if(DEBUG_C)				echo "<p class='debug'><b>Line " . __LINE__ . "</b>: \$rowCount: $rowCount <i>(" . basename(__FILE__) . ")</i></p>\n";

						if ( !$rowCount ) {
							//Fehlerfall
							return false;
						}else{
							//Erfolgsfall

							//LastInsertId auslesen und ins Objekt schreiber
							$this->setPkw_id($pdo->lastInsertId());
							return true;
						}



					}// SAVE TO DB END

				
			}			
#*******************************************************************************************#
?>


















