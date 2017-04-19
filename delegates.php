<?php
session_start(); 
	error_reporting(0);
	$db = new mysqli('localhost', 'root', '', 'munapp');

 	if($db->connect_errno) { 
 		die('Sorry we having some connection problems');
 	} 
	$records = array();
    $selected_val = $_SESSION['conference'];  // Storing Selected Value In Variable
     // Displaying Selected Value
    $selected_val = str_replace(' ', '', $selected_val);
    $delegationsdatabase = $selected_val . "delegations"; 
    $query = "SELECT delegation FROM ".$delegationsdatabase."";

 	$result2 = mysqli_query($db, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[0]</option>";
}

if(isset($_POST['submit'])){
			unset($_SESSION['delegation']);
            $_SESSION['delegation'] = str_replace(' ', '',$_POST['delegation']);
            echo $_SESSION['delegation'];
        header('Location: delegate.php');    

		}


$delegatetable = $selected_val . "delegations";
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
        <title> </title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="delegates.php" class="brand-logo">
                    <?php echo $selected_val; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="adddelegation.php">Add a new delegation</a></li>
                    <li><a href="index.php">Other conferences</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h3>Delegations</h3>
            <?php
					if(!count($records)) {

						echo 'no delegations found'; 
						} else {  
				?>
                <table>
                    <thead>
                        <tr>
                            <th>School</th>
                            <th>Faculty Information</th>
                            <th>Payment Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						foreach($records as $r){
						?>
                            <tr>
                                <td>
                                    <?php echo $r->delegation; ?>
                                </td>
                                <td>
                                    <?php echo $r->faculty; ?>
                                </td>
                                <td>
                                    <?php echo $r->payment; ?>
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
                    <h4>Delegates</h4>
                    <h6>Select the delegation below in order to see the delegates for the delegation</h6>
                    <form action="" method="post">
                        <select name="delegation" class="browser-default">
                            <?php echo $options;?>
                        </select>
                        <input type="submit" name="submit" class="blue lighten-2 btn waves-effect waves-light" value="See delegates for this delegation" /> </form>
                    <hr> </div>
    </body>

    </html>