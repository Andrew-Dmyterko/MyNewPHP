<?php

/**
 * Get weather from api.openweathermap.org
 * use API
 *
 * http://api.openweathermap.org/data/2.5/weather?id=706369&appid=0cc2936d01c4136a63efb215ae5429ae
 * http://api.openweathermap.org/data/2.5/weather?id=706369&units=metric&lang=ru&appid=0cc2936d01c4136a63efb215ae5429ae
 * where 706369 - Khmelnytskyi, UA
 *
 * How API use
 * By city ID
 *
 * You can make an API call by city ID. List of city ID 'city.list.json.gz' can be downloaded here.
 *
 * We recommend to call API by city ID to get unambiguous result for your city.
 *
 * API call
 * api.openweathermap.org/data/2.5/weather?id={city id}&appid={API key}
 *
 * Parameters
 * id 	required 	City ID. List of city ID 'city.list.json.gz' can be downloaded here.
 * appid 	required 	Your unique API key (you can always find it on your account page under the "API key" tab)
 * mode 	optional 	Response format. Possible values are xml and html. If you don't use the mode parameter format is JSON by default. Learn more
 * units 	optional 	Units of measurement. standard, metric and imperial units are available. If you do not use the units parameter, standard units will be applied by default. Learn more
 * lang 	optional 	You can use this parameter to get the output in your language. Learn more
 *
 * Examples of API calls
 * api.openweathermap.org/data/2.5/weather?id=2172797&appid={API key}
 *
 */
//forecast?id=

$apiKey = "0cc2936d01c4136a63efb215ae5429ae";
//$apiKey = "9de243494c0b295cca9337e1e96b00e2";
$cityId = "702550";
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=ru&cnt=3&units=metric&APPID=" . $apiKey;

$weatherRequest = curl_init();

