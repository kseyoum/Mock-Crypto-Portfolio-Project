
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
// echo "<hr>";
// //var_dump($response);
// echo "<hr>";

// echo $response["data"][4]["symbol"];
// // close curl
// curl_close($curl);
// ?>

<!DOCTYPE html>
<html>
<head>
	<style>
		.error-message
		{
			color: white;
			font-style: bold;
			font-size: 25px;
		}
		
	</style>
	<title>LogInPage</title>

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
				<li class="nav-item text">
					<a class="nav-link"  href="home.php">Home</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="port.php">Portfolio</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link" href="signup.php">Sign Up</a>
				</li>
				<li class="nav-item active text">
					<a class="nav-link" href="login.php">Log In<span class="sr-only">(current)</span></a>
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
			<div class="row justify-content-start l-i">
				<div class="col-12">
					<h1 class="display-4 h4 text"> Log In: </h1>
				</div>
			</div>

			<div class="row justify-content-start space-two">
			</div>

			<div class="row justify-content-start l-i">
				<div class="col-12">

					<!-- change the action file -->
					<form id= "log-in-form" action="login_confirmation.php" method="POST">


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
								<button type="submit" class="btn btn-primary">Submit</button>
								<div id="error" class="error-message">
									<?php
									if(isset($_GET['error'])) {
										echo  "</h1>" . $_GET['error'] . "</h1>";
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

		 document.querySelector("#log-in-form").onsubmit = function(event)

		{
		 	
		 	let username_text = document.querySelector("#username-id").value;
		 	let password_text = document.querySelector("#password-id").value;
		 	//event.preventDefault();
		 	// if(empty(username_text) ||empty(password_text))
		 	// {
		 	// 	console.log("entered here");

		 	// 	document.querySelector(".error-message").innerHTML="Please fill out the required fields";

		 	// }
		 	if(username_text == "" || password_text == "")
		 	{
		 		document.querySelector(".error-message").innerHTML="Please fill out the required fields";

		 	}

		 }

		
		

	</script>


</body>
</html>