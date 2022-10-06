<link rel="stylesheet" href="css/style.css">
<?php
$init= curl_init();
$url = "http://127.0.0.1:8080/alfresco/s/api/login?u=admin&pw=123456";
curl_setopt($init, CURLOPT_URL, $url);
curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
$ticket = curl_exec($init);
$ticket = simplexml_load_string($ticket, 'SimpleXMLElement', LIBXML_NOCDATA)[0];
curl_close($init);
?>
    <link rel="stylesheet" href="style.css">
    <?php
    $init= curl_init();
    $baseurl="http://127.0.0.1:8080/alfresco/s/slingshot/doclib2/doclist/folders/node/";
     $token="?alf_ticket=".$ticket;
    
    $nodeId = $_GET['nodeId'] ?? "workspace/SpacesStore/807da3a3-a4e6-48c2-b135-819b8ad5e69c";
    $url = $baseurl.$nodeId.$token;
    
    curl_setopt($init, CURLOPT_URL, $url);
    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
    $reponse = curl_exec($init);
    $res= json_decode($reponse);
?>
    
    <div class="card-body">
        <?php
            foreach($res->items as $item){
                $path= $item->node->nodeRef;
                $noderef=str_replace('://', '/', $path);
                ?>
            <table class="table table-bordered" id="Tableau-folder">
                <tr class="folder-tab">
                    <td id="folder-view"><?php echo '<a href="Documents.php?nodeId='.$noderef.'" class="node-link"><img src="./img/1.png" style="width:70px"><h3 class="nav-link-btn">'.$item->node->properties->{'cm:name'}.'</h3></a><br>';?>
                    <h5 class="des-link">recemment modifié le: <?php $heure = $item->node->properties->{'cm:modified'}->{'value'}.'</a><br>'; $timestamp = strtotime($heure); $newDate = date("m-d-Y", $timestamp ); echo $newDate;?> par:<?php echo $item->node->properties->{'cm:modifier'}->{'displayName'}.'</a><br>';?></h5>
                </td>
                    <td id="folder-action">
                            <a href="" id="copy-folder">Copier</a>
                            <a href="" id="move-folder">Deplacer</a>
                            <a href="delete.php?nodeId=<?= $noderef?>" id="delete-folder" name="delete">Supprimer</a>
                    </td>
                </tr>
            </table>
        <?php
        }?>


        <?php
            $lien ="http://127.0.0.2:8080/alfresco/s/slingshot/doclib2/doclist/documents/node/";
            $url2 =$lien.$nodeId.$token;
            curl_setopt($init,CURLOPT_URL, $url2);
            curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($init);
                $resultat= json_decode($response);
                foreach($resultat->items as $item){
                    $path= $item->node->nodeRef;
                    $noderef=str_replace('://', '/', $path);
                    ?>
                    <table class="table table-bordered" id="Tableau-folder">
                        <tr class="folder-tab">
                            <td id="folder-view"><?php echo '<a href="lecteurpdf.php?nodeId='.$noderef.'" class="node-link"><img src="./img/icone.png" style="width:50px"><h3class="nav-link-btn">'.$item->node->properties->{'cm:name'}.'</h3></a><br>';?>
                                <h5 class="des-link">recemment modifié le: <?php $heure = $item->node->properties->{'cm:modified'}->{'value'}.'</a><br>'; $heurelocal= date($heure); echo($heurelocal)?> par:<?php echo $item->node->properties->{'cm:modifier'}->{'displayName'}.'</a><br>';?></h5>
                            </td>
                            <td id="folder-action">
                                <div class="linkaction">
                                    <a href="" id="copy-folder">Copier</a>
                                    <a href="" id="move-folder">Deplacer</a>
                                    <a href="delete.php?nodeId=<?= $noderef?>" id="delete-folder" name="delete">Supprimer</a>
                                    <a href="" id="delete-folder">Télécharger</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                
                <?php 
                } ?>
    </div>
    
    

    