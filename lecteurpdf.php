<?php
$init= curl_init();
$url = "http://127.0.0.2:8080/alfresco/s/api/login?u=admin&pw=123456";
curl_setopt($init, CURLOPT_URL, $url);
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
$ticket = curl_exec($init);
$ticket = simplexml_load_string($ticket, 'SimpleXMLElement', LIBXML_NOCDATA)[0];
curl_close($init);
?>

<?php
$cookie = 'cookies.txt';
$timeout = 30;
$urlread = "http://127.0.0.2:8080/alfresco/s/slingshot/node/content/";
$token="?alf_ticket=".$ticket;
$nodeId = $_GET['nodeId'];
$url = $urlread.$nodeId.$token;

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout );
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);


header('Content-type: application/pdf');
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>