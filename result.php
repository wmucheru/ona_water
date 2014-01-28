<?php
//Require the functions file
require('inc/functions.php');

$file = file_get_contents('inc/Water.json', true);
$json = json_decode($file, true);
$total = count($json);
$communities = '';
$communities = array_values(getCommunities($json));
sort($communities);
//var_dump($json);
$com_count = count($communities);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Programming Task | Ona Labs</title>
<meta name="description" content=""/>
<meta name="keywords" content=""/>
<meta name="author" content="Mucheru"/>
<meta name="robots" content="index, follow" />
<meta name="revisit-after" content="7 days" />
<meta name="viewport" content="width=device-width, user-scalable=no"/>

<link rel="stylesheet" href="assets/css/reset.css"/>
<link rel="stylesheet" href="assets/css/style.css"/>
<link rel="stylesheet" href="assets/css/leaflet.css"/>
	
<style type="text/css">
#map{
	height:30em;
}
</style>
</head>
<body>
<div id="wrapper">
	<h2>Survey on Water Points</h2>
	<p>Based on research from: 
		<a href="http://ona.io/">http://ona.io</a></p>
	<br/><br/>
	
	<div class="container">
		<div class="waterbox cfix">
			<h3>Functional Water points: 
				<?php echo '<span style="color:green;">'.getPointStatus($json, 'functioning').'</span>'; ?></h3>
		</div>
		
		<div class="waterbox cfix">
			<h3>The number of water points per community: </h3>
			<table class="dataTables">
			<thead>
			<tr>
				<th width="60%">Community</th>
				<th># of Water points in community</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				for($c=0; $c<=$com_count; $c++){
					$name = isset($communities[$c])? $communities[$c] : '';
					if($name){
						echo '<tr><td>'.$name . '</td>
						<td>'.countWaterPoints($name, $json, '').'</td></tr>';
					}
				}
			?>
			</tbody>
			</table>
		</div>
	
		<div class="waterbox cfix">
			<h3>Percentage of broken water points per community</h3>
			<p>(Rankings in Descending order)</p><br/>
			
			<table class="dataTables">
			<thead>
			<tr>
				<th width="60%">Community</th>
				<th>% of Broken Water points</th>
			</tr>
			</thead>
			<tbody>
			
			<?php 
				
				for($c=0; $c<$com_count; $c++){
					$name = isset($communities[$c])? $communities[$c] : '';
					$all_points = countWaterPoints($name, $json, '');
					$broken_points = countWaterPoints($name, $json, 'broken');
					
					if($name && $broken_points!=0 && $all_points!=0){
						$percentage = ($broken_points/$all_points)*100;
						echo '<tr><td>'.$name . '</td>
						<td>'.number_format($percentage, 1, '.', '').'%</td></tr>';
					}
					//var_dump($name);
				}
			?>
			</tbody>
			</table>
		</div>
		
	<div class="cls"></div>
	</div>
<div class="cls"></div>
</div>
	
<!--<div id="map"></div>-->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/datatable.js"></script>
<script src="assets/js/leaflet.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
