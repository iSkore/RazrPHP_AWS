<?php
	require ('razrAWS.php');
	use razrPHP as RAZR;
	$razr = new  RAZR\rDynamo ();
    
    //Function complements of @sivanesh-govindan
	function get_client_ip() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	$date = date_format(date_create(), 'm-d-Y H:i:s') . "\n";
	$r = array('Webhost' => array('S' => 'Web_Record'), 'TimeStamp' => array('S' => $date), 'ClientIP' => array('S' => get_client_ip()));
	$p = $razr->putItem('WebsiteLogs', $r);
?>