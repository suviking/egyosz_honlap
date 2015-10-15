<?php

error_reporting(E_ALL); 


function res($input)
{
	global $db;
	$output = $db->real_escape_string($input);
	return $output;
}

function html($input)
{
	$output = htmlspecialchars($input);
	return $output;
}

?>