<?php

session_start();

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

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
{

	// $old_portamt = "SELECT users_info.amt_holding FROM users_info WHERE users_info.username = '".$_SESSION['username']."' ;";
	// $results_old_portamt = $mysqli->query($old_portamt);
	// $row_oldport = $results_old_portamt->fetch_assoc();


//bitcoin amount
	$bc_coin_amt = "SELECT users_info.bc_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
	$results_bc_coin_amt = $mysqli->query($bc_coin_amt);
	$row_bc_coin = $results_bc_coin_amt->fetch_assoc();

//ettheruem amount
	$ec_coin_amt = "SELECT users_info.ec_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
	$results_ec_coin_amt = $mysqli->query($ec_coin_amt);
	$row_ec_coin = $results_ec_coin_amt->fetch_assoc();

//ripple amount
	$rc_coin_amt = "SELECT users_info.rc_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
	$results_rc_coin_amt = $mysqli->query($rc_coin_amt);
	$row_rc_coin = $results_rc_coin_amt->fetch_assoc();

//litecoin amount
	$lc_coin_amt = "SELECT users_info.lc_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
	$results_lc_coin_amt = $mysqli->query($lc_coin_amt);
	$row_lc_coin = $results_lc_coin_amt->fetch_assoc();

//dash amount
	$dc_coin_amt = "SELECT users_info.dc_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
	$results_dc_coin_amt = $mysqli->query($dc_coin_amt);
	$row_dc_coin = $results_dc_coin_amt->fetch_assoc();

	$btc_money = $btc_coin_price * $row_bc_coin["bc_amt"];
	$etc_money = $etc_coin_price * $row_ec_coin["ec_amt"];
	$xrp_money = $xrp_coin_price * $row_rc_coin["rc_amt"];
	$ltc_money = $ltc_coin_price * $row_lc_coin["lc_amt"];
	$dash_money = $dash_coin_price * $row_dc_coin["dc_amt"];
	$port_money = $btc_money + $etc_money + $xrp_money + $ltc_money + $dash_money;
	$display_port_money = round_to_2dp($port_money);



}
else{}



	$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>PortfolioPage</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<!-- Bootsrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">

	<link href="cssFile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	


