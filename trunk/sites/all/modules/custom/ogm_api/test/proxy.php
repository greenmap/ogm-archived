<?php


error_reporting(E_ALL);
// API key is not used atm
// $api_key = 'your api key goes here';
// TODO: change to your host
$host = 'http://staging.opengreenmap.org/';


// setup the curl instance
$c = curl_init();
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_URL, $host.'services/json');

// check if we got a method argument
if (empty($_REQUEST['method'])) {
	header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	die();
} else {
	if (get_magic_quotes_gpc()) {
		$method = stripslashes($_REQUEST['method']);
	} else {
		$method = $_REQUEST['method'];
	}
	unset($_REQUEST['method']);
}

// setup the arguments
$data = array('method' => $method);
if (isset($api_key)) {
	$data['api_key'] = '"'.$api_key.'"';
}
foreach ($_REQUEST as $key=>$val) {
	if (get_magic_quotes_gpc()) {
		$data[$key] = stripslashes($val);
	} else {
		$data[$key] = $val;
	}
}
curl_setopt($c, CURLOPT_POSTFIELDS, $data);

// fetch the result
$result = curl_exec($c);
if ($result !== false) {
	echo $result;
} else {
	header($_SERVER['SERVER_PROTOCOL'].' 503 Service Unavailable');
	die();
}


?>