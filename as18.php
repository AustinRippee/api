<DOCTYPE html>
<html lang="en-US">
    <!-- Page HTML and Bootstrap for the header -->
    <head>
        <title>As18 (Covid-19 Deaths)</title>
        <meta charset="hutf-8" />
        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    </head>
    
    <body>
        <div class = "container">
        <?php
        // show page header
        echo "<div class='page-header'>
                <h1>As18 (Covid-19 Deaths)</h1>
                <h5 style='color:grey;'>Created by Austin Rippee</h5>
                <a href='https://github.com/AustinRippee/api.git'>Link to the GitHub Source Code </a>
            </div>";
        ?>
             
             
<?php

// Prints the main function that displays everything
main();

function main () {
    // Covid19api.com deaths data
	$apiCall = 'https://api.covid19api.com/summary';
    // Reads the data from the website and puts it into a JSON string
	$json_string = curl_get_contents($apiCall);
    // Stores the JSON string into a PHP object
	$obj = json_decode($json_string);
	
    // Creates the deaths array for the data to be stored
	$death_arr = Array() ;

    // Sets each country with the respective deaths
	foreach($obj->Countries as $i){
		$death_arr[$i->Country] = $i->TotalDeaths;
	}

    #-----------------------------------------------------------------------------

	// Sorts the array in Desecending order 
	arsort($death_arr);

    // Cuts the array into the specified number to be shown from the array
    $death_arr = array_slice($death_arr, 0, 10);
    // Reads the data again
    $deaths_str = json_encode($death_arr);
    // Then stores it into another PHP object
    $deaths_obj = json_decode($deaths_str);

    #-----------------------------------------------------------------------------

    // Creates the header
    echo "</br><div><h4><b>JSON OBJECT</b></h4>";
    // Spits out the data from the string object from above
	echo var_dump($deaths_obj);

	echo '<br><br><br>';

    #-----------------------------------------------------------------------------

    // Creates the header
	echo "<div><h4><b>TOP 10 DEATHS PER COUNTRY</b></h4>";
    echo "<hr>";
    // Creates the table
	echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            // Creates the tables headers
		  	echo "<th>RANK</th>";
            echo "<th>COUNTRY</th>";
            echo "<th>TOTAL DEATH CASES</th>";
		echo "</tr>";

        // Starts the country count from 1
		$i = 1;

        // Creates the loop to add each country/deaths in their respective row
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
}

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