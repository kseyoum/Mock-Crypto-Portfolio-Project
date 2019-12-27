<?php  
if( isset($_POST['username']) &&  isset($_POST['password'])) 
{
			// User has attempted to log in - now check for two more cases
			// 1. Validation - make sure user has entered a username & password
	//echo "now";
	if( empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Please enter a username and password";
		header("Location: delete.php?error=Please+enter+a+username+and+password");
	}
	else
	{
		//echo "here";
		$host = "303.itpwebdev.com";
		$user = "kseyoum_db_user";
		$password = "10534303Abc!";
		$db = "kseyoum_crypto_info";
		// DB Connection.
		$mysqli = new mysqli($host, $user, $password, $db);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$usernameInput = $_POST["username"];
			// hash the password that user typed in
		$passwordInput = hash("sha256", $_POST["password"]);
			// Look up the user table, see if there is a username/password match
		//echo "here";
		$sql_registered = "SELECT * FROM users_info
		WHERE username = '" . $usernameInput . "' AND password = '" . $passwordInput . "';";
		//echo $sql_registered;
		$results_registered = $mysqli->query($sql_registered);
		if(!$results_registered) {
			echo $mysqli->error;
			exit();
		}
		else
		{

			$row_delete = $results_registered->fetch_assoc();
			//echo $row_delete['id'];



			if(isset($row_delete['id']) || !empty($row_delete['id']))
			{
				//echo $row_delete['id'];
				$sql_delete = "DELETE FROM users_info WHERE id = '" . $row_delete['id'] . "';";
				//echo "dkdkd";
				$deleted = $mysqli->query($sql_delete);

				if(!$deleted)
				{
					echo $mysqli->error;
					exit();
				}

			}
			else 
			{
				$error = "Account does not exsist.";
				header("Location: delete.php?error=Account+does+not+exist");
			}
		}


	}
}


?>

<?php

//define a constant for the API endpoint

define("LUNARCRUSH_API_ENDPOINT", "https://lunarcrush.com/api/v1/assets?symbols=BTC,LTC,ETH,XRP,DASH&key=FfPkANfuQiNutfcasy0D");

//echo LUNARCRUSH_API_ENDPOINT;
//initialize the curl
$curl = curl_init(LUNARCRUSH_API_ENDPOINT);
//set some curl options
//curl_setopt($curl, CURLOPT_URL, LUNARCRUSH_API_ENDPOINT);
//verifies the authenticity of the peer's SSL certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//returns the data instead of printing it to the page
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//execute the curl, aka make a HTTP request
$response = curl_exec($curl);
 //var_dump($response);
$response = json_decode($response, true);

// foreach($response['data'] as $money) {
// 	echo $money['price'];
// }

//just show this one price

function round_to_2dp($number) {
	return number_format((float)$number, 2, '.', '');

}

foreach($response['data'] as $money)
{
	if ($money['name']=="Bitcoin")
	{
		$btc_coin_price = $money['price'];
	} 
}
$display_btc_price = round_to_2dp($btc_coin_price);

foreach($response['data'] as $money)
{
	if ($money['name']=="Ethereum")
	{
		$etc_coin_price = $money['price'];
	} 
}
$display_etc_price = round_to_2dp($etc_coin_price);

foreach($response['data'] as $money)
{
	if ($money['name']=="Ripple")
	{
		$xrp_coin_price = $money['price'];
	} 
}
$display_xrp_price = round_to_2dp($xrp_coin_price);

foreach($response['data'] as $money)
{
	if ($money['name']=="Litecoin")
	{
		$ltc_coin_price = $money['price'];
	} 
}
$display_ltc_price = round_to_2dp($ltc_coin_price);


foreach($response['data'] as $money)
{
	if ($money['name']=="Dash")
	{
		$dash_coin_price = $money['price'];
	} 
}
$display_dash_price = round_to_2dp($dash_coin_price);

?>

<!DOCTYPE html>
<html>
<head>
	<style>
		.error-message
		{
			color: white;
			font-style: ;
			font-size: 25px;
		}

	</style>
	<title>DeletePage</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<!-- Bootsrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="cssFile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">


</head>
<body class="body">

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand text" href="#">M-M</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active text">
					<a class="nav-link"  href="home.php">Home</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="port.php">Portfolio</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="signup.php">Sign Up</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="login.php">Log In</a>
				</li>
				<li class="nav-item active text">
					<a class="nav-link" href="delete.php">Delete<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="logout_confirmation.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid stockmarket">
		<div class= "stocks">
			<div class= "stext scroll">
				Bitcoin: <?php echo "$ " . $display_btc_price; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ethereum: <?php echo "$ " . $display_etc_price; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Ripple: <?php echo "$ ". $display_xrp_price; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Litecoin: <?php echo "$ " . $display_ltc_price; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Dash: <?php echo "$ " . $display_dash_price; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			</div> 
		</div>


	</div>

	<div class="jumbotron jumbotron-fluid home info">
		<div class="container full">
			<div class="row justify-content-start l-i">
				<div class="col-12">
					<h1 id= "page-header" class="display-4 h4 text"> Delete Account: </h1>
				</div>
			</div>

			<div class="row justify-content-start space-two">
			</div>

			<div class="row justify-content-start l-i">
				<div class="col-12">

					<!-- change the action file -->
					<form id= "delete-form" action="delete_confirmation.php" method="POST">


						<div class="form-group row">
							<label for="username" class="col-sm-3 col-form-label text-sm-right labels">Username:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username-id" name="username">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label text-sm-right labels">Password:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="password-id" name="password">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 mt-2">
								<button type="submit" id="delete-button" class="btn btn-primary">Delete Account</button>
								<div id="error" class="error-message">

									<?php  

									if(isset($error) && !empty($error))
									{
										echo $error;

									}

									?>	

								</div>
							</div>
						</div> <!-- .form-group -->

					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="space">

	</div>

	<div class="container-fluid fourth">
		<div class="row four">
			<footer class="footer text"> © 2019 Mock Portfolio Company - Kirubel Seyoum</footer>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>

		document.querySelector("#delete-form").onsubmit = function(event)
		{
			let username_text = document.querySelector("#username-id").value;
			let password_text = document.querySelector("#password-id").value;
			event.preventDefault();
			if( username_text == ""|| password_text == "")
			{
				document.querySelector(".error-message").innerHTML="Please fill out the required fields";

			}
		}
		




	</script>


</body>
</html>

