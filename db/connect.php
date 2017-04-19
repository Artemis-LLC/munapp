<?php
 	$db = new mysqli('localhost', 'root', '', 'munapp');

 	if($db->connect_errno) { 
 		die('Sorry we having some connection problems');
 	} 
 ?> 