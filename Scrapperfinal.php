<?php
include 'AVscr.php';
include 'AVlist.php';

$conn = new mysqli("localhost", "root", "", "scraperav");


$handle = @fopen("listurl.csv", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
		pagescrapper(''.$line);
    }

    fclose($handle);
} else {
    // error opening the file.
} 
$url="http://www.avito.ma/fr/casablanca/voitures/Renault_Express_8007080.htm ";

?>