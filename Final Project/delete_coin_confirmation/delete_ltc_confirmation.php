<?php
session_start();


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
foreach($response['data'] as $money)
{
	if ($money['name']=="Litecoin")
	{
		$ltc_coin_price = $money['price'];
	} 
}

// echo "<hr>";
// //var_dump($response);
// echo "<hr>";

// echo $response["data"][4]["symbol"];
// // close curl
// curl_close($curl);

echo "dkfj";
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
echo "db connection";

	//select from table to find qty store into var
	//sql statement that adds to those amounts

$old_portamt = "SELECT users_info.amt_holding FROM users_info WHERE users_info.username = '".$_SESSION['username']."' ;";
//echo intval($old_portamt);
echo $old_portamt;
$results_old_portamt = $mysqli->query($old_portamt);
$row_oldport = $results_old_portamt->fetch_assoc();
echo $row_oldport["amt_holding"];


$old_coin_amt = "SELECT users_info.lc_amt FROM users_info WHERE users_info.username = '".$_SESSION['username']."';";
echo "<hr>";
//echo intval($old_coin_amt);
echo $old_coin_amt;

$results_old_coin_amt = $mysqli->query($old_coin_amt);
$row_oldcoin = $results_old_coin_amt->fetch_assoc();
echo $row_oldcoin["lc_amt"];

if ($row_oldcoin["lc_amt"]>0)
{

	echo "<hr>";

	$new_coin_amt = $row_oldcoin["lc_amt"]-1;
// $new_coin_amt=$old_coin_amt+1;
	echo "<hr>";
	echo $new_coin_amt;
	echo "<hr>";

	$new_portamt = $row_oldport["amt_holding"]-$ltc_coin_price;
	echo $new_portamt;






	$sql = "UPDATE users_info SET users_info.lc_amt = '" . $new_coin_amt . "', amt_holding = '" . $new_portamt . "' WHERE users_info.username = '".$_SESSION['username']."';";
	$mysqli->query($sql);

	echo $sql;
	header("Location: ../port.php");

}
else
{
	$mysqli->close();
	header("Location: ../port.php?erroritc=You+can+not+have+less+than+zero+shares");
}



?>

