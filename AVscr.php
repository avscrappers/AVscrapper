<?php


function get_string_between($string, $start, $end){
$string = " ".$string;
$ini = strpos($string,$start);
if ($ini == 0) return "";
$ini += strlen($start);
$len = strpos($string,$end,$ini) - $ini;
return substr($string,$ini,$len);
}


function depurate ($string) {
$string = strip_tags($string);
// Erase the comma as thousand separator
$string = str_replace(',', '', $string);
// Some manual strings
$string = str_replace("\n", '', $string); //NB \n requires double quotes
$string = str_replace(' ', '', $string);
$string = htmlentities($string);
return $string;
}


function pagescrapper($url){
	// Retrieve all the client-side code of the page requested

$pageContent = file_get_contents($url);

	/////////////////
	// Extract prix
	$REGEX = '/<span class=\"amount value\"  title=\"(.*?)\">/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	if(isset($itemNameMatches[1][0])){
	$prix = $itemNameMatches[1][0];
    }
	else{
		$prix= "NA";
		
	}
	/////////////////
	/////////////////
	// Extract marque
	$REGEX = '/<strong>Marque:\<\/strong> (.*?)\<\/h2>/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	$marque = depurate($itemNameMatches[1][0]);

	/////////////////
	/////////////////
	// Extract modele
	
	
	$REGEX = '/<strong>Modèle:\<\/strong>(.*?)\<\/h2>/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	$modele = depurate($itemNameMatches[1][0]);

	/////////////////
/////////////////
	// Extract annee
	$REGEX = '/<strong>Année-Modèle:\<\/strong> (.*?)\<\/h2>/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	$annee = $itemNameMatches[1][0];

	/////////////////
	/////////////////
	// Extract carburant
	$REGEX = '/<strong>Type de carburant:\<\/strong> (.*?)\<\/h2>/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	$carburant = $itemNameMatches[1][0];

	/////////////////
	/////////////////
	// Extract kilometrage
	$REGEX = '/<strong>Kilométrage:\<\/strong> (.*?)\<\/h2>/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	$kilometrage = depurate($itemNameMatches[1][0]);

	/////////////////
	
	$output = array(
	"marque" =>$marque,
	"modele" => $modele,
	"carburant" => $carburant,
	"annee" => $annee,
	"prix" => $prix,
	"kilometrage" => $kilometrage,
	
	
	
	

	);




$fp = fopen('voiture.csv', 'a');


    fputcsv($fp, $output);

fclose($fp);




return $output;
}

?>