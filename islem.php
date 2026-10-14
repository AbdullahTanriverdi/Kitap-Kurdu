<?php
session_start();
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "uyeler";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Veritabanına bağlanılamadı: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    $kullanici_adi = trim($_POST['kullanici_adi'] ?? '');
    $kullanici_mail = trim($_POST['kullanici_mail'] ?? '');
    $kullanici_sifre = trim($_POST['kullanici_sifre'] ?? '');

    if (!empty($kullanici_adi) && !empty($kullanici_mail) && !empty($kullanici_sifre)) {
        // Kullanıcı adı veya e-posta var mı kontrol et (Prepared Statement)
        $check_stmt = $conn->prepare("SELECT * FROM visitor WHERE visitorname = ? OR visitormail = ?");
        $check_stmt->bind_param("ss", $kullanici_adi, $kullanici_mail);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $mesaj = '<p class="error-message">Bu kullanıcı adı veya e-posta zaten kullanılıyor.</p>';
        } else {
            // Yeni kullanıcıyı güvenli bir şekilde ekle
            $insert_stmt = $conn->prepare("INSERT INTO visitor (visitorname, visitormail, visitorsifre) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $kullanici_adi, $kullanici_mail, $kullanici_sifre);

            if ($insert_stmt->execute()) {
                $mesaj = '<p class="success-message" style="color:green;">Yeni kayıt başarıyla oluşturuldu.</p>';
            } else {
                $mesaj = '<p class="error-message" style="color:red;">Hata oluştu, lütfen tekrar deneyin.</p>';
            }
            $insert_stmt->close();
        }
        $check_stmt->close();
    } else {
        $mesaj = '<p class="error-message" style="color:red;">Lütfen tüm alanları doldurun.</p>';
    }

    $conn->close();
}
?>