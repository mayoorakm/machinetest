<?php 

if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) {
	$local = TRUE;
} else {
	$local = FALSE;
}

if ($local) {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'vibes');
	define('DB_NAME', 'sippy190');
} else {
	define('DB_HOST', '154.51.184.30'); //host
	define('DB_USER', 'bot'); //write youe own DB username
	define('DB_PASSWORD', '336L3nK'); //write youe own DB password//336L3nK0
	define('DB_NAME', 'sippy190'); //write youe own DB name
}


($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASSWORD)) or die ('I cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) ;
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . constant('DB_NAME')));



?>