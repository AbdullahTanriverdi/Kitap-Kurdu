<?php
include 'urun_ekle.php'; // urun_ekle.php dosyasını include ediyoruz
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim</title>
    <style>
        /* Özel CSS stil tanımlamaları */
        .urun-card {
            margin-bottom: 20px;
        }
        table {
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            background-color: #dedede;
            border: 1px solid black;
            color: black;
            font-weight: 400;
            font-family: Verdana;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left; text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td img {
            margin: auto auto;
            max-height: 100px;
            max-width: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sepetinizdeki Ürünler</h2>
        <div class="row">
            <table>
            <tr>
                <td>Kapak</td>
                <td>Urun Adi</td>
                <td>Fiyat</td>
                <td>Sil</td>
            </tr>
           
            <?php
             if(isset($_SESSION['sepet']) && is_array($_SESSION['sepet'])) {
                
                if (isset($_GET["sil"])) {
                    $sil_id = $_GET["sil"];
                    foreach($_SESSION['sepet'] as $key => $urun) {
                        if ($urun["urun_id"] == $sil_id) {
                            unset($_SESSION['sepet'][$key]);
                        }
                    }
                    echo "<script>window.location.href = 'sepet.php'</script>";
                    return;
                }

                foreach($_SESSION['sepet'] as $key => $urun) {
                    $urun_id = $urun['urun_id'];
                    $urun_adi = $urun["adi"];
                    $urun_fiyat = $urun["fiyat"];

                    ?>
                    <tr>
                        <td><img src="urun_resimleri/<?php echo $urun_id; ?>.jpg"></td>
                        <td><?php echo $urun_adi; ?></td>
                        <td><?php echo $urun_fiyat; ?> TL</td>
                        <td><a href="?sil=<?php echo $urun_id;?>"><button>Sil</button></a></td>
                    </tr>
                    <?php 
                }
                
            } else {
                echo "<p>Sepetinizde ürün bulunmamaktadır.</p>";
            }
            
            ?>
            </table>
        </div>
    </div>
          <!-- Anasayfaya dön butonu -->
    <a href="anasayfa.html" class="styled-button">Anasayfaya Dön</a>
    
    <!-- Kitaplığa dön butonu -->
    <a href="kitap.php" class="styled-button">Kitaplığa Dön</a>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
