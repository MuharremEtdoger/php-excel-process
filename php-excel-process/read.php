<?php
require_once 'SimpleXLSX.php';
if ( $xlsx = SimpleXLSX::parse('read.xlsx') ) {
	$veriler=$xlsx->rows();
	foreach($veriler as $veri){
	    echo $veri[0].' - '.$veri[1].'<br>';
	}
} else {
	echo SimpleXLSX::parseError();
}