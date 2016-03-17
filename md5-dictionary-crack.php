#!/usr/bin/php
<?php
/*
Author: Alienwithin
Website: http://munir.skilledsoft.com 
Role: MD5 Dictionary Based Hash Identifier
Tested on: Linux (Opensuse Bottle x86_64)
Run Environment: Command Line
Applicability: Quick Dirty way of dealing with hashes in an environment with lack of tools like hydra and necessity to find md5 hashes using dictionary attacks.

Test Run Dictionary used is Cain(http://downloads.skullsecurity.org/passwords/cain.txt.bz2):
martian@linux-25v9:~/> php crack.php dictionary.txt 2054aa40547bcfb7b8eb9ee1f10055d5

**********Trimmed Led to a 15.8MB file generating the log*****
Current Hash: e6a92349fe372d49d290476e5c52f113
Current Hash: ac8959f8f636169e97437f8d22985b55
Current Hash: 57df8940e45bea32a4fffcc395ed0ea1
Current Hash: b7724fae9c568e8917dcb16f3ce329b9
Current Hash: 7ec53cb4338d72fc5e218bc5f892c450
Current Hash: b74988f0f24d49e09f92754e44bbb613
Current Hash: 7b504d29387dae72efc220803fbb6cbd
Current Hash: 70fa7095e4b5a3aeb485c7093f7fccc7
Current Hash: dc877ed32f3047e5c5a7a41e6f301c6f
Current Hash: cf1b88e760a8588842646417285104e4
Current Hash: 3be17577bed38ea628bada9e1716096e
Current Hash: 76146d2de67431519059bb716f9f195f
Current Hash: 660cf678c704b42b749b3cdfa7aaa88a
Current Hash: 311d138f88f1ce50786712220d1b1466
Current Hash: ef3af4c980b91d7deffd03e55e2ce8e7
Current Hash: 49378e923fc5d50edc52bf20d1aff47c
Current Hash: 17ff61468f569e4b6541722be15f7193
Current Hash: ecaaef867336556160794e8ebc864227
Current Hash: 1079e9cac451cf97c41a75b55101c7ef
Current Hash: 83dc958ef6a29734cc527e163dec6795
Current Hash: 2261b6bd29dfeb5c54ffe65f3ae430a9
Current Hash: b8cd8521e1039235c37db676a1a29d2a
Current Hash: 2054aa40547bcfb7b8eb9ee1f10055d5

String Matching Hash Found:
zythem

Hash Cracked in 2.0806159973145 seconds.

*/
// Turn off all error reporting
error_reporting(0);

//Start Timer to Get how long it takes to run it.

$start = microtime(true);

$lines         = file($_SERVER["argv"][1]);
$hash_to_crack = $_SERVER["argv"][2];


if ($lines == "") {
    echo "No Dictionary Specified \n";
    echo "Usage: php crack.php dictionary_file hash_to_test_for_match e.g. \n \nphp crack.php out.txt 25e4ee4e9229397b6b17776bfceaf8e7";
} else {
    foreach ($lines as $line) {
        $encr = md5($line);
        echo ("Current Hash: " . $encr . "\n");
        
        if ($encr == $hash_to_crack) {
            echo ("\nString Matching Hash Found:\n " . $line . "\n");
            
            
            $time_elapsed_us = microtime(true) - $start;
            echo "Hash Cracked in $time_elapsed_us seconds.\n\n";
            exit;
        }
    }
}

?>  
