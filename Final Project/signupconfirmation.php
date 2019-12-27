<?php
if ( !isset($_POST['first-name']) || empty($_POST['first-name']) 
	|| !isset($_POST['last-name']) || empty($_POST['last-name'])
	|| !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password'])
	|| !isset($_POST['age']) || empty($_POST['age'])
	|| !isset($_POST['user-type']) || empty($_POST['user-type']) ) {
	// double check if and validate for required fields.
	$error = "Please fill out all required fields.";
}

else{
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



		// Sanitize user input
	$username = $mysqli->real_escape_string($_POST['username']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = hash("sha256", $_POST['password']);
	// Check if this user already exists in the database
	$sql_registered = "SELECT * FROM users_info
	WHERE username = '" . $username . "' OR email = '" . $email . "';";
	//echo $sql_registered;
	//echo "<hr>";
	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	}
	// var_dump($results_registered);
	// If more than 0 result came back, it means the username or email already exists in the users table.
	if($results_registered->num_rows > 0) {
		$error = "Username or email has been already taken. Please choose another one.";
	}
	else {




// something wrong with my sql statement

		$sql = "INSERT INTO users_info (username, password, email, first_name, last_name, user_type_id, age_id)
		VALUES ('" 
		. $username 
		. "', '"
		. $password
		."', '"
		. $email
		."', '"
		. $_POST['first-name']
		."', '"
		. $_POST['last-name']
		."', '"
		. $_POST['user-type']
		."', '"
		. $_POST['age']
		."');";
	 //echo "<hr>" . $sql . "<hr>";
		$results = $mysqli->query($sql);
		if ( !$results ) {
			echo $mysqli->error;
			exit();
		}
		$mysqli->close();
		header("Location: login.php");
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
$mysqli->set_charset('utf8');


$sql_age = "SELECT * FROM age;";
$results_age = $mysqli->query($sql_age);
if ( $results_age == false ) {
	echo $mysqli->error;
	exit();
}

$sql_user_type = "SELECT * FROM user_type;";
$results_user_type = $mysqli->query($sql_user_type);
if ( $results_user_type == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection
$mysqli->close();


?>

<!DOCTYPE html>
<html>
<head>
	<title>SignUpConfirmationPage</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<!-- Bootsrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="cssFile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">


</head>

<style>
	.error-message
	{
		color: white;
		font-style: ;
		font-size: 25px;
	}
	
</style>

<body class="body">

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand text" href="#">M-M</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item text">
					<a class="nav-link"  href="home.php">Home</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="port.php">Portfolio</a>
				</li>
				<li class="nav-item active text">
					<a class="nav-link" href="signup.php">Sign Up<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="login.php">Log In</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="delete.php">Delete</a>
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
			<div class="row justify-content-start su">
				<div class="col-12">
					<h1 class="display-4 h4 text"> Sign Up: </h1>
				</div>
			</div>

			<div class="row justify-content-start space-two">
			</div>

			<div class="row justify-content-start su">
				<div class="col-12">

					
					<!-- change the action file -->
					<form id= "sign-up-form" action="signupconfirmation.php" method="POST">
						<div class="form-group row">
							<label for="first-name" class="col-sm-3 col-form-label text-sm-right labels">First Name:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" placeholder="First Name"class="form-control" id="first-name-id" name="first-name">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="last-name" class="col-sm-3 col-form-label text-sm-right labels">Last Name:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="last-name-id" placeholder="Last Name" name="last-name">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label text-sm-right labels">Email:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Email" id="email-id" name="email">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="username" class="col-sm-3 col-form-label text-sm-right labels">Username:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Username" id="username-id" name="username">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label text-sm-right labels">Password:  <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Password" id="password-id" name="password">
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="age-id" class="col-sm-3 col-form-label text-sm-right labels">Age-Range: <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<select name="age" id="age-id" class="form-control">
									<option value="" selected disabled>- Select Age Range -</option>

									<?php while( $row = $results_age->fetch_assoc() ): ?>

										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['age_range']; ?>
										</option>

									<?php endwhile; ?>

								</select>
							</div>
						</div> <!-- .form-group -->

						<div class="form-group row">
							<label for="user-type-id" class="col-sm-3 col-form-label text-sm-right labels">User-Type: <span class="text-danger">*</span> </label>
							<div class="col-sm-9">
								<select name="user-type" id="user-type-id" class="form-control">
									<option value="" selected>- Select User Type -</option>


									<?php while( $row = $results_user_type->fetch_assoc() ): ?>

										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['type']; ?>
										</option>

									<?php endwhile; ?>

								</select>
							</div>
						</div> <!-- .form-group -->
						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9 mt-2">
								<button type="submit" class="btn btn-primary">Submit</button>
								<div id="error" class="error-message">

									<?php  

									if(isset($error) && !empty($error))
									{
										echo $error;

									}
									else{
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

		document.querySelector("#sign-up-form").onsubmit = function(event)
		{
			let first_name_text = document.querySelector("#first-name-id").value;
			let last_name_text = document.querySelector("#last-name-id").value;
			let email_text = document.querySelector("#email-id").value;
			let username_text = document.querySelector("#username-id").value;
			let password_text = document.querySelector("#password-id").value;
			let age_text = document.querySelector("#age-id").value;
			let user_text = document.querySelector("#user-type-id").value;
			event.preventDefault();
			if(empty(first_name_text) || empty(last_name_text) ||empty(email_text) ||empty(username_text) ||empty(password_text) ||empty(age_text) ||empty(user_text))
			{
				document.querySelector(".error-message").innerHTML="Please fill out the required fields";

			}



		</script>

	</body>
	</html>
