<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$db_old = 'sozialii';
$db_new = 'typo76';

$tbl_old = 'tx_siinfothek_land';
$tbl_new = 'tx_sinews_domain_model_country';

$basiccol = array('tx_siinfothek_land.uid','tx_siinfothek_land.pid','tx_siinfothek_land.tstamp','tx_siinfothek_land.crdate','tx_siinfothek_land.cruser_id','tx_siinfothek_land.sorting','tx_siinfothek_land.deleted','tx_siinfothek_land.hidden');
				 
$countrycol = array('bezeichnung'=> 'definition',
					'kuerzel'=> 'short');

$cantoncol = array('bezeichnung'=> 'definition',
					'kuerzel'=> 'short');
$col = implode($basiccol);					
$col_old = $col.',tx_siinfothek_land.bezeichnung as definition, tx_siinfothek_land.kuerzel as short';
$sql = "INSERT INTO{$db_new.$tbl_new} ";
$sql .= " SELECT {$col_old} FROM {$db_old.$tbl_old}";		

if(!$result = $conn->query($sql)){
    die('There was an error running the query [' . $conn->error . ']');
}			
?>