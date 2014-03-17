<?php

if(isset($_COOKIE['DACC'])) {
	$isLogged === true;
	$uid = $_COOKIE['DACC'];
	$level = $_COOKIE['DACCLevel'];
	setcookie('DACC', $uid, time()-1800, '/', '192.168.10.2');
	setcookie('DACC', $uid, time()+1800, '/', '192.168.10.2');
	setcookie('DACCLevel', $level, time()-1800, '/', '192.168.10.2');
	setcookie('DACCLevel', $level, time()+1800, '/', '192.168.10.2');
}

?>