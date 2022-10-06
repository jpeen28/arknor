<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>ARKNOR | Mes Documents</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name"></div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Rechercher...">
            </li>
            <li>
                <a href="dashboard.php">
                    <i class='bx bxs-grid-alt'></i>
                    <span class="links_name">Tableau de Bord</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="Documents.php">
                    <i class='bx bx-box'></i>
                    <span class="links_name">Mes Archives</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Mes Archives</span>
            </li>
            <li>
                <a href="nummerisation.php">
                    <i class='bx bx-printer'></i>
                    <span class="links_name">Numerisation</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Numerisation</span>
            </li>
            <li>
                <a href="ajouter.php">
                    <i class='bx bx-user-plus'></i>
                    <span class="links_name">Ajouter</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Ajouter</span>
            </li>
           
            <li>
                <a href="utilisateur.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Utilisateurs</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Utilisateurs</span>
            </li>
            <li>
                <a href="parametres.php">
                    <i class='bx bxs-cog'></i>
                    <span class="links_name">Parametres</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Parametres</span>
            </li>
        </ul>

        <div class="profile-content">
            <div class="profile">
                <div class="profile-details">
                    <img src="img/logo.png" alt="">
                    <div class="name-job">
                        <div class="name">ARKNOR</div>
                        <div class="job">Version 1.1.2</div>
                    </div>
                </div>
                <a href="deconnexion.php"><i class='bx bx-log-out' id="log-out"></i></a>
            </div>
        </div>
    </div>
    <div class="home-content">
        <div class="header-arch">
            <div class="new-folder">
                <form action="createfolder.php" method="post" class="folder-form">
                <input type="hidden" name="ref" value="<?= $_GET['nodeId'] ?? "workspace/SpacesStore/807da3a3-a4e6-48c2-b135-819b8ad5e69c"; ?>">
                    <input type="text" placeholder="Nom du dossier" id="folder" name="namefolder" required>
                    <input type="submit" value="Ajouter" id="btn-folder">
                </form>
            </div>
            <div class="upload-form">

                <?php
                    $init= curl_init();
                    $url = "http://127.0.0.2:8080/alfresco/s/api/login?u=admin&pw=123456";
                    curl_setopt($init, CURLOPT_URL, $url);
                    curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
                    $ticket = curl_exec($init);
                    $ticket = simplexml_load_string($ticket, 'SimpleXMLElement', LIBXML_NOCDATA)[0];
                    curl_close($init);
                    $token="?alf_ticket=".$ticket;
                    $nodeId = $_POST['destination'] ?? "workspace/SpacesStore/807da3a3-a4e6-48c2-b135-819b8ad5e69c";
                    $url="http://127.0.0.1:8080/alfresco/s/api/upload";
                    $upload = $url.$token;
                ?>

                <form action="<?=$upload;?>"method="post" enctype="multipart/form-data" class="uploading">
                    <input type="hidden" name="filename" value="">
                    <input type="hidden" name="destination" value="workspace://SpacesStore/807da3a3-a4e6-48c2-b135-819b8ad5e69c">
                    <input type="file" name="uplaod" id="upload" required>
                    <input type="submit" value="importer" id="btn-upload">
                </form>
            </div>
        </div>

        
<?php
include "doc.php";
?>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchbtn = document.querySelector(".bx-search");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        searchbtn.onclick = function() {
            sidebar.classList.toggle('active');
        }
    </script>
</body>

</html>