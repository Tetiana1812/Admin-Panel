<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS MOTOR **********#
				#********************************#

				
#*******************************************************************************************#


				class Motor {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					

					private $hubraum;
					private $zylinder;
					private $leistung;
					private $kraftstoff;
					

					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					
					public function __construct($hubraum=NULL, $zylinder=NULL, $leistung=NULL, $kraftstoff=NULL, $motor_name=NULL, $motor_id=NULL){
if(DEBUG_CC)			echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "($hubraum, $zylinder, $leistung, $kraftstoff)  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						
						
						if( $hubraum 	!== NULL AND $hubraum    !== '' ) $this->setHubraum($hubraum);
						if( $zylinder 	!== NULL AND $zylinder 	 !== '' ) $this->setZylinder($zylinder);
						if( $leistung 	!== NULL AND $leistung 	 !== '' ) $this->setLeistung($leistung);
						if( $kraftstoff !== NULL AND $kraftstoff !== '' ) $this->setKraftstoff($kraftstoff);
						if( $motor_name !== NULL AND $motor_name !== '' ) $this->setMotor_name($motor_name);
						if( $motor_id !== NULL AND $motor_id !== '' ) $this->setMotor_id($motor_id);

/* if(DEBUG_CC)			echo "<pre class='debugClass'><b>Line " . __LINE__ .  "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG_CC)			print_r($this);					
if(DEBUG_CC)			echo "</pre>";	 */
					}
					
					
					
					#********** DESTRUCTOR **********#
					
					public function __destruct() {
if(DEBUG_C)				echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

					}
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					#********** HUBRAUM **********#
					public function getHubraum(){
						return $this->hubraum;

					}

					public function setHubraum($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->hubraum = cleanString($value);
						}
					}

					#********** ZYLINDER **********#
					public function getZylinder(){
						return $this->zylinder;

					}

					public function setZylinder($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->zylinder = cleanString($value);
						}
					}
					
					#********** LEISTUNG **********#
					public function getLeistung(){
						return $this->leistung;

					}

					public function setLeistung($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->leistung = cleanString($value);
						}
					}

					#********** KRAFTSTOFF **********#
					public function getKraftstoff(){
						return $this->kraftstoff;

					}

					public function setKraftstoff($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->kraftstoff = cleanString($value);
						}
					}

					#********** MOTOR_ID **********#
					public function getMotor_id(){
						return $this->motor_id;

					}

					public function setMotor_id($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->motor_id = cleanString($value);
						}
					}
					
					#********** MOTOR_NAME **********#
					public function getMotor_name(){
						return $this->motor_name;

					}

					public function setMotor_name($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->motor_name = cleanString($value);
						}
					}
					
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					public static function fetchAllFromDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

						$sql = 'SELECT * FROM motor';

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

						$motorArray = array();

						while ( $row= $statement->fetch(PDO::FETCH_ASSOC)){
/* if(DEBUG)				echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)				print_r($row);					
if(DEBUG)				echo "</pre>";  */
							
							//$hubraum=NULL, $zylinder=NULL, $leistung=NULL, $kraftstoff=NULL, $motor_name, $motor_id=NULL
							$motor = new Motor( $row['motor_hubraum'], $row['motor_zylinder'], 
												$row['motor_leistung'], $row['motor_kraftstoff'], $row['motor_name'], $row['motor_id'] );
							
							
							$motorArray[] = $motor;
					

							
							

						}//Schritt 4 DB: Daten weiterverarbeiten END
						
						//Array mit Objekt Motor zurück geben
						
						return $motorArray;

					}//FETCH FROM DB END


					
					#***********************************************************#
					
				}
				
				
#*******************************************************************************************#
?>


















