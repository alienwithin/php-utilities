<?php
ini_set(error_reporting(0));

function banner(){
	echo "################################################\nAlienwithin's Give Web Head \n";
	echo "Version: 1.0 \n";
	echo "Usage: \n";
	echo "To Find common Directories: \n";
	echo "php give-web-head.php http://example.com dirs\n\n";
	echo "To Find common PHP Filenames: \n";
	echo "php ".$_SERVER["argv"][0]." http://example.com files\n\n";
	echo "For Good Results don't add a trailing slash\n";
	echo "################################################\n\n";
}

$url_param=$_SERVER["argv"][1];
$scan_type=$_SERVER["argv"][2];

function http_response($url){
    $resURL = curl_init(); 
    curl_setopt($resURL, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_NOBODY, true);
   	curl_setopt($ch,CURLOPT_USERAGENT,'SpaceZilla/5.0 (SpaceOS; U; SpaceOS NT 5.1; en-US; rv:1.8.1.13) Aliens/20080311 Spacefox/2.0.0.13');
	curl_setopt ($resURL, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($resURL, CURLOPT_FAILONERROR, 1); 
    curl_setopt($resURL, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($resURL, CURLOPT_SSL_VERIFYPEER, 0);
    curl_exec ($resURL); 
    $intReturnCode = curl_getinfo($resURL, CURLINFO_HTTP_CODE); 
    curl_close ($resURL); 
    if ($intReturnCode != 200 && $intReturnCode != 301 && $intReturnCode != 304 && $intReturnCode != 302 && $intReturnCode != 403) { } else return $url;
}

if (empty($url_param) || empty($scan_type)){
	banner();
	exit();
}
else{
	echo "###########################################\nAlienwithin's Give Web Head \nVersion: 1.0 \nhttp://munir.skilledsoft.com\n###########################################\n\nLoading Wordlist \n";
	
	switch ($scan_type) {
    case "dirs":
       $file_handle = fopen("dirlist.txt", "r");
        break;
    case "files":
        $file_handle = fopen("filenames.txt", "r");
        break;
    default:
       banner();
}
	echo "Creating Result File \n\n";
	$resultfile = parse_url($url_param, PHP_URL_HOST)."-urls-list.txt";
	$fh = fopen($resultfile, 'a') or die("can't open file");
	echo "Successfully Created Result File ".$resultfile. "\n\n Starting Directory Scanner \n";
	while (!feof($file_handle)) {
	   $line = fgets($file_handle);
	   $url=$url_param."/".$line; 
	   if (http_response($url)!= ""){
	      echo $url." => Found\n";
	    fwrite($fh, $url);     
	   }else{
	   	echo $url." => Not Found\n";
	   }
	 }
	fclose($file_handle);
	fclose($fh);
	echo "Search Complete";
}

