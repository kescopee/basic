<?php

// database configuration and connection

function db_connect(){
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'contacts';

	$out = new mysqli($db_host, $db_user, $db_pass, $db_name) or die($out->connect_error);
	return $out;
}

?>