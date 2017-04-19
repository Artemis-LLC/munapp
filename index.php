<?php
error_reporting(0);
session_start(); 
	require 'db/connect.php';

	$records = array();
	if(!empty($_POST)) {
		if(isset($_POST['Name'],$_POST['Host'],$_POST['Info'])) {

				$Name = trim($_POST['Name']); 
				$Host = trim($_POST['Host']); 
				$Info = trim($_POST['Info']); 
				$rawdate = htmlentities($_POST['date']);
				$date = date('Y-m-d', strtotime($rawdate)); 


				
				$insert = $db->prepare("INSERT INTO conferences (Name, date, Info, Host) VALUES (?,?,?,?)");
				$insert->bind_param('ssss', $Name, $date, $Info, $Host);
				$delegateDatabaseName = $Name . "Delegations"; 
                $delegateDatabaseName  = str_replace(' ', '', $delegateDatabaseName);
				$sql = "CREATE TABLE ".$delegateDatabaseName." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				delegation TEXT,
				faculty TEXT,
				payment TEXT
				)";
				if ($db->query($sql) === TRUE) {
				    echo "Table MyGuests created successfully";
				} else {
				    echo "Error creating table: " . $db->error;
				}
					if($insert->execute()) {

						header('Location:index.php'); 
						die(); 
					}
			
			}

	}
	if($results = $db->query("SELECT * FROM conferences")) {
		if($results->num_rows) {
			while($row = $results->fetch_object()) { 
				$records[] = $row; 
			}
			$results->free(); 
		}
	}


 	$query = "SELECT Name FROM `conferences`";

 	$result2 = mysqli_query($db, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[0]</option>";
}

if(isset($_POST['submitconference'])) {
    unset($_SESSION['conference']);
    $_SESSION['conference'] = str_replace(' ', '',$_POST['conference']);  
     header('Location: delegates.php');    
}
$conference = $_SESSION['conference'];
echo $conference; 
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title> </title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
      
     <div class = "container">  <h1>Conferences</h1>
            <?php
			if(!count($records)) {

				echo 'no conferences found'; 
				} else {  
		?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Info</th>
                            <th>Host</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
				foreach($records as $r){
				?>
                            <tr>
                                <td>
                                    <?php echo $r->Name; ?>
                                </td>
                                <td>
                                    <?php echo $r->date; ?>
                                </td>
                                <td>
                                    <?php echo $r->Info; ?>
                                </td>
                                <td>
                                    <?php echo $r->Host; ?>
                                </td>
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
                    <h3>Enter a new conference to be shared with everybody! </h3>
                    <hr>
                    <form action="" method="post">
                        <div class="field">
                            <label for "Name">Conference Name</label>
                            <input type="text" name="Name" id="Name" autocomplete="off"> </div>
                        <div class="field">
                            <label for "Host">Conference Host</label>
                            <input type="text" name="Host" id="Host" autocomplete="off"> </div>
                        <div class="field">
                            <label for "Info">Conference Info</label>
                            <textarea name="Info" id="Info"></textarea>
                        </div>
                        <div class="field">
                            <label for "date">Date insert in YYYY-MM-DD</label>
                            <input type "date" name="date" id="date" />
                            <input type="submit" class="blue lighten-2 btn waves-effect waves-light" value="Insert"> </div>
                    </form>
        
        <hr> 
        
        <h2>See details of the conference</h2>
        <form action = "" method = "post"> 
        <select name = "conference" class = "browser-default">
            <?php echo $options;?>
        </select>
		<input type="submit" name="submitconference" value="Get Selected Values" />

		</form>
        </div>
            </div>

        </body> 
    </html>