<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS KAROSSERIE **********#
				#********************************#

				
#*******************************************************************************************#


				class Karosserie {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
				
					private $bauform;
					private $tueren;
					private $sitzplaetze;
					private $karosserie_id;
					

					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					
					public function __construct($bauform=NULL, $tueren=NULL, $sitzplaetze=NULL, $karosserie_id=NULL){
if(DEBUG_CC)			echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "($bauform, $tueren, $sitzplaetze)  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						
						
						if( $bauform 	 !== NULL AND $bauform    	!== '' ) $this->setBauform($bauform);
						if( $tueren 	 !== NULL AND $tueren 	 	!== '' ) $this->setTueren($tueren);
						if( $sitzplaetze !== NULL AND $sitzplaetze	!== '' ) $this->setSitzplaetze($sitzplaetze);
						if( $karosserie_id !== NULL AND $karosserie_id	!== '' ) $this->setKarosserie_id($karosserie_id);

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
				
					#********** BAUFORM **********#
					public function getBauform(){
						return $this->bauform;

					}

					public function setBauform($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->bauform = cleanString($value);
						}
					}

					#********** TUEREN **********#
					public function getTueren(){
						return $this->tueren;

					}

					public function setTueren($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->tueren = cleanString($value);
						}
					}

					#********** SITZPLAETZE **********#
					public function getSitzplaetze(){
						return $this->sitzplaetze;

					}

					public function setSitzplaetze($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->sitzplaetze = cleanString($value);
						}
					}

					#********** KAROSSERIE_ID **********#
					public function getKarosserie_id(){
						return $this->karosserie_id;

					}

					public function setKarosserie_id($value){
						if( !is_string($value) ){
							//Fehlerfall
if(DEBUG)					echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: $value muss String sein! <i>(" . basename(__FILE__) . ")</i></p>\n";				

						}else{
							//Erfolgsfall
							$this->karosserie_id = cleanString($value);
						}
					}
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					public static function fetchAllFromDb(PDO $pdo){
if(DEBUG_C)				echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

						$sql = 'SELECT * FROM karosserie';

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

						$karosserieArray = array();

						while ( $row= $statement->fetch(PDO::FETCH_ASSOC)){
							// Je Schleifendurchlauf ein Objekt aus dem Array $row erstellen
							// und das Objekt in ein Array schreiben

							// Da das Product-Objekt ein Mediatype-Objekt enthalten soll, wird zunächst ein
							// Mediatype-Objekt erzeugt
							// $media_id=NULL, $media_label=NULL
/* if(DEBUG)				echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG)				print_r($row);					
if(DEBUG)				echo "</pre>";  */
							
							//$bauform=NULL, $tueren=NULL, $sitzplaetze=NULL
							$karosserie = new Karosserie( $row['karosserie_bauform'], $row['karosserie_tueren'], 
															$row['karosserie_sitzplaetze'], $row['karosserie_id']);
							
							
							$karosserieArray[] = $karosserie;
					

							
							

						}//Schritt 4 DB: Daten weiterverarbeiten END
						
						//Array mit Objekt Karosserie zurück geben
						
						return $karosserieArray;

					}//FETCH ALL FROM DB END


					
					#***********************************************************#
					
				}
				
				
#*******************************************************************************************#
?>


















