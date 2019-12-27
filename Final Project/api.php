<?php

//define a constant for the API endpoint
echo "kdekjfkalsjdf";
define("LUNARCRUSH_API_ENDPOINT", "https://lunarcrush.com/api/v1/assets?symbols=BTC,LTC,ETH,XRP,DASH&key=FfPkANfuQiNutfcasy0D");

echo LUNARCRUSH_API_ENDPOINT;
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
echo "<hr>";
 var_dump($response);
$response = json_decode($response, true);

foreach($response['data'] as $money) {
	echo $money['price'];
}

// echo "<hr>";
// //var_dump($response);
// echo "<hr>";

// echo $response["data"][4]["symbol"];
// // close curl
// curl_close($curl);
// ?>