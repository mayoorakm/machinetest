<?php
	define('DB_HOST', 'localhost');
	define('DB_USER', 'bankkixs_botnew');
	define('DB_PASSWORD', 'FdpfH^H8t4D4');
	define('DB_NAME', 'bankkixs_bot_dev');
	
	($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASSWORD)) or die ('I cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) ;
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . constant('DB_NAME')));

$page=$_GET['page'];

   $url='http://voipercan.com/api/web/v2/provider?page='.$page;
	  
    
	   $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL,$url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer mDitiXkGNUUePdMT9RlE9Rx4gR7W4TKqv1UOZduM7n_WBMPKCanM0VQhLXcQPWfk'
                ));
                $result = curl_exec($curl);
                if(!$result){die("Connection Failure");}
                curl_close($curl);

       $record=json_decode($result);
	
	   $count = count($record);
	   
	   $arr = json_decode(json_encode($record), True);
	   
	   for($p=0;$p<$count;$p++)
	   {
	   		$provider_name=$arr[$p]['title'];
	   		$ip=$arr[$p]['ip'];
				   
			$pr_id=$arr[$p]['id'];
				   
			$prefix=$arr[$p]['prefix'];
			
			$sel_prid=mysqli_query($GLOBALS["___mysqli_ston"], "select * from tbl_voipercan_provider where pr_id='".$pr_id."'");
	        	
	        	$num_prid=mysqli_num_rows($sel_prid);
	        	
	        	if ($num_prid<=0)
	        	{
					mysqli_query($GLOBALS["___mysqli_ston"], "insert into tbl_voipercan_provider (pr_id,name,ip,prefix) values ('".$pr_id."','".$provider_name."','".$ip."','".$prefix."')");
				}
				
		}
?>