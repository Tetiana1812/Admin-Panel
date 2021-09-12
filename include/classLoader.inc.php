<?php
#******************************************************************************************************#

				#********** CLASS LOADER **********#
				function classLoader($name) {
if(DEBUG_F)		    echo "<p class='debugClassLoader'><b>Line " . __LINE__ . "</b>: Aufruf " . __FUNCTION__ . "('$name') <i>(" . basename(__FILE__) . ")</i></p>\n";	
					
					#********** CHECK IF $name IS INTERFACE **********#
					if( str_ends_with($name, 'Interface') ){
						$fileType = 'Interface';

					}else{
					#********** CHECK IF $name IS CLASS **********#
						$fileType = 'Class';

					}


					#********** GENERATE PATH FOR CLASS FILE **********#
					$filePath = CLASS_PATH .$name . '.class.php';

					#********** CHECK IF FILE EXISTS **********#
					if( !file_exists($filePath) ) {
						//Fehlerfall
if(DEBUG_F)				echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER: <i>$fileType</i> <b>'$name'</b> unter <i>'$filePath'</i> wurde nicht gefunden! <i>(" . basename(__FILE__) . ")</i></p>\n";				
						
						//Ausnahmeweise echo-Ausgabe in der Funktion, da aus dieser speziellen Funktion 
						//kein return-Wert empfangen werden kann, damit wir Script abbrechen können
						echo '<h2 class="error">Es ist ein Fehler aufgetreten! Bitte versuchen Sie es später noch ein Mal</h2>';
						exit;

					} else {
						//Erfolgsfall
if(DEBUG_F)				echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: <i>$fileType</i> <b>'$name'</b> unter <i>'$filePath'</i> wurde gefunden und wird eingebunden... <i>(" . basename(__FILE__) . ")</i></p>\n";				

						$loadError = NULL;
						#********** INCLUDE FILE **********#
						require_once($filePath);
					}

					
				}
				#********** CLASS LOADER END **********#
				
#******************************************************************************************************#
?>