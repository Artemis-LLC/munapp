	<?php 
		session_start(); 
		$db = new mysqli('localhost', 'root', '', 'munapp');

	 	if($db->connect_errno) { 
	 		die('Sorry we having some connection problems');
	 	} 
		$records = array();

	 	
    
		

		$delegatetable = $_SESSION['conference'] . $_SESSION['delegation'] . "delegates";
        echo $delegatetable;
		if($results = $db->query("SELECT * FROM ".$delegatetable."")) {
			if($results->num_rows) {
				while($row = $results->fetch_object()) { 
					$records[] = $row; 
				}
				$results->free(); 
			}
		}

		
	?> 
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
      
		
			<h3>Delegates</h3>
					<?php
						if(!count($records)) {

							echo 'no delegates found'; 
							} else {  
					?>
					<table> 
						<thead><tr> 
							<th>id</th>
							<th>name</th>
							<th>country</th>
							<th>contact</th>
							<th>committee</th>
							</tr>
							</thead>
						<tbody>
						<?php
							foreach($records as $r){
							?>
							<tr>
								<td><?php echo $r->id; ?></td>
								<td><?php echo $r->Name; ?></td>
								<td><?php echo $r->Country; ?></td>
								<td><?php echo $r->Contact; ?></td>
								<td><?php echo $r->Committee; ?></td>

							</tr>
							<?php
						}
							?>
						</tbody>	
					</table>
					<?php 
								} 
							?>

					<hr> 



	</body>
	</html>
