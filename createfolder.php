
<?php
    $init= curl_init();
    $url = "http://127.0.0.1:8080/alfresco/s/api/login?u=admin&pw=123456";
    curl_setopt($init, CURLOPT_URL, $url);
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
    $ticket = curl_exec($init);
    $ticket = simplexml_load_string($ticket, 'SimpleXMLElement', LIBXML_NOCDATA)[0];
    curl_close($init);

    $folder = $_POST['namefolder'];
    $data = array(
        'name' => $folder,
        'title' => '',
        'description' => ''
    );
    $payload = json_encode($data);


    $ch = curl_init();
    $folderurl = "http://127.0.0.1:8080/alfresco/s/api/node/folder/";
    $token="?alf_ticket=".$ticket;
    $nodeId = $_POST['ref'] ?? "workspace/SpacesStore/807da3a3-a4e6-48c2-b135-819b8ad5e69c";
    $URLink = $folderurl.$nodeId.$token;
    curl_setopt($ch, CURLOPT_URL, $URLink);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
    );

    $result = curl_exec($ch);
    curl_close($ch);
    header('location:Documents.php');
?>
