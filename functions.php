<?php
function search_function($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?s='.$search1.'&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}

function series_details($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?i='.$search1.'&Plot=full&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}

function movie_details($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?i='.$search1.'&Plot=full&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}

function direct_search($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?t='.$search1.'&Plot=full&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}

function details($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?i='.$search1.'&Plot=full&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}


function series_single_season_details($search){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?i='.$search1.'&Season=1&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}


function series_season_details($search, $season, $episode){
	$search1 = rawurlencode($search);
	$service_url = 'http://www.omdbapi.com/?i='.$search1.'&Season='.$season.'&Episode='.$episode.'&apikey=584ac277';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    	$info = curl_getinfo($curl);
    	curl_close($curl);
    	die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	return($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    	die('error occured: ' . $decoded->response->errormessage);
	}
	echo 'response ok!';
}




?>