</head>
<body class="body">
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand text" href="#">M-M</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item ">
					<a class="nav-link text" href="home.php">Home</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link text" href="port.php">Portfolio<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item text">
					<a class="nav-link text" href="signup.php">Sign Up</a>
				</li>
				<li class="nav-item text">
					<a class="nav-link text" href="login.php">Log In</a>
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

	

	<div class="jumbotron jumbotron-fluid port">
		<div class="container full">
			<div class="row justify-content-start pb">
				<div class="col-12">
					<h1 class="display-4 h4 text"> PORTOFLIO AMOUNT: </h1>
				</div>
			</div>

			<div class="row justify-content-start space-two">
			</div>
			<br>

			<div class="row justify-content-start pb">
				<div class="col-12">
					<span class="display-4 text portVal">

						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							//echo $row_oldport["amt_holding"];
							echo "$" . $display_port_money;
						}
						else{
							echo "Log in to find out!";
						}

						?>	

					</span> 
				</div>	
			</div>


			
			
			
			
		</div>
	</div>



	<br>

	<div class="container-fluid stockmarket">

		<div class= "row cryptostocks">

			<div class= "col-6 col-md stext">
				<h1 class= "stext">Bitcoin</h1>
				<img class="coin" src="Images/bitcoin.jpg">
				<form id="bitcoin-forum" class="edit" >
					<div class="form-group">
						<a href="add_coin_confirmation/add_btc_confirmation.php">
							<button type="button" class="btn-btc-p btn-primary">Buy 1 share of Bitcoin</button>
						</a>
						<a href="delete_coin_confirmation/delete_btc_confirmation.php">
							<button type="button" class="btn-btc-d btn-danger" id="btn-remove">Sell 1 share of Bitcoin</button>
						</a>
						<div class="error-message"> 

							<?php
							if(isset($_GET['errorbtc'])) {
								echo  "</h1>" . $_GET['errorbtc'] . "</h1>";
							}
							?>

						</div>
					</div>
				</form>

				<div class="amt">
					<h5>Shares of Bitcoin:</h5>
					<span id="bitcoin-qty">


						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo $row_bc_coin["bc_amt"];

						}
						else{
							echo "0";
						}

						?>	

						
					</span>
				</div>
			</div>

			<div class= "col-6 col-md stext">
				<h1 class= "stext">Ethereum</h1>
				<img class="coin" src="Images/ethereum.jpg">
				<form id="ethereum-forum" class="edit">
					<div class="form-group">
						<a href="add_coin_confirmation/add_etc_confirmation.php">
							<button type="button" class="btn-etc-p btn-primary">Buy 1 share of Ethereum</button>
						</a>

						<a href="delete_coin_confirmation/delete_etc_confirmation.php">
							<button type="button" class="btn-etc-d btn-danger" id="btn-remove">Sell 1 share of Ethereum</button>
						</a>
						<div class="error-message"> 

							<?php
							if(isset($_GET['erroretc'])) {
								echo  "</h1>" . $_GET['erroretc'] . "</h1>";
							}
							?>

						</div>
					</div>
				</form>
				<div class="amt">
					<h5>Shares of Ethereum:</h5>
					<span id="ethereum-qty">
						

						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo $row_ec_coin["ec_amt"];

						}
						else{
							echo "0";
						}

						?>	

					</span>
				</div>
			</div>

			<div class= "col-6 col-md stext">
				<h1 class= "stext">Ripple</h1>
				<img class="coin" src="Images/ripple.jpg">
				<form id= "ripple-forum" class="edit">
					<div class="form-group">
						<a href="add_coin_confirmation/add_xrp_confirmation.php">
							
							<button type="button" class="btn-rpc-p btn-primary">Buy 1 share of Ripple</button>

						</a>
						<a href="delete_coin_confirmation/delete_xrp_confirmation.php">
							<button type="button" class="btn-rpc-d btn-danger" id="btn-remove">Sell 1 share of Ripple</button>
						</a>
						
						<div class="error-message">
							<?php
							if(isset($_GET['errorxrp'])) {
								echo  "</h1>" . $_GET['errorxrp'] . "</h1>";
							}
							?>
						</div>
					</div>
				</form>
				<div class="amt">
					<h5>Shares of Ripple:</h5>
					<span id="ripple-qty">
						

						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo $row_rc_coin["rc_amt"];

						}
						else{
							echo "0";
						}

						?>	

					</span>
				</div>
			</div>

			<div class= "col-6 col-md stext">
				<h1 class= "stext">Litecoin</h1>
				<img class="coin" src="Images/litecoin.jpg">

				<form id= "litecoin-forum" class="edit">
					<div class="form-group">
						<a href="add_coin_confirmation/add_ltc_confirmation.php">
							<button type="button" class="btn-ltc-p btn-primary">Buy 1 share of Litecoin</button>
						</a>

						<a href="delete_coin_confirmation/delete_ltc_confirmation.php">
							<button type="button" class="btn-ltc-d btn-danger" id="btn-remove">Sell 1 share of Litecoin</button>
						</a>
						
						
						<div class="error-message">
							<?php
							if(isset($_GET['errorltc'])) {
								echo  "</h1>" . $_GET['errorltc'] . "</h1>";
							}
							?>
						</div>
					</div>
				</form>
				<div class="amt">
					<h5>Shares of Litecoin:</h5>
					<span id="litecoin-qty">
						

						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo $row_lc_coin["lc_amt"];

						}
						else{
							echo "0";
						}

						?>	

					</span>
				</div>
			</div>

			<div class= "col-lg col-md-3 col-sm-6 stext">
				<h1 class= "stext">Dash</h1>
				<img class="coin" src="Images/dash.jpg">
				<form id="dash-forum" class="edit" >
					<div class="form-group">

						<a href="add_coin_confirmation/add_dash_confirmation.php">
							<button type="button" class="btn-dash-p btn-primary">Buy 1 share of Dash</button>
						</a>


						<a href="delete_coin_confirmation/delete_dash_confirmation.php">

							<button type="button" class="btn-dash-d btn-danger" id="btn-remove">Sell 1 share of Dash</button>
							
						</a>
						
						<div class="error-message">
							<?php
							if(isset($_GET['errordash'])) {
								echo  "</h1>" . $_GET['errordash'] . "</h1>";
							}
							?>
						</div>
					</div>
				</form>
				<div class="amt">
					<h5>Shares of Dash:</h5>
					<span id="dash-qty">
						

						<?php  

						if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo $row_dc_coin["dc_amt"];

						}
						else{
							echo "0";
						}

						?>	

					</span>
				</div>
			</div>
		</div>
	</div>

	<br>

	<div class="container-fluid fourth">
		<div class="row four">
			<footer class="footer text"> © 2019 Mock Portfolio Company - Kirubel Seyoum</footer>
		</div>
	</div>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script>





		// //amount should equal amount from db
		// //when an account is made all users should start with 0 qty of each coin
		// //make in php
		// //+ each amount of moneycoin
		// let amountBtc=0;
		// //let moneyBtc=0;
		// let amountEtc=0;
		// //let moneyEtc=0;
		// let amountRpc=0;
		// //let moneyRpc=0;
		// let amountLtc=0;
		// //let moneyLtc=0;
		// let amountDash=0;
		// //let moneyDash

		
		// let amountPort=0;
		
		// document.querySelector(".btn-btc-p").onclick=function(event)
		// {
		// 	event.preventDefault();
		// 	amountBtc++;
		// 	console.log(amountBtc);
		// 	document.querySelector("#bitcoin-qty").innerHTML = amountBtc;

		// }

		

		
		// document.querySelector(".btn-btc-d").onclick=function(event)
		// {
		// 	if (amountBtc>0) 
		// 	{
		// 		event.preventDefault();
		// 		amountBtc--;
		// 		console.log(amountBtc);
		// 		document.querySelector("#bitcoin-qty").innerHTML = amountBtc;


		// 	}


		// }


		
		

		
		// document.querySelector(".btn-etc-p").onclick=function(event)
		// {
		// 	event.preventDefault();
		// 	amountEtc++;
		// 	document.querySelector("#ethereum-qty").innerHTML= amountEtc;

		// }

		// document.querySelector(".btn-etc-d").onclick=function(event)
		// {
		// 	if (amountEtc>0) 
		// 	{
		// 		event.preventDefault();
		// 		amountEtc--;
		// 		console.log(amountEtc);
		// 		document.querySelector("#ethereum-qty").innerHTML = amountEtc;
		// 	}


		// }


		// document.querySelector(".btn-rpc-p").onclick=function(event)
		// {
		// 	event.preventDefault();
		// 	amountRpc++;
		// 	document.querySelector("#ripple-qty").innerHTML= amountRpc;

		// }

		// document.querySelector(".btn-rpc-d").onclick=function(event)
		// {
		// 	if (amountRpc>0) 
		// 	{
		// 		event.preventDefault();
		// 		amountRpc--;
		// 		console.log(amountRpc);
		// 		document.querySelector("#ripple-qty").innerHTML = amountRpc;
		// 	}


		// }

		
		// document.querySelector(".btn-ltc-p").onclick=function(event)
		// {
		// 	event.preventDefault();
		// 	amountLtc++;
		// 	document.querySelector("#litecoin-qty").innerHTML= amountLtc;

		// }

		// document.querySelector(".btn-ltc-d").onclick=function(event)
		// {
		// 	if (amountLtc>0) 
		// 	{
		// 		event.preventDefault();
		// 		amountLtc--;
		// 		console.log(amountLtc);
		// 		document.querySelector("#litecoin-qty").innerHTML = amountLtc;
		// 	}


		// }

		
		// document.querySelector(".btn-dash-p").onclick=function(event)
		// {
		// 	event.preventDefault();
		// 	amountDash++;
		// 	document.querySelector("#dash-qty").innerHTML= amountDash;

		// }

		// document.querySelector(".btn-dash-d").onclick=function(event)
		// {
		// 	if (amountDash>0) 
		// 	{
		// 		event.preventDefault();
		// 		amountDash--;
		// 		console.log(amountDash);
		// 		document.querySelector("#dash-qty").innerHTML = amountDash;
		// 	}


		// }











	</script>










</body>

</html>