<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS LKW **********#
				#********************************#

				
#*******************************************************************************************#


				class Lkw extends Kfz {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					protected $gewicht;
					protected $achsen;
					protected $kabine;
					private $lkw_id;
					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					public function __construct($gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL, $lkw_id=NULL){
if(DEBUG_CC)			echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						
						
						if( $gewicht 	!== NULL AND $gewicht    !== '' ) $this->setGewicht($gewicht);
						if( $achsen 	!== NULL AND $achsen 	 !== '' ) $this->setAchsen($achsen);
						if( $kabine 	!== NULL AND $kabine 	 !== '' ) $this->setKabine($kabine);
						if( $motor 		!== NULL AND $motor 	 !== '' ) $this->setMotor($motor);
						if( $lkw_id		!== NULL AND $lkw_id 	 !== '' ) $this->setLkw_id($lkw_id);


/* if(DEBUG_CC)			echo "<pre class='debugClass'><b>Line " . __LINE__ .  "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG_CC)			print_r($this);					
if(DEBUG_CC)			echo "</pre>"; */	
					}
					
					
					
					#********** DESTRUCTOR **********#
					
					public function __destruct() {
if(DEBUG_C)				echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

					}
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					#********** GEWICHT **********#

					public function getGewicht(){
						return $this->gewicht;
					}

					public function setGewicht($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->gewicht = cleanString($value);
						}
					}

					#********** ACHSEN **********#

					public function getAchsen(){
						return $this->achsen;
					}

					public function setAchsen($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->achsen = cleanString($value);
						}
					}

					#********** KABINE **********#

					public function getKabine(){
						return $this->kabine;
					}

					public function setKabine($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->kabine = cleanString($value);
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
					
					#********** LKW_ID **********#

					public function getLkw_id(){
						return $this->lkw_id;
					}

					public function setLkw_id($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->lkw_id = $value;
						}
					}
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					public function saveToDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";
						
						$sql = 'INSERT INTO lkw
						(lkw_gewicht, lkw_achsen, lkw_kabine, motor_id)
						VALUES
						(?, ?, ?, ?)';
						$params = array( $this->getGewicht(),
										$this->getAchsen(),
										$this->getKabine(),
										$this->getMotor()->getMotor_id()
										);

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
							$this->setLkw_id($pdo->lastInsertId());
							return true;
						}



					}// SAVE TO DB END


					
					#***********************************************************#
					
					public static function fetchAllFromDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

						$sql = 'SELECT * FROM lkw
								INNER JOIN motor
								USING(motor_id)';

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

						$lkwArray = array();
						$lkwObject = new Lkw();

						while ( $row= $statement->fetch(PDO::FETCH_ASSOC)){
							
/* if(DEBUG_C)				echo "<pre class='debugCLass'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG_C)				print_r($row);					
if(DEBUG_C)				echo "</pre>"; */
							
							//$hubraum=NULL, $zylinder=NULL, $leistung=NULL, $kraftstoff=NULL, $motor_name, $motor_id=NULL
							$motor = new Motor( $row['motor_hubraum'], $row['motor_zylinder'], 
												$row['motor_leistung'], $row['motor_kraftstoff'], $row['motor_name'], $row['motor_id'] );
							

							#********** ENTWEDER PHYSICAL PRODUCT ODER DIGITAL PRODUCT OBJEKT ERSTELLEN **********#
							if(!$row['lkw_aufbau']){
								//$gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL, $lkw_id=NULL)

								$lkwObject = new Lkw($row['lkw_gewicht'], $row['lkw_achsen'], 
								$row['lkw_kabine'], $motor, $row['lkw_id'] );
							}else{
								//$aufbau=NULL, $gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL, $transporter_id=NULL

								$lkwObject = new Transporter($row['lkw_aufbau'], $row['lkw_gewicht'], $row['lkw_achsen'], 
								$row['lkw_kabine'], $motor, $row['lkw_id']);
							}

							$lkwArray[] = $lkwObject;
				

						}//Schritt 4 DB: Daten weiterverarbeiten END
						
						//Array mit Objekt Lkw zurück geben
						
						return $lkwArray;

					}//FETCH FROM DB END
				}
				
				
#*******************************************************************************************#
?>

















