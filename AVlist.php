<?php



function pagescrapperlist($url){
	// Retrieve all the client-side code of the page requested
	
$pageContent = file_get_contents($url);

	

	/////////////////
	// Extract urls
	$REGEX = '/<h2 class=\"fs14\"><a   href=\"(.*?)\">/is'; ### Fine tune/edit if needed
	
	$itemNameExtracted = preg_match_all($REGEX, $pageContent, $itemNameMatches);
	

	/////////////////
	




$fp = fopen('listurl.csv', 'a');


foreach($itemNameMatches[1] as $elt){
	
	fwrite($fp, $elt);
	fwrite($fp, "\n");
}

fclose($fp);




return $itemNameMatches[1];
}

?>