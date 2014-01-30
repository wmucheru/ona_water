<?php

/* functions.php */

function getPointStatus($json, $status){
	$func = '';
	
	/*Loop through the 'water_point_condition' key values */
	foreach($json as $js){
		if($js['water_point_condition'] == $status){
			$func++;
		}
	}
	return $func;
}

/* Get waterpoints according to status, blank status gives all  */
function countWaterPoints($community, $json, $status){
	$wpoints = 0;
	
	if($status=='functioning'){
		foreach($json as $js){
			if($js['communities_villages'] == $community && 
			   $js['water_point_condition'] == 'functioning'){
				$wpoints++;
			}
		}
		return $wpoints;
	}
	elseif($status=='broken'){
		foreach($json as $js){
			if($js['communities_villages'] == $community && 
			   $js['water_point_condition'] == 'broken'){
				$wpoints++;
			}
			
		}
		return $wpoints;
	}
	elseif($status==''){
		foreach($json as $js){
			if($js['communities_villages'] == $community){
				$wpoints++;
			}
		}
		return $wpoints;
	}
}




//Find a list of unique values from communities key / Push into array
function getCommunities($json){
	$comms[] = '';
	
	foreach($json as $js){
		array_push($comms, $js['communities_villages']);
	}
	return array_unique($comms);
}




/* Create an array of the total no. of water points per community */
function getCommunityBroken(){
	for($c=0; $c<$com_count; $c++){
		$name = isset($communities[$c])? $communities[$c] : '';
		$all_points = countWaterPoints($name, $json, '');
		$broken_points = countWaterPoints($name, $json, 'broken');
		
		if($name){
			//echo '<li>'.$name . ': <span class="dgt">'.number_format($percentage, 1, '.', '').'%</span></li>';
		}
		echo '<hr/>';
		var_dump($name);
	}
}


?>