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
$init= curl_init();
$baseurl="http://127.0.0.2:8080/alfresco/s/slingshot/doclib/action/file/node/";
$token="?alf_ticket=".$ticket;

$nodeId = $_GET['nodeId'];
$url = $baseurl.$nodeId.$token;

curl_setopt($init, CURLOPT_URL, $url);
curl_setopt($init, CURLOPT_CUSTOMREQUEST,"DELETE");
curl_setopt($init, CURLOPT_RETURNTRANSFER,true);

$resultat = curl_exec($init);
$res = json_decode($resultat);
header('location:./Documents.php');
?>

