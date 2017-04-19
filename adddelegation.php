<?php 
        session_start(); 
			error_reporting(0);
			$db = new mysqli('localhost', 'root', '', 'munapp');
		 	if($db->connect_errno) { 
		 		die('Sorry we having some connection problems');
		 	} 
			$records = array();

		 	$query = "SELECT Name FROM `conferences`";

		 	$result2 = mysqli_query($db, $query);

		$options = "";

		while($row2 = mysqli_fetch_array($result2))
		{
		    $options = $options."<option>$row2[0]</option>";
		}

		if(isset($_POST['submit'])){
					$selected_val = $_POST['conference'];  // Storing Selected Value In Variable
				echo "You have selected :" .$selected_val;
                $selected_val = str_replace(' ', '', $selected_val);
// Displaying Selected Value
				}
	$delegatetable = $selected_val . "delegations";
			if(!empty($_POST)) {

				if(isset($_POST['delegation'],$_POST['pay'],$_POST['faculty'])) {

				$delegation = trim($_POST['delegation']); 
				$pay = trim($_POST['pay']); 
				$faculty = trim($_POST['faculty']); 
				$nospacesdelegation  = str_replace(' ', '', $delegation);

				$individualdelegatetable = $selected_val . $nospacesdelegation . "delegates"; 				
				$insert = $db->prepare("INSERT INTO ".$delegatetable." (delegation, faculty, payment) VALUES (?,?,?)");
				$insert->bind_param('sss', $delegation, $faculty, $pay);
				$sql = "CREATE TABLE ".$individualdelegatetable." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				Name TEXT,
				Country TEXT,
				Contact TEXT,
				Committee TEXT 
				)";
				
				
				
					if($insert->execute()) {

						header('Location:delegates.php'); 
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
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
          <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="delegates.php" class="brand-logo">
                    <?php echo $_SESSION['conference']; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="delegates.php"> <?php echo 'Go back to the ' .$_SESSION['conference']. 'page'; ?></a></li>
                    <li><a href="index.php">Other conferences</a></li>
                   
            </div>
        </nav>
          <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <form action="" method="post">
            <select name="conference" class = "browser-default">
                <?php echo $options;?>
            </select>
            <div class="field">
                <label for "Name">Delegation Name</label>
                <input type="text" name="delegation" id="delegation" autocomplete="off"> </div>
            <div class="field">
                <label for "Host">Payment Method</label>
                <input type="text" name="pay" id="pay" autocomplete="off"> </div>
            <div class="field">
                <label for "Info">Faculty Information</label>
                <textarea name="faculty" id="faculty"></textarea>
            </div>
            <input type="submit" name="submit" value="Insert"> </form> <a href="delegates.php">Want to see the other delegations!</a>
        <br> <a href="index.php">Want to see conference details!</a>
        <br> <a href="delegate.php">Want to see the individual delegates!</a> </body>

    </html>