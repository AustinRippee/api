<DOCTYPE html>
<html lang="en-US">
    <head>
        <title>As18 - Covid-19 Deaths</title>
        <meta charset="hutf-8" />
        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <!-- our custom CSS -->
        <link rel="stylesheet" href="libs/css/custom.css" />
    </head>
    
    <body>
       
        <div class = "container">
        <?php
        // show page header
        echo "<div class='page-header'>
                <h1>As18 - Covid-19 Deaths</h1>
                <h5 style='color:grey;'>Created by Austin Rippee</h5>
                <a href='https://github.com/AustinRippee/api.git'>Link to the GitHub Source Code </a>
            </div>";
        ?>
             
             
<?php
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

$death_arr = array_slice($death_arr,0,10); //  top 10 highest number of deaths.
//print_r($death_arr);
$JSONString=json_encode($death_arr);
$JSONObject = json_decode($JSONString);
echo '<b>Filtered JSON Object From $death_arr</b><br>';
	echo var_dump($JSONObject);
	echo '<br><br>';
	echo "<div><b>Table With PHP Array</b>";
	echo "<table>";
        echo "<tr>";
		  	echo "<th>PHP</th>";
            echo "<th>Country</th>";
            echo "<th>Total Death Cases</th>";
		echo "</tr>";
		$i=1;
		foreach ($death_arr as $country => $cases) {
			echo "<tr>";
			echo "<td>{$i}</td>";
			echo "<td>{$country}</td>";
			echo "<td>{$cases}</td>";
			echo "</tr>";
			$i++;
		 }
	echo "</table>";
	echo '</div>';

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