curl_setopt($weatherRequest, CURLOPT_HEADER, 0);
curl_setopt($weatherRequest, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($weatherRequest, CURLOPT_URL, $apiUrl);
curl_setopt($weatherRequest, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($weatherRequest, CURLOPT_VERBOSE, 0);
curl_setopt($weatherRequest, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($weatherRequest);

curl_close($weatherRequest);

$data = json_decode($response,true);
$currentTime = time();

// ----------------- Наличный курс ПриватБанка (в отделениях):
$weatherRequest = curl_init();

$apiUrl = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";


curl_setopt($weatherRequest, CURLOPT_HEADER, 0);
curl_setopt($weatherRequest, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($weatherRequest, CURLOPT_URL, $apiUrl);
curl_setopt($weatherRequest, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($weatherRequest, CURLOPT_VERBOSE, 0);
curl_setopt($weatherRequest, CURLOPT_SSL_VERIFYPEER, false);
$response_course = curl_exec($weatherRequest);

curl_close($weatherRequest);

$course = json_decode($response_course,true);
$currentTime = time();
// ----------------- Наличный курс ПриватБанка (в отделениях):
// ----------------- погода 5 дней Хмельницкий
$apiUrl5days = "http://api.openweathermap.org/data/2.5/forecast/daily?id=".$cityId."&units=metric&cnt=5&appid=9de243494c0b295cca9337e1e96b00e2";

$weatherRequest = curl_init();

curl_setopt($weatherRequest, CURLOPT_HEADER, 0);
curl_setopt($weatherRequest, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($weatherRequest, CURLOPT_URL, $apiUrl5days);
curl_setopt($weatherRequest, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($weatherRequest, CURLOPT_VERBOSE, 0);
curl_setopt($weatherRequest, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($weatherRequest);

curl_close($weatherRequest);

$data5days = json_decode($response,true);

//var_dump($data5days);
//var_dump($data);

?>
</pre>

<style>
    body{
        background-color:#aaa!important;
    }
    .wrapper .single{
        color:#fff;
        width:100%;
        padding:10px;
        text-align:center;
        margin-bottom:10px;
    }
    .aqi-value{
        font-family : "Noto Serif","Palatino Linotype","Book Antiqua","URW Palladio L";
        font-size:40px;
        font-weight:bold;
    }
    h1{
        text-align: center;
        font-size:3em;
    }
    .forecast-block{
        background-color: #708072 !important;
        width:20% !important;
    }
    .title{
        background-color:#673f3f;
        width: 100%;
        color:#fff;
        margin-bottom:0px;
        padding-top:10px;
        padding-bottom: 10px;
    }
    .bordered{
        border:1px solid #fff;
    }
    .weather-icon{
        width:40%;
        font-weight: bold;
        background-color: #673f3f;
        padding:10px;
        border: 1px solid #fff;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />

<div class="container wrapper">
    <br>

    <div class="row">
        <h3 class="title text-center bordered">Weather Report for <?php echo $data['name'].' ('.$data['sys']['country'].')';?></h3>
        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
            <div class="single bordered" style="padding-bottom:25px;background:url('back.jpg') no-repeat ;border-top:0px;background-size: cover;">
                <div class="row">
                    <div class="col-sm-9" style="font-size:20px;text-align:left;padding-left:70px;">
                        <?php $temp = (double) $data['main']['temp'];?>
                        <p class="aqi-value"><?php echo round( $temp, 1 );?> °C</p>
<!--                        <p class="aqi-value">--><?php //echo ($data['main']['feels_like']);?><!-- °C</p>-->
                        <p class="weather-icon">
                            <img style="margin-left:-10px;" src="http://openweathermap.org/img/wn/<?php echo $data["weather"][0]['icon'];?>.png">
                            <?php echo $data["weather"][0]['description'];?>
                        </p>
                        <div class="weather-icon">
                            <p><strong>Wind Speed : </strong><?php echo $data['wind']['speed'];?> <?php echo "m/s";?></p>
                            <p><strong>Pressue : </strong><?php echo $data['main']['pressure'];?> <?php echo "hPa";?></p>
                            <p><strong>Visibility : </strong><?php echo $data['visibility'];?> <?php echo "m";?></p>
                            <p><strong>Humidity : </strong><?php echo $data['main']['humidity'];?> <?php echo "%";?></p>
                            <p><strong>Feels like : </strong><?php echo $data['main']['feels_like'];?> °C</p>
                        </div>

                            <div class="weather-icon">
                                <p><strong>Наличный курс ПриватБанка (в отделениях): </strong></p>
                                <table>
                                    <tr>
                                        <th>Валюта</th>
                                        <th></th>
                                        <th>Покупка</th>
                                        <th></th>
                                        <th>Продажа</th>
                                        <th></th>
                                    </tr>
                                    <?php foreach ($course as $id => $value) : ?>
                                        <tr>
                                            <td><?=$value['ccy']."/".$value['base_ccy']?></td>
                                            <td><?=" "?></td>
                                            <td><?=(float) $value['buy']?></td>
                                            <td><?=" "?></td>
                                            <td><?=(float) $value['sale']?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br>
    <div class="row">
        <h3 class="title text-center bordered">5 Days Weather Forecast for <?php echo $data['name'].' ('.$data['sys']['country'].')';?></h3>
        <?php foreach($data5days['list'] as $id => $day) :?>
            <div class="single forecast-block bordered">
                <h3><?php echo date("l", $day['dt']);?></h3>
                <h4><?php echo date("d.m.y", $day['dt']);?></h4>
                <p style="font-size:1em;" class="aqi-value"><?php echo $day['temp']['min'];?> °C - <?php echo $day['temp']['max'];?> °C</p>
                <hr style="border-bottom:1px solid #fff;">
                <img src="http://openweathermap.org/img/wn/<?php echo $day["weather"][0]['icon'];?>.png">
                <p><?php echo $day["weather"][0]['description'];?></p>
            </div>
        <?php endforeach;?>
    </div>
    <div class="weather-icon">
        <center>
            <p><strong>Наличный курс ПриватБанка (в отделениях): </strong></p>
            <table>
                <tr>
                    <th>Валюта</th>
                    <th></th>
                    <th>Покупка</th>
                    <th></th>
                    <th>Продажа</th>
                    <th></th>
                </tr>
                <?php foreach ($course as $id => $value) : ?>
                    <tr>
                        <td><?=$value['ccy']."/".$value['base_ccy']?></td>
                        <td><?=" "?></td>
                        <td><?=(float) $value['buy']?></td>
                        <td><?=" "?></td>
                        <td><?=(float) $value['sale']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </center>
    </div>
</div>