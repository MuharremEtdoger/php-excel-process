<?php
	require_once 'SimpleXLSX.php';
	include 'php.excel.class.php';
	$url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if ( $xlsx = SimpleXLSX::parse('created.xlsx') ) {
		$veriler=$xlsx->rows();
		$item_array=array();
		$sayac=0;
		$count=count($veriler);
		$parca=500;
		$bolum=$count/$parca;
		$kalan=$count%$parca;
		$finish=0;
		$start=0;
		$limits=array();
		for($i=1;$i<=$bolum;$i++){
			$start=$finish+1;
			$cikar=0;
			if($finish==0){
				$start=0;
				$cikar=1;
			}
			if($start){
				$start=$start;
			}
			$finish=($finish+$parca)-$cikar;	
			$_tmp=array();
			$_tmp['start']=$start;	
			$_tmp['finish']=$finish;
			$limits[]=$_tmp;		
		}
		$data=array();
		$s=0;
		if(isset($_GET['parca'])){
		foreach($limits as $keyf=>$limit){
			if($keyf==$_GET['parca']){
				
				for($i=$limit['start'];$i<=$limit['finish'];$i++){
					$veri=$veriler[$i];
					$data[]=array($veri[0],$veri[1]);
				}
				$xls = new Excel_XML;
				$xls->addWorksheet('Split Excel', $data);
				$xls->sendWorkbook('split-excel-'.$keyf.'.xls');
				exit; 
			}		
		}			
		}else{
			foreach($limits as $key=>$limit){
				echo '<a href="'.$url.'?parca='.$key.'" target="_blank">Parça '.$key.'</a><br>';
			}
		}
	}