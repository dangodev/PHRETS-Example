<?php @include_once('login.php'); ?>
<pre>
<?php

$rets = new PHRETS;

$connect = $rets->Connect($login, $un, $pw);

if($connect) {
	/* Get table layout */
	$fields = $rets->GetMetadataTable("Property", 4);
	
	/* Take the system name / human name and place in an array */
	$table = array();
	foreach($fields as $field) {
		$table[$field['SystemName']] = $field['LongName'];
	}
	
	/* Display output */
	print_r($table);
	$rets->Disconnect();
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>