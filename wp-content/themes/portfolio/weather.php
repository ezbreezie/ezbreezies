<?php
/**
 * @package Ezbreezies
 * Weather API Practice
 * Template Name: Weather
**/

get_header();
date_default_timezone_set('America/New_York');

?>

<style>

html,body{
	background:rgba(80, 189, 204, 0.4);
	color:#333;
}

#page{
	position:relative;
	height:100%;
}

.icon {
	display: inline-block;
	width: 1em;
	height: 1em;
	stroke-width: 0;
	stroke: currentColor;
	fill: currentColor;
	height: 200px;
	width: 200px;
	position: absolute;
	right: -30px;
	top: -30px;
	z-index:-1;
	-webkit-animation-name: spin;
    -webkit-animation-duration: 10s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 10s;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 10s;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;
    
    animation-name: spin;
    animation-duration: 10s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

.icon path{
	fill:yellow;
	opacity:0.2;
}

@-ms-keyframes spin {
    from { -ms-transform: rotate(0deg); }
    to { -ms-transform: rotate(360deg); }
}
@-moz-keyframes spin {
    from { -moz-transform: rotate(0deg); }
    to { -moz-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
    from { -webkit-transform: rotate(0deg); }
    to { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}

main{
	position:absolute;
	width:350px;
	height:300px;
	border:1px solid #fff;
	top:50%;
	left:50%;
	transform:translate(-50%,-50%);
	background-color:rgba(255,255,255,0.2);
	overflow:hidden;
}

.content{
	padding:25px;
}

h1{
	color:#333;
	font-weight:800;
}

h5{
	font-size:14px;
	font-weight:800;
}

p{
	margin-bottom:8px;
	color:#333;
}

.weather-header h1{
	margin-bottom:7px;

}

.weather-header h5{
	margin-bottom:7px;

}

.temperature {
    font-size: 50px;
    margin: 30px 0;
}

.forecast span{
	font-weight:800;
	font-size:14px;
}

</style>

<?php

$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="philadelphia, pa")';
$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";

$session = curl_init($yql_query_url);
curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
$json = curl_exec($session);

$weather_data =  json_decode($json);

$condition = $weather_data->query->results->channel->item->condition->text;
$temperature = $weather_data->query->results->channel->item->condition->temp;
$rise = $weather_data->query->results->channel->astronomy->sunrise;
$set = $weather_data->query->results->channel->astronomy->sunset;

?>

<main data="<?php echo $yql_query_url; ?>">
	<svg class="icon icon-sun">
		<use xlink:href="#icon-sun">
			<symbol id="icon-sun" viewBox="0 0 32 32">
				<title>sun</title>
				<path d="M16 26c1.105 0 2 0.895 2 2v2c0 1.105-0.895 2-2 2s-2-0.895-2-2v-2c0-1.105 0.895-2 2-2zM16 6c-1.105 0-2-0.895-2-2v-2c0-1.105 0.895-2 2-2s2 0.895 2 2v2c0 1.105-0.895 2-2 2zM30 14c1.105 0 2 0.895 2 2s-0.895 2-2 2h-2c-1.105 0-2-0.895-2-2s0.895-2 2-2h2zM6 16c0 1.105-0.895 2-2 2h-2c-1.105 0-2-0.895-2-2s0.895-2 2-2h2c1.105 0 2 0.895 2 2zM25.899 23.071l1.414 1.414c0.781 0.781 0.781 2.047 0 2.828s-2.047 0.781-2.828 0l-1.414-1.414c-0.781-0.781-0.781-2.047 0-2.828s2.047-0.781 2.828 0zM6.101 8.929l-1.414-1.414c-0.781-0.781-0.781-2.047 0-2.828s2.047-0.781 2.828 0l1.414 1.414c0.781 0.781 0.781 2.047 0 2.828s-2.047 0.781-2.828 0zM25.899 8.929c-0.781 0.781-2.047 0.781-2.828 0s-0.781-2.047 0-2.828l1.414-1.414c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-1.414 1.414zM6.101 23.071c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-1.414 1.414c-0.781 0.781-2.047 0.781-2.828 0s-0.781-2.047 0-2.828l1.414-1.414z"></path>
				<path d="M16 8c-4.418 0-8 3.582-8 8s3.582 8 8 8c4.418 0 8-3.582 8-8s-3.582-8-8-8zM16 21c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5z"></path>
			</symbol>
		</use>
	</svg>

	<div class="content">
		<div class="weather-header">
			<h5 class="header-font">CURRENTLY IN</h5>
			<h1>Philadelphia</h1>
			<p><?php echo date(" F j, Y | g:i a"); ?></p>
		</div>
		<div class="forecast">
			<h1 class="temperature"><?php echo $temperature; ?>&deg;F</h1>
			<p><span class="header-font">CONDITION:</span> <?php echo $condition; ?></p>
			<p><span class="header-font">SUNRISE:</span> <?php echo $rise; ?></p>
			<p><span class="header-font">SUNSET:</span> <?php echo $set; ?></p>
		</div>
	</div>

</main>

<?php //get_template_part('/page-templates/about'); ?>

<?php
get_footer();