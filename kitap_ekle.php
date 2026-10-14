<!DOCTYPE html>
<html>
<head>
    <style>
        .hcol {
            display: flex;
            flex-direction: column;
            gap: 15px;
            
        }

        textarea {
            width: 500px;
            border: 2px solid black;
        }

        input {
            font-size: 18px;
            border: 2px solid black;
        }

        .hcol div {
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <div class="hcol">
            <div><h2>Kitap Ekle</h2></div>
            <div><div>Kitap Adı </div><input name="kitap_adi" type="text"/></div>
            <div><div>Kitap Açıklama:</div> <textarea name="kitap_aciklama" rows=13></textarea></div>
            <div><div>Kitap Kapağı</div><input name="kitap_kapak" type="file"></div>
            <div><div>Kitap Fiyat </div><input name="kitap_fiyat" type="number"/></div>
            <div><input type="submit" name="ekle" value="Ekle"></input></div>
        </div>
    </form>
<?php
    include 'veritabani.php';
    if (isset($_POST["ekle"])) {
        $kitap_adi      = $_POST["kitap_adi"];
        $kitap_aciklama = $_POST["kitap_aciklama"];
        $kitap_fiyat    = $_POST["kitap_fiyat"];    
        
        $kitap_id = -1;
        $eklendi = $conn->query("INSERT INTO urun(adi, aciklama, fiyat) VALUES('$kitap_adi', '$kitap_aciklama', $kitap_fiyat)");
        $kitap_id = $conn->insert_id;
        if ($eklendi == TRUE && $kitap_id != -1) {
            $uploaded_file = $_FILES['kitap_kapak']['tmp_name'];
            $destination_path = $_SERVER['DOCUMENT_ROOT'] . "/Proje/urun_resimleri/$kitap_id.jpg";
            if (move_uploaded_file($uploaded_file, $destination_path)) {
                echo "File uploaded successfully!";
            } else {
                echo "Error uploading file.";
            }
        }

    }
?>
</body>

</html>
