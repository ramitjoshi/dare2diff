<?php
	echo $request =  'https://cdn.bambuser.net/broadcasts/a3e1a07b-6169-4748-16d1-288c2703d196?da_id=a3e1a07b-6169-4748-16d1-288c2703d196&da_timestamp=1471360487&da_nonce=0.7911932193674147&da_signature_method=HMAC-SHA256&da_signature=e066b95e1688a140030fe34dcc1ba304e094b8cfdd31118eeaeb1c40ad8317b5';
	
	
	
	$session = curl_init($request);
	curl_setopt ($session, CURLOPT_POST, false);
	
	curl_setopt($session, CURLOPT_HEADER, true);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	$response = json_decode(curl_exec($session));
    curl_close($session);  
	
	$result=json_encode($response); 
	return $result;   
?>