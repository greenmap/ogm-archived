<?php


error_reporting(E_ALL);
// $api_key = 'your api key goes here';


// setup the curl instance
$c = curl_init();
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// TODO: change to your host
curl_setopt($c, CURLOPT_URL, 'http://staging.opengreenmap.org/services/json');

// check if we got a method argument
if (empty($_REQUEST['method'])) {
	header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
	die();
} else {
	$method = $_REQUEST['method'];
	unset($_REQUEST['method']);
}

// setup the arguments
$data = array('method' => $method);
if (isset($api_key)) {
	$data['api_key'] = '"'.$api_key.'"';
}
foreach ($_REQUEST as $key=>$val) {
	$data[$key] = $val;
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