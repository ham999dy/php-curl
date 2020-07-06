<?php
/*
 * ham999dy
 * used only at command line
 */


if (PHP_SAPI === 'cli') {
	
	if($argc == 3){
		$url = $argv[1];
		$file = $argv[2];
		if(filter_var($url, FILTER_VALIDATE_URL)) {
			
			$files = array(
			  $file,
			);

			$postfields = array();
			foreach ($files as $index => $file) {
				if (function_exists('curl_file_create')) { // For PHP 5.5+
					$file = curl_file_create($file);
				} else {
					$file = '@' . realpath($file);
				}
				$postfields["file"] = $file;
			}
			$postfields['submit'] = '2';

			
			$headers = [
				"Content-Type" => "multipart/form-data",
				"Cookie" => "PHPSSID=238hiwoery8rq23an",
			];
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, ($postfields) );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
			$result=curl_exec ($ch);
			curl_close ($ch);
			
			echo $result;
			
		} else {
			echo 'URL ('. $url. ') not valid!';
		}
	} else {
		echo 'must code like '.basename(__FILE__).' http://127.0.0.1/post.php file.txt '.PHP_EOL;
	}
	
}