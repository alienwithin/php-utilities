#!/usr/bin/php
<?php
// Turn off all error reporting
error_reporting(0);

//Start Timer to Get how long it takes to run it.

$start = microtime(true); 
 
$lines = file($_SERVER["argv"][1]);
$hash_to_crack=$_SERVER["argv"][2];


if ($lines==""){
    echo "No Dictionary Specified \n";
    echo "Usage: php crack.php dictionary_file hash_to_test_for_match e.g. \n \nphp crack.php out.txt 25e4ee4e9229397b6b17776bfceaf8e7";
}
else{
    foreach($lines as $line)
    {
      $encr=md5($line);
      echo ("Current Hash: ". $encr."\n");
      
	if ($encr==$hash_to_crack){
	echo("\nString Matching Hash Found:\n ".$line."\n");


	$time_elapsed_us = microtime(true) - $start;	
	echo "Hash Cracked in $time_elapsed_us seconds.\n\n";
	exit;
	}
    }
}

?>  
