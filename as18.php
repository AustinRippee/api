<?php
echo "<a target='_blank' href='https://github.com/AustinRippee/api.git'>GitHub repo</a> ";
// Covid19api.com deaths data

main();

function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);

    $arr1 = Array();
    $arr2 = Array();
    foreach($obj->Countries as $i) {
        array_push($arr1, $i->Country);
        array_push($arr2, $i->TotalDeaths);
    }
    array_multisort($arr2, SORT_DESC, $arr1);
    print_r($arr1);
}

//country_usa = JSON.parse(this.responseText).Countries[170].NewDeaths;
#-----------------------------------------------------------------------------
// read data from a URL into a string
function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}