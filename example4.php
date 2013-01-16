<?php @include_once('login.php'); ?>
<pre>
<?php

$rets = new PHRETS;

$connect = $rets->Connect($login, $un, $pw);

if($connect) {
	$sysid = '156456';
	$n = 1;
	$dir = 'photos'.$sysid;
	$photos = $rets->GetObject('Property', 'Photo', $sysid);
	foreach($photos as $photo) {
		file_put_contents($dir.'/'.$n.'.jpg', $photo['Data']);
		$n++;
	}
	$rets->FreeResult($photos);
	$rets->Disconnect();
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>