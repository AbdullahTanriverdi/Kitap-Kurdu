<?php
// Oturumu başlat
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Veritabanı bağlantısı için bilgileri belirleme
    $servername = "localhost"; // Sunucu adı
    $username = "root"; // Veritabanı kullanıcı adı
    $password = ""; // Veritabanı şifresi
    $database = "uyeler"; // Veritabanı adı

    // Kullanıcı girişi başarılı olduğunda gelen kullanıcı ID'sini oturumdan al
    if(isset($_SESSION['kullanici_id'])) {
        $kullanici_id = $_SESSION['kullanici_id'];

        // POST ile gelen verileri alma
        $kitap_ismi = "Bir Aşk Masalı"; // Örnek olarak bir kitap ismi belirledik
        $kitap_resmi = "wh_true.jpg"; // Örnek olarak bir resim dosyası belirledik

        // Veritabanına bağlanma
        $conn = new mysqli($servername, $username, $password, $database);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Veritabanına bağlanılamadı: " . $conn->connect_error);
        }

        // Sepetlik tablosuna ürünü ekleme
        $sql2 = "INSERT INTO sepetlik (kullanici_id, kitap_resim, kitap_isim) VALUES ('$kullanici_id', '$kitap_resmi', '$kitap_ismi')";

        if ($conn->query($sql2) === TRUE) {
            echo "Sepete ürün başarıyla eklendi.";
        } else {
            echo "Hata: " . $sql2 . "<br>" . $conn->error;
        }

        // Veritabanı bağlantısını kapatma
        $conn->close();
    } else {
        // Oturumda kullanıcı ID'si bulunamadı, giriş yapılmamış olabilir
        echo "Kullanıcı oturumu bulunamadı. Lütfen giriş yapın.";
    }
}
?>
