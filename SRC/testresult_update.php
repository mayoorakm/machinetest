<?php
	define('DB_HOST', 'localhost');
	define('DB_USER', 'bankkixs_botnew');
	define('DB_PASSWORD', 'FdpfH^H8t4D4');
	define('DB_NAME', 'bankkixs_bot');
	
	($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASSWORD)) or die ('I cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) ;
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . constant('DB_NAME')));

$sel_calls=mysqli_query($GLOBALS["___mysqli_ston"], "select * from testing_results where `from`='' and `status`='Processing' group by test_id");

while($res_calls=mysqli_fetch_array($sel_calls))
{

$test_id=$res_calls['test_id'];

  $third_url='http://voipercan.com/api/web/v2/test/'.$test_id;
	  
    
	   $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL,$third_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer mDitiXkGNUUePdMT9RlE9Rx4gR7W4TKqv1UOZduM7n_WBMPKCanM0VQhLXcQPWfk'
                ));
                $result = curl_exec($curl);
                if(!$result){die("Connection Failure");}
                curl_close($curl);

       $record=json_decode($result);
	
	   $arr = json_decode(json_encode($record), True);
	   
	  
	   $count = count($arr['calls']);
	   
	   
	   for($p=0;$p<$count;$p++)
	   {
	   		$numberSrc=$arr['calls'][$p]['numberSrc'];
	   		$numberDst=$arr['calls'][$p]['numberDst'];
			$startTimestamp=$arr['calls'][$p]['startTimestamp'];
			$pdd=$arr['calls'][$p]['pdd'];
			$rbt=$arr['calls'][$p]['rbt'];
			$goodCall=$arr['calls'][$p]['goodCall'];
			$billsec=$arr['calls'][$p]['billsec'];
			$hangupCauseCode=$arr['calls'][$p]['hangupCauseCode'];
			
			
			$sel_rowid=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from testing_results where test_id='".$test_id."' limit $p,1"));
	        	
	        	$row_id=$sel_rowid['id'];
	        	
	        	mysqli_query($GLOBALS["___mysqli_ston"], "update testing_results set `from`='".$numberSrc."',`to`='".$numberDst."',`pdd`='".$pdd."',`rbt`='".$rbt."',`goodcall`='".$goodCall."',`billsec`='".$billsec."',`dates`='".$startTimestamp."',`status`='".$hangupCauseCode."' where test_id='".$test_id."' and id='".$row_id."'");
				
				
		}
		
		}
?>