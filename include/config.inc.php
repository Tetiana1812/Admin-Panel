<?php
#*****************************************************************************#

				
				#******************************************#
				#********** GLOBAL CONFIGURATION **********#
				#******************************************#
				
				/*
					Konstanten werden in PHP mittels der Funktion define() oder über 
					das Schlüsselwort const (const DEBUG = true;) definiert. Seit PHP7
					ist der Unterschied zwischen den beiden Varianten, dass über 
					const definierte Konstanten nicht innerhalb von Funktionen, Schleifen, 
					if-Statements oder try/catch-Blöcken definiert werden können. Außerdem
					können mittels const definierte Konstanten keine komplexen Datentypen enthalten.
					Konstanten besitzen im Gegensatz zu Variablen kein $-Präfix
					Üblicherweise werden Konstanten komplett GROSS geschrieben.
					
					Konstanten können in PHP auf zwei unterschiedliche Arten deklariert werden:
					Über das Schlüsselwort const und über die Funktion define().
					
					const DEBUG = true;
					define('DEBUG', true);
					
					Der Unterschied zwischen diesen beiden Varianten ist, dass Konstanten, die mittels 
					const deklariert wurden, ausschließlich simple Datentypen anthalten können, Konstanten, 
					die mittels define() deklariert wurden auch komplexe Datentypen.
				*/
				
				
				#********** DATABASE CONFIGURATION **********#
				define('DB_SYSTEM',						'mysql');
				define('DB_HOST',							'localhost');
				define('DB_NAME',							'market');
				define('DB_USER',							'root');
				define('DB_PWD',							'');
				
				
				#********** FORM CONFIGURATION **********#
				define('INPUT_MIN_LENGTH',				2);
				define('INPUT_MAX_LENGTH',				256);


				#********** IMAGE UPLOAD CONFIGURATION **********#
				define('IMAGE_MAX_WIDTH', 				800);
				define('IMAGE_MAX_HEIGHT', 			800);
				define('IMAGE_MAX_SIZE', 				128*1024);				
				define('IMAGE_ALLOWED_MIME_TYPES', 	array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'));
				
				
				#********** STANDARD PATHS CONFIGURATION **********#
				define('IMAGE_UPLOAD_PATH',			'uploads/userimages/');
				define('AVATAR_DUMMY_PATH',			'css/images/avatar_dummy.png');
				define('MEDIA_DOWNLOADS_LINK',		'downloads/media/');
				define('CLASS_PATH',				'Class/');
				
				
				#********** DEBUGGING **********#
				
				define('DEBUG', 						true);	// DEBUGGING for main documents
				define('DEBUG_F', 						false);	// DEBUGGING for functions
				define('DEBUG_DB', 						true);	// DEBUGGING for database functions
				define('DEBUG_C', 						true);	// DEBUGGING for classes
				define('DEBUG_CC', 						true);	// DEBUGGING for class constructors 
				
#*****************************************************************************#
?>