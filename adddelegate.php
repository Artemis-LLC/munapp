<?php 
    error_reporting(0); 
	session_start();

	$selected_val= $_SESSION['conference']; 
	$selected_delegation = $_SESSION['delegation']; 

	$db = new mysqli('localhost', 'root', '', 'munapp');

	 	if($db->connect_errno) { 
	 		die('Sorry we having some connection problems');
	 	} 
		$records = array();

	$nospacesdelegation  = str_replace(' ', '', $selected_delegation);
    $selected_val = str_replace(' ', '', $selected_val);
	$delegatetable = $selected_val . $nospacesdelegation . "delegates";
	if(!empty($_POST)) {
				if(isset($_POST['Name'],$_POST['Country'],$_POST['Contact'],$_POST['Committee'])) {

						$Name = trim($_POST['Name']); 
						$Country = trim($_POST['Country']); 
						$Contact = trim($_POST['Contact']); 
						$Committee = trim($_POST['Committee']); 
						
						$insert = $db->prepare("INSERT INTO ".$delegatetable." (Name, Country, Contact, Committee) VALUES (?,?,?,?)");
						$insert->bind_param('ssss', $Name, $Country, $Contact, $Committee);
						
							if($insert->execute()) {

								header('Location:delegate.php'); 
								die(); 
							}
					
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

    <body>
         <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="delegates.php" class="brand-logo">
                    <?php echo $_SESSION['conference']; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="delegates.php">Go back to the conference page</a></li>
                    <li><a href="index.php">Other conferences</a></li>
                    <li><a href="delegate.php">See the other delegates in this delegation</a></li>
                </ul>
            </div>
        </nav>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <form action="" method="post">
            <div class="field">
                <label for "Name">Delegation Name</label>
                <input type="text" name="Name" id="Name" autocomplete="off"> </div>
            <div class="field">
                <label for "Country">Country</label>
                <input type="text" name="Country" id="Country" autocomplete="off"> </div>
            <div class="field">
                <label for "Contact">Contact Information</label>
                <textarea name="Contact" id="Contact"></textarea>
            </div>
            <div class="field">
                <label for "Committee">Committee </label>
                <input type="text" name="Committee" id="Committee" autocomplete="off"> </div>
            <input type="submit" name="submit" value="Insert"> </form>
    </body>

    </html>