<?php
	include 'php.excel.class.php';
	$data=array();
	$data[]=array('ID','BAŞLIK');
	for($i=1;$i<=3000;$i++){
		$data[]=array($i,'BAŞLIK '.$i);
	}
	$xls = new Excel_XML;
	$xls->addWorksheet('Created File Title', $data);
	$xls->sendWorkbook('created.xls');
	exit; 