<?php
#*******************************************************************************************#


				#***************************************#
				#********** CLASS TRANSPORTER **********#
				#***************************************#

				
#*******************************************************************************************#


				class Transporter extends Lkw {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					

					private $aufbau;
					private $lkw_id;
					

					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					
					public function __construct($aufbau=NULL, $gewicht=NULL, $achsen=NULL, $kabine=NULL, $motor=NULL, $lkw_id=NULL){
if(DEBUG_CC)			echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						

						if( $aufbau 		!== NULL AND $aufbau 	  	 !== '' ) $this->setAufbau($aufbau);
 						if( $gewicht 		!== NULL AND $gewicht    	 !== '' ) $this->setGewicht($gewicht);
						if( $achsen 		!== NULL AND $achsen		 !== '' ) $this->setAchsen($achsen);
						if( $kabine 		!== NULL AND $kabine 		 !== '' ) $this->setKabine($kabine);
						if( $motor 			!== NULL AND $motor 	 	 !== '' ) $this->setMotor($motor);
						if( $lkw_id 		!== NULL AND $lkw_id 		 !== '' ) $this->setLkw_id($lkw_id);

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
				
					#********** AUFBAU **********#
					public function getAufbau(){
						return $this->aufbau;
					}

					public function setAufbau($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->aufbau = cleanString($value);
						}
					}

					#********** Lkw_ID **********#
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
						(lkw_gewicht, lkw_achsen, lkw_kabine, lkw_aufbau, motor_id)
						VALUES
						(?, ?, ?, ?, ?)';
						$params = array( $this->getGewicht(),
										$this->getAchsen(),
										$this->getKabine(),
										$this->getAufbau(),
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
					
				}
				
				
#*******************************************************************************************#
?>


















