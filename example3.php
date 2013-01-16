<?php @include_once('login.php'); ?>
<pre>
<?php

$rets = new PHRETS;

$connect = $rets->Connect($login, $un, $pw);

if($connect) {

	$sixmonths = date('Y-m-d\TH:i:s', time()-15778800); // get listings updated within last 6 months
	
	/* Search RETS server */
	$search = $rets->SearchQuery(
		'Property',								// Resource
		4,										// Class
		'((112='.$sixmonths.'+),(178=ACT))',	// DMQL, with SystemNames
		array(
			'Format'	=> 'COMPACT-DECODED',
			'Select'	=> 'sysid,49,112,175,9,2302,2304',
			'Count'		=> 1,
			'Limit'		=> 20
		)
	);
	
	/* If search returned results */
	if($rets->TotalRecordsFound() > 0) {
		while($data = $rets->FetchRow($search)) {
			print_r($data);
		}
	} else {
		echo '0 Records Found';
	}

	$rets->FreeResult($search);
	$rets->Disconnect();
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>