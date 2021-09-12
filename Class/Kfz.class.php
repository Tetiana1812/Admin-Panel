<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS KFZ **********#
				#********************************#

				/*
					Die Klasse ist quasi der Bauplan/die Vorlage für alle Objekte, die aus ihr erstellt werden.
					Sie gibt die Eigenschaften/Attribute eines späteren Objekts vor (Variablen) sowie 
					die "Fähigkeiten" (Methoden/Funktionen), über die das spätere Objekt besitzt.

					Jedes Objekt einer Klasse ist nach dem gleichen Schema aufgebaut (gleiche Eigenschaften und Methoden), 
					besitzt aber i.d.R. unterschiedliche Attributswerte.
				*/

				
#*******************************************************************************************#


				class Kfz {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					/* 
						Innerhalb der Klassendefinition müssen Attribute nicht zwingend initialisiert werden.
						Ein Weglassen der Initialisierung bewirkt das gleiche, wie eine Initialisierung mit NULL.
					*/
					protected $motor;
					
					

					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					/*
						Der Konstruktor ist eine magische Methode und wird automatisch aufgerufen,
						sobald mittels des new-Befehls ein neues Objekt erstellt wird.
						Der Konstruktor erstellt eine neue Klasseninstanz/Objekt.
						Soll ein Objekt beim Erstellen bereits mit Attributwerten versehen werden,
						muss ein eigener Konstruktor geschrieben werden. Dieser nimmt die Werte in 
						Form von Parametern (genau wie bei Funktionen) entgegen und ruft seinerseits 
						die entsprechenden Setter auf, um die Werte zuzuweisen.					
					*/
					
					
					
					
					
					#********** DESTRUCTOR **********#
					/*
						Der Destruktor ist eine magische Methode und wird automatisch aufgerufen,
						sobald ein Objekt mittels unset() gelöscht wird, oder sobald das Skript beendet ist.
						Der Destructor gibt den vom gelöschten Objekt belegten Speicherplatz wieder frei.
					*/
					
					
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#

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
				
					#********** VIRTUAL ATTRIBUTES **********#
					public function getDataSheet(){
						$datasheet  	 = "<datasheet>";

						// Klassenname der aktuell aufrufenden Instanz
						$datasheet 		.= "<b>Fahrzeug:</b> <i>" 		   . get_class($this)							. "</i><br>";

						// Karosseriedaten
						if( $this instanceof Pkw ) {
							$datasheet 	.= "<b>Karosserie:</b> <i>" 	   . $this->getKarosserie()->getBauform() 		. "</i><br>";
							$datasheet 	.= "<b>Anzahl Türen:</b> <i>" 	   . $this->getKarosserie()->getTueren() 		. "</i><br>";
							$datasheet 	.= "<b>Anzahl Sitzplätze:</b> <i>" . $this->getKarosserie()->getSitzplaetze() 	. "</i><br>";
						}

						// Gewicht, Achsen, Kabinenform
						if( $this instanceof Lkw ) {
							$datasheet 	.= "<b>Gewicht:</b> <i>" 			. $this->getGewicht() 						. "kg</i><br>";
							$datasheet 	.= "<b>Achsen:</b> <i>" 			. $this->getAchsen() 						. "</i><br>";
							$datasheet 	.= "<b>Kabinenform:</b> <i>"		. $this->getKabine() 						. "</i><br>";
						} 

						// Aufbau
						if( $this instanceof Transporter  ) {
							$datasheet 	.= "<b>Aufbau:</b> <i>" 			. $this->getAufbau() 					. "</i><br>";
						}
						
						// Motordaten
						$datasheet 		.= "<b>Leistung:</b> <i>" 			. $this->getMotor()->getLeistung() 		. " PS</i><br>";
						$datasheet 		.= "<b>Hubraum:</b> <i>" 			. $this->getMotor()->getHubraum() 		. " ccm</i><br>";
						$datasheet 		.= "<b>Zylinder:</b> <i>" 			. $this->getMotor()->getZylinder() 		. "</i><br>";
						$datasheet 		.= "<b>Kraftstoff:</b> <i>" 		. $this->getMotor()->getKraftstoff() 	. "</i><br>";	
						
						$datasheet .= "</datasheet>";
						
						return $datasheet;
					}
					
					
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					


					
					#***********************************************************#
					
				}
				
				
#*******************************************************************************************#
?>


















