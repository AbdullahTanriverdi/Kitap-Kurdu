<?php
include 'islem.php'; // islem.php dosyasını include ediyoruz
include 'veritabani.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
    function addToCart(urunAdi, resim) {
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', 'sepet.php');

        var urunInput = document.createElement('input');
        urunInput.setAttribute('type', 'hidden');
        urunInput.setAttribute('name', 'urun');
        urunInput.setAttribute('value', urunAdi);
        form.appendChild(urunInput);

        var resimInput = document.createElement('input');
        resimInput.setAttribute('type', 'hidden');
        resimInput.setAttribute('name', 'resim');
        resimInput.setAttribute('value', resim);
        form.appendChild(resimInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Tanıtım Sayfası</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Özel CSS stil tanımlamaları */
        .kitap-card {
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Kitap 1 -->
          
            <?php
            $urunler = $conn->query("SELECT * FROM urun WHERE 1");
            foreach ($urunler as $urun) {
                ?>
                          <div class="col-md-4">
                <div class="card kitap-card">
                    <img src="urun_resimleri/<?php echo $urun["urun_id"]; ?>.jpg" class="card-img-top" alt="Kitap Resmi  TODO1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $urun["adi"] ?></h5>
                        <p class="card-text"><?php echo $urun["aciklama"] ?></p>
                        <p class="card-text">Fiyat: <span class="badge badge-primary"><?php echo $urun["fiyat"]; ?> TL</span></p>
                        <a href="?sepet_ekle=<?php echo $urun['urun_id'] ?>" class="btn btn-primary">Sepete Ekle</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <?php

                if (isset($_GET["sepet_ekle"])) {
                    $urun_id = $_GET["sepet_ekle"];
                    $urun = null;
                    echo $urun_id;
                    foreach($urunler as $key => $aranan_urun) {
                        if ($aranan_urun["urun_id"] == $urun_id) {
                            $urun = $aranan_urun;
                           
                        }
                    }
                    if ($urun != null) {
                    if (!isset($_SESSION["sepet"])) {
                        $_SESSION["sepet"] = array();
                    }
                     array_push($_SESSION["sepet"], $urun); 
                    
                }
                }
            ?>
             <a href="sepet.php" class="styled-button">Sepet Sayfasına Git</a>